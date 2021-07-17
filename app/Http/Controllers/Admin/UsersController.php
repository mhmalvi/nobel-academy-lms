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
    public function store(CreateUserRequest $request)
    {
        try {
            $file = null;

            if ($request->hasFile('avatar')) {
                /**
                 * Check if derectory exist or not
                 * Create a new directory if not exist
                 */
                if (!Storage::exists("public/users")) {
                    Storage::makeDirectory("public/users");
                }

                $image = $request->file('avatar');
                $imgExtension = $image->getClientOriginalExtension();

                $file = date('dmy-hms') . '.' . $imgExtension;

                //Store the file after saving it to the databse
                Storage::putFileAs('public/users', $image, $file);
            }

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password,
                'photo' => $file,
                'user_type' => $request->user_type,
            ]);

            if ($user->id) {
                UserInfo::create([
                    'user_id' => $user->id,
                    'firstname' => $request->fName,
                    'lastname' => $request->lName,
                    'phone' => $request->phone,
                    'address' => $request->address,
                ]);

                if ($user->user_type == 'student') {
                    Enrollment::create([
                        'student_id' => $user->id,
                        'course_id' => $request->course_id,
                    ]);

                    return redirect()->route('admin.assign', $user->id);
                }
            }

            return back();
        } catch (\Throwable $th) {
            /**
             * Return the exceptions
             */
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }
}
