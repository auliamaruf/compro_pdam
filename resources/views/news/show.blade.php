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

@push('head')
<script type="application/ld+json">
{
  "@@context": "https://schema.org",
  "@@type": "NewsArticle",
  "headline": "{{ $article->title }}",
  "image": [
    "{{ $article->featured_image ?? asset('images/og-default.jpg') }}"
  ],
  "datePublished": "{{ $article->created_at->toIso8601String() }}",
  "dateModified": "{{ $article->updated_at->toIso8601String() }}",
  "author": [{
      "@@type": "Person",
      "name": "{{ $article->author->name ?? 'Admin PDAM' }}"
  }],
  "publisher": {
    "@@type": "Organization",
    "name": "{{ $company->company_name ?? 'PDAM Tirta Perwira' }}",
    "logo": {
      "@@type": "ImageObject",
      "url": "{{ $company && $company->logo ? asset('storage/' . $company->logo) : asset('images/og-default.jpg') }}"
    }
  }
}
</script>
@endpush


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
    background: #f3f4f6;
    border: 2px solid transparent;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.07);
}

.gallery-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    border-color: rgba(59, 130, 246, 0.3);
}

.gallery-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: all 0.3s ease;
    opacity: 1;
}

.gallery-item:hover img {
    transform: scale(1.05);
    filter: brightness(0.8);
}

/* Document styles */
.document-card {
    transition: all 0.3s ease;
    border: 1px solid #e5e7eb;
}

.document-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    border-color: rgba(59, 130, 246, 0.3);
}

.document-icon {
    transition: transform 0.2s ease;
}

.document-card:hover .document-icon {
    transform: scale(1.1);
}

.document-button {
    transition: all 0.2s ease;
}

.document-button:hover {
    transform: translateY(-1px);
}

.pulse-animation {
    animation: pulse 1.5s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

.gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, 
        rgba(59, 130, 246, 0.85) 0%, 
        rgba(16, 185, 129, 0.85) 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.3s ease;
    backdrop-filter: blur(2px);
}

.gallery-item:hover .gallery-overlay {
    opacity: 1;
}

.gallery-icon {
    color: white;
    font-size: 2.5rem;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    margin-bottom: 0.5rem;
    animation: pulse 2s infinite;
}

.gallery-text {
    color: white;
    font-size: 0.875rem;
    font-weight: 600;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
    letter-spacing: 0.5px;
}

@keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.1); }
}

/* Lightbox Improvements - Modern & Elegant */
#lightbox-modal {
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    background: linear-gradient(135deg, 
        rgba(0, 0, 0, 0.9) 0%, 
        rgba(15, 23, 42, 0.95) 50%, 
        rgba(0, 0, 0, 0.9) 100%);
    animation: modalFadeIn 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

@keyframes modalFadeIn {
    from {
        opacity: 0;
        backdrop-filter: blur(0px);
    }
    to {
        opacity: 1;
        backdrop-filter: blur(15px);
    }
}

#lightbox-image {
    max-width: 90vw;
    max-height: 80vh;
    object-fit: contain;
    box-shadow: 
        0 25px 80px rgba(0, 0, 0, 0.7),
        0 0 0 1px rgba(255, 255, 255, 0.1),
        0 0 100px rgba(59, 130, 246, 0.1);
    border-radius: 16px;
    transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    filter: drop-shadow(0 25px 50px rgba(0, 0, 0, 0.5));
}

#lightbox-image:hover {
    box-shadow: 
        0 35px 100px rgba(0, 0, 0, 0.8),
        0 0 0 1px rgba(255, 255, 255, 0.15),
        0 0 150px rgba(59, 130, 246, 0.2);
    transform: scale(1.02);
}

.lightbox-container {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    padding: 3rem 2rem 8rem;
    width: 100%;
}

/* Enhanced Close Button */
.lightbox-close {
    position: fixed;
    top: 2rem;
    right: 2rem;
    z-index: 50;
    background: linear-gradient(135deg, 
        rgba(239, 68, 68, 0.9) 0%, 
        rgba(220, 38, 38, 0.95) 100%);
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    width: 56px;
    height: 56px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
}

.lightbox-close:hover {
    transform: scale(1.1) rotate(90deg);
    background: linear-gradient(135deg, 
        rgba(220, 38, 38, 1) 0%, 
        rgba(185, 28, 28, 1) 100%);
    border-color: rgba(255, 255, 255, 0.4);
    box-shadow: 0 12px 40px rgba(239, 68, 68, 0.4);
}

/* Enhanced Caption Styling */
#lightbox-caption {
    background: linear-gradient(135deg, 
        rgba(15, 23, 42, 0.95) 0%, 
        rgba(30, 41, 59, 0.95) 50%,
        rgba(15, 23, 42, 0.95) 100%);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 
        0 8px 32px rgba(0, 0, 0, 0.4),
        0 0 0 1px rgba(59, 130, 246, 0.1);
    border-radius: 20px;
    padding: 1.25rem 2.5rem;
    margin-bottom: 1.5rem;
    font-weight: 500;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.7);
    max-width: 85vw;
    text-align: center;
    line-height: 1.6;
    font-size: 1.1rem;
    color: #f8fafc;
    letter-spacing: 0.025em;
}

.lightbox-counter {
    background: linear-gradient(135deg, 
        rgba(59, 130, 246, 0.95) 0%, 
        rgba(16, 185, 129, 0.95) 50%,
        rgba(139, 92, 246, 0.95) 100%);
    color: white;
    padding: 1rem 2rem;
    border-radius: 3rem;
    font-size: 1.1rem;
    font-weight: 700;
    border: 1px solid rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    box-shadow: 
        0 8px 32px rgba(0, 0, 0, 0.3),
        0 0 0 1px rgba(255, 255, 255, 0.1),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
    letter-spacing: 0.05em;
    position: relative;
    overflow: hidden;
}

.lightbox-counter::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, 
        transparent, 
        rgba(255, 255, 255, 0.2), 
        transparent);
    transition: left 0.6s ease;
}

.lightbox-counter:hover::before {
    left: 100%;
}

/* Enhanced Navigation Buttons */
.lightbox-navigation {
    position: fixed;
    top: 50%;
    transform: translateY(-50%);
    background: linear-gradient(135deg, 
        rgba(15, 23, 42, 0.9) 0%, 
        rgba(30, 41, 59, 0.95) 100%);
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.15);
    padding: 1.25rem;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: 40;
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    width: 70px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 
        0 12px 40px rgba(0, 0, 0, 0.4),
        0 0 0 1px rgba(59, 130, 246, 0.1);
}

