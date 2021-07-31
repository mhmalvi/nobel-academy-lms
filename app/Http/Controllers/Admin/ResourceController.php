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
        return view('admin.resource.index', compact('steps', 'units', 'files'));
    }



    /**
     * POST['admin/share-resources']
     */

    public function store(FileUploadRequest $request)
    {
        try {
            $request->save();

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
