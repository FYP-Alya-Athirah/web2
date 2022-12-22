<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use Illuminate\Validation\Rule;
use Adrianorosa\GeoLocation\GeoLocation;


class StudentController extends Controller
{
    public function getList()
    {
        $students = DB::table('students')->get();
        return view('pages.students-management', ['students' => $students]);
    }
    
    public function addStudent(Request $request)
    {
        $post = new Student;
        $post->fullname = $request->input('fullname');
        $post->ic_number = $request->input('ic_number');
        $post->birthday = $request->input('birthday');
        $post->gender = $request->input('gender');
        $post->class = $request->input('class');
        $post->pickup_session = $request->input('pickup_session');
        $post->save();
        return redirect('students-management');
    }
    public function getStudent(Request $request, $id)
    {
        // $participants =  DB::table('participant')
        //                     ->select('firstname', 'lastname', 'phone','age_category', 'employee_status')
        //                     ->leftjoin('activity_participant', 'activity_participant.participant_id', '=', 'participant.id')
        //                     ->where('activity_participant.activity_id', $id)
        //                     ->get();

        // $activity = DB::table('activity')
        //                     ->select('name')
        //                     ->where('id', $id)
        //                     ->get();
        $student = DB::table('students')
                            ->select('fullname')
                            ->where('id', $id)
                            ->get();                 

        // return view('pages.admin-activity-participant', ['participants' => $participants, 'activity' => $activity[0]->name]);
        return view('pages.students-management', ['student' => $student[0]->name]);
    }
    public function updateStudent (Request $request, $id)
    {
        // $name = $request->input('name');
        // $event = $request->input('event');
        // $description = $request->input('description');
        // $start_time = $request->input('start-time');
        // $end_time = $request->input('end-time');
        // $max_slot = $request->input('slot');
        // $type = $request->input('type');
        // $age_category = $request->input('age-category');
        
        // $updateData = array('name' => $name, 'event_id' => $event, 'start_time' => $start_time, 'end_time' => $end_time, 'max_slot' => $max_slot, 'type' => $type,'age_category' => $age_category);

        // DB::table('activity')
        //     -> where('id', $id)
        //     -> update($updateData);
        
        // return redirect('admin-activity-list');

        $post = Student::find($request->id);
        $post->fullname = $request->input('fullname');
        $post->ic_number = $request->input('ic_number');
        $post->birthday = $request->input('birthday');
        $post->gender = $request->input('gender');
        $post->class = $request->input('class');
        $post->pickup_session = $request->input('pickup_session');
        $post->save();

        return redirect('students-management');
        
    }
}

