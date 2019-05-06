<?php

namespace App\Http\Controllers\Admin;

use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;


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
            'firstname'  => 'required',
            'middlename'  => 'required',
            'lastname'  => 'required',
            'blood_type'  => 'required',
            'address'  => 'required',
            'birthday'  => 'required',
            'contact_number'  => ['required', 'regex:/(09|\+639)\d{9}$/'
            ]            ]);


        if (Auth::check()){
            $years = Carbon::parse($request->input('birthday'))->age;

            $patients = new Patient;
            $patients->firstname = $request->input('firstname');
            $patients->middlename = $request->input('middlename');
            $patients->lastname = $request->input('lastname');
            $patients->blood_type = $request->input('blood_type');
            $patients->address = $request->input('address');
            $patients->birthday = $request->input('birthday');
            $patients->age = $years;
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
    // public function show(Patient $patient)

    public function show($id)
    {
        // if (! Gate::allows('donor_view')) {
        //     return abort(401);
        // }
        $patient = Patient::findOrFail($id);
        $blood_requests = DB::table('blood_requests')->where('patient_id',$id)->get();
        return view('admin.patients.show', compact('patient', 'blood_requests'));
    }

    /**
     * Restore Donor from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        // if (! Gate::allows('donor_delete')) {
        //     return abort(401);
        // }
        $patient = Patient::onlyTrashed()->findOrFail($id);
        $patient->restore();

        return redirect()->route('admin.patients.index');
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

     public function createBR($id)
    {
        //
        $patient = DB::table('patients')->where('id',$id)->get();
        return view('admin.blood_requests.create', compact('patient')); 
    }

     public function destroy($id)
    {
        // if (! Gate::allows('patient_delete')) {
        //     return abort(401);
        // }
        $patient = Patient::findOrFail($id);
        $patient->delete();
        return redirect()->route('admin.patients.index');
    }

    public function perma_del($id)
    {
        // if (! Gate::allows('patient_delete')) {
        //     return abort(401);
        // }
        $patient = Patient::onlyTrashed()->findOrFail($id);
        $patient->forceDelete();

        return redirect()->route('admin.patients.index');
    }

}
