<?php

namespace App\Http\Controllers\Admin;

use App\Donor;
use App\Donation;
use Auth;
use App\Http\Controllers\Admin\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;

class DonationsController extends Controller
{
    
	public function create()
    {
        
        return view('admin.donations.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'date_donated' => 'required|date_format:'.config('app.date_format'),
            // 'weight' => 'required|numeric',
            // 'blood_count' => 'numeric',
            // 'result' => 'required',
            // 'status' => 'required',
            // 'flag' => 'required'
        ]);

        if(Auth::check()){
            $donation = new Donation;
            $donation->date_donated = $request->input('date_donated');
            $donation->donor_id = $request['donor_id'];
            $donation->trans_code = $request->input('trans_code');
            $donation->weight = $request->input('weight');
            if ($request->input('weight') >= 50) {
                // also finished interview about confidential questions
                $donation->status = "Passed PE and Interview";
            }else{
                $donation->status = "Defer";
            }
            // button : "Hemoglobin Checking"
            $donation->blood_count = $request->input('blood_count');
            $donation->flag = $request->input('flag');

            $donation->details_information = $request->input('details_information');
            $donation->employee_id = Auth::user()->id;
            $donation->processed = 'No';
            $donation->save();
        }
        $donor_id = $request->input('donor_id');
        return redirect()->route('admin.donors.show', [$donor_id]);         
    }

    public function edit($id)
    {

        $donation = Donation::findOrFail($id);
        $donor = $donation->donor_id;

        return view('admin.donations.edit', compact('donation', 'donor'));
    }

    /**
     * Update Blood in storage.
     *
     * @param  \App\Http\Requests\UpdateBloodsRequest $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('blood_edit')) {
            return abort(401);
        }

        $this->validate($request,[
            'date_donated' => 'required|date_format:'.config('app.date_format'),
            'donor_id' => 'required',
            // 'patient_id' => 'required', 
            // 'trans_code' => 'required',  
            // 'weight' => 'required',
            // 'blood_count' => 'required',
            // 'result' => 'required',
            // 'status' => 'required',
            // 'flag' => 'required',
        ]);

        if(Auth::check()){
            $donation = Donation::find($id);
            $donation->date_donated = $request->input('date_donated');
            $donation->donor_id = $request['donor_id'];
            $donation->trans_code = $request->input('trans_code');
            $donation->weight = $request->input('weight');
            // if button is "Hemoglobin Checking"
            $donation->blood_count = $request->input('blood_count');

            if ($request->input('blood_count') >= 150) {               
                $donation->status = "Passed Checking"; //button: for collection
            }else{
                $donation->status = "Defer "; //NO button for collection
            }
            

            // if ($request->input('flag') != "--") {
            //     $donation->flag = $request->input('flag');
            //     $donation->details_information = $request->input('details_information');
            //     $donation->status = "Discard";
            //     $donation->employee_id = Auth::user()->id;
            //     $donation->processed = 'Yes';
            // }else{
            //     $donation->flag = $request->input('--');
            //     $donation->details_information = $request->input('details_information');
            //     $donation->employee_id = Auth::user()->id;
            //     $donation->processed = 'No';
            // }

            $donation->update();
        }
        // $donor_id = $request->input('donor_id');
        return redirect()->route('admin.donors.show', [$donation->donor_id]);
    }

    /**
     * Remove Donation from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $donation = Donation::findOrFail($id);
        $donation->forceDelete();

        return redirect()->back();
    }

    /**
     * Delete all selected Donation at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        
        if ($request->input('ids')) {
            $entries = Donation::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    /**
     * Restore Donation from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
       
        $donation = Donation::onlyTrashed()->findOrFail($id);
        $donation->restore();

        return redirect()->route('admin.donors.show', [$donor_id]);
    }

    /**
     * Permanently delete Donation from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function perma_del($id)
    // {
    
    //     $donation = Donation::onlyTrashed()->findOrFail($id);
    //     $donation->forceDelete();

    //     return redirect()->route('admin.donors.show', [$donor_id]);
    // }
   
}
