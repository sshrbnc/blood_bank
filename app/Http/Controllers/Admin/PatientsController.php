<?php

namespace App\Http\Controllers\Admin;

use App\Patient;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;
use Carbon\Carbon;
use Nexmo\Laravel\Facade\Nexmo;
use Session;


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
            'contact_number'  => 'required'
            ]);


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
            $patients->contact_number = '639'.$request->input('contact_number');

            $patients->details_information = $request->input('details_information');

            $patients->save();  
        }
        

        $id = $patients->id;

        if($patients){
            $patient = DB::table('patients')->where('id',$id)->get()->first();
            return view('admin.blood_requests.create', compact('patient'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Patient  $patient
     * @return \Illuminate\Http\Response
     */

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
        $patient = DB::table('patients')->where('id',$id)->get()->first();
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


      public function massDestroy(Request $request)
    {
        if (! Gate::allows('patient_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Patient::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function sendSMS(Request $request){
        Nexmo::message()->send([
            'to'   => $request->input('mobile'),
            'from' => '16105552344',
            'text' => 'Testing from Philippine Red Cross'
        ]);

        Session::flash('success', 'SMS Send');
        return redirect('/');
    }

}
