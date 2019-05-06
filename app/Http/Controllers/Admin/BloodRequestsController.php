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


    public function generate_code(){
       $transaction_code = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, 8);
    $t_code = DB::table('blood_requests')->where('transaction_code',$transaction_code)->first();

        if($t_code){
           return $this->generate_code(); 
        }

        return $transaction_code;
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
            $blood_requests->status = $request->input('status');;
            $blood_requests->transaction_code = $this->generate_code();
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

    public function assignDonor($id){
        $br = DB::table('blood_requests') ->where('id', $id)->get()->first();
        $patient = DB::table('patients') -> where('id', $br->patient_id)->get()->first();
        $donors = DB::table('donors')->get();
        return view('admin.blood_requests.assignDonor', compact('br', 'patient','donors')); 
    }

    public function donorReceipient(Request $request, $bcode, $bid, $did){

        $br = DB::table('blood_requests')->where('transaction_code', $bcode)->get()->first();
        $blood = DB::table('bloods')->where('donor_id', $did)->where('component', $br->component)->get();

        dd($blood);
    }

    public function searchDonor(Request $request){

        $input = $request->search;
        $output="";
        
        if ($request->ajax()){
            if ($input==''){
                $donors = DB::table('donors')->get();
            }
            else{
                $donors = DB::table('donors')->where('name', 'LIKE', '%'.$request->search.'%')
                                        ->orWhere('address', 'LIKE', '%'.$request->search.'%')
                                        ->orWhere('blood_type', 'LIKE', '%'.$request->search.'%')
                                        ->get();  
            }

            $num_rows = $donors->count();

            if ($num_rows==0){
                $output = '<tr>
                            <td align="center" colspan="4">No entries found<td>
                            </tr>';
            }

            if($donors){
                foreach ($donors as $key => $donor) {
                $output.='<tr>'.
                        '<td>'.$donor->name.'</td>'.
                        '<td>'.$donor->blood_type.'</td>'.
                        '<td>'.$donor->birthday.'</td>'.
                        '<td>'.$donor->address.'</td>
                        <td><a href="{{ route("admin.patients.show",'.$donor->id.') }}" class="btn btn-xs btn-primary">View</a></td>
                        </tr>';
                }
                return Response($output);

            }
        }
    }
}
