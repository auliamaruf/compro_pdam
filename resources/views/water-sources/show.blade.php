@extends('layouts.app')

@section('title', $waterSource->name . ' - Sumber Mata Air - ' . (($company && $company->company_name && is_string($company->company_name)) ? $company->company_name : 'Tirta Perwira'))
@section('description', 'Detail lengkap tentang ' . $waterSource->name . ' - sumber mata air yang dikelola ' . (($company && $company->company_name && is_string($company->company_name)) ? $company->company_name : 'PDAM Tirta Perwira'))

@push('styles')
<style>
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

    .hero-badge {
        display: inline-flex;
        align-items: center;
        padding: 0.75rem 1.5rem;
        background: rgba(255, 255, 255, 0.15);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 9999px;
        font-size: 0.875rem;
        font-weight: 500;
        backdrop-filter: blur(12px);
        margin-bottom: 2rem;
        color: rgba(255, 255, 255, 0.9);
    }

    .hero-location {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 1.125rem;
        color: rgba(255, 255, 255, 0.9);
        margin-bottom: 1.5rem;
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

    .detail-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-left: 4px solid #3b82f6;
        height: fit-content;
    }

    .detail-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }
    
    .detail-icon {
        width: 18px;
        height: 18px;
        color: #3b82f6;
        margin-top: 2px;
        flex-shrink: 0;
    }
    
    .detail-content h4 {
        font-weight: 600;
        color: #1f2937;
        font-size: 0.8125rem;
        margin-bottom: 0.25rem;
        line-height: 1.3;
    }
    
    .detail-content p {
        color: #6b7280;
        font-size: 0.8125rem;
        line-height: 1.4;
        font-weight: 500;
    }

    .main-photo-container {
        transition: all 0.3s ease;
    }

    .main-photo-container:hover {
        transform: translateY(-4px);
    }

    .main-photo-container img {
        border-radius: 12px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        background-color: #f9fafb;
    }

    .main-photo-container:hover img {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }

    .sidebar-photo-container {
        transition: all 0.3s ease;
    }

    .sidebar-photo-container:hover {
        transform: translateY(-2px);
    }

    .sidebar-photo-container img {
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        min-height: 14rem;
        background-color: #f9fafb;
    }

    .sidebar-photo-container:hover img {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    /* Sidebar detail styling */
    .detail-item {
        padding-bottom: 0.75rem;
        border-bottom: 1px solid #f3f4f6;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: flex-start;
        gap: 0.625rem;
    }

    .detail-item:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }

    .detail-item.border-t {
        margin-top: 0.75rem;
        padding-top: 0.75rem;
    }

    /* Sidebar height matching */
    @media (min-width: 1024px) {
        .sidebar-info-height {
            height: auto; /* Auto height untuk mengakomodasi semua konten */
            max-height: none; /* Hilangkan batas maksimal */
            min-height: 450px; /* Batas minimal tetap */
        }
        
        .sidebar-content {
            max-height: none; /* Hilangkan batas tinggi konten */
        }
    }

    @media (max-width: 1023px) {
        .sidebar-info-height {
            height: auto;
        }
    }

    /* Equal height layout - REMOVED */

    /* Modal styling */
    #imageModal {
        backdrop-filter: blur(8px);
        -webkit-backdrop-filter: blur(8px);
    }

    #imageModal img {
        filter: drop-shadow(0 10px 25px rgba(0, 0, 0, 0.3));
    }

    /* Smooth animations */
    .sidebar-photo-container .group-hover\:scale-105:hover {
        transform: scale(1.03);
    }
    
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2rem;
        }
        
        .hero-description {
            font-size: 1rem;
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
                <h1 class="hero-title">{{ $waterSource->name }}</h1>
                
                <div class="hero-location">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>{{ $waterSource->location }}</span>
                </div>
                
                <!-- <p class="hero-description">
                    Informasi lengkap tentang sumber mata air {{ $waterSource->name }} yang dikelola dengan standar kualitas tinggi untuk memastikan pasokan air bersih yang berkelanjutan.
                </p> -->
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="section-padding">
        <div class="container-custom">
            <div class="max-w-7xl mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-8">
                        <!-- Photo Section -->
                        <div class="detail-card">
                            @if($waterSource->getFirstMediaUrl('water_source_images'))
                            @php
                                $mainImageUrl = $waterSource->getFirstMediaUrl('water_source_images');
                            @endphp
                            <div class="text-center mb-6">
                                <h2 class="text-2xl font-bold text-gray-800 mb-2 flex items-center justify-center">
                                    <i class="fas fa-camera mr-3 text-blue-600"></i>
                                    Foto Sumber Mata Air
                                </h2>
                                <p class="text-gray-600">{{ $waterSource->name }}</p>
                            </div>
                            
                            <div class="main-photo-container group cursor-pointer" onclick="openImageModal()">
                                <div class="relative overflow-hidden rounded-xl bg-gray-50 shadow-lg">
                                    <img src="{{ $mainImageUrl }}" 
                                         alt="{{ $waterSource->name }}" 
                                         class="w-full h-96 md:h-[500px] lg:h-[600px] object-cover transition-all duration-300 group-hover:scale-105"
                                         loading="eager"
                                         style="display: block; object-position: center;">
                                    
                                    <!-- Elegant hover overlay -->
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300">
                                        <div class="absolute bottom-6 left-6 right-6">
                                            <div class="bg-white/90 backdrop-blur-sm rounded-lg px-4 py-3 shadow-lg">
                                                <div class="flex items-center justify-between">
                                                    <div>
                                                        <h3 class="font-bold text-gray-800">{{ $waterSource->name }}</h3>
                                                        <p class="text-sm text-gray-600 flex items-center mt-1">
                                                            <i class="fas fa-map-marker-alt mr-2"></i>
                                                            {{ $waterSource->location }}
                                                        </p>
                                                    </div>
                                                    <div class="bg-blue-600 text-white rounded-full p-2">
                                                        <i class="fas fa-expand-alt"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="mt-4 text-center">
                                    <p class="text-sm text-gray-600 font-medium flex items-center justify-center">
                                        <i class="fas fa-search-plus mr-2"></i>
                                        Klik gambar untuk melihat ukuran penuh
                                    </p>
                                </div>
                            </div>
                            @else
                            <div class="text-center">
                                <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center justify-center">
                                    <i class="fas fa-camera mr-3 text-gray-400"></i>
                                    Foto Sumber Mata Air
                                </h2>
                                
                                <div class="relative overflow-hidden rounded-xl bg-gradient-to-br from-blue-100 to-blue-200 h-96 md:h-[500px] lg:h-[600px] flex items-center justify-center">
                                    <div class="text-center text-blue-600">
                                        <i class="fas fa-tint text-8xl mb-6 opacity-50"></i>
                                        <h3 class="text-2xl font-semibold mb-3 opacity-75">Foto Belum Tersedia</h3>
                                        <p class="text-lg opacity-75">Dokumentasi foto akan segera ditambahkan</p>
                                        <div class="mt-6 inline-flex items-center px-4 py-2 bg-blue-600/10 rounded-lg">
                                            <i class="fas fa-clock mr-2"></i>
                                            <span class="text-sm font-medium">Segera Hadir</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-4">
                        <!-- Details Information -->
                        <div class="bg-white rounded-lg shadow-lg border border-gray-200 sidebar-info-height">
                            <div class="p-3 bg-gradient-to-r from-blue-600 to-blue-700">
                                <h3 class="text-base font-bold text-white flex items-center">
                                    <i class="fas fa-info-circle mr-2 text-sm"></i>
                                    Informasi Detail
                                </h3>
                            </div>
                            
                            <div class="p-4 space-y-3 overflow-y-auto sidebar-content">
                                <!-- Production Capacity -->
                                <div class="detail-item">
                                    <i class="fas fa-chart-line detail-icon text-blue-600"></i>
                                    <div class="detail-content">
                                        <h4>Kapasitas Produksi</h4>
                                        <p>{{ $waterSource->formatted_production_capacity }}</p>
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="detail-item">
                                    <i class="fas fa-info-circle detail-icon text-green-600"></i>
                                    <div class="detail-content">
                                        <h4>Status</h4>
                                        <p>{{ $waterSource->status_label }}</p>
                                    </div>
                                </div>

                                <!-- Ownership -->
                                <div class="detail-item">
                                    <i class="fas fa-user-tie detail-icon text-purple-600"></i>
                                    <div class="detail-content">
                                        <h4>Kepemilikan</h4>
                                        <p>{{ $waterSource->ownership_label }}</p>
                                    </div>
                                </div>

                                <!-- Location -->
                                <div class="detail-item">
                                    <i class="fas fa-map-marker-alt detail-icon text-red-600"></i>
                                    <div class="detail-content">
                                        <h4>Lokasi</h4>
                                        <p>{{ $waterSource->location }}</p>
                                    </div>
                                </div>

                                <!-- Active Status -->
                                @if($waterSource->is_active)
                                <div class="detail-item">
                                    <i class="fas fa-check-circle detail-icon text-emerald-600"></i>
                                    <div class="detail-content">
                                        <h4>Keaktifan</h4>
                                        <p>Sumber air aktif beroperasi</p>
                                    </div>
                                </div>
                                @endif

                                <!-- Documentation Status -->
                                <div class="detail-item">
                                    @if($waterSource->getFirstMediaUrl('water_source_images'))
                                    <i class="fas fa-camera detail-icon text-indigo-600"></i>
                                    <div class="detail-content">
                                        <h4>Dokumentasi</h4>
                                        <p>Foto tersedia</p>
                                    </div>
                                    @else
                                    <i class="fas fa-camera detail-icon text-gray-400"></i>
                                    <div class="detail-content">
                                        <h4>Dokumentasi</h4>
                                        <p>Foto belum tersedia</p>
                                    </div>
                                    @endif
                                </div>

                                <!-- Distribution Area -->
                                @if($waterSource->distribution_area)
                                <div class="detail-item border-t border-gray-100 pt-3">
                                    <i class="fas fa-map detail-icon text-indigo-600"></i>
                                    <div class="detail-content">
                                        <h4>Wilayah Distribusi</h4>
                                        <p>{{ $waterSource->distribution_area }}</p>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Image Modal -->
                @if($waterSource->getFirstMediaUrl('water_source_images'))
                @php
                    $modalImageUrl = $waterSource->getFirstMediaUrl('water_source_images');
                @endphp
                <div id="imageModal" class="fixed inset-0 bg-black/90 backdrop-blur-sm z-50 hidden items-center justify-center p-4" onclick="closeImageModal(event)">
                    <div class="relative max-w-7xl w-full h-full flex items-center justify-center">
                        <!-- Main image container -->
                        <div class="relative max-w-full max-h-full bg-white/5 rounded-xl overflow-hidden shadow-2xl" onclick="event.stopPropagation()">
                            <img src="{{ $modalImageUrl }}" 
                                 alt="{{ $waterSource->name }}" 
                                 class="max-w-full max-h-[85vh] w-auto h-auto object-contain block mx-auto"
                                 loading="eager">
                        </div>
                        
                        <!-- Close button -->
                        <button onclick="closeImageModal()" 
                                class="absolute top-6 right-6 bg-black/30 hover:bg-black/50 text-white p-3 rounded-full transition-all duration-300 backdrop-blur-sm border border-white/20 hover:border-white/40">
                            <i class="fas fa-times text-lg"></i>
                        </button>
                        
                        <!-- Image info panel -->
                        <div class="absolute bottom-6 left-6 right-6 bg-black/40 backdrop-blur-md text-white p-4 rounded-lg border border-white/20">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-lg font-bold mb-1">{{ $waterSource->name }}</h3>
                                    <p class="text-sm opacity-90 flex items-center">
                                        <i class="fas fa-map-marker-alt mr-2"></i>
                                        {{ $waterSource->location }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="text-sm opacity-75">Kapasitas Produksi</p>
                                    <p class="font-semibold">{{ $waterSource->formatted_production_capacity }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Navigation hint -->
                        <div class="absolute top-6 left-6 bg-black/30 backdrop-blur-sm text-white px-3 py-2 rounded-lg text-sm border border-white/20">
                            <i class="fas fa-info-circle mr-2"></i>
                            Tekan ESC atau klik di luar gambar untuk menutup
                        </div>
                    </div>
                </div>
                @endif
            </div>
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

    // Back to top functionality
    const backToTopBtn = document.getElementById('backToTop');
    if (backToTopBtn) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 300) {
                backToTopBtn.classList.remove('opacity-0', 'invisible');
                backToTopBtn.classList.add('opacity-100', 'visible');
            } else {
                backToTopBtn.classList.add('opacity-0', 'invisible');
                backToTopBtn.classList.remove('opacity-100', 'visible');
            }
        });

        backToTopBtn.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }
</script>
@endpush
@endsection

@push('scripts')
<script>
function openImageModal() {
    const modal = document.getElementById('imageModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
        
        // Add fade in animation
        modal.style.opacity = '0';
        setTimeout(() => {
            modal.style.opacity = '1';
            modal.style.transition = 'opacity 0.3s ease';
        }, 10);
    }
}

function closeImageModal(event) {
    // Prevent closing when clicking on the image itself
    if (event && event.target.tagName === 'IMG') {
        return;
    }
    
    const modal = document.getElementById('imageModal');
    if (modal) {
        modal.style.opacity = '0';
        modal.style.transition = 'opacity 0.3s ease';
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }, 300);
    }
}

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});

// Prevent scroll when modal is open
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('imageModal');
    if (modal) {
        modal.addEventListener('wheel', function(e) {
            e.preventDefault();
        }, { passive: false });
    }
    
    // Preload image for better performance
    const sidebarImage = document.querySelector('.sidebar-photo-container img');
    if (sidebarImage) {
        const img = new Image();
        img.src = sidebarImage.src;
    }
});
</script>
@endpush
