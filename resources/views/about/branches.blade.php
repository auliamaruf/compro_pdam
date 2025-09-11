@extends('layouts.app')

@section('title', 'Cabang - ' . (($company && $company->company_name && is_string($company->company_name)) ? $company->company_name : 'Tirta Perwira'))
@section('description', 'Informasi lengkap tentang cabang-cabang ' . (($company && $company->company_name && is_string($company->company_name)) ? $company->company_name : 'PDAM Tirta Perwira') . ' untuk melayani masyarakat dengan lebih baik')

@push('styles')
<style>
    .branches-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }
    
    .branch-card {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.5s ease-out;
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        border-left: 4px solid #3b82f6;
        height: fit-content;
    }
    
    .branch-card.animate {
        opacity: 1;
        transform: translateY(0);
    }
    
    .branch-card:hover {
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }
    
    .branch-header {
        display: flex;
        align-items: center;
        margin-bottom: 1rem;
    }
    
    .branch-icon {
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
    
    .branch-info {
        flex: 1;
        min-width: 0;
    }
    
    .branch-name {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.25rem;
        line-height: 1.2;
    }
    
    .branch-code {
        color: #6b7280;
        font-weight: 500;
        font-size: 0.875rem;
    }
    
    .branch-head {
        background: #f8fafc;
        border-radius: 6px;
        padding: 0.75rem;
        margin-bottom: 1rem;
        border-left: 3px solid #10b981;
    }
    
    .head-title {
        font-size: 0.75rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.25rem;
    }
    
    .head-name {
        font-size: 1rem;
        font-weight: 600;
        color: #1f2937;
        line-height: 1.2;
    }
    
    .branch-details {
        space-y: 1rem;
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
    
    .services-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }
    
    .service-tag {
        background: #eff6ff;
        color: #1e40af;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    .office-hours {
        background: #f1f5f9;
        border-radius: 8px;
        padding: 1rem;
        margin-top: 1rem;
    }
    
    .hours-title {
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .hours-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 0.5rem;
    }
    
    .hour-item {
        display: flex;
        justify-content: space-between;
        font-size: 0.875rem;
    }
    
    .hour-day {
        font-weight: 500;
        color: #374151;
    }
    
    .hour-time {
        color: #6b7280;
    }
    
    .map-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #3b82f6;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.875rem;
        transition: color 0.3s ease;
    }
    
    .map-link:hover {
        color: #1d4ed8;
    }
    
    @media (max-width: 768px) {        
        .branch-header {
            flex-direction: column;
            text-align: center;
        }
        
        .branch-icon {
            margin-right: 0;
            margin-bottom: 1rem;
        }
        
        .branch-details {
            grid-template-columns: 1fr;
        }
        
        .hours-list {
            grid-template-columns: 1fr;
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
                <h1 class="hero-title">Cabang & Unit IKK</h1>
                <p class="hero-description">
                    {{ (($company && $company->company_name && is_string($company->company_name)) ? $company->company_name : 'PDAM Tirta Perwira') }} memiliki cabang dan Unit IKK strategis untuk melayani masyarakat dengan lebih baik dan mudah dijangkau
                </p>
            </div>
        </div>
    </section>

<!-- Branches & Unit IKK Content -->
<section class="section-padding">
    <div class="container-custom">
        <!-- Cabang Section -->
        @if($branches->count() > 0)
            <div class="max-w-7xl mx-auto mb-16">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Cabang Kami</h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Cabang-cabang utama {{ (($company && $company->company_name && is_string($company->company_name)) ? $company->company_name : 'PDAM Tirta Perwira') }} yang tersebar strategis di wilayah {{ (($company && $company->address && is_string($company->address) && Str::contains($company->address, 'Purbalingga')) ? 'Purbalingga' : (($company && $company->address && is_string($company->address)) ? last(explode(',', $company->address)) : 'Purbalingga')) }} untuk kemudahan akses pelayanan.
                    </p>
                </div>
                
                <div class="branches-grid">
                    @foreach($branches as $index => $branch)
                    <div class="branch-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <!-- Branch Header -->
                        <div class="branch-header">
                            <div class="branch-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="branch-info">
                                <h3 class="branch-name">{{ $branch->name }}</h3>
                                <!-- <p class="branch-code">{{ $branch->code }}</p> -->
                            </div>
                        </div>

                        <!-- Kepala Cabang -->
                        @if($branch->headOfBranch)
                        <div class="branch-head">
                            <div class="head-title">Kepala Cabang</div>
                            <div class="head-name">{{ $branch->headOfBranch->name }}</div>
                        </div>
                        @endif

                        <!-- Branch Details -->
                        <div class="branch-details">
                            <!-- Address -->
                            <div class="detail-item">
                                <i class="fas fa-map-marker-alt detail-icon text-blue-600"></i>
                                <div class="detail-content">
                                    <h4 class="font-semibold text-gray-800 mb-1">Alamat</h4>
                                    <p class="text-gray-600 text-sm leading-relaxed">{{ $branch->address }}</p>
                                    @if($branch->google_maps_url)
                                        <a href="{{ $branch->google_maps_url }}" target="_blank" class="text-blue-600 hover:text-blue-800 text-sm font-medium mt-1 inline-flex items-center">
                                            <i class="fas fa-external-link-alt mr-1"></i>
                                            Lihat di Google Maps
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Contact -->
                            @if($branch->phone || $branch->email)
                            <div class="detail-item">
                                <i class="fas fa-phone detail-icon text-green-600"></i>
                                <div class="detail-content">
                                    <h4 class="font-semibold text-gray-800 mb-1">Kontak</h4>
                                    @if($branch->phone)
                                        <p class="text-gray-600 text-sm"><strong>Telepon:</strong> {{ $branch->phone }}</p>
                                    @endif
                                    @if($branch->email)
                                        <p class="text-gray-600 text-sm"><strong>Email:</strong> {{ $branch->email }}</p>
                                    @endif
                                </div>
                            </div>
                            @endif

                            <!-- Office Hours -->
                            @if($branch->office_hours_weekday || $branch->office_hours_friday || $branch->office_hours_saturday || $branch->office_hours_sunday)
                            <div class="detail-item">
                                <i class="fas fa-clock detail-icon text-purple-600"></i>
                                <div class="detail-content">
                                    <h4 class="font-semibold text-gray-800 mb-1">Jam Operasional</h4>
                                    <div class="space-y-1">
                                        @if($branch->office_hours_weekday)
                                            <div class="text-sm">
                                                <span class="text-gray-600 font-medium">Senin - Kamis:</span>
                                                <span class="text-gray-600">{{ $branch->office_hours_weekday }}</span>
                                            </div>
                                        @endif
                                        @if($branch->office_hours_friday)
                                            <div class="text-sm">
                                                <span class="text-gray-600 font-medium">Jumat:</span>
                                                <span class="text-gray-600">{{ $branch->office_hours_friday }}</span>
                                            </div>
                                        @endif
                                        @if($branch->office_hours_saturday)
                                            <div class="text-sm">
                                                <span class="text-gray-600 font-medium">Sabtu:</span>
                                                <span class="text-gray-600">{{ $branch->office_hours_saturday }}</span>
                                            </div>
                                        @endif
                                        @if($branch->office_hours_sunday)
                                            <div class="text-sm">
                                                <span class="text-gray-600 font-medium">Minggu:</span>
                                                <span class="text-gray-600">{{ $branch->office_hours_sunday }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Services -->
                            @if($branch->services && count($branch->services) > 0)
                            <div class="detail-item">
                                <i class="fas fa-cogs detail-icon text-indigo-600"></i>
                                <div class="detail-content">
                                    <h4 class="font-semibold text-gray-800 mb-1">Layanan</h4>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach(array_slice($branch->services, 0, 3) as $service)
                                            <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">{{ $service }}</span>
                                        @endforeach
                                        @if(count($branch->services) > 3)
                                            <span class="text-xs text-gray-500">+{{ count($branch->services) - 3 }} lainnya</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Unit IKK Section -->
        @if($unitIkk->count() > 0)
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Unit IKK</h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Unit Ibukota Kecamatan (IKK) yang melayani wilayah-wilayah strategis dengan fokus distribusi air bersih dan pelayanan masyarakat.
                    </p>
                </div>
                
                <div class="branches-grid">
                    @foreach($unitIkk as $index => $unit)
                    <div class="branch-card" data-aos="fade-up" data-aos-delay="{{ ($branches->count() + $index) * 100 }}" style="border-left-color: #10b981;">
                        <!-- Unit Header -->
                        <div class="branch-header">
                            <div class="branch-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                                <i class="fas fa-industry"></i>
                            </div>
                            <div class="branch-info">
                                <h3 class="branch-name">{{ $unit->name }}</h3>
                                <!-- <p class="branch-code">{{ $unit->code }}</p> -->
                            </div>
                        </div>

                        <!-- Kepala Unit IKK -->
                        @if($unit->headOfBranch)
                        <div class="branch-head" style="border-left-color: #10b981;">
                            <div class="head-title">Kepala Unit IKK</div>
                            <div class="head-name">{{ $unit->headOfBranch->name }}</div>
                        </div>
                        @endif

                        <!-- Unit Details -->
                        <div class="branch-details">
                            <!-- Address -->
                            <div class="detail-item">
                                <i class="fas fa-map-marker-alt detail-icon text-green-600"></i>
                                <div class="detail-content">
                                    <h4 class="font-semibold text-gray-800 mb-1">Alamat</h4>
                                    <p class="text-gray-600 text-sm leading-relaxed">{{ $unit->address }}</p>
                                    @if($unit->google_maps_url)
                                        <a href="{{ $unit->google_maps_url }}" target="_blank" class="text-green-600 hover:text-green-800 text-sm font-medium mt-1 inline-flex items-center">
                                            <i class="fas fa-external-link-alt mr-1"></i>
                                            Lihat di Google Maps
                                        </a>
                                    @endif
                                </div>
                            </div>

                            <!-- Contact -->
                            @if($unit->phone || $unit->email)
                            <div class="detail-item">
                                <i class="fas fa-phone detail-icon text-green-600"></i>
                                <div class="detail-content">
                                    <h4 class="font-semibold text-gray-800 mb-1">Kontak</h4>
                                    @if($unit->phone)
                                        <p class="text-gray-600 text-sm"><strong>Telepon:</strong> {{ $unit->phone }}</p>
                                    @endif
                                    @if($unit->email)
                                        <p class="text-gray-600 text-sm"><strong>Email:</strong> {{ $unit->email }}</p>
                                    @endif
                                </div>
                            </div>
                            @endif

                            <!-- Office Hours -->
                            @if($unit->office_hours_weekday || $unit->office_hours_friday || $unit->office_hours_saturday || $unit->office_hours_sunday)
                            <div class="detail-item">
                                <i class="fas fa-clock detail-icon text-green-600"></i>
                                <div class="detail-content">
                                    <h4 class="font-semibold text-gray-800 mb-1">Jam Operasional</h4>
                                    <div class="space-y-1">
                                        @if($unit->office_hours_weekday)
                                            <div class="text-sm">
                                                <span class="text-gray-600 font-medium">Senin - Kamis:</span>
                                                <span class="text-gray-600">{{ $unit->office_hours_weekday }}</span>
                                            </div>
                                        @endif
                                        @if($unit->office_hours_friday)
                                            <div class="text-sm">
                                                <span class="text-gray-600 font-medium">Jumat:</span>
                                                <span class="text-gray-600">{{ $unit->office_hours_friday }}</span>
                                            </div>
                                        @endif
                                        @if($unit->office_hours_saturday)
                                            <div class="text-sm">
                                                <span class="text-gray-600 font-medium">Sabtu:</span>
                                                <span class="text-gray-600">{{ $unit->office_hours_saturday }}</span>
                                            </div>
                                        @endif
                                        @if($unit->office_hours_sunday)
                                            <div class="text-sm">
                                                <span class="text-gray-600 font-medium">Minggu:</span>
                                                <span class="text-gray-600">{{ $unit->office_hours_sunday }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Coverage Areas -->
                            @if($unit->coverage_areas && count($unit->coverage_areas) > 0)
                            <div class="detail-item">
                                <i class="fas fa-map detail-icon text-green-600"></i>
                                <div class="detail-content">
                                    <h4 class="font-semibold text-gray-800 mb-1">Area Cakupan</h4>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach(array_slice($unit->coverage_areas, 0, 2) as $area)
                                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">{{ $area }}</span>
                                        @endforeach
                                        @if(count($unit->coverage_areas) > 2)
                                            <span class="text-xs text-gray-500">+{{ count($unit->coverage_areas) - 2 }} lainnya</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif

                            <!-- Services -->
                            @if($unit->services && count($unit->services) > 0)
                            <div class="detail-item">
                                <i class="fas fa-cogs detail-icon text-green-600"></i>
                                <div class="detail-content">
                                    <h4 class="font-semibold text-gray-800 mb-1">Layanan</h4>
                                    <div class="flex flex-wrap gap-1">
                                        @foreach(array_slice($unit->services, 0, 3) as $service)
                                            <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">{{ $service }}</span>
                                        @endforeach
                                        @if(count($unit->services) > 3)
                                            <span class="text-xs text-gray-500">+{{ count($unit->services) - 3 }} lainnya</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- No Data State -->
        @if($branches->count() == 0 && $unitIkk->count() == 0)
            <div class="text-center py-16">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-building text-6xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Data Cabang & Unit IKK</h3>
                <p class="text-gray-500">Informasi cabang dan unit IKK akan segera tersedia.</p>
            </div>
        @endif
    </div>
</section>

<!-- Contact CTA -->
<!-- <section class="bg-gradient-to-r from-blue-600 to-blue-700 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl font-bold mb-4">Butuh Bantuan Lebih Lanjut?</h2>
        <p class="text-xl mb-8 opacity-90">
            Tim customer service kami siap membantu Anda di kantor pusat atau cabang terdekat
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('contact') }}" class="bg-white text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                Hubungi Kami
            </a>
            <a href="{{ route('services') }}" class="border-2 border-white text-white px-8 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600 transition-colors">
                Lihat Layanan
            </a>
        </div>
    </div>
</section> -->
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Animate branch cards on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, observerOptions);

    document.querySelectorAll('.branch-card').forEach(function(card) {
        observer.observe(card);
    });
});
</script>
@endpush
