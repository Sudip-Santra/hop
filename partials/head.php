<?php
/**
 * Page start: <head>, <body>, icon sprite and header.
 * Expects: $page (nav key), $base ('' at root, '../' one level down), $title, $description.
 * Optional: $jsonLd, an array of schema.org objects printed as structured data;
 *           $preloadImage, the above-the-fold image to fetch first (the LCP).
 */
require_once __DIR__ . '/config.php';

// This page's own URL: "back to top" links here, and clicking it on this page just scrolls up
$self = '/' . ($page === 'home' ? '' : $page . '/');
?>
<!doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= e($title) ?></title>
<meta name="description" content="<?= e($description) ?>">
<link rel="canonical" href="<?= SITE_URL . $self ?>">
<meta name="robots" content="index, follow">
<meta name="theme-color" content="#f4efe6">
<link rel="icon" href="<?= $base ?>assets/logo.svg" type="image/svg+xml">
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?= SITE_NAME ?>">
<meta property="og:locale" content="en_IN">
<meta property="og:title" content="<?= e($title) ?>">
<meta property="og:description" content="<?= e($description) ?>">
<meta property="og:url" content="<?= SITE_URL . $self ?>">
<meta property="og:image" content="<?= SITE_URL ?>/assets/og-image.png">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta property="og:image:alt" content="<?= SITE_NAME ?> wordmark in red on cream">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= e($title) ?>">
<meta name="twitter:description" content="<?= e($description) ?>">
<meta name="twitter:image" content="<?= SITE_URL ?>/assets/og-image.png">
<link rel="preload" href="<?= $base ?>assets/fonts/megalito-slab.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="<?= $base ?>assets/fonts/sen.woff2" as="font" type="font/woff2" crossorigin>
<link rel="preload" href="<?= $base ?>assets/fonts/jetbrains-mono.woff2" as="font" type="font/woff2" crossorigin>
<?php if (!empty($preloadImage)): ?>
<link rel="preload" href="<?= $base . $preloadImage ?>" as="image" fetchpriority="high">
<?php endif; ?>
<link rel="stylesheet" href="<?= $base ?>assets/css/index.css">
<?php foreach ($jsonLd ?? [] as $ld): ?>
<script type="application/ld+json"><?= json_encode($ld, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) ?></script>
<?php endforeach; ?>
</head>
<body id="top" class="page-<?= e($page) ?>" data-whatsapp="<?= WHATSAPP ?>">

<?php include __DIR__ . '/icons.php'; ?>
<?php include __DIR__ . '/header.php'; ?>