.lightbox-navigation:hover {
    background: linear-gradient(135deg, 
        rgba(59, 130, 246, 0.95) 0%, 
        rgba(16, 185, 129, 0.95) 100%);
    border-color: rgba(255, 255, 255, 0.3);
    transform: translateY(-50%) scale(1.15);
    box-shadow: 
        0 20px 60px rgba(59, 130, 246, 0.4),
        0 0 0 1px rgba(255, 255, 255, 0.2);
}

.lightbox-navigation:active {
    transform: translateY(-50%) scale(1.05);
}

.lightbox-navigation.prev {
    left: 2.5rem;
}

.lightbox-navigation.next {
    right: 2.5rem;
}

.lightbox-navigation svg {
    width: 2rem;
    height: 2rem;
    stroke-width: 2.5;
    filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.3));
}

/* Loading Enhancement */
#lightbox-loading {
    background: linear-gradient(135deg, 
        rgba(0, 0, 0, 0.8) 0%, 
        rgba(15, 23, 42, 0.9) 100%);
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    border-radius: 16px;
}

.loading-spinner {
    width: 3rem;
    height: 3rem;
    border: 3px solid rgba(255, 255, 255, 0.2);
    border-top: 3px solid #3b82f6;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

.loading-text {
    color: #e2e8f0;
    font-size: 1rem;
    font-weight: 500;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
}

/* Mobile responsive adjustments */
@media (max-width: 768px) {
    .gallery-item {
        aspect-ratio: 4/3;
    }
    
    .gallery-icon {
        font-size: 2rem;
    }
    
    .gallery-text {
        font-size: 0.75rem;
    }
    
    .lightbox-navigation {
        width: 60px;
        height: 60px;
        padding: 1rem;
    }
    
    .lightbox-navigation.prev {
        left: 1.5rem;
    }
    
    .lightbox-navigation.next {
        right: 1.5rem;
    }
    
    .lightbox-navigation svg {
        width: 1.75rem;
        height: 1.75rem;
    }
    
    .lightbox-counter {
        font-size: 1rem;
        padding: 0.75rem 1.5rem;
    }
    
    #lightbox-caption {
        font-size: 1rem;
        padding: 1rem 1.75rem;
        margin-bottom: 1.25rem;
        max-width: 90vw;
    }
    
    #lightbox-image {
        max-height: 70vh;
        max-width: 95vw;
    }
    
    .lightbox-container {
        padding: 2rem 1rem 6rem;
    }
    
    .lightbox-close {
        top: 1.5rem;
        right: 1.5rem;
        width: 48px;
        height: 48px;
    }
    
    .lightbox-close svg {
        width: 1.25rem;
        height: 1.25rem;
    }
}

/* Tablet adjustments */
@media (min-width: 769px) and (max-width: 1024px) {
    #lightbox-image {
        max-width: 85vw;
        max-height: 75vh;
    }
    
    .lightbox-navigation {
        width: 65px;
        height: 65px;
    }
    
    .lightbox-navigation.prev {
        left: 2rem;
    }
    
    .lightbox-navigation.next {
        right: 2rem;
    }
}

/* Ultra-wide screen adjustments */
@media (min-width: 1920px) {
    #lightbox-image {
        max-width: 80vw;
        max-height: 75vh;
    }
    
    .lightbox-container {
        padding: 4rem 3rem 10rem;
    }
    
    .lightbox-navigation {
        width: 80px;
        height: 80px;
    }
    
    .lightbox-navigation.prev {
        left: 3rem;
    }
    
    .lightbox-navigation.next {
        right: 3rem;
    }
    
    .lightbox-navigation svg {
        width: 2.25rem;
        height: 2.25rem;
    }
    
    #lightbox-caption {
        font-size: 1.25rem;
        padding: 1.5rem 3rem;
    }
    
    .lightbox-counter {
        font-size: 1.2rem;
        padding: 1.25rem 2.5rem;
    }
}

/* High resolution screens */
@media (min-resolution: 2dppx) {
    #lightbox-image {
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
    }
}

/* Touch improvements */
@media (hover: none) and (pointer: coarse) {
    .gallery-overlay {
        opacity: 0.4;
    }
    
    .gallery-item:active .gallery-overlay {
        opacity: 1;
    }
    
    .lightbox-navigation:hover {
        transform: translateY(-50%) scale(1);
    }
    
    .lightbox-navigation:active {
        transform: translateY(-50%) scale(1.1);
        background: linear-gradient(135deg, 
            rgba(59, 130, 246, 1) 0%, 
            rgba(16, 185, 129, 1) 100%);
    }
    
    .lightbox-close:hover {
        transform: scale(1);
    }
    
    .lightbox-close:active {
        transform: scale(1.1);
    }
}

/* Image centering and container improvements */
.lightbox-image-container {
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 1;
    width: 100%;
    position: relative;
    min-height: 60vh;
}

/* Additional modern touches */
.lightbox-overlay-bg {
    position: fixed;
    inset: 0;
    background: radial-gradient(ellipse at center, 
        rgba(59, 130, 246, 0.05) 0%, 
        rgba(0, 0, 0, 0.8) 70%);
    z-index: -1;
}

/* Smooth transitions for all elements */
* {
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1),
                background 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.lightbox-navigation {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.8);
    color: white;
    border: 2px solid rgba(255, 255, 255, 0.2);
    padding: 1rem;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 20;
    backdrop-filter: blur(10px);
    width: 60px;
    height: 60px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.lightbox-navigation:hover {
    background: rgba(59, 130, 246, 0.9);
    border-color: rgba(255, 255, 255, 0.4);
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
}

.lightbox-navigation:active {
    transform: translateY(-50%) scale(0.95);
}

.lightbox-navigation.prev {
    left: 2rem;
}

.lightbox-navigation.next {
    right: 2rem;
}

.lightbox-counter {
    background: rgba(0, 0, 0, 0.8);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 2rem;
    font-size: 1rem;
    font-weight: 600;
    border: 1px solid rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(10px);
}

/* Enhanced Prose Content Styling */
.prose-content {
    line-height: 1.7;
    font-size: 16px;
}

.prose-content h1, .prose-content h2, .prose-content h3, 
.prose-content h4, .prose-content h5, .prose-content h6 {
    margin-top: 2rem;
    margin-bottom: 1rem;
    font-weight: 700;
    line-height: 1.3;
    color: #1f2937;
}

