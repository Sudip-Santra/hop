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
      <p class="label">(01) Our work</p>
      <h2>See the work. <em>Feel the press.</em></h2>
      <div class="side">
        <p>Recent cards from the studio — single and multiple inks, blind pressed, and designed to each client’s brief.</p>
        <a href="gallery" class="text-link">View all <svg class="i" aria-hidden="true"><use href="#i-arrow-right"/></svg></a>
      </div>
    </div>
    <div class="grid collections">
      <a href="gallery" class="card c-lg rv">
        <figure class="ph"><video src="assets/videos/crispy-business-card.mp4" poster="assets/videos/crispy-business-card.jpg" autoplay muted loop playsinline preload="metadata" aria-label="Crispy business card by House of Press: a contour-line pattern blind letterpressed into thick white cotton paper, with the name printed in black ink"></video><span class="no label">01</span></figure>
        <div class="meta"><div><h3>Crispy business card</h3><p>For Uru Living: contour lines blind pressed deep into cotton, the details in a single black ink.</p></div><span class="go"><svg class="i" aria-hidden="true"><use href="#i-arrow-right"/></svg></span></div>
      </a>
      <a href="gallery" class="card c-sm rv">
        <figure class="ph"><img src="assets/videos/sakshi-jain.jpg" alt="Sakshi Jain architect business card by House of Press, letterpressed in olive-green ink on thick white cotton paper" loading="lazy"><span class="no label">02</span></figure>
        <div class="meta"><div><h3>Sakshi Jain, Architect</h3><p>Olive-green ink, crisp lines on soft cotton.</p></div><span class="go"><svg class="i" aria-hidden="true"><use href="#i-arrow-right"/></svg></span></div>
      </a>
      <a href="gallery" class="card c-sm rv">
        <figure class="ph"><img src="assets/videos/urmil-nisar.jpg" alt="Bhanu Cospack business card for Urmil Nisar, letterpressed in blue ink on cotton paper and held up straight off the House of Press press" loading="lazy"><span class="no label">03</span></figure>
        <div class="meta"><div><h3>Bhanu Cospack</h3><p>Our first ever run, pressed in blue.</p></div><span class="go"><svg class="i" aria-hidden="true"><use href="#i-arrow-right"/></svg></span></div>
      </a>
      <a href="gallery" class="card c-sm rv">
        <figure class="ph"><img src="assets/videos/hero-poster.jpg" alt="Letterpress business cards by House of Press laid out together, pressed in orange, black and green inks on white cotton paper" loading="lazy"><span class="no label">04</span></figure>
        <div class="meta"><div><h3>Studio cards</h3><p>Orange, black and green, fresh off the press.</p></div><span class="go"><svg class="i" aria-hidden="true"><use href="#i-arrow-right"/></svg></span></div>
      </a>
      <div class="card c-sm cta rv">
        <span class="label" style="color:var(--butter)">05 — Your card</span>
        <div>
          <h3>Have a design <em>in mind?</em></h3>
          <p>Send your logo, artwork or a rough idea. We’ll set it, send a proof on WhatsApp, and press it once you approve.</p>
        </div>
        <a href="contact/" class="btn paper">Start your card <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right"/></svg></a>
      </div>
    </div>
  </section>

  <!-- Story -->
  <section id="about" class="story" data-route="">
    <div class="wrap grid">
      <figure class="story-img rv"><video src="assets/videos/about-studio.mp4" poster="assets/videos/about-studio.jpg" autoplay muted loop playsinline preload="metadata" aria-label="Inside the House of Press letterpress studio: gloved hands set up a vintage platen press and check a printing plate against the light"></video></figure>
      <div class="story-body">
        <div class="rv">
          <p class="label">(02) About House of Press</p>
          <h2>In a hurry? <em>Not the place for you.</em></h2>
        </div>
        <div class="story-cols rv">
          <p>House of Press is a letterpress studio for business cards and brand cards. Every card is pressed by hand into thick cotton paper, one sheet at a time, so your words sit just below the surface where you can feel them.</p>
          <p class="muted">It takes longer than printing flat. That is the point. Every order starts with a proof on WhatsApp, and nothing touches the press until you approve it.</p>
        </div>
        <div class="stats rv">
          <div><b>40K+</b><span class="label">Instagram followers</span></div>
          <div><b>600 gsm</b><span class="label">Cotton paper</span></div>
          <div><b>1 sheet</b><span class="label">Pressed at a time</span></div>
        </div>
        <a href="about/" class="btn paper rv" style="align-self:flex-start">More about us <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right"/></svg></a>
      </div>
    </div>
  </section>

  <!-- Clients -->
  <section id="gallery" class="clients" data-route="gallery">
    <div class="wrap">
      <div class="sec-head grid rv">
        <p class="label">(03) Who we press for</p>
        <h2>Pressed for people who <em>notice</em>.</h2>
        <p class="side">Same paper, same inks, same press, so your next box matches the last one.</p>
      </div>
      <div class="grid client-list">
        <div class="client rv"><h3>Founders &amp; businesses</h3><p class="muted">A card that says you’re here to stay.</p></div>
        <div class="client rv"><h3>Architects &amp; designers</h3><p class="muted">Clean lines, pressed as precisely as you draw them.</p></div>
        <div class="client rv"><h3>Studios &amp; agencies</h3><p class="muted">Cards for the whole team, in one run.</p></div>
        <div class="client rv"><h3>Brands &amp; makers</h3><p class="muted">Brand cards and notes that carry your mark.</p></div>
      </div>
    </div>
  </section>

  <!-- Process -->
  <section id="how-to-order" class="wrap" data-route="how-to-order">
    <div class="sec-head grid rv">
      <p class="label">(04) How to order</p>
      <h2>Four steps, <em>no rush</em>.</h2>
      <p class="side">Message us on WhatsApp or send an enquiry — we’ll take it from there.</p>
    </div>
    <div class="grid steps">
      <div class="step rv"><span class="n">01</span><h3>Choose your card</h3><p>Pick a style and quantity, or send us your own design.</p></div>
      <div class="step rv"><span class="n">02</span><h3>Approve your proof</h3><p>We send a proof on WhatsApp. Nothing moves until you say yes.</p></div>
      <div class="step rv"><span class="n">03</span><h3>We press it</h3><p>Ink mixed for your order, each sheet pressed by hand, one at a time.</p></div>
      <div class="step rv"><span class="n">04</span><h3>Delivered to you</h3><p>Trimmed, checked and sent with tracking, free across India.</p></div>
    </div>
  </section>

  <!-- Contact -->
  <section id="enquiry-home" class="contact" data-route="">
    <div class="wrap grid">
      <div class="contact-head rv">
        <p class="label">(05) Enquiry</p>
        <h2 style="margin-top:18px">Have a card in mind? <em>Let’s talk.</em></h2>
        <p class="lead">Prices for our standard cards are on the business cards page. For anything custom — your own design, a special ink or a larger run — tell us here and we’ll reply on WhatsApp.</p>
        <div class="details">
          <div><span class="label">WhatsApp</span><a href="https://wa.me/<?= WHATSAPP ?>" target="_blank" rel="noopener"><?= PHONE_DISPLAY ?></a></div>
          <div><span class="label">Email</span><a href="mailto:<?= EMAIL ?>"><?= EMAIL ?></a></div>
          <div><span class="label">Instagram</span><a href="https://instagram.com/<?= INSTAGRAM ?>" target="_blank" rel="noopener">@<?= INSTAGRAM ?> <svg class="i" aria-hidden="true"><use href="#i-arrow-up-right"/></svg></a></div>
          <div><span class="label">Studio hours</span><?= e(HOURS) ?></div>
        </div>
      </div>

      <form id="enquiry" class="rv" novalidate>
        <h3>Start an enquiry</h3>
        <div class="field-row">
          <label class="field"><span class="label">Name</span><input name="name" required autocomplete="name"></label>
          <label class="field"><span class="label">Phone</span><input name="phone" type="tel" required autocomplete="tel"></label>
        </div>
        <div class="field">
          <span class="label">I’m looking for</span>
          <div class="chips">
            <label><input type="radio" name="type" value="Business cards" checked><span>Business cards</span></label>
            <label><input type="radio" name="type" value="Brand cards"><span>Brand cards</span></label>
            <label><input type="radio" name="type" value="A custom design"><span>Custom design</span></label>
            <label><input type="radio" name="type" value="Something else"><span>Something else</span></label>
          </div>
        </div>
        <div class="field">
          <span class="label">Roughly how many?</span>
          <div class="chips">
            <label><input type="radio" name="qty" value="100" checked><span>100</span></label>
            <label><input type="radio" name="qty" value="250"><span>250</span></label>
            <label><input type="radio" name="qty" value="500"><span>500</span></label>
            <label><input type="radio" name="qty" value="More than 500"><span>500+</span></label>
          </div>
        </div>
        <label class="field"><span class="label">Tell us about it</span><textarea name="need" placeholder="e.g. Logo in one ink, name blind pressed, cards for three team members"></textarea></label>
        <div class="form-foot">
          <small>Opens WhatsApp with your message.</small>
          <button type="submit" class="btn red">Send enquiry <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right"/></svg></button>
        </div>
      </form>
    </div>
  </section>
</main>

<?php include __DIR__ . '/partials/footer.php'; ?>
