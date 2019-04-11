<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patientBloodRequest extends Model
{
    //
     protected $fillable = [ 'patient_id', 'bloodReq_id'];
    protected $hidden = [];
}
