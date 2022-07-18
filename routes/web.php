<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route:/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

//  require __DIR__.'/auth.php';
################################# Auth User ###############################

////test email/////

//Route::get('send-mail','Email\TestEmailController@sendEmail');



Route::group(['namespace' => 'Users'], function () {

  //###################### bigin root ###########################
    Route::get('/','VendorController@index')->name('user.vendors');
   //###################### end root ############################

   //##################### bagin user-auth ######################
    Route::get('login', 'VendorLoginController@getLogin')->name('get.user.login');
 
    Route::post('getlogin', 'VendorLoginController@Login')->name('user.login');
 
    Route::post('logout', 'VendorLoginController@logout')->name('user.logout');

    Route::resource('user', 'VendorController', [
      'names' => [
         'create' => 'user.vendors.create',
         'store' => 'user.vendors.store',
         'edit' => 'user.vendors.edit',
         'update' => 'user.vendors.update',
         'destroy' => 'user.vendors.delete',
         ] 
       ]);
       //##################### end user-auth ######################
       
        //##################### bagin pharmcy ######################
       Route::resource('pharmacy', 'MyPharmacyController', [
        'names' => [
          'index' => 'user.pharmacy',
           'create' => 'user.pharmacy.create',
           'store' => 'user.pharmacy.store',
           'edit' => 'user.pharmacy.edit',
           'update' => 'user.pharmacy.update',
           'show'=>'user.pharmacy.show',
           'destroy' => 'user.pharmacy.delete',       
           ] 
         ]);
             
        //##################### end pharmcy ######################


        //##################### bagin medication ######################
       Route::get('medication/create_exists','MedicationController@createExste')->name('user.medication.crete.exists');  
       Route::post('medication/store_exists','MedicationController@storeExists')->name('user.medication.store.exists'); 
       Route::resource('medication', 'MedicationController', [
          'names' => [
          'index' => 'user.medication',
           'create' => 'user.medication.create',
           'store' => 'user.medication.store',
           'edit' => 'user.medication.edit',
           'update' => 'user.medication.update',
           'destroy' => 'user.medication.delete',       
           ] 
         ]);
         Route::any('get_medications','MedicationController@loadMedication')->name('load_medications');
             
        //##################### end medication ######################

    
        //##################### bagin allter native ######################
        Route::get('allter_native/create_exists','AllterNativeController@createExste')->name('user.allter_native.crete.exists');  
        Route::post('allter_native/store_exists','AllterNativeController@storeExists')->name('user.allter_native.store.exists'); 
        Route::resource('allter_native', 'AllterNativeController', [
          'names' => [
          'index' => 'user.allter_native',
           'create' => 'user.allter_native.create',
           'store' => 'user.allter_native.store',
           'edit' => 'user.allter_native.edit',
           'show'=> 'user.allter_native.show',
           'update' => 'user.allter_native.update',
           'destroy' => 'user.allter_native.delete',       
           ] 
         ]);
         Route::any('get_allterNative','AllterNativeController@loadeAllterNative')->name('load_allterNative');

       //##################### end allter native ######################
 });

