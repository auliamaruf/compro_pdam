{{-- Unified Navbar Component - Menggabungkan Home dan Internal Pages --}}
@props([
    'company' => null,
    'variant' => 'internal' // 'home' or 'internal'
])

@php
    $isHomePage = $variant === 'home';
    $navbarClass = $isHomePage ? 'home-navbar' : 'internal-navbar';
    $headerClass = 'fixed';
@endphp

<header id="main-navbar" class="bg-white dark:bg-gray-900 shadow-lg {{ $headerClass }} top-0 z-50 transition-all duration-300 {{ $navbarClass }} w-full {{ $isHomePage ? 'bg-opacity-90 dark:bg-opacity-90 backdrop-blur-sm' : '' }}">
    <div class="container-custom">
        <div class="flex items-center justify-between h-16 lg:h-20">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center space-x-3 flex-shrink-0" group>
                @if($company && $company->getFirstMediaUrl('logo'))
                <img src="{{ $company->getFirstMediaUrl('logo') }}"
                     alt="Logo {{ $company->company_name ?? 'Tirta Perwira' }}"
                     class="h-10 w-10 lg:h-12 lg:w-12 object-contain"
                     fetchpriority="high"
                     width="48" height="48">
                @elseif($company && $company->logo)
                <img src="{{ asset('storage/' . $company->logo) }}"
                     alt="Logo {{ $company->company_name ?? 'Tirta Perwira' }}"
                     class="h-10 w-10 lg:h-12 lg:w-12 object-contain"
                     fetchpriority="high"
                     width="48" height="48">
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
            </a>

            <!-- Desktop Navigation -->
            <div class="hidden lg:flex items-center space-x-6 flex-1 justify-end">
                @if($isHomePage)
                    <!-- Home Page Navigation - dengan smooth scroll -->
                    <a href="#hero" class="nav-link active home-section-link" data-section="hero">
                        Beranda
                    </a>
                    <a href="#about-preview" class="nav-link home-section-link" data-section="about-preview">
                        Tentang Kami
                    </a>
                    <a href="#services-preview" class="nav-link home-section-link" data-section="services-preview">
                        Layanan
                    </a>
                    <a href="#news-preview" class="nav-link home-section-link" data-section="news-preview">
                        Berita
                    </a>
                    <a href="{{ route('contact') }}" class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                        Kontak
                    </a>
                @else
                    <!-- Internal Pages Navigation - dengan route based -->
                    <a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        Beranda
                    </a>

                    <!-- Tentang Kami Dropdown -->
                    <div class="relative group">
                        <button class="nav-link flex items-center {{ request()->routeIs('about*') || request()->routeIs('water-sources*') ? 'active' : '' }}">
                            Tentang Kami
                            <svg class="ml-1 h-4 w-4 transform group-hover:rotate-180 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute left-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-xl py-2 opacity-0 group-hover:opacity-100 transition-all duration-200 invisible group-hover:visible border border-gray-100 dark:border-gray-700 dark:bg-gray-900">
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
                            <a href="{{ route('water-sources.index') }}" class="dropdown-link">
                                <svg class="w-4 h-4 mr-2 inline text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                                </svg>
                                Sumber Mata Air
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
                        <div class="absolute left-0 mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-xl py-2 opacity-0 group-hover:opacity-100 transition-all duration-200 invisible group-hover:visible border border-gray-100 dark:border-gray-700 dark:bg-gray-900">
                            <a href="{{ route('services') }}" class="dropdown-link">
                                <svg class="w-4 h-4 mr-2 inline text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                                </svg>
                                Semua Layanan
                            </a>
                            <div class="border-t border-gray-200 my-1 dark:border-gray-700"></div>
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
                @endif
                
                <!-- Dark Mode Toggle Desktop -->
                <button type="button" onclick="toggleDarkMode()" aria-label="Toggle Dark Mode" class="flex items-center justify-center p-2.5 rounded-lg bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400 transition-all duration-200 ml-2 focus:outline-none">
                    <svg class="w-5 h-5 dark:hidden" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg class="w-5 h-5 hidden dark:block" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                </button>
            </div>

            <!-- Mobile Menu and Theme Mode -->
            <div class="lg:hidden flex items-center flex-shrink-0">
                <!-- Dark Mode Toggle Mobile -->
                <button type="button" onclick="toggleDarkMode()" aria-label="Toggle Dark Mode" class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300 transition-all duration-200 mr-2 dark:text-gray-400">
                    <svg class="w-5 h-5 dark:hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg class="w-5 h-5 hidden dark:block" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                </button>
                <!-- Mobile Menu Button -->
                <button 
                    type="button" 
                    id="mobile-menu-button" 
                    class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 hover:text-gray-900 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:bg-gray-700 dark:text-gray-400"
                    aria-expanded="false"
                    aria-controls="mobile-menu"
                    aria-label="Toggle mobile menu"
                >
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div class="lg:hidden hidden" id="mobile-menu" role="navigation" aria-label="Mobile navigation">
        @if(!$isHomePage)
            <!-- Mobile Search - Only for internal pages -->
            <div class="px-4 py-3 border-b dark:border-gray-700 bg-gray-50 dark:bg-gray-900 dark:bg-gray-800">
                <form action="{{ route('search') }}" method="GET" class="relative">
                    <input
                        type="text"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Cari berita, layanan, informasi..."
                        class="w-full pl-10 pr-4 py-3 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:border-gray-600 dark:bg-gray-900"
                    >
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </form>
            </div>
        @endif

        <div class="bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700 dark:bg-gray-900">
            @if($isHomePage)
                <!-- Home Page Mobile Navigation - with smooth scroll -->
                <div class="space-y-1 p-2">
                    <a href="#hero" class="mobile-nav-link home-section-link active" data-section="hero">
                        <i class="fas fa-home w-5 text-blue-600 mr-3"></i>
                        Beranda
                    </a>
                    <a href="#about-preview" class="mobile-nav-link home-section-link" data-section="about-preview">
                        <i class="fas fa-building w-5 text-green-600 mr-3"></i>
                        Tentang Kami
                    </a>
                    <a href="#services-preview" class="mobile-nav-link home-section-link" data-section="services-preview">
                        <i class="fas fa-cogs w-5 text-purple-600 mr-3"></i>
                        Layanan
                    </a>
                    <a href="#news-preview" class="mobile-nav-link home-section-link" data-section="news-preview">
                        <i class="fas fa-newspaper w-5 text-orange-600 mr-3"></i>
                        Berita
                    </a>
                    <a href="{{ route('contact') }}" class="mobile-nav-link">
                        <i class="fas fa-envelope w-5 text-red-600 mr-3"></i>
                        Kontak
                    </a>
                </div>

                <!-- Divider -->
                <div class="border-t border-gray-200 dark:border-gray-700"></div>

                <!-- Quick Links untuk Home Page -->
                <div class="p-2">
                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-3 px-3 dark:text-gray-400">Menu Lengkap</div>
                    
                    <!-- Tentang Kami Group -->
                    <div class="mobile-dropdown mb-2">
                        <button class="mobile-dropdown-trigger w-full flex items-center justify-between px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg dark:text-gray-300" data-target="about-menu">
                            <div class="flex items-center">
                                <i class="fas fa-building w-5 text-blue-600 mr-3"></i>
                                <span class="font-medium">Tentang Kami</span>
                            </div>
                            <i class="fas fa-chevron-down w-4 transition-transform duration-200"></i>
                        </button>
                        <div class="mobile-dropdown-content hidden bg-gray-50 dark:bg-gray-900 rounded-lg mt-1 ml-6 overflow-hidden dark:bg-gray-800" id="about-menu">
                            <a href="{{ route('about') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 dark:text-gray-300">
                                <i class="fas fa-info-circle w-4 text-blue-500 mr-2"></i>
                                Profil Perusahaan
                            </a>
                            <a href="{{ route('about.history') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 dark:text-gray-300">
                                <i class="fas fa-history w-4 text-green-500 mr-2"></i>
                                Sejarah
                            </a>
                            <a href="{{ route('about.vision-mission') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 dark:text-gray-300">
                                <i class="fas fa-eye w-4 text-purple-500 mr-2"></i>
                                Visi & Misi
                            </a>
                            <a href="{{ route('about.organization') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 dark:text-gray-300">
                                <i class="fas fa-sitemap w-4 text-orange-500 mr-2"></i>
                                Struktur Organisasi
                            </a>
                            <a href="{{ route('about.branches') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 dark:text-gray-300">
                                <i class="fas fa-map-marker-alt w-4 text-red-500 mr-2"></i>
                                Cabang & Unit IKK
                            </a>
                            <a href="{{ route('water-sources.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 dark:text-gray-300">
                                <i class="fas fa-tint w-4 text-cyan-500 mr-2"></i>
                                Sumber Mata Air
                            </a>
                        </div>
                    </div>

                    <!-- Layanan Group -->
                    <div class="mobile-dropdown mb-2">
                        <button class="mobile-dropdown-trigger w-full flex items-center justify-between px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg dark:text-gray-300" data-target="services-menu">
                            <div class="flex items-center">
                                <i class="fas fa-cogs w-5 text-purple-600 mr-3"></i>
                                <span class="font-medium">Layanan</span>
                            </div>
                            <i class="fas fa-chevron-down w-4 transition-transform duration-200"></i>
                        </button>
                        <div class="mobile-dropdown-content hidden bg-gray-50 dark:bg-gray-900 rounded-lg mt-1 ml-6 overflow-hidden dark:bg-gray-800" id="services-menu">
                            <a href="{{ route('services') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 dark:text-gray-300">
                                <i class="fas fa-list w-4 text-blue-500 mr-2"></i>
                                Semua Layanan
                            </a>
                            <a href="https://tagihan.pdampurbalingga.co.id/" target="_blank" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 dark:text-gray-300">
                                <i class="fas fa-credit-card w-4 text-green-500 mr-2"></i>
                                Cek Tagihan
                            </a>
                            <a href="{{ route('services') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 dark:text-gray-300">
                                <i class="fas fa-plus-circle w-4 text-purple-500 mr-2"></i>
                                Sambungan Baru
                            </a>
                            <a href="https://pengaduan.pdampurbalingga.co.id/" target="_blank" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 dark:text-gray-300">
                                <i class="fas fa-exclamation-triangle w-4 text-red-500 mr-2"></i>
                                Pengaduan Online
                            </a>
                            <a href="{{ route('tariff') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 dark:text-gray-300">
                                <i class="fas fa-dollar-sign w-4 text-indigo-500 mr-2"></i>
                                Tarif Air
                            </a>
                        </div>
                    </div>

                    <!-- Informasi Group -->
                    <div class="mobile-dropdown mb-2">
                        <button class="mobile-dropdown-trigger w-full flex items-center justify-between px-3 py-2 text-gray-700 hover:bg-gray-100 rounded-lg dark:text-gray-300" data-target="info-menu">
                            <div class="flex items-center">
                                <i class="fas fa-newspaper w-5 text-orange-600 mr-3"></i>
                                <span class="font-medium">Informasi</span>
                            </div>
                            <i class="fas fa-chevron-down w-4 transition-transform duration-200"></i>
                        </button>
                        <div class="mobile-dropdown-content hidden bg-gray-50 dark:bg-gray-900 rounded-lg mt-1 ml-6 overflow-hidden dark:bg-gray-800" id="info-menu">
                            <a href="{{ route('news') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 dark:text-gray-300">
                                <i class="fas fa-newspaper w-4 text-purple-500 mr-2"></i>
                                Semua Berita
                            </a>
                            <a href="{{ route('contact') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 dark:text-gray-300">
                                <i class="fas fa-envelope w-4 text-blue-500 mr-2"></i>
                                Kontak Kami
                            </a>
                        </div>
                    </div>
                </div>
            @else
                <!-- Internal Pages Mobile Navigation - Simplified with dropdowns -->
                <div class="space-y-1 p-2">
                    <a href="{{ route('home') }}" class="mobile-nav-link {{ request()->routeIs('home') ? 'active' : '' }}">
                        <i class="fas fa-home w-5 text-blue-600 mr-3"></i>
                        Beranda
                    </a>

                    <!-- Tentang Kami Dropdown -->
                    <div class="mobile-dropdown">
                        <button class="mobile-dropdown-trigger w-full flex items-center justify-between px-3 py-3 text-gray-700 hover:bg-gray-100 rounded-lg {{ request()->routeIs('about*') || request()->routeIs('water-sources*') ? 'bg-blue-50 text-blue-700' : '' }} dark:text-gray-300" data-target="about-internal-menu">
                            <div class="flex items-center">
                                <i class="fas fa-building w-5 text-green-600 mr-3"></i>
                                <span class="font-medium">Tentang Kami</span>
                            </div>
                            <i class="fas fa-chevron-down w-4 transition-transform duration-200"></i>
                        </button>
                        <div class="mobile-dropdown-content hidden bg-gray-50 dark:bg-gray-900 rounded-lg mt-1 ml-6 overflow-hidden dark:bg-gray-800" id="about-internal-menu">
                            <a href="{{ route('about') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('about') ? 'bg-blue-100 text-blue-800 font-medium' : '' }} dark:text-gray-300">
                                <i class="fas fa-info-circle w-4 text-blue-500 mr-2"></i>
                                Profil Perusahaan
                            </a>
                            <a href="{{ route('about.history') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('about.history') ? 'bg-blue-100 text-blue-800 font-medium' : '' }} dark:text-gray-300">
                                <i class="fas fa-history w-4 text-green-500 mr-2"></i>
                                Sejarah
                            </a>
                            <a href="{{ route('about.vision-mission') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('about.vision-mission') ? 'bg-blue-100 text-blue-800 font-medium' : '' }} dark:text-gray-300">
                                <i class="fas fa-eye w-4 text-purple-500 mr-2"></i>
                                Visi & Misi
                            </a>
                            <a href="{{ route('about.organization') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('about.organization') ? 'bg-blue-100 text-blue-800 font-medium' : '' }} dark:text-gray-300">
                                <i class="fas fa-sitemap w-4 text-orange-500 mr-2"></i>
                                Struktur Organisasi
                            </a>
                            <a href="{{ route('about.branches') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('about.branches') ? 'bg-blue-100 text-blue-800 font-medium' : '' }} dark:text-gray-300">
                                <i class="fas fa-map-marker-alt w-4 text-red-500 mr-2"></i>
                                Cabang & Unit IKK
                            </a>
                            <a href="{{ route('water-sources.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('water-sources*') ? 'bg-blue-100 text-blue-800 font-medium' : '' }} dark:text-gray-300">
                                <i class="fas fa-tint w-4 text-cyan-500 mr-2"></i>
                                Sumber Mata Air
                            </a>
                        </div>
                    </div>

                    <!-- Layanan Dropdown -->
                    <div class="mobile-dropdown">
                        <button class="mobile-dropdown-trigger w-full flex items-center justify-between px-3 py-3 text-gray-700 hover:bg-gray-100 rounded-lg {{ request()->routeIs('services*') || request()->routeIs('tariff') ? 'bg-blue-50 text-blue-700' : '' }} dark:text-gray-300" data-target="services-internal-menu">
                            <div class="flex items-center">
                                <i class="fas fa-cogs w-5 text-purple-600 mr-3"></i>
                                <span class="font-medium">Layanan</span>
                            </div>
                            <i class="fas fa-chevron-down w-4 transition-transform duration-200"></i>
                        </button>
                        <div class="mobile-dropdown-content hidden bg-gray-50 dark:bg-gray-900 rounded-lg mt-1 ml-6 overflow-hidden dark:bg-gray-800" id="services-internal-menu">
                            <a href="{{ route('services') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('services') ? 'bg-blue-100 text-blue-800 font-medium' : '' }} dark:text-gray-300">
                                <i class="fas fa-list w-4 text-blue-500 mr-2"></i>
                                Semua Layanan
                            </a>
                            <a href="https://tagihan.pdampurbalingga.co.id/" target="_blank" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 dark:text-gray-300">
                                <i class="fas fa-credit-card w-4 text-green-500 mr-2"></i>
                                Cek Tagihan
                            </a>
                            <a href="{{ route('services') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 dark:text-gray-300">
                                <i class="fas fa-plus-circle w-4 text-purple-500 mr-2"></i>
                                Sambungan Baru
                            </a>
                            <a href="https://pengaduan.pdampurbalingga.co.id/" target="_blank" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 dark:text-gray-300">
                                <i class="fas fa-exclamation-triangle w-4 text-red-500 mr-2"></i>
                                Pengaduan Online
                            </a>
                            <a href="{{ route('tariff') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-blue-50 hover:text-blue-700 {{ request()->routeIs('tariff') ? 'bg-blue-100 text-blue-800 font-medium' : '' }} dark:text-gray-300">
                                <i class="fas fa-dollar-sign w-4 text-indigo-500 mr-2"></i>
                                Tarif Air
                            </a>
                        </div>
                    </div>

                    <!-- Berita & Informasi -->
                    <a href="{{ route('news') }}" class="mobile-nav-link {{ request()->routeIs('news*') ? 'active' : '' }}">
                        <i class="fas fa-newspaper w-5 text-orange-600 mr-3"></i>
                        Berita & Info
                    </a>

                    <!-- Kontak -->
                    <a href="{{ route('contact') }}" class="mobile-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                        <i class="fas fa-envelope w-5 text-red-600 mr-3"></i>
                        Kontak Kami
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Section Indicator Dots (hanya untuk home page) -->
    @if($isHomePage)
    <div class="hidden lg:block fixed right-6 top-1/2 transform -translate-y-1/2 z-40 space-y-3" id="section-indicators">
        <div class="section-dot active" data-section="hero" title="Beranda">
            <div class="section-dot-inner"></div>
        </div>
        <div class="section-dot" data-section="about-preview" title="Tentang Kami">
            <div class="section-dot-inner"></div>
        </div>
        <div class="section-dot" data-section="services-preview" title="Layanan">
            <div class="section-dot-inner"></div>
        </div>
        <div class="section-dot" data-section="news-preview" title="Berita">
            <div class="section-dot-inner"></div>
        </div>
    </div>
    @endif
