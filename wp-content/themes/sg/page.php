<?php
/**
 * Template Name: Page with Sidebar
 *
 * Standardseite mit Seitenleiste. Einige Seiten haben eigene Inhalte (Formulare, Anleitung, Designwahl).
 * Mit ?lightbox=true (Anzeige im Dialog) entfallen Überschrift und Seitenleiste.
 */

defined('ABSPATH') || exit;

$in_lightbox = !empty($_GET['lightbox']);
$special     = [
    'kontakt'          => 'templates/forms/form-kontakt',
    'gutschein-melden' => 'templates/forms/form-code-melden',
    'feedback'         => 'templates/forms/form-feedback',
    'anleitung'        => 'templates/pages/page-anleitung',
    'design-aendern'   => 'template-parts/page-designs',
];

get_header();

while (have_posts()) :
    the_post();
    $slug = get_post_field('post_name');
    ?>
    <article class="col-first col span_3_of_4 style-a1">
      <?php if (!$in_lightbox) : ?>
        <?php the_title('<h1>', '</h1>'); ?>
      <?php endif; ?>

      <?php
      if (isset($special[$slug])) {
          get_template_part($special[$slug]);
      } else {
          the_content();
      }
      ?>
    </article>
<?php
endwhile;

if (!$in_lightbox) {
    get_sidebar();
}

get_footer();
