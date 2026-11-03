<?php
$page        = 'home';
$base        = '';
$preloadImage = 'assets/videos/hero-poster.jpg';
$title       = 'House of Press - Human Made. Craft and letterpress in Mumbai';
$description = 'House of Press is an institution in Mumbai dedicated to the preservation, practice and advancement of human craftsmanship, through print, stationery, objects, art and collaboration.';

// Structured data: lets search engines show the studio's address, hours and phone
require_once __DIR__ . '/partials/config.php';
$jsonLd = [
  [
    '@context' => 'https://schema.org',
    '@type' => 'LocalBusiness',
    '@id' => SITE_URL . '/#studio',
    'name' => SITE_NAME,
    'description' => $description,
    'url' => SITE_URL . '/',
    'logo' => SITE_URL . '/assets/logo.svg',
    'image' => [SITE_URL . '/assets/og-image.png', SITE_URL . '/assets/videos/hero-poster.jpg'],
    'telephone' => PHONE_TEL,
    'email' => EMAIL,
    'address' => [
      '@type' => 'PostalAddress',
      'streetAddress' => ADDRESS_STREET,
      'addressLocality' => ADDRESS_AREA . ', ' . ADDRESS_CITY,
      'addressRegion' => ADDRESS_REGION,
      'postalCode' => ADDRESS_PIN,
      'addressCountry' => 'IN',
    ],
    'geo' => ['@type' => 'GeoCoordinates', 'latitude' => GEO[0], 'longitude' => GEO[1]],
    'hasMap' => MAPS_URL,
    'openingHoursSpecification' => [[
      '@type' => 'OpeningHoursSpecification',
      'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
      'opens' => '09:00',
      'closes' => '19:00',
    ]],
    'areaServed' => ['@type' => 'Country', 'name' => 'India'],
    'knowsAbout' => ['Letterpress printing', 'Printed matter', 'Stationery', 'Business cards', 'Blind debossing', 'Cotton paper', 'Craftsmanship'],
    'sameAs' => ['https://instagram.com/' . INSTAGRAM],
  ],
  [
    '@context' => 'https://schema.org',
    '@type' => 'WebSite',
    'name' => SITE_NAME,
    'url' => SITE_URL . '/',
    'publisher' => ['@id' => SITE_URL . '/#studio'],
  ],
];
$scripts = ['home.js', 'work.js'];
include __DIR__ . '/partials/head.php';
?>

