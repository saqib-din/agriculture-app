<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SingleController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\TeamController;

// Backend Controllers
use App\Http\Controllers\BackendProductController;



Route::get('/', function () {
    return view('pages.landing.index');
});

// Products
Route::get('/singleproduct', [SingleController::class, 'show'])->name('singleproduct');
Route::get('/products', [CategoriesController::class, 'show'])->name('products');

Route::get('/services', [ServicesController::class, 'show'])->name('services');


// Teams
Route::get('/teams', [TeamController::class, 'show'])->name('teams');

// About Us
Route::get('/aboutus', [AboutController::class, 'show'])->name('aboutus');


Route::get('/contactus', [ContactController::class, 'show'])->name('contactus');



// Contact Us
Route::get('/contactus', [ContactController::class, 'show'])->name('contactus');

// 404 error page
Route::get('/not-found', function () {
    return view('pages.errors.404');
})->name('not-found');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/product/add', [BackendProductController::class, 'productAdd'])->name('backend.products.create');

});

require __DIR__ . '/auth.php';
