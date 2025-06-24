@extends('layouts.app')

@section('title', 'Tarif Air - Tirta Perwira PDAM Purbalingga')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content container-custom">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="hero-title">Tarif Air</h1>
                <p class="hero-description">
                    Informasi tarif air bersih yang terjangkau dan transparan
                </p>
            </div>
        </div>
        <div class="hero-wave">
            <svg viewBox="0 0 1200 120" class="w-full h-12 fill-current text-blue-50">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"></path>
            </svg>
        </div>
    </section>

    <!-- Tariff Content -->
    <section class="section-padding">
        <div class="container-custom">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Daftar Tarif Air Bersih</h2>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-blue-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-blue-900 uppercase tracking-wider">Kategori</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-blue-900 uppercase tracking-wider">Volume (m³)</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-blue-900 uppercase tracking-wider">Tarif per m³</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Rumah Tangga</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">0 - 10</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 3.500</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Rumah Tangga</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">11 - 20</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 4.000</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Rumah Tangga</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> > 20</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 5.000</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Komersial</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Semua</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 7.500</td>
                                </tr>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">Industri</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Semua</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">Rp 8.500</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-8 p-4 bg-blue-50 rounded-lg">
                        <h3 class="font-semibold text-blue-900 mb-2">Catatan Penting:</h3>
                        <ul class="text-sm text-blue-800 space-y-1">
                            <li>• Tarif sudah termasuk PPN 11%</li>
                            <li>• Biaya administrasi Rp 5.000 per bulan</li>
                            <li>• Denda keterlambatan 2% per bulan</li>
                            <li>• Tarif dapat berubah sesuai peraturan yang berlaku</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
