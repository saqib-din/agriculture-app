<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use App\Models\Faq;
use App\Models\Testimonial;
use App\Models\Service;
use App\Models\Team;
use App\Models\Partner; // ✅ Add this
use App\Models\Variable;

class HomeController extends Controller
{
    public function welcome()
    {
        $heroSections = HeroSection::all();
        $testimonials = Testimonial::all();
        $faqs = Faq::all();
        $services = Service::all();
        $teams = Team::all();
        $partners = Partner::where('status', 1)->orderBy('id', 'desc')->get(); // ✅ Add this
        $variables = Variable::all();
        
        return view('pages.landing.index', compact(
            'heroSections',
            'testimonials',
            'faqs',
            'services',
            'teams',
            'partners',
            'variables'
        ));
    }
}
