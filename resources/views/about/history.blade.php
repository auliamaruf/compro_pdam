@extends('layouts.app')

@section('title', 'Sejarah - Tirta Perwira')
@section('description', 'Sejarah perjalanan PDAM Tirta Perwira Purbalingga dalam melayani masyarakat dengan air bersih berkualitas')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-cyan-50">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container-custom">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="hero-title">Sejarah {{ $company->company_name ?? 'Tirta Perwira' }}</h1>
                <p class="hero-description">
                    {{ $company->company_history ?? 'Perjalanan panjang melayani masyarakat Purbalingga dengan air bersih berkualitas' }}
                </p>
            </div>
        </div>
        <div class="hero-wave">
            <svg viewBox="0 0 1200 120" class="w-full h-12 fill-current text-blue-50">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"></path>
            </svg>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="section-padding">
        <div class="container-custom">
            <div class="max-w-6xl mx-auto">
                <!-- Section Title -->
                <div class="text-center mb-16">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Perjalanan Historis</h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Dari awal berdiri hingga menjadi perusahaan daerah yang terpercaya dalam penyediaan air bersih
                    </p>
                </div>

                <!-- Timeline -->
                <div class="relative">
                    <!-- Timeline Line -->
                    <div class="absolute left-8 lg:left-1/2 transform lg:-translate-x-px top-0 bottom-0 w-0.5 bg-blue-200"></div>

                    <!-- Timeline Items -->
                    <div class="space-y-12">
                        @if($company && $company->history_timeline)
                            @foreach($company->history_timeline as $index => $timeline)
                                <div class="relative flex items-center lg:justify-center">
                                    @if($index % 2 == 0)
                                        <!-- Left side timeline items -->
                                        <div class="lg:w-1/2 lg:pr-8 lg:text-right">
                                            <div class="bg-white rounded-lg shadow-lg p-6 ml-16 lg:ml-0 {{ $loop->last ? 'border-2 border-blue-200' : '' }}">
                                                <div class="text-blue-600 font-semibold text-lg mb-2">{{ $timeline['year'] ?? '' }}</div>
                                                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $timeline['title'] ?? '' }}</h3>
                                                <p class="text-gray-600 leading-relaxed">{{ $timeline['description'] ?? '' }}</p>
                                            </div>
                                        </div>
                                    @else
                                        <!-- Right side timeline items -->
                                        <div class="lg:w-1/2 lg:pl-8">
                                            <div class="bg-white rounded-lg shadow-lg p-6 ml-16 lg:ml-0 {{ $loop->last ? 'border-2 border-blue-200' : '' }}">
                                                <div class="text-blue-600 font-semibold text-lg mb-2">{{ $timeline['year'] ?? '' }}</div>
                                                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $timeline['title'] ?? '' }}</h3>
                                                <p class="text-gray-600 leading-relaxed">{{ $timeline['description'] ?? '' }}</p>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="absolute left-6 lg:left-1/2 lg:transform lg:-translate-x-1/2 w-4 h-4 bg-blue-600 rounded-full border-4 border-white shadow {{ $loop->last ? 'animate-pulse' : '' }}"></div>
                                </div>
                            @endforeach
                        @else
                            <!-- Default timeline if no data -->
                            <div class="relative flex items-center lg:justify-center">
                                <div class="lg:w-1/2 lg:pr-8 lg:text-right">
                                    <div class="bg-white rounded-lg shadow-lg p-6 ml-16 lg:ml-0">
                                        <div class="text-blue-600 font-semibold text-lg mb-2">1970-an</div>
                                        <h3 class="text-xl font-bold text-gray-900 mb-3">Awal Mula Berdiri</h3>
                                        <p class="text-gray-600 leading-relaxed">
                                            PDAM Tirta Perwira Purbalingga didirikan sebagai bagian dari upaya pemerintah daerah
                                            untuk menyediakan akses air bersih bagi masyarakat Kabupaten Purbalingga.
                                        </p>
                                    </div>
                                </div>
                                <div class="absolute left-6 lg:left-1/2 lg:transform lg:-translate-x-1/2 w-4 h-4 bg-blue-600 rounded-full border-4 border-white shadow"></div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Achievements Section -->
    <section class="section-padding bg-white">
        <div class="container-custom">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Pencapaian Bersejarah</h2>
                    <p class="text-lg text-gray-600">Prestasi yang telah diraih dalam perjalanan melayani masyarakat</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    @if($company && $company->achievements)
                        @foreach($company->achievements as $achievement)
                            <div class="text-center group">
                                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                                    {!! $achievement['icon'] ?? '<svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' !!}
                                </div>
                                <h3 class="text-2xl font-bold text-blue-600 mb-2">{{ $achievement['value'] ?? '' }}</h3>
                                <p class="text-gray-600">{{ $achievement['label'] ?? '' }}</p>
                            </div>
                        @endforeach
                    @else
                        <!-- Default achievements if no data -->
                        <div class="text-center group">
                            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H7m2 0v-5a2 2 0 012-2h2a2 2 0 012 2v5"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-blue-600 mb-2">50+</h3>
                            <p class="text-gray-600">Tahun Pengalaman</p>
                        </div>
                        <div class="text-center group">
                            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-blue-600 mb-2">150K+</h3>
                            <p class="text-gray-600">Pelanggan Dilayani</p>
                        </div>
                        <div class="text-center group">
                            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-blue-600 mb-2">99%</h3>
                            <p class="text-gray-600">Kualitas Air Terjamin</p>
                        </div>
                        <div class="text-center group">
                            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-blue-600 mb-2">24/7</h3>
                            <p class="text-gray-600">Pelayanan Siaga</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Legacy Section -->
    <section class="section-padding bg-gradient-to-r from-blue-900 to-blue-700 text-white">
        <div class="container-custom">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl lg:text-4xl font-bold mb-6">Warisan untuk Masa Depan</h2>
                <p class="text-xl text-blue-100 leading-relaxed mb-8">
                    {{ $company->legacy_description ?? 'Dengan pengalaman puluhan tahun, PDAM Tirta Perwira terus berkomitmen memberikan pelayanan terbaik dan berkontribusi dalam pembangunan Kabupaten Purbalingga yang berkelanjutan.' }}
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('about.vision-mission') }}" class="inline-flex items-center px-6 py-3 bg-white text-blue-900 font-medium rounded-lg hover:bg-blue-50 transition-colors">
                        <span>Lihat Visi & Misi</span>
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    <a href="{{ route('about.organization') }}" class="inline-flex items-center px-6 py-3 bg-transparent border-2 border-white text-white font-medium rounded-lg hover:bg-white hover:text-blue-900 transition-colors">
                        <span>Struktur Organisasi</span>
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
