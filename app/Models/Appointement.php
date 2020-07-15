<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Model;

class Appointement extends Model
{

		protected $fillable = ['created_by','patient_id','text','start_date' , 'end_date' ,'category_id' , 'color' ,'fauteuil' ,'assign_to'];

	public function patient()
	{
		return $this->belongsTo('App\Models\Patient');
	}

	public function category()
	{
		return $this->belongsTo('App\Models\Category');
	}
	
	public function createdBy()
	{
		return $this->belongsTo('App\User', 'created_by' , 'id');
	}

	public function assignTo()
	{
		return $this->belongsTo('App\User', 'assign_to' , 'id');
	}

}