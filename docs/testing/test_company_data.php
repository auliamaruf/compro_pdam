<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    // Test retrieving company data
    echo "Testing Company Data Service Provider...\n";
    
    $company = app('company');
    
    if ($company) {
        echo "✓ Company data object created successfully\n";
        echo "Company Name: " . ($company->company_name ?? 'N/A') . "\n";
        echo "Company Tagline: " . ($company->company_tagline ?? 'N/A') . "\n";
        echo "Phone: " . ($company->phone ?? 'N/A') . "\n";
        echo "Email: " . ($company->email ?? 'N/A') . "\n";
        
        // Test getFirstMediaUrl method
        echo "\nTesting getFirstMediaUrl method...\n";
        $logoUrl = $company->getFirstMediaUrl('logo');
        echo "Logo URL: " . $logoUrl . "\n";
        
        echo "\n✓ All tests passed!\n";
    } else {
        echo "✗ Company data object is null\n";
    }
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}