</header>

<!-- Unified Styling -->
@push('styles')
<style>
/* Base navbar styles */
header {
    transition: all 0.3s ease-in-out;
}

/* Container styles */
.container-custom {
    @apply container mx-auto px-4 lg:px-8;
}

/* Navigation link styles */
.nav-link {
    @apply text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 font-medium transition-all duration-200 relative px-3 py-2 rounded-lg;
}

.nav-link:hover {
    @apply bg-blue-50 dark:bg-gray-800 text-blue-600 dark:text-blue-400;
}

.nav-link.active {
    @apply text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-gray-800;
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
    @apply block px-4 py-3 text-sm text-gray-700 dark:text-gray-300 hover:bg-blue-50 dark:hover:bg-gray-700 hover:text-blue-600 dark:hover:text-blue-400 transition-all duration-150 rounded-md mx-2;
}

/* Mobile navigation styles */
.mobile-nav-link {
    @apply block px-4 py-3 text-base font-medium text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-gray-800 transition-all duration-150 rounded-lg mx-2;
}

.mobile-nav-link.active {
    @apply text-blue-600 dark:text-blue-400 bg-blue-50 dark:bg-gray-800;
}

.mobile-nav-sublink {
    @apply block px-4 py-2 text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 hover:bg-blue-50 dark:hover:bg-gray-800 transition-all duration-150 rounded-lg mx-2 my-1;
}

