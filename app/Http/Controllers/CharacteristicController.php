<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Characteristic;
use Illuminate\Database\Eloquent\Builder;

class CharacteristicController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Characteristic::whereHas('subCharacteristics', function (Builder $query) {
            $query->whereHas('indicators', function (Builder $query) {
                $query->Has('indicatorValues');
            });
        })->get();
    }
}
