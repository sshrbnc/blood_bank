<?php

namespace App\Http\Controllers;

use App\Donor;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class TransactionsController extends Controller
{

	/**
     * Display a listing of Donor.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($trans_code)
    {
        $trans_code = $users = DB::table('transaction')->where('trans_code', $trans_code)->get();

        return view('transaction', compact('trans_code'));
    }


}

