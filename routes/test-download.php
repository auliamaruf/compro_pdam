<?php
// Test route untuk debug download

use App\Models\Service;

Route::get('/test-download', function() {
    $service = Service::where('slug', 'pemasangan-sambungan-baru-rumah-tangga')->first();
    
    if (!$service) {
        return response()->json(['error' => 'Service not found']);
    }
    
    $media = $service->getMedia('forms');
    
    return response()->json([
        'service_name' => $service->name,
        'forms_count' => $media->count(),
        'forms' => $media->map(function($m) {
            return [
                'id' => $m->id,
                'name' => $m->name,
                'file_name' => $m->file_name,
                'path' => $m->getPath(),
                'url' => $m->getUrl(),
                'exists' => file_exists($m->getPath())
            ];
        })
    ]);
});
