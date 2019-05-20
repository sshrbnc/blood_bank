<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EmailAvailable extends Controller
{
    function index(){
    	return view('login');
    }
}
