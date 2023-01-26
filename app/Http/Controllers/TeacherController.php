<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Teachers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function getList()
    {
        $teachers = DB::table('teachers')->get();
        return view('pages.teachers-management', ['teachers' => $teachers]);
    }
    public function addTeacher(Request $request){
        
        $post = new Teachers;
        $post->user_id = $request->input('user_id');
        $post->fullname = $request->input('fullname');
        $post->phone_number = $request->input('phone_number');
        $post->save();


        // Get current user
        $userId = $request->input('user_id');
        $user = User::findOrFail($userId);
        //change role
        // Fill user model
        $user->update([
            'role' => "2"
        ]);

        // Save user to database
        $user->save();

        return redirect('teachers-management');
    }
    public function showUser($id){
        //show child before 
        $msg = "There is no such user in the system.";
        $user = User::where('id', $id)->first();

        
        if($user->count()>0){
            $msg = "Found user with id: ".($user->id)." and email: ".($user->email);
        }
        return response()->json(array('user_msg'=> $msg), 200);
    }
}
