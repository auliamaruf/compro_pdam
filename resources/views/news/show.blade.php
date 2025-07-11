@extends('layouts.app')

@section('title', $article->title . ' - ' . ($company->company_name ?? 'Tirta Perwira'))

@section('meta')
<meta name="description" content="{{ Str::limit(strip_tags($article->excerpt), 160) }}">
<meta name="keywords" content="{{ $article->title }}, PDAM, {{ ($company && $company->company_name && is_string($company->company_name)) ? $company->company_name : 'Tirta Perwira' }}">
<meta property="og:title" content="{{ $article->title }}">
<meta property="og:description" content="{{ Str::limit(strip_tags($article->excerpt), 160) }}">
<meta property="og:type" content="article">
<meta property="og:url" content="{{ route('news.show', $article->slug) }}">
@if($article->featured_image)
<meta property="og:image" content="{{ $article->featured_image }}">
@endif
@endsection

@section('content')
<!-- Add CSS for share buttons -->
<style>
.share-button {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    border-radius: 0.5rem;
    font-weight: 500;
    font-size: 0.875rem;
    text-decoration: none;
    transition: all 0.2s ease-in-out;
    border: none;
    cursor: pointer;
}

.share-button.facebook {
    background-color: #1877f2;
    color: white;
}

.share-button.facebook:hover {
    background-color: #166fe5;
    transform: translateY(-1px);
}

.share-button.twitter {
    background-color: #1da1f2;
    color: white;
}

.share-button.twitter:hover {
    background-color: #1a91da;
    transform: translateY(-1px);
}

.share-button.whatsapp {
    background-color: #25d366;
    color: white;
}

.share-button.whatsapp:hover {
    background-color: #128c7e;
    transform: translateY(-1px);
}

.share-button.linkedin {
    background-color: #0a66c2;
    color: white;
}

.share-button.linkedin:hover {
    background-color: #004182;
    transform: translateY(-1px);
}

.share-button.copy {
    background-color: #6b7280;
    color: white;
}

.share-button.copy:hover {
    background-color: #4b5563;
    transform: translateY(-1px);
}

.gallery-item {
    cursor: pointer;
    overflow: hidden;
    border-radius: 0.75rem;
    position: relative;
    aspect-ratio: 1;
    transition: all 0.3s ease;
}

.gallery-item:hover {
    transform: scale(1.02);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4);
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-icon {
    color: white;
    font-size: 1.5rem;
}
</style>

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
                <a href="{{ route('news') }}" class="text-blue-600 hover:text-blue-800">Berita</a>
            </li>
            <li class="flex items-center">
                <svg class="w-4 h-4 mx-2 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                </svg>
                <span class="text-gray-500">{{ Str::limit($article->title, 50) }}</span>
            </li>
        </ol>
    </div>
</nav>

