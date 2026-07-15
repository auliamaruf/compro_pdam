<?php

$file = 'resources/views/home.blade.php';
$content = file_get_contents($file);

// Replace 1: Add PHP block for JSON data generation
// Actually, it's cleaner to define a helper function at the top of the file or just inside the loop.
$helper = <<<'HTML'
@php
if (!function_exists('getCustomerInfoData')) {
    function getCustomerInfoData($info) {
        return base64_encode(json_encode([
            'title' => $info->title,
            'date' => \Carbon\Carbon::parse($info->created_at)->format('d M Y, H:i') . ' WIB',
            'description' => $info->description,
            'category' => $info->category,
            'repair_start' => $info->repair_start ? \Carbon\Carbon::parse($info->repair_start)->format('d M Y, H:i') : null,
            'repair_end' => $info->repair_end ? \Carbon\Carbon::parse($info->repair_end)->format('d M Y, H:i') : null,
            'promo_start' => $info->promo_start ? \Carbon\Carbon::parse($info->promo_start)->format('d M Y') : null,
            'promo_end' => $info->promo_end ? \Carbon\Carbon::parse($info->promo_end)->format('d M Y') : null,
            'affected_areas' => $info->affected_areas,
            'image_url' => $info->getFirstMediaUrl('customer-info-images', 'webp') ?: null,
        ]));
    }
}
@endphp
HTML;

if (strpos($content, 'getCustomerInfoData') === false) {
    $content = str_replace('<!-- Info Pelanggan Ticker -->', "<!-- Info Pelanggan Ticker -->\n" . $helper, $content);
}

// Replace onclick calls
$content = preg_replace(
    "/onclick=\"openCustomerInfoDetailModal\('\{\{ addslashes\(\\\$info->title\) \}\}', '\{\{ \\\Carbon\\\Carbon::parse\(\\\$info->created_at\)->format\('d M Y, H:i'\) \. ' WIB' \}\}', '\{\{ base64_encode\(\\\$info->description\) \}\}'\)\"/",
    "onclick=\"openCustomerInfoDetailModal('{{ getCustomerInfoData(\$info) }}')\"",
    $content
);

$content = preg_replace(
    "/onclick=\"openCustomerInfoDetailModal\('\{\{ addslashes\(\\\$customerInfos->first\(\)->title\) \}\}', '\{\{ \\\Carbon\\\Carbon::parse\(\\\$customerInfos->first\(\)->created_at\)->format\('d M Y, H:i'\) \. ' WIB' \}\}', '\{\{ base64_encode\(\\\$customerInfos->first\(\)->description\) \}\}'\)\"/",
    "onclick=\"openCustomerInfoDetailModal('{{ getCustomerInfoData(\$customerInfos->first()) }}')\"",
    $content
);

file_put_contents($file, $content);
echo "Blade updated part 1.\n";
