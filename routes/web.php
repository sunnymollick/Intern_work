<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\DynamicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

// Auth Routes go here

Route::get('/',[AuthController::class,'index']);
Route::post('/login',[AuthController::class,'login'])->name('login');
Route::get('/logout',[AuthController::class,'logout'])->name('logout');


// Employee Routes Go Here
Route::group(['middleware' => 'checkloggedin'], function(){
	Route::get('/dashboard',[EmployeeController::class,'index']);
    Route::get('/create-employee',[EmployeeController::class,'createEmployee'])->name('employee.create');
    Route::post('/store-employee',[EmployeeController::class,'storeEmployee'])->name('employee.store');
    Route::get('/delete/employee/{id}',[EmployeeController::class,'deleteEmployee'])->name('employee.delete');
    Route::get('/edit/employee/{id}',[EmployeeController::class,'editEmployee'])->name('employee.edit');
    Route::post('/update/employee/{id}',[EmployeeController::class,'updateEmployee'])->name('employee.update');
    Route::get('/download/pdf/by/id/{id}',[EmployeeController::class,'downloadPdfById'])->name('downloadById.pdf');
});

Route::get('/ajax',[AjaxController::class,'index']);
Route::get('/dynamic',[DynamicController::class,'index']);
Route::get('/dynamic2',[DynamicController::class,'index2']);

Route::get('/user',[UserController::class,'index']);


Route::get('/ajax2',[AjaxController::class,'index2']);
