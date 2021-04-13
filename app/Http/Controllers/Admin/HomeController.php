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
    public function index(){
        $totalStd = DB::table('students')->count();
        $totalTch = DB::table('teachers')->count();
        $totalCrs = DB::table('courses')->count();
        $totalUnits = DB::table('course_units')->count();
        return view('admin.index', compact('totalStd', 'totalTch', 'totalCrs', 'totalUnits'));
    }
}
