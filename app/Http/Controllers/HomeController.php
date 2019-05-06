<?php

namespace App\Http\Controllers;

use App\Donor;
use App\Patient;
use DB;
use App\Http\Requests;
use Illuminate\Http\Request;

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
    }

    public function search(Request $request)
    {
        $search = $request->get('search');
        $patients = DB::table('patients')->where('name', 'like', '%'.$search.'%')->paginate(5);

        return view('home', ['patients' => $patients]);
    }

}
