@extends('layouts.app')

@section('title', 'Visi & Misi - Tirta Perwira')
@section('description', 'Visi, Misi, dan Nilai-nilai PDAM Tirta Perwira Purbalingga dalam melayani masyarakat dengan air bersih berkualitas')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-cyan-50">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container-custom">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="hero-title">Visi & Misi</h1>
                <p class="hero-description">
                    Komitmen dan arah strategis {{ $company->company_name ?? 'PDAM Tirta Perwira' }} dalam melayani masyarakat {{ $company->company_address ?? 'Purbalingga' }}
                </p>
            </div>
        </div>
        <div class="hero-wave">
            <svg viewBox="0 0 1200 120" class="w-full h-12 fill-current text-blue-50">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"></path>
            </svg>
        </div>
    </section>

    <!-- Vision Section -->
    <section class="section-padding">
        <div class="container-custom">
            <div class="max-w-6xl mx-auto">
                <div class="bg-white rounded-xl shadow-xl overflow-hidden">
                    <div class="lg:grid lg:grid-cols-2">
                        <!-- Vision Content -->
                        <div class="p-8 lg:p-12">
                            <div class="flex items-center mb-6">
                                <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </div>
                                <h2 class="text-3xl font-bold text-gray-900">VISI</h2>
                            </div>
                            <div class="text-xl text-gray-700 leading-relaxed mb-6">
                                "{{ $company->vision_description ?? 'Menjadi perusahaan daerah air minum yang terdepan di Jawa Tengah dalam memberikan pelayanan air bersih berkualitas, berkelanjutan, dan terjangkau untuk meningkatkan kualitas hidup masyarakat Purbalingga.' }}"
                            </div>
                            <div class="space-y-3">
                                <div class="flex items-start">
                                    <div class="w-2 h-2 bg-blue-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                    <span class="text-gray-600"><strong class="text-gray-800">Terdepan:</strong> Menjadi yang terbaik dalam inovasi dan teknologi</span>
                                </div>
                                <div class="flex items-start">
                                    <div class="w-2 h-2 bg-blue-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                    <span class="text-gray-600"><strong class="text-gray-800">Berkualitas:</strong> Air bersih sesuai standar kesehatan</span>
                                </div>
                                <div class="flex items-start">
                                    <div class="w-2 h-2 bg-blue-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                    <span class="text-gray-600"><strong class="text-gray-800">Berkelanjutan:</strong> Menjaga kelestarian sumber daya air</span>
                                </div>
                                <div class="flex items-start">
                                    <div class="w-2 h-2 bg-blue-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                    <span class="text-gray-600"><strong class="text-gray-800">Terjangkau:</strong> Tarif yang wajar untuk semua kalangan</span>
                                </div>
                            </div>
                        </div>

                        <!-- Vision Image -->
                        <div class="bg-gradient-to-br from-blue-600 to-cyan-500 p-8 lg:p-12 flex items-center justify-center">
                            <div class="text-center text-white">
                                <svg class="w-32 h-32 mx-auto mb-6 opacity-80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <h3 class="text-2xl font-bold mb-4">Pandangan Masa Depan</h3>
                                <p class="text-blue-100 leading-relaxed">
                                    Memimpikan Purbalingga dengan akses air bersih universal yang berkelanjutan dan terjangkau untuk semua lapisan masyarakat.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <div class="flex items-center justify-center mb-6">
                        <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                            </svg>
                        </div>
                        <h2 class="text-3xl lg:text-4xl font-bold text-gray-900">MISI</h2>
                    </div>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Langkah strategis untuk mewujudkan visi perusahaan dalam melayani masyarakat
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @if($company && $company->mission_points)
                        @foreach($company->mission_points as $index => $mission)
                            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-6 border border-blue-100">
                                <div class="flex items-start">
                                    <div class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold mr-4 mt-1 flex-shrink-0">{{ $index + 1 }}</div>
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $mission['title'] ?? '' }}</h3>
                                        <p class="text-gray-600 leading-relaxed">{{ $mission['description'] ?? '' }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Default mission if no data -->
                        <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-6 border border-blue-100">
                            <div class="flex items-start">
                                <div class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold mr-4 mt-1 flex-shrink-0">1</div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Penyediaan Air Berkualitas</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Menyediakan air bersih yang memenuhi standar kesehatan dan kualitas nasional dengan sistem pengolahan yang modern dan terpercaya.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-6 border border-blue-100">
                            <div class="flex items-start">
                                <div class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center text-sm font-bold mr-4 mt-1 flex-shrink-0">2</div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Pelayanan Prima</h3>
                                    <p class="text-gray-600 leading-relaxed">
                                        Memberikan pelayanan yang responsif, profesional, dan berorientasi pada kepuasan pelanggan dengan dukungan teknologi digital.
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="py-16">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">NILAI-NILAI PERUSAHAAN</h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Prinsip dasar yang menjadi pedoman dalam setiap kegiatan dan pelayanan
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @if($company && $company->core_values)
                        @foreach($company->core_values as $value)
                            <div class="bg-white rounded-xl shadow-lg p-6 text-center group hover:shadow-xl transition-shadow">
                                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                                    {!! $value['icon'] ?? '<svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' !!}
                                </div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">{{ strtoupper($value['name'] ?? '') }}</h3>
                                <p class="text-gray-600 leading-relaxed">{{ $value['description'] ?? '' }}</p>
                            </div>
                        @endforeach
                    @else
                        <!-- Default values if no data -->
                        <div class="bg-white rounded-xl shadow-lg p-6 text-center group hover:shadow-xl transition-shadow">
                            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">PEDULI</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Mengutamakan kepentingan masyarakat dan lingkungan dalam setiap pengambilan keputusan dan tindakan.
                            </p>
                        </div>
                        <div class="bg-white rounded-xl shadow-lg p-6 text-center group hover:shadow-xl transition-shadow">
                            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">AMANAH</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Menjalankan tugas dan tanggung jawab dengan penuh integritas, kejujuran, dan dapat dipercaya.
                            </p>
                        </div>
                        <div class="bg-white rounded-xl shadow-lg p-6 text-center group hover:shadow-xl transition-shadow">
                            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">INOVATIF</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Senantiasa mencari cara-cara baru yang lebih baik dalam memberikan pelayanan dan mengelola sumber daya.
                            </p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-gradient-to-r from-blue-900 to-blue-700 text-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl lg:text-4xl font-bold mb-6">Bergabunglah dengan Visi Kami</h2>
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
    </section>
</div>
@endsection
