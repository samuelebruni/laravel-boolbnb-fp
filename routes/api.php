<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ApartmentController;
use App\Http\Controllers\API\ServiceController;
use App\Models\Apartment;
use App\Http\Controllers\API\LeadController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Apartment
Route::post('apartments', [ApartmentController::class, 'index']);
Route::get('apartment/{id}', [ApartmentController::class, 'getApartmentById']);

//Services
Route::get('service', [ServiceController::class, 'index']);

//Mail
Route::post('/contacts', [LeadController::class, 'store']);
