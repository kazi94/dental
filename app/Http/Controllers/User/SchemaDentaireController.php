<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Models\Schema;
use App\Models\Traitement;
use App\Models\Formule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Debugbar;

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
            ['id' => $request->schema_id],
            [
                'patient_id' => $request->patient_id,
                'type'  => $request->type,
            ]
        );

        if ($request->formulas != "") {
            $formulas = explode(',', $request->formulas);

            //foreach ($formulas as $key => $formule) {//
            // get the formulas id  from the table formulas where num dent and formulas matchess
            $formulas_id = Formule::where('teeth', $request->teeth)
                ->whereIn('formulas', $formulas)
                ->select('id')
                ->get();
            //}

            $formulas_id = collect($formulas_id)->map(function ($e) {
                return $e->id;
            });
            $this->syncTraitements($schema, $formulas_id, $request->teeth);


            // get the coords
            $coords = Formule::whereIn('id', $formulas_id)->get();
        } else $schema->traitements()->wherePivot('teeth', $request->teeth)->detach();


        return response()->json([
            'schema_id' => $schema->id,
            'coords'    => $coords
        ], 201);
    }
    /**
     * Undocumented function
     *
     * @param [Integer] $schema
     * @param [Array] $ids
     * @param [Integer] $teeth
     * @author Kazi Aouel Sid Ahmed <kazi.sidou.94@gmail.com>
     * @return void
     */
    protected function syncTraitements($schema, $ids, $teeth)
    {
        foreach ($ids as $id) {
            //collect all inserted record IDs
            $ant_id_array[$id] = ['teeth' => $teeth];
        }
        // $schema->traitements()

        //     ->detach();
        Debugbar::info($ant_id_array);
        // sync schema and formulas in traitement table and remove id not exist in table
        $schema->traitements()
            ->wherePivot('teeth', $teeth)
            ->detach();
        $schema->traitements()
            ->wherePivot('teeth', $teeth)
            ->sync($ant_id_array);
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
    public function getCoords($teeth = null, $formulas)
    {
        // get the coords ,color of the selected formulas and teeth
        $coords = Formule::where('teeth', $teeth)
            ->whereIn('formulas', explode(",", $formulas))
            ->select('coord', 'color', 'formulas')
            ->get();

        return response()->json($coords, 201);
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
    public function destroy(Request $request, $schema)
    {
        return $request;
    }

    public function removeTooth($toothToRemove)
    {
        $exp = explode(',', $toothToRemove);
        foreach ($exp as $val) {
            Traitement::where('num_dent', $val)->where('formule', '!=', null)->delete();
        }

        return response()->json([], 201);
    }

    public function getCoordsByAct($act_id, $teeth)
    {
        // get the coords ,color of the selected act and teeth
        $coords = Formule::where('teeth', $teeth)
            ->where('acte_id', $act_id)
            ->select('coord', 'color', 'formulas')
            ->get();
        $result[0] = [
            'coord' => $coords[0]
        ];

        return response()->json($result, 201);
    }
}
