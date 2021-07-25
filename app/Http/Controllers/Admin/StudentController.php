<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\User;
use App\Models\Course;
use App\Models\Teacher;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exceptions\AppExceptions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CourseUnit;
use App\Http\Requests\EnrollmentRequest;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::with('enrollment')->orderBy('created_at', 'desc')->get();
        return view('admin.students.index', compact('students'));
    }



    /**
     * 
     */
    public function create()
    {
        $courses = Course::all();
        $teachers = Teacher::all();
        return view('admin.students.create', compact('teachers', 'courses'));
    }



    /**
     * 
     */
    public function store(EnrollmentRequest $request)
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

            $data = [
                'name' => Str::ucfirst($request->name),
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => $request->password,
                'photo' => $file,
                'user_type' => 'student',
            ];

            $user = User::create($data);

            if ($user->id) {
                $student = Student::create([
                    'action_user' => Auth::id(),
                    'user_id' => $user->id,
                    'first_name' => Str::ucfirst($request->fName),
                    'last_name' => Str::ucfirst($request->lName),
                    'phone' => $request->phone,
                    'mobile' => $request->mobile,
                    'address_one' => $request->address,
                    'address_two' => $request->address_op,
                    'is_enrolled' => 'y'
                ]);

                if ($student->id) {
                    Enrollment::create([
                        'action_user' => Auth::id(),
                        'student_id' => $student->id,
                        'teacher_id' => $request->tutor_id,
                        'course_id' => $request->course_id,
                    ]);
                    /**
                     * retun successfull notification
                     */
                    $notification = [
                        'message'   =>  "successfully saved",
                        'alert-type'    =>  'success'
                    ];

                    return redirect()->route('admin.assign', $student->id)->with($notification);
                } else {
                    /**
                     * Throw an exception if request cannot be processed
                     */
                    throw new Exception("Error Processing Request", 1);
                }
            } else {
                /**
                 * Throw an exception if request cannot be processed
                 */
                throw new Exception("Error Processing Request", 1);
            }
        } catch (\Throwable $th) {
            /**
             * Return the exceptions
             */
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }


    /**
     * Get['admin/students/{id}/profile']
     * 
     * @return view
     */
    public function profile(int $id)
    {
        $user = User::with(['enrollments', 'info'])->findOrFail($id);
        $units = CourseUnit::where('course_id', $user->enrollments->course_id)->get();
        return view('admin.users.profile', compact('user', 'units'));
    }


    /**
     * @return view
     */
    public function edit($id)
    {
        try {
            $student = Student::with(['user', 'enrollment'])->findOrFail($id);
            $courses = Course::all();
            $teachers = Teacher::all();
            return view('admin.students.update', compact('student', 'courses', 'teachers'));
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
    public function update(Request $request, $id)
    {
        try {
            $student = Student::findOrFail($id);


            $student->first_name = $request->fName;
            $student->last_name = $request->lName;
            $student->phone = $request->phone;
            $student->mobile = $request->mobile;
            $student->address_one = $request->address;
            $student->address_two = $request->address_op;

            $student->save();

            /**
             * retun successfull notification
             */
            $notification = [
                'message'   =>  "successfully saved",
                'alert-type'    =>  'success'
            ];

            return redirect()->route('admin.students')->with($notification);
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
    public function delete($id)
    {
        try {
            $student = Student::findOrFail($id);

            $student->delete();

            /**
             * retun successfull notification
             */
            $notification = [
                'message'   =>  "successfully deleted",
                'alert-type'    =>  'success'
            ];

            return redirect()->route('admin.students')->with($notification);
        } catch (\Throwable $th) {
            /**
             * Return the exceptions
             */
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }
}
