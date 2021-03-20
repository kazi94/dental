<?php

namespace App\Http\Controllers\User;

use Auth;
use App\Models\Schema;
use App\Models\Traitement;
use App\Models\Formule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Debugbar;
use Illuminate\Support\Facades\Validator;

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

        // $validator = Validator::make(
        //     $request->all(),
        //     [
        //         'tooth' => 'array'
        //     ],
        //     [
        //         'array' => 'Veuillez sélectionner au moin une dent.',
        //     ]
        // )->validate();
        $tooth = json_decode($request->tooth);
        if (count($tooth) == 0)
            return response()->json("Veuillez sélectionner au moins une dent.", 422);
        $coords = [];

        $schema = Schema::find($request->schema_id);

        if ($request->formula != "") {



            foreach ($tooth as $teeth) {
                // get the formulas id  from the table formulas where num dent and formulas matchess
                $formulas_id = Formule::where('teeth', $teeth)
                    ->where('formulas', $request->formula)
                    ->select('id')
                    ->get();


                $formulas_id = collect($formulas_id)->map(function ($e) {
                    return $e->id;
                });

                $this->syncTraitements($schema, $formulas_id, $teeth);
            }



            // get the coords of the selected teeth or tooth
            $coords = Formule::where('formulas', $request->formula)
                ->whereIn('teeth', $tooth)
                ->get();

            return response()->json(
                [
                    'schema_id' => $schema->id,
                    'coords'    => $coords
                ],
                201
            );
        }
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
        // $schema->traitements()
        //     ->wherePivot('teeth', $teeth)
        //     ->detach();
        $schema->traitements()
            ->wherePivot('teeth', $teeth)
            ->attach($ant_id_array);
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
     * return to the client the coords of the selected teeth or
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
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $schema)
    {
        // Get Schema
        $schema = Schema::find($schema);

        //Get the Formula IDS given by name of formula and list of tooth
        $formula_ids = Formule::whereIn('teeth', json_decode($request->tooth))
            ->where('formulas', $request->formula)
            ->select('id')
            ->get();
        $formula_ids = collect($formula_ids)->map(function ($e) {
            return $e->id;
        });

        // detach from 'Traitements' table tooth from fomula 
        $schema->traitements()->detach($formula_ids);

        return response()->json("success", 200);
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

    /**
     * send to the client the list of formulas of selected teeth
     *
     * @param [type] $teeth
     * @author Kazi Aouel Sid Ahmed <kazi.sidou.94@gmail.com>
     * @return Response List of formulas
     */
    public function getFormulasOfTeeth($id, $teeth)
    {

        //$formulas = Traitement::with('formulas')->whereIn('teeth', explode(',', $teeth))->where('schema_id', $id)->distinct();

        return $formulas = \DB::table('traitements')
            ->join('formules', 'traitements.formule_id', 'formules.id')
            ->where('traitements.teeth', $teeth)
            ->where('schema_id', $id)
            ->select('formules.formulas')
            ->get();
    }
}
