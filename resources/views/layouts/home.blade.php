<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', (($company && $company->company_name && is_string($company->company_name)) ? $company->company_name : config('app.name', 'Tirta Perwira')))</title>
    <meta name="description" content="@yield('description', (($company && $company->company_description && is_string($company->company_description)) ? strip_tags($company->company_description) : 'PDAM Purbalingga - Melayani dengan Hati, Memberikan yang Terbaik untuk Air Bersih Berkualitas'))">
    <meta name="keywords" content="@yield('keywords', 'PDAM, Purbalingga, air bersih, pelayanan air, tarif air')">

    <!-- Open Graph -->
    <meta property="og:title" content="@yield('og_title', (($company && $company->company_name && is_string($company->company_name)) ? $company->company_name : config('app.name')))">
    <meta property="og:description" content="@yield('og_description', (($company && $company->company_description && is_string($company->company_description)) ? strip_tags($company->company_description) : 'PDAM Purbalingga - Melayani dengan Hati'))">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="@yield('og_image', $company && $company->logo ? asset('storage/' . $company->logo) : asset('images/og-default.jpg'))">

    <!-- Favicon -->
    @if($company && $company->favicon)
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/' . $company->favicon) }}">
    <link rel="apple-touch-icon" href="{{ asset('storage/' . $company->favicon) }}">
    @else
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    @endif

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Styles for Enhanced Features -->
    <style>
        /* Enhanced smooth scrolling */
        html {
            scroll-behavior: smooth;
            scroll-padding-top: 80px; /* Account for sticky header */
        }
        
        /* Container styles */
        .container-custom {
            @apply container mx-auto px-4 lg:px-8;
        }

        /* Section padding */
        .section-padding {
            @apply py-16 lg:py-24;
        }

        /* Hero gradient */
        .hero-gradient {
            background: linear-gradient(135deg, #1e3a8a 0%, #3b82f6 50%, #06b6d4 100%);
        }

        .hero-overlay {
            background: rgba(30, 58, 138, 0.8);
        }

        /* Button styles */
        .btn-primary {
            @apply inline-flex items-center px-8 py-4 bg-white text-blue-600 font-semibold rounded-full hover:bg-blue-50 hover:shadow-lg transform hover:scale-105 transition-all duration-300 shadow-md;
        }

        .btn-secondary {
            @apply inline-flex items-center px-8 py-4 bg-transparent text-white font-semibold rounded-full border-2 border-white hover:bg-white hover:text-blue-600 transform hover:scale-105 transition-all duration-300;
        }

        /* Animation classes */
        .animate-fadeInUp {
            animation: fadeInUp 0.6s ease-out forwards;
            opacity: 0;
            transform: translateY(30px);
        }

        .animation-delay-200 {
            animation-delay: 0.2s;
        }

        .animation-delay-400 {
            animation-delay: 0.4s;
        }

        .animation-delay-600 {
            animation-delay: 0.6s;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Hero carousel styles */
        .hero-slide {
            opacity: 0;
            visibility: hidden;
        }

        .hero-slide.active {
            opacity: 1;
            visibility: visible;
        }

        .hero-nav {
            transition: all 0.3s ease;
        }

        .hero-nav:hover {
            transform: scale(1.1);
        }

        .hero-dot.active {
            transform: scale(1.2);
        }

        /* Card styles */
        .card {
            @apply bg-white rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden;
        }

        .card:hover {
            transform: translateY(-4px);
        }

        /* Stats animation */
        .stat-number {
            @apply text-3xl lg:text-4xl font-bold text-blue-600 mb-2;
        }

        /* Service card hover effect */
        .service-card {
            @apply bg-white rounded-xl p-6 shadow-md hover:shadow-xl transition-all duration-300 border border-gray-100 group;
        }

        .service-card:hover {
            @apply border-blue-200 transform -translate-y-1;
        }

        /* News card styles */
        .news-card {
            @apply bg-white rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-all duration-300 group;
        }

        .news-card:hover {
            @apply transform -translate-y-1;
        }

        /* Form styles */
        .form-input {
            @apply w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200;
        }

        .form-textarea {
            @apply w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200 resize-none;
        }

        .form-select {
            @apply w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-200;
        }

        /* Footer link styles */
        .footer-link {
            @apply text-blue-200 hover:text-white transition-colors duration-200;
        }

        /* Social links */
        .social-link {
            @apply text-blue-200 hover:text-white transition-all duration-200 transform hover:scale-110;
        }

        /* Loading animation for stats */
        .loading-number {
            animation: countUp 2s ease-out forwards;
        }

        @keyframes countUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Enhanced image hover effects */
        .image-hover {
            transition: all 0.3s ease;
        }

        .image-hover:hover {
            transform: scale(1.05);
        }

        /* Gradient text */
        .gradient-text {
            background: linear-gradient(135deg, #2563eb, #06b6d4);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Enhanced shadows */
        .shadow-blue {
            box-shadow: 0 10px 25px rgba(59, 130, 246, 0.1);
        }

        .shadow-blue:hover {
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.15);
        }
    </style>

    @stack('styles')
</head>
<body class="bg-gray-50 font-sans antialiased">
    <!-- Home Navigation -->
    <x-home-navbar :company="$company" />

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gradient-to-br from-blue-900 via-blue-800 to-blue-900 text-white relative overflow-hidden">
        <!-- Decorative background pattern -->
        <div class="absolute inset-0 opacity-10">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="footer-grid" width="20" height="20" patternUnits="userSpaceOnUse">
                        <circle cx="10" cy="10" r="1" fill="currentColor"/>
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#footer-grid)"/>
            </svg>
        </div>

        <div class="relative z-10">
            <!-- Main Footer Content -->
            <div class="container-custom py-16 lg:py-20">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div class="lg:col-span-2">
                        <div class="flex items-center space-x-3 mb-6">
                            @if($company && $company->getFirstMediaUrl('logo'))
                            <img src="{{ $company->getFirstMediaUrl('logo') }}" 
                                 alt="Logo {{ $company->company_name ?? 'Tirta Perwira' }}"
                                 class="h-12 w-12 object-contain">
                            @elseif($company && $company->logo)
                            <img src="{{ asset('storage/' . $company->logo) }}" 
                                 alt="Logo {{ $company->company_name ?? 'Tirta Perwira' }}"
                                 class="h-12 w-12 object-contain">
                            @else
                            <div class="h-12 w-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                <span class="text-white font-bold text-lg">TP</span>
                            </div>
                            @endif
                            <div>
                                <div class="text-xl font-bold">
                                    {{ ($company && $company->company_name && is_string($company->company_name)) ? Str::before($company->company_name, ' - ') : 'Tirta Perwira' }}
                                </div>
                                <div class="text-blue-200 text-sm">
                                    {{ ($company && $company->company_name && is_string($company->company_name) && Str::contains($company->company_name, ' - ')) ? Str::after($company->company_name, ' - ') : 'PDAM Purbalingga' }}
                                </div>
                            </div>
                        </div>
                        @if($company && $company->company_description && is_string($company->company_description))
                        <p class="text-blue-100 mb-6 leading-relaxed">
                            {{ Str::limit(strip_tags($company->company_description), 200) }}
                        </p>
                        @endif
                        
                        <!-- Social Links -->
                        <div class="flex space-x-4">
                            @if($company && $company->facebook_url)
                            <a href="{{ $company->facebook_url }}" target="_blank" rel="noopener noreferrer" 
                               class="social-link bg-white bg-opacity-20 p-3 rounded-full hover:bg-opacity-30">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            @endif
                            @if($company && $company->instagram_url)
                            <a href="{{ $company->instagram_url }}" target="_blank" rel="noopener noreferrer"
                               class="social-link bg-white bg-opacity-20 p-3 rounded-full hover:bg-opacity-30">
                                <i class="fab fa-instagram"></i>
                            </a>
                            @endif
                            @if($company && $company->youtube_url)
                            <a href="{{ $company->youtube_url }}" target="_blank" rel="noopener noreferrer"
                               class="social-link bg-white bg-opacity-20 p-3 rounded-full hover:bg-opacity-30">
                                <i class="fab fa-youtube"></i>
                            </a>
                            @endif
                            @if($company && $company->twitter_url)
                            <a href="{{ $company->twitter_url }}" target="_blank" rel="noopener noreferrer"
                               class="social-link bg-white bg-opacity-20 p-3 rounded-full hover:bg-opacity-30">
                                <i class="fab fa-twitter"></i>
                            </a>
                            @endif
                        </div>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h3 class="text-lg font-semibold mb-6">Tautan Cepat</h3>
                        <ul class="space-y-3">
                            <li><a href="{{ route('about') }}" class="footer-link hover:underline">Tentang Kami</a></li>
                            <li><a href="{{ route('services') }}" class="footer-link hover:underline">Layanan</a></li>
                            <li><a href="{{ route('news') }}" class="footer-link hover:underline">Berita</a></li>
                            <li><a href="{{ route('tariff') }}" class="footer-link hover:underline">Tarif Air</a></li>
                            <li><a href="{{ route('contact') }}" class="footer-link hover:underline">Kontak</a></li>
                        </ul>
                    </div>

                    <!-- Contact Info -->
                    <div>
                        <h3 class="text-lg font-semibold mb-6">Kontak Kami</h3>
                        <div class="space-y-3">
                            @if($company && $company->address && is_string($company->address))
                            <div class="flex items-start space-x-3">
                                <i class="fas fa-map-marker-alt text-blue-300 mt-1 flex-shrink-0"></i>
                                <span class="text-blue-100 text-sm">{{ $company->address }}</span>
                            </div>
                            @endif
                            @if($company && $company->phone && is_string($company->phone))
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-phone text-blue-300 flex-shrink-0"></i>
                                <a href="tel:{{ $company->phone }}" class="text-blue-100 text-sm hover:underline">{{ $company->phone }}</a>
                            </div>
                            @endif
                            @if($company && $company->email && is_string($company->email))
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-envelope text-blue-300 flex-shrink-0"></i>
                                <a href="mailto:{{ $company->email }}" class="text-blue-100 text-sm hover:underline">{{ $company->email }}</a>
                            </div>
                            @endif
                            @if($company && $company->website && is_string($company->website))
                            <div class="flex items-center space-x-3">
                                <i class="fas fa-globe text-blue-300 flex-shrink-0"></i>
                                <a href="{{ $company->website }}" target="_blank" rel="noopener noreferrer" class="text-blue-100 text-sm hover:underline">{{ $company->website }}</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bottom Footer -->
            <div class="border-t border-blue-700 border-opacity-50">
                <div class="container-custom py-6">
                    <div class="flex flex-col md:flex-row items-center justify-between space-y-4 md:space-y-0">
                        <div class="text-blue-200 text-sm text-center md:text-left">
                            &copy; {{ date('Y') }} {{ ($company && $company->company_name && is_string($company->company_name)) ? $company->company_name : 'Tirta Perwira - PDAM Purbalingga' }}. Hak Cipta Dilindungi.
                        </div>
                        <div class="flex space-x-6 text-sm">
                            <a href="#" class="footer-link hover:underline">Kebijakan Privasi</a>
                            <a href="#" class="footer-link hover:underline">Syarat & Ketentuan</a>
                            <a href="#" class="footer-link hover:underline">Sitemap</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    @stack('scripts')

    <!-- Enhanced JavaScript for better UX -->
    <script>
        // Enhanced smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const headerOffset = 80;
                    const elementPosition = target.offsetTop;
                    const offsetPosition = elementPosition - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add loading animation to numbers
        function animateNumbers() {
            const numbers = document.querySelectorAll('.stat-number');
            numbers.forEach(number => {
                const target = parseInt(number.innerText);
                let current = 0;
                const increment = target / 100;
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    number.innerText = Math.floor(current).toLocaleString('id-ID');
                }, 20);
            });
        }

        // Intersection Observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate-fadeInUp');
                    
                    // Animate numbers if they exist
                    const numbers = entry.target.querySelectorAll('.stat-number');
                    if (numbers.length > 0) {
                        animateNumbers();
                    }
                }
            });
        }, observerOptions);

        // Observe elements for animation
        document.querySelectorAll('.card, .service-card, .news-card').forEach(el => {
            observer.observe(el);
        });
    </script>
</body>
</html>