.prose-content h1 { 
    font-size: 2rem; 
    border-bottom: 2px solid #e5e7eb;
    padding-bottom: 0.5rem;
}
.prose-content h2 { 
    font-size: 1.5rem;
    border-bottom: 1px solid #f3f4f6;
    padding-bottom: 0.25rem;
}
.prose-content h3 { 
    font-size: 1.25rem;
    color: #374151;
}
.prose-content h4 { 
    font-size: 1.125rem;
    color: #374151;
}
.prose-content h5 { 
    font-size: 1rem;
    color: #4b5563;
    font-weight: 600;
}
.prose-content h6 { 
    font-size: 0.875rem;
    color: #6b7280;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.prose-content p {
    margin-bottom: 1.5rem;
    text-align: justify;
    text-justify: inter-word;
}

.prose-content ul, .prose-content ol {
    margin-bottom: 1.5rem !important;
    padding-left: 2rem !important;
    list-style-position: outside !important;
}

.prose-content ul {
    list-style-type: disc !important;
}

.prose-content ol {
    list-style-type: decimal !important;
}

.prose-content ul ul {
    list-style-type: circle !important;
    margin-top: 0.5rem !important;
    margin-bottom: 0.5rem !important;
}

.prose-content ul ul ul {
    list-style-type: square !important;
}

.prose-content ol ol {
    list-style-type: lower-alpha !important;
    margin-top: 0.5rem !important;
    margin-bottom: 0.5rem !important;
}

.prose-content ol ol ol {
    list-style-type: lower-roman !important;
}

.prose-content li {
    margin-bottom: 0.5rem !important;
    line-height: 1.6 !important;
    position: relative !important;
    display: list-item !important;
}

.prose-content li p {
    margin-bottom: 0.75rem !important;
}

.prose-content li > ul,
.prose-content li > ol {
    margin-top: 0.5rem !important;
}

.prose-content blockquote {
    border-left: 4px solid #3b82f6;
    margin: 2rem 0;
    padding: 1rem 1.5rem;
    background-color: #f8fafc;
    font-style: italic;
    color: #4b5563;
    border-radius: 0 0.5rem 0.5rem 0;
}

.prose-content table {
    width: 100%;
    margin: 2rem 0;
    border-collapse: collapse;
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
    overflow: hidden;
}

.prose-content th, .prose-content td {
    padding: 0.75rem 1rem;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
}

.prose-content th {
    background-color: #f9fafb;
    font-weight: 600;
}

.prose-content img {
    max-width: 100%;
    height: auto;
    margin: 1.5rem auto;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
}

.prose-content pre {
    background-color: #f3f4f6;
    border-radius: 0.5rem;
    padding: 1rem;
    overflow-x: auto;
    margin: 1.5rem 0;
    border: 1px solid #e5e7eb;
}

.prose-content code {
    background-color: #f3f4f6;
    color: #ef4444;
    padding: 0.125rem 0.25rem;
    border-radius: 0.25rem;
    font-size: 0.875em;
}

.prose-content a {
    color: #3b82f6;
    text-decoration: underline;
    font-weight: 500;
}

.prose-content a:hover {
    color: #1d4ed8;
}

.prose-content strong, .prose-content b {
    font-weight: 700;
    color: #1f2937;
}

.prose-content em, .prose-content i {
    font-style: italic;
}

.prose-content u {
    text-decoration: underline;
    text-decoration-color: #6b7280;
}

.prose-content s, .prose-content strike {
    text-decoration: line-through;
    text-decoration-color: #ef4444;
}

.prose-content sub {
    font-size: 0.75em;
    vertical-align: sub;
}

.prose-content sup {
    font-size: 0.75em;
    vertical-align: super;
}

.prose-content mark {
    background-color: #fef3c7;
    color: #92400e;
    padding: 0.125rem 0.25rem;
    border-radius: 0.25rem;
}

/* Mobile-first Document Responsive Design */
@media (max-width: 640px) {
    .document-card {
        margin-bottom: 0.75rem;
    }
    
    .document-card .document-button {
        font-size: 0.75rem;
        padding: 0.5rem 0.75rem;
        min-height: 2.5rem;
        white-space: nowrap;
    }
    
    .document-card h5 {
        font-size: 0.875rem;
        line-height: 1.3;
        word-break: break-word;
        hyphens: auto;
    }
    
    /* Ensure buttons don't shrink too much */
    .document-card .flex-1 {
        min-width: calc(50% - 0.25rem);
    }
    
    /* Better spacing for mobile document meta */
    .document-card .bg-gray-200 {
        font-size: 0.625rem;
        padding: 0.125rem 0.375rem;
    }
    
    /* Section headers responsive */
    .mb-12 {
        margin-bottom: 2rem;
    }
    
    .mb-6 {
        margin-bottom: 1rem;
    }
    
    /* Document section mobile padding */
    .bg-white.border.border-gray-200.rounded-lg.p-4 {
        padding: 0.75rem;
    }
}

/* Touch targets for mobile */
@media (pointer: coarse) {
    .document-button {
        min-height: 44px;
        min-width: 44px;
    }
}
</style>

<!-- Breadcrumb -->
<nav class="bg-blue-50 dark:bg-gray-800 py-4" aria-label="Breadcrumb">
    <div class="container-custom">
        <ol class="flex items-center space-x-2 text-sm text-gray-600 dark:text-gray-400">
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

