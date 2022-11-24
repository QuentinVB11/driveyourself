<?php

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

use App\Http\Controllers\PathController;
use App\Models\Path;


Route::get('/path', [ PathController::class, 'pagePaths' ]);
Route::get('/path/type/{id}', [ Path::class, 'getPathByType' ]);
Route::get('/path/center/{id}', [ Path::class, 'getPathByCenter' ]);
Route::get('/path/duration/{time}', [ Path::class, 'getPathByDuration' ]);
Route::get('/path/distance/{distance}', [ Path::class, 'getPathByDistance' ]);
Route::get('/path/level/{level}', [ Path::class, 'getPathByLevel' ]);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
