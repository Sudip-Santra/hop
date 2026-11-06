<?php
// Sticky header (+ mobile menu). The link for $page gets aria-current.
// The institution leads; Visit / Enquire and the Shop sit on the right, available but quiet.
$nav = [
  'institution' => ['The Institution', $base . 'institution/'],
  'works'       => ['The Works', $base . 'works/'],
  'people'      => ['The People', $base . 'people/'],
  'archive'     => ['The Archive', $base . 'archive/'],
  'journal'     => ['The Journal', $base . 'journal/'],
];
$current = fn(string $key): string => $key === $page ? ' aria-current="page"' : '';
$waHello = 'https://wa.me/' . WHATSAPP . '?text=' . rawurlencode("Hi House of Press, I'd like to know more.");
?>
<header>
  <nav class="wrap grid">
    <a href="/" class="logo" aria-label="House of Press - home"><img class="logo-svg" src="<?= $base ?>assets/logo.svg" alt="House of Press"></a>
    <div class="links">
      <?php foreach ($nav as $key => [$label, $href]): ?>
        <a href="<?= $href ?>" <?= $current($key) ?>><?= $label ?></a>
      <?php endforeach; ?>
    </div>
    <div class="nav-cta">
      <a href="<?= $base ?>contact/" class="btn line nav-visit" <?= $current('contact') ?>>Visit / Enquire</a>
      <a href="<?= $base ?>business-cards/" class="btn" <?= $current('business-cards') ?>>Shop</a>
      <button type="button" class="nav-toggle" id="nav-toggle" aria-label="Open menu" aria-expanded="false" aria-controls="m-menu">
        <svg class="i i-open" aria-hidden="true">
          <use href="#i-menu" />
        </svg>
        <svg class="i i-close" aria-hidden="true">
          <use href="#i-x" />
        </svg>
      </button>
    </div>
  </nav>
</header>

<!-- Mobile menu (1080px and below); outside <header> so its blur doesn't trap the fixed panel -->
<div class="m-menu" id="m-menu" hidden>
  <div class="wrap">
    <ol class="m-links">
      <li><a href="/" <?= $current('home') ?>><span class="label">01</span>Home<svg class="i" aria-hidden="true">
            <use href="#i-arrow-right" />
          </svg></a></li>
      <?php $n = 1;
      foreach ($nav as $key => [$label, $href]): $n++; ?>
        <li><a href="<?= $href ?>" <?= $current($key) ?>><span class="label"><?= sprintf('%02d', $n) ?></span><?= $label ?><svg class="i" aria-hidden="true">
              <use href="#i-arrow-right" />
            </svg></a></li>
      <?php endforeach; ?>
    </ol>
    <div class="m-cta">
      <a href="<?= $base ?>business-cards/" class="btn">Shop <svg class="i arr" aria-hidden="true">
          <use href="#i-arrow-right" />
        </svg></a>
      <a href="<?= $base ?>contact/" class="btn line">Visit / Enquire</a>
      <a href="<?= e($waHello) ?>" class="btn wa-btn" target="_blank" rel="noopener"><svg class="i wa-i" aria-hidden="true">
          <use href="#i-whatsapp" />
        </svg>WhatsApp</a>
    </div>
  </div>
</div>
