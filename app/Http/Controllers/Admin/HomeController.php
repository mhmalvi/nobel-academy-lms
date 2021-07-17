<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('admin.index', compact('totalStd', 'totalTch', 'totalCrs', 'totalUnits'));
    }
}
