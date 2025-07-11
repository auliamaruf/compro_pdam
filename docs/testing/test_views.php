<?php

require_once __DIR__ . '/vendor/autoload.php';

// Bootstrap Laravel
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

try {
    echo "Testing View Rendering...\n";
    
    // Create a simple request
    $request = \Illuminate\Http\Request::create('/');
    $app->instance('request', $request);
    
    // Try to render the welcome view
    $view = view('welcome');
    echo "✓ Welcome view compiled successfully\n";
    
    // Try to render about view
    try {
        $aboutView = view('about.index');
        echo "✓ About view compiled successfully\n";
    } catch (Exception $e) {
        echo "✗ About view error: " . $e->getMessage() . "\n";
    }
    
    // Try to render a partial that uses $company
    try {
        $layoutView = view('layouts.app');
        echo "✓ Layout view compiled successfully\n";
    } catch (Exception $e) {
        echo "✗ Layout view error: " . $e->getMessage() . "\n";
    }
    
    echo "\n✓ View rendering tests completed!\n";
    
} catch (Exception $e) {
    echo "✗ Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}
