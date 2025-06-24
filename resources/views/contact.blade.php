@extends('layouts.app')

@section('title', 'Kontak - ' . ($company->company_name ?? 'Tirta Perwira PDAM Purbalingga'))

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content container-custom">
            <div class="max-w-4xl mx-auto text-center">
                <h1 class="hero-title">Hubungi Kami</h1>
                <p class="hero-description">
                    {{ ($company && $company->company_tagline && is_string($company->company_tagline)) ? $company->company_tagline : 'Kami siap melayani Anda dengan sepenuh hati' }}
                </p>
            </div>
        </div>
        <div class="hero-wave">
            <svg viewBox="0 0 1200 120" class="w-full h-12 fill-current text-blue-50">
                <path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z"></path>
            </svg>
        </div>
    </section>

    <!-- Contact Info -->
    <section class="section-padding">
        <div class="container-custom">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Contact Information -->
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Kontak</h2>

                    <div class="space-y-6">
                        <!-- Address -->
                        @if($company->address)
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Alamat</h3>
                                <p class="text-gray-600">{!! nl2br(e($company->address)) !!}</p>
                            </div>
                        </div>
                        @endif

                        <!-- Phone -->
                        @if($company && $company->phone && is_string($company->phone))
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Telepon</h3>
                                <a href="tel:{{ $company->phone }}" class="text-gray-600 hover:text-blue-600 transition-colors">
                                    {{ $company->phone }}
                                </a>
                            </div>
                        </div>
                        @endif

                        <!-- Email -->
                        @if($company && $company->email && is_string($company->email))
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                                <a href="mailto:{{ $company->email }}" class="text-gray-600 hover:text-blue-600 transition-colors">
                                    {{ $company->email }}
                                </a>
                            </div>
                        </div>
                        @endif

                        <!-- Emergency Phone -->
                        @if($company && $company->emergency_phone && is_string($company->emergency_phone) && $company->emergency_phone !== $company->phone)
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Telepon Darurat</h3>
                                <a href="tel:{{ $company->emergency_phone }}" class="text-gray-600 hover:text-orange-600 transition-colors">
                                    {{ $company->emergency_phone }}
                                </a>
                            </div>
                        </div>
                        @endif

                        <!-- WhatsApp CS -->
                        @if($company && $company->whatsapp_cs && is_string($company->whatsapp_cs))
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.403"/>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">WhatsApp Customer Service</h3>
                                <a href="https://wa.me/{{ str_replace(['+', '-', ' '], '', $company->whatsapp_cs) }}"
                                   target="_blank"
                                   class="text-gray-600 hover:text-green-600 transition-colors">
                                    {{ $company->whatsapp_cs }}
                                </a>
                            </div>
                        </div>
                        @endif

                        <!-- Office Hours -->
                        @if($company && $company->office_hours && is_string($company->office_hours))
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Jam Operasional</h3>
                                <div class="text-gray-600">
                                    @if(is_array($company->office_hours))
                                        @foreach($company->office_hours as $key => $value)
                                            @if($key === 'weekdays' || $key === 'days')
                                                <p><strong>{{ $value['label'] ?? 'Senin - Jumat' }}:</strong> {{ $value['hours'] ?? $value }}</p>
                                            @elseif($key === 'saturday' && $value)
                                                <p><strong>Sabtu:</strong> {{ $value['hours'] ?? $value }}</p>
                                            @elseif($key === 'sunday' && $value)
                                                <p><strong>Minggu:</strong> {{ $value['hours'] ?? $value }}</p>
                                            @elseif(is_string($value))
                                                <p>{{ $value }}</p>
                                            @endif
                                        @endforeach
                                    @else
                                        <p>{{ $company->office_hours }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                        <!-- Website -->
                        @if($company && $company->website && is_string($company->website))
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900 mb-1">Website</h3>
                                <a href="{{ $company->website }}"
                                   target="_blank"
                                   class="text-gray-600 hover:text-blue-600 transition-colors">
                                    {{ $company->website }}
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h2>

                    <!-- Success/Error Messages -->
                    @if(session('success'))
                        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                            <div class="flex">
                                <svg class="w-5 h-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

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

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="form-label">Nama Lengkap <span class="text-red-500">*</span></label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       value="{{ old('name') }}"
                                       class="form-input @error('name') border-red-500 @enderror"
                                       required>
                                @error('name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="email" class="form-label">Email <span class="text-red-500">*</span></label>
                                <input type="email"
                                       id="email"
                                       name="email"
                                       value="{{ old('email') }}"
                                       class="form-input @error('email') border-red-500 @enderror"
                                       required>
                                @error('email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="phone" class="form-label">Nomor Telepon</label>
                            <input type="tel"
                                   id="phone"
                                   name="phone"
                                   value="{{ old('phone') }}"
                                   class="form-input @error('phone') border-red-500 @enderror"
                                   placeholder="08xxxxxxxxxx">
                            @error('phone')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="type" class="form-label">Jenis Pesan <span class="text-red-500">*</span></label>
                            <select id="type"
                                    name="type"
                                    class="form-input @error('type') border-red-500 @enderror"
                                    required>
                                <option value="">Pilih jenis pesan...</option>
                                <option value="general" {{ old('type') == 'general' ? 'selected' : '' }}>Umum</option>
                                <option value="complaint" {{ old('type') == 'complaint' ? 'selected' : '' }}>Keluhan</option>
                                <option value="suggestion" {{ old('type') == 'suggestion' ? 'selected' : '' }}>Saran</option>
                                <option value="service_info" {{ old('type') == 'service_info' ? 'selected' : '' }}>Info Layanan</option>
                                <option value="technical_support" {{ old('type') == 'technical_support' ? 'selected' : '' }}>Bantuan Teknis</option>
                            </select>
                            @error('type')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="subject" class="form-label">Subjek <span class="text-red-500">*</span></label>
                            <input type="text"
                                   id="subject"
                                   name="subject"
                                   value="{{ old('subject') }}"
                                   class="form-input @error('subject') border-red-500 @enderror"
                                   required>
                            @error('subject')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="message" class="form-label">Pesan <span class="text-red-500">*</span></label>
                            <textarea id="message"
                                      name="message"
                                      rows="5"
                                      class="form-textarea @error('message') border-red-500 @enderror"
                                      required>{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Maksimal 2000 karakter</p>
                        </div>

                        <button type="submit" class="btn-primary w-full">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Kirim Pesan
                        </button>

                        <p class="text-xs text-gray-500 text-center">
                            Dengan mengirim pesan ini, Anda menyetujui bahwa data yang diberikan akan digunakan untuk memberikan respon terbaik atas pertanyaan Anda.
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
