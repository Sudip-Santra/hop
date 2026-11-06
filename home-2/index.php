<?php
// A second take on the home page, to compare with the live one at /. Not linked and kept out of
// search (noindex). The same content as the home page, as the studio wall in a scrapbook: the pressed
// headline beside a collage of taped and pinned photos; the belief on a notebook page; what we do on
// sticky notes; the works pinned to a kraft board; the people as a taped photo; the archive as a
// manila folder; and the closing statement on a torn sheet.
$page        = 'home-2';
$base        = '../';
$noindex     = true;
$title       = 'House of Press - Human Made. Craft and letterpress in Mumbai';
$description = 'House of Press is an institution in Mumbai dedicated to the preservation, practice and advancement of human craftsmanship, through print, stationery, objects, art and collaboration.';
$scripts     = ['work.js'];
require_once __DIR__ . '/../partials/config.php';
include __DIR__ . '/../partials/head.php';

// Ink chips on the wall: [name, colour]
$inks = [['Red', '#a51e23'], ['Olive', '#6b6b2a'], ['Black', '#262827']];
// What we do, one sticky note each: [word, what it means, note colour, tilt]
$pillars = [
  ['Preserve', 'We preserve traditional craftsmanship, techniques and knowledge that deserve to be carried forward.', '#f3dc8c', -2],
  ['Create', 'We bring design and craftsmanship together to create objects that challenge conventions and stand the test of time.', '#f2c9c2', 1.5],
  ['Champion', 'We give artists, designers and craftspeople a platform to be recognised, supported and rewarded for their contributions.', '#d3e2c8', -1],
  ['Document', 'We record the stories behind the work, ensuring that the people and processes behind every creation are never forgotten.', '#cfdcea', 2],
];
// Prints on the board: [photo in assets/videos, label, ink, crop, tilt]
$prints = [
  ['crispy-business-card.jpg', 'Uru Living',    'Blind pressed',           'center 40%', -3],
  ['sakshi-jain.jpg',          'Sakshi Jain',   'Olive-green ink',         'center 40%', 2],
  ['hero-poster.jpg',          'Studio run',    'Orange, black and green', 'center',     -2],
  ['urmil-nisar.jpg',          'Bhanu Cospack', 'Blue ink',                'center 40%', 3],
  ['about-studio.jpg',         'The press',     'Set up by hand',          'center',     -4],
];
?>

