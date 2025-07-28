<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\OnlineComplaintController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\FilamentTestController;

// Test routes
Route::get('/test/company-setting', [TestController::class, 'testCompanySetting'])->name('test.company-setting');
Route::get('/test/filament-resource', [FilamentTestController::class, 'testResource'])->name('test.filament-resource');

// Admin test route
Route::get('/test/admin-user', function() {
    $user = App\Models\User::first();
    if (!$user) {
        return response()->json([
            'status' => 'error',
            'message' => 'No admin user found. Please run seeder.',
            'suggestion' => 'php artisan db:seed --class=DatabaseSeeder'
        ]);
    }
    
    return response()->json([
        'status' => 'success',
        'admin_user' => [
            'email' => $user->email,
            'name' => $user->name,
            'created_at' => $user->created_at
        ],
        'login_info' => [
            'url' => url('/admin'),
            'email' => $user->email,
            'password' => 'password (default)'
        ]
    ]);
})->name('test.admin-user');

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// About & Company Profile
Route::get('/tentang', [HomeController::class, 'about'])->name('about');
Route::get('/tentang/sejarah', [HomeController::class, 'aboutHistory'])->name('about.history');
Route::get('/tentang/visi-misi', [HomeController::class, 'aboutVisionMission'])->name('about.vision-mission');
Route::get('/tentang/struktur-organisasi', [HomeController::class, 'aboutOrganization'])->name('about.organization');
Route::get('/tentang/cabang', [HomeController::class, 'branches'])->name('about.branches');

// Services
Route::prefix('layanan')->group(function () {
    Route::get('/', [ServiceController::class, 'index'])->name('services');
    Route::get('/sambungan-baru', [ServiceController::class, 'sambunganBaru'])->name('services.sambungan-baru');
    Route::get('/pengaduan', [ServiceController::class, 'pengaduan'])->name('services.pengaduan');
    Route::get('/pembayaran', [ServiceController::class, 'pembayaran'])->name('services.pembayaran');
    Route::get('/download-form/{service}/{media}', [ServiceController::class, 'downloadForm'])->name('services.download-form');
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

// Contact & Support - dengan rate limiting
Route::middleware(['throttle:10,1'])->group(function () {
    Route::get('/kontak', [ContactController::class, 'index'])->name('contact')->withoutMiddleware('throttle:10,1');
    Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');
});

// Online Services
Route::get('/cek-tagihan', [HomeController::class, 'checkBill'])->name('check-bill');
Route::get('/download-center', [HomeController::class, 'downloadCenter'])->name('download-center');
Route::get('/dokumentasi', [HomeController::class, 'documentation'])->name('documentation');

// Online Complaint - dengan rate limiting ketat
Route::prefix('pengaduan-online')->middleware(['throttle:5,1'])->group(function () {
    Route::get('/', [OnlineComplaintController::class, 'index'])->name('complaint')->withoutMiddleware('throttle:5,1');
    Route::post('/', [OnlineComplaintController::class, 'store'])->name('complaint.store');
    Route::get('/success/{ticketNumber}', [OnlineComplaintController::class, 'success'])->name('complaint.success')->withoutMiddleware('throttle:5,1');
    Route::get('/track', [OnlineComplaintController::class, 'track'])->name('complaint.track')->withoutMiddleware('throttle:5,1');
    Route::post('/track', [OnlineComplaintController::class, 'track'])->name('complaint.track.search');
});

// Search
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/search/suggest', [SearchController::class, 'suggest'])->name('search.suggest');

// API Routes untuk AJAX - dengan rate limiting
Route::middleware(['throttle:30,1'])->group(function () {
    Route::post('/search/api', [SearchController::class, 'api'])->name('search.api');
    Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
});

// Debug route
Route::get('/debug-hero', function () {
    $company = App\Models\CompanySetting::first();
    if (!$company) {
        return 'No company setting found';
    }
    
    return [
        'hero_slides_raw' => $company->getAttributes()['hero_slides'] ?? null,
        'hero_slides_cast' => $company->hero_slides,
        'is_array' => is_array($company->hero_slides),
        'count' => is_array($company->hero_slides) ? count($company->hero_slides) : 0,
        'active_slides' => is_array($company->hero_slides) ? 
            array_filter($company->hero_slides, fn($slide) => $slide['is_active'] ?? false) : [],
    ];
});

// Test frontend data route
Route::get('/test-frontend-data', function () {
    $company = App\Models\CompanySetting::current();
    if (!$company) {
        return 'No company setting found';
    }
    
    return [
        'hero_section' => [
            'hero_slides_count' => is_array($company->hero_slides) ? count($company->hero_slides) : 0,
            'active_slides' => is_array($company->hero_slides) ? 
                array_filter($company->hero_slides, fn($slide) => $slide['is_active'] ?? false) : [],
        ],
        'statistics' => [
            'years_experience' => $company->years_experience,
            'customers_served' => $company->customers_served,
            'water_quality_percentage' => $company->water_quality_percentage,
            'service_availability' => $company->service_availability,
        ],
        'organization' => [
            'organization_structure_count' => is_array($company->organization_structure) ? count($company->organization_structure) : 0,
            'has_organization_description' => !empty($company->organization_structure_description),
        ],
        'company_info' => [
            'name' => $company->company_name,
            'tagline' => $company->company_tagline,
            'vision' => $company->vision,
            'mission_points_count' => is_array($company->mission_points) ? count($company->mission_points) : 0,
            'core_values_count' => is_array($company->core_values) ? count($company->core_values) : 0,
        ],
        'contact' => [
            'phone' => $company->phone,
            'email' => $company->email,
            'address' => $company->address,
        ]
    ];
});

// Dynamic Pages (harus di akhir agar tidak mengganggu route lain)
Route::get('/{page}', [App\Http\Controllers\PageController::class, 'show'])->name('page.show');
