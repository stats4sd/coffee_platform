<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
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
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
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

        if (CRUD::getOperation() == 'update' && $id = CRUD::getCurrentEntryId()) {
            $entry = Unit::find($id);
            $unit = $entry->unit ?? 'of this unit';
            $standardUnit = $entry ? $entry->unitType->standard_unit : 'of the standard unit';
        }

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

        CRUD::field('conversion-text')->type('custom_html')
        ->value("<h5>Conversion Rate</h5>
        <p>To correctly convert {$unit} into {$standardUnit} defined for this type of measurement, please enter ONE of the following:</p>
        ");

        CRUD::field('to_standard')->label("How many {$unit} equals 1 {$standardUnit} (selected above)?")
        ->type('number')
        ->prefix("1 {$unit} equals... ")
        ->suffix("{$standardUnit}");
        CRUD::field("from_standard")->label("How many {$standardUnit}s equals 1 {$unit}?")
        ->type("number")
        ->prefix("1 {$standardUnit} equals... ")
        ->suffix("{$unit}");
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
    }

    public function fetchUnitType()
    {
        return $this->fetch(UnitType::class);
    }
}