<div class="container-custom py-8">
    <div class="max-w-7xl mx-auto">
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-3">
                <article class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl overflow-hidden border border-gray-100 dark:border-gray-700">
                    <!-- Featured Image -->
                    @if($article->getFirstMediaUrl('featured_image'))
                    <div class="aspect-[16/9] w-full overflow-hidden relative">
                        <img src="{{ $article->getFirstMediaUrl('featured_image') }}"
                             alt="{{ $article->title }}"
                             class="w-full h-full object-cover"
                             width="800" height="450">
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
                                        @else bg-gray-100 dark:bg-gray-800 text-gray-800 dark:text-gray-100 border border-gray-200
                                        @endif">
                                        <i class="fas fa-tag mr-2"></i>
                                        {{ ucfirst($article->type) }}
                                    </span>
                                    <time datetime="{{ $article->published_at->format('Y-m-d') }}"
                                          class="text-gray-600 dark:text-gray-400 font-medium">
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
                            <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-6 leading-tight">
                                {{ $article->title }}
                            </h1>

                            <!-- Article Excerpt -->
                            @if($article->excerpt)
                            <div class="relative">
                                <div class="text-lg text-gray-700 dark:text-gray-300 mb-8 leading-relaxed bg-gradient-to-r from-blue-50 to-indigo-50 border-l-4 border-blue-500 pl-6 pr-6 py-4 rounded-r-lg">
                                    <i class="fas fa-quote-left text-blue-400 mr-2"></i>
                                    {{ $article->excerpt }}
                                </div>
                            </div>
                            @endif
                        </header>

                        <!-- Article Content -->
                        <div class="max-w-none mb-12">
                            <div class="prose-content text-gray-800 dark:text-gray-100 leading-relaxed space-y-4 text-base">
                                {!! $article->content !!}
                            </div>
                        </div>

                        <!-- Photo Gallery -->
                        @if($article->getMedia('gallery')->count() > 0)
                        <section class="mb-12">
                            <div class="flex items-center mb-6">
                                <i class="fas fa-images text-2xl text-blue-600 mr-3"></i>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Galeri Foto</h3>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
                                @foreach($article->getMedia('gallery') as $index => $media)
                                <div class="gallery-item"
                                     onclick="openLightbox({{ $index }})"
                                     title="Klik untuk memperbesar foto">
                                    <img src="{{ $media->getUrl() }}"
                                         alt="{{ $media->name ?? 'Foto galeri' }}"
                                         loading="lazy" width="400" height="400"
                                         style="opacity: 0; transition: opacity 0.3s ease;"
                                         onload="this.style.opacity = '1'; if(this.nextElementSibling && this.nextElementSibling.classList.contains('loading-placeholder')) this.nextElementSibling.remove();"
                                         >
                                    <div class="gallery-overlay">
                                        <i class="fas fa-search-plus gallery-icon"></i>
                                        <span class="gallery-text">PERBESAR</span>
                                    </div>
                                    <!-- Loading placeholder -->
                                    <div class="loading-placeholder absolute inset-0 bg-gray-200 animate-pulse flex items-center justify-center rounded-lg">
                                        <i class="fas fa-image text-gray-400 text-2xl"></i>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </section>
                        @endif

                        <!-- Document Attachments -->
                        @if($article->hasDocuments())
                        <section class="mb-12">
                            <div class="flex items-center mb-6">
                                <i class="fas fa-paperclip text-xl text-green-600 mr-3"></i>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Dokumen Terkait</h3>
                            </div>
                            
                            <div class="bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-4">
                                <!-- Uploaded Documents -->
                                @if($article->getMedia('documents')->count() > 0)
                                <div class="mb-4 last:mb-0">
                                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 flex items-center">
                                        <i class="fas fa-file-alt text-green-600 mr-2 text-sm"></i>
                                        File Lampiran
                                    </h4>
                                    <div class="space-y-3">
                                        @foreach($article->getMedia('documents') as $document)
                                        <div class="document-card bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-3 hover:bg-gray-100 transition-colors group">
                                            <!-- Mobile Layout -->
                                            <div class="sm:hidden">
                                                <div class="flex items-start space-x-3 mb-3">
                                                    <div class="flex-shrink-0 document-icon">
                                                        @php
                                                            $extension = pathinfo($document->file_name, PATHINFO_EXTENSION);
                                                            $iconClass = match(strtolower($extension)) {
                                                                'pdf' => 'fas fa-file-pdf text-red-500',
                                                                'doc', 'docx' => 'fas fa-file-word text-blue-500',
                                                                'xls', 'xlsx' => 'fas fa-file-excel text-green-500',
                                                                'ppt', 'pptx' => 'fas fa-file-powerpoint text-orange-500',
                                                                'txt' => 'fas fa-file-alt text-gray-500',
                                                                'jpg', 'jpeg', 'png', 'gif', 'webp' => 'fas fa-file-image text-purple-500',
                                                                default => 'fas fa-file text-gray-500'
                                                            };
                                                        @endphp
                                                        <i class="{{ $iconClass }} text-xl"></i>
                                                    </div>
                                                    <div class="flex-1 min-w-0">
                                                        <h5 class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-blue-600 leading-snug">
                                                            {{ $document->name ?: $document->file_name }}
                                                        </h5>
                                                        <div class="flex flex-wrap items-center gap-2 text-xs text-gray-500 mt-1">
                                                            <span class="bg-gray-200 px-2 py-0.5 rounded">{{ strtoupper($extension) }}</span>
                                                            <span>{{ $document->human_readable_size }}</span>
                                                            <span>{{ $document->created_at->format('d M Y') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="flex flex-wrap gap-2">
                                                    @if(in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                    <a href="{{ $document->getUrl() }}" 
                                                       target="_blank" 
                                                       class="document-button flex-1 min-w-0 inline-flex items-center justify-center px-3 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 text-xs font-medium rounded-md">
                                                        <i class="fas fa-eye mr-1"></i>
                                                        Lihat
                                                    </a>
                                                    @endif
                                                    <a href="{{ $document->getUrl() }}" 
                                                       download="{{ $document->file_name }}"
                                                       class="document-button flex-1 min-w-0 inline-flex items-center justify-center px-3 py-2 bg-green-100 hover:bg-green-200 text-green-700 text-xs font-medium rounded-md">
                                                        <i class="fas fa-download mr-1"></i>
                                                        Download
                                                    </a>
                                                </div>
                                            </div>
                                            
                                            <!-- Desktop Layout -->
                                            <div class="hidden sm:flex items-center space-x-3">
                                                <div class="flex-shrink-0 document-icon">
                                                    @php
                                                        $extension = pathinfo($document->file_name, PATHINFO_EXTENSION);
                                                        $iconClass = match(strtolower($extension)) {
                                                            'pdf' => 'fas fa-file-pdf text-red-500',
                                                            'doc', 'docx' => 'fas fa-file-word text-blue-500',
                                                            'xls', 'xlsx' => 'fas fa-file-excel text-green-500',
                                                            'ppt', 'pptx' => 'fas fa-file-powerpoint text-orange-500',
                                                            'txt' => 'fas fa-file-alt text-gray-500',
                                                            'jpg', 'jpeg', 'png', 'gif', 'webp' => 'fas fa-file-image text-purple-500',
                                                            default => 'fas fa-file text-gray-500'
                                                        };
                                                    @endphp
                                                    <i class="{{ $iconClass }} text-lg"></i>
                                                </div>
                                                <div class="flex-1 min-w-0">
                                                    <h5 class="text-sm font-medium text-gray-900 dark:text-white truncate group-hover:text-blue-600">
                                                        {{ $document->name ?: $document->file_name }}
                                                    </h5>
                                                    <div class="flex items-center space-x-2 text-xs text-gray-500 mt-1">
                                                        <span>{{ strtoupper($extension) }}</span>
                                                        <span>•</span>
                                                        <span>{{ $document->human_readable_size }}</span>
                                                        <span>•</span>
                                                        <span>{{ $document->created_at->format('d M Y') }}</span>
                                                    </div>
                                                </div>
                                                <div class="flex space-x-1">
                                                    @if(in_array(strtolower($extension), ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'webp']))
                                                    <a href="{{ $document->getUrl() }}" 
                                                       target="_blank" 
                                                       class="document-button inline-flex items-center px-2 py-1 bg-blue-100 hover:bg-blue-200 text-blue-700 text-xs font-medium rounded">
                                                        <i class="fas fa-eye mr-1"></i>
                                                        Lihat
                                                    </a>
                                                    @endif
                                                    <a href="{{ $document->getUrl() }}" 
                                                       download="{{ $document->file_name }}"
                                                       class="document-button inline-flex items-center px-2 py-1 bg-green-100 hover:bg-green-200 text-green-700 text-xs font-medium rounded">
                                                        <i class="fas fa-download mr-1"></i>
                                                        Download
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                <!-- External Document Links -->
                                @if($article->document_links && count($article->document_links) > 0)
                                <div>
                                    <h4 class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3 flex items-center">
                                        <i class="fas fa-globe text-green-600 mr-2 text-sm"></i>
                                        Tautan Dokumen
                                    </h4>
                                    <div class="space-y-3">
                                        @foreach($article->document_links as $doc)
                                        @if($doc['type'] === 'url')
                                        <div class="bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg p-3 hover:bg-gray-100 transition-colors">
                                            <!-- Mobile Layout -->
                                            <div class="sm:hidden">
                                                <div class="mb-3">
                                                    <h5 class="text-sm font-medium text-gray-900 dark:text-white leading-snug">
                                                        {{ $doc['title'] }}
                                                    </h5>
                                                    @if(isset($doc['description']) && $doc['description'])
                                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1 leading-relaxed">{{ $doc['description'] }}</p>
                                                    @endif
                                                </div>
                                                <div class="flex flex-wrap gap-2">
                                                    <a href="{{ $doc['url'] }}" 
                                                       target="_blank" 
                                                       rel="noopener noreferrer"
                                                       class="flex-1 min-w-0 inline-flex items-center justify-center px-3 py-2 bg-blue-100 hover:bg-blue-200 text-blue-700 text-xs font-medium rounded-md">
                                                        <i class="fas fa-external-link-alt mr-1"></i>
                                                        Buka Link
                                                    </a>
                                                    <button onclick="copyToClipboard('{{ $doc['url'] }}')"
                                                            class="flex-1 min-w-0 inline-flex items-center justify-center px-3 py-2 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 text-gray-700 dark:text-gray-300 text-xs font-medium rounded-md">
                                                        <i class="fas fa-copy mr-1"></i>
                                                        Salin
                                                    </button>
                                                </div>
                                            </div>
                                            
                                            <!-- Desktop Layout -->
                                            <div class="hidden sm:flex items-center justify-between">
                                                <div class="flex-1 min-w-0">
                                                    <h5 class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                                        {{ $doc['title'] }}
                                                    </h5>
                                                    @if(isset($doc['description']) && $doc['description'])
                                                    <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">{{ $doc['description'] }}</p>
                                                    @endif
                                                </div>
                                                <div class="flex space-x-1 ml-3">
                                                    <a href="{{ $doc['url'] }}" 
                                                       target="_blank" 
                                                       rel="noopener noreferrer"
                                                       class="inline-flex items-center px-2 py-1 bg-blue-100 hover:bg-blue-200 text-blue-700 text-xs font-medium rounded">
                                                        <i class="fas fa-external-link-alt mr-1"></i>
                                                        Buka
                                                    </a>
                                                    <button onclick="copyToClipboard('{{ $doc['url'] }}')"
                                                            class="inline-flex items-center px-2 py-1 bg-gray-100 dark:bg-gray-800 hover:bg-gray-200 text-gray-700 dark:text-gray-300 text-xs font-medium rounded">
                                                        <i class="fas fa-copy mr-1"></i>
                                                        Salin
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                            </div>
                        </section>
                        @endif

                        <!-- Article Footer -->
                        <footer class="border-t border-gray-200 dark:border-gray-700 pt-8">
                            <!-- Tags -->
                            @if($article->tags)
                            <div class="mb-8">
                                <div class="flex items-center mb-4">
                                    <i class="fas fa-tags text-lg text-gray-600 dark:text-gray-400 mr-3"></i>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Tags</h3>
                                </div>
                                <div class="flex flex-wrap gap-2">
                                    @foreach(explode(',', $article->tags) as $tag)
                                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-gray-100 dark:bg-gray-800 text-gray-700 dark:text-gray-300 hover:bg-gray-200 transition-colors cursor-pointer border border-gray-200 dark:border-gray-700">
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
                                    <i class="fas fa-share-alt text-lg text-gray-600 dark:text-gray-400 mr-3"></i>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Bagikan Artikel</h3>
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

                    {{-- Comment form - hanya tampil jika komentar diaktifkan --}}
                    @if($article->comments_enabled)
                        @include('components.comment-form', [
                            'commentableType' => 'App\Models\News',
                            'commentableId' => $article->id
                        ])
                    @else
                        <div class="bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg p-6 mt-8 text-center">
                            <div class="w-16 h-16 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-comment-slash text-gray-400 text-2xl"></i>
                            </div>
                            <h4 class="text-gray-600 dark:text-gray-400 font-medium mb-2">Komentar Tidak Diaktifkan</h4>
                            <p class="text-gray-500 text-sm">Komentar tidak tersedia untuk artikel ini.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Enhanced Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-8 space-y-6">
                    <!-- Related News -->
                    @if($relatedNews->count() > 0)
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-100 dark:border-gray-700">
                        <div class="flex items-center mb-6">
                            <i class="fas fa-newspaper text-2xl text-blue-600 mr-3"></i>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Berita Terkait</h3>
                        </div>
                        <div class="space-y-4">
                            @foreach($relatedNews as $related)
                            <article class="group border-b border-gray-100 dark:border-gray-700 pb-4 last:border-b-0 last:pb-0">
                                <a href="{{ route('news.show', $related->slug) }}" class="block">
                                    @if($related->getFirstMediaUrl('featured_image'))
                                    <div class="aspect-[4/3] w-full overflow-hidden rounded-xl mb-3 relative">
                                        <img src="{{ $related->getFirstMediaUrl('featured_image') }}"
                                             alt="{{ $related->title }}"
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                             loading="lazy" width="400" height="300">
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                    </div>
                                    @endif
                                    <h4 class="font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 transition-colors line-clamp-2 mb-2 leading-snug">
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
                        <div class="mt-6 pt-4 border-t border-gray-100 dark:border-gray-700">
                            <a href="{{ route('news') }}"
                               class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors">
                                <span>Lihat Semua Berita</span>
                                <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    </div>
                    @endif

                    <!-- Latest News -->
                    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-xl p-6 border border-gray-100 dark:border-gray-700">
                        <div class="flex items-center mb-6">
                            <i class="fas fa-clock text-2xl text-blue-600 mr-3"></i>
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white">Berita Terbaru</h3>
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
                            <article class="group border-b border-gray-100 dark:border-gray-700 pb-4 last:border-b-0 last:pb-0">
                                <a href="{{ route('news.show', $latest->slug) }}" class="block">
                                    <h4 class="font-semibold text-gray-900 dark:text-white group-hover:text-blue-600 transition-colors line-clamp-3 text-sm leading-relaxed mb-2">
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

<!-- Lightbox Modal - Modern & Elegant -->
<div id="lightbox-modal" class="fixed inset-0 z-50 hidden p-0">
    <!-- Background overlay with gradient -->
    <div class="lightbox-overlay-bg"></div>
    
    <div class="lightbox-container">
        <!-- Enhanced Close Button -->
        <button onclick="closeLightbox()"
                class="lightbox-close"
                title="Tutup (ESC)">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        <!-- Enhanced Navigation Buttons -->
        <button class="lightbox-navigation prev" onclick="previousImage()" title="Foto sebelumnya (←)">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        
        <button class="lightbox-navigation next" onclick="nextImage()" title="Foto selanjutnya (→)">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
        
        <!-- Centered Image Container -->
        <div class="lightbox-image-container">
            <div class="relative">
                <img id="lightbox-image"
                     src="" 
                     alt="Lightbox image" 
                     class="max-w-[90vw] max-h-[90vh] object-contain shadow-2xl transition-transform duration-300 transform scale-95 opacity-0 rounded-lg" loading="lazy" width="800" height="600">
                
                <!-- Enhanced Loading indicator -->
                <div id="lightbox-loading" class="absolute inset-0 flex items-center justify-center hidden">
                    <div class="flex flex-col items-center space-y-6">
                        <div class="loading-spinner"></div>
                        <p class="loading-text">Memuat gambar...</p>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Enhanced Caption and Counter -->
        <div class="fixed bottom-8 left-1/2 transform -translate-x-1/2 text-center max-w-5xl px-6 z-30">
            <p id="lightbox-caption" class="text-white"></p>
            <div class="lightbox-counter" id="lightbox-counter"></div>
        </div>
    </div>
</div>

<script>
// Gallery data
const galleryImages = [
    @if($article->getMedia('gallery')->count() > 0)
        @foreach($article->getMedia('gallery') as $media)
        {
            url: '{{ $media->getUrl() }}',
            mediumUrl: '{{ $media->getUrl('medium') ?? $media->getUrl() }}',
            thumbUrl: '{{ $media->getUrl('thumb') ?? $media->getUrl() }}',
            name: '{{ $media->name }}',
            alt: '{{ $media->alt_text ?? $media->name }}'
        },
        @endforeach
    @endif
];

// Debug: Log available URLslet currentImageIndex = 0;

function openLightbox(index) {
    if (galleryImages.length === 0) return;
    
    currentImageIndex = index;
    const modal = document.getElementById('lightbox-modal');
    const image = document.getElementById('lightbox-image');
    const captionEl = document.getElementById('lightbox-caption');
    const counterEl = document.getElementById('lightbox-counter');
    const loadingEl = document.getElementById('lightbox-loading');

    // Show modal with enhanced animation
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
    
    // Progressive enhancement for entrance
    requestAnimationFrame(() => {
        modal.style.opacity = '1';
        modal.style.transform = 'scale(1)';
    });
    
    // Show loading with elegant animation
    loadingEl.classList.remove('hidden');
    image.style.opacity = '0';
    image.style.transform = 'scale(0.9) translateY(20px)';
    
    // Load image with enhanced error handling
    const newImage = new Image();
    newImage.onload = function() {
        // Set image properties
        image.src = this.src;
        image.alt = galleryImages[currentImageIndex].alt;
        captionEl.textContent = galleryImages[currentImageIndex].name || 'Foto galeri';
        counterEl.textContent = `${currentImageIndex + 1} / ${galleryImages.length}`;
        
        // Elegant reveal animation
        setTimeout(() => {
            loadingEl.classList.add('hidden');
            image.style.opacity = '1';
            image.style.transform = 'scale(1) translateY(0)';
            
            // Add subtle scale animation
            image.style.animation = 'imageReveal 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            setTimeout(() => {
                image.style.animation = '';
            }, 600);
        }, 100);
    };
    
    newImage.onerror = function() {
        // Enhanced error placeholder
        const placeholder = 'data:image/svg+xml;base64,' + btoa(`
            <svg width="800" height="600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 600">
                <defs>
                    <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#1e293b;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#0f172a;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <rect width="100%" height="100%" fill="url(#grad1)"/>
                <circle cx="400" cy="200" r="50" fill="#475569" opacity="0.8"/>
                <path d="M350 350 L350 300 L400 250 L450 300 L450 350 Z" fill="#475569" opacity="0.8"/>
                <text x="400" y="450" font-family="Arial, sans-serif" font-size="24" fill="#94a3b8" text-anchor="middle">Gambar tidak tersedia</text>
                <text x="400" y="480" font-family="Arial, sans-serif" font-size="16" fill="#64748b" text-anchor="middle">Gagal memuat konten</text>
            </svg>
        `);
        image.src = placeholder;
        image.alt = 'Gambar tidak tersedia';
        captionEl.textContent = 'Gambar tidak dapat dimuat';
        counterEl.textContent = `${currentImageIndex + 1} / ${galleryImages.length}`;
        
        setTimeout(() => {
            loadingEl.classList.add('hidden');
            image.style.opacity = '1';
            image.style.transform = 'scale(1) translateY(0)';
        }, 100);
    };
    
    newImage.src = galleryImages[currentImageIndex].url;
    
    // Enhanced navigation button visibility
    const prevBtn = modal.querySelector('.prev');
    const nextBtn = modal.querySelector('.next');
    
    if (galleryImages.length <= 1) {
        prevBtn.style.display = 'none';
        nextBtn.style.display = 'none';
    } else {
        prevBtn.style.display = 'flex';
        nextBtn.style.display = 'flex';
        
        // Animate button appearance
        setTimeout(() => {
            prevBtn.style.opacity = '1';
            nextBtn.style.opacity = '1';
            prevBtn.style.transform = 'translateY(-50%) translateX(0)';
            nextBtn.style.transform = 'translateY(-50%) translateX(0)';
        }, 200);
    }
}

