<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Model;

class Appointement extends Model
{

	protected $fillable = ['created_by','patient_id','text','start_date' , 'end_date' ,'category_id' , 'color' ,'fauteuil'];

}