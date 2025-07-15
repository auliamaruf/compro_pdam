@extends('layouts.app')

@section('title', 'Layanan - Tirta Perwira PDAM Purbalingga')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content container-custom">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="hero-title">Layanan Kami</h1>
                <p class="hero-description">
                    Berbagai layanan air bersih berkualitas untuk memenuhi kebutuhan masyarakat Purbalingga
                </p>
            </div>
        </div>
        <div class="hero-wave">
            <svg viewBox="0 0 1200 120" class="w-full h-12 fill-current text-blue-50">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"></path>
            </svg>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="section-padding">
        <div class="container-custom">
            @if($services->count() > 0)
                <!-- Services by Category -->
                @foreach($servicesByCategory as $categoryName => $categoryServices)
                <div class="mb-16">
                    <!-- Category Header -->
                    <div class="flex items-center mb-8">
                        <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mr-4">
                            @if($categoryName === 'new_connection')
                                <i class="fas fa-plus text-white text-xl"></i>
                            @elseif($categoryName === 'billing')
                                <i class="fas fa-money-bill-wave text-white text-xl"></i>
                            @elseif($categoryName === 'customer_service')
                                <i class="fas fa-headset text-white text-xl"></i>
                            @elseif($categoryName === 'technical')
                                <i class="fas fa-tools text-white text-xl"></i>
                            @else
                                <i class="fas fa-concierge-bell text-white text-xl"></i>
                            @endif
                        </div>
                        <div>
                            <h2 class="text-3xl font-bold text-gray-900">
                                @if($categoryName === 'new_connection')
                                    Sambungan Baru
                                @elseif($categoryName === 'billing')
                                    Pembayaran & Tagihan
                                @elseif($categoryName === 'customer_service')
                                    Layanan Pelanggan
                                @elseif($categoryName === 'technical')
                                    Teknis & Instalasi
                                @else
                                    {{ ucfirst($categoryName) }}
                                @endif
                            </h2>
                            <p class="text-gray-600 mt-1">
                                @if($categoryName === 'new_connection')
                                    Layanan pemasangan sambungan air baru
                                @elseif($categoryName === 'billing')
                                    Informasi tagihan dan cara pembayaran
                                @elseif($categoryName === 'customer_service')
                                    Bantuan dan pengaduan pelanggan
                                @elseif($categoryName === 'technical')
                                    Perbaikan dan maintenance jaringan
                                @else
                                    Layanan dan informasi lainnya
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Services Cards -->
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach($categoryServices as $service)
                        <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-blue-200">
                            <!-- Service Icon/Image -->
                            <div class="relative overflow-hidden">
                                @if($service->getFirstMediaUrl('icons'))
                                <div class="aspect-video">
                                    <img src="{{ $service->getFirstMediaUrl('icons') }}"
                                         alt="{{ $service->name }}"
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                                @else
                                <div class="aspect-video bg-gradient-to-br from-blue-50 to-blue-100 flex items-center justify-center">
                                    <div class="w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center">
                                        @if($service->category === 'new_connection')
                                            <i class="fas fa-plus text-white text-2xl"></i>
                                        @elseif($service->category === 'billing')
                                            <i class="fas fa-money-bill-wave text-white text-2xl"></i>
                                        @elseif($service->category === 'customer_service')
                                            <i class="fas fa-headset text-white text-2xl"></i>
                                        @elseif($service->category === 'technical')
                                            <i class="fas fa-tools text-white text-2xl"></i>
                                        @else
                                            <i class="fas fa-concierge-bell text-white text-2xl"></i>
                                        @endif
                                    </div>
                                </div>
                                @endif

                                <!-- Service Badges -->
                                <div class="absolute top-4 left-4 flex gap-2">
                                    @if($service->is_featured)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 border border-blue-200">
                                        <i class="fas fa-star mr-1"></i>
                                        Unggulan
                                    </span>
                                    @endif
                                    @if($service->is_online)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-cyan-100 text-cyan-800 border border-cyan-200">
                                        <i class="fas fa-globe mr-1"></i>
                                        Online
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!-- Service Content -->
                            <div class="p-6">
                                <!-- Service Title -->
                                <h3 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                    <a href="{{ route('services.show', $service->slug) }}">
                                        {{ $service->name }}
                                    </a>
                                </h3>

                                <!-- Service Description -->
                                <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                                    {{ Str::limit(strip_tags($service->description), 120) }}
                                </p>

                                <!-- Service Actions -->
                                <div class="flex items-center justify-between">
                                    <a href="{{ route('services.show', $service->slug) }}"
                                       class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors text-sm">
                                        <i class="fas fa-arrow-right mr-2"></i>
                                        Selengkapnya
                                    </a>

                                    @if($service->category === 'customer_service' && $service->is_online)
                                    <a href="https://pengaduan.pdampurbalingga.co.id" target="_blank" rel="noopener noreferrer"
                                       class="inline-flex items-center px-4 py-2 bg-orange-100 text-orange-700 font-medium rounded-lg hover:bg-orange-200 transition-colors text-sm">
                                        <i class="fas fa-headset mr-2"></i>
                                        Langsung
                                    </a>
                                    @elseif($service->category === 'billing')
                                    <a href="https://tagihan.pdampurbalingga.co.id" target="_blank" rel="noopener noreferrer"
                                       class="inline-flex items-center px-4 py-2 bg-blue-100 text-blue-700 font-medium rounded-lg hover:bg-blue-200 transition-colors text-sm">
                                        <i class="fas fa-search mr-2"></i>
                                        Cek
                                    </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach

                <!-- Quick Access Section -->
                <div class="mt-12 bg-gradient-to-r from-blue-600 to-blue-700 rounded-2xl p-8 text-white shadow-xl">
                    <h2 class="text-3xl font-bold mb-8 text-center">Akses Cepat Layanan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <a href="{{ route('services.sambungan-baru') }}"
                           class="bg-white bg-opacity-15 backdrop-blur-sm rounded-xl p-6 text-center hover:bg-opacity-25 transition-all duration-300 border border-white border-opacity-20">
                            <svg class="w-12 h-12 mx-auto mb-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            <h3 class="font-bold mb-2 text-white text-lg">Sambungan Baru</h3>
                            <p class="text-sm text-white opacity-90">Daftar sambungan air bersih baru</p>
                        </a>
                        <a href="https://tagihan.pdampurbalingga.co.id" target="_blank" rel="noopener noreferrer"
                           class="bg-white bg-opacity-15 backdrop-blur-sm rounded-xl p-6 text-center hover:bg-opacity-25 transition-all duration-300 border border-white border-opacity-20">
                            <svg class="w-12 h-12 mx-auto mb-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="font-bold mb-2 text-white text-lg">Cek Tagihan</h3>
                            <p class="text-sm text-white opacity-90">Periksa tagihan air bulanan</p>
                        </a>
                        <a href="https://pengaduan.pdampurbalingga.co.id" target="_blank" rel="noopener noreferrer"
                           class="bg-white bg-opacity-15 backdrop-blur-sm rounded-xl p-6 text-center hover:bg-opacity-25 transition-all duration-300 border border-white border-opacity-20">
                            <svg class="w-12 h-12 mx-auto mb-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.232 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            <h3 class="font-bold mb-2 text-white text-lg">Pengaduan</h3>
                            <p class="text-sm text-white opacity-90">Sampaikan keluhan atau saran</p>
                        </a>
                    </div>
                </div>

            @else
                <div class="text-center py-16">
                    <div class="w-24 h-24 mx-auto mb-6 bg-gray-100 rounded-full flex items-center justify-center">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Layanan Akan Segera Tersedia</h2>
                    <p class="text-lg text-gray-600 mb-8 max-w-2xl mx-auto">
                        Kami sedang mempersiapkan informasi layanan terbaik untuk Anda. Silakan hubungi kami untuk informasi lebih lanjut.
                    </p>
                    <a href="{{ route('contact') }}" class="btn-primary">
                        Hubungi Kami
                    </a>
                </div>
            @endif
        </div>
    </section>
</div>
@endsection
