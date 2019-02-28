<?php

namespace App\Http\Controllers;

use App\Donor;
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
    public function index()
    {
        $q = Input::get('q');
        $donor = Donor::findOrFail($q);

        return view('transaction');
    }

    // public function show()
    // {
    
    //     $q = Input::get('q');
    //     $donor = Donor::findOrFail($q);
    //     // $donor_name = Input::get('trans_donor')
    //     // $donor = Donor::findOrFail($trans_donor);

    //     return view('transaction', compact('donor'));
    // }
}

// use App\User;
// use Illuminate\Support\Facades\Input;
// Route::get ( '/', function () {
//     return view ( 'welcome' );
// } );
// Route::any ( '/search', function () {
//     $q = Input::get ( 'q' );
//     $user = User::where ( 'name', 'LIKE', '%' . $q . '%' )->orWhere ( 'email', 'LIKE', '%' . $q . '%' )->get ();
//     if (count ( $user ) > 0)
//         return view ( 'welcome' )->withDetails ( $user )->withQuery ( $q );
//     else
//         return view ( 'welcome' )->withMessage ( 'No Details found. Try to search again !' );
// } );
