<?php

namespace App\Http\Controllers;

use App\Models\Scope;

class ScopeController extends Controller
{
    public function index()
    {
        return Scope::has('indicatorValues')->get();
    }
}
