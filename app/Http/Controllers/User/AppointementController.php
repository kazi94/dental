<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Requests\StorePatient;
use Illuminate\Database\Query\Builder;
use App\Models\Patient;
use DB;
use Auth;


class AppointementController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // public function search() {
    //     $terme  = $_POST['phrase'];
    //      return $result = DB::table('patients')->where('nom' ,'LIKE' , '%'.$terme.'%')->orWhere('prenom' , 'LIKE' ,'%'.$terme.'%')->get();
    //     // $result = DB::table('patients')->where('nom' ,'LIKE' , '%'.$terme.'%')->orWhere('prenom' , 'LIKE' ,'%'.$terme.'%')->get();
    //     // foreach ($result as $val) {
    //     //     $result = array(
    //     //         'patient' => $val,
    //     //         'website-link' => '/patient/'.$val->id.'/edit'
    //     //     );
    //     // }

    //     // return response()->json($result);

    // }  

    public function index()
    {

        // if (Auth::user()->cant('patients.view')) return redirect()->back();
        
        // $patients = Patient::all();

        return view('appoint.appointement');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // if (Auth::user()->cant('patients.create')) return redirect()->back();
        
        //$pathologies = Pathologie::all();
        
        return view('patient.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StorePatient $request)
    // {

        // $patient                      = new Patient;
        // if($request->hasFile('photo')){
        //     $photo = $request->file('photo');
        //     $filename = time().'.'.$photo->getClientOriginalExtension();
        //     Image::make($photo)->resize(300,300)->save(public_path('/avatar/'.$filename));
        //     $patient->photo = $filename;
            
        // }
        // $patient->num_securite_sociale= $request->num_securite_sociale;
        // $patient->code_national       = $request->code_nationale;
        // $patient->owned_by            = $request->owned_by;
        // $patient->groupe_sanguin      = $request->groupe_sanguin;
        // $patient->nom                 = ucfirst($request->nom);
        // $patient->prenom              = ucfirst($request->prenom);
        // $patient->date_naissance      = $request->date_naissance;
        // $patient->num_dossier         = $request->num_dossier;
        // $patient->taille              = $request->taille;
        // $patient->adresse             = $request->adresse;
        // $patient->ville               = $request->ville;
        // $patient->commune             = $request->commune;
        // $patient->situation_familliale= $request->situation_familliale;
        // $patient->nbre_enfants        = $request->nbre_enfants;
        // $patient->travaille           = $request->travaille;
        // $patient->sexe                = $request->sexe;
        // if($request->sexe == "F"){
        //     $patient->etat                = $request->etat;
        // }
        // $patient->tabagiste           = $request->tabagiste;
        // $patient->tabagiste_depuis    = $request->tabagiste_depuis;
        // $patient->alcoolique          = $request->alcoolique;
        // $patient->alcoolique_depuis   = $request->alcoolique_depuis;
        // $patient->drogue              = $request->drogué;
        // $patient->drogue_depuis       = $request->drogué_depuis;
        // $patient->num_tel_1           = $request->num_tel_1;
        // $patient->num_tel_2           = $request->num_tel_2;
        // $patient->created_by          = $request->user()->id;
        // $patient->details             = $request->détails;
        // $patient->p_tierce            = $request->p_tierce;
        // $patient->famille_antecedants = $request->famille_antecedants;
        // $patient->save();


        // //associate patient with pathologies
        // $patient->pathologies()->sync($request->pathologies);

        // //associate patient with allergie
        // $patient->allergies()->sync($request->allergies);

        // $patient->operations()->sync($request->operations);
        // // for ($i=0; $i < count($request->pathologies); $i++) { // attach patient_id to pathologie_id in intermediate table
        // //     $patient->pathologies()->attach($request->pathologies[$i]);
        // // }
        // // for ($i=0; $i < count($request->allergies); $i++) { // attach patient_id to allergie_id in intermediate table
        // //     $patient->allergies()->attach($request->allergies[$i]);
        // // }


        // //$hospitalisation->hospitalisations()->associate($patient);

        // return redirect(route('patient.edit',$patient->id)); //or to back back()->withInput();
    // }
    /**
     * store request fields
     *
     * @return view
     * @author 
     **/
    public function store(Request $request)
    {
        return redirect(route('patient.edit' , '1'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

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
        // if (Auth::user()->cant('patients.update')) return redirect()->back();
    
        // $patient = Patient::with('interventions','interventionsValide','pathologies','allergies','hospi','bilans'
        //     ,'consultations','questionnaires','traitements.lignes','autos.lignes','tmp_traitements','tmp_autos','phytos','educations','prescriptions.lignes','prescriptionsRetroInvalide.lignes','prescriptionsRisque.lignes','operations')->find($id);
        // $elements = Element::all();

                                      
        // $bilans = DB::table('elements')->select('bilan')->distinct()->get();
        // $Hospitalisation = Hospitalisation::all();
        // //get all traitement patient
        // $traitement  = Traitement::where('patient_id',$patient->id)->get();
        // //récupérer formule de calcule sc
        // $formule = FormuleSC::where('confirmed',1)->pluck('formule')->first();

        // $annotations = DB::table('users')->join('annotations','users.id','=','annotations.user_id')
        //                                  ->where('pat_id',$id)
        //                                  ->get();
        // $questionnaires = Questionnaire::all();
        // return view('patient.edit1',compact('patient','elements','bilans','Hospitalisation','traitement','annotations','formule','questionnaires'));
        return view('patient.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author __KaziWhite**__SALAF4_WebDev**.
     */
    // public function update(StorePatient $request, $id)

    // {
        // $patient =Patient::find($id);
        // $compte = DB::table('comptes')->where('patient_id','=',$id)->first();        
        // if($request->hasFile('photo')){
        //     $photo = $request->file('photo');
        //     $filename = time().'.'.$photo->getClientOriginalExtension();
        //     Image::make($photo)->resize(300,300)->save(public_path('/avatar/'.$filename));
        //     $patient->photo = $filename;
            
        // }
        // $patient->num_securite_sociale= $request->num_securite_sociale;
        // $patient->code_national       = $request->code_nationale;
        // $patient->owned_by            = $request->owned_by;
        // $patient->groupe_sanguin      = $request->groupe_sanguin;
        // $patient->nom                 = $request->nom;
        // $patient->prenom              = $request->prenom;
        // $patient->date_naissance      = $request->date_naissance;
        // $patient->num_dossier         = $request->num_dossier;
        // $patient->taille              = $request->taille;
        // $patient->adresse             = $request->adresse;
        // $patient->ville               = $request->ville;
        // $patient->commune             = $request->commune;
        // $patient->situation_familliale= $request->situation_familliale;
        // $patient->nbre_enfants        = $request->nbre_enfants;
        // $patient->travaille           = $request->travaille;
        // $patient->sexe                = $request->sexe;
        // if($request->sexe == "F"){
        // $patient->etat                = $request->etat;
        // }
        // $patient->tabagiste           = $request->tabagiste;
        // $patient->tabagiste_depuis    = $request->tabagiste_depuis;
        // $patient->alcoolique          = $request->alcoolique;
        // $patient->alcoolique_depuis   = $request->alcoolique_depuis;
        // $patient->drogue              = $request->drogué;
        // $patient->drogue_depuis       = $request->drogué_depuis;
        // if($compte != null){
        //     DB::table('comptes')->where('patient_id','=',$id)->update(['tel' => $request->num_tel_1]);
        // }
        // $patient->num_tel_1           = $request->num_tel_1;
        // $patient->num_tel_2           = $request->num_tel_2;
        // $patient->updated_by          = $request->user()->id;
        // $patient->updated_at          = now();
        // $patient->details             = $request->détails;
        // $patient->p_tierce            = $request->p_tierce;
        // $patient->poids               = $request->poids;
        // $patient->famille_antecedants = $request->famille_antecedants;
        // $patient->save();


        // //$hospitalisation->hospitalisations()->associate($patient);
        // $patient->pathologies()->sync($request->pathologies);
        // $patient->allergies()->sync($request->allergies);
        // $patient->operations()->sync($request->operations);

        // return redirect(route('patient.edit',$patient->id))->with('message' , 'Profile patient modifié avec succés !'); //or to back back()->withInput();
    // }
}