<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('characteristic', 'CharacteristicCrudController');
    Route::crud('subcharacteristic', 'SubCharacteristicCrudController');
    Route::crud('indicator', 'IndicatorCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('indicatorvalue', 'IndicatorValueCrudController');
    Route::crud('unit', 'UnitCrudController');
    Route::crud('gender', 'GenderCrudController');
    Route::crud('smallholderdefinition', 'SmallholderDefinitionCrudController');
    Route::crud('purposeofcollection', 'PurposeOfCollectionCrudController');
    Route::crud('approachcollection', 'ApproachCollectionCrudController');
    Route::crud('country', 'CountryCrudController');
    Route::crud('geoboundary', 'GeoBoundaryCrudController');
    Route::crud('source', 'SourceCrudController');
    Route::crud('type', 'TypeCrudController');
    Route::crud('partner', 'PartnerCrudController');
}); // this should be the absolute last line of this file