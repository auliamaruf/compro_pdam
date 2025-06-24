<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OnlineComplaintController;
use App\Http\Controllers\CommentController;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// About & Company Profile
Route::get('/tentang', [HomeController::class, 'about'])->name('about');
Route::get('/tentang/sejarah', [HomeController::class, 'aboutHistory'])->name('about.history');
Route::get('/tentang/visi-misi', [HomeController::class, 'aboutVisionMission'])->name('about.vision-mission');
Route::get('/tentang/struktur-organisasi', [HomeController::class, 'aboutOrganization'])->name('about.organization');

// Services
Route::prefix('layanan')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('services');
    Route::get('/sambungan-baru', [ServiceController::class, 'sambunganBaru'])->name('services.sambungan-baru');
    Route::get('/pengaduan', [ServiceController::class, 'pengaduan'])->name('services.pengaduan');
    Route::get('/pembayaran', [ServiceController::class, 'pembayaran'])->name('services.pembayaran');
    Route::get('/{slug}', [ServiceController::class, 'show'])->name('services.show');
});

// News & Information
Route::prefix('berita')->group(function () {
    Route::get('/', [NewsController::class, 'index'])->name('news');
    Route::get('/{slug}', [NewsController::class, 'show'])->name('news.show');
});

// Information Pages
Route::get('/tarif', [HomeController::class, 'tariff'])->name('tariff');
Route::get('/tarif-air', [HomeController::class, 'tariff'])->name('tariff.alternative');

// Contact & Support
Route::get('/kontak', [ContactController::class, 'index'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');

// Online Services
Route::get('/cek-tagihan', [HomeController::class, 'checkBill'])->name('check-bill');
Route::get('/download-center', [HomeController::class, 'downloadCenter'])->name('download-center');
Route::get('/dokumentasi', [HomeController::class, 'documentation'])->name('documentation');

// Online Complaint
Route::prefix('pengaduan-online')->group(function () {
    Route::get('/', [OnlineComplaintController::class, 'index'])->name('complaint');
    Route::post('/', [OnlineComplaintController::class, 'store'])->name('complaint.store');
    Route::get('/success/{ticketNumber}', [OnlineComplaintController::class, 'success'])->name('complaint.success');
    Route::get('/track', [OnlineComplaintController::class, 'track'])->name('complaint.track');
    Route::post('/track', [OnlineComplaintController::class, 'track'])->name('complaint.track.search');
});

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/search/suggest', [SearchController::class, 'suggest'])->name('search.suggest');

// Comments
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
