<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variable;

class AboutController extends Controller

{
    public function show()
    {
        $variables = Variable::all();
        return view('pages.abouts.about-us', compact('variables'));
    }
}