<main>
  <!-- The wall: the headline pressed into the paper, and beside it what's pinned up in the studio -->
  <div class="sb-wall">
    <div class="wrap sb-wall-in">
      <div class="sb-copy">
        <p class="sb-eyebrow">House of Press, Mumbai</p>
        <h1 class="sb-title">
          <span class="px-ink">Human made.</span>
          <span class="px-ink px-red">Honestly kept.</span>
        </h1>
        <p class="sb-lead">A celebration of the human hand, the mind behind the design, and the honesty of the craft.</p>
        <p class="sb-lead-2">We are an institution dedicated to keeping human craftsmanship alive. Through print, objects, art and collaboration, we preserve traditional practices, explore new possibilities and celebrate the people behind the work.</p>
        <div class="sb-actions sb-wall-actions">
          <a href="<?= $base ?>institution/" class="btn">Explore the Institution <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right" /></svg></a>
          <a href="<?= $base ?>works/" class="btn line">Discover the Works</a>
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
        <p class="sb-sticky">craft is king, always</p>
        <p class="sb-offcut"><span class="px-note">600 gsm cotton, pressed deep</span></p>
      </div>
    </div>
  </div>

  <!-- Our belief, written out on a notebook page pinned beside the title -->
  <section class="sb-belief">
    <div class="wrap sb-belief-in">
      <h2 class="sb-belief-title">There is something extraordinary about being <em>made by hand.</em></h2>
      <div class="sb-page">
        <span class="sb-pin" aria-hidden="true"></span>
        <p class="sb-page-big">In a world increasingly shaped by machines, we believe in the value of things made by people.</p>
        <p>In the time taken. The knowledge passed down. The decisions made by hand. The imperfections that make every creation its own.</p>
        <p>We believe that an object’s worth extends beyond what it is. It lives in the people, process and purpose behind its making.</p>
        <p class="px-note sb-page-note">This is what we stand for.</p>
      </div>
      <figure class="sb-snap sb-belief-snap" aria-hidden="true">
        <span class="px-tape"></span>
        <img src="<?= $base ?>assets/videos/about1.webp" alt="" loading="lazy">
      </figure>
    </div>
  </section>

  <!-- What we do: four sticky notes on the studio's red wall -->
  <section class="sb-do">
    <div class="wrap">
      <h2>A practice. A platform. <em>An institution.</em></h2>
      <ol class="sb-notes">
        <?php foreach ($pillars as $n => [$word, $what, $colour, $tilt]): ?>
          <li class="sb-note" style="--note: <?= $colour ?>; --tilt: <?= $tilt ?>deg">
            <span class="px-tape" aria-hidden="true"></span>
            <span class="num"><?= sprintf('%02d', $n + 1) ?></span>
            <h3><?= e($word) ?></h3>
            <p><?= e($what) ?></p>
          </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </section>

  <!-- The works: prints pinned to kraft, each with a label on a strip of tape; each opens larger -->
  <section class="sb-board">
    <div class="wrap">
      <div class="sb-board-head">
        <div>
          <h2>Made with intention. <em>Kept with meaning.</em></h2>
          <p class="sb-board-text">A collection of printed matter, stationery, objects and works created through the meeting of design and craftsmanship. Every piece has a purpose. Every process has a story.</p>
        </div>
        <a href="<?= $base ?>works/" class="sb-more">Explore the Collection <svg class="i" aria-hidden="true"><use href="#i-arrow-right" /></svg></a>
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

    <dialog class="g-box" id="g-box" aria-label="The works, larger">
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

  <!-- The people: a taped photo of the hands at work, beside the words -->
  <section class="sb-people">
    <div class="wrap sb-people-in">
      <figure class="sb-snap sb-people-snap">
        <span class="px-tape" aria-hidden="true"></span>
        <img src="<?= $base ?>assets/videos/about2.webp" alt="A House of Press printer inking a block of type by hand with an orange roller" loading="lazy">
        <figcaption class="px-note" aria-hidden="true">the hands that refined it</figcaption>
      </figure>
      <div class="sb-people-text">
        <h2>Behind every great work, <em>there are people.</em></h2>
        <p class="sb-people-big">The designer who imagined it. The craftsperson who gave it form. The hands that refined it. The people whose knowledge made it possible.</p>
        <p>We believe recognition should extend to everyone who contributes. House of Press exists to give these people a platform, an opportunity and a place in its history.</p>
        <div class="sb-actions">
          <a href="<?= $base ?>people/" class="btn">Meet the People <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right" /></svg></a>
        </div>
      </div>
    </div>
  </section>

  <!-- The archive: a manila folder on the dark desk -->
  <section class="sb-archive">
    <div class="wrap">
      <div class="sb-folder">
        <p class="sb-folder-tab"><span>The Archive</span><span class="num">No. 0001</span></p>
        <h2>Nothing worth making should be <em>forgotten.</em></h2>
        <p>An ongoing record of the people, ideas, techniques and works that shape House of Press. A living archive of contributions, discoveries and collaborations.</p>
        <p class="px-note sb-folder-note">Built today. Preserved for generations.</p>
        <a href="<?= $base ?>archive/" class="btn line">Enter the Archive <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right" /></svg></a>
      </div>
    </div>
  </section>

  <!-- The closing statement on a torn sheet, with a sticky note on its corner -->
  <section class="sb-end">
    <div class="wrap">
      <div class="sb-sheet">
        <p class="px-note sb-sheet-note" aria-hidden="true">with love and faith ↓</p>
        <h2 class="sb-sheet-title"><span class="px-ink">Love the process.</span> <span class="px-ink px-red">Have faith in the honesty.</span></h2>
        <p>We believe in making things with care, standing behind the work and honouring everyone involved in bringing it to life.</p>
        <div class="sb-actions">
          <a href="<?= $base ?>commissions/" class="btn red">Discuss a commission <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right" /></svg></a>
          <a href="<?= $base ?>business-cards/" class="btn line">Visit the Shop</a>
        </div>
        <p class="sb-sticky sb-sticky-end" aria-hidden="true">we stand behind the work</p>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
