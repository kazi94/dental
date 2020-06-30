<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    public $table ="devis";

	protected $fillable = ['schema_id','total','discount','total_accept' ,'state'];

	public function lignes()
	{
	    return $this->hasMany('App\Models\LigneDevis', 'devis_id');
	}

	public function versements()
	{
	    return $this->hasMany('App\Models\Versement', 'devis_id' ,'id');
	}


}
