<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ScenariosController;
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

// Landing page
Route::get('/', [IndexController::class, 'index'])->name('index');

Route::post('/', [IndexController::class, 'sort_by'])->name('index');

// 'Scenario' page
Route::get('/scenario', function(){
    return view('scenarios.scenario');
})->name('scenario');

//Registeration page
Route::get('/register', [AuthController::class, 'register'] )->name('register')->middleware('guest');

Route::post('/register', [AuthController::class, 'store'] )->middleware('guest');

//Login page
Route::get('/login', [AuthController::class, 'login'] )->name('login')->middleware('guest');

Route::post('/login', [AuthController::class, 'authenticate'] )->middleware('guest');

//Logout
Route::get('/logout', [AuthController::class, 'logout'] )->middleware('auth');

//Dashboard
Route::get('/dashboard', [DashboardController::class, 'render'] )->middleware('auth')->name('dashboard');
