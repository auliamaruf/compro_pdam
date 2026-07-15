@extends('layouts.home')

@section('title', 'Beranda - Perumda Air Minum Tirta Perwira Purbalingga')
@section('description', 'Perumda Air Minum Tirta Perwira Purbalingga melayani dengan hati untuk memberikan air bersih berkualitas. Temukan informasi layanan, tarif, dan berita terkini.')
@section('keywords', 'PDAM Purbalingga, air bersih, pelayanan air, tarif air, Tirta Perwira, Perumda Air Minum Tirta Perwira Purbalingga')

@section('meta')
    @if(isset($herobanners) && $herobanners->count() > 0 && $herobanners->first()->getFirstMediaUrl('hero_backgrounds'))
        <link rel="preload" as="image" href="{{ $herobanners->first()->getFirstMediaUrl('hero_backgrounds') }}" fetchpriority="high">
    @endif
@endsection
@section('content')
<!-- Hero Section -->
@if($herobanners && $herobanners->count() > 0)
    <!-- Multiple Hero Slides -->
    <section id="hero" class="relative overflow-hidden" style="height: 100vh !important;">
        <div class="hero-carousel relative" style="height: 100vh !important;">
            @foreach($herobanners as $index => $banner)
                <div class="hero-slide {{ $index === 0 ? 'active' : '' }} absolute inset-0 flex items-center justify-center" 
                     style="height: 100vh !important; width: 100vw !important;{{ $index === 0 ? ' opacity:1; visibility:visible;' : '' }}"
                     data-slide="{{ $index }}"
                     data-overlay-color="{{ $banner->overlay_color ?? '#1e3a8a' }}"
                     data-overlay-opacity="{{ $banner->overlay_opacity ?? 80 }}">

                    <!-- Background Image -->
                    @if($banner->getFirstMediaUrl('hero_backgrounds'))
                        <img src="{{ $banner->getFirstMediaUrl('hero_backgrounds') }}" 
                             alt="{{ $banner->title ?? 'Hero Background' }}"
                             class="absolute inset-0 w-full h-full object-cover object-center"
                             {{ $index === 0 ? 'fetchpriority="high"' : 'loading="lazy"' }}>
                    @else
                        <div class="absolute inset-0 hero-gradient"></div>
                    @endif

                    <!-- Overlay -->
                    <div class="absolute inset-0 hero-overlay"
                         style="background-color: {{ $banner->overlay_color ?? '#1e3a8a' }}; opacity: {{ ($banner->overlay_opacity ?? 80) / 100 }};"></div>

                    <!-- Content -->
                    <div class="relative z-10 container-custom text-white px-4 w-full">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center min-h-screen py-20">
                            <div class="text-{{ $banner->text_position ?? 'left' }} {{ ($banner->text_position ?? 'left') === 'center' ? 'lg:text-center col-span-2' : (($banner->text_position ?? 'left') === 'right' ? 'lg:text-right lg:order-2' : 'lg:text-left') }}">
                                <h1 class="text-4xl lg:text-6xl font-bold mb-6 leading-tight {{ $index === 0 ? '' : 'animate-fadeInUp' }}">
                                    {{ $banner->title ?? 'Default Title' }}
                                </h1>
                                @if($banner->subtitle)
                                <p class="text-xl lg:text-2xl mb-4 text-blue-100 leading-relaxed {{ $index === 0 ? '' : 'animate-fadeInUp animation-delay-200' }}">
                                    {{ $banner->subtitle }}
                                </p>
                                @endif
                                @if($banner->description)
                                <p class="text-lg mb-8 text-blue-200 leading-relaxed {{ $index === 0 ? '' : 'animate-fadeInUp animation-delay-400' }}">
                                    {{ $banner->description }}
                                </p>
                                @endif
                                <div class="flex flex-col sm:flex-row gap-4 justify-{{ $banner->text_position ?? 'left' === 'center' ? 'center' : (($banner->text_position ?? 'left') === 'right' ? 'end' : 'start') }} {{ $index === 0 ? '' : 'animate-fadeInUp animation-delay-600' }}">
                                    @if($banner->primary_cta_text)
                                    <a href="{{ $banner->primary_cta_link ?? '#' }}" class="btn-primary">
                                        {{ $banner->primary_cta_text }}
                                    </a>
                                    @endif
                                    @if($banner->secondary_cta_text)
                                    <a href="{{ $banner->secondary_cta_link ?? '#' }}" class="btn-secondary">
                                        {{ $banner->secondary_cta_text }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Navigation Arrows - Enhanced Narrow Design -->
        @if($herobanners->count() > 1)
        <button class="hero-nav hero-prev absolute left-2 lg:left-4 top-1/2 transform -translate-y-1/2 z-20 hero-nav-button group" 
                aria-label="Previous slide" 
                title="Previous slide">
            <div class="hero-nav-inner">
                <svg class="w-5 h-5 lg:w-6 lg:h-6 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                </svg>
            </div>
            <div class="hero-nav-bg"></div>
        </button>
        <button class="hero-nav hero-next absolute right-2 lg:right-4 top-1/2 transform -translate-y-1/2 z-20 hero-nav-button group" 
                aria-label="Next slide" 
                title="Next slide">
            <div class="hero-nav-inner">
                <svg class="w-5 h-5 lg:w-6 lg:h-6 transition-transform duration-300 group-hover:scale-110" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                </svg>
            </div>
            <div class="hero-nav-bg"></div>
        </button>

        <!-- Navigation Hint for First Visit -->
        <div class="hero-nav-hint absolute inset-x-0 bottom-20 lg:bottom-24 text-center z-10 pointer-events-none">
            <div class="inline-flex items-center space-x-2 bg-black bg-opacity-30 backdrop-blur-sm rounded-full px-4 py-2 text-white text-sm opacity-0 animate-fadeInDelay">
                <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                </svg>
                <span>Hover untuk navigasi</span>
                <svg class="w-4 h-4 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                </svg>
            </div>
        </div>
        @endif

        <!-- Dots Indicator -->
        @if($herobanners->count() > 1)
        <div class="hero-dots absolute bottom-6 lg:bottom-8 left-1/2 transform -translate-x-1/2 z-20 flex space-x-2">
            @foreach($herobanners as $index => $banner)
                <button class="hero-dot w-3 h-3 rounded-full bg-white dark:bg-gray-800 bg-opacity-50 hover:bg-opacity-75 transition-all duration-200 {{ $index === 0 ? 'active bg-opacity-100' : '' }}"
                        data-slide="{{ $index }}"></button>
            @endforeach
        </div>
        @endif
    </section>
@else
    <!-- Fallback: Single Hero Section -->
    <section id="hero" class="hero-gradient relative flex items-center justify-center" style="height: 100vh !important;">
        <div class="absolute inset-0 hero-overlay"></div>
        <div class="relative z-10 container-custom text-white px-4 w-full">
            <div class="text-center flex items-center justify-center min-h-screen py-20 fallback-hero">
                <div class="max-w-4xl mx-auto">
                    <h1 class="text-4xl lg:text-6xl font-bold mb-6 leading-tight">
                        @if($company && $company->hero_title && is_string($company->hero_title))
                            {!! nl2br(e($company->hero_title)) !!}
                        @else
                            <span class="block">Melayani dengan</span>
                            <span class="block text-yellow-300">Hati</span>
                        @endif
                    </h1>
                    <p class="text-xl lg:text-2xl mb-8 text-blue-100 leading-relaxed">
                        {{ ($company && $company->hero_subtitle && is_string($company->hero_subtitle)) ? $company->hero_subtitle : 'Memberikan yang terbaik untuk air bersih berkualitas bagi masyarakat Purbalingga' }}
                    </p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('services') }}" class="btn-primary">
                            {{ ($company && $company->hero_cta_primary && is_string($company->hero_cta_primary)) ? $company->hero_cta_primary : 'Layanan Kami' }}
                        </a>
                        <a href="https://tagihan.pdampurbalingga.co.id/" target="_blank" rel="noopener noreferrer" class="btn-secondary">
                            {{ ($company && $company->hero_cta_secondary && is_string($company->hero_cta_secondary)) ? $company->hero_cta_secondary : 'Cek Tagihan' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-6 lg:bottom-8 left-1/2 transform -translate-x-1/2 text-white animate-bounce z-10">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>
@endif

<!-- Quick Actions -->
<section class="bg-gray-50 py-12 lg:py-16 relative overflow-hidden dark:bg-gray-800">
    <!-- Subtle decorative elements -->
    <div class="absolute top-10 left-10 w-20 h-20 bg-blue-100 rounded-full opacity-30 animate-pulse"></div>
    <div class="absolute bottom-10 right-10 w-16 h-16 bg-cyan-100 rounded-full opacity-20 animate-pulse" style="animation-delay: 2s;"></div>
    <div class="absolute top-1/2 left-1/4 w-2 h-2 bg-blue-300 rounded-full opacity-40"></div>
    <div class="absolute top-1/3 right-1/3 w-1 h-1 bg-cyan-300 rounded-full opacity-50"></div>

    <div class="container-custom relative z-10">
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-500 rounded-full mb-6 shadow-lg">
                <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                </svg>
            </div>
            <h2 class="text-3xl lg:text-4xl font-bold mb-4 text-gray-900 dark:text-white">Akses Cepat</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto leading-relaxed dark:text-gray-400">
                Layanan digital untuk kemudahan transaksi dan komunikasi Anda
            </p>
        </div>

        <!-- Quick Action Buttons - Modern Pill Style -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-stretch max-w-4xl mx-auto">
            <!-- Cek Tagihan -->
            <a href="https://tagihan.pdampurbalingga.co.id" target="_blank" rel="noopener noreferrer" 
               class="group flex-1">
                <div class="bg-white hover:bg-blue-50 rounded-2xl px-6 py-5 transition-all duration-300 shadow-lg hover:shadow-xl border border-blue-100 hover:border-blue-200 dark:border-gray-700 dark:hover:border-gray-600 hover:-translate-y-1 h-full dark:bg-gray-900">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center group-hover:scale-105 transition-all duration-300 flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600 transition-colors duration-200 dark:text-white">Cek Tagihan</h3>
                            <p class="text-sm text-gray-600 mt-1 dark:text-gray-400">Lihat tagihan air bulanan</p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Pengaduan -->
            <a href="{{ route('services.pengaduan') }}" 
               class="group flex-1">
                <div class="bg-white hover:bg-red-50 rounded-2xl px-6 py-5 transition-all duration-300 shadow-lg hover:shadow-xl border border-red-100 hover:border-red-200 dark:border-gray-700 dark:hover:border-gray-600 hover:-translate-y-1 h-full dark:bg-gray-900">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-600 rounded-xl flex items-center justify-center group-hover:scale-105 transition-all duration-300 flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-red-600 transition-colors duration-200 dark:text-white">Pengaduan</h3>
                            <p class="text-sm text-gray-600 mt-1 dark:text-gray-400">Laporkan keluhan Anda</p>
                        </div>
                    </div>
                </div>
            </a>

            <!-- Sambungan Baru -->
            <a href="{{ route('services') }}" 
               class="group flex-1">
                <div class="bg-white hover:bg-green-50 rounded-2xl px-6 py-5 transition-all duration-300 shadow-lg hover:shadow-xl border border-green-100 hover:border-green-200 dark:border-gray-700 dark:hover:border-gray-600 hover:-translate-y-1 h-full dark:bg-gray-900">
                    <div class="flex items-center space-x-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center group-hover:scale-105 transition-all duration-300 flex-shrink-0">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="text-lg font-bold text-gray-900 group-hover:text-green-600 transition-colors duration-200 dark:text-white">Sambungan Baru</h3>
                            <p class="text-sm text-gray-600 mt-1 dark:text-gray-400">Daftar pemasangan baru</p>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        
        <!-- Info Pelanggan Ticker -->
        @if(isset($customerInfos) && $customerInfos->count() > 0)
        <div class="max-w-4xl mx-auto mt-6">
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-md border border-red-100 dark:border-gray-700 overflow-hidden flex items-stretch h-16" id="ticker-wrapper">
                <div class="bg-red-600 dark:bg-red-800 text-white text-sm font-bold px-4 md:px-6 flex items-center shrink-0 z-10 shadow-[4px_0_10px_-2px_rgba(0,0,0,0.1)] whitespace-nowrap">
                    <svg class="w-4 h-4 md:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"></path>
                    </svg>
                    <span class="hidden md:inline">Info Pelanggan</span>
                </div>
                <div class="flex-1 overflow-hidden relative bg-red-50/50 dark:bg-gray-900/50">
                    <div id="ticker-content" class="flex flex-col w-full absolute top-0 left-0">
                        @foreach($customerInfos as $info)
                            <button type="button" onclick="openCustomerInfoDetailModal('{{ addslashes($info->title) }}', '{{ \Carbon\Carbon::parse($info->created_at)->format('d M Y, H:i') . ' WIB' }}', '{{ base64_encode($info->description) }}')" class="h-16 flex items-center px-4 text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 transition-colors w-full text-left focus:outline-none">
                                <div class="flex flex-col items-center justify-center bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-300 rounded md:rounded-md px-2 py-1 mr-4 shrink-0">
                                    <span style="font-size: 10px;" class="font-bold tracking-tight leading-none mb-0.5">{{ \Carbon\Carbon::parse($info->created_at)->format('d M Y') }}</span>
                                    <span style="font-size: 9px;" class="font-medium tracking-tight leading-none opacity-90">{{ \Carbon\Carbon::parse($info->created_at)->format('H:i') }} WIB</span>
                                </div>
                                <div class="flex flex-col overflow-hidden w-full">
                                    <span class="text-xs md:text-sm font-semibold truncate w-full">{{ $info->title }}</span>
                                    <span class="text-[10px] md:text-xs text-gray-500 dark:text-gray-400 truncate w-full">{{ strip_tags($info->description) }}</span>
                                </div>
                            </button>
                        @endforeach
                        
                        @if($customerInfos->count() > 1)
                            {{-- Clone first item for seamless vertical scroll --}}
                            <button type="button" onclick="openCustomerInfoDetailModal('{{ addslashes($customerInfos->first()->title) }}', '{{ \Carbon\Carbon::parse($customerInfos->first()->created_at)->format('d M Y, H:i') . ' WIB' }}', '{{ base64_encode($customerInfos->first()->description) }}')" class="h-16 flex items-center px-4 text-gray-700 dark:text-gray-300 hover:text-red-600 dark:hover:text-red-400 transition-colors w-full text-left focus:outline-none">
                                <div class="flex flex-col items-center justify-center bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-300 rounded md:rounded-md px-2 py-1 mr-4 shrink-0">
                                    <span style="font-size: 10px;" class="font-bold tracking-tight leading-none mb-0.5">{{ \Carbon\Carbon::parse($customerInfos->first()->created_at)->format('d M Y') }}</span>
                                    <span style="font-size: 9px;" class="font-medium tracking-tight leading-none opacity-90">{{ \Carbon\Carbon::parse($customerInfos->first()->created_at)->format('H:i') }} WIB</span>
                                </div>
                                <div class="flex flex-col overflow-hidden w-full">
                                    <span class="text-xs md:text-sm font-semibold truncate w-full">{{ $customerInfos->first()->title }}</span>
                                    <span class="text-[10px] md:text-xs text-gray-500 dark:text-gray-400 truncate w-full">{{ strip_tags($customerInfos->first()->description) }}</span>
                                </div>
                            </button>
                        @endif
                    </div>
                </div>
                <button type="button" onclick="openCustomerInfoListModal()" class="flex items-center justify-center px-4 bg-gray-50 dark:bg-gray-700 border-l border-gray-200 dark:border-gray-600 text-gray-500 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-600 transition-colors shrink-0 focus:outline-none" title="Lihat Semua Info">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const tickerContent = document.getElementById('ticker-content');
                const totalItems = {{ $customerInfos->count() }};
                
                if (totalItems > 1 && tickerContent) {
                    let currentIndex = 0;
                    let isHovered = false;
                    const itemHeight = 64; // h-16 is 64px

                    document.getElementById('ticker-wrapper').addEventListener('mouseenter', () => isHovered = true);
                    document.getElementById('ticker-wrapper').addEventListener('mouseleave', () => isHovered = false);

                    setInterval(() => {
                        if (isHovered) return;
                        
                        currentIndex++;
                        tickerContent.style.transition = 'transform 0.5s ease-in-out';
                        tickerContent.style.transform = `translateY(-${currentIndex * itemHeight}px)`;

                        if (currentIndex === totalItems) {
                            setTimeout(() => {
                                tickerContent.style.transition = 'none';
                                tickerContent.style.transform = 'translateY(0)';
                                currentIndex = 0;
                            }, 500); // Matches transition duration
                        }
                    }, 3500);
                }
            });
        </script>
        @endif
    </div>