<div class="container mx-auto px-4 py-8">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <article class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
                    <!-- Featured Image -->
                    @if($article->getFirstMediaUrl('featured_image'))
                    <div class="aspect-[16/9] w-full overflow-hidden relative">
                        <img src="{{ $article->getFirstMediaUrl('featured_image') }}"
                             alt="{{ $article->title }}"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    </div>
                    @endif

                    <div class="p-8 lg:p-12">
                        <!-- Article Header -->
                        <header class="mb-8">
                            <!-- Category and Meta Info -->
                            <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                                <div class="flex items-center space-x-4">
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold
                                        @if($article->type === 'news') bg-blue-100 text-blue-800 border border-blue-200
                                        @elseif($article->type === 'announcement') bg-cyan-100 text-cyan-800 border border-cyan-200
                                        @elseif($article->type === 'event') bg-purple-100 text-purple-800 border border-purple-200
                                        @else bg-gray-100 text-gray-800 border border-gray-200
                                        @endif">
                                        <i class="fas fa-tag mr-2"></i>
                                        {{ ucfirst($article->type) }}
                                    </span>
                                    <time datetime="{{ $article->published_at->format('Y-m-d') }}"
                                          class="text-gray-600 font-medium">
                                        <i class="fas fa-calendar-alt mr-2 text-blue-500"></i>
                                        {{ $article->published_at->format('d F Y') }}
                                    </time>
                                </div>
                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    <span class="flex items-center">
                                        <i class="fas fa-eye mr-2 text-gray-400"></i>
                                        {{ number_format($article->views ?? 0) }} views
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-comments mr-2 text-gray-400"></i>
                                        {{ $comments->count() }} komentar
                                    </span>
                                </div>
                            </div>

                            <!-- Article Title -->
                            <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-6 leading-tight">
                                {{ $article->title }}
                            </h1>

                            <!-- Article Excerpt -->
                            @if($article->excerpt)
                            <div class="relative">
                                <div class="text-xl text-gray-700 mb-8 leading-relaxed bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 pl-6 pr-6 py-4 rounded-r-lg">
                                    <i class="fas fa-quote-left text-blue-400 mr-2"></i>
                                    {{ $article->excerpt }}
                                </div>
                            </div>
                            @endif
                        </header>

                        <!-- Article Content -->
                        <div class="prose prose-xl max-w-none mb-12">
                            <div class="text-gray-800 leading-relaxed space-y-6">
                                {!! $article->content !!}
                            </div>
                        </div>

                        <!-- Photo Gallery -->
                        @if($article->getMedia('gallery')->count() > 0)
                        <section class="mb-12">
                            <div class="flex items-center mb-6">
                                <i class="fas fa-images text-2xl text-blue-600 mr-3"></i>
                                <h3 class="text-2xl font-bold text-gray-900">Galeri Foto</h3>
                            </div>
                            <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                                @foreach($article->getMedia('gallery') as $media)
                                <div class="gallery-item"
                                     onclick="openLightbox('{{ $media->getUrl() }}', '{{ $media->name }}')">
                                    <img src="{{ $media->getUrl('medium') }}"
                                         alt="{{ $media->name }}"
                                         loading="lazy">
                                    <div class="gallery-overlay">
                                        <i class="fas fa-search-plus gallery-icon"></i>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </section>
                        @endif

                        <!-- Article Footer -->
                        <footer class="border-t border-gray-200 pt-8">
                            <!-- Tags -->
                            @if($article->tags)
                            <div class="mb-8">
                                <div class="flex items-center mb-4">
                                    <i class="fas fa-tags text-lg text-gray-600 mr-3"></i>
                                    <h3 class="text-lg font-semibold text-gray-900">Tags</h3>
                                </div>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(explode(',', $article->tags) as $tag)
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gray-100 text-gray-700 hover:bg-gray-200 transition-colors cursor-pointer border border-gray-200">
                                        <i class="fas fa-hashtag mr-1 text-xs"></i>
                                        {{ trim($tag) }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            <!-- Share Buttons -->
                            <div class="mb-8">
                                <div class="flex items-center mb-4">
                                    <i class="fas fa-share-alt text-lg text-gray-600 mr-3"></i>
                                    <h3 class="text-lg font-semibold text-gray-900">Bagikan Artikel</h3>
                                </div>
                                <div class="flex flex-wrap gap-3">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                       target="_blank"
                                       class="share-button facebook">
                                        <i class="fab fa-facebook-f mr-2"></i>
                                        Facebook
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}"
                                       target="_blank"
                                       class="share-button twitter">
                                        <i class="fab fa-twitter mr-2"></i>
                                        Twitter
                                    </a>
                                    <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . request()->url()) }}"
                                       target="_blank"
                                       class="share-button whatsapp">
                                        <i class="fab fa-whatsapp mr-2"></i>
                                        WhatsApp
                                    </a>
                                    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                                       target="_blank"
                                       class="share-button linkedin">
                                        <i class="fab fa-linkedin-in mr-2"></i>
                                        LinkedIn
                                    </a>
                                    <button onclick="copyToClipboard('{{ request()->url() }}')"
                                            class="share-button copy">
                                        <i class="fas fa-link mr-2"></i>
                                        Salin Link
                                    </button>
                                </div>
                            </div>
                        </footer>
                    </div>
                </article>

                {{-- Comments Section --}}
                <div class="mt-12">
                    {{-- Display existing comments --}}
                    @include('components.comment-list', [
                        'comments' => $comments
                    ])

                    {{-- Comment form --}}
                    @include('components.comment-form', [
                        'commentableType' => 'App\Models\News',
                        'commentableId' => $article->id
                    ])
                </div>
            </div>

            <!-- Enhanced Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-8 space-y-6">
                    <!-- Related News -->
                    @if($relatedNews->count() > 0)
                    <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
                        <div class="flex items-center mb-6">
                            <i class="fas fa-newspaper text-2xl text-blue-600 mr-3"></i>
                            <h3 class="text-xl font-bold text-gray-900">Berita Terkait</h3>
                        </div>
                        <div class="space-y-4">
                            @foreach($relatedNews as $related)
                            <article class="group border-b border-gray-100 pb-4 last:border-b-0 last:pb-0">
                                <a href="{{ route('news.show', $related->slug) }}" class="block">
                                    @if($related->getFirstMediaUrl('featured_image'))
                                    <div class="aspect-[4/3] w-full overflow-hidden rounded-xl mb-3 relative">
                                        <img src="{{ $related->getFirstMediaUrl('featured_image') }}"
                                             alt="{{ $related->title }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                    @endif
                                    <h4 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-2 mb-2 leading-snug">
                                        {{ $related->title }}
                                    </h4>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="fas fa-calendar-alt mr-2 text-blue-400"></i>
                                        {{ $related->published_at->format('d M Y') }}
                                    </div>
                                </a>
                            </article>
                            @endforeach
                        </div>
                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <a href="{{ route('news') }}"
                               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors">
                                <span>Lihat Semua Berita</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- Latest News -->
                    <div class="bg-white rounded-2xl shadow-xl p-6 border border-gray-100">
                        <div class="flex items-center mb-6">
                            <i class="fas fa-clock text-2xl text-blue-600 mr-3"></i>
                            <h3 class="text-xl font-bold text-gray-900">Berita Terbaru</h3>
                        </div>
                        <div class="space-y-4">
                            @php
                                $latestNews = App\Models\News::published()
                                    ->where('id', '!=', $article->id)
                                    ->latest()
                                    ->take(5)
                                    ->get();
                            @endphp
                            @foreach($latestNews as $latest)
                            <article class="group border-b border-gray-100 pb-4 last:border-b-0 last:pb-0">
                                <a href="{{ route('news.show', $latest->slug) }}" class="block">
                                    <h4 class="font-semibold text-gray-900 group-hover:text-blue-600 transition-colors line-clamp-3 text-sm leading-relaxed mb-2">
                                        {{ $latest->title }}
                                    </h4>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <span class="flex items-center">
                                            <i class="fas fa-calendar-alt mr-1 text-blue-400"></i>
                                            {{ $latest->published_at->format('d M Y') }}
                                        </span>
                                        <span class="flex items-center">
                                            <i class="fas fa-eye mr-1 text-gray-400"></i>
                                            {{ number_format($latest->views ?? 0) }}
                                        </span>
                                    </div>
                                </a>
                            </article>
                            @endforeach
                        </div>
                    </div>




                </div>
            </div>
        </div>
    </div>
