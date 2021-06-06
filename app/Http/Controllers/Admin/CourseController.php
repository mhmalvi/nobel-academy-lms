<?php

namespace App\Http\Controllers\Admin;

use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\CourseCategory;
use App\Exceptions\AppExceptions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\CourseResource;
use App\Http\Requests\CreateCourseRequest as CourseRequest;

class CourseController extends Controller
{
    /**
     * Category Collections
     * 
     */
    public function getData()
    {
        return new CourseResource(
            Course::orderBy('created_at', 'desc')->get()
        );
    }



    /**
     * Display a listing of the resource
     * 
     * @return view
     */
    public function index()
    {
        return view('admin.Course.index');
    }



    /**
     * Get['admin/course/create']
     * 
     * @return view
     */
    public function create()
    {
        $categories = CourseCategory::all();
        $teachers = Teacher::all();
        return view('admin.Course.create', compact('categories', 'teachers'));
    }


    /**
     * Post['admin/course/create']
     * 
     * @Save new data
     */
    public function store(CourseRequest $request)
    {
        try {
            $course = $request->saveCourse();

            if ($course) {
                $notification = [
                    'message'   => "{$request->course_name} successfully saved",
                    'alert-type'    =>  'success'
                ];

                return redirect()->back()->with($notification);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }


    /**
     * Get['admin/course/{id}']
     * 
     * @return view
     */
    public function edit(Request $request)
    {
        try {
            if ($request->expectsJson()) {
                $id = $request->id;
                $course = Course::find($id);
                $categories = CourseCategory::all();
                $teachers = Teacher::all();

                return view('admin.Course.update', compact('categories', 'teachers', 'course'));
            }
        } catch (\Throwable $th) {
            return response()->json([
                'data' => AppExceptions::throwback($th),
                'status' => 404
            ]);
        }
    }



    /**
     * Put['admin/course/{id}']
     * 
     * @Update data
     */
    public function update(CourseRequest $request, $id)
    {
        try {
            $course = $request->updateCourse($id);

            if ($course) {
                $notification = [
                    'message'   =>  "{$request->course_name} successfully saved",
                    'alert-type'    =>  'success'
                ];

                return redirect()->back()->with($notification);
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }



    /**
     * Delete['admin/course/{id}]
     * 
     * @return json response
     */
    public function destroy(Request $request)
    {
        $arr = $request->id;

        $csv = implode(", ", array_map(function ($arr) {
            return $arr;
        }, $arr));

        try {
            return response()
                ->json([
                    'data' => DB::delete("DELETE FROM courses WHERE id IN ($csv)"),
                    'status' => 200
                ]);
        } catch (\Throwable $th) {
            return response()
                ->json([
                    'message' => AppExceptions::throwback($th),
                    'status' => 404
                ]);
        }
    }
}
