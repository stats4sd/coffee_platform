<?php

namespace App\Http\Controllers\Admin;

use App\Models\ApproachCollection;
use App\Exports\ApproachCollectionsExport;
use App\Imports\ApproachCollectionsImport;
use App\Http\Requests\ApproachCollectionRequest;
use App\Http\Controllers\Operations\ExportOperation;
use App\Http\Controllers\Operations\ImportOperation;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ApproachCollectionCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ApproachCollectionCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\InlineCreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\FetchOperation;

    use ExportOperation;
    use ImportOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     *
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\ApproachCollection::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/approach_collection');
        CRUD::setEntityNameStrings(t('Approach'), t('Approaches to collection'));

        CRUD::set('export.exporter', ApproachCollectionsExport::class);
        CRUD::set('import.importer', ApproachCollectionsImport::class);
    }

    /**
     * Define what happens when the List operation is loaded.
     *
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        CRUD::column('name')->type('text')->label(t('Name'));
    }

    /**
     * Define what happens when the Create operation is loaded.
     *
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(ApproachCollectionRequest::class);

        CRUD::field('name')->type('text')->label(t('Name'));

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

    protected function setupImportOperation()
    {
        //CRUD::removeAllFields();
        CRUD::field('import_instructions')->type('custom_html')->value(
            '<div class="alert">' .
            t('<h3>Instructions</h3>
            Please upload the Excel file containing new collection approaches.
            <ul>
                <li>The file should be in the same format as the file downloadable on the main view page.</li>
            </ul>') .
            '</div>'
        );
    }
}
