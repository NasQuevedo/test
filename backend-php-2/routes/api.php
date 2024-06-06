<?php

use App\Http\Controllers\Api\V1\EmployeeController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(EmployeeController::class)->group(function() {
    Route::get('/employees', 'index');
    Route::post('/employee/create', 'store');
    Route::put('/employee/update/{employee}', 'update');
    Route::get('/employee/{employee}', 'show');
    Route::delete('/employee/delete/{employee}', 'destroy');
});

