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

    <!-- Organization Structure Content -->
    <div class="org-container py-16 px-4 sm:px-6 lg:px-8">
        @if(!empty($organizations) && count($organizations) > 0)
            @foreach($organizations as $level => $structures)
                <div class="org-level level-{{ $level }} mb-12" data-aos="fade-up" data-aos-delay="{{ $level * 100 }}">
                    @if($level == 1)
                        <!-- Direktur Utama -->
                        <div class="org-level-title">
                            <h2>Direktur Utama</h2>
                            <div class="org-level-indicator"></div>
                        </div>
                        <div class="org-grid-1">
                            @foreach($structures as $structure)
                                <div class="org-card">
                                    <div class="org-avatar">
                                        <i class="fas fa-crown"></i>
                                    </div>
                                    <h3 class="org-title">{{ $structure->title }}</h3>
                                    <p class="org-name">{{ $structure->name }}</p>
                                    <div class="org-level-badge">
                                        <i class="fas fa-user-tie mr-1"></i>Pemimpin Tertinggi
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    @elseif($level == 2)
                        <!-- Direktur -->
                        <div class="org-level-title">
                            <h2>Dewan Direktur</h2>
                            <div class="org-level-indicator"></div>
                        </div>
                        <div class="org-grid-2">
                            @foreach($structures as $structure)
                                <div class="org-card">
                                    <div class="org-avatar">
                                        <i class="fas fa-user-graduate"></i>
                                    </div>
                                    <h3 class="org-title">{{ $structure->title }}</h3>
                                    <p class="org-name">{{ $structure->name }}</p>
                                    <div class="org-level-badge">
                                        <i class="fas fa-layer-group mr-1"></i>Level Direktur
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    @elseif($level == 3)
                        <!-- Kepala Bagian -->
                        <div class="org-level-title">
                            <h2>Kepala Bagian</h2>
                            <div class="org-level-indicator"></div>
                        </div>
                        <div class="org-grid-3">
                            @foreach($structures as $structure)
                                <div class="org-card">
                                    <div class="org-avatar">
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
                                        <i class="{{ $icon }}"></i>
                                    </div>
                                    <h3 class="org-title">{{ $structure->title }}</h3>
                                    <p class="org-name">{{ $structure->name }}</p>
                                    <div class="org-level-badge">
                                        <i class="fas fa-layer-group mr-1"></i>Kepala Bagian
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    @elseif($level == 4)
                        <!-- Kepala Cabang & Unit -->
                        <div class="org-level-title">
                            <h2>Kepala Cabang & Unit</h2>
                            <div class="org-level-indicator"></div>
                        </div>
                        <div class="org-grid-4">
                            @foreach($structures as $structure)
                                <div class="org-card">
                                    <div class="org-avatar">
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
                                        <i class="{{ $icon }}"></i>
                                    </div>
                                    <h3 class="org-title">{{ Str::limit($structure->title, 30) }}</h3>
                                    <p class="org-name">{{ Str::limit($structure->name, 25) }}</p>
                                </div>
                            @endforeach
                        </div>

                    @else
                        <!-- Sub Bagian -->
                        <div class="org-level-title">
                            <h2>{{ $level == 5 ? 'Sub Bagian Umum' : ($level == 6 ? 'Sub Bagian Teknik' : 'Sub Bagian Lainnya') }}</h2>
                            <div class="org-level-indicator"></div>
                        </div>
                        <div class="org-grid-5">
                            @foreach($structures as $structure)
                                <div class="org-card">
                                    <div class="org-avatar">
                                        @php
                                            $subIcons = [
                                                'keuangan' => 'fas fa-calculator',
                                                'administrasi' => 'fas fa-file-alt',
                                                'hukum' => 'fas fa-gavel',
                                                'personalia' => 'fas fa-user-friends',
                                                'teknik' => 'fas fa-tools',
                                                'produksi' => 'fas fa-industry',
                                                'distribusi' => 'fas fa-shipping-fast',
                                                'langganan' => 'fas fa-handshake',
                                                'default' => 'fas fa-user'
                                            ];
                                            $icon = 'fas fa-user';
                                            foreach($subIcons as $key => $iconClass) {
                                                if(stripos($structure->title, $key) !== false) {
                                                    $icon = $iconClass;
                                                    break;
                                                }
                                            }
                                        @endphp
                                        <i class="{{ $icon }}"></i>
                                    </div>
                                    <h3 class="org-title">{{ str_replace(['Kepala Sub Bagian ', 'Sub Bagian '], '', $structure->title) }}</h3>
                                    <p class="org-name">{{ Str::limit($structure->name, 20) }}</p>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            @endforeach

            <!-- Organization Summary -->
            <div class="org-summary" data-aos="fade-up">
                <h3 class="org-summary-title">Ringkasan Organisasi</h3>
                <div class="org-summary-grid">
                    <div class="org-summary-item">
                        <div class="org-summary-number">{{ collect($organizations)->flatten()->count() }}</div>
                        <div class="org-summary-label">
                            <i class="fas fa-users mr-1"></i>Total Personel
                        </div>
                    </div>
                    <div class="org-summary-item">
                        <div class="org-summary-number">{{ count($organizations) }}</div>
                        <div class="org-summary-label">
                            <i class="fas fa-layer-group mr-1"></i>Level Struktur
                        </div>
                    </div>
                    <div class="org-summary-item">
                        <div class="org-summary-number">{{ collect($organizations)->get(3, collect())->count() + collect($organizations)->get(4, collect())->count() }}</div>
                        <div class="org-summary-label">
                            <i class="fas fa-building mr-1"></i>Unit Kerja
                        </div>
                    </div>
                    <div class="org-summary-item">
                        <div class="org-summary-number">24/7</div>
                        <div class="org-summary-label">
                            <i class="fas fa-clock mr-1"></i>Layanan
                        </div>
                    </div>
                </div>
            </div>

        @else
            <!-- Enhanced Empty State -->
            <div class="org-empty" data-aos="fade-up">
                <div class="org-empty-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="org-empty-title">Struktur Organisasi Belum Tersedia</h3>
                <p class="org-empty-description">
                    Data struktur organisasi sedang dalam proses pemutakhiran. Silakan hubungi Customer Service untuk informasi lebih lanjut.
                </p>
                <div class="space-y-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        <i class="fas fa-home mr-2"></i>
                        Kembali ke Beranda
                    </a>
                    <div class="text-sm text-gray-500">
                        atau hubungi <a href="{{ route('contact') }}" class="text-blue-600 hover:underline">Customer Service</a> untuk informasi lebih lanjut
                    </div>
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
                duration: 800,
                easing: 'ease-out',
                once: true,
                offset: 100
            });
        }

        // Organization level animation observer
        const orgLevels = document.querySelectorAll('.org-level');
        const observerOptions = {
            threshold: 0.2,
            rootMargin: '0px 0px -50px 0px'
        };

        const orgObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('animate');
                    }, index * 150);
                }
            });
        }, observerOptions);

        orgLevels.forEach(level => {
            orgObserver.observe(level);
        });

        // Counter animation for summary
        const counters = document.querySelectorAll('.org-summary-number');
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const target = entry.target;
                    const finalValue = target.textContent;
                    const numericValue = parseInt(finalValue.replace(/\D/g, ''));
                    
                    if (!isNaN(numericValue)) {
                        animateCounter(target, 0, numericValue, 2000, finalValue);
                    }
                    counterObserver.unobserve(target);
                }
            });
        }, { threshold: 0.5 });

        counters.forEach(counter => {
            counterObserver.observe(counter);
        });

        function animateCounter(element, start, end, duration, finalText) {
            const range = end - start;
            const increment = range / (duration / 16);
            let current = start;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= end) {
                    element.textContent = finalText;
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current).toLocaleString();
                }
            }, 16);
        }
    });
</script>
@endpush

@endsection
