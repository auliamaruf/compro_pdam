@extends('layouts.app')

@section('title', 'Struktur Organisasi - ' . config('app.name'))

@push('styles')
<style>
    /* Organization specific animations */
    .org-card-hover:hover {
        animation: orgCardFloat 0.6s ease-in-out;
    }
    
    @keyframes orgCardFloat {
        0%, 100% { transform: translateY(0) scale(1); }
        50% { transform: translateY(-8px) scale(1.02); }
    }
    
    .org-avatar-pulse {
        animation: avatarPulse 2s infinite;
    }
    
    @keyframes avatarPulse {
        0%, 100% { box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3); }
        50% { box-shadow: 0 12px 30px rgba(59, 130, 246, 0.5); }
    }
</style>
@endpush

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
    <div class="org-container px-4 sm:px-6 lg:px-8 py-16">
        @if(!empty($organizations) && count($organizations) > 0)
            @foreach($organizations as $level => $structures)
                <div class="org-level level-{{ $level }}" data-aos="fade-up" data-aos-delay="{{ $level * 100 }}">
                    <div class="org-level-title">
                        @if($level == 1)
                            <h2>Direktur Utama</h2>
                            <div class="org-level-indicator"></div>
                        @elseif($level == 2)
                            <h2>Dewan Direktur</h2>
                            <div class="org-level-indicator"></div>
                        @elseif($level == 3)
                            <h2>Kepala Bagian</h2>
                            <div class="org-level-indicator"></div>
                        @elseif($level == 4)
                            <h2>Kepala Cabang & Unit</h2>
                            <div class="org-level-indicator"></div>
                        @elseif($level == 5)
                            <h2>Sub Bagian Umum</h2>
                            <div class="org-level-indicator"></div>
                        @elseif($level == 6)
                            <h2>Sub Bagian Teknik</h2>
                            <div class="org-level-indicator"></div>
                        @elseif($level == 7)
                            <h2>Sub Bagian Hubungan Langganan</h2>
                            <div class="org-level-indicator"></div>
                        @else
                            <h2>Sub Bagian Lainnya</h2>
                            <div class="org-level-indicator"></div>
                        @endif
                    </div>

                    <!-- Grid Layout based on level -->
                    <div class="org-grid-{{ min($level, 5) }}">
                        @foreach($structures as $structure)
                            <div class="org-card org-card-hover">
                                <div class="org-avatar org-avatar-pulse">
                                    @php
                                        // Icon mapping berdasarkan level dan jabatan
                                        $iconClass = 'fas fa-user';
                                        if ($level == 1) {
                                            $iconClass = 'fas fa-crown';
                                        } elseif ($level == 2) {
                                            $iconClass = 'fas fa-user-tie';
                                        } elseif ($level == 3) {
                                            // Kepala Bagian - ikon berdasarkan bidang
                                            if (stripos($structure->title, 'umum') !== false) {
                                                $iconClass = 'fas fa-cogs';
                                            } elseif (stripos($structure->title, 'teknik') !== false) {
                                                $iconClass = 'fas fa-wrench';
                                            } elseif (stripos($structure->title, 'keuangan') !== false) {
                                                $iconClass = 'fas fa-calculator';
                                            } elseif (stripos($structure->title, 'langganan') !== false) {
                                                $iconClass = 'fas fa-users';
                                            } elseif (stripos($structure->title, 'produksi') !== false) {
                                                $iconClass = 'fas fa-industry';
                                            } elseif (stripos($structure->title, 'distribusi') !== false) {
                                                $iconClass = 'fas fa-route';
                                            } else {
                                                $iconClass = 'fas fa-briefcase';
                                            }
                                        } elseif ($level == 4) {
                                            // Kepala Cabang & Unit
                                            if (stripos($structure->title, 'cabang') !== false) {
                                                $iconClass = 'fas fa-building';
                                            } elseif (stripos($structure->title, 'unit') !== false) {
                                                $iconClass = 'fas fa-cube';
                                            } elseif (stripos($structure->title, 'produksi') !== false) {
                                                $iconClass = 'fas fa-industry';
                                            } elseif (stripos($structure->title, 'distribusi') !== false) {
                                                $iconClass = 'fas fa-truck';
                                            } else {
                                                $iconClass = 'fas fa-home';
                                            }
                                        } elseif ($level >= 5) {
                                            // Sub Bagian
                                            if (stripos($structure->title, 'keuangan') !== false || stripos($structure->title, 'akuntansi') !== false) {
                                                $iconClass = 'fas fa-coins';
                                            } elseif (stripos($structure->title, 'kepegawaian') !== false || stripos($structure->title, 'sdm') !== false) {
                                                $iconClass = 'fas fa-id-card';
                                            } elseif (stripos($structure->title, 'hukum') !== false || stripos($structure->title, 'legal') !== false) {
                                                $iconClass = 'fas fa-gavel';
                                            } elseif (stripos($structure->title, 'perencanaan') !== false) {
                                                $iconClass = 'fas fa-chart-pie';
                                            } elseif (stripos($structure->title, 'teknik') !== false || stripos($structure->title, 'engineering') !== false) {
                                                $iconClass = 'fas fa-tools';
                                            } elseif (stripos($structure->title, 'produksi') !== false || stripos($structure->title, 'operasional') !== false) {
                                                $iconClass = 'fas fa-play-circle';
                                            } elseif (stripos($structure->title, 'distribusi') !== false || stripos($structure->title, 'transmisi') !== false) {
                                                $iconClass = 'fas fa-share-alt';
                                            } elseif (stripos($structure->title, 'pelanggan') !== false || stripos($structure->title, 'langganan') !== false) {
                                                $iconClass = 'fas fa-handshake';
                                            } elseif (stripos($structure->title, 'penagihan') !== false || stripos($structure->title, 'billing') !== false) {
                                                $iconClass = 'fas fa-file-invoice-dollar';
                                            } else {
                                                $iconClass = 'fas fa-user-cog';
                                            }
                                        }
                                    @endphp
                                    <i class="{{ $iconClass }}"></i>
                                </div>
                                
                                <h3 class="org-title">{{ $structure->title }}</h3>
                                <p class="org-name">{{ $structure->name }}</p>
                                
                                <div class="org-level-badge">
                                    <i class="fas fa-layer-group mr-1"></i>
                                    @if($level == 1) Pimpinan Tertinggi
                                    @elseif($level == 2) Level Direktur  
                                    @elseif($level == 3) Kepala Bagian
                                    @elseif($level == 4) Kepala Unit
                                    @else Sub Bagian
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
            
            <!-- Organization Summary -->
            <div class="org-summary" data-aos="fade-up" data-aos-delay="800">
                <h3 class="org-summary-title">Ringkasan Struktur Organisasi</h3>
                <div class="org-summary-grid">
                    @php
                        $totalPersonnel = collect($organizations)->flatten()->count();
                        $directorsCount = isset($organizations[1]) ? count($organizations[1]) + (isset($organizations[2]) ? count($organizations[2]) : 0) : 0;
                        $departmentHeads = isset($organizations[3]) ? count($organizations[3]) : 0;
                        $unitHeads = isset($organizations[4]) ? count($organizations[4]) : 0;
                        $subDepartments = 0;
                        for($i = 5; $i <= 8; $i++) {
                            if(isset($organizations[$i])) {
                                $subDepartments += count($organizations[$i]);
                            }
                        }
                    @endphp
                    
                    <div class="org-summary-item">
                        <div class="org-summary-number">{{ $totalPersonnel }}</div>
                        <div class="org-summary-label">Total Pejabat</div>
                    </div>
                    <div class="org-summary-item">
                        <div class="org-summary-number">{{ $directorsCount }}</div>
                        <div class="org-summary-label">Tingkat Direktur</div>
                    </div>
                    <div class="org-summary-item">
                        <div class="org-summary-number">{{ $departmentHeads }}</div>
                        <div class="org-summary-label">Kepala Bagian</div>
                    </div>
                    <div class="org-summary-item">
                        <div class="org-summary-number">{{ $unitHeads }}</div>
                        <div class="org-summary-label">Kepala Unit</div>
                    </div>
                    <div class="org-summary-item">
                        <div class="org-summary-number">{{ $subDepartments }}</div>
                        <div class="org-summary-label">Sub Bagian</div>
                    </div>
                </div>
            </div>
            
        @else
            <!-- Enhanced Empty State -->
            <div class="org-empty">
                <div class="org-empty-icon">
                    <i class="fas fa-sitemap"></i>
                </div>
                <h3 class="org-empty-title">Struktur Organisasi Belum Tersedia</h3>
                <p class="org-empty-description">Data struktur organisasi sedang dalam proses pengembangan dan akan segera ditampilkan.</p>
                <div class="mt-6">
                    <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                        <i class="fas fa-envelope mr-2"></i>
                        Hubungi Kami untuk Info Lebih Lanjut
                    </a>
                </div>
            </div>
        @endif
    </div>
                        <div class="bg-gradient-to-r from-rose-50 to-pink-50 rounded-xl p-6 mb-8">
                            <div class="text-center mb-6">
                                <h2 class="text-xl font-bold text-gray-900 mb-2">Sub Bagian Hubungan Langganan</h2>
                                <div class="w-16 h-1 bg-gradient-to-r from-rose-500 to-pink-500 mx-auto rounded-full"></div>
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach($structures as $structure)
                                    <div class="bg-white rounded-lg shadow-sm p-4 text-center border border-rose-100 hover:shadow-md transition-all duration-300 group">
                                        <div class="mb-3">
                                            <div class="w-12 h-12 bg-gradient-to-br from-rose-500 to-pink-500 rounded-full flex items-center justify-center mx-auto text-white group-hover:scale-110 transition-transform">
                                                <i class="fas fa-handshake"></i>
                                            </div>
                                        </div>
                                        <h3 class="text-sm font-bold text-gray-900 mb-1 leading-tight">{{ str_replace(['Kepala Sub Bagian ', 'Sub Bagian '], '', $structure->title) }}</h3>
                                        <p class="text-rose-600 text-sm">{{ $structure->name }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            @endforeach

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

        // Card hover effects enhancement
        const orgCards = document.querySelectorAll('.org-card');
        orgCards.forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px) scale(1.02)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
            });
        });

        // Avatar pulse animation control
        const avatars = document.querySelectorAll('.org-avatar');
        avatars.forEach((avatar, index) => {
            setTimeout(() => {
                avatar.classList.add('org-avatar-pulse');
            }, index * 100);
        });

        // Summary counter animation
        const summaryNumbers = document.querySelectorAll('.org-summary-number');
        const summaryObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const number = entry.target;
                    const target = parseInt(number.textContent);
                    let current = 0;
                    const increment = target / 50;
                    const timer = setInterval(() => {
                        current += increment;
                        if (current >= target) {
                            number.textContent = target;
                            clearInterval(timer);
                        } else {
                            number.textContent = Math.floor(current);
                        }
                    }, 30);
                    summaryObserver.unobserve(number);
                }
            });
        }, { threshold: 0.5 });

        summaryNumbers.forEach(number => {
            summaryObserver.observe(number);
        });

        // Stagger animation for cards within each level
        orgLevels.forEach(level => {
            const cards = level.querySelectorAll('.org-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
            });
        });
    });
</script>
@endpush
@endsection
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

<!-- Add AOS Animation Library -->
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script>
    AOS.init({
        duration: 600,
        once: true,
        offset: 100
    });
</script>
@endsection
