<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', (($company && $company->company_name && is_string($company->company_name)) ? $company->company_name : config('app.name', 'Tirta Perwira')))</title>
    <meta name="description" content="@yield('description', (($company && $company->company_description && is_string($company->company_description)) ? strip_tags($company->company_description) : 'PDAM Purbalingga - Melayani dengan Hati, Memberikan yang Terbaik untuk Air Bersih Berkualitas'))">
    <meta name="keywords" content="@yield('keywords', 'PDAM, Purbalingga, air bersih, pelayanan air, tarif air')">

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
        /* Enhanced smooth scrolling */
        html {
            scroll-behavior: smooth !important;
            scroll-padding-top: 80px; /* Account for sticky header */
        }
        
        body {
            scroll-behavior: smooth !important;
        }
        
        * {
            scroll-behavior: smooth !important;
        }
        
        /* Container styles */
        .container-custom {
            @apply container mx-auto px-4 lg:px-8;
        }

        /* Section padding */
        .section-padding {
            @apply py-16 lg:py-24;
        }

        /* Hero gradient */
        .hero-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #06b6d4 100%);
        }

        .hero-overlay {
            background: rgba(30, 58, 138, 0.8);
        }

        /* Hero viewport optimization */
        #hero {
            height: 100vh !important;
            min-height: 100vh !important; 
            max-height: 100vh !important;
        }

        .hero-carousel {
            height: 100% !important;
        }

        .hero-slide {
            height: 100% !important;
        }

        /* Home navbar transparency */
        .home-navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        /* Ensure viewport height is respected */
        html, body {
            overflow-x: hidden;
        }

        /* Force viewport height for hero */
        section#hero {
            height: 100vh !important;
            min-height: 100vh !important;
            max-height: 100vh !important;
            width: 100vw !important;
            position: relative !important;
            overflow-x: hidden !important; /* Only hide horizontal overflow */
        }

        @media (max-height: 600px) {
            #hero {
                height: 600px;
            }
        }

        @media (orientation: landscape) and (max-height: 500px) {
            #hero {
                height: 500px;
            }
        }

        /* Background image optimization for viewport */
        .hero-slide .bg-cover,
        .hero-gradient {
            background-attachment: fixed;
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
        }

        /* Mobile optimization - disable fixed background on small screens */
        @media (max-width: 768px) {
            .hero-slide .bg-cover {
                background-attachment: scroll;
            }
        }

        /* Content centering for viewport */
        .hero-slide .grid,
        .hero-content-wrapper {
            align-items: center;
            justify-content: center;
        }

        /* Mobile viewport optimization */
        @media (max-width: 640px) {
            #hero {
                height: 100vh;
                height: 100svh; /* Use small viewport height on supported browsers */
                min-height: 500px;
            }
            
            .hero-slide .container-custom {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }

        /* Tablet viewport optimization */
        @media (min-width: 641px) and (max-width: 1024px) {
            #hero {
                height: 100vh;
                height: 100dvh; /* Use dynamic viewport height */
            }
        }

        /* Desktop viewport optimization */
        @media (min-width: 1025px) {
            #hero {
                height: 100vh;
            }
        }

        /* Prevent content overflow on very small screens */
        @media (max-height: 450px) {
            .hero-slide .py-20 {
                padding-top: 1rem;
                padding-bottom: 1rem;
            }
            
            .hero-slide h1 {
                font-size: 2rem !important;
                margin-bottom: 1rem !important;
            }
            
            .hero-slide p {
                font-size: 1rem !important;
                margin-bottom: 1.5rem !important;
            }
        }

        /* Button styles */
        .btn-primary {
            @apply inline-flex items-center px-8 py-4 bg-white text-blue-600 font-semibold rounded-full hover:bg-blue-50 hover:shadow-lg transform hover:scale-105 transition-all duration-300 shadow-md;
        }

        .btn-secondary {
            @apply inline-flex items-center px-8 py-4 bg-transparent text-white font-semibold rounded-full border-2 border-white hover:bg-white hover:text-blue-600 transform hover:scale-105 transition-all duration-300;
        }

        /* Hero text positioning - enhanced with navbar clearance */
        .hero-slide .grid {
            align-items: center;
            padding-top: 150px; /* Increased clearance from navbar */
            min-height: calc(100vh - 150px);
        }

        /* Hero content spacing to avoid navbar overlap */
        .hero-slide .container-custom {
            position: relative;
            z-index: 10;
        }

        @media (max-width: 768px) {
            .hero-slide .grid {
                align-items: center;
                padding-top: 120px; /* Increased for tablet */
                min-height: calc(100vh - 120px);
            }
        }

        @media (max-width: 640px) {
            .hero-slide .grid {
                padding-top: 100px; /* Increased for mobile */
                min-height: calc(100vh - 100px);
            }
        }

        /* Fallback hero positioning */
        .fallback-hero .flex {
            padding-top: 150px; /* Increased clearance */
            min-height: calc(100vh - 150px);
        }

        @media (max-width: 768px) {
            .fallback-hero .flex {
                padding-top: 120px;
                min-height: calc(100vh - 120px);
            }
        }

        /* Animation delays */
        .animation-delay-200 { animation-delay: 200ms; }
        .animation-delay-400 { animation-delay: 400ms; }
        .animation-delay-600 { animation-delay: 600ms; }

        /* Fade in animation */
        .animate-fadeInUp {
            animation: fadeInUp 1s ease-out forwards;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animation classes */
        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .animation-delay-200 {
            animation-delay: 0.2s;
        }

        .animation-delay-400 {
            animation-delay: 0.4s;
        }

        .animation-delay-600 {
            animation-delay: 0.6s;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Hero carousel styles */
        .hero-slide {
            opacity: 0;
            visibility: hidden;
        }

        .hero-slide.active {
            opacity: 1;
            visibility: visible;
        }

        .hero-nav {
            transition: all 0.3s ease;
        }

        .hero-nav:hover {
            transform: scale(1.1);
        }

        .hero-dot.active {
            transform: scale(1.2);
        }

        /* Card styles */
        .card {
            @apply bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden;
        }

        .card:hover {
            transform: translateY(-4px);
        }

        /* Stats animation */
        .stat-number {
            @apply text-3xl lg:text-4xl font-bold text-blue-600 mb-2;
        }

        /* Service card hover effect */
        .service-card {
            @apply bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100 group;
        }

        .service-card:hover {
            @apply border-blue-200 transform -translate-y-1;
        }

        /* News card styles */
        .news-card {
            @apply bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 group;
        }

        .news-card:hover {
            @apply transform -translate-y-1;
        }

        /* Form styles */
        .form-input {
            @apply w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200;
        }

        .form-textarea {
            @apply w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none;
        }

        .form-select {
            @apply w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200;
        }

        /* Footer link styles */
        .footer-link {
            @apply text-blue-200 hover:text-white transition-colors duration-200;
        }

        /* Social links */
        .social-link {
            @apply text-blue-200 hover:text-white transition-all duration-200 transform hover:scale-110;
        }

        /* Loading animation for stats */
        .loading-number {
            animation: countUp 2s ease-out forwards;
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Enhanced image hover effects */
        .image-hover {
            transition: all 0.3s ease;
        }

        .image-hover:hover {
            transform: scale(1.05);
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #2563eb, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Enhanced shadows */
        .shadow-blue {
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.1);
        }

        .shadow-blue:hover {
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.15);
        }

        /* Partnership Slider Styles */
        .partnership-slider-container {
            height: 120px;
        }

        .partnership-track {
            will-change: transform;
        }

        .partnership-item {
            min-width: 128px;
        }

        .partnership-fade-left,
        .partnership-fade-right {
            pointer-events: none;
        }

        .partnership-fade-left {
            background: linear-gradient(to right, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);
        }

        .partnership-fade-right {
            background: linear-gradient(to left, rgba(255, 255, 255, 1) 0%, rgba(255, 255, 255, 0) 100%);
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Home Navigation -->
        <!-- Navigation -->
    <x-navbar variant="home" :company="$company" />

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
                             class="h-12 w-12 object-contain"
                             width="48" height="48" loading="lazy">
                        @elseif($company && $company->getFirstMediaUrl('logo'))
                        <img src="{{ $company->getFirstMediaUrl('logo') }}"
                             alt="Logo {{ $company->company_name ?? 'Tirta Perwira' }}"
                             class="h-12 w-12 object-contain filter brightness-0 invert"
                             width="48" height="48" loading="lazy">
                        @elseif($company && $company->logo)
                        <img src="{{ asset('storage/' . $company->logo) }}"
                             alt="Logo {{ $company->company_name ?? 'Tirta Perwira' }}"
                             class="h-12 w-12 object-contain filter brightness-0 invert"
                             width="48" height="48" loading="lazy">
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
                                {{ ($company && $company->company_name && is_string($company->company_name) && Str::contains($company->company_name, ' - ')) ? Str::after($company->company_name, ' - ') : 'Kabupaten Purbalingga' }}
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
                        <!-- <li><a href="{{ route('download-center') }}" class="text-blue-200 hover:text-white transition-colors duration-200 flex items-center group">
                            <svg class="w-4 h-4 mr-2 text-indigo-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download Center
                        </a></li> -->
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
                               target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            
                            <!-- Twitter/X -->
                            <a href="{{ ($company && $company->social_media && isset($company->social_media['twitter'])) ? $company->social_media['twitter'] : '#' }}" 
                               class="w-10 h-10 bg-sky-500 hover:bg-sky-400 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110 group" 
                               target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            
                            <!-- Instagram -->
                            <a href="{{ ($company && $company->social_media && isset($company->social_media['instagram'])) ? $company->social_media['instagram'] : '#' }}" 
                               class="w-10 h-10 bg-gradient-to-br from-purple-600 to-pink-500 hover:from-purple-500 hover:to-pink-400 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110 group" 
                               target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                            </a>
                            
                            <!-- WhatsApp -->
                            <a href="{{ ($company && $company->whatsapp_cs) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $company->whatsapp_cs) : '#' }}" 
                               class="w-10 h-10 bg-green-500 hover:bg-green-400 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110 group" 
                               target="_blank" rel="noopener noreferrer" aria-label="WhatsApp">
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

    @stack('scripts')

    <!-- Enhanced JavaScript for better UX -->
    <script>
        // Enhanced smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const headerOffset = 80;
                    const elementPosition = target.offsetTop;
                    const offsetPosition = elementPosition - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add loading animation to numbers
        function animateNumbers() {
            const numbers = document.querySelectorAll('.stat-number');
            numbers.forEach(number => {
                const target = parseInt(number.innerText);
                let current = 0;
                const increment = target / 100;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    number.innerText = Math.floor(current).toLocaleString('id-ID');
                }, 20);
            });
        }

        // Intersection Observer for animations
        const layoutObserverOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const layoutObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fadeInUp');
                    
                    // Animate numbers if they exist
                    const numbers = entry.target.querySelectorAll('.stat-number');
                    if (numbers.length > 0) {
                        animateNumbers();
                    }
                }
            });
        }, layoutObserverOptions);

        // Observe elements for animation
        document.querySelectorAll('.card, .service-card, .news-card').forEach(el => {
            layoutObserver.observe(el);
        });
    </script>

    <!-- Floating Action Button -->
    @include('components.floating-action-button-popup')
</body>
</html>
