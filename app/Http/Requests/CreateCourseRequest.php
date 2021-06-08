<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
}
