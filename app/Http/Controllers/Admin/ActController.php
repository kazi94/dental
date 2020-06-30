<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Requests\StorePatient;
use Illuminate\Database\Query\Builder;
use App\Models\Patient;
use App\Models\Acte;
use App\Models\Category;
use DB;
use Auth;


class ActController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $acts = Acte::all();

        return response()->json($acts , 200);
    }
    /**
     * return acts regrouped by category
     *
     * @return acts
     * @author 
     **/
    public function getActs()
    {
        return Category::with('acts')->get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = Category::firstOrCreate([
            'name' => $request->category]);
        $act = new Acte;
        $act->code_cnas    = $request->code_cnas;
        $act->nom          = $request->nom;
        $act->category_id  = $category->id;
        $act->price        = $request->price;
        $act->save();

        return response()->json($act , 200);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $category = Category::firstOrCreate([
            'name' => $request->category]);

        $act = Acte::find($id);
        $act->code_cnas = $request->code_cnas;
        $act->nom = $request->nom;
        $act->category_id = $category->id;
        $act->price = $request->price;
        $act->save();

        return response()->json( $act, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Acte::where('id',$id)->delete();

        return response()->json( [] , 200);
    }

}