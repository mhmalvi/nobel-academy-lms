<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Classroom;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * 
     */
    public function index()
    {
        $totalStd = User::where('user_type', 'student')->count();
        $totalTch = User::where('user_type', 'teacher')->count();
        $totalCrs = DB::table('courses')->count();
        $totalUnits = DB::table('course_units')->count();
        $classes = Classroom::with('course')->orderBy('created_at', 'asc')->paginate(12);
        return view('admin.index', compact('totalStd', 'totalTch', 'totalCrs', 'totalUnits', 'classes'));
    }
}
