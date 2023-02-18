<?php /* Template Name: Content Full-width, Ohne Sidebar */
get_header(); ?>
<style>


td,th {
  border: 1px solid #ddd;
  padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2;}

tr:hover {background-color: #ddd;}

th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #4CAF50;
  color: white;
}
</style>
<?php while ( have_posts() ) : the_post(); ?>
<article class="col-first col span_3_of_3 style-a1" role="main">
<h1 class="headline-a1"><?php the_title(); ?></h1>
<?php the_content(); ?>		
</article>
<?php endwhile;  ?>
<?php get_footer(); ?>