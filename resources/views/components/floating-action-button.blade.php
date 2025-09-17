@php
    use App\Models\CompanySetting;
    $company = CompanySetting::current();
@endphp

<!-- Floating Action Button Component -->
<div class="floating-action-button" style="position: fixed; bottom: 30px; right: 30px; z-index: 9999; font-family: 'Inter', sans-serif; pointer-events: auto;">
    <!-- Main FAB Button -->
    <div class="fab-main" id="fabMain" role="button" tabindex="0" aria-label="Menu layanan cepat" aria-expanded="false" aria-haspopup="true" 
         style="width: 60px; height: 60px; background: linear-gradient(135deg, #059669 0%, #10b981 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; box-shadow: 0 4px 20px rgba(5, 150, 105, 0.3); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); user-select: none; border: none; outline: none; pointer-events: auto; position: relative; z-index: 10001;">
        <i class="fas fa-plus" id="fabIcon" aria-hidden="true" style="color: white; font-size: 24px; transition: all 0.3s ease; pointer-events: none;"></i>
    </div>
    
    <!-- FAB Menu Items -->
    <div class="fab-menu" id="fabMenu" style="position: absolute; bottom: 75px; right: 0; opacity: 0; visibility: hidden; transform: translateY(20px) scale(0.8); transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); display: flex; flex-direction: column; align-items: flex-end; gap: 12px; pointer-events: auto; z-index: 10005;">
        <!-- WhatsApp Pelayanan Pelanggan -->
        <div class="fab-item" data-tooltip="Kontak WhatsApp Pelayanan" style="position: relative; display: flex; align-items: center; justify-content: flex-end; opacity: 0; transform: translateX(20px); transition: all 0.3s ease; pointer-events: auto; z-index: 10006;">
            @if($company && $company->whatsapp_cs)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp_cs) }}?text=Halo,%20saya%20ingin%20bertanya%20tentang%20layanan%20PDAM" 
               target="_blank" class="fab-link whatsapp" aria-label="Chat WhatsApp dengan Customer Service" rel="noopener"
               style="width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 3px 15px rgba(0, 0, 0, 0.15); border: none; outline: none; background: linear-gradient(135deg, #25d366 0%, #128c7e 100%); pointer-events: auto; z-index: 10007; position: relative;">
                <i class="fab fa-whatsapp" aria-hidden="true" style="font-size: 20px; color: white; pointer-events: none;"></i>
            </a>
            @else
            <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20bertanya%20tentang%20layanan%20PDAM" 
               target="_blank" class="fab-link whatsapp" aria-label="Chat WhatsApp dengan Customer Service" rel="noopener"
               style="width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 3px 15px rgba(0, 0, 0, 0.15); border: none; outline: none; background: linear-gradient(135deg, #25d366 0%, #128c7e 100%); pointer-events: auto; z-index: 10007; position: relative;">
                <i class="fab fa-whatsapp" aria-hidden="true" style="font-size: 20px; color: white; pointer-events: none;"></i>
            </a>
            @endif
        </div>
        
        <!-- Cek Tagihan -->
        <div class="fab-item" data-tooltip="Cek Tagihan Online" style="position: relative; display: flex; align-items: center; justify-content: flex-end; opacity: 0; transform: translateX(20px); transition: all 0.3s ease; pointer-events: auto; z-index: 10006;">
            <a href="https://tagihan.pdampurbalingga.co.id/" 
               target="_blank" class="fab-link bill" aria-label="Cek tagihan air online" rel="noopener"
               style="width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 3px 15px rgba(0, 0, 0, 0.15); border: none; outline: none; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); pointer-events: auto; z-index: 10007; position: relative;">
                <i class="fas fa-file-invoice-dollar" aria-hidden="true" style="font-size: 20px; color: white; pointer-events: none;"></i>
            </a>
        </div>
        
        <!-- Pengaduan Pelanggan -->
        <div class="fab-item" data-tooltip="Pengaduan Pelanggan" style="position: relative; display: flex; align-items: center; justify-content: flex-end; opacity: 0; transform: translateX(20px); transition: all 0.3s ease; pointer-events: auto; z-index: 10006;">
            <a href="https://pengaduan.pdampurbalingga.co.id/" 
               target="_blank" class="fab-link complaint" aria-label="Buat pengaduan atau keluhan pelanggan" rel="noopener"
               style="width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); box-shadow: 0 3px 15px rgba(0, 0, 0, 0.15); border: none; outline: none; background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); pointer-events: auto; z-index: 10007; position: relative;">
                <i class="fas fa-exclamation-circle" aria-hidden="true" style="font-size: 20px; color: white; pointer-events: none;"></i>
            </a>
        </div>
    </div>
</div>

