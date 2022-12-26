<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Students;
use App\Models\Parents;
use App\Models\User;
use Illuminate\Support\Arr;

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

    //CHILDREN MANAGEMENT
    public function registerParent(Request $request){
        $userId =  Auth::user()->id;
        $post = new Parents;
        $post->user_id = $userId;
        $post->carplate = $request->input('carplate');
        $post->phone_number = $request->input('phone_number');
        $post->save();

        // Get current user
        $user = User::findOrFail($userId);
        //change role
        // Fill user model
        $user->update([
            'role' => "1"
        ]);

        // Save user to database
        $user->save();

        return redirect('children-management');
    }
    public function ifParent(){

    }
    public function showChildren(){
        if(Auth::user()->role == 0){
            return view('pages.children-management', 
                [
                'user' => Auth::user(),
                ],
            );
        }
        else{
            // $students = DB::table('students')
            // ->get();

            // //get user id
            // $userId = Auth::user()->id;
            // //get parent id 
            // $parents = DB::table('parents')
            // ->where('user_id', '=', $userId)
            // ->get();
            // $parentID = $parents->id;

            // //get students IDs based on parent_id in table parent_student
            // $studentIDs = DB::table('parent_student')
            // ->select('student_id')
            // ->where('parent_id', '=', $parentID)
            // ->get();

            $studentIDs = [10];
            //get real student table
            $students = DB::table('students')
            ->whereIn('id', $studentIDs)
            ->get();
            

            return view('pages.children-management', 
                ['students' => $students,
                'user' => Auth::user()],
            );
        }
        // $students = DB::table('students')->get();

        // return view('pages.children-management', ['students' => $students, 'user' => Auth::user()]);

    }
    public function deleteChild($id){
        // Students::destroy($id);
        return redirect('children-management');
    }
    // if user is not a parent -> show card to ask to be parent
    // else show children list
}

