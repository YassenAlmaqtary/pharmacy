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
    
 });

