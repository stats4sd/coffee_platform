<?php

use App\Http\Controllers\CharacteristicController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\IndicatorValueController;
use App\Http\Controllers\PurposeOfCollectionController;
use App\Http\Controllers\SubCharacteristicController;
use App\Http\Controllers\TypeController;
use App\Models\Characteristic;
use App\Models\PurposeOfCollection;
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
Route::post('indicators/download/', [IndicatorValueController::class, 'download'])->name('indicators.download');
Route::post('indicators/report', [IndicatorValueController::class, 'report'])->name('indicators.report');

Route::get('country', [CountryController::class, 'index'])->name('country.index');
Route::get('year', [IndicatorValueController::class, 'getYears'])->name('year.index');
Route::get('type', [TypeController::class, 'index'])->name('type.index');
Route::get('purposeofcollection', [PurposeOfCollectionController::class, 'index'])->name('purposeOfCollection.search');
Route::get('characteristic', [CharacteristicController::class, 'index'])->name('characteristic.index');
Route::get('subcharacteristic', [SubCharacteristicController::class, 'index'])->name('subcharacteristic.index');
