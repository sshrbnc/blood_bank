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

                $query = DB::table('blood_requests')
                ->where('blood_type', $blood->blood_type)
                ->where('components', $blood->component);
                if (condition) {
                    # code...
                }
                $donation->save();
                $blood->save();
            }
        }
        return redirect()->route('admin.bloods.index');
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
