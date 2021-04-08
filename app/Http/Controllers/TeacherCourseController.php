<?php

namespace App\Http\Controllers;

use App\Models\Step;
use App\Models\Course;
use App\Models\CourseUnit;
use App\Models\CourseUnitFiles;

class TeacherCourseController extends Controller
{
    /**
     * 
     */
    public function index($id){
        $steps = Step::all();
        $course = Course::with('units')->where('id', $id)->first();
        return view('teacher.course', compact('course', 'steps'));
    }



    /**
     * GET['instructor/{id}/unit']
     */
    public function courseUnit($id){
        $steps = Step::all();
        $unit = CourseUnit::with('files')->where('id', $id)->first();

        return view('teacher.unit', compact('unit', 'steps'));
    }
}
