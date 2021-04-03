<?php

Auth::routes();



Route::get('/', function () {
    if (Auth::user()) return redirect('acceuil');
    else return view('auth.login');
});

Route::resource('/acceuil', 'HomeController', ['names' => 'home']);
Route::get('test', 'HomeController@index')->name('name');

/*//*******************ADMINISTRATION MODULE//*******************::*/
Route::prefix('/admin')->namespace('Admin')->middleware(['auth'])->group(function () {
    Route::get('role/get-roles', 'RoleController@getRoles');
    Route::resource('role', 'RoleController');
    Route::get('reglages/general', 'SettingController@getSettings');
    Route::resource('reglages', 'SettingController', ['names' => 'setting']);
    Route::resource('user', 'UserController');
    Route::get('ordonnance-type/get-ordonnances-type', 'OrdonnanceTypeController@getOrdonnancesType');
    Route::resource('ordonnance-type', 'OrdonnanceTypeController');
    Route::get('act/get_categories', 'ActController@getCategories');
    Route::get('act/get_acts', 'ActController@getActs');
    Route::resource('act', 'ActController');
    Route::resource('category', 'CategoryController');
});
/*//*******************END ADMINISTRATION MODULE//*******************::*/



Route::middleware(['auth'])->namespace('User')->group(function () {

    //*******************APPOINTEMENT MODULE*******************************
    Route::resource('/rendez-vous', 'AppointementController', ['names' => 'appointement']);
    // Route::post('/appointement/storePatient', 'AppointementController@storePatient')->middleware('auth');
    //*******************END APPOINTEMENT MODULE*******************************

    //*******************PATIENT MANAGEMENT MODULE//*******************::
    // Patient routes
    Route::resource('/patients', 'PatientController');
    // Radiographie routes
    Route::resource('/patients/radiographies', 'RadiographieController');

    // Utilities routes
    Route::get('pathologies', 'PatientController@getPathologies');
    Route::get('antecedents', 'PatientController@getAntecedents');

    // Prescription routes
    Route::resource('/patients/prescription', 'PrescriptionController');
    Route::get('/patients/prescription/{id}/print', 'PrescriptionController@print');

    // Quotation routes
    Route::post('/patients/devis/add-acts', 'DevisController@AddLinesQuotation');
    Route::get('/patients/devis/update-ligne/{state}&&{ligne_id}', 'DevisController@updateLigne');
    Route::post('/patients/devis/create-payement-by-devis', 'DevisController@createPayementByDevis');
    Route::resource('/patients/devis', 'DevisController');

    // Dental schema routes
    Route::get('/patients/acts/get-coords/act_id={act_id}&&teeth={teeth}', 'SchemaDentaireController@getCoordsByAct');
    Route::get('/patients/schema-dentaire/get-coords/{teeth}&&formules={formulas}', 'SchemaDentaireController@getCoords');
    Route::delete('/patients/schema-dentaire/remove_tooth/{toothToRemove}', 'SchemaDentaireController@removeTooth');
    Route::get('/patients/schema-dentaire/{id}/teeth/{teeth}/get-formulas', 'SchemaDentaireController@getFormulasOfTeeth');
    Route::resource('/patients/schema-dentaire', 'SchemaDentaireController');

    // Line Plan routes
    Route::post('/api/patients/plan/lines/{id}', 'LinePlanController@updatePrice');

    // Drugs routes
    Route::get('/medicament/{query}', 'MedicamentController@search');
    // Route::post('/medicamentDci','MedicamentController@getMedicamentDci');

    //*******************END PATIENT MANAGEMENT MODULE//*******************::

    Route::resource('ordonnances', 'PrescriptionController', ['names' => 'prescriptions']);
    Route::resource('honoraires', 'PaymentController', ['names' => 'payments']);
});
Route::middleware(['auth'])->namespace('Api')->group(function () {
    Route::get(
        '/api/prescriptions',
        'PrescriptionController@index'
    );
    Route::delete('/api/prescriptions/{prescription}', 'PrescriptionController@destroy');
    Route::get(
        '/api/payments',
        'PaymentController@index'
    );
    Route::delete('/api/payments/{payment}', 'PaymentController@destroy');
});

// Route::post('bugs_report', 'ReportController@reportBug')->name('report_bug');