<main>
  <!-- Opening frame: the page is a press proof. The headline is pressed into the cotton in black ink
       and "impression." is pressed blind (no ink, only the bite of the plate), with the printer's red-pencil
       notes around it. -->
  <div class="px-proof" data-route="">
    <div class="px-sheet wrap">
      <p class="px-slug">Human Made · House of Press, Mumbai</p>

      <h1 class="px-title">
        <span class="px-ink">Cards that leave</span>
        <span class="px-ink">a lasting</span>
        <span class="px-ink px-blind">impression.</span>
      </h1>
      <p class="px-note px-note-blind" aria-hidden="true">
        <svg viewBox="0 0 60 40" class="px-arrow"><path d="M52 34 C 40 30, 22 26, 10 8 M10 8 l 1 9 M10 8 l 8 3" /></svg>
        blind, no ink, just the bite
      </p>

      <div class="px-foot">
        <div class="px-copy">
          <p class="px-lead">A celebration of the human hand, the mind behind the design, and the honesty of the craft.</p>
          <p class="hm-lead-2">We are an institution dedicated to keeping human craftsmanship alive. Through print, objects, art and collaboration, we preserve traditional practices, explore new possibilities and celebrate the people behind the work.</p>
          <div class="px-actions">
            <a href="institution/" class="btn">Explore the Institution <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right" /></svg></a>
            <a href="works/" class="btn line">Discover the Works</a>
          </div>
        </div>
        <figure class="px-pinned">
          <span class="px-tape" aria-hidden="true"></span>
          <video src="assets/videos/hero.mp4" poster="assets/videos/hero-poster.jpg" data-autoplay muted loop playsinline preload="none" aria-label="Letterpress cards from House of Press, pressed by hand into thick cotton paper in one and two inks"></video>
          <figcaption class="px-note px-note-pin" aria-hidden="true">pressed by hand, every sheet</figcaption>
        </figure>
      </div>
    </div>
  </div>

  <!-- Our belief -->
  <section class="hm-belief">
    <div class="wrap hm-belief-in">
      <h2 class="hm-belief-title">There is something extraordinary about being <em>made by hand.</em></h2>
      <div class="hm-belief-text">
        <p class="hm-big">In a world increasingly shaped by machines, we believe in the value of things made by people.</p>
        <p>In the time taken. The knowledge passed down. The decisions made by hand. The imperfections that make every creation its own.</p>
        <p>We believe that an object’s worth extends beyond what it is. It lives in the people, process and purpose behind its making.</p>
        <p class="px-note hm-stand">This is what we stand for.</p>
      </div>
      <figure class="hm-belief-photo">
        <span class="px-tape" aria-hidden="true"></span>
        <img src="assets/videos/about1.webp" alt="Freshly pressed cotton sheets drying on a wooden rack in the House of Press studio, beside jars of ink and a roller" loading="lazy" width="1344" height="768">
      </figure>
    </div>
  </section>

  <!-- What we do, on the studio's red -->
  <?php
  $pillars = [
    ['Preserve', 'We preserve traditional craftsmanship, techniques and knowledge that deserve to be carried forward.'],
    ['Create', 'We bring design and craftsmanship together to create objects that challenge conventions and stand the test of time.'],
    ['Champion', 'We give artists, designers and craftspeople a platform to be recognised, supported and rewarded for their contributions.'],
    ['Document', 'We record the stories behind the work, ensuring that the people and processes behind every creation are never forgotten.'],
  ];
  ?>
  <section class="ip-pillars">
    <div class="wrap">
      <h2>A practice. A platform. <em>An institution.</em></h2>
      <ol class="ip-pillar-list">
        <?php foreach ($pillars as $n => [$name, $what]): ?>
          <li>
            <span class="num"><?= sprintf('%02d', $n + 1) ?></span>
            <h3 class="hm-pillar"><?= e($name) ?></h3>
            <p><?= e($what) ?></p>
          </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </section>

  <!-- The works: prints laid out on the dark press-room table, each a little askew; swipe on a phone -->
  <?php
  // [photo in assets/videos, job, ink, crop, tilt]
  $prints = [
    ['crispy-business-card.jpg', 'Uru Living',    'Blind pressed',   'center 40%', -4],
    ['sakshi-jain.jpg',          'Sakshi Jain',   'Olive-green ink', 'center 40%', 3],
    ['hero-poster.jpg',          'Studio run',    'Orange, black and green', 'center', -2],
    ['urmil-nisar.jpg',          'Bhanu Cospack', 'Blue ink',        'center 40%', 4],
    ['about-studio.jpg',         'The press',     'Set up by hand',  'center', -3],
  ];
  ?>
  <section id="products" class="px-table" data-route="">
    <div class="px-table-head wrap">
      <div>
        <h2>Made with intention. <em>Kept with meaning.</em></h2>
        <p class="hm-table-text">A collection of printed matter, stationery, objects and works created through the meeting of design and craftsmanship. Every piece has a purpose. Every process has a story.</p>
      </div>
      <a href="works/" class="px-more">Explore the Collection <svg class="i" aria-hidden="true"><use href="#i-arrow-right" /></svg></a>
    </div>
    <div class="px-prints">
      <?php foreach ($prints as $n => [$file, $job, $ink, $crop, $tilt]): ?>
        <button type="button" class="px-print work-tile" style="--tilt: <?= $tilt ?>deg" data-name="<?= e($job) ?>" data-note="<?= e($ink) ?>" aria-label="View larger: <?= e("$job, $ink") ?>">
          <img src="assets/videos/<?= $file ?>" alt="<?= e("$job by House of Press: $ink") ?>" loading="lazy" style="object-position: <?= $crop ?>">
          <span class="px-print-cap" aria-hidden="true"><span class="num">No. <?= sprintf('%02d', $n + 1) ?></span><?= e($job) ?></span>
        </button>
      <?php endforeach; ?>
    </div>

    <!-- Lightbox, the same one the Works page uses (work.js) -->
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

  <!-- The people, beside the hands at work -->
  <section class="hm-people">
    <div class="wrap hm-people-in">
      <figure class="hm-people-photo">
        <img src="assets/videos/about2.webp" alt="A House of Press printer inking a block of type by hand with an orange roller" loading="lazy" width="1344" height="768">
        <figcaption class="px-note" aria-hidden="true">the hands that refined it</figcaption>
      </figure>
      <div class="hm-people-text">
        <h2>Behind every great work, <em>there are people.</em></h2>
        <p class="hm-big">The designer who imagined it. The craftsperson who gave it form. The hands that refined it. The people whose knowledge made it possible.</p>
        <p>We believe recognition should extend to everyone who contributes. House of Press exists to give these people a platform, an opportunity and a place in its history.</p>
        <div class="px-actions">
          <a href="people/" class="btn">Meet the People <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right" /></svg></a>
        </div>
      </div>
    </div>
  </section>

  <!-- The archive: an index card from the drawer -->
  <section class="hm-archive">
    <div class="wrap">
      <div class="hm-index">
        <p class="hm-index-tab"><span class="num">No. 0001</span>The Archive</p>
        <h2>Nothing worth making should be <em>forgotten.</em></h2>
        <p>An ongoing record of the people, ideas, techniques and works that shape House of Press. A living archive of contributions, discoveries and collaborations.</p>
        <p class="px-note hm-index-note">Built today. Preserved for generations.</p>
        <a href="archive/" class="btn line">Enter the Archive <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right" /></svg></a>
      </div>
    </div>
  </section>

  <!-- Closing statement, pressed into a card that tilts under the pointer (home.js) -->
  <section id="enquiry-home" class="px-end" data-route="">
    <div class="wrap">
      <p class="px-note px-note-end" aria-hidden="true">with love and faith</p>
      <div class="px-card" id="px-card">
        <div class="px-card-face">
          <p class="px-ink px-card-brand">House of Press</p>
          <div>
            <h2 class="px-card-title"><span class="px-ink">Love the process.</span> <span class="px-ink px-red">Have faith in the honesty.</span></h2>
            <span class="px-card-rule" aria-hidden="true"></span>
            <p class="px-ink px-card-text">We believe in making things with care, standing behind the work and honouring everyone involved in bringing it to life.</p>
          </div>
          <p class="px-card-foot"><span class="px-ink">Human Made. Honestly Kept.</span><span class="px-ink">Mumbai, India</span></p>
        </div>
      </div>
      <div class="px-actions px-end-actions">
        <a href="commissions/" class="btn red">Discuss a commission <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right" /></svg></a>
        <a href="business-cards/" class="btn line">Visit the Shop</a>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>