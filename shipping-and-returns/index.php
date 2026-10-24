<?php
$page        = 'shipping-and-returns';
$base        = '../';
$title       = 'Shipping & Returns — House of Press';
$description = 'How House of Press ships letterpress business cards across India, when an order can be cancelled, and what happens if a card arrives damaged or misprinted.';
include __DIR__ . '/../partials/head.php';

$legalTitle = 'Shipping &amp; <em>returns</em>';
$legalLead  = 'Every card is made to order for you, so this page explains when we ship, what you can change, and how we put things right if something goes wrong.';
$updated    = '24 October 2026';

$dispatch = e(DISPATCH);
$wa       = 'https://wa.me/' . WHATSAPP;
$sections = [
    ['delivery', 'Delivery', <<<HTML
        <p>Delivery is free to any address in India, and the price you see includes it. We send every order with a tracked courier and share the tracking number with you on WhatsApp once the parcel is on its way.</p>
        <p>We do not ship outside India at the moment.</p>
HTML],
    ['timing', 'When your order ships', <<<HTML
        <p>We dispatch within {$dispatch} of you approving your proof. The clock starts at approval, not at the order, because nothing goes to press before you say yes.</p>
        <p>The courier then takes a few working days, depending on where you are. Courier times are outside our control, and remote areas can take longer.</p>
HTML],
    ['proof', 'Your proof', <<<HTML
        <p>After you order, we send a digital proof of your card on WhatsApp. Please check every name, number, spelling and email on it. You can ask for changes, and we send a new proof each time.</p>
        <p>Your approval of the proof is what we print. We press exactly what you approve, so we cannot take back a card for a mistake that was on the approved proof.</p>
HTML],
    ['cancel', 'Changing or cancelling an order', <<<HTML
        <ul>
          <li><b>Before you approve the proof:</b> you can change or cancel your order at no cost, and anything you have paid is refunded in full.</li>
          <li><b>After you approve the proof:</b> we make your plates and start pressing, so the order can no longer be changed or cancelled.</li>
        </ul>
        <p>If we have started a design for you (the studio design service), the design fee covers work already done and is not refunded once we have sent you a first design.</p>
HTML],
    ['returns', 'Returns', <<<HTML
        <p>Because every card is printed with your own name and details, we cannot accept returns or exchanges for a change of mind.</p>
        <p>Letterpress is pressed by hand, so small differences in ink tone and impression depth from card to card are part of the craft and are not a defect. Ink colours can also look a little different on paper than on a screen.</p>
HTML],
    ['problems', 'Damaged, misprinted or missing orders', <<<HTML
        <p>We will reprint your order at no cost, or refund it if you prefer, when:</p>
        <ul>
          <li>the cards arrive damaged in transit,</li>
          <li>the printed cards differ from the proof you approved, or</li>
          <li>the parcel is lost by the courier.</li>
        </ul>
        <p>Please tell us within 48 hours of delivery, on <a href="{$wa}">WhatsApp</a>, with photos of the cards and the packaging. For a lost parcel, write to us as soon as tracking stops moving.</p>
HTML],
    ['refunds', 'Refunds', <<<HTML
        <p>Approved refunds go back to the account you paid from, within 7 working days of us agreeing the refund. Your bank may take a few more days to show it.</p>
HTML],
];

include __DIR__ . '/../partials/legal.php';
include __DIR__ . '/../partials/footer.php';
