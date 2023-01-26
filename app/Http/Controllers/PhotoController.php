<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PhotoAI;
use App\Models\PhotoLaravel;
use App\Models\Students;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUpload()
    {
        return view('pages.photo-management');
    }
    
    public function imageUploadPost($fullname, $id, $role, Request $request)
    {
        // $request->validate([
        //     'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
    

        // name from original filename
        $imageName = $request->file('image')->getClientOriginalName();

        //Upload file to recognition project
        // Storage::disk('disks')->put($imageName, 'image');

        //Upload file to FTP server
        // Storage::disk('ftp')->makeDirectory($imageName);
        // Storage::disk('ftp')->put($imageName, fopen($request->file('image'), 'r+'));
        // $post = new PhotoAI;
        // $post->path = $imageName;
        // $post->save();


        //Upload file to public folder
        // $username = "Alya Athirah";
        $path = public_path('images').'/'.$fullname;
        if(!File::isDirectory($path)){
            File::makeDirectory($path, 0777, true, true);
        }
        $request->image->move(public_path('images').'/'.$fullname, $imageName);

        $post = new PhotoLaravel;
        $post->path = $fullname.'/'.$imageName;
        $post->person_id = $id;
        $post->role = $role;
        $post->save();

        //get user by role

    
        // return back()
        //     ->with('success','You have successfully upload image.')
        //     ->with('image',$imageName)
        //     ; 
    }

    public function imageUploadChild($id,Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $role = 1;
        // find student name
        $student = Students::where('id', $id)->first();
        //give function the id and role too
        $this->imageUploadPost($student->fullname, $id, $role, $request);
        return back()
            ->with('success','You have successfully upload image.')
        ; 

    }
    public function imageUploadParent($id,Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $role = 2;
        // find parent name
        $student = Students::where('id', $id)->first();
        //give function the id and role too
        $this->imageUploadPost($student->fullname, $id, $role, $request);
        return back()
            ->with('success','You have successfully upload image.')
        ; 

    }
    public function imageDeleteChild($id, $role, Request $request){

    }
    public function imageDelete($fullname, $image_path)
    {
        // path = fullname+path
        // $fullname = "";
        // $image_path = "";
        $path = $fullname."/".$image_path;
        // delete in ftp
        Storage::disk('ftp')->delete($path);

        // delete in public
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }

    public function photosChild($id){
        //join tables students-parent
        $photos = DB::table('photo_laravel')
        ->where(['person_id' => $id, 
                'role' => '1'])
        ->get();
        // $photos = $id;
        $role = 1;
        return view('pages.photo-child-management', 
        ['photos' => $photos,
        'id' => $id,
        'role' => $role]);
    }
    public function photosParent($id){
        //join tables students-parent
        $photos = DB::table('photo_laravel')
        ->where(['person_id' => $id, 
                'role' => '1'])
        ->get();
        // $photos = $id;
        $role = 1;
        return view('pages.photo-parent-management', 
        ['photos' => $photos,
        'id' => $id,
        'role' => $role]);
    }
}
?>
