<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use DB;
class Patient extends Model
{

	//associate patient to pathologies
 //    public function pathologies () {
 //    	return $this->BelongsToMany('App\Models\Pathologie');
	// }

	
	// public function created_by_user(){
	// 	return $this->belongsTo('App\Models\User','created_by'); // the second argument is used to determine the foreign key of user in patients tables
	// }

	// public function consultations() {
	// 	return $this->hasMany('App\Models\Consultation');
	// }	
	

	// public function prescriptions() {
	// 	return $this->hasMany('App\Models\Prescription')->where('etats','prescription');
	// }
	
}
