@extends('layouts.app')

@section('title', 'Beranda - Tirta Perwira PDAM Purbalingga')
@section('description', 'PDAM Purbalingga melayani dengan hati untuk memberikan air bersih berkualitas. Temukan informasi layanan, tarif, dan berita terkini.')
@section('keywords', 'PDAM Purbalingga, air bersih, pelayanan air, tarif air, Tirta Perwira')

@section('content')
<!-- Hero Section -->
@if($company && $company->hero_slides && is_array($company->hero_slides) && count($company->hero_slides) > 0)
    <!-- Multiple Hero Slides -->
    <section class="relative min-h-screen overflow-hidden">
        <div class="hero-carousel relative min-h-screen">
            @foreach($company->hero_slides as $index => $slide)
                @if(isset($slide['is_active']) && $slide['is_active'])
                <div class="hero-slide {{ $index === 0 ? 'active' : '' }} absolute inset-0 min-h-screen flex items-center transition-all duration-1000 ease-in-out"
                     data-slide="{{ $index }}"
                     data-overlay-color="{{ $slide['overlay_color'] ?? '#1e3a8a' }}"
                     data-overlay-opacity="{{ $slide['overlay_opacity'] ?? 80 }}">

                    <!-- Background Image -->
                    @if(isset($slide['background_image']) && $slide['background_image'])
                        <div class="absolute inset-0 bg-cover bg-center bg-no-repeat"
                             style="background-image: url('{{ Storage::url($slide['background_image']) }}');">
                        </div>
                    @else
                        <div class="absolute inset-0 hero-gradient"></div>
                    @endif

                    <!-- Overlay -->
                    <div class="absolute inset-0 hero-overlay"
                         style="background-color: {{ $slide['overlay_color'] ?? '#1e3a8a' }}; opacity: {{ ($slide['overlay_opacity'] ?? 80) / 100 }};"></div>

                    <!-- Content -->
                    <div class="relative z-10 container-custom text-white">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                            <div class="text-{{ $slide['text_position'] ?? 'left' }} {{ ($slide['text_position'] ?? 'left') === 'center' ? 'lg:text-center col-span-2' : (($slide['text_position'] ?? 'left') === 'right' ? 'lg:text-right lg:order-2' : 'lg:text-left') }}">
                                <h1 class="text-4xl lg:text-6xl font-bold mb-6 leading-tight animate-fadeInUp">
                                    {{ $slide['title'] ?? 'Default Title' }}
                                </h1>
                                <p class="text-xl lg:text-2xl mb-4 text-blue-100 leading-relaxed animate-fadeInUp animation-delay-200">
                                    {{ $slide['subtitle'] ?? '' }}
                                </p>
                                @if(isset($slide['description']) && $slide['description'])
                                <p class="text-lg mb-8 text-blue-200 leading-relaxed animate-fadeInUp animation-delay-400">
                                    {{ $slide['description'] }}
                                </p>
                                @endif
                                <div class="flex flex-col sm:flex-row gap-4 justify-{{ $slide['text_position'] ?? 'left' === 'center' ? 'center' : (($slide['text_position'] ?? 'left') === 'right' ? 'end' : 'start') }} animate-fadeInUp animation-delay-600">
                                    @if(isset($slide['primary_cta_text']) && $slide['primary_cta_text'])
                                    <a href="{{ $slide['primary_cta_link'] ?? '#' }}" class="btn-primary">
                                        {{ $slide['primary_cta_text'] }}
                                    </a>
                                    @endif
                                    @if(isset($slide['secondary_cta_text']) && $slide['secondary_cta_text'])
                                    <a href="{{ $slide['secondary_cta_link'] ?? '#' }}" class="btn-secondary">
                                        {{ $slide['secondary_cta_text'] }}
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            @endforeach
        </div>

        <!-- Navigation Arrows -->
        @if(count(array_filter($company->hero_slides, fn($slide) => $slide['is_active'] ?? false)) > 1)
        <button class="hero-nav hero-prev absolute left-4 top-1/2 transform -translate-y-1/2 z-20 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-full p-3 transition-all duration-200 text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button class="hero-nav hero-next absolute right-4 top-1/2 transform -translate-y-1/2 z-20 bg-white bg-opacity-20 hover:bg-opacity-30 rounded-full p-3 transition-all duration-200 text-white">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        <!-- Dots Indicator -->
        <div class="hero-dots absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 flex space-x-2">
            @foreach($company->hero_slides as $index => $slide)
                @if(isset($slide['is_active']) && $slide['is_active'])
                <button class="hero-dot w-3 h-3 rounded-full bg-white bg-opacity-50 hover:bg-opacity-75 transition-all duration-200 {{ $index === 0 ? 'active bg-opacity-100' : '' }}"
                        data-slide="{{ $index }}"></button>
                @endif
            @endforeach
        </div>
        @endif
    </section>
