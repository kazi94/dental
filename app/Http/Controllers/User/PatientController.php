<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Requests\StorePatient;
use Illuminate\Database\Query\Builder;
use App\Models\Patient;
use App\Models\Radio;
use App\Models\Pathologie;
use App\Models\Antecedent;
use DB;
use Auth;
use Storage;


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
        
        $patients = Patient::all();
        $patients = $patients->map(function($item){
            $item->date_naissance = intval(date('Y/m/d' ,strtotime("now")))- intval(date('Y/m/d',strtotime($item->date_naissance)));
            return $item;
        });
        $pathologies = $this->getPathologies();
        $antecedents = $this->getAntecedents();

        return view('patient.show',compact('pathologies', 'antecedents', 'patients'));
    }
    public function getPatients()
    {

        // if (Auth::user()->cant('patients.view')) return redirect()->back();
        
        $patients = Patient::all();
        $patients = $patients->map(function($item){
            $item->date_naissance = intval(date('Y/m/d' ,strtotime("now")))- intval(date('Y/m/d',strtotime($item->date_naissance)));
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
        // if (Auth::user()->cant('patients.create')) return redirect()->back();
        
        //$pathologies = Pathologie::all();
        
        return view('patient.create');

    }

    /**
     * store request fields
     *
     * @return view
     * @author 
     **/
    public function store(Request $request)
   {
        $patient                      = new Patient;
        $patient->nom                 = ucfirst($request->nom);
        $patient->prenom              = ucfirst($request->prenom);
        $patient->date_naissance      = $request->date_naissance;
        $patient->age                 = $request->date_naissance ? intval(date('Y/m/d' ,strtotime("now")))- intval(date('Y/m/d',strtotime($patient->date_naissance))) : '0';
        $patient->profession          = $request->profession;
        $patient->adresse             = $request->adresse;
        $patient->sexe                = $request->sexe;
        $patient->fumeur              = $request->fumeur ;
        $patient->medecin_externe     = $request->medecin_externe;
        $patient->created_by          = $request->user()->id;
        $patient->save();

        $pathologies = collect($request->pathologies)->map(function($pathologie){
            return $pathologie['id'];
        });
        //associate patient with pathologies
        $patient->pathologies()->sync($pathologies);

        $antecedents = collect($request->antecedents)->map(function($antecedent){
            return $antecedent['id'];
        });
        //associate patient with allergie
        $patient->antecedents()->sync($antecedents);

        $patient = $this->getPatient($patient->id); 

        // return response()->json([
        //     'patient' => $patient,
        //     'success' => 'Patient ajouté avec succés!'
        // ]);
        $pathologies = DB::table('pathologie_patient')->join('pathologies','pathologies.id','pathologie_patient.pathologie_id')->where('patient_id',$id)->get();
        $antecedents = DB::table('antecedent_patient')->join('antecedents','antecedents.id','antecedent_patient.antecedent_id')->where('patient_id',$id)->get();

        $patient->pathologies = $pathologies;
        $patient->antecedents = $antecedents;

        $pats = $this->getPathologies();
        $ant =  $this->getAntecedents();


        return view('patient.edit' , compact ('patient' , 'pats' , 'ant'));
    }

    public function getPathologies()
    {
        return DB::table('pathologies')->get();
    } 
    public function getAntecedents()
    {
        return DB::table('antecedents')->get();
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

        $pathologies = DB::table('pathologie_patient')->join('pathologies','pathologies.id','pathologie_patient.pathologie_id')->where('patient_id',$id)->get();
        $antecedents = DB::table('antecedent_patient')->join('antecedents','antecedents.id','antecedent_patient.antecedent_id')->where('patient_id',$id)->get();

        $patient->pathologies = $pathologies;
        $patient->antecedents = $antecedents;

        return response()->json($patient , 200);
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
        $patient = $this->getPatient($id);

        $pathologies = DB::table('pathologie_patient')->join('pathologies','pathologies.id','pathologie_patient.pathologie_id')->where('patient_id',$id)->get();
        $antecedents = DB::table('antecedent_patient')->join('antecedents','antecedents.id','antecedent_patient.antecedent_id')->where('patient_id',$id)->get();

        $patient->pathologies = $pathologies;
        $patient->antecedents = $antecedents;

        $pats = $this->getPathologies();
        $ant =  $this->getAntecedents();

        return view('patient.edit' , compact('patient' , 'pats' , 'ant') );
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
        $patient =Patient::find($id);
        $patient->nom                 = ucfirst($request->nom);
        $patient->prenom              = ucfirst($request->prenom);
        $patient->date_naissance      = $request->date_naissance;
        $patient->age                 = $request->date_naissance ? intval(date('Y/m/d' ,strtotime("now")))- intval(date('Y/m/d',strtotime($patient->date_naissance))) : '0';
        $patient->profession          = $request->profession;
        $patient->adresse             = $request->adresse;
        $patient->sexe                = $request->sexe;
        $patient->fumeur              = $request->fumeur ? 'Oui' : 'Non';
        $patient->medecin_externe     = $request->medecin_externe;
        $patient->updated_by          = $request->user()->id;
        $patient->updated_at          = now();
        $patient->save();

        $pathologies =collect($request->pathologies)->map(function($e){
            return $e['id'];
        });
        $antecedents =collect($request->antecedents)->map(function($e){
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
     * post Radiographie file
     *
     * @return void
     * @author 
     */
    public function postFile(Request $request)
    {
        $uploadedFile = $request->file('file');
        $patient_id = $request->id;
        $this->validate($request , [
            'file' => 'image'
        ]);
        // Handle file upload
        if ($request->hasFile('file')){

            $fileNameToStore = '/img/radios/'.time().'.jpeg';
            $path = $request->file('file')->store('/im9mmmg/radio/');
            $upload = new Radio;
            $upload->img_url    = $fileNameToStore;
            $upload->patient_id = $patient_id;
            $upload->created_by = $request->user()->id;
            $upload->save();
        } 
        else 
            return response()->json([] , 200);
        
        //$path = $uploadedFile->store('public');//store file in public storage folder
        //if (Storage::mimeType($path) == 'image/png' || Storage::mimeType($path) == 'image/jpeg')// Stocker tout les format des images à une seul et unique extension
          //  $uploadedFile->move(public_path().'/img/radios', time().'.jpeg');    



      return response()->json($upload , 200); 
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function destroy($id)
    {
        $deleted =  Patient::where('id',$id)->delete();

        return $deleted ?  response()->json(['success' => 'Patient supprimé avec succés!'] , 200) : 'Erreur dans la suppression';
    }


    private function getPatient($id) {
        return Patient::with(
            'antecedents',
            'pathologies' ,
            'lastSchema.lastQuotation.lines.act',
            'lastSchema.lastQuotation.crediteur',
            'lastSchema.lastQuotation.lastPayment'
            )->find($id);
    }


}