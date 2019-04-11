<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blood extends Model
{
    use SoftDeletes;

    protected $fillable = ['donor_id', 'blood_type', 'component', 'date_donated', 'exp_date', 'employee_id'];
    protected $hidden = [];
    

    public function donor()
    {
        return $this->belongsTo('App\Donor');
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    public function setDateDonatedAttribute($input)
    {
        if ($input != null && $input != '') {
            $this->attributes['date_donated'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
        } else {
            $this->attributes['date_donated'] = null;
        }
    }

    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    public function getDateDonatedAttribute($input)
    {
        $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

        if ($input != $zeroDate && $input != null) {
            return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
        } else {
            return '';
        }
    }

    //  /**
    //  * Set attribute to date format
    //  * @param $input
    //  */
    // public function setExpDateAttribute($input)
    // {
    //     if ($input != null && $input != '') {
    //         $this->attributes['exp_date'] = Carbon::createFromFormat(config('app.date_format'), $input)->format('Y-m-d');
    //     } else {
    //         $this->attributes['exp_date'] = null;
    //     }
    // }

    // *
    //  * Get attribute from date format
    //  * @param $input
    //  *
    //  * @return string
     
    // public function getExpDateAttribute($input)
    // {
    //     $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

    //     if ($input != $zeroDate && $input != null) {
    //         return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format'));
    //     } else {
    //         return '';
    //     }
    // }
}
