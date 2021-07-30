<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Classroom;

class HomeController extends Controller
{
    /**
     * 
     */
    public function index()
    {
        $totalStd = 0;
        $totalTch = 0;
        $totalCrs = DB::table('courses')->count();
        $totalUnits = DB::table('course_units')->count();
        $classes = Classroom::with('course')->orderBy('created_at', 'asc')->paginate(12);
        return view('admin.index', compact('totalStd', 'totalTch', 'totalCrs', 'totalUnits', 'classes'));
    }
}
