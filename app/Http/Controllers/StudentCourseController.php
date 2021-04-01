<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseUnit;
use App\Models\CourseUnitFiles;
use App\Models\Enrollment;
use App\Models\Step;
use App\Models\UnitProgress;
use Illuminate\Support\Facades\Auth;

class StudentCourseController extends Controller
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
    public function courseUnit($unique_id = null){
        $steps = Step::all();
        $files = CourseUnitFiles::all();
        $unit = CourseUnit::with('progress')->where('id', $unique_id)->first();

        return view('student.unit', compact('unit', 'files', 'steps'));
    }



    /**
     * Unit Steps
     */
    public function getStep($unitId, $stepId){
        $steps = Step::all();
        $files = CourseUnitFiles::all();
        $getStep = Step::with('files')->findOrFail($stepId);
        $unit = CourseUnit::with('progress')->where('id', $unitId)->first();
        return view('student.unit', compact('unit', 'files', 'steps', 'getStep'));
    }



    /**
     * 
     */
    public function completeStep($unitId, $id)
    {
        $progress = UnitProgress::where('student_id', Auth::user()->student->id)->where('course_unit_id', $unitId)->first();
        $progress->complete_step = $id;
        $progress->current_step = $progress->current_step + 1;
        $progress->save();

        return redirect()->back();
    }
}
