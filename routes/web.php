<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\IncidentController;

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

Route::get('/', function () {
    return view('login');
});


Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::post('/login', [LoginController::class, 'login'])->name('login.submit');

Route::get('/incidents', [IncidentController::class, 'index'])->name('incidents');
Route::get('/incident/create', [IncidentController::class, 'create'])->name('incident.create');
Route::post('/incident/store', [IncidentController::class, 'store'])->name('incident.store');
Route::get('show/incident/{id}', [IncidentController::class, 'show'])->name('incident.show');

Route::get('edit/incident/{id}', [IncidentController::class, 'edit'])->name('incident.edit');

Route::post('update/incident/{id}', [IncidentController::class, 'update'])->name('incident.update');

Route::get('delete/incident/{id}', [IncidentController::class, 'destroy'])->name('incident.delete');


Route::get('/forgot-password', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('/forgot-password', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');