@push('styles')
<style>
/* Mobile responsive adjustments */
@media (max-width: 768px) {
    .floating-action-button {
        bottom: 20px !important;
        right: 20px !important;
    }
    
    .fab-main {
        width: 56px !important;
        height: 56px !important;
    }
    
    .fab-main i {
        font-size: 20px !important;
    }
    
    .fab-menu {
        bottom: 70px !important;
    }
    
    .fab-link {
        width: 48px !important;
        height: 48px !important;
    }
    
    .fab-link i {
        font-size: 18px !important;
    }
}

/* Hover effects */
.fab-main:hover {
    transform: translateY(-3px) !important;
    box-shadow: 0 8px 30px rgba(5, 150, 105, 0.4) !important;
}

.fab-main:focus {
    box-shadow: 0 0 0 3px rgba(5, 150, 105, 0.3) !important;
}

.fab-main.active {
    background: linear-gradient(135deg, #dc2626 0%, #ef4444 100%) !important;
    transform: rotate(45deg) !important;
    box-shadow: 0 8px 30px rgba(220, 38, 38, 0.4) !important;
}

/* Ensure FAB is always clickable */
.floating-action-button {
    pointer-events: auto !important;
    z-index: 9999 !important;
}

.fab-main {
    pointer-events: auto !important;
    z-index: 10001 !important;
    position: relative !important;
}

.fab-menu {
    pointer-events: auto !important;
    z-index: 10005 !important;
    position: absolute !important;
}

.fab-menu.active {
    opacity: 1 !important;
    visibility: visible !important;
    transform: translateY(0) scale(1) !important;
    z-index: 10005 !important;
}

.fab-menu.active .fab-item {
    opacity: 1 !important;
    transform: translateX(0) !important;
    z-index: 10006 !important;
}

.fab-menu.active .fab-item:nth-child(1) {
    transition-delay: 0.1s !important;
}

.fab-menu.active .fab-item:nth-child(2) {
    transition-delay: 0.15s !important;
}

.fab-menu.active .fab-item:nth-child(3) {
    transition-delay: 0.2s !important;
}

/* Force menu visibility when active */
.floating-action-button .fab-menu.active,
.fab-menu.active {
    opacity: 1 !important;
    visibility: visible !important;
    transform: translateY(0) scale(1) !important;
    z-index: 10005 !important;
    display: flex !important;
    position: absolute !important;
    pointer-events: auto !important;
}

.floating-action-button .fab-menu.active .fab-item,
.fab-menu.active .fab-item {
    opacity: 1 !important;
    visibility: visible !important;
    transform: translateX(0) !important;
    z-index: 10006 !important;
    display: flex !important;
    pointer-events: auto !important;
}

.floating-action-button .fab-link,
.fab-link {
    z-index: 10007 !important;
    position: relative !important;
    pointer-events: auto !important;
    display: flex !important;
}

.fab-link:hover {
    transform: translateY(-2px) scale(1.05) !important;
}

.fab-link.whatsapp:hover {
    box-shadow: 0 8px 25px rgba(37, 211, 102, 0.4) !important;
}

.fab-link.bill:hover {
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4) !important;
}

.fab-link.complaint:hover {
    box-shadow: 0 8px 25px rgba(245, 158, 11, 0.4) !important;
}

/* Tooltip styles */
.fab-item[data-tooltip]:before {
    content: attr(data-tooltip);
    position: absolute;
    right: 60px;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.85);
    color: white;
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 500;
    white-space: nowrap;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    pointer-events: none;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
    z-index: 1001;
}

.fab-item[data-tooltip]:after {
    content: '';
    position: absolute;
    right: 52px;
    top: 50%;
    transform: translateY(-50%);
    border: 6px solid transparent;
    border-left-color: rgba(0, 0, 0, 0.85);
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    z-index: 1001;
}

.fab-item:hover[data-tooltip]:before,
.fab-item:hover[data-tooltip]:after {
    opacity: 1 !important;
    visibility: visible !important;
}

/* Backdrop */
.fab-backdrop {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.05);
    z-index: 9998 !important;
    opacity: 0;
    visibility: hidden;
    transition: all 0.3s ease;
    backdrop-filter: blur(1px);
    pointer-events: auto;
}

