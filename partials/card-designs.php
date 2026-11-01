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
        case 'allen': // the famous one: centred small capitals, phone in the corner
            $body = $f('phone', 'Phone', '212 555 6342', 'al-phone')
                . '<div class="al-co">' . $f('company', 'Company', 'Pierce & Pierce', 'al-company') . $f('dept', 'Department', 'Mergers and Acquisitions', 'al-dept') . '</div>'
                . '<div class="al-person">' . $f('name', 'Name', 'Paul Allen', 'al-name') . $f('title', 'Title', 'Vice President', 'al-title') . '</div>'
                . '<div class="al-foot">' . $f('address', 'Address', '358 Exchange Place New York, N.Y. 10099') . $f('fax', 'Fax and telex', 'Fax 212 555 6390 Telex 10 4534') . '</div>';
            $class = 'pcard-allen';
            break;
        case 'monogram': // initials in a pressed ring, the person beside it
            $body = '<div class="mo-mark acc-line">' . $f('initials', 'Initials', 'AK', 'mo-initials acc') . '</div>'
                . '<div class="mo-text">' . $f('name', 'Name', 'Aanya Kapoor', 'mo-name') . $f('title', 'Title', 'Interior Architect', 'mo-title acc')
                . '<div class="mo-details">' . $f('phone', 'Phone', '+91 98200 41275') . $f('email', 'Email', 'aanya@kapoorstudio.in') . $f('place', 'Place', 'Bandra West, Mumbai') . '</div></div>';
            $class = 'pcard-mono';
            break;
        case 'statement': // a big brand name across the foot, details small above
            $body = '<div class="st-top"><div>' . $f('name', 'Name', 'Rohan Mehta', 'st-name') . $f('title', 'Title', 'Founder', 'st-title') . '</div>'
                . '<div class="st-details">' . $f('phone', 'Phone', '+91 99300 18842') . $f('email', 'Email', 'rohan@northfield.co') . $f('web', 'Website', 'northfield.co') . '</div></div>'
                . '<div class="st-brand"><span class="st-bar acc-line"></span>' . $f('brand', 'Brand', 'Northfield', 'st-word') . '</div>';
            $class = 'pcard-stmt';
            break;
        default: // minimal: a centred name over a short rule, one line of details
            $body = '<div class="mi-centre">' . $f('name', 'Name', 'Meera Iyer', 'mi-name') . '<span class="mi-rule acc-line"></span>' . $f('title', 'Title', 'Photographer', 'mi-title') . '</div>'
                . $f('details', 'Details', '+91 90040 66218 · meera@iyer.studio', 'mi-details');
            $class = 'pcard-min';
            $id = 'minimal';
    }
    return '<div class="pcard-front ' . $class . '" data-design="' . $id . '">' . $body . '</div>';
}

// Thumbnail order, with each design's starting paper, ink and accent
const CARD_DESIGNS = [
    'house'     => ['House',      'pearl',    'black', 'red'],
    'allen'     => ['Paul Allen', 'bone',     'black', 'black'],
    'monogram'  => ['Monogram',   'pearl',    'navy',  'gold'],
    'statement' => ['Statement',  'charcoal', 'white', 'orange'],
    'minimal'   => ['Minimal',    'blush',    'forest', 'forest'],
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
