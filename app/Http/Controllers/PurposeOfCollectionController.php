<?php

namespace App\Http\Controllers;

use App\Models\PurposeOfCollection;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PurposeOfCollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PurposeOfCollection::has('indicatorValues')->get();
    }
}
