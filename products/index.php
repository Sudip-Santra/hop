<?php
$page        = 'products';
$base        = '../';
$title       = 'Products — K K Marketing, Margao';
$description = 'Paper plates, paper cups, bowls, food containers, areca leaf plates, meal trays and wooden cutlery from K K Marketing, Margao, Goa. Choose your packs and order on WhatsApp.';
$scripts     = ['products.js'];

// /products/<range> opens this page scrolled to that range (see .htaccess / router.php)
$ranges = [
    'paper-plates'  => 'Paper plates',
    'paper-cups'    => 'Paper cups',
    'bowls'         => 'Bowls & containers',
    'areca'         => 'Areca leaf plates',
    'trays-cutlery' => 'Trays & cutlery',
];
$slug = basename(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH));
if ($slug !== 'products' && $slug !== '' && $slug !== 'index.php') {
    if (!isset($ranges[$slug])) {
        http_response_code(404);
    } else {
        $title = $ranges[$slug] . ' — K K Marketing, Margao';
    }
}
include __DIR__ . '/../partials/head.php';
?>

<main>
  <!-- Page head -->
  <div class="p-head wrap grid" data-route="">
    <div class="p-head-text">
      <div>
        <nav class="crumbs label rv" aria-label="Breadcrumb"><a href="../">Home</a><span>/</span><span aria-current="page">Products</span></nav>
        <h1 class="rv">The <em>catalogue</em>.</h1>
        <p class="lead muted rv">Everything we stock, range by range. Add the packs you need to your cart, then send it on WhatsApp. We reply with rates and stock.</p>
      </div>
      <ol class="p-steps rv">
        <li><span class="n">01</span><b>Add packs</b><span>Use + on any item to add it.</span></li>
        <li><span class="n">02</span><b>Open your cart</b><span>Send the list on WhatsApp.</span></li>
        <li><span class="n">03</span><b>Get rates</b><span>Then collect or ask about delivery.</span></li>
      </ol>
    </div>
    <figure class="p-head-img rv">
      <img src="../assets/leaf-plates.jpg" alt="Inside the K K Marketing shop: shelves of plates, cups and boxed stock" fetchpriority="high">
      <figcaption class="tag label">The shop — Pajifond, Margao</figcaption>
    </figure>
  </div>

  <!-- Range navigation -->
  <nav class="cat-nav" aria-label="Product ranges">
    <div class="wrap">
      <a href="paper-plates"><span class="label">01</span>Paper plates</a>
      <a href="paper-cups"><span class="label">02</span>Paper cups</a>
      <a href="bowls"><span class="label">03</span>Bowls &amp; containers</a>
      <a href="areca"><span class="label">04</span>Areca leaf plates</a>
      <a href="trays-cutlery"><span class="label">05</span>Trays &amp; cutlery</a>
    </div>
  </nav>

  <!-- Range 01: Paper plates -->
  <section class="range" id="paper-plates" data-route="paper-plates">
    <div class="wrap grid">
      <aside class="range-aside rv">
        <figure class="range-img"><img src="../assets/paper-plate.jpg" alt="Stacks of printed, plain and silver-laminated paper plates" loading="lazy" style="object-position:center 60%"><span class="no label">01</span></figure>
        <div class="range-info">
          <p class="label muted">Range 01 · 6 items</p>
          <h2>Paper <em>plates</em></h2>
          <p>Printed, plain and silver-laminated plates — paper plates in every size from snacks to buffets.</p>
          <a class="btn line" href="https://wa.me/<?= WHATSAPP ?>?text=Hi%20K%20K%20Marketing%2C%20please%20send%20me%20rates%20for%20your%20Paper%20plates%20range." target="_blank" rel="noopener">Rates for the whole range <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right"/></svg></a>
        </div>
      </aside>
      <ol class="range-list rv">
        <li class="item" data-item="Snack plate (6&quot; · 15 cm)" data-pack="Pack of 100">
          <span class="item-no label">01.01</span>
          <div class="item-body">
            <h3>Snack plate</h3>
            <p class="item-spec label">6" · 15 cm <span>·</span> Pack of 100</p>
            <p class="item-use">Chaat, sweets and cake.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Snack plate (6&quot; · 15 cm)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Quarter plate (7&quot; · 18 cm)" data-pack="Pack of 100">
          <span class="item-no label">01.02</span>
          <div class="item-body">
            <h3>Quarter plate</h3>
            <p class="item-spec label">7" · 18 cm <span>·</span> Pack of 100</p>
            <p class="item-use">Starters and breakfast.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Quarter plate (7&quot; · 18 cm)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Dinner plate (10&quot; · 25 cm)" data-pack="Pack of 50">
          <span class="item-no label">01.03</span>
          <div class="item-body">
            <h3>Dinner plate</h3>
            <p class="item-spec label">10" · 25 cm <span>·</span> Pack of 50</p>
            <p class="item-use">Full meals and thalis.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Dinner plate (10&quot; · 25 cm)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Buffet plate, heavy-duty (12&quot; · 30 cm)" data-pack="Pack of 50">
          <span class="item-no label">01.04</span>
          <div class="item-body">
            <h3>Buffet plate, heavy-duty</h3>
            <p class="item-spec label">12" · 30 cm <span>·</span> Pack of 50</p>
            <p class="item-use">Weddings and buffets.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Buffet plate, heavy-duty (12&quot; · 30 cm)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Printed party plate (9&quot; · 23 cm)" data-pack="Pack of 25">
          <span class="item-no label">01.05</span>
          <div class="item-body">
            <h3>Printed party plate</h3>
            <p class="item-spec label">9" · 23 cm <span>·</span> Pack of 25</p>
            <p class="item-use">Birthdays and functions.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Printed party plate (9&quot; · 23 cm)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Silver-laminated plate (10&quot; · 25 cm)" data-pack="Pack of 50">
          <span class="item-no label">01.06</span>
          <div class="item-body">
            <h3>Silver-laminated plate</h3>
            <p class="item-spec label">10" · 25 cm <span>·</span> Pack of 50</p>
            <p class="item-use">Holds gravy without soaking.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Silver-laminated plate (10&quot; · 25 cm)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
      </ol>
    </div>
  </section>

  <!-- Range 02: Paper cups -->
  <section class="range" id="paper-cups" data-route="paper-cups">
    <div class="wrap grid">
      <aside class="range-aside rv">
        <figure class="range-img"><img src="../assets/paper-cups.jpg" alt="Printed chai cups, ripple coffee cups with lids and plain white cups" loading="lazy" style="object-position:center 55%"><span class="no label">02</span></figure>
        <div class="range-info">
          <p class="label muted">Range 02 · 5 items</p>
          <h2>Paper <em>cups</em></h2>
          <p>Chai, coffee, water and juice cups — plain, printed and ripple-wall with lids.</p>
          <a class="btn line" href="https://wa.me/<?= WHATSAPP ?>?text=Hi%20K%20K%20Marketing%2C%20please%20send%20me%20rates%20for%20your%20Paper%20cups%20range." target="_blank" rel="noopener">Rates for the whole range <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right"/></svg></a>
        </div>
      </aside>
      <ol class="range-list rv">
        <li class="item" data-item="Chai cup (65 ml)" data-pack="Pack of 100">
          <span class="item-no label">02.01</span>
          <div class="item-body">
            <h3>Chai cup</h3>
            <p class="item-spec label">65 ml <span>·</span> Pack of 100</p>
            <p class="item-use">Tea, cutting chai and kahwa.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Chai cup (65 ml)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Printed chai cup (100 ml)" data-pack="Pack of 100">
          <span class="item-no label">02.02</span>
          <div class="item-body">
            <h3>Printed chai cup</h3>
            <p class="item-spec label">100 ml <span>·</span> Pack of 100</p>
            <p class="item-use">Cafés and tea stalls.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Printed chai cup (100 ml)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Coffee cup (150 ml)" data-pack="Pack of 100">
          <span class="item-no label">02.03</span>
          <div class="item-body">
            <h3>Coffee cup</h3>
            <p class="item-spec label">150 ml <span>·</span> Pack of 100</p>
            <p class="item-use">Hot drinks.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Coffee cup (150 ml)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Water &amp; juice cup (200 ml)" data-pack="Pack of 100">
          <span class="item-no label">02.04</span>
          <div class="item-body">
            <h3>Water & juice cup</h3>
            <p class="item-spec label">200 ml <span>·</span> Pack of 100</p>
            <p class="item-use">Cold drinks and water.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Water &amp; juice cup (200 ml)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Ripple cup with lid (250 ml)" data-pack="Pack of 50">
          <span class="item-no label">02.05</span>
          <div class="item-body">
            <h3>Ripple cup with lid</h3>
            <p class="item-spec label">250 ml <span>·</span> Pack of 50</p>
            <p class="item-use">Takeaway coffee.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Ripple cup with lid (250 ml)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
      </ol>
    </div>
  </section>

  <!-- Range 03: Bowls & containers -->
  <section class="range" id="bowls" data-route="bowls">
    <div class="wrap grid">
      <aside class="range-aside rv">
        <figure class="range-img"><img src="../assets/paper-bowl.jpg" alt="Kraft paper bowls with lids, silver dona bowls and foil containers" loading="lazy" style="object-position:center 55%"><span class="no label">03</span></figure>
        <div class="range-info">
          <p class="label muted">Range 03 · 6 items</p>
          <h2>Bowls &amp; <em>containers</em></h2>
          <p>Kraft bowls, lidded food containers, silver donas and foil containers for curries, desserts and takeaway.</p>
          <a class="btn line" href="https://wa.me/<?= WHATSAPP ?>?text=Hi%20K%20K%20Marketing%2C%20please%20send%20me%20rates%20for%20your%20Bowls%20%26%20containers%20range." target="_blank" rel="noopener">Rates for the whole range <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right"/></svg></a>
        </div>
      </aside>
      <ol class="range-list rv">
        <li class="item" data-item="Sweet &amp; ice-cream bowl (100 ml)" data-pack="Pack of 100">
          <span class="item-no label">03.01</span>
          <div class="item-body">
            <h3>Sweet & ice-cream bowl</h3>
            <p class="item-spec label">100 ml <span>·</span> Pack of 100</p>
            <p class="item-use">Desserts and kheer.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Sweet &amp; ice-cream bowl (100 ml)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Kraft curry bowl (250 ml)" data-pack="Pack of 50">
          <span class="item-no label">03.02</span>
          <div class="item-body">
            <h3>Kraft curry bowl</h3>
            <p class="item-spec label">250 ml <span>·</span> Pack of 50</p>
            <p class="item-use">Dal, curry and rice.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Kraft curry bowl (250 ml)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Kraft food bowl with lid (500 ml)" data-pack="Pack of 50">
          <span class="item-no label">03.03</span>
          <div class="item-body">
            <h3>Kraft food bowl with lid</h3>
            <p class="item-spec label">500 ml <span>·</span> Pack of 50</p>
            <p class="item-use">Takeaway meals.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Kraft food bowl with lid (500 ml)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Soup container with lid (750 ml)" data-pack="Pack of 25">
          <span class="item-no label">03.04</span>
          <div class="item-body">
            <h3>Soup container with lid</h3>
            <p class="item-spec label">750 ml <span>·</span> Pack of 25</p>
            <p class="item-use">Soups and gravies.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Soup container with lid (750 ml)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Silver dona (4&quot; · 10 cm)" data-pack="Pack of 100">
          <span class="item-no label">03.05</span>
          <div class="item-body">
            <h3>Silver dona</h3>
            <p class="item-spec label">4" · 10 cm <span>·</span> Pack of 100</p>
            <p class="item-use">Prasad, chaat and sweets.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Silver dona (4&quot; · 10 cm)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Foil container with lid (450 ml)" data-pack="Pack of 50">
          <span class="item-no label">03.06</span>
          <div class="item-body">
            <h3>Foil container with lid</h3>
            <p class="item-spec label">450 ml <span>·</span> Pack of 50</p>
            <p class="item-use">Hot food delivery.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Foil container with lid (450 ml)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
      </ol>
    </div>
  </section>

  <!-- Range 04: Areca leaf plates -->
  <section class="range" id="areca" data-route="areca">
    <div class="wrap grid">
      <aside class="range-aside rv">
        <figure class="range-img"><img src="../assets/areca-plates.jpg" alt="Square and round areca palm leaf plates and bowls" loading="lazy" style="object-position:center 60%"><span class="no label">04</span></figure>
        <div class="range-info">
          <p class="label muted">Range 04 · 6 items</p>
          <h2>Areca <em>leaf plates</em></h2>
          <p>Natural palm-leaf plates and bowls. Sturdy, plastic-free and compostable.</p>
          <a class="btn line" href="https://wa.me/<?= WHATSAPP ?>?text=Hi%20K%20K%20Marketing%2C%20please%20send%20me%20rates%20for%20your%20Areca%20leaf%20plates%20range." target="_blank" rel="noopener">Rates for the whole range <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right"/></svg></a>
        </div>
      </aside>
      <ol class="range-list rv">
        <li class="item" data-item="Round plate (6&quot; · 15 cm)" data-pack="Pack of 25">
          <span class="item-no label">04.01</span>
          <div class="item-body">
            <h3>Round plate</h3>
            <p class="item-spec label">6" · 15 cm <span>·</span> Pack of 25</p>
            <p class="item-use">Snacks and sweets.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Round plate (6&quot; · 15 cm)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Round plate (10&quot; · 25 cm)" data-pack="Pack of 25">
          <span class="item-no label">04.02</span>
          <div class="item-body">
            <h3>Round plate</h3>
            <p class="item-spec label">10" · 25 cm <span>·</span> Pack of 25</p>
            <p class="item-use">Full meals.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Round plate (10&quot; · 25 cm)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Square plate (8&quot; · 20 cm)" data-pack="Pack of 25">
          <span class="item-no label">04.03</span>
          <div class="item-body">
            <h3>Square plate</h3>
            <p class="item-spec label">8" · 20 cm <span>·</span> Pack of 25</p>
            <p class="item-use">Starters and desserts.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Square plate (8&quot; · 20 cm)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Square plate (10&quot; · 25 cm)" data-pack="Pack of 25">
          <span class="item-no label">04.04</span>
          <div class="item-body">
            <h3>Square plate</h3>
            <p class="item-spec label">10" · 25 cm <span>·</span> Pack of 25</p>
            <p class="item-use">Meals and buffets.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Square plate (10&quot; · 25 cm)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Deep bowl (4&quot; · 10 cm)" data-pack="Pack of 25">
          <span class="item-no label">04.05</span>
          <div class="item-body">
            <h3>Deep bowl</h3>
            <p class="item-spec label">4" · 10 cm <span>·</span> Pack of 25</p>
            <p class="item-use">Curries and desserts.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Deep bowl (4&quot; · 10 cm)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Rectangular tray (6 × 9&quot;)" data-pack="Pack of 25">
          <span class="item-no label">04.06</span>
          <div class="item-body">
            <h3>Rectangular tray</h3>
            <p class="item-spec label">6 × 9" <span>·</span> Pack of 25</p>
            <p class="item-use">Serving and platters.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Rectangular tray (6 × 9&quot;)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
      </ol>
    </div>
  </section>

  <!-- Range 05: Trays & cutlery -->
  <section class="range" id="trays-cutlery" data-route="trays-cutlery">
    <div class="wrap grid">
      <aside class="range-aside rv">
        <figure class="range-img"><img src="../assets/hero-range.jpg" alt="Compartment meal trays and wooden spoons and forks" loading="lazy" style="object-position:right bottom"><span class="no label">05</span></figure>
        <div class="range-info">
          <p class="label muted">Range 05 · 5 items</p>
          <h2>Trays &amp; <em>cutlery</em></h2>
          <p>Compartment meal trays, wooden cutlery and napkins to complete the table.</p>
          <a class="btn line" href="https://wa.me/<?= WHATSAPP ?>?text=Hi%20K%20K%20Marketing%2C%20please%20send%20me%20rates%20for%20your%20Trays%20%26%20cutlery%20range." target="_blank" rel="noopener">Rates for the whole range <svg class="i arr" aria-hidden="true"><use href="#i-arrow-right"/></svg></a>
        </div>
      </aside>
      <ol class="range-list rv">
        <li class="item" data-item="3-compartment meal tray (Standard)" data-pack="Pack of 50">
          <span class="item-no label">05.01</span>
          <div class="item-body">
            <h3>3-compartment meal tray</h3>
            <p class="item-spec label">Standard <span>·</span> Pack of 50</p>
            <p class="item-use">Rice, curry and side.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of 3-compartment meal tray (Standard)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="5-compartment thali tray (Large)" data-pack="Pack of 50">
          <span class="item-no label">05.02</span>
          <div class="item-body">
            <h3>5-compartment thali tray</h3>
            <p class="item-spec label">Large <span>·</span> Pack of 50</p>
            <p class="item-use">Full thali meals.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of 5-compartment thali tray (Large)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Wooden spoon (11 cm)" data-pack="Pack of 100">
          <span class="item-no label">05.03</span>
          <div class="item-body">
            <h3>Wooden spoon</h3>
            <p class="item-spec label">11 cm <span>·</span> Pack of 100</p>
            <p class="item-use">Desserts and meals.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Wooden spoon (11 cm)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Wooden fork (16 cm)" data-pack="Pack of 100">
          <span class="item-no label">05.04</span>
          <div class="item-body">
            <h3>Wooden fork</h3>
            <p class="item-spec label">16 cm <span>·</span> Pack of 100</p>
            <p class="item-use">Buffets and parties.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Wooden fork (16 cm)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
        <li class="item" data-item="Paper napkin (30 × 30 cm)" data-pack="Pack of 100">
          <span class="item-no label">05.05</span>
          <div class="item-body">
            <h3>Paper napkin</h3>
            <p class="item-spec label">30 × 30 cm <span>·</span> Pack of 100</p>
            <p class="item-use">Tables and counters.</p>
          </div>
          <div class="item-act">
            <div class="qty" role="group" aria-label="Packs of Paper napkin (30 × 30 cm)">
              <button type="button" class="q-dec" aria-label="One pack less"><svg class="i" aria-hidden="true"><use href="#i-minus"/></svg></button>
              <input type="number" min="0" max="999" value="0" inputmode="numeric" aria-label="Number of packs">
              <button type="button" class="q-inc" aria-label="One pack more"><svg class="i" aria-hidden="true"><use href="#i-plus"/></svg></button>
            </div>
          </div>
        </li>
      </ol>
    </div>
  </section>

  <!-- Not listed -->
  <section class="p-custom">
    <div class="wrap grid">
      <p class="label rv">(06) Something else?</p>
      <h2 class="rv">Need a size or item <em>not listed?</em></h2>
      <div class="p-custom-act rv">
        <p>Send us your list and quantities. If we stock it, or can get it, we’ll tell you the rate.</p>
        <div>
          <a class="btn terra" href="https://wa.me/<?= WHATSAPP ?>?text=Hi%20K%20K%20Marketing%2C%20I%27m%20looking%20for%20an%20item%20that%20isn%27t%20on%20your%20website%3A%0A" target="_blank" rel="noopener"><svg class="i wa-i" aria-hidden="true"><use href="#i-whatsapp"/></svg>Ask on WhatsApp</a>
          <a class="btn paper" href="tel:<?= PHONE_TEL ?>">Call the shop</a>
        </div>
      </div>
    </div>
  </section>
