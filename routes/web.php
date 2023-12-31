<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\UserController;
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

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/create', [UserController::class, 'create'])
    ->name('createUser')
    ->middleware('can:admin');
Route::post('/users', [UserController::class, 'store']);
Route::get('/change-password', [UserController::class, 'changePassword'])
    ->name('changePassword')
    ->middleware('auth');
Route::post('/change-password', [UserController::class, 'changePasswordSave'])
    ->name('changePasswordSave')
    ->middleware('auth');
Route::get('/users/{user}', [UserController::class, 'show']);

Route::get('/services', [ServiceController::class, 'index']);

Route::get('/users/{user}/reservations', [ReservationController::class, 'index'])
    ->name('users.reservations');
Route::get('/reservations/create', [ReservationController::class, 'create'])
    ->name('reservation.create');
Route::post('/reservations', [ReservationController::class, 'store']);
Route::get('/reservations/{reservation}/edit', [ReservationController::class, 'edit'])
    ->name('reservations.edit')
    ->middleware('auth');
Route::patch('/reservations/{reservation}', [ReservationController::class, 'update'])
    ->middleware('auth');
Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])
    ->name('reservations.destroy')
    ->middleware('auth');
Route::get('/reservations/my-reservations', [ReservationController::class, 'myReservations'])
    ->name('reservations.myReservations')
    ->middleware('auth');

Route::get('/login', [SessionsController::class, 'create']);
Route::post('/login', [SessionsController::class, 'store']);
Route::get('/logout', [SessionsController::class, 'destroy']);

Route::get('/register', [RegisterController::class, 'create'])
    ->middleware('guest');
Route::post('/register', [RegisterController::class, 'store'])
    ->middleware('guest');

Route::get('/reservations/feedback/{reservation}/create', [FeedbackController::class, 'create'])
    ->name('reservations.feedback');
Route::post('/reservations/feedback', [FeedbackController::class, 'store']);

