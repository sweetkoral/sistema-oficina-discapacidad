<?php

// Set Vercel environment flags
$_ENV['VERCEL'] = 'true';
putenv('VERCEL=true');

// Force HTTPS for assets
$_ENV['FORCE_HTTPS'] = 'true';
putenv('FORCE_HTTPS=true');

// Force Logging to stderr
// to avoid Read-only file system error
$_ENV['LOG_CHANNEL'] = 'stderr';
putenv('LOG_CHANNEL=stderr');

// Ensure SQLite database exists in /tmp
$dbPath = '/tmp/database.sqlite';
if (!file_exists($dbPath)) {
    touch($dbPath);
}

// Ensure Storage directories exist in /tmp
$storagePath = '/tmp/storage';
$dirs = [
    $storagePath . '/framework/views',
    $storagePath . '/framework/cache',
    $storagePath . '/framework/sessions',
    $storagePath . '/logs',
    '/tmp/bootstrap/cache', // Add this for bootstrap cache issues
];

foreach ($dirs as $dir) {
    if (!is_dir($dir)) {
        mkdir($dir, 0755, true);
    }
}

// Point bootstrap cache to /tmp as well
putenv('APP_STORAGE=' . $storagePath);
$_ENV['APP_STORAGE'] = $storagePath;
$_ENV['APP_SERVICES_CACHE'] = '/tmp/storage/framework/services.php';
$_ENV['APP_PACKAGES_CACHE'] = '/tmp/storage/framework/packages.php';
$_ENV['APP_CONFIG_CACHE'] = '/tmp/storage/framework/config.php';
$_ENV['APP_ROUTES_CACHE'] = '/tmp/storage/framework/routes.php';

// Check for APP_KEY
if (!getenv('APP_KEY') && !isset($_ENV['APP_KEY'])) {
    die('Error: APP_KEY is not set in Vercel Environment Variables.');
}

// Auto-migrate if we are on Vercel
$_ENV['RUN_MIGRATIONS'] = 'true';
putenv('RUN_MIGRATIONS=true');

// Forward Vercel requests to normal Laravel index.php
try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    echo "<h1>Error Crítico de Laravel en Vercel</h1>";
    echo "<p><strong>Mensaje:</strong> " . $e->getMessage() . "</p>";
    echo "<p><strong>Archivo:</strong> " . $e->getFile() . " (Línea " . $e->getLine() . ")</p>";
    echo "<h3>Sugerencia:</h3>";
    echo "<p>Asegúrate de que <strong>LOG_CHANNEL</strong> sea 'stderr' y <strong>APP_KEY</strong> esté configurada.</p>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
