<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\IndicatorRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class IndicatorCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class IndicatorCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Indicator::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/indicator');
        CRUD::setEntityNameStrings('indicator', 'indicators');
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
                'name' => 'sub_characteristic',
            ],
            [
                'name' => 'code',
                'type' => 'text',
                'label' => 'Code'
            ],
            [
                'name' => 'definition',
                'type' => 'text',
                'label' => 'Definition'
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
        CRUD::setValidation(IndicatorRequest::class);

        $this->crud->addFields([
            [
                'type' => 'relationship',
                'name' => 'sub_characteristic_id',
                'attribute' => "name", 
                'entity' => 'sub_characteristic',
                'model' => "App\Models\SubCharacteristic",
            ],
            [
                'name' => 'code',
                'type' => 'text',
                'label' => 'Code'
            ],
            [
                'name' => 'definition',
                'type' => 'text',
                'label' => 'Definition'
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
}
