@php
    use App\Models\CompanySetting;
    $company = CompanySetting::current();
@endphp

<!-- Floating Action Button -->
<div style="position: fixed; bottom: 20px; right: 20px; z-index: 9999;">
    <!-- Main FAB Button (blue theme) -->
    <button id="fabButton" 
            style="width: 50px; height: 50px; border-radius: 50%; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border: none; cursor: pointer; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3); display: flex; align-items: center; justify-content: center; transition: all 0.3s ease; position: relative;">
        <i class="fas fa-headset" style="color: white; font-size: 18px;"></i>
        
        <!-- Tooltip -->
        <div id="fabTooltip" 
             style="position: absolute; right: 60px; top: 50%; transform: translateY(-50%); background: rgba(0, 0, 0, 0.8); color: white; padding: 8px 12px; border-radius: 6px; font-size: 12px; white-space: nowrap; opacity: 0; visibility: hidden; transition: all 0.3s ease; pointer-events: none; z-index: 10001;">
            Hubungi Kami
            <!-- Tooltip arrow -->
            <div style="position: absolute; left: 100%; top: 50%; transform: translateY(-50%); width: 0; height: 0; border: 5px solid transparent; border-left-color: rgba(0, 0, 0, 0.8);"></div>
        </div>
    </button>
</div>

<!-- Popup Modal -->
<div id="fabModal" 
     style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.5); z-index: 10000; backdrop-filter: blur(2px);">
    <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2); max-width: 350px; width: 90%;">
        <!-- Modal Header (blue theme) -->
        <div style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; display: flex; justify-content: space-between; align-items: center; padding: 20px; margin-bottom: 0;">
            <h3 style="margin: 0; font-size: 18px; font-weight: 600;">Layanan Pelanggan</h3>
            <button id="closeModal" style="background: rgba(255, 255, 255, 0.2); border: none; font-size: 16px; cursor: pointer; color: white; padding: 4px; width: 28px; height: 28px; display: flex; align-items: center; justify-content: center; border-radius: 50%; transition: all 0.3s ease;">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <!-- Modal Content -->
        <div style="padding: 20px; display: flex; flex-direction: column; gap: 12px;">
            <!-- WhatsApp -->
            <a href="{{ ($company && $company->whatsapp_cs) ? 'https://wa.me/' . preg_replace('/[^0-9]/', '', $company->whatsapp_cs) . '?text=Halo,%20saya%20ingin%20bertanya%20tentang%20layanan%20PDAM' : 'https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20bertanya%20tentang%20layanan%20PDAM' }}" 
               target="_blank" 
               style="display: flex; align-items: center; padding: 12px 15px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; text-decoration: none; border-radius: 8px; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(59, 130, 246, 0.3);"
               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(59, 130, 246, 0.4)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(59, 130, 246, 0.3)';">
                <div style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                    <i class="fab fa-whatsapp" style="font-size: 18px;"></i>
                </div>
                <div>
                    <div style="font-weight: 600; font-size: 14px;">Kontak WhatsApp</div>
                    <div style="font-size: 12px; opacity: 0.9;">Chat langsung dengan CS kami</div>
                </div>
            </a>

            <!-- Cek Tagihan -->
            <a href="https://tagihan.pdampurbalingga.co.id/" 
               target="_blank" 
               style="display: flex; align-items: center; padding: 12px 15px; background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 100%); color: white; text-decoration: none; border-radius: 8px; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(30, 64, 175, 0.3);"
               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(30, 64, 175, 0.4)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(30, 64, 175, 0.3)';">
                <div style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                    <i class="fas fa-file-invoice-dollar" style="font-size: 16px;"></i>
                </div>
                <div>
                    <div style="font-weight: 600; font-size: 14px;">Cek Tagihan</div>
                    <div style="font-size: 12px; opacity: 0.9;">Cek tagihan air online</div>
                </div>
            </a>

            <!-- Pengaduan -->
            <a href="https://pengaduan.pdampurbalingga.co.id/" 
               target="_blank" 
               style="display: flex; align-items: center; padding: 12px 15px; background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%); color: white; text-decoration: none; border-radius: 8px; transition: all 0.3s ease; box-shadow: 0 2px 8px rgba(30, 58, 138, 0.3);"
               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 4px 15px rgba(30, 58, 138, 0.4)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(30, 58, 138, 0.3)';">
                <div style="width: 40px; height: 40px; background: rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                    <i class="fas fa-exclamation-circle" style="font-size: 16px;"></i>
                </div>
                <div>
                    <div style="font-weight: 600; font-size: 14px;">Buat Pengaduan</div>
                    <div style="font-size: 12px; opacity: 0.9;">Sampaikan keluhan Anda</div>
                </div>
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const fabButton = document.getElementById('fabButton');
    const fabModal = document.getElementById('fabModal');
    const closeModal = document.getElementById('closeModal');

    // Button hover effects with tooltip
    fabButton.addEventListener('mouseenter', function() {
        this.style.transform = 'scale(1.1)';
        this.style.boxShadow = '0 6px 20px rgba(59, 130, 246, 0.4)';
        // Show tooltip
        const tooltip = this.querySelector('.tooltip');
        if (tooltip) {
            tooltip.style.opacity = '1';
            tooltip.style.visibility = 'visible';
        }
    });

    fabButton.addEventListener('mouseleave', function() {
        this.style.transform = 'scale(1)';
        this.style.boxShadow = '0 4px 15px rgba(59, 130, 246, 0.3)';
        // Hide tooltip
        const tooltip = this.querySelector('.tooltip');
        if (tooltip) {
            tooltip.style.opacity = '0';
            tooltip.style.visibility = 'hidden';
        }
    });

    // Open modal
    fabButton.addEventListener('click', function() {
        fabModal.style.display = 'block';
        // Animation
        setTimeout(() => {
            fabModal.style.opacity = '1';
            const modalContent = fabModal.querySelector('div > div');
            modalContent.style.transform = 'translate(-50%, -50%) scale(1)';
        }, 10);
        
        // Initial state for animation
        fabModal.style.opacity = '0';
        const modalContent = fabModal.querySelector('div > div');
        modalContent.style.transform = 'translate(-50%, -50%) scale(0.8)';
        modalContent.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
    });

    // Close modal
    function closeModalFunc() {
        const modalContent = fabModal.querySelector('div > div');
        modalContent.style.transform = 'translate(-50%, -50%) scale(0.8)';
        fabModal.style.opacity = '0';
        
        setTimeout(() => {
            fabModal.style.display = 'none';
        }, 300);
    }

    closeModal.addEventListener('click', closeModalFunc);

    // Add hover effects for close button
    closeModal.addEventListener('mouseenter', function() {
        this.style.background = 'rgba(255, 255, 255, 0.3)';
        this.style.transform = 'scale(1.1)';
    });
    
    closeModal.addEventListener('mouseleave', function() {
        this.style.background = 'rgba(255, 255, 255, 0.2)';
        this.style.transform = 'scale(1)';
    });

    // Close modal when clicking backdrop
    fabModal.addEventListener('click', function(e) {
        if (e.target === fabModal) {
            closeModalFunc();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && fabModal.style.display === 'block') {
            closeModalFunc();
        }
    });

    // Track clicks for analytics
    const modalLinks = fabModal.querySelectorAll('a');
    modalLinks.forEach((link, index) => {
        link.addEventListener('click', function() {
            const services = ['WhatsApp', 'Cek Tagihan', 'Pengaduan'];
            console.log('Layanan dipilih:', services[index]);
            
            // Close modal after a short delay
            setTimeout(() => {
                closeModalFunc();
            }, 500);
        });
    });
});
</script>