</section>

<!-- About Preview Section -->
<section id="about-preview" class="bg-white section-padding dark:bg-gray-900">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <!-- Content -->
            <div class="order-2 lg:order-1">
                <div class="mb-6">
                    <span class="inline-block px-4 py-2 bg-blue-100 text-blue-800 text-sm font-semibold rounded-full mb-4">
                        Tentang Kami
                    </span>
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6 dark:text-white">
                        {{ $company->about_preview_title ?? 'PDAM Tirta Perwira Purbalingga' }}
                    </h2>
                </div>

                @if($company && $company->about_preview_content)
                    <div class="space-y-4 text-gray-600 leading-relaxed dark:text-gray-400">
                        {!! $company->about_preview_content !!}
                    </div>
                @else
                    <div class="space-y-4 text-gray-600 leading-relaxed dark:text-gray-400">
                        <p class="text-lg">
                            <strong class="text-gray-900 dark:text-white">PDAM Tirta Perwira</strong> telah mengabdi kepada masyarakat Purbalingga selama lebih dari 50 tahun dalam menyediakan air bersih berkualitas. Kami berkomitmen melayani dengan hati dan memberikan pelayanan terbaik.
                        </p>
                        <p>
                            Dengan teknologi modern dan SDM yang kompeten, kami terus berinovasi untuk meningkatkan kualitas pelayanan. Saat ini kami melayani lebih dari <strong class="text-blue-600">150.000 pelanggan</strong> di seluruh Kabupaten Purbalingga.
                        </p>
                        <p>
                            Visi kami adalah menjadi perusahaan air minum terdepan yang memberikan pelayanan prima dan berkontribusi pada pembangunan daerah yang berkelanjutan.
                        </p>
                    </div>
                @endif

                <!-- Key Features -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">
                    @if($company && $company->key_features && count($company->key_features) > 0)
                        @foreach($company->key_features as $feature)
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 {{ $feature['bg_color'] ?? 'bg-blue-100' }} rounded-full flex items-center justify-center">
                                <svg class="{{ $feature['icon'] ?? 'w-5 h-5 text-blue-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700 font-medium dark:text-gray-300">{{ $feature['title'] }}</span>
                        </div>
                        @endforeach
                    @else
                        {{-- Fallback: Default Key Features --}}
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700 font-medium dark:text-gray-300">Air Berkualitas Tinggi</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700 font-medium dark:text-gray-300">Pelayanan 24/7</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-cyan-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700 font-medium dark:text-gray-300">150K+ Pelanggan</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700 font-medium dark:text-gray-300">Teknologi Terdepan</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700 font-medium dark:text-gray-300">99% Kualitas Air</span>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Image -->
            <div class="order-1 lg:order-2">
                <div class="relative">
                    @if($company && $company->getFirstMediaUrl('about_image'))
                        <img data-src="{{ $company->getFirstMediaUrl('about_image') }}"
                             alt="Kantor PDAM Tirta Perwira"
                             class="w-full h-96 lg:h-[500px] object-cover rounded-2xl shadow-2xl lazy-image"
                             loading="lazy" width="800" height="500">
                    @else
                        <!-- Fallback: Gradient placeholder with building icon -->
                        <div class="w-full h-96 lg:h-[500px] bg-gradient-to-br from-blue-400 via-blue-500 to-blue-600 rounded-2xl shadow-2xl overflow-hidden relative">
                            @if($company && $company->getFirstMediaUrl('about_image'))
                                <!-- Image Background -->
                                <img src="{{ $company->getFirstMediaUrl('about_image') }}"
                                     alt="{{ $company->company_name ?? 'PDAM Tirta Perwira' }}"
                                     class="w-full h-full object-cover"
                                     loading="lazy" width="800" height="500">
                                <!-- Overlay for better text contrast -->
                                <div class="absolute inset-0 bg-gradient-to-br from-blue-600/60 to-cyan-500/40"></div>
                                <!-- Content overlay -->
                                <div class="absolute inset-0 flex items-center justify-center">
                                    <div class="text-center text-white">
                                        <svg class="w-24 h-24 mx-auto mb-4 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H7m2 0v-5a2 2 0 012-2h2a2 2 0 012 2v5"></path>
                                        </svg>
                                        <h3 class="text-xl font-semibold mb-2">{{ $company->company_name ?? 'PDAM Tirta Perwira' }}</h3>
                                        <p class="text-blue-100">Kantor Pusat Purbalingga</p>
                                    </div>
                                </div>
                            @else
                                <!-- Fallback: Gradient background -->
                                <div class="flex items-center justify-center h-full">
                                    <div class="text-center text-white">
                                        <svg class="w-24 h-24 mx-auto mb-4 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H7m2 0v-5a2 2 0 012-2h2a2 2 0 012 2v5"></path>
                                        </svg>
                                        <h3 class="text-xl font-semibold mb-2">{{ $company->company_name ?? 'PDAM Tirta Perwira' }}</h3>
                                        <p class="text-blue-100">Kantor Pusat Purbalingga</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endif

                    <!-- Decorative elements -->
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-blue-200 rounded-full opacity-20 animate-pulse"></div>
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-cyan-200 rounded-full opacity-20 animate-pulse" style="animation-delay: 1s;"></div>
                </div>
            </div>
        </div>

        <!-- Action Buttons - Full Width Section (Breaking out of grid) -->
        <div class="mt-16 pt-8">
            <div class="max-w-7xl mx-auto">
                <!-- Single row with all 6 buttons spanning full width -->
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
                    <!-- Profil Lengkap -->
                    <a href="{{ route('about') }}" class="btn-primary flex items-center justify-center group min-h-[44px] text-center px-3 py-2">
                        <svg class="w-4 h-4 mr-1.5 group-hover:scale-105 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="text-xs font-medium">Profil Lengkap</span>
                    </a>

                    <!-- Sejarah -->
                    <a href="{{ route('about.history') }}" class="about-secondary-btn bg-white text-blue-700 px-3 py-2 rounded-lg font-medium hover:bg-blue-50 hover:text-blue-800 transition-all duration-200 border border-blue-200 hover:border-blue-300 flex items-center justify-center group min-h-[44px] dark:bg-gray-900">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                        <span class="text-xs font-medium">Sejarah</span>
                    </a>

                    <!-- Visi Misi -->
                    <a href="{{ route('about.vision-mission') }}" class="about-secondary-btn bg-white text-blue-700 px-3 py-2 rounded-lg font-medium hover:bg-blue-50 hover:text-blue-800 transition-all duration-200 border border-blue-200 hover:border-blue-300 flex items-center justify-center group min-h-[44px] dark:bg-gray-900">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <span class="text-xs font-medium">Visi Misi</span>
                    </a>

                    <!-- Struktur Organisasi -->
                    <a href="{{ route('about.organization') }}" class="about-secondary-btn bg-white text-green-700 px-3 py-2 rounded-lg font-medium hover:bg-green-50 hover:text-green-800 transition-all duration-200 border border-green-200 hover:border-green-300 flex items-center justify-center group min-h-[44px] dark:bg-gray-900">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H7m2 0v-5a2 2 0 012-2h2a2 2 0 012 2v5"></path>
                        </svg>
                        <span class="text-xs font-medium">Struktur Organisasi</span>
                    </a>

                    <!-- Cabang dan Unit IKK -->
                    <a href="{{ route('about.branches') }}" class="about-secondary-btn bg-white text-purple-700 px-3 py-2 rounded-lg font-medium hover:bg-purple-50 hover:text-purple-800 transition-all duration-200 border border-purple-200 hover:border-purple-300 flex items-center justify-center group min-h-[44px] dark:bg-gray-900">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H7m2 0v-5a2 2 0 012-2h2a2 2 0 012 2v5"></path>
                        </svg>
                        <span class="text-xs font-medium">Cabang & Unit IKK</span>
                    </a>

                    <!-- Sumber Mata Air -->
                    <a href="{{ route('water-sources.index') }}" class="about-secondary-btn bg-white text-cyan-700 px-3 py-2 rounded-lg font-medium hover:bg-cyan-50 hover:text-cyan-800 transition-all duration-200 border border-cyan-200 hover:border-cyan-300 flex items-center justify-center group min-h-[44px] dark:bg-gray-900">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5l-1-1z"></path>
                        </svg>
                        <span class="text-xs font-medium">Sumber Mata Air</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<!-- Bagian Prestasi kami
