<?php

namespace App\Http\Requests;

use App\Models\Course;
use Illuminate\Support\Str;

class CourseUpdateRequest extends CourseRequest
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
            //
        ];
    }


    public function update($id)
    {
        $course = Course::findOrFail($id);

        $course->course_code = Str::upper($this->course_code);
        $course->course_name = Str::title($this->course_name);
        $course->course_category_id = $this->category;
        $course->course_units = $this->units;
        $course->descriptions = $this->descriptions;

        if ($this->hasFile('image')) {
            $this->removeImage($course->course_thumbnail);
            $course->course_thumbnail = $this->saveImage($this->file('image'));
        }

        $course->save();
    }
}
