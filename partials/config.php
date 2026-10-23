<?php
// Site-wide settings: change contact details here only.
// Every page, the header, the footer and the JavaScript read from these.

const PHONE_DISPLAY = '+91 00000 00000'; // TODO: real number, as shown on the site
const PHONE_TEL     = '+910000000000';   // TODO: same number for tel: links
const WHATSAPP      = '910000000000';    // TODO: country code first, digits only
const MAPS_URL      = 'https://share.google/1BVz61cuJOT8y9ZLr';

function e(string $s): string
{
    return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}
