<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix'=>'medications','namespace' => 'Api'],function () {
  
    Route::get('medication',"MedicationController@getMedicationWithPharmce");
    Route::get('medication-withe-category',"MedicationController@getMedicationWithCategory");
    Route::get('categorys',"MedicationController@getAllCategorys");


});

