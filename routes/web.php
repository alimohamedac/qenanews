<?php

use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\NewsController;
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
//front
Route::get('/', [HomeController::class, 'index']);
Route::get('/news', [NewsController::class, 'index']);

//admin
Route::get('/admin', [\App\Http\Controllers\Admin\HomeController::class, 'index']);
