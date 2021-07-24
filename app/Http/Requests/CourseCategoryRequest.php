<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use App\Support\AppCryption;
use App\Models\CourseCategory;

class CourseCategoryRequest extends FormRequest
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
            'code' => 'max:50',
            'category_name' => 'required|string|unique:course_categories',
            'descriptions' => 'max:255'
        ];
    }


    public function createOrUpdate()
    {
        $id = [
            'uuid' => ($this->id) ? AppCryption::encrypt($this->id) : null,
        ];

        $category = CourseCategory::updateOrCreate($id, [
            'uuid' => Str::random(8),
            'category_code' => ($this->code) ? Str::ucfirst($this->code) : null,
            'category_name' => $this->category_name,
            'descriptions' => $this->descriptions
        ]);

        return $category;
    }
}
