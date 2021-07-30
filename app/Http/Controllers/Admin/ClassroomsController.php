<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateClassroomRequest;
use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomsController extends Controller
{
    public function index()
    {
        // $classes = Classroom::with('course')->orderBy('created_at', 'asc')->paginate(12);
        // return view('admin.classrooms.index', compact('classes'));
    }

    public function store(CreateClassroomRequest $request)
    {
        try {
            $request->save();

            $notification = [
                'message'   =>  "Successfully saved",
                'alert-type'    =>  'success'
            ];

            return redirect()->back()->with($notification);
        } catch (\Throwable $th) {
            $notification = [
                'message'   =>  $th->getMessage(),
                'alert-type'    =>  'warning'
            ];
            return redirect()->back()->with($notification);
        }
    }
}
