<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IndicatorValue;
use Illuminate\Support\Facades\DB;
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
}
