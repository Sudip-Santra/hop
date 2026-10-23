<?php
// Site-wide settings: change contact details here only.
// Every page, the header, the footer and the JavaScript read from these.

const PHONE_DISPLAY = '+91 81695 65253'; // as shown on the site
const PHONE_TEL     = '+918169565253';   // same number for tel: links
const WHATSAPP      = '918169565253';    // country code first, digits only
const MAPS_URL      = 'https://share.google/1BVz61cuJOT8y9ZLr';
const SITE_URL      = 'https://houseofpress.in'; // no trailing slash; used for share-preview links

const SITE_NAME = 'House of Press';
const EMAIL     = 'hello@houseofpress.in';           // TODO: real address
const INSTAGRAM = 'houseofpress.in';                 // handle, without the @
const HOURS     = 'Monday to Saturday, 10am – 6pm'; // TODO: real hours
const DISPATCH  = '7–10 working days';              // TODO: after proof approval

function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
