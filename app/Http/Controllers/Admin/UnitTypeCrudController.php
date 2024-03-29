<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UnitTypeRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class UnitTypeCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class UnitTypeCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use InlineCreateOperation;


    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\UnitType::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/unittype');
        CRUD::setEntityNameStrings(t('unit-types'), t('unit-types'));
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->query->withCount('units');

        CRUD::column('name')
            ->label(t('Name'));
        CRUD::column('standardUnit')
            ->type('relationship')
            ->label(t('Standard Unit'));
        CRUD::column('units_count')
            ->type('text')
            ->label(t('Number of units'));
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(UnitTypeRequest::class);

        CRUD::field('name')
            ->type('text')
            ->label(t('What is the unit type? (e.g. length, area, volume, time...)'));
        CRUD::field('standardUnit')
            ->type('relationship')
            ->label(t('What is the standard unit for this type?'));
        CRUD::field('split_by_year')
            ->type('checkbox')
            ->label(t('If this unit type has a different conversion rate each year, tick this box.'))
            ->hint(t('This is likely only currency'));
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
}
