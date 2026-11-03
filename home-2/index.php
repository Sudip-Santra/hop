<?php
// A second take on the home page, to compare with the live one at /. Not linked and kept out of
// search (noindex). The studio wall as a scrapbook: the pressed headline beside a collage of taped
// and pinned photos, ink chips, a sticky note and a torn offcut; prints pinned to a kraft board
// with handwritten labels; and the invitation on a torn sheet.
$page        = 'home-2';
$base        = '../';
$noindex     = true;
$title       = 'House of Press - Letterpress Business Cards in Mumbai';
$description = 'Letterpress business and brand cards pressed by hand into thick cotton paper in Mumbai. Custom designs, a WhatsApp proof first, and free delivery across India.';
$scripts     = ['work.js'];
require_once __DIR__ . '/../partials/config.php';
include __DIR__ . '/../partials/head.php';

// Ink chips on the wall: [name, colour]
$inks = [['Red', '#a51e23'], ['Olive', '#6b6b2a'], ['Black', '#262827']];
// Prints on the board: [photo in assets/videos, label, ink, crop, tilt]
$prints = [
  ['crispy-business-card.jpg', 'Uru Living',    'Blind pressed',           'center 40%', -3],
  ['sakshi-jain.jpg',          'Sakshi Jain',   'Olive-green ink',         'center 40%', 2],
  ['hero-poster.jpg',          'Studio run',    'Orange, black and green', 'center',     -2],
  ['urmil-nisar.jpg',          'Bhanu Cospack', 'Blue ink',                'center 40%', 3],
  ['about-studio.jpg',         'The press',     'Set up by hand',          'center',     -4],
];
$clients = [
  ['google', 'Google'],
  ['apple', 'Apple'],
  ['amazon', 'Amazon'],
  ['flipkart', 'Flipkart'],
  ['ashoka-chakra', 'Govt. of India'],
];
?>

<main>
  <!-- The wall: the headline pressed into the paper, and beside it what's pinned up in the studio -->
  <div class="sb-wall">
    <div class="wrap sb-wall-in">
      <div class="sb-copy">
        <p class="sb-eyebrow">House of Press, Mumbai</p>
        <h1 class="sb-title">
          <span class="px-ink">Cards that leave</span>
          <span class="px-ink">a lasting</span>
          <span class="px-ink px-red">impression.</span>
        </h1>
        <p class="sb-lead">Business cards pressed by hand into thick cotton paper, one sheet at a time. A proof on WhatsApp before we print, and free delivery across India.</p>
        <div class="sb-actions">
          <a href="<?= $base ?>business-cards/" class="btn">See cards <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right" /></svg></a>
          <a href="https://wa.me/<?= WHATSAPP ?>" class="btn line">WhatsApp us</a>
        </div>
      </div>

      <div class="sb-collage" aria-hidden="true">
        <figure class="sb-snap sb-snap-a"><span class="px-tape"></span><img src="<?= $base ?>assets/videos/sakshi-jain.jpg" alt=""></figure>
        <figure class="sb-snap sb-snap-b"><span class="sb-pin"></span><img src="<?= $base ?>assets/videos/crispy-business-card.jpg" alt="" style="object-position: center 40%"></figure>
        <div class="sb-chips">
          <?php foreach ($inks as $k => [$ink, $hex]): ?>
            <span class="sb-chip" style="--chip: <?= $hex ?>; --tilt: <?= [-4, 3, -1][$k] ?>deg"><i></i><b><?= e($ink) ?></b></span>
          <?php endforeach; ?>
        </div>
        <p class="sb-sticky">proof on WhatsApp first, always</p>
        <p class="sb-offcut"><span class="px-note">600 gsm cotton, pressed deep</span></p>
      </div>
    </div>
  </div>

  <div class="marquee clients-strip px-clients">
    <p class="sr-only">Brands we’ve pressed cards for: <?= e(implode(', ', array_column($clients, 1))) ?>.</p>
    <div class="marquee-track" aria-hidden="true">
      <?php for ($i = 0; $i < 4; $i++): foreach ($clients as [$logo, $name]): ?>
        <span class="client-logo"><?= file_get_contents(__DIR__ . "/../assets/clients/$logo.svg") ?><b><?= e($name) ?></b></span>
      <?php endforeach; endfor; ?>
    </div>
  </div>

  <!-- The board: prints pinned to kraft, each with a label on a strip of tape; each opens larger -->
  <section class="sb-board">
    <div class="wrap">
      <div class="sb-board-head">
        <h2>Pinned up <em>this week.</em></h2>
        <a href="<?= $base ?>gallery/" class="sb-more">See the gallery <svg class="i" aria-hidden="true"><use href="#i-arrow-right" /></svg></a>
      </div>
      <div class="sb-prints">
        <?php foreach ($prints as [$file, $label, $ink, $crop, $tilt]): ?>
          <button type="button" class="sb-print work-tile" style="--tilt: <?= $tilt ?>deg" data-name="<?= e($label) ?>" data-note="<?= e($ink) ?>" aria-label="View larger: <?= e("$label, $ink") ?>">
            <span class="sb-pin" aria-hidden="true"></span>
            <img src="<?= $base ?>assets/videos/<?= $file ?>" alt="<?= e("$label by House of Press: $ink") ?>" loading="lazy" style="object-position: <?= $crop ?>">
            <span class="sb-label" aria-hidden="true"><?= e($label) ?></span>
          </button>
        <?php endforeach; ?>
      </div>
    </div>

    <dialog class="g-box" id="g-box" aria-label="Our work, larger">
      <div class="g-box-stage" id="g-box-stage"></div>
      <div class="g-box-bar">
        <p class="g-box-cap"><b id="g-box-name"></b><span class="label" id="g-box-note"></span></p>
        <span class="label g-box-count" id="g-box-count" aria-live="polite"></span>
        <div class="g-box-nav">
          <button type="button" id="g-box-prev" aria-label="Previous"><svg class="i" aria-hidden="true"><use href="#i-chevron-left" /></svg></button>
          <button type="button" id="g-box-next" aria-label="Next"><svg class="i" aria-hidden="true"><use href="#i-chevron-right" /></svg></button>
          <button type="button" id="g-box-close" aria-label="Close"><svg class="i" aria-hidden="true"><use href="#i-x" /></svg></button>
        </div>
      </div>
    </dialog>
  </section>

  <!-- The invitation on a torn sheet, with a sticky note on its corner -->
  <section class="sb-end">
    <div class="wrap">
      <div class="sb-sheet">
        <p class="px-note sb-sheet-note" aria-hidden="true">your turn ↓</p>
        <h2 class="sb-sheet-title"><span class="px-ink">Got a card</span> <span class="px-ink px-red">in mind?</span></h2>
        <p>Send your logo, your artwork or just a scribble. We’ll set it, send a proof on WhatsApp, and press it once you approve.</p>
        <div class="sb-actions">
          <a href="<?= $base ?>business-cards/" class="btn red">Start your card <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right" /></svg></a>
          <a href="https://wa.me/<?= WHATSAPP ?>" class="btn line">WhatsApp us</a>
        </div>
        <p class="sb-sticky sb-sticky-end" aria-hidden="true">a scribble is enough</p>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
