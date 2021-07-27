<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CreateCourseRequest extends FormRequest
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
            'units' => 'required|integer',
            'course_code' => 'required|string|max:50|unique:courses',
            'course_name' => 'required|string|unique:courses',
            'files[]' => 'mimes:pdf,docx,xlxs,ppt|max:2048',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ];
    }


    public function save()
    {
        $course = Course::create([
            'uuid' => Str::random(8),
            'course_code' => Str::upper($this->course_code),
            'course_name' => Str::title($this->course_name),
            'course_category_id' => ($this->has('category')) ? $this->category : null,
            'course_units' => ($this->has('units')) ? $this->units : null,
            'descriptions' => ($this->has('descriptions')) ? $this->descriptions : null,
            'course_thumbnail' => $this->hasFile('image') ?
                $this->saveImage($this->file('image')) : null
        ]);

        return $course;
    }


    public function saveImage($imageFile)
    {
        $image = $imageFile->getClientOriginalName();

        //check if directory exist or not
        if (!Storage::exists("public/courses")) {
            Storage::makeDirectory("public/courses");
        }

        Storage::putFileAs('public/courses', $imageFile, $image);

        return $image;
    }
}
