<?php /* Template Name: Blog Template */ ?>

<?php get_header(); ?>

<div id="content">

    <?php $args = array('post_type=' => 'post','paged'=> $paged); query_posts($args); ?>

    <?php get_template_part('loop'); ?>
  
    
<?php get_footer(); ?>