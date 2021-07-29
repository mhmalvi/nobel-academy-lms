<?php

namespace App\Http\Requests;

use App\Models\Post;
use App\Models\PostFile;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostCreateRequest extends FormRequest
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
            'type' => 'required',
            'post' => 'required',
            'file' => 'exclude_unless:type,material|required'
        ];
    }


    public function save($classroom)
    {
        $post = Post::create([
            'uuid' => Str::random(8),
            'user_id' => Auth::id(),
            'classroom_id' => $classroom->id,
            'type' => $this->type,
            'post' => $this->post
        ]);

        return $post;
    }


    public function saveFiles($post)
    {
        $files = $this->file('file');
        foreach ($files as $file) {
            PostFile::create([
                'uuid' => Str::random(8),
                'post_id' => $post->id,
                'file_name' => $this->uploadFiles($file),
            ]);
        }
    }


    public function uploadFiles($file)
    {
        //check if directory exist or not
        if (!Storage::exists("public/posts")) {
            Storage::makeDirectory("public/posts");
        }

        $fileName = $file->getClientOriginalName();

        Storage::putFileAs('public/posts', $file, $fileName);

        return $fileName;
    }
}
