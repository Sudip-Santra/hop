<?php
// Cart: floating button (shows once something is in the cart) + right-hand drawer.
// Included on every page by footer.php; assets/js/cart.js runs it. On the checkout page
// the button is hidden by CSS, since the order summary is already on screen.
?>
<script id="hop-prices" type="application/json"><?= json_encode(['cards' => CARD_PRICES, 'design' => DESIGN_FEE, 'rush' => RUSH_FEE, 'checkout' => $base . 'checkout/', 'product' => $base . 'business-cards/']) ?></script>
<button type="button" class="cart-fab" id="cart-fab" aria-label="Open cart" aria-controls="cart" aria-expanded="false">
  <svg class="i" aria-hidden="true"><use href="#i-shopping-cart"/></svg>
  <span class="cart-count" id="cart-count">0</span>
</button>
<div class="cart-scrim" id="cart-scrim"></div>
<aside class="cart" id="cart" role="dialog" aria-modal="true" aria-labelledby="cart-title" aria-hidden="true" inert>
  <div class="cart-head">
    <div>
      <span class="label">Your cart</span>
      <h2 id="cart-title">Your <em>cards</em></h2>
    </div>
    <button type="button" class="cart-x" id="cart-close" aria-label="Close cart"><svg class="i" aria-hidden="true"><use href="#i-x"/></svg></button>
  </div>
  <ol class="cart-list" id="cart-list"></ol>
  <!-- Empty cart: a blank card, the wordmark blind pressed into it, waiting for a design -->
  <div class="cart-empty" id="cart-empty">
    <div class="cart-empty-stack" aria-hidden="true"><div class="cart-empty-card"><span>House of Press</span></div></div>
    <h3>Nothing on the press yet</h3>
    <p>Pick a quantity, send your design or have our studio set it. Your proof comes on WhatsApp before we print.</p>
    <a href="<?= $base ?>business-cards/" class="btn red">Choose your cards <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right"/></svg></a>
    <p class="label cart-empty-from">From <b class="num">₹<?= number_format(min(CARD_PRICES)) ?></b> for <b class="num"><?= array_search(min(CARD_PRICES), CARD_PRICES) ?></b> cards · free delivery</p>
  </div>
  <div class="cart-foot" id="cart-foot">
    <div class="cart-total"><span class="label">Subtotal</span><b id="cart-total">₹0</b></div>
    <p class="cart-note">Prices include GST and free delivery across India. Your proof comes on WhatsApp before we print.</p>
    <div class="cart-act">
      <button type="button" class="btn line" id="cart-clear"><svg class="i" aria-hidden="true"><use href="#i-trash-2"/></svg>Clear</button>
      <a href="<?= $base ?>checkout/" class="btn red" id="cart-checkout">Checkout <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right"/></svg></a>
    </div>
  </div>
</aside>
