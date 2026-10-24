<?php
/**
 * Static build for hosts that can't run PHP (Netlify): renders every page to dist/ as plain HTML.
 *
 *   php build.php
 *
 * Section URLs come from the pages themselves: each data-route="slug" found on a page
 * becomes its own file, e.g. /how-to-order -> dist/how-to-order.html
 * (Netlify serves /how-to-order from that file).
 */

// Child mode: render one page as if it were requested at $argv[2]
if (($argv[1] ?? '') === '--render') {
    $_SERVER['REQUEST_URI'] = $argv[2];
    chdir(dirname(__DIR__ . '/' . $argv[3]));
    include __DIR__ . '/' . $argv[3];
    exit;
}

$root = __DIR__;
$out  = $root . '/dist';

// Each page: URL, PHP source, output file
$pages = [
    ['/',         'index.php',          'index.html'],
    ['/business-cards/', 'business-cards/index.php', 'business-cards/index.html'],
    ['/checkout/',  'checkout/index.php',  'checkout/index.html'],
    ['/about/',    'about/index.php',    'about/index.html'],
    ['/contact/',  'contact/index.php',  'contact/index.html'],
    ['/gallery/',  'gallery/index.php',  'gallery/index.html'],
    ['/shipping-and-returns/', 'shipping-and-returns/index.php', 'shipping-and-returns/index.html'],
    ['/privacy/',  'privacy/index.php',  'privacy/index.html'],
    ['/terms/',    'terms/index.php',    'terms/index.html'],
];

function render(string $url, string $src): string
{
    $cmd = escapeshellarg(PHP_BINARY) . ' ' . escapeshellarg(__FILE__) . ' --render '
         . escapeshellarg($url) . ' ' . escapeshellarg($src);
    exec($cmd, $lines, $code);
    if ($code !== 0) {
        fwrite(STDERR, "Failed to render $url ($src)\n");
        exit(1);
    }
    return implode("\n", $lines) . "\n";
}

function write(string $file, string $html): void
{
    @mkdir(dirname($file), 0777, true);
    file_put_contents($file, $html);
    echo '  ' . str_replace(__DIR__ . '/', '', $file) . "\n";
}

function copy_dir(string $from, string $to): void
{
    @mkdir($to, 0777, true);
    foreach (scandir($from) as $f) {
        if ($f === '.' || $f === '..') continue;
        is_dir("$from/$f") ? copy_dir("$from/$f", "$to/$f") : copy("$from/$f", "$to/$f");
    }
}

function remove_dir(string $dir): void
{
    if (!is_dir($dir)) return;
    foreach (scandir($dir) as $f) {
        if ($f === '.' || $f === '..') continue;
        is_dir("$dir/$f") ? remove_dir("$dir/$f") : unlink("$dir/$f");
    }
    rmdir($dir);
}

echo "Building dist/\n";
remove_dir($out);

foreach ($pages as [$url, $src, $file]) {
    $html = render($url, $src);
    write("$out/$file", $html);

    // One file per section URL on this page
    preg_match_all('/data-route="([a-z0-9-]+)"/', $html, $m);
    $dir = rtrim(dirname($file), '.');
    foreach (array_unique($m[1]) as $slug) {
        write("$out/" . ($dir ? "$dir/" : '') . "$slug.html", render(rtrim($url, '/') . "/$slug", $src));
    }
}

copy_dir("$root/assets", "$out/assets");
echo "Done.\n";
