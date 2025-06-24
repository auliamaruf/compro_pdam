@extends('layouts.app')

@section('title', 'Struktur Organisasi - Tirta Perwira')
@section('description', 'Struktur organisasi dan kepemimpinan PDAM Tirta Perwira Purbalingga dalam mengelola pelayanan air bersih')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-cyan-50">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container-custom">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="hero-title">Struktur Organisasi</h1>
                <p class="hero-description">
                    Kepemimpinan dan tim profesional yang menggerakkan {{ $company->company_name ?? 'PDAM Tirta Perwira' }}
                </p>
            </div>
        </div>
        <div class="hero-wave">
            <svg viewBox="0 0 1200 120" class="w-full h-12 fill-current text-blue-50">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"></path>
            </svg>
        </div>
    </section>

    <!-- Organizational Chart -->
    <section class="py-12">
        <div class="container-custom">
            <div class="max-w-6xl mx-auto">
                <!-- Section Title -->
                <div class="text-center mb-8">
                    <h2 class="text-2xl lg:text-3xl font-bold text-gray-900 mb-3">Bagan Organisasi</h2>
                    <p class="text-base text-gray-600 max-w-3xl mx-auto">
                        {{ (is_string($company->organization_structure_description ?? '') ? $company->organization_structure_description : 'Struktur kepemimpinan dan pembagian tanggung jawab dalam organisasi') }}
                    </p>
                </div>                <!-- Organization Chart with Hierarchical Structure -->
                <div class="space-y-6">
                    @if($company && $company->organization_structure && is_array($company->organization_structure))

                        <!-- Level 1: Direktur Utama -->
                        @if(isset($company->organization_structure[0]) && is_array($company->organization_structure[0]))
                            <div class="text-center">
                                <div class="inline-block">
                                    <div class="bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg shadow-lg p-4 max-w-xs mx-auto">
                                        <div class="bg-white w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-3">
                                            @if(isset($company->organization_structure[0][0]['icon']) && is_string($company->organization_structure[0][0]['icon']))
                                                {!! $company->organization_structure[0][0]['icon'] !!}
                                            @else
                                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            @endif
                                        </div>
                                        <h2 class="text-base font-bold mb-1">{{ $company->organization_structure[0][0]['title'] ?? 'Direktur Utama' }}</h2>
                                        <p class="text-blue-100 font-medium text-sm mb-1">{{ $company->organization_structure[0][0]['name'] ?? '' }}</p>
                                        <p class="text-blue-50 text-xs">{{ $company->organization_structure[0][0]['subtitle'] ?? 'Chief Executive Officer' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Connection Line -->
                            <div class="flex justify-center">
                                <div class="w-px h-4 bg-blue-300"></div>
                            </div>
                        @endif

                        <!-- Level 2: Direktur Umum -->
                        @if(isset($company->organization_structure[1]) && is_array($company->organization_structure[1]))
                            <div class="text-center">
                                <div class="inline-block">
                                    <div class="bg-white rounded-lg shadow-md border-2 border-green-200 p-3 max-w-xs mx-auto">
                                        <div class="bg-green-100 w-10 h-10 rounded-full flex items-center justify-center mx-auto mb-2">
                                            @if(isset($company->organization_structure[1][0]['icon']) && is_string($company->organization_structure[1][0]['icon']))
                                                {!! $company->organization_structure[1][0]['icon'] !!}
                                            @else
                                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            @endif
                                        </div>
                                        <h3 class="text-sm font-bold text-gray-900 mb-1">{{ $company->organization_structure[1][0]['title'] ?? 'Direktur Umum' }}</h3>
                                        <p class="text-green-600 font-medium text-xs mb-1">{{ $company->organization_structure[1][0]['name'] ?? '' }}</p>
                                        <p class="text-gray-600 text-xs">{{ $company->organization_structure[1][0]['subtitle'] ?? 'General Director' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Connection Line -->
                            <div class="flex justify-center">
                                <div class="w-px h-4 bg-green-300"></div>
                            </div>
                        @endif

                        <!-- Level 3: Kepala Bagian -->
                        @if(isset($company->organization_structure[2]) && is_array($company->organization_structure[2]))
                            <div class="mb-4">
                                <div class="text-center mb-3">
                                    <h3 class="text-lg font-bold text-gray-900 mb-1">Kepala Bagian</h3>
                                    <p class="text-gray-600 text-sm">Divisi utama dalam struktur organisasi</p>
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3 max-w-5xl mx-auto">
                                    @foreach($company->organization_structure[2] as $position)
                                        @if(is_array($position))
                                            @php
                                                $color = (isset($position['color']) && is_string($position['color'])) ? $position['color'] : 'blue';
                                                $colorClass = match($color) {
                                                    'green' => 'bg-green-100 border-green-200',
                                                    'orange' => 'bg-orange-100 border-orange-200',
                                                    'purple' => 'bg-purple-100 border-purple-200',
                                                    'red' => 'bg-red-100 border-red-200',
                                                    'yellow' => 'bg-yellow-100 border-yellow-200',
                                                    'cyan' => 'bg-cyan-100 border-cyan-200',
                                                    default => 'bg-blue-100 border-blue-200'
                                                };
                                                $textColorClass = match($color) {
                                                    'green' => 'text-green-600',
                                                    'orange' => 'text-orange-600',
                                                    'purple' => 'text-purple-600',
                                                    'red' => 'text-red-600',
                                                    'yellow' => 'text-yellow-600',
                                                    'cyan' => 'text-cyan-600',
                                                    default => 'text-blue-600'
                                                };
                                            @endphp
                                            <div class="bg-white rounded-lg shadow-md border {{ $colorClass }} p-3 text-center hover:shadow-lg transition-shadow">
                                                <div class="{{ str_replace('border-', 'bg-', $colorClass) }} w-8 h-8 rounded-full flex items-center justify-center mx-auto mb-2">
                                                    {!! (isset($position['icon']) && is_string($position['icon'])) ? $position['icon'] : '<svg class="w-4 h-4 '.$textColorClass.'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>' !!}
                                                </div>
                                                <h4 class="text-xs font-bold text-gray-900 mb-1 leading-tight">{{ (isset($position['title']) && is_string($position['title'])) ? $position['title'] : '' }}</h4>
                                                <p class="{{ $textColorClass }} font-medium text-xs mb-1">{{ (isset($position['name']) && is_string($position['name'])) ? $position['name'] : '' }}</p>
                                                <p class="text-gray-600 text-xs">{{ (isset($position['subtitle']) && is_string($position['subtitle'])) ? $position['subtitle'] : '' }}</p>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Sub Bagian Groups -->
                        <div class="space-y-8">

                            <!-- Sub Bagian under Bagian Umum -->
                            @if(isset($company->organization_structure[3]) && is_array($company->organization_structure[3]))
                                <div class="bg-purple-50 rounded-xl p-5">
                                    <div class="flex items-center justify-center mb-4">
                                        <div class="bg-purple-100 w-8 h-8 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                                        </div>
                                        <h3 class="text-lg font-bold text-purple-900">Sub Bagian - Bagian Umum</h3>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-3">
                                        @foreach($company->organization_structure[3] as $position)
                                            @if(is_array($position))
                                                <div class="bg-white rounded-md shadow-sm border border-purple-200 p-3 text-center hover:shadow-md transition-shadow">
                                                    <div class="bg-purple-100 w-8 h-8 rounded-full flex items-center justify-center mx-auto mb-2">
                                                        {!! (isset($position['icon']) && is_string($position['icon'])) ? $position['icon'] : '<svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>' !!}
                                                    </div>
                                                    <h5 class="text-xs font-bold text-gray-900 mb-1 leading-tight">{{ (isset($position['title']) && is_string($position['title'])) ? $position['title'] : '' }}</h5>
                                                    <p class="text-purple-600 font-medium text-xs mb-1">{{ (isset($position['name']) && is_string($position['name'])) ? $position['name'] : '' }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Sub Bagian under Bagian Teknik -->
                            @if(isset($company->organization_structure[4]) && is_array($company->organization_structure[4]))
                                <div class="bg-orange-50 rounded-xl p-5">
                                    <div class="flex items-center justify-center mb-4">
                                        <div class="bg-orange-100 w-8 h-8 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                        </div>
                                        <h3 class="text-lg font-bold text-orange-900">Sub Bagian - Bagian Teknik</h3>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
                                        @foreach($company->organization_structure[4] as $position)
                                            @if(is_array($position))
                                                <div class="bg-white rounded-md shadow-sm border border-orange-200 p-3 text-center hover:shadow-md transition-shadow">
                                                    <div class="bg-orange-100 w-8 h-8 rounded-full flex items-center justify-center mx-auto mb-2">
                                                        {!! (isset($position['icon']) && is_string($position['icon'])) ? $position['icon'] : '<svg class="w-4 h-4 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>' !!}
                                                    </div>
                                                    <h5 class="text-xs font-bold text-gray-900 mb-1 leading-tight">{{ (isset($position['title']) && is_string($position['title'])) ? $position['title'] : '' }}</h5>
                                                    <p class="text-orange-600 font-medium text-xs mb-1">{{ (isset($position['name']) && is_string($position['name'])) ? $position['name'] : '' }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Sub Bagian under Bagian Hubungan Langganan -->
                            @if(isset($company->organization_structure[5]) && is_array($company->organization_structure[5]))
                                <div class="bg-cyan-50 rounded-xl p-5">
                                    <div class="flex items-center justify-center mb-4">
                                        <div class="bg-cyan-100 w-8 h-8 rounded-full flex items-center justify-center mr-2">
                                            <svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                                        </div>
                                        <h3 class="text-lg font-bold text-cyan-900">Sub Bagian - Bagian Hubungan Langganan</h3>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                        @foreach($company->organization_structure[5] as $position)
                                            @if(is_array($position))
                                                <div class="bg-white rounded-md shadow-sm border border-cyan-200 p-3 text-center hover:shadow-md transition-shadow">
                                                    <div class="bg-cyan-100 w-8 h-8 rounded-full flex items-center justify-center mx-auto mb-2">
                                                        {!! (isset($position['icon']) && is_string($position['icon'])) ? $position['icon'] : '<svg class="w-4 h-4 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>' !!}
                                                    </div>
                                                    <h5 class="text-xs font-bold text-gray-900 mb-1 leading-tight">{{ (isset($position['title']) && is_string($position['title'])) ? $position['title'] : '' }}</h5>
                                                    <p class="text-cyan-600 font-medium text-xs mb-1">{{ (isset($position['name']) && is_string($position['name'])) ? $position['name'] : '' }}</p>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                        </div>
                    @else
                        <!-- Default organization chart if no data -->
                        <div class="flex justify-center">
                            <div class="bg-white rounded-xl shadow-lg p-6 text-center max-w-sm border-2 border-blue-200">
                                <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">Direktur Utama</h3>
                                <p class="text-blue-600 text-sm mb-2">Chief Executive Officer</p>
                                <p class="text-gray-600 text-sm">Pemimpin tertinggi organisasi yang bertanggung jawab atas keseluruhan operasional perusahaan</p>
                            </div>
                        </div>

                        <!-- Connection Line -->
                        <div class="flex justify-center">
                            <div class="w-px h-8 bg-blue-200"></div>
                        </div>

                        <!-- Level 2: Divisi Utama -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                            <!-- Direktur Teknik -->
                            <div class="bg-white rounded-xl shadow-lg p-6 text-center border border-gray-200">
                                <div class="bg-green-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-md font-bold text-gray-900 mb-1">Direktur Teknik</h4>
                                <p class="text-green-600 text-sm mb-2">Technical Director</p>
                                <p class="text-gray-600 text-xs">Mengelola operasional teknis dan infrastruktur</p>
                            </div>

                            <!-- Direktur Keuangan -->
                            <div class="bg-white rounded-xl shadow-lg p-6 text-center border border-gray-200">
                                <div class="bg-orange-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                <h4 class="text-md font-bold text-gray-900 mb-1">Direktur Keuangan</h4>
                                <p class="text-orange-600 text-sm mb-2">Finance Director</p>
                                <p class="text-gray-600 text-xs">Mengelola keuangan dan akuntansi perusahaan</p>
                            </div>

                            <!-- Direktur Umum -->
                            <div class="bg-white rounded-xl shadow-lg p-6 text-center border border-gray-200">
                                <div class="bg-purple-100 w-12 h-12 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="text-md font-bold text-gray-900 mb-1">Direktur Umum</h4>
                                <p class="text-purple-600 text-sm mb-2">General Affairs Director</p>
                                <p class="text-gray-600 text-xs">Mengelola SDM dan administrasi umum</p>
                            </div>
                        </div>

                        <!-- Connection Lines Level 2 -->
                        <div class="flex justify-center">
                            <div class="w-px h-8 bg-blue-200"></div>
                        </div>

                        <!-- Level 3: Departemen -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                            <!-- Bagian Produksi -->
                            <div class="bg-white rounded-lg shadow p-4 text-center border border-gray-200">
                                <div class="bg-blue-100 w-10 h-10 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path>
                                    </svg>
                                </div>
                                <h5 class="text-sm font-semibold text-gray-900 mb-1">Bagian Produksi</h5>
                                <p class="text-xs text-gray-600">Pengolahan & distribusi air</p>
                            </div>

                            <!-- Bagian Distribusi -->
                            <div class="bg-white rounded-lg shadow p-4 text-center border border-gray-200">
                                <div class="bg-cyan-100 w-10 h-10 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-5 h-5 text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16l2.879-2.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242zM21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h5 class="text-sm font-semibold text-gray-900 mb-1">Bagian Distribusi</h5>
                                <p class="text-xs text-gray-600">Jaringan pipa & pelayanan</p>
                            </div>

                            <!-- Bagian Keuangan -->
                            <div class="bg-white rounded-lg shadow p-4 text-center border border-gray-200">
                                <div class="bg-green-100 w-10 h-10 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <h5 class="text-sm font-semibold text-gray-900 mb-1">Bagian Keuangan</h5>
                                <p class="text-xs text-gray-600">Akuntansi & pelaporan</p>
                            </div>

                            <!-- Bagian SDM -->
                            <div class="bg-white rounded-lg shadow p-4 text-center border border-gray-200">
                                <div class="bg-purple-100 w-10 h-10 rounded-full flex items-center justify-center mx-auto mb-3">
                                    <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z"></path>
                                    </svg>
                                </div>
                                <h5 class="text-sm font-semibold text-gray-900 mb-1">Bagian SDM</h5>
                                <p class="text-xs text-gray-600">Pengembangan karyawan</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Organizational Values -->
    <section class="py-16">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-12">
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Budaya Organisasi</h2>
                    <p class="text-lg text-gray-600 max-w-3xl mx-auto">
                        Nilai-nilai yang menjadi landasan dalam setiap aktivitas dan pengambilan keputusan
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @if($company && $company->organizational_culture && is_array($company->organizational_culture))
                        @foreach($company->organizational_culture as $culture)
                            @if(is_array($culture))
                                <div class="text-center group">
                                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                                        {!! (isset($culture['icon']) && is_string($culture['icon'])) ? $culture['icon'] : '<svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>' !!}
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ (isset($culture['name']) && is_string($culture['name'])) ? $culture['name'] : '' }}</h3>
                                    <p class="text-gray-600 text-sm">{{ (isset($culture['description']) && is_string($culture['description'])) ? $culture['description'] : '' }}</p>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <!-- Default culture values if no data -->
                        <div class="text-center group">
                            <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-200 transition-colors">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Integritas</h3>
                            <p class="text-gray-600 text-sm">Kejujuran dan transparansi dalam setiap tindakan</p>
                        </div>
                        <div class="text-center group">
                            <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-200 transition-colors">
                                <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Inovasi</h3>
                            <p class="text-gray-600 text-sm">Terus mencari cara baru untuk meningkatkan pelayanan</p>
                        </div>
                        <div class="text-center group">
                            <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-200 transition-colors">
                                <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Kerjasama</h3>
                            <p class="text-gray-600 text-sm">Sinergitas tim untuk mencapai tujuan bersama</p>
                        </div>
                        <div class="text-center group">
                            <div class="bg-orange-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-orange-200 transition-colors">
                                <svg class="w-8 h-8 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                </svg>
                            </div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Dedikasi</h3>
                            <p class="text-gray-600 text-sm">Komitmen penuh untuk melayani masyarakat</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Leadership -->
    <section class="py-16 bg-gradient-to-r from-blue-900 to-blue-700 text-white">
        <div class="container mx-auto px-4 lg:px-8">
            <div class="max-w-4xl mx-auto text-center">
                <h2 class="text-3xl lg:text-4xl font-bold mb-6">Hubungi Tim Kami</h2>
                <p class="text-xl text-blue-100 leading-relaxed mb-8">
                    Tim profesional kami siap membantu dan melayani kebutuhan air bersih Anda
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('contact') }}" class="inline-flex items-center px-6 py-3 bg-white text-blue-900 font-medium rounded-lg hover:bg-blue-50 transition-colors">
                        <span>Hubungi Kami</span>
                        <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </a>
                    <a href="{{ route('services') }}" class="inline-flex items-center px-6 py-3 bg-transparent border-2 border-white text-white font-medium rounded-lg hover:bg-white hover:text-blue-900 transition-colors">
                        <span>Lihat Layanan</span>
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
