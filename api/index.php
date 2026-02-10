<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Set Vercel environment flag
$_ENV['VERCEL'] = 'true';
putenv('VERCEL=true');

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
    die('Error: APP_KEY is not set in Vercel Environment Variables.');
}

// Auto-migrate if we are on Vercel and it's a new DB
if (getenv('VERCEL') === 'true') {
    // We can't easily run artisan here without booting Laravel, 
    // but we can set a flag for a Middleware or a ServiceProvider to handle it.
    $_ENV['RUN_MIGRATIONS'] = 'true';
}

// Forward Vercel requests to normal Laravel index.php
require __DIR__ . '/../public/index.php';
