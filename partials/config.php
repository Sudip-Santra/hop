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
const SITE_URL      = 'https://houseofpress.in'; // no trailing slash; used for share-preview links

const SITE_NAME = 'House of Press';
const EMAIL     = 'hello@houseofpress.in';           // TODO: real address
const INSTAGRAM = 'houseofpress.in';                 // handle, without the @
const HOURS     = 'Monday to Friday, 9am – 7pm';
const DISPATCH  = '7–10 working days';              // TODO: after proof approval

function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