@else
    <!-- Fallback: Single Hero Section -->
    <section class="hero-gradient relative min-h-screen flex items-center pb-32">
        <div class="absolute inset-0 hero-overlay"></div>
        <div class="relative z-10 container-custom text-white">
            <div class="text-center">
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
                        <a href="{{ route('check-bill') }}" class="btn-secondary">
                            {{ ($company && $company->hero_cta_secondary && is_string($company->hero_cta_secondary)) ? $company->hero_cta_secondary : 'Cek Tagihan' }}
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Services -->
        <div class="absolute -bottom-28 lg:-bottom-32 left-0 right-0 px-4 z-20">
            <div class="container-custom">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 max-w-4xl mx-auto">
                    <!-- Cek Tagihan Service -->
                    <a href="https://tagihan.pdampurbalingga.co.id/"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="group bg-white/95 backdrop-blur-md rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 flex items-center space-x-4 hover:bg-white hover:-translate-y-1">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-blue-600 transition-colors">
                                Cek Tagihan
                            </h3>
                            <p class="text-sm text-gray-600">
                                Cek tagihan air bulanan Anda secara online dengan mudah
                            </p>
                        </div>
                        <div class="flex-shrink-0 text-gray-400 group-hover:text-blue-600 transition-colors">
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </a>

                    <!-- Pengaduan Online Service -->
                    <a href="https://pengaduan.pdampurbalingga.co.id/"
                       target="_blank"
                       rel="noopener noreferrer"
                       class="group bg-white/95 backdrop-blur-md rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 flex items-center space-x-4 hover:bg-white hover:-translate-y-1">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-red-600 rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.232 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                        </div>
                        <div class="flex-1">
                            <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-red-600 transition-colors">
                                Pengaduan Online
                            </h3>
                            <p class="text-sm text-gray-600">
                                Sampaikan keluhan atau saran Anda secara online
                            </p>
                        </div>
                        <div class="flex-shrink-0 text-gray-400 group-hover:text-red-600 transition-colors">
                            <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <!-- Scroll indicator -->
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 text-white animate-bounce">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>
@endif

