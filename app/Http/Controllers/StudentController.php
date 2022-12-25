<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Students;


class StudentController extends Controller
{
    public function getList()
    {
        $students = DB::table('students')->get();
        return view('pages.students-management', ['students' => $students]);
    }
    
    public function addStudent(Request $request)
    {
        $post = new Students;
        $post->fullname = $request->input('fullname');
        $post->ic_number = $request->input('ic_number');
        $post->birthday = $request->input('birthday');
        $post->gender = $request->input('gender');
        $post->class = $request->input('class');
        $post->pickup_session = $request->input('pickup_session');
        $post->save();
        return redirect('students-management');
    }
    public function updateStudent (Request $request)
    {
        $post = Students::find($request->id);
        $post->fullname = $request->input('fullname');
        $post->ic_number = $request->input('ic_number');
        $post->birthday = $request->input('birthday');
        $post->gender = $request->input('gender');
        $post->class = $request->input('class');
        $post->pickup_session = $request->input('pickup_session');
        $post->save();

        return redirect('students-management'); 
    }
    public function deleteStudent($id){
        Students::destroy($id);
        return redirect('students-management');
    }
    public function showChildren(){
        $students = DB::table('students')
        ->get();

        //get user id
        $userId = Auth::id();
        //get parent id 
        $parentID = DB::table('parents')
        ->where('user_id', $userId)
        ->get('id');

        //get students IDs based on parent_id in table parent_student
        $studentIDs = DB::table('parent_student')
        ->whereIn('parent_id', $parentID)
        ->get('student_id');

        //get real student table
        $student = DB::table('students')
        ->whereIn('student_id', $studentIDs)
        ->get();
        

        return view('pages.children-management', 
            ['students' => $student,
            'user' => Auth::user()],
        );
        // return view('pages.children-management');
    }
    // if user is not a parent -> show card to ask to be parent
    // else show children list
}

