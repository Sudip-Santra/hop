<?php
$page        = 'archive';
$base        = '../';
$title       = 'The Archive - House of Press, Mumbai';
$description = 'The House of Press Archive: a growing record of craftsmanship, techniques, materials, people and contributions, kept for future generations of makers.';
require_once __DIR__ . '/../partials/config.php';
include __DIR__ . '/../partials/head.php';

$head = [
  'slug'  => 'The Archive',
  'title' => ['A record of what we make.', 'And who makes it possible.'],
  'lead'  => 'The House of Press Archive is a growing record of craftsmanship, creative thought, techniques, people and contributions.',
  'text'  => ['It is intended to become a resource for future generations of designers, artists and craftspeople.'],
];
// What the archive documents
$records = [
  'People and their contributions.',
  'Historical printing techniques.',
  'Materials and processes.',
  'Collections and editions.',
  'Collaborations.',
  'Experiments and discoveries.',
  'Milestones in the history of House of Press.',
];
?>

<main>
  <?php include __DIR__ . '/../partials/page-head.php'; ?>

  <section class="ip-ledger-sec">
    <div class="wrap ip-ledger-in">
      <div class="ip-sec-head">
        <h2>The archive <em>will document.</em></h2>
        <p class="px-note">the first entries are being filed</p>
      </div>
      <ol class="ip-ledger">
        <?php foreach ($records as $n => $item): ?>
          <li><span class="num"><?= sprintf('%02d', $n + 1) ?></span><?= e($item) ?></li>
        <?php endforeach; ?>
      </ol>
    </div>
  </section>

  <section class="ip-quote">
    <div class="wrap">
      <p class="ip-quote-text"><span class="px-ink">An institution is remembered not only for what it creates, but for</span> <span class="px-ink px-red">what it preserves.</span></p>
    </div>
  </section>

  <?php $next = ['The Journal', 'journal/'];
  include __DIR__ . '/../partials/page-next.php'; ?>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
