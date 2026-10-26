<?php
$page        = 'terms';
$base        = '../';
$title       = 'Terms & Conditions - House of Press';
$description = 'The terms for ordering letterpress business cards from House of Press: proofs, prices, payment, artwork, delivery and liability.';
include __DIR__ . '/../partials/head.php';

$legalTitle = 'Terms &amp; <em>conditions</em>';
$legalLead  = 'The agreement between you and our studio when you order cards from us. Plain words, no surprises.';
$updated    = '24 October 2026';

$name     = SITE_NAME;
$addr     = e(ADDRESS_1 . ' ' . ADDRESS_2);
$dispatch = e(DISPATCH);
$fee      = '₹' . number_format(DESIGN_FEE);
$sections = [
    ['about', 'About these terms', <<<HTML
        <p>These terms apply to every order placed with {$name}, {$addr}, through this website, WhatsApp, phone or email. By placing an order you agree to them, together with our <a href="../shipping-and-returns/">shipping &amp; returns</a> and <a href="../privacy/">privacy</a> policies.</p>
HTML],
    ['orders', 'Placing an order', <<<HTML
        <p>Sending us your order on WhatsApp is a request to make your cards. The order is confirmed once we accept it and you approve your proof.</p>
        <p>We may decline an order, for example if the artwork breaks these terms or the law, and we will refund anything you have paid.</p>
HTML],
    ['prices', 'Prices and payment', <<<HTML
        <p>Prices are in Indian rupees and include GST and delivery within India. The studio design service costs {$fee} on top of the card price.</p>
        <p>We confirm payment with you on WhatsApp after your proof. We start pressing once payment is received.</p>
HTML],
    ['proofs', 'Proofs and approval', <<<HTML
        <p>Before printing, we send a digital proof on WhatsApp. You are responsible for checking everything on it: spelling, names, numbers, addresses and layout. We print exactly what you approve, and we are not responsible for errors that appear on an approved proof.</p>
HTML],
    ['artwork', 'Your artwork', <<<HTML
        <p>When you send us a logo, text or artwork, you confirm that you own it or have permission to use it, and that printing it does not break anyone else’s rights. You keep all rights to your artwork. You give us permission to use it only to make your order.</p>
        <p>We will not print material that is unlawful, misleading, or copies another business’s identity.</p>
HTML],
    ['design', 'Designs we make for you', <<<HTML
        <p>When our studio designs your card, the finished design is yours to use on your cards and stationery once the order is paid. We may show the printed cards in our gallery and on Instagram unless you ask us not to.</p>
HTML],
    ['craft', 'The nature of letterpress', <<<HTML
        <p>Every card is pressed by hand, one sheet at a time. Small variations in ink tone, impression depth and alignment between cards are part of the process and are not defects. Colours on paper can differ slightly from how they look on a screen.</p>
HTML],
    ['delivery', 'Delivery', <<<HTML
        <p>We dispatch within {$dispatch} of proof approval and deliver free within India. Delivery dates from the courier are estimates. Our <a href="../shipping-and-returns/">shipping &amp; returns</a> page explains delivery, cancellations, reprints and refunds in full.</p>
HTML],
    ['liability', 'Our responsibility', <<<HTML
        <p>If something goes wrong with your order because of us, we will reprint it or refund what you paid for it. Our total responsibility for any order is limited to the amount you paid for that order. We are not responsible for indirect losses, such as missed events or lost business, or for delays caused by events outside our control.</p>
        <p>Nothing in these terms limits your rights under the Consumer Protection Act, 2019.</p>
HTML],
    ['law', 'Law and disputes', <<<HTML
        <p>These terms are governed by the laws of India. If we cannot settle a disagreement by talking it through, the courts in Mumbai will decide it.</p>
HTML],
    ['changes', 'Changes to these terms', <<<HTML
        <p>We may update these terms from time to time. The version on this page when you place your order is the one that applies to it.</p>
HTML],
];

include __DIR__ . '/../partials/legal.php';
include __DIR__ . '/../partials/footer.php';
