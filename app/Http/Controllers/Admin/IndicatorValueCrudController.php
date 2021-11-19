<?php

namespace App\Http\Controllers\Admin;

use App\Models\Unit;
use App\Models\Group;
use App\Models\Scope;
use App\Models\Gender;
use App\Models\Source;
use App\Models\Indicator;
use App\Models\GeoBoundary;
use App\Models\ApproachCollection;
use App\Models\PurposeOfCollection;
use App\Models\SmallholderDefinition;
use App\Http\Requests\IndicatorValueRequest;
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
        CRUD::setEntityNameStrings(t('indicator values'), t('indicator values'));
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // select2_multiple filter
        $this->crud->addFilter([
            'name'  => 'groups',
            'type'  => 'select2_multiple',
            'label' => t('Groups'),
        ], function () {
            $groups = Group::all()->pluck('name', 'id')->toArray();

            return $groups;
        }, function ($values) { // if the filter is active
            $this->crud->addClause('whereIn', 'group_id', json_decode($values));
        });

        $this->crud->addColumns([
            [
                'type' => 'relationship',
                'name' => 'indicator',
                'label' => t('Indicator'),
            ],
            [
                'name' => 'value',
                'label' => t('Value'),
            ],
            [
                'type' => 'relationship',
                'name' => 'unit',
                'attribute' => 'unit',
                'label' => t('Unit'),
            ],
            [
                'type' => 'relationship',
                'name' => 'group',
                'label' => t('Group'),
            ],
            [
                'name' => 'converted_value',
                'label' => t('Value in Standard Units'),
            ],
            [
                'name' => 'standard_unit',
                'type' => 'text',
                'label' => t('Standard Unit'),
            ],
            [
                'name' => 'conversion_rate',
                'type' => 'text',
                'label' => t('Conversion Ratio <br/>(original to standard)'),
            ],
            [
                'name' => 'years',
                'type' => 'relationship',
                'label' => t('Year'),
                'attribute' => 'year',
            ],
            [
                'type' => 'relationship',
                'name' => 'geoBoundary',
                'label' => t('Geo-boundary'),
            ],
            [
                'type' => 'relationship',
                'name' => 'gender',
                'label' => t('Gender'),
            ],
            [
                'name' => 'sample_size',
                'type' => 'number',
                'label' => t('Sample Size'),
            ],
            [
                'type' => 'relationship',
                'name' => 'smallholderDefinition',
                'label' => t('Smallholder Definition'),
            ],
            [
                'type' => 'relationship',
                'name' => 'user',
                'label' => t('User'),
            ],
            [
                'type' => 'relationship',
                'name' => 'purposeOfCollection',
                'label' => t('Purpose of Collection'),
            ],
            [
                'type' => 'relationship',
                'name' => 'approachCollection',
                'label' => t('Approach'),
            ],
            [
                'type' => 'relationship',
                'name' => 'scope',
                'label' => t('Scope'),
            ],
            [
                'name' => 'calculated_by_us',
                'type' => 'check',
                'label' => t('Calculated by us'),
            ],
            [
                'type' => 'text',
                'name' => 'definition',
                'label' => t('Indicator definition from source'),
            ],
            [
                'type' => 'text',
                'name' => 'indicator_name_original',
                'label' => t('Indicator name from source'),
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
                'label' => t('Indicator'),
                'hint' => t('If the indicator is not in the dropdown select <b>+Add</b> to add a new one.'),
            ],
            [
                'name' => 'value',
                'type' => 'number',
                'label' => t('Value'),
                'attributes' => ["step" => "any"], // allow decimals
            ],
            [
                'type' => 'relationship',
                'name' => 'unit_id',
                'attribute' => "unit",
                'ajax' => true,
                'inline_create' => [ 'entity' => 'unit' ],
                'minimum_input_length' => 0,
                'label' => t('Unit'),
                'hint' => t('If the unit is not in the dropdown select <b>+Add</b> to add a new one.'),
            ],
            [
                'name' => 'years',
                'type' => 'relationship',
                'label' => t('Year(s)'),
                'attribute' => "year",
            ],
            [
                'type' => 'relationship',
                'name' => 'source_id',
                'inline_create' => [ 'entity' => 'source' ],
                'ajax' => true,
                'minimum_input_length' => 0,
                'label' => t('Source'),
                'hint' => t('If the source is not in the dropdown select <b>+Add</b> to add a new one.'),
            ],
            [
                'type' => 'relationship',
                'name' => 'geo_boundary_id',
                'entity' => 'geoBoundary' ,
                'attribute' => "geo_description",
                'data_source' => route('indicator_value.fetchGeoBoundary'),
                'inline_create' => [
                    'entity' => 'geo_boundary',
                    'modal_route' => route('geo_boundary-inline-create'),
                    'create_route' =>  route('geo_boundary-inline-create-save'),
                ],
                'ajax' => true,
                'minimum_input_length' => 0,
                'label' => t('Geo boundary'),
                'hint' => t('If the geo boundary is not in the dropdown select <b>+Add</b> to add a new one.<br>If the locations are incomplete add a new Geo Boundaries using the tab on the left.'),
            ],
            [
                'type' => 'relationship',
                'name' => 'gender_id',
                'ajax' => true,
                'inline_create' => [ 'entity' => 'gender' ],
                'minimum_input_length' => 0,
                'label' => t('Gender'),
                'hint' => t('If the gender is not in the dropdown select <b>+Add</b> to add a new one.'),
            ],
            [
                'name' => 'sample_size',
                'type' => 'number',
                'label' => t('Sample Size'),
            ],
            [
                'type' => 'relationship',
                'name' => 'smallholder_definition_id',
                'entity' => 'smallholderDefinition' ,
                'ajax' => true,
                'data_source' => route('indicator_value.fetchSmallholderDefinition'),
                'inline_create' => [
                    'entity' => 'smallholder_definition' ,
                    'modal_route' => route('smallholder_definition-inline-create'),
                    'create_route' =>  route('smallholder_definition-inline-create-save'),
                ],
                'minimum_input_length' => 0,
                'label' => t('Smallholder definition'),
                'hint' => t('If the smallholder definition is not in the dropdown select <b>+Add</b> to add a new one.'),
            ],
            [
                'label'     => "User",
                'type'      => 'select2',
                'name'      => 'user_id',
                'default'  => backpack_user()->id,

                // optional
                'entity'    => 'user',
                'model'     => "App\Models\User",
                'attribute' => 'name',
            ],
            [
                'type' => 'relationship',
                'name' => 'purpose_of_collection_id',
                'ajax' => true,
                'data_source' => route('indicator_value.fetchPurposeOfCollection'),
                'entity' => 'purposeOfCollection' ,
                'inline_create' => [
                    'entity' => 'purpose_of_collection' ,
                    'modal_route' => route('purpose_of_collection-inline-create'),
                    'create_route' =>  route('purpose_of_collection-inline-create-save'),

                ],
                'minimum_input_length' => 0,
                'label' => t('Purpose of collection'),
                'hint' => t('If the purpose of collection is not in the dropdown select <b>+Add</b> to add a new one.'),
            ],
            [
                'type' => 'relationship',
                'name' => 'approach_collection_id',
                'ajax' => true,
                'data_source' => route('indicator_value.fetchApproachCollection'),
                'entity' => 'approachCollection',
                'inline_create' => [
                    'entity' => 'approach_collection',
                    'modal_route' => route('approach_collection-inline-create'),
                    'create_route' =>  route('approach_collection-inline-create-save'),
                ],
                'minimum_input_length' => 0,
                'label' => t('Collection approach'),
                'hint' => t('If the collection approach is not in the dropdown select <b>+Add</b> to add a new one.'),
            ],
            [
                'type' => 'relationship',
                'name' => 'group_id',
                'ajax' => true,
                'inline_create' => [ 'entity' => 'group' ],
                'minimum_input_length' => 0,
                'label' => t('Group'),
                'hint' => t('If the group is not in the dropdown select <b>+Add</b> to add a new one.'),
            ],
            [
                'type' => 'relationship',
                'name' => 'scope_id',
                'ajax' => true,
                'inline_create' => [ 'entity' => 'scope' ],
                'minimum_input_length' => 0,
                'label' => t('Scope'),
                'hint' => t('If the scope is not in the dropdown select <b>+Add</b> to add a new one.'),
            ],
            [
                'name' => 'calculated_by_us',
                'type' => 'checkbox',
                'label' => t('Calculated by us'),
            ],
            [
                'type' => 'text',
                'name' => 'definition',
                'label' => t('Indicator definition from source'),
            ],
            [
                'type' => 'text',
                'name' => 'indicator_name_original',
                'label' => t('Indicator name from source'),
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

    public function fetchScope()
    {
        return $this->fetch(Scope::class);
    }
    public function fetchGroup()
    {
        return $this->fetch(Group::class);
    }
}
