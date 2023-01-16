<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\PhotoAI;
use App\Models\PhotoLaravel;
use App\Models\Students;
use Illuminate\Support\Facades\DB;

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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function imageUploadPost(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // $imageName = time().'.'.$request->image->extension();  
        $imageName = $request->file('image')->getClientOriginalName();
        //Upload file to recognition project
        // Storage::disk('disks')->put($imageName, 'image');

        //Upload file to FTP server
        Storage::disk('ftp')->put($imageName, fopen($request->file('image'), 'r+'));
        $post = new PhotoLaravel;
        $post->path = $imageName;
        $post->save();


        //Upload file to public folder
        $request->image->move(public_path('images'), $imageName);
        $post = new PhotoAI;
        $post->path = public_path('images');
        $post->save();

        /* Store $imageName name in DATABASE from HERE */
    
        return back()
            ->with('success','You have successfully upload image.')
            ->with('image',$imageName)
            ; 
        // return view('pages.photo-management', ['imgPath' => public_path('images')]);
    }
    public function imageDeletePost(Request $request)
    {
        Storage::disk('ftp')->delete('path/file.jpg');
    }

    public function showChildPhotos($id){
        //join tables students-parent
        $photos = DB::table('photo_laravel')
        ->where(['person_id' => $id, 
                'role' => '1'])
        ->get();
        // $photos = $id;

        return view('pages.photo-management', 
        ['photos' => $photos]);
    }
}
