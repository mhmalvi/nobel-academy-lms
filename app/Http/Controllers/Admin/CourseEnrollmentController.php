<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\CourseUnit;
use App\Models\Enrollment;
use App\Http\Controllers\Controller;

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

}
