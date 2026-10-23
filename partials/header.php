<?php
// Announcement bar + sticky header (+ mobile menu). The link for $page gets aria-current.
$nav = [
    'products' => ['Products', $base . 'products/'],
    'about'    => ['About', $base . 'about/'],
    'clients'  => ['Who we supply', $base . 'who-we-supply'],
    'process'  => ['How to order', $base . 'how-to-order'],
    'contact'  => ['Contact', $base . 'contact/'],
];
$waHello = 'https://wa.me/' . WHATSAPP . '?text=' . rawurlencode("Hi K K Marketing, I'd like to know more about your products.");
?>
<div class="bar">
  <div class="wrap">
    <span class="label">Disposable plates, bowls &amp; cups — Margao, Goa</span>
    <span class="label hide-sm">Supplying since 2015 · Bulk orders welcome</span>
  </div>
</div>

<header>
  <nav class="wrap grid">
    <a href="/" class="logo" aria-label="House of Press — home"><img class="logo-svg" src="<?= $base ?>assets/logo.svg" alt="House of Press"></a>
    <div class="links">
<?php foreach ($nav as $key => [$label, $href]): ?>
      <a href="<?= $href ?>"<?= $key === $page ? ' aria-current="page"' : '' ?>><?= $label ?></a>
<?php endforeach; ?>
    </div>
    <div class="nav-cta">
      <a href="tel:<?= PHONE_TEL ?>" class="btn line">Call</a>
      <a href="<?= $base ?>contact/" class="btn">Get a rate <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right"/></svg></a>
      <button type="button" class="nav-toggle" id="nav-toggle" aria-label="Open menu" aria-expanded="false" aria-controls="m-menu">
        <svg class="i i-open" aria-hidden="true"><use href="#i-menu"/></svg>
        <svg class="i i-close" aria-hidden="true"><use href="#i-x"/></svg>
      </button>
    </div>
  </nav>
</header>

<!-- Mobile menu (1080px and below); outside <header> so its blur doesn't trap the fixed panel -->
<div class="m-menu" id="m-menu" hidden>
  <div class="wrap">
    <ol class="m-links">
      <li><a href="/"<?= $page === 'home' ? ' aria-current="page"' : '' ?>><span class="label">01</span>Home<svg class="i" aria-hidden="true"><use href="#i-arrow-right"/></svg></a></li>
<?php $n = 1; foreach ($nav as $key => [$label, $href]): $n++; ?>
      <li><a href="<?= $href ?>"<?= $key === $page ? ' aria-current="page"' : '' ?>><span class="label"><?= sprintf('%02d', $n) ?></span><?= $label ?><svg class="i" aria-hidden="true"><use href="#i-arrow-right"/></svg></a></li>
<?php endforeach; ?>
    </ol>
    <div class="m-cta">
      <a href="<?= $base ?>contact/" class="btn">Get a rate <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right"/></svg></a>
      <a href="<?= e($waHello) ?>" class="btn wa-btn" target="_blank" rel="noopener"><svg class="i wa-i" aria-hidden="true"><use href="#i-whatsapp"/></svg>WhatsApp</a>
      <a href="tel:<?= PHONE_TEL ?>" class="btn line">Call <?= PHONE_DISPLAY ?></a>
    </div>
    <p class="m-addr"><span class="label">Visit</span>Shop No. 3, Seagull Apartment, Pajifond, Margao, Goa 403601</p>
  </div>
</div>
