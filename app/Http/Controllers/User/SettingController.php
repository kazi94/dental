<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
//use App\Http\Requests\StorePatient;
use Illuminate\Database\Query\Builder;
use DB;
use Auth;
use Storage;
use App\Models\Cabinet;


class SettingController extends Controller
{

    public function __construct() {
        $this->middleware('auth');

        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {

        return view('admin.settings.show');
    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function getSettings()
    {
        return response()->json(Cabinet::first());
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
        $cabinet = Cabinet::first();

        if ($cabinet) 
           return response()->json($this->editCabinet($cabinet ,$request) , 200); 

        $cabinet = new Cabinet;
        $cabinet->nom     = $request->nom;
        $cabinet->adresse = $request->adresse;
        if ($request->file('logo') != null) 
        {
            $uploadedFile = $request->file('logo');
            $path = $uploadedFile->store('public');//store file in public storage folder
            if (Storage::mimeType($path) == 'image/png' || Storage::mimeType($path) == 'image/jpeg')// Stocker tout les format des images à une seul et unique extension
                $uploadedFile->move(public_path().'/img/', time().'.jpeg'); 
            $cabinet->logo = '/img/'.time().'.jpeg';    
        }        
        $cabinet->save();

      return response()->json( $cabinet->logo , 200); 
    }

    private function editCabinet($cabinet , $req)
    {

        if ($req->file('logo') != null) 
        {
            $uploadedFile = $req->file('logo');
            $path = $uploadedFile->store('public');//store file in public storage folder
            if (Storage::mimeType($path) == 'image/png' || Storage::mimeType($path) == 'image/jpeg')// Stocker tout les format des images à une seul et unique extension
                $uploadedFile->move(public_path().'/img/', time().'.jpeg'); 
            $cabinet->logo = '/img/'.time().'.jpeg';    
        }

        $cabinet->nom = $req->nom;
        $cabinet->adresse = $req->adresse;
        $cabinet->save();

        return $cabinet->logo;
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

    }

    /**
     * undocumented function
     *
     * @return void
     * @author 
     **/
    public function destroy($id)
    {

    }



}