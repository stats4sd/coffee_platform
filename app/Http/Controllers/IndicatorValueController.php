<?php

namespace App\Http\Controllers;

use App\Exports\IndicatorValuesExport;
use Illuminate\Http\Request;
use App\Models\IndicatorValue;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Maatwebsite\Excel\Facades\Excel;

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
            if (is_array($request->input('indicator'))) {
                $export = $export->forIndicators($request->input('indicator'));
            } else {
                $export = $export->forIndicators([$request->input('indicator')]);
            }
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

        Excel::store($export, 'test-download'.now()->toDateTimeString().'.xlsx');

        return 'hello';
    }
}