function closeLightbox() {
    const modal = document.getElementById('lightbox-modal');
    const image = document.getElementById('lightbox-image');
    
    // Enhanced exit animation
    modal.style.opacity = '0';
    modal.style.transform = 'scale(0.95)';
    image.style.transform = 'scale(0.9) translateY(20px)';
    
    setTimeout(() => {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
        
        // Reset styles
        modal.style.opacity = '';
        modal.style.transform = '';
        image.style.transform = '';
    }, 300);
}

function previousImage() {
    currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
    updateLightboxImage('prev');
}

function nextImage() {
    currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
    updateLightboxImage('next');
}

function updateLightboxImage(direction = 'next') {
    const image = document.getElementById('lightbox-image');
    const captionEl = document.getElementById('lightbox-caption');
    const counterEl = document.getElementById('lightbox-counter');
    const loadingEl = document.getElementById('lightbox-loading');
    
    // Enhanced transition animation based on direction
    const slideDirection = direction === 'next' ? '30px' : '-30px';
    
    loadingEl.classList.remove('hidden');
    image.style.opacity = '0';
    image.style.transform = `scale(0.95) translateX(${slideDirection})`;
    
    // Load new image
    const newImage = new Image();
    newImage.onload = function() {
        image.src = this.src;
        image.alt = galleryImages[currentImageIndex].alt;
        captionEl.textContent = galleryImages[currentImageIndex].name || 'Foto galeri';
        counterEl.textContent = `${currentImageIndex + 1} / ${galleryImages.length}`;
        
        // Smooth reveal with directional slide
        setTimeout(() => {
            loadingEl.classList.add('hidden');
            image.style.opacity = '1';
            image.style.transform = 'scale(1) translateX(0)';
            
            // Add slide animation based on direction
            const reverseDirection = direction === 'next' ? '-30px' : '30px';
            image.style.animation = `slideFrom${direction === 'next' ? 'Right' : 'Left'} 0.5s cubic-bezier(0.4, 0, 0.2, 1)`;
            setTimeout(() => {
                image.style.animation = '';
            }, 500);
        }, 150);
    };
    
    newImage.onerror = function() {
        // Enhanced error placeholder (same as in openLightbox)
        const placeholder = 'data:image/svg+xml;base64,' + btoa(`
            <svg width="800" height="600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 800 600">
                <defs>
                    <linearGradient id="grad1" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:#1e293b;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#0f172a;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <rect width="100%" height="100%" fill="url(#grad1)"/>
                <circle cx="400" cy="200" r="50" fill="#475569" opacity="0.8"/>
                <path d="M350 350 L350 300 L400 250 L450 300 L450 350 Z" fill="#475569" opacity="0.8"/>
                <text x="400" y="450" font-family="Arial, sans-serif" font-size="24" fill="#94a3b8" text-anchor="middle">Gambar tidak tersedia</text>
                <text x="400" y="480" font-family="Arial, sans-serif" font-size="16" fill="#64748b" text-anchor="middle">Gagal memuat konten</text>
            </svg>
        `);
        image.src = placeholder;
        image.alt = 'Gambar tidak tersedia';
        captionEl.textContent = 'Gambar tidak dapat dimuat';
        counterEl.textContent = `${currentImageIndex + 1} / ${galleryImages.length}`;
        
        setTimeout(() => {
            loadingEl.classList.add('hidden');
            image.style.opacity = '1';
            image.style.transform = 'scale(1) translateX(0)';
        }, 150);
    };
    
    newImage.src = galleryImages[currentImageIndex].url;
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

// Event listeners
document.getElementById('lightbox-modal').addEventListener('click', function(e) {
    if (e.target === this || e.target.classList.contains('lightbox-container')) {
        closeLightbox();
    }
});

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('lightbox-modal');
    if (!modal.classList.contains('hidden')) {
        switch(e.key) {
            case 'Escape':
                closeLightbox();
                break;
            case 'ArrowLeft':
                e.preventDefault();
                previousImage();
                break;
            case 'ArrowRight':
                e.preventDefault();
                nextImage();
                break;
        }
    }
});

