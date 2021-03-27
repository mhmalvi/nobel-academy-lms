<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseUnit;
use App\Models\CourseUnitFiles;
use App\Models\Enrollment;
use App\Models\Step;
use Illuminate\Support\Facades\Auth;

class CourseController extends Controller
{
    /**
     * 
     */
    public function index($id){
        $course = Course::where('id', $id)->first();
        $enrollment = Enrollment::where('student_id', Auth::user()->student->id)
            ->where('course_id', $id)
            ->first();
        return view('student.course', compact('course', 'enrollment'));
    }


    /**
     * 
     */
    public function course($id){
        $course = Course::where('id', $id)->first();
        return view('teacher.course', compact('course'));
    }


    /**
     * 
     */
    public function coreUnit($unique_id){
        $unit = CourseUnit::where('id', $unique_id)->first();
        $files = CourseUnitFiles::all();
        $steps = Step::all();
        return view('unit', compact('unit', 'files', 'steps'));
    }


    /**
     * 
     */
    public function elctiveUnit($unique_id){
        $unit = CourseUnit::where('id', $unique_id)->first();
        $files = CourseUnitFiles::all();
        
        return view('unit', compact('unit', 'files'));
    }
}
