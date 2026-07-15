<?php

$file = 'resources/views/home.blade.php';
$content = file_get_contents($file);

$newModalHTML = <<<HTML
            <div class="px-4 py-5 sm:p-6 max-h-[60vh] overflow-y-auto text-gray-700 dark:text-gray-300 prose dark:prose-invert max-w-none">
                <div id="detail-modal-image-container" class="mb-4 hidden">
                    <img id="detail-modal-image" src="" alt="Info Poster" class="w-full rounded-lg object-contain max-h-64">
                </div>
                
                <div id="detail-modal-category-badge" class="mb-2 hidden">
                    <span id="detail-modal-category-text" class="text-xs font-bold px-2 py-1 rounded text-white bg-blue-600"></span>
                </div>
                
                <div id="detail-modal-meta-container" class="bg-gray-50 dark:bg-gray-800 rounded-lg p-3 sm:p-4 mb-4 hidden border border-gray-100 dark:border-gray-700">
                    <!-- Repair / Maintenance Info -->
                    <div id="detail-modal-repair-info" class="hidden text-sm">
                        <div class="flex items-start mb-2">
                            <span class="mr-2">🕒</span>
                            <div>
                                <span class="font-bold block text-gray-900 dark:text-white">Waktu Pengerjaan:</span>
                                <span id="detail-modal-repair-time" class="text-gray-600 dark:text-gray-400"></span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Promo Info -->
                    <div id="detail-modal-promo-info" class="hidden text-sm">
                        <div class="flex items-start mb-2">
                            <span class="mr-2">🎉</span>
                            <div>
                                <span class="font-bold block text-gray-900 dark:text-white">Masa Berlaku Promo:</span>
                                <span id="detail-modal-promo-time" class="text-gray-600 dark:text-gray-400"></span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Affected Areas -->
                    <div id="detail-modal-affected-areas" class="hidden text-sm mt-3 pt-3 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-start">
                            <span class="mr-2">📍</span>
                            <div>
                                <span class="font-bold block text-gray-900 dark:text-white">Wilayah Terdampak:</span>
                                <span id="detail-modal-affected-areas-text" class="text-gray-600 dark:text-gray-400 whitespace-pre-line"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="detail-modal-content"></div>
            </div>
HTML;

// Replace the old detail-modal-content div with the new complex one
$content = preg_replace(
    '/<div class="px-4 py-5 sm:p-6 max-h-\[60vh\] overflow-y-auto text-gray-700 dark:text-gray-300 prose dark:prose-invert max-w-none" id="detail-modal-content">\s*<\/div>/',
    $newModalHTML,
    $content
);

$newJS = <<<JS
    function openCustomerInfoDetailModal(base64Payload) {
        let data = {};
        try {
            data = JSON.parse(decodeURIComponent(escape(atob(base64Payload))));
        } catch(e) {
            data = JSON.parse(atob(base64Payload));
        }

        document.getElementById('detail-modal-title').textContent = data.title;
        document.getElementById('detail-modal-date').textContent = data.date;
        document.getElementById('detail-modal-content').innerHTML = data.description;
        
        // Image
        const imgContainer = document.getElementById('detail-modal-image-container');
        const imgEl = document.getElementById('detail-modal-image');
        if (data.image_url) {
            imgEl.src = data.image_url;
            imgContainer.classList.remove('hidden');
        } else {
            imgContainer.classList.add('hidden');
            imgEl.src = '';
        }
        
        // Category Badge
        const catBadge = document.getElementById('detail-modal-category-badge');
        const catText = document.getElementById('detail-modal-category-text');
        
        let metaHasContent = false;
        const metaContainer = document.getElementById('detail-modal-meta-container');
        
        const repairInfo = document.getElementById('detail-modal-repair-info');
        const repairTime = document.getElementById('detail-modal-repair-time');
        
        const promoInfo = document.getElementById('detail-modal-promo-info');
        const promoTime = document.getElementById('detail-modal-promo-time');
        
        const affectedAreas = document.getElementById('detail-modal-affected-areas');
        const affectedAreasText = document.getElementById('detail-modal-affected-areas-text');
        
        // Hide all first
        repairInfo.classList.add('hidden');
        promoInfo.classList.add('hidden');
        affectedAreas.classList.add('hidden');
        metaContainer.classList.add('hidden');
        
        if (data.category === 'perbaikan' || data.category === 'gangguan') {
            catBadge.classList.remove('hidden');
            catText.textContent = data.category === 'gangguan' ? 'Gangguan' : 'Perbaikan';
            catText.className = data.category === 'gangguan' ? 'text-xs font-bold px-2 py-1 rounded text-white bg-red-600' : 'text-xs font-bold px-2 py-1 rounded text-white bg-orange-500';
            
            if (data.repair_start || data.repair_end) {
                repairInfo.classList.remove('hidden');
                repairTime.textContent = (data.repair_start || '?') + ' s/d ' + (data.repair_end || '?');
                metaHasContent = true;
            }
        } else if (data.category === 'promo') {
            catBadge.classList.remove('hidden');
            catText.textContent = 'Promo';
            catText.className = 'text-xs font-bold px-2 py-1 rounded text-white bg-green-600';
            
            if (data.promo_start || data.promo_end) {
                promoInfo.classList.remove('hidden');
                promoTime.textContent = (data.promo_start || '?') + ' s/d ' + (data.promo_end || '?');
                metaHasContent = true;
            }
        } else {
            catBadge.classList.add('hidden');
        }
        
        if (data.affected_areas) {
            affectedAreas.classList.remove('hidden');
            affectedAreasText.textContent = data.affected_areas;
            metaHasContent = true;
        }
        
        if (metaHasContent) {
            metaContainer.classList.remove('hidden');
        }
        
        document.getElementById('customerInfoDetailModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
JS;

// Replace the old JS function
$content = preg_replace(
    '/function openCustomerInfoDetailModal\(title, date, contentBase64\) \{.*?document\.body\.style\.overflow = \'hidden\';\n    \}/s',
    $newJS,
    $content
);

file_put_contents($file, $content);
echo "Blade updated part 2.\n";
