<?php
/**
 * Page start: <head>, <body>, icon sprite and header.
 * Expects: $page (nav key), $base ('' at root, '../' one level down), $title, $description.
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
<link rel="icon" href="<?= $base ?>assets/logo.svg" type="image/svg+xml">
<meta property="og:type" content="website">
<meta property="og:site_name" content="House of Press">
<meta property="og:title" content="<?= e($title) ?>">
<meta property="og:description" content="<?= e($description) ?>">
<meta property="og:url" content="<?= SITE_URL . $self ?>">
<meta property="og:image" content="<?= SITE_URL ?>/assets/og-image.png">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter+Tight:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= $base ?>assets/css/index.css">
</head>
<body id="top" class="page-<?= e($page) ?>" data-whatsapp="<?= WHATSAPP ?>">

<?php include __DIR__ . '/icons.php'; ?>
<?php include __DIR__ . '/header.php'; ?>
