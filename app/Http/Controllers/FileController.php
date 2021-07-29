<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Step;
use App\Models\CourseUnit;
use Illuminate\Support\Str;
use App\Models\CourseUnitFiles;
use App\Exceptions\AppExceptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FileUploadRequest;
use Illuminate\Support\Facades\Session;

class FileController extends Controller
{
    /**
     * GET['share/resources']
     */
    public function index()
    {
        $steps = Step::all();
        $units = CourseUnit::all();
        $files = CourseUnitFiles::where('action_user', Auth::id())->paginate(10);
        return view('teacher.file', compact('steps', 'units', 'files'));
    }


    /**
     * POST['share/resources']
     */
    public function store(FileUploadRequest $request)
    {
        try {
            $files = $request->files;

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
                        'file_path' => storage_path('public/courses/units/' . $filename),
                        'file_ext' => $extension,
                        'file_meta_data' => null,
                        'is_approved' => 'n'
                    ]);

                    if ($unit_file->id) {
                        /**
                         * Check if derectory exist or not
                         * Create a new directory if not exist
                         */

                        if (!Storage::exists("public/courses/units")) {
                            Storage::makeDirectory("public/courses/units");
                        }

                        //store image into storage directory
                        Storage::putFileAs('public/courses/units', $file, $filename);
                    } else {
                        /**
                         * Throw an exception if request cannot be processed
                         */
                        throw new Exception("File cannot be saved to server", 1);
                    }
                } else {
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
            Session::flash('message', "Files successfully send for confirmation");
            Session::flash('alert-class', 'alert-soft-success');

            return back();
        } catch (\Throwable $th) {
            /**
             * retun successfull notification
             */
            // Session::flash('message', $th->getMessage());
            Session::flash('message', "Something went wrong!");
            Session::flash('alert-class', 'alert-soft-warning');

            return back();
        }
    }


    /**
     * File Download
     */
    public function fileDownload($directory, $file)
    {
        return response()->download(public_path("storage/{$directory}/{$file}"));
    }
}
