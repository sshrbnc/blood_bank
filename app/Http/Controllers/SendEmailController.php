<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class SendEmailController extends Controller
{
    function index(){
    	return view('login');
    }

    function send(Request $request){
    	$data = array(
    		'name' = $request->name,
    		'email' = $request->email,
    		'message' = $request->message
    	);

    	Mail::to('abancioshaira@gmail.com')->send(new SendMail($data));
        return back();

    }
}
