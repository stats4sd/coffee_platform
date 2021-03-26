<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GeoBoundaryRequest;
use App\Models\Country;
use App\Models\Department;
use App\Models\Region;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use PHPUnit\Framework\Constraint\Count;

/**
 * Class GeoBoundaryCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class GeoBoundaryCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\GeoBoundary::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/geo_boundary');
        CRUD::setEntityNameStrings('geo boundary', 'geo boundaries');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'type' => 'relationship',
                'name' => 'country',
            ],
            [
                'type' => 'relationship',
                'name' => 'region',
            ],
            [
                'type' => 'relationship',
                'name' => 'department',
            ],
            [
                'name' => 'description',
                'type' => 'text',
                'label' => 'Description'
            ],
            [
                'name' => 'altitude',
                'type' => 'number',
                'label' => 'altitude'
            ]
        ]);
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(GeoBoundaryRequest::class);

        $this->crud->addFields([
            [
                'type' => 'relationship',
                'name' => 'country_id',
                'ajax' => true,
                'inline_create' => [ 'entity' => 'country' ],
                'minimum_input_length' => 0,
                'label' => 'Select the country for this geo boundary',
                'hint' => 'If the country is not in the dropdown select the <b>+Add</b> to add a new one.',
            ],
            [
                'type' => 'relationship',
                'name' => 'region_id',
                'ajax' => true,
                'inline_create' => [ 'entity' => 'region' ],
                'minimum_input_length' => 0,
                'label' => 'Select the region for this geo boundary',
                'hint' => 'If the region is not in the dropdown select the <b>+Add</b> to add a new one.',
            ],
            [
                'type' => 'relationship',
                'name' => 'department_id',
                'ajax' => true,
                'inline_create' => [ 'entity' => 'department' ],
                'minimum_input_length' => 0,
                'label' => 'Select the department for this geo boundary',
                'hint' => 'If the department is not in the dropdown select the <b>+Add</b> to add a new one.',
            ],
            [
                'name' => 'description',
                'type' => 'text',
                'label' => 'Description'
            ],
            [
                'name' => 'altitude',
                'type' => 'number',
                'label' => 'Altitude'
            ]
        ]);
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

    public function fetchCountry()
    {
        return $this->fetch(Country::class);
    }

    public function fetchRegion()
    {
        return $this->fetch(Region::class);
    }

    public function fetchDepartment()
    {
        return $this->fetch(Department::class);
    }
}
