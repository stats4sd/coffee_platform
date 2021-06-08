<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Year;
use Illuminate\Http\Request;
use App\Models\IndicatorValue;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IndicatorValuesExport;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Symfony\Component\Process\Exception\ProcessFailedException;

class IndicatorValueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $query = IndicatorValue::search($request->search);
        } else {
            $query = IndicatorValue::query();
        }

        $results = $query->get()->load('purposeOfCollection', 'indicator.subCharacteristic.characteristic', 'gender', 'scope');

        return $results;
    }

    public function getYears()
    {
        return Year::has('indicatorValues')->get();
    }

    public function download(Request $request)
    {
        $export = new IndicatorValuesExport;


        // ensure indicators is array - even if only 1 is passed;
        if ($request->has('indicators')) {
            $export = $export->forIndicators($request->input('indicators'));
        }

        if ($request->has('countries') && count($request->input('countries')) > 0) {
            $export = $export->forCountries($request->input('countries'));
        }

        if ($request->has('years') && count($request->input('years')) > 0) {
            $export = $export->forYears($request->input('years'));
        }

        if ($request->has('types') && count($request->input('types')) > 0) {
            $export = $export->forTypes($request->input('types'));
        }

        if ($request->has('purposes') && count($request->input('purposes')) > 0) {
            $export = $export->forPurposes($request->input('purposes'));
        }

        if ($request->has('genders') && count($request->input('genders')) > 0) {
            $export = $export->forGenders($request->input('genders'));
        }

        if ($request->has('scopes') && count($request->input('scopes')) > 0) {
            $export = $export->forScopes($request->input('scopes'));
        }


        $filename = 'indicator-values-exports/indicator-values-'.now()->format('Y-M-D_his').'.xlsx';

        $success = Excel::store($export, $filename, 'public');

        if (! $success) {
            return response('Could not export data - please check logs', 500);
        }

        return Storage::disk('public')->url($filename);
    }

    public function report(Request $request)
    {
        $excelPath = $this->download($request);

        $indicatorValueIds = Collect($request->input('indicator_values'))->pluck('id')->toArray();
        $indicatorValueIds = implode(",", $indicatorValueIds);

        $process = new Process(['Rscript', 'makeReport.R', $excelPath, $indicatorValueIds]);
        $process->setWorkingDirectory(base_path('scripts/Rscript'));

        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $filename = 'indicator-values-exports/indicator-values-report-'.now()->toDateTimeString().'.pdf';

        copy(base_path('scripts/Rscript/PDF Report Script.Rmd'), storage_path('app/public/'.$filename));

        return Storage::disk('public')->url($filename);
    }
}