// Add enhanced animation keyframes and modal initialization
const enhancedAnimationStyle = document.createElement('style');
enhancedAnimationStyle.textContent = `
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: scale(0.95) translateX(20px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateX(0);
        }
    }
    
    @keyframes slideFromRight {
        from {
            opacity: 0;
            transform: scale(0.95) translateX(30px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateX(0);
        }
    }
    
    @keyframes slideFromLeft {
        from {
            opacity: 0;
            transform: scale(0.95) translateX(-30px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateX(0);
        }
    }
    
    @keyframes imageReveal {
        from {
            opacity: 0;
            transform: scale(0.9) translateY(20px);
            filter: blur(8px);
        }
        to {
            opacity: 1;
            transform: scale(1) translateY(0);
            filter: blur(0px);
        }
    }
    
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.9);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
    
    @keyframes modalFadeIn {
        from {
            opacity: 0;
            backdrop-filter: blur(0px);
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            backdrop-filter: blur(15px);
            transform: scale(1);
        }
    }
    
    #lightbox-modal {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        transform-origin: center center;
    }
    
    #lightbox-modal.hidden {
        pointer-events: none;
    }
    
    .lightbox-navigation {
        opacity: 0;
        transform: translateY(-50%) translateX(-10px);
    }
    
    .lightbox-navigation.next {
        transform: translateY(-50%) translateX(10px);
    }
    
    /* Smooth reveal for navigation buttons */
    .lightbox-navigation.revealed {
        opacity: 1;
        transform: translateY(-50%) translateX(0);
    }
    
    /* Enhanced loading animation */
    .loading-spinner {
        background: conic-gradient(from 0deg, transparent, #3b82f6, transparent);
        mask: radial-gradient(farthest-side, transparent calc(100% - 3px), #000 calc(100% - 3px));
        -webkit-mask: radial-gradient(farthest-side, transparent calc(100% - 3px), #000 calc(100% - 3px));
    }
    
    /* Parallax effect for background */
    .lightbox-overlay-bg {
        animation: subtleShift 20s ease-in-out infinite;
    }
    
    @keyframes subtleShift {
        0%, 100% { 
            background-position: 0% 50%;
            opacity: 0.8;
        }
        50% { 
            background-position: 100% 50%;
            opacity: 0.9;
        }
    }
`;
document.head.appendChild(enhancedAnimationStyle);

