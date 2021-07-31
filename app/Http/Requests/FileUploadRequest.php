<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\CourseUnitFiles;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FileUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'unit' => 'required',
            'step' => 'required',
            'files' => 'required'
        ];
    }


    public function save()
    {
        foreach ($this->file('files') as $file) {
            CourseUnitFiles::create([
                'unit_id' => $this->unit,
                'step_id' => $this->step,
                'file_name' => $this->saveFile($file),
                'file_path' => null,
                'file_ext' => null,
                'file_meta_data' => null,
                'is_approved' => 'y',
                'approved_by' => Auth::id()
            ]);
        }
    }


    public function saveFile($file)
    {
        $name = $file->getClientOriginalName();


        if (!Storage::exists("public/units")) {
            Storage::makeDirectory("public/units");
        }

        Storage::putFileAs('public/units', $file, $name);
        return $name;
    }
}
