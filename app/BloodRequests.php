<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BloodRequests extends Model
{
    //
    protected $fillable = [ 'quantity', 'hospital', 'component', 'blood_type', 'status','employee_id'];
    protected $hidden = [];
}
