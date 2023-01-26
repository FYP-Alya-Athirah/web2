<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function getList()
    {
        // students list
        $students = DB::table('students')
        ->get();
        $studentsAttend = DB::table('students')
        ->where('attend','1')
        ->get();
        $studentsAbsent = DB::table('students')
        ->where('attend','0')
        ->get();
        $studentsattendNum = count($studentsAttend);
        $studentsabsentNum = count($studentsAbsent);

        // teachers list
        $teachers = DB::table('teachers')
        ->get();
        $teachersAttend = DB::table('teachers')
        ->where('attend','1')
        ->get();
        $teachersAbsent = DB::table('teachers')
        ->where('attend','0')
        ->get();
        $teachersattendNum = count($teachersAttend);
        $teachersabsentNum = count($teachersAbsent);

        return view('pages.attendance-list', [
            'students' => $students,'studentsattendNum' => $studentsattendNum,'studentsabsentNum' => $studentsabsentNum,
            'teachers' => $teachers,'teachersattendNum' => $teachersattendNum,'teachersabsentNum' => $teachersabsentNum,
        ]);
    }
}
