@php
    use App\Models\CompanySetting;
    $company = CompanySetting::current();
@endphp

<!-- Simple Floating Action Button -->
<div id="simple-fab" style="position: fixed; bottom: 30px; right: 30px; z-index: 99999;">
    <!-- Main Button -->
    <button id="fab-btn" 
            onclick="toggleFAB()"
            style="width: 60px; height: 60px; background: linear-gradient(135deg, #059669, #10b981); border: none; border-radius: 50%; cursor: pointer; box-shadow: 0 4px 20px rgba(5, 150, 105, 0.3); transition: all 0.3s ease; display: flex; align-items: center; justify-content: center; color: white; font-size: 24px;">
        <i class="fas fa-plus" id="fab-icon" style="transition: transform 0.3s ease;"></i>
    </button>
    
    <!-- Menu -->
    <div id="fab-menu" style="position: absolute; bottom: 75px; right: 0; opacity: 0; visibility: hidden; transform: translateY(20px); transition: all 0.3s ease;">
        <!-- WhatsApp -->
        <div style="margin-bottom: 15px;">
            @if($company && $company->whatsapp_cs)
            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $company->whatsapp_cs) }}?text=Halo,%20saya%20ingin%20bertanya%20tentang%20layanan%20PDAM" 
               target="_blank" 
               style="width: 50px; height: 50px; background: #25d366; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; box-shadow: 0 3px 15px rgba(0,0,0,0.15); color: white; font-size: 20px;"
               title="Chat WhatsApp">
                <i class="fab fa-whatsapp"></i>
            </a>
            @else
            <a href="https://wa.me/6281234567890?text=Halo,%20saya%20ingin%20bertanya%20tentang%20layanan%20PDAM" 
               target="_blank" 
               style="width: 50px; height: 50px; background: #25d366; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; box-shadow: 0 3px 15px rgba(0,0,0,0.15); color: white; font-size: 20px;"
               title="Chat WhatsApp">
                <i class="fab fa-whatsapp"></i>
            </a>
            @endif
        </div>
        
        <!-- Cek Tagihan -->
        <div style="margin-bottom: 15px;">
            <a href="https://tagihan.pdampurbalingga.co.id/" 
               target="_blank" 
               style="width: 50px; height: 50px; background: #3b82f6; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; box-shadow: 0 3px 15px rgba(0,0,0,0.15); color: white; font-size: 20px;"
               title="Cek Tagihan">
                <i class="fas fa-file-invoice-dollar"></i>
            </a>
        </div>
        
        <!-- Pengaduan -->
        <div style="margin-bottom: 15px;">
            <a href="https://pengaduan.pdampurbalingga.co.id/" 
               target="_blank" 
               style="width: 50px; height: 50px; background: #f59e0b; border-radius: 50%; display: flex; align-items: center; justify-content: center; text-decoration: none; box-shadow: 0 3px 15px rgba(0,0,0,0.15); color: white; font-size: 20px;"
               title="Pengaduan">
                <i class="fas fa-exclamation-circle"></i>
            </a>
        </div>
    </div>
</div>

<script>
let fabMenuOpen = false;

function toggleFAB() {
    console.log('toggleFAB called, current state:', fabMenuOpen);
    
    const fabBtn = document.getElementById('fab-btn');
    const fabMenu = document.getElementById('fab-menu');
    const fabIcon = document.getElementById('fab-icon');
    
    fabMenuOpen = !fabMenuOpen;
    
    if (fabMenuOpen) {
        console.log('Opening FAB menu');
        // Open menu
        fabBtn.style.background = 'linear-gradient(135deg, #dc2626, #ef4444)';
        fabIcon.style.transform = 'rotate(45deg)';
        fabMenu.style.opacity = '1';
        fabMenu.style.visibility = 'visible';
        fabMenu.style.transform = 'translateY(0)';
    } else {
        console.log('Closing FAB menu');
        // Close menu
        fabBtn.style.background = 'linear-gradient(135deg, #059669, #10b981)';
        fabIcon.style.transform = 'rotate(0deg)';
        fabMenu.style.opacity = '0';
        fabMenu.style.visibility = 'hidden';
        fabMenu.style.transform = 'translateY(20px)';
    }
}

// Close menu when clicking outside
document.addEventListener('click', function(e) {
    const simpleFab = document.getElementById('simple-fab');
    if (fabMenuOpen && !simpleFab.contains(e.target)) {
        console.log('Clicked outside, closing menu');
        toggleFAB();
    }
});

// Close menu when pressing escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && fabMenuOpen) {
        console.log('Escape pressed, closing menu');
        toggleFAB();
    }
});

console.log('Simple FAB script loaded');
</script>

<style>
@media (max-width: 768px) {
    #simple-fab {
        bottom: 20px !important;
        right: 20px !important;
    }
    
    #fab-btn {
        width: 56px !important;
        height: 56px !important;
        font-size: 20px !important;
    }
    
    #fab-menu a {
        width: 48px !important;
        height: 48px !important;
        font-size: 18px !important;
    }
}

#fab-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 30px rgba(5, 150, 105, 0.4);
}

#fab-menu a:hover {
    transform: translateY(-2px) scale(1.05);
}
</style>