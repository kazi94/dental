<?php

namespace App\Models;

use DB;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Appointement extends Model
{

	protected $fillable = ['created_by', 'patient_id', 'text', 'start_date', 'end_date', 'category_id', 'color', 'fauteuil', 'assign_to'];

	protected $appends = ['date_appointement'];

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
		return $this->belongsTo('App\User', 'created_by', 'id');
	}

	public function assignedTo()
	{
		return $this->belongsTo('App\User', 'assign_to', 'id');
	}

	public function getDateAppointementAttribute()
	{
		$ed = new Carbon($this->end_date);
		$sd = new Carbon($this->start_date);
		$d = date("d/m/Y", strtotime($this->start_date));
		return $d . " | " . $sd->roundMinute()->format('H:i') . "-" . $ed->roundMinute()->format('H:i');
	}
}
