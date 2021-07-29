<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCreateRequest;
use App\Models\Classroom;
use App\Models\Post;
use App\Models\PostFile;
use App\Support\AppCryption;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{
    public function index($uuid, $type)
    {
        $classroom = Classroom::where('uuid', AppCryption::encrypt($uuid))->first();
        $posts = Post::with(['user', 'files'])->where('type', $type)->orderBy('created_at', 'desc')->paginate(10);
        return view('pages.classroom', compact('classroom', 'posts'));
    }


    public function store(PostCreateRequest $request, $uuid)
    {
        try {
            $classroom = Classroom::where('uuid', AppCryption::encrypt($uuid))->first();

            $post = $request->save($classroom);

            if ($request->hasFile('file')) {
                $request->saveFiles($post);
            }

            return back();
        } catch (\Throwable $th) {
            session()->flash('msg', 'Something went wrong');
        }
    }

    public function destroy($uuid)
    {
        $post = Post::where('uuid', AppCryption::encrypt($uuid))->first();

        $postFiles = PostFile::where('post_id', $post->id)->get();

        if ($postFiles->count() > 0) {
            foreach ($postFiles as  $files) {
                Storage::delete('public/courses/' . $files->file_name);
                $files->delete();
            }
        }

        $post->delete();

        return back();
    }
}