<section id="stats" class="bg-gray-50 section-padding dark:bg-gray-800">
    <div class="container-custom">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4 dark:text-white">{{ $company->stats_section_title ?? 'Prestasi Kami' }}</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto dark:text-gray-400">
                {{ $company->stats_section_description ?? 'Komitmen nyata dalam memberikan pelayanan air bersih berkualitas untuk masyarakat Purbalingga' }}
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="stat-item text-center group">
                <div class="w-20 h-20 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center group-hover:bg-blue-200 transition-colors duration-200">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="stat-number text-3xl font-bold text-blue-600 mb-2" data-count="{{ $company->customers_served ?? 45000 }}">0</div>
                <div class="stat-label text-gray-600 font-medium dark:text-gray-400">Pelanggan Aktif</div>
            </div>
            <div class="stat-item text-center group">
                <div class="w-20 h-20 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center group-hover:bg-green-200 transition-colors duration-200">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H7m2 0v-5a2 2 0 012-2h2a2 2 0 012 2v5"></path>
                    </svg>
                </div>
                <div class="stat-number text-3xl font-bold text-green-600 mb-2" data-count="{{ $company->years_experience ?? 38 }}">0</div>
                <div class="stat-label text-gray-600 font-medium dark:text-gray-400">Tahun Pengalaman</div>
            </div>
            <div class="stat-item text-center group">
                <div class="w-20 h-20 mx-auto mb-4 bg-cyan-100 rounded-full flex items-center justify-center group-hover:bg-cyan-200 transition-colors duration-200">
                    <svg class="w-10 h-10 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5l-1-1z"></path>
                    </svg>
                </div>
                <div class="stat-number text-3xl font-bold text-cyan-600 mb-2" data-count="{{ $company->service_availability ?? 99.5 }}">0</div>
                <div class="stat-label text-gray-600 font-medium dark:text-gray-400">% Ketersediaan Layanan</div>
            </div>
            <div class="stat-item text-center group">
                <div class="w-20 h-20 mx-auto mb-4 bg-yellow-100 rounded-full flex items-center justify-center group-hover:bg-yellow-200 transition-colors duration-200">
                    <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="stat-number text-3xl font-bold text-yellow-600 mb-2" data-count="{{ $company->water_quality_percentage ?? 99.8 }}">0</div>
                <div class="stat-label text-gray-600 font-medium dark:text-gray-400">% Kualitas Air</div>
            </div>
        </div>
    </div>
