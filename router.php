<?php
// Local dev only: `php -S localhost:8000 router.php`
// Mirrors the .htaccess rules, which PHP's built-in server ignores.

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if (str_starts_with($path, '/partials/')) {
    http_response_code(403);
    exit('Forbidden');
}
if (preg_match('#^/products(/.*)?$#', $path)) {
    header('Location: /business-cards/', true, 301); // the old catalogue
    exit;
}
if (preg_match('#^/(how-to-order)/$#', $path, $m)) {
    header('Location: /' . $m[1], true, 301);
    exit;
}
if (preg_match('#^/(how-to-order)$#', $path)) {
    require __DIR__ . '/index.php';
    return true;
}
// Folder pages without the trailing slash: /contact -> /contact/ (Apache does this itself)
if (preg_match('#^/(business-cards|checkout|about|contact|gallery)$#', $path, $m)) {
    header('Location: /' . $m[1] . '/', true, 301);
    exit;
}
return false; // everything else: serve the file or folder index as usual
