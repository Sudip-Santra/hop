<?php
$page        = 'business-cards';
$base        = '../';
$title       = 'Custom Letterpress Business Cards - House of Press';
$description = 'Custom letterpress business cards pressed by hand into thick cotton paper. 100 to 1,000 cards, your artwork or ours, a WhatsApp proof first and free delivery across India.';
$scripts     = ['card-editor.js', 'product.js'];
require_once __DIR__ . '/../partials/config.php';
require_once __DIR__ . '/../partials/card-designs.php';

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
// Per-card price of the smallest pack: each bigger pack's "Save %" is measured against it
$basePer = CARD_PRICES[array_key_first(CARD_PRICES)] / array_key_first(CARD_PRICES);
?>

<main>
  <div class="bc wrap grid">
    <!-- Card preview: a drawn card (the studio's own, or a design being tried in the playground),
         or the customer's uploaded design pressed onto it -->
    <div class="bc-preview" id="bc-preview">
      <!-- The big card with the playground's designs in a column on its left (a row under it on phones).
           Pick a design, then click the card or anything on it: its options open right there
           (card-editor.js; product.js for the card's paper and inks). Ideas only, nothing here goes
           with the order. -->
      <div class="bc-stage">
        <div class="pg-thumbs" role="group" aria-label="Try a design">
          <?php foreach (CARD_DESIGNS as $id => [$name, $paper, $ink, $accent]): ?>
            <button type="button" class="pg-thumb" data-design="<?= $id ?>" data-paper="<?= $paper ?>" data-ink="<?= $ink ?>" data-accent="<?= $accent ?>" aria-pressed="false" title="<?= e($name) ?>">
              <span class="pcard pcard-mini" style="<?= card_vars($paper, $ink, $accent) ?>" data-tone="<?= CARD_PAPERS[$paper][2] ?>" aria-hidden="true"><?= card_front($id) ?></span>
              <span class="pg-thumb-name sr-only"><?= e($name) ?></span>
            </button>
          <?php endforeach; ?>
        </div>
        <div class="pcard" id="pcard" role="img" aria-label="A House of Press card in black ink with a red rule, on Pearl White cotton">
          <div class="pcard-designs" id="pcard-sample">
            <?php foreach (CARD_DESIGNS as $id => $d): ?>
              <?= str_replace('<div class="pcard-front', '<div' . ($id === 'house' ? '' : ' hidden') . ' class="pcard-front', card_front($id)) ?>
            <?php endforeach; ?>
          </div>
          <img class="pcard-art" id="pcard-art" alt="" hidden>
        </div>

        <!-- The card's options, for a click on the card itself: paper, its inks, add text, reset -->
        <div class="ce-bar" id="ce-card-bar" role="toolbar" aria-label="Card" hidden>
          <div class="ce-bar-row">
            <span class="ce-bar-label">Paper</span>
            <div class="pg-swatches" data-kind="paper">
              <?php foreach (CARD_PAPERS as $k => [$name, $hex, $tone]): ?>
                <button type="button" class="pg-sw" data-value="<?= $k ?>" data-hex="<?= $hex ?>" data-tone="<?= $tone ?>" style="--sw:<?= $hex ?>" aria-pressed="false" title="<?= e($name) ?>"><span class="sr-only"><?= e($name) ?></span></button>
              <?php endforeach; ?>
              <button type="button" class="pg-sw ce-custom" data-value="custom" aria-pressed="false" aria-expanded="false" title="Custom colour"><span class="sr-only">Custom colour</span></button>
            </div>
          </div>
          <?php foreach (['ink' => 'Ink', 'accent' => 'Accent'] as $kind => $label): ?>
            <div class="ce-bar-row">
              <span class="ce-bar-label"><?= $label ?></span>
              <div class="pg-swatches" data-kind="<?= $kind ?>">
                <?php foreach (CARD_INKS as $k => [$name, $hex]): ?>
                  <button type="button" class="pg-sw<?= $hex === 'blind' ? ' is-blind' : '' ?>" data-value="<?= $k ?>" data-hex="<?= $hex ?>" style="--sw:<?= $hex === 'blind' ? 'transparent' : $hex ?>" aria-pressed="false" title="<?= e($name) ?>"><span class="sr-only"><?= e($name) ?></span></button>
                <?php endforeach; ?>
                <button type="button" class="pg-sw ce-custom" data-value="custom" aria-pressed="false" aria-expanded="false" title="Custom colour"><span class="sr-only">Custom colour</span></button>
              </div>
            </div>
          <?php endforeach; ?>
          <!-- Custom colour for the paper or an ink: opened from a row's rainbow swatch (product.js) -->
          <div class="ce-cp" hidden>
            <div class="ce-cp-sv" aria-label="Shade"><span class="ce-cp-dot"></span></div>
            <div class="ce-cp-hue" aria-label="Hue"><span class="ce-cp-knob"></span></div>
            <div class="ce-cp-row">
              <span class="ce-cp-prev"></span>
              <input class="ce-cp-hex" type="text" maxlength="7" spellcheck="false" autocomplete="off" aria-label="Hex colour">
            </div>
          </div>
          <div class="ce-bar-row ce-bar-acts">
            <button type="button" class="ce-btn" data-act="add">Add text</button>
            <button type="button" class="ce-btn" id="pg-reset">Reset design</button>
          </div>
        </div>

        <!-- A selected item's options, beside it: type, font, size, weight, its own ink, delete -->
        <div class="ce-bar" id="ce-item-bar" role="toolbar" aria-label="Selected item" hidden>
          <div class="ce-bar-row ce-bar-acts">
            <button type="button" class="ce-btn" data-act="edit" data-text>Edit</button>
            <!-- Font picker: each font shown in itself; the list is filled by card-editor.js -->
            <div class="ce-dd" data-text>
              <button type="button" class="ce-btn ce-dd-btn" aria-haspopup="listbox" aria-expanded="false" aria-label="Font">
                <span class="ce-dd-val">Instrument Serif</span>
                <svg class="i" aria-hidden="true"><use href="#i-chevron-down" /></svg>
              </button>
              <div class="ce-dd-list" role="listbox" aria-label="Font" tabindex="-1" hidden></div>
            </div>
            <button type="button" class="ce-btn" data-act="smaller" aria-label="Smaller">−</button>
            <button type="button" class="ce-btn" data-act="bigger" aria-label="Bigger">+</button>
            <button type="button" class="ce-btn ce-bold" data-act="bold" data-text aria-pressed="false" aria-label="Bold">B</button>
            <button type="button" class="ce-btn ce-italic" data-act="italic" data-text aria-pressed="false" aria-label="Italic">I</button>
            <button type="button" class="ce-btn ce-del" data-act="delete" aria-label="Delete" title="Delete"><svg class="i" aria-hidden="true"><use href="#i-trash-2" /></svg></button>
          </div>
          <div class="ce-bar-row">
            <div class="pg-swatches ce-inks" data-kind="item">
              <?php foreach (CARD_INKS as $k => [$name, $hex]): ?>
                <button type="button" class="pg-sw<?= $hex === 'blind' ? ' is-blind' : '' ?>" data-value="<?= $k ?>" data-hex="<?= $hex ?>" style="--sw:<?= $hex === 'blind' ? 'transparent' : $hex ?>" aria-pressed="false" title="<?= e($name) ?>"><span class="sr-only"><?= e($name) ?></span></button>
              <?php endforeach; ?>
              <button type="button" class="pg-sw ce-custom" data-value="custom" aria-pressed="false" aria-expanded="false" title="Custom colour"><span class="sr-only">Custom colour</span></button>
            </div>
          </div>
          <!-- Custom colour: shade square, hue strip, hex (card-editor.js) -->
          <div class="ce-cp" hidden>
            <div class="ce-cp-sv" aria-label="Shade"><span class="ce-cp-dot"></span></div>
            <div class="ce-cp-hue" aria-label="Hue"><span class="ce-cp-knob"></span></div>
            <div class="ce-cp-row">
              <span class="ce-cp-prev"></span>
              <input class="ce-cp-hex" type="text" maxlength="7" spellcheck="false" autocomplete="off" aria-label="Hex colour">
            </div>
          </div>
        </div>
      </div>
      <p class="bc-preview-cap" id="pcard-cap"><span id="pcard-cap-lead">Our own card, as a sample; yours goes on the proof.</span></p>
      <p class="ce-hint" id="ce-hint">Click the card, or anything on it, to change it. Drag to move, pull a corner to resize, click selected text again to type.</p>
    </div>

    <!-- Choose and buy -->
    <div class="bc-info">
      <nav class="crumbs label rv" aria-label="Breadcrumb"><a href="../">Home</a><span>/</span><span aria-current="page">Business cards</span></nav>
      <h1 class="rv">Custom Letterpress <em>Business Cards</em></h1>
      <p class="bc-price rv"><b id="bc-price" class="num"><?= $rupees($from) ?></b><span class="label">GST and delivery included</span></p>

      <form id="bc-form" class="bc-form rv" novalidate>
        <fieldset class="bc-opt">
          <legend class="bc-step">Choose quantity</legend>
          <div class="bc-choices bc-2 bc-tiles">
            <?php foreach (CARD_PRICES as $qty => $p):
              $per  = $p / $qty;
              $save = (int) round((1 - $per / $basePer) * 100); ?>
              <label><input type="radio" name="qty" value="<?= $qty ?>" <?= $qty === array_key_first(CARD_PRICES) ? ' checked' : '' ?>>
                <span class="bc-tile">
                  <?php if ($save > 0): ?><i class="bc-tag">Save <b class="num"><?= $save ?>%</b></i><?php endif; ?>
                  <?php if ($qty === POPULAR_QTY): ?><i class="bc-tag is-pop">Popular</i><?php endif; ?>
                  <b class="bc-tile-big"><?= number_format($qty) ?></b>
                  <small>cards</small>
                  <b class="bc-tile-price num"><?= $rupees($p) ?></b>
                  <small><b class="num">₹<?= number_format($per, 2) ?></b> per card</small>
                </span>
              </label>
            <?php endforeach; ?>
          </div>
        </fieldset>

        <fieldset class="bc-opt">
          <legend class="bc-step">Choose colours</legend>
          <div class="bc-choices bc-2 bc-tiles">
            <label><input type="radio" name="colors" value="1" checked><span class="bc-tile"><b class="bc-tile-big">1</b><small>colour</small></span></label>
            <label><input type="radio" name="colors" value="2"><span class="bc-tile"><b class="bc-tile-big">2</b><small>colours</small></span></label>
          </div>
          <p class="bc-hint">One or two inks, same price.</p>
        </fieldset>

        <fieldset class="bc-opt">
          <legend class="bc-step">Artwork</legend>
          <div class="bc-choices bc-tiles bc-rows">
            <label><input type="radio" name="design" value="yes" checked>
              <span class="bc-tile"><strong>Design service <i class="bc-fee">+<b class="num"><?= $rupees(DESIGN_FEE) ?></b></i></strong><small>Our studio designs your card from scratch: typography, layout and artwork.</small></span>
            </label>
            <label><input type="radio" name="design" value="no">
              <span class="bc-tile"><strong>I’ll upload my design</strong><small>Send your own artwork, ready for the press.</small></span>
            </label>
          </div>
          <!-- Own artwork: upload it to see it on the card. Only shown for "I'll send my artwork". -->
          <div class="bc-upload" id="bc-upload">
            <label class="btn line bc-up" id="bc-up">
              <svg class="i" aria-hidden="true">
                <use href="#i-upload" />
              </svg>Upload your design
              <input type="file" id="bc-file" accept=".png,.jpg,.jpeg,.webp,.pdf,image/png,image/jpeg,image/webp,application/pdf">
            </label>
            <p class="bc-file" id="bc-file-row" hidden>
              <svg class="i" aria-hidden="true">
                <use href="#i-file" />
              </svg>
              <span id="bc-file-name"></span>
              <button type="button" class="bc-file-x" id="bc-file-x" aria-label="Remove file"><svg class="i" aria-hidden="true">
                  <use href="#i-x" />
                </svg></button>
            </p>
            <p class="bc-up-hint">PNG, JPG, WEBP or PDF · up to <b class="num">1</b> MB. You’ll see an image on the card, and your file goes with your order.</p>
            <p class="bc-up-err" id="bc-up-err" role="alert" hidden></p>
          </div>
        </fieldset>

        <fieldset class="bc-opt">
          <legend class="bc-step">Notes for the studio</legend>
          <textarea class="bc-notes" id="bc-notes" name="notes" rows="3" aria-label="Notes for the studio" placeholder="Paper preference, ink colours, special instructions…"></textarea>
          <p class="bc-hint">Goes to the studio with your order.</p>
        </fieldset>

        <div class="bc-buy">
          <button type="button" class="btn red bc-now" id="bc-now">Acquire <svg class="i arr" aria-hidden="true">
              <use href="#i-arrow-right" />
            </svg></button>
          <button type="submit" class="btn bc-add"><svg class="i" aria-hidden="true">
              <use href="#i-shopping-cart" />
            </svg>Add to cart</button>
        </div>
        <p class="bc-added" id="bc-added" role="status" aria-live="polite"></p>
      </form>

      <!-- Help: straight to the studio on WhatsApp -->
      <div class="bc-help rv">
        <h2 class="bc-help-title">Questions? Chat with us.</h2>
        <p>Our team is available on WhatsApp to help with artwork, paper choices, and anything else. Most orders are confirmed within a few hours.</p>
        <a class="bc-help-link" href="<?= e('https://wa.me/' . WHATSAPP . '?text=' . rawurlencode("Hi House of Press, I have a question about business cards.")) ?>" target="_blank" rel="noopener">
          <svg class="i" aria-hidden="true"><use href="#i-whatsapp" /></svg>Chat on WhatsApp
        </a>
      </div>
    </div>
  </div>

</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>