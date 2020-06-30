<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use DB;
class Patient extends Model
{

	//associate patient to pathologies
    public function pathologies () {
    	return $this->BelongsToMany('App\Models\Pathologie');
	}

		//associate patient to antecedents
    public function antecedents () {
    	return $this->BelongsToMany('App\Models\Antecedent');
	}
    public function radios () {
    	return $this->hasMany('App\Models\Radio');
	}
	public function LastSchema()
	{
		return $this->hasOne('App\Models\Schema', 'patient_id', 'id')->latest()->limit(1);
	}
	public function prescriptions() {
		return $this->hasMany('App\Models\Prescription')->where('type','prescription');
	}
	
}
