{{-- Comment Form Component --}}
<div class="comment-form-section mt-8">
    <h3 class="text-xl font-semibold text-gray-800 mb-4">
        <i class="fas fa-comments text-blue-600 mr-2"></i>
        Tinggalkan Komentar
    </h3>

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

    <form action="{{ route('comments.store') }}" method="POST" class="space-y-4">
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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="author_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Lengkap <span class="text-red-500">*</span>
                </label>
                <input type="text"
                       id="author_name"
                       name="author_name"
                       value="{{ old('author_name') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('author_name') border-red-500 @enderror"
                       placeholder="Masukkan nama lengkap Anda"
                       required>
                @error('author_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="author_email" class="block text-sm font-medium text-gray-700 mb-2">
                    Email <span class="text-red-500">*</span>
                </label>
                <input type="email"
                       id="author_email"
                       name="author_email"
                       value="{{ old('author_email') }}"
                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('author_email') border-red-500 @enderror"
                       placeholder="email@contoh.com"
                       required>
                @error('author_email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="author_phone" class="block text-sm font-medium text-gray-700 mb-2">
                Nomor Telepon <span class="text-gray-500">(Opsional)</span>
            </label>
            <input type="tel"
                   id="author_phone"
                   name="author_phone"
                   value="{{ old('author_phone') }}"
                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('author_phone') border-red-500 @enderror"
                   placeholder="08xxxxxxxxxx">
            @error('author_phone')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="content" class="block text-sm font-medium text-gray-700 mb-2">
                Komentar <span class="text-red-500">*</span>
            </label>
            <textarea id="content"
                      name="content"
                      rows="4"
                      class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('content') border-red-500 @enderror"
                      placeholder="Tulis komentar Anda di sini... (maksimal 2000 karakter)"
                      maxlength="2000"
                      required>{{ old('content') }}</textarea>
            <div class="flex justify-between items-center mt-1">
                @error('content')
                    <p class="text-sm text-red-600">{{ $message }}</p>
                @else
                    <p class="text-sm text-gray-500">Komentar akan ditampilkan setelah disetujui moderator.</p>
                @enderror
                <span id="char-count" class="text-sm text-gray-400">0/2000</span>
            </div>
        </div>

        <div class="flex items-center justify-between">
            <p class="text-sm text-gray-600">
                <i class="fas fa-shield-alt text-green-600 mr-1"></i>
                Email Anda tidak akan dipublikasikan
            </p>

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-md transition duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                <i class="fas fa-paper-plane mr-2"></i>
                Kirim Komentar
            </button>
        </div>
    </form>
</div>

<script>
// Character counter
document.getElementById('content').addEventListener('input', function() {
    const maxLength = 2000;
    const currentLength = this.value.length;
    const counter = document.getElementById('char-count');

    counter.textContent = currentLength + '/' + maxLength;

    if (currentLength > maxLength * 0.9) {
        counter.classList.add('text-red-500');
        counter.classList.remove('text-gray-400');
    } else {
        counter.classList.add('text-gray-400');
        counter.classList.remove('text-red-500');
    }
});

// Reply functionality
function replyToComment(commentId, authorName) {
    document.getElementById('parent_id').value = commentId;
    document.getElementById('reply-to-name').textContent = authorName;
    document.getElementById('reply-indicator').classList.remove('hidden');

    // Scroll to form
    document.querySelector('.comment-form-section').scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });

    // Focus on content textarea
    document.getElementById('content').focus();
}

function cancelReply() {
    document.getElementById('parent_id').value = '';
    document.getElementById('reply-indicator').classList.add('hidden');
}
</script>
