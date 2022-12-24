<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Parents;

class ParentController extends Controller
{
    public function getList()
    {
        $parents = DB::table('parents')->get();
        return view('pages.parents-management', ['parents' => $parents]);
    }
    
    public function addParent(Request $request)
    {
        $post = new Parents;
        $post->fullname = $request->input('fullname');
        $post->username = $request->input('username');
        $post->carplate = $request->input('carplate');
        $post->phone_number = $request->input('phone_number');
        $post->save();
        return redirect('parents-management');
    }
    public function updateParent(Request $request)
    {
        $post = Parents::find($request->id);
        $post->fullname = $request->input('fullname');
        $post->username = $request->input('username');
        $post->carplate = $request->input('carplate');
        $post->phone_number = $request->input('phone_number');
        $post->save();

        return redirect('parents-management'); 
    }
    public function deleteParent($id){
        Parents::destroy($id);
        return redirect('parents-management');
    }
}
