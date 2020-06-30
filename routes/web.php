<?php

Auth::routes();



Route::get('/', function () {
    if(Auth::user()) return redirect('home');
    else return view('auth.login');
});

Route::resource('/home' , 'HomeController');
Route::get('test' , 'HomeController@index')->name('name');

/*:::::::::::::::::::::ADMINISTRATION MODULE:::::::::::::::::::::::*/
Route::prefix('/admin')->group(function()
{
 	Route::get('role/get-roles','Admin\RoleController@getRoles')->middleware('auth');
 	Route::resource('role','Admin\RoleController')->middleware('auth');
 	Route::get('reglages/general','Admin\SettingController@getSettings')->middleware('auth');
 	Route::resource('reglages','Admin\SettingController', ['names' => 'setting'])->middleware('auth');
    Route::resource('user','Admin\UserController')->middleware('auth');   
    Route::resource('ordonnance-type','Admin\OrdonnanceTypeController')->middleware('auth');   
    Route::get('act/get_acts', 'Admin\ActController@getActs')->middleware('auth');
    Route::resource('act','Admin\ActController')->middleware('auth');                                                       
    // Route::resource('profile','Admin\RoleController');                                                       

});
/*:::::::::::::::::::::END ADMINISTRATION MODULE:::::::::::::::::::::::*/

/*:::::::::::::::::::::PATIENT MANAGEMENT MODULE:::::::::::::::::::::::*/
 Route::resource('/patient','User\PatientController')->middleware('auth');
<<<<<<< HEAD
 Route::get('/patients','User\PatientController@getPatients')->middleware('auth');
 Route::post('/patient/radiographie','User\PatientController@postFile')->name('upload')->middleware('auth');
=======
 Route::post('/patient/radiographie','User\PatientController@postFile')->name('upload')->middleware('auth');
 Route::get('/patients','User\PatientController@getPatients')->middleware('auth');
>>>>>>> a3433d2ecbd535b1e67896b2cf4c7a16d59556b3
 Route::get('pathologies','User\PatientController@getPathologies')->middleware('auth');
 Route::get('antecedents','User\PatientController@getAntecedents')->middleware('auth');
 
Route::resource('/patient/prescription','User\PrescriptionController')->middleware('auth');
Route::post('/patient/devis/update_devis','User\DevisController@updateDevis')->middleware('auth');
Route::resource('/patient/devis','User\DevisController')->middleware('auth');
Route::delete('/patient/schema-dentaire/remove_tooth/{toothToRemove}','User\SchemaDentaireController@removeTooth')->middleware('auth');
Route::resource('/patient/schema-dentaire','User\SchemaDentaireController')->middleware('auth');
Route::get('/patient/prescription/{id}/print','User\PrescriptionController@print')->middleware('auth');
Route::get('/medicament/{query}','User\MedicamentController@search')->middleware('auth');
// Route::post('/medicamentDci','User\MedicamentController@getMedicamentDci')->middleware('auth');
/*:::::::::::::::::::::END PATIENT MANAGEMENT MODULE:::::::::::::::::::::::*/

//*******************APPOINTEMENT MODULE*******************************
Route::resource('/appointement', 'User\AppointementController')->middleware('auth');
// Route::post('/appointement/storePatient', 'AppointementController@storePatient')->middleware('auth');
//*******************END APPOINTEMENT MODULE*******************************

// Route::post('bugs_report', 'ReportController@reportBug')->name('report_bug');

