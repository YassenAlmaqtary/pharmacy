<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

  require __DIR__.'/auth.php';

################################# Auth User ###############################


Route::group(['namespace' => 'Users'], function () {

  //###################### bigin root ###########################
  //Route::get('/','VendorController@index')->name('user.vendors');
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
    
 });




 

 

 
 

