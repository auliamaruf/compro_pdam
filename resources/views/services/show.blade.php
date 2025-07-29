@extends('layouts.app')

@section('title', $service->name . ' - Layanan ' . ($company->company_name ?? 'Tirta Perwira'))

@section('meta')
<meta name="description" content="{{ Str::limit(strip_tags($service->description ?? ''), 160) }}">
<meta name="keywords" content="{{ $service->name }}, layanan, PDAM, {{ $company->company_name ?? 'Tirta Perwira' }}">
<meta property="og:title" content="{{ $service->name }}">
<meta property="og:description" content="{{ Str::limit(strip_tags($service->description), 160) }}">
<meta property="og:type" content="service">
<meta property="og:url" content="{{ route('services.show', $service->slug) }}">
@if($service->getFirstMediaUrl('icons'))
<meta property="og:image" content="{{ $service->getFirstMediaUrl('icons') }}">
@endif
@endsection

@section('content')
<!-- Breadcrumb -->
<nav class="bg-blue-50 py-4" aria-label="Breadcrumb">
    <div class="container mx-auto px-4">
        <ol class="flex items-center space-x-2 text-sm text-gray-600">
            <li>
                <a href="{{ route('home') }}" class="text-blue-600 hover:text-blue-800">Beranda</a>
            </li>
            <li class="flex items-center">
                <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <a href="{{ route('services') }}" class="text-blue-600 hover:text-blue-800">Layanan</a>
            </li>
            <li class="flex items-center">
                <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-gray-500">{{ Str::limit($service->name, 50) }}</span>
            </li>
        </ol>
    </div>
</nav>

