<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('emp',EmployeeController::class);
Route::get('getcountrycities',[EmployeeController::class,'getCountryCities'])->name('getCountryCities');