<!-- Section Quick Card Layanan Utama -->
<section class="relative z-20 -mt-12 mb-16">
    <div class="container-custom px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
            <!-- Cek Tagihan Card -->
            <a href="https://tagihan.pdampurbalingga.co.id/"
               target="_blank"
               rel="noopener noreferrer"
               class="group bg-white/95 backdrop-blur-md rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 flex items-center space-x-4 hover:bg-white hover:-translate-y-1">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-blue-600 transition-colors">
                        Cek Tagihan
                    </h3>
                    <p class="text-sm text-gray-600">
                        Cek tagihan air bulanan Anda secara online dengan mudah
                    </p>
                </div>
                <div class="flex-shrink-0 text-gray-400 group-hover:text-blue-600 transition-colors">
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </a>

            <!-- Pengaduan Online Card -->
            <a href="https://pengaduan.pdampurbalingga.co.id/"
               target="_blank"
               rel="noopener noreferrer"
               class="group bg-white/95 backdrop-blur-md rounded-2xl p-6 shadow-xl hover:shadow-2xl transition-all duration-300 flex items-center space-x-4 hover:bg-white hover:-translate-y-1">
                <div class="flex-shrink-0">
                    <div class="w-12 h-12 bg-red-600 rounded-xl flex items-center justify-center group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.232 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-bold text-gray-900 mb-1 group-hover:text-red-600 transition-colors">
                        Pengaduan Online
                    </h3>
                    <p class="text-sm text-gray-600">
                        Sampaikan keluhan atau saran Anda secara online
                    </p>
                </div>
                <div class="flex-shrink-0 text-gray-400 group-hover:text-red-600 transition-colors">
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- About Preview Section -->
<section id="about-preview" class="bg-gradient-to-br from-blue-50 to-cyan-50 section-padding pt-40 lg:pt-48">
    <div class="container-custom">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            <!-- Content -->
            <div class="order-2 lg:order-1">
                <div class="mb-6">
                    <span class="inline-block px-4 py-2 bg-blue-100 text-blue-800 text-sm font-semibold rounded-full mb-4">
                        Tentang Kami
                    </span>
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">
                        PDAM Tirta Perwira Purbalingga
                    </h2>
                </div>

                <div class="space-y-4 text-gray-600 leading-relaxed">
                    <p class="text-lg">
                        <strong class="text-gray-900">PDAM Tirta Perwira</strong> telah mengabdi kepada masyarakat Purbalingga selama lebih dari 50 tahun dalam menyediakan air bersih berkualitas. Kami berkomitmen melayani dengan hati dan memberikan pelayanan terbaik.
                    </p>
                    <p>
                        Dengan teknologi modern dan SDM yang kompeten, kami terus berinovasi untuk meningkatkan kualitas pelayanan. Saat ini kami melayani lebih dari <strong class="text-blue-600">150.000 pelanggan</strong> di seluruh Kabupaten Purbalingga.
                    </p>
                    <p>
                        Visi kami adalah menjadi perusahaan air minum terdepan yang memberikan pelayanan prima dan berkontribusi pada pembangunan daerah yang berkelanjutan.
                    </p>
                </div>

                <!-- Key Features -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-8">
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-gray-700 font-medium">Air Berkualitas Tinggi</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-gray-700 font-medium">Pelayanan 24/7</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-cyan-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <span class="text-gray-700 font-medium">150K+ Pelanggan</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-yellow-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <span class="text-gray-700 font-medium">Teknologi Terdepan</span>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="w-10 h-10 bg-emerald-100 rounded-full flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <span class="text-gray-700 font-medium">99% Kualitas Air</span>
                    </div>
                </div>

                <!-- Action Buttons - Perfect Balanced Layout -->
                <div class="mt-8">
                    <!-- Single row with perfect 2:1:1 ratio -->
                    <div class="grid grid-cols-1 sm:grid-cols-4 gap-3">
                        <!-- Primary Button - Takes 2 columns (50%) -->
                        <a href="{{ route('about') }}" class="sm:col-span-2 btn-primary flex items-center justify-center group min-h-[48px]">
                            <svg class="w-5 h-5 mr-2 group-hover:scale-105 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <span>Profil Lengkap</span>
                        </a>

                        <!-- Secondary Button 1 - Takes 1 column (25%) -->
                        <a href="{{ route('about.history') }}" class="about-secondary-btn bg-white text-blue-600 px-3 py-3 rounded-lg font-medium hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 border border-blue-200 hover:border-blue-300 flex items-center justify-center group min-h-[48px]">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                            <span class="text-sm">Sejarah</span>
                        </a>

                        <!-- Secondary Button 2 - Takes 1 column (25%) -->
                        <a href="{{ route('about.vision-mission') }}" class="about-secondary-btn bg-white text-blue-600 px-3 py-3 rounded-lg font-medium hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 border border-blue-200 hover:border-blue-300 flex items-center justify-center group min-h-[48px]">
                            <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                            <span class="text-sm">Visi Misi</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Image -->
            <div class="order-1 lg:order-2">
                <div class="relative">
                    @if($company && $company->getFirstMediaUrl('about_image'))
                        <img data-src="{{ $company->getFirstMediaUrl('about_image') }}"
                             alt="Kantor PDAM Tirta Perwira"
                             class="w-full h-96 lg:h-[500px] object-cover rounded-2xl shadow-2xl lazy-image"
                             loading="lazy">
                    @else
                        <!-- Fallback: Gradient placeholder with building icon -->
                        <div class="w-full h-96 lg:h-[500px] bg-gradient-to-br from-blue-400 via-blue-500 to-blue-600 rounded-2xl shadow-2xl flex items-center justify-center">
                            <div class="text-center text-white">
                                <svg class="w-24 h-24 mx-auto mb-4 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H7m2 0v-5a2 2 0 012-2h2a2 2 0 012 2v5"></path>
                                </svg>
                                <h3 class="text-xl font-semibold mb-2">PDAM Tirta Perwira</h3>
                                <p class="text-blue-100">Kantor Pusat Purbalingga</p>
                            </div>
                        </div>
                    @endif

                    <!-- Decorative elements -->
                    <div class="absolute -top-4 -right-4 w-24 h-24 bg-blue-200 rounded-full opacity-20 animate-pulse"></div>
                    <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-cyan-200 rounded-full opacity-20 animate-pulse" style="animation-delay: 1s;"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="bg-white section-padding">
    <div class="container-custom">
        <div class="text-center mb-12">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Prestasi Kami</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Komitmen nyata dalam memberikan pelayanan air bersih berkualitas untuk masyarakat Purbalingga
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="stat-item text-center group">
                <div class="w-20 h-20 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center group-hover:bg-blue-200 transition-colors duration-200">
                    <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="stat-number text-3xl font-bold text-blue-600 mb-2" data-count="150000">0</div>
                <div class="stat-label text-gray-600 font-medium">Pelanggan Aktif</div>
            </div>
            <div class="stat-item text-center group">
                <div class="w-20 h-20 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center group-hover:bg-green-200 transition-colors duration-200">
                    <svg class="w-10 h-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H7m2 0v-5a2 2 0 012-2h2a2 2 0 012 2v5"></path>
                    </svg>
                </div>
                <div class="stat-number text-3xl font-bold text-green-600 mb-2" data-count="50">0</div>
                <div class="stat-label text-gray-600 font-medium">Tahun Pengalaman</div>
            </div>
            <div class="stat-item text-center group">
                <div class="w-20 h-20 mx-auto mb-4 bg-cyan-100 rounded-full flex items-center justify-center group-hover:bg-cyan-200 transition-colors duration-200">
                    <svg class="w-10 h-10 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5l-1-1z"></path>
                    </svg>
                </div>
                <div class="stat-number text-3xl font-bold text-cyan-600 mb-2" data-count="500">0</div>
                <div class="stat-label text-gray-600 font-medium">Liter/Detik Kapasitas</div>
            </div>
            <div class="stat-item text-center group">
                <div class="w-20 h-20 mx-auto mb-4 bg-yellow-100 rounded-full flex items-center justify-center group-hover:bg-yellow-200 transition-colors duration-200">
                    <svg class="w-10 h-10 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="stat-number text-3xl font-bold text-yellow-600 mb-2" data-count="99">0</div>
                <div class="stat-label text-gray-600 font-medium">% Kualitas Air</div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section id="services-preview" class="bg-gray-50 section-padding">
    <div class="container-custom">
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Layanan Utama</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Kami menyediakan berbagai layanan air bersih berkualitas untuk memenuhi kebutuhan masyarakat Purbalingga
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($services->take(6) as $service)
            <div class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 group overflow-hidden">
                @if($service->getFirstMediaUrl('featured_image'))
                    <img data-src="{{ $service->getFirstMediaUrl('featured_image') }}" alt="{{ $service->name }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300 lazy-image" loading="lazy">
                @else
                    <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center group-hover:from-blue-500 group-hover:to-blue-700 transition-all duration-300">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5l-1-1z"></path>
                        </svg>
                    </div>
                @endif
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors duration-200">{{ $service->name }}</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit(strip_tags($service->description), 100) }}</p>
                    <a href="{{ route('services.show', $service->slug) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors duration-200">
                        Selengkapnya
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Layanan Akan Segera Tersedia</h3>
                <p class="text-gray-600">Kami sedang mempersiapkan informasi layanan terbaik untuk Anda.</p>
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

