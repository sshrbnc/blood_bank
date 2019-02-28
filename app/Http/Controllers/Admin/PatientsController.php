<?php

namespace App\Http\Controllers\Admin;

use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class PatientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $patients = Patient::all()->toArray();
        return view('admin.patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.patients.create');

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

         $this->validate($request, [
            'name'  => 'required',
            'blood_type'  => 'required',
            'address'  => 'required',
            'birthday'  => 'required',
            'contact_number'  => 'required'
            ]);


        if (Auth::check()){

            $patients = new Patient;
            $patients->name = $request->input('name');
            $patients->blood_type = $request->input('blood_type');
            $patients->address = $request->input('address');
            $patients->birthday = $request->input('birthday');
            $patients->age = $request->input('age');
            $patients->contact_number = $request->input('contact_number');
            $patients->details_information = $request->input('details_information');
            $patients->save();  
        }
       

        if($patients){
            return redirect()->route('admin.patients.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show(Patient $patient)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit(Patient $patient)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy(Patient $patient)
    {
        //
    }
}
