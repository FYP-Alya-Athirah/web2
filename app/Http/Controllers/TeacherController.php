<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class TeacherController extends Controller
{
    public function getList()
    {
        $teachers = DB::table('teachers')->get();
        return view('pages.teachers-management', ['teachers' => $teachers]);
    }
}
