@extends('layouts.app')

@section('title', 'Cek Tagihan - Tirta Perwira PDAM Purbalingga')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container-custom">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="hero-title">Cek Tagihan</h1>
                <p class="hero-description">
                    Lihat informasi tagihan air bulanan Anda dengan mudah
                </p>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="section-padding">
        <div class="container-custom">
            <div class="max-w-2xl mx-auto">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Masukkan Nomor Pelanggan</h2>

                    <form class="space-y-6">
                        <div>
                            <label class="form-label">Nomor Pelanggan</label>
                            <input type="text" class="form-input" placeholder="Contoh: 123456789" required>
                            <p class="text-sm text-gray-500 mt-2">Nomor pelanggan dapat ditemukan pada struk pembayaran terakhir</p>
                        </div>

                        <button type="submit" class="btn-primary w-full">
                            Cek Tagihan
                        </button>
                    </form>

                    <div class="mt-8 p-4 bg-blue-50 rounded-lg">
                        <h3 class="font-semibold text-blue-900 mb-2">Informasi Penting:</h3>
                        <ul class="text-sm text-blue-800 space-y-1">
                            <li>• Tagihan diupdate setiap hari pada pukul 08.00 WIB</li>
                            <li>• Pembayaran dapat dilakukan di kantor PDAM atau loket pembayaran terdekat</li>
                            <li>• Untuk informasi lebih lanjut hubungi (0281) 895-123</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
