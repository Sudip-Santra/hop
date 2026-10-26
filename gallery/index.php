<?php
$page        = 'gallery';
$base        = '../';
$title       = 'Gallery - House of Press, letterpress business cards';
$description = 'Letterpress business and brand cards by House of Press, pressed by hand into thick cotton paper, and a look inside the studio where they are made.';
$scripts     = ['gallery.js'];
include __DIR__ . '/../partials/head.php';

// Each piece: [type, file in assets/videos (without extension), title, note, shape, crop]
// Shape sets the tile's proportions, so the same piece can appear more than once and still
// look different in the grid. Crop is the object-position for that tile. The five subjects
// take turns, so a repeat never lands next to itself.
$v = $base . 'assets/videos/';
$pieces = [
  ['video', 'crispy-business-card', 'Crispy business card',   'Uru Living · Blind pressed',     'tall',     'center'],
  ['image', 'sakshi-jain',          'Sakshi Jain, Architect', 'Olive-green ink',                'portrait', 'center'],
  ['image', 'hero-poster',          'Studio cards',           'Orange, black and green inks',   'square',   'center'],
  ['video', 'about-studio',         'Inside the studio',      'The platen press',               'classic',  'center'],
  ['image', 'urmil-nisar',          'Bhanu Cospack',          'Blue ink · Our first run',       'portrait', 'center'],
  ['image', 'crispy-business-card', 'Crispy business card',   'Contour lines, pressed deep',    'square',   'center 40%'],
  ['image', 'sakshi-jain',          'Sakshi Jain, Architect', 'Fine lines on soft cotton',      'classic',  'center 35%'],
  ['video', 'hero',                 'Fresh off the press',    'Cards in multiple inks',         'tall',     'center'],
  ['image', 'about-studio',         'Setting the press',      'Every sheet fed by hand',        'portrait', 'center'],
  ['image', 'urmil-nisar',          'Bhanu Cospack',          'Blue ink on cotton',             'square',   'center 45%'],
  ['video', 'crispy-business-card', 'Crispy business card',   'Uru Living · Blind pressed',     'portrait', 'center 30%'],
  ['image', 'sakshi-jain',          'Sakshi Jain, Architect', 'Olive-green ink',                'square',   'center 60%'],
  ['image', 'hero-poster',          'Studio cards',           'A spread of recent work',        'classic',  'left center'],
  ['video', 'about-studio',         'Inside the studio',      'Checking the plate',             'tall',     'center'],
  ['image', 'urmil-nisar',          'Bhanu Cospack',          'Held up straight off the press', 'classic',  'center'],
  ['image', 'crispy-business-card', 'Crispy business card',   'Blind pressed into cotton',      'portrait', 'center 55%'],
  ['image', 'sakshi-jain',          'Sakshi Jain, Architect', 'Shadow and impression',          'tall',     'center'],
  ['video', 'hero',                 'Fresh off the press',    'Cards in multiple inks',         'portrait', 'center 40%'],
];
// Still image for each file; videos use theirs as the poster. Most are <file>.jpg.
$images = ['hero' => 'hero-poster.jpg'];
?>

<main>
  <!-- Page head -->
  <div class="g-head wrap grid">
    <div class="g-head-text">
      <nav class="crumbs label rv" aria-label="Breadcrumb"><a href="../">Home</a><span>/</span><span aria-current="page">Gallery</span></nav>
      <h1 class="rv">Cards from <em>the press</em>.</h1>
      <p class="lead muted rv">Recent business and brand cards, and the studio where they’re made. Select any piece to see it larger.</p>
    </div>
    <div class="g-filter chips rv" role="radiogroup" aria-label="Show">
      <label><input type="radio" name="show" value="all" checked><span>All</span></label>
      <label><input type="radio" name="show" value="image"><span>Photos</span></label>
      <label><input type="radio" name="show" value="video"><span>Videos</span></label>
    </div>
  </div>

  <!-- Masonry grid -->
  <section class="g-wall">
    <div class="wrap">
      <div class="g-grid">
        <?php foreach ($pieces as $i => [$type, $file, $name, $note, $shape, $crop]):
          $poster = $v . ($images[$file] ?? $file . '.jpg');
          $alt = "$name by House of Press: $note";
        ?>
          <div class="g-item g-<?= $shape ?>" data-type="<?= $type ?>" data-shape="<?= $shape ?>" data-file="<?= $file ?>">
            <button type="button" class="g-open" data-index="<?= $i ?>" aria-label="View larger: <?= e($name) ?>, <?= e($note) ?>">
              <?php if ($type === 'video'): ?>
                <video src="<?= $v . $file ?>.mp4" poster="<?= $poster ?>" muted loop playsinline preload="none" style="object-position: <?= $crop ?>" aria-hidden="true"></video>
                <span class="g-play label" aria-hidden="true">Video</span>
              <?php else: ?>
                <img src="<?= $poster ?>" alt="<?= e($alt) ?>" loading="lazy" style="object-position: <?= $crop ?>">
              <?php endif; ?>
              <span class="g-cap" aria-hidden="true"><b><?= e($name) ?></b><span class="label"><?= e($note) ?></span></span>
            </button>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <!-- Closing prompt -->
  <section class="g-end">
    <div class="wrap">
      <div class="g-end-main grid">
        <div class="g-end-text rv">
          <p class="label">Your card next</p>
          <h2>Have a design <em>in mind?</em></h2>
        </div>
        <div class="g-end-act rv">
          <p>Send your logo, artwork or a rough idea. We’ll set it, send a proof on WhatsApp, and press it once you approve.</p>
          <div class="g-end-btns">
            <a href="../contact/" class="btn red">Start your card <svg class="i arr" aria-hidden="true">
                <use href="#i-arrow-right" />
              </svg></a>
            <a href="https://wa.me/<?= WHATSAPP ?>?text=<?= rawurlencode("Hi House of Press, I'd like to talk about a card design.") ?>" class="btn line" target="_blank" rel="noopener"><svg class="i wa-i" aria-hidden="true">
                <use href="#i-whatsapp" />
              </svg>WhatsApp us</a>
          </div>
        </div>
      </div>
      <ol class="g-end-steps rv">
        <li><span class="label">01</span><b>Send your idea</b><span>A logo, artwork or a rough sketch.</span></li>
        <li><span class="label">02</span><b>Approve the proof</b><span>On WhatsApp, before anything is pressed.</span></li>
        <li><span class="label">03</span><b>We press and deliver</b><span>By hand, free across India.</span></li>
      </ol>
    </div>
  </section>
</main>

<!-- Lightbox -->
<dialog class="g-box" id="g-box" aria-label="Gallery viewer">
  <div class="g-box-stage" id="g-box-stage"></div>
  <div class="g-box-bar">
    <p class="g-box-cap"><b id="g-box-name"></b><span class="label" id="g-box-note"></span></p>
    <div class="g-box-nav">
      <span class="label" id="g-box-count" aria-live="polite"></span>
      <button type="button" id="g-box-prev" aria-label="Previous"><svg class="i" aria-hidden="true">
          <use href="#i-chevron-left" />
        </svg></button>
      <button type="button" id="g-box-next" aria-label="Next"><svg class="i" aria-hidden="true">
          <use href="#i-chevron-right" />
        </svg></button>
      <button type="button" id="g-box-close" aria-label="Close"><svg class="i" aria-hidden="true">
          <use href="#i-x" />
        </svg></button>
    </div>
  </div>
</dialog>

<?php include __DIR__ . '/../partials/footer.php'; ?>