<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseRequest extends FormRequest
{
    public function saveImage($imageFile)
    {
        $random = Str::random(15);
        $image = "{$random}_{$imageFile->getClientOriginalName()}";

        //check if directory exist or not
        if (!Storage::exists("public/courses")) {
            Storage::makeDirectory("public/courses");
        }

        Storage::putFileAs('public/courses', $imageFile, $image);

        return $image;
    }


    public function removeImage($imageFile)
    {
        Storage::delete("public/courses/{$imageFile}");
    }
}