</section>
sampai sini -->

<!-- Services Section -->
<section id="services-preview" class="bg-gray-50 section-padding dark:bg-gray-800">
    <div class="container-custom">
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4 dark:text-white">{{ $company->services_section_title ?? 'Layanan Utama' }}</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto dark:text-gray-400">
                {{ $company->services_section_description ?? 'Kami menyediakan berbagai layanan air bersih berkualitas untuk memenuhi kebutuhan masyarakat Purbalingga' }}
            </p>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
            @forelse($services->take(6) as $service)
            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 group overflow-hidden h-full flex flex-col dark:bg-gray-900">
                @if($service->getFirstMediaUrl('icons'))
                    <img data-src="{{ $service->getFirstMediaUrl('icons') }}" alt="{{ $service->name }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300 lazy-image" loading="lazy" width="400" height="192">
                @elseif($service->icon)
                    <img data-src="{{ asset('storage/' . $service->icon) }}" alt="{{ $service->name }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300 lazy-image" loading="lazy" width="400" height="192">
                @else
                    <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center group-hover:from-blue-500 group-hover:to-blue-700 transition-all duration-300">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5l-1-1z"></path>
                        </svg>
                    </div>
                @endif
                <div class="p-6 flex-grow flex flex-col">
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-200 line-clamp-2 dark:text-white">{{ $service->name }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3 flex-grow dark:text-gray-400">{{ Str::limit(strip_tags($service->description), 120) }}</p>
                    <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors duration-200 mt-auto">
                        Selengkapnya
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-lg flex items-center justify-center dark:bg-gray-700">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2 dark:text-white">Layanan Akan Segera Tersedia</h3>
                <p class="text-gray-600 dark:text-gray-400">Kami sedang mempersiapkan informasi layanan terbaik untuk Anda.</p>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('services') }}" class="btn-primary">
                Lihat Semua Layanan
            </a>
        </div>
    </div>
