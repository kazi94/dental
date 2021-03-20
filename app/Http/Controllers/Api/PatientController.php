<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Requests\StorePatient;
use Illuminate\Database\Query\Builder;
use App\Models\Patient;
use App\Models\Pathologie;
use App\Models\Antecedent;
use DB;
use Auth;
use Storage;


class PatientController extends Controller
{

    public function index()
    {

        // if (Auth::user()->cant('patients.view')) return redirect()->back();

        $patients = Patient::all();
        $patients = $patients->map(function ($item) {
            $item->date_naissance = intval(date('Y/m/d', strtotime("now"))) - intval(date('Y/m/d', strtotime($item->date_naissance)));
            return $item;
        });

        return response()->json($patients);
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
     * store request fields
     *
     * @return view
     * @author 
     **/
    public function store(Request $request)
    {
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = $this->getPatient($id);

        $pathologies = DB::table('pathologie_patient')->join('pathologies', 'pathologies.id', 'pathologie_patient.pathologie_id')->where('patient_id', $id)->get();
        $antecedents = DB::table('antecedent_patient')->join('antecedents', 'antecedents.id', 'antecedent_patient.antecedent_id')->where('patient_id', $id)->get();

        $patient->pathologies = $pathologies;
        $patient->antecedents = $antecedents;

        return response()->json($patient, 200);
    }

    /**
     * Show the patient profile , and his folder : 
     * auto , traitement , medical , biological analysis , phyto  *...etc
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
     * @author __KaziWhite**__SALAF4_WebDev**.
     */
    public function update(Request $request, $id)

    {
        $patient = Patient::find($id);
        $patient->nom                 = ucfirst($request->nom);
        $patient->prenom              = ucfirst($request->prenom);
        $patient->date_naissance      = $request->date_naissance;
        $patient->age                 = $request->date_naissance ? intval(date('Y/m/d', strtotime("now"))) - intval(date('Y/m/d', strtotime($patient->date_naissance))) : '0';
        $patient->profession          = $request->profession;
        $patient->adresse             = $request->adresse;
        $patient->sexe                = $request->sexe;
        $patient->fumeur              = $request->fumeur ? 'Oui' : 'Non';
        $patient->medecin_externe     = $request->medecin_externe;
        $patient->updated_by          = $request->user()->id;
        $patient->updated_at          = now();
        $patient->save();

        $pathologies = collect($request->pathologies)->map(function ($e) {
            return $e['id'];
        });
        $antecedents = collect($request->antecedents)->map(function ($e) {
            return $e['id'];
        });
        $patient->pathologies()->sync($pathologies);
        $patient->antecedents()->sync($antecedents);

        $patient = $this->getPatient($patient->id);

        return response()->json([
            'patient' => $patient,
            'success' => 'Patient modifier avec succés!'
        ]);
    }
    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function destroy($id)
    {
        $deleted =  Patient::where('id', $id)->delete();

        return $deleted ?  response()->json(['success' => 'Patient supprimé avec succés!'], 200) : 'Erreur dans la suppression';
    }


    private function getPatient($id)
    {
        return Patient::with(
            'prescriptions',
            'antecedents',
            'radios',
            'pathologies',
            'lastSchema.lastQuotation.lines.act',
            'lastSchema.lastQuotation.lines.coord',
            'lastSchema.lastQuotation.crediteur',
            'lastSchema.lastQuotation.lastPayment',
            'initialSchema.traitements'
        )->find($id);
    }
}
