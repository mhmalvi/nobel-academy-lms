<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\CourseUnit;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
                        'course_unit_id' => $id,
                    ]
                );
            }
            $enrollment->core_units = $units;
            $enrollment->save();
        }

        if($request->unit == 'elective'){
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
                        'course_unit_id' => $id,
                    ]
                );
            }
            $enrollment->elective_units = $units;
            $enrollment->save();
        }

        return redirect()->back();
    }
}
