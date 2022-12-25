<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NoticeController extends Controller
{
    public function showNotice(){
        return view('pages.notice-view');
    }
    public function showNoticeAdmin(){
        return view('pages.notice-view-admin');
    }
}
