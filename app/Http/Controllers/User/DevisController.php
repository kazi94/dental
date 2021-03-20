<?php

namespace App\Http\Controllers\User;

use App\Models\Devis;
use App\Models\LigneDevis;
use App\Models\Versement;
use App\Models\Schema;
use App\Models\Formule;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Debugbar;
use DB;

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

        $tooth = [];
        $quotState  = (($request->total_accept - $request->total_paid) == 0) ? 'payer&&fait' : 'devis';
        $ligneState = ($request->rhythmTraitement == 'onDay') ? 'Fait' : 'En cours'; // * Traitement d'un patient qui vient en une seule journée

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


        //Store lignes quotation
        $selectedLignes = json_decode($request->selectedLignes, true);
        $ids = $this->storeLinesQuotation($selectedLignes, $quotation->id, $ligneState);


        // Make payement if exist !
        if ($request->total_paid != 0)
            $this->createPayment($request->total_paid, $quotation->id);

        // $tooth[] = collect($selectedLignes)->map(function ($e) {
        //     return $e['num_dent'];
        // });
        // Debugbar::info($tooth[0]);

        // get devis and coords of acts for each teeth
        // $lignes = DB::table('lignedevis')
        //     ->join('actes', 'lignedevis.acte_id', 'actes.id')
        //     ->join('formules', 'lignedevis.formule_id', 'formules.id')
        //     ->whereIn('lignedevis.id', $ids)
        //     // ->whereIn('formules.teeth', $tooth[0])
        //     ->select('lignedevis.*', DB::raw("actes.nom as act"), 'formules.coord', 'formules.color')
        //     ->get();
        $lignes = LigneDevis::with('act', 'coord')->whereIn('id', $ids)->get();
        // return response()->json(LigneDevis::whereIn('id' , $ids)->with('act:id,nom')->get() ,201);
        return response()->json($lignes, 201);
    }

    /**
     * Add new Acts To the Plan
     *
     * @param Request $req
     * @author Kazi Aouel Sid Ahmed <kazi.sidou.94@gmail.com>
     * @return void
     **/
    public function AddLinesQuotation(Request $req)
    {
        $quotation = Devis::find($req->quot_id);

        // add new total
        $quotation->total = $req->total;
        $quotation->save();


        // add new acts to the plan
        $ligne = json_decode($req->lignes, true);

        $ids = $this->storeLinesQuotation($ligne, $quotation->id, "En cours");

        $tooth[] = collect($ligne)->map(function ($e) {
            return $e['num_dent'];
        });

        // get quot lines and coords of acts by tooth
        // $lignes = DB::table('lignedevis')
        //     ->join('formules', 'lignedevis.formule_id', 'formules.id')
        //     ->whereIn('lignedevis.id', $ids)
        //     ->get();

        $lignes = LigneDevis::with('coord', 'act')->whereIn('id', $ids)->get();
        return response()->json($lignes, 201);
    }


    /**
     * store lines to databasz
     *
     * 
     *
     * @param Type $var Description
     * @return Array id ID's of the new lines in quotation
     * @throws conditon
     **/
    public function storeLinesQuotation($lines, $quot_id, $state)
    {
        $coords = [];
        foreach ($lines  as $ligne) {
            $ids[] = LigneDevis::create([
                'devis_id'  => $quot_id,
                'num_dent'  => $ligne['num_dent'],
                'acte_id'   => $ligne['act_id'],
                'formule_id'   => $this->getFormuleID($ligne['act_id'], $ligne['num_dent']),
                'price'     => $ligne['prix'],
                'state'     => $state,
            ])->id;
        }

        return $ids;
    }

    private function getFormuleID($act_id, $num_dent)
    {
        $formule = Formule::where('acte_id', $act_id)->where('teeth', $num_dent)->first();
        return $formule->id;
    }
    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    private function createPayment($total_paid, $quot_id)
    {
        return Versement::create([
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
     * Create Payement by Plan
     *
     * @param Request $request
     * @return Response
     * @author Kazi Aouel Sidou
     **/
    public function createPayementByDevis(Request $request)
    {

        try {
            if ($request->total_paid != 0)
                $this->createPayment($request->total_paid, $request->devis_id);
        } catch (\Throwable $th) {
            return response()->json($th, 500);
        }


        return response()->json("success", 201);
    }

    /**
     * Update the state of the ligne Devis
     *
     * @param [array] $value
     * @author Kazi Aouel Sid Ahmed <kazi.sidou.94@gmail.com>
     * @return LigneDevis
     */
    public function updateTable($value)
    {
        return LigneDevis::where('id', $value['id'])
            ->update([
                'state' => $value['state'],
                'lock'  => $value['state'] == "Fait" ? 'true' : 'false',  // lock i.e on UI can't change state to "En cours"
            ]);
    }

    public function updateLigne($state, $ligne_id)
    {
        $arr = [
            'id' => $ligne_id,
            'state' => $state
        ];

        $this->updateTable($arr);

        return response()->json("done", 200);
    }

    protected function getSumPayments($quot_id)
    {
        return Devis::with('crediteur')->find($quot_id);
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
