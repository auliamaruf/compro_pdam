@extends('layouts.app')

@section('title', 'Cabang - Tirta Perwira')
@section('description', 'Informasi lengkap tentang cabang-cabang PDAM Tirta Perwira Purbalingga untuk melayani masyarakat dengan lebih baik')

@push('styles')
<style>
    .branch-card {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.5s ease-out;
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        border-left: 4px solid #3b82f6;
        margin-bottom: 2rem;
    }
    
    .branch-card.animate {
        opacity: 1;
        transform: translateY(0);
    }
    
    .branch-card:hover {
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        transform: translateY(-4px);
    }
    
    .branch-header {
        display: flex;
        align-items: center;
        margin-bottom: 1.5rem;
    }
    
    .branch-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        margin-right: 1rem;
    }
    
    .branch-info {
        flex: 1;
    }
    
    .branch-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.25rem;
    }
    
    .branch-code {
        color: #6b7280;
        font-weight: 500;
    }
    
    .branch-head {
        background: #f8fafc;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        border-left: 3px solid #10b981;
    }
    
    .head-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.25rem;
    }
    
    .head-name {
        font-size: 1.125rem;
        font-weight: 600;
        color: #1f2937;
    }
    
    .branch-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .detail-item {
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
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
    
    .page-header {
        background: linear-gradient(135deg, #1e40af 0%, #3b82f6 100%);
        color: white;
        padding: 4rem 0;
        margin-bottom: 3rem;
    }
    
    .header-content {
        text-align: center;
    }
    
    .page-title {
        font-size: 3rem;
        font-weight: 700;
        margin-bottom: 1rem;
    }
    
    .page-subtitle {
        font-size: 1.25rem;
        opacity: 0.9;
        max-width: 600px;
        margin: 0 auto;
    }

    @media (max-width: 768px) {
        .page-title {
            font-size: 2rem;
        }
        
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
<!-- Page Header -->
<section class="page-header">
    <div class="container mx-auto px-4">
        <div class="header-content">
            <h1 class="page-title">Cabang & Unit IKK</h1>
            <p class="page-subtitle">
                PDAM Tirta Perwira memiliki cabang dan Unit IKK strategis untuk melayani masyarakat Purbalingga dengan lebih baik dan mudah dijangkau
            </p>
        </div>
    </div>
</section>

<!-- Branches & Unit IKK Content -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <!-- Cabang Section -->
        @if($branches->count() > 0)
            <div class="max-w-6xl mx-auto mb-16">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Cabang Kami</h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Cabang-cabang utama PDAM Tirta Perwira yang tersebar strategis di wilayah Purbalingga untuk kemudahan akses pelayanan.
                    </p>
                </div>
                
                @foreach($branches as $index => $branch)
                <div class="branch-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                    <!-- Branch Header -->
                    <div class="branch-header">
                        <div class="branch-icon">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="branch-info">
                            <h3 class="branch-name">{{ $branch->name }}</h3>
                            <p class="branch-code">{{ $branch->code }}</p>
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
                            <i class="fas fa-map-marker-alt detail-icon"></i>
                            <div class="detail-content">
                                <h4>Alamat</h4>
                                <p>{{ $branch->address }}</p>
                                @if($branch->latitude && $branch->longitude)
                                    <a href="{{ $branch->google_maps_url }}" target="_blank" class="map-link">
                                        <i class="fas fa-external-link-alt"></i>
                                        Lihat di Google Maps
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Contact -->
                        @if($branch->phone || $branch->email)
                        <div class="detail-item">
                            <i class="fas fa-phone detail-icon"></i>
                            <div class="detail-content">
                                <h4>Kontak</h4>
                                @if($branch->phone)
                                    <p><strong>Telepon:</strong> {{ $branch->phone }}</p>
                                @endif
                                @if($branch->email)
                                    <p><strong>Email:</strong> {{ $branch->email }}</p>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Coverage Areas -->
                        @if($branch->coverage_areas && count($branch->coverage_areas) > 0)
                        <div class="detail-item">
                            <i class="fas fa-map detail-icon"></i>
                            <div class="detail-content">
                                <h4>Area Cakupan</h4>
                                <p>{{ implode(', ', $branch->coverage_areas) }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Description -->
                    @if($branch->description)
                    <div class="mb-6">
                        <p class="text-gray-600 leading-relaxed">{{ $branch->description }}</p>
                    </div>
                    @endif

                    <!-- Services -->
                    @if($branch->services && count($branch->services) > 0)
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-800 mb-3">Layanan Tersedia:</h4>
                        <div class="services-tags">
                            @foreach($branch->services as $service)
                                <span class="service-tag">{{ $service }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Office Hours -->
                    @if($branch->office_hours && count($branch->office_hours) > 0)
                    <div class="office-hours">
                        <h4 class="hours-title">
                            <i class="fas fa-clock"></i>
                            Jam Operasional
                        </h4>
                        <div class="hours-list">
                            @foreach($branch->office_hours as $hour)
                                @php
                                    $dayNames = [
                                        'monday' => 'Senin',
                                        'tuesday' => 'Selasa',
                                        'wednesday' => 'Rabu',
                                        'thursday' => 'Kamis',
                                        'friday' => 'Jumat',
                                        'saturday' => 'Sabtu',
                                        'sunday' => 'Minggu',
                                    ];
                                @endphp
                                <div class="hour-item">
                                    <span class="hour-day">{{ $dayNames[$hour['day']] ?? $hour['day'] }}</span>
                                    <span class="hour-time">{{ substr($hour['open'], 0, 5) }} - {{ substr($hour['close'], 0, 5) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        @endif

        <!-- Unit IKK Section -->
        @if($unitIkk->count() > 0)
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Unit IKK</h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Unit Instalasi Kapasitas Kecil (IKK) yang melayani wilayah-wilayah strategis dengan fokus distribusi air bersih dan pelayanan masyarakat.
                    </p>
                </div>
                
                @foreach($unitIkk as $index => $unit)
                <div class="branch-card" data-aos="fade-up" data-aos-delay="{{ ($branches->count() + $index) * 100 }}">
                    <!-- Unit Header -->
                    <div class="branch-header">
                        <div class="branch-icon" style="background: linear-gradient(135deg, #10b981, #059669);">
                            <i class="fas fa-industry"></i>
                        </div>
                        <div class="branch-info">
                            <h3 class="branch-name">{{ $unit->name }}</h3>
                            <p class="branch-code">{{ $unit->code }}</p>
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
                            <i class="fas fa-map-marker-alt detail-icon" style="color: #10b981;"></i>
                            <div class="detail-content">
                                <h4>Alamat</h4>
                                <p>{{ $unit->address }}</p>
                                @if($unit->latitude && $unit->longitude)
                                    <a href="{{ $unit->google_maps_url }}" target="_blank" class="map-link" style="color: #10b981;">
                                        <i class="fas fa-external-link-alt"></i>
                                        Lihat di Google Maps
                                    </a>
                                @endif
                            </div>
                        </div>

                        <!-- Contact -->
                        @if($unit->phone || $unit->email)
                        <div class="detail-item">
                            <i class="fas fa-phone detail-icon" style="color: #10b981;"></i>
                            <div class="detail-content">
                                <h4>Kontak</h4>
                                @if($unit->phone)
                                    <p><strong>Telepon:</strong> {{ $unit->phone }}</p>
                                @endif
                                @if($unit->email)
                                    <p><strong>Email:</strong> {{ $unit->email }}</p>
                                @endif
                            </div>
                        </div>
                        @endif

                        <!-- Coverage Areas -->
                        @if($unit->coverage_areas && count($unit->coverage_areas) > 0)
                        <div class="detail-item">
                            <i class="fas fa-map detail-icon" style="color: #10b981;"></i>
                            <div class="detail-content">
                                <h4>Area Cakupan</h4>
                                <p>{{ implode(', ', $unit->coverage_areas) }}</p>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Description -->
                    @if($unit->description)
                    <div class="mb-6">
                        <p class="text-gray-600 leading-relaxed">{{ $unit->description }}</p>
                    </div>
                    @endif

                    <!-- Services -->
                    @if($unit->services && count($unit->services) > 0)
                    <div class="mb-6">
                        <h4 class="font-semibold text-gray-800 mb-3">Layanan Tersedia:</h4>
                        <div class="services-tags">
                            @foreach($unit->services as $service)
                                <span class="service-tag" style="background: #d1fae5; color: #065f46;">{{ $service }}</span>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Office Hours -->
                    @if($unit->office_hours && count($unit->office_hours) > 0)
                    <div class="office-hours">
                        <h4 class="hours-title">
                            <i class="fas fa-clock"></i>
                            Jam Operasional
                        </h4>
                        <div class="hours-list">
                            @foreach($unit->office_hours as $hour)
                                @php
                                    $dayNames = [
                                        'monday' => 'Senin',
                                        'tuesday' => 'Selasa',
                                        'wednesday' => 'Rabu',
                                        'thursday' => 'Kamis',
                                        'friday' => 'Jumat',
                                        'saturday' => 'Sabtu',
                                        'sunday' => 'Minggu',
                                    ];
                                @endphp
                                <div class="hour-item">
                                    <span class="hour-day">{{ $dayNames[$hour['day']] ?? $hour['day'] }}</span>
                                    <span class="hour-time">{{ substr($hour['open'], 0, 5) }} - {{ substr($hour['close'], 0, 5) }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
                @endforeach
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
<section class="bg-gradient-to-r from-blue-600 to-blue-700 text-white py-16">
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
</section>
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