// Image lazy loading error handling
document.addEventListener('DOMContentLoaded', function() {
    // Global error handling for all images
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.addEventListener('error', function() {
            // Create SVG placeholder
            const placeholder = 'data:image/svg+xml;base64,' + btoa(`
                <svg width="400" height="400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400">
                    <rect width="100%" height="100%" fill="#f3f4f6"/>
                    <circle cx="200" cy="160" r="30" fill="#9ca3af"/>
                    <path d="M160 280 L160 240 L200 200 L240 240 L240 280 Z" fill="#9ca3af"/>
                    <text x="200" y="320" font-family="Arial, sans-serif" font-size="16" fill="#6b7280" text-anchor="middle">Gambar tidak tersedia</text>
                </svg>
            `);
            this.src = placeholder;
            this.alt = 'Gambar tidak tersedia';
        });
    });
    
    // Enhanced gallery image loading
    const galleryItems = document.querySelectorAll('.gallery-item img');
    galleryItems.forEach((img, index) => {
        // Check if image is already loaded (cached)
        if (img.complete && img.naturalWidth > 0) {
            img.style.opacity = '1';
            const placeholder = img.parentElement.querySelector('.loading-placeholder');
            if (placeholder) placeholder.remove();
            return;
        }
        
        // Add error handling with delay to avoid premature placeholder
        let errorTimeout;
        
        img.addEventListener('load', function() {
            clearTimeout(errorTimeout);
            this.style.opacity = '1';
            const placeholder = this.parentElement.querySelector('.loading-placeholder');
            if (placeholder) placeholder.remove();
        });
        
        img.addEventListener('error', function() {
            clearTimeout(errorTimeout);
            
            // Try alternative URLs
            const originalSrc = this.src;
            if (!this.dataset.tried && this.dataset.fallback && originalSrc !== this.dataset.fallback) {
                this.dataset.tried = 'true';
                this.src = this.dataset.fallback;
                return;
            }
            
            // If all fails, show placeholder
            const placeholder = 'data:image/svg+xml;base64,' + btoa(`
                <svg width="400" height="400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400">
                    <rect width="100%" height="100%" fill="#f3f4f6"/>
                    <circle cx="200" cy="160" r="30" fill="#9ca3af"/>
                    <path d="M160 280 L160 240 L200 200 L240 240 L240 280 Z" fill="#9ca3af"/>
                    <text x="200" y="320" font-family="Arial, sans-serif" font-size="16" fill="#6b7280" text-anchor="middle">Gambar tidak tersedia</text>
                </svg>
            `);
            this.src = placeholder;
            this.alt = 'Gambar tidak tersedia';
            this.style.opacity = '1';
            const placeholderEl = this.parentElement.querySelector('.loading-placeholder');
            if (placeholderEl) placeholderEl.remove();
        });
        
        // Set a timeout for slow loading images
        errorTimeout = setTimeout(() => {
            if (img.naturalWidth === 0) {
                // Trigger error handler
                img.dispatchEvent(new Event('error'));
            }
        }, 10000); // 10 second timeout
    });    // Add click hint animation after page load
    setTimeout(() => {
        const firstGalleryItem = document.querySelector('.gallery-item');
        if (firstGalleryItem) {
            firstGalleryItem.style.animation = 'pulse 1.5s ease-in-out 3';
        }
    }, 2000);
});

