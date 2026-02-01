<?php

namespace App\Http\Controllers;

use App\Models\HeroSection;
use App\Models\Faq;
use App\Models\Testimonial;
use App\Models\Service;
use App\Models\Team;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Variable;
use App\Models\Page;

class HomeController extends Controller
{
    public function welcome()
    {
        $heroSections = HeroSection::where('status', 'active')->get();
        $testimonials = Testimonial::where('status', 1)->get();
        $faqs = Faq::where('status', 1)->get();
        $services = Service::where('status', 'active')->get();
        $teams = Team::where('status', 'active')->get();
        $partners = Partner::where('status', 1)->orderBy('id', 'desc')->get();
        $products = Product::where('status', 1)->orderBy('id', 'desc')->get();
        $variables = Variable::all();
        $pages = Page::where('status', 'Active')
            ->where('display_in_footer', 1)
            ->get();

        // Check if About Us page exists and is active
        $hasAboutData = Page::where('slug', 'about-us')
            ->where('status', 'Active')
            ->exists();

        return view('pages.landing.index', compact(
            'heroSections',
            'testimonials',
            'faqs',
            'services',
            'teams',
            'partners',
            'products',
            'variables',
            'pages',
            'hasAboutData'
        ));
    }
}
