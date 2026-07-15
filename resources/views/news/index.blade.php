@extends('layouts.app')

@section('title', 'Berita dan Informasi - ' . ($company->company_name ?? 'PDAM Tirta Perwira'))

@section('content')
<div class="bg-gray-50 dark:bg-gray-900 min-h-screen">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content container-custom">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="hero-title">Berita & Informasi</h1>
                <p class="hero-description">
                    Dapatkan informasi terbaru seputar pelayanan dan perkembangan {{ $company->company_name ?? 'PDAM Tirta Perwira' }}
                </p>
            </div>
        </div>
    </section>

    <!-- News Grid -->
    <section class="section-padding">
        <div class="container-custom">
            <!-- Filter Tabs -->
            <div class="flex flex-wrap justify-center mb-8 border-b border-gray-200 dark:border-gray-700">
                <a href="{{ route('news') }}"
                   class="px-6 py-3 border-b-2 font-medium text-sm {{ $type === 'all' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Semua
                </a>
                <a href="{{ route('news', ['type' => 'news']) }}"
                   class="px-6 py-3 border-b-2 font-medium text-sm {{ $type === 'news' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Berita
                </a>
                <a href="{{ route('news', ['type' => 'announcement']) }}"
                   class="px-6 py-3 border-b-2 font-medium text-sm {{ $type === 'announcement' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Pengumuman
                </a>
                <a href="{{ route('news', ['type' => 'emergency']) }}"
                   class="px-6 py-3 border-b-2 font-medium text-sm {{ $type === 'emergency' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                    Darurat
                </a>
            </div>

            @if($news->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($news as $article)
                <article class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <!-- Featured Image -->
                    @if($article->getFirstMediaUrl('featured_image'))
                    <a href="{{ route('news.show', $article->slug) }}" class="block aspect-video overflow-hidden">
                        <img src="{{ $article->getFirstMediaUrl('featured_image') }}"
                             alt="{{ $article->title }}"
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-300"
                             loading="lazy" width="400" height="225">
                    </a>
                    @endif

                    <div class="p-6">
                        <!-- Article Meta -->
                        <div class="flex items-center justify-between mb-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                @if($article->type === 'news') bg-blue-100 text-blue-800
                                @elseif($article->type === 'announcement') bg-cyan-100 text-cyan-800
                                @elseif($article->type === 'emergency') bg-orange-100 text-orange-800
                                @else bg-gray-100 dark:bg-gray-800 text-gray-800
                                @endif">
                                {{ ucfirst($article->type) }}
                            </span>
                            @if($article->is_featured)
                            <span class="inline-flex items-center text-yellow-600">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </span>
                            @endif
                        </div>

                        <!-- Article Title -->
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 line-clamp-2">
                            <a href="{{ route('news.show', $article->slug) }}" class="hover:text-blue-600 transition-colors">
                                {{ $article->title }}
                            </a>
                        </h3>

                        <!-- Article Excerpt -->
                        @if($article->excerpt)
                        <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-3">
                            {{ $article->excerpt }}
                        </p>
                        @endif

                        <!-- Article Footer -->
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <time datetime="{{ $article->published_at->format('Y-m-d') }}">
                                {{ $article->published_at->format('d M Y') }}
                            </time>
                            <div class="flex items-center space-x-4">
                                @if($article->views > 0)
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    {{ number_format($article->views) }}
                                </span>
                                @endif
                                <a href="{{ route('news.show', $article->slug) }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                    Baca →
                                </a>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-12">
                {{ $news->withQueryString()->links() }}
            </div>
            @else
            <!-- Empty State -->
            <div class="col-span-full text-center py-16">
                <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 dark:bg-gray-800 rounded-full flex items-center justify-center">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Belum Ada Berita</h2>
                <p class="text-lg text-gray-600 dark:text-gray-400 mb-8 max-w-2xl mx-auto">
                    Berita untuk kategori ini belum tersedia saat ini.
                </p>
                <a href="{{ route('home') }}" class="btn-primary">
                    Kembali ke Beranda
                </a>
            </div>
            @endif
        </div>
    </section>
</div>
@endsection
