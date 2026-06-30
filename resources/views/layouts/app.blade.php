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

    @yield('meta')

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
        /* Search form animations */
        #search-form {
            transform-origin: top right;
        }
        
        /* Social links - Enhanced with proper hover states */
        .social-link {
            @apply text-blue-200 hover:text-white transition-all duration-200 transform hover:scale-110;
        }
        
        /* Quick search buttons */
        .quick-search-btn {
            @apply inline-flex items-center px-3 py-1.5 rounded-full text-xs font-medium transition-all cursor-pointer;
        }
        
        /* Search input focus styles */
        #search-input:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
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

    <!-- reCAPTCHA -->
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    @stack('styles')
    @stack('head')

    <!-- Structured Data (JSON-LD) for LocalBusiness/Organization -->
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "Organization",
      "name": "{{ $company->company_name ?? config('app.name', 'Tirta Perwira') }}",
      "url": "{{ url('/') }}",
      "logo": "{{ $company && $company->logo ? asset('storage/' . $company->logo) : asset('images/og-default.jpg') }}",
      "contactPoint": {
        "@@type": "ContactPoint",
        "telephone": "{{ $company->phone ?? '' }}",
        "contactType": "customer service",
        "email": "{{ $company->email ?? '' }}",
        "areaServed": "ID",
        "availableLanguage": "Indonesian"
      }
    }
    </script>
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "LocalBusiness",
      "name": "{{ $company->company_name ?? config('app.name', 'Tirta Perwira') }}",
      "image": "{{ $company && $company->logo ? asset('storage/' . $company->logo) : asset('images/og-default.jpg') }}",
      "@@id": "{{ url('/') }}",
      "url": "{{ url('/') }}",
      "telephone": "{{ $company->phone ?? '' }}",
      "address": {
        "@@type": "PostalAddress",
        "streetAddress": "{{ $company->address ?? '' }}",
        "addressLocality": "Purbalingga",
        "addressRegion": "Jawa Tengah",
        "addressCountry": "ID"
      },
      "geo": {
        "@@type": "GeoCoordinates",
        "latitude": -7.3879482,
        "longitude": 109.3516599
      },
      "openingHoursSpecification": {
        "@@type": "OpeningHoursSpecification",
        "dayOfWeek": [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday"
        ],
        "opens": "07:30",
        "closes": "15:30"
      }
    }
    </script>
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Navigation -->
    <x-navbar variant="internal" :company="$company" />

    <!-- Main Content -->
    <main class="pt-16 lg:pt-20">
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

    <!-- Scripts -->
    <script>
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

        // NOTE: Mobile menu functionality is handled by navbar component
        // NOTE: Smooth scrolling for home page sections is handled by navbar component
        // NOTE: Navbar scroll shadow is handled by navbar component for internal pages
    </script>

    <!-- Floating Action Button Global -->
    @include('components.floating-action-button-popup')
    @stack('scripts')
    <x-cookie-consent />
</body>
</html>
