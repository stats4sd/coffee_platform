<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCharacteristic;
use Illuminate\Database\Eloquent\Builder;

class SubCharacteristicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return SubCharacteristic::whereHas('indicators', function (Builder $query) {
            $query->Has('indicatorValues');
        })->get();
    }
}
