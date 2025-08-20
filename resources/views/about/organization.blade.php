@extends('layouts.app')

@section('title', 'Struktur Organisasi - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content container-custom">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="hero-title">Struktur Organisasi</h1>
                <p class="hero-description">
                    Struktur kepemimpinan dan manajemen {{ $company->company_name ?? 'PDAM Tirta Perwira' }} yang professional dan berpengalaman
                </p>
            </div>
        </div>
    </section>

    <!-- Organization Structure Content -->
    <div class="container-custom section-padding">
        @if(!empty($organizations) && count($organizations) > 0)
            
            <!-- Executive Leadership Section -->
            @if(isset($organizations[1]) || isset($organizations[2]))
            <div class="mb-16" data-aos="fade-up">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Direksi</h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-blue-500 to-indigo-500 mx-auto rounded-full"></div>
                    <p class="text-gray-600 mt-4 text-lg">Tim kepemimpinan tertinggi {{ $company->company_name ?? 'PDAM Tirta Perwira' }}</p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-items-start">
                    @if(isset($organizations[1]))
                        @foreach($organizations[1] as $structure)
                            <div class="group relative w-full max-w-sm">
                                <div class="bg-gradient-to-br from-blue-50 to-indigo-100 p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-blue-100">
                                    <!-- Position Badge -->
                                    <div class="absolute -top-4 left-6">
                                        <span class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                            Direktur Utama
                                        </span>
                                    </div>
                                    
                                    <!-- Avatar with Photo/Icon -->
                                    <div class="flex justify-center mb-6">
                                        @if($structure->hasPhoto())
                                            <div class="w-24 h-24 rounded-full overflow-hidden shadow-lg group-hover:scale-110 transition-transform duration-300 border-4 border-white">
                                                <img 
                                                    src="{{ $structure->getPhotoUrl('thumb') }}" 
                                                    alt="{{ $structure->name }}"
                                                    class="w-full h-full object-cover"
                                                >
                                            </div>
                                        @else
                                            <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                                @if($structure->icon)
                                                    <div class="text-white text-2xl">
                                                        {!! $structure->icon !!}
                                                    </div>
                                                @else
                                                    <i class="fas fa-crown text-white text-2xl"></i>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Content -->
                                    <div class="text-center">
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $structure->title }}</h3>
                                        <p class="text-blue-700 font-semibold text-lg">{{ $structure->name }}</p>
                                        @if($structure->subtitle)
                                            <p class="text-gray-600 text-sm mt-1">{{ $structure->subtitle }}</p>
                                        @endif
                                        @if($structure->description)
                                            <p class="text-gray-500 text-xs mt-2 leading-relaxed">{{ Str::limit($structure->description, 100) }}</p>
                                        @endif
                                    </div>
                                    
                                    <!-- Decorative Element -->
                                    <div class="absolute bottom-0 right-0 w-16 h-16 bg-gradient-to-br from-blue-200 to-indigo-200 rounded-tl-3xl opacity-20"></div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    
                    @if(isset($organizations[2]))
                        @foreach($organizations[2] as $structure)
                            <div class="group relative w-full max-w-sm">
                                <div class="bg-gradient-to-br from-emerald-50 to-teal-100 p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-emerald-100">
                                    <!-- Position Badge -->
                                    <div class="absolute -top-4 left-6">
                                        <span class="bg-gradient-to-r from-emerald-600 to-teal-600 text-white px-4 py-2 rounded-full text-sm font-semibold shadow-lg">
                                            Direktur Umum
                                        </span>
                                    </div>
                                    
                                    <!-- Avatar with Photo/Icon -->
                                    <div class="flex justify-center mb-6">
                                        @if($structure->hasPhoto())
                                            <div class="w-24 h-24 rounded-full overflow-hidden shadow-lg group-hover:scale-110 transition-transform duration-300 border-4 border-white">
                                                <img 
                                                    src="{{ $structure->getPhotoUrl('thumb') }}" 
                                                    alt="{{ $structure->name }}"
                                                    class="w-full h-full object-cover"
                                                >
                                            </div>
                                        @else
                                            <div class="w-24 h-24 bg-gradient-to-br from-emerald-500 to-teal-600 rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform duration-300">
                                                @if($structure->icon)
                                                    <div class="text-white text-2xl">
                                                        {!! $structure->icon !!}
                                                    </div>
                                                @else
                                                    <i class="fas fa-user-tie text-white text-2xl"></i>
                                                @endif
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Content -->
                                    <div class="text-center">
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $structure->title }}</h3>
                                        <p class="text-emerald-700 font-semibold text-lg">{{ $structure->name }}</p>
                                        @if($structure->subtitle)
                                            <p class="text-gray-600 text-sm mt-1">{{ $structure->subtitle }}</p>
                                        @endif
                                        @if($structure->description)
                                            <p class="text-gray-500 text-xs mt-2 leading-relaxed">{{ Str::limit($structure->description, 100) }}</p>
                                        @endif
                                    </div>
                                    
                                    <!-- Decorative Element -->
                                    <div class="absolute bottom-0 right-0 w-16 h-16 bg-gradient-to-br from-emerald-200 to-teal-200 rounded-tl-3xl opacity-20"></div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
            @endif

            <!-- Department Heads Section -->
            @if(isset($organizations[3]))
            <div class="mb-16" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Kepala Bagian</h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-purple-500 to-pink-500 mx-auto rounded-full"></div>
                    <p class="text-gray-600 mt-4 text-lg">Pimpinan departemen dan divisi utama</p>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-6">
                    @foreach($organizations[3] as $structure)
                        <div class="group">
                            <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100 relative overflow-hidden">
                                <!-- Background Pattern -->
                                <div class="absolute top-0 right-0 w-16 h-16 bg-gradient-to-br from-purple-100 to-pink-100 rounded-bl-full opacity-50"></div>
                                
                                <!-- Avatar with Photo/Icon -->
                                <div class="flex justify-center mb-4">
                                    @if($structure->hasPhoto())
                                        <div class="w-16 h-16 rounded-full overflow-hidden shadow-md group-hover:scale-110 transition-transform duration-300 border-3 border-white">
                                            <img 
                                                src="{{ $structure->getPhotoUrl('thumb') }}" 
                                                alt="{{ $structure->name }}"
                                                class="w-full h-full object-cover"
                                            >
                                        </div>
                                    @else
                                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center shadow-md group-hover:scale-110 transition-transform duration-300">
                                            @if($structure->icon)
                                                <div class="text-white text-lg">
                                                    {!! $structure->icon !!}
                                                </div>
                                            @else
                                                @php
                                                    $bagianIcons = [
                                                        'umum' => 'fas fa-layer-group',
                                                        'teknik' => 'fas fa-wrench',
                                                        'keuangan' => 'fas fa-calculator',
                                                        'langganan' => 'fas fa-users',
                                                        'produksi' => 'fas fa-industry',
                                                        'distribusi' => 'fas fa-route',
                                                        'default' => 'fas fa-briefcase'
                                                    ];
                                                    $icon = 'fas fa-briefcase';
                                                    foreach($bagianIcons as $key => $iconClass) {
                                                        if(stripos($structure->title, $key) !== false) {
                                                            $icon = $iconClass;
                                                            break;
                                                        }
                                                    }
                                                @endphp
                                                <i class="{{ $icon }} text-white text-lg"></i>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Content -->
                                <div class="text-center">
                                    <h3 class="font-bold text-gray-900 text-sm mb-2 leading-tight min-h-[2.5rem]">{{ $structure->title }}</h3>
                                    <p class="text-purple-600 font-medium text-xs">{{ $structure->name }}</p>
                                    @if($structure->subtitle)
                                        <p class="text-gray-500 text-xs mt-1">{{ $structure->subtitle }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Unit & Branch Section -->
            @if(isset($organizations[4]))
            <div class="mb-16" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Kepala Unit & Cabang</h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-orange-500 to-red-500 mx-auto rounded-full"></div>
                    <p class="text-gray-600 mt-4 text-lg">Unit operasional dan cabang layanan</p>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4">
                    @foreach($organizations[4] as $structure)
                        <div class="group">
                            <div class="bg-gradient-to-br from-orange-50 to-red-50 p-4 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 border border-orange-100">
                                <!-- Avatar with Photo/Icon -->
                                <div class="flex justify-center mb-3">
                                    @if($structure->hasPhoto())
                                        <div class="w-12 h-12 rounded-full overflow-hidden shadow-sm group-hover:scale-110 transition-transform duration-300 border-2 border-white">
                                            <img 
                                                src="{{ $structure->getPhotoUrl('thumb') }}" 
                                                alt="{{ $structure->name }}"
                                                class="w-full h-full object-cover"
                                            >
                                        </div>
                                    @else
                                        <div class="w-12 h-12 bg-gradient-to-br from-orange-500 to-red-500 rounded-full flex items-center justify-center shadow-sm group-hover:scale-110 transition-transform duration-300">
                                            @if($structure->icon)
                                                <div class="text-white text-sm">
                                                    {!! $structure->icon !!}
                                                </div>
                                            @else
                                                @php
                                                    $unitIcons = [
                                                        'cabang' => 'fas fa-building',
                                                        'unit' => 'fas fa-cube',
                                                        'produksi' => 'fas fa-industry',
                                                        'distribusi' => 'fas fa-truck',
                                                        'default' => 'fas fa-home'
                                                    ];
                                                    $icon = 'fas fa-home';
                                                    foreach($unitIcons as $key => $iconClass) {
                                                        if(stripos($structure->title, $key) !== false) {
                                                            $icon = $iconClass;
                                                            break;
                                                        }
                                                    }
                                                @endphp
                                                <i class="{{ $icon }} text-white text-sm"></i>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Content -->
                                <div class="text-center">
                                    <h3 class="font-semibold text-gray-900 text-xs mb-1 leading-tight min-h-[2rem]">{{ $structure->title }}</h3>
                                    <p class="text-orange-600 font-medium text-xs">{{ $structure->name }}</p>
                                    @if($structure->subtitle)
                                        <p class="text-gray-500 text-xs mt-1">{{ $structure->subtitle }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Sub-Departments Grid -->
            @if(isset($organizations[5]) || isset($organizations[6]) || isset($organizations[7]) || isset($organizations[8]))
            <div class="space-y-6" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center mb-8">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Sub Bagian</h2>
                    <div class="w-24 h-1 bg-gradient-to-r from-indigo-500 to-purple-500 mx-auto rounded-full"></div>
                    <p class="text-gray-600 mt-4 text-lg">Unit kerja spesialisasi dan departemen pendukung</p>
                </div>
                
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    @if(isset($organizations[5]))
                    <div class="bg-gradient-to-br from-teal-50 to-cyan-50 p-4 rounded-xl shadow-md border border-teal-100">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-cyan-500 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-layer-group text-white text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Sub Bagian Umum</h3>
                                <p class="text-teal-600 text-xs">Administrasi & Support</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach($organizations[5] as $structure)
                                <div class="bg-white p-2 rounded-lg shadow-sm border border-teal-100 hover:shadow-md transition-shadow duration-200">
                                    <div class="flex items-center">
                                        @if($structure->hasPhoto())
                                            <div class="w-6 h-6 rounded-full overflow-hidden mr-2 border border-teal-200">
                                                <img 
                                                    src="{{ $structure->getPhotoUrl('thumb') }}" 
                                                    alt="{{ $structure->name }}"
                                                    class="w-full h-full object-cover"
                                                >
                                            </div>
                                        @else
                                            <div class="w-6 h-6 bg-gradient-to-br from-teal-400 to-cyan-400 rounded-full flex items-center justify-center mr-2">
                                                @if($structure->icon)
                                                    <div class="text-white text-xs">
                                                        {!! $structure->icon !!}
                                                    </div>
                                                @else
                                                    <i class="fas fa-user text-white text-xs"></i>
                                                @endif
                                            </div>
                                        @endif
                                        <div>
                                            <h4 class="font-semibold text-gray-900 text-xs leading-tight">{{ str_replace(['Kepala Sub Bagian ', 'Sub Bagian '], '', $structure->title) }}</h4>
                                            <p class="text-teal-600 text-xs">{{ $structure->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if(isset($organizations[6]))
                    <div class="bg-gradient-to-br from-indigo-50 to-blue-50 p-4 rounded-xl shadow-md border border-indigo-100">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-indigo-500 to-blue-500 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-tools text-white text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Sub Bagian Teknik</h3>
                                <p class="text-indigo-600 text-xs">Engineering & Maintenance</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach($organizations[6] as $structure)
                                <div class="bg-white p-2 rounded-lg shadow-sm border border-indigo-100 hover:shadow-md transition-shadow duration-200">
                                    <div class="flex items-center">
                                        @if($structure->hasPhoto())
                                            <div class="w-6 h-6 rounded-full overflow-hidden mr-2 border border-indigo-200">
                                                <img 
                                                    src="{{ $structure->getPhotoUrl('thumb') }}" 
                                                    alt="{{ $structure->name }}"
                                                    class="w-full h-full object-cover"
                                                >
                                            </div>
                                        @else
                                            <div class="w-6 h-6 bg-gradient-to-br from-indigo-400 to-blue-400 rounded-full flex items-center justify-center mr-2">
                                                @if($structure->icon)
                                                    <div class="text-white text-xs">
                                                        {!! $structure->icon !!}
                                                    </div>
                                                @else
                                                    <i class="fas fa-tools text-white text-xs"></i>
                                                @endif
                                            </div>
                                        @endif
                                        <div>
                                            <h4 class="font-semibold text-gray-900 text-xs leading-tight">{{ str_replace(['Kepala Sub Bagian ', 'Sub Bagian '], '', $structure->title) }}</h4>
                                            <p class="text-indigo-600 text-xs">{{ $structure->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if(isset($organizations[7]))
                    <div class="bg-gradient-to-br from-rose-50 to-pink-50 p-4 rounded-xl shadow-md border border-rose-100">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-rose-500 to-pink-500 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-handshake text-white text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Sub Bagian Hubungan Langganan</h3>
                                <p class="text-rose-600 text-xs">Customer Relations</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach($organizations[7] as $structure)
                                <div class="bg-white p-2 rounded-lg shadow-sm border border-rose-100 hover:shadow-md transition-shadow duration-200">
                                    <div class="flex items-center">
                                        @if($structure->hasPhoto())
                                            <div class="w-6 h-6 rounded-full overflow-hidden mr-2 border border-rose-200">
                                                <img 
                                                    src="{{ $structure->getPhotoUrl('thumb') }}" 
                                                    alt="{{ $structure->name }}"
                                                    class="w-full h-full object-cover"
                                                >
                                            </div>
                                        @else
                                            <div class="w-6 h-6 bg-gradient-to-br from-rose-400 to-pink-400 rounded-full flex items-center justify-center mr-2">
                                                @if($structure->icon)
                                                    <div class="text-white text-xs">
                                                        {!! $structure->icon !!}
                                                    </div>
                                                @else
                                                    <i class="fas fa-handshake text-white text-xs"></i>
                                                @endif
                                            </div>
                                        @endif
                                        <div>
                                            <h4 class="font-semibold text-gray-900 text-xs leading-tight">{{ str_replace(['Kepala Sub Bagian ', 'Sub Bagian '], '', $structure->title) }}</h4>
                                            <p class="text-rose-600 text-xs">{{ $structure->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    @if(isset($organizations[8]))
                    <div class="bg-gradient-to-br from-emerald-50 to-green-50 p-4 rounded-xl shadow-md border border-emerald-100">
                        <div class="flex items-center mb-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-emerald-500 to-green-500 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-calculator text-white text-sm"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Sub Bagian Keuangan</h3>
                                <p class="text-emerald-600 text-xs">Finance</p>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            @foreach($organizations[8] as $structure)
                                <div class="bg-white p-2 rounded-lg shadow-sm border border-emerald-100 hover:shadow-md transition-shadow duration-200">
                                    <div class="flex items-center">
                                        @if($structure->hasPhoto())
                                            <div class="w-6 h-6 rounded-full overflow-hidden mr-2 border border-emerald-200">
                                                <img 
                                                    src="{{ $structure->getPhotoUrl('thumb') }}" 
                                                    alt="{{ $structure->name }}"
                                                    class="w-full h-full object-cover"
                                                >
                                            </div>
                                        @else
                                            <div class="w-6 h-6 bg-gradient-to-br from-emerald-400 to-green-400 rounded-full flex items-center justify-center mr-2">
                                                @if($structure->icon)
                                                    <div class="text-white text-xs">
                                                        {!! $structure->icon !!}
                                                    </div>
                                                @else
                                                    <i class="fas fa-calculator text-white text-xs"></i>
                                                @endif
                                            </div>
                                        @endif
                                        <div>
                                            <h4 class="font-semibold text-gray-900 text-xs leading-tight">{{ str_replace(['Kepala Sub Bagian ', 'Sub Bagian '], '', $structure->title) }}</h4>
                                            <p class="text-emerald-600 text-xs">{{ $structure->name }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            @endif

        @else
            <!-- Empty State -->
            <div class="text-center py-16" data-aos="fade-up">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-users text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Struktur Organisasi Belum Tersedia</h3>
                    <p class="text-gray-600 mb-6">
                        Data sedang dalam proses pemutakhiran untuk memberikan informasi yang akurat
                    </p>
                    <a href="{{ route('home') }}" class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-home mr-2"></i>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS (Animate On Scroll)
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 600,
                easing: 'ease-out',
                once: true,
                offset: 100
            });
        }

        // Enhanced hover effects for cards
        const cards = document.querySelectorAll('.group');
        cards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                const cardElement = this.querySelector('div');
                if (cardElement) {
                    cardElement.style.transform = 'translateY(-2px) scale(1.02)';
                    cardElement.style.boxShadow = '0 10px 25px rgba(0,0,0,0.1)';
                    cardElement.style.transition = 'all 0.3s ease';
                }
            });
            
            card.addEventListener('mouseleave', function() {
                const cardElement = this.querySelector('div');
                if (cardElement) {
                    cardElement.style.transform = 'translateY(0) scale(1)';
                    cardElement.style.boxShadow = '';
                    cardElement.style.transition = 'all 0.3s ease';
                }
            });
        });

        // Add smooth scroll behavior to navigation links
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
    });
</script>

<style>
/* Ensure text doesn't get truncated and has proper spacing */
.min-h-\[2\.5rem\] {
    min-height: 2.5rem;
}

.min-h-\[2rem\] {
    min-height: 2rem;
}

/* Enhanced hover states for icons */
.group:hover .w-24 {
    transform: scale(1.05);
    transition: transform 0.3s ease;
}

.group:hover .w-16 {
    transform: scale(1.1);
    transition: transform 0.3s ease;
}

.group:hover .w-12 {
    transform: scale(1.1);
    transition: transform 0.3s ease;
}

.group:hover .w-8 {
    transform: scale(1.15);
    transition: transform 0.3s ease;
}

/* Ensure proper text wrapping */
.leading-tight {
    line-height: 1.25;
}

/* Make sure cards have consistent height */
.bg-white.p-6 {
    min-height: 180px;
}

.bg-white.p-4 {
    min-height: 120px;
}

.bg-white.p-3 {
    min-height: 80px;
}

.bg-white.p-2 {
    min-height: 60px;
}

.bg-gradient-to-br.p-4 {
    min-height: 120px;
}
</style>
@endpush

@endsection
