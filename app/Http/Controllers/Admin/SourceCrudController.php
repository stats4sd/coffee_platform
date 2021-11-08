<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use App\Models\Partner;
use App\Http\Requests\SourceRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class SourceCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class SourceCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Source::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/source');
        CRUD::setEntityNameStrings(t('sources'), t('sources'));
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
                'name' => 'name',
                'type' => 'text',
                'label' => t('Name'),
            ],
            [
                'name' => 'reference',
                'type' => 'text',
                'label' => t('Reference'),
            ],
            [
                'type' => 'relationship',
                'name' => 'partner',
                'label' => t('Partner'),
            ],
            [
                'name' => 'is_not_public',
                'type' => 'check',
                'label' => t('Keep source anonymous?'),
            ],
            [
                'name' => 'description',
                'type' => 'text',
                'label' => t('Description'),
            ],
            [
                'name'      => 'file',
                'label'     => t('Files'),
                'type'      => 'upload_multiple',
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
        CRUD::setValidation(SourceRequest::class);

        $this->crud->addFields([
            [
                'name' => 'name',
                'type' => 'text',
                'label' => t('Name'),
            ],
            [
                'name' => 'reference',
                'type' => 'text',
                'label' => t('reference'),
            ],
            [
                'type' => 'relationship',
                'name' => 'partner_id',
                'ajax' => true,
                'inline_create' => [ 'entity' => 'partner' ],
                'minimum_input_length' => 0,
                'label' => t('Partner'),
            ],
            [
                'name' => 'is_not_public',
                'type' => 'checkbox',
                'label' => t('Keep source anonymous?'),

            ],
            [
                'name' => 'description',
                'type' => 'text',
                'label' => t('Description'),
            ],
            [
                'name'      => 'file',
                'label'     => t('Files'),
                'type'      => 'upload_multiple',
                'upload'    => true,
                'disk'      => 'public',
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

    public function fetchPartner()
    {
        return $this->fetch(Partner::class);
    }
}
