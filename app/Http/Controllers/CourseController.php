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
    public function courseUnit($unique_id){
        $steps = Step::all();
        $files = CourseUnitFiles::all();
        $unit = CourseUnit::with('progress')->where('id', $unique_id)->first();

        return view('unit', compact('unit', 'files', 'steps'));
    }



    /**
     * Unit Steps
     */
    public function getStep($stepId){
        $step = Step::findOrFail($stepId);
        return view('step', compact('step'));
    }
}
