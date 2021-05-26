<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assesment;
use Illuminate\Http\Request;

class AssesmentsController extends Controller
{
    /**
     * 
     */
    public function index()
    {
        $assesments = Assesment::with(['student', 'course', 'unit'])->get();
        return view('admin.assesment.index', compact('assesments'));
    }


    /**
     * @return void
     * 
     */
    public function update(Request $request)
    {
        $headers = [
            'content-type' => 'application/json'
        ];

        try {
            if ($request->expectsJson()) {

                $assesment = Assesment::findOrFail($request->assesment);
    
                if ($request->status === 'approved') {
                    $assesment->schedule = $request->schedule;
                    $assesment->status = $request->status;
                }else{
                    $assesment->status = $request->status;
                }
            }

            $assesment->save();
    
            return response()->json([
                'status' => 'Successfully Saved'
            ], 200, $headers);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => $th->getMessage()
            ], 503, $headers);
        }
    }
}
