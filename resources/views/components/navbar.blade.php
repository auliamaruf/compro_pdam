{{-- Unified Navbar Component - Menggabungkan Home dan Internal Pages --}}
@props([
    'company' => null,
    'variant' => 'internal' // 'home' or 'internal'
])

@php
    $isHomePage = $variant === 'home';
    $navbarClass = $isHomePage ? 'home-navbar' : 'internal-navbar';
    $headerClass = $isHomePage ? 'absolute' : 'sticky';
@endphp

<header class="bg-white shadow-lg {{ $headerClass }} top-0 z-50 transition-all duration-300 {{ $navbarClass }} w-full {{ $isHomePage ? 'bg-opacity-90 backdrop-blur-sm' : '' }}">
    <div class="container-custom">
        <div class="flex items-center justify-between h-16 lg:h-20">
            <!-- Logo -->
            <a href="{{ url('/') }}" class="flex items-center space-x-3 flex-shrink-0" group>
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
                @endif
            </div>

            <!-- Mobile Menu Button -->
            <div class="lg:hidden flex-shrink-0">
                <button type="button" id="mobile-menu-button" class="flex items-center justify-center w-10 h-10 rounded-full bg-gray-100 hover:bg-gray-200 text-gray-600 hover:text-gray-900 transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div class="lg:hidden hidden" id="mobile-menu">
        @if(!$isHomePage)
            <!-- Mobile Search - Only for internal pages -->
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
        @endif

        <div class="px-2 pt-2 pb-3 space-y-1 bg-white border-t border-gray-200">
            @if($isHomePage)
                <!-- Home Page Mobile Navigation - with smooth scroll -->
                <a href="#hero" class="mobile-nav-link home-section-link active" data-section="hero">
                    Beranda
                </a>
                <a href="#about-preview" class="mobile-nav-link home-section-link" data-section="about-preview">
                    Tentang Kami
                </a>
                <a href="#services-preview" class="mobile-nav-link home-section-link" data-section="services-preview">
                    Layanan
                </a>
                <a href="#news-preview" class="mobile-nav-link home-section-link" data-section="news-preview">
                    Berita
                </a>
                <a href="{{ route('contact') }}" class="mobile-nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">
                    Kontak
                </a>

                <!-- Divider -->
                <div class="border-t border-gray-200 my-3"></div>

                <!-- Tentang Kami Sub Menu for Home Page -->
                <div class="px-2">
                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2">Tentang Kami</div>
                    <a href="{{ route('about') }}" class="mobile-nav-sublink">
                        <svg class="w-4 h-4 mr-2 inline text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Profil Perusahaan
                    </a>
                    <a href="{{ route('about.history') }}" class="mobile-nav-sublink">
                        <svg class="w-4 h-4 mr-2 inline text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Sejarah
                    </a>
                    <a href="{{ route('about.vision-mission') }}" class="mobile-nav-sublink">
                        <svg class="w-4 h-4 mr-2 inline text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Visi & Misi
                    </a>
                    <a href="{{ route('about.organization') }}" class="mobile-nav-sublink">
                        <svg class="w-4 h-4 mr-2 inline text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Struktur Organisasi
                    </a>
                    <a href="{{ route('about.branches') }}" class="mobile-nav-sublink">
                        <svg class="w-4 h-4 mr-2 inline text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                        Cabang & Unit IKK
                    </a>
                    <a href="{{ route('water-sources.index') }}" class="mobile-nav-sublink">
                        <svg class="w-4 h-4 mr-2 inline text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 7.172V5l-1-1z"></path>
                        </svg>
                        Sumber Mata Air
                    </a>
                </div>

                <!-- Layanan Sub Menu for Home Page -->
                <div class="px-2">
                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2 mt-4">Layanan</div>
                    <a href="{{ route('services') }}" class="mobile-nav-sublink">
                        <svg class="w-4 h-4 mr-2 inline text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                        </svg>
                        Semua Layanan
                    </a>
                    <a href="https://tagihan.pdampurbalingga.co.id/" target="_blank" rel="noopener noreferrer" class="mobile-nav-sublink">
                        <svg class="w-4 h-4 mr-2 inline text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Cek Tagihan
                    </a>
                    <a href="{{ route('services') }}" class="mobile-nav-sublink">
                        <svg class="w-4 h-4 mr-2 inline text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Sambungan Baru
                    </a>
                    <a href="https://pengaduan.pdampurbalingga.co.id/" target="_blank" rel="noopener noreferrer" class="mobile-nav-sublink">
                        <svg class="w-4 h-4 mr-2 inline text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Pengaduan Online
                    </a>
                    <a href="{{ route('tariff') }}" class="mobile-nav-sublink">
                        <svg class="w-4 h-4 mr-2 inline text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        Tarif Air
                    </a>
                </div>

                <!-- Informasi Lainnya for Home Page -->
                <div class="px-2">
                    <div class="text-xs font-semibold text-gray-500 uppercase tracking-wide mb-2 mt-4">Informasi Lainnya</div>
                    <a href="{{ route('news') }}" class="mobile-nav-sublink">
                        <svg class="w-4 h-4 mr-2 inline text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2.5 2.5 0 00-2.5-2.5H15"></path>
                        </svg>
                        Semua Berita
                    </a>
                    <a href="{{ route('contact') }}" class="mobile-nav-sublink">
                        <svg class="w-4 h-4 mr-2 inline text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Kontak Kami
                    </a>
                </div>
            @else
                <!-- Internal Pages Mobile Navigation - with routes -->
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

                <a href="{{ route('water-sources.index') }}" class="mobile-nav-link {{ request()->routeIs('water-sources*') ? 'active' : '' }} ml-6">
                    <svg class="w-4 h-4 inline mr-2 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 15a4 4 0 004 4h9a5 5 0 10-.1-9.999 5.002 5.002 0 10-9.78 2.096A4.001 4.001 0 003 15z"></path>
                    </svg>
                    Sumber Mata Air
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Kontak
                </a>
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
        <div class="section-dot" data-section="contact-preview" title="Kontak">
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
    @apply block px-4 py-2 text-sm text-gray-600 hover:text-blue-600 hover:bg-blue-50 transition-all duration-150 rounded-lg mx-2 my-1;
}