<!-- News Section -->
<section id="news-preview" class="bg-white section-padding">
    <div class="container-custom">
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Berita Terkini</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Dapatkan informasi terbaru seputar pelayanan dan perkembangan PDAM Purbalingga
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($news->take(6) as $article)
            <article class="bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 group overflow-hidden">
                @if($article->getFirstMediaUrl('featured_image'))
                    <img data-src="{{ $article->getFirstMediaUrl('featured_image') }}" alt="{{ $article->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300 lazy-image" loading="lazy">
                @else
                    <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center group-hover:from-blue-500 group-hover:to-blue-700 transition-all duration-300">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                    </div>
                @endif
                <div class="p-6">
                    <div class="flex items-center text-sm text-gray-500 mb-3">
                        <time datetime="{{ $article->published_at->format('Y-m-d') }}">
                            {{ $article->published_at->format('d M Y') }}
                        </time>
                        <span class="mx-2">•</span>
                        <span class="inline-flex px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 rounded-full">{{ ucfirst($article->type) }}</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200">
                        <a href="{{ route('news.show', $article->slug) }}">
                            {{ $article->title }}
                        </a>
                    </h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit(strip_tags($article->content), 120) }}</p>
                    <a href="{{ route('news.show', $article->slug) }}" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold text-sm transition-colors duration-200">
                        Baca Selengkapnya
                        <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </article>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-lg flex items-center justify-center">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Berita Akan Segera Tersedia</h3>
                <p class="text-gray-600">Kami akan segera menyajikan berita dan informasi terkini untuk Anda.</p>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-12">
            <a href="{{ route('news') }}" class="btn-primary">
                Lihat Semua Berita
            </a>
        </div>
    </div>
