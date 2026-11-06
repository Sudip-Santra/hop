<?php
/**
 * Body of a legal page: head, a contents list that stays in view, and the sections.
 * Expects: $legalTitle (HTML, may hold <em>), $legalLead, $updated (e.g. '24 October 2026'),
 *          $sections, a list of [id, heading, body HTML].
 */

// Set by the page that includes this file
/** @var string $legalTitle */
/** @var string $legalLead */
/** @var string $updated */
/** @var array<int, array{0: string, 1: string, 2: string}> $sections */
?>
<main class="lg">
  <div class="lg-head wrap">
    <nav class="crumbs label rv" aria-label="Breadcrumb"><a href="../">Home</a><span>/</span><span aria-current="page"><?= e(html_entity_decode(strip_tags($legalTitle))) ?></span></nav>
    <h1 class="rv"><?= $legalTitle ?></h1>
    <p class="lead muted rv"><?= e($legalLead) ?></p>
    <p class="label muted lg-updated rv">Last updated <?= nums($updated) ?></p>
  </div>

  <div class="lg-body wrap grid">
    <nav class="lg-toc" aria-label="On this page">
      <p class="label">On this page</p>
      <ol>
<?php foreach ($sections as $i => [$id, $heading]): ?>
        <li><a href="#<?= $id ?>"><span class="label"><?= sprintf('%02d', $i + 1) ?></span><?= e($heading) ?></a></li>
<?php endforeach; ?>
      </ol>
    </nav>
    <div class="lg-text">
<?php foreach ($sections as [$id, $heading, $body]): ?>
      <section id="<?= $id ?>">
        <h2><?= e($heading) ?></h2>
        <?= $body ?>

      </section>
<?php endforeach; ?>
      <aside class="lg-ask">
        <p>Questions about this page? Write to us on <a href="https://wa.me/<?= WHATSAPP ?>">WhatsApp</a>, call <a href="tel:<?= PHONE_TEL ?>"><?= PHONE_DISPLAY ?></a> or email <a href="mailto:<?= EMAIL ?>"><?= EMAIL ?></a>.</p>
      </aside>
    </div>
  </div>
</main>
