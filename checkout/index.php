<?php
$page        = 'checkout';
$base        = '../';
$title       = 'Checkout - House of Press';
$description = 'Complete your House of Press letterpress business card order.';
$scripts     = ['combobox.js', 'checkout.js'];
$noFooter    = true;
include __DIR__ . '/../partials/head.php';
?>

<main class="co-page">
  <div class="wrap">
    <div class="co-shell">
      <div class="co-head">
        <nav class="crumbs label" aria-label="Breadcrumb"><a href="../business-cards/">Business cards</a><span>/</span><span aria-current="page">Checkout</span></nav>
        <h1>Checkout</h1>
      </div>

      <!-- Nothing in the cart -->
      <section class="co-state" id="co-empty" hidden>
        <h2>Your cart is <em>empty</em>.</h2>
        <p>Choose a quantity and whether you’d like our studio to design your card.</p>
        <a href="../business-cards/" class="btn">Choose your cards <svg class="i arr" aria-hidden="true">
            <use href="#i-arrow-right" />
          </svg></a>
      </section>

      <!-- Order placed -->
      <section class="co-state" id="co-done" hidden tabindex="-1">
        <span class="co-tick" aria-hidden="true"><svg class="i">
            <use href="#i-check" />
          </svg></span>
        <p class="label">Order <span id="co-ref"></span></p>
        <h2>Thank you. <em>We’ve got it.</em></h2>
        <p>Your order has opened in WhatsApp. Press send so it reaches the studio - we’ll confirm the details and share your proof there within 24 hours.</p>
        <div class="co-done-files" id="co-done-files" hidden>
          <p><svg class="i" aria-hidden="true">
              <use href="#i-file" />
            </svg><span><b>Your artwork:</b> <span id="co-done-names"></span></span></p>
          <p class="co-muted" id="co-done-how">Attach it in the same WhatsApp chat so we can set your card.</p>
          <button type="button" class="btn line" id="co-share" hidden><svg class="i" aria-hidden="true">
              <use href="#i-upload" />
            </svg>Share artwork to WhatsApp</button>
        </div>
        <div class="co-done-act">
          <a href="#" class="btn red" id="co-resend" target="_blank" rel="noopener"><svg class="i wa-i" aria-hidden="true">
              <use href="#i-whatsapp" />
            </svg>Open WhatsApp again</a>
          <a href="../" class="btn line">Back to home</a>
        </div>
      </section>

      <form class="co" id="co-form" novalidate data-dispatch="<?= e(DISPATCH) ?>" data-rush-dispatch="<?= e(RUSH_DISPATCH) ?>">
        <!-- Details -->
        <div class="co-main">
          <section class="co-sec" aria-labelledby="co-s-speed">
            <div class="co-sec-head">
              <h2 id="co-s-speed">How soon?</h2>
              <p>Every card is pressed by hand, so standard is the usual pace. In a hurry? Rush puts yours first.</p>
            </div>
            <div class="co-speed" role="radiogroup" aria-labelledby="co-s-speed">
              <label>
                <input type="radio" name="speed" value="standard" checked>
                <span>
                  <b>Standard</b>
                  <small>Dispatched in <?= nums(DISPATCH) ?> after your proof</small>
                  <em>Free</em>
                </span>
              </label>
              <label>
                <input type="radio" name="speed" value="rush">
                <span>
                  <b>Rush</b>
                  <small>Dispatched in <?= nums(RUSH_DISPATCH) ?> after your proof</small>
                  <em>+<b class="num">₹<?= number_format(RUSH_FEE) ?></b></em>
                </span>
              </label>
            </div>
            <!-- Calendar: green days are reachable with standard, red ones only with rush -->
            <div class="co-cal" id="co-cal" data-standard-days="<?= DISPATCH_DAYS ?>" data-rush-days="<?= RUSH_DISPATCH_DAYS ?>">
              <input type="hidden" name="needby" id="co-needby">
              <div class="co-cal-top">
                <p class="co-cal-q">Need it dispatched by a date? <span>Optional</span></p>
                <div class="co-cal-nav">
                  <button type="button" id="co-cal-prev" aria-label="Previous month"><svg class="i" aria-hidden="true">
                      <use href="#i-chevron-left" />
                    </svg></button>
                  <b id="co-cal-month" aria-live="polite"></b>
                  <button type="button" id="co-cal-next" aria-label="Next month"><svg class="i" aria-hidden="true">
                      <use href="#i-chevron-right" />
                    </svg></button>
                </div>
              </div>
              <div class="co-cal-week" aria-hidden="true"><span>Mo</span><span>Tu</span><span>We</span><span>Th</span><span>Fr</span><span>Sa</span><span>Su</span></div>
              <div class="co-cal-grid" id="co-cal-grid" role="group" aria-label="Dispatch dates"></div>
              <ul class="co-cal-key">
                <li><i class="k-std" aria-hidden="true"></i><span>Standard, free</span></li>
                <li><i class="k-rush" aria-hidden="true"></i><span>Rush only, +<b class="num">₹<?= number_format(RUSH_FEE) ?></b></span></li>
                <li><i class="k-off" aria-hidden="true"></i><span>Too soon</span></li>
              </ul>
              <p class="co-cal-note" id="co-cal-note" aria-live="polite">Counted from today, weekends included, as if your proof is approved today.</p>
            </div>
          </section>

          <section class="co-sec" aria-labelledby="co-s1">
            <div class="co-sec-head">
              <h2 id="co-s1">Contact</h2>
              <p>Your proof and order updates come on WhatsApp.</p>
            </div>
            <div class="co-grid">
              <label class="co-field co-wide"><span>Full name</span><input name="name" required autocomplete="name"></label>
              <label class="co-field co-half"><span>WhatsApp number</span><span class="co-tel"><b aria-hidden="true">+91</b><input name="phone" type="tel" required autocomplete="tel-national" inputmode="numeric" maxlength="10" pattern="[6-9][0-9]{9}" aria-label="WhatsApp number, 10 digits after +91"></span></label>
              <label class="co-field co-half"><span>Email</span><input name="email" type="email" required autocomplete="email"></label>
            </div>
          </section>

          <section class="co-sec" aria-labelledby="co-s2">
            <div class="co-sec-head">
              <h2 id="co-s2">Delivery</h2>
              <p>Free, tracked delivery anywhere in India.</p>
            </div>
            <div class="co-grid">
              <label class="co-field co-wide"><span>Address</span><input name="address" required autocomplete="address-line1" placeholder="House, building, street"></label>
              <label class="co-field co-wide"><span>Area or landmark</span><input name="address2" autocomplete="address-line2"></label>
              <div class="co-field co-third">
                <label for="co-state">State</label>
                <div class="co-combo">
                  <input id="co-state" name="state" required autocomplete="off" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-controls="co-state-list" placeholder="Search state" spellcheck="false">
                  <svg class="i" aria-hidden="true">
                    <use href="#i-chevron-down" />
                  </svg>
                  <ul class="co-list" id="co-state-list" role="listbox" aria-label="States" hidden></ul>
                </div>
              </div>
              <div class="co-field co-third">
                <label for="co-city">City</label>
                <div class="co-combo">
                  <input id="co-city" name="city" required autocomplete="off" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-controls="co-city-list" placeholder="Choose a state first" spellcheck="false">
                  <svg class="i" aria-hidden="true">
                    <use href="#i-chevron-down" />
                  </svg>
                  <ul class="co-list" id="co-city-list" role="listbox" aria-label="Cities" hidden></ul>
                </div>
              </div>
              <label class="co-field co-third"><span>PIN code</span><input name="pin" required autocomplete="postal-code" inputmode="numeric" pattern="[0-9]{6}" maxlength="6"></label>
            </div>
          </section>

          <section class="co-sec" aria-labelledby="co-s3">
            <div class="co-sec-head">
              <h2 id="co-s3">On the card</h2>
              <p>Tell us what to print. You can also share it on WhatsApp later.</p>
            </div>
            <label class="co-field"><span class="sr-only">What should the card say?</span><textarea name="details" rows="3" placeholder="Name, title, phone, email, address - and any ink colour you have in mind"></textarea></label>
          </section>

          <!-- Phones: the order sits above the form, so the button repeats here -->
          <div class="co-end">
            <p class="co-error" id="co-error-end" role="alert" hidden></p>
            <button type="submit" class="btn red co-place">Pay and Confirm Order · <span class="co-total-inline">₹0</span></button>
          </div>
        </div>

        <!-- Your order -->
        <aside class="co-sum" aria-labelledby="co-sum-title">
          <div class="co-sum-head">
            <h2 id="co-sum-title">Your order</h2>
            <a href="../business-cards/" class="co-link">Add more</a>
          </div>
          <ol class="co-items" id="co-items"></ol>
          <dl class="co-rows">
            <div>
              <dt>Subtotal</dt>
              <dd id="co-sub">₹0</dd>
            </div>
            <div id="co-rush-row" hidden>
              <dt>Rush</dt>
              <dd id="co-rush">₹0</dd>
            </div>
            <div>
              <dt>Delivery</dt>
              <dd>Free</dd>
            </div>
            <div class="co-total">
              <dt>Total <span>incl. GST</span></dt>
              <dd id="co-total">₹0</dd>
            </div>
          </dl>
          <p class="co-error" id="co-error" role="alert" hidden></p>
          <button type="submit" class="btn red co-place">Pay and Confirm Order</button>
          <p class="co-note">Your order is sent to the studio on WhatsApp. Nothing is charged here - we confirm payment with you there, after your proof.</p>
        </aside>
      </form>
    </div>
  </div>
</main>

<?php include __DIR__ . '/../partials/footer.php'; ?>