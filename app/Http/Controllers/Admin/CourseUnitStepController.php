<?php

namespace App\Http\Controllers\Admin;

use App\Models\Step;
use Illuminate\Http\Request;
use App\Exceptions\AppExceptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseUnitStepRequest;
use App\Http\Resources\CourseUnitStepsCollection;

class CourseUnitStepController extends Controller
{
    /**
     *GET['steps']
     */
    public function index(){
        return view('admin.CourseUnitStep.index');
    }



    /**
     * GET['get-steps']
     */
    public function getAllSteps(){
        return new CourseUnitStepsCollection(Step::all());
    }



    /**
     * POST['steps']
     */
    public function store(CourseUnitStepRequest $request)
    {
        try {
            $id = [
                'id' => ($request->id)? $request->id : null,
            ];

            $step = Step::updateOrCreate($id, [
                'action_user' => Auth::id(),
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
        } catch (\Throwable $th) {
            /**
             * Return exception
             */
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }



    /**
     * GET['get-step']
     */
    public function edit(Request $request){
        try {
            if ($request->expectsJson()) {
                $id = $request->id;
                $step = Step::findOrFail($id);

                return response()->json([
                    'data' => [
                        'Id' => $step->id,
                        'Step' => $step->step_name,
                        'Details' => $step->descriptions
                    ],

                    'status' => 200
                ]);
            }
        } catch (\Throwable $th) {
            /**
             * Return exception
             */
            return response()->json([
                'data' => AppExceptions::throwback($th),
                'status' => 404
            ]);
        }
    }



    /**
     * Delete['remove/steps']
     */
    public function destroy(Request $request){
        $arr = $request->id;
        $csv = implode(", ", array_map(function($arr){
            return $arr;
        }, $arr));

        try {
            return response()->json([
                'data' => DB::delete("DELETE FROM steps WHERE id IN ($csv)"),
                'status' => 200
                ]);
        } catch (\Throwable $th) {
            /**
             * Return exception
             */
            return response()->json([
                'data' => AppExceptions::throwback($th),
                'status' => 404
            ]);
        }
    }
}
