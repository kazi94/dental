<?php

namespace App\Http\Controllers\User;
use Auth;
use App\Models\Schema;
use App\Models\Traitement;
use App\Models\Formule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        // foreach ($request->all() as $formule) 
        // {
        // 	// Create instance of Schema
        // 	$schema = Schema::firstOrCreate( // firstOrCreate : store to DB if id not found
        // 		[ 'id' => $formule['schema_id'] ],
        // 		[
        //     		'patient_id' => $formule['patient_id'],
        //     		'type'  => $formule['type'],
        // 	    ]
        //     );
        // 	// Create for each Selected Tooth instance of Traitement
        //     $tooth =$formule['nums_dent'];

        //     foreach ($tooth as $val) {
        //     		Traitement::create([
        //     			'num_dent'   => $val,
        //     			'formule'    => $formule['formule'],
        //     			'created_by' => Auth::id(),
        //     			'schema_id'  => $schema->id 
        //     		]);
            
        //     }
        // }
        // Create instance of Schema
        $schema = Schema::firstOrCreate( // firstOrCreate : store to DB if id not found
            [ 'id' => $request->schema_id ],
            [
                'patient_id' => $request->patient_id,
                'type'  => $request->type,
            ]
        );

        Traitement::updateOrCreate(
            ['num_dent' => $request->teeth,'schema_id' => $schema->id],
            [                
            'num_dent'   => $request->teeth,
            'formules'    => $request->formulas, // "frac-rad,carie,abs..."
            'created_by' => Auth::id(),
            'schema_id'  => $schema->id 
            ]);

            // get the coords ,color of the selected formulas and teeth
            $coords = Formule::where('teeth', $request->teeth)
            ->whereIn('formulas' , explode("," , $request->formulas))
            ->select('coord','color','formulas')
            ->get();

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
