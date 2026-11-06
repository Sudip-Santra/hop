<?php
$page        = 'privacy';
$base        = '../';
$title       = 'Privacy Policy - House of Press';
$description = 'What personal details House of Press collects when you order or enquire, why, who sees them and how long we keep them.';
include __DIR__ . '/../partials/head.php';

$legalTitle = 'Privacy <em>policy</em>';
$legalLead  = 'We ask only for what we need to make and deliver your cards. This page lists what that is, where it goes, and what you can ask us to do with it.';
$updated    = '24 October 2026';

$name  = SITE_NAME;
$email = EMAIL;
$addr  = e(ADDRESS_1 . ' ' . ADDRESS_2);
$sections = [
    ['who', 'Who we are', <<<HTML
        <p>{$name} is a letterpress studio at {$addr}. We are responsible for the personal details you share with us through this website, WhatsApp, phone or email.</p>
HTML],
    ['collect', 'What we collect', <<<HTML
        <ul>
          <li><b>Order details:</b> your name, WhatsApp number, email, delivery address and the text and artwork for your card.</li>
          <li><b>Enquiries:</b> whatever you write to us in the contact form, on WhatsApp, by phone or by email.</li>
          <li><b>Payment:</b> we confirm payment with you on WhatsApp. We see the payment confirmation, never your card or bank login details.</li>
        </ul>
        <p>We do not use analytics, advertising trackers or cookies on this website.</p>
HTML],
    ['how', 'How the website handles your details', <<<HTML
        <p>This website has no server-side database. When you place an order or send an enquiry, the site prepares a WhatsApp message with your details and opens WhatsApp, and you choose to send it. Nothing is sent to us until you do.</p>
        <ul>
          <li><b>Your cart</b> is saved in your own browser (local storage) so it is still there when you come back. Clearing your browser data removes it.</li>
          <li><b>Artwork you choose at checkout</b> stays in your browser tab. Only the file name goes into the order message; you send the file itself in the WhatsApp chat.</li>
        </ul>
HTML],
    ['use', 'Why we use it', <<<HTML
        <ul>
          <li>To make your proof, print your order and deliver it.</li>
          <li>To talk to you about your order, your proof and payment.</li>
          <li>To keep the accounts and tax records the law asks us to keep.</li>
        </ul>
        <p>We do not sell your details, and we do not send you marketing unless you ask us to.</p>
HTML],
    ['share', 'Who else sees it', <<<HTML
        <ul>
          <li><b>WhatsApp (Meta)</b> carries our conversations with you.</li>
          <li><b>Our courier</b> receives your name, phone number and delivery address to deliver your parcel.</li>
          <li><b>Our website host</b> keeps standard server logs, such as IP addresses, for security.</li>
          <li><b>Google Maps</b> loads on our contact page to show where we are, and Google may record that visit.</li>
          <li><b>CountriesNow</b> supplies the state and city lists at checkout. It receives the state you pick, not your name or address.</li>
        </ul>
        <p>We may also share details when the law requires it.</p>
HTML],
    ['work', 'Photos of your cards', <<<HTML
        <p>We like to photograph the cards we press for our gallery and Instagram. If you would rather your cards are not shown, tell us when you order and we will leave them out.</p>
HTML],
    ['keep', 'How long we keep it', <<<HTML
        <p>We keep order details for as long as tax and accounting law requires, which in India is usually 8 years. Enquiries that do not lead to an order are deleted within a year. Your artwork files are kept so you can reorder easily, unless you ask us to delete them.</p>
HTML],
    ['rights', 'Your choices', <<<HTML
        <p>Under India’s Digital Personal Data Protection Act, 2023, you can ask us to show you the details we hold about you, correct them, or delete them, unless we must keep them by law. Write to us at <a href="mailto:{$email}">{$email}</a> or on WhatsApp and we will reply within 7 working days.</p>
HTML],
    ['changes', 'Changes to this policy', <<<HTML
        <p>If we change how we handle personal details, we will update this page and the date at the top.</p>
HTML],
];

include __DIR__ . '/../partials/legal.php';
include __DIR__ . '/../partials/footer.php';
