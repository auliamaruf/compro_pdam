{{-- Comment Form Component --}}
<div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mt-8">
    <h3 class="text-xl font-semibold text-gray-800 mb-6">
        <i class="fas fa-comments text-blue-600 mr-2"></i>
        Tinggalkan Komentar
    </h3>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
            <div class="flex">
                <div class="py-1">
                    <i class="fas fa-check-circle mr-2"></i>
                </div>
                <div>
                    {{ session('success') }}
                </div>
            </div>
        </div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4" role="alert">
            <div class="flex">
                <div class="py-1">
                    <i class="fas fa-exclamation-circle mr-2"></i>
                </div>
                <div>
                    {{ session('error') }}
                </div>
            </div>
        </div>
    @endif

    {{-- Comment Form --}}
    <form action="{{ route('comments.store') }}" method="POST" class="space-y-4" id="commentForm">
        @csrf
        
        {{-- Hidden fields for commentable --}}
        <input type="hidden" name="commentable_type" value="{{ $commentableType }}">
        <input type="hidden" name="commentable_id" value="{{ $commentableId }}">
        <input type="hidden" name="parent_id" id="parent_id" value="">
        
        {{-- Reply indicator --}}
        <div id="reply-indicator" class="hidden bg-blue-50 border-l-4 border-blue-400 p-3 mb-4 rounded">
            <div class="flex items-center justify-between">
                <span class="text-blue-800">
                    <i class="fas fa-reply mr-2"></i>
                    Membalas komentar: <span id="reply-to-name" class="font-semibold"></span>
                </span>
                <button type="button" onclick="cancelReply()" class="text-blue-600 hover:text-blue-800">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        
        {{-- Honeypot field (hidden spam protection) --}}
        <input type="text" name="website" style="display: none;" tabindex="-1" autocomplete="off">

        {{-- Name and Email Fields --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       name="name"
                       id="name"
                       value="{{ old('name') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                       required>
                @error('name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email"
                       name="email"
                       id="email"
                       value="{{ old('email') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                       required>
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
        </div>

        {{-- Comment Content Field --}}
        <div>
            <label for="comment" class="block text-sm font-medium text-gray-700 mb-2">
                Komentar <span class="text-red-500">*</span>
            </label>
            <textarea name="comment"
                      id="comment"
                      rows="4"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('comment') border-red-500 @enderror"
                      placeholder="Tulis komentar Anda di sini..."
                      required>{{ old('comment') }}</textarea>
            @error('comment')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        {{-- reCAPTCHA --}}
        <div class="mb-4">
            <div class="g-recaptcha" 
                 data-sitekey="{{ env('NOCAPTCHA_SITEKEY') }}"
                 data-callback="onCaptchaSuccess"
                 data-error-callback="onCaptchaError"
                 data-expired-callback="onCaptchaExpired"></div>
            @error('g-recaptcha-response')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            <div id="captcha-error" class="text-red-500 text-sm mt-1" style="display: none;">
                Verifikasi CAPTCHA wajib diisi.
            </div>
        </div>

        {{-- Submit Button --}}
        <div class="flex justify-end">
            <button type="submit" 
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition duration-200 flex items-center"
                    id="submitBtn">
                <i class="fas fa-paper-plane mr-2"></i>
                Kirim Komentar
            </button>
        </div>
    </form>
</div>

{{-- reCAPTCHA Script --}}
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<script>
// Global variables untuk reCAPTCHA
var captchaVerified = false;

// Callback ketika reCAPTCHA berhasil diverifikasi
function onCaptchaSuccess(token) {
    console.log('reCAPTCHA verified successfully');
    captchaVerified = true;
    document.getElementById('captcha-error').style.display = 'none';
}

// Callback ketika reCAPTCHA error
function onCaptchaError() {
    console.log('reCAPTCHA error occurred');
    captchaVerified = false;
    document.getElementById('captcha-error').style.display = 'block';
    document.getElementById('captcha-error').textContent = 'Terjadi error pada CAPTCHA. Silakan refresh halaman.';
}

// Callback ketika reCAPTCHA expired
function onCaptchaExpired() {
    console.log('reCAPTCHA expired');
    captchaVerified = false;
    document.getElementById('captcha-error').style.display = 'block';
    document.getElementById('captcha-error').textContent = 'CAPTCHA telah expired. Silakan verifikasi ulang.';
}

// Validasi form sebelum submit
document.getElementById('commentForm').addEventListener('submit', function(e) {
    var captchaResponse = grecaptcha.getResponse();
    
    if (!captchaResponse || captchaResponse.length === 0) {
        e.preventDefault();
        document.getElementById('captcha-error').style.display = 'block';
        document.getElementById('captcha-error').textContent = 'Verifikasi CAPTCHA wajib diisi.';
        
        // Scroll ke captcha
        document.querySelector('.g-recaptcha').scrollIntoView({ 
            behavior: 'smooth', 
            block: 'center' 
        });
        
        return false;
    }
    
    // Jika captcha terisi, sembunyikan error dan lanjutkan submit
    document.getElementById('captcha-error').style.display = 'none';
    
    // Disable tombol submit untuk mencegah double submit
    document.getElementById('submitBtn').disabled = true;
    document.getElementById('submitBtn').innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Mengirim...';
});

// Debug function untuk development
function debugCaptcha() {
    console.log('Captcha site key:', '{{ env("NOCAPTCHA_SITEKEY") }}');
    console.log('Captcha verified:', captchaVerified);
    console.log('Captcha response:', grecaptcha && grecaptcha.getResponse ? grecaptcha.getResponse() : 'grecaptcha not loaded');
}

// Functions untuk reply functionality
function replyToComment(commentId, authorName) {
    document.getElementById('parent_id').value = commentId;
    document.getElementById('reply-to-name').textContent = authorName;
    document.getElementById('reply-indicator').classList.remove('hidden');
    
    // Scroll ke form
    document.getElementById('commentForm').scrollIntoView({ 
        behavior: 'smooth', 
        block: 'start' 
    });
    
    // Focus ke textarea
    document.getElementById('comment').focus();
}

function cancelReply() {
    document.getElementById('parent_id').value = '';
    document.getElementById('reply-indicator').classList.add('hidden');
}

// Auto-debug setelah 3 detik
setTimeout(debugCaptcha, 3000);
</script>