</main>

<!-- Cart: floating button (appears once something is added) + drawer -->
<button type="button" class="cart-fab" id="cart-fab" aria-label="Open cart" aria-controls="cart" aria-expanded="false">
  <svg class="i" aria-hidden="true"><use href="#i-shopping-cart"/></svg>
  <span class="cart-count" id="cart-count">0</span>
</button>
<div class="cart-scrim" id="cart-scrim"></div>
<aside class="cart" id="cart" role="dialog" aria-modal="true" aria-labelledby="cart-title" aria-hidden="true" inert>
  <div class="cart-head">
    <div>
      <span class="label">Your cart</span>
      <h2 id="cart-title">Order <em>list</em></h2>
    </div>
    <button type="button" class="cart-x" id="cart-close" aria-label="Close cart"><svg class="i" aria-hidden="true"><use href="#i-x"/></svg></button>
  </div>
  <ol class="cart-list" id="cart-list"></ol>
  <p class="cart-empty" id="cart-empty">Your cart is empty. Use + on any item to add it.</p>
  <div class="cart-foot">
    <div class="cart-total"><span class="label">Total</span><b id="cart-total">0 items · 0 packs</b></div>
    <p class="cart-note">No payment online. We reply on WhatsApp with rates and stock.</p>
    <div class="cart-act">
      <button type="button" class="btn line" id="cart-clear"><svg class="i" aria-hidden="true"><use href="#i-trash-2"/></svg>Clear</button>
      <button type="button" class="btn wa-btn" id="cart-send"><svg class="i wa-i" aria-hidden="true"><use href="#i-whatsapp"/></svg>Order on WhatsApp</button>
    </div>
  </div>
</aside>

<?php include __DIR__ . '/../partials/footer.php'; ?>
