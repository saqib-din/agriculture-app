<?php

namespace App\Http\Controllers;
use App\Models\HeroSection;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function create()
    {
        return view('pages.admin-side.hero-section.create');
    }
  
    public function index()
    {
        // Get all hero sections from DB
        $heroSections = HeroSection::all();

        // Pass the data to your index view
        return view('pages.admin-side.hero-section.index', compact('heroSections'));
    }

   
}