</section>

<!-- Quick Actions -->
<section class="bg-gradient-to-br from-blue-600 via-blue-700 to-blue-800 text-white section-padding relative overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" preserveAspectRatio="none">
            <pattern id="grid" width="10" height="10" patternUnits="userSpaceOnUse">
                <path d="M 10 0 L 0 0 0 10" fill="none" stroke="currentColor" stroke-width="0.5"/>
            </pattern>
            <rect width="100" height="100" fill="url(#grid)" />
        </svg>
    </div>

    <div class="container-custom relative z-10">
        <div class="text-center mb-16">
            <h2 class="text-3xl lg:text-4xl font-bold mb-4">Akses Cepat</h2>
            <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                Dapatkan layanan dengan mudah dan cepat melalui platform digital kami
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Cek Tagihan -->
            <a href="{{ route('check-bill') }}" class="quick-action-card bg-white hover:bg-gray-50 rounded-xl p-6 text-center transition-all duration-300 group shadow-lg hover:shadow-xl border border-gray-100">
                <div class="w-16 h-16 mx-auto mb-4 bg-blue-100 rounded-full flex items-center justify-center group-hover:bg-blue-200 group-hover:scale-110 transition-all duration-300">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-2 text-gray-900 group-hover:text-blue-600 transition-colors duration-200">Cek Tagihan</h3>
                <p class="text-gray-600 text-sm">Lihat tagihan air bulanan Anda</p>
            </a>

            <!-- Pengaduan -->
            <a href="{{ route('services.pengaduan') }}" class="quick-action-card bg-white hover:bg-gray-50 rounded-xl p-6 text-center transition-all duration-300 group shadow-lg hover:shadow-xl border border-gray-100">
                <div class="w-16 h-16 mx-auto mb-4 bg-red-100 rounded-full flex items-center justify-center group-hover:bg-red-200 group-hover:scale-110 transition-all duration-300">
                    <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-2 text-gray-900 group-hover:text-red-600 transition-colors duration-200">Pengaduan</h3>
                <p class="text-gray-600 text-sm">Laporkan masalah atau keluhan</p>
            </a>

            <!-- Sambungan Baru -->
            <a href="{{ route('services.sambungan-baru') }}" class="quick-action-card bg-white hover:bg-gray-50 rounded-xl p-6 text-center transition-all duration-300 group shadow-lg hover:shadow-xl border border-gray-100">
                <div class="w-16 h-16 mx-auto mb-4 bg-green-100 rounded-full flex items-center justify-center group-hover:bg-green-200 group-hover:scale-110 transition-all duration-300">
                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-2 text-gray-900 group-hover:text-green-600 transition-colors duration-200">Sambungan Baru</h3>
                <p class="text-gray-600 text-sm">Daftar sambungan air baru</p>
            </a>

            <!-- Download Center -->
            <a href="{{ route('download-center') }}" class="quick-action-card bg-white hover:bg-gray-50 rounded-xl p-6 text-center transition-all duration-300 group shadow-lg hover:shadow-xl border border-gray-100">
                <div class="w-16 h-16 mx-auto mb-4 bg-purple-100 rounded-full flex items-center justify-center group-hover:bg-purple-200 group-hover:scale-110 transition-all duration-300">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold mb-2 text-gray-900 group-hover:text-purple-600 transition-colors duration-200">Download</h3>
                <p class="text-gray-600 text-sm">Formulir dan dokumen</p>
            </a>
        </div>

        <!-- Additional Info -->
        <div class="mt-12 text-center">
            <div class="inline-flex items-center px-6 py-3 bg-white bg-opacity-10 rounded-full text-blue-100">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Layanan tersedia 24/7 untuk kemudahan Anda
            </div>
        </div>
    </div>
