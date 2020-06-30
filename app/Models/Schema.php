<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schema extends Model
{
    protected $fillable = ['patient_id','type','created_by'];

	public function lastQuotation()
	{
		return $this->hasOne('App\Models\Devis', 'schema_id', 'id')->latest()->limit(1);
	}    
}
