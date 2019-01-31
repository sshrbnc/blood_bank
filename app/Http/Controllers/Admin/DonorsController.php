<?php

namespace App\Http\Controllers\Admin;

use App\Donor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreProfilesRequest;
use App\Http\Requests\Admin\UpdateProfilesRequest;
// use App\Http\Requests\Admin\StoreDonorsRequest;
// use App\Http\Requests\Admin\UpdateDonorsRequest;
use App\Http\Controllers\Traits\FileUploadTrait;

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
        }
       
        return view('admin.donors.index', compact('donors'));
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

    /**
     * Store a newly created Donor in storage.
     *
     * @param  \App\Http\Requests\StoreDonorsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDonorsRequest $request)
    {
        if (! Gate::allows('donor_create')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $donor = Donor::create($request->all());

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
    public function update(UpdateDonorsRequest $request, $id)
    {
        if (! Gate::allows('donor_edit')) {
            return abort(401);
        }
        $request = $this->saveFiles($request);
        $donor = Donor::findOrFail($id);
        $donor->update($request->all());

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
        if (! Gate::allows('donor_show')) {
            return abort(401);
        }
        $donor = Donor::findOrFail($id);

        return view('admin.donors.show', compact('donor'));
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

        return redirect()->route('admin.donors.index');
    }
   
}

