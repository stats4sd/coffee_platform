<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\SubCharacteristicRequest;
use App\Models\Characteristic;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SubCharacteristicCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SubCharacteristicCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;


    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\SubCharacteristic::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/sub_characteristic');
        CRUD::setEntityNameStrings(t('sub characteristics'), t('sub characteristics'));
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
                'name' => 'characteristic',
                'label' => t('Characteristic'),
            ],
            [
                'name' => 'name',
                'type' => 'text',
                'label' => t('Name'),
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
        CRUD::setValidation(SubCharacteristicRequest::class);

        $this->crud->addFields([
            [
                'label'     => t("Characteristic"),
                'type'      => 'select',
                'name'      => 'characteristic_id',
                'entity'    => 'characteristic',
                'model'     => "App\Models\Characteristic",
                'attribute' => 'name',

            ],
            [
                'name' => 'name',
                'type' => 'text',
                'label' => t('Name'),
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
