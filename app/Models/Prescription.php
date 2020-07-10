<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    public function lignes()
    {
        return $this->hasMany('App\Models\Ligneprescription');
    }

    public function patient()
    {
        return $this->belongsTo('App\Models\Patient');
    }

    public function user()
    {
        return $this->belongsTo('App\User', 'created_by');
    }

    /**
     * Get prescription date
     *
     * @param  string  $value
     * @return string
     */
    public function getDatePrescriptionAttribute($value)
    {
        $tims = explode(' ', $this->created_at);
        $date = $tims[0];
        return $date;
    }    

}
