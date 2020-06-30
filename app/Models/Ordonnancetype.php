<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordonnancetype extends Model
{
    public $timestamps = false;

    public function medicaments()
    {
        return $this->belongsToMany('App\Models\Medicament','ordonnancetype_sp_specialite','ordonnancetype_id','sp_specialite_id');
    }
}
