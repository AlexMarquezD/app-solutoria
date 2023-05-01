<?php

use App\Http\Controllers as controllers;
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

Route::get('/', [controllers\HomeController::class, 'viewHome'])->name('/');
Route::get('/insert', [controllers\InsertController::class, 'viewInsert'])->name('insert.index');

Route::get('/filter/{date_init}/{date_end}', [controllers\IndicatorController::class, 'filter'])->name('indicator.filter');
Route::group(['prefix' => 'api'], function () {
    Route::resource('indicators', controllers\IndicatorController::class);
});