<?php
$page        = 'people';
$base        = '../';
$title       = 'The People - House of Press, Mumbai';
$description = 'The designers, artists, printers, artisans and craftspeople behind the work of House of Press: a platform for recognition, opportunity and collaboration.';
require_once __DIR__ . '/../partials/config.php';
include __DIR__ . '/../partials/head.php';

$head = [
  'slug'  => 'The People',
  'title' => ['The people', 'make the work.'],
  'lead'  => 'House of Press believes that craftsmanship is inseparable from the people who practise it.',
  'text'  => [
    'This is a platform for designers, artists, printers, artisans and craftspeople whose work contributes to the world of making.',
    'We seek to create opportunities, provide recognition, facilitate collaborations and help people take their work further.',
  ],
  'photo' => ['about2.webp', 'A House of Press printer inking a block of type by hand with an orange roller', 'the hands behind it'],
];
// What every profile documents
$profile = [
  'Name and practice.',
  'Their story.',
  'Their philosophy of making.',
  'Their skills and specialisation.',
  'Their contribution to House of Press.',
  'Selected works and collaborations.',
  'Their journey and achievements.',
];
$waMaker = 'https://wa.me/' . WHATSAPP . '?text=' . rawurlencode("Hi House of Press, I'm a maker and I'd like to tell you about my work.");
?>

<main>
  <?php include __DIR__ . '/../partials/page-head.php'; ?>

  <!-- The profiles to come: what each one will hold, as a ruled ledger -->
  <section class="ip-ledger-sec">
    <div class="wrap ip-ledger-in">
      <div class="ip-sec-head">
        <h2>Every profile <em>documents.</em></h2>
        <p class="px-note">the first profiles are being written</p>
      </div>
      <ol class="ip-ledger">
        <?php foreach ($profile as $n => $item): ?>
          <li><span class="num"><?= sprintf('%02d', $n + 1) ?></span><?= e($item) ?></li>
        <?php endforeach; ?>
      </ol>
    </div>
  </section>

  <section class="ip-quote">
    <div class="wrap">
      <p class="ip-quote-text"><span class="px-ink">Make the people behind the work as discoverable and memorable as</span> <span class="px-ink px-red">the work itself.</span></p>
      <p class="ip-quote-act">Are you a designer, artist, printer or craftsperson? <a href="<?= e($waMaker) ?>" target="_blank" rel="noopener">Tell us about your work</a>.</p>
    </div>
  </section>

  <?php $next = ['The Archive', 'archive/'];
  include __DIR__ . '/../partials/page-next.php'; ?>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
