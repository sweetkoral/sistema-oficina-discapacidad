<?php

// Set Vercel environment flag
$_ENV['VERCEL'] = 'true';
putenv('VERCEL=true');

// Ensure SQLite database exists in /tmp since Vercel is read-only
$dbPath = '/tmp/database.sqlite';
if (!file_exists($dbPath)) {
    touch($dbPath);
}

// Check for APP_KEY
if (!getenv('APP_KEY') && !isset($_ENV['APP_KEY'])) {
    die('Error: APP_KEY is not set in Vercel Environment Variables.');
}

// Forward Vercel requests to normal Laravel index.php
require __DIR__ . '/../public/index.php';