</section>

<!-- Partnership Section -->
@if($partnerships && $partnerships->count() > 0)
<section id="partnerships" class="bg-white section-padding dark:bg-gray-900">
    <div class="container-custom">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4 dark:text-white">Mitra Pembayaran</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto dark:text-gray-400">
                Kami bangga bekerja sama dengan berbagai institusi dan organisasi terpercaya dalam memberikan pelayanan terbaik
            </p>
        </div>
        
        <div class="partnership-slider-container relative overflow-hidden">
            <!-- Partnership slider dengan animasi seamless -->
            <div class="partnership-fade-left absolute left-0 top-0 w-20 h-full bg-gradient-to-r from-white to-transparent z-10"></div>
            <div class="partnership-fade-right absolute right-0 top-0 w-20 h-full bg-gradient-to-l from-white to-transparent z-10"></div>
            
            <!-- Single Row Rolling Animation -->
            <div class="partnership-track flex items-center" id="partnershipTrack" style="gap: 3rem;">
                @foreach($partnerships as $partner)
                <div class="partnership-item flex-shrink-0">
                    <div class="transition-all duration-300 hover:scale-110 w-32 h-20 flex items-center justify-center">
                        @if($partner->logo_type === 'url' && $partner->logo_url)
                            <img src="{{ $partner->logo_url }}" 
                                 alt="{{ $partner->name }}" 
                                 class="max-w-full max-h-full object-contain transition-all duration-300 opacity-80 hover:opacity-100"
                                 title="{{ $partner->name }}"
                                 onerror="this.style.display='none'"
                                 loading="lazy" width="128" height="80">
                        @elseif($partner->getFirstMediaUrl('logo'))
                            <img src="{{ $partner->getFirstMediaUrl('logo', 'slider') }}" 
                                 alt="{{ $partner->name }}" 
                                 class="max-w-full max-h-full object-contain transition-all duration-300 opacity-80 hover:opacity-100"
                                 title="{{ $partner->name }}"
                                 loading="lazy" width="128" height="80">
                        @else
                            <div class="w-full h-full bg-gray-100 rounded flex items-center justify-center opacity-60 dark:bg-gray-700">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m4 0v-2.5M9 13.5h2.5M7 9.5h6"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <p class="text-xs text-gray-600 text-center mt-2 font-medium dark:text-gray-400">{{ $partner->name }}</p>
                </div>
                @endforeach
                
                <!-- Duplicate for seamless loop -->
                @foreach($partnerships as $partner)
                <div class="partnership-item flex-shrink-0">
                    <div class="transition-all duration-300 hover:scale-110 w-32 h-20 flex items-center justify-center">
                        @if($partner->logo_type === 'url' && $partner->logo_url)
                            <img src="{{ $partner->logo_url }}" 
                                 alt="{{ $partner->name }}" 
                                 class="max-w-full max-h-full object-contain transition-all duration-300 opacity-80 hover:opacity-100"
                                 title="{{ $partner->name }}"
                                 onerror="this.style.display='none'"
                                 loading="lazy" width="128" height="80">
                        @elseif($partner->getFirstMediaUrl('logo'))
                            <img src="{{ $partner->getFirstMediaUrl('logo', 'slider') }}" 
                                 alt="{{ $partner->name }}" 
                                 class="max-w-full max-h-full object-contain transition-all duration-300 opacity-80 hover:opacity-100"
                                 title="{{ $partner->name }}"
                                 loading="lazy" width="128" height="80">
                        @else
                            <div class="w-full h-full bg-gray-100 rounded flex items-center justify-center opacity-60 dark:bg-gray-700">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m4 0v-2.5M9 13.5h2.5M7 9.5h6"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <p class="text-xs text-gray-600 text-center mt-2 font-medium dark:text-gray-400">{{ $partner->name }}</p>
                </div>
                @endforeach

                <!-- Triple duplicate untuk memastikan seamless loop yang sempurna -->
                @foreach($partnerships as $partner)
                <div class="partnership-item flex-shrink-0">
                    <div class="transition-all duration-300 hover:scale-110 w-32 h-20 flex items-center justify-center">
                        @if($partner->logo_type === 'url' && $partner->logo_url)
                            <img src="{{ $partner->logo_url }}" 
                                 alt="{{ $partner->name }}" 
                                 class="max-w-full max-h-full object-contain transition-all duration-300 opacity-80 hover:opacity-100"
                                 title="{{ $partner->name }}"
                                 onerror="this.style.display='none'"
                                 loading="lazy" width="128" height="80">
                        @elseif($partner->getFirstMediaUrl('logo'))
                            <img src="{{ $partner->getFirstMediaUrl('logo', 'slider') }}" 
                                 alt="{{ $partner->name }}" 
                                 class="max-w-full max-h-full object-contain transition-all duration-300 opacity-80 hover:opacity-100"
                                 title="{{ $partner->name }}"
                                 loading="lazy" width="128" height="80">
                        @else
                            <div class="w-full h-full bg-gray-100 rounded flex items-center justify-center opacity-60 dark:bg-gray-700">
                                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H5m4 0v-2.5M9 13.5h2.5M7 9.5h6"></path>
                                </svg>
                            </div>
                        @endif
                    </div>
                    <p class="text-xs text-gray-600 text-center mt-2 font-medium dark:text-gray-400">{{ $partner->name }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

<!-- News Section -->
<section id="news-preview" class="bg-gray-50 dark:bg-gray-800 section-padding">
    <div class="container-custom">
        <div class="text-center mb-10">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ $company->news_section_title ?? 'Berita & Informasi Terkini' }}</h2>
            <p class="text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto dark:text-gray-400">
                {{ $company->news_section_description ?? 'Dapatkan informasi terbaru seputar pelayanan dan perkembangan PDAM Purbalingga' }}
            </p>
        </div>

        <!-- Tabs Navigation -->
        <div class="flex justify-center mb-10">
            <div class="inline-flex bg-white dark:bg-gray-900 rounded-full p-1 shadow-sm border border-gray-100 dark:border-gray-700">
                @foreach($newsByType as $type => $articles)
                <button type="button" class="news-tab-btn px-6 py-2.5 rounded-full text-sm font-medium transition-all duration-200 {{ $loop->first ? 'bg-blue-600 text-white shadow-md' : 'text-gray-600 dark:text-gray-300 hover:text-gray-900 dark:hover:text-white dark:text-gray-400' }}" data-target="tab-{{ $type }}">
                    {{ ucfirst($type) }}
                </button>
                @endforeach
            </div>
        </div>

        @foreach($newsByType as $type => $articles)
        <!-- Tab Content: {{ ucfirst($type) }} -->
        <div id="tab-{{ $type }}" class="news-tab-content {{ $loop->first ? '' : 'hidden' }}">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($articles as $article)
                    @include('partials.news-card', ['article' => $article])
                @empty
                    @include('partials.news-empty')
                @endforelse
            </div>
            <div class="text-center mt-12">
                <a href="{{ route('news', ['type' => $type]) }}" class="btn-primary">Lihat Semua {{ ucfirst($type) }}</a>
            </div>
        </div>
        @endforeach
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tabBtns = document.querySelectorAll('.news-tab-btn');
        const tabContents = document.querySelectorAll('.news-tab-content');

        tabBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                // Remove active classes from all buttons
                tabBtns.forEach(b => {
                    b.classList.remove('bg-blue-600', 'text-white', 'shadow-md');
                    b.classList.add('text-gray-600', 'dark:text-gray-300');
                });

                // Add active classes to clicked button
                this.classList.add('bg-blue-600', 'text-white', 'shadow-md');
                this.classList.remove('text-gray-600', 'dark:text-gray-300');

                // Hide all contents
                tabContents.forEach(content => {
                    content.classList.add('hidden');
                });

                // Show target content
                const targetId = this.getAttribute('data-target');
                document.getElementById(targetId).classList.remove('hidden');
            });
        });
    });
