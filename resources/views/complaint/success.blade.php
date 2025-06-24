@extends('layouts.app')

@section('title', 'Keluhan Berhasil Dikirim - Tirta Perwira PDAM Purbalingga')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="container-custom py-16">
        <div class="max-w-2xl mx-auto">
            <!-- Success Card -->
            <div class="bg-white rounded-xl shadow-xl p-8 text-center">
                <!-- Success Icon -->
                <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>

                <!-- Success Message -->
                <h1 class="text-3xl font-bold text-gray-900 mb-4">Keluhan Berhasil Dikirim!</h1>
                <p class="text-lg text-gray-600 mb-8">
                    Terima kasih telah mengirimkan keluhan Anda. Kami akan segera menindaklanjuti.
                </p>

                <!-- Ticket Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
                    <div class="flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a1 1 0 001 1h1a1 1 0 001-1V7a2 2 0 00-2-2H5zM5 14a2 2 0 00-2 2v3a1 1 0 001 1h1a1 1 0 001-1v-3a2 2 0 00-2-2H5z"></path>
                        </svg>
                        <h2 class="text-xl font-semibold text-blue-800">Nomor Tiket Anda</h2>
                    </div>
                    <div class="text-3xl font-bold text-blue-600 mb-2 font-mono">{{ $complaint->ticket_number }}</div>
                    <p class="text-sm text-blue-600">Simpan nomor ini untuk melacak status keluhan Anda</p>
                </div>

                <!-- Complaint Details -->
                <div class="text-left bg-gray-50 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Keluhan</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <span class="font-medium text-gray-600">Nama:</span>
                            <p class="text-gray-900">{{ $complaint->customer_name }}</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Email:</span>
                            <p class="text-gray-900">{{ $complaint->email }}</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Jenis Keluhan:</span>
                            <p class="text-gray-900">{{ $complaint->complaint_type_display }}</p>
                        </div>
                        <div>
                            <span class="font-medium text-gray-600">Prioritas:</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                @if($complaint->priority === 'urgent') bg-red-100 text-red-800
                                @elseif($complaint->priority === 'high') bg-orange-100 text-orange-800
                                @elseif($complaint->priority === 'medium') bg-yellow-100 text-yellow-800
                                @else bg-green-100 text-green-800
                                @endif">
                                {{ $complaint->priority_display }}
                            </span>
                        </div>
                        <div class="md:col-span-2">
                            <span class="font-medium text-gray-600">Subjek:</span>
                            <p class="text-gray-900">{{ $complaint->subject }}</p>
                        </div>
                    </div>
                </div>

                <!-- Next Steps -->
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-6 mb-8">
                    <h3 class="text-lg font-semibold text-yellow-800 mb-4">Langkah Selanjutnya</h3>
                    <div class="text-left space-y-3 text-sm text-yellow-700">
                        <div class="flex items-start space-x-3">
                            <span class="flex-shrink-0 w-6 h-6 bg-yellow-200 rounded-full flex items-center justify-center text-yellow-800 font-bold text-xs">1</span>
                            <p>Tim kami akan meninjau keluhan Anda dalam 1x24 jam</p>
                        </div>
                        <div class="flex items-start space-x-3">
                            <span class="flex-shrink-0 w-6 h-6 bg-yellow-200 rounded-full flex items-center justify-center text-yellow-800 font-bold text-xs">2</span>
                            <p>Anda akan menerima konfirmasi dan update melalui email yang terdaftar</p>
                        </div>
                        <div class="flex items-start space-x-3">
                            <span class="flex-shrink-0 w-6 h-6 bg-yellow-200 rounded-full flex items-center justify-center text-yellow-800 font-bold text-xs">3</span>
                            <p>Gunakan nomor tiket untuk melacak progres penanganan</p>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-4">
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="{{ route('complaint.track') }}" class="btn-primary">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Lacak Status Keluhan
                        </a>
                        <a href="{{ route('complaint') }}" class="btn-secondary">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Ajukan Keluhan Lain
                        </a>
                    </div>
                    <a href="{{ route('home') }}" class="btn-ghost">
                        ← Kembali ke Beranda
                    </a>
                </div>

                <!-- Print/Save Option -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <button onclick="window.print()" class="text-blue-600 hover:text-blue-800 text-sm">
                        <svg class="w-4 h-4 mr-1 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                        </svg>
                        Cetak Bukti Keluhan
                    </button>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-8 text-center">
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Butuh Bantuan?</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                        <div>
                            <p class="font-medium text-gray-600">Customer Service</p>
                            <p class="text-blue-600">(0281) 895-123</p>
                            <p class="text-gray-500">Senin - Jumat: 07:30 - 15:30</p>
                        </div>
                        <div>
                            <p class="font-medium text-gray-600">Emergency Hotline</p>
                            <p class="text-red-600">(0281) 895-911</p>
                            <p class="text-gray-500">24 Jam</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
@media print {
    .btn-primary, .btn-secondary, .btn-ghost {
        display: none;
    }

    body {
        background: white !important;
    }

    .bg-gray-50 {
        background: white !important;
    }
}
</style>
@endpush
@endsection
