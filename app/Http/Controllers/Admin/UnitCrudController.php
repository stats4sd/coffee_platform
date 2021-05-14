<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use App\Models\Year;
use App\Models\UnitType;
use App\Http\Requests\UnitRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UnitCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UnitCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {store as traitStore;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation {update as traitUpdate;}
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Unit::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/unit');
        CRUD::setEntityNameStrings('unit', 'units');
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('unit');
        CRUD::column('unitType')->type('relationship')->label('Unit measures...');
        CRUD::column('conversion_rate');
        CRUD::column('unitType')->key('unitTypeStandard')->type('relationship')->attribute('standard_unit')->label('Standard unit');
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(UnitRequest::class);


        $unit = 'of this unit';
        $standardUnit = 'of the standard unit';



        CRUD::field('unit')->label('What is the unit called?');
        CRUD::field('unit_type_id')
        ->entity('unitType')
        ->model(UnitType::class)
        ->multiple(false)
        ->type('relationship')
        ->attribute('name_with_unit')
        ->label("What does this unit measure?")
        ->ajax([
            'minimum_input_length' => 0,

        ])
        ->inline_create([
            'entity' => 'unittype',
            'modal_route' => route('unittype-inline-create'),
            'create_route' => route('unittype-inline-create-save'), //manually specifying these as by default it will try 'unit-type' instead of 'unittype' (which doesn't exist). Seems like a bug in how inline create routes are created.
        ]);

        CRUD::field('tab-text')->type('custom_html')->value('<b>Complete ONE of the tabs below, depending on the unit type.</b>');


        CRUD::field('conversion-text')->type('custom_html')
        ->value("<h5>Conversion Rate - Normal Unit Types</h5>
        <p>To correctly convert this unit into the standard unit defined for this type of measurement, please enter ONE of the following:</p>
        ")->tab('Normal Unit Types');

        CRUD::field('to_standard')->label("How many of this unit equals 1 of the standard unit (selected above)?")
        ->type('number')
        ->prefix("1 of this unit equals... ")
        ->suffix("of the standard unit")->tab('Normal Unit Types');
        ;
        CRUD::field("from_standard")->label("How many of the standard units equals 1 of this unit?")
        ->type("number")
        ->prefix("1 of the standard unit equals... ")
        ->suffix("of this unit")->tab('Normal Unit Types');
        ;

        CRUD::field('conversion-year-text')->type('custom_html')
        ->value('<h5>For Currency Only - Year-by-year conversion rates</h5>
        <p>For a currency unit, please enter the conversion rate for each year needed in the platform.</p>
        ')->tab('Types Split By Year');
        ;

        CRUD::field('conversion_years')->type('table')
        ->columns([
            'to_standard' => '1 of this unit equals X of the standard unit',
            'year' => 'Year (YYYY)',
        ])->tab('Types Split By Year');
        ;
    }

    /**
     * Define what happens when the Update operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
        CRUD::field('script-only')->type('tab-chooser');
    }

    public function store()
    {
        $response = $this->traitStore();

        if (request()->conversion_years) {
            $this->handleYears(request());
        }

        return $response;
    }


    public function update()
    {
        $response = $this->traitUpdate();

        if (request()->conversion_years) {
            $this->handleYears(request());
        }

        return $response;
    }

    public function handleYears($request)
    {
        //remove existing entries
        $unit = Unit::find(request()->id);

        if ($unit->years) {
            $unit->years()->detach($unit->years->pluck('id')->toArray());
        }


        $years = json_decode($request->conversion_years);

        //add new entries
        foreach ($years as $year) {
            $yearDb = Year::where('year', $year->year)->first();
            $yearDb->units()->attach(request()->id, ['to_standard' => $year->to_standard]);
        }
    }



    public function fetchUnitType()
    {
        return $this->fetch(UnitType::class);
    }
}
