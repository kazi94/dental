<?php

namespace App\Models;

use DB;

use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
	public $table = "devis";

	protected $fillable = ['schema_id', 'total', 'discount', 'total_accept', 'state'];

	protected $appends = ['date_devis', 'debit'];

	public function linesInProgress()
	{
		return $this->hasMany('App\Models\LigneDevis', 'devis_id')->whereState('En cours');
	}
	public function linesDone()
	{
		return $this->hasMany('App\Models\LigneDevis', 'devis_id')->whereState('fait');
	}
	public function payments()
	{
		return $this->hasMany('App\Models\Versement', 'devis_id', 'id');
	}


	public function crediteur()
	{
		return $this->hasOne('App\Models\Versement', 'devis_id', 'id')
			->select('devis_id', DB::raw('SUM(total_paid) as crediteur'))
			->groupBy('devis_id');
		// return $this->hasOne('App\Models\Bonus_Item','customer_bones_id')
		//     ->select('customer_bones_id',DB::raw('sum(bonus_quantity) as bonusQuantity'))
		//     ->groupBy('customer_bones_id');
	}

	public function lastPayment()
	{

		$result = $this->hasOne('App\Models\Versement')
			->select('paid_at')
			->latest('paid_at')
			->limit(1);

		return $result;
	}

	public function getDateDevisAttribute()
	{
		return date("d/m/Y", strtotime($this->created_at));
	}

	/**
	 * Calculate Debit of Quotation
	 *
	 * 		
	 *
	 * @param 
	 * @return Debit
	 **/
	public function getDebitAttribute($value)
	{
		if ($this->crediteur)
			return $this->total_accept - $this->crediteur->crediteur;
		else return null;
	}
}
