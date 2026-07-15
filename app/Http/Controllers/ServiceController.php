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

    public function pengaduan()
    {
        // Company data is now provided globally by CompanyDataServiceProvider
        return view('services.pengaduan');
    }

    public function pembayaran()
    {
        abort(404);
    }

    public function downloadForm(Service $service, $mediaId)
    {
        try {
            $media = $service->getMedia('forms')->find($mediaId);
            
            if (!$media) {
                abort(404, 'Formulir tidak ditemukan');
            }

            // Get the file path
            $filePath = $media->getPath();
            
            if (!file_exists($filePath)) {
                abort(404, 'File formulir tidak ditemukan di server');
            }

            // Get proper filename with extension
            $fileName = $media->file_name ?: $media->name;
            
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
            
        } catch (\Exception $e) {
            // Log error untuk debugging
            \Log::error('Download Form Error', [
                'service_id' => $service->id,
                'media_id' => $mediaId,
                'error' => $e->getMessage()
            ]);
            
            abort(500, 'Terjadi kesalahan saat mengunduh formulir');
        }
    }
}
