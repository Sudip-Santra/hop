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
$scripts = ['work.js'];
include __DIR__ . '/partials/head.php';
?>

<main>
  <!-- Hero -->
  <div class="hero wrap grid" data-route="">
    <div class="hero-text">
      <div>
        <p class="label muted rv">Business cards</p>
        <h1 class="rv" style="margin-top:28px">Cards that leave a lasting <em>impression.</em></h1>
        <p class="lead muted rv">Business and brand cards <strong>pressed by hand</strong> into thick cotton paper - with <strong>a proof on WhatsApp before we print</strong>, and free delivery across India.</p>
        <div class="hero-actions rv">
          <a href="business-cards/" class="btn">See cards <svg class="i arr" aria-hidden="true">
              <use href="#i-arrow-right" />
            </svg></a>
          <a href="https://wa.me/<?= WHATSAPP ?>" class="btn line">WhatsApp us</a>
        </div>
      </div>
      <div class="hero-facts rv">
        <div><b>600 gsm</b><span>Cotton paper</span></div>
        <div><b>Multiple inks</b><span>Or blind, with no ink</span></div>
        <div><b>Custom</b><span>Designed to your brief</span></div>
      </div>
    </div>
    <div class="hero-visual">
      <div class="main hero-showcase">
        <video class="hero-media" src="assets/videos/hero.mp4" poster="assets/videos/hero-poster.jpg" data-autoplay muted loop playsinline preload="none" aria-label="Letterpress business cards from House of Press, pressed into thick cotton paper in one and two inks"></video>
      </div>
      <span class="tag">Inside House of Press</span>
    </div>
  </div>

  <!-- Clients: the names we've pressed cards for, sliding past on the black strip.
       Logos are single-colour SVGs in assets/clients, inlined so they take the strip's colour. -->
  <?php
  $clients = [
    ['google', 'Google'],
    ['apple', 'Apple'],
    ['amazon', 'Amazon'],
    ['flipkart', 'Flipkart'],
    ['ashoka-chakra', 'Govt. of India'],
  ];
  ?>
  <div class="marquee clients-strip">
    <p class="sr-only">Brands we’ve pressed cards for: <?= e(implode(', ', array_column($clients, 1))) ?>.</p>
    <div class="marquee-track" aria-hidden="true">
      <?php for ($i = 0; $i < 4; $i++): foreach ($clients as [$logo, $name]): ?>
        <span class="client-logo"><?= $logo ? file_get_contents(__DIR__ . "/assets/clients/$logo.svg") : '' ?><b><?= e($name) ?></b></span>
      <?php endforeach; endfor; ?>
    </div>
  </div>

  <!-- Products -->
  <section id="products" class="wrap" data-route="">
    <div class="sec-head grid rv">
      <p class="label">Our work</p>
      <h2>See the work. <em>Feel the press.</em></h2>
      <div class="side">
        <p>Recent cards from the studio - single and multiple inks, blind pressed, and designed to each client’s brief.</p>
        <a href="gallery/" class="text-link">View all <svg class="i" aria-hidden="true">
            <use href="#i-arrow-right" />
          </svg></a>
      </div>
    </div>
    <?php
    // The wall: card photos only, three to a column, in grid areas a–l (see .work-wall), so every
    // column ends on the same line: four columns wide, like the gallery; three on a tablet, two on
    // a phone. Photos go down the columns in turn; photo (column + 2 × row) mod 4 never matches a
    // neighbour four across, even corner to corner.
    // Each photo: [file in assets/videos, title, notes for each time it appears, crops for each time]
    $photos = [
      ['crispy-business-card.jpg', 'Crispy business card',   ['Uru Living · Blind pressed', 'Contour lines, pressed deep', 'Blind pressed into cotton', 'Deep impression, white on white'], ['center', 'center 35%', 'center 60%', 'center 20%']],
      ['sakshi-jain.jpg',          'Sakshi Jain, Architect', ['Olive-green ink on cotton', 'Shadow and impression', 'Fine lines on soft cotton', 'Olive-green ink'], ['center 40%', 'center 60%', 'center', 'center 30%']],
      ['hero-poster.jpg',          'Studio cards',           ['Orange, black and green inks', 'A spread of recent work', 'Fresh off the press', 'Cards in many inks'], ['center 30%', 'center 70%', 'center', 'center 50%']],
      ['urmil-nisar.jpg',          'Bhanu Cospack',          ['Blue ink · Our first run', 'Held up straight off the press', 'Blue ink on cotton', 'Our first ever run'], ['center 40%', 'center 55%', 'center', 'center 30%']],
    ];
    $work = [];
    $seen = [0, 0, 0, 0];
    for ($k = 0; $k < 12; $k++) {
      $p = (intdiv($k, 3) + 2 * ($k % 3)) % 4; // column, row
      [$file, $name, $notes, $crops] = $photos[$p];
      $n = $seen[$p]++ % 4;
      $work[] = [$file, $name, $notes[$n], $crops[$n]];
    }
    ?>
    <div class="work-wall">
      <?php foreach ($work as $i => [$file, $name, $note, $crop]): ?>
        <?php if ($i === 6): // third in the top row, four across: the prompt to start a card ?>
          <div class="work-cta w-g rv">
            <span class="label">Your card</span>
            <div>
              <h3>Have a design <em>in mind?</em></h3>
              <p>Send your logo, artwork or a rough idea. We’ll set it, send a proof on WhatsApp, and press it once you approve.</p>
            </div>
            <a href="contact/" class="btn paper">Start your card <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right" /></svg></a>
          </div>
          <?php continue; endif; ?>
        <button type="button" class="work-tile w-<?= chr(97 + $i) ?> rv" aria-label="View larger: <?= e($name) ?>, <?= e($note) ?>">
          <img src="assets/videos/<?= $file ?>" alt="<?= e("$name by House of Press: $note") ?>" loading="lazy" style="object-position: <?= $crop ?>">
          <span class="work-cap" aria-hidden="true"><b><?= e($name) ?></b><span class="label"><?= e($note) ?></span></span>
        </button>
      <?php endforeach; ?>
    </div>

    <!-- Lightbox, the same one the gallery page uses -->
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

  <!-- Story -->
  <section id="about" class="story" data-route="">
    <div class="wrap grid">
      <figure class="story-img rv"><video src="assets/videos/about-studio.mp4" poster="assets/videos/about-studio.jpg" data-autoplay muted loop playsinline preload="none" aria-label="Inside the House of Press letterpress studio: gloved hands set up a vintage platen press and check a printing plate against the light"></video></figure>
      <div class="story-body">
        <div class="rv">
          <p class="label">About House of Press</p>
          <h2>Pressed deep. <em>Made to last.</em></h2>
        </div>
        <div class="story-cols rv">
          <p>House of Press is a letterpress studio for business cards and brand cards. Every card is <strong>pressed by hand</strong> into thick cotton paper, <strong>one sheet at a time</strong>, so your words sit just below the surface where you can feel them.</p>
          <p class="muted">It takes longer than printing flat. That is the point. Every order starts with <strong>a proof on WhatsApp</strong>, and nothing touches the press until you approve it.</p>
        </div>
        <div class="stats rv">
          <div><b>43K+</b><span class="label">Instagram followers</span></div>
          <div><b>5K+</b><span class="label">Cards pressed</span></div>
          <div><b>1 sheet</b><span class="label">Pressed at a time</span></div>
        </div>
        <a href="about/" class="btn paper rv" style="align-self:flex-start">More about us <svg class="i arr" aria-hidden="true">
            <use href="#i-arrow-right" />
          </svg></a>
      </div>
    </div>
  </section>

  <!-- Contact -->
  <section id="enquiry-home" class="contact" data-route="">
    <div class="wrap grid">
      <div class="contact-head rv">
        <p class="label">Enquiry</p>
        <h2 style="margin-top:18px">Have a card in mind? <em>Let’s talk.</em></h2>
        <p class="lead">Prices for our standard cards are on the <a href="business-cards/">business cards page</a>. For anything custom - your own design, a special ink or a larger run - tell us here and we’ll reply on WhatsApp.</p>
        <div class="details">
          <div><span class="label">WhatsApp</span><a href="https://wa.me/<?= WHATSAPP ?>" target="_blank" rel="noopener" class="num"><?= PHONE_DISPLAY ?></a></div>
          <div><span class="label">Email</span><a href="mailto:<?= EMAIL ?>"><?= EMAIL ?></a></div>
          <div><span class="label">Instagram</span><a href="https://instagram.com/<?= INSTAGRAM ?>" target="_blank" rel="noopener">@<?= INSTAGRAM ?> <svg class="i" aria-hidden="true">
                <use href="#i-arrow-up-right" />
              </svg></a></div>
          <div><span class="label">Studio hours</span><?= nums(HOURS) ?></div>
        </div>
      </div>

      <form id="enquiry" class="rv" novalidate>
        <h3>Start an enquiry</h3>
        <div class="field-row">
          <label class="field"><span class="label">Name</span><input name="name" required autocomplete="name"></label>
          <label class="field"><span class="label">Phone</span><input name="phone" type="tel" required autocomplete="tel"></label>
        </div>
        <div class="field">
          <span class="label">Roughly how many?</span>
          <div class="chips">
            <label><input type="radio" name="qty" value="100" checked><span class="num">100</span></label>
            <label><input type="radio" name="qty" value="250"><span class="num">250</span></label>
            <label><input type="radio" name="qty" value="500"><span class="num">500</span></label>
            <label><input type="radio" name="qty" value="More than 500"><span class="num">500+</span></label>
          </div>
        </div>
        <div class="field">
          <span class="label">Finishes I like</span>
          <div class="chips">
            <label><input type="checkbox" name="finishes" value="One ink"><span>One ink</span></label>
            <label><input type="checkbox" name="finishes" value="Multiple inks"><span>Multiple inks</span></label>
            <label><input type="checkbox" name="finishes" value="Blind pressed"><span>Blind pressed</span></label>
            <label><input type="checkbox" name="finishes" value="Extra thick, painted edges"><span>Extra thick, painted edges</span></label>
          </div>
        </div>
        <label class="field"><span class="label">Tell us about it</span><textarea name="need" placeholder="e.g. Logo in one ink, name blind pressed, cards for three team members"></textarea></label>
        <div class="form-foot">
          <small>Opens WhatsApp with your message.</small>
          <button type="submit" class="btn red">Send enquiry <svg class="i arr" aria-hidden="true">
              <use href="#i-arrow-right" />
            </svg></button>
        </div>
      </form>
    </div>
  </section>

  <!-- Questions -->
  <section class="c-faq dark">
    <div class="wrap grid">
      <div class="c-faq-head rv">
        <p class="label">Questions</p>
        <h2>Before you <em>order</em>.</h2>
      </div>
      <div class="c-faq-list rv">
        <details>
          <summary>What is letterpress?<svg class="i" aria-hidden="true">
              <use href="#i-plus" />
            </svg></summary>
          <div class="faq-a">
            <p>Relief printing: a raised plate is inked and pressed into paper with real force. The words sit slightly below the surface of the card, so you can feel them with your fingertips.</p>
          </div>
        </details>
        <details>
          <summary>Will I see my card before it’s pressed?<svg class="i" aria-hidden="true">
              <use href="#i-plus" />
            </svg></summary>
          <div class="faq-a">
            <p>Yes. We send a proof to your WhatsApp. Nothing goes to press until you approve it, and you can ask for changes first.</p>
          </div>
        </details>
        <details>
          <summary>Do I need a design ready?<svg class="i" aria-hidden="true">
              <use href="#i-plus" />
            </svg></summary>
          <div class="faq-a">
            <p>No. Send your own print-ready design, or tell us what should be on the card and the studio will set it for you.</p>
          </div>
        </details>
        <details>
          <summary>Which file should I send?<svg class="i" aria-hidden="true">
              <use href="#i-plus" />
            </svg></summary>
          <div class="faq-a">
            <p>A vector PDF, AI, EPS or SVG works best, with text converted to outlines. Letterpress can’t print photographs or soft gradients, so keep the artwork to solid shapes and lines.</p>
          </div>
        </details>
        <details>
          <summary>Can you match my brand colour?<svg class="i" aria-hidden="true">
              <use href="#i-plus" />
            </svg></summary>
          <div class="faq-a">
            <p>We press in multiple house inks, or blind with no ink at all. For a specific Pantone shade, message us on WhatsApp before you order.</p>
          </div>
        </details>
        <details>
          <summary>How long does it take?<svg class="i" aria-hidden="true">
              <use href="#i-plus" />
            </svg></summary>
          <div class="faq-a">
            <p>We dispatch within <?= e(DISPATCH) ?> of your proof being approved, with free tracked delivery across India.</p>
          </div>
        </details>
        <details>
          <summary>Why does each card look slightly different?<svg class="i" aria-hidden="true">
              <use href="#i-plus" />
            </svg></summary>
          <div class="faq-a">
            <p>Each card is pressed one at a time, so the depth of the impression and the ink vary a little from card to card. That small variation is what makes letterpress feel handmade.</p>
          </div>
        </details>
      </div>
    </div>
  </section>

</main>

<?php include __DIR__ . '/partials/footer.php'; ?>