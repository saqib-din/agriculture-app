<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use App\Models\Faq;


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
    public function faqs()
    {
        $faqs = Faq::all(); 

        return view('pages.landing.index', compact('faqs'));
    }
}
