<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\DynamicController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('store/user',[UserController::class,'storeUser']);
Route::get('employee/list',[EmployeeController::class,'allEmployeeGet']);


Route::get('/get-districts/{id}',[AjaxController::class,'getDistrictsByID']);
Route::post('/insert-division',[AjaxController::class,'insertDivision']);

Route::post('insert_dynamic',[DynamicController::class,'insertDynamic']);
