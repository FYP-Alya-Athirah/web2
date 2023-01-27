<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Students;
use Datatables;

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
    public function getStudentList()
    {
        // students list
        $students = DB::table('students')
        ->get();

        // return view('pages.attendance-list', [
        //     'students' => $students
        // ]);
        // $students = Students::select('fullname', 'class', 'pickup_session', 'attend')->get();
        // return DataTables::of($students)->make();

        return response()->json(array('students' => $students), 200);
    }
    public function getStudentStatus($id)
    {
        // students list
        $students = DB::table('students')
        ->where('id',$id)
        ->get();

        return response()->json(array('students' => $students), 200);
    }
    public function getStudentAttendanceNumber()
    {
        $studentsAttend = DB::table('students')
        ->where('attend','1')
        ->get();
        $studentsAbsent = DB::table('students')
        ->where('attend','0')
        ->get();
        $studentsattendNum = count($studentsAttend);
        $studentsabsentNum = count($studentsAbsent);

        return response()->json(array('studentsattendNum' => $studentsattendNum,'studentsabsentNum' => $studentsabsentNum), 200);
    }
    public function getTeacherAttendanceNumber()
    {
        $teachersAttend = DB::table('teachers')
        ->where('attend','1')
        ->get();
        $teachersAbsent = DB::table('teachers')
        ->where('attend','0')
        ->get();
        $teachersattendNum = count($teachersAttend);
        $teachersabsentNum = count($teachersAbsent);

        return response()->json(array('teachersattendNum' => $teachersattendNum,'teachersabsentNum' => $teachersabsentNum), 200);
    }
}
