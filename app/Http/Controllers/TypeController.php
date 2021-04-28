<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Type::whereHas('partners', function (Builder $query) {
            $query->whereHas('sources', function (Builder $query){
                $query->has('indicatorValues');
            });
        })->get();
    }
}
