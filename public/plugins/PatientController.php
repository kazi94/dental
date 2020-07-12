<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePatient;
use Illuminate\Database\Query\Builder;
use App\Models\Patient;
use App\Models\Pathologie;
use App\Models\Operation_chirugicale;
use App\Models\Allergie;
use App\Models\Bilan;
use App\Models\Hospitalisation;
use App\Models\Questionnaire;
use App\Models\Element;
use App\Models\Poid;
use App\Models\Ligneprescription;
use DB;
use Auth;
use Image;
use App\ModelsChimio\Traitement;
use App\ModelsChimio\Cure;
use App\ModelsChimio\FormuleSC;

class PatientController extends Controller
{

    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function search() {
        $terme  = $_POST['phrase'];
         return $result = DB::table('patients')->where('nom' ,'LIKE' , '%'.$terme.'%')->orWhere('prenom' , 'LIKE' ,'%'.$terme.'%')->get();
        // $result = DB::table('patients')->where('nom' ,'LIKE' , '%'.$terme.'%')->orWhere('prenom' , 'LIKE' ,'%'.$terme.'%')->get();
        // foreach ($result as $val) {
        //     $result = array(
        //         'patient' => $val,
        //         'website-link' => '/patient/'.$val->id.'/edit'
        //     );
        // }

        // return response()->json($result);

    }  

