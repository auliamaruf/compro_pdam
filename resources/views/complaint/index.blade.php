@extends('layouts.app')

@section('title', 'Pengaduan Online - Tirta Perwira PDAM Purbalingga')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <!-- Hero Section -->
    <section class="bg-red-600 text-white py-16">
        <div class="container-custom">
            <div class="max-w-3xl mx-auto text-center">
                <h1 class="text-4xl lg:text-5xl font-bold mb-6">Pengaduan Online</h1>
                <p class="text-xl text-red-100">
                    Sampaikan keluhan Anda, kami siap membantu menyelesaikannya
                </p>
            </div>
        </div>
    </section>

    <div class="container-custom py-8">
        <!-- Quick Actions -->
        <div class="mb-8">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Ajukan Keluhan Baru</h3>
                        <p class="text-gray-600 mb-4">Isi form di bawah ini untuk mengajukan keluhan terkait layanan air</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Lacak Status Keluhan</h3>
                        <p class="text-gray-600 mb-4">Cek progres penanganan keluhan Anda dengan nomor tiket</p>
                        <a href="{{ route('complaint.track.alt') }}" class="btn-secondary">Lacak Keluhan</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Complaint Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Form Pengaduan</h2>

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

                    <form action="{{ route('complaint.store.alt') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                        @csrf

                        <!-- Customer Information -->
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Informasi Pelanggan</h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="customer_name" class="form-label">Nama Lengkap <span class="text-red-500">*</span></label>
                                    <input type="text"
                                           id="customer_name"
                                           name="customer_name"
                                           value="{{ old('customer_name') }}"
                                           class="form-input @error('customer_name') border-red-500 @enderror"
                                           required>
                                    @error('customer_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="customer_id_number" class="form-label">Nomor Pelanggan/ID</label>
                                    <input type="text"
                                           id="customer_id_number"
                                           name="customer_id_number"
                                           value="{{ old('customer_id_number') }}"
                                           class="form-input @error('customer_id_number') border-red-500 @enderror"
                                           placeholder="Opsional">
                                    @error('customer_id_number')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
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
                                <div>
                                    <label for="phone" class="form-label">Nomor Telepon <span class="text-red-500">*</span></label>
                                    <input type="tel"
                                           id="phone"
                                           name="phone"
                                           value="{{ old('phone') }}"
                                           class="form-input @error('phone') border-red-500 @enderror"
                                           placeholder="08xxxxxxxxxx"
                                           required>
                                    @error('phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-6">
                                <label for="address" class="form-label">Alamat Lengkap <span class="text-red-500">*</span></label>
                                <textarea id="address"
                                          name="address"
                                          rows="3"
                                          class="form-textarea @error('address') border-red-500 @enderror"
                                          required>{{ old('address') }}</textarea>
                                @error('address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Complaint Details -->
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Detail Keluhan</h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>                                    <label for="complaint_type" class="form-label">Jenis Keluhan <span class="text-red-500">*</span></label>
                                    <select id="complaint_type"
                                            name="complaint_type"
                                            class="form-input @error('complaint_type') border-red-500 @enderror"
                                            required>
                                        <option value="">Pilih jenis keluhan...</option>
                                        <option value="billing" {{ old('complaint_type') == 'billing' ? 'selected' : '' }}>Tagihan</option>
                                        <option value="water_quality" {{ old('complaint_type') == 'water_quality' ? 'selected' : '' }}>Kualitas Air</option>
                                        <option value="water_pressure" {{ old('complaint_type') == 'water_pressure' ? 'selected' : '' }}>Tekanan Air</option>
                                        <option value="service_connection" {{ old('complaint_type') == 'service_connection' ? 'selected' : '' }}>Sambungan Baru</option>
                                        <option value="pipe_damage" {{ old('complaint_type') == 'pipe_damage' ? 'selected' : '' }}>Kerusakan Pipa</option>
                                        <option value="meter_reading" {{ old('complaint_type') == 'meter_reading' ? 'selected' : '' }}>Pembacaan Meter</option>
                                        <option value="other" {{ old('complaint_type') == 'other' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('complaint_type')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="priority" class="form-label">Tingkat Prioritas <span class="text-red-500">*</span></label>
                                    <select id="priority"
                                            name="priority"
                                            class="form-input @error('priority') border-red-500 @enderror"
                                            required>
                                        <option value="">Pilih prioritas...</option>
                                        <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Rendah</option>
                                        <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Sedang</option>
                                        <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>Tinggi</option>
                                        <option value="urgent" {{ old('priority') == 'urgent' ? 'selected' : '' }}>Mendesak</option>
                                    </select>
                                    @error('priority')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="mt-6">
                                <label for="subject" class="form-label">Subjek Keluhan <span class="text-red-500">*</span></label>
                                <input type="text"
                                       id="subject"
                                       name="subject"
                                       value="{{ old('subject') }}"
                                       class="form-input @error('subject') border-red-500 @enderror"
                                       placeholder="Ringkasan singkat masalah Anda"
                                       required>
                                @error('subject')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mt-6">
                                <label for="description" class="form-label">Deskripsi Keluhan <span class="text-red-500">*</span></label>
                                <textarea id="description"
                                          name="description"
                                          rows="5"
                                          class="form-textarea @error('description') border-red-500 @enderror"
                                          placeholder="Jelaskan detail masalah yang Anda alami..."
                                          required>{{ old('description') }}</textarea>
                                @error('description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">Maksimal 2000 karakter</p>
                            </div>
                        </div>

                        <!-- File Attachments -->
                        <div class="pb-6">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Lampiran (Opsional)</h3>

                            <div>
                                <label for="attachments" class="form-label">Upload File</label>
                                <input type="file"
                                       id="attachments"
                                       name="attachments[]"
                                       multiple
                                       class="form-input @error('attachments.*') border-red-500 @enderror"
                                       accept=".jpg,.jpeg,.png,.pdf,.doc,.docx">
                                @error('attachments.*')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">
                                    Format yang diperbolehkan: JPG, PNG, PDF, DOC, DOCX. Maksimal 2MB per file.
                                </p>
                            </div>
                        </div>

                        <button type="submit" class="btn-primary w-full">
                            <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            Kirim Keluhan
                        </button>

                        <p class="text-xs text-gray-500 text-center">
                            Keluhan Anda akan mendapat nomor tiket unik untuk tracking. Kami akan menghubungi Anda dalam 1x24 jam.
                        </p>
                    </form>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="lg:col-span-1">
                <!-- Contact Info -->
                <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Penting</h3>
                    <div class="space-y-4 text-sm text-gray-600">
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="font-medium">Respon Cepat</p>
                                <p>Keluhan mendesak akan ditanggapi dalam 1-4 jam</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-green-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="font-medium">Tracking Otomatis</p>
                                <p>Setiap keluhan mendapat nomor tiket untuk pelacakan</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <svg class="w-5 h-5 text-purple-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                            </svg>
                            <div>
                                <p class="font-medium">Update Berkala</p>
                                <p>Anda akan mendapat notifikasi perkembangan via email/SMS</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="bg-red-50 border border-red-200 rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-red-800 mb-4">Darurat 24 Jam</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            <div>
                                <p class="text-sm font-medium text-red-800">Hotline Darurat</p>
                                <p class="text-lg font-bold text-red-600">(0281) 895-911</p>
                            </div>
                        </div>
                        <p class="text-sm text-red-600">
                            Untuk keluhan darurat seperti kebocoran pipa utama, kontaminasi air, atau gangguan total layanan
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
