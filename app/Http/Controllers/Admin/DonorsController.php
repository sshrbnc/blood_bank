<?php

namespace App\Http\Controllers\Admin;

use App\Donor;
use App\Donation;
use App\Blood;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDonorsRequest;
use App\Http\Requests\Admin\UpdateDonorsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;
use Illuminate\Database\Eloquent\Collection;

class DonorsController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of Donor.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('donor_access')) {
            return abort(401);
        }

        if (request('show_deleted') == 1) {
            if (! Gate::allows('donor_delete')) {
                return abort(401);
            }
            $donors = Donor::onlyTrashed()->get();
        } else {
            $donors = Donor::all();

            // foreach ($donors as $donor) {
            //     $data = Donation::select('donor_id', 'date_donated', 'created_at')->get();
            //     $grouped = $data->groupBy('donor_id');
            // }
            // dd($grouped->toArray());
            
            
            // $donor_donation = array();
           
            // $donor_donation = DB::table('donations')->where('donor_id', $donors[0]->id)->get();
            // $last_donation[] = DB::table('donations')->where('donor_id', $donors[0]->id)->orderBy('created_at', 'desc')->first();
        }
        // dd($last_donation);       
        return view('admin.donors.index', compact('donors', 'donor_donation', 'last_donation'));
    }
  
    /**
     * Show the form for creating new Donor.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('donor_create')) {
            return abort(401);
        }

        return view('admin.donors.create');
    }

    public function newDonation($id)
    {
        $donor = DB::table('donors')->where('id', $id)->get();
        return view('admin.donations.create', compact('donor'));
    }

    /**
     * Store a newly created Donor in storage.
     *
     * @param  \App\Http\Requests\StoreDonorsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (! Gate::allows('donor_create')) {
            return abort(401);
        }

        request()->validate([
            'firstname' => 'min:1|max:30|required',
            'lastname' => 'min:1|max:30|required',
            'blood_type' => 'required',            
            'birthday' => 'required|date_format:'.config('app.date_format'),
            'sex' => 'required',
            'address' => 'required',
            'phone_number' => ['required', 'regex:/(09|\+639)\d{9}$/'],
        ]);

        if(Auth::check()){
            $donor = new Donor;
            $donor->firstname = $request->input('firstname');
            $donor->middlename = $request->input('middlename');
            $donor->lastname = $request->input('lastname');
            $donor->blood_type = $request->input('blood_type');
            $donor->birthday = $request->input('birthday');
            $donor->sex = $request->input('sex');
            $donor->address = $request->input('address');
            $donor->phone_number = $request->input('phone_number');
            $donor->employee_id = Auth::user()->id;

            $donor->save();
        }
        
        return redirect()->route('admin.donors.index');
    }


    /**
     * Show the form for editing Donor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('donor_edit')) {
            return abort(401);
        }
        $donor = Donor::findOrFail($id);

        return view('admin.donors.edit', compact('donor'));
    }

    /**
     * Update Donor in storage.
     *
     * @param  \App\Http\Requests\UpdateDonorsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (! Gate::allows('donor_edit')) {
            return abort(401);
        }

        request()->validate([
            'firstname' => 'min:1|max:30|required|string',
            'lastname' => 'min:1|max:30|required|string',
            'blood_type' => 'required',            
            'birthday' => 'required|date_format:'.config('app.date_format'),
            'sex' => 'required',
            'address' => 'required',
            'phone_number' => ['required', 'regex:/(09|\+639)\d{9}$/'],
        ]);

        if(Auth::check()){
            $donor = Donor::find($id);
            $donor->firstname = $request->input('firstname');
            $donor->middlename = $request->input('middlename');
            $donor->lastname = $request->input('lastname');
            $donor->blood_type = $request->input('blood_type');
            $donor->birthday = $request->input('birthday');
            $donor->sex = $request->input('sex');
            $donor->address = $request->input('address');
            $donor->phone_number = $request->input('phone_number');
            $donor->employee_id = Auth::user()->id;

            $donor->update();
        }

        return redirect()->route('admin.donors.index');
    }

    /**
     * Display Donor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $donor = Donor::findOrFail($id);
        $donation = Donation::where('donor_id', $id)->get();
        
        $date_now_wbc = Carbon::now();
        $date_now_rbc = Carbon::now();
        $date_now_platelet = Carbon::now();
        $date_now_plasma = Carbon::now();
        $date_now_cryo= Carbon::now();
        $date_now_wcg= Carbon::now();
        $expdatewbc = $date_now_wbc->addMonth()->format('m-d-Y');
        $expdaterbc = $date_now_rbc->addMonths(2)->format('m-d-Y');
        $expdateplatelet = $date_now_platelet->addMonths(3)->format('m-d-Y');
        $expdateplasma = $date_now_plasma->addMonths(4)->format('m-d-Y');
        $expdatecryo = $date_now_cryo->addMonths(5)->format('m-d-Y');
        $expdatewcg = $date_now_wcg->addMonths(6)->format('m-d-Y');

        return view('admin.donors.show', compact('donor', 'donation', 'expdatewbc', 'expdaterbc', 'expdateplatelet', 'expdateplasma', 'expdatecryo', 'expdatewcg'));
    }

    /**
     * Remove Donor from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('donor_delete')) {
            return abort(401);
        }
        $donor = Donor::findOrFail($id);
        $donor->delete();
        // $donations = Donation::where('donor_id', $id)->get();
        // $donations->delete();

        return redirect()->route('admin.donors.index');
    }

    /**
     * Delete all selected Donor at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('donor_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Donor::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Donor from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('donor_delete')) {
            return abort(401);
        }
        $donor = Donor::onlyTrashed()->findOrFail($id);
        $donor->restore();

        return redirect()->route('admin.donors.index');
    }

    /**
     * Permanently delete Donor from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('donor_delete')) {
            return abort(401);
        }
        $donor = Donor::onlyTrashed()->findOrFail($id);
        $donor->forceDelete();
        // $donations = Donation::onlyTrashed()->where('donor_id', $id)->get();
        // $donations->forceDelete();

        return redirect()->route('admin.donors.index');
    }
   
}