</script>

<!-- FAQ Section -->
@if(isset($faqs) && $faqs->count() > 0)
<section id="faq-section" class="bg-white dark:bg-gray-900 section-padding">
    <div class="container-custom">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-4">Tanya Jawab (FAQ)</h2>
            <p class="text-xl text-gray-600 dark:text-gray-400 max-w-3xl mx-auto">
                Temukan jawaban untuk pertanyaan yang sering ditanyakan seputar layanan Perumda AM Tirta Perwira.
            </p>
        </div>
        
        <div class="max-w-4xl mx-auto space-y-4">
            @foreach($faqs as $index => $faq)
            <div class="border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-800 overflow-hidden faq-item {{ $index >= 4 ? 'hidden faq-hidden-item' : '' }}">
                <button type="button" class="faq-toggle flex justify-between items-center w-full px-6 py-4 text-left font-semibold text-gray-900 dark:text-white hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors focus:outline-none focus-visible:ring-2 focus-visible:ring-blue-500">
                    <span>{{ $faq->question }}</span>
                    <svg class="faq-icon w-5 h-5 text-gray-500 dark:text-gray-400 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                </button>
                <div class="faq-content" style="display: none;">
                    <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-300 prose dark:prose-invert max-w-none dark:text-gray-400">
                        {!! $faq->answer !!}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        
        @if($faqs->count() > 4)
        <div class="mt-8 text-center">
            <button id="btn-toggle-faq" class="btn-primary inline-flex items-center">
                <span id="text-toggle-faq">Lihat Selengkapnya</span>
                <svg id="icon-toggle-faq" class="w-5 h-5 ml-2 transform transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
            </button>
        </div>
        @endif
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggles = document.querySelectorAll('.faq-toggle');
        toggles.forEach(toggle => {
            toggle.addEventListener('click', function () {
                const content = this.nextElementSibling;
                const icon = this.querySelector('.faq-icon');
                
                if (content.style.display === 'none') {
                    content.style.display = 'block';
                    icon.classList.add('rotate-180');
                } else {
                    content.style.display = 'none';
                    icon.classList.remove('rotate-180');
                }
            });
        });

        // View more functionality
        const btnToggleFaq = document.getElementById('btn-toggle-faq');
        if (btnToggleFaq) {
            btnToggleFaq.addEventListener('click', function() {
                const hiddenItems = document.querySelectorAll('.faq-hidden-item');
                const textSpan = document.getElementById('text-toggle-faq');
                const iconSvg = document.getElementById('icon-toggle-faq');
                
                let isExpanded = false;
                
                hiddenItems.forEach(item => {
                    if (item.classList.contains('hidden')) {
                        item.classList.remove('hidden');
                        isExpanded = true;
                    } else {
                        item.classList.add('hidden');
                    }
                });
                
                if (isExpanded) {
                    textSpan.textContent = 'Tampilkan Lebih Sedikit';
                    iconSvg.classList.add('rotate-180');
                } else {
                    textSpan.textContent = 'Lihat Selengkapnya';
                    iconSvg.classList.remove('rotate-180');
                }
            });
        }
    });
</script>
@endif

<!-- Progress Indicator -->
<div id="scroll-progress" class="fixed top-0 left-0 w-full h-1 bg-gray-200 z-50">
    <div id="progress-bar" class="h-full bg-gradient-to-r from-blue-500 to-cyan-500 transition-all duration-150 ease-out" style="width: 0%"></div>
</div>

