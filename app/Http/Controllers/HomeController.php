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
        $heroSections = HeroSection::where('status', 'active')->get();
        $testimonials = Testimonial::where('status', 'active')->get();
        $faqs = Faq::where('status', 'active')->get();
        $services = Service::where('status', 'active')->get();
        $teams = Team::where('status', 'active')->get();

        return view('pages.landing.index', compact('heroSections', 'testimonials', 'faqs', 'services', 'teams'));
    }
}
