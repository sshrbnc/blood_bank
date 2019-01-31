<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $fillable = [ 'name', 'address','age', 'contact_number', 'blood_type', 'details_information'];
    protected $hidden = [];
}
