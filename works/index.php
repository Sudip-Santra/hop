<?php
$page        = 'works';
$base        = '../';
$title       = 'The Works - House of Press, Mumbai';
$description = 'The works of House of Press: printed matter, stationery, objects, editions and collaborations made where design meets craftsmanship. Each piece has a story.';
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

$head = [
  'slug'  => 'The Works',
  'title' => ['Objects with', 'a story to tell.'],
  'lead'  => 'Explore the works of House of Press.',
  'text'  => ['From printed matter and stationery to collaborative editions and artistic explorations, each collection represents a meeting of material, design and human skill.'],
];
// The collections: [name, what's in it, link or null while it's being made]
$collections = [
  ['Letterpress & Printed Matter', 'Business and brand cards pressed by hand into thick cotton paper.', 'business-cards/'],
  ['Stationery & Writing', 'Paper, cards and writing sets for keeping and for sending.', null],
  ['Objects & Editions', 'Made in small numbers, each one numbered and kept on record.', null],
  ['Art & Collaborations', 'Work made together with artists, designers and craftspeople.', null],
];
?>

<main>
  <?php include __DIR__ . '/../partials/page-head.php'; ?>

  <!-- The four collections; the ones still being made say so -->
  <section class="ip-collections">
    <div class="wrap">
      <ol class="ip-coll-list">
        <?php foreach ($collections as $n => [$name, $what, $href]): ?>
          <li class="ip-coll<?= $href ? '' : ' is-making' ?>">
            <span class="num"><?= sprintf('%02d', $n + 1) ?></span>
            <h2><?= e($name) ?></h2>
            <p><?= e($what) ?></p>
            <?php if ($href): ?>
              <a href="<?= $base . $href ?>" class="px-more">Discover the collection <svg class="i" aria-hidden="true"><use href="#i-arrow-right" /></svg></a>
            <?php else: ?>
              <span class="px-note" aria-label="Being made">in the making</span>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </section>

  <!-- Masonry grid -->
  <section class="g-wall">
    <div class="wrap">
      <div class="ip-wall-head">
        <div>
          <h2>From <em>the press.</em></h2>
          <p>Every piece has a purpose. Every process has a story. Select any piece to see it larger.</p>
        </div>
        <div class="g-filter chips" role="radiogroup" aria-label="Show">
          <label><input type="radio" name="show" value="all" checked><span>All</span></label>
          <label><input type="radio" name="show" value="image"><span>Photos</span></label>
          <label><input type="radio" name="show" value="video"><span>Videos</span></label>
        </div>
      </div>
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

  <?php $next = ['The People', 'people/'];
  include __DIR__ . '/../partials/page-next.php'; ?>
</main>

<!-- Lightbox -->
<dialog class="g-box" id="g-box" aria-label="Gallery viewer">
  <div class="g-box-stage" id="g-box-stage"></div>
  <div class="g-box-bar">
    <p class="g-box-cap"><b id="g-box-name"></b><span class="label" id="g-box-note"></span></p>
    <span class="label g-box-count" id="g-box-count" aria-live="polite"></span>
    <div class="g-box-nav">
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