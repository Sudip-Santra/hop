<?php
// Footer, cart and scripts. Optional: $scripts = ['gallery.js'] for page-specific JS,
// $noFooter = true to leave out the footer itself (checkout).

$footerNav = [
  'Shop' => [
    ['Business cards', 'business-cards/'],
    ['How to order',   'how-to-order'],
    ['Checkout',       'checkout/'],
  ],
  'Studio' => [
    ['About',   'about/'],
    ['Gallery', 'gallery/'],
    ['Contact', 'contact/'],
  ],
];
$instagramUrl = 'https://instagram.com/' . INSTAGRAM;
?>
<?php if (empty($noFooter)): ?>
<footer class="footer">
  <div class="wrap footer__top">
    <div class="footer__intro">
      <p class="footer__lead">We’re so glad you appreciate tactile, analog craftsmanship.</p>
      <p class="footer__about">A small letterpress studio pressing business cards into thick cotton paper, one sheet at a time. Every order gets a proof on WhatsApp before anything touches the press.</p>
      <ul class="footer__social" aria-label="Talk to us">
        <li><a href="https://wa.me/<?= WHATSAPP ?>" aria-label="WhatsApp" title="WhatsApp"><svg class="i" aria-hidden="true"><use href="#i-whatsapp"/></svg></a></li>
        <li><a href="<?= $instagramUrl ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram @<?= INSTAGRAM ?>" title="Instagram @<?= INSTAGRAM ?>"><svg class="i" aria-hidden="true"><use href="#i-instagram"/></svg></a></li>
        <li><a href="mailto:<?= EMAIL ?>" aria-label="Email <?= EMAIL ?>" title="Email <?= EMAIL ?>"><svg class="i" aria-hidden="true"><use href="#i-mail"/></svg></a></li>
      </ul>
    </div>

    <nav class="footer__nav" aria-label="Footer">
<?php foreach ($footerNav as $title => $links): ?>
      <div>
        <h2 class="footer__title"><?= e($title) ?></h2>
        <ul>
<?php foreach ($links as [$label, $href]): ?>
          <li><a href="<?= $base . e($href) ?>"><?= e($label) ?></a></li>
<?php endforeach; ?>
        </ul>
      </div>
<?php endforeach; ?>
      <div>
        <h2 class="footer__title">Talk to us</h2>
        <ul>
          <li><a href="https://wa.me/<?= WHATSAPP ?>">WhatsApp</a></li>
          <li><a href="<?= $instagramUrl ?>" target="_blank" rel="noopener noreferrer">@<?= INSTAGRAM ?></a></li>
          <li><a href="mailto:<?= EMAIL ?>"><?= EMAIL ?></a></li>
        </ul>
      </div>
    </nav>
  </div>

  <!-- The facts a customer looks for last, ruled like a printed form. -->
  <dl class="wrap footer__facts">
    <div>
      <dt>Studio hours</dt>
      <dd><?= e(HOURS) ?></dd>
    </div>
    <div>
      <dt>Dispatch</dt>
      <dd><?= e(DISPATCH) ?> after your proof</dd>
    </div>
    <div>
      <dt>Delivery</dt>
      <dd>Free across India, with tracking</dd>
    </div>
  </dl>

  <!-- The wordmark, blind pressed into the footer's paper: no ink, only the impression. -->
  <div class="wrap">
    <div class="footer__press" aria-hidden="true">
      <span class="footer__press-light"></span>
      <span class="footer__press-shade"></span>
      <span class="footer__press-face"></span>
    </div>
  </div>

  <div class="wrap footer__base">
    <p>© <?= date('Y') ?> <?= SITE_NAME ?>. Prices include GST and delivery within India.</p>
    <ul class="footer__legal">
      <li><a href="<?= $base ?>shipping-and-returns/">Shipping &amp; returns</a></li>
      <li><a href="<?= $base ?>privacy/">Privacy policy</a></li>
      <li><a href="<?= $base ?>terms/">Terms &amp; conditions</a></li>
    </ul>
  </div>
</footer>
<?php endif; ?>
<?php include __DIR__ . '/cart.php'; ?>
<script src="<?= $base ?>assets/js/main.js"></script>
<script src="<?= $base ?>assets/js/cart.js"></script>
<?php foreach ($scripts ?? [] as $script): ?>
<script src="<?= $base ?>assets/js/<?= $script ?>"></script>
<?php endforeach; ?>
</body>
</html>