@if(isset($customerInfos) && $customerInfos->count() > 0)
<!-- Customer Info List Modal -->
<div id="customerInfoListModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-4 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-10 dark:bg-gray-900 dark:bg-opacity-40 transition-opacity backdrop-blur-sm" aria-hidden="true" onclick="closeCustomerInfoListModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="relative inline-block align-middle bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-2xl sm:w-full">
            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <h3 class="text-xl leading-6 font-bold text-gray-900 dark:text-white" id="modal-title">Semua Info Pelanggan</h3>
                    <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none" onclick="closeCustomerInfoListModal()">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="px-4 py-5 sm:p-6 max-h-[60vh] overflow-y-auto space-y-4">
                @foreach($customerInfos as $info)
                <div class="border border-gray-100 dark:border-gray-700 rounded-xl p-4 hover:shadow-md transition-shadow bg-gray-50 dark:bg-gray-900 cursor-pointer" onclick="openCustomerInfoDetailModal('{{ addslashes($info->title) }}', '{{ \Carbon\Carbon::parse($info->created_at)->format('d M Y, H:i') . ' WIB' }}', '{{ base64_encode($info->description) }}')">
                    <div class="flex justify-between items-start mb-2">
                        <h4 class="text-lg font-bold text-gray-900 dark:text-white">{{ $info->title }}</h4>
                        <span class="text-xs font-semibold px-2.5 py-1 bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-300 rounded-md shrink-0 ml-4">{{ \Carbon\Carbon::parse($info->created_at)->format('d M Y, H:i') . ' WIB' }}</span>
                    </div>
                    <div class="text-sm text-gray-600 dark:text-gray-400 line-clamp-2">
                        {!! strip_tags($info->description) !!}
                    </div>
                </div>
                @endforeach
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 flex justify-end">
                <button type="button" class="inline-flex justify-center rounded-lg border border-transparent shadow-sm px-6 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:text-sm" onclick="closeCustomerInfoListModal()">Tutup</button>
            </div>
        </div>
    </div>
</div>

<!-- Customer Info Detail Modal -->
<div id="customerInfoDetailModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="detail-modal-title" role="dialog" aria-modal="true">
    <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-4 text-center sm:block sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-10 dark:bg-gray-900 dark:bg-opacity-40 transition-opacity backdrop-blur-sm" aria-hidden="true" onclick="closeCustomerInfoDetailModal()"></div>
        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
        <div class="relative inline-block align-middle bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:max-w-2xl sm:w-full">
            <div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-start">
                    <div>
                        <span id="detail-modal-date" class="text-xs font-semibold px-2.5 py-1 bg-red-100 dark:bg-red-900/50 text-red-800 dark:text-red-300 rounded-md mb-3 inline-block"></span>
                        <h3 class="text-2xl leading-6 font-bold text-gray-900 dark:text-white" id="detail-modal-title"></h3>
                    </div>
                    <button type="button" class="text-gray-400 hover:text-gray-500 focus:outline-none ml-4" onclick="closeCustomerInfoDetailModal()">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="px-4 py-5 sm:p-6 max-h-[60vh] overflow-y-auto text-gray-700 dark:text-gray-300 prose dark:prose-invert max-w-none" id="detail-modal-content">
            </div>
            <div class="bg-gray-50 dark:bg-gray-700 px-4 py-3 sm:px-6 flex justify-end">
                <button type="button" class="inline-flex justify-center rounded-lg border border-transparent shadow-sm px-6 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none sm:text-sm" onclick="closeCustomerInfoDetailModal()">Tutup</button>
            </div>
        </div>
    </div>
</div>

<script>
    function openCustomerInfoListModal() {
        document.getElementById('customerInfoListModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeCustomerInfoListModal() {
        document.getElementById('customerInfoListModal').classList.add('hidden');
        document.body.style.overflow = '';
    }
    
    function openCustomerInfoDetailModal(title, date, contentBase64) {
        document.getElementById('detail-modal-title').textContent = title;
        document.getElementById('detail-modal-date').textContent = date;
        try {
            document.getElementById('detail-modal-content').innerHTML = decodeURIComponent(escape(atob(contentBase64)));
        } catch (e) {
            document.getElementById('detail-modal-content').innerHTML = atob(contentBase64);
        }
        
        document.getElementById('customerInfoDetailModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
    
    function closeCustomerInfoDetailModal() {
        document.getElementById('customerInfoDetailModal').classList.add('hidden');
        if(document.getElementById('customerInfoListModal').classList.contains('hidden')) {
            document.body.style.overflow = '';
        }
    }
</script>
@endif

@endsection

@push('scripts')
<script>
// Hero Carousel Functionality
class HeroCarousel {
    constructor() {
        this.carousel = document.querySelector('.hero-carousel');
        this.slides = document.querySelectorAll('.hero-slide');
        this.dots = document.querySelectorAll('.hero-dot');
        this.prevBtn = document.querySelector('.hero-prev');
        this.nextBtn = document.querySelector('.hero-next');
        this.currentSlide = 0;
        this.slideCount = this.slides.length;
        this.autoPlayInterval = null;
        this.autoPlayDelay = 5000; // 5 seconds

        if (this.slideCount > 1) {
            this.init();
        }
    }

    init() {
               // Set initial state
        this.showSlide(0);

        // Add event listeners
        if (this.prevBtn) {
            this.prevBtn.addEventListener('click', () => {
                this.addClickFeedback(this.prevBtn);
                this.prevSlide();
            });
        }

        if (this.nextBtn) {
            this.nextBtn.addEventListener('click', () => {
                this.addClickFeedback(this.nextBtn);
                this.nextSlide();
            });
        }

        // Dot navigation
        this.dots.forEach((dot, index) => {
            dot.addEventListener('click', () => this.goToSlide(index));
        });

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowLeft') this.prevSlide();
            if (e.key === 'ArrowRight') this.nextSlide();
        });

        // Touch/swipe support
        this.addTouchSupport();

        // Auto-play
        this.startAutoPlay();

        // Initialize navigation hint
        this.initNavigationHint();

        // Pause auto-play on hover with delay
        if (this.carousel) {
            let hoverTimeout;

            this.carousel.addEventListener('mouseenter', () => {
                clearTimeout(hoverTimeout);
                this.stopAutoPlay();
                this.hideNavigationHint();
            });

            this.carousel.addEventListener('mouseleave', () => {
                // Delay restart to avoid flickering when moving between elements
                hoverTimeout = setTimeout(() => {
                    this.startAutoPlay();
                }, 300);
            });
        }
    }

    initNavigationHint() {
        // Hide navigation hint after first interaction
        const hint = document.querySelector('.hero-nav-hint');
        if (hint) {
            // Auto-hide after 5 seconds
            setTimeout(() => {
                hint.style.opacity = '0';
                setTimeout(() => {
                    hint.style.display = 'none';
                }, 300);
            }, 7000);

            // Hide on any navigation interaction
            const hideHint = () => {
                hint.style.opacity = '0';
                setTimeout(() => {
                    hint.style.display = 'none';
                }, 300);
            };

            // Hide hint on any navigation button click
            if (this.prevBtn) this.prevBtn.addEventListener('click', hideHint, { once: true });
            if (this.nextBtn) this.nextBtn.addEventListener('click', hideHint, { once: true });
            
            // Hide hint on dot click
            this.dots.forEach(dot => {
                dot.addEventListener('click', hideHint, { once: true });
            });

            // Hide hint on touch/swipe
            if (this.carousel) {
                this.carousel.addEventListener('touchstart', hideHint, { once: true });
            }
        }
    }

    hideNavigationHint() {
        const hint = document.querySelector('.hero-nav-hint');
        if (hint && hint.style.display !== 'none') {
            hint.style.opacity = '0';
        }
    }

    showSlide(index) {
        // Add loading state to navigation buttons
        if (this.prevBtn) this.prevBtn.classList.add('loading');
        if (this.nextBtn) this.nextBtn.classList.add('loading');

        // Hide all slides
        this.slides.forEach((slide, i) => {
            slide.classList.remove('active');
            slide.style.opacity = '0';
            slide.style.transform = 'translateX(100%)';

            if (i === index) {
                slide.classList.add('active');
                slide.style.opacity = '1';
                slide.style.transform = 'translateX(0)';
            } else if (i < index) {
                slide.style.transform = 'translateX(-100%)';
            }
        });

        // Update dots
        this.dots.forEach((dot, i) => {
            dot.classList.toggle('active', i === index);
            dot.classList.toggle('bg-opacity-100', i === index);
            dot.classList.toggle('bg-opacity-50', i !== index);
        });

        this.currentSlide = index;

        // Remove loading state after transition
        setTimeout(() => {
            if (this.prevBtn) this.prevBtn.classList.remove('loading');
            if (this.nextBtn) this.nextBtn.classList.remove('loading');
        }, 400);
    }

    nextSlide() {
        const next = (this.currentSlide + 1) % this.slideCount;
        this.showSlide(next);
    }

    prevSlide() {
        const prev = (this.currentSlide - 1 + this.slideCount) % this.slideCount;
        this.showSlide(prev);
    }

    addClickFeedback(button) {
        // Add visual feedback for button clicks
        button.style.transform = 'translateY(-50%) translateX(0) scale(0.95)';
        
        setTimeout(() => {
            button.style.transform = '';
        }, 150);
        
        // Add temporary glow effect
        const glowClass = 'hero-nav-clicked';
        button.classList.add(glowClass);
        
        setTimeout(() => {
            button.classList.remove(glowClass);
        }, 300);
    }

    goToSlide(index) {
        if (index >= 0 && index < this.slideCount) {
            this.showSlide(index);
        }
    }

    startAutoPlay() {
        this.stopAutoPlay();
        if (this.slideCount > 1) {
            this.autoPlayInterval = setInterval(() => {
                this.nextSlide();
            }, this.autoPlayDelay);
        }
    }

    stopAutoPlay() {
        if (this.autoPlayInterval) {
            clearInterval(this.autoPlayInterval);
            this.autoPlayInterval = null;
        }
    }

    addTouchSupport() {
        if (!this.carousel) return;

        let startX = 0;
        let endX = 0;
        let startY = 0;
        let endY = 0;

        this.carousel.addEventListener('touchstart', (e) => {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
        });

        this.carousel.addEventListener('touchend', (e) => {
            endX = e.changedTouches[0].clientX;
            endY = e.changedTouches[0].clientY;
            this.handleSwipe();
        });

        const handleSwipe = () => {
            const deltaX = startX - endX;
            const deltaY = Math.abs(startY - endY);

            // Only handle horizontal swipes (not vertical scrolling)
            if (Math.abs(deltaX) > 50 && deltaY < 100) {
                if (deltaX > 0) {
                    this.nextSlide(); // Swipe left - next slide
                } else {
                    this.prevSlide(); // Swipe right - prev slide
                }
            }
        };

        this.handleSwipe = handleSwipe;
    }
}

// Counter animation for stats
function animateCounter(element) {
    const target = parseInt(element.getAttribute('data-count'));
    const duration = 2000;
    const step = target / (duration / 16);
    let current = 0;

    const timer = setInterval(() => {
        current += step;
        if (current >= target) {
            current = target;
            clearInterval(timer);
        }
        element.textContent = Math.floor(current).toLocaleString();
    }, 16);
}

// Intersection Observer for stats animation
const observerOptions = {
    threshold: 0.5,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            const counters = entry.target.querySelectorAll('[data-count]');
            counters.forEach(counter => {
                if (!counter.classList.contains('animated')) {
                    counter.classList.add('animated');
                    animateCounter(counter);
                }
            });
        }
    });
}, observerOptions);

