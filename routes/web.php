<?php

Auth::routes();



Route::get('/', function () {
    if(Auth::user()) return redirect('home');
    else return view('auth.login');
});

Route::resource('/home' , 'HomeController');

/*:::::::::::::::::::::ADMINISTRATION MODULE:::::::::::::::::::::::*/
Route::prefix('/admin')->group(function()
{
    Route::resource('user','Admin\UserController');   
    Route::resource('acte','User\ActeController')->middleware('auth');                                                       
    // Route::resource('profile','Admin\RoleController');                                                       

});
/*:::::::::::::::::::::END ADMINISTRATION MODULE:::::::::::::::::::::::*/

/*:::::::::::::::::::::PATIENT MANAGEMENT MODULE:::::::::::::::::::::::*/
 Route::resource('/patient','User\PatientController')->middleware('auth');
 
// Route::resource('/patient/prescription','User\PrescriptionController')->middleware('auth');
// Route::post('/medicament','User\MedicamentController@getMedicament')->middleware('auth');
// Route::post('/medicamentDci','User\MedicamentController@getMedicamentDci')->middleware('auth');
/*:::::::::::::::::::::END PATIENT MANAGEMENT MODULE:::::::::::::::::::::::*/

//*******************APPOINTEMENT MODULE*******************************
Route::resource('/appointement', 'User\AppointementController')->middleware('auth');
// Route::post('/appointement/storePatient', 'AppointementController@storePatient')->middleware('auth');
//*******************END APPOINTEMENT MODULE*******************************

// Route::post('bugs_report', 'ReportController@reportBug')->name('report_bug');

