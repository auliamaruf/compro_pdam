<article class="bg-white dark:bg-gray-900 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 group overflow-hidden border border-gray-100 dark:border-gray-700">
    @if($article->getFirstMediaUrl('featured_image'))
        <img data-src="{{ $article->getFirstMediaUrl('featured_image') }}" alt="{{ $article->title }}" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300 lazy-image" loading="lazy" width="400" height="192">
    @else
        <div class="w-full h-48 bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center group-hover:from-blue-500 group-hover:to-blue-700 transition-all duration-300">
            <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
            </svg>
        </div>
    @endif
    <div class="p-6">
        <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-3">
            <time datetime="{{ $article->published_at->format('Y-m-d') }}">
                {{ $article->published_at->format('d M Y') }}
            </time>
            <span class="mx-2">•</span>
            <span class="inline-flex px-2 py-1 text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200 rounded-full">{{ ucfirst($article->type) }}</span>
        </div>
        <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3 line-clamp-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors duration-200">
            <a href="{{ route('news.show', $article->slug) }}">
                {{ $article->title }}
            </a>
        </h3>
        <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-3">{{ Str::limit(strip_tags($article->content), 120) }}</p>
        <a href="{{ route('news.show', $article->slug) }}" class="inline-flex items-center text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-semibold text-sm transition-colors duration-200">
            Baca Selengkapnya
            <svg class="w-4 h-4 ml-2 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>
</article>
