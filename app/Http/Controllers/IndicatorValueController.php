<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\IndicatorValue;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\IndicatorValuesExport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;

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

        //Add filters here;
        if ($request->exists('countries')) {
            $query = $query->whereIn('country_id', explode(',', $request->input('countries')));
        }

        $results = $query->get();

        // if ($request->exists('by-indicator')) {
        //     $results = $results->groupBy('indicator_id');


        //     // organise data into indicators, with 'values' containing the IndicatorValues.

        //     $results = $results->map(function ($values) {
        //         $indicatorValue = $values->first();

        //         return [
        //             'id' => $indicatorValue->indicator->id,
        //             'code' => $indicatorValue->indicator->code,
        //             'definition' => $indicatorValue->indicator->definition,
        //             'values' => $values,
        //         ];
        //     })->values();
        // }

        return $results;
    }

    public function getYears()
    {
        return DB::table('indicator_values')->selectRaw('distinct year')->get();
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

        $filename = 'indicator-values-'.now()->toDateTimeString().'.xlsx';
        $success = Excel::store($export, $filename, 'public');

        if (! $success) {
            return response('Could not export data - please check logs', 500);
        }

        return Storage::disk('public')->url($filename);
    }

    public function report(Request $request)
    {

        // Call the R script, and pass the indicator list and the set of filters from the $request as parameters (or whatever the R script needs)

        return 'this is a temporary holder.';
    }
}
