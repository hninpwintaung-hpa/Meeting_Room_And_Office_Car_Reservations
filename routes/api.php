<?php

use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\CarReservationController;
use App\Http\Controllers\Api\RoomController;
use App\Http\Controllers\Api\RoomReservationController;
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
Route::apiResource('rooms', RoomController::class);
Route::apiResource('cars', CarController::class);
Route::apiResource('car_reservation', CarReservationController::class);
Route::apiResource('room_reservation', RoomReservationController::class);
Route::post('room_reservation/searchByDate', [RoomReservationController::class, 'searchByDate'])->name('room_reservation.searchByDate');

//Route::post('/auth/register', [AuthController::class, 'registerUser']);