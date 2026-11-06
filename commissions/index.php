<?php
$page        = 'commissions';
$base        = '../';
$title       = 'Commissions & Collaborations - House of Press, Mumbai';
$description = 'Commission House of Press: bespoke stationery, printed matter, special editions, artistic collaborations and commissioned works, made with respect for design and craftsmanship.';
require_once __DIR__ . '/../partials/config.php';
include __DIR__ . '/../partials/head.php';

$head = [
  'slug'  => 'Commissions & Collaborations',
  'title' => ['For work that deserves', 'to be made differently.'],
  'lead'  => 'We work with designers, artists, institutions, brands and individuals to bring considered ideas into physical form.',
  'text'  => ['From bespoke stationery and printed matter to special editions, artistic collaborations and commissioned works, we approach every project with the same respect for design and craftsmanship.'],
  'photo' => ['hero-poster.jpg', 'Letterpress cards laid out together, pressed in orange, black and green inks', 'one of a kind, on purpose'],
];
// What we take on
$kinds = ['Bespoke stationery', 'Printed matter', 'Special editions', 'Artistic collaborations', 'Commissioned works'];
$waCommission = 'https://wa.me/' . WHATSAPP . '?text=' . rawurlencode("Hi House of Press, I'd like to discuss a commission.");
?>

<main>
  <?php include __DIR__ . '/../partials/page-head.php'; ?>

  <section class="ip-ledger-sec">
    <div class="wrap ip-ledger-in">
      <div class="ip-sec-head">
        <h2>What we <em>take on.</em></h2>
      </div>
      <ol class="ip-ledger">
        <?php foreach ($kinds as $n => $item): ?>
          <li><span class="num"><?= sprintf('%02d', $n + 1) ?></span><?= e($item) ?></li>
        <?php endforeach; ?>
      </ol>
    </div>
  </section>

  <!-- The invitation, pressed into a card like the one on the home page -->
  <section class="px-end">
    <div class="wrap">
      <div class="px-card">
        <div class="px-card-face">
          <p class="px-ink px-card-brand">House of Press</p>
          <div>
            <h2 class="px-card-title"><span class="px-ink">Work worth</span> <span class="px-ink px-red">keeping.</span></h2>
            <span class="px-card-rule" aria-hidden="true"></span>
            <p class="px-ink px-card-text">We believe in conversations that challenge possibilities and result in work worth keeping.</p>
          </div>
          <p class="px-card-foot"><a class="px-ink num" href="tel:<?= PHONE_TEL ?>"><?= PHONE_DISPLAY ?></a><a class="px-ink" href="mailto:<?= EMAIL ?>"><?= EMAIL ?></a></p>
        </div>
      </div>
      <div class="px-actions px-end-actions">
        <a href="<?= e($waCommission) ?>" class="btn red" target="_blank" rel="noopener">Discuss a commission <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right" /></svg></a>
        <a href="../contact/" class="btn line">Visit / Enquire</a>
      </div>
    </div>
  </section>

  <?php $next = ['The Shop', 'business-cards/'];
  include __DIR__ . '/../partials/page-next.php'; ?>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
