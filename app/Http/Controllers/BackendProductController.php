<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendProductController extends Controller
{
    public function productAdd()
    {
        return view('pages.backend.products.product-add');
    }
}
