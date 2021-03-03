<?php

use App\Http\Controllers\IndicatorValueController;
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

Route::view('/', 'home')->name('home');
Route::view('partners', 'partners')->name('partners');
Route::view('reports', 'reports')->name('reports');
Route::view('indicators', 'indicators')->name('indicators');


Route::get('indicators/search', [IndicatorValueController::class, 'index'])->name('indicators.search');
