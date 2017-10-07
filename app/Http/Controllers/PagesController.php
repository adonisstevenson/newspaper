<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function index(){

    	return view('pages.home');
    }

    public function logout(){
    	
    	Auth::logout();

    	return redirect('/');
    }
}
