<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CourseUnitStepRequest;
use App\Models\Step;
use Illuminate\Http\Request;

class CourseUnitStepController extends Controller
{
    /**
     *
     */
    public function index(){
        return view('admin.CourseUnitStep.index');
    }


    public function store(CourseUnitStepRequest $request)
    {
        $step = Step::create([
            'step_name'=>$request->step_name,
            'descriptions'=>$request->description
        ]);


        if($step->id){
            /**
             * retun successfull notification
             */
            $notification = [
                'message'   =>  "{$request->stepName} successfully saved",
                'alert-type'    =>  'success'
            ];

            return redirect()->back()->with($notification);
        }

    }
}