/* Section Indicator Dots (untuk home page) */
.section-dot {
    @apply w-3 h-3 rounded-full border-2 border-gray-300 bg-white cursor-pointer transition-all duration-200 hover:border-blue-400 relative group;
}

.section-dot.active {
    @apply border-blue-600 bg-blue-600;
}

.section-dot-inner {
    @apply w-1 h-1 rounded-full bg-gray-300 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 transition-all duration-200;
}

.section-dot.active .section-dot-inner {
    @apply bg-white;
}

.section-dot:hover .section-dot-inner {
    @apply bg-blue-400;
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
document.addEventListener('DOMContentLoaded', function() {
    const mobileMenuButton = document.getElementById('mobile-menu-button');
    const mobileMenu = document.getElementById('mobile-menu');
    const isHomePage = {{ $isHomePage ? 'true' : 'false' }};

    // Mobile menu toggle
    mobileMenuButton?.addEventListener('click', function() {
        mobileMenu.classList.toggle('hidden');
    });

    // Only initialize home page specific functionality if on home page
    if (isHomePage) {
        const sectionLinks = document.querySelectorAll('.home-section-link');
        const sectionDots = document.querySelectorAll('.section-dot');

        // Smooth scroll functionality
        function scrollToSection(sectionId) {
            const section = document.getElementById(sectionId);
            
            if (section) {
                const navbar = document.querySelector('header');
                // For absolute positioned navbar, use getBoundingClientRect for accurate height
                const navbarHeight = navbar ? navbar.getBoundingClientRect().height : 80;
                const offset = navbarHeight + 30; // Extra padding for better UX
                const elementPosition = section.offsetTop - offset;
                
                // Try multiple scroll methods
                try {
                    // Method 1: scrollIntoView (more reliable)
                    section.scrollIntoView({ 
                        behavior: 'smooth', 
                        block: 'start',
                        inline: 'nearest'
                    });
                    
                    // Adjust for navbar after scrollIntoView
                    setTimeout(() => {
                        const currentScroll = window.scrollY;
                        const adjustedPosition = currentScroll - (navbarHeight + 30);
                        if (adjustedPosition >= 0) {
                            window.scrollTo({
                                top: adjustedPosition,
                                behavior: 'smooth'
                            });
                        }
                    }, 300);
                    
                } catch(error) {
                    // Method 2: Fallback window.scrollTo
                    window.scrollTo({
                        top: Math.max(0, elementPosition),
                        behavior: 'smooth'
                    });
                }
            }
        }

        // Handle section link clicks
        sectionLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const sectionId = this.getAttribute('data-section');
                
                // Close mobile menu if open
                if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                    mobileMenu.classList.add('hidden');
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
                console.log('Clicked section dot:', sectionId); // Debug
                
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
            const sections = ['hero', 'about-preview', 'services-preview', 'news-preview', 'contact-preview'];
            
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
        updateActiveStates();
    } else {
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

    // Close mobile menu when clicking outside
    document.addEventListener('click', function(e) {
        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
            if (!mobileMenu.contains(e.target) && !mobileMenuButton.contains(e.target)) {
                mobileMenu.classList.add('hidden');
            }
        }
    });

    // Handle escape key for closing menus
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            // Close mobile menu
            if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
                mobileMenu.classList.add('hidden');
            }
        }
    });
});
</script>