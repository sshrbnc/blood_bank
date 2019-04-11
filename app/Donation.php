<?php

namespace App;

use App\Donor;
use App\Donation;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Donation extends Model
{
    use SoftDeletes;

    protected $fillable = ['date_donated', 'donor_id', 'trans_code', 'weight', 'blood_count', 'result', 'details_information', 'status', 'flag', 'employee_id'];
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

}
