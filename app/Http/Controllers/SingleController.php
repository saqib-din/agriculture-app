<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SingleController extends Controller
{
    public function show()
    {
        return view('pages.products.single-product');
    }
}
