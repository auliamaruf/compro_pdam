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
                                @if(isset($tariffs) && $tariffs->count() > 0 && $tariffs->first()->legal_basis)
                                    <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                        <p class="text-sm text-blue-800"><strong>Berdasarkan:</strong> {{ $tariffs->first()->legal_basis }}</p>
                                    </div>
                                @else
                                    <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                        <p class="text-sm text-blue-800"><strong>Berdasarkan:</strong> Peraturan Bupati Purbalingga No.62 Tahun 2011 tanggal 14 Juni 2011 Tentang penyesuaian Tarif Dasar Air pada PDAM Kabupaten Purbalingga</p>
                                    </div>
                                @endif
                            </div>

                            @if(isset($tariffs) && $tariffs->count() > 0)
                                <div class="overflow-x-auto">
                                    <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                                        <thead class="bg-blue-600 text-white">
                                            <tr>
                                                <th class="px-4 py-3 text-center font-semibold border-r border-blue-400" rowspan="3">NO</th>
                                                <th class="px-4 py-3 text-center font-semibold border-r border-blue-400" rowspan="3" colspan="2">GOLONGAN PELANGGAN</th>
                                                <th class="px-4 py-3 text-center font-semibold" colspan="4">KELOMPOK KONSUMSI (m³)</th>
                                            </tr>
                                            <tr class="bg-blue-500 text-white">
                                                <th class="px-4 py-2 text-center border-l border-r border-blue-400">0-10 m³</th>
                                                <th class="px-4 py-2 text-center border-r border-blue-400">11-20 m³</th>
                                                <th class="px-4 py-2 text-center border-r border-blue-400">21-30 m³</th>
                                                <th class="px-4 py-2 text-center border-r border-blue-400">>30 m³</th>
                                            </tr>
                                            <tr class="bg-blue-400 text-white text-sm">
                                                <th class="px-4 py-2 text-center border-l border-r border-blue-300">Rp./m³</th>
                                                <th class="px-4 py-2 text-center border-r border-blue-300">Rp./m³</th>
                                                <th class="px-4 py-2 text-center border-r border-blue-300">Rp./m³</th>
                                                <th class="px-4 py-2 text-center border-r border-blue-300">Rp./m³</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $groupedTariffs = $tariffs->groupBy('customer_type');
                                                $no = 1;
                                            @endphp
                                            
                                            @foreach($groupedTariffs as $customerType => $tariffGroup)
                                                @php
                                                    $subCategories = $tariffGroup->groupBy('sub_category');
                                                    $isFirstCustomerType = true;
                                                @endphp
                                                
                                                @foreach($subCategories as $subCategory => $subTariffs)
                                                    @php
                                                        $sortedTariffs = $subTariffs->sortBy('min_usage');
                                                        $ranges = ['0-10' => null, '11-20' => null, '21-30' => null, '>30' => null];
                                                        
                                                        foreach($sortedTariffs as $tariff) {
                                                            if ($tariff->min_usage == 0 && $tariff->max_usage == 10) $ranges['0-10'] = $tariff;
                                                            elseif ($tariff->min_usage == 11 && $tariff->max_usage == 20) $ranges['11-20'] = $tariff;
                                                            elseif ($tariff->min_usage == 21 && $tariff->max_usage == 30) $ranges['21-30'] = $tariff;
                                                            elseif ($tariff->min_usage >= 31 && $tariff->max_usage === null) $ranges['>30'] = $tariff;
                                                        }
                                                    @endphp
                                                    
                                                    <tr class="border-b border-gray-200 hover:bg-gray-50">
                                                        @if($isFirstCustomerType && $loop->first)
                                                            <td class="px-4 py-3 font-semibold text-center align-middle bg-gray-50 border-r border-gray-300" rowspan="{{ $subCategories->count() }}">{{ $no }}</td>
                                                        @endif
                                                        
                                                        @if($loop->first)
                                                            <td class="px-4 py-3 font-semibold align-middle bg-blue-50 border-r border-gray-300" rowspan="{{ $subCategories->count() }}">{{ strtoupper($customerType) }}</td>
                                                        @endif
                                                        
                                                        <td class="px-4 py-3 font-medium text-sm border-r border-gray-300">{{ $subCategory }}</td>
                                                        
                                                        @foreach($ranges as $range => $tariff)
                                                            <td class="px-4 py-3 text-center border-r border-gray-200">
                                                                @if($tariff)
                                                                    <span class="font-semibold text-green-700">{{ number_format($tariff->rate_per_m3, 0, ',', '.') }}</span>
                                                                @else
                                                                    <span class="text-gray-400">-</span>
                                                                @endif
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                    @php $isFirstCustomerType = false; @endphp
                                                @endforeach
                                                @php $no++; @endphp
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <div class="max-w-md mx-auto">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data tarif</h3>
                                        <p class="mt-1 text-sm text-gray-500">Data tarif air belum tersedia.</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Fixed Cost Tab Content -->
                        <div id="fixed-cost-content" class="tab-content hidden">
                            <div class="mb-6">
                                <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-2">Tarif Biaya Tetap Perumda Air Minum Tirta Perwira Purbalingga</h2>
                                <p class="text-gray-600">Biaya tetap bulanan berdasarkan kategori pelanggan</p>
                                @if(isset($fixedCosts) && $fixedCosts->count() > 0 && $fixedCosts->first()->legal_basis)
                                    <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                        <p class="text-sm text-blue-800"><strong>Berdasarkan:</strong><br>{!! nl2br(e($fixedCosts->first()->legal_basis)) !!}</p>
                                    </div>
                                @else
                                    <div class="mt-4 p-4 bg-blue-50 rounded-lg">
                                        <p class="text-sm text-blue-800"><strong>Berdasarkan:</strong><br>
                                        1. SK Direktur PDAM Kabupaten Purbalingga no.695.1/45.289/PDAM/XI/2010 tanggal 30 Nopember 2010<br>
                                        2. SK Direktur PDAM Kabupaten Purbalingga No.695.5/036.360/2016 Tanggal 29 Nopember 2016</p>
                                    </div>
                                @endif
                            </div>

                            @if(isset($fixedCosts) && $fixedCosts->count() > 0)
                                <!-- Tabel Tarif Abonemen -->
                                <div class="mb-8">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Tarif Biaya Tetap</h3>
                                    <div class="overflow-x-auto">
                                        <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                                            <thead class="bg-blue-600 text-white">
                                                <tr>
                                                    <th class="px-4 py-3 text-center font-semibold border-r border-blue-400">NO</th>
                                                    <th class="px-4 py-3 text-center font-semibold border-r border-blue-400" colspan="2">GOLONGAN PELANGGAN</th>
                                                    <th class="px-4 py-3 text-center font-semibold">TARIF BIAYA TETAP (Rp.)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    // Group abonemen data from database
                                                    $abonemenCosts = $fixedCosts->whereIn('category_name', [
                                                        'Sosial Umum (HU)', 'Sosial Khusus',
                                                        'Rumah Tangga Khusus', 'Rumah Tangga A', 'Rumah Tangga B', 'Rumah Tangga C',
                                                        'Instansi Pemerintah', 'TNI/Polri',
                                                        'Niaga Kecil', 'Niaga Besar',
                                                        'Industri Kecil', 'Industri Besar'
                                                    ]);
                                                    
                                                    $groupedAbonemen = [
                                                        1 => ['category' => 'SOSIAL', 'items' => $abonemenCosts->whereIn('category_name', ['Sosial Umum (HU)', 'Sosial Khusus'])],
                                                        2 => ['category' => 'NON NIAGA', 'items' => $abonemenCosts->whereIn('category_name', ['Rumah Tangga Khusus', 'Rumah Tangga A', 'Rumah Tangga B', 'Rumah Tangga C', 'Instansi Pemerintah', 'TNI/Polri'])],
                                                        3 => ['category' => 'NIAGA', 'items' => $abonemenCosts->whereIn('category_name', ['Niaga Kecil', 'Niaga Besar'])],
                                                        4 => ['category' => 'INDUSTRI', 'items' => $abonemenCosts->whereIn('category_name', ['Industri Kecil', 'Industri Besar'])]
                                                    ];
                                                @endphp

                                                @foreach($groupedAbonemen as $no => $group)
                                                    @if($group['items']->count() > 0)
                                                        @foreach($group['items'] as $item)
                                                            <tr class="border-b border-gray-200 hover:bg-gray-50">
                                                                @if($loop->first)
                                                                    <td class="px-4 py-3 font-semibold text-center align-middle bg-gray-50 border-r border-gray-300" rowspan="{{ $group['items']->count() }}">{{ $no }}</td>
                                                                    <td class="px-4 py-3 font-semibold align-middle bg-blue-50 border-r border-gray-300" rowspan="{{ $group['items']->count() }}">{{ $group['category'] }}</td>
                                                                @endif
                                                                <td class="px-4 py-3 font-medium border-r border-gray-300">{{ strtoupper($item->category_name) }}</td>
                                                                <td class="px-4 py-3 text-center font-semibold text-green-700">{{ number_format($item->monthly_cost, 0, ',', '.') }}</td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Tabel Biaya Layanan Lainnya -->
                                <div class="mt-8">
                                    <h3 class="text-xl font-semibold text-gray-900 mb-4">Biaya Layanan Lainnya</h3>
                                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                        @php
                                            $serviceCosts = $fixedCosts->filter(function($cost) {
                                                return in_array($cost->category_name, [
                                                    'Biaya Pemasangan Baru',
                                                    'Biaya Pembukaan Kembali', 
                                                    'Biaya Ganti Nama',
                                                    'Biaya Penggantian Meter Rusak',
                                                    'Biaya Upgrade Meter',
                                                    'Biaya Pindah Lokasi Meter',
                                                    'Biaya Surat Keterangan',
                                                    'Denda Keterlambatan'
                                                ]);
                                            });
                                        @endphp

                                        @foreach($serviceCosts as $service)
                                            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-lg p-6 border border-blue-100 hover:shadow-lg transition-all duration-300">
                                                <div class="flex items-start justify-between mb-4">
                                                    <div>
                                                        <h4 class="text-lg font-semibold text-gray-900 mb-1">{{ $service->category_name }}</h4>
                                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                            {{ $service->connection_type === 'new' ? 'bg-green-100 text-green-800' : ($service->connection_type === 'upgrade' ? 'bg-yellow-100 text-yellow-800' : 'bg-blue-100 text-blue-800') }}">
                                                            {{ $service->connection_type === 'new' ? 'Sambungan Baru' : ($service->connection_type === 'upgrade' ? 'Upgrade' : 'Layanan') }}
                                                        </span>
                                                    </div>
                                                </div>

                                                @if($service->description)
                                                    <p class="text-gray-600 text-sm mb-4">{{ $service->description }}</p>
                                                @endif

                                                <div class="space-y-3">
                                                    @if($service->monthly_cost > 0)
                                                        <div class="flex justify-between items-center py-2 border-b border-blue-200">
                                                            <span class="text-sm font-medium text-gray-700">Biaya Bulanan</span>
                                                            <span class="text-lg font-bold text-blue-600">{{ $service->formatted_monthly_cost }}</span>
                                                        </div>
                                                    @endif
                                                    
                                                    @if($service->installation_cost > 0)
                                                        <div class="flex justify-between items-center py-2 border-b border-blue-200">
                                                            <span class="text-sm font-medium text-gray-700">Biaya Layanan</span>
                                                            <span class="text-lg font-bold text-green-600">{{ $service->formatted_installation_cost }}</span>
                                                        </div>
                                                    @endif
                                                    
                                                    @if($service->security_deposit > 0)
                                                        <div class="flex justify-between items-center py-2 border-b border-blue-200">
                                                            <span class="text-sm font-medium text-gray-700">Uang Jaminan</span>
                                                            <span class="text-sm font-semibold text-gray-900">{{ $service->formatted_security_deposit }}</span>
                                                        </div>
                                                    @endif
                                                </div>

                                                @if($service->notes)
                                                    <div class="mt-4 p-3 bg-yellow-50 border border-yellow-200 rounded-lg">
                                                        <p class="text-sm text-yellow-800">
                                                            <span class="font-medium">Catatan:</span> {{ $service->notes }}
                                                        </p>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-12">
                                    <div class="max-w-md mx-auto">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                        </svg>
                                        <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data biaya tetap</h3>
                                        <p class="mt-1 text-sm text-gray-500">Data biaya tetap belum tersedia.</p>
                                    </div>
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
