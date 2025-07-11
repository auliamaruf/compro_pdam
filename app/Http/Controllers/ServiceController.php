<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        // Company data is now provided globally by CompanyDataServiceProvider
        $services = Service::active()->orderBy('sort_order')->get();

        // Group services by category
        $servicesByCategory = $services->groupBy('category');

        return view('services.index', compact('services', 'servicesByCategory'));
    }

    public function show($slug)
    {
        // Company data is now provided globally by CompanyDataServiceProvider
        $service = Service::where('slug', $slug)->active()->firstOrFail();

        // Get related services
        $relatedServices = Service::active()
            ->where('id', '!=', $service->id)
            ->where('category', $service->category)
            ->take(3)
            ->get();

        return view('services.show', compact('service', 'relatedServices'));
    }

    public function sambunganBaru()
    {
        // Company data is now provided globally by CompanyDataServiceProvider
        return view('services.sambungan-baru');
    }

    public function pengaduan()
    {
        // Company data is now provided globally by CompanyDataServiceProvider
        return view('services.pengaduan');
    }

    public function pembayaran()
    {
        // Company data is now provided globally by CompanyDataServiceProvider
        return view('services.pembayaran');
    }
}
