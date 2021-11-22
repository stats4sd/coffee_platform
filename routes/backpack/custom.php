<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

    Route::group([
        'prefix' => config('backpack.base.route_prefix', 'admin'),
        'middleware' => array_merge(
            (array)config('backpack.base.web_middleware', 'web'),
            ['set.locale'],
            (array)config('backpack.base.middleware_key', 'admin'),
        ),
        'namespace' => 'App\Http\Controllers\Admin',
    ], function () { // custom admin routes
        Route::crud('characteristic', 'CharacteristicCrudController');
        Route::crud('sub_characteristic', 'SubCharacteristicCrudController');
        Route::crud('indicator', 'IndicatorCrudController');
        Route::crud('user', 'UserCrudController');
        Route::crud('indicator_value', 'IndicatorValueCrudController');
        Route::crud('unit', 'UnitCrudController');
        Route::crud('gender', 'GenderCrudController');
        Route::crud('smallholder_definition', 'SmallholderDefinitionCrudController');
        Route::crud('purpose_of_collection', 'PurposeOfCollectionCrudController');
        Route::crud('approach_collection', 'ApproachCollectionCrudController');
        Route::crud('country', 'CountryCrudController');
        Route::crud('geo_boundary', 'GeoBoundaryCrudController');
        Route::crud('source', 'SourceCrudController');
        Route::crud('type', 'TypeCrudController');
        Route::crud('partner', 'PartnerCrudController');
        Route::crud('unittype', 'UnitTypeCrudController');
        Route::crud('region', 'RegionCrudController');
        Route::crud('department', 'DepartmentCrudController');
        Route::crud('year', 'YearCrudController');
        Route::crud('municipality', 'MunicipalityCrudController');
        Route::crud('scope', 'ScopeCrudController');
        Route::crud('group', 'GroupCrudController');
    });
