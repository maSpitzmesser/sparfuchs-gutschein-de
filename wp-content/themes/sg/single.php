<?php
/**
 * Shop-Seite (jeder Beitrag ist ein Shop).
 */

defined('ABSPATH') || exit;

get_header();

while (have_posts()) {
    the_post();
    get_template_part('template-parts/shop');
}

get_sidebar();
get_footer();
