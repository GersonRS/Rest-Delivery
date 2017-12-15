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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:api')->namespace('Api')->group(function () {
    Route::namespace('v1')->group(function () {
        Route::get('authenticated', 'ApiUserController@index')
            ->name('authenticated');
        Route::get('cupom/{code}', 'ApiCupomsController@show');
        Route::get('categories/by-company/{id}', 'ApiCategoryController@listByCompany')
            ->name('categoryByCompany');
        Route::resource('companies',
            'ApiCompanyController', [
                'except' => ['create', 'edit', 'destroy','update', 'store']
            ]);
        Route::resource('order',
            'ApiOrderController', [
                'except' => ['create', 'edit', 'destroy','update']
            ]);
        Route::resource('client',
            'ApiClientsController', [
                'except' => ['edit', 'destroy','update']
            ]);
    });
});