</div>

<!-- Lightbox Modal -->
<div id="lightbox-modal" class="fixed inset-0 z-50 hidden bg-black bg-opacity-90 p-4">
    <div class="flex items-center justify-center h-full">
        <div class="relative max-w-5xl max-h-full">
            <button onclick="closeLightbox()"
                    class="absolute -top-12 right-0 text-white hover:text-gray-300 transition-colors z-10">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <div class="bg-white rounded-2xl p-2 shadow-2xl">
                <img id="lightbox-image"
                     src=""
                     alt=""
                     class="max-w-full max-h-[80vh] object-contain rounded-xl mx-auto block">
            </div>
            <p id="lightbox-caption"
               class="text-white text-center mt-6 text-lg font-medium bg-black bg-opacity-50 rounded-lg px-4 py-2"></p>
        </div>
    </div>
</div>

<script>
function openLightbox(imageUrl, caption) {
    const modal = document.getElementById('lightbox-modal');
    const image = document.getElementById('lightbox-image');
    const captionEl = document.getElementById('lightbox-caption');

    image.src = imageUrl;
    captionEl.textContent = caption;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const modal = document.getElementById('lightbox-modal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = 'auto';
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show notification
        const notification = document.createElement('div');
        notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 transform transition-all duration-300';
        notification.innerHTML = '<i class="fas fa-check mr-2"></i>Link berhasil disalin!';
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.transform = 'translateX(100%)';
            setTimeout(() => notification.remove(), 300);
        }, 2000);
    }).catch(function(err) {
        console.error('Could not copy text: ', err);
        // Fallback for older browsers
        const textArea = document.createElement('textarea');
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);

        alert('Link berhasil disalin!');
    });
}

// Close on background click
document.getElementById('lightbox-modal').addEventListener('click', function(e) {
    if (e.target === this || e.target.classList.contains('flex')) {
        closeLightbox();
    }
});

// Close on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLightbox();
    }
});

// Image lazy loading error handling
document.addEventListener('DOMContentLoaded', function() {
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.addEventListener('error', function() {
            this.src = '/images/placeholder.jpg'; // Add a fallback image
            this.alt = 'Image not available';
        });
    });
});
</script>
@endsection
