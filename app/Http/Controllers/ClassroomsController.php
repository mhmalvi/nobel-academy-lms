<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Support\AppCryption;
use Illuminate\Http\Request;

class ClassroomsController extends Controller
{
    public function classroom($uuid)
    {
        $classroom = Classroom::where('uuid', AppCryption::encrypt($uuid))->first();
        return view('pages.classroom', compact('classroom'));
    }
}
