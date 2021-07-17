<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\UserInfo;
use App\Models\Enrollment;
use App\Exceptions\AppExceptions;
use App\Http\Requests\CreateUserRequest;

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
    public function store(CreateUserRequest $request)
    {
        try {
            $user = $request->store();

            if ($user) {
                $request->saveInfo($user);
            }

            if ($user->user_type == 'student' && $request->has('course_id')) {
                Enrollment::create([
                    'student_id' => $user->id,
                    'course_id' => $this->course_id,
                ]);

                return redirect()->route('admin.assign', $user->id);
            } else {
                return back();
            }
        } catch (\Throwable $th) {
            /**
             * Return the exceptions
             */
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }
}
