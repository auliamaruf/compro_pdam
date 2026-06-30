@extends('layouts.app')

@section('title', $page->title . ' - ' . (($company && $company->company_name && is_string($company->company_name)) ? $company->company_name : 'Tirta Perwira'))
@section('description', $page->excerpt ?? strip_tags(Str::limit($page->content, 160)))

@if($page->meta && isset($page->meta['keywords']))
@section('keywords', $page->meta['keywords'])
@endif

@push('styles')
<style>
    .page-content {
        line-height: 1.8;
    }
    
    .page-content h1,
    .page-content h2,
    .page-content h3,
    .page-content h4,
    .page-content h5,
    .page-content h6 {
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #1f2937;
    }
    
    .page-content h1 { font-size: 2.25rem; }
    .page-content h2 { font-size: 1.875rem; }
    .page-content h3 { font-size: 1.5rem; }
    
    .page-content p {
        margin-bottom: 1.5rem;
        color: #4b5563;
    }
    
    .page-content ul,
    .page-content ol {
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }
    
    .page-content li {
        margin-bottom: 0.5rem;
    }
    
    .page-content blockquote {
        border-left: 4px solid #3b82f6;
        padding-left: 1rem;
        margin: 1.5rem 0;
        font-style: italic;
        background-color: #f8fafc;
        padding: 1rem;
        border-radius: 0.5rem;
    }
    
    .page-content img {
        border-radius: 0.75rem;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="bg-gradient-to-r from-blue-600 to-blue-700 text-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h1 class="text-4xl lg:text-5xl font-bold mb-4">{{ $page->title }}</h1>
            @if($page->excerpt)
                <p class="text-xl text-blue-100 leading-relaxed">{{ $page->excerpt }}</p>
            @endif
        </div>
    </div>
</section>

<!-- Page Content -->
<section class="py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            @if($page->getFirstMediaUrl('featured_image'))
                <div class="mb-12">
                    <img src="{{ $page->getFirstMediaUrl('featured_image') }}" 
                         alt="{{ $page->title }}"
                         class="w-full h-64 lg:h-96 object-cover rounded-2xl shadow-xl"
                         width="800" height="400">
                </div>
            @endif
            
            <div class="page-content prose prose-lg max-w-none">
                {!! $page->content !!}
            </div>
            
            <!-- Page Meta Info -->
            <div class="mt-12 pt-8 border-t border-gray-200">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm text-gray-500">
                    <div>
                        <span>Dipublikasi pada {{ $page->published_at->format('d F Y') }}</span>
                    </div>
                    <div>
                        <span>Terakhir diperbarui {{ $page->updated_at->format('d F Y') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Pages CTA -->
<section class="bg-gray-50 py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">Butuh Informasi Lainnya?</h2>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('contact') }}" class="bg-blue-600 text-white px-8 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors">
                    Hubungi Kami
                </a>
                <a href="{{ route('services') }}" class="border-2 border-blue-600 text-blue-600 px-8 py-3 rounded-lg font-semibold hover:bg-blue-600 hover:text-white transition-colors">
                    Lihat Layanan
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
