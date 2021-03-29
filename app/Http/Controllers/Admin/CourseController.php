<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Course;
use App\Models\Teacher;
use Illuminate\Support\Str;
use App\Models\CourseCategory;
use App\Models\CoursesTeacher;
use Illuminate\Support\Carbon;
use App\Exceptions\AppExceptions;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Resources\CourseResource;
use Illuminate\Http\Request;
use App\Support\AppCryption;

class CourseController extends Controller
{
    /**
     * Category Collections
     */
    public function getData(){
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
    public function create(){
        $categories = CourseCategory::all();
        $teachers = Teacher::all();
        return view('admin.course.create', compact('categories', 'teachers'));
    }


    /**
     * 
     */
    public function store(CreateCourseRequest $request){
        try{
            if($request->has('course_name')){
                $files = null;
                $image = null;

                if($request->hasFile('image')){
                    $file = $request->file('image');
                    $ext = $file->getClientOriginalExtension();
                    $image = $request->course_code . "_" . date('dmy') . "." .$ext;

                    //check if directory exist or not
                    if (!Storage::exists("public/courses")) {
                        Storage::makeDirectory("public/courses");
                    }
                    Storage::putFileAs('public/courses', $file, $image);
                }

                $data = [
                    'action_user' => Auth::id(),
                    'course_code' => Str::upper($request->course_code),
                    'course_name' => Str::title($request->course_name),
                    'course_category_id' => ($request->has('category'))? $request->category : null,
                    'course_units' => ($request->has('units'))? $request->units : null,
                    'descriptions' => ($request->has('descriptions'))? $request->descriptions : null,
                    'course_thumbnail' => $image
                ];


                $course = Course::create($data);

                if($course->id){
                    if($request->filled('tutor_id')){
                        foreach($request->tutor_id as $tutor){
                            CoursesTeacher::create([
                                'action_user' => Auth::id(),
                                'teacher_id' => $tutor,
                                'course_id' => $course->id
                            ]);
                        }
                    }


                    if($request->hasFile('files')){
                        $files = $request->file('files');

                        foreach ($files as $file) {
                            $allowedfileExtension = ['pdf', 'docx', 'xlxs', 'ppt'];
                            $name = $file->getClientOriginalName();
                            $extension = $file->getClientOriginalExtension();
                            $check = in_array($extension, $allowedfileExtension);
        
                            if ($check) {
                                $filename = date('dmy') . "_" . $request->course_code . "_" . $name . "." .$extension;
        
                                $data = [
                                    'action_user' => Auth::id(),
                                    'course_id' => $course->id,
                                    'file_name' => $filename,
                                    'file_path' => storage_path('public/courses/files/'.$filename),
                                    'file_meta_data' => null,
                                    'created_at' => Carbon::now()->toDateTimeString(),
                                    'updated_at' => Carbon::now()->toDateTimeString()
                                ];
        
                                DB::table('course_files')->insert($data);
                                //check if directory exist or not
                                if (!Storage::exists("public/courses/files")) {
                                    Storage::makeDirectory("public/courses/files");
                                }
                                Storage::putFileAs('public/courses/files', $file, $filename);
                            }
                        }
                    }

                    $notification = [
                        'message'   =>  $request->course_name . " successfully saved",
                        'alert-type'    =>  'success'
                    ];

                    return redirect()->back()->with($notification);
                }
                else{
                    throw new Exception("internal: Something went wrong!");
                }
            }else{
                throw new Exception("internal: Something went wrong!");
            }
        }
        catch(\Throwable $th){
            /**
             * Return the exception
             */
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }


    
    /**
     * 
     */
    public function edit(Request $request){
        try {
            if ($request->expectsJson()) {
                $id = $request->id;
                $course = Course::find($id);
                $categories = CourseCategory::all();
                $teachers = Teacher::all();

                return view('admin.course.update', compact('categories', 'teachers', 'course'));
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
     * Update
     */
    public function update(Request $request, $id){
        try{
            $files = null;
            $image = null;
            $id = $id;

            if($request->hasFile('image')){
                $file = $request->file('image');
                $ext = $file->getClientOriginalExtension();
                $image = $request->course_code . "_" . date('dmy') . "." .$ext;

                //check if directory exist or not
                if (!Storage::exists("public/courses")) {
                    Storage::makeDirectory("public/courses");
                }
                Storage::putFileAs('public/courses', $file, $image);

                $course = Course::where('id', $id)->update([
                    'action_user' => Auth::id(),
                    'course_code' => Str::upper($request->course_code),
                    'course_name' => Str::title($request->course_name),
                    'course_category_id' => ($request->has('category'))? AppCryption::decrypt($request->category) : null,
                    'course_units' => ($request->has('units'))? $request->units : null,
                    'descriptions' => ($request->has('descriptions'))? $request->descriptions : null,
                    'course_thumbnail' => $image
                ]);
            }else{
                $course = Course::where('id', $id)->update([
                    'action_user' => Auth::id(),
                    'course_code' => Str::upper($request->course_code),
                    'course_name' => Str::title($request->course_name),
                    'course_category_id' => ($request->has('category'))? AppCryption::decrypt($request->category) : null,
                    'course_units' => ($request->has('units'))? $request->units : null,
                    'descriptions' => ($request->has('descriptions'))? $request->descriptions : null,
                ]);
            }


            if($course){
                if($request->filled('tutor_id')){
                    foreach($request->tutor_id as $tutor){
                        CoursesTeacher::updateOrCreate(
                            [
                                'teacher_id' => $tutor,
                                'course_id' => $id
                            ],
                            [
                                'action_user' => Auth::id(),
                                'teacher_id' => $tutor,
                                'course_id' => $id
                            ]
                        );
                    }
                }


                if($request->hasFile('files')){
                    $files = $request->file('files');

                    foreach ($files as $file) {
                        $allowedfileExtension = ['pdf', 'docx', 'xlxs', 'ppt'];
                        $name = $file->getClientOriginalName();
                        $extension = $file->getClientOriginalExtension();
                        $check = in_array($extension, $allowedfileExtension);
    
                        if ($check) {
                            $filename = date('dmy') . "_" . $request->course_code . "_" . $name . "." .$extension;
    
                            $data = [
                                'action_user' => Auth::id(),
                                'course_id' => $id,
                                'file_name' => $filename,
                                'file_path' => storage_path('public/courses/files/'.$filename),
                                'file_meta_data' => null,
                                'created_at' => Carbon::now()->toDateTimeString(),
                                'updated_at' => Carbon::now()->toDateTimeString()
                            ];
    
                            DB::table('course_files')->insert($data);
                            //check if directory exist or not
                            if (!Storage::exists("public/courses/files")) {
                                Storage::makeDirectory("public/courses/files");
                            }
                            Storage::putFileAs('public/courses/files', $file, $filename);
                        }
                    }
                }

                $notification = [
                    'message'   =>  $request->course_name . " successfully saved",
                    'alert-type'    =>  'success'
                ];

                return redirect()->back()->with($notification);
            }
            else{
                throw new Exception("internal: Something went wrong!");
            }
        }
        catch(\Throwable $th){
            /**
             * Return the exception
             */
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }



    /**
     * Remove Course
     */
    public function destroy(Request $request){
        $arr = $request->id;
        $csv = implode(", ", array_map(function($arr){
            return $arr;
        }, $arr));

        try {
            return response()->json([
                'data' => DB::delete("DELETE FROM courses WHERE id IN ($csv)")
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