.fab-backdrop.active {
    opacity: 1 !important;
    visibility: visible !important;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('FAB Script loading...'); // Debug
    
    const fabMain = document.getElementById('fabMain');
    const fabMenu = document.getElementById('fabMenu');
    const fabIcon = document.getElementById('fabIcon');
    let isMenuOpen = false;

    console.log('FAB Elements:', { fabMain, fabMenu, fabIcon }); // Debug

    // Create backdrop
    const backdrop = document.createElement('div');
    backdrop.className = 'fab-backdrop';
    backdrop.id = 'fabBackdrop';
    backdrop.style.cssText = 'position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.05); z-index: 9998; opacity: 0; visibility: hidden; transition: all 0.3s ease; backdrop-filter: blur(1px); pointer-events: auto;';
    document.body.appendChild(backdrop);

    // Make sure FAB is always on top and clickable
    const fabContainer = document.querySelector('.floating-action-button');
    if (fabContainer) {
        fabContainer.style.zIndex = '9999';
        fabContainer.style.pointerEvents = 'auto';
    }

    // Toggle FAB menu
    function toggleFabMenu() {
        console.log('Toggle FAB menu, current state:', isMenuOpen); // Debug
        isMenuOpen = !isMenuOpen;
        
        if (isMenuOpen) {
            console.log('Opening menu...'); // Debug
            fabMain.classList.add('active');
            fabMenu.classList.add('active');
            backdrop.classList.add('active');
            fabMain.setAttribute('aria-expanded', 'true');
            
            // Force style updates for menu visibility
            fabMenu.style.opacity = '1';
            fabMenu.style.visibility = 'visible';
            fabMenu.style.transform = 'translateY(0) scale(1)';
            fabMenu.style.zIndex = '10005';
            fabMenu.style.position = 'absolute';
            fabMenu.style.pointerEvents = 'auto';
            backdrop.style.opacity = '1';
            backdrop.style.visibility = 'visible';
            
            // Show menu items with staggered delay
            const fabItems = fabMenu.querySelectorAll('.fab-item');
            console.log('Found fab items:', fabItems.length); // Debug
            fabItems.forEach((item, index) => {
                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.visibility = 'visible';
                    item.style.transform = 'translateX(0)';
                    item.style.zIndex = '10006';
                    item.style.pointerEvents = 'auto';
                    console.log(`Item ${index + 1} shown`); // Debug
                }, 100 + (index * 50));
            });
            
        } else {
            console.log('Closing menu...'); // Debug
            fabMain.classList.remove('active');
            fabMenu.classList.remove('active');
            backdrop.classList.remove('active');
            fabMain.setAttribute('aria-expanded', 'false');
            
            // Force style updates for menu hiding
            fabMenu.style.opacity = '0';
            fabMenu.style.visibility = 'hidden';
            fabMenu.style.transform = 'translateY(20px) scale(0.8)';
            backdrop.style.opacity = '0';
            backdrop.style.visibility = 'hidden';
            
            // Hide menu items
            const fabItems = fabMenu.querySelectorAll('.fab-item');
            fabItems.forEach((item) => {
                item.style.opacity = '0';
                item.style.transform = 'translateX(20px)';
            });
        }
    }

    // FAB main button click - multiple event handlers for safety
    fabMain.addEventListener('click', function(e) {
        console.log('FAB main clicked'); // Debug
        e.preventDefault();
        e.stopPropagation();
        toggleFabMenu();
    });

    // Alternative event handler
    fabMain.addEventListener('mousedown', function(e) {
        console.log('FAB main mousedown'); // Debug
    });

    fabMain.addEventListener('touchstart', function(e) {
        console.log('FAB main touchstart'); // Debug
        e.preventDefault();
        e.stopPropagation();
        toggleFabMenu();
    }, { passive: false });
    
    // Keyboard support for main button
    fabMain.addEventListener('keydown', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            toggleFabMenu();
        }
    });

    // Backdrop click to close menu
    backdrop.addEventListener('click', function() {
        console.log('Backdrop clicked'); // Debug
        if (isMenuOpen) {
            toggleFabMenu();
        }
    });

    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        if (isMenuOpen && !fabMain.contains(e.target) && !fabMenu.contains(e.target)) {
            console.log('Click outside, closing menu'); // Debug
            toggleFabMenu();
        }
    });

    // Close menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isMenuOpen) {
            console.log('Escape key pressed, closing menu'); // Debug
            toggleFabMenu();
        }
    });

    // Add click tracking for analytics (optional)
    const fabLinks = document.querySelectorAll('.fab-link');
    console.log('Found FAB links:', fabLinks.length); // Debug
    
    fabLinks.forEach(function(link) {
        link.addEventListener('click', function(e) {
            const action = this.classList.contains('whatsapp') ? 'WhatsApp' :
                          this.classList.contains('bill') ? 'Cek Tagihan' :
                          this.classList.contains('complaint') ? 'Pengaduan' : 'Unknown';
            
            console.log('FAB Action clicked:', action); // Debug
            
            // Close menu after click
            setTimeout(() => {
                if (isMenuOpen) {
                    toggleFabMenu();
                }
            }, 300);
        });
    });

    console.log('FAB Script loaded successfully'); // Debug
});
</script>
@endpush