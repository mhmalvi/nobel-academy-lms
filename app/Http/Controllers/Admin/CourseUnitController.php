<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Course;
use App\Models\CourseUnit;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CourseUnitFiles;
use App\Exceptions\AppExceptions;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UnitResource;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CourseUnitRequest;
use App\Http\Requests\FileUploadRequest;
use App\Http\Resources\CourseUnitCollection;
use App\Models\Step;
use Illuminate\Support\Facades\DB;

class CourseUnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        return view('admin.CourseUnit.index');
    }



    /**
     * 
     */
    public function getData(){
        return new CourseUnitCollection(CourseUnit::with('course')->orderBy('created_at', 'desc')->get());
    }
    


    /**
     * Show the form for creating a new unit.
     *
     */
    public function create(){
        $courses = Course::all();
        return view('admin.CourseUnit.create', compact('courses'));
    }



    /**
     * return the course units
     * check if request is for core/elective units
     * create a collection of results in
     * return JSON end point
     */
    public function getUnits(Request $request){
        if($request->name == 'core'){

            return new UnitResource(CourseUnit::where('unit_type', 'core')->get());

        }elseif($request->name == 'elective'){

            return new UnitResource(CourseUnit::where('unit_type', 'elective')->get());

        }
    }




    /**
     * Store newly created course unit in database
     * Check if request is valid
     */
    public function store(CourseUnitRequest $request){
        try{
            $unit = CourseUnit::create([
                'action_user' => Auth::id(),
                'course_id' => $request->course,
                'unit_type' => $request->unit_type,
                'unit_code' => ($request->unit_code) ? Str::upper($request->unit_code) : null,
                'unit_name' => Str::title($request->unit_name),
                'descriptions' => $request->descriptions
            ]);

            if($request->hasFile('files')){
                $files = $request->file('files');

                //start loop
                foreach ($files as $file) {
                    /**
                     * Get the file name without extension
                     */
                    $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $allowedfileExtension = ['pdf', 'docx', 'xlsx', 'ppt'];
                    $check = in_array($extension, $allowedfileExtension);
                    $unique = Str::random(8);

                    if ($check) {
                        $filename = "{$name}_{$unique}.{$extension}";

                        $unit_file = CourseUnitFiles::create([
                            'action_user' => Auth::id(),
                            'unit_id' => $unit->id,
                            'file_name' => $filename,
                            'file_path' => storage_path('public/courses/units/'.$filename),
                            'file_ext' => $extension,
                            'file_meta_data' => null,
                            'is_approved' => 'y',
                            'approved_by' => Auth::id()
                        ]);

                        if($unit_file->id){
                            /**
                             * Check if derectory exist or not
                             * Create a new directory if not exist
                             */

                            if (!Storage::exists("public/courses/units")) {
                                Storage::makeDirectory("public/courses/units");
                            }

                            //store image into storage directory
                            Storage::putFileAs('public/courses/units', $file, $filename);
                        }
                    }else{
                        /**
                         * Throw an exception if request cannot be processed
                         */
                        throw new Exception("Invalid file formate", 1);
                    }
                }
                //loop end
            }

            if($unit->id){
                /**
                 * retun successfull notification
                 */
                $notification = [
                    'message'   =>  "{$unit->unit_name} successfully saved",
                    'alert-type'    =>  'success'
                ];
        
                return redirect()->back()->with($notification);
            }
        }
        catch(\Throwable $th){
            /**
             * Return the exceptions
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
                $unit = CourseUnit::find($id);
                $courses = Course::all();

                return view('admin.CourseUnit.update', compact('courses', 'unit'));
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
     * 
     */
    public function update(Request $request, $id){
        try{
            $unit = CourseUnit::where('id', $id)->update([
                'action_user' => Auth::id(),
                'course_id' => $request->course,
                'unit_type' => $request->unit_type,
                'unit_code' => ($request->unit_code) ? Str::upper($request->unit_code) : null,
                'unit_name' => Str::title($request->unit_name),
                'descriptions' => $request->descriptions
            ]);

            /**
             * retun successfull notification
             */
            $notification = [
                'message'   =>  "{$unit->unit_name} successfully saved",
                'alert-type'    =>  'success'
            ];
    
            return redirect()->back()->with($notification);
        }
        catch(\Throwable $th){
            /**
             * Return the exceptions
             */
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }



    /**
     * Files
     */
    public function files(){
        $units = CourseUnit::all();
        $steps = Step::all();
        $files = CourseUnitFiles::orderBy('created_at', 'asc')->get();
        return view('admin.CourseUnit.files', compact('files', 'units', 'steps'));
    }



    /**
    * Store Files
    */
    public function storeFile(FileUploadRequest $request){
        try {
            /**
             * Checking if incoming request has files
             * else throw an exception
             */
            if($request->hasFile('files')){
                $files = $request->file('files');

                //start loop
                foreach ($files as $file) {
                    /**
                     * Get the file name without extension
                     */
                    $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                    $extension = $file->getClientOriginalExtension();
                    $allowedfileExtension = ['pdf', 'docx', 'xlsx', 'ppt'];
                    $check = in_array($extension, $allowedfileExtension);
                    $unique = Str::random(8);

                    if ($check) {
                        $filename = "{$name}_{$unique}.{$extension}";

                        $unit_file = CourseUnitFiles::create([
                            'action_user' => Auth::id(),
                            'unit_id' => $request->unit,
                            'step_id' => $request->step,
                            'file_name' => $filename,
                            'file_path' => storage_path('public/courses/units/'.$filename),
                            'file_ext' => $extension,
                            'file_meta_data' => null,
                            'is_approved' => 'y',
                            'approved_by' => Auth::id()
                        ]);

                        if($unit_file->id){
                            /**
                             * Check if derectory exist or not
                             * Create a new directory if not exist
                             */

                            if (!Storage::exists("public/courses/units")) {
                                Storage::makeDirectory("public/courses/units");
                            }

                            //store image into storage directory
                            Storage::putFileAs('public/courses/units', $file, $filename);
                        }
                        else{
                            /**
                             * Throw an exception if request cannot be processed
                             */
                            throw new Exception("File cannot be saved to server", 1);
                        }
                    }else{
                        /**
                         * Throw an exception if request cannot be processed
                         */
                        throw new Exception("Invalid file formate", 1);
                    }
                }
                //loop end

                /**
                 * retun successfull notification
                 */
                $notification = [
                    'message'   =>  "Successfully saved",
                    'alert-type'    =>  'success'
                ];

                return redirect()->back()->with($notification);

            }else{
                /**
                 * Throw an exception if request cannot be processed
                 */
                throw new Exception("Error Processing Request", 1);
            }
        } catch (\Throwable $th) {
            /**
             * Return the exceptions
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
            return response()->json(
                [
                    'data' => DB::delete("DELETE FROM course_units WHERE id IN ($csv)"),
                    'status' => 200
                ]
            );
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

