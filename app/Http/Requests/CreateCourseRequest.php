<?php

namespace App\Http\Requests;

use App\Models\Course;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\CoursesTeacher;

class CreateCourseRequest extends FormRequest
{
    private $random;

    function __construct()
    {
        $this->random = Str::random(8);
    }



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
            'units'         => 'required|integer',
            'course_code'          => 'required|string|max:50|unique:courses',
            'course_name'          => 'required|string',
            'files[]'       => 'mimes:pdf,docx,xlxs,ppt|max:2048',
            'image'         => 'image|mimes:jpg,jpeg,png|max:2048',
        ];
    }



    /**
     * Save the course
     * 
     * @return object
     */
    public function saveCourse(): object
    {
        $imagename = null;

        if ($this->has('image')) {
            $imagename = $this->saveThumbnail($this->file('image'));
        }

        $course = Course::create([
            'action_user'           => Auth::id(),
            'course_code'                  => $this->course_code,
            'course_name'                  => $this->course_name,
            'course_category_id'    => ($this->has('category')) ? $this->category : null,
            'course_units'                 => ($this->has('units')) ? $this->units : null,
            'descriptions'          => ($this->has('descriptions')) ? $this->descriptions : null,
            'thumbnail'             => $imagename
        ]);

        if ($this->filled('tutor_id')) {
            $this->saveCourseTeacher($this->tutor_id, $course->id);
        }

        if ($this->hasFile('files')) {
            $this->saveFiles($this->file('files'), $course->id);
        }


        return $course;
    }



    /**
     * Update the course
     * @return boolean
     */
    public function updateCourse(int $id): bool
    {
        $course = Course::findOrFail($id);

        $course->action_user        = Auth::id();
        $course->course_code               = $this->course_code;
        $course->course_name               = $this->course_name;
        $course->course_category_id = $this->category;
        $course->course_units              = $this->units;
        $course->descriptions       = $this->descriptions;

        if ($this->has('image')) {
            $course->thumbnail = $this->saveThumbnail($this->file('image'));
        }

        if ($this->filled('tutor_id')) {
            $this->saveCourseTeacher($this->tutor_id, $course->id);
        }

        if ($this->hasFile('files')) {
            $this->saveFiles($this->file('files'), $course->id);
        }


        return $course->save();
    }



    /**
     * Save Course Teacher
     * @void
     */
    protected function saveCourseTeacher($tutors, int $id): void
    {
        foreach ($tutors as $tutor) {
            CoursesTeacher::updateOrCreate(
                [
                    'teacher_id' => $tutor,
                    'course_id' => $id
                ],
                [
                    'action_user' => Auth::id(),
                    'teacher_id' => $tutor,
                    'course_id' => $id
                ]
            );
        }
    }



    /**
     * Save course thumbnail/image
     * @return string $imagename
     */
    protected function saveThumbnail($image): string
    {
        //Get the file name without extension
        $imagename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
        $ext = $image->getClientOriginalExtension();

        $newName = "{$imagename}_{$this->random}.{$ext}";

        //check if directory exist or not
        if (!Storage::exists("public/courses")) {
            Storage::makeDirectory("public/courses");
        }
        Storage::putFileAs('public/courses', $image, $newName);

        return $newName;
    }



    /**
     * If each course files
     * save the course files
     * pdf, docx, xlxs, ppt, jpg, jpeg
     * @void
     */
    protected function saveFiles($files, int $id): void
    {

        (array) $errors = [];

        foreach ($files as $file) {
            $allowedfileExtension = ['pdf', 'docx', 'ppt', 'jpg', 'jpeg'];

            $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

            $extension = $file->getClientOriginalExtension();

            $check = in_array($extension, $allowedfileExtension);

            if ($check) {
                $newName = "{$filename}_{$this->random}.{$extension}";

                DB::table('course_files')->insert([
                    'action_user' => Auth::id(),
                    'course_id' => $id,
                    'file_name' => $newName,
                    'file_path' => storage_path('public/courses/files/' . $newName),
                    'file_meta_data' => null,
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]);

                //check if directory exist or not
                if (!Storage::exists("public/courses/files")) {
                    Storage::makeDirectory("public/courses/files");
                }
                Storage::putFileAs('public/courses/files', $file, $newName);
            } else {
                $msg = "Failed to upload {$filename}. Invalid file extension";
                array_push($errors, $msg);
                $this->session()->flash("fileErrors", $errors);
            }
        }
    }
}
