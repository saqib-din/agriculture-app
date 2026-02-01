<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\QuoteRequest;
use App\Models\Category;
use App\Models\HeroSection;
use App\Models\Faq;
use App\Models\Testimonial;
use App\Models\Service;
use App\Models\Team;
use App\Models\Partner;
use App\Models\Product;
use App\Models\Order;
use App\Models\Page;
use App\Models\ContactMessage;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'hero_sections' => HeroSection::where('status', 'active')->count(),
            'services'      => Service::where('status', 'active')->count(),
            'products'      => Product::where('status', 1)->count(),
            'categories'    => Category::count(),
            'quoteRequests'    => QuoteRequest::count(),
            'testimonials'  => Testimonial::where('status', 1)->count(),
            'faqs'          => Faq::where('status', 1)->count(),
            'teams'         => Team::where('status', 'active')->count(),
            'partners'      => Partner::where('status', 1)->count(),
            'clients'       => Client::where('status', 1)->count(),
            'orders'        => Order::where('status', 1)->count(),
            'contacts'        => ContactMessage::count(),

            'footer_pages'  => Page::where('status', 'Active')
                ->where('display_in_footer', 1)
                ->count(),
            'about_page'    => Page::where('slug', 'about-us')
                ->where('status', 'Active')
                ->exists(),
        ];

        return view('dashboard', compact('stats'));
    }
}
