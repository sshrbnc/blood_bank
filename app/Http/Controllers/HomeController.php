<?php

namespace App\Http\Controllers;

use App\Donor;
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
        $donor = DB::table('donors')
                ->select('blood_type')
                ->get();

        return view('home', compact('donor'));
    }

}
