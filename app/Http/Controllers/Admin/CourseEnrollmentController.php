<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\CourseUnit;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Support\AppCryption;
use App\Exceptions\AppExceptions;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EnrollmentRequest;
use App\Models\UnitProgress;

class CourseEnrollmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $courses = Course::all();
        $teachers = Teacher::all();
        $students = Student::all(); 
        $enrollments = Enrollment::orderBy('created_at', 'desc')->get();
        return view('admin.students.course-enroll', compact('courses', 'teachers', 'students', 'enrollments'));
    }


    /**
     * 
     */
    public function store(EnrollmentRequest $request){
        try{
            $enroll = Enrollment::create([
                'action_user' => Auth::id(),
                'student_id' => $request->student_id,
                'teacher_id' => $request->tutor_id,
                'course_id' => $request->course_id,
            ]);

            if($enroll->id){
                $notification = [
                    'message'   =>  "Successfully saved!",
                    'alert-type'    =>  'success'
                ];
        
                return redirect()->route('admin.assign', $request->student_id)->with($notification);
            }
            else{
                throw new Exception("Something went wrong!");
            }
        }
        catch(\Throwable $th){
            /**
             * Return the exception
             */
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }



    /**
     * 
     */
    public function unit($id){
        $core = CourseUnit::where('unit_type', 'core')->orderBy('course_id', 'asc')->get();
        $elective = CourseUnit::where('unit_type', 'elective')->get();
        $enrollment = Enrollment::where('student_id', $id)->first();
        return view('admin.students.course-unit', compact('core', 'elective', 'enrollment'));
    }


    /**
     * 
     */
    public function assignUnit(Request $request, $id){
        (array) $units = [];

        $enrollment = Enrollment::where('id', $id)->first();

        if($request->unit == 'core'){
            foreach ($request->units as $id) {
                $unit = CourseUnit::findOrFail($id);

                array_push($units, $unit->unit_code);

                /**
                 * Create or update
                 * unit process report/data
                 */
                UnitProgress::updateOrCreate(
                    [
                        'student_id' => $enrollment->student_id,
                        'course_id' => $enrollment->course_id,
                        'course_unit_id' => $id
                    ],
                    [
                        'action_user' => Auth::id(),
                        'student_id' => $enrollment->student_id,
                        'course_id' => $enrollment->course_id,
                        'course_unit_id' => $id
                    ]
                );
            }
            $enrollment->core_units = $units;
            $enrollment->save();
        }

        return redirect()->back();
    }
}
