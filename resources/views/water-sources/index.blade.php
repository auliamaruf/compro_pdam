@extends('layouts.app')

@section('title', 'Sumber Mata Air - ' . (($company && $company->company_name && is_string($company->company_name)) ? $company->company_name : 'Tirta Perwira'))
@section('description', 'Informasi lengkap tentang sumber mata air yang dikelola ' . (($company && $company->company_name && is_string($company->company_name)) ? $company->company_name : 'PDAM Tirta Perwira') . ' untuk melayani masyarakat dengan air berkualitas')

@push('styles')
<style>
    .sources-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }
    
    .source-card {
        opacity: 1; /* Changed from 0 to 1 to ensure visibility */
        transform: translateY(0); /* Reset transform */
        transition: all 0.5s ease-out;
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-left: 4px solid #3b82f6;
        height: 100%; /* Make all cards same height */
        display: flex;
        flex-direction: column;
    }
    
    .source-card.animate {
        opacity: 1;
        transform: translateY(0);
    }
    
    .source-card:hover {
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }
    
    .source-image {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        margin-bottom: 1rem;
        height: 200px; /* Fixed height for consistent appearance */
    }
    
    .source-image img {
        transition: transform 0.3s ease;
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensure image covers the container properly */
    }
    
    .source-card:hover .source-image img {
        transform: scale(1.05);
    }
    
    .source-image-placeholder {
        margin-bottom: 1rem;
        height: 200px; /* Same fixed height as source-image */
    }
    
    .source-header {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }
    
    .source-icon {
        width: 50px;
        height: 50px;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
        margin-right: 0.75rem;
        flex-shrink: 0;
    }
    
    .source-info {
        flex: 1;
        min-width: 0;
    }
    
    .source-name {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1f2937 !important; /* Added !important to ensure color is applied */
        margin-bottom: 0.25rem;
        line-height: 1.2;
        display: block; /* Ensure it's displayed as block */
        z-index: 1; /* Ensure it's above other elements */
    }
    
    .source-location {
        color: #6b7280 !important; /* Added !important to ensure color is applied */
        font-weight: 500;
        font-size: 0.875rem;
        display: block; /* Ensure it's displayed as block */
    }
    
    .source-status {
        background: #f8fafc;
        border-radius: 6px;
        padding: 0.75rem;
        margin-bottom: 1rem;
        border-left: 3px solid #10b981;
    }
    
    .status-title {
        font-size: 0.75rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.25rem;
    }
    
    .status-value {
        font-size: 1rem;
        font-weight: 600;
        color: #1f2937;
        line-height: 1.2;
    }
    
    .source-details {
        space-y: 1rem;
        flex: 1; /* Take remaining space */
        display: flex;
        flex-direction: column;
    }
    
    .detail-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }
    
    .detail-icon {
        width: 20px;
        height: 20px;
        color: #3b82f6;
        margin-top: 2px;
        flex-shrink: 0;
    }
    
    .detail-content h4 {
        font-weight: 600;
        color: #1f2937;
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
    }
    
    .detail-content p {
        color: #6b7280;
        font-size: 0.875rem;
        line-height: 1.4;
    }

    .hero-section {
        display: flex;
        align-items: center;
    }

    .hero-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        line-height: 1.1;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .hero-description {
        font-size: 1.25rem;
        color: rgba(255, 255, 255, 0.95);
        margin-bottom: 2.5rem;
        max-width: 768px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    .hero-wave {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        transform: translateY(1px);
        z-index: 5;
    }

    .hero-wave svg {
        width: 100%;
        height: 4rem;
        fill: #f9fafb;
    }

    .container-custom {
        max-width: 1280px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    .section-padding {
        padding: 4rem 0;
    }
    
    /* Pagination Styling */
    .pagination-wrapper {
        background: white;
        border-radius: 16px;
        padding: 1.5rem 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        border: 1px solid #e5e7eb;
    }
    
    .pagination-info {
        text-align: center;
        margin-bottom: 1rem;
        color: #6b7280;
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    .pagination-nav {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .pagination-nav .page-item {
        margin: 0;
    }
    
    .pagination-nav .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 0.75rem;
        border: 2px solid #e5e7eb;
        border-radius: 10px;
        color: #374151;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        background: white;
    }
    
    .pagination-nav .page-link:hover {
        background-color: #3b82f6;
        color: white;
        border-color: #3b82f6;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
    
    .pagination-nav .page-item.active .page-link {
        background-color: #3b82f6;
        color: white;
        border-color: #3b82f6;
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
    
    .pagination-nav .page-item.disabled .page-link {
        opacity: 0.4;
        cursor: not-allowed;
        background-color: #f9fafb;
        color: #9ca3af;
    }
    
    .pagination-nav .page-item.disabled .page-link:hover {
        transform: none;
        box-shadow: none;
        background-color: #f9fafb;
        color: #9ca3af;
        border-color: #e5e7eb;
    }
    
    .pagination-nav .page-link svg {
        width: 16px;
        height: 16px;
    }
    
    @media (max-width: 768px) {
        .sources-grid {
            grid-template-columns: 1fr;
        }
        
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-description {
            font-size: 1rem;
        }
        
        .pagination-wrapper {
            padding: 1rem 1.25rem;
        }
        
        .pagination-info {
            font-size: 0.8rem;
            margin-bottom: 0.75rem;
        }
        
        .pagination-nav .page-link {
            min-width: 36px;
            height: 36px;
            padding: 0 0.5rem;
            font-size: 0.8rem;
        }
        
        .pagination-nav {
            gap: 0.25rem;
        }
    }
</style>
@endpush

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content container-custom">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="hero-title">Sumber Mata Air</h1>
                <p class="hero-description">
                    {{ (($company && $company->company_name && is_string($company->company_name)) ? $company->company_name : 'PDAM Tirta Perwira') }} mengelola berbagai sumber mata air strategis untuk menyediakan air bersih berkualitas bagi masyarakat
                </p>
            </div>
        </div>
    </section>

    <!-- Water Sources Content -->
    <section class="section-padding">
        <div class="container-custom">
            @if($waterSources->count() > 0)
                <div class="max-w-7xl mx-auto">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl font-bold text-gray-800 mb-4">Sumber Mata Air Kami</h2>
                        <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                            Sumber-sumber mata air berkualitas yang dikelola dengan standar tinggi untuk memastikan pasokan air bersih yang berkelanjutan.
                        </p>
                    </div>
                    
                    <div class="sources-grid">
                        @foreach($waterSources as $index => $source)
                        <div class="source-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                            <!-- Source Image -->
                            @if($source->getFirstMediaUrl('water_source_images') || $source->getFirstMediaUrl('photo'))
                            <div class="source-image mb-4">
                                <img src="{{ $source->getFirstMediaUrl('water_source_images') ?: $source->getFirstMediaUrl('photo') }}" 
                                     alt="{{ $source->name }}" 
                                     class="w-full h-[200px] object-cover rounded-lg shadow-sm"
                                     loading="lazy" width="400" height="200">
                            </div>
                            @else
                            <div class="source-image-placeholder mb-4">
                                <div class="w-full h-[200px] bg-gradient-to-br from-blue-100 to-blue-200 rounded-lg shadow-sm flex items-center justify-center">
                                    <div class="text-center text-blue-600">
                                        <i class="fas fa-tint text-4xl mb-2 opacity-50"></i>
                                        <p class="text-sm font-medium opacity-75">Foto akan segera tersedia</p>
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Source Header -->
                            <div class="source-header">
                                <div class="source-icon">
                                    <i class="fas fa-tint"></i>
                                </div>
                                <div class="source-info">
                                    <h3 class="source-name" style="color: #1f2937 !important; font-weight: 700 !important;">
                                        {{ $source->name ?? 'Nama tidak tersedia' }}
                                    </h3>
                                    <p class="source-location" style="color: #6b7280 !important;">
                                        {{ $source->location ?? 'Lokasi tidak tersedia' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="source-status">
                                <div class="status-title">Status</div>
                                <div class="status-value">{{ $source->status_label }}</div>
                            </div>

                            <!-- Source Details -->
                            <div class="source-details flex-1">
                                <!-- Production Capacity -->
                                <div class="detail-item">
                                    <i class="fas fa-chart-line detail-icon text-blue-600"></i>
                                    <div class="detail-content">
                                        <h4 class="font-semibold text-gray-800 mb-1">Kapasitas Produksi</h4>
                                        <p class="text-gray-600 text-sm">{{ $source->formatted_production_capacity }}</p>
                                    </div>
                                </div>

                                <!-- Ownership -->
                                <div class="detail-item">
                                    <i class="fas fa-user-tie detail-icon text-green-600"></i>
                                    <div class="detail-content">
                                        <h4 class="font-semibold text-gray-800 mb-1">Kepemilikan</h4>
                                        <p class="text-gray-600 text-sm">{{ $source->ownership_label }}</p>
                                    </div>
                                </div>

                                <!-- Distribution Area -->
                                @if($source->distribution_area)
                                <div class="detail-item">
                                    <i class="fas fa-map detail-icon text-purple-600"></i>
                                    <div class="detail-content">
                                        <h4 class="font-semibold text-gray-800 mb-1">Wilayah Distribusi</h4>
                                        <p class="text-gray-600 text-sm leading-relaxed">{{ $source->distribution_area }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- View Detail Button - Always at bottom -->
                            <div class="mt-auto pt-4 border-t border-gray-100">
                                <a href="{{ route('water-sources.show', $source) }}" 
                                   class="inline-flex items-center justify-center w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2.5 px-4 rounded-lg transition-colors">
                                    <i class="fas fa-eye mr-2"></i>
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <!-- Pagination -->
                    @if($waterSources->hasPages())
                    <div class="flex justify-center mt-12">
                        <div class="pagination-wrapper">
                            <!-- Pagination Info -->
                            <div class="pagination-info">
                                Menampilkan {{ $waterSources->firstItem() ?? 0 }} - {{ $waterSources->lastItem() ?? 0 }} 
                                dari {{ $waterSources->total() }} sumber mata air
                            </div>
                            
                            <!-- Pagination Navigation -->
                            <div class="pagination-nav">
                                {{ $waterSources->links('components.pagination') }}
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            @else
                <!-- No Data State -->
                <div class="text-center py-16">
                    <div class="text-gray-400 mb-4">
                        <i class="fas fa-tint text-6xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Data Sumber Mata Air</h3>
                    <p class="text-gray-500">Informasi sumber mata air akan segera tersedia.</p>
                </div>
            @endif
        </div>
    </section>
</div>

@push('scripts')
<script>
    // Initialize AOS if available
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 600,
            easing: 'ease-out-cubic',
            once: true
        });
    }

    // Animate cards when page loads - with fallback
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.source-card');
        
        // Immediate fallback - ensure cards are visible
        cards.forEach(card => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        });
        
        // Enhanced animation with Intersection Observer
        if ('IntersectionObserver' in window) {
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate');
                        // Add a slight delay for staggered effect
                        const delay = Array.from(cards).indexOf(entry.target) * 100;
                        setTimeout(() => {
                            entry.target.style.transform = 'translateY(-2px)';
                            setTimeout(() => {
                                entry.target.style.transform = 'translateY(0)';
                            }, 200);
                        }, delay);
                    }
                });
            }, { threshold: 0.1 });

            cards.forEach(card => observer.observe(card));
        } else {
            // Fallback for browsers without Intersection Observer
            cards.forEach((card, index) => {
                setTimeout(() => {
                    card.classList.add('animate');
                }, index * 100);
            });
        }
    });
</script>
@endpush
@endsection
