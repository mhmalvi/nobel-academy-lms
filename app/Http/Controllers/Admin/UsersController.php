<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Enrollment;
use App\Exceptions\AppExceptions;
use App\Http\Requests\CreateUserRequest;
use App\Models\Teachers;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    /**
     * 
     */
    public function index()
    {
        $users = User::with('info')->paginate(10);

        return view('admin.users.index', compact('users'));
    }


    /**
     * 
     */
    public function show(Request $request)
    {
        $users = User::with('info')->where('user_type', $request->userType)->paginate(10);
        return view('admin.users.index', compact('users'));
    }


    public function edit($id)
    {
        $user = User::with('info')->findOrFail($id);

        return view('admin.users.update', compact('user'));
    }


    /**
     * 
     */
    public function store(CreateUserRequest $request)
    {
        try {
            $user = $request->store();

            if ($user) {
                $request->saveInfo($user);
            }

            if ($user->user_type == 'Student' && $request->has('course_id')) {
                Enrollment::create([
                    'uuid' => Str::random(8),
                    'student_id' => $user->id,
                    'course_id' => $request->course_id,
                ]);
            } elseif ($user->user_type == 'Teacher' && $request->has('course_id')) {
                Teachers::create([
                    'user_id' => $user->id,
                    'course_id' => $request->course_id
                ]);
            }
            $notification = [
                'message'   =>  "successfully saved",
                'alert-type'    =>  'success'
            ];
            return redirect()->route('admin.user.profile', $user->id)->with($notification);
        } catch (\Throwable $th) {
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }


    /**
     * 
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return back();
        } catch (\Throwable $th) {
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }


    /**
     * view trashed recordeds
     */
    public function trashedRecords()
    {
        $users = User::onlyTrashed()->paginate(10);

        return view('admin.users.index', compact('users'));
    }


    /**
     * Profile
     */
    public function profile($id)
    {
        $user = User::with(['enrollments', 'info'])->findOrFail($id);
        return view('admin.users.profile', compact('user'));
    }


    /**
     * restore a softdeleted model
     */
    public function restoreSoftDelete($id)
    {
        try {
            User::withTrashed()->findOrFail($id)->restore();
            return redirect()->route('admin.users');
        } catch (\Throwable $th) {
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }


    /**
     * Permanently delete a softdeleted model
     */
    public function permanentDestroy($id)
    {
        try {
            $user = User::withTrashed()->findOrFail($id);
            Storage::delete('public/users/' . $user->photo);

            $user->forceDelete();

            return redirect()->route('admin.users');
        } catch (\Throwable $th) {
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }
}
