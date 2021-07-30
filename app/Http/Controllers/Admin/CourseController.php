<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Exceptions\AppExceptions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CourseCreateRequest;
use App\Http\Requests\CourseUpdateRequest;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;
use App\Models\Teachers;

class CourseController extends Controller
{
    /**
     * Category Collections
     */
    public function getData()
    {
        return new CourseResource(
            Course::orderBy('created_at', 'desc')->get()
        );
    }

    /**
     * Display a listing of the resource.
     * return with the resources
     */
    public function index()
    {
        return view('admin.course.index');
    }

    /**
     * 
     */
    public function store(CourseCreateRequest $request)
    {
        try {
            $course = $request->save();
            if ($request->filled('tutor_id')) {
                foreach ($request->tutor_id as $tutor) {
                    Teachers::create([
                        'user_id' => $tutor,
                        'course_id' => $course->id
                    ]);
                }
            }

            $notification = [
                'message'   =>  $request->course_name . " successfully saved",
                'alert-type'    =>  'success'
            ];

            return redirect()->route('admin.courses')->with($notification);
        } catch (\Throwable $th) {
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }



    /**
     * 
     */
    public function edit(Request $request)
    {
        try {
            if ($request->expectsJson()) {
                $id = $request->id;
                $course = Course::find($id);

                return view('admin.course.update', compact('course'));
            }
        } catch (\Throwable $th) {
            return response()->json([
                'msg' => AppExceptions::throwback($th)
            ], 503);
        }
    }



    /**
     * Update
     */
    public function update(CourseUpdateRequest $request, $id)
    {
        try {
            $request->update($id);

            $notification = [
                'message'   =>  "Successfully saved",
                'alert-type'    =>  'success'
            ];

            return redirect()->route('admin.courses')->with($notification);
        } catch (\Throwable $th) {
            /**
             * Return the exception
             */
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }



    /**
     * Remove Course
     */
    public function destroy(Request $request)
    {
        $arr = $request->id;
        $csv = implode(", ", array_map(function ($arr) {
            return $arr;
        }, $arr));

        try {
            return response()->json([
                'data' => DB::delete("DELETE FROM courses WHERE id IN ($csv)"),
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
