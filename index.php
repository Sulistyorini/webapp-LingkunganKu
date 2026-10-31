<?php
/**
 * Entry point untuk InfinityFree hosting.
 * File ini ada di htdocs/ dan meneruskan request ke public/index.php
 */
define('LARAVEL_START', microtime(true));

// Tentukan base path project
$basePath = __DIR__;

// Load autoloader
require $basePath . '/vendor/autoload.php';

// Set path ke public folder
$_SERVER['DOCUMENT_ROOT'] = $basePath . '/public';

// Bootstrap Laravel
$app = require_once $basePath . '/bootstrap/app.php';

use Illuminate\Http\Request;
$app->handleRequest(Request::capture());
