<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use DB;
use Auth;


class MedicamentController extends Controller
{

    public function __construct() {
        $this->middleware('auth');

        
    }

    /**
     * Search Drugs
     *
     * @return void
     * @author 
     **/
    public function search($query)
    {
        return DB::table('sp_specialite')->where('sp_nom', 'like' , '%'.$query.'%')->limit(10)->get();
    }
    
}