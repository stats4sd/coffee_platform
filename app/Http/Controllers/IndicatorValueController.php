<?php

namespace App\Http\Controllers;

use App\Models\Year;
use Illuminate\Http\Request;
use App\Models\IndicatorValue;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IndicatorValuesWorkbookExport;
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
            // return full set search result instead of using pagination
            $query = IndicatorValue::search($request->search)->get();
        } else {
            $query = IndicatorValue::query()->get();
        }

        $results = $query->load('purposeOfCollection', 'indicator.subCharacteristic.characteristic', 'gender', 'scope');

        return $results;
    }

    public function getYears()
    {
        return Year::has('indicatorValues')->get();
    }

    public function makeExcel(Request $request)
    {
        $export = new IndicatorValuesWorkbookExport;

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
            return response(t('Could not export data - please try again or contact the website support team'), 500);
        }

        return $filename;
    }

    public function download(Request $request)
    {
        $filename = $this->makeExcel($request);

        return Storage::disk('public')->url($filename);
    }

    public function getExcel(Request $request)
    {
        $filename = $this->makeExcel($request);

        return Storage::disk('public')->path($filename);
    }



    public function report(Request $request)
    {
        $excelPath = $this->getExcel($request);

        $indicatorValueIds = Collect($request->input('indicator_values'))->pluck('id')->toArray();
        $indicatorValueIds = implode(",", $indicatorValueIds);

        // choose correct R script based on current locale
        $scriptFile = 'makeReport_' . session('locale') . '.R';

        $process = new Process(['Rscript', $scriptFile, $excelPath, $indicatorValueIds]);
        $process->setWorkingDirectory(base_path('scripts/Rscript'));

        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $filename = 'indicator-values-exports/indicator-values-report-'.session('locale').'-'.now()->toDateTimeString().'.pdf';

        $pdfPath = 'scripts/Rscript/PDF_Report_Script_' . session('locale') . '.pdf';

        copy(base_path($pdfPath), storage_path('app/public/'.$filename));

        return Storage::disk('public')->url($filename);
    }
}