/* Section Indicator Dots (untuk home page) */
.section-dot {
    @apply w-3 h-3 rounded-full border-2 border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 cursor-pointer transition-all duration-200 hover:border-b dark:border-gray-700lue-400 dark:hover:border-b dark:border-gray-700lue-500 relative group;
}

.section-dot.active {
    @apply border-b dark:border-gray-700lue-600 dark:border-b dark:border-gray-700lue-500 bg-blue-600 dark:bg-blue-500;
}

.section-dot-inner {
    @apply w-1 h-1 rounded-full bg-gray-300 dark:bg-gray-600 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 transition-all duration-200;
}

.section-dot.active .section-dot-inner {
    @apply bg-white dark:bg-gray-900;
}

.section-dot:hover .section-dot-inner {
    @apply bg-blue-400 dark:bg-blue-400;
}

/* Tooltip untuk section dots */
.section-dot::before {
    content: attr(title);
    position: absolute;
    right: 20px;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    white-space: nowrap;
    opacity: 0;
    pointer-events: none;
    transition: opacity 0.3s ease;
    z-index: 1000;
}

.section-dot:hover::before {
    opacity: 1;
}

/* Enhanced hover effects */
.home-navbar .nav-link:hover {
    transform: translateY(-1px);
}

.internal-navbar .nav-link:hover {
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.15);
}
</style>
@endpush

