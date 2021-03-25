<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\TempUserPhoto;
use App\Models\CourseUnitFiles;
use App\Exceptions\AppExceptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * 
     */
    public function index(){
        return view('teacher.file');
    }


    /**
     * 
     */
    public function store(Request $request){
        try{
            if($request->hasFile('files')){
                $files = $request->file('files');

                foreach ($files as $file) {
                    $allowedfileExtension = ['pdf', 'docx', 'xlxs', 'ppt'];
                    $name = $file->getClientOriginalName();
                    $extension = $file->getClientOriginalExtension();
                    $check = in_array($extension, $allowedfileExtension);
                    $unique = Str::random(8);

                    if ($check) {
                        $filename = "{$request->code}_{$name}_{$unique}.{$extension}";

                        $unit = CourseUnitFiles::create([
                            'action_user' => Auth::id(),
                            'unit_id' => $request->code,
                            'file_name' => $filename,
                            'file_path' => storage_path('public/courses/units/'.$filename),
                            'file_ext' => $extension,
                            'file_meta_data' => null
                        ]);

                        if($unit->id){
                            //check if directory exist or not
                            if (!Storage::exists("public/courses/units")) {
                                Storage::makeDirectory("public/courses/units");
                            }
                            Storage::putFileAs('public/courses/units', $file, $filename);
                        }
                    }else{
                        throw new Exception("Something went wrong!"); 
                    }
                }

                $notification = [
                    'message'   =>  "successfully saved",
                    'alert-type'    =>  'success'
                ];
        
                return redirect()->back()->with($notification);
            }
            else{
                throw new Exception("Something went wrong!");
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
     * File Download
     */
    public function fileDownload($file){
        return Storage::download("public/courses/units/{$file}");
    }



    /**
     * Temporary profile picture upload
     */
    public function TempProfilePic(Request $request){
        try {
            if($request->hasFile('file')){
                $id = uniqid();
                $date = now()->timestamp;
                $file = $request->file('file');
                /**
                 * Get the file name without extension
                 */
                $name = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $ext = $file->getClientOriginalExtension();
                $filename = "{$id}-{$name}-{$date}.{$ext}";

                /**
                 * Check if derectory exist or not
                 * Create a new directory if not exist
                 */
                if (!Storage::exists("public/users/temp")) {
                    Storage::makeDirectory("public/users/temp");
                }

                /**
                 * Store the file in temporary directory
                 */
                Storage::putFileAs('public/users/temp', $file, $filename);

                $response = TempUserPhoto::create([
                    'filename' => $filename,
                    'foldername' => 'temp',
                ]);

                return response()->json([
                    'data' => $response,
                    'status' => 200
                ]);
            }else{
                throw new Exception("Error Processing Request", 1);
                
            }
        } catch (\Throwable $th) {
            /**
             * Return the exception
             */
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }

}
