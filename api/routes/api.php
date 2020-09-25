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
//
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Rotas da operadora:
Route::get(		'/operadora/payload', 			'App\Http\Controllers\OperadoraController@getPayload'		);
Route::get(		'/operadora', 					'App\Http\Controllers\OperadoraController@getAll'			);
Route::get(		'/operadora/{id}', 				'App\Http\Controllers\OperadoraController@get'				);
Route::post(	'/operadora', 					'App\Http\Controllers\OperadoraController@post'				);
Route::put(		'/operadora/deactivate', 		'App\Http\Controllers\OperadoraController@deactivateMany'	);
Route::put(		'/operadora/{id}', 				'App\Http\Controllers\OperadoraController@put'				);
Route::put(		'/operadora/{id}/deactivate', 	'App\Http\Controllers\OperadoraController@deactivate'		);
Route::delete(	'/operadora/delete', 			'App\Http\Controllers\OperadoraController@deleteMany'		);
Route::delete(	'/operadora/{id}', 				'App\Http\Controllers\OperadoraController@delete'			);


//Rotas do tipo de operadoras
Route::get(		'/tipo_operadora/payload', 		'App\Http\Controllers\TipoOperadoraController@getPayload'	);
Route::get(		'/tipo_operadora', 				'App\Http\Controllers\TipoOperadoraController@getAll'		);
Route::get(		'/tipo_operadora/{id}', 		'App\Http\Controllers\TipoOperadoraController@get'			);
Route::post(	'/tipo_operadora', 				'App\Http\Controllers\TipoOperadoraController@post'			);
Route::put(		'/tipo_operadora/{id}', 		'App\Http\Controllers\TipoOperadoraController@put'			);
Route::delete(	'/tipo_operadora/{id}', 		'App\Http\Controllers\TipoOperadoraController@delete'		);
