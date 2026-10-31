<?php
// Tangkap semua error
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno)) { return false; } error_log("PHP Error [$errno]: $errstr in $errfile on line $errline");
    return true;
});

register_shutdown_function(function() {
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR])) {
        error_log("Fatal Error: " . $error["message"] . " in " . $error["file"] . " on line " . $error["line"]);
    }
});

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

// Polyfill untuk PHP Wasmer yang tidak punya mb_split
if (!function_exists('mb_split')) {
    function mb_split($pattern, $string, $limit = -1) {
        $result = preg_split('/' . str_replace('/', '\/', $pattern) . '/u', $string, $limit);
        return $result === false ? [$string] : $result;
    }
}

$uri = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($uri, PHP_URL_PATH);

// Batas ukuran kiriman: PHP mengosongkan $_POST bila melebihi post_max_size
$ke_byte = function ($v) {
    $v = trim((string) $v);
    $n = (int) $v;
    switch (strtolower(substr($v, -1))) {
        case 'g': $n *= 1024;
        case 'm': $n *= 1024;
        case 'k': $n *= 1024;
    }
    return $n;
};
$batas = $ke_byte(ini_get('post_max_size'));
if (($_SERVER['REQUEST_METHOD'] ?? '') === 'POST' && $batas > 0
    && (int) ($_SERVER['CONTENT_LENGTH'] ?? 0) > $batas) {
    http_response_code(413);
    header('Content-Type: text/html; charset=UTF-8');
    echo '<!DOCTYPE html><html lang="id"><meta charset="UTF-8"><meta name="viewport" content="width=device-width, initial-scale=1">'
       . '<title>Foto terlalu besar</title>'
       . '<body style="font-family:system-ui,sans-serif;max-width:480px;margin:15vh auto;padding:0 20px;text-align:center">'
       . '<h1 style="font-size:1.4rem">Ukuran foto terlalu besar</h1>'
       . '<p>Total foto yang dikirim melebihi batas. Gunakan maksimal 3 foto dan 2 MB per foto, lalu coba lagi.</p>'
       . '<p><a href="/buat-laporan">Kembali ke formulir</a></p></body></html>';
    exit;
}


$file = __DIR__ . $path;

// Serve static files
if ($path !== '/' && is_file($file)) {
    return false;
}

// Bootstrap Laravel dengan try/catch
try {
    define('LARAVEL_START', microtime(true));

    if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
        require $maintenance;
    }

    require __DIR__.'/../vendor/autoload.php';

    $app = require_once __DIR__.'/../bootstrap/app.php';

    $request = Illuminate\Http\Request::capture();
    $response = $app->handle($request);
    $response->send();
    $app->terminate($request, $response);

} catch (\Throwable $e) {
    error_log("Exception " . get_class($e) . ": " . $e->getMessage() . " in " . $e->getFile() . " line " . $e->getLine());
    http_response_code(500);
    echo "<h1>Terjadi kesalahan</h1><p>Silakan coba lagi beberapa saat.</p>";
}
