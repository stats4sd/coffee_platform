<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Operations\ImportOperation;
use App\Http\Requests\IndicatorRequest;
use App\Imports\IndicatorsSheetImport;
use App\Models\Characteristic;
use App\Models\SubCharacteristic;
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

    use ImportOperation;


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

        CRUD::set('import.importer', IndicatorsSheetImport::class);
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
                'name' => 'subCharacteristic.characteristic',
                'label' => 'Characteristic',
            ],
            [
                'type' => 'relationship',
                'name' => 'subCharacteristic',
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
                'type' => 'select2_from_ajax',
                'name' => 'characteristic_id',
                'attribute' => "name",
                'data_source' => backpack_url('indicator/fetch/characteristic'),
                'model' => Characteristic::class,
                'placeholder' => 'Select Characteristic',
                'minimum_input_length' => 0,
                'method' => 'post',
            ],
            [
                'type' => 'relationship',
                'name' => 'sub_characteristic_id',
                'attribute' => 'name',
                'entity' => 'subCharacteristic',
                'model' => "App\Models\SubCharacteristic",
                'ajax' => true,
                'minimum_input_length' => 0,
                'data_source' => backpack_url('indicator/fetch/sub-characteristic'),
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

    public function fetchCharacteristic()
    {
        return $this->fetch(Characteristic::class);
    }

    public function fetchSubCharacteristic()
    {
        $form = collect(request()->input('form'))->pluck('value', 'name');

        return $this->fetch([
            'model' => SubCharacteristic::class,
            'query' => function ($model) use ($form) {
                if (!isset($form['characteristic_id'])) {
                    return $model;
                }
                return $model->where('characteristic_id', $form['characteristic_id']);
            }
        ]);
    }
}
