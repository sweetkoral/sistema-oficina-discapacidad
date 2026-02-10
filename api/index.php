<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set Vercel environment flag
$_ENV['VERCEL'] = 'true';
putenv('VERCEL=true');

// Force Debug mode temporarily to see the real error
$_ENV['APP_DEBUG'] = 'true';
putenv('APP_DEBUG=true');

// Ensure SQLite database exists in /tmp since Vercel is read-only
$dbPath = '/tmp/database.sqlite';
if (!file_exists($dbPath)) {
    touch($dbPath);
}

// Set storage path to /tmp/storage for write access
$storagePath = '/tmp/storage';
if (!is_dir($storagePath)) {
    mkdir($storagePath, 0755, true);
    mkdir($storagePath . '/framework/views', 0755, true);
    mkdir($storagePath . '/framework/cache', 0755, true);
    mkdir($storagePath . '/framework/sessions', 0755, true);
    mkdir($storagePath . '/logs', 0755, true);
}
putenv('APP_STORAGE=' . $storagePath);

// Check for APP_KEY
if (!getenv('APP_KEY') && !isset($_ENV['APP_KEY'])) {
    die('Error: APP_KEY is not set in Vercel Environment Variables. Please add it in project settings.');
}

// Auto-migrate if we are on Vercel and it's a new DB
$_ENV['RUN_MIGRATIONS'] = 'true';

// Forward Vercel requests to normal Laravel index.php with error capturing
try {
    require __DIR__ . '/../public/index.php';
} catch (\Throwable $e) {
    echo "<h1>Error Crítico de Laravel en Vercel</h1>";
    echo "<p><strong>Mensaje:</strong> " . $e->getMessage() . "</p>";
    echo "<p><strong>Archivo:</strong> " . $e->getFile() . " (Línea " . $e->getLine() . ")</p>";
    echo "<h3>Traza:</h3>";
    echo "<pre>" . $e->getTraceAsString() . "</pre>";
}
