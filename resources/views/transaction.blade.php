@extends('layouts.home')

@section('main')

<div class="result-details">
	<div id="trans_id">Transaction ID: 0986YYDGE64</div>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<p></p>
	<div class="patient_details">
		<h6>Patient: </h6><h3> Shaira Abancio </h3> 
		<h6>Donor: </h6><h3> {{ $donor->name }} </h3> 
	 	<h6> Blood Type: </h6><h3> O+ </h3>
	 	<p></p>
	 	<p></p>
	 	<p></p>
	 	<h6> Status: </h6>
	 	<h2>CLAIMED</h2>
 	</div>
</div>

@endsection