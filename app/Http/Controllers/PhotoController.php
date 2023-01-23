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
    
    public function imageUploadPost($id, $role, Request $request)
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
        $request->image->move(public_path('images'), $imageName);
        // $post = new PhotoLaravel;
        // $post->path = public_path('images');
        // $post->save();
        
        //get user by role


        //create directory(by name) in public/images folder
        // $path = public_path('images').'/images';
        // if(!File::isDirectory($path)){
        //     File::makeDirectory($path, 0777, true, true);
        // }
        // $path = public_path().'/images';
        // File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);

        $post = new PhotoLaravel;
        $post->path = $imageName;
        $post->person_id = $id;
        $post->role = $role;
        $post->save();

        /* Store $imageName name in DATABASE from HERE */
    
        // return back()
        //     ->with('success','You have successfully upload image.')
        //     ->with('image',$imageName)
        //     ; 
    }

    public function imageUploadChild($id, $role, Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        // $role = 1;
        //give function the id and role too
        $this->imageUploadPost($id, $role, $request);
        return back()
            ->with('success','You have successfully upload image.')
            ; 

    }
    public function imageDeletePost(Request $request)
    {
        Storage::disk('ftp')->delete('path/file.jpg');
    }

    public function photosChild($id){
        //join tables students-parent
        $photos = DB::table('photo_laravel')
        ->where(['person_id' => $id, 
                'role' => '1'])
        ->get();
        // $photos = $id;
        $role = 1;
        return view('pages.photo-management', 
        ['photos' => $photos,
        'id' => $id,
        'role' => $role]);
    }
}
?>
