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
if (preg_match('#^/how-to-order/?$#', $path)) {
    header('Location: /', true, 301); // the old How to order section
    exit;
}
if (preg_match('#^/about(/.*)?$#', $path)) {
    header('Location: /institution/', true, 301); // About became The Institution
    exit;
}
if (preg_match('#^/gallery(/.*)?$#', $path)) {
    header('Location: /works/', true, 301); // the Gallery became The Works
    exit;
}
// Folder pages without the trailing slash: /contact -> /contact/ (Apache does this itself)
if (preg_match('#^/(business-cards|checkout|institution|works|people|archive|journal|commissions|contact|shipping-and-returns|privacy|terms|home-2)$#', $path, $m)) {
    header('Location: /' . $m[1] . '/', true, 301);
    exit;
}
return false; // everything else: serve the file or folder index as usual
