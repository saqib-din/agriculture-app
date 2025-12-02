<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Variable;

class CategoriesController extends Controller
{
    public function show()
    {
        $variables = Variable::all();
        return view('pages.products.product-list', compact('variables'));
    }
}
