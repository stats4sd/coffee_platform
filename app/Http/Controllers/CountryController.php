<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Database\Eloquent\Builder;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Country::whereHas('geoBoundaries', function (Builder $query) {
            $query->has('indicatorValues');
        })->get();
    }
}
