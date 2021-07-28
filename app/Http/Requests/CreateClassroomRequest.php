<?php

namespace App\Http\Requests;

use App\Models\Classroom;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class CreateClassroomRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'section' => 'required|string|max:255',
            'course' => 'required',
            'teacher' => 'required'
        ];
    }


    public function save()
    {
        $class = Classroom::create([
            'uuid' => Str::random(8),
            'name' => $this->name,
            'section' => $this->section,
            'course_id' => $this->course,
            'teacher_id' => $this->teacher
        ]);

        return $class;
    }
}
