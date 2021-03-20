<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use DB;

class Patient extends Model
{

	//associate patient to pathologies
	public function pathologies()
	{
		return $this->BelongsToMany('App\Models\Pathologie');
	}

	//associate patient to antecedents
	public function antecedents()
	{
		return $this->BelongsToMany('App\Models\Antecedent');
	}
	public function radios()
	{
		return $this->hasMany('App\Models\Radio');
	}
	public function lastSchema()
	{
		return $this->hasOne('App\Models\Schema', 'patient_id', 'id')->latest()->limit(1);
	}
	public function initialSchema()
	{
		return $this->hasOne('App\Models\Schema', 'patient_id', 'id')->where('type', 'initial')->limit(1);
	}
	public function schemas()
	{
		return $this->hasMany('App\Models\Schema', 'patient_id', 'id');
	}
	public function prescriptions()
	{
		return $this->hasMany('App\Models\Prescription');
	}

	public function appointements()
	{
		return $this->hasMany('App\Models\Appointement')
			->where('start_date', '>=', date('Y-m-d'))
			->orderBy('start_date', 'asc');
	}
}
