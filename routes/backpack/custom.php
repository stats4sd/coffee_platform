<?php

use App\Http\Controllers\Admin\CharacteristicCrudController;
use App\Http\Controllers\Admin\SubCharacteristicCrudController;
use App\Http\Controllers\Admin\IndicatorCrudController;
use App\Http\Controllers\Admin\UserCrudController;
use App\Http\Controllers\Admin\IndicatorValueCrudController;
use App\Http\Controllers\Admin\UnitCrudController;
use App\Http\Controllers\Admin\GenderCrudController;
use App\Http\Controllers\Admin\SmallholderDefinitionCrudController;
use App\Http\Controllers\Admin\PurposeOfCollectionCrudController;
use App\Http\Controllers\Admin\ApproachCollectionCrudController;
use App\Http\Controllers\Admin\CountryCrudController;
use App\Http\Controllers\Admin\GeoBoundaryCrudController;
use App\Http\Controllers\Admin\SourceCrudController;
use App\Http\Controllers\Admin\TypeCrudController;
use App\Http\Controllers\Admin\PartnerCrudController;
use App\Http\Controllers\Admin\UnitTypeCrudController;
use App\Http\Controllers\Admin\RegionCrudController;
use App\Http\Controllers\Admin\DepartmentCrudController;
use App\Http\Controllers\Admin\YearCrudController;
use App\Http\Controllers\Admin\MunicipalityCrudController;
use App\Http\Controllers\Admin\ScopeCrudController;
use App\Http\Controllers\Admin\GroupCrudController;

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::prefix(config('backpack.base.route_prefix', 'admin'))->middleware(array_merge(
    (array) config('backpack.base.web_middleware', 'web'),
    ['set.locale'],
    (array) config('backpack.base.middleware_key', 'admin'),
))->group(function () { // custom admin routes

    Route::crud('characteristic', CharacteristicCrudController::class);
    Route::crud('sub_characteristic', SubCharacteristicCrudController::class);
    Route::crud('indicator', IndicatorCrudController::class);
    Route::crud('user', UserCrudController::class);
    Route::crud('indicator_value', IndicatorValueCrudController::class);
    Route::crud('unit', UnitCrudController::class);
    Route::crud('gender', GenderCrudController::class);
    Route::crud('smallholder_definition', SmallholderDefinitionCrudController::class);
    Route::crud('purpose_of_collection', PurposeOfCollectionCrudController::class);
    Route::crud('approach_collection', ApproachCollectionCrudController::class);
    Route::crud('country', CountryCrudController::class);
    Route::crud('geo_boundary', GeoBoundaryCrudController::class);
    Route::crud('source', SourceCrudController::class);
    Route::crud('type', TypeCrudController::class);
    Route::crud('partner', PartnerCrudController::class);
    Route::crud('unittype', UnitTypeCrudController::class);
    Route::crud('region', RegionCrudController::class);
    Route::crud('department', DepartmentCrudController::class);
    Route::crud('year', YearCrudController::class);
    Route::crud('municipality', MunicipalityCrudController::class);
    Route::crud('scope', ScopeCrudController::class);
    Route::crud('group', GroupCrudController::class);

});
