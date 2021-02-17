<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\IndicatorValueRequest;
use App\Models\ApproachCollection;
use App\Models\Gender;
use App\Models\GeoBoundary;
use App\Models\Indicator;
use App\Models\PurposeOfCollection;
use App\Models\SmallholderDefinition;
use App\Models\Unit;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class IndicatorValueCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class IndicatorValueCrudController extends CrudController
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
        CRUD::setModel(\App\Models\IndicatorValue::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/indicator_value');
        CRUD::setEntityNameStrings('indicator value', 'indicator values');
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
                'name' => 'indicator',
            ],
            [
                'name' => 'value',
                'type' => 'number',
                'label' => 'Value'
            ],
            [
                'name' => 'year',
                'type' => 'number',
                'label' => 'Year'
            ],
            [
                'type' => 'relationship',
                'name' => 'geo_boundary',
            ],
            [
                'type' => 'relationship',
                'name' => 'unit',
            ],
            [
                'type' => 'relationship',
                'name' => 'gender',
            ],
            [
                'name' => 'sample_size',
                'type' => 'number',
                'label' => 'Sample Size'
            ],
            [
                'type' => 'relationship',
                'name' => 'smallholder_definition',
            ],
            [
                'type' => 'relationship',
                'name' => 'user',
            ],
            [
                'type' => 'relationship',
                'name' => 'purpose_of_collection',
            ],
            [
                'type' => 'relationship',
                'name' => 'approach_collection',
            ],
            [
                'name' => 'scope',
                'type' => 'text',
                'label' => 'Scope'
            ],
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
        CRUD::setValidation(IndicatorValueRequest::class);

        $this->crud->addFields([
            [
                'type' => 'relationship',
                'name' => 'indicator_id',
                'ajax' => true,
                'inline_create' => [ 'entity' => 'indicator' ],
                'minimum_input_length' => 0,
            ],
            [
                'name' => 'value',
                'type' => 'number',
                'label' => 'Value'
            ],
            [
                'name' => 'year',
                'type' => 'number',
                'label' => 'Year'
            ],
            [
                'type' => 'relationship',
                'name' => 'source_id',
                'inline_create' => [ 'entity' => 'source' ],
                'ajax' => true,
                'inline_create' => true,
                'minimum_input_length' => 0,
            ],
            [
                'type' => 'relationship',
                'name' => 'geo_boundary_id',
                'inline_create' => [ 'entity' => 'geo_boundary' ],
                'ajax' => true,
                'inline_create' => true,
                'minimum_input_length' => 0,
            ],
            [
                'type' => 'relationship',
                'name' => 'unit_id',
                'attribute' => "unit",
                'ajax' => true,
                'inline_create' => [ 'entity' => 'unit' ],
                'minimum_input_length' => 0,
            ],
            [
                'type' => 'relationship',
                'name' => 'gender_id',
                'ajax' => true,
                'inline_create' => [ 'entity' => 'gender' ],
                'minimum_input_length' => 0,
            ],
            [
                'name' => 'sample_size',
                'type' => 'number',
                'label' => 'Sample Size'
            ],
            [
                'type' => 'relationship',
                'name' => 'smallholder_definition_id',
                'ajax' => true,
                'inline_create' => [ 'entity' => 'smallholder_definition' ],
                'minimum_input_length' => 0,
            ],
            [
                'label'     => "User",
                'type'      => 'select2',
                'name'      => 'user_id', 

                // optional
                'entity'    => 'user', 
                'model'     => "App\Models\User",
                'attribute' => 'name', 
            ],
            [
                'type' => 'relationship',
                'name' => 'purpose_of_collection_id',
                'ajax' => true,
                'inline_create' => [ 'entity' => 'purpose_of_collection' ],
                'minimum_input_length' => 0,
            ],
            [
                'type' => 'relationship',
                'name' => 'approach_collection_id',
                'ajax' => true,
                'inline_create' => [ 'entity' => 'approach_collection' ],
                'minimum_input_length' => 0,
            ],
            [
                'name' => 'scope',
                'type' => 'text',
                'label' => 'Scope'
            ],
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

    public function fetchIndicator()
    {
        return $this->fetch(Indicator::class);
    }

    public function fetchSource()
    {
        return $this->fetch(Source::class);
    }

    public function fetchGeo_boundary()
    {
        return $this->fetch(GeoBoundary::class);
    }

    public function fetchUnit()
    {
        return $this->fetch(Unit::class);
    }

    public function fetchGender()
    {
        return $this->fetch(Gender::class);
    }

    public function fetchSmallholder_definition()
    {
        return $this->fetch(SmallholderDefinition::class);
    }

    public function fetchPurpose_of_collection()
    {
        return $this->fetch(PurposeOfCollection::class);
    }

    public function fetchApproach_collection()
    {
        return $this->fetch(ApproachCollection::class);
    }
}
