<?php
/**
 * The head of an institution page, pressed into cotton like the home page: a slug, the title in
 * pressed ink (the last line in red), the introduction, and optionally a photo taped to the sheet
 * with a red-pencil note.
 *
 * Set before including:
 *   $head = [
 *     'slug'  => 'The Institution',
 *     'title' => ['More than a practice.', 'A belief.'],   // one span per line; the last is red
 *     'lead'  => 'The first paragraph, set larger.',
 *     'text'  => ['Further paragraphs.', ...],              // optional
 *     'photo' => ['about1.webp', 'Alt text', 'note'],       // optional, from assets/videos
 *   ];
 *
 * Example: 'title' => ['Notes on', 'making.'] → "Notes on" in black ink, "making." in red
 */
$lines = $head['title'];
$last  = count($lines) - 1;
?>
<div class="ip-head">
  <div class="wrap ip-head-in<?= empty($head['photo']) ? '' : ' has-photo' ?>">
    <p class="px-slug"><?= e($head['slug']) ?></p>
    <h1 class="ip-title">
      <?php foreach ($lines as $i => $line): ?>
        <span class="px-ink<?= $i === $last ? ' px-red' : '' ?>"><?= e($line) ?></span>
      <?php endforeach; ?>
    </h1>
    <div class="ip-intro">
      <p class="ip-lead"><?= e($head['lead']) ?></p>
      <?php foreach ($head['text'] ?? [] as $p): ?>
        <p><?= e($p) ?></p>
      <?php endforeach; ?>
    </div>
    <?php if (!empty($head['photo'])): [$file, $alt, $note] = $head['photo']; ?>
      <figure class="px-pinned ip-pinned">
        <span class="px-tape" aria-hidden="true"></span>
        <img src="<?= $base ?>assets/videos/<?= $file ?>" alt="<?= e($alt) ?>" fetchpriority="high">
        <figcaption class="px-note" aria-hidden="true"><?= e($note) ?></figcaption>
      </figure>
    <?php endif; ?>
  </div>
</div>
