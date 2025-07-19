<?php

namespace App\Observers;

use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Illuminate\Support\Facades\Auth;

class MediaObserver
{
    public function created(Media $media)
    {
        // Track when media is uploaded
        if ($media->model) {
            activity()
                ->performedOn($media->model)
                ->causedBy(Auth::user())
                ->withProperties([
                    'media_id' => $media->getAttribute('id'),
                    'media_name' => $media->name,
                    'media_collection' => $media->collection_name,
                    'media_file_name' => $media->file_name,
                    'media_size' => $media->size,
                    'media_mime_type' => $media->mime_type,
                ])
                ->log("Media '{$media->name}' ditambahkan ke {$this->getModelName($media->model)} '{$this->getModelTitle($media->model)}'");
        }
    }

    public function deleted(Media $media)
    {
        // Track when media is deleted
        if ($media->model) {
            activity()
                ->performedOn($media->model)
                ->causedBy(Auth::user())
                ->withProperties([
                    'media_id' => $media->getAttribute('id'),
                    'media_name' => $media->name,
                    'media_collection' => $media->collection_name,
                    'media_file_name' => $media->file_name,
                ])
                ->log("Media '{$media->name}' dihapus dari {$this->getModelName($media->model)} '{$this->getModelTitle($media->model)}'");
        }
    }

    private function getModelName($model): string
    {
        return match(get_class($model)) {
            'App\Models\HeroBanner' => 'Hero Banner',
            'App\Models\News' => 'Berita',
            'App\Models\Service' => 'Layanan',
            'App\Models\CompanySetting' => 'Pengaturan Perusahaan',
            'App\Models\CompanyHistory' => 'Sejarah Perusahaan',
            'App\Models\Page' => 'Halaman',
            default => class_basename($model)
        };
    }

    private function getModelTitle($model): string
    {
        return match(get_class($model)) {
            'App\Models\HeroBanner' => $model->title ?? 'Unknown',
            'App\Models\News' => $model->title ?? 'Unknown',
            'App\Models\Service' => $model->name ?? 'Unknown',
            'App\Models\CompanySetting' => 'Company Settings',
            'App\Models\CompanyHistory' => $model->title ?? 'Unknown',
            'App\Models\Page' => $model->title ?? 'Unknown',
            default => 'Unknown'
        };
    }
}