// Copy to clipboard function for document links
function copyToClipboard(text) {
    if (navigator.clipboard && window.isSecureContext) {
        // Use modern clipboard API
        navigator.clipboard.writeText(text).then(() => {
            showToast('Link berhasil disalin ke clipboard!', 'success');
        }).catch(() => {
            fallbackCopyToClipboard(text);
        });
    } else {
        // Fallback for older browsers
        fallbackCopyToClipboard(text);
    }
}

function fallbackCopyToClipboard(text) {
    const textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.style.position = 'fixed';
    textArea.style.left = '-999999px';
    textArea.style.top = '-999999px';
    document.body.appendChild(textArea);
    textArea.focus();
    textArea.select();
    
    try {
        document.execCommand('copy');
        showToast('Link berhasil disalin ke clipboard!', 'success');
    } catch (err) {
        showToast('Gagal menyalin link. Silakan salin manual.', 'error');
    }
    
    document.body.removeChild(textArea);
}

// Toast notification function
function showToast(message, type = 'info') {
    // Remove existing toast if any
    const existingToast = document.getElementById('toast-notification');
    if (existingToast) {
        existingToast.remove();
    }
    
    // Create toast element
    const toast = document.createElement('div');
    toast.id = 'toast-notification';
    toast.className = `fixed top-4 right-4 z-50 flex items-center p-4 mb-4 text-sm rounded-lg shadow-lg transition-all duration-300 transform translate-x-full ${
        type === 'success' ? 'text-green-800 bg-green-50 border border-green-200' :
        type === 'error' ? 'text-red-800 bg-red-50 border border-red-200' :
        'text-blue-800 bg-blue-50 border border-blue-200'
    }`;
    
    toast.innerHTML = `
        <div class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 ${
            type === 'success' ? 'text-green-500 bg-green-100' :
            type === 'error' ? 'text-red-500 bg-red-100' :
            'text-blue-500 bg-blue-100'
        } rounded-lg">
            <i class="fas ${
                type === 'success' ? 'fa-check' :
                type === 'error' ? 'fa-times' :
                'fa-info'
            }"></i>
        </div>
        <div class="ml-3 text-sm font-medium">${message}</div>
        <button type="button" onclick="this.parentElement.remove()" class="ml-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8">
            <span class="sr-only">Close</span>
            <i class="fas fa-times w-3 h-3"></i>
        </button>
    `;
    
    document.body.appendChild(toast);
    
    // Animate in
    requestAnimationFrame(() => {
        toast.style.transform = 'translateX(0)';
    });
    
    // Auto remove after 3 seconds
    setTimeout(() => {
        if (toast.parentElement) {
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.remove();
                }
            }, 300);
        }
    }, 3000);
}
</script>
@endsection
