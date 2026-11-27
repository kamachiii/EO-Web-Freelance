<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RobotstxtController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceDetailController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\StoreInquiryController;
use App\Http\Controllers\SupportingServiceController;
use Illuminate\Support\Facades\Route;

// URL pendek, huruf kecil, kata dipisah tanda hubung (docs/AGENTS.md bagian 10).
Route::get('/', HomeController::class)->name('home');
Route::get('/tentang', AboutController::class)->name('about');
Route::get('/layanan', ServiceController::class)->name('services.index');
Route::get('/layanan/{service}', ServiceDetailController::class)->name('services.show');
Route::get('/layanan-pendukung', SupportingServiceController::class)->name('supporting-services.index');
Route::get('/kontak', ContactController::class)->name('contact');

// Batasi spam dari form Kontak (docs/AGENTS.md bagian 11).
Route::post('/kontak', StoreInquiryController::class)
    ->middleware('throttle:5,10')
    ->name('contact.store');

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
Route::get('/robots.txt', RobotstxtController::class)->name('robots');
