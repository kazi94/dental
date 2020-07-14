<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\Ordonnancetype;

class OrdonnanceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ordonnances = Ordonnancetype::with('medicaments')->get();

        foreach ($ordonnances as $val) {
            $this->implodeMedicaments($val);
        }
        return response()->json($ordonnances , 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.profile.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $ordonnance = new Ordonnancetype;
        $ordonnance->nom       = ucfirst($request->nom);
        $ordonnance->save();

        $medicaments = collect($request->medicaments)->map(function($antecedent){
            return $antecedent['SP_CODE_SQ_PK'];
        });
        //associate ordonnance with medicaments
        $ordonnance->medicaments()->sync($medicaments);

        $this->implodeMedicaments($ordonnance);

        return response()->json($ordonnance , 200);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
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
     */
    public function update(Request $request, $id)
    {
        $ordonnance = Ordonnancetype::find($id);
        $ordonnance->nom       = ucfirst($request->nom);
        $ordonnance->save();

        $medicaments =collect($request->medicaments)->map(function($e){
            return $e['SP_CODE_SQ_PK'];
        });

        $ordonnance->medicaments()->sync($medicaments);

        $ordonnance = Ordonnancetype::with('medicaments')->find($id);

        $this->implodeMedicaments($ordonnance);

        return response()->json( $ordonnance, 200);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         Ordonnancetype::where('id',$id)->delete();

        return response()->json( [] , 200);
    }

    protected function implodeMedicaments($ordonnance){
        $ordonnance['imploded'] = implode(',', array_map(function($v){
            return $v['SP_NOM'] ;
        },$ordonnance['medicaments']->toArray()));
    }
}