// Partnership Rolling Slider Class
class PartnershipRollingSlider {
    constructor() {
        this.track = document.getElementById('partnershipTrack');
        this.container = document.querySelector('.partnership-slider-container');
        this.items = this.track ? this.track.querySelectorAll('.partnership-item') : [];
        this.isAnimating = true;
        this.animationId = null;
        this.speed = 0.5; // Slower speed for more elegant movement
        this.currentX = 0;

        if (this.track && this.items.length > 0) {
            this.init();
        }
    }

    init() {
        // Calculate actual width of one set of items (we have 3 duplicates, so divide by 3)
        const originalItemsCount = this.items.length / 3;
        
        // Get actual width by measuring elements
        if (this.items.length > 0) {
            const firstItem = this.items[0];
            const itemWidth = firstItem.offsetWidth;
            const gap = 48; // 3rem = 48px gap
            
            this.itemWidth = itemWidth + gap;
            this.totalWidth = originalItemsCount * this.itemWidth;
        } else {
            this.itemWidth = 176; // fallback
            this.totalWidth = originalItemsCount * this.itemWidth;
        }
        
        // Set initial position
        this.currentX = 0;
        
        // Start animation
        this.startAnimation();
        
        // Pause on hover
        if (this.container) {
            this.container.addEventListener('mouseenter', () => this.pauseAnimation());
            this.container.addEventListener('mouseleave', () => this.resumeAnimation());
        }
    }

    startAnimation() {
        if (this.animationId) return;
        
        const animate = () => {
            if (this.isAnimating) {
                this.currentX -= this.speed;
                
                // Reset position when first set of items completely scrolled out
                // This creates seamless infinite loop
                if (Math.abs(this.currentX) >= this.totalWidth) {
                    this.currentX = 0;
                }
                
                this.track.style.transform = `translateX(${this.currentX}px)`;
            }
            
            this.animationId = requestAnimationFrame(animate);
        };
        
        animate();
    }

    pauseAnimation() {
        this.isAnimating = false;
    }

    resumeAnimation() {
        this.isAnimating = true;
    }

    stopAnimation() {
        if (this.animationId) {
            cancelAnimationFrame(this.animationId);
            this.animationId = null;
        }
    }
}

// Initialize everything when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    // Initialize hero carousel
    new HeroCarousel();

    // Initialize partnership rolling slider
    new PartnershipRollingSlider();

    // Observe stats section
    const statsSection = document.querySelector('.stat-item')?.closest('section');
    if (statsSection) {
        observer.observe(statsSection);
    }
});

// Update the progress bar on scroll
document.addEventListener('scroll', () => {
    const scrollTop = window.scrollY || document.documentElement.scrollTop;
    const docHeight = document.documentElement.scrollHeight - document.documentElement.clientHeight;
    const scrollPercent = (scrollTop / docHeight) * 100;

    const progressBar = document.getElementById('progress-bar');
    if (progressBar) {
        progressBar.style.width = `${scrollPercent}%`;
    }
});
</script>
@endpush