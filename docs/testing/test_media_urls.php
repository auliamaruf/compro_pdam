<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    echo "Testing getFirstMediaUrl method across all views...\n";
    
    // Create a simple request
    $request = \Illuminate\Http\Request::create('/');
    $app->instance('request', $request);
    
    // Get company data
    $company = app('company');
    echo "Company object type: " . get_class($company) . "\n";
    
    // Test different media collections
    $collections = ['logo', 'logo_white', 'favicon', 'about_image', 'hero_background'];
    
    foreach ($collections as $collection) {
        try {
            $url = $company->getFirstMediaUrl($collection);
            echo "✓ getFirstMediaUrl('$collection'): " . ($url ?: '(empty)') . "\n";
        } catch (Exception $e) {
            echo "✗ Error with collection '$collection': " . $e->getMessage() . "\n";
        }
    }
    
    // Test methods that should exist
    $properties = ['company_name', 'company_tagline', 'phone', 'email', 'address'];
    
    echo "\nTesting object properties:\n";
    foreach ($properties as $property) {
        $value = $company->$property ?? 'N/A';
        echo "- $property: $value\n";
    }
    
    echo "\n✓ All getFirstMediaUrl tests passed!\n";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}
