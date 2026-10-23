<?php
$page        = 'home';
$base        = '';
$title       = 'K K Marketing — Disposable Plates, Bowls & Cups';
$description = 'K K Marketing, Margao, Goa — supplier and trader of disposable plates, paper plates, bowls and cups since 2015. Bulk supply for caterers, hotels, restaurants, events and shops.';

// /gallery and /how-to-order open this page at that section (see .htaccess / router.php)
$sections = [
    'gallery'      => 'Gallery',
    'how-to-order' => 'How to order',
];
$slug = basename(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH));
if (isset($sections[$slug])) {
    $title = $sections[$slug] . ' — K K Marketing, Margao';
}
include __DIR__ . '/partials/head.php';
?>

<main>
  <!-- Hero -->
  <div class="hero wrap grid" data-route="">
    <div class="hero-text">
      <div>
        <p class="label muted rv">Business cards · Brand cards · Letterpress studio</p>
        <h1 class="rv" style="margin-top:20px">Cards that leave a lasting <em>impression.</em></h1>
        <p class="lead muted rv">Business and brand cards pressed by hand into thick cotton paper — with a proof on WhatsApp before we print, and free delivery across India.</p>
        <div class="hero-actions rv">
          <a href="products/" class="btn">See cards <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right"/></svg></a>
          <a href="https://wa.me/<?= WHATSAPP ?>" class="btn line">WhatsApp us</a>
        </div>
      </div>
      <div class="hero-facts rv">
        <div><b>600 gsm</b><span>Cotton paper</span></div>
        <div><b>Multiple inks</b><span>Or blind, with no ink</span></div>
        <div><b>Custom</b><span>Designed to your brief</span></div>
      </div>
    </div>
    <div class="hero-visual">
      <div class="main hero-showcase">
        <video class="hero-media" src="assets/videos/hero.mp4" poster="assets/videos/hero-poster.jpg" autoplay muted loop playsinline preload="auto" aria-label="Letterpress business cards from House of Press, pressed into thick cotton paper in one and two inks"></video>
      </div>
      <span class="tag label">Off the press</span>
      <div class="chip rv">
        <span class="label">Proof first</span>
        <p>Approve your card on WhatsApp before it touches the press.</p>
      </div>
    </div>
  </div>

  <!-- Marquee -->
  <div class="marquee" aria-hidden="true">
    <div class="marquee-track">
      <span>Business cards</span><span>Brand cards</span><span>Letterpress</span><span>Cotton paper</span><span>Blind pressed</span><span>Painted edges</span><span>Custom designs</span><span>Proof on WhatsApp</span>
      <span>Business cards</span><span>Brand cards</span><span>Letterpress</span><span>Cotton paper</span><span>Blind pressed</span><span>Painted edges</span><span>Custom designs</span><span>Proof on WhatsApp</span>
    </div>
  </div>

  <!-- Products -->
  <section id="products" class="wrap" data-route="">
    <div class="sec-head grid rv">
      <p class="label">(01) Products</p>
      <h2>Use once. <em>Serve well.</em></h2>
      <p class="side">Stocked in common sizes and packed in bulk. Ask for samples before a large order.</p>
    </div>
    <div class="grid collections">
      <a href="products/paper-plates" class="card c-lg rv">
        <figure class="ph"><img src="assets/paper-plate.jpg" alt="Stacks of printed floral buffet paper plates, fluted plates, and silver snack plates" loading="lazy"><span class="no label">01</span></figure>
        <div class="meta"><div><h3>Paper plates</h3><p>Round plates for meals, snacks and buffets, in a range of sizes.</p></div><span class="go"><svg class="i" aria-hidden="true"><use href="#i-arrow-right"/></svg></span></div>
      </a>
      <a href="products/paper-cups" class="card c-sm rv">
        <figure class="ph"><img src="assets/paper-cups.jpg" alt="Assortment of disposable paper cups for Indian chai, coffee, and beverages" loading="lazy"><span class="no label">02</span></figure>
        <div class="meta"><div><h3>Paper cups</h3><p>For tea, coffee, water and juice.</p></div><span class="go"><svg class="i" aria-hidden="true"><use href="#i-arrow-right"/></svg></span></div>
      </a>
      <a href="products/bowls" class="card c-sm rv">
        <figure class="ph"><img src="assets/paper-bowl.jpg" alt="Kraft paper curry and takeaway food bowls with lids and silver dona bowls" loading="lazy"><span class="no label">03</span></figure>
        <div class="meta"><div><h3>Bowls</h3><p>For curries, desserts and takeaway.</p></div><span class="go"><svg class="i" aria-hidden="true"><use href="#i-arrow-right"/></svg></span></div>
      </a>
      <a href="products/areca" class="card c-sm rv">
        <figure class="ph"><img src="assets/areca-plates.jpg" alt="Natural areca palm leaf plates and bowls showing organic woodgrain texture" loading="lazy"><span class="no label">04</span></figure>
        <div class="meta"><div><h3>Areca leaf plates</h3><p>Natural, sturdy, plastic-free.</p></div><span class="go"><svg class="i" aria-hidden="true"><use href="#i-arrow-right"/></svg></span></div>
      </a>
      <div class="card c-sm cta rv">
        <span class="label" style="color:var(--butter)">05 — Something else?</span>
        <div>
          <h3>Need a size or item <em>not listed?</em></h3>
          <p>Send us your list and quantities. We’ll tell you what we can supply.</p>
        </div>
        <a href="products/" class="btn paper">See all products <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right"/></svg></a>
      </div>
    </div>
  </section>

  <!-- Story -->
  <section id="about" class="story" data-route="">
    <div class="wrap grid">
      <figure class="story-img rv"><img src="assets/leaf-plates.jpg" alt="K K Marketing wholesale supply showroom in Margao, Goa" loading="lazy"></figure>
      <div class="story-body">
        <div class="rv">
          <p class="label">(02) About K K Marketing</p>
          <h2>Supplying Goa’s kitchens, caterers and celebrations <em>since 2015</em>.</h2>
        </div>
        <div class="story-cols rv">
          <p>K K Marketing is a supplier and trading company in Margao, Goa, dealing in disposable products — bowls, plates, paper plates and cups.</p>
          <p class="muted">Buy in bulk for the best rates, or pick up what you need from the shop at Pajifond. Run by Mr Kantilal Bagrecha.</p>
        </div>
        <div class="stats rv">
          <div><b>2015</b><span class="label">Registered</span></div>
          <div><b>Bulk</b><span class="label">Carton orders</span></div>
          <div><b>Goa</b><span class="label">Based in Margao</span></div>
        </div>
        <a href="about/" class="btn paper rv" style="align-self:flex-start">More about us <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right"/></svg></a>
      </div>
    </div>
  </section>

  <!-- Clients -->
  <section id="gallery" class="clients" data-route="gallery">
    <div class="wrap">
      <div class="sec-head grid rv">
        <p class="label">(03) Who we supply</p>
        <h2>From a house party to <em>a thousand guests</em>.</h2>
        <p class="side">Steady stock, so your next order matches the last one.</p>
      </div>
      <div class="grid client-list">
        <div class="client rv"><h3>Caterers &amp; events</h3><p class="muted">Weddings, functions and large gatherings.</p></div>
        <div class="client rv"><h3>Hotels &amp; restaurants</h3><p class="muted">Takeaway, room service and staff meals.</p></div>
        <div class="client rv"><h3>Food stalls &amp; cafés</h3><p class="muted">Everyday cups, plates and bowls.</p></div>
        <div class="client rv"><h3>Shops &amp; resellers</h3><p class="muted">Bulk stock to sell on.</p></div>
      </div>
    </div>
  </section>

  <!-- Process -->
  <section id="how-to-order" class="wrap" data-route="how-to-order">
    <div class="sec-head grid rv">
      <p class="label">(04) How to order</p>
      <h2>Four steps, <em>no fuss</em>.</h2>
      <p class="side">Call, WhatsApp or walk in — whatever is quickest for you.</p>
    </div>
    <div class="grid steps">
      <div class="step rv"><span class="n">01</span><h3>Send your list</h3><p>Items, sizes and how many — plates, bowls, cups.</p></div>
      <div class="step rv"><span class="n">02</span><h3>Get a rate</h3><p>We reply with prices and what’s in stock.</p></div>
      <div class="step rv"><span class="n">03</span><h3>Confirm</h3><p>Lock in quantities and a pick-up or delivery time.</p></div>
      <div class="step rv"><span class="n">04</span><h3>Collect &amp; reorder</h3><p>Collect from Margao or ask about delivery. Reorder anytime.</p></div>
    </div>
  </section>

  <!-- Contact -->
  <section id="enquiry-home" class="contact" data-route="">
    <div class="wrap grid">
      <div class="contact-head rv">
        <p class="label">(05) Enquiry</p>
        <h2 style="margin-top:18px">Planning an event? <em>Let’s talk.</em></h2>
        <p class="lead">Tell us what you need. We’ll reply on WhatsApp with rates and availability.</p>
        <!-- TODO: add real phone number -->
        <div class="details">
          <div><span class="label">Contact</span>Mr Kantilal Bagrecha</div>
          <div><span class="label">Phone</span><a href="tel:<?= PHONE_TEL ?>"><?= PHONE_DISPLAY ?></a></div>
          <div><span class="label">Visit</span>Shop No. 3, Seagull Apartment,<br>Pajifond, Margao, Goa 403601</div>
          <div><span class="label">Directions</span><a href="<?= MAPS_URL ?>" target="_blank" rel="noopener">Open in Maps <svg class="i" aria-hidden="true"><use href="#i-arrow-up-right"/></svg></a></div>
        </div>
      </div>

      <form id="enquiry" class="rv" novalidate>
        <h3>Ask for a rate</h3>
        <div class="field-row">
          <label class="field"><span class="label">Name</span><input name="name" required autocomplete="name"></label>
          <label class="field"><span class="label">Phone</span><input name="phone" type="tel" required autocomplete="tel"></label>
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
        <label class="field"><span class="label">What do you need?</span><textarea name="need" placeholder="e.g. 1,000 paper plates, 500 bowls, 2,000 tea cups"></textarea></label>
        <div class="form-foot">
          <small>Opens WhatsApp with your message.</small>
          <button type="submit" class="btn red">Send enquiry <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right"/></svg></button>
        </div>
      </form>
    </div>
  </section>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>
