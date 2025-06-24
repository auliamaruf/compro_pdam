@extends('layouts.app')

@section('title', 'Lacak Status Keluhan - Tirta Perwira PDAM Purbalingga')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <section class="bg-blue-600 text-white py-16">
        <div class="container-custom">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl lg:text-5xl font-bold mb-6">Lacak Status Keluhan</h1>
                <p class="text-xl text-blue-100">
                    Masukkan nomor tiket untuk melihat progres penanganan keluhan Anda
                </p>
            </div>
        </div>
    </section>

    <div class="container-custom py-8">
        <div class="max-w-3xl mx-auto">
            <!-- Search Form -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Cari Keluhan</h2>

                @if(session('error'))
                    <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex">
                            <svg class="w-5 h-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                            </svg>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <form action="{{ route('complaint.track.search.alt') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label for="ticket_number" class="form-label">Nomor Tiket</label>
                        <input type="text"
                               id="ticket_number"
                               name="ticket_number"
                               value="{{ request('ticket_number') }}"
                               class="form-input"
                               placeholder="Contoh: TP20250621ABCD"
                               required>
                        <p class="mt-1 text-sm text-gray-500">
                            Nomor tiket biasanya berformat: TP + Tanggal + 4 digit huruf (contoh: TP20250621ABCD)
                        </p>
                    </div>

                    <button type="submit" class="btn-primary w-full">
                        <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Lacak Keluhan
                    </button>
                </form>
            </div>

            @if($complaint)
            <!-- Complaint Details -->
            <div class="bg-white rounded-xl shadow-lg p-8">
                <!-- Header -->
                <div class="border-b border-gray-200 pb-6 mb-6">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900 mb-2">
                                Keluhan #{{ $complaint->ticket_number }}
                            </h2>
                            <p class="text-gray-600">{{ $complaint->subject }}</p>
                        </div>
                        <div class="mt-4 md:mt-0">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                @if($complaint->status === 'received') bg-blue-100 text-blue-800
                                @elseif($complaint->status === 'in_progress') bg-yellow-100 text-yellow-800
                                @elseif($complaint->status === 'resolved') bg-green-100 text-green-800
                                @elseif($complaint->status === 'closed') bg-gray-100 text-gray-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ $complaint->status_display }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Status Timeline -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Penanganan</h3>
                    <div class="flow-root">
                        <ul class="-mb-8">
                            <!-- Received -->
                            <li>
                                <div class="relative pb-8">
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"></span>
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">Keluhan Diterima</p>
                                                <p class="text-sm text-gray-500">{{ $complaint->created_at->format('d M Y, H:i') }} WIB</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <!-- In Progress -->
                            <li>
                                <div class="relative pb-8">
                                    @if(in_array($complaint->status, ['in_progress', 'resolved', 'closed']))
                                        <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200"></span>
                                    @endif
                                    <div class="relative flex space-x-3">
                                        <div>
                                            @if(in_array($complaint->status, ['in_progress', 'resolved', 'closed']))
                                                <span class="h-8 w-8 rounded-full bg-yellow-500 flex items-center justify-center ring-8 ring-white">
                                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </span>
                                            @else
                                                <span class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center ring-8 ring-white">
                                                    <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">
                                                    Sedang Diproses
                                                    @if(!in_array($complaint->status, ['in_progress', 'resolved', 'closed']))
                                                        <span class="text-gray-500">(Menunggu)</span>
                                                    @endif
                                                </p>
                                                @if(in_array($complaint->status, ['in_progress', 'resolved', 'closed']))
                                                    <p class="text-sm text-gray-500">Tim teknis sedang menangani keluhan Anda</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <!-- Resolved -->
                            <li>
                                <div class="relative">
                                    <div class="relative flex space-x-3">
                                        <div>
                                            @if(in_array($complaint->status, ['resolved', 'closed']))
                                                <span class="h-8 w-8 rounded-full bg-green-500 flex items-center justify-center ring-8 ring-white">
                                                    <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </span>
                                            @else
                                                <span class="h-8 w-8 rounded-full bg-gray-300 flex items-center justify-center ring-8 ring-white">
                                                    <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                                    </svg>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5">
                                            <div>
                                                <p class="text-sm font-medium text-gray-900">
                                                    Selesai
                                                    @if(!in_array($complaint->status, ['resolved', 'closed']))
                                                        <span class="text-gray-500">(Menunggu)</span>
                                                    @endif
                                                </p>
                                                @if($complaint->resolved_at)
                                                    <p class="text-sm text-gray-500">{{ $complaint->resolved_at->format('d M Y, H:i') }} WIB</p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Complaint Details -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Keluhan</h3>
                        <div class="space-y-3">
                            <div>
                                <span class="text-sm font-medium text-gray-600">Nama Pelanggan:</span>
                                <p class="text-gray-900">{{ $complaint->customer_name }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Email:</span>
                                <p class="text-gray-900">{{ $complaint->email }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Telepon:</span>
                                <p class="text-gray-900">{{ $complaint->phone }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Jenis Keluhan:</span>
                                <p class="text-gray-900">{{ $complaint->complaint_type_display }}</p>
                            </div>
                            <div>
                                <span class="text-sm font-medium text-gray-600">Prioritas:</span>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium
                                    @if($complaint->priority === 'urgent') bg-red-100 text-red-800
                                    @elseif($complaint->priority === 'high') bg-orange-100 text-orange-800
                                    @elseif($complaint->priority === 'medium') bg-yellow-100 text-yellow-800
                                    @else bg-green-100 text-green-800
                                    @endif">
                                    {{ $complaint->priority_display }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Alamat</h3>
                        <p class="text-gray-900 whitespace-pre-wrap">{{ $complaint->address }}</p>

                        @if($complaint->attachments && count($complaint->attachments) > 0)
                        <h4 class="text-md font-semibold text-gray-900 mt-6 mb-3">Lampiran</h4>
                        <div class="space-y-2">
                            @foreach($complaint->attachments as $attachment)
                            <div class="flex items-center space-x-2 text-sm">
                                <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                </svg>
                                <a href="{{ Storage::url($attachment['path']) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                                    {{ $attachment['original_name'] }}
                                </a>
                                <span class="text-gray-500">({{ formatBytes($attachment['size'] ?? 0) }})</span>
                            </div>
                            @endforeach
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Deskripsi Keluhan</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-900 whitespace-pre-wrap">{{ $complaint->description }}</p>
                    </div>
                </div>

                <!-- Admin Response -->
                @if($complaint->admin_response)
                <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-green-800 mb-4">Tanggapan Tim Kami</h3>
                    <p class="text-green-700 whitespace-pre-wrap">{{ $complaint->admin_response }}</p>
                    @if($complaint->responded_at)
                        <p class="text-sm text-green-600 mt-3">
                            Ditanggapi pada: {{ $complaint->responded_at->format('d M Y, H:i') }} WIB
                        </p>
                    @endif
                </div>
                @endif

                <!-- Actions -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="{{ route('complaint') }}" class="btn-primary">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Ajukan Keluhan Baru
                        </a>
                        <button onclick="window.print()" class="btn-secondary">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                            </svg>
                            Cetak Detail
                        </button>
                    </div>
                </div>
            </div>
            @endif

            <!-- Help Section -->
            @if(!$complaint)
            <div class="bg-white rounded-xl shadow-lg p-8">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Butuh Bantuan?</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-blue-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        <div>
                            <h4 class="font-medium text-gray-900">Customer Service</h4>
                            <p class="text-blue-600 font-semibold">(0281) 895-123</p>
                            <p class="text-sm text-gray-600">Senin - Jumat: 07:30 - 15:30</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <svg class="w-6 h-6 text-red-500 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.864-.833-2.634 0L5.18 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <div>
                            <h4 class="font-medium text-gray-900">Emergency Hotline</h4>
                            <p class="text-red-600 font-semibold">(0281) 895-911</p>
                            <p class="text-sm text-gray-600">24 Jam untuk keluhan darurat</p>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

@php
function formatBytes($bytes, $precision = 2) {
    $units = array('B', 'KB', 'MB', 'GB', 'TB');

    for ($i = 0; $bytes > 1024; $i++) {
        $bytes /= 1024;
    }

    return round($bytes, $precision) . ' ' . $units[$i];
}
@endphp
@endsection
