<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function getList()
    {
        $students = DB::table('students')
        ->where('attend','1')
        ->get();
        return view('pages.attendance-list', ['students' => $students]);
    }
}
