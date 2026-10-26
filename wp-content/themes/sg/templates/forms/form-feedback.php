<?php
/**
 * Feedback-Formular. Felder und Verarbeitung: inc/forms.php.
 */

defined('ABSPATH') || exit;
?>
<h2>Deine Meinung ist uns wichtig!</h2>
<?php
sg_form_open('feedback');
sg_form_field('feedback', 'erfahren_durch', ['class' => 'grid-50']);
foreach (['inhalt', 'design', 'name', 'email', 'vorschlag'] as $field) {
    sg_form_field('feedback', $field);
}
sg_form_close('feedback', 'Feedback absenden');
