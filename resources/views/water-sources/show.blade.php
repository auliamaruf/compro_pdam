@extends('layouts.app')

@section('title', $waterSource->name . ' - Sumber Mata Air - ' . (($company && $company->company_name && is_string($company->company_name)) ? $company->company_name : 'Tirta Perwira'))
@section('description', 'Detail lengkap tentang ' . $waterSource->name . ' - sumber mata air yang dikelola ' . (($company && $company->company_name && is_string($company->company_name)) ? $company->company_name : 'PDAM Tirta Perwira'))

@push('styles')
<style>
    .hero-section {
        position: relative;
        background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #1e40af 100%);
        color: white;
        padding: 4rem 0 5rem 0;
        min-height: 50vh;
        display: flex;
        align-items: center;
        overflow: hidden;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.15);
        backdrop-filter: blur(1px);
    }

    .hero-content {
        position: relative;
        z-index: 10;
        text-align: center;
        width: 100%;
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
                
                <p class="hero-description">
                    Informasi lengkap tentang sumber mata air {{ $waterSource->name }} yang dikelola dengan standar kualitas tinggi untuk memastikan pasokan air bersih yang berkelanjutan.
                </p>
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
                        <!-- Image Section -->
                        @if($waterSource->getFirstMediaUrl('water_source_images'))
                        <div class="detail-card">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center">
                                <i class="fas fa-camera mr-3 text-blue-600"></i>
                                Foto Sumber Mata Air
                            </h2>
                            <div class="relative overflow-hidden rounded-lg group cursor-pointer" onclick="openImageModal()">
                                <img src="{{ $waterSource->getFirstMediaUrl('water_source_images') }}" 
                                     alt="{{ $waterSource->name }}" 
                                     class="w-full h-64 md:h-96 object-cover transition-transform duration-300 group-hover:scale-105">
                                <!-- Overlay for zoom hint -->
                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-300 flex items-center justify-center">
                                    <div class="bg-white bg-opacity-90 rounded-full p-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <i class="fas fa-search-plus text-gray-700 text-lg"></i>
                                    </div>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600 mt-3 text-center">
                                <i class="fas fa-info-circle mr-1"></i>
                                Klik gambar untuk melihat ukuran penuh
                            </p>
                        </div>

                        <!-- Image Modal -->
                        <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden items-center justify-center p-4" onclick="closeImageModal()">
                            <div class="relative max-w-4xl max-h-full">
                                <img src="{{ $waterSource->getFirstMediaUrl('water_source_images') }}" 
                                     alt="{{ $waterSource->name }}" 
                                     class="max-w-full max-h-full object-contain rounded-lg">
                                <button onclick="closeImageModal()" class="absolute top-4 right-4 bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-2 rounded-full transition-all">
                                    <i class="fas fa-times text-xl"></i>
                                </button>
                            </div>
                        </div>
                        @endif

                        <!-- Details Section -->
                        <div class="detail-card">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">Informasi Detail</h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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

                                @if($waterSource->getFirstMediaUrl('water_source_images'))
                                <!-- Photo Available -->
                                <div class="detail-item">
                                    <i class="fas fa-camera detail-icon text-indigo-600"></i>
                                    <div class="detail-content">
                                        <h4>Dokumentasi</h4>
                                        <p>Foto sumber mata air tersedia</p>
                                    </div>
                                </div>
                                @endif

                                @if($waterSource->is_active)
                                <!-- Active Status -->
                                <div class="detail-item">
                                    <i class="fas fa-check-circle detail-icon text-emerald-600"></i>
                                    <div class="detail-content">
                                        <h4>Keaktifan</h4>
                                        <p>Sumber air aktif beroperasi</p>
                                    </div>
                                </div>
                                @endif
                            </div>

                            <!-- Distribution Area -->
                            @if($waterSource->distribution_area)
                            <div class="mt-6 pt-6 border-t border-gray-100">
                                <div class="detail-item">
                                    <i class="fas fa-map detail-icon text-indigo-600"></i>
                                    <div class="detail-content">
                                        <h4>Wilayah Distribusi</h4>
                                        <p>{{ $waterSource->distribution_area }}</p>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <!-- Back Button -->
                        <div class="detail-card">
                            <a href="{{ route('water-sources.index') }}" 
                               class="inline-flex items-center justify-center w-full bg-gray-600 hover:bg-gray-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                                <i class="fas fa-arrow-left mr-2"></i>
                                Kembali ke Daftar
                            </a>
                        </div>

                        <!-- Status & Documentation Card -->
                        <div class="bg-white rounded-lg shadow-lg p-6 border border-gray-200">
                            <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-200">
                                <i class="fas fa-chart-line text-green-600 mr-2"></i>
                                Status & Dokumentasi
                            </h3>
                            
                            <div class="space-y-4">
                                <!-- Status Operasional -->
                                <div class="text-center">
                                    @if($waterSource->is_active)
                                    <div class="inline-flex items-center px-4 py-2 bg-green-100 text-green-800 rounded-full">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        <span class="font-medium">Aktif</span>
                                    </div>
                                    @else
                                    <div class="inline-flex items-center px-4 py-2 bg-red-100 text-red-800 rounded-full">
                                        <i class="fas fa-exclamation-circle mr-2"></i>
                                        <span class="font-medium">Tidak Aktif</span>
                                    </div>
                                    @endif
                                </div>

                                <!-- Dokumentasi -->
                                <div class="pt-3 border-t border-gray-100">
                                    <div class="text-center">
                                        @if($waterSource->getFirstMediaUrl('water_source_images'))
                                        <div class="flex items-center justify-center text-green-600 mb-2">
                                            <i class="fas fa-camera mr-2"></i>
                                            <span class="font-medium">Foto Tersedia</span>
                                        </div>
                                        <p class="text-sm text-gray-600">Klik pada gambar untuk melihat detail</p>
                                        @else
                                        <div class="flex items-center justify-center text-gray-400 mb-2">
                                            <i class="fas fa-camera mr-2"></i>
                                            <span class="font-medium">Foto Belum Tersedia</span>
                                        </div>
                                        <p class="text-sm text-gray-600">Dokumentasi akan segera ditambahkan</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
    document.getElementById('imageModal').classList.remove('hidden');
    document.getElementById('imageModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.getElementById('imageModal').classList.remove('flex');
    document.body.style.overflow = 'auto';
}

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImageModal();
    }
});
</script>
@endpush
