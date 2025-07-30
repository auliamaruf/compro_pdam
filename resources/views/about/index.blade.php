@extends('layouts.app')

@section('title', 'Tentang Kami - {{ $company->company_name ?? "PDAM Tirta Perwira" }}')
@section('description', 'Profil perusahaan {{ $company->company_name ?? "PDAM Tirta Perwira" }} - {{ $company->company_tagline ?? "Air Bersih Untuk Kehidupan Yang Lebih Baik" }}')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content container-custom">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="hero-title">Tentang Kami</h1>
                <p class="hero-description">
                    {{ $company->company_description ? strip_tags($company->company_description) : 'Mengenal lebih dekat Perumda Air Minum Tirta Perwira' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Company Profile Section -->
    <section class="section-padding">
        <div class="container-custom">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Profil Perusahaan</h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        {{ $company->company_tagline ?? 'PDAM Purbalingga berkomitmen memberikan pelayanan air bersih terbaik untuk masyarakat' }}
                    </p>
                </div>

                <div class="bg-white rounded-xl shadow-lg p-8 lg:p-12 mb-12">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-6">{{ $company->company_name ?? 'Tirta Perwira' }}</h3>
                            <div class="prose prose-lg max-w-none text-gray-600">
                                @if($company->company_description)
                                    {!! $company->company_description !!}
                                @else
                                    <p class="mb-6">
                                        Perumda Air Minum Tirta Perwira merupakan perusahaan daerah yang bergerak dalam bidang penyediaan air bersih untuk masyarakat Kabupaten Purbalingga. Dengan pengalaman lebih dari 25 tahun, kami telah melayani lebih dari 50,000 pelanggan aktif.
                                    </p>
                                    <p>
                                        Sebagai perusahaan daerah yang mengutamakan pelayanan publik, kami berkomitmen untuk terus meningkatkan kualitas pelayanan dan infrastruktur guna memenuhi kebutuhan air bersih masyarakat Purbalingga.
                                    </p>
                                @endif
                            </div>
                        </div>
                        <div class="relative">
                            @if($company->getFirstMediaUrl('about_image'))
                                <div class="relative bg-white p-2 rounded-xl shadow-lg">
                                    <img 
                                        src="{{ $company->getFirstMediaUrl('about_image') }}" 
                                        alt="{{ $company->company_name ?? 'PDAM Tirta Perwira' }}"
                                        class="w-full h-80 object-cover rounded-lg"
                                    >
                                    <div class="absolute inset-2 bg-gradient-to-t from-black/60 via-black/20 to-transparent rounded-lg"></div>
                                    <div class="absolute bottom-0 left-0 right-0 text-center p-6">
                                        <div class="text-white">
                                            <h4 class="text-lg lg:text-xl font-bold mb-2 drop-shadow-lg">
                                                {{ $company->company_name ?? 'PDAM Tirta Perwira' }}
                                            </h4>
                                            <p class="text-sm lg:text-base text-white/95 leading-relaxed drop-shadow-md">
                                                {{ $company->company_tagline ?? 'Air Bersih Untuk Kehidupan Yang Lebih Baik' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @elseif($company->getFirstMediaUrl('company_photos') || $company->company_logo)
                                <div class="relative bg-white p-2 rounded-xl shadow-lg">
                                    <img 
                                        src="{{ $company->getFirstMediaUrl('company_photos') ?: ($company->company_logo ? asset('storage/' . $company->company_logo) : asset('images/default-company.jpg')) }}" 
                                        alt="{{ $company->company_name ?? 'PDAM Tirta Perwira' }}"
                                        class="w-full h-80 object-cover rounded-lg"
                                    >
                                    <div class="absolute inset-2 bg-gradient-to-t from-black/60 via-black/20 to-transparent rounded-lg"></div>
                                    <div class="absolute bottom-0 left-0 right-0 text-center p-6">
                                        <div class="text-white">
                                            <h4 class="text-lg lg:text-xl font-bold mb-2 drop-shadow-lg">
                                                {{ $company->company_name ?? 'PDAM Tirta Perwira' }}
                                            </h4>
                                            <p class="text-sm lg:text-base text-white/95 leading-relaxed drop-shadow-md">
                                                {{ $company->company_tagline ?? 'Air Bersih Untuk Kehidupan Yang Lebih Baik' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <!-- Fallback jika tidak ada foto -->
                                <div class="bg-gradient-to-br from-blue-600 to-cyan-500 p-8 rounded-xl text-white text-center h-80 flex flex-col justify-end">
                                    <div class="mb-8">
                                        <svg class="w-16 h-16 mx-auto opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H7m2 0v-5a2 2 0 012-2h2a2 2 0 012 2v5"></path>
                                        </svg>
                                    </div>
                                    <div class="pb-4">
                                        <h4 class="text-lg lg:text-xl font-bold mb-2">
                                            {{ $company->company_name ?? 'PDAM Tirta Perwira' }}
                                        </h4>
                                        <p class="text-sm lg:text-base text-blue-100 leading-relaxed">
                                            {{ $company->company_tagline ?? 'Air Bersih Untuk Kehidupan Yang Lebih Baik' }}
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>



                <!-- Statistics -->
                <!-- @if($company->years_experience || $company->customers_served || $company->water_quality_percentage || $company->service_availability)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                    @if($company->years_experience)
                    <div class="text-center group">
                        <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H7m2 0v-5a2 2 0 012-2h2a2 2 0 012 2v5"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-blue-600 mb-2">{{ $company->years_experience }}+</h3>
                        <p class="text-gray-600">Tahun Pengalaman</p>
                    </div>
                    @endif

                    @if($company->customers_served)
                    <div class="text-center group">
                        <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-200 transition-colors">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-green-600 mb-2">{{ number_format($company->customers_served / 1000) }}K+</h3>
                        <p class="text-gray-600">Pelanggan Dilayani</p>
                    </div>
                    @endif

                    @if($company->water_quality_percentage)
                    <div class="text-center group">
                        <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-orange-200 transition-colors">
                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-orange-600 mb-2">{{ $company->water_quality_percentage }}%</h3>
                        <p class="text-gray-600">Kualitas Air Terjamin</p>
                    </div>
                    @endif

                    @if($company->service_availability)
                    <div class="text-center group">
                        <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-200 transition-colors">
                            <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-purple-600 mb-2">{{ $company->service_availability }}</h3>
                        <p class="text-gray-600">Pelayanan Siaga</p>
                    </div>
                    @endif
                </div>
                @endif -->

                <!-- Company Values - Now using core_values instead of company_values -->
                <!-- @if($company->core_values && count($company->core_values) > 0)
                <div class="mb-12">
                    <div class="text-center mb-8">
                        <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4">Nilai-nilai Perusahaan</h3>
                        <p class="text-lg text-gray-600">Prinsip dasar yang menjadi pedoman dalam setiap kegiatan</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($company->core_values as $value)
                        <div class="bg-white rounded-xl shadow-lg p-6 text-center border border-blue-100 hover:shadow-xl transition-shadow">
                            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                {!! $value['icon'] ?? '<svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' !!}
                            </div>
                            <h4 class="text-lg font-bold text-gray-900 mb-3">{{ strtoupper($value['name'] ?? '') }}</h4>
                            <p class="text-gray-600 leading-relaxed">{{ $value['description'] ?? '' }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section> -->

    <!-- Navigation to Other Pages -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h3 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4">Pelajari Lebih Lanjut</h3>
                    <p class="text-lg text-gray-600">Jelajahi berbagai aspek perusahaan kami</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <a href="{{ route('about.history') }}" class="group bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-6 border border-blue-100 hover:shadow-lg transition-shadow">
                        <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mb-4 group-hover:bg-blue-200 transition-colors">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Sejarah Kami</h4>
                        <p class="text-gray-600 text-sm">Perjalanan panjang melayani masyarakat Purbalingga dengan air bersih berkualitas</p>
                    </a>

                    <a href="{{ route('about.vision-mission') }}" class="group bg-gradient-to-r from-green-50 to-blue-50 rounded-xl p-6 border border-green-100 hover:shadow-lg transition-shadow">
                        <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mb-4 group-hover:bg-blue-200 transition-colors">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Visi & Misi</h4>
                        <p class="text-gray-600 text-sm">Komitmen dan arah strategis kami dalam melayani masyarakat Purbalingga</p>
                    </a>

                    <a href="{{ route('about.organization') }}" class="group bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6 border border-purple-100 hover:shadow-lg transition-shadow">
                        <div class="bg-purple-100 w-12 h-12 rounded-full flex items-center justify-center mb-4 group-hover:bg-purple-200 transition-colors">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h4 class="text-lg font-bold text-gray-900 mb-2">Struktur Organisasi</h4>
                        <p class="text-gray-600 text-sm">Kepemimpinan dan tim profesional yang menggerakkan PDAM Tirta Perwira</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <!-- <section class="py-16 bg-gradient-to-r from-blue-900 to-blue-700 text-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h3 class="text-3xl lg:text-4xl font-bold mb-6">Bergabunglah dengan Kami</h3>
                <p class="text-xl text-blue-100 leading-relaxed mb-8">
                    Mari bersama-sama mewujudkan akses air bersih berkualitas untuk seluruh masyarakat Purbalingga
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('services') }}" class="inline-flex items-center px-6 py-3 bg-white text-blue-900 font-medium rounded-lg hover:bg-blue-50 transition-colors">
                        <span>Lihat Layanan Kami</span>
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 bg-transparent border-2 border-white text-white font-medium rounded-lg hover:bg-white hover:text-blue-900 transition-colors">
                        <span>Hubungi Kami</span>
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section> -->
</div>
@endsection
