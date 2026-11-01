<?php
/**
 * Card designs for the playground on the business cards page: try a layout, change every line
 * of text, the paper and the inks. Ideas only; nothing here goes with the order.
 *
 * Each design: name for its thumbnail, default paper / ink / accent (keys of CARD_PAPERS and
 * CARD_INKS), and its front as HTML. On the page, every [data-field] (a line of text) and .acc-line
 * (a pressed rule, ring or bar) can be moved, resized and retyped on the card (card-editor.js);
 * .acc elements print in the accent ink.
 */

// Papers: the cotton texture multiplies over the base colour. The tone sets how much light the
// impression's lip catches: full on white, less on tinted stock, almost none on dark.
const CARD_PAPERS = [
    'pearl'    => ['Pearl white', '#ffffff', 'light'],
    'ash'      => ['Ivory',       '#f3ece5', 'light'], // the Paul Allen card's paper
    'bone'     => ['Bone',        '#efe4cd', 'soft'],
    'blush'    => ['Blush',       '#f0d9d0', 'soft'],
    'kraft'    => ['Kraft',       '#c4a079', 'mid'],
    'navy'     => ['Navy',        '#1f2a44', 'dark'],
    'charcoal' => ['Charcoal',    '#2e2b28', 'dark'],
];
// Inks: 'blind' presses without ink, so the type is the paper itself
const CARD_INKS = [
    'black'  => ['Press black', '#262827'],
    'red'    => ['Studio red',  '#a51e23'],
    'navy'   => ['Navy',        '#24345f'],
    'forest' => ['Forest',      '#2c5a3f'],
    'orange' => ['Orange',      '#d9752b'],
    'gold'   => ['Gold',        '#b08a3e'],
    'white'  => ['White',       '#f3efe6'],
    'blind'  => ['Blind',       'blind'],
];

/**
 * A design's front. Text goes through e(); the layout is fixed per design.
 *
 * Example: card_front('allen') → '<div class="pcard-front pcard-allen" data-design="allen" …>…</div>'
 */
function card_front(string $id): string
{
    $f = fn(string $key, string $label, string $text, string $class = '') =>
        '<p' . ($class ? ' class="' . $class . '"' : '') . ' data-field="' . $key . '" data-label="' . e($label) . '">' . e($text) . '</p>';

    switch ($id) {
        case 'house': // the studio's own card: name, tagline, a rule, details in two columns
            $body = '<div class="pcard-brand">' . $f('name', 'Name', 'House of Press', 'pcard-name') . $f('role', 'Tagline', 'Letterpress studio', 'pcard-role') . '</div>'
                . '<div class="pcard-foot"><span class="pcard-rule acc-line"></span><div class="pcard-details">' . $f('phone', 'Phone', PHONE_DISPLAY) . $f('email', 'Email', EMAIL) . '</div>'
                . '<div class="pcard-details pcard-right">' . $f('social', 'Social', '@' . INSTAGRAM) . $f('place', 'Place', 'Andheri East, Mumbai') . '</div></div>';
            $class = 'pcard-hop';
            break;
        case 'allen': // the famous one, set as the pressed original: a geometric sans, the phone top
                      // left, the firm top right, the name centred, the address along the foot
            $body = $f('phone', 'Phone', '212.555.6342', 'al-phone')
                . $f('company', 'Company', 'Pierce & Pierce', 'al-company')
                . $f('dept', 'Department', 'Mergers and Acquisitions', 'al-dept')
                . $f('name', 'Name', 'Paul Allen', 'al-name')
                . $f('title', 'Title', 'Vice President', 'al-title')
                . $f('address', 'Address', '358 Exchange Place New York N.Y. 10006', 'al-addr')
                . $f('fax', 'Fax and telex', 'Fax 212.555.6390 Telex 10 4534', 'al-fax');
            $class = 'pcard-allen';
            break;
        case 'meishi': // the Japanese meishi: the name large at centre left over the designation,
                       // the firm top right, the address and contacts in a block bottom right
            $body = $f('brand', 'Brand', 'KAPOOR STUDIO', 'me-brand')
                . $f('name', 'Name', 'Aanya Kapoor', 'me-name')
                . $f('title', 'Designation', 'Interior Architect', 'me-title')
                . $f('pin', 'Pin code', 'Pin 400050', 'me-line me-l1')
                . $f('address', 'Address', 'Hill Road, Bandra West, Mumbai', 'me-line me-l2')
                . $f('phone', 'Phone', 'phone  +91 98200 41275', 'me-line me-l3')
                . $f('email', 'Email', 'mail  aanya@kapoorstudio.in', 'me-line me-l4')
                . $f('web', 'Website', 'URL  kapoorstudio.in', 'me-line me-l5');
            $class = 'pcard-meishi';
            break;
        case 'statement': // bold and modern: who and how to reach them small across the top,
                          // the brand as one big word along the foot under an accent bar
            $body = $f('name', 'Name', 'Rohan Mehta', 'st-name')
                . $f('title', 'Title', 'Founder & Creative Director', 'st-title')
                . $f('phone', 'Phone', '+91 99300 18842', 'st-d st-d1')
                . $f('email', 'Email', 'rohan@northfield.co', 'st-d st-d2')
                . $f('web', 'Website', 'northfield.co', 'st-d st-d3')
                . '<span class="st-bar acc-line"></span>'
                . $f('brand', 'Brand', 'Northfield', 'st-word');
            $class = 'pcard-stmt';
            break;
        default: // script: a handwritten first name centred over the title and phone, the studio
                 // top left, what the studio shoots top right, email and website in the foot corners
            $body = $f('studio', 'Studio', 'Iyer Photo Studio', 'sc-studio')
                . $f('tag', 'Specialty', 'Weddings & Portraits', 'sc-tag')
                . $f('name', 'Name', 'Meera', 'sc-name')
                . $f('title', 'Title', 'Senior Photographer', 'sc-title')
                . $f('phone', 'Phone', '+91 90040 66218', 'sc-phone')
                . $f('email', 'Email', 'meera.iyer@gmail.com', 'sc-email')
                . $f('web', 'Website', 'www.iyerstudio.in', 'sc-web');
            $class = 'pcard-script';
            $id = 'minimal';
    }
    return '<div class="pcard-front ' . $class . '" data-design="' . $id . '">' . $body . '</div>';
}

// Thumbnail order, with each design's starting paper, ink and accent
const CARD_DESIGNS = [
    'house'     => ['House',      'pearl',    'black', 'red'],
    'allen'     => ['Paul Allen', 'ash',      'black', 'black'],
    'meishi'    => ['Meishi',     'pearl',    'black', 'black'],
    'statement' => ['Statement',  'charcoal', 'white', 'orange'],
    'minimal'   => ['Script',     'pearl',    'black', 'black'],
];

/**
 * The CSS custom properties for a paper / ink / accent choice, for a style="" attribute.
 *
 * Example: card_vars('bone', 'black', 'red') → '--card-paper:#efe4cd;--press-ink:#262827;--card-accent:#a51e23'
 */
function card_vars(string $paper, string $ink, string $accent): string
{
    $hex = fn(string $k) => CARD_INKS[$k][1] === 'blind' ? 'var(--blind-ink)' : CARD_INKS[$k][1];
    return '--card-paper:' . CARD_PAPERS[$paper][1] . ';--press-ink:' . $hex($ink) . ';--card-accent:' . $hex($accent);
}
