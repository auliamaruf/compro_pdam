@extends('layouts.app')

@section('title', 'Sambungan Baru - Layanan Tirta Perwira')
@section('description', 'Panduan lengkap dan prosedur pemasangan sambungan air baru PDAM Tirta Perwira Purbalingga')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-cyan-50">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content container-custom">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="hero-title">Sambungan Baru</h1>
                <p class="hero-description">
                    Panduan lengkap pemasangan sambungan air bersih untuk rumah, kantor, dan usaha
                </p>
            </div>
        </div>
        <div class="hero-wave">
            <svg viewBox="0 0 1200 120" class="w-full h-12 fill-current text-blue-50">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"></path>
            </svg>
        </div>
    </section>

    <!-- Service Types -->
    <section class="py-16">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Jenis Sambungan</h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Pilih jenis sambungan yang sesuai dengan kebutuhan Anda
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Rumah Tinggal -->
                    <div class="bg-white rounded-xl shadow-lg p-6 text-center group hover:shadow-xl transition-shadow border border-blue-100">
                        <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Rumah Tinggal</h3>
                        <p class="text-gray-600 mb-4 text-sm">Sambungan untuk kebutuhan rumah tangga</p>
                        <div class="text-left space-y-2 mb-4">
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-blue-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <span class="text-sm text-gray-600">Diameter pipa ½ inch atau ¾ inch</span>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-blue-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <span class="text-sm text-gray-600">Meteran air standar</span>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-blue-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <span class="text-sm text-gray-600">Kapasitas 10-15 m³/bulan</span>
                            </div>
                        </div>
                        <div class="bg-blue-50 rounded-lg p-3">
                            <p class="text-blue-800 font-semibold text-sm">Mulai dari Rp 850.000</p>
                        </div>
                    </div>

                    <!-- Komersial -->
                    <div class="bg-white rounded-xl shadow-lg p-6 text-center group hover:shadow-xl transition-shadow border border-green-100">
                        <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-200 transition-colors">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H7m2 0v-5a2 2 0 012-2h2a2 2 0 012 2v5"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Komersial</h3>
                        <p class="text-gray-600 mb-4 text-sm">Sambungan untuk kantor, toko, warung</p>
                        <div class="text-left space-y-2 mb-4">
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-green-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <span class="text-sm text-gray-600">Diameter pipa ¾ inch atau 1 inch</span>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-green-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <span class="text-sm text-gray-600">Meteran air komersial</span>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-green-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <span class="text-sm text-gray-600">Kapasitas 20-50 m³/bulan</span>
                            </div>
                        </div>
                        <div class="bg-green-50 rounded-lg p-3">
                            <p class="text-green-800 font-semibold text-sm">Mulai dari Rp 1.250.000</p>
                        </div>
                    </div>

                    <!-- Industri -->
                    <div class="bg-white rounded-xl shadow-lg p-6 text-center group hover:shadow-xl transition-shadow border border-orange-100">
                        <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-orange-200 transition-colors">
                            <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Industri</h3>
                        <p class="text-gray-600 mb-4 text-sm">Sambungan untuk pabrik dan industri</p>
                        <div class="text-left space-y-2 mb-4">
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-orange-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <span class="text-sm text-gray-600">Diameter pipa 1-2 inch</span>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-orange-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <span class="text-sm text-gray-600">Meteran air industri</span>
                            </div>
                            <div class="flex items-start">
                                <div class="w-2 h-2 bg-orange-600 rounded-full mt-2 mr-3 flex-shrink-0"></div>
                                <span class="text-sm text-gray-600">Kapasitas >100 m³/bulan</span>
                            </div>
                        </div>
                        <div class="bg-orange-50 rounded-lg p-3">
                            <p class="text-orange-800 font-semibold text-sm">Mulai dari Rp 2.500.000</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Requirements -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Persyaratan Pendaftaran</h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Dokumen yang perlu disiapkan untuk pengajuan sambungan baru
                    </p>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Documents Required -->
                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-6 border border-blue-100">
                        <div class="flex items-center mb-6">
                            <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Dokumen Wajib</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Fotocopy KTP (Kartu Tanda Penduduk) yang masih berlaku</span>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Fotocopy Kartu Keluarga (KK)</span>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Surat keterangan dari RT/RW setempat</span>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Fotocopy sertifikat tanah atau surat kepemilikan</span>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Denah lokasi dan sketsa pipa yang akan dipasang</span>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Pas foto pemohon 3x4 sebanyak 2 lembar</span>
                            </div>
                        </div>
                    </div>

                    <!-- Additional for Business -->
                    <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-xl p-6 border border-green-100">
                        <div class="flex items-center mb-6">
                            <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-4m-5 0H9m0 0H7m2 0v-5a2 2 0 012-2h2a2 2 0 012 2v5"></path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900">Dokumen Tambahan (Komersial/Industri)</h3>
                        </div>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Surat Izin Usaha Perdagangan (SIUP)</span>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Nomor Pokok Wajib Pajak (NPWP)</span>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Izin Mendirikan Bangunan (IMB)</span>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Surat pernyataan kesanggupan membayar</span>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-5 h-5 text-green-600 mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span class="text-gray-700">Rencana penggunaan air (untuk industri)</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Process Steps -->
    <section class="py-16">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Prosedur Pendaftaran</h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Langkah-langkah mudah untuk mendapatkan sambungan air baru
                    </p>
                </div>

                <div class="space-y-8">
                    <!-- Step 1 -->
                    <div class="flex flex-col lg:flex-row items-center lg:items-start">
                        <div class="flex items-center justify-center w-16 h-16 bg-blue-600 text-white rounded-full text-xl font-bold mb-4 lg:mb-0 lg:mr-6 flex-shrink-0">1</div>
                        <div class="flex-1 text-center lg:text-left">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Persiapan Dokumen</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Siapkan semua dokumen yang diperlukan sesuai dengan jenis sambungan yang diinginkan.
                                Pastikan semua dokumen lengkap dan masih berlaku.
                            </p>
                        </div>
                    </div>

                    <!-- Step 2 -->
                    <div class="flex flex-col lg:flex-row items-center lg:items-start">
                        <div class="flex items-center justify-center w-16 h-16 bg-blue-600 text-white rounded-full text-xl font-bold mb-4 lg:mb-0 lg:mr-6 flex-shrink-0">2</div>
                        <div class="flex-1 text-center lg:text-left">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Pengajuan Permohonan</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Datang ke kantor PDAM Tirta Perwira dengan membawa semua dokumen yang diperlukan.
                                Isi formulir permohonan sambungan baru dan serahkan kepada petugas.
                            </p>
                        </div>
                    </div>

                    <!-- Step 3 -->
                    <div class="flex flex-col lg:flex-row items-center lg:items-start">
                        <div class="flex items-center justify-center w-16 h-16 bg-blue-600 text-white rounded-full text-xl font-bold mb-4 lg:mb-0 lg:mr-6 flex-shrink-0">3</div>
                        <div class="flex-1 text-center lg:text-left">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Survey Lokasi</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Tim teknis PDAM akan melakukan survey ke lokasi untuk menentukan jalur pipa,
                                ukuran sambungan, dan estimasi biaya pemasangan.
                            </p>
                        </div>
                    </div>

                    <!-- Step 4 -->
                    <div class="flex flex-col lg:flex-row items-center lg:items-start">
                        <div class="flex items-center justify-center w-16 h-16 bg-blue-600 text-white rounded-full text-xl font-bold mb-4 lg:mb-0 lg:mr-6 flex-shrink-0">4</div>
                        <div class="flex-1 text-center lg:text-left">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Pembayaran</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Setelah survey selesai, lakukan pembayaran biaya pemasangan sesuai dengan
                                estimasi yang telah diberikan. Pembayaran dapat dilakukan di kantor PDAM.
                            </p>
                        </div>
                    </div>

                    <!-- Step 5 -->
                    <div class="flex flex-col lg:flex-row items-center lg:items-start">
                        <div class="flex items-center justify-center w-16 h-16 bg-blue-600 text-white rounded-full text-xl font-bold mb-4 lg:mb-0 lg:mr-6 flex-shrink-0">5</div>
                        <div class="flex-1 text-center lg:text-left">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Pemasangan</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Tim teknisi akan melakukan pemasangan pipa dan meteran air di lokasi Anda.
                                Proses pemasangan biasanya memerlukan waktu 1-3 hari kerja.
                            </p>
                        </div>
                    </div>

                    <!-- Step 6 -->
                    <div class="flex flex-col lg:flex-row items-center lg:items-start">
                        <div class="flex items-center justify-center w-16 h-16 bg-green-600 text-white rounded-full text-xl font-bold mb-4 lg:mb-0 lg:mr-6 flex-shrink-0">6</div>
                        <div class="flex-1 text-center lg:text-left">
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Aktivasi & Serah Terima</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Sambungan air siap digunakan! Anda akan menerima kartu pelanggan dan
                                informasi tentang cara pembayaran tagihan bulanan.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Download Forms -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-4xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Download Formulir</h2>
                    <p class="text-lg text-gray-600">
                        Unduh formulir untuk mempercepat proses pendaftaran
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <a href="#" class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-6 border border-blue-100 hover:shadow-lg transition-shadow group">
                        <div class="flex items-center">
                            <div class="bg-blue-100 w-12 h-12 rounded-full flex items-center justify-center mr-4 group-hover:bg-blue-200 transition-colors">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Formulir Sambungan Rumah Tangga</h3>
                                <p class="text-gray-600 text-sm">Format PDF • 250 KB</p>
                            </div>
                        </div>
                    </a>

                    <a href="#" class="bg-gradient-to-r from-green-50 to-blue-50 rounded-xl p-6 border border-green-100 hover:shadow-lg transition-shadow group">
                        <div class="flex items-center">
                            <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mr-4 group-hover:bg-green-200 transition-colors">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Formulir Sambungan Komersial</h3>
                                <p class="text-gray-600 text-sm">Format PDF • 320 KB</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Information -->
    <section class="py-16 bg-gradient-to-r from-blue-900 to-blue-700 text-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl lg:text-4xl font-bold mb-6">Butuh Bantuan?</h2>
                <p class="text-xl text-blue-100 leading-relaxed mb-8">
                    Tim kami siap membantu proses pendaftaran sambungan baru Anda
                </p>
                <!-- <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-white bg-opacity-10 rounded-lg p-6">
                        <div class="flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Telepon</h3>
                        <p class="text-blue-100">(0281) 891234</p>
                        <p class="text-blue-100 text-sm">Senin - Jumat: 08:00 - 16:00</p>
                    </div>

                    <div class="bg-white bg-opacity-10 rounded-lg p-6">
                        <div class="flex items-center justify-center mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold mb-2">Kunjungi Kantor</h3>
                        <p class="text-blue-100">Jl. Letjen S. Parman No. 53</p>
                        <p class="text-blue-100 text-sm">Purbalingga, Jawa Tengah</p>
                    </div>
                </div> -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 bg-white text-blue-900 font-medium rounded-lg hover:bg-blue-50 transition-colors">
                        <span>Hubungi Kami</span>
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </a>
                    <a href="{{ route('services') }}" class="inline-flex items-center px-6 py-3 bg-transparent border-2 border-white text-white font-medium rounded-lg hover:bg-white hover:text-blue-900 transition-colors">
                        <span>Layanan Lainnya</span>
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
