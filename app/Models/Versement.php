<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Versement extends Model
{

	public $timestamps =  false;

	protected $fillable = ['patient_id', 'total_paid', 'paid_by', 'paid_at'];

	public function lignes()
	{
		return $this->hasMany('App\Models\LigneDevis', 'devis_id');
	}
	/**
	 * returns the user who validated the payment
	 *
	 * @return App\User
	 */
	public function validatedPaymentBy()
	{
		return $this->belongsTo('App\User', 'paid_by', 'id');
	}
	/**
	 * Return the Patient where the quote is created for
	 *
	 * @return App\Models\Patient
	 */
	public function createdTo()
	{
		return $this->belongsTo('App\Models\Patient', 'patient_id', 'id');
	}
}
