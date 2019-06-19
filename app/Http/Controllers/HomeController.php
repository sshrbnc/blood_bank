<?php

namespace App\Http\Controllers;

use App\Donor;

use App\Patient;
use App\Donation;
use App\Blood;
use App\BloodRequests;

use DB;
use App\Http\Requests;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Mail;
// use App\Mail\SendMailable;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $opblood = DB::table('bloods')->where('blood_type', 'O+')->where('status', 'On storage')->get();
        $onblood = DB::table('bloods')->where('blood_type', 'O-')->where('status', 'On storage')->get();
        $apblood = DB::table('bloods')->where('blood_type', 'A+')->where('status', 'On storage')->get();
        $anblood = DB::table('bloods')->where('blood_type', 'A-')->where('status', 'On storage')->get();
        $abpblood = DB::table('bloods')->where('blood_type', 'AB+')->where('status', 'On storage')->get();
        $abnblood = DB::table('bloods')->where('blood_type', 'AB-')->where('status', 'On storage')->get();
        $bpblood = DB::table('bloods')->where('blood_type', 'B+')->where('status', 'On storage')->get();
        $bnblood = DB::table('bloods')->where('blood_type', 'B-')->where('status', 'On storage')->get();


        return view('home', compact('opblood','onblood', 'apblood','anblood', 'abpblood', 'abnblood', 'bpblood', 'bnblood'));

    }

    // public function search(Request $request)
    // {
    //     $search = $request->get('search');
    //     $patients = DB::table('patients')->where('name', 'like', '%'.$search.'%')->paginate(5);

    //     return view('home', ['patients' => $patients]);
    // }

    // public function mail()
    // {
    //    $name = 'Shaira';
    //    Mail::to('abancioshaira@gmail.com')->send(new SendMailable($name));
       
    //    return 'Email was sent';
    // }



}
