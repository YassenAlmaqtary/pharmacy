<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;




Route::group(['namespace' => 'Admin','middleware' => 'auth:admin'], function () {

   Route::get('/', 'DashboardController@index')->name('admin.dashboard');


   #################### start categrys  #################################

Route::group(['prefix' => 'categorys'], function () {

   Route::resource('category','CategoryController', [
     'names' => [
         'index' => 'admin.categorys',
         'create' => 'admin.categorys.create',
         'store' => 'admin.categorys.store',
         'edit' => 'admin.categorys.edit',
         'update' => 'admin.categorys.update',
         'destroy' => 'admin.categorys.delete',
      ]

   ]);
});


 #################### end categrys  #################################




 

});






################################# Auth Admin ###############################


Route::group(['namespace' => 'Admin'], function () {

   Route::get('login', 'LoginController@getLogin')->name('get.admin.login');

   Route::post('getlogin', 'LoginController@Login')->name('admin.login');

   Route::post('logout', 'LoginController@logout')->name('admin.logout');
});

############################ end Auth Admin  #################


 




