<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $fillable = [ 'name', 'blood_type', 'address','birthday','age', 'contact_number', 'details_information'];
    protected $hidden = [];
}
