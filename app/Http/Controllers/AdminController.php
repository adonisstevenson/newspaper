<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\News;

class AdminController extends Controller
{
    

    public function index(){

    	$users = User::latest()->limit(10)->get();

    	$news = News::latest()->limit(10)->get();

    	return view('admin.dashboard')->withUsers($users)->withNews($news);
    }
}
