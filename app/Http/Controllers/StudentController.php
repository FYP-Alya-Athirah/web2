<?php

namespace App\Http\Controllers;

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
}

