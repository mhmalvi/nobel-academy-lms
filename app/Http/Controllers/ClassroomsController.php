<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Post;
use App\Support\AppCryption;
use Illuminate\Http\Request;

class ClassroomsController extends Controller
{
    public function classroom($uuid)
    {
        $classroom = Classroom::where('uuid', AppCryption::encrypt($uuid))->first();
        $posts = Post::with(['user', 'files'])->where('classroom_id', $classroom->id)->orderBy('created_at', 'desc')->paginate(10);
        return view('pages.classroom', compact('classroom', 'posts'));
    }
}
