<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Blood;
use App\Donor;
use App\Donation;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreBloodsRequest;
use App\Http\Requests\Admin\UpdateBloodsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use App\Patient;
use App\BloodRequests;
use DB;

class BloodsController extends Controller
{
    /**
     * Display a listing of Bloods.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request('show_deleted') == 1) {
            if (! Gate::allows('blood_delete')) {
                return abort(401);
            }
            $bloods = Blood::onlyTrashed()->get();
        } else {
            $bloods = Blood::all();
        }
       
        return view('admin.bloods.index', compact('bloods', 'donors'));
    }

    /**
     * Show the form for creating new Blood.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.bloods.create');
    }

    /**
     * Store a newly created Blood in storage.
     *
     * @param  \App\Http\Requests\StoreBloodsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('blood_create')) {
            return abort(401);
        }
        if(Auth::check()){
            $component = $request['component'];

            foreach($component as $components){
                $blood = new Blood;
                if ($components == 'Whole Blood') {
                    $exp_date = Carbon::now()->addMonths(2);
                }
                elseif ($components == 'Red Blood Cell') {
                    $exp_date = Carbon::now()->addMonths(3); 
                }
                elseif ($components == 'Platelet') {
                    $exp_date = Carbon::now()->addMonths(4); 
                }
                elseif ($components == 'Plasma') {
                    $exp_date = Carbon::now()->addMonths(5); 
                }
                elseif ($components == 'Cryo') {
                    $exp_date = Carbon::now()->addMonths(6); 
                }
                elseif ($components == 'White Cells') {
                    $exp_date = Carbon::now()->addMonths(7); 
                }
                $blood->donor_id = $request['donor_id'];
                $blood->blood_type = $request['blood_type'];
                $blood->date_donated = $request['date_donated'];
                $blood->component = $components;
                $blood->exp_date = $exp_date;
                $blood->employee_id = Auth::user()->id;
                
                $donation = Donation::find($request['donation_id']);
                $donation->processed = $request['processed'];

                $donation->save();
                $blood->save();

                $urgent = DB::table('blood_requests')
                ->where('component', $blood->component)->where('urgent', true)->get();

                $pending = DB::table('blood_requests')
                ->where('component', $blood->component)->where('status', "Pending")->get();

                if($donation->blood_req==NULL){
                    if (count($urgent)>0) {
                        foreach($urgent as $urg){
                            $id = $urg->patient_id;
                            $patient = DB::table('patients')->where('id',$id)->get()->first();
                            if($patient->blood_type == $blood->blood_type){
                                BloodRequests::where('id', $urg->id)->update(array('blood_id' => $blood->id, 'status' => 'Matched'));
                                break;
                            }
                        }
                    }
                    else{
                        if (count($pending)>0){
                            foreach($pending as $pend){
                            $id = $pend->patient_id;
                            $patient = DB::table('patients')->where('id',$id)->get()->first();

                                if($patient->blood_type == $blood->blood_type){
                                    BloodRequests::where('id', $pend->id)->update(array('blood_id' => $blood->id, 'status' => 'Matched'));
                                    break;
                                }
                            }
                        }
                    }
                }
                else{
                    $br = DB::table('blood_requests')->where('id', $donation->blood_req)->where('component', $blood->component)->get()->first();
                    if($br){
                        BloodRequests::where('id', $br->id)->update(array('blood_id' => $blood->id, 'status' => 'Donor donated'));
                    }

                }
                
            }
                
            }
        
        return redirect()->route('admin.bloods.index');
    }

     public function sendSMS($mobile){
        Nexmo::message()->send([
            'to'   => $mobile,
            'from' => '16105552344',
            'text' => 'Testing from Philippine Red Cross'
        ]);

        Session::flash('success', 'SMS Send');
        return redirect('/');
    }

    /**
     * Show the form for editing Blood.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('blood_edit')) {
            return abort(401);
        }

        $blood = Blood::findOrFail($id);

        return view('admin.bloods.edit', compact('blood'));
    }

    /**
     * Update Blood in storage.
     *
     * @param  \App\Http\Requests\UpdateBloodsRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBloodsRequest $request, $id)
    {
        if (! Gate::allows('blood_edit')) {
            return abort(401);
        }
        if(Auth::check()){
            $blood = Blood::find($id);
            $blood->donor_id = $request->input('donor_id');
            $blood->blood_type = $request->input('blood_type');
            $blood->component = $request->input('component');
            $blood->date_donated = $request->input('date_donated');
            $blood->exp_date = $request->input('exp_date');
            $blood->employee_id = Auth::user()->id;

            $blood->save();
        }
        // $bloods = Blood::findOrFail($id);
        // $bloods->update();

        return redirect()->route('admin.bloods.index');
    }

    /**
     * Display Blood.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('blood_view')) {
            return abort(401);
        }
        $blood = Blood::findOrFail($id);

        return view('admin.bloods.show', compact('blood'));
    }

    /**
     * Remove Blood from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('blood_delete')) {
            return abort(401);
        }
        $blood = Blood::findOrFail($id);
        $blood->delete();

        return redirect()->route('admin.bloods.index');
    }

    /**
     * Delete all selected Donor at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('blood_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Blood::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Blood from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('blood_delete')) {
            return abort(401);
        }
        $blood = Blood::onlyTrashed()->findOrFail($id);
        $blood->restore();

        return redirect()->route('admin.bloods.index');
    }

    /**
     * Permanently delete Blood from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('blood_delete')) {
            return abort(401);
        }
        $blood = Blood::onlyTrashed()->findOrFail($id);
        $blood->forceDelete();

        return redirect()->route('admin.bloods.index');
    }

}
