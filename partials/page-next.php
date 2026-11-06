<?php
/**
 * The foot of an institution page: the next room to walk into, as one large link.
 *
 * Set before including: $next = ['The Works', 'works/'];
 */
[$nextLabel, $nextHref] = $next;
?>
<nav class="ip-next" aria-label="Continue">
  <div class="wrap">
    <a href="<?= $base . $nextHref ?>">
      <span class="label">Continue to</span>
      <span class="ip-next-title"><?= e($nextLabel) ?> <svg class="i" aria-hidden="true"><use href="#i-arrow-right" /></svg></span>
    </a>
  </div>
</nav>