    public function index()
    {

        if (Auth::user()->cant('patients.view')) return redirect()->back();
        
        $patients = Patient::with('hospi')->get();

        return view('user.patient.show',compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->cant('patients.create')) return redirect()->back();
        
        $pathologies = Pathologie::all();
        $allergies   = Allergie::all();
        $operations = Operation_chirugicale::all();

        return view ('user.patient.create',compact('pathologies','allergies','operations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePatient $request)
    {

        $patient                      = new Patient;
        if($request->hasFile('photo')){
            $photo = $request->file('photo');
            $filename = time().'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(300,300)->save(public_path('/avatar/'.$filename));
            $patient->photo = $filename;
            
        }
        $patient->num_securite_sociale= $request->num_securite_sociale;
        $patient->code_national       = $request->code_nationale;
        $patient->owned_by            = $request->owned_by;
        $patient->groupe_sanguin      = $request->groupe_sanguin;
        $patient->nom                 = ucfirst($request->nom);
        $patient->prenom              = ucfirst($request->prenom);
        $patient->date_naissance      = $request->date_naissance;
        $patient->num_dossier         = $request->num_dossier;
        $patient->taille              = $request->taille;
        $patient->adresse             = $request->adresse;
        $patient->ville               = $request->ville;
        $patient->commune             = $request->commune;
        $patient->situation_familliale= $request->situation_familliale;
        $patient->nbre_enfants        = $request->nbre_enfants;
        $patient->travaille           = $request->travaille;
        $patient->sexe                = $request->sexe;
        if($request->sexe == "F"){
            $patient->etat                = $request->etat;
        }
        $patient->tabagiste           = $request->tabagiste;
        $patient->tabagiste_depuis    = $request->tabagiste_depuis;
        $patient->alcoolique          = $request->alcoolique;
        $patient->alcoolique_depuis   = $request->alcoolique_depuis;
        $patient->drogue              = $request->drogué;
        $patient->drogue_depuis       = $request->drogué_depuis;
        $patient->num_tel_1           = $request->num_tel_1;
        $patient->num_tel_2           = $request->num_tel_2;
        $patient->created_by          = $request->user()->id;
        $patient->details             = $request->détails;
        $patient->p_tierce            = $request->p_tierce;
        $patient->famille_antecedants = $request->famille_antecedants;
        $patient->save();


        //associate patient with pathologies
        $patient->pathologies()->sync($request->pathologies);

        //associate patient with allergie
        $patient->allergies()->sync($request->allergies);

        $patient->operations()->sync($request->operations);
        // for ($i=0; $i < count($request->pathologies); $i++) { // attach patient_id to pathologie_id in intermediate table
        //     $patient->pathologies()->attach($request->pathologies[$i]);
        // }
        // for ($i=0; $i < count($request->allergies); $i++) { // attach patient_id to allergie_id in intermediate table
        //     $patient->allergies()->attach($request->allergies[$i]);
        // }


        //$hospitalisation->hospitalisations()->associate($patient);

        return redirect(route('patient.edit',$patient->id)); //or to back back()->withInput();
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
        if (Auth::user()->cant('patients.update')) return redirect()->back();
    
        $patient = Patient::with('interventions','interventionsValide','pathologies','allergies','hospi','bilans'
            ,'consultations','questionnaires','traitements.lignes','autos.lignes','tmp_traitements','tmp_autos','phytos','educations','prescriptions.lignes','prescriptionsRetroInvalide.lignes','prescriptionsRisque.lignes','operations')->find($id);
        $elements = Element::all();

                                      
        $bilans = DB::table('elements')->select('bilan')->distinct()->get();
        $Hospitalisation = Hospitalisation::all();
        //get all traitement patient
        $traitement  = Traitement::where('patient_id',$patient->id)->get();
        //récupérer formule de calcule sc
        $formule = FormuleSC::where('confirmed',1)->pluck('formule')->first();

        $annotations = DB::table('users')->join('annotations','users.id','=','annotations.user_id')
                                         ->where('pat_id',$id)
                                         ->get();
        $questionnaires = Questionnaire::all();
        return view('user.patient.edit1',compact('patient','elements','bilans','Hospitalisation','traitement','annotations','formule','questionnaires'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @author __KaziWhite**__SALAF4_WebDev**.
     */
    public function update(StorePatient $request, $id)

    {
        $patient =Patient::find($id);
        $compte = DB::table('comptes')->where('patient_id','=',$id)->first();        
        if($request->hasFile('photo')){
            $photo = $request->file('photo');
            $filename = time().'.'.$photo->getClientOriginalExtension();
            Image::make($photo)->resize(300,300)->save(public_path('/avatar/'.$filename));
            $patient->photo = $filename;
            
        }
        $patient->num_securite_sociale= $request->num_securite_sociale;
        $patient->code_national       = $request->code_nationale;
        $patient->owned_by            = $request->owned_by;
        $patient->groupe_sanguin      = $request->groupe_sanguin;
        $patient->nom                 = $request->nom;
        $patient->prenom              = $request->prenom;
        $patient->date_naissance      = $request->date_naissance;
        $patient->num_dossier         = $request->num_dossier;
        $patient->taille              = $request->taille;
        $patient->adresse             = $request->adresse;
        $patient->ville               = $request->ville;
        $patient->commune             = $request->commune;
        $patient->situation_familliale= $request->situation_familliale;
        $patient->nbre_enfants        = $request->nbre_enfants;
        $patient->travaille           = $request->travaille;
        $patient->sexe                = $request->sexe;
        if($request->sexe == "F"){
        $patient->etat                = $request->etat;
        }
        $patient->tabagiste           = $request->tabagiste;
        $patient->tabagiste_depuis    = $request->tabagiste_depuis;
        $patient->alcoolique          = $request->alcoolique;
        $patient->alcoolique_depuis   = $request->alcoolique_depuis;
        $patient->drogue              = $request->drogué;
        $patient->drogue_depuis       = $request->drogué_depuis;
        if($compte != null){
            DB::table('comptes')->where('patient_id','=',$id)->update(['tel' => $request->num_tel_1]);
        }
        $patient->num_tel_1           = $request->num_tel_1;
        $patient->num_tel_2           = $request->num_tel_2;
        $patient->updated_by          = $request->user()->id;
        $patient->updated_at          = now();
        $patient->details             = $request->détails;
        $patient->p_tierce            = $request->p_tierce;
        $patient->poids               = $request->poids;
        $patient->famille_antecedants = $request->famille_antecedants;
        $patient->save();


        //$hospitalisation->hospitalisations()->associate($patient);
        $patient->pathologies()->sync($request->pathologies);
        $patient->allergies()->sync($request->allergies);
        $patient->operations()->sync($request->operations);

        return redirect(route('patient.edit',$patient->id))->with('message' , 'Profile patient modifié avec succés !'); //or to back back()->withInput();
    }
    /**
     * Retourne la fiche de conciliation final à imprimé
     *
     * @return void
     * @author 
     **/
    public function print_conciliation(Request $request , $id)
    {
        
        
        $resul_trait = $resul_pres = $resul_auto = $lignes = array();

        // $patient = Patient::with('prescriptions.lignes','traitements.lignes','autos.lignes')->find($id);
        
        //resortir les prescriptions
        $pres = DB::select("
            select  LEFT(t3.catc_code_pk,1) as first, 
                    users.prenom as user_prenom ,users.name as user_name ,
                    users.hopital,users.service ,
                    patients.nom,patients.prenom,patients.date_naissance,patients.id as patient_id,
                    t1.*,
                    h.date_admission,h.date_sortie
            from 
                users , patients, hospitalisations as h ,
                prescriptions as t0,ligneprescriptions as t1,
                sp_specialite t2 , catc_classeatc t3
            where
                users.id           = patients.owned_by
            and patients.id        = t0.patient_id
            and patients.id        = h.patient_id
            and t0.id              = t1.prescription_id
            and t1.med_sp_id       = t2.sp_code_sq_pk
            and t2.sp_catc_code_fk = t3.catc_code_pk
            and t0.date_prescription in (
                select max(created_at) 
                            from prescriptions 
                                where patient_id = ?            
                                 and (etats ='prescription' 
                                        or etats = 'invalide')
                    )
            
            and patients.id = ?           
            and h.date_admission IN (
                SELECT MAX(date_admission)
                    FROM `hospitalisations`
                         WHERE `patient_id` = ?
                             GROUP BY `patient_id`)
            " , [$id,$id,$id]);

        foreach ($pres as $val) {
             $res  = DB::select('select * from catc_classeatc where catc_code_pk = ? ' , [$val->first]);
            $resul_pres [] = array_merge((array) $val , (array)$res[0]); 
        }

         $auto = DB::select("
            select  LEFT(t3.catc_code_pk,1) as first, 
                    users.prenom as user_prenom ,users.name as user_name ,
                    users.hopital,users.service ,
                    patients.nom,patients.prenom,patients.date_naissance,patients.id as patient_id,
                    t1.*,
                    h.date_admission,h.date_sortie
            from 
                users ,hospitalisations as h, patients, automedications as t0,
                ligneprescriptions as t1,
                sp_specialite t2 ,catc_classeatc t3
            where 
                users.id               = patients.owned_by
                and patients.id        = t0.patient_id
                and patients.id        = h.patient_id
                and t0.id              = t1.automedication_id
                and t1.med_sp_id       = t2.sp_code_sq_pk
                and t2.sp_catc_code_fk = t3.catc_code_pk
                and t0.patient_id      = ?            
                and h.date_admission IN (
                    SELECT MAX(date_admission)
                        FROM `hospitalisations`
                            WHERE `patient_id` =?
                                GROUP BY `patient_id`
                            )
                                             and t1.date_etats in( SELECT distinct(max(date_etats))
                            FROM `ligneprescriptions`  
                            group by med_sp_id) ",
             [$id,$id]);
        foreach ($auto as $val) {
             $res  = DB::select('select * from catc_classeatc where catc_code_pk = ? ' , [$val->first]);
            $resul_auto [] = array_merge((array) $val , (array)$res[0]);
         
        } 
        //resortir les traitement médicamenteux   
        $trait = DB::select("
            select  LEFT(t3.catc_code_pk,1) as first, 
                    users.prenom as user_prenom ,users.name as user_name ,users.hopital,users.service ,
                    patients.nom,patients.prenom,patients.date_naissance,patients.id as patient_id,
                    t1.*,
                    h.date_admission,h.date_sortie
            from 
                users , patients,hospitalisations as h, 
                traitementchroniques as t0,ligneprescriptions as t1,
                sp_specialite t2 , catc_classeatc t3
            where 
                users.id = patients.owned_by
                and patients.id = t0.patient_id
                and patients.id = h.patient_id
                and t0.id = t1.traitementchronique_id
                and t1.med_sp_id = t2.sp_code_sq_pk
                and t2.sp_catc_code_fk = t3.catc_code_pk
                and t1.etats = 'En cours'
                and t0.patient_id = ?
                and h.date_admission IN (
                    SELECT MAX(date_admission)
                        FROM `hospitalisations`
                            WHERE `patient_id` =?
                                GROUP BY `patient_id`)
                                                 and t1.date_etats in( SELECT distinct(max(date_etats))
                            FROM `ligneprescriptions`  
                            group by med_sp_id) "
                ,[$id,$id]);

        foreach ($trait as $val) {
             $res  = DB::select('select * from catc_classeatc where catc_code_pk = ? ' , [$val->first]);
            $resul_trait [] = array_merge((array) $val , (array)$res[0]);
         
        }
  
        $lignes= array_merge($resul_trait , $resul_pres , $resul_auto);

        usort($lignes, function ($item1, $item2) { // cette fonction permet de trier les table associatiove par clé choisi dans item
            return $item1['CATC_NOMF'] <=> $item2['CATC_NOMF'];
        });
        return view('user.patient.print.print_conciliation',compact('lignes'));

    }
    public function exit( $id) // Modifer Fiche de conciliation
    {
        $resul_trait = $resul_pres = $resul_auto = $lignes = array();

        // $patient = Patient::with('prescriptions.lignes','traitements.lignes','autos.lignes')->find($id);
        $pres = DB::select("
            select  LEFT(t3.catc_code_pk,1) as first, 
                    users.prenom as user_prenom ,users.name as user_name ,
                    users.hopital,users.service ,
                    patients.nom,patients.prenom,patients.date_naissance,patients.id as patient_id,
                    t1.*,
                    h.date_admission,h.date_sortie
            from 
                users , patients, hospitalisations as h ,
                prescriptions as t0,ligneprescriptions as t1,
                sp_specialite t2 , catc_classeatc t3
            where
                users.id           = patients.owned_by
            and patients.id        = t0.patient_id
            and patients.id        = h.patient_id
            and t0.id              = t1.prescription_id
            and t1.med_sp_id       = t2.sp_code_sq_pk
            and t2.sp_catc_code_fk = t3.catc_code_pk
            and t0.date_prescription in (
                select max(created_at) 
                            from prescriptions 
                                where patient_id = ?            
                                 and (etats ='prescription' 
                                        or etats = 'invalide')
                    )
            
            and patients.id = ?           
            and h.date_admission IN (
                SELECT MAX(date_admission)
                    FROM `hospitalisations`
                         WHERE `patient_id` = ?
                             GROUP BY `patient_id`)
            " , [$id,$id,$id]);
        foreach ($pres as $val) {
             $res  = DB::select('select * from catc_classeatc where catc_code_pk = ? ' , [$val->first]);
            $resul_pres [] = array_merge((array) $val , (array)$res[0]); 
        }

         $auto = DB::select("
            select  LEFT(t3.catc_code_pk,1) as first, 
                    users.prenom as user_prenom ,users.name as user_name ,
                    users.hopital,users.service ,
                    patients.nom,patients.prenom,patients.date_naissance,patients.id as patient_id,
                    t1.*,
                    h.date_admission,h.date_sortie
            from 
                users ,hospitalisations as h, patients, automedications as t0,
                ligneprescriptions as t1,
                sp_specialite t2 ,catc_classeatc t3
            where 
                users.id               = patients.owned_by
                and patients.id        = t0.patient_id
                and patients.id        = h.patient_id
                and t0.id              = t1.automedication_id
                and t1.med_sp_id       = t2.sp_code_sq_pk
                and t2.sp_catc_code_fk = t3.catc_code_pk
                and t0.patient_id      = ?            
                and h.date_admission IN (
                    SELECT MAX(date_admission)
                        FROM `hospitalisations`
                            WHERE `patient_id` =?
                                GROUP BY `patient_id`
                            )
                                             and t1.date_etats in( SELECT distinct(max(date_etats))
                            FROM `ligneprescriptions`  
                            group by med_sp_id) ",
             [$id,$id]);
        foreach ($auto as $val) {
             $res  = DB::select('select * from catc_classeatc where catc_code_pk = ? ' , [$val->first]);
            $resul_auto [] = array_merge((array) $val , (array)$res[0]);
         
        } 

        $trait = DB::select("
            select  LEFT(t3.catc_code_pk,1) as first, 
                    users.prenom as user_prenom ,users.name as user_name ,users.hopital,users.service ,
                    patients.nom,patients.prenom,patients.date_naissance,patients.id as patient_id,
                    t1.*,
                    h.date_admission,h.date_sortie
            from 
                users , patients,hospitalisations as h, 
                traitementchroniques as t0,ligneprescriptions as t1,
                sp_specialite t2 , catc_classeatc t3
            where 
                users.id = patients.owned_by
                and patients.id = t0.patient_id
                and patients.id = h.patient_id
                and t0.id = t1.traitementchronique_id
                and t1.med_sp_id = t2.sp_code_sq_pk
                and t2.sp_catc_code_fk = t3.catc_code_pk
                and t1.etats = 'En cours'
                and t0.patient_id = ?
                and h.date_admission IN (
                    SELECT MAX(date_admission)
                        FROM `hospitalisations`
                            WHERE `patient_id` =?
                                GROUP BY `patient_id`)
                                                 and t1.date_etats in( SELECT distinct(max(date_etats))
                            FROM `ligneprescriptions`  
                            group by med_sp_id) "
                ,[$id,$id]);  
        foreach ($trait as $val) {
             $res  = DB::select('select * from catc_classeatc where catc_code_pk = ? ' , [$val->first]);
            $resul_trait [] = array_merge((array) $val , (array)$res[0]);
         
        }    
        $lignes= array_merge($resul_trait , $resul_pres , $resul_auto);

        usort($lignes, function ($item1, $item2) { // cette fonction permet de trier les table associatiove par clé choisi dans item
            return $item1['CATC_NOMF'] <=> $item2['CATC_NOMF'];
        });

        if (count($lignes) == 0) return redirect()->back()->with('message' , "Inmpossible d'effectuer cette opération !");
        return view('user.patient.conciliation',compact('lignes'));
    }

    /**
     * return code , libdet of classe
     *
     * @return array
     * @author SidouWhiteSalaf
     **/

    protected function getDCIS($dci_code) 
    {
        $dci ="";

        $resultats = DB::table('cosac_compo_subact')
            ->join('sac_subactive as t0','t0.SAC_CODE_SQ_PK' , 'cosac_compo_subact.cosac_sac_code_fk_pk')
            ->select('t0.SAC_CODE_SQ_PK as code_dci')
            ->where('cosac_compo_subact.cosac_sp_code_fk_pk' , $dci_code)
            ->get();
        
        return $resultats;
    }

    protected function getClasse($dci)
    {
        $sql = "select cph_cph_code_fk        as cphpere,
            cph_code_pk            as code,
            cph_nom                as libdet
            from   cph_classepharmther    ,
            spcph_specialite_classeph
            where  cph_code_pk         = spcph_cph_code_fk_pk
            and    spcph_sp_code_fk_pk = ?
            order by cph_nom ";
        $result = DB::select($sql,[$dci]);

        $result = array('code' => 55 , 'libdet' => 'anatalgique');

        return $result;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //fetch row to delete
        Patient::where('id',$id)->delete();

        return redirect()->back()->with('message' ,'Patient supprimé avec succés !');
    }
    /**
     * return profile patient en format json à la requete ajax
     *
     * @return Patient
     * @author WhiteSalafiDev
     **/
    public function getPatient($id)
    {

        $patient = Patient::with('pathologies','allergies')->find($id);

        $pathologies = self::getPathologies(); 
        $allergies   = self::getAllergies(); 

        return response()->json([
            'patient'     => $patient,
            'pathologies' => $pathologies,
            'allergies'   => $allergies,
        ]);
    }
    /**
     * get Pathologies
     *
     * @return Pathologies
     * @author 
     **/
    protected function getPathologies()
    {
        return Pathologie::all();
    }
    /**
     * get Allergies
     *
     * @return Allergies
     * @author 
     **/
    protected function getAllergies()
    {
        return Allergie::all();  
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function intervenir($id , $pr_risque) 
    {

        $patient = Patient::with('questionnaires')->find($id);

        //Get all elements to display in bilogical analysis form
        $elements = Element::all();

        // $result = DB::table('questionnaires')->select(DB::raw('SUM(reponse) as reponse'),'date_questionnaire','question_id','user_id')
        //             ->where ('patient_id',$id)
        //             ->groupBy('date_questionnaire','patient_id')
        //             ->get();

        $bilans = DB::table('elements')->select('bilan')->distinct()->get();    
        $traitement = Traitement::where('patient_id',$patient->id)->get(); 
        $annotations = DB::table('annotations')->where('pat_id',$id)
        ->join('users','annotations.user_id','=','users.id')
        ->get();
        //récupérer formule de calcule sc
        $formule = FormuleSC::where('confirmed',1)->pluck('formule')->first();                  
        $questionnaires = Questionnaire::all();

        return view('user.patient.edit1',compact('patient','elements','bilans','result','pr_risque','traitement','formule','annotations','questionnaires'));
            
    }
}
       // $elements = Patient::find($id)->elements; // return all biological analysis associated with id patient
         /** return array of [
         //                {
         //                    'valeur' : '', 
         //                    'commentaire' : '' ,
         //                     'laboratoire': '' , 
         //                     'date_analyse': ''
         //                 },
         //                  {
         //                    'valeur' : '', 
         //                    'commentaire' : '' ,
         //                     'laboratoire': '' , 
         //                     'date_analyse': ''
         //                 },                                           
         //            ]
        **/
//          SELECT 
//     `p`.`id`,
//     `p`.`name`, 
//     `p`.`img`, 
//     `p`.`safe_name`, 
//     `p`.`sku`, 
//     `p`.`productstatusid` 
// FROM `products` p 
// WHERE `p`.`id` IN (
//     SELECT 
//         `product_id` 
//     FROM `product_category`
//     WHERE `category_id` IN ('223', '15')
// )
// AND `p`.`active`=1
// DB::table('users')
//     ->whereIn('id', function($query)
//     {
//         $query->select(DB::raw(1))
//               ->from('orders')
//               ->whereRaw('orders.user_id = users.id');
//     })
//     ->get();
// This will produce:

// select * from users where id in (
//     select 1 from orders where orders.user_id = users.id
// )