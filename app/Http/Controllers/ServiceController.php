<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\CompanySetting;

class ServiceController extends Controller
{
    public function index()
    {
        $company = CompanySetting::current();
        $services = Service::active()->orderBy('sort_order')->get();

        // Group services by category
        $servicesByCategory = $services->groupBy('category');

        return view('services.index', compact('company', 'services', 'servicesByCategory'));
    }

    public function show($slug)
    {
        $company = CompanySetting::current();
        $service = Service::where('slug', $slug)->active()->firstOrFail();

        // Get related services
        $relatedServices = Service::active()
            ->where('id', '!=', $service->id)
            ->where('category', $service->category)
            ->take(3)
            ->get();

        return view('services.show', compact('company', 'service', 'relatedServices'));
    }

    public function sambunganBaru()
    {
        $company = CompanySetting::current();
        return view('services.sambungan-baru', compact('company'));
    }

    public function pengaduan()
    {
        $company = CompanySetting::current();
        return view('services.pengaduan', compact('company'));
    }

    public function pembayaran()
    {
        $company = CompanySetting::current();
        return view('services.pembayaran', compact('company'));
    }
}
