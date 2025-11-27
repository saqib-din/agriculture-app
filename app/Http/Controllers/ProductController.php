<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function productAdd()
    {
        return view('pages.admin-side.products.product-add');
    }
    public function productList()
    {
        return view('pages.admin-side.products.product-list');
    }
}
