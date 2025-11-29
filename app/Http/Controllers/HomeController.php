<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use App\Models\Faq;
use App\Models\Testimonial;
use App\Models\Service;
use App\Models\Team;

class HomeController extends Controller
{
    public function welcome()
    {
        $heroSections = HeroSection::all();
        $testimonials = Testimonial::all();
        $faqs = Faq::all();
        $services = Service::all();
        $teams = Team::all();

        return view('pages.landing.index', compact('heroSections', 'testimonials', 'faqs', 'services', 'teams'));
    }
}
