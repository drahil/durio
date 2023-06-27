<?php

use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\WorkerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', fn() => view('welcome'));

Route::get('/workers', [WorkerController::class, 'index']);
Route::get('/services', [ServiceController::class, 'index']);

Route::get('/workers/{worker}/reservations', [ReservationController::class, 'show'])->name('workers.reservations');



