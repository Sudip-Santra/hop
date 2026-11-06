<?php
$page        = 'journal';
$base        = '../';
$title       = 'The Journal - House of Press, Mumbai';
$description = 'Notes on making: the House of Press Journal explores craftsmanship, design, materials, people and the changing world of human-made objects.';
require_once __DIR__ . '/../partials/config.php';
include __DIR__ . '/../partials/head.php';

$head = [
  'slug'  => 'The Journal',
  'title' => ['Notes on', 'making.'],
  'lead'  => 'An ongoing publication exploring craftsmanship, design, materials, people and the changing world of human-made objects.',
];
// The Journal's sections: [name, what it covers]
$sections = [
  ['The Craft', 'Techniques, tools and the knowledge passed down with them.'],
  ['The Maker', 'The people at the press, the bench and the drawing board.'],
  ['The Material', 'Paper, ink, metal and wood, and where they come from.'],
  ['The Process', 'How a piece goes from an idea to something you can hold.'],
  ['The Conversation', 'Talks with designers, artists and craftspeople.'],
  ['The Experiment', 'What we tried, what worked and what we learnt.'],
];
?>

<main>
  <?php include __DIR__ . '/../partials/page-head.php'; ?>

  <!-- The sections, each a blank page waiting for its first note -->
  <section class="ip-ledger-sec">
    <div class="wrap">
      <div class="ip-sec-head">
        <h2>In <em>the Journal.</em></h2>
        <p class="px-note">first notes in preparation</p>
      </div>
      <ol class="ip-notes">
        <?php foreach ($sections as $n => [$name, $what]): ?>
          <li>
            <span class="num"><?= sprintf('%02d', $n + 1) ?></span>
            <h3><?= e($name) ?></h3>
            <p><?= e($what) ?></p>
          </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </section>

  <section class="ip-quote">
    <div class="wrap">
      <p class="ip-quote-text"><span class="px-ink">A source of knowledge and perspective, not simply</span> <span class="px-ink px-red">a showcase.</span></p>
    </div>
  </section>

  <?php $next = ['Commissions', 'commissions/'];
  include __DIR__ . '/../partials/page-next.php'; ?>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
