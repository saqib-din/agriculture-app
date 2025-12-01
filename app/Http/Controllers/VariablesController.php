<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VariablesController extends Controller
{
    public function createorupdate()
    {
        return view('pages.admin-side.variables.createorupdate');
    }
    public function index()
    {
        return view('pages.admin-side.variables.index');
    }
}
