@extends('layouts.app')

@section('title', 'Layanan Pengaduan - Tirta Perwira')
@section('description', 'Sistem pengaduan PDAM Tirta Perwira Purbalingga - sampaikan keluhan, saran, dan masukan untuk peningkatan pelayanan')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-cyan-50">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container-custom">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="hero-title">Layanan Pengaduan</h1>
                <p class="hero-description">
                    Suara Anda sangat berarti bagi kami. Sampaikan keluhan, saran, dan masukan untuk pelayanan yang lebih baik.
                </p>
            </div>
        </div>
        <div class="hero-wave">
            <svg viewBox="0 0 1200 120" class="w-full h-12 fill-current text-blue-50">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"></path>
            </svg>
        </div>
    </section>

    <!-- Quick Access -->
    <section class="section-padding">
        <div class="container-custom">
            <div class="max-w-4xl mx-auto text-center mb-12">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">Pilih Cara Pengaduan</h2>
                <p class="text-lg text-gray-600">
                    Kami menyediakan berbagai channel untuk memudahkan Anda menyampaikan pengaduan
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-4xl mx-auto">
                <!-- Online Complaint -->
                <div class="bg-white rounded-xl shadow-lg p-8 text-center border-2 border-red-200 group hover:shadow-xl transition-shadow">
                    <div class="bg-red-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-red-200 transition-colors">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2zM7 10a5 5 0 0110 0v1a1 1 0 11-2 0v-1a3 3 0 10-6 0v1a1 1 0 11-2 0v-1z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Pengaduan Online</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Platform pengaduan digital dengan sistem tiket dan tracking status. Mudah, cepat, dan dapat dipantau kapan saja.
                    </p>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-center text-sm text-gray-500">
                            <svg class="w-4 h-4 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Tracking status real-time
                        </div>
                        <div class="flex items-center justify-center text-sm text-gray-500">
                            <svg class="w-4 h-4 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Upload foto/dokumen pendukung
                        </div>
                        <div class="flex items-center justify-center text-sm text-gray-500">
                            <svg class="w-4 h-4 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Notifikasi otomatis
                        </div>
                    </div>
                    <a href="{{ route('complaint') }}" class="inline-flex items-center px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors w-full justify-center">
                        <span>Buat Pengaduan Online</span>
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <!-- Traditional Complaint -->
                <div class="bg-white rounded-xl shadow-lg p-8 text-center border border-blue-200 group hover:shadow-xl transition-shadow">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6 group-hover:bg-blue-200 transition-colors">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">Kunjungi Kantor</h3>
                    <p class="text-gray-600 mb-6 leading-relaxed">
                        Sampaikan pengaduan langsung di kantor kami. Tim customer service siap membantu dengan pelayanan terbaik.
                    </p>
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-center text-sm text-gray-500">
                            <svg class="w-4 h-4 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Konsultasi langsung
                        </div>
                        <div class="flex items-center justify-center text-sm text-gray-500">
                            <svg class="w-4 h-4 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Penyelesaian cepat
                        </div>
                        <div class="flex items-center justify-center text-sm text-gray-500">
                            <svg class="w-4 h-4 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Senin - Jumat: 08:00-16:00
                        </div>
                    </div>
                    <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors w-full justify-center">
                        <span>Info Kontak & Lokasi</span>
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Complaint Categories -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Kategori Pengaduan</h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Jenis pengaduan yang sering diterima dan cara penanganannya
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Water Quality -->
                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-6 border border-blue-100">
                        <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Kualitas Air</h3>
                        <p class="text-gray-600 text-sm mb-4">Air keruh, berbau, berasa, atau berwarna tidak normal</p>
                        <div class="text-xs text-blue-600 bg-blue-100 px-3 py-1 rounded-full inline-block">
                            Respon: 24 jam
                        </div>
                    </div>

                    <!-- Water Pressure -->
                    <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-xl p-6 border border-green-100">
                        <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Tekanan Air</h3>
                        <p class="text-gray-600 text-sm mb-4">Air tidak mengalir, tekanan rendah, atau mati total</p>
                        <div class="text-xs text-green-600 bg-green-100 px-3 py-1 rounded-full inline-block">
                            Respon: 12 jam
                        </div>
                    </div>

                    <!-- Billing -->
                    <div class="bg-gradient-to-r from-orange-50 to-yellow-50 rounded-xl p-6 border border-orange-100">
                        <div class="bg-orange-100 w-12 h-12 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Tagihan</h3>
                        <p class="text-gray-600 text-sm mb-4">Tagihan tidak sesuai, meteran rusak, atau kesalahan perhitungan</p>
                        <div class="text-xs text-orange-600 bg-orange-100 px-3 py-1 rounded-full inline-block">
                            Respon: 3 hari kerja
                        </div>
                    </div>

                    <!-- Service -->
                    <div class="bg-gradient-to-r from-purple-50 to-pink-50 rounded-xl p-6 border border-purple-100">
                        <div class="bg-purple-100 w-12 h-12 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Pelayanan</h3>
                        <p class="text-gray-600 text-sm mb-4">Keluhan tentang petugas, proses administrasi, atau waktu layanan</p>
                        <div class="text-xs text-purple-600 bg-purple-100 px-3 py-1 rounded-full inline-block">
                            Respon: 1 hari kerja
                        </div>
                    </div>

                    <!-- Infrastructure -->
                    <div class="bg-gradient-to-r from-red-50 to-pink-50 rounded-xl p-6 border border-red-100">
                        <div class="bg-red-100 w-12 h-12 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16l3.5-2 3.5 2 3.5-2L19 21z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Infrastruktur</h3>
                        <p class="text-gray-600 text-sm mb-4">Pipa bocor, kerusakan meteran, atau masalah instalasi</p>
                        <div class="text-xs text-red-600 bg-red-100 px-3 py-1 rounded-full inline-block">
                            Respon: 6 jam
                        </div>
                    </div>

                    <!-- Others -->
                    <div class="bg-gradient-to-r from-gray-50 to-blue-50 rounded-xl p-6 border border-gray-100">
                        <div class="bg-gray-100 w-12 h-12 rounded-full flex items-center justify-center mb-4">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Lainnya</h3>
                        <p class="text-gray-600 text-sm mb-4">Saran, masukan, atau pengaduan kategori lain</p>
                        <div class="text-xs text-gray-600 bg-gray-100 px-3 py-1 rounded-full inline-block">
                            Respon: 2 hari kerja
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Complaint Process -->
    <section class="py-16">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Proses Penanganan Pengaduan</h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Sistem penanganan yang terstruktur untuk memastikan setiap pengaduan ditangani dengan baik
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                    <!-- Process Steps -->
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex items-center justify-center w-12 h-12 bg-blue-600 text-white rounded-full text-lg font-bold mr-4 flex-shrink-0">1</div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Penerimaan Pengaduan</h3>
                                <p class="text-gray-600">Pengaduan diterima melalui berbagai channel dan dicatat dalam sistem dengan nomor tiket unik.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center justify-center w-12 h-12 bg-blue-600 text-white rounded-full text-lg font-bold mr-4 flex-shrink-0">2</div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Verifikasi & Kategorisasi</h3>
                                <p class="text-gray-600">Tim customer service memverifikasi data dan mengkategorikan pengaduan berdasarkan jenis dan prioritas.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center justify-center w-12 h-12 bg-blue-600 text-white rounded-full text-lg font-bold mr-4 flex-shrink-0">3</div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Penugasan Tim</h3>
                                <p class="text-gray-600">Pengaduan diteruskan ke tim teknis atau bagian terkait sesuai dengan kategori masalah.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center justify-center w-12 h-12 bg-blue-600 text-white rounded-full text-lg font-bold mr-4 flex-shrink-0">4</div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Investigasi & Penyelesaian</h3>
                                <p class="text-gray-600">Tim melakukan investigasi di lapangan dan mengambil tindakan perbaikan yang diperlukan.</p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center justify-center w-12 h-12 bg-green-600 text-white rounded-full text-lg font-bold mr-4 flex-shrink-0">5</div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-2">Konfirmasi & Penutupan</h3>
                                <p class="text-gray-600">Setelah masalah terselesaikan, kami akan mengkonfirmasi kepada pelanggan dan menutup tiket pengaduan.</p>
                            </div>
                        </div>
                    </div>

                    <!-- SLA Commitment -->
                    <div class="bg-white rounded-xl shadow-lg p-8 border border-blue-100">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6 text-center">Komitmen Waktu Penyelesaian</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center p-3 bg-red-50 rounded-lg">
                                <span class="text-gray-700 font-medium">Darurat (Air mati)</span>
                                <span class="text-red-600 font-bold">6 jam</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-orange-50 rounded-lg">
                                <span class="text-gray-700 font-medium">Kritis (Kualitas air)</span>
                                <span class="text-orange-600 font-bold">24 jam</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-blue-50 rounded-lg">
                                <span class="text-gray-700 font-medium">Normal (Tagihan)</span>
                                <span class="text-blue-600 font-bold">3 hari</span>
                            </div>
                            <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                                <span class="text-gray-700 font-medium">Rendah (Saran)</span>
                                <span class="text-green-600 font-bold">7 hari</span>
                            </div>
                        </div>
                        <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                            <p class="text-sm text-blue-800 text-center">
                                <strong>Jaminan:</strong> Semua pengaduan akan mendapat respon dalam 1x24 jam
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Track Complaint -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-6">Lacak Status Pengaduan</h2>
                <p class="text-lg text-gray-600 mb-8">
                    Pantau perkembangan pengaduan Anda dengan memasukkan nomor tiket
                </p>

                <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-8 border border-blue-100">
                    <form action="{{ route('complaint.track') }}" method="GET" class="flex flex-col sm:flex-row gap-4 justify-center">
                        <input
                            type="text"
                            name="ticket_number"
                            placeholder="Masukkan nomor tiket (contoh: TP-2024-001)"
                            class="flex-1 max-w-md px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent text-center sm:text-left"
                            required
                        >
                        <button type="submit" class="px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors">
                            Lacak Status
                        </button>
                    </form>
                    <p class="text-sm text-gray-500 mt-4">
                        Nomor tiket dapat ditemukan pada email konfirmasi atau SMS yang kami kirimkan
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Support -->
    <section class="py-16 bg-gradient-to-r from-blue-900 to-blue-700 text-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl lg:text-4xl font-bold mb-6">Butuh Bantuan Lebih Lanjut?</h2>
                <p class="text-xl text-blue-100 leading-relaxed mb-8">
                    Tim customer support kami siap membantu Anda 24/7 untuk menyelesaikan masalah
                </p>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white bg-opacity-10 rounded-lg p-6">
                        <div class="flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Hotline 24/7</h3>
                        <p class="text-blue-100">(0281) 891234</p>
                    </div>

                    <div class="bg-white bg-opacity-10 rounded-lg p-6">
                        <div class="flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">WhatsApp</h3>
                        <p class="text-blue-100">0812-3456-7890</p>
                    </div>

                    <div class="bg-white bg-opacity-10 rounded-lg p-6">
                        <div class="flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold mb-2">Email</h3>
                        <p class="text-blue-100">pengaduan@tirtaperwira.com</p>
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('complaint') }}" class="inline-flex items-center px-6 py-3 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition-colors">
                        <span>Buat Pengaduan Baru</span>
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </a>
                    <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 bg-transparent border-2 border-white text-white font-medium rounded-lg hover:bg-white hover:text-blue-900 transition-colors">
                        <span>Hubungi Kami</span>
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
