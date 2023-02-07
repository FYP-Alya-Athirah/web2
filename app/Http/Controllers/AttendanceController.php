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
        ->orWhere('attend','2')
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
        ->orWhere('attend','2')
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
    public function getStudentList(Request $request){

        ## Read value
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page
   
        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');
   
        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value
   
        // students list
        // $records = DB::table('students')
        // ->get();
        // Total records
        $totalRecords = Students::select('count(*) as allcount')->count();
        $totalRecordswithFilter = Students::select('count(*) as allcount')->where('name', 'like', '%' .$searchValue . '%')->count();
   
        // Fetch records
        $records = Students::orderBy($columnName,$columnSortOrder)
          ->where('students.fullname', 'like', '%' .$searchValue . '%')
          ->select('students.*')
          ->skip($start)
          ->take($rowperpage)
          ->get();
   
        $data_arr = array();
        
        foreach($records as $record){
           $id = $record->id;
           $fullname = $record->fullname;
           $class = $record->class;
           $pickup_session = $record->pickup_session;
   
           $data_arr[] = array(
             "id" => $id,
             "fullname" => $fullname,
             "class" => $class,
             "pickup_session" => $pickup_session,
           );
        }
   
        $response = array(
           "draw" => intval($draw),
           "iTotalRecords" => $totalRecords,
           "iTotalDisplayRecords" => $totalRecordswithFilter,
           "aaData" => $data_arr
        );
   
        echo json_encode($response);
        exit;
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
