<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assesment;
use Illuminate\Http\Request;

class AssesmentsController extends Controller
{
    /**
     * 
     */
    public function index()
    {
        $assesments = Assesment::where('status', 'pending')->get();
        return view('admin.assesment.index', compact('assesments'));
    }
}
