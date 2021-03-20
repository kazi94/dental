<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Versement extends Model
{

	public $timestamps =  false;

	protected $fillable = ['devis_id','total_paid','paid_by','paid_at'];

	public function lignes()
	{
	    return $this->hasMany('App\Models\LigneDevis', 'devis_id');
	}

	public function versements()
	{
	    return $this->hasMany('App\Models\Versement', 'devis_id' ,'id');
	}


}
