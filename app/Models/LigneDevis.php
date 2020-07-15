<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LigneDevis extends Model
{
    public $table ="lignedevis";

    protected $fillable = ['num_dent','price','acte_id','devis_id' ,'state'];
    

    public function act()
    {
        return $this->hasOne('App\Models\Acte', 'id', 'acte_id');
    }

}
