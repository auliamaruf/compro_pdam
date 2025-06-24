import './bootstrap';

// Search functionality for home page
document.addEventListener('DOMContentLoaded', function() {
    // Search term function for popular tags
    window.searchTerm = function(term) {
        const searchInput = document.getElementById('hero-search');
        if (searchInput) {
            searchInput.value = term;
            searchInput.focus();
        }
    };

    // Enhanced Deep Linking - Browser Navigation Support
    function navigateToSection(hash) {
        const target = document.querySelector(hash);
        if (target) {
            const headerHeight = 80;
            const targetPosition = target.offsetTop - headerHeight;

            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        }
    }

    // Handle browser back/forward navigation
    window.addEventListener('popstate', function(e) {
        const hash = window.location.hash;
        if (hash) {
            navigateToSection(hash);
        } else {
            // If no hash, scroll to top
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }
    });

    // Handle initial page load with hash
    window.addEventListener('DOMContentLoaded', function() {
        const hash = window.location.hash;
        if (hash) {
            // Small delay to ensure page is fully loaded
            setTimeout(() => {
                navigateToSection(hash);
            }, 500);
        }
    });

    // Smooth scroll functionality for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const href = this.getAttribute('href');

            // Skip if it's just a hash without target
            if (href === '#') return;

            e.preventDefault();

            const target = document.querySelector(href);
            if (target) {
                // Calculate offset for fixed header
                const headerHeight = 80; // Adjust based on your header height
                const targetPosition = target.offsetTop - headerHeight;

                window.scrollTo({
                    top: targetPosition,
                    behavior: 'smooth'
                });

                // Update URL without triggering scroll
                history.pushState(null, null, href);
            }
        });
    });

    // Active section highlighting for navbar
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('nav a[href^="#"]');

    if (sections.length > 0 && navLinks.length > 0) {
        const highlightActiveSection = () => {
            let current = '';
            const scrollY = window.pageYOffset;

            sections.forEach(section => {
                const sectionTop = section.offsetTop - 100;
                const sectionHeight = section.offsetHeight;

                if (scrollY >= sectionTop && scrollY < sectionTop + sectionHeight) {
                    current = section.getAttribute('id');
                }
            });

            navLinks.forEach(link => {
                link.classList.remove('active', 'text-blue-600');
                if (link.getAttribute('href') === `#${current}`) {
                    link.classList.add('active', 'text-blue-600');
                }
            });
        };

        // Throttle scroll event for better performance
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                requestAnimationFrame(() => {
                    highlightActiveSection();
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Initial check
        highlightActiveSection();
    }

    // Enhanced navbar dropdown behavior
    const dropdownButtons = document.querySelectorAll('.relative.group button');
    dropdownButtons.forEach(button => {
        const dropdown = button.nextElementSibling;
        if (dropdown) {
            let hoverTimeout;

            button.addEventListener('mouseenter', () => {
                clearTimeout(hoverTimeout);
                dropdown.classList.remove('invisible', 'opacity-0');
                dropdown.classList.add('visible', 'opacity-100');
            });

            button.addEventListener('mouseleave', () => {
                hoverTimeout = setTimeout(() => {
                    if (!dropdown.matches(':hover')) {
                        dropdown.classList.add('invisible', 'opacity-0');
                        dropdown.classList.remove('visible', 'opacity-100');
                    }
                }, 100);
            });

            dropdown.addEventListener('mouseenter', () => {
                clearTimeout(hoverTimeout);
            });

            dropdown.addEventListener('mouseleave', () => {
                dropdown.classList.add('invisible', 'opacity-0');
                dropdown.classList.remove('visible', 'opacity-100');
            });
        }
    });



    // Progress Bar for Page Scroll
    const progressBar = document.createElement('div');
    progressBar.id = 'scroll-progress';
    progressBar.className = 'fixed top-0 left-0 w-0 h-1 bg-gradient-to-r from-blue-500 to-cyan-500 z-50 transition-all duration-150';
    document.body.appendChild(progressBar);

    window.addEventListener('scroll', () => {
        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        const scrolled = (winScroll / height) * 100;
        progressBar.style.width = scrolled + '%';
    });

    // Parallax Effect for Hero Section
    const heroSection = document.querySelector('.hero-slide.active');
    if (heroSection) {
        window.addEventListener('scroll', () => {
            const scrolled = window.pageYOffset;
            const heroBackground = heroSection.querySelector('.absolute.inset-0');
            if (heroBackground) {
                heroBackground.style.transform = `translateY(${scrolled * 0.5}px)`;
            }
        });
    }

    // Intersection Observer for Animation Triggers
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -10% 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fadeInUp');
                // Add stagger delay for child elements
                const children = entry.target.querySelectorAll('.animate-on-scroll');
                children.forEach((child, index) => {
                    setTimeout(() => {
                        child.classList.add('animate-fadeInUp');
                    }, index * 100);
                });
            }
        });
    }, observerOptions);

    // Observe sections for animations
    document.querySelectorAll('section').forEach(section => {
        observer.observe(section);
    });

    // Mobile FAB (Floating Action Button) Enhancement
    const fabMain = document.getElementById('fab-main');
    const fabMenu = document.getElementById('fab-menu');
    let fabOpen = false;

    if (fabMain && fabMenu) {
        fabMain.addEventListener('click', () => {
            fabOpen = !fabOpen;

            if (fabOpen) {
                // Open FAB menu
                fabMenu.classList.remove('opacity-0', 'invisible');
                fabMenu.classList.add('opacity-100', 'visible');

                // Animate menu items
                const fabItems = fabMenu.querySelectorAll('.fab-item');
                fabItems.forEach((item, index) => {
                    setTimeout(() => {
                        item.classList.remove('translate-x-8');
                        item.classList.add('translate-x-0');
                    }, index * 50);
                });

                // Rotate main button
                fabMain.querySelector('svg').style.transform = 'rotate(45deg)';
            } else {
                // Close FAB menu
                const fabItems = fabMenu.querySelectorAll('.fab-item');
                fabItems.forEach((item) => {
                    item.classList.add('translate-x-8');
                    item.classList.remove('translate-x-0');
                });

                setTimeout(() => {
                    fabMenu.classList.add('opacity-0', 'invisible');
                    fabMenu.classList.remove('opacity-100', 'visible');
                }, 150);

                // Reset main button rotation
                fabMain.querySelector('svg').style.transform = 'rotate(0deg)';
            }
        });

        // Close FAB when clicking outside
        document.addEventListener('click', (e) => {
            if (!fabMain.contains(e.target) && !fabMenu.contains(e.target) && fabOpen) {
                fabMain.click();
            }
        });

        // Handle FAB menu item clicks
        const fabItems = fabMenu.querySelectorAll('.fab-item');
        fabItems.forEach(item => {
            item.addEventListener('click', () => {
                if (fabOpen) {
                    fabMain.click(); // Close menu after selection
                }
            });
        });
    }

    // Enhanced Search with Real-time Suggestions
    const searchInput = document.getElementById('hero-search');
    if (searchInput) {
        let searchTimeout;

        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            const query = this.value.trim();

            if (query.length > 2) {
                searchTimeout = setTimeout(() => {
                    // Add loading state
                    this.classList.add('animate-pulse-slow');

                    // Simulate search suggestions (you can replace with actual API call)
                    setTimeout(() => {
                        this.classList.remove('animate-pulse-slow');
                        // Here you would typically show search suggestions
                    }, 500);
                }, 300);
            }
        });
    }

    // ============================================
    // ENHANCED IMAGE LAZY LOADING
    // ============================================

    // Create shimmer loading effect
    function createImagePlaceholder(img) {
        img.style.backgroundColor = '#f3f4f6';
        img.style.background = 'linear-gradient(90deg, #f3f4f6 25%, #e5e7eb 50%, #f3f4f6 75%)';
        img.style.backgroundSize = '200% 100%';
        img.style.animation = 'shimmer 1.5s infinite';
    }

    // Enhanced lazy loading observer
    const imageObserver = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const img = entry.target;
                const src = img.dataset.src;

                if (src) {
                    // Preload image before displaying
                    const imageLoader = new Image();

                    imageLoader.onload = () => {
                        img.src = src;
                        img.classList.remove('opacity-0');
                        img.classList.add('opacity-100');
                        img.style.background = 'none';
                        img.style.animation = 'none';
                        img.removeAttribute('data-src');
                    };

                    imageLoader.onerror = () => {
                        img.style.background = '#f3f4f6';
                        img.style.animation = 'none';
                        console.warn('Failed to load image:', src);
                    };

                    imageLoader.src = src;
                }

                observer.unobserve(img);
            }
        });
    }, {
        rootMargin: '50px 0px', // Load 50px before entering viewport
        threshold: 0.01
    });

    // Apply lazy loading to images with data-src attribute
    document.querySelectorAll('img[data-src]').forEach(img => {
        img.classList.add('opacity-0', 'transition-opacity', 'duration-500');
        createImagePlaceholder(img);
        imageObserver.observe(img);
    });

    // Enhanced Scroll Performance with Throttling
    let isScrolling = false;

    function handleScroll() {
        if (!isScrolling) {
            window.requestAnimationFrame(() => {
                // Your scroll-dependent functions here
                isScrolling = false;
            });
            isScrolling = true;
        }
    }

    window.addEventListener('scroll', handleScroll, { passive: true });

    // ============================================
    // SMART CONTENT - OFFICE STATUS
    // ============================================

    function updateOfficeStatus() {
        const now = new Date();
        const currentHour = now.getHours();
        const currentDay = now.getDay(); // 0 = Sunday, 1 = Monday, etc.

        const statusIndicator = document.querySelector('.office-status-indicator');
        const statusText = document.querySelector('.office-status-text');

        if (!statusIndicator || !statusText) return;

        let status = '';
        let indicatorClass = '';

        // Check if it's weekend (Sunday = 0)
        if (currentDay === 0) {
            status = 'Tutup - Hari Minggu';
            indicatorClass = 'bg-red-500';
        }
        // Check if it's Saturday
        else if (currentDay === 6) {
            if (currentHour >= 8 && currentHour < 12) {
                status = 'Buka - Sabtu (hingga 12:00)';
                indicatorClass = 'bg-green-500';
            } else if (currentHour >= 12) {
                status = 'Tutup - Sabtu (buka sampai 12:00)';
                indicatorClass = 'bg-red-500';
            } else {
                status = 'Tutup - Belum Buka (buka 08:00)';
                indicatorClass = 'bg-yellow-500';
            }
        }
        // Weekdays (Monday-Friday)
        else if (currentDay >= 1 && currentDay <= 5) {
            if (currentHour >= 8 && currentHour < 16) {
                if (currentHour >= 12 && currentHour < 13) {
                    status = 'Istirahat - Kembali 13:00';
                    indicatorClass = 'bg-yellow-500';
                } else {
                    status = 'Buka - Siap Melayani';
                    indicatorClass = 'bg-green-500';
                }
            } else if (currentHour >= 16) {
                status = 'Tutup - Buka Besok 08:00';
                indicatorClass = 'bg-red-500';
            } else {
                const hoursUntilOpen = 8 - currentHour;
                status = `Tutup - Buka ${hoursUntilOpen}h lagi`;
                indicatorClass = 'bg-yellow-500';
            }
        }

        // Apply status
        statusText.textContent = status;
        statusIndicator.className = `w-3 h-3 rounded-full ${indicatorClass} office-status-indicator`;

        // Add animation for live updates
        statusIndicator.style.animation = 'pulse 2s infinite';
    }

    // Update office status immediately and every minute
    updateOfficeStatus();
    setInterval(updateOfficeStatus, 60000); // Update every minute
});
