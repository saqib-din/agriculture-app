<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use App\Models\Faq;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function create()
    {
        return view('pages.admin-side.hero-section.create');
    }

    public function index()
    {
        $heroSections = HeroSection::all();
        $testimonials = Testimonial::all();

        return view('pages.admin-side.hero-section.index', compact('heroSections', 'testimonials'));
    }

    public function faqs()
    {
        $faqs = Faq::all();

        return view('pages.landing.index', compact('faqs'));
    }
}
