@extends('layouts.app')

@section('title', 'Sejarah - Tirta Perwira')
@section('description', 'Sejarah perjalanan PDAM Tirta Perwira Purbalingga dalam melayani masyarakat dengan air bersih berkualitas')

@php
    use Illuminate\Support\Facades\Storage;
@endphp

@push('styles')
<style>
    /* Compact Timeline Styles */
    .timeline-item {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.5s ease-out;
        margin-bottom: 3rem;
    }
    
    .timeline-item.animate {
        opacity: 1;
        transform: translateY(0);
    }
    
    .timeline-content {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border-left: 4px solid #3b82f6;
        transition: all 0.3s ease;
        position: relative;
    }
    
    .timeline-content:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        transform: translateY(-2px);
    }
    
    .timeline-dot {
        position: absolute;
        left: -12px;
        top: 1.5rem;
        width: 24px;
        height: 24px;
        background: #3b82f6;
        border: 3px solid white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 12px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        z-index: 10;
    }
    
    .timeline-year {
        display: inline-flex;
        align-items: center;
        background: linear-gradient(135deg, #3b82f6, #06b6d4);
        color: white;
        padding: 4px 12px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.875rem;
        margin-bottom: 0.75rem;
    }
    
    .timeline-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #1f2937;
        line-height: 1.3;
    }
    
    .timeline-description {
        color: #6b7280;
        line-height: 1.6;
        margin-bottom: 1rem;
    }
    
    .timeline-image {
        border-radius: 12px;
        overflow: hidden;
        margin: 1rem 0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    }
    
    .timeline-image img {
        width: 100%;
        height: auto;
        transition: transform 0.3s ease;
    }
    
    .timeline-image:hover img {
        transform: scale(1.02);
    }
    
    .timeline-highlight {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(6, 182, 212, 0.05));
        border-left: 3px solid #3b82f6;
        padding: 0.75rem;
        border-radius: 8px;
        margin-top: 0.75rem;
        font-size: 0.875rem;
    }
    
    .timeline-line {
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 2px;
        background: linear-gradient(to bottom, #3b82f6, #06b6d4);
        margin-left: -1px;
    }
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .timeline-content {
            margin-left: 2rem;
            padding: 1rem;
        }
        
        .timeline-dot {
            left: -8px;
            width: 16px;
            height: 16px;
            font-size: 10px;
        }
        
        .timeline-title {
            font-size: 1.125rem;
        }
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-cyan-50">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content container-custom">
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

    <!-- Compact Timeline Section -->
    <section class="section-padding bg-white">
        <div class="container-custom">
            <div class="max-w-4xl mx-auto">
                <!-- Section Title -->
                <div class="text-center mb-12">
                    <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-3">Perjalanan Sejarah</h2>
                    <p class="text-base text-gray-600 max-w-2xl mx-auto">
                        Kronologi perjalanan Tirta Perwira dalam melayani masyarakat Purbalingga
                    </p>
                </div>

                <!-- Timeline Container -->
                <div class="relative">
                    <!-- Timeline Line -->
                    <div class="timeline-line"></div>

                    <!-- Timeline Items -->
                    <div class="space-y-4">
                        @if($company && $company->history_timeline)
                            @foreach($company->history_timeline as $index => $timeline)
                                <div class="timeline-item relative pl-8" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
                                    <!-- Timeline Dot -->
                                    <div class="timeline-dot">
                                        <i class="{{ $timeline['icon'] ?? 'fas fa-calendar-alt' }}"></i>
                                    </div>
                                    
                                    <!-- Timeline Content -->
                                    <div class="timeline-content">
                                        <!-- Year Badge -->
                                        <div class="timeline-year">
                                            <i class="fas fa-calendar-alt mr-1"></i>{{ $timeline['year'] ?? '' }}
                                        </div>
                                        
                                        <!-- Content Grid -->
                                        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                                            <!-- Text Content -->
                                            <div class="lg:col-span-2">
                                                <h3 class="timeline-title">{{ $timeline['title'] ?? '' }}</h3>
                                                <p class="timeline-description">{{ $timeline['description'] ?? '' }}</p>
                                                
                                                <!-- Impact/Achievement -->
                                                @if(isset($timeline['impact']))
                                                <div class="timeline-highlight">
                                                    <div class="flex items-start">
                                                        <i class="fas fa-lightbulb text-blue-600 mt-0.5 mr-2 flex-shrink-0"></i>
                                                        <div>
                                                            <strong class="text-blue-900">Dampak:</strong>
                                                            <span class="text-blue-700">{{ $timeline['impact'] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                
                                                @if(isset($timeline['achievement']))
                                                <div class="timeline-highlight">
                                                    <div class="flex items-start">
                                                        <i class="fas fa-trophy text-amber-600 mt-0.5 mr-2 flex-shrink-0"></i>
                                                        <div>
                                                            <strong class="text-amber-900">Pencapaian:</strong>
                                                            <span class="text-amber-700">{{ $timeline['achievement'] }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            
                                            <!-- Image -->
                                            @if(isset($timeline['image']) && !empty($timeline['image']))
                                            <div class="lg:col-span-1">
                                                <div class="timeline-image">
                                                    <img src="{{ Storage::url($timeline['image']) }}" 
                                                         alt="{{ $timeline['title'] ?? 'Timeline Image' }}"
                                                         class="w-full h-32 object-cover">
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Default Timeline -->
                            @php
                                $defaultTimeline = [
                                    [
                                        'year' => '1970-an',
                                        'title' => 'Pendirian PDAM',
                                        'description' => 'PDAM Tirta Perwira Purbalingga didirikan sebagai bagian dari upaya pemerintah daerah untuk menyediakan akses air bersih bagi masyarakat.',
                                        'icon' => 'fas fa-seedling',
                                        'impact' => 'Memulai pelayanan air bersih untuk ribuan keluarga di Purbalingga'
                                    ],
                                    [
                                        'year' => '1980-an',
                                        'title' => 'Ekspansi Jaringan',
                                        'description' => 'Perluasan jaringan distribusi air ke berbagai kecamatan dengan peningkatan kualitas infrastruktur dan teknologi pengolahan.',
                                        'icon' => 'fas fa-rocket',
                                        'achievement' => 'Cakupan pelayanan meningkat hingga 60% wilayah kabupaten'
                                    ],
                                    [
                                        'year' => '1990-an',
                                        'title' => 'Modernisasi Sistem',
                                        'description' => 'Implementasi sistem manajemen modern dan peningkatan kualitas pelayanan dengan teknologi terdepan.',
                                        'icon' => 'fas fa-chart-line',
                                        'impact' => 'Efisiensi operasional meningkat 40% dan kepuasan pelanggan mencapai 85%'
                                    ],
                                    [
                                        'year' => '2000-an',
                                        'title' => 'Era Digital',
                                        'description' => 'Transformasi digital dalam pelayanan dan penerapan sistem informasi terintegrasi untuk kemudahan pelanggan.',
                                        'icon' => 'fas fa-lightbulb',
                                        'achievement' => 'Menjadi PDAM terdepan di Jawa Tengah dalam inovasi teknologi'
                                    ],
                                    [
                                        'year' => '2020-sekarang',
                                        'title' => 'Sustainability & Innovation',
                                        'description' => 'Komitmen pada pembangunan berkelanjutan, inovasi hijau, dan smart water management untuk masa depan yang lebih baik.',
                                        'icon' => 'fas fa-star',
                                        'impact' => 'Target Universal Water Access 2030 dan Zero Waste Operations'
                                    ]
                                ];
                            @endphp
                            
                            @foreach($defaultTimeline as $index => $timeline)
                                <div class="timeline-item relative pl-8" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
                                    <!-- Timeline Dot -->
                                    <div class="timeline-dot">
                                        <i class="{{ $timeline['icon'] }}"></i>
                                    </div>
                                    
                                    <!-- Timeline Content -->
                                    <div class="timeline-content">
                                        <!-- Year Badge -->
                                        <div class="timeline-year">
                                            <i class="fas fa-calendar-alt mr-1"></i>{{ $timeline['year'] }}
                                        </div>
                                        
                                        <!-- Content -->
                                        <div>
                                            <h3 class="timeline-title">{{ $timeline['title'] }}</h3>
                                            <p class="timeline-description">{{ $timeline['description'] }}</p>
                                            
                                            <!-- Impact/Achievement -->
                                            @if(isset($timeline['impact']))
                                            <div class="timeline-highlight">
                                                <div class="flex items-start">
                                                    <i class="fas fa-lightbulb text-blue-600 mt-0.5 mr-2 flex-shrink-0"></i>
                                                    <div>
                                                        <strong class="text-blue-900">Dampak:</strong>
                                                        <span class="text-blue-700">{{ $timeline['impact'] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            
                                            @if(isset($timeline['achievement']))
                                            <div class="timeline-highlight">
                                                <div class="flex items-start">
                                                    <i class="fas fa-trophy text-amber-600 mt-0.5 mr-2 flex-shrink-0"></i>
                                                    <div>
                                                        <strong class="text-amber-900">Pencapaian:</strong>
                                                        <span class="text-amber-700">{{ $timeline['achievement'] }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
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
                    Dengan pengalaman puluhan tahun, PDAM Tirta Perwira terus berkomitmen memberikan pelayanan terbaik dan berkontribusi dalam pembangunan Kabupaten Purbalingga yang berkelanjutan.
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS (Animate On Scroll)
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 600,
                easing: 'ease-out',
                once: true,
                offset: 50
            });
        }

        // Timeline animation observer
        const timelineItems = document.querySelectorAll('.timeline-item');
        const observerOptions = {
            threshold: 0.2,
            rootMargin: '0px 0px -100px 0px'
        };

        const timelineObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.add('animate');
                    }, index * 150);
                }
            });
        }, observerOptions);

        timelineItems.forEach(item => {
            timelineObserver.observe(item);
        });

        // Image lazy loading with intersection observer
        const timelineImages = document.querySelectorAll('.timeline-image img');
        const imageObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    if (img.dataset.src) {
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                    }
                    imageObserver.unobserve(img);
                }
            });
        });

        timelineImages.forEach(img => {
            imageObserver.observe(img);
        });

        // Timeline dots hover effect
        const timelineDots = document.querySelectorAll('.timeline-dot');
        timelineDots.forEach(dot => {
            dot.addEventListener('mouseenter', function() {
                this.style.transform = 'scale(1.2)';
                this.style.boxShadow = '0 4px 8px rgba(59, 130, 246, 0.3)';
            });
            
            dot.addEventListener('mouseleave', function() {
                this.style.transform = 'scale(1)';
                this.style.boxShadow = '0 2px 4px rgba(0,0,0,0.1)';
            });
        });
    });
</script>
@endpush
