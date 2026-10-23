<?php
$page        = 'contact';
$base        = '../';
$title       = 'Contact — K K Marketing, Margao';
$description = 'Contact K K Marketing in Margao, Goa: WhatsApp, call or visit the shop at Pajifond. Send your list of plates, bowls and cups for rates and stock.';
$scripts     = ['contact.js'];
include __DIR__ . '/../partials/head.php';

$waHello = 'https://wa.me/' . WHATSAPP . '?text=' . rawurlencode("Hi K K Marketing, I'd like to know more about your products.");
$mapQuery = rawurlencode('Seagull Apartment, Pajifond, Margao, Goa 403601');
?>

<main>
  <!-- Page head: title + three ways to reach us -->
  <div class="c-head wrap grid">
    <div class="c-head-text">
      <nav class="crumbs label rv" aria-label="Breadcrumb"><a href="../">Home</a><span>/</span><span aria-current="page">Contact</span></nav>
      <h1 class="rv">Send your list. <em>We’ll send rates.</em></h1>
      <p class="lead muted rv">WhatsApp is quickest. You can also call, or come by the shop at Pajifond to see the stock in person.</p>
    </div>
    <div class="c-ways rv">
      <a class="c-way is-wa" href="<?= e($waHello) ?>" target="_blank" rel="noopener">
        <span class="c-ic"><svg class="i" aria-hidden="true"><use href="#i-whatsapp"/></svg></span>
        <span class="c-way-text"><span class="label">WhatsApp</span><b>Message us</b></span>
        <svg class="i arr" aria-hidden="true"><use href="#i-arrow-up-right"/></svg>
      </a>
      <a class="c-way" href="tel:<?= PHONE_TEL ?>">
        <span class="c-ic"><svg class="i" aria-hidden="true"><use href="#i-phone"/></svg></span>
        <span class="c-way-text"><span class="label">Call</span><b><?= PHONE_DISPLAY ?></b></span>
        <svg class="i arr" aria-hidden="true"><use href="#i-arrow-up-right"/></svg>
      </a>
      <a class="c-way" href="<?= MAPS_URL ?>" target="_blank" rel="noopener">
        <span class="c-ic"><svg class="i" aria-hidden="true"><use href="#i-map-pin"/></svg></span>
        <span class="c-way-text"><span class="label">Visit</span><b>Pajifond, Margao</b></span>
        <svg class="i arr" aria-hidden="true"><use href="#i-arrow-up-right"/></svg>
      </a>
    </div>
  </div>

  <!-- Enquiry form -->
  <section class="c-enquiry">
    <div class="wrap grid">
      <div class="c-enquiry-head rv">
        <p class="label">(01) Enquiry</p>
        <h2>Tell us what you <em>need</em>.</h2>
        <p class="muted">Fill in what you know. The form opens WhatsApp with your message ready to send — nothing is stored on this website.</p>
        <ol class="c-next">
          <li><span>01</span>You send the message on WhatsApp.</li>
          <li><span>02</span>We reply with rates and what’s in stock.</li>
          <li><span>03</span>You confirm, then collect or ask about delivery.</li>
        </ol>
      </div>

      <form id="contact-form" class="c-form rv" novalidate>
        <div class="field-row">
          <label class="field"><span class="label">Name *</span><input name="name" required autocomplete="name"></label>
          <label class="field"><span class="label">Phone *</span><input name="phone" type="tel" required autocomplete="tel"></label>
        </div>

        <div class="field">
          <span class="label">I’m buying for</span>
          <div class="chips">
            <label><input type="radio" name="type" value="Catering / event" checked><span>Catering / event</span></label>
            <label><input type="radio" name="type" value="Hotel / restaurant"><span>Hotel / restaurant</span></label>
            <label><input type="radio" name="type" value="Food stall / café"><span>Stall / café</span></label>
            <label><input type="radio" name="type" value="Shop / resale"><span>Shop / resale</span></label>
            <label><input type="radio" name="type" value="Home / party"><span>Home / party</span></label>
          </div>
        </div>

        <div class="field">
          <span class="label">Products</span>
          <div class="chips">
            <label><input type="checkbox" name="products" value="Paper plates"><span>Paper plates</span></label>
            <label><input type="checkbox" name="products" value="Paper cups"><span>Paper cups</span></label>
            <label><input type="checkbox" name="products" value="Bowls & containers"><span>Bowls &amp; containers</span></label>
            <label><input type="checkbox" name="products" value="Areca leaf plates"><span>Areca leaf plates</span></label>
            <label><input type="checkbox" name="products" value="Trays & cutlery"><span>Trays &amp; cutlery</span></label>
          </div>
        </div>

        <div class="field-row">
          <div class="field">
            <span class="label">Pickup or delivery</span>
            <div class="chips">
              <label><input type="radio" name="collect" value="Pickup from the shop" checked><span>Pickup</span></label>
              <label><input type="radio" name="collect" value="Asking about delivery"><span>Ask about delivery</span></label>
            </div>
          </div>
          <div class="field dp" id="dp">
            <span class="label" id="dp-label">Needed by</span>
            <input type="hidden" name="date" id="dp-value">
            <button type="button" class="dp-field" id="dp-btn" aria-haspopup="dialog" aria-expanded="false" aria-controls="dp-pop" aria-labelledby="dp-label dp-text">
              <span id="dp-text" class="is-empty">Pick a date</span>
              <svg class="i" aria-hidden="true"><use href="#i-calendar"/></svg>
            </button>
            <div class="dp-pop" id="dp-pop" role="dialog" aria-label="Choose a date" hidden>
              <div class="dp-head">
                <button type="button" class="dp-nav" id="dp-prev" aria-label="Previous month"><svg class="i" aria-hidden="true"><use href="#i-chevron-left"/></svg></button>
                <b id="dp-month" aria-live="polite"></b>
                <button type="button" class="dp-nav" id="dp-next" aria-label="Next month"><svg class="i" aria-hidden="true"><use href="#i-chevron-right"/></svg></button>
              </div>
              <div class="dp-week label" aria-hidden="true"><span>Mo</span><span>Tu</span><span>We</span><span>Th</span><span>Fr</span><span>Sa</span><span>Su</span></div>
              <div class="dp-grid" id="dp-grid"></div>
              <div class="dp-foot">
                <button type="button" class="dp-link" id="dp-today">Today</button>
                <button type="button" class="dp-link" id="dp-clear">Clear</button>
              </div>
            </div>
          </div>
        </div>

        <label class="field"><span class="label">Area / location</span><input name="area" placeholder="e.g. Margao, Colva, Panaji"></label>
        <label class="field"><span class="label">What do you need?</span><textarea name="need" placeholder="e.g. 1,000 dinner plates, 500 curry bowls, 2,000 chai cups"></textarea></label>

        <label class="c-cart" id="c-cart" hidden>
          <input type="checkbox" name="cart" checked>
          <span>Add my cart from the products page <b id="c-cart-sum"></b></span>
        </label>

        <div class="form-foot">
          <small>Opens WhatsApp with your message.</small>
          <button type="submit" class="btn wa-btn"><svg class="i wa-i" aria-hidden="true"><use href="#i-whatsapp"/></svg>Send on WhatsApp</button>
        </div>
      </form>
    </div>
  </section>

  <!-- Visit -->
  <section class="a-visit">
    <div class="wrap grid">
      <div class="a-visit-text">
        <div class="rv">
          <p class="label">(02) Visit the shop</p>
          <h2>Come by <em>Pajifond</em>.</h2>
          <p class="lead muted">See the stock in person, check sizes and pick up your order.</p>
        </div>
        <div class="details rv">
          <div><span class="label">Address</span>Shop No. 3, Seagull Apartment,<br>Pajifond, Margao, Goa 403601</div>
          <div><span class="label">Proprietor</span>Mr Kantilal Bagrecha</div>
          <div><span class="label">Phone</span><a href="tel:<?= PHONE_TEL ?>"><?= PHONE_DISPLAY ?></a></div>
          <div><span class="label">Directions</span><a href="<?= MAPS_URL ?>" target="_blank" rel="noopener">Open in Maps <svg class="i" aria-hidden="true"><use href="#i-arrow-up-right"/></svg></a></div>
        </div>
      </div>
      <div class="a-map rv">
        <iframe title="Map: K K Marketing, Pajifond, Margao" src="https://maps.google.com/maps?q=<?= $mapQuery ?>&amp;z=16&amp;output=embed" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
      </div>
    </div>
  </section>

  <!-- Questions -->
  <section class="c-faq">
    <div class="wrap grid">
      <div class="c-faq-head rv">
        <p class="label">(03) Questions</p>
        <h2>Before you <em>order</em>.</h2>
      </div>
      <div class="c-faq-list rv">
        <details>
          <summary>How do I get a rate?<svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></summary>
          <div class="faq-a"><p>Send your list — items, sizes and quantities — on WhatsApp or through the form above. We reply with rates and what’s in stock.</p></div>
        </details>
        <details>
          <summary>Do you sell in small quantities?<svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></summary>
          <div class="faq-a"><p>Yes. We supply both bulk and retail: order by the carton for events, or pick up a few packs from the shop.</p></div>
        </details>
        <details>
          <summary>Can I see samples first?<svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></summary>
          <div class="faq-a"><p>Yes. Ask for samples before a large order, or visit the shop at Pajifond to see the products in person.</p></div>
        </details>
        <details>
          <summary>Do you deliver?<svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></summary>
          <div class="faq-a"><p>Orders can be collected from the shop in Margao. For delivery, mention your area when you send your list and we’ll let you know.</p></div>
        </details>
        <details>
          <summary>Can I pay online?<svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></summary>
          <div class="faq-a"><p>There’s no online payment on this website. Rates and payment are confirmed directly with us once you’ve sent your list.</p></div>
        </details>
        <details>
          <summary>What if the item I need isn’t listed?<svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></summary>
          <div class="faq-a"><p>Send it anyway. Tell us the item, size and quantity, and we’ll tell you if we can supply it.</p></div>
        </details>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
