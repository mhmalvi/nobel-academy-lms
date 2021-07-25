<?php

namespace App\Http\Controllers;

use App\Models\Assesment;
use App\Models\Course;
use App\Models\CourseUnit;
use App\Models\CourseUnitFiles;
use App\Models\Enrollment;
use App\Models\Step;
use App\Models\UnitProgress;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class StudentCourseController extends Controller
{
    /**
     * 
     */
    public function index(int $id)
    {
        $course = Course::where('id', $id)->first();
        $enrollment = Enrollment::where('student_id', Auth::user()->student->id)
            ->where('course_id', $id)
            ->first();
        return view('student.course', compact('course', 'enrollment'));
    }



    /**
     * 
     */
    public function courseUnit(int $unique_id = null)
    {
        $steps = Step::all();
        $files = CourseUnitFiles::all();
        $unit = CourseUnit::where('id', $unique_id)->first();
        $progress = UnitProgress::where('student_id', Auth::id())->where('course_unit_id', $unit->id)->first();

        return view('student.unit', compact('unit', 'files', 'steps', 'progress'));
    }



    /**
     * Unit Steps
     */
    public function getStep(int $unitId, int $stepId)
    {
        $steps = Step::all();
        $files = CourseUnitFiles::all();
        $getStep = Step::with('files')->findOrFail($stepId);
        $unit = CourseUnit::with('progress')->where('id', $unitId)->first();
        $progress = UnitProgress::where('student_id', Auth::id())->where('course_unit_id', $unit->id)->first();
        return view('student.unit', compact('unit', 'files', 'steps', 'getStep', 'progress'));
    }



    /**
     * 
     */
    public function completeStep(Request $request, $unitId, $id)
    {
        $steps = Step::all();
        $progress = UnitProgress::where('student_id', Auth::id())->where('course_unit_id', $unitId)->first();

        if ($request->has('link') && count($steps) == $id) {
            $rules = [
                'link' => 'required',
            ];

            $message = [
                'link.required' => 'You must provide assignments drive link'
            ];

            Validator::make($request->all(), $rules, $message)->validate();

            Assesment::create([
                'student_id' => Auth::id(),
                'unit_id' => $unitId,
                'links' => $request->link
            ]);

            Session::flash('assesment', 'Assenment request submited successfully, you will be notified shortly');

            return back();
        }

        $progress->complete_step = $id;
        $progress->current_step = $progress->current_step + 1;
        $progress->save();

        return redirect()->route('step', ['unitId' => $unitId, 'stepId' => $progress->current_step]);
    }
}
