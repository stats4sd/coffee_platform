<?php

namespace App\Http\Controllers\Operations;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;

trait ExportOperation
{
    /**
     * Define which routes are needed for this operation.
     *
     * @param string $segment    Name of the current entity (singular). Used as first URL segment.
     * @param string $routeName  Prefix of the route name.
     * @param string $controller Name of the current CrudController.
     */
    protected function setupExportRoutes($segment, $routeName, $controller)
    {
        Route::get($segment . '/export', [
            'as'        => $routeName . '.export',
            'uses'      => $controller . '@export',
            'operation' => 'export',
        ]);
    }

    /**
     * Add the default settings, buttons, etc that this operation needs.
     */
    protected function setupExportDefaults()
    {
        $this->crud->allowAccess('export');

        $this->crud->operation('export', function () {
            $this->crud->loadDefaultOperationSettingsFromConfig();
        });

        $this->crud->operation('list', function () {
            $this->crud->addButton('top', 'export', 'view', 'crud::buttons.export');
        });
    }

    /**
     * Export All rows to Excel
     *
     * @return \Illuminate\View\View
     */
    public function export()
    {
        $this->crud->hasAccessOrFail('export');
        $exporter = $this->crud->get('export.exporter');

        if (!$exporter) {
            return response("Exporter Class not found - please check the exporter is properly setup for this page", 500);
        }
        return Excel::download(new $exporter, $this->crud->entity_name_plural." - ".Carbon::now()->format('Ymd_His').".xlsx");
    }
}