<div class="container mx-auto px-8 lg:px-12 py-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-12">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <!-- Service Image -->
                @if($service->getFirstMediaUrl('icons'))
                <div class="aspect-[16/10] w-full overflow-hidden">
                    <img src="{{ $service->getFirstMediaUrl('icons') }}"
                         alt="{{ $service->name }}"
                         class="w-full h-full object-cover">
                </div>
                @endif

                <div class="p-8 lg:p-10">
                    <!-- Service Meta -->
                    <div class="flex items-center justify-between mb-4">
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                            @if($service->category === 'new_connection') bg-blue-100 text-blue-800
                            @elseif($service->category === 'billing') bg-green-100 text-green-800
                            @elseif($service->category === 'customer_service') bg-red-100 text-red-800
                            @elseif($service->category === 'technical') bg-purple-100 text-purple-800
                            @else bg-gray-100 text-gray-800
                            @endif">
                            {{ ucfirst($service->category) }}
                        </span>
                        @if($service->is_featured)
                        <span class="inline-flex items-center text-yellow-600 text-sm">
                            <svg class="w-4 h-4 mr-1.5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            Unggulan
                        </span>
                        @endif
                    </div>

                    <!-- Service Title -->
                    <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-4 leading-tight">
                        {{ $service->name }}
                    </h1>

                    <!-- Service Description -->
                    <div class="prose prose-base max-w-none mb-8">
                        {!! $service->description !!}
                    </div>                    <!-- Service Details -->
                    @if($service->requirements || $service->fee || $service->contact_person || $service->contact_phone)
                    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Requirements -->
                        @if($service->requirements && is_array($service->requirements))
                        <div class="bg-blue-50 p-6 rounded-lg">
                            <h3 class="text-base font-semibold text-gray-900 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Persyaratan
                            </h3>
                            <ul class="text-sm text-gray-700 list-disc list-inside space-y-1">
                                @foreach($service->requirements as $requirement)
                                <li>
                                    @if(is_array($requirement) && isset($requirement['requirement']))
                                        {{ $requirement['requirement'] }}
                                    @elseif(is_string($requirement))
                                        {{ $requirement }}
                                    @endif
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- Price Info -->
                        @if($service->fee)
                        <div class="bg-green-50 p-6 rounded-lg">
                            <h3 class="text-base font-semibold text-gray-900 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                </svg>
                                Informasi Biaya
                            </h3>
                            <div class="text-gray-700">
                                <div class="text-2xl font-bold text-green-600">Rp {{ number_format($service->fee, 0, ',', '.') }}</div>
                                @if($service->process_time)
                                <div class="text-sm text-gray-600 mt-1">Proses: {{ $service->process_time }}</div>
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                    @endif

                    <!-- Contact Info -->
                    @if($service->contact_person || $service->contact_phone)
                    <div class="mt-6 bg-yellow-50 p-6 rounded-lg">
                        <h3 class="text-base font-semibold text-gray-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Informasi Kontak
                        </h3>
                        <div class="text-sm text-gray-700 space-y-2">
                            @if($service->contact_person)
                            <div><span class="font-medium">Person in Charge:</span> {{ $service->contact_person }}</div>
                            @endif
                            @if($service->contact_phone)
                            <div>
                                <span class="font-medium">Telepon:</span>
                                <a href="tel:{{ $service->contact_phone }}" class="text-blue-600 hover:text-blue-800 ml-2">{{ $service->contact_phone }}</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    @endif

                    <!-- Procedure -->
                    @if($service->procedure)
                    <div class="mt-6 bg-gray-50 p-6 rounded-lg">
                        <h3 class="text-base font-semibold text-gray-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                            </svg>
                            Prosedur Layanan
                        </h3>
                        <div class="text-sm text-gray-700 leading-relaxed">
                            {!! $service->procedure !!}
                        </div>
                    </div>
                    @endif

                    <!-- Required Forms -->
                    @php
                        $uploadedForms = $service->getMedia('forms');
                        $externalForms = $service->forms && is_array($service->forms) ? $service->forms : [];
                        $hasAnyForms = $uploadedForms->count() > 0 || count($externalForms) > 0;
                    @endphp
                    
                    <div class="mt-6 bg-purple-50 p-6 rounded-lg">
                        <h3 class="text-base font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Formulir yang Diperlukan
                        </h3>
                        
                        @if($hasAnyForms)
                            <!-- Uploaded Forms -->
                            @if($uploadedForms->count() > 0)
                            <div class="mb-4">
                                <h4 class="text-sm font-medium text-gray-800 mb-2">Download Formulir:</h4>
                                <div class="space-y-3">
                                    @foreach($uploadedForms as $media)
                                    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center flex-1">
                                                <div class="flex-shrink-0 mr-3">
                                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="text-sm font-semibold text-gray-900 mb-1">
                                                        {{ $media->name }}
                                                    </div>
                                                    <div class="text-xs text-gray-500">
                                                        @php
                                                            $fileName = $media->file_name ?: $media->name;
                                                            $extension = strtoupper(pathinfo($fileName, PATHINFO_EXTENSION));
                                                            $sizeKB = number_format($media->size / 1024, 0);
                                                        @endphp
                                                        {{ $extension ? $extension : 'FILE' }} • {{ $sizeKB }} KB
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 ml-4">
                                                <a href="{{ route('services.download-form', [$service, $media->id]) }}" 
                                                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 text-white text-sm font-semibold rounded-lg hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl border border-blue-600">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V11a2 2 0 01-2 2z"></path>
                                                    </svg>
                                                    Download
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            
                            <!-- External Form Links -->
                            @if(count($externalForms) > 0)
                            <div>
                                <h4 class="text-sm font-medium text-gray-800 mb-2">Link Formulir External:</h4>
                                <div class="space-y-3">
                                    @foreach($externalForms as $form)
                                    @if(is_array($form) && isset($form['title']) && isset($form['url']))
                                    <div class="bg-white p-4 rounded-lg border border-gray-200 shadow-sm">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center flex-1">
                                                <div class="flex-shrink-0 mr-3">
                                                    <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2M14 4h6m0 0v6m0-6L10 14"></path>
                                                    </svg>
                                                </div>
                                                <div class="flex-1">
                                                    <div class="text-sm font-semibold text-gray-900 mb-1">
                                                        {{ $form['title'] }}
                                                    </div>
                                                    @if(isset($form['description']) && $form['description'])
                                                    <div class="text-xs text-gray-500">
                                                        {{ $form['description'] }}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 ml-4">
                                                <a href="{{ $form['url'] }}" 
                                                   target="_blank" 
                                                   rel="noopener noreferrer"
                                                   class="inline-flex items-center px-4 py-2 bg-gradient-to-r from-green-600 to-green-700 text-white text-sm font-semibold rounded-lg hover:from-green-700 hover:to-green-800 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl border border-green-600">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-2M14 4h6m0 0v6m0-6L10 14"></path>
                                                    </svg>
                                                    Buka Link
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        @else
                            <!-- Default message when no forms are available -->
                            <div class="bg-white p-4 rounded-lg border border-dashed border-gray-300">
                                <div class="text-center">
                                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    <h4 class="text-sm font-medium text-gray-900 mb-1">Formulir Belum Tersedia</h4>
                                    <p class="text-xs text-gray-500">Formulir untuk layanan ini sedang dalam proses penyiapan.</p>
                                    <p class="text-xs text-gray-500 mt-2">Silakan hubungi kantor PDAM untuk informasi lebih lanjut.</p>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="mt-8 flex flex-wrap gap-4">
                        <a href="{{ route('contact') }}"
                           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Hubungi Kami
                        </a>

                        @if($service->category === 'new_connection')
                        <a href="{{ route('services') }}"
                           class="inline-flex items-center px-6 py-3 bg-green-600 text-white text-sm font-medium rounded-lg hover:bg-green-700 transition-colors shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Layanan Lainnya
                        </a>
                        @endif
                        @if($service->category === 'customer_service')
                        <a href="{{ route('services.pengaduan') }}"
                           class="inline-flex items-center px-6 py-3 bg-red-600 text-white text-sm font-medium rounded-lg hover:bg-red-700 transition-colors shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.232 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                            </svg>
                            Ajukan Pengaduan
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Related Services -->
            @if($relatedServices->count() > 0)
            <div class="bg-white rounded-lg shadow-md p-6 mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-5">Layanan Terkait</h3>
                <div class="space-y-6">
                    @foreach($relatedServices as $related)
                    <div class="border-b border-gray-200 pb-5 last:border-b-0 last:pb-0">
                        <a href="{{ route('services.show', $related->slug) }}" class="block group">
                            @if($related->getFirstMediaUrl('icons'))
                            <div class="aspect-video w-full overflow-hidden rounded-lg mb-4">
                                <img src="{{ $related->getFirstMediaUrl('icons') }}"
                                     alt="{{ $related->name }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                            </div>
                            @endif
                            <h4 class="font-semibold text-base text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2 mb-2">
                                {{ $related->name }}
                            </h4>
                            <p class="text-sm text-gray-600 mt-2 line-clamp-2 leading-relaxed">
                                {{ Str::limit(strip_tags($related->description), 80) }}
                            </p>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Quick Links -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-xl font-bold text-gray-900 mb-5">Layanan Lainnya</h3>
                <div class="space-y-4">
                    <a href="{{ route('services.show', 'pemasangan-sambungan-baru-rumah-tangga') }}"
                       class="flex items-center p-4 rounded-lg bg-blue-50 hover:bg-blue-100 transition-colors group">
                        <svg class="w-5 h-5 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-blue-800">Sambungan Rumah Tangga</span>
                    </a>
                    <a href="https://pengaduan.pdampurbalingga.co.id" target="_blank" rel="noopener noreferrer"
                       class="flex items-center p-4 rounded-lg bg-red-50 hover:bg-red-100 transition-colors group">
                        <svg class="w-5 h-5 text-red-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.232 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-red-800">Pengaduan</span>
                    </a>
                    <a href="{{ route('services.pembayaran') }}"
                       class="flex items-center p-4 rounded-lg bg-green-50 hover:bg-green-100 transition-colors group">
                        <svg class="w-5 h-5 text-green-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-green-800">Pembayaran</span>
                    </a>
                    <a href="https://tagihan.pdampurbalingga.co.id" target="_blank" rel="noopener noreferrer"
                       class="flex items-center p-4 rounded-lg bg-purple-50 hover:bg-purple-100 transition-colors group">
                        <svg class="w-5 h-5 text-purple-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        <span class="text-sm font-medium text-gray-700 group-hover:text-purple-800">Cek Tagihan</span>
                    </a>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <a href="{{ route('services') }}" class="text-blue-600 hover:text-blue-800 text-sm font-medium">
                        Lihat Semua Layanan →
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
