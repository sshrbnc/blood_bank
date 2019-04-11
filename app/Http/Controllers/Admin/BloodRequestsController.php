<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\BloodRequests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Patient;

class BloodRequestsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $blood_requests = BloodRequests::all()->toArray();
        return view('admin.blood_requests.index', compact('blood_requests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        //
        //  if (! Gate::allows('user_create')) {
        //     return abort(401);
        // }
        return view('admin.blood_requests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

         // if (! Gate::allows('user_create')) {
        //     return abort(401);
        // }

        $this->validate($request, [
            'quantity'  => 'required',
            'hospital'  => 'required',
            'component'  => 'required',
            ]);


        if (Auth::check()){
            $blood_requests = new BloodRequests;
            $blood_requests->quantity = $request->input('quantity');
            $blood_requests->hospital = $request->input('hospital');
            $blood_requests->component = $request->input('component');
            $blood_requests->employee_id = Auth::user()->id;
            $blood_requests->patient_id = $request['patient_id'];
            $blood_requests->save();  
        }
       
        if($blood_requests){
            return redirect()->route('admin.patients.show', $request['patient_id']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\BloodRequests  $bloodRequests
     * @return \Illuminate\Http\Response
     */
    public function show(BloodRequests $bloodRequests)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\BloodRequests  $bloodRequests
     * @return \Illuminate\Http\Response
     */
    public function edit(BloodRequests $bloodRequests)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\BloodRequests  $bloodRequests
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BloodRequests $bloodRequests)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\BloodRequests  $bloodRequests
     * @return \Illuminate\Http\Response
     */
    public function destroy(BloodRequests $bloodRequests)
    {
        //
    }
}
