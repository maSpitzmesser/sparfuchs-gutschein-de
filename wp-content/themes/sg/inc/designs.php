<?php
/**
 * Wählbare Designs. Einzige Quelle für die Liste: Header, Design-Seite und Script lesen sie von hier.
 * Jedes Design liegt in styles/<slug>/ mit theme.css und einem 200x200-Vorschaubild.
 */

defined('ABSPATH') || exit;

const SG_DEFAULT_DESIGN = 'flat';
const SG_DESIGN_COOKIE  = 'selected_theme';

function sg_designs(): array
{
    return [
        'modern'   => ['title' => 'Modern Design', 'new' => true, 'preview' => 'modern/sparfuchs-modern.min.png',
            'text' => 'Klar, ruhig und übersichtlich: viel Weißraum, gut lesbare Schrift und unser Sparfuchs als Gütesiegel.'],
        'fuchsbau' => ['title' => 'Fuchsbau Design', 'new' => true, 'preview' => 'fuchsbau/sparfuchs-fuchsbau.min.png',
            'text' => 'Ein warmer Herbstwald mit unserem Sparfuchs als Begleiter. Gutscheine sehen aus wie echte Abreiß-Coupons.'],
        'flat'     => ['title' => 'Flat Design', 'new' => false, 'preview' => 'flat/sparfuchs-flat.min.jpg',
            'text' => 'Ein sehr einfach gehaltenes Design für eine saubere Übersicht.'],
        'standard' => ['title' => 'Standard Design von 2012', 'new' => false, 'preview' => 'standard/sparfuchs-standard.min.jpg',
            'text' => 'Das Standard Design ist sehr Detail reich mit mehr Grafiken und einer schöneren Optik.'],
        'pinky'    => ['title' => 'Pinky Design', 'new' => false, 'preview' => 'pinky/sparfuchs-pinky.min.jpg',
            'text' => 'Platzhalter für Text. Platzhalter für Text. Platzhalter für Text. Platzhalter für Text. Platzhalter für Text.'],
        'grey'     => ['title' => 'Grau Texture Design', 'new' => false, 'preview' => 'grey/sparfuchs-gray.min.jpg',
            'text' => 'Platzhalter für Text. Platzhalter für Text. Platzhalter für Text. Platzhalter für Text. Platzhalter für Text.'],
    ];
}

/** Gewähltes Design aus dem Cookie, abgesichert gegen beliebige Werte. */
function sg_current_design(): string
{
    $design = isset($_COOKIE[SG_DESIGN_COOKIE]) ? sanitize_key(wp_unslash($_COOKIE[SG_DESIGN_COOKIE])) : '';
    return array_key_exists($design, sg_designs()) ? $design : SG_DEFAULT_DESIGN;
}

/** Gemeinsame Versionsnummer aller Design-Stylesheets (der Wechsler lädt Designs nachträglich). */
function sg_designs_version(): int
{
    $times = array_map(
        static fn(string $slug): int => (int) @filemtime(SG_THEME_DIR . "/styles/{$slug}/theme.css"),
        array_keys(sg_designs())
    );
    return max($times ?: [0]);
}
