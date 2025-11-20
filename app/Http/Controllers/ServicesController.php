<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function show()
    {
        return view('pages.servicess.our-services');
    }
}
