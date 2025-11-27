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

use Pest\Plugins\Only;

// Welcome Page
Route::get('/', [HeroSectionController::class, 'index'])->name('welcome');

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

    // Home Controller 
    Route::get('/hero/section/list', [HomeController::class, 'index'])->name('hero-section.index');

    // Hero Section
    Route::get('/hero/create', [HeroSectionController::class, 'form'])->name('hero.create');
    Route::get('/hero/edit/{id}', [HeroSectionController::class, 'form'])->name('hero.edit');
    Route::post('/hero/save/{id?}', [HeroSectionController::class, 'save'])->name('hero.save');
    Route::delete('/hero/delete/{id}', [HeroSectionController::class, 'destroy'])->name('hero.delete');

    // Services
    Route::get('/services/create', [ServicesController::class, 'form'])->name('services.create');
    Route::get('/services/edit/{id}', [ServicesController::class, 'form'])->name('services.edit');
    Route::post('/services/save/{id?}', [ServicesController::class, 'save'])->name('services.save');
    Route::delete('/services/delete/{id}', [ServicesController::class, 'destroy'])->name('services.delete');

    // Teams 
    Route::get('/teams/createorupdate', [TeamController::class, 'createorupdate'])->name('teams.createorupdate');
    Route::get('/teams/list', [TeamController::class, 'index'])->name('teams.list');

    //Faqs 
    Route::get('/faqs', [FaqsController::class, 'index'])->name('faqs.index');
    Route::get('/faqs/create', [FaqsController::class, 'create'])->name('faqs.create');
    Route::post('/faqs', [FaqsController::class, 'store'])->name('faqs.store');
    Route::get('/faqs/{id}/edit', [FaqsController::class, 'edit'])->name('faqs.edit');
    Route::put('/faqs/{id}', [FaqsController::class, 'update'])->name('faqs.update');
    Route::delete('/faqs/{id}', [FaqsController::class, 'destroy'])->name('faqs.destroy');


    // Products
    Route::get('/product/add', [ProductController::class, 'productAdd'])->name('products.create');
    Route::get('/product/list', [ProductController::class, 'productList'])->name('products.list');
});

require __DIR__ . '/auth.php';
