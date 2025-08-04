@extends('layouts.app')

@section('title', 'Tarif Air & Biaya Tetap - Tirta Perwira PDAM Purbalingga')
@section('description', 'Informasi lengkap tarif air minum dan biaya tetap berdasarkan kategori pelanggan dan volume pemakaian di PDAM Tirta Perwira Purbalingga')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content container-custom">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="hero-title">Tarif Air & Biaya Tetap</h1>
                <p class="hero-description">
                    Informasi lengkap tarif air minum dan biaya tetap berdasarkan kategori pelanggan
                </p>
            </div>
        </div>
    </section>

    <!-- Tariff Content -->
    <section class="section-padding">
        <div class="container-custom">
            <div class="max-w-6xl mx-auto">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <!-- Tab Navigation -->
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex" aria-label="Tabs">
                            <button type="button" 
                                    class="tab-button active w-1/2 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none transition-colors duration-200"
                                    onclick="switchTab('tariff')"
                                    id="tariff-tab">
                                <div class="flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    <span>Tarif Air per m³</span>
                                </div>
                            </button>
                            <button type="button" 
                                    class="tab-button w-1/2 py-4 px-6 text-center border-b-2 font-medium text-sm focus:outline-none transition-colors duration-200"
                                    onclick="switchTab('fixed-cost')"
                                    id="fixed-cost-tab">
                                <div class="flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                    <span>Biaya Tetap</span>
                                </div>
                            </button>
                        </nav>
                    </div>

                    <!-- Tab Content -->
                    <div class="p-6 lg:p-8">
                        <!-- Tariff Tab Content -->
                        <div id="tariff-content" class="tab-content">
                            <div class="mb-6">
                                <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">Tarif Air per m³</h2>
                                <p class="text-gray-600">Tarif air berdasarkan kategori pelanggan dan volume pemakaian bulanan</p>
                            </div>

                            @if(isset($tariffs) && $tariffs->count() > 0)
                                <div class="space-y-6">
                                    @php
                                        $groupedTariffs = $tariffs->groupBy('customer_type');
                                    @endphp
                                    
                                    @foreach($groupedTariffs as $customerType => $customerTariffs)
                                        <div class="bg-gray-50 rounded-lg p-6">
                                            <h3 class="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                                                <span class="w-2 h-8 bg-blue-600 rounded-full mr-3"></span>
                                                {{ $customerType }}
                                            </h3>
                                            
                                            <div class="overflow-x-auto">
                                                <table class="min-w-full divide-y divide-gray-200">
                                                    <thead>
                                                        <tr class="bg-white">
                                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Volume Pemakaian</th>
                                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarif per m³</th>
                                                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="bg-white divide-y divide-gray-200">
                                                        @foreach($customerTariffs as $tariff)
                                                            <tr class="hover:bg-gray-50 transition-colors">
                                                                <td class="px-4 py-4 whitespace-nowrap">
                                                                    <div class="text-sm font-medium text-gray-900">
                                                                        @if($tariff->max_usage)
                                                                            {{ number_format($tariff->min_usage) }} - {{ number_format($tariff->max_usage) }} m³
                                                                        @else
                                                                            > {{ number_format($tariff->min_usage) }} m³
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                                <td class="px-4 py-4 whitespace-nowrap">
                                                                    <div class="text-sm font-semibold text-blue-600">
                                                                        Rp {{ number_format($tariff->rate_per_m3, 0, ',', '.') }}
                                                                    </div>
                                                                </td>
                                                                <td class="px-4 py-4">
                                                                    <div class="text-sm text-gray-500">
                                                                        {{ $tariff->description ?? '-' }}
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Tarif Akan Segera Tersedia</h3>
                                    <p class="text-gray-600">Informasi tarif air sedang dipersiapkan untuk Anda.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Fixed Cost Tab Content -->
                        <div id="fixed-cost-content" class="tab-content hidden">
                            <div class="mb-6">
                                <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">Biaya Tetap</h2>
                                <p class="text-gray-600">Biaya tetap berdasarkan kategori pelanggan dan jenis sambungan</p>
                            </div>

                            @if(isset($fixedCosts) && $fixedCosts->count() > 0)
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    @foreach($fixedCosts as $fixedCost)
                                        <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg p-6 border border-blue-100 hover:shadow-lg transition-all duration-300">
                                            <div class="flex items-start justify-between mb-4">
                                                <div>
                                                    <h3 class="text-xl font-semibold text-gray-900 mb-1">{{ $fixedCost->category_name }}</h3>
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                        {{ $fixedCost->connection_type === 'new' ? 'bg-green-100 text-green-800' : ($fixedCost->connection_type === 'upgrade' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                                                        {{ $fixedCost->connection_type === 'new' ? 'Sambungan Baru' : ($fixedCost->connection_type === 'upgrade' ? 'Upgrade' : 'Penggantian') }}
                                                    </span>
                                                </div>
                                                @if($fixedCost->meter_size)
                                                    <div class="text-right">
                                                        <span class="text-sm text-gray-500">Meter</span>
                                                        <div class="text-sm font-medium text-gray-900">{{ $fixedCost->meter_size }}</div>
                                                    </div>
                                                @endif
                                            </div>

                                            @if($fixedCost->description)
                                                <p class="text-gray-600 text-sm mb-4">{{ $fixedCost->description }}</p>
                                            @endif

                                            <div class="space-y-3">
                                                <div class="flex justify-between items-center py-2 border-b border-blue-200">
                                                    <span class="text-sm font-medium text-gray-700">Biaya Tetap Bulanan</span>
                                                    <span class="text-lg font-bold text-blue-600">{{ $fixedCost->formatted_monthly_cost }}</span>
                                                </div>
                                                
                                                @if($fixedCost->installation_cost > 0)
                                                    <div class="flex justify-between items-center py-2 border-b border-blue-200">
                                                        <span class="text-sm font-medium text-gray-700">Biaya Pemasangan</span>
                                                        <span class="text-sm font-semibold text-gray-900">{{ $fixedCost->formatted_installation_cost }}</span>
                                                    </div>
                                                @endif
                                                
                                                @if($fixedCost->security_deposit > 0)
                                                    <div class="flex justify-between items-center py-2 border-b border-blue-200">
                                                        <span class="text-sm font-medium text-gray-700">Uang Jaminan</span>
                                                        <span class="text-sm font-semibold text-gray-900">{{ $fixedCost->formatted_security_deposit }}</span>
                                                    </div>
                                                @endif
                                                
                                                @if($fixedCost->minimum_usage > 0)
                                                    <div class="flex justify-between items-center py-2">
                                                        <span class="text-sm font-medium text-gray-700">Pemakaian Minimum</span>
                                                        <span class="text-sm font-semibold text-gray-900">{{ $fixedCost->minimum_usage }} m³</span>
                                                    </div>
                                                @endif
                                            </div>

                                            @if($fixedCost->notes)
                                                <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                                    <p class="text-sm text-yellow-800">
                                                        <span class="font-medium">Catatan:</span> {{ $fixedCost->notes }}
                                                    </p>
                                                </div>
                                            @endif

                                            <div class="mt-4 text-xs text-gray-500">
                                                Berlaku mulai: {{ $fixedCost->effective_date->format('d M Y') }}
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <div class="w-16 h-16 mx-auto mb-4 bg-gray-100 rounded-lg flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                    </div>
                                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Biaya Tetap Akan Segera Tersedia</h3>
                                    <p class="text-gray-600">Informasi biaya tetap sedang dipersiapkan untuk Anda.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Information Card -->
                <div class="mt-8 bg-blue-50 border border-blue-200 rounded-lg p-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800">Informasi Penting</h3>
                            <div class="mt-2 text-sm text-blue-700">
                                <ul class="list-disc list-inside space-y-1">
                                    <li>Tarif dapat berubah sewaktu-waktu sesuai kebijakan perusahaan</li>
                                    <li>Untuk informasi lebih lengkap, silakan hubungi kantor cabang terdekat</li>
                                    <li>Pembayaran dapat dilakukan melalui loket atau mitra pembayaran resmi</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('styles')
<style>
.tab-button {
    border-bottom-color: transparent;
    color: #6B7280;
}

.tab-button.active {
    border-bottom-color: #3B82F6;
    color: #3B82F6;
    background-color: #EFF6FF;
}

.tab-button:hover:not(.active) {
    color: #374151;
    border-bottom-color: #D1D5DB;
}

.tab-content {
    animation: fadeIn 0.3s ease-in-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}
</style>
@endpush

@push('scripts')
<script>
function switchTab(tabName) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active class from all tabs
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('active');
    });
    
    // Show selected tab content
    document.getElementById(tabName + '-content').classList.remove('hidden');
    
    // Add active class to selected tab
    document.getElementById(tabName + '-tab').classList.add('active');
}

// Set default tab on page load
document.addEventListener('DOMContentLoaded', function() {
    switchTab('tariff');
});
</script>
@endpush
