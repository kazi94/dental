<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Versement;
use Auth;

class PaymentController extends Controller
{
    /**
     * Return all payments of all users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return prescriptions created by the auth user
        return response()->json(Versement::with('createdTo', 'validatedPaymentBy')->get());
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
    public function destroy(Versement $payment)
    {
        return $payment->delete() ? response()->json(['success' => 'Règlement supprimée avec succés!'], 200) : 'Erreur dans la suppression';
    }
}
