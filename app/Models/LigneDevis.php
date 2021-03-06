<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LigneDevis extends Model
{
    public $table = "lignedevis";

    protected $fillable = ['num_dent', 'price', 'acte_id', 'devis_id', 'state', 'formule_id'];

    protected $appends = ['date_done'];

    public function act()
    {
        return $this->hasOne('App\Models\Acte', 'id', 'acte_id');
    }

    public function coord()
    {
        return $this->hasOne('App\Models\Formule', 'id', 'formule_id');
    }

    public function getDateDoneAttribute()
    {
        return date("d/m/Y", strtotime($this->updated_at));
    }
}
