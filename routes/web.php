<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SingleController;
use App\Http\Controllers\CategoriesController;
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

// Welcome Page
Route::get('/', [HomeController::class, 'welcome'])->name('welcomepage');

// Products
Route::get('/singleproduct', [SingleController::class, 'show'])->name('singleproduct');
Route::get('/products', [CategoriesController::class, 'show'])->name('products');

// Services
Route::get('/services', [ServicesController::class, 'show'])->name('services');

// Teams
Route::get('/teams', [TeamController::class, 'show'])->name('teams');

// About Us
Route::get('/aboutus', [AboutController::class, 'show'])->name('aboutus');

// Contact Us
Route::get('/contactus', [ContactController::class, 'show'])->name('contactus');
Route::post('/contact-submit', [ContactController::class, 'store'])->name('contact.submit');

// 404 error page
Route::get('/not-found', function () {
    return view('pages.errors.404');
})->name('not-found');

// Only Authenticated Users
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
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

    //Faqs 
    Route::get('/faqs', [FaqsController::class, 'index'])->name('faqs.index');
    Route::get('/faqs/create', [FaqsController::class, 'create'])->name('faqs.create');
    Route::post('/faqs', [FaqsController::class, 'store'])->name('faqs.store');
    Route::get('/faqs/{id}/edit', [FaqsController::class, 'edit'])->name('faqs.edit');
    Route::put('/faqs/{id}', [FaqsController::class, 'update'])->name('faqs.update');
    Route::delete('/faqs/{id}', [FaqsController::class, 'destroy'])->name('faqs.destroy');

    //Testimonial
    Route::get('/testimonials', [TestimonialsController::class, 'index'])->name('testimonials.index');
    Route::get('/testimonials/create', [TestimonialsController::class, 'create'])->name('testimonials.create');
    Route::post('/testimonials/store', [TestimonialsController::class, 'store'])->name('testimonials.store');
    Route::get('/testimonials/edit/{id}', [TestimonialsController::class, 'edit'])->name('testimonials.edit');
    Route::post('/testimonials/update/{id}', [TestimonialsController::class, 'update'])->name('testimonials.update');
    Route::delete('/testimonials/delete/{id}', [TestimonialsController::class, 'destroy'])
        ->name('testimonials.destroy');

    // Products
    Route::get('/product/add', [ProductController::class, 'productAdd'])->name('products.create');
    Route::get('/product/list', [ProductController::class, 'productList'])->name('products.list');

    // Partners
    Route::get('/partners', [PartnerController::class, 'index'])->name('partners.index');
    Route::get('/partners/create', [PartnerController::class, 'create'])->name('partners.create');
    Route::post('/partners/store', [PartnerController::class, 'store'])->name('partners.store');
    Route::get('/partners/edit/{id}', [PartnerController::class, 'edit'])->name('partners.edit');
    Route::post('/partners/update/{id}', [PartnerController::class, 'update'])->name('partners.update');
    Route::get('/partners/delete/{id}', [PartnerController::class, 'destroy'])->name('partners.destroy');

    // Variables
    Route::get('/variables', [VariablesController::class, 'index'])->name('variables.index');
    Route::get('/variables/create-or-update/{id?}', [VariablesController::class, 'createorupdate'])->name('variables.createorupdate');

    // Contact Messages - Admin Side
    Route::get('/admin/contacts', [ContactController::class, 'index'])->name('admin.contacts.index');
    Route::get('/admin/contacts/{id}/view', [ContactController::class, 'showMessage'])->name('admin.contacts.view');
    Route::post('/admin/contacts/{id}/reply', [ContactController::class, 'reply'])->name('admin.contacts.reply');
    Route::delete('/admin/contacts/{id}', [ContactController::class, 'destroy'])->name('admin.contacts.delete');
});

require __DIR__ . '/auth.php';
