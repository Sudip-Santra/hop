<?php
// Footer + scripts. Optional: $scripts = ['products.js'] for page-specific JS.
?>
<footer>
  <div class="wrap">
    <div class="foot-grid">
      <!-- Col 1: Brand & Credentials -->
      <div class="foot-brand">
        <a href="/" class="foot-logo-link" aria-label="K K Marketing — home">
          <svg class="foot-logo-svg" role="img" aria-label="K K Marketing" viewBox="0 0 270.22 64"><use href="#brand-logo"/></svg>
        </a>
        <p class="foot-desc">Wholesale supplier &amp; trader of premium paper plates, cups, bowls, food containers and eco-friendly areca leaf plates across Goa since 2015.</p>
        <div class="foot-badges">
          <span class="foot-badge"><span class="dot"></span>Est. 2015 · Registered</span>
          <span class="foot-badge">Margao, South Goa</span>
          <span class="foot-badge">Wholesale &amp; Retail</span>
        </div>
      </div>

      <!-- Col 2: Product Catalogue -->
      <div class="foot-col">
        <h4>Catalogue</h4>
        <ul class="foot-list">
          <li><a href="<?= $base ?>products/paper-plates">Heavy-Duty Paper Plates</a></li>
          <li><a href="<?= $base ?>products/paper-cups">Chai &amp; Coffee Paper Cups</a></li>
          <li><a href="<?= $base ?>products/bowls">Ice Cream &amp; Gravy Bowls</a></li>
          <li><a href="<?= $base ?>products/areca">Areca Palm Leaf Plates</a></li>
          <li><a href="<?= $base ?>products/bowls">Dona Bowls &amp; Meal Trays</a></li>
          <li><a href="<?= $base ?>products/trays-cutlery">Bulk Custom Packs</a></li>
        </ul>
      </div>

      <!-- Col 3: Who We Supply & Links -->
      <div class="foot-col">
        <h4>Who We Supply</h4>
        <ul class="foot-list">
          <li><a href="<?= $base ?>who-we-supply">Caterers &amp; Wedding Events</a></li>
          <li><a href="<?= $base ?>who-we-supply">Hotels, Resorts &amp; Shacks</a></li>
          <li><a href="<?= $base ?>who-we-supply">Food Stalls &amp; Cafés</a></li>
          <li><a href="<?= $base ?>who-we-supply">Retail Shops &amp; Resellers</a></li>
          <li><a href="<?= $base ?>about/">About K K Marketing</a></li>
          <li><a href="<?= $base ?>contact/">Contact &amp; Enquiries</a></li>
          <li><a href="<?= $base ?>how-to-order">How Ordering Works</a></li>
        </ul>
      </div>

      <!-- Col 4: Visit & Contact -->
      <div class="foot-col">
        <h4>Visit &amp; Contact</h4>
        <div class="foot-contact-details">
          <div class="c-item">
            <b>Proprietor</b>
            <span>Mr. Kantilal Bagrecha</span>
          </div>
          <div class="c-item">
            <b>Address</b>
            <span>Shop No. 3, Seagull Apartment,<br>Pajifond, Margao, Goa 403601</span>
          </div>
          <div class="c-item">
            <b>Phone</b>
            <a href="tel:<?= PHONE_TEL ?>"><?= PHONE_DISPLAY ?></a>
          </div>
        </div>
        <div class="foot-cta-row">
          <a href="https://wa.me/<?= WHATSAPP ?>" target="_blank" rel="noopener" class="foot-btn terra-btn">WhatsApp Us <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right"/></svg></a>
          <a href="<?= MAPS_URL ?>" target="_blank" rel="noopener" class="foot-btn">Open Map <svg class="i" aria-hidden="true"><use href="#i-arrow-up-right"/></svg></a>
        </div>
      </div>
    </div>

    <!-- Bottom Bar -->
    <div class="foot-bottom">
      <div class="foot-bottom-left">
        <span>© <span id="yr"></span> K K Marketing. All rights reserved.</span>
        <span class="foot-legal">Disposable Tableware &amp; Catering Supplies · Margao, Goa, India</span>
      </div>
      <div class="foot-bottom-right">
        <a href="<?= $self ?>" class="back-top">Back to top <svg class="i" aria-hidden="true"><use href="#i-arrow-up"/></svg></a>
      </div>
    </div>
  </div>
</footer>
<script src="<?= $base ?>assets/js/main.js"></script>
<?php foreach ($scripts ?? [] as $script): ?>
<script src="<?= $base ?>assets/js/<?= $script ?>"></script>
<?php endforeach; ?>
</body>
</html>
