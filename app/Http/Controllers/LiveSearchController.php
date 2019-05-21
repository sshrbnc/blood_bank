<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class LiveSearchController extends Controller
{
    //

public function search(Request $request) {
    if($request->ajax()){
        $output="";
        $query=$request->trans;
        $transaction=DB::table('blood_requests')->where('transaction_code','like','%'.$query."%")->get()->first();


        if($transaction){
    		$patient = DB::table('patients')->where('id',$transaction->patient_id)->get()->first();
                $output.=
                '<p style="font-size:40px; font-weight:bold; ">'.$patient->firstname.' '.$patient->middlename.' '.$patient->lastname.'</p>'.
                '<p>'.$transaction->component.'</p>'.
                '<p>'.$transaction->hospital.'</p>'.
                '<p style="font-weight:bold; color:#77030f;">'.$transaction->status.'</p>';
            
        return Response($output);
        }

    }
}
}
