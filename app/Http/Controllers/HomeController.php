<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use App\Models\Faq;
use App\Models\Testimonial;
use App\Models\Service;
use App\Models\Team;
use App\Models\Partner; // ✅ Add this
use App\Models\Variable;
use App\Models\Page;

class HomeController extends Controller
{
    public function welcome()
    {
        $heroSections = HeroSection::all();
        $testimonials = Testimonial::all();
        $faqs = Faq::all();
        $services = Service::all();
        $teams = Team::all();
        $partners = Partner::where('status', 1)->orderBy('id', 'desc')->get();
        $variables = Variable::all();
        $pages = Page::where('status', 'Active')
            ->where('display_in_footer', 1)
            ->get();


        return view('pages.landing.index', compact(
            'heroSections',
            'testimonials',
            'faqs',
            'services',
            'teams',
            'partners',
            'variables',
            'pages'
        ));
    }
}
