<?php
// Site-wide settings: change contact details here only.
// Every page, the header, the footer and the JavaScript read from these.

const PHONE_DISPLAY = '+91 81695 65253'; // as shown on the site
const PHONE_TEL     = '+918169565253';   // same number for tel: links
const WHATSAPP      = '918169565253';    // country code first, digits only
const MAPS_URL      = 'https://maps.app.goo.gl/i9pEjtyYjYRvbVRX9';
const MAPS_EMBED    = 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3769.860229025897!2d72.8763116!3d19.113786699999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c9c8b7ac3693%3A0x6efeb091a3ec8bf5!2sHouse%20Of%20Press!5e0!3m2!1sen!2sin!4v1792756300160!5m2!1sen!2sin';
const ADDRESS_1     = 'Shop 19, Mubarak Building, Saifee Park,';
const ADDRESS_2     = 'Marol Church Rd, Andheri East, Mumbai 400059';
// The same address in parts, for search engines (structured data on the home page)
const ADDRESS_STREET = 'Shop 19, Mubarak Building, Saifee Park, Marol Church Rd';
const ADDRESS_AREA   = 'Andheri East';
const ADDRESS_CITY   = 'Mumbai';
const ADDRESS_REGION = 'Maharashtra';
const ADDRESS_PIN    = '400059';
const GEO            = [19.1137867, 72.8763116]; // from the Google Maps embed
const SITE_URL      = 'https://houseofpress.in'; // no trailing slash; used for share-preview links

const SITE_NAME = 'House of Press';
const EMAIL     = 'hello@houseofpress.in';           // TODO: real address
const INSTAGRAM = 'houseofpress.in';                 // handle, without the @
const HOURS     = 'Monday to Friday, 9am – 7pm';
const DISPATCH  = '7–10 working days';              // TODO: after proof approval
const DISPATCH_DAYS = 10; // the longest standard wait in days, weekends included (keep in step with DISPATCH)

// Business cards: price in rupees for each quantity (GST and delivery included)
const CARD_PRICES = [100 => 2499, 200 => 4499, 500 => 9999, 1000 => 17999];
const DESIGN_FEE  = 3000; // studio designs the card
// Rush: the order jumps the queue, one flat fee per order (not per card)
const RUSH_FEE      = 1500;                 // TODO: confirm the amount
const RUSH_DISPATCH = '3–4 working days';   // TODO: confirm; after proof approval, like DISPATCH
const RUSH_DISPATCH_DAYS = 4;               // the longest rush wait in days, weekends included (keep in step with RUSH_DISPATCH)

function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

/**
 * Escapes text and wraps each number (a range, or a time like 9am) in <b class="num"> so it sets in mono.
 *
 * Example: nums('7–10 working days') → '<b class="num">7–10</b> working days'
 * Example: nums('9am – 7pm') → '<b class="num">9am</b> – <b class="num">7pm</b>'
 */
function nums(string $s): string
{
    return preg_replace('/\d+(?:[–-]\d+)?(?:am|pm)?/u', '<b class="num">$0</b>', e($s));
}
