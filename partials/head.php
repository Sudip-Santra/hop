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
<link rel="icon" href="<?= $base ?>assets/favicon.svg" type="image/svg+xml">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Instrument+Serif:ital@0;1&family=Inter+Tight:wght@400;500;600&family=JetBrains+Mono:wght@400;500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="<?= $base ?>assets/css/index.css">
</head>
<body id="top" class="page-<?= e($page) ?>" data-whatsapp="<?= WHATSAPP ?>">

<?php include __DIR__ . '/icons.php'; ?>
<?php include __DIR__ . '/header.php'; ?>
