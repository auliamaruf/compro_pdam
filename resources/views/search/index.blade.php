@extends('layouts.app')

@section('title', 'Pencarian: ' . $query . ' - ' . $company->name)

@section('meta')
<meta name="description" content="Hasil pencarian untuk: {{ $query }}">
<meta name="robots" content="noindex">
@endsection

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Search Header -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content container-custom">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="hero-title">Hasil Pencarian</h1>
                @if($query)
                <p class="hero-description mb-6">
                    Menampilkan hasil untuk: <strong>"{{ $query }}"</strong>
                </p>
                <p class="text-blue-200">
                    Ditemukan {{ number_format($totalResults) }} hasil
                </p>
                @endif
            </div>
        </div>
        <div class="hero-wave">
            <svg viewBox="0 0 1200 120" class="w-full h-12 fill-current text-blue-50">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"></path>
            </svg>
        </div>
    </section>

    <div class="container-custom py-8">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Search Sidebar -->
            <div class="lg:col-span-1">
                <!-- Search Form -->
                <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Pencarian</h3>
                    <form action="{{ route('search') }}" method="GET" class="space-y-4">
                        <div>
                            <input type="text"
                                   name="q"
                                   value="{{ $query }}"
                                   placeholder="Masukkan kata kunci..."
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   autocomplete="off">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <select name="type" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="all" {{ $type === 'all' ? 'selected' : '' }}>Semua</option>
                                <option value="news" {{ $type === 'news' ? 'selected' : '' }}>Berita</option>
                                <option value="services" {{ $type === 'services' ? 'selected' : '' }}>Layanan</option>
                                <option value="pages" {{ $type === 'pages' ? 'selected' : '' }}>Halaman</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg hover:bg-blue-700 transition-colors font-medium">
                            <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari
                        </button>
                    </form>
                </div>

                <!-- Quick Links -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Pencarian Populer</h3>
                    <div class="space-y-2">
                        <a href="{{ route('search', ['q' => 'sambungan baru']) }}"
                           class="block text-blue-600 hover:text-blue-800 text-sm">
                            Sambungan Baru
                        </a>
                        <a href="{{ route('search', ['q' => 'tarif air']) }}"
                           class="block text-blue-600 hover:text-blue-800 text-sm">
                            Tarif Air
                        </a>
                        <a href="{{ route('search', ['q' => 'pengaduan']) }}"
                           class="block text-blue-600 hover:text-blue-800 text-sm">
                            Pengaduan
                        </a>
                        <a href="{{ route('search', ['q' => 'pembayaran']) }}"
                           class="block text-blue-600 hover:text-blue-800 text-sm">
                            Pembayaran
                        </a>
                        <a href="{{ route('search', ['q' => 'gangguan']) }}"
                           class="block text-blue-600 hover:text-blue-800 text-sm">
                            Gangguan Air
                        </a>
                    </div>
                </div>
            </div>

            <!-- Search Results -->
            <div class="lg:col-span-3">
                @if($query && $totalResults > 0)
                <!-- Filter Tabs -->
                <div class="flex flex-wrap justify-start mb-6 border-b border-gray-200">
                    <a href="{{ route('search', ['q' => $query, 'type' => 'all']) }}"
                       class="px-4 py-3 border-b-2 font-medium text-sm {{ $type === 'all' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Semua ({{ $totalResults }})
                    </a>
                    <a href="{{ route('search', ['q' => $query, 'type' => 'news']) }}"
                       class="px-4 py-3 border-b-2 font-medium text-sm {{ $type === 'news' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Berita
                    </a>
                    <a href="{{ route('search', ['q' => $query, 'type' => 'services']) }}"
                       class="px-4 py-3 border-b-2 font-medium text-sm {{ $type === 'services' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Layanan
                    </a>
                    <a href="{{ route('search', ['q' => $query, 'type' => 'pages']) }}"
                       class="px-4 py-3 border-b-2 font-medium text-sm {{ $type === 'pages' ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                        Halaman
                    </a>
                </div>

                <!-- Results List -->
                <div class="space-y-6">
                    @foreach($results as $result)
                    <div class="bg-white rounded-lg shadow-lg p-6 hover:shadow-xl transition-shadow duration-300">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <!-- Result Type Badge -->
                                <div class="flex items-center mb-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                        @if($result->result_type === 'news') bg-blue-100 text-blue-800
                                        @elseif($result->result_type === 'service') bg-blue-100 text-blue-800
                                        @else bg-purple-100 text-purple-800
                                        @endif">
                                        @if($result->result_type === 'news')
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $result->category_name }}
                                        @elseif($result->result_type === 'service')
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $result->category_name }}
                                        @else
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path>
                                        </svg>
                                        {{ $result->category_name }}
                                        @endif
                                    </span>
                                </div>                                <!-- Result Title -->
                                <h3 class="text-xl font-bold text-gray-900 mb-2">
                                    <a href="{{ $result->url }}" class="hover:text-blue-600 transition-colors">
                                        {!! $result->highlighted_title ?? $result->title !!}
                                    </a>
                                </h3>

                                <!-- Result Excerpt -->
                                @if($result->excerpt)
                                <p class="text-gray-600 mb-3 line-clamp-3">
                                    {!! Str::limit(strip_tags($result->highlighted_excerpt ?? $result->excerpt, '<mark>'), 200) !!}
                                </p>
                                @endif

                                <!-- Result Meta -->
                                <div class="flex items-center text-sm text-gray-500 space-x-4">
                                    @if($result->result_type === 'news' && $result->published_at)
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        {{ $result->published_at->format('d M Y') }}
                                    </span>
                                    @endif

                                    @if($result->result_type === 'news' && $result->views)
                                    <span class="flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        {{ number_format($result->views) }} views
                                    </span>
                                    @endif

                                    <a href="{{ $result->url }}" class="text-blue-600 hover:text-blue-800 font-medium">
                                        Baca Selengkapnya →
                                    </a>
                                </div>
                            </div>

                            <!-- Result Image -->
                            @if($result->result_type === 'news' && $result->getFirstMediaUrl('featured_image'))
                            <div class="ml-4 flex-shrink-0">
                                <img src="{{ $result->getFirstMediaUrl('featured_image') }}"
                                     alt="{{ $result->title }}"
                                     class="w-24 h-24 object-cover rounded-lg">
                            </div>
                            @elseif($result->result_type === 'service' && $result->getFirstMediaUrl('icons'))
                            <div class="ml-4 flex-shrink-0">
                                <img src="{{ $result->getFirstMediaUrl('icons') }}"
                                     alt="{{ $result->title }}"
                                     class="w-24 h-24 object-cover rounded-lg">
                            </div>
                            @endif
                        </div>
                    </div>                    @endforeach
                </div>

                <!-- Pagination -->
                @if($query && $totalResults > $perPage)
                @php
                    $currentPage = request()->get('page', 1);
                    $totalPages = ceil($totalResults / $perPage);
                    $startResult = (($currentPage - 1) * $perPage) + 1;
                    $endResult = min($currentPage * $perPage, $totalResults);
                @endphp

                <div class="mt-8 border-t border-gray-200 pt-6">
                    <div class="flex items-center justify-between">
                        <div class="text-sm text-gray-700">
                            Menampilkan <span class="font-medium">{{ $startResult }}</span>
                            sampai <span class="font-medium">{{ $endResult }}</span>
                            dari <span class="font-medium">{{ number_format($totalResults) }}</span> hasil
                        </div>

                        @if($totalPages > 1)
                        <div class="flex items-center space-x-2">
                            <!-- Previous Page -->
                            @if($currentPage > 1)
                            <a href="{{ route('search', array_merge(request()->query(), ['page' => $currentPage - 1])) }}"
                               class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                </svg>
                                Sebelumnya
                            </a>
                            @endif

                            <!-- Page Numbers -->
                            @php
                                $start = max(1, $currentPage - 2);
                                $end = min($totalPages, $currentPage + 2);
                            @endphp

                            @if($start > 1)
                                <a href="{{ route('search', array_merge(request()->query(), ['page' => 1])) }}"
                                   class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                    1
                                </a>
                                @if($start > 2)
                                    <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700">...</span>
                                @endif
                            @endif

                            @for($i = $start; $i <= $end; $i++)
                                @if($i == $currentPage)
                                    <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-white bg-blue-600 border border-blue-600 rounded-md">
                                        {{ $i }}
                                    </span>
                                @else
                                    <a href="{{ route('search', array_merge(request()->query(), ['page' => $i])) }}"
                                       class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                        {{ $i }}
                                    </a>
                                @endif
                            @endfor

                            @if($end < $totalPages)
                                @if($end < $totalPages - 1)
                                    <span class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-700">...</span>
                                @endif
                                <a href="{{ route('search', array_merge(request()->query(), ['page' => $totalPages])) }}"
                                   class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                    {{ $totalPages }}
                                </a>
                            @endif

                            <!-- Next Page -->
                            @if($currentPage < $totalPages)
                            <a href="{{ route('search', array_merge(request()->query(), ['page' => $currentPage + 1])) }}"
                               class="relative inline-flex items-center px-3 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                Selanjutnya
                                <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                @endif
                @elseif($query)
                <!-- No Results -->
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Tidak Ada Hasil</h2>
                    <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                        Maaf, tidak ditemukan hasil untuk pencarian "<strong>{{ $query }}</strong>".
                        Coba gunakan kata kunci yang berbeda atau periksa ejaan Anda.
                    </p>
                    <div class="space-x-4">
                        <a href="{{ route('news') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                            Lihat Semua Berita
                        </a>
                        <a href="{{ route('services') }}" class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                            Lihat Semua Layanan
                        </a>
                    </div>
                </div>
                @else
                <!-- No Search Query -->
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Masukkan Kata Kunci</h2>
                    <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                        Masukkan kata kunci pada form pencarian untuk menemukan berita, layanan, atau informasi yang Anda cari.
                    </p>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
