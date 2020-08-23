<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Traitement extends Model
{
    protected $fillable = ['num_dent', 'formule', 'created_by', 'schema_id'];

    public function coords() {
        return $this->hasMany('App\Models\Formule' , 'teeth' , 'num_dent');
    }
}
