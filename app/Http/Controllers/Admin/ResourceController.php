<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Step;
use App\Models\CourseUnit;
use App\Models\CourseUnitFiles;
use App\Http\Requests\FileUploadRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Exception;
use App\Exceptions\AppExceptions;

class ResourceController extends Controller
{
    /**
     * GET['admin/share-resources']
     */
    public function index()
    {
        $steps = Step::all();
        $units = CourseUnit::all();
        $files = CourseUnitFiles::all();
        return view('admin.Resource.index', compact('steps', 'units', 'files'));
    }



    /**
     * POST['admin/share-resources']
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
                $allowedfileExtension = ['pdf', 'docx', 'xlsx', 'pptx', 'dotx'];
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
                        'is_approved' => 'y',
                        'approved_by' => Auth::id()
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

            $notification = [
                'message'   =>  "File successfully saved",
                'alert-type'    =>  'success'
            ];

            return redirect()->back()->with($notification);
        } catch (\Throwable $th) {
            /**
             * Return the exception
             */
            return redirect()->back()->with(AppExceptions::throwback($th));
        }
    }
}
