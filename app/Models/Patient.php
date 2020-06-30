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
<<<<<<< HEAD
	public function LastSchema()
	{
		return $this->hasOne('App\Models\Schema', 'patient_id', 'id')->latest()->limit(1);
	}
	public function prescriptions() {
		return $this->hasMany('App\Models\Prescription')->where('type','prescription');
	}
=======
	// public function created_by_user(){
	// 	return $this->belongsTo('App\Models\User','created_by'); // the second argument is used to determine the foreign key of user in patients tables
	// }

	// public function consultations() {
	// 	return $this->hasMany('App\Models\Consultation');
	// }	
	

	// public function prescriptions() {
	// 	return $this->hasMany('App\Models\Prescription')->where('etats','prescription');
	// }
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
	
}
