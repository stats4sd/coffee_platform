<?php

namespace App\Http\Controllers;

use App\Models\Scope;
use Illuminate\Http\Request;

class ScopeController extends Controller
{
    public function index()
    {
        return Scope::has('indicatorValues')->get();
    }
}
