<?php

namespace App\Http\Controllers;

use App\Models\PurposeOfCollection;

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
