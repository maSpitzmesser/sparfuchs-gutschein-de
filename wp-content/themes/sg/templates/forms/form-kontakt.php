<?php
/**
 * Kontaktformular. Felder und Verarbeitung: inc/forms.php.
 */

defined('ABSPATH') || exit;
?>
<h2>Schreib uns eine Nachricht.</h2>
<?php
sg_form_open('kontakt');
foreach (['name', 'email', 'betreff', 'nachricht'] as $field) {
    sg_form_field('kontakt', $field);
}
sg_form_close('kontakt', 'Anfrage absenden');
