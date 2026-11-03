<?php
$page        = 'institution';
$base        = '../';
$title       = 'The Institution - House of Press, Mumbai';
$description = 'House of Press was founded on a simple belief: human craftsmanship deserves a future. An institution in Mumbai built around the people, practices and ideas behind human-made objects.';
require_once __DIR__ . '/../partials/config.php';
include __DIR__ . '/../partials/head.php';

$head = [
  'slug'  => 'The Institution',
  'title' => ['More than a practice.', 'A belief.'],
  'lead'  => 'House of Press was founded on a simple belief: human craftsmanship deserves a future.',
  'text'  => ['We are building an institution around the people, practices and ideas that make human-made objects meaningful.'],
  'photo' => ['about1.webp', 'Freshly pressed cotton sheets drying on a wooden rack in the House of Press studio, beside jars of ink and a roller', 'left to dry, overnight'],
];
// [principle, what it means]
$principles = [
  ['Craft is King.', 'The integrity of the work comes before convenience.'],
  ['Honesty is non-negotiable.', 'We stand behind the materials, methods and people involved in every creation.'],
  ['Tradition and innovation belong together.', 'We preserve knowledge while pushing the boundaries of what is possible.'],
  ['Recognition belongs to the makers.', 'Every contribution deserves to be acknowledged.'],
  ['Legacy is built through people.', 'Our success is inseparable from the growth of those associated with us.'],
];
?>

<main>
  <?php include __DIR__ . '/../partials/page-head.php'; ?>

  <!-- What the institution does, beside a photo of the hands doing it -->
  <section class="ip-body">
    <div class="wrap ip-body-in">
      <figure class="ip-photo">
        <img src="../assets/videos/about2.webp" alt="A House of Press printer inking a block of type by hand with an orange roller" loading="lazy" width="1344" height="768">
      </figure>
      <div class="ip-text">
        <p>Our work spans print, stationery, objects, art and collaborative projects. We preserve traditional methods while exploring what they can become in the hands of contemporary designers and craftspeople.</p>
        <p>We are not interested in preserving craft as something frozen in time. We believe it must continue to evolve, be practised, challenged and experienced.</p>
        <p class="ip-pull"><span class="px-ink">Our ambition is to build something that outlives us.</span></p>
      </div>
    </div>
  </section>

  <!-- The principles, on the studio's red -->
  <section class="ip-pillars">
    <div class="wrap">
      <h2>Our <em>principles.</em></h2>
      <ol class="ip-pillar-list is-five">
        <?php foreach ($principles as $n => [$name, $means]): ?>
          <li>
            <span class="num"><?= sprintf('%02d', $n + 1) ?></span>
            <h3><?= e($name) ?></h3>
            <p><?= e($means) ?></p>
          </li>
        <?php endforeach; ?>
      </ol>
    </div>
  </section>

  <?php $next = ['The Works', 'works/'];
  include __DIR__ . '/../partials/page-next.php'; ?>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
