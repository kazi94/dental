<?php

namespace App\Http\Controllers\User;
use Auth;
use App\Models\Schema;
use App\Models\Traitement;
use App\Models\Formule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Barryvdh\Debugbar;
class SchemaDentaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coords = [];

        $schema = Schema::firstOrCreate( // firstOrCreate : store to DB if id not found
            [ 'id' => $request->schema_id],
            [
                'patient_id' => $request->patient_id,
                'type'  => $request->type,
            ]
        );

        if ($request->formulas != "") {
            $formulas = explode(',' , $request->formulas);

            foreach ($formulas as $key => $formule) {
                // get the formulas id  from the table formulas where num dent and formulas matchess
                $formulas_id[] = Formule::where('teeth', $request->teeth)
                ->where('formulas' , $formule)
                ->select('id')
                ->first();
            }
            
            $formulas_id = collect($formulas_id)->map(function($e){ return $e->id; });
            
            // sync schema and formulas in traitement table and remove id not exist in table
            $schema->traitements()->sync($formulas_id);
    
            // get the coords
            $coords = Formule::whereIn('id' , $formulas_id)->get();
        } else $schema->traitements()->detach();


        return response()->json([
            'schema_id' => $schema->id,
            'coords'    => $coords 
        ] , 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Schema  $schema
     * @return \Illuminate\Http\Response
     */
    public function show(Schema $schema)
    {
        //
    }
    /**
     * undocumented function summary
     *
     * Undocumented function long description
     *
     * @param Type $var Description
     * @return type
     * @throws conditon
     **/
    public function getCoords($teeth = null , $formulas)
    {
        // get the coords ,color of the selected formulas and teeth
        $coords = Formule::where('teeth', $teeth)
        ->whereIn('formulas' , explode("," , $formulas))
        ->select('coord','color','formulas')
        ->get();

        return response()->json( $coords , 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Schema  $schema
     * @return \Illuminate\Http\Response
     */
    public function edit(Schema $schema)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Schema  $schema
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schema $schema)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Schema  $schema
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request , $schema)
    {
        return $request;
    }

    public function removeTooth ($toothToRemove)
    {
        $exp = explode(',',$toothToRemove);
        foreach ($exp as $val) {
            Traitement::where('num_dent',$val)->where('formule','!=',null)->delete();
        }

        return response()->json([] , 201);
    }
}
