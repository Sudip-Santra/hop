<?php
$page        = 'business-cards';
$base        = '../';
$title       = 'Custom Letterpress Business Cards - House of Press';
$description = 'Custom letterpress business cards pressed by hand into thick cotton paper. 100 to 1,000 cards, your artwork or ours, a WhatsApp proof first and free delivery across India.';
$scripts     = ['product.js'];
require_once __DIR__ . '/../partials/config.php';

$v = $base . 'assets/videos/';
// Product photos for search results (structured data): [file, alt, crop]
$photos = [
  ['crispy-business-card.jpg', 'Crispy business card for Uru Living: a contour pattern blind letterpressed into thick white cotton paper', 'center 40%'],
  ['sakshi-jain.jpg',          'Sakshi Jain architect business card, letterpressed in olive-green ink on cotton paper',                  'center'],
  ['urmil-nisar.jpg',          'Bhanu Cospack business card for Urmil Nisar, letterpressed in blue ink',                                 'center 45%'],
  ['hero-poster.jpg',          'A spread of House of Press business cards in orange, black and green inks',                               'center'],
  ['about2.webp',              'Inking a block of type by hand in the House of Press studio',                                             'center'],
];
$from = min(CARD_PRICES);
$jsonLd = [[
  '@context' => 'https://schema.org',
  '@type' => 'Product',
  'name' => 'Custom Letterpress Business Cards',
  'description' => $description,
  'image' => array_map(fn($p) => SITE_URL . '/assets/videos/' . $p[0], $photos),
  'brand' => ['@type' => 'Brand', 'name' => SITE_NAME],
  'offers' => [
    '@type' => 'AggregateOffer',
    'priceCurrency' => 'INR',
    'lowPrice' => $from,
    'highPrice' => max(CARD_PRICES) + DESIGN_FEE,
    'offerCount' => count(CARD_PRICES) * 2,
    'availability' => 'https://schema.org/InStock',
  ],
]];
include __DIR__ . '/../partials/head.php';
$rupees = fn(int $n) => '₹' . number_format($n);
?>

<main>
  <div class="bc wrap grid">
    <!-- Choose and buy -->
    <div class="bc-info">
      <nav class="crumbs label rv" aria-label="Breadcrumb"><a href="../">Home</a><span>/</span><span aria-current="page">Business cards</span></nav>
      <h1 class="rv">Custom Letterpress <em>Business Cards</em></h1>
      <p class="bc-price rv"><b id="bc-price" class="num"><?= $rupees($from) ?></b><span class="label">GST and delivery included</span></p>

      <form id="bc-form" class="bc-form rv" novalidate>
        <fieldset class="bc-opt">
          <legend class="label">Quantity</legend>
          <div class="bc-choices bc-4">
            <?php foreach (CARD_PRICES as $qty => $p): ?>
              <label><input type="radio" name="qty" value="<?= $qty ?>" <?= $qty === array_key_first(CARD_PRICES) ? ' checked' : '' ?>><span><em><b class="num"><?= number_format($qty) ?></b> cards</em></span></label>
            <?php endforeach; ?>
          </div>
        </fieldset>

        <fieldset class="bc-opt">
          <legend class="label">Design service</legend>
          <div class="bc-choices bc-2">
            <label><input type="radio" name="design" value="no" checked><span>No, I’ll send my artwork</span></label>
            <label><input type="radio" name="design" value="yes"><span><em>Yes (+<b class="num"><?= $rupees(DESIGN_FEE) ?></b>)</em></span></label>
          </div>
        </fieldset>

        <div class="bc-buy">
          <div class="qty bc-sets" aria-label="Number of sets">
            <button type="button" class="q-dec" aria-label="One set less"><svg class="i" aria-hidden="true">
                <use href="#i-minus" />
              </svg></button>
            <input name="sets" type="number" min="1" max="50" value="1" inputmode="numeric" aria-label="Sets">
            <button type="button" class="q-inc" aria-label="One set more"><svg class="i" aria-hidden="true">
                <use href="#i-plus" />
              </svg></button>
          </div>
          <button type="button" class="btn red bc-now" id="bc-now">Buy it now <svg class="i arr" aria-hidden="true">
              <use href="#i-arrow-right" />
            </svg></button>
          <button type="submit" class="btn bc-add"><svg class="i" aria-hidden="true">
              <use href="#i-shopping-cart" />
            </svg>Add to cart</button>
        </div>
        <p class="bc-added" id="bc-added" role="status" aria-live="polite"></p>
      </form>

      <div class="bc-copy rv">
        <p class="bc-motto">In a hurry? <em>Not the place for you.</em></p>
        <p>Every card is letterpressed by hand, a craft that is centuries old: deep impressions, textured cotton paper, and ink you can feel as much as see. Choose your quantity, decide whether our studio designs your card from scratch or you send your own artwork, and we’ll take it from there.</p>
        <p>Delivery is included across India. After you place your order, we confirm the details with you on WhatsApp within 24 hours, before your cards go to press.</p>
      </div>

      <dl class="bc-specs rv">
        <div>
          <dt class="label">Size</dt>
          <dd><b class="num">89 × 51</b> mm, standard business card</dd>
        </div>
        <div>
          <dt class="label">Paper</dt>
          <dd><b class="num">600</b> gsm cotton</dd>
        </div>
        <div>
          <dt class="label">Ink</dt>
          <dd>Multiple house inks, or blind with no ink</dd>
        </div>
        <div>
          <dt class="label">Proof</dt>
          <dd>On WhatsApp, before anything is pressed</dd>
        </div>
        <div>
          <dt class="label">Dispatch</dt>
          <dd><?= nums(DISPATCH) ?> after your proof</dd>
        </div>
        <div>
          <dt class="label">Delivery</dt>
          <dd>Free across India, with tracking</dd>
        </div>
      </dl>
    </div>
  </div>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>