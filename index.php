<?php
$page        = 'home';
$base        = '';
$preloadImage = 'assets/videos/hero-poster.jpg';
$title       = 'House of Press - Letterpress Business Cards in Mumbai';
$description = 'Letterpress business and brand cards pressed by hand into thick cotton paper in Mumbai. Custom designs, a WhatsApp proof first, and free delivery across India.';

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
    'knowsAbout' => ['Letterpress printing', 'Business cards', 'Brand cards', 'Blind debossing', 'Cotton paper'],
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
  <!-- Hero: the page is a press proof. The headline is pressed into the cotton paper in black ink,
       and "impression." is pressed blind (no ink, only the bite of the plate), with the printer's
       red-pencil notes around it. -->
  <div class="px-proof" data-route="">
    <div class="px-sheet wrap">
      <p class="px-slug">House of Press, Mumbai</p>

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
          <p class="px-lead">Business cards pressed by hand into thick cotton paper, one sheet at a time. A proof on WhatsApp before we print, and free delivery across India.</p>
          <div class="px-actions">
            <a href="business-cards/" class="btn">See cards <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right" /></svg></a>
            <a href="https://wa.me/<?= WHATSAPP ?>" class="btn line">WhatsApp us</a>
          </div>
        </div>
        <figure class="px-pinned">
          <span class="px-tape" aria-hidden="true"></span>
          <video src="assets/videos/hero.mp4" poster="assets/videos/hero-poster.jpg" data-autoplay muted loop playsinline preload="none" aria-label="Letterpress business cards from House of Press, pressed into thick cotton paper in one and two inks"></video>
          <figcaption class="px-note px-note-pin" aria-hidden="true">600 gsm cotton, feel it</figcaption>
        </figure>
      </div>
    </div>
  </div>

  <!-- Clients: the names we've pressed cards for, sliding past between two rules.
       Logos are single-colour SVGs in assets/clients, inlined so they take the text colour. -->
  <?php
  $clients = [
    ['google', 'Google'],
    ['apple', 'Apple'],
    ['amazon', 'Amazon'],
    ['flipkart', 'Flipkart'],
    ['ashoka-chakra', 'Govt. of India'],
  ];
  ?>
  <div class="marquee clients-strip px-clients">
    <p class="sr-only">Brands we’ve pressed cards for: <?= e(implode(', ', array_column($clients, 1))) ?>.</p>
    <div class="marquee-track" aria-hidden="true">
      <?php for ($i = 0; $i < 4; $i++): foreach ($clients as [$logo, $name]): ?>
        <span class="client-logo"><?= $logo ? file_get_contents(__DIR__ . "/assets/clients/$logo.svg") : '' ?><b><?= e($name) ?></b></span>
      <?php endforeach; endfor; ?>
    </div>
  </div>

  <!-- Work: prints laid out on the dark press-room table, each a little askew; swipe on a phone -->
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
      <h2>Fresh off <em>the press.</em></h2>
      <a href="gallery/" class="px-more">See the gallery <svg class="i" aria-hidden="true"><use href="#i-arrow-right" /></svg></a>
    </div>
    <div class="px-prints">
      <?php foreach ($prints as $n => [$file, $job, $ink, $crop, $tilt]): ?>
        <button type="button" class="px-print work-tile" style="--tilt: <?= $tilt ?>deg" data-name="<?= e($job) ?>" data-note="<?= e($ink) ?>" aria-label="View larger: <?= e("$job, $ink") ?>">
          <img src="assets/videos/<?= $file ?>" alt="<?= e("$job by House of Press: $ink") ?>" loading="lazy" style="object-position: <?= $crop ?>">
          <span class="px-print-cap" aria-hidden="true"><span class="num">No. <?= sprintf('%02d', $n + 1) ?></span><?= e($job) ?></span>
        </button>
      <?php endforeach; ?>
    </div>

    <!-- Lightbox, the same one the gallery page uses (work.js) -->
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

  <!-- Closing: the invitation is itself a letterpress card, pressed into cotton; it tilts under the
       pointer (home.js) so the light catches the impression -->
  <section id="enquiry-home" class="px-end" data-route="">
    <div class="wrap">
      <p class="px-note px-note-end" aria-hidden="true">your turn ↓</p>
      <div class="px-card" id="px-card">
        <div class="px-card-face">
          <p class="px-ink px-card-brand">House of Press</p>
          <div>
            <h2 class="px-card-title"><span class="px-ink">Have a card</span> <span class="px-ink px-red">in mind?</span></h2>
            <span class="px-card-rule" aria-hidden="true"></span>
            <p class="px-ink px-card-text">Send your logo or a rough idea. We’ll set it, send a proof on WhatsApp, and press it once you approve.</p>
          </div>
          <p class="px-card-foot"><a class="px-ink num" href="https://wa.me/<?= WHATSAPP ?>"><?= PHONE_DISPLAY ?></a><a class="px-ink" href="mailto:<?= EMAIL ?>"><?= EMAIL ?></a></p>
        </div>
      </div>
      <div class="px-actions px-end-actions">
        <a href="contact/" class="btn red">Start your card <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right" /></svg></a>
        <a href="https://wa.me/<?= WHATSAPP ?>" class="btn line">WhatsApp us</a>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>