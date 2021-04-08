<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Course;
use App\Models\Teacher;
use App\Support\AppCryption;
use App\Models\CoursesTeacher;
use App\Exceptions\AppExceptions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateUserRequest;

class TutorController extends Controller
{
    /**
     * 
     */
    public function index(){
        try {

            $teachers = Teacher::orderBy('created_at', 'desc')->get();
            return view('admin.tutors.index', compact('teachers'));

        } catch (\Throwable $th) {
            /**
             * Return the exceptions
             */
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }



    /**
     * 
     */
    public function create(){
        try {

            $courses = Course::all();
            return view('admin.tutors.create', compact('courses'));

        } catch (\Throwable $th) {
            /**
             * Return the exceptions
             */
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }


    /**
     * 
     */
    public function store(CreateUserRequest $request){
        try {
            $file = null;
            if($request->hasFile('avatar')){
                //check if directory exist or not
                if (!Storage::exists("public/users")) {
                    Storage::makeDirectory("public/users");
                }
    
                $image = $request->file('avatar');
                $imgExtension = $image->getClientOriginalExtension();
    
                $file = date('dmy-hms').'.'.$imgExtension;
    
                //store image into storage directory
                Storage::putFileAs('public/users', $image, $file);
            }
    
            $data = [
                'action_user' => Auth::id(),
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,
                'photo' => $file,
                'user_type' => 'teacher',
                'action_user' => Auth::id()
            ];

            $user = User::create($data);

            if($user->id){
                $teacher = Teacher::create([
                    'action_user' => Auth::id(),
                    'user_id' => $user->id,
                    'first_name' => $request->fName,
                    'last_name' => $request->lName,
                    'phone' => $request->phone,
                    'mobile' => $request->mobile,
                    'address_one' => $request->address,
                    'address_two' => $request->address_op
                ]);

                if($teacher->id){
                    if($request->filled('course_id')){
                        foreach($request->course_id as $course){
                            CoursesTeacher::create([
                                'action_user' => Auth::id(),
                                'teacher_id' => $teacher->id,
                                'course_id' => $course
                            ]);
                        }
                    }

                    $notification = [
                        'message'   =>  "An account for {$user->name} successfully created!",
                        'alert-type'    =>  'success'
                    ];
            
                    return redirect()->back()->with($notification);
                }
                else{
                    throw new Exception('Something went wrong!');
                }
            }
            else{
                throw new Exception('Something went wrong!');
            }

        } catch (\Throwable $th) {
            /**
             * Return the exceptions
             */
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }
}
