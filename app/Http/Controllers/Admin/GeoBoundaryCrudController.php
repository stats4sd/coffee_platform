<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\GeoBoundaryRequest;
use App\Models\Country;
use App\Models\Department;
use App\Models\Municipality;
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
        CRUD::setEntityNameStrings(t('geo boundaries'), t('geo boundaries'));
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
                'label' => t('Country'),
            ],
            [
                'type' => 'relationship',
                'name' => 'region',
                'label' => t('Region'),

            ],
            [
                'type' => 'relationship',
                'name' => 'department',
                'label' => t('Department'),
            ],
            [
                'type' => 'relationship',
                'name' => 'municipality',
                'label' => t('Municipality'),
            ],
            [
                'name' => 'description',
                'type' => 'text',
                'label' => t('Description')
            ],
            [
                'name' => 'altitude',
                'type' => 'text',
                'label' => t('altitude')
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
                'label' => t('Country'),
                'hint' => t('If the country is not in the dropdown select <b>+Add</b> to add a new one.'),
            ],
            [
                'type' => 'relationship',
                'name' => 'region_id',
                'ajax' => true,
                'inline_create' => [ 'entity' => 'region' ],
                'minimum_input_length' => 0,
                'label' => t('Region'),
                'hint' => t('If the region is not in the dropdown select <b>+Add</b> to add a new one.'),
            ],
            [
                'type' => 'relationship',
                'name' => 'department_id',
                'ajax' => true,
                'inline_create' => [ 'entity' => 'department' ],
                'minimum_input_length' => 0,
                'label' => t('Department'),
                'hint' => t('If the department is not in the dropdown select <b>+Add</b> to add a new one.'),
            ],
            [
                'type' => 'relationship',
                'name' => 'municipality_id',
                'ajax' => true,
                'inline_create' => [ 'entity' => 'municipality' ],
                'minimum_input_length' => 0,
                'label' => t('Municipality'),
                'hint' => t('If the municipality is not in the dropdown select <b>+Add</b> to add a new one.'),
            ],
            [
                'name' => 'description',
                'type' => 'text',
                'label' => t('Description'),
            ],
            [
                'name' => 'altitude',
                'type' => 'text',
                'label' => t('Altitude'),
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

    public function fetchMuncipality()
    {
        return $this->fetch(Municipality::class);
    }
}
