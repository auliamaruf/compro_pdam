<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\Service;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sample images URLs (you can replace with local files or external URLs)
        $sampleImages = [
            'https://picsum.photos/1200/675?random=1',
            'https://picsum.photos/1200/675?random=2',
            'https://picsum.photos/1200/675?random=3',
            'https://picsum.photos/1200/675?random=4',
            'https://picsum.photos/1200/675?random=5',
            'https://picsum.photos/1200/675?random=6',
            'https://picsum.photos/1200/675?random=7',
            'https://picsum.photos/1200/675?random=8',
        ];

        $galleryImages = [
            'https://picsum.photos/800/600?random=10',
            'https://picsum.photos/800/600?random=11',
            'https://picsum.photos/800/600?random=12',
            'https://picsum.photos/800/600?random=13',
            'https://picsum.photos/800/600?random=14',
            'https://picsum.photos/800/600?random=15',
        ];

        // Add featured images to news
        $news = News::all();
        foreach ($news as $index => $article) {
            if ($index < count($sampleImages)) {
                try {
                    $article->addMediaFromUrl($sampleImages[$index])
                        ->toMediaCollection('featured_image');
                } catch (\Exception $e) {
                    // Skip if URL is not accessible
                    continue;
                }

                // Add some gallery images to featured articles
                if ($article->is_featured && $index < 3) {
                    for ($i = 0; $i < 3; $i++) {
                        $galleryIndex = ($index * 3 + $i) % count($galleryImages);
                        try {
                            $article->addMediaFromUrl($galleryImages[$galleryIndex])
                                ->toMediaCollection('gallery');
                        } catch (\Exception $e) {
                            continue;
                        }
                    }
                }
            }
        }

        // Add icons/images to services
        $serviceImages = [
            'https://picsum.photos/400/400?random=20',
            'https://picsum.photos/400/400?random=21',
            'https://picsum.photos/400/400?random=22',
            'https://picsum.photos/400/400?random=23',
            'https://picsum.photos/400/400?random=24',
            'https://picsum.photos/400/400?random=25',
        ];

        $services = Service::all();
        foreach ($services as $index => $service) {
            if ($index < count($serviceImages)) {
                try {
                    $service->addMediaFromUrl($serviceImages[$index])
                        ->toMediaCollection('icons');
                } catch (\Exception $e) {
                    continue;
                }
            }
        }

        $this->command->info('Sample media added successfully!');
    }
}
