@extends('layouts.app')

@section('title', 'Struktur Organisasi - ' . config('app.name'))

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-50 to-blue-50">
    <!-- Hero Section -->
    <div class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white py-16 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"%3E%3Cg fill="none" fill-rule="evenodd"%3E%3Cg fill="%23ffffff" fill-opacity="0.1"%3E%3Cpath d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>
        
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-white bg-opacity-20 rounded-full mb-6">
                    <i class="fas fa-sitemap text-3xl"></i>
                </div>
                <h1 class="text-4xl lg:text-5xl font-bold mb-4">Struktur Organisasi</h1>
                <p class="text-xl text-blue-100 max-w-3xl mx-auto">
                    Struktur kepemimpinan dan manajemen PDAM Tirta Perwira yang professional dan berpengalaman
                </p>
            </div>
        </div>
    </div>

    <!-- Compact Organization Structure Content -->
    <div class="org-container">
        @if(!empty($organizations) && count($organizations) > 0)
            <!-- Executive Leadership -->
            @if(isset($organizations[1]) || isset($organizations[2]))
            <div class="mb-6" data-aos="fade-up">
                <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-blue-500">
                    <h2 class="org-section-header text-lg font-bold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-crown text-blue-500 mr-2"></i>
                        Pimpinan Eksekutif
                    </h2>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 org-grid-normal">
                        @if(isset($organizations[1]))
                            @foreach($organizations[1] as $structure)
                                <div class="org-card org-card-content text-center p-3 bg-gradient-to-br from-blue-50 to-indigo-50 rounded-lg border border-blue-100">
                                    <div class="org-icon-container w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <i class="fas fa-crown text-white text-sm"></i>
                                    </div>
                                    <h3 class="org-title-multiline font-semibold text-gray-900 text-xs mb-1 leading-tight">{{ $structure->title }}</h3>
                                    <p class="org-text-truncate text-blue-600 font-medium text-xs">{{ Str::limit($structure->name, 25) }}</p>
                                </div>
                            @endforeach
                        @endif
                        
                        @if(isset($organizations[2]))
                            @foreach($organizations[2] as $structure)
                                <div class="org-card org-card-content text-center p-3 bg-gradient-to-br from-green-50 to-emerald-50 rounded-lg border border-green-100">
                                    <div class="org-icon-container w-10 h-10 bg-gradient-to-br from-green-500 to-green-600 rounded-full flex items-center justify-center mx-auto mb-2">
                                        <i class="fas fa-user-graduate text-white text-sm"></i>
                                    </div>
                                    <h3 class="org-title-multiline font-semibold text-gray-900 text-xs mb-1 leading-tight">{{ $structure->title }}</h3>
                                    <p class="org-text-truncate text-green-600 font-medium text-xs">{{ Str::limit($structure->name, 25) }}</p>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
            @endif

            <!-- Departmental Structure -->
            @if(isset($organizations[3]))
            <div class="mb-6" data-aos="fade-up" data-aos-delay="100">
                <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-purple-500">
                    <h2 class="org-section-header text-lg font-bold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-sitemap text-purple-500 mr-2"></i>
                        Kepala Bagian
                    </h2>
                    
                    <div class="grid grid-cols-3 md:grid-cols-4 lg:grid-cols-6 org-grid-tight">
                        @foreach($organizations[3] as $structure)
                            <div class="org-card org-card-content text-center p-2 bg-gradient-to-br from-purple-50 to-violet-50 rounded-lg border border-purple-100">
                                <div class="org-icon-container w-8 h-8 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-1">
                                    @php
                                        $bagianIcons = [
                                            'umum' => 'fas fa-cogs',
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
                                    <i class="{{ $icon }} text-white text-xs"></i>
                                </div>
                                <h3 class="org-title-multiline font-semibold text-gray-900 text-xs mb-1 leading-tight">{{ Str::limit($structure->title, 20) }}</h3>
                                <p class="org-text-truncate text-purple-600 font-medium text-xs">{{ Str::limit($structure->name, 15) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Unit & Branch Structure -->
            @if(isset($organizations[4]))
            <div class="mb-6" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-orange-500">
                    <h2 class="org-section-header text-lg font-bold text-gray-900 mb-3 flex items-center">
                        <i class="fas fa-building text-orange-500 mr-2"></i>
                        Kepala Unit & Cabang
                    </h2>
                    
                    <div class="grid grid-cols-3 md:grid-cols-5 lg:grid-cols-6 org-grid-tight">
                        @foreach($organizations[4] as $structure)
                            <div class="org-card org-card-content text-center p-2 bg-gradient-to-br from-orange-50 to-amber-50 rounded-lg border border-orange-100">
                                <div class="org-icon-container w-8 h-8 bg-gradient-to-br from-orange-500 to-orange-600 rounded-full flex items-center justify-center mx-auto mb-1">
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
                                    <i class="{{ $icon }} text-white text-xs"></i>
                                </div>
                                <h3 class="org-title-multiline font-semibold text-gray-900 text-xs mb-1 leading-tight">{{ Str::limit($structure->title, 18) }}</h3>
                                <p class="org-text-truncate text-orange-600 font-medium text-xs">{{ Str::limit($structure->name, 12) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif

            <!-- Sub-Departments Compact Grid -->
            @if(isset($organizations[5]) || isset($organizations[6]) || isset($organizations[7]) || isset($organizations[8]))
            <div class="grid grid-cols-1 lg:grid-cols-2 org-grid-normal" data-aos="fade-up" data-aos-delay="300">
                @if(isset($organizations[5]))
                <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-teal-500">
                    <h3 class="org-section-header text-md font-bold text-gray-900 mb-2 flex items-center">
                        <i class="fas fa-layer-group text-teal-500 mr-2 text-sm"></i>
                        Sub Bagian Umum
                    </h3>
                    <div class="grid grid-cols-2 org-grid-tight">
                        @foreach($organizations[5] as $structure)
                            <div class="org-card org-card-content text-center p-2 bg-gradient-to-br from-teal-50 to-cyan-50 rounded-md border border-teal-100">
                                <div class="org-icon-container w-6 h-6 bg-gradient-to-br from-teal-500 to-teal-600 rounded-full flex items-center justify-center mx-auto mb-1">
                                    <i class="fas fa-user text-white text-xs"></i>
                                </div>
                                <h4 class="org-title-multiline font-semibold text-gray-900 text-xs mb-1 leading-tight">{{ str_replace(['Kepala Sub Bagian ', 'Sub Bagian '], '', $structure->title) }}</h4>
                                <p class="org-text-truncate text-teal-600 text-xs">{{ Str::limit($structure->name, 10) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if(isset($organizations[6]))
                <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-indigo-500">
                    <h3 class="org-section-header text-md font-bold text-gray-900 mb-2 flex items-center">
                        <i class="fas fa-tools text-indigo-500 mr-2 text-sm"></i>
                        Sub Bagian Teknik
                    </h3>
                    <div class="grid grid-cols-2 org-grid-tight">
                        @foreach($organizations[6] as $structure)
                            <div class="org-card org-card-content text-center p-2 bg-gradient-to-br from-indigo-50 to-blue-50 rounded-md border border-indigo-100">
                                <div class="org-icon-container w-6 h-6 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-full flex items-center justify-center mx-auto mb-1">
                                    <i class="fas fa-tools text-white text-xs"></i>
                                </div>
                                <h4 class="org-title-multiline font-semibold text-gray-900 text-xs mb-1 leading-tight">{{ str_replace(['Kepala Sub Bagian ', 'Sub Bagian '], '', $structure->title) }}</h4>
                                <p class="org-text-truncate text-indigo-600 text-xs">{{ Str::limit($structure->name, 10) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if(isset($organizations[7]))
                <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-rose-500">
                    <h3 class="org-section-header text-md font-bold text-gray-900 mb-2 flex items-center">
                        <i class="fas fa-handshake text-rose-500 mr-2 text-sm"></i>
                        Sub Bagian Hubungan Langganan
                    </h3>
                    <div class="grid grid-cols-2 org-grid-tight">
                        @foreach($organizations[7] as $structure)
                            <div class="org-card org-card-content text-center p-2 bg-gradient-to-br from-rose-50 to-pink-50 rounded-md border border-rose-100">
                                <div class="org-icon-container w-6 h-6 bg-gradient-to-br from-rose-500 to-rose-600 rounded-full flex items-center justify-center mx-auto mb-1">
                                    <i class="fas fa-handshake text-white text-xs"></i>
                                </div>
                                <h4 class="org-title-multiline font-semibold text-gray-900 text-xs mb-1 leading-tight">{{ str_replace(['Kepala Sub Bagian ', 'Sub Bagian '], '', $structure->title) }}</h4>
                                <p class="org-text-truncate text-rose-600 text-xs">{{ Str::limit($structure->name, 10) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                @if(isset($organizations[8]))
                <div class="bg-white rounded-lg shadow-md p-4 border-l-4 border-emerald-500">
                    <h3 class="org-section-header text-md font-bold text-gray-900 mb-2 flex items-center">
                        <i class="fas fa-cogs text-emerald-500 mr-2 text-sm"></i>
                        Sub Bagian Lainnya
                    </h3>
                    <div class="grid grid-cols-2 org-grid-tight">
                        @foreach($organizations[8] as $structure)
                            <div class="org-card org-card-content text-center p-2 bg-gradient-to-br from-emerald-50 to-green-50 rounded-md border border-emerald-100">
                                <div class="org-icon-container w-6 h-6 bg-gradient-to-br from-emerald-500 to-emerald-600 rounded-full flex items-center justify-center mx-auto mb-1">
                                    <i class="fas fa-cogs text-white text-xs"></i>
                                </div>
                                <h4 class="org-title-multiline font-semibold text-gray-900 text-xs mb-1 leading-tight">{{ str_replace(['Kepala Sub Bagian ', 'Sub Bagian '], '', $structure->title) }}</h4>
                                <p class="org-text-truncate text-emerald-600 text-xs">{{ Str::limit($structure->name, 10) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            @endif

        @else
            <!-- Compact Empty State -->
            <div class="text-center py-8" data-aos="fade-up">
                <div class="bg-white rounded-lg shadow-md p-6 max-w-md mx-auto">
                    <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-users text-gray-400 text-xl"></i>
                    </div>
                    <h3 class="text-md font-bold text-gray-900 mb-2">Struktur Organisasi Belum Tersedia</h3>
                    <p class="text-gray-600 text-sm mb-3">
                        Data sedang dalam proses pemutakhiran
                    </p>
                    <a href="{{ route('home') }}" class="inline-flex items-center bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700 transition-colors text-sm">
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
                duration: 400,
                easing: 'ease-out',
                once: true,
                offset: 30
            });
        }

        // Add compact hover effects to organization cards
        const orgCards = document.querySelectorAll('.org-card');
        orgCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-1px) scale(1.02)';
                this.style.boxShadow = '0 4px 12px rgba(0,0,0,0.1)';
                this.style.transition = 'all 0.2s ease';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
                this.style.boxShadow = '';
                this.style.transition = 'all 0.2s ease';
            });
        });
    });
</script>
@endpush

@endsection
