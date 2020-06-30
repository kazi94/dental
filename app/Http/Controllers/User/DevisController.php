<?php

namespace App\Http\Controllers\User;

use App\Models\Devis;
use App\Models\LigneDevis;
use App\Models\Versement;
use App\Models\Schema;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DevisController extends Controller
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
        $quotState  = (($request->total_accept-$request->total_paid) == 0 ) ? 'payer&&fait' : 'devis';
        $ligneState = ($request->rhythmTraitement == 'onDay' ) ? 'Fait' : 'En cours'; // * Traitement d'un patient qui vient en une seule journée
        
        //Create New Schema
        $schema = Schema::create([
            'patient_id'  => $request->patient_id,
            'type'        => 'plan',
            'created_by'  => Auth::id(),
        ]);

        // Create Traitements (Acts) : coords , acts , and all data to be need for drawing shapes in schema
        //...

        // Create New quotation    
        $quotation = Devis::create([
            'state'        => $quotState,
            'discount'     => $request->discount,
            'total'        => $request->total,
            'total_accept' => $request->total_accept,
            'created_by'   => Auth::id(),
            'schema_id'    => $schema->id,
        ]);

        $selectedLignes = json_decode($request->selectedLignes, true);
        //Store lignes quotation
        foreach ($selectedLignes  as $ligne) {
            $ids[] = LigneDevis::create([
                'devis_id'  => $quotation->id,
                'num_dent'  => $ligne['num_dent'],
                'acte_id'   => $ligne['act_id'],
                'price'     => $ligne['prix'],
                'state'     => $ligneState,
            ])->id;
        }

        // Make payement if exist !
        if ($request->total_paid != 0)
            $this->createPayment($request->total_paid , $quotation->id);


        
        return response()->json(LigneDevis::whereIn('id' , $ids)->with('act:id,nom')->get() ,201);
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    private function createPayment($total_paid , $quot_id)
    {
        Versement::create([
                        'total_paid' => $total_paid,
                        'paid_by'    => Auth::id(),
                        'devis_id'   => $quot_id,
                        'paid_at'    => now(),
                    ]);        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Devis  $devis
     * @return \Illuminate\Http\Response
     */
    public function show(Devis $devis)
    {
        //
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function updateDevis(Request $request)
    {       
        // mettre à jour les actes de en cours  à fait
        foreach ($request->acceptedQuotation as $value) {
            $quot_id = LigneDevis::where('id', $value->id)
                ->update(['state' => $value->status]);        
        }

        // Make payement if exist !
        if ($request->total_paid != 0)
            $this->createPayment($request->total_paid , $quot_id);        

        return response()->json([] , 201);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Devis  $devis
     * @return \Illuminate\Http\Response
     */
    public function edit(Devis $devis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Devis  $devis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Devis $devis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Devis  $devis
     * @return \Illuminate\Http\Response
     */
    public function destroy(Devis $devis)
    {
        //
    }
}
