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
        
        // Get sambungan baru service with forms
        $sambunganBaruService = Service::where('slug', 'sambungan-baru')
            ->orWhere('name', 'like', '%sambungan%baru%')
            ->orWhere('category', 'new_connection')
            ->active()
            ->first();

        // If no specific service found, get all services with forms for fallback
        $servicesWithForms = Service::active()
            ->whereHas('media', function($query) {
                $query->where('collection_name', 'forms');
            })
            ->get();

        return view('services.sambungan-baru', compact('sambunganBaruService', 'servicesWithForms'));
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

    public function downloadForm(Service $service, $mediaId)
    {
        $media = $service->getMedia('forms')->find($mediaId);
        
        if (!$media) {
            abort(404, 'Formulir tidak ditemukan');
        }

        // Get the file path
        $filePath = $media->getPath();
        
        if (!file_exists($filePath)) {
            abort(404, 'File formulir tidak ditemukan');
        }

        // Get proper filename with extension
        $fileName = $media->file_name ?: $media->name; // This includes the original extension
        
        // Debug: Log media properties (remove this after testing)
        \Log::info('Media Debug', [
            'name' => $media->name,
            'file_name' => $media->file_name,
            'mime_type' => $media->mime_type,
            'original_filename' => $media->getCustomProperty('original_filename'),
        ]);
        
        // Fallback: if file_name doesn't have extension, add it based on mime_type
        if (!pathinfo($fileName, PATHINFO_EXTENSION)) {
            $extension = match($media->mime_type) {
                'application/pdf' => '.pdf',
                'application/msword' => '.doc',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document' => '.docx',
                default => ''
            };
            $fileName = ($media->name ?: 'formulir') . $extension;
        }

        // Return download response with proper headers and filename
        return response()->download($filePath, $fileName, [
            'Content-Type' => $media->mime_type,
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"'
        ]);
    }
}
