<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Role;
use App\Models\Cabinet;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json( User::with('role')->get() , 200 );


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();

        return view ('admin.user.create',compact('roles'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = new User;
        $user->name       = ucfirst($request->name);
        $user->prenom     = ucfirst($request->prenom);
        $user->email      = $request->email;
        $user->profession = $request->profession;
        $user->role_id    = $request->role;
        $user->cabinet_id = Auth::user()->cabinet_id;
        $user->password   = bcrypt($request->password);
        $user->save();

        return response()->json($user , 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        $roles = Role::all();

        return view ('admin.user.edit',compact('user','roles'));
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

        $user = User::find($id);

        $user->name       = ucfirst($request->name);
        $user->prenom     = ucfirst($request->prenom);
        $user->email      = $request->email;
        $user->profession = $request->profession;
        $user->role_id    = $request->role;
        $user->save();

        return response()->json($user , 200);

        return redirect(route('user.index'))->with('message' , 'Utilisateur Modifier avec succées !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::where('id',$id)->delete();

        return response()->json( [] , 200);
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */

}
