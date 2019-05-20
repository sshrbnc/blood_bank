<?php

namespace App;

use App\Donor;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donor extends Model
{
    use SoftDeletes;

    protected $fillable = ['firstname', 'middlename', 'lastname', 'blood_type', 'birthday', 'sex', 'address', 'phone_number', 'employee_id'];
    protected $hidden = [];

    public function donations()
    {
        return $this->hasMany('App\Donation');
    }

    public function blood()
    {
        return $this->hasOne('App\Blood');
    }

    // /**
    //  * Set attribute to date format
    //  * @param $input
    //  */
    // public function setDateDonatedAttribute($input)
    // {
    //     if ($input != null && $input != '') {
    //         $this->attributes['date_donated'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
    //     } else {
    //         $this->attributes['date_donated'] = null;
    //     }
    // }

     /**
     * Set attribute to date format
     * @param $input
     */
    public function setBirthdayAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['birthday'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['birthday'] = null;
        }
    }

    // /**
    //  * Get attribute from date format
    //  * @param $input
    //  *
    //  * @return string
    //  */
    // public function getDateDonatedAttribute($input)
    // {
    //     $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

    //     if ($input != $zeroDate && $input != null) {
    //         return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
    //     } else {
    //         return '';
    //     }
    // }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getBirthdayAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }
}
