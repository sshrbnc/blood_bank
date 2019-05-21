<?php

namespace App\Http\Controllers;

use App\Donor;

use App\Patient;
use App\Donation;
use App\Blood;

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

        $patients = DB::table('patients')->paginate(5);
        return view('home', ['patients'=>$patients]);

        $donor = DB::table('donors')
                ->select('blood_type')
                ->get();
        // $donors = Donor::all();
        // $bloods = Blood::all();

        // $avail_blood = DB::table('bloods')->where('donor_id', $donor->id)->get();


        return view('home', compact('donor'));

    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $patients = DB::table('patients')->where('name', 'like', '%'.$search.'%')->paginate(5);

        return view('home', ['patients' => $patients]);
    }

    // public function mail()
    // {
    //    $name = 'Shaira';
    //    Mail::to('abancioshaira@gmail.com')->send(new SendMailable($name));
       
    //    return 'Email was sent';
    // }

}
