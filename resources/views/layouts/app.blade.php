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
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Styles for Enhanced Features -->
    <style>
        /* Navbar transition */
        header {
            transition: all 0.3s ease-in-out;
        }
        
        /* Search form animations */
        #search-form {
            transform-origin: top right;
        }
        
        /* Navigation link styles */
        .nav-link {
            @apply text-gray-700 hover:text-blue-600 font-medium transition-all duration-200 relative px-3 py-2 rounded-lg;
        }
        
        .nav-link:hover {
            @apply bg-blue-50 text-blue-600;
        }
        
        .nav-link.active {
            @apply text-blue-600 bg-blue-50;
        }
        
        .nav-link.active::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 50%;
            right: 50%;
            height: 2px;
            background: linear-gradient(90deg, #2563eb, #3b82f6);
            border-radius: 1px;
            animation: expandWidth 0.3s ease-out forwards;
        }
        
        @keyframes expandWidth {
            from {
                left: 50%;
                right: 50%;
            }
            to {
                left: 15%;
                right: 15%;
            }
        }
        
        /* Dropdown styles */
        .dropdown-link {
            @apply block px-4 py-3 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-600 transition-all duration-150 rounded-md mx-2;
        }
        
        /* Mobile navigation styles */
        .mobile-nav-link {
            @apply block px-4 py-3 text-base font-medium text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-150 rounded-lg mx-2;
        }
        
        .mobile-nav-link.active {
            @apply text-blue-600 bg-blue-50;
        }
        
        .mobile-nav-sublink {
            @apply block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-25 transition-all duration-150 rounded-md mx-2;
        }
        
        /* Social links - Enhanced with proper hover states */
        .social-link {
            @apply text-blue-200 hover:text-white transition-all duration-200 transform hover:scale-110;
        }
        
        /* Quick search buttons */
        .quick-search-btn {
            @apply inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium transition-all cursor-pointer;
        }
        
        /* Enhanced hover effects for navbar */
        .nav-link:hover::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.1), rgba(37, 99, 235, 0.05));
            border-radius: 0.5rem;
            z-index: -1;
        }
        
        /* Search input focus styles */
        #search-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
        }
        
        /* Mobile menu animation */
        #mobile-menu {
            animation: slideDown 0.3s ease-out;
        }
        
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Dropdown arrow rotation */
        .dropdown-arrow {
            transition: transform 0.2s ease-in-out;
        }
        
        .group:hover .dropdown-arrow {
            transform: rotate(180deg);
        }
        
        /* Smooth scrolling enhancement */
        html {
            scroll-behavior: smooth;
        }
        
        /* Footer link styles */
        .footer-link {
            @apply text-blue-200 hover:text-white transition-colors duration-200;
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Header Navigation -->
    <header class="bg-white shadow-lg sticky top-0 z-50 transition-all duration-300">
        <nav class="container mx-auto px-4 lg:px-8">
            <div class="flex items-center justify-between h-16 lg:h-20">
                <!-- Logo -->
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
                            {{ ($company && $company->company_name && is_string($company->company_name) && Str::contains($company->company_name, ' - ')) ? Str::after($company->company_name, ' - ') : 'Kabupaten Purbalingga' }}
                        </div>
                    </div>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden lg:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        Beranda
                    </a>

                    <!-- Tentang Kami Dropdown -->
                    <div class="relative group">
                        <button class="nav-link flex items-center {{ request()->routeIs('about*') ? 'active' : '' }}">
                            Tentang Kami
                            <svg class="ml-1 h-4 w-4 transform group-hover:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-xl py-2 opacity-0 group-hover:opacity-100 transition-all duration-200 invisible group-hover:visible border border-gray-100">
                            <a href="{{ route('about') }}" class="dropdown-link">
                                <svg class="w-4 h-4 mr-2 inline text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Profil Perusahaan
                            </a>
                            <a href="{{ route('about.history') }}" class="dropdown-link">
                                <svg class="w-4 h-4 mr-2 inline text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Sejarah
                            </a>
                            <a href="{{ route('about.vision-mission') }}" class="dropdown-link">
                                <svg class="w-4 h-4 mr-2 inline text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Visi & Misi
                            </a>
                            <a href="{{ route('about.organization') }}" class="dropdown-link">
                                <svg class="w-4 h-4 mr-2 inline text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                                Struktur Organisasi
                            </a>
                            <a href="{{ route('about.branches') }}" class="dropdown-link">
                                <svg class="w-4 h-4 mr-2 inline text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                </svg>
                                Cabang & Unit IKK
                            </a>
                        </div>
                    </div>

                    <!-- Layanan Dropdown -->
                    <div class="relative group">
                        <button class="nav-link flex items-center {{ request()->routeIs('services*') ? 'active' : '' }}">
                            Layanan
                            <svg class="ml-1 h-4 w-4 transform group-hover:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-2 w-56 bg-white rounded-lg shadow-xl py-2 opacity-0 group-hover:opacity-100 transition-all duration-200 invisible group-hover:visible border border-gray-100">
                            <a href="{{ route('services') }}" class="dropdown-link">
                                <svg class="w-4 h-4 mr-2 inline text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                                Semua Layanan
                            </a>
                            <div class="border-t border-gray-200 my-1"></div>
                            <a href="https://tagihan.pdampurbalingga.co.id/" target="_blank" rel="noopener noreferrer" class="dropdown-link">
                                <svg class="w-4 h-4 mr-2 inline text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Cek Tagihan
                            </a>
                            <a href="{{ route('services') }}" class="dropdown-link">
                                <svg class="w-4 h-4 mr-2 inline text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Sambungan Baru
                            </a>
                            <a href="https://pengaduan.pdampurbalingga.co.id/" target="_blank" rel="noopener noreferrer" class="dropdown-link">
                                <svg class="w-4 h-4 mr-2 inline text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Pengaduan Online
                            </a>
                            <a href="{{ route('tariff') }}" class="dropdown-link">
                                <svg class="w-4 h-4 mr-2 inline text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                Tarif Air
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('news') }}" class="nav-link {{ request()->routeIs('news*') ? 'active' : '' }}">
                        Berita
                    </a>
                    <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                        Kontak
                    </a>
                </div>

                <!-- Search and Mobile Menu -->
                <div class="flex items-center space-x-4">
                    <!-- Enhanced Search (Desktop & Mobile) -->
                    <div class="relative">
                        <button id="search-toggle" class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 hover:bg-blue-50 text-gray-600 hover:text-blue-600 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </button>
                        
                        <!-- Enhanced Search Form -->
                        <div id="search-form" class="absolute top-full right-0 mt-3 w-80 lg:w-96 bg-white rounded-xl shadow-2xl border border-gray-200 hidden z-50 transform opacity-0 scale-95 transition-all duration-200">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <h3 class="text-lg font-semibold text-gray-900">Pencarian</h3>
                                    <button id="search-close" class="text-gray-400 hover:text-gray-600 transition-colors">
                                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                </div>
                                
                                <form action="{{ route('search') }}" method="GET" class="space-y-4">
                                    <div class="relative">
                                        <input
                                            type="text"
                                            name="q"
                                            id="search-input"
                                            value="{{ request('q') }}"
                                            placeholder="Cari berita, layanan, informasi..."
                                            class="w-full pl-12 pr-4 py-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 focus:bg-white transition-colors"
                                            autocomplete="off"
                                        >
                                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    
                                    <!-- Quick Search Suggestions -->
                                    <div class="border-t border-gray-100 pt-4">
                                        <p class="text-xs font-medium text-gray-500 mb-3 uppercase tracking-wide">Pencarian Populer</p>
                                        <div class="flex flex-wrap gap-2">
                                            <button type="button" onclick="document.getElementById('search-input').value='tarif air'; this.closest('form').submit();" class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700 hover:bg-blue-100 transition-colors">
                                                Tarif Air
                                            </button>
                                            <button type="button" onclick="document.getElementById('search-input').value='cek tagihan'; this.closest('form').submit();" class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-green-50 text-green-700 hover:bg-green-100 transition-colors">
                                                Cek Tagihan
                                            </button>
                                            <button type="button" onclick="document.getElementById('search-input').value='sambungan baru'; this.closest('form').submit();" class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-purple-50 text-purple-700 hover:bg-purple-100 transition-colors">
                                                Sambungan Baru
                                            </button>
                                            <button type="button" onclick="document.getElementById('search-input').value='pengaduan'; this.closest('form').submit();" class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium bg-red-50 text-red-700 hover:bg-red-100 transition-colors">
                                                Pengaduan
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                        <svg class="h-4 w-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                        </svg>
                                        Cari Sekarang
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Mobile Menu Button -->
                    <div class="lg:hidden">
                        <button type="button" id="mobile-menu-button" class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 hover:text-gray-900 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="lg:hidden hidden">
                <!-- Mobile Search -->
                <div class="px-4 py-3 border-b bg-gray-50">
                    <form action="{{ route('search') }}" method="GET" class="relative">
                        <input
                            type="text"
                            name="q"
                            value="{{ request('q') }}"
                            placeholder="Cari berita, layanan, informasi..."
                            class="w-full pl-10 pr-4 py-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white"
                        >
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </form>
                </div>

                <!-- Mobile Navigation Links -->
                <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3 bg-white border-t">
                    <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <svg class="w-4 h-4 inline mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Beranda
                    </a>
                    
                    <a href="{{ route('about') }}" class="mobile-nav-link {{ request()->routeIs('about*') ? 'active' : '' }}">
                        <svg class="w-4 h-4 inline mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Profil Perusahaan
                    </a>
                    
                    <a href="{{ route('about.history') }}" class="mobile-nav-link {{ request()->routeIs('about.history') ? 'active' : '' }} ml-6">
                        <svg class="w-4 h-4 inline mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Sejarah Perusahaan
                    </a>
                    
                    <a href="{{ route('about.vision-mission') }}" class="mobile-nav-link {{ request()->routeIs('about.vision-mission') ? 'active' : '' }} ml-6">
                        <svg class="w-4 h-4 inline mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Visi & Misi
                    </a>
                    
                    <a href="{{ route('about.organization') }}" class="mobile-nav-link {{ request()->routeIs('about.organization') ? 'active' : '' }} ml-6">
                        <svg class="w-4 h-4 inline mr-2 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Struktur Organisasi
                    </a>
                    
                    <a href="{{ route('about.branches') }}" class="mobile-nav-link {{ request()->routeIs('about.branches') ? 'active' : '' }} ml-6">
                        <svg class="w-4 h-4 inline mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Cabang & Unit IKK
                    </a>

                    <a href="{{ route('services') }}" class="mobile-nav-link {{ request()->routeIs('services*') ? 'active' : '' }}">
                        <svg class="w-4 h-4 inline mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        Layanan
                    </a>
                    
                    <a href="{{ route('news') }}" class="mobile-nav-link {{ request()->routeIs('news*') ? 'active' : '' }}">
                        <svg class="w-4 h-4 inline mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                        </svg>
                        Berita
                    </a>
                    
                    <a href="{{ route('contact') }}" class="mobile-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                        <svg class="w-4 h-4 inline mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 012 2z"></path>
                        </svg>
                        Kontak
                    </a>
                    
                    <!-- Quick Services -->
                    <div class="border-t border-gray-200 mt-2 pt-2">
                        <p class="px-4 py-2 text-xs font-semibold text-gray-500 uppercase tracking-wide">Layanan Cepat</p>
                        <a href="https://tagihan.pdampurbalingga.co.id/" target="_blank" rel="noopener noreferrer" class="mobile-nav-link text-green-600">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Cek Tagihan
                        </a>
                        <a href="https://pengaduan.pdampurbalingga.co.id/" target="_blank" rel="noopener noreferrer" class="mobile-nav-link text-red-600">
                            <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Pengaduan Online
                        </a>
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-blue-900 via-blue-800 to-blue-900 text-white">
        <div class="container mx-auto px-4 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div class="lg:col-span-1">
                    <div class="flex items-center space-x-3 mb-6">
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
                            <div class="text-xl font-bold text-white">
                                {{ ($company && $company->company_name && is_string($company->company_name)) ? Str::before($company->company_name, ' - ') : 'Tirta Perwira' }}
                            </div>
                            <div class="text-sm text-blue-200">
                                {{ ($company && $company->company_name && is_string($company->company_name) && Str::contains($company->company_name, ' - ')) ? Str::after($company->company_name, ' - ') : 'PDAM Purbalingga' }}
                            </div>
                        </div>
                    </div>
                    
                    <p class="text-blue-200 text-sm leading-relaxed">
                        {{ ($company && $company->company_description && is_string($company->company_description)) ? Str::limit(strip_tags($company->company_description), 120) : 'Melayani dengan hati, memberikan yang terbaik untuk air bersih berkualitas bagi masyarakat Purbalingga.' }}
                    </p>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-6 text-white border-b border-blue-700 pb-2">Tautan Cepat</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('about') }}" class="text-blue-200 hover:text-white transition-colors duration-200 flex items-center group">
                            <svg class="w-4 h-4 mr-2 text-blue-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Tentang Kami
                        </a></li>
                        <li><a href="{{ route('services') }}" class="text-blue-200 hover:text-white transition-colors duration-200 flex items-center group">
                            <svg class="w-4 h-4 mr-2 text-blue-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Layanan
                        </a></li>
                        <li><a href="{{ route('news') }}" class="text-blue-200 hover:text-white transition-colors duration-200 flex items-center group">
                            <svg class="w-4 h-4 mr-2 text-blue-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Berita
                        </a></li>
                        <li><a href="{{ route('tariff') }}" class="text-blue-200 hover:text-white transition-colors duration-200 flex items-center group">
                            <svg class="w-4 h-4 mr-2 text-blue-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Tarif Air
                        </a></li>
                        <li><a href="{{ route('contact') }}" class="text-blue-200 hover:text-white transition-colors duration-200 flex items-center group">
                            <svg class="w-4 h-4 mr-2 text-blue-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                            Kontak
                        </a></li>
                    </ul>
                </div>

                <!-- Services -->
                <div>
                    <h3 class="text-lg font-semibold mb-6 text-white border-b border-blue-700 pb-2">Layanan Utama</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('services') }}" class="text-blue-200 hover:text-white transition-colors duration-200 flex items-center group">
                            <svg class="w-4 h-4 mr-2 text-green-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Sambungan Baru
                        </a></li>
                        <li><a href="https://pengaduan.pdampurbalingga.co.id" target="_blank" rel="noopener noreferrer" class="text-blue-200 hover:text-white transition-colors duration-200 flex items-center group">
                            <svg class="w-4 h-4 mr-2 text-red-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Pengaduan Online
                        </a></li>
                        <li><a href="https://tagihan.pdampurbalingga.co.id/" target="_blank" rel="noopener noreferrer" class="text-blue-200 hover:text-white transition-colors duration-200 flex items-center group">
                            <svg class="w-4 h-4 mr-2 text-purple-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Cek Tagihan
                        </a></li>
                        <li><a href="{{ route('services.pembayaran') }}" class="text-blue-200 hover:text-white transition-colors duration-200 flex items-center group">
                            <svg class="w-4 h-4 mr-2 text-yellow-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                            </svg>
                            Info Pembayaran
                        </a></li>
                        <li><a href="{{ route('download-center') }}" class="text-blue-200 hover:text-white transition-colors duration-200 flex items-center group">
                            <svg class="w-4 h-4 mr-2 text-indigo-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download Center
                        </a></li>
                    </ul>
                </div>

                <!-- Contact Info & Social Media -->
                <div>
                    <h3 class="text-lg font-semibold mb-6 text-white border-b border-blue-700 pb-2">Hubungi Kami</h3>
                    <div class="space-y-4 text-sm mb-6">
                        @if($company && $company->address)
                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-blue-300 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-blue-200 leading-relaxed">{{ $company->address }}</span>
                            </div>
                        @else
                            <div class="flex items-start space-x-3">
                                <svg class="w-5 h-5 text-blue-300 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span class="text-blue-200 leading-relaxed">Jl. Jenderal Ahmad Yani No. 123, Purbalingga, Jawa Tengah 53316</span>
                            </div>
                        @endif

                        @if($company && $company->phone)
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-blue-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <a href="tel:{{ $company->phone }}" class="text-blue-200 hover:text-white transition-colors">{{ $company->phone }}</a>
                            </div>
                        @else
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-blue-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <a href="tel:(0281) 891-234" class="text-blue-200 hover:text-white transition-colors">(0281) 891-234</a>
                            </div>
                        @endif

                        @if($company && $company->email)
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-blue-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 012 2z"></path>
                                </svg>
                                <a href="mailto:{{ $company->email }}" class="text-blue-200 hover:text-white transition-colors">{{ $company->email }}</a>
                            </div>
                        @else
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-blue-300 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 012 2z"></path>
                                </svg>
                                <a href="mailto:info@tirtaperwira.purbalinggakab.go.id" class="text-blue-200 hover:text-white transition-colors">info@tirtaperwira.purbalinggakab.go.id</a>
                            </div>
                        @endif
                    </div>

                    <!-- Social Media - Moved to fourth column -->
                    <div>
                        <h4 class="text-base font-semibold mb-4 text-white">Ikuti Kami</h4>
                        <div class="flex space-x-4">
                            <!-- Facebook -->
                            <a href="{{ ($company && $company->social_media && isset($company->social_media['facebook'])) ? $company->social_media['facebook'] : '#' }}" 
                               class="w-10 h-10 bg-blue-700 hover:bg-blue-600 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110 group" 
                               target="_blank" rel="noopener noreferrer">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            
                            <!-- Twitter/X -->
                            <a href="{{ ($company && $company->social_media && isset($company->social_media['twitter'])) ? $company->social_media['twitter'] : '#' }}" 
                               class="w-10 h-10 bg-sky-500 hover:bg-sky-400 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110 group" 
                               target="_blank" rel="noopener noreferrer">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            
                            <!-- Instagram -->
                            <a href="{{ ($company && $company->social_media && isset($company->social_media['instagram'])) ? $company->social_media['instagram'] : '#' }}" 
                               class="w-10 h-10 bg-gradient-to-br from-purple-600 to-pink-500 hover:from-purple-500 hover:to-pink-400 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110 group" 
                               target="_blank" rel="noopener noreferrer">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                            
                            <!-- WhatsApp -->
                            <a href="{{ ($company && $company->whatsapp_cs) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $company->whatsapp_cs) : '#' }}" 
                               class="w-10 h-10 bg-green-500 hover:bg-green-400 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110 group" 
                               target="_blank" rel="noopener noreferrer">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                            </a>
                        </div>
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

        // Enhanced Search toggle functionality
        const searchToggle = document.getElementById('search-toggle');
        const searchForm = document.getElementById('search-form');
        const searchClose = document.getElementById('search-close');
        const searchInput = document.getElementById('search-input');
        
        if (searchToggle && searchForm) {
            // Open search form
            searchToggle.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Show the form with animation
                searchForm.classList.remove('hidden');
                setTimeout(() => {
                    searchForm.classList.remove('opacity-0', 'scale-95');
                    searchForm.classList.add('opacity-100', 'scale-100');
                    searchInput.focus();
                }, 10);
            });

            // Close search form
            function closeSearchForm() {
                searchForm.classList.add('opacity-0', 'scale-95');
                searchForm.classList.remove('opacity-100', 'scale-100');
                setTimeout(() => {
                    searchForm.classList.add('hidden');
                }, 200);
            }

            // Close button functionality
            if (searchClose) {
                searchClose.addEventListener('click', function(e) {
                    e.preventDefault();
                    closeSearchForm();
                });
            }

            // Hide search form when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchToggle.contains(e.target) && !searchForm.contains(e.target)) {
                    closeSearchForm();
                }
            });

            // Close on escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape' && !searchForm.classList.contains('hidden')) {
                    closeSearchForm();
                }
            });

            // Auto-submit on Enter key
            searchInput.addEventListener('keydown', function(e) {
                if (e.key === 'Enter') {
                    this.closest('form').submit();
                }
            });
        }

        // Real-time search suggestions (optional enhancement)
        let searchTimeout;
        
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                const query = this.value.trim();
                
                clearTimeout(searchTimeout);
                
                if (query.length < 2) {
                    return;
                }

                // Optional: Add real-time search suggestions here
                // This would require additional backend API endpoint
            });
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href === '#') return;
                
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Auto-hide navbar on scroll (disabled for better UX)
        // Removed auto-hide functionality for better user experience
        
        // Add scroll shadow to navbar
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('header');
            if (window.scrollY > 10) {
                navbar.classList.add('shadow-lg');
                navbar.classList.remove('shadow-sm');
            } else {
                navbar.classList.add('shadow-sm');
                navbar.classList.remove('shadow-lg');
            }
        });
        
        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuButton = document.getElementById('mobile-menu-button');
            
            if (!mobileMenuButton.contains(e.target) && !mobileMenu.contains(e.target)) {
                if (!mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                }
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
