<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\Builder;
use App\Models\Patient;
use App\Models\Category;
use App\Models\Appointement;
use Auth;
use DB;

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

    // }  

    public function index()
    {

        // if (Auth::user()->cant('patients.view')) return redirect()->back();
        
        $users = \App\User::all();

        return view('appoint.appointement' , compact('users'));
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
     * Store a newly created resource in storage from Calendar.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response 
     */
    public function store(Request $request)
    {
        $d = json_decode($request->category);
        $request['start_date'] = $request->date_rdv." ".$request->start_date;
        $request['end_date']   = $request->date_rdv." ".$request->end_date;
        $request->request->add(['created_by' =>  Auth::user()->id]);
        $request->request->add(['color' =>  $d->color]);
        $request->request->add(['category_id' =>  $d->key]);

        $appoint = Appointement::create($request->all());

        return response()->json($appoint , 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response To calendar
     */
    public function show($id)
    {
        if ($id != 'null'){
            $appointements = Appointement::where('created_by',$id)->get();

        }
        else
            // $appointements = Appointement::where('created_by',Auth::id())->get();
            $appointements = Appointement::with('patient' , 'category' , 'assignTo' , 'createdBy')->get();

        //Returned Format should be : { value : '' , label : ''}
        $patients = Patient::select('id as value',DB::raw("CONCAT(nom, ' ',prenom) as label"))->get();


        $categories = Category::select('id as value',"name as label" , "color")->get();

        $users = \App\User::select('id as value',DB::raw("CONCAT(name, ' ',prenom) as label"))
        // ->where('id' , '!=' , Auth::id())
        ->get();

        return response()->json([
            "data"        => $appointements,
            "collections" => [
              "type" => $patients,
              "categories" => $categories ,// add to list of lightbox
              "users" => $users 
            ]
        ]); 
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
       $event             = Appointement::find($id);
       $event->text       = strip_tags($request->text);
       $event->patient_id = $request->patient_id;
       $event->start_date = $request->start_date;
       $event->end_date   = $request->end_date;
       $event->updated_by = Auth::id();
       $event->assign_to  = $request->assign_to;
       $event->save();
 
       return response()->json([
           "action"=> "updated"
       ]);
    }


   public function destroy($id){
       $event = Appointement::find($id);
       $event->delete();
 
       return response()->json([
           "action"=> "deleted"
       ]);
   }    
}