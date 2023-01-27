<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Students;
use App\Models\Parents;
use App\Models\ParentStudent;
use App\Models\User;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use Symfony\Component\VarDumper\VarDumper;

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
        $post->fullname = Auth::user()->username;
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
    public function addChild(Request $request)
    {
        //get user id
        $userId = Auth::user()->id;

        //get parent id 
        $parents = DB::table('parents')
        ->where('user_id', '=', $userId)
        ->first();
        $parentID = $parents->id;

        //find student based on IC number
        $student = DB::table('students')
            ->where('ic_number', '=', $request->input('ic_number'))
            ->first();


        $post = new ParentStudent;
        $post->parent_id = $parentID;
        $post->student_id = $student->id;
        $post->save();
        return redirect('children-management');
    }
    public function showChildren(){
        if(Auth::user()->role != 1){
            // return view('pages.children-management', 
            //     [
            //     'user' => Auth::user(),
            //     ],
            // );
            return view('pages.children-management', 
                [
                'user' => Auth::user(),
                ],
            );
        }
        else{
            //get user id
            $userId = Auth::user()->id;
            
            //get parent id 
            $parents = DB::table('parents')
            ->where('user_id', '=', $userId)
            ->first();
            $parentID = $parents->id;
            
            //join tables students-parent
            $students = DB::table('students')
            ->select('students.id','students.fullname','students.ic_number','students.birthday',
            'students.gender','students.class','students.pickup_session')
            ->join('parent_student','parent_student.student_id','=','students.id')
            ->where('parent_student.parent_id', '=', $parentID)
            ->get();

            //join tables students-parent
            // $photos = DB::table('photo_laravel')
            // ->select('students.id','photo_laravel.role',
            // 'photo_laravel.path','students.birthday')
            // ->join('students','students.id','=','photo_laravel.person_id')
            // ->where('parent_id', '=', $parentID)
            // ->get();

            return view('pages.children-management', 
                ['students' => $students,
                // 'photos' => $photos,
                'user' => Auth::user()],
            );
        }

    }
    public function deleteChild($id){
        $student = ParentStudent::where('student_id', $id)->firstorfail()->delete();
        return redirect('children-management');
    }
    public function showChild($icnumber){
        //show child before 
        $msg = "There is no such student in the system.";
        $student = Students::where('ic_number', $icnumber)->first();

        
        if($student->count()>0){
            $msg = "Found: ".($student->fullname);
        }
        return response()->json(array('ic_msg'=> $msg), 200);
    }
    // if user is not a parent -> show card to ask to be parent
    // else show children list
}

