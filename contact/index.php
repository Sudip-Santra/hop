<?php
$page        = 'contact';
$base        = '../';
$title       = 'Contact — House of Press, letterpress business cards';
$description = 'Contact House of Press about letterpress business and brand cards: WhatsApp, call, email or Instagram. Tell us about your card and we’ll reply with options and a proof.';
$scripts     = ['contact.js'];
include __DIR__ . '/../partials/head.php';

$waHello = 'https://wa.me/' . WHATSAPP . '?text=' . rawurlencode("Hi House of Press, I'd like to know more about your business cards.");
$instagramUrl = 'https://instagram.com/' . INSTAGRAM;
?>

<main>
  <!-- Page head: title + three ways to reach us -->
  <div class="c-head wrap grid">
    <div class="c-head-text">
      <nav class="crumbs label rv" aria-label="Breadcrumb"><a href="../">Home</a><span>/</span><span aria-current="page">Contact</span></nav>
      <h1 class="rv">Tell us about your card. <em>We’ll press it.</em></h1>
      <p class="lead muted rv">WhatsApp is quickest. You can also call, email, or message the studio on Instagram.</p>
    </div>
    <div class="c-ways rv">
      <a class="c-way" href="<?= e($waHello) ?>" target="_blank" rel="noopener">
        <span class="c-ic"><svg class="i" aria-hidden="true"><use href="#i-whatsapp"/></svg></span>
        <span class="c-way-text"><span class="label">WhatsApp</span><b>Message us</b></span>
        <svg class="i arr" aria-hidden="true"><use href="#i-arrow-up-right"/></svg>
      </a>
      <a class="c-way" href="tel:<?= PHONE_TEL ?>">
        <span class="c-ic"><svg class="i" aria-hidden="true"><use href="#i-phone"/></svg></span>
        <span class="c-way-text"><span class="label">Call</span><b><?= PHONE_DISPLAY ?></b></span>
        <svg class="i arr" aria-hidden="true"><use href="#i-arrow-up-right"/></svg>
      </a>
      <a class="c-way" href="<?= $instagramUrl ?>" target="_blank" rel="noopener">
        <span class="c-ic"><svg class="i" aria-hidden="true"><use href="#i-instagram"/></svg></span>
        <span class="c-way-text"><span class="label">Instagram</span><b>@<?= INSTAGRAM ?></b></span>
        <svg class="i arr" aria-hidden="true"><use href="#i-arrow-up-right"/></svg>
      </a>
    </div>
  </div>

  <!-- Enquiry form -->
  <section class="c-enquiry">
    <div class="wrap grid">
      <div class="c-enquiry-head rv">
        <p class="label">(01) Enquiry</p>
        <h2>Tell us about your <em>card</em>.</h2>
        <p class="muted">Fill in what you know. The form opens WhatsApp with your message ready to send — nothing is stored on this website.</p>
        <ol class="c-next">
          <li><span>01</span>You send the message on WhatsApp.</li>
          <li><span>02</span>We reply with options and set your proof.</li>
          <li><span>03</span>You approve, we press and deliver.</li>
        </ol>
      </div>

      <form id="contact-form" class="c-form rv" novalidate>
        <div class="field-row">
          <label class="field"><span class="label">Name *</span><input name="name" required autocomplete="name"></label>
          <label class="field"><span class="label">Phone *</span><input name="phone" type="tel" required autocomplete="tel"></label>
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
          <span class="label">Finishes I like</span>
          <div class="chips">
            <label><input type="checkbox" name="finishes" value="One ink"><span>One ink</span></label>
            <label><input type="checkbox" name="finishes" value="Multiple inks"><span>Multiple inks</span></label>
            <label><input type="checkbox" name="finishes" value="Blind pressed"><span>Blind pressed</span></label>
            <label><input type="checkbox" name="finishes" value="Extra thick, painted edges"><span>Extra thick, painted edges</span></label>
          </div>
        </div>

        <div class="field-row">
          <div class="field">
            <span class="label">Roughly how many?</span>
            <div class="chips">
              <label><input type="radio" name="qty" value="100" checked><span>100</span></label>
              <label><input type="radio" name="qty" value="250"><span>250</span></label>
              <label><input type="radio" name="qty" value="500"><span>500</span></label>
              <label><input type="radio" name="qty" value="More than 500"><span>500+</span></label>
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

        <label class="field"><span class="label">City</span><input name="area" placeholder="e.g. Mumbai, Bengaluru, Pune" autocomplete="address-level2"></label>
        <label class="field"><span class="label">Tell us about it</span><textarea name="need" placeholder="e.g. Logo in one ink, name blind pressed, cards for three team members"></textarea></label>

        <div class="form-foot">
          <small>Opens WhatsApp with your message.</small>
          <button type="submit" class="btn wa-btn"><svg class="i wa-i" aria-hidden="true"><use href="#i-whatsapp"/></svg>Send on WhatsApp</button>
        </div>
      </form>
    </div>
  </section>

  <!-- The studio -->
  <section class="a-visit">
    <div class="wrap grid">
      <div class="a-visit-text">
        <div class="rv">
          <p class="label">(02) The studio</p>
          <h2>Come by <em>the press</em>.</h2>
          <p class="lead muted">See the paper, feel the cards and talk through your design. We deliver free across India too.</p>
        </div>
        <div class="details rv">
          <div><span class="label">Address</span><?= ADDRESS_1 ?><br><?= ADDRESS_2 ?></div>
          <div><span class="label">Studio hours</span><?= e(HOURS) ?></div>
          <div><span class="label">Phone</span><a href="tel:<?= PHONE_TEL ?>"><?= PHONE_DISPLAY ?></a></div>
          <div><span class="label">Email</span><a href="mailto:<?= EMAIL ?>"><?= EMAIL ?></a></div>
        </div>
      </div>
      <div class="a-map rv">
        <iframe title="Map: House of Press, Andheri East, Mumbai" src="<?= MAPS_EMBED ?>" loading="lazy" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
      </div>
    </div>
  </section>

  <!-- Questions -->
  <section class="c-faq dark">
    <div class="wrap grid">
      <div class="c-faq-head rv">
        <p class="label">(03) Questions</p>
        <h2>Before you <em>order</em>.</h2>
      </div>
      <div class="c-faq-list rv" data-batch="6">
        <details>
          <summary>What is letterpress?<svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></summary>
          <div class="faq-a"><p>Relief printing: a raised plate is inked and pressed into paper with real force. The words sit slightly below the surface of the card, so you can feel them with your fingertips.</p></div>
        </details>
        <details>
          <summary>Will I see my card before it’s pressed?<svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></summary>
          <div class="faq-a"><p>Yes. We send a proof to your WhatsApp. Nothing goes to press until you approve it, and you can ask for changes first.</p></div>
        </details>
        <details>
          <summary>Do I need a design ready?<svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></summary>
          <div class="faq-a"><p>No. Send your own print-ready design, or tell us what should be on the card and the studio will set it for you.</p></div>
        </details>
        <details>
          <summary>Which file should I send?<svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></summary>
          <div class="faq-a"><p>A vector PDF, AI, EPS or SVG works best, with text converted to outlines. Letterpress can’t print photographs or soft gradients, so keep the artwork to solid shapes and lines.</p></div>
        </details>
        <details>
          <summary>Can you match my brand colour?<svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></summary>
          <div class="faq-a"><p>We press in multiple house inks, or blind with no ink at all. For a specific Pantone shade, message us on WhatsApp before you order.</p></div>
        </details>
        <details>
          <summary>How long does it take?<svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></summary>
          <div class="faq-a"><p>We dispatch within <?= e(DISPATCH) ?> of your proof being approved, with free tracked delivery across India.</p></div>
        </details>
        <details>
          <summary>What size are the cards?<svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></summary>
          <div class="faq-a"><p>Every card is 89 × 51 mm, the standard business-card size.</p></div>
        </details>
        <details>
          <summary>What paper do you use?<svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></summary>
          <div class="faq-a"><p>Thick 600 gsm cotton, soft enough to hold a deep impression. For extra weight, we join two sheets into a 1,200 gsm card and paint every edge by hand.</p></div>
        </details>
        <details>
          <summary>What does blind pressed mean?<svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></summary>
          <div class="faq-a"><p>The plate is pressed with no ink at all. Only the impression remains, catching the light as the card moves.</p></div>
        </details>
        <details>
          <summary>What is the smallest order?<svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></summary>
          <div class="faq-a"><p>Orders start at 100 cards. Ask on WhatsApp if you need a different quantity.</p></div>
        </details>
        <details>
          <summary>Why does each card look slightly different?<svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></summary>
          <div class="faq-a"><p>Each card is pressed one at a time, so the depth of the impression and the ink vary a little from card to card. That small variation is what makes letterpress feel handmade.</p></div>
        </details>
        <details>
          <summary>Can I reorder the same card later?<svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></summary>
          <div class="faq-a"><p>Yes. We keep your approved design on file, so a reorder matches the last box.</p></div>
        </details>
        <details>
          <summary>Do you deliver outside India?<svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></summary>
          <div class="faq-a"><p>Not yet. We deliver anywhere in India, free of charge.</p></div>
        </details>
        <div class="c-faq-more"><button type="button" class="btn paper">Load more</button></div>
      </div>
    </div>
  </section>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
