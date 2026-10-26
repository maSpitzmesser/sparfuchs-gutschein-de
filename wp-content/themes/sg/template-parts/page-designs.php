<?php
/**
 * Auswahl der Designs (Seite "Design ändern"). Der Wechsel geschieht in site.js über data-design.
 */

defined('ABSPATH') || exit;
?>
<h2>Wähle dein Sparfuchs Design.</h2>
<p>Wir konnten uns für kein Design entscheiden, deswegen lassen wir euch die Wahl. Sucht euch ein Design aus welches dann für dich persönlich gespeichert bleibt und wenn Du möchtest kannst es hier jeder Zeit wieder ändern.<br> Grüße Euer Sparfuchs-Gutschein Team</p>

<?php foreach (sg_designs() as $slug => $design) : ?>
  <div class="float-box">
    <img src="<?php echo esc_url(SG_THEME_URI . '/styles/' . $design['preview']); ?>" alt="<?php echo esc_attr('Vorschau ' . $design['title']); ?>" width="200" height="200" loading="lazy">
    <h3><?php echo esc_html($design['title']); ?><?php if ($design['new']) : ?> <small>neu</small><?php endif; ?></h3>
    <p><?php echo esc_html($design['text']); ?></p>
    <button type="button" data-design="<?php echo esc_attr($slug); ?>" class="b">Design ändern</button>
  </div>
<?php endforeach; ?>
