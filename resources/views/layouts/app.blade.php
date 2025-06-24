<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', (($company && $company->company_name && is_string($company->company_name)) ? $company->company_name : config('app.name', 'Tirta Perwira')))</title>
    <meta name="description" content="@yield('description', (($company && $company->company_description && is_string($company->company_description)) ? strip_tags($company->company_description) : 'PDAM Purbalingga - Melayani dengan Hati, Memberikan yang Terbaik untuk Air Bersih Berkualitas'))">
    <meta name="keywords" content="@yield('keywords', 'PDAM, Purbalingga, air bersih, pelayanan air, tarif air, pembayaran air')">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og_title', (($company && $company->company_name && is_string($company->company_name)) ? $company->company_name : config('app.name')))">
    <meta property="og:description" content="@yield('og_description', (($company && $company->company_description && is_string($company->company_description)) ? strip_tags($company->company_description) : 'PDAM Purbalingga - Melayani dengan Hati'))">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', $company && $company->logo ? asset('storage/' . $company->logo) : asset('images/og-default.jpg'))">

    <!-- Favicon -->
    @if($company && $company->favicon)
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $company->favicon) }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/' . $company->favicon) }}">
    @else
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Header Navigation -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <nav class="container mx-auto px-4 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">                <!-- Logo -->
                <div class="flex items-center space-x-3">
                    @if($company && $company->getFirstMediaUrl('logo'))
                    <img src="{{ $company->getFirstMediaUrl('logo') }}"
                         alt="Logo {{ $company->company_name ?? 'Tirta Perwira' }}"
                         class="h-10 w-10 lg:h-12 lg:w-12 object-contain">
                    @elseif($company && $company->logo)
                    <img src="{{ asset('storage/' . $company->logo) }}"
                         alt="Logo {{ $company->company_name ?? 'Tirta Perwira' }}"
                         class="h-10 w-10 lg:h-12 lg:w-12 object-contain">
                    @else
                    <div class="h-10 w-10 lg:h-12 lg:w-12 bg-blue-600 rounded-full flex items-center justify-center">
                        <span class="text-white font-bold text-lg">TP</span>
                    </div>
                    @endif
                    <div class="hidden sm:block">
                        <div class="text-lg lg:text-xl font-bold text-blue-900">
                            {{ ($company && $company->company_name && is_string($company->company_name)) ? Str::before($company->company_name, ' - ') : 'Tirta Perwira' }}
                        </div>
                        <div class="text-xs lg:text-sm text-blue-600">
                            {{ ($company && $company->company_name && is_string($company->company_name) && Str::contains($company->company_name, ' - ')) ? Str::after($company->company_name, ' - ') : 'PDAM Purbalingga' }}
                        </div>
                    </div>
                </div>

                <!-- Search Bar (Desktop) -->
                <div class="hidden md:flex flex-1 max-w-md mx-8">
                    <div class="relative w-full">
                        <form action="{{ route('search') }}" method="GET" class="relative">
                            <input
                                type="text"
                                name="q"
                                id="search-input"
                                value="{{ request('q') }}"
                                placeholder="Cari berita, layanan, informasi..."
                                class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                autocomplete="off"
                            >
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                </svg>
                            </div>
                        </form>

                        <!-- Search Suggestions Dropdown -->
                        <div id="search-suggestions" class="absolute top-full left-0 right-0 bg-white border border-gray-200 rounded-lg shadow-lg mt-1 hidden z-50">
                            <div id="suggestions-content" class="py-2"></div>
                        </div>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        Beranda
                    </a>

                    @if(request()->routeIs('home'))
                        <!-- Hybrid Navigation for Homepage -->
                        <a href="#about-preview" class="nav-link smooth-scroll">
                            Tentang Kami
                        </a>
                        <a href="#services-preview" class="nav-link smooth-scroll">
                            Layanan
                        </a>
                        <a href="#news-preview" class="nav-link smooth-scroll">
                            Berita
                        </a>
                        <a href="#contact-preview" class="nav-link smooth-scroll">
                            Kontak
                        </a>

                        <!-- Quick Actions Dropdown -->
                        <div class="relative group">
                            <button class="nav-link flex items-center">
                                Layanan Online
                                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="absolute right-0 mt-2 w-56 bg-white rounded-md shadow-lg py-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 invisible group-hover:visible">
                                <a href="{{ route('check-bill') }}" class="dropdown-link">
                                    <svg class="w-4 h-4 mr-2 inline text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Cek Tagihan
                                </a>
                                <a href="{{ route('services.sambungan-baru') }}" class="dropdown-link">
                                    <svg class="w-4 h-4 mr-2 inline text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                    Sambungan Baru
                                </a>
                                <a href="{{ route('complaint') }}" class="dropdown-link">
                                    <svg class="w-4 h-4 mr-2 inline text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Pengaduan Online
                                </a>
                                <div class="border-t border-gray-200 my-1"></div>
                                <a href="{{ route('tariff') }}" class="dropdown-link">
                                    <svg class="w-4 h-4 mr-2 inline text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                    Tarif Air
                                </a>
                            </div>
                        </div>
                    @else
                        <!-- Traditional Navigation for Other Pages -->
                        <div class="relative group">
                            <button class="nav-link flex items-center">
                                Tentang Kami
                                <svg class="ml-1 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div class="absolute left-0 mt-2 w-48 bg-white rounded-md shadow-lg py-2 opacity-0 group-hover:opacity-100 transition-opacity duration-200 invisible group-hover:visible">
                                <a href="{{ route('about') }}" class="dropdown-link">Profil Perusahaan</a>
                                <a href="{{ route('about.history') }}" class="dropdown-link">Sejarah</a>
                                <a href="{{ route('about.vision-mission') }}" class="dropdown-link">Visi & Misi</a>
                            </div>
                        </div>
                        <a href="{{ route('services') }}" class="nav-link {{ request()->routeIs('services*') ? 'active' : '' }}">
                            Layanan
                        </a>
                        <a href="{{ route('news') }}" class="nav-link {{ request()->routeIs('news*') ? 'active' : '' }}">
                            Berita
                        </a>
                        <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                            Kontak
                        </a>
                    @endif
                </div>

                <!-- Mobile Menu Button -->
                <div class="lg:hidden">
                    <button type="button" id="mobile-menu-button" class="text-gray-600 hover:text-gray-900 focus:outline-none focus:text-gray-900">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>

            <!-- Mobile Navigation -->
            <div id="mobile-menu" class="lg:hidden hidden">
                <!-- Mobile Search -->
                <div class="px-4 py-3 border-b bg-white">
                    <form action="{{ route('search') }}" method="GET" class="relative">
                        <input
                            type="text"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Cari..."
                            class="w-full pl-10 pr-4 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </form>
                </div>

                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-gray-50 border-t">
                    <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a>
                    <a href="{{ route('about') }}" class="mobile-nav-link">Tentang Kami</a>

                    <!-- Mobile Services Section -->
                    <div class="mobile-nav-section">
                        <a href="{{ route('services') }}" class="mobile-nav-link">Layanan</a>
                        @if(isset($navbarServices) && $navbarServices->isNotEmpty())
                            <div class="ml-4 space-y-1">
                                @php
                                    $mobileServices = $navbarServices->flatten()->take(4);
                                @endphp
                                @foreach($mobileServices as $service)
                                    <a href="{{ route('services.show', $service->slug) }}" class="mobile-nav-sublink">
                                        @if($service->navbar_display_icon)
                                            <i class="{{ $service->navbar_display_icon }} mr-2 text-xs"></i>
                                        @endif
                                        {{ $service->navbar_display_name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    <a href="{{ route('news') }}" class="mobile-nav-link">Berita</a>

                    <!-- Mobile Tariff Section -->
                    <div class="mobile-nav-section">
                        <a href="{{ route('tariff') }}" class="mobile-nav-link">Tarif Air</a>
                        @if(isset($navbarTariffs) && $navbarTariffs->isNotEmpty())
                            <div class="ml-4 space-y-1">
                                @php
                                    $mobileTariffs = $navbarTariffs->flatten()->take(4);
                                @endphp
                                @foreach($mobileTariffs as $tariff)
                                    <a href="{{ route('tariff') }}#{{ Str::slug($tariff->customer_type . '-' . $tariff->min_usage) }}" class="mobile-nav-sublink">
                                        @if($tariff->navbar_display_icon)
                                            <i class="{{ $tariff->navbar_display_icon }} mr-2 text-xs"></i>
                                        @endif
                                        {{ $tariff->navbar_display_name }}
                                    </a>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <a href="{{ route('check-bill') }}" class="mobile-nav-link">Cek Tagihan</a>
                    <a href="{{ route('complaint') }}" class="mobile-nav-link text-red-600 font-medium">Pengaduan Online</a>
                    <a href="{{ route('contact') }}" class="mobile-nav-link">Kontak</a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-blue-900 text-white">
        <div class="container mx-auto px-4 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="lg:col-span-1">
                    <div class="flex items-center space-x-3 mb-4">
                        @if($company && $company->getFirstMediaUrl('logo_white'))
                        <img src="{{ $company->getFirstMediaUrl('logo_white') }}"
                             alt="Logo {{ $company->company_name ?? 'Tirta Perwira' }}"
                             class="h-12 w-12 object-contain">
                        @elseif($company && $company->getFirstMediaUrl('logo'))
                        <img src="{{ $company->getFirstMediaUrl('logo') }}"
                             alt="Logo {{ $company->company_name ?? 'Tirta Perwira' }}"
                             class="h-12 w-12 object-contain filter brightness-0 invert">
                        @elseif($company && $company->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}"
                             alt="Logo {{ $company->company_name ?? 'Tirta Perwira' }}"
                             class="h-12 w-12 object-contain filter brightness-0 invert">
                        @else
                        <div class="h-12 w-12 bg-white rounded-full flex items-center justify-center">
                            <span class="text-blue-900 font-bold text-xl">TP</span>
                        </div>
                        @endif
                        <div>
                            <div class="text-xl font-bold">
                                {{ ($company && $company->company_name && is_string($company->company_name)) ? Str::before($company->company_name, ' - ') : 'Tirta Perwira' }}
                            </div>
                            <div class="text-sm text-blue-200">
                                {{ ($company && $company->company_name && is_string($company->company_name) && Str::contains($company->company_name, ' - ')) ? Str::after($company->company_name, ' - ') : 'PDAM Purbalingga' }}
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    @if($company && $company->social_media && is_array($company->social_media))
                        <div class="flex space-x-4">
                            @foreach($company->social_media as $platform => $url)
                                @if($url)
                                    <a href="{{ $url }}" class="social-link" target="_blank" rel="noopener noreferrer">
                                        @if($platform === 'facebook')
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                            </svg>
                                        @elseif($platform === 'twitter')
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                            </svg>
                                        @elseif($platform === 'instagram')
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                            </svg>
                                        @elseif($platform === 'youtube')
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                                            </svg>
                                        @elseif($platform === 'linkedin')
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                            </svg>
                                        @else
                                            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M13.54 12a6.8 6.8 0 01-6.77 6.82A6.8 6.8 0 010 12a6.8 6.8 0 016.77-6.82A6.8 6.8 0 0113.54 12zM20.96 12c0 3.54-1.51 6.42-3.38 6.42-1.87 0-3.39-2.88-3.39-6.42s1.52-6.42 3.39-6.42 3.38 2.88 3.38 6.42M24 12c0 3.17-.53 5.75-1.19 5.75-.66 0-1.19-2.58-1.19-5.75s.53-5.75 1.19-5.75C23.47 6.25 24 8.83 24 12z"/>
                                            </svg>
                                        @endif
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    @else
                        <!-- Default social media jika tidak ada data dinamis -->
                        <div class="flex space-x-4">
                            <a href="#" class="social-link">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="social-link">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="#" class="social-link">
                                <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    </div>
                    @endif
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Tautan Cepat</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('about') }}" class="footer-link">Tentang Kami</a></li>
                        <li><a href="{{ route('services') }}" class="footer-link">Layanan</a></li>
                        <li><a href="{{ route('news') }}" class="footer-link">Berita</a></li>
                        <li><a href="{{ route('tariff') }}" class="footer-link">Tarif Air</a></li>
                        <li><a href="{{ route('contact') }}" class="footer-link">Kontak</a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Layanan Utama</h3>
                    <ul class="space-y-2">
                        <li><a href="{{ route('services.sambungan-baru') }}" class="footer-link">Sambungan Baru</a></li>
                        <li><a href="{{ route('services.pengaduan') }}" class="footer-link">Pengaduan Online</a></li>
                        <li><a href="{{ route('check-bill') }}" class="footer-link">Cek Tagihan</a></li>
                        <li><a href="{{ route('services.pembayaran') }}" class="footer-link">Info Pembayaran</a></li>
                        <li><a href="{{ route('download-center') }}" class="footer-link">Download Center</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Hubungi Kami</h3>
                    <div class="space-y-3 text-sm">
                        @if($company && $company->address)
                            <div class="flex items-start space-x-2">
                                <svg class="w-4 h-4 text-blue-300 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-blue-200">{{ $company->address }}</span>
                            </div>
                        @else
                            <div class="flex items-start space-x-2">
                                <svg class="w-4 h-4 text-blue-300 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-blue-200">Jl. Jenderal Ahmad Yani No. 123, Purbalingga, Jawa Tengah 53316</span>
                            </div>
                        @endif

                        @if($company && $company->phone)
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-blue-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <a href="tel:{{ $company->phone }}" class="text-blue-200 hover:text-white transition-colors">{{ $company->phone }}</a>
                            </div>
                        @else
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-blue-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <a href="tel:(0281) 891-234" class="text-blue-200 hover:text-white transition-colors">(0281) 891-234</a>
                            </div>
                        @endif

                        @if($company && $company->email)
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-blue-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 012 2z"></path>
                                </svg>
                                <a href="mailto:{{ $company->email }}" class="text-blue-200 hover:text-white transition-colors">{{ $company->email }}</a>
                            </div>
                        @else
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-blue-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 012 2z"></path>
                                </svg>
                                <a href="mailto:info@tirtaperwira.purbalinggakab.go.id" class="text-blue-200 hover:text-white transition-colors">info@tirtaperwira.purbalinggakab.go.id</a>
                            </div>
                        @endif

                        @if($company && $company->website)
                            <div class="flex items-center space-x-2">
                                <svg class="w-4 h-4 text-blue-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                </svg>
                                <a href="{{ $company->website }}" target="_blank" rel="noopener noreferrer" class="text-blue-200 hover:text-white transition-colors">Website Resmi</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="border-t border-blue-800 mt-12 pt-8">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div class="text-sm text-blue-200">
                        © {{ date('Y') }} {{ ($company && $company->company_name && is_string($company->company_name)) ? $company->company_name : 'Tirta Perwira - PDAM Purbalingga' }}. Semua hak dilindungi.
                    </div>
                    <div class="mt-4 md:mt-0 flex space-x-6">
                        <a href="#" class="text-sm text-blue-200 hover:text-white">Kebijakan Privasi</a>
                        <a href="#" class="text-sm text-blue-200 hover:text-white">Syarat & Ketentuan</a>
                        <a href="#" class="text-sm text-blue-200 hover:text-white">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });

        // Search autocomplete functionality
        let searchTimeout;
        const searchInput = document.getElementById('search-input');
        const suggestionsDiv = document.getElementById('search-suggestions');
        const suggestionsContent = document.getElementById('suggestions-content');

        if (searchInput && suggestionsDiv) {
            searchInput.addEventListener('input', function() {
                const query = this.value.trim();

                clearTimeout(searchTimeout);

                if (query.length < 2) {
                    suggestionsDiv.classList.add('hidden');
                    return;
                }

                searchTimeout = setTimeout(() => {
                    fetch(`{{ route('search.suggest') }}?q=${encodeURIComponent(query)}`, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => response.json())
                    .then(suggestions => {
                        if (suggestions.length > 0) {
                            suggestionsContent.innerHTML = suggestions.map(suggestion => {
                                const iconClass = suggestion.type === 'news' ? 'text-blue-500' : 'text-green-500';
                                const typeLabel = suggestion.type === 'news' ? 'Berita' : 'Layanan';

                                return `
                                    <div class="px-4 py-2 hover:bg-gray-50 cursor-pointer search-suggestion" data-text="${suggestion.text}">
                                        <div class="flex items-center space-x-3">
                                            <div class="flex-shrink-0">
                                                <svg class="h-4 w-4 ${iconClass}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    ${suggestion.type === 'news' ?
                                                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>' :
                                                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>'
                                                    }
                                                </svg>
                                            </div>
                                            <div class="flex-1 min-w-0">
                                                <p class="text-sm font-medium text-gray-900 truncate">${suggestion.text}</p>
                                                <p class="text-xs text-gray-500">${typeLabel}</p>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            }).join('');

                            // Add "Lihat semua hasil" option
                            suggestionsContent.innerHTML += `
                                <div class="border-t border-gray-100 px-4 py-2 hover:bg-gray-50 cursor-pointer" onclick="document.querySelector('form').submit();">
                                    <div class="flex items-center space-x-3">
                                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-600">Lihat semua hasil untuk "<strong>${query}</strong>"</span>
                                    </div>
                                </div>
                            `;

                            suggestionsDiv.classList.remove('hidden');

                            // Add click handlers for suggestions
                            document.querySelectorAll('.search-suggestion').forEach(item => {
                                item.addEventListener('click', function() {
                                    const text = this.getAttribute('data-text');
                                    searchInput.value = text;
                                    suggestionsDiv.classList.add('hidden');
                                    document.querySelector('form').submit();
                                });
                            });
                        } else {
                            suggestionsDiv.classList.add('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Search suggestion error:', error);
                        suggestionsDiv.classList.add('hidden');
                    });
                }, 300);
            });

            // Hide suggestions when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchInput.contains(e.target) && !suggestionsDiv.contains(e.target)) {
                    suggestionsDiv.classList.add('hidden');
                }
            });

            // Handle keyboard navigation
            searchInput.addEventListener('keydown', function(e) {
                const suggestions = document.querySelectorAll('.search-suggestion');
                let currentFocus = -1;

                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    currentFocus++;
                    if (currentFocus >= suggestions.length) currentFocus = 0;
                    suggestions[currentFocus]?.focus();
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    currentFocus--;
                    if (currentFocus < 0) currentFocus = suggestions.length - 1;
                    suggestions[currentFocus]?.focus();
                } else if (e.key === 'Escape') {
                    suggestionsDiv.classList.add('hidden');
                }
            });
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
