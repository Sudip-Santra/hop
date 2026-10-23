<?php
$page        = 'about';
$base        = '../';
$title       = 'About — House of Press, letterpress studio in Mumbai';
$description = 'House of Press is a letterpress studio in Andheri East, Mumbai, pressing business and brand cards by hand into thick cotton paper, one sheet at a time.';
include __DIR__ . '/../partials/head.php';
$v = '../assets/videos/';
?>

<main>
  <!-- Page head -->
  <div class="a-head wrap">
    <div class="grid">
      <div class="a-head-text">
        <nav class="crumbs label rv" aria-label="Breadcrumb"><a href="../">Home</a><span>/</span><span aria-current="page">About</span></nav>
        <h1 class="rv">A letterpress studio for <em>cards<br class="br-lg"> you can feel</em>.</h1>
      </div>
      <p class="lead muted a-head-lead rv">House of Press presses business and brand cards by hand into thick cotton paper, one sheet at a time, from a small studio in Andheri East, Mumbai.</p>
    </div>
    <figure class="a-head-img rv">
      <img src="<?= $v ?>sakshi-jain.jpg" alt="A House of Press business card for Sakshi Jain, architect, letterpressed in olive-green ink on cotton paper, in afternoon shadow" fetchpriority="high" style="object-position:center 55%">
      <figcaption class="tag label">Pressed in Andheri East, Mumbai</figcaption>
    </figure>
    <div class="a-facts rv">
      <div><b>600 gsm</b><span>Cotton paper</span></div>
      <div><b>1 sheet</b><span>Pressed at a time</span></div>
      <div><b>40K+</b><span>Following on Instagram</span></div>
      <div><b>Free</b><span>Delivery across India</span></div>
    </div>
  </div>

  <!-- Who we are: two split rows, photo beside a coloured panel -->
  <section class="a-split">
    <div class="a-split-row">
      <figure class="a-split-img"><img src="<?= $v ?>about1.webp" alt="Freshly pressed cotton sheets drying on a wooden rack in the House of Press studio, beside jars of ink and a roller" loading="lazy" width="1344" height="768"></figure>
      <div class="a-split-panel is-red rv">
        <p class="label">Who we are</p>
        <h2>Slow by design. <em>Felt for years.</em></h2>
        <p>Letterpress is relief printing, the method behind nearly every book, poster and calling card for centuries. Type and artwork stand raised on a plate, and the press pushes them into the paper.</p>
        <a href="../gallery/" class="btn paper">See the work <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right"/></svg></a>
      </div>
    </div>
    <div class="a-split-row is-flip">
      <figure class="a-split-img"><img src="<?= $v ?>about2.webp" alt="A House of Press printer inking a block of type by hand with an orange roller" loading="lazy" width="1344" height="768"></figure>
      <div class="a-split-panel rv">
        <p class="label">The craft</p>
        <h2>Pressed <em>by hand</em>.</h2>
        <p>Soft cotton takes that push beautifully, so your words sit just below the surface and catch the light. It is slower than printing flat. That is the point.</p>
        <div class="a-split-sign">
          <b>House of Press</b>
          <span class="label">Letterpress &amp; Design · Andheri East, Mumbai</span>
        </div>
      </div>
    </div>
  </section>

  <!-- What we press -->
  <section class="wrap">
    <div class="sec-head grid rv">
      <p class="label">What we press</p>
      <h2>One press, <em>many kinds of card</em>.</h2>
      <p class="side">Business and brand cards in one ink or several, blind pressed, or made to your own design.</p>
    </div>
    <div class="a-ranges">
        <a class="a-range rv" href="../products/">
          <figure><img src="<?= $v ?>urmil-nisar.jpg" alt="" loading="lazy" style="object-position:center 40%"></figure>
          <span class="label">01</span>
          <h3>Business cards</h3>
          <span class="go"><svg class="i" aria-hidden="true"><use href="#i-arrow-right"/></svg></span>
        </a>
        <a class="a-range rv" href="../gallery/">
          <figure><img src="<?= $v ?>hero-poster.jpg" alt="" loading="lazy" style="object-position:center 35%"></figure>
          <span class="label">02</span>
          <h3>Brand cards</h3>
          <span class="go"><svg class="i" aria-hidden="true"><use href="#i-arrow-right"/></svg></span>
        </a>
        <a class="a-range rv" href="../gallery/">
          <figure><img src="<?= $v ?>crispy-business-card.jpg" alt="" loading="lazy" style="object-position:center 45%"></figure>
          <span class="label">03</span>
          <h3>Blind pressed</h3>
          <span class="go"><svg class="i" aria-hidden="true"><use href="#i-arrow-right"/></svg></span>
        </a>
        <a class="a-range rv" href="../contact/">
          <figure><img src="<?= $v ?>sakshi-jain.jpg" alt="" loading="lazy" style="object-position:center 45%"></figure>
          <span class="label">04</span>
          <h3>Custom design</h3>
          <span class="go"><svg class="i" aria-hidden="true"><use href="#i-arrow-right"/></svg></span>
        </a>
        <a class="a-range rv" href="../how-to-order">
          <figure><img src="<?= $v ?>about-studio.jpg" alt="" loading="lazy" style="object-position:center"></figure>
          <span class="label">05</span>
          <h3>How it’s made</h3>
          <span class="go"><svg class="i" aria-hidden="true"><use href="#i-arrow-right"/></svg></span>
        </a>
    </div>
    <div class="a-more rv"><a class="btn" href="../gallery/">See the work <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right"/></svg></a></div>
  </section>

  <!-- How we work -->
  <section class="a-work">
    <div class="wrap">
      <div class="sec-head grid rv">
        <p class="label">How we work</p>
        <h2>Slow, <em>on purpose</em>.</h2>
        <p class="side">No rush and no shortcuts: a proof, a press and your approval.</p>
      </div>
      <div class="grid steps">
        <div class="step rv"><span class="n">01</span><h3>Proof first</h3><p>We set your card and send a proof on WhatsApp before anything is pressed.</p></div>
        <div class="step rv"><span class="n">02</span><h3>Ink by hand</h3><p>Ink is mixed for your order and worked onto the rollers.</p></div>
        <div class="step rv"><span class="n">03</span><h3>One sheet at a time</h3><p>Each sheet is fed and pressed on its own, deep into the cotton.</p></div>
        <div class="step rv"><span class="n">04</span><h3>Finished by hand</h3><p>Trimmed, checked and wrapped, then sent free across India.</p></div>
      </div>
    </div>
  </section>

  <!-- Closing prompt -->
  <section class="g-end">
    <div class="wrap">
      <div class="g-end-main grid">
        <div class="g-end-text rv">
          <p class="label">Your card next</p>
          <h2>Have a design <em>in mind?</em></h2>
        </div>
        <div class="g-end-act rv">
          <p>Send your logo, artwork or a rough idea. We’ll set it, send a proof on WhatsApp, and press it once you approve.</p>
          <div class="g-end-btns">
            <a href="../contact/" class="btn red">Start your card <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right"/></svg></a>
            <a href="https://wa.me/<?= WHATSAPP ?>?text=<?= rawurlencode("Hi House of Press, I'd like to talk about a card design.") ?>" class="btn line" target="_blank" rel="noopener"><svg class="i wa-i" aria-hidden="true"><use href="#i-whatsapp"/></svg>WhatsApp us</a>
          </div>
        </div>
      </div>
      <ol class="g-end-steps rv">
        <li><span class="label">01</span><b>Send your idea</b><span>A logo, artwork or a rough sketch.</span></li>
        <li><span class="label">02</span><b>Approve the proof</b><span>On WhatsApp, before anything is pressed.</span></li>
        <li><span class="label">03</span><b>We press and deliver</b><span>By hand, free across India.</span></li>
      </ol>
    </div>
  </section>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>
