<?php
/**
 * Formular "Gutschein melden". Felder und Verarbeitung: inc/forms.php.
 */

defined('ABSPATH') || exit;
?>
<h2>Gutscheincode an uns schicken.</h2>
<p>Wir werden diesen Rabatt erst prüfen, bevor wir diesen auf unser Webseite listen.</p>
<?php
sg_form_open('gutschein-melden');
sg_form_field('gutschein-melden', 'shopid', ['class' => 'grid-25']);
sg_form_field('gutschein-melden', 'wert', ['class' => 'text']);
sg_form_field('gutschein-melden', 'unit', ['class' => 'grid-06']);
foreach (['code', 'date', 'link', 'name', 'email'] as $field) {
    sg_form_field('gutschein-melden', $field, ['class' => 'itext']);
}
sg_form_close('gutschein-melden', 'Anfrage absenden');
