<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\CourseUnit;
use Illuminate\Support\Str;
use App\Models\CourseUnitFiles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CourseUnitRequest extends FormRequest
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
            'unit_code' => 'required|string|max:50|unique:course_units',
            'unit_name' => 'required|string|max:100',
            'unit_type' => 'required',
        ];
    }


    /**
     * 
     */
    public function save()
    {
        $unit = CourseUnit::create([
            'uuid' => Str::random(8),
            'course_id' => $this->course,
            'unit_type' => $this->unit_type,
            'unit_code' => ($this->unit_code) ? Str::upper($this->unit_code) : null,
            'unit_name' => Str::title($this->unit_name),
            'descriptions' => $this->descriptions
        ]);

        return $unit;
    }


    /**
     * 
     */
    public function saveFiles()
    {
        $files = $this->file('files');

        foreach ($files as $file) {
            $name = $file->getClientOriginalName();

            $unit_file = CourseUnitFiles::create([
                'unit_id' => $this->save()->id,
                'file_name' => $name,
                'file_path' => storage_path('public/courses/units/' . $name),
                'file_meta_data' => null,
                'is_approved' => 'y',
                'approved_by' => Auth::id()
            ]);

            if ($unit_file->id) {
                if (!Storage::exists("public/courses/units")) {
                    Storage::makeDirectory("public/courses/units");
                }

                //store image into storage directory
                Storage::putFileAs('public/courses/units', $file, $name);
            }
        }
    }
}
