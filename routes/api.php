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
/* Departments Routes */
Route::get('/departments', 'App\Http\Controllers\Api\DepartmentsController@getAllDepartments');
Route::get('/departments/{id}', 'App\Http\Controllers\Api\DepartmentsController@getDepartment');
Route::post('/departments', 'App\Http\Controllers\Api\DepartmentsController@createDepartment');
Route::put('/departments/{id}', 'App\Http\Controllers\Api\DepartmentsController@updateDepartment');
Route::delete('/departments/{id}','App\Http\Controllers\Api\DepartmentsController@deleteDepartment');
/* Jobs Routes */
Route::get('/jobs',        'App\Http\Controllers\Api\JobsController@getAllJobs');
Route::get('/jobs/{id}',   'App\Http\Controllers\Api\JobsController@getJob');
Route::post('/jobs',       'App\Http\Controllers\Api\JobsController@createJob');
Route::put('/jobs/{id}',   'App\Http\Controllers\Api\JobsController@updateJob');
Route::delete('/jobs/{id}','App\Http\Controllers\Api\JobsController@deleteJob');
