<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\HeroSectionController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\TestimonialsController;
use App\Http\Controllers\VariablesController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\QuoteRequestController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;

// PUBLIC ROUTES (No Authentication Required)

// Welcome Page
Route::get('/', [HomeController::class, 'welcome'])->name('welcomepage');

// Public product list
Route::get('/products', [ProductController::class, 'list'])->name('products.public.list');

// Public single product
Route::get('products/{slug}', [ProductController::class, 'showBySlug'])->name('products.show');

// QUOTE REQUEST - PUBLIC ROUTE (Customers can submit without login)
Route::post('/quote-request', [QuoteRequestController::class, 'store'])->name('quote.store');

// Services
Route::get('/services', [ServicesController::class, 'show'])->name('services');

// Teams
Route::get('/teams', [TeamController::class, 'show'])->name('teams');

// About Us
Route::get('/aboutus', [AboutController::class, 'show'])->name('aboutus');

// Contact Us
Route::get('/contactus', [ContactController::class, 'show'])->name('contactus');
Route::post('/contact-submit', [ContactController::class, 'store'])->name('contact.submit');

// Frontend route (public)
Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');

// 404 error page
Route::get('/not-found', function () {
    return view('pages.errors.404');
})->name('not-found');

// AUTHENTICATED ROUTES (Login Required)

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

     Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // User Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users', [ProfileController::class, 'index'])->name('users.index');

    // Hero Section
    Route::get('/hero/section/list', [HeroSectionController::class, 'index'])->name('hero-section.index');
    Route::get('/hero/create', [HeroSectionController::class, 'form'])->name('hero.create');
    Route::get('/hero/edit/{id}', [HeroSectionController::class, 'form'])->name('hero.edit');
    Route::post('/hero/save/{id?}', [HeroSectionController::class, 'save'])->name('hero.save');
    Route::delete('/hero/delete/{id}', [HeroSectionController::class, 'destroy'])->name('hero.delete');

    // Client
    Route::get('/clients', [ClientsController::class, 'index'])->name('admin.clients.index');
    Route::get('/clients/create', [ClientsController::class, 'create'])->name('admin.clients.create');
    Route::post('/clients', [ClientsController::class, 'store'])->name('admin.clients.store');
    Route::get('/clients/{client}', [ClientsController::class, 'show'])->name('admin.clients.show');
    Route::get('/clients/{client}/edit', [ClientsController::class, 'edit'])->name('admin.clients.edit');
    Route::put('/clients/{client}', [ClientsController::class, 'update'])->name('admin.clients.update');
    Route::delete('/clients/{client}', [ClientsController::class, 'destroy'])->name('admin.clients.destroy');

    // Order Routes
    Route::prefix('orders')->name('admin.orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/create', [OrderController::class, 'create'])->name('create');
        Route::post('/store', [OrderController::class, 'store'])->name('store');
        Route::get('/{order}', [OrderController::class, 'show'])->name('show');
        Route::get('/{order}/edit', [OrderController::class, 'edit'])->name('edit');
        Route::put('/{order}', [OrderController::class, 'update'])->name('update');
        Route::delete('/{order}', [OrderController::class, 'destroy'])->name('destroy');

        // Activity
        Route::post('/{order}/activity', [OrderController::class, 'storeActivity'])->name('storeActivity');

        // Invoice actions
        Route::get('/{order}/print', [OrderController::class, 'print'])->name('print');
        Route::post('/{order}/send-invoice', [OrderController::class, 'sendInvoice'])->name('sendInvoice');

        // Status actions
        Route::post('/{order}/mark-completed', [OrderController::class, 'markCompleted'])->name('markCompleted');
        Route::post('/{order}/mark-cancelled', [OrderController::class, 'markCancelled'])->name('markCancelled');
        Route::post('/{order}/reopen', [OrderController::class, 'reopenOrder'])->name('reopenOrder');
    });

    // Services
    Route::get('/services/index', [ServicesController::class, 'index'])->name('services.index');
    Route::get('/services/add', [ServicesController::class, 'form'])->name('services.add');
    Route::get('/services/edit/{id}', [ServicesController::class, 'form'])->name('services.edit');
    Route::post('/services/save/{id?}', [ServicesController::class, 'save'])->name('services.save');
    Route::delete('/services/delete/{id}', [ServicesController::class, 'destroy'])->name('services.delete');

    // Teams 
    Route::get('/teams/list', [TeamController::class, 'index'])->name('teams.index');
    Route::get('/create-or-update/{id?}', [TeamController::class, 'createorupdate'])->name('createorupdate');
    Route::post('/save', [TeamController::class, 'save'])->name('save');
    Route::post('/teams/save', [TeamController::class, 'save'])->name('teams.save');
    Route::delete('/teams/delete/{id}', [TeamController::class, 'destroy'])->name('teams.destroy');

    // Faqs 
    Route::get('/faqs', [FaqsController::class, 'index'])->name('faqs.index');
    Route::get('/faqs/create', [FaqsController::class, 'create'])->name('faqs.create');
    Route::post('/faqs', [FaqsController::class, 'store'])->name('faqs.store');
    Route::get('/faqs/{id}/edit', [FaqsController::class, 'edit'])->name('faqs.edit');
    Route::put('/faqs/{id}', [FaqsController::class, 'update'])->name('faqs.update');
    Route::delete('/faqs/{id}', [FaqsController::class, 'destroy'])->name('faqs.destroy');

    // Testimonial
    Route::get('/testimonials', [TestimonialsController::class, 'index'])->name('testimonials.index');
    Route::get('/testimonials/create', [TestimonialsController::class, 'create'])->name('testimonials.create');
    Route::post('/testimonials/store', [TestimonialsController::class, 'store'])->name('testimonials.store');
    Route::get('/testimonials/edit/{id}', [TestimonialsController::class, 'edit'])->name('testimonials.edit');
    Route::post('/testimonials/update/{id}', [TestimonialsController::class, 'update'])->name('testimonials.update');
    Route::delete('/testimonials/delete/{id}', [TestimonialsController::class, 'destroy'])->name('testimonials.destroy');

    // Categories 
    Route::get('/index', [CategoryController::class, 'index'])->name('index');
    Route::post('/store', [CategoryController::class, 'store'])->name('store');
    Route::put('/update/{id}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/destroy/{category}', [CategoryController::class, 'destroy'])->name('destroy');

    // Product Management Routes
    Route::prefix('admin')->group(function () {
        // Product CRUD
        Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
        Route::post('/products/store-update/{product?}', [ProductController::class, 'storeOrUpdate'])->name('admin.products.storeUpdate');
        Route::get('/product/list', [ProductController::class, 'index'])->name('products.list');
        Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('admin.products.edit');
        Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('admin.products.destroy');

        // Image Delete (AJAX)
        Route::delete('/products/image-destroy/{id}', [ProductController::class, 'imageDestroy'])->name('admin.products.imageDestroy');

        // Bulk & Display Updates
        Route::post('/products/bulk-update', [ProductController::class, 'bulkUpdate'])->name('admin.products.bulk-update');
        Route::post('/products/quantity-display/{product}', [ProductController::class, 'updateQuantityDisplay']);
        Route::post('/products/price-display/{product}', [ProductController::class, 'updatePriceDisplay']);
        Route::post('/products/status/{product}', [ProductController::class, 'updateStatus']);
    });

    // Quote 
    Route::prefix('admin/quotes')->name('admin.quotes.')->group(function () {
        Route::get('/', [QuoteRequestController::class, 'index'])->name('index');
        Route::get('/{quoteRequest}', [QuoteRequestController::class, 'show'])->name('show');
        Route::post('/update-status', [QuoteRequestController::class, 'updateStatus'])->name('updateStatus');
        Route::patch('/{quoteRequest}/update-quantity', [QuoteRequestController::class, 'updateQuantity'])->name('updateQuantity');
        Route::patch('/{quoteRequest}/update-price', [QuoteRequestController::class, 'updatePrice'])->name('updatePrice');
        Route::post('/{quoteRequest}/convert-to-client', [QuoteRequestController::class, 'convertToClient'])->name('convertToClient');
        Route::post('/{quoteRequest}/reject', [QuoteRequestController::class, 'reject'])->name('reject');
        Route::post('/{quoteRequest}/reopen', [QuoteRequestController::class, 'reopen'])->name('reopen');
        Route::post('/{quoteRequest}/reply', [QuoteRequestController::class, 'reply'])->name('reply');
        Route::post('/{quoteRequest}/send', [QuoteRequestController::class, 'sendQuote'])->name('send');
        Route::post('/{quoteRequest}/activity', [QuoteRequestController::class, 'storeActivity'])->name('storeActivity');
        Route::delete('/{quoteRequest}', [QuoteRequestController::class, 'destroy'])->name('destroy');
    });

    // Partners
    Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
    Route::get('/partners/create', [PartnerController::class, 'create'])->name('partners.create');
    Route::post('/partners/store', [PartnerController::class, 'store'])->name('partners.store');
    Route::get('/partners/edit/{id}', [PartnerController::class, 'edit'])->name('partners.edit');
    Route::post('/partners/update/{id}', [PartnerController::class, 'update'])->name('partners.update');
    Route::delete('/partners/delete/{id}', [PartnerController::class, 'destroy'])->name('partners.destroy');

    // Variables
    Route::get('/variables', [VariablesController::class, 'create'])->name('variables.create');
    Route::post('/variables', [VariablesController::class, 'storeOrUpdate'])->name('variables.save');

    // Pages
    Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('/pages/create', [PageController::class, 'createOrUpdate'])->name('pages.create');
    Route::get('/pages/edit/{id}', [PageController::class, 'createOrUpdate'])->name('pages.edit');
    Route::post('/pages/save/{id?}', [PageController::class, 'save'])->name('pages.save');
    Route::delete('/pages/{id}', [PageController::class, 'destroy'])->name('pages.destroy');

    // Contact Messages - Admin Side
    Route::get('/admin/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('/admin/contacts/{id}/view', [ContactController::class, 'showMessage'])->name('admin.contacts.view');
    Route::post('/admin/contacts/{id}/reply', [ContactController::class, 'reply'])->name('admin.contacts.reply');
    Route::delete('/admin/contacts/{id}', [ContactController::class, 'destroy'])->name('admin.contacts.delete');
});

require __DIR__ . '/auth.php';