<script>
// Navbar Mobile Menu Handler - Unified for all pages
(function() {
    'use strict';
    
    let mobileMenuButton, mobileMenu;
    const isHomePage = {{ $isHomePage ? 'true' : 'false' }};
    
    // Global navbar functionality
    function initializeNavbar() {
        mobileMenuButton = document.getElementById('mobile-menu-button');
        mobileMenu = document.getElementById('mobile-menu');

        // Ensure elements exist before adding listeners
        if (!mobileMenuButton || !mobileMenu) {
            setTimeout(initializeNavbar, 200);
            return;
        }

        // Mobile menu toggle with enhanced reliability
        mobileMenuButton.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            
            const isHidden = mobileMenu.classList.contains('hidden');
            
            if (isHidden) {
                mobileMenu.classList.remove('hidden');
                mobileMenuButton.setAttribute('aria-expanded', 'true');
            } else {
                mobileMenu.classList.add('hidden');
                mobileMenuButton.setAttribute('aria-expanded', 'false');
            }
        });

        // Mobile dropdown functionality
        const mobileDropdownTriggers = document.querySelectorAll('.mobile-dropdown-trigger');
        
        mobileDropdownTriggers.forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const targetId = this.getAttribute('data-target');
                const dropdownContent = document.getElementById(targetId);
                const chevron = this.querySelector('.fa-chevron-down');
                
                if (dropdownContent && chevron) {
                    // Toggle current dropdown
                    const isHidden = dropdownContent.classList.contains('hidden');
                    
                    if (isHidden) {
                        // Show dropdown
                        dropdownContent.classList.remove('hidden');
                        chevron.style.transform = 'rotate(180deg)';
                    } else {
                        // Hide dropdown
                        dropdownContent.classList.add('hidden');
                        chevron.style.transform = 'rotate(0deg)';
                    }
                    
                    // Close other dropdowns
                    mobileDropdownTriggers.forEach(otherTrigger => {
                        if (otherTrigger !== this) {
                            const otherTargetId = otherTrigger.getAttribute('data-target');
                            const otherDropdownContent = document.getElementById(otherTargetId);
                            const otherChevron = otherTrigger.querySelector('.fa-chevron-down');
                            
                            if (otherDropdownContent && otherChevron) {
                                otherDropdownContent.classList.add('hidden');
                                otherChevron.style.transform = 'rotate(0deg)';
                            }
                        }
                    });
                }
            });
        });

        // Close mobile menu when clicking on links
        const mobileNavLinks = document.querySelectorAll('#mobile-menu a');
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Only close if it's not a dropdown trigger
                if (!this.classList.contains('mobile-dropdown-trigger')) {
                    if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                        mobileMenu.classList.add('hidden');
                        mobileMenuButton.setAttribute('aria-expanded', 'false');
                    }
                }
            });
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(e) {
            if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                    mobileMenu.classList.add('hidden');
                    mobileMenuButton.setAttribute('aria-expanded', 'false');
                }
            }
        });

        // Handle escape key for closing menus
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                // Close mobile menu
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    mobileMenuButton.setAttribute('aria-expanded', 'false');
                }
            }
        });

        // Hide navbar on scroll down, show on scroll up
        let lastScrollTop = 0;
        const navbarElement = document.getElementById('main-navbar');
        const scrollThreshold = 10;
        
        window.addEventListener('scroll', function() {
            if (!navbarElement) return;
            
            // Don't hide if mobile menu is open
            if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                return;
            }
            
            let scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
            
            // Ignore small scrolls to prevent jitter
            if (Math.abs(lastScrollTop - scrollTop) <= scrollThreshold) {
                return;
            }
            
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                // Scrolling down
                navbarElement.style.top = '-150px';
            } else {
                // Scrolling up
                navbarElement.style.top = '0px';
            }
            lastScrollTop = Math.max(0, scrollTop);
        }, { passive: true });

        // Initialize home page functionality after navbar is ready
        if (isHomePage) {
            initializeHomePage();
        } else {
            initializeInternalPages();
        }
    }

    // Home page specific functionality
    function initializeHomePage() {
        const sectionLinks = document.querySelectorAll('.home-section-link');
        const sectionDots = document.querySelectorAll('.section-dot');

        // Smooth scroll functionality with a single reliable calculation
        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            
            if (!section) {
                return;
            }
            
            const navbar = document.getElementById('main-navbar');
            const navbarHeight = navbar ? navbar.getBoundingClientRect().height : 80;
            const adjustment = 20; // Extra padding
            
            // Get section position relative to viewport, then add current scroll position
            const sectionTop = section.getBoundingClientRect().top + window.pageYOffset;
            const scrollPosition = sectionTop - navbarHeight - adjustment;
            
            window.scrollTo({
                top: Math.max(0, scrollPosition),
                behavior: 'smooth'
            });
        }

        // Handle section link clicks
        sectionLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                const sectionId = this.getAttribute('data-section');
                
                // Close mobile menu if open
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
                    mobileMenuButton.setAttribute('aria-expanded', 'false');
                }
                
                // Scroll to section
                if (sectionId === 'hero') {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                } else {
                    scrollToSection(sectionId);
                }
            });
        });

        // Handle section dot clicks
        sectionDots.forEach(function(dot) {
            dot.addEventListener('click', function() {
                const sectionId = this.getAttribute('data-section');
                
                if (sectionId === 'hero') {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                } else {
                    scrollToSection(sectionId);
                }
            });
        });

        // Update active states based on scroll position
        function updateActiveStates() {
            const navbar = document.querySelector('header');
            const navbarHeight = navbar ? navbar.getBoundingClientRect().height : 80;
            const scrollPos = window.scrollY + navbarHeight + 50; // Adjust for absolute navbar
            const sections = ['hero', 'about-preview', 'services-preview', 'news-preview']; // Removed contact-preview as it doesn't exist
            
            let activeSection = 'hero';
            
            // Check if we're at the top (accounting for hero viewport)
            if (window.scrollY < window.innerHeight / 2) {
                activeSection = 'hero';
            } else {
                // Find current section
                sections.forEach(sectionId => {
                    const section = document.getElementById(sectionId);
                    if (section && scrollPos >= section.offsetTop) {
                        activeSection = sectionId;
                    }
                });
            }

            // Update section links
            sectionLinks.forEach(link => {
                const linkSection = link.getAttribute('data-section');
                if (linkSection === activeSection) {
                    link.classList.add('active');
                } else {
                    link.classList.remove('active');
                }
            });

            // Update section dots
            sectionDots.forEach(dot => {
                const dotSection = dot.getAttribute('data-section');
                if (dotSection === activeSection) {
                    dot.classList.add('active');
                } else {
                    dot.classList.remove('active');
                }
            });
        }

        // Scroll event listener dengan throttling untuk performance
        let ticking = false;
        window.addEventListener('scroll', function() {
            if (!ticking) {
                requestAnimationFrame(function() {
                    updateActiveStates();
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Initial setup
        setTimeout(updateActiveStates, 500);
    }

    // Internal pages functionality
    function initializeInternalPages() {
        // Internal pages - Add scroll shadow to navbar
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
    }

    // Initialize when DOM is ready
    function initWhenReady() {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', function() {
                setTimeout(initializeNavbar, 100);
            });
        } else {
            setTimeout(initializeNavbar, 100);
        }
    }
    
    // Start initialization
    initWhenReady();
})();
</script>