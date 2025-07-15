@extends('layouts.app')

@section('title', 'Kontak - ' . ($company->company_name ?? 'Tirta Perwira PDAM Purbalingga'))

@section('content')
<div class="bg-white min-h-screen">
    <!-- Hero Section - Simplified -->
    <section class="bg-gradient-to-r from-blue-600 to-blue-700 py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center text-white">
                <h1 class="text-3xl lg:text-4xl font-bold mb-4">Hubungi Kami</h1>
                <p class="text-lg text-blue-100 mb-6">
                    {{ ($company && $company->company_tagline && is_string($company->company_tagline)) ? $company->company_tagline : 'Kami siap melayani Anda dengan sepenuh hati' }}
                </p>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="#contact-info" class="inline-flex items-center justify-center px-6 py-2.5 bg-white text-blue-700 font-medium rounded-lg hover:bg-blue-50 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        </svg>
                        Info Kontak
                    </a>
                    <a href="#contact-form" class="inline-flex items-center justify-center px-6 py-2.5 bg-transparent border border-white text-white font-medium rounded-lg hover:bg-white hover:text-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Kirim Pesan
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Information Section -->
    <section class="py-12 bg-gray-50" id="contact-info">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">Informasi Kontak</h2>
                    <p class="text-gray-600">Berbagai cara untuk menghubungi kami</p>
                </div>

                <!-- Contact Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                    @if($company && $company->phone && is_string($company->phone))
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-1">Telepon</h3>
                        <a href="tel:{{ $company->phone }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                            {{ $company->phone }}
                        </a>
                    </div>
                    @endif

                    @if($company && $company->whatsapp_cs && is_string($company->whatsapp_cs))
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.403"/>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-2">WhatsApp</h3>
                        <a href="https://wa.me/{{ str_replace(['+', '-', ' '], '', $company->whatsapp_cs) }}" 
                           target="_blank"
                           class="inline-flex items-center px-3 py-1.5 bg-green-500 text-white rounded text-xs font-medium hover:bg-green-600 transition-colors">
                            Chat Sekarang
                        </a>
                    </div>
                    @endif

                    @if($company && $company->email && is_string($company->email))
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                        <a href="mailto:{{ $company->email }}" class="text-purple-600 hover:text-purple-700 text-sm font-medium break-all">
                            {{ $company->email }}
                        </a>
                    </div>
                    @endif

                    @if($company && $company->office_hours && is_string($company->office_hours))
                    <div class="bg-white rounded-lg p-4 text-center shadow-sm hover:shadow-md transition-shadow">
                        <div class="w-12 h-12 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-1">Jam Kerja</h3>
                        <div class="text-gray-600 text-xs">
                            @if(is_array($company->office_hours))
                                @foreach($company->office_hours as $key => $value)
                                    @if($key === 'weekdays' || $key === 'days')
                                        <p>{{ $value['hours'] ?? $value }}</p>
                                    @elseif(is_string($value))
                                        <p>{{ $value }}</p>
                                    @endif
                                @endforeach
                            @else
                                <p>{{ $company->office_hours }}</p>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Address and Map Section -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- Address Card -->
                    @if($company->address)
                    <div class="bg-white rounded-lg p-6 shadow-sm">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900 mb-2">Alamat Kantor</h3>
                                <p class="text-gray-600 text-sm leading-relaxed mb-3">{!! nl2br(e($company->address)) !!}</p>
                                <button onclick="openGoogleMaps()" class="text-blue-600 hover:text-blue-700 text-sm font-medium flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                    </svg>
                                    Buka di Google Maps
                                </button>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Google Maps -->
                    <div class="bg-white rounded-lg overflow-hidden shadow-sm">
                        <div class="h-64">
                            <iframe 
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3956.823!2d109.3559!3d-7.3849!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6559734e8e30a1%3A0x302e35b01397830!2sPerumda%20Air%20Minum%20Tirta%20Perwira!5e0!3m2!1sid!2sid!4v1642000000000!5m2!1sid!2sid"
                                width="100%" 
                                height="100%" 
                                style="border:0;" 
                                allowfullscreen="" 
                                loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade"
                                class="w-full h-full">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="py-12 bg-white" id="contact-form">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <div class="text-center mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-3">Kirim Pesan</h2>
                    <p class="text-gray-600">Sampaikan pertanyaan, saran, atau keluhan Anda</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-6">
                    <!-- Success/Error Messages -->
                    @if(session('success'))
                        <div class="mb-4 bg-green-50 border-l-4 border-green-400 p-3 rounded">
                            <div class="flex">
                                <svg class="w-5 h-5 text-green-400 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 bg-red-50 border-l-4 border-red-400 p-3 rounded">
                            <div class="flex">
                                <svg class="w-5 h-5 text-red-400 mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                    </svg>
                                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('name') border-red-500 @enderror"
                                       placeholder="Masukkan nama lengkap"
                                       required>
                                @error('name')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                    Email <span class="text-red-500">*</span>
                                </label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('email') border-red-500 @enderror"
                                       placeholder="contoh@email.com"
                                       required>
                                @error('email')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon</label>
                                <input type="tel"
                                       id="phone"
                                       name="phone"
                                       value="{{ old('phone') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('phone') border-red-500 @enderror"
                                       placeholder="08xxxxxxxxxx">
                                @error('phone')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-1">
                                    Jenis Pesan <span class="text-red-500">*</span>
                                </label>
                                <select id="type"
                                        name="type"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('type') border-red-500 @enderror"
                                        required>
                                    <option value="">Pilih jenis pesan...</option>
                                    <option value="general" {{ old('type') == 'general' ? 'selected' : '' }}>Umum</option>
                                    <option value="complaint" {{ old('type') == 'complaint' ? 'selected' : '' }}>Keluhan</option>
                                    <option value="suggestion" {{ old('type') == 'suggestion' ? 'selected' : '' }}>Saran</option>
                                    <option value="service_info" {{ old('type') == 'service_info' ? 'selected' : '' }}>Info Layanan</option>
                                    <option value="technical_support" {{ old('type') == 'technical_support' ? 'selected' : '' }}>Bantuan Teknis</option>
                                </select>
                                @error('type')
                                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">
                                Subjek <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   id="subject"
                                   name="subject"
                                   value="{{ old('subject') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors @error('subject') border-red-500 @enderror"
                                   placeholder="Ringkasan pesan Anda"
                                   required>
                            @error('subject')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-medium text-gray-700 mb-1">
                                Pesan <span class="text-red-500">*</span>
                            </label>
                            <textarea id="message"
                                      name="message"
                                      rows="4"
                                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-vertical @error('message') border-red-500 @enderror"
                                      placeholder="Tuliskan pesan Anda dengan detail..."
                                      required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                            @enderror
                            <div class="flex justify-between items-center mt-1">
                                <span class="text-xs text-gray-500">Maksimal 2000 karakter</span>
                                <span id="charCount" class="text-xs text-gray-400">0/2000</span>
                            </div>
                        </div>

                        <div class="pt-4">
                            <button type="submit" 
                                    class="w-full bg-blue-600 text-white font-medium py-3 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                                <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                                Kirim Pesan
                            </button>
                        </div>

                        <div class="bg-blue-50 rounded-md p-3 border border-blue-200">
                            <p class="text-xs text-blue-700 text-center">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                                Data Anda akan dijaga kerahasiaannya dan hanya digunakan untuk memberikan respon terbaik.
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
<script>
// Google Maps function
function openGoogleMaps() {
    window.open('https://maps.app.goo.gl/Nudzdm5uyDemkZWu9', '_blank');
}

// Character counter for textarea
document.addEventListener('DOMContentLoaded', function() {
    const messageTextarea = document.getElementById('message');
    const charCount = document.getElementById('charCount');
    
    if (messageTextarea && charCount) {
        messageTextarea.addEventListener('input', function() {
            const currentLength = this.value.length;
            charCount.textContent = `${currentLength}/2000`;
            
            if (currentLength > 2000) {
                charCount.classList.add('text-red-500');
                charCount.classList.remove('text-gray-500');
            } else {
                charCount.classList.add('text-gray-500');
                charCount.classList.remove('text-red-500');
            }
        });
        
        // Initialize counter
        const initialLength = messageTextarea.value.length;
        charCount.textContent = `${initialLength}/2000`;
    }
    
    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});
</script>
@endpush

@endsection