</section>

<!-- Contact Preview Section -->
<section id="contact-preview" class="bg-gradient-to-br from-blue-50 to-cyan-50 py-8 lg:py-12">
    <div class="container-custom">
        <!-- Main Grid: Mobile stack, Desktop side-by-side -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-5 lg:gap-6">

            <!-- Contact Info Section - 7 columns on desktop -->
            <div class="lg:col-span-7">
                <!-- Header -->
                <div class="mb-5">
                    <span class="inline-block px-2.5 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full mb-2">
                        Hubungi Kami
                    </span>
                    <h2 class="text-xl lg:text-2xl font-bold text-gray-900 mb-2">
                        Butuh Bantuan atau Informasi?
                    </h2>
                    <p class="text-gray-600 leading-relaxed text-sm">
                        Tim customer service kami siap membantu Anda 24/7 untuk semua kebutuhan layanan air bersih.
                    </p>
                </div>

                <!-- Contact Cards - Grid 2x2 -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-5">
                    <!-- Phone -->
                    <div class="bg-white rounded-lg p-3 shadow-md hover:shadow-lg transition-all duration-300 border border-blue-100">
                        <div class="flex items-center space-x-2.5">
                            <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900 text-xs">Telepon</h3>
                                <p class="text-xs text-gray-500">Layanan Pelanggan</p>
                                <a href="tel:{{ $company->phone ?? '(0281) 895-123' }}" class="text-blue-600 font-medium hover:text-blue-700 transition-colors text-xs">
                                    {{ $company->phone ?? '(0281) 895-123' }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    @if($company && $company->whatsapp_cs)
                    <div class="bg-white rounded-lg p-3 shadow-md hover:shadow-lg transition-all duration-300 border border-green-100">
                        <div class="flex items-center space-x-2.5">
                            <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.570-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.106"/>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900 text-xs">WhatsApp</h3>
                                <p class="text-xs text-gray-500">Chat Langsung</p>
                                <a href="https://wa.me/{{ str_replace(['+', '-', ' '], '', $company->whatsapp_cs) }}" class="text-green-600 font-medium hover:text-green-700 transition-colors text-xs">
                                    {{ $company->whatsapp_cs }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Email -->
                    <div class="bg-white rounded-lg p-3 shadow-md hover:shadow-lg transition-all duration-300 border border-purple-100">
                        <div class="flex items-center space-x-2.5">
                            <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 012 2z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900 text-xs">Email</h3>
                                <p class="text-xs text-gray-500">Kirim Pesan</p>
                                <a href="mailto:{{ $company->email ?? 'info@pdamtirtaperwira.com' }}" class="text-purple-600 font-medium hover:text-purple-700 transition-colors text-xs">
                                    {{ $company->email ?? 'info@pdamtirtaperwira.com' }}
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Address -->
                    <div class="bg-white rounded-lg p-3 shadow-md hover:shadow-lg transition-all duration-300 border border-cyan-100">
                        <div class="flex items-start space-x-2.5">
                            <div class="w-8 h-8 bg-cyan-100 rounded-full flex items-center justify-center">
                                <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900 text-xs">Alamat Kantor</h3>
                                <p class="text-xs text-gray-500">Kunjungi Langsung</p>
                                <p class="text-cyan-600 font-medium text-xs leading-tight">
                                    {{ $company->address ?? 'Jl. Jend. Sudirman No. 123, Purbalingga, Jawa Tengah 53312' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Office Status & Action Buttons -->
                <div class="space-y-3">
                    <!-- Office Status -->
                    <div class="bg-white rounded-lg p-3 shadow-md border-l-4 border-blue-500">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2.5">
                                <div class="w-2.5 h-2.5 rounded-full office-status-indicator"></div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 text-xs">Status Kantor</h3>
                                    <p class="text-xs office-status-text text-gray-500"></p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-400">Jam Operasional</p>
                                <p class="text-xs font-medium text-gray-600">Sen-Jum: 08:00-16:00</p>
                                <p class="text-xs font-medium text-gray-600">Sabtu: 08:00-12:00</p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-2.5">
                        <a href="{{ route('contact') }}" class="btn-primary text-xs px-3 py-2 flex-1">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                            Kontak Lengkap
                        </a>
                        <a href="{{ route('complaint') }}" class="bg-white text-blue-600 px-3 py-2 rounded-lg font-semibold hover:bg-blue-50 hover:text-blue-700 transition-all duration-200 border border-blue-200 hover:border-blue-300 inline-flex items-center justify-center flex-1 text-xs">
                            <svg class="w-3.5 h-3.5 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Buat Pengaduan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Quick Contact Form Section - 5 columns on desktop -->
            <div class="lg:col-span-5">
                <div class="bg-white rounded-xl shadow-lg p-4 h-full">
                    <h3 class="text-lg font-bold text-gray-900 mb-3">Kirim Pesan Cepat</h3>
                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-3">
                        @csrf
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label for="quick-name" class="block text-xs font-medium text-gray-700 mb-1">Nama</label>
                                <input type="text" id="quick-name" name="name" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm">
                            </div>
                            <div>
                                <label for="quick-phone" class="block text-xs font-medium text-gray-700 mb-1">Telepon</label>
                                <input type="tel" id="quick-phone" name="phone" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm">
                            </div>
                        </div>
                        <div>
                            <label for="quick-subject" class="block text-xs font-medium text-gray-700 mb-1">Subjek</label>
                            <select id="quick-subject" name="subject" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 text-sm">
                                <option value="">Pilih subjek...</option>
                                <option value="Informasi Layanan">Informasi Layanan</option>
                                <option value="Sambungan Baru">Sambungan Baru</option>
                                <option value="Keluhan Pelayanan">Keluhan Pelayanan</option>
                                <option value="Tagihan">Tagihan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>
                        <div>
                            <label for="quick-message" class="block text-xs font-medium text-gray-700 mb-1">Pesan</label>
                            <textarea id="quick-message" name="message" rows="4" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none text-sm" placeholder="Tulis pesan Anda..."></textarea>
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-200 flex items-center justify-center shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 text-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Kirim Pesan Sekarang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Progress Indicator -->
<div id="scroll-progress" class="fixed top-0 left-0 w-full h-1 bg-gray-200 z-50">
    <div id="progress-bar" class="h-full bg-gradient-to-r from-blue-500 to-cyan-500 transition-all duration-150 ease-out" style="width: 0%"></div>
</div>

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
            this.prevBtn.addEventListener('click', () => this.prevSlide());
        }

        if (this.nextBtn) {
            this.nextBtn.addEventListener('click', () => this.nextSlide());
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

        // Pause auto-play on hover with delay
        if (this.carousel) {
            let hoverTimeout;

            this.carousel.addEventListener('mouseenter', () => {
                clearTimeout(hoverTimeout);
                this.stopAutoPlay();
            });

            this.carousel.addEventListener('mouseleave', () => {
                // Delay restart to avoid flickering when moving between elements
                hoverTimeout = setTimeout(() => {
                    this.startAutoPlay();
                }, 300);
            });
        }
    }

    showSlide(index) {
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
    }

    nextSlide() {
        const next = (this.currentSlide + 1) % this.slideCount;
        this.showSlide(next);
    }

    prevSlide() {
        const prev = (this.currentSlide - 1 + this.slideCount) % this.slideCount;
        this.showSlide(prev);
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

// Initialize everything when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    // Initialize hero carousel
    new HeroCarousel();

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
