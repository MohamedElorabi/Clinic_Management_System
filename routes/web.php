<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




// Authentication Routes
Auth::routes();
Route::get('/', 'HomeController@index')->name('home');


Route::middleware(['auth'])->group(function() {

// Admis
Route::resource('admins', 'UserController');
// Patients
Route::get('/reveals/details/{id}', 'PatientController@details')->name('details');
Route::resource('patients', 'PatientController');

// Reveals
Route::get('/reveals/get-data-reveal/{id}', 'RevealController@getData');
Route::post('/reveals/create-Diagnosis', 'RevealController@createDiagnosis')->name('reveals.create-Diagnosis');
Route::get('/reveals/search', 'RevealController@search');
Route::get('reveals/finished/{id}', 'RevealController@isFinished')->name('reveals.finished');
Route::resource('reveals', 'RevealController');

// Reservations
Route::get('/reservations/search', 'ReservationsController@search');
Route::post('reservations/add-to-reveals', 'ReservationsController@toReveal')->name('add-to-reveals');
Route::delete('/delte_imge', 'RevealController@trash_img');
Route::resource('reservations', 'ReservationsController');
// End Reservations

// Records
Route::get('/record/reveal/details/{id}', 'RecordsController@record_details')->name('record_details');
Route::resource('records', 'RecordsController');
// End Records


});
