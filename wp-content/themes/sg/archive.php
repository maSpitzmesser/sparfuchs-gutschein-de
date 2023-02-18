<?php /* Template Name: Alle Shops Template */ 
get_header();
$alt_text_menu  	   = 'Alle Online-Shops mit';
$shop_list_head_before = '<h3>';
$shop_list_head_after  = '</h3>';
$class_start      	   = '<section class="col-first span_3_of_3 shop-list style-a1">';
$class_close      	   = '</section>';
$Img_Url = '/wp-content/themes/sg/images/shop_logos/';

?>
<!--
<nav id="navi-right">
    <a href="#A" title="<?php echo $alt_text_menu; ?> A">A</a>
    <a href="#B" title="<?php echo $alt_text_menu; ?> B">B</a>
    <a href="#C" title="<?php echo $alt_text_menu; ?> C">C</a>
    <a href="#D" title="<?php echo $alt_text_menu; ?> D">D</a>
    <a href="#E" title="<?php echo $alt_text_menu; ?> E">E</a>
    <a href="#F" title="<?php echo $alt_text_menu; ?> F">F</a>
    <a href="#G" title="<?php echo $alt_text_menu; ?> G">G</a>
    <a href="#H" title="<?php echo $alt_text_menu; ?> H">H</a>
    <a href="#I" title="<?php echo $alt_text_menu; ?> I">I</a>
    <a href="#J" title="<?php echo $alt_text_menu; ?> J">J</a>
    <a href="#K" title="<?php echo $alt_text_menu; ?> K">K</a>
    <a href="#L" title="<?php echo $alt_text_menu; ?> L">L</a>
    <a href="#M" title="<?php echo $alt_text_menu; ?> M">M</a>
    <a href="#N" title="<?php echo $alt_text_menu; ?> N">N</a>
    <a href="#O" title="<?php echo $alt_text_menu; ?> O">O</a>
    <a href="#P" title="<?php echo $alt_text_menu; ?> P">P</a>
    <a href="#Q" title="<?php echo $alt_text_menu; ?> Q">Q</a>
    <a href="#R" title="<?php echo $alt_text_menu; ?> R">R</a>
    <a href="#S" title="<?php echo $alt_text_menu; ?> S">S</a>
    <a href="#T" title="<?php echo $alt_text_menu; ?> T">T</a>
    <a href="#U" title="<?php echo $alt_text_menu; ?> U">U</a>
    <a href="#V" title="<?php echo $alt_text_menu; ?> V">V</a>
    <a href="#W" title="<?php echo $alt_text_menu; ?> W">W</a>
    <a href="#X" title="<?php echo $alt_text_menu; ?> X">X</a>
    <a href="#Y" title="<?php echo $alt_text_menu; ?> Y">Y</a>
    <a href="#Z" title="<?php echo $alt_text_menu; ?> Z">Z</a>
    <a href="#0" title="<?php echo $alt_text_menu; ?> 0-9">0-4</a>
    <a href="#5" title="<?php echo $alt_text_menu; ?> 0-9">5-9</a>
</nav>-->


<section class="navigation-abc style-a1">
	<h1 class="headline-a1"><?php echo wp_count_posts()->publish;  ?> Online Shops mit Gutscheinen, Rabatten und Schnäppchen von A-Z</h1>
	
    
	<nav class="ABC">
		<a href="#A" title="<?php echo $alt_text_menu; ?> A">A</a>
		<a href="#B" title="<?php echo $alt_text_menu; ?> B">B</a>
		<a href="#C" title="<?php echo $alt_text_menu; ?> C">C</a>
		<a href="#D" title="<?php echo $alt_text_menu; ?> D">D</a>
		<a href="#E" title="<?php echo $alt_text_menu; ?> E">E</a>
		<a href="#F" title="<?php echo $alt_text_menu; ?> F">F</a>
		<a href="#G" title="<?php echo $alt_text_menu; ?> G">G</a>
		<a href="#H" title="<?php echo $alt_text_menu; ?> H">H</a>
		<a href="#I" title="<?php echo $alt_text_menu; ?> I">I</a>
		<a href="#J" title="<?php echo $alt_text_menu; ?> J">J</a>
		<a href="#K" title="<?php echo $alt_text_menu; ?> K">K</a>
		<a href="#L" title="<?php echo $alt_text_menu; ?> L">L</a>
		<a href="#M" title="<?php echo $alt_text_menu; ?> M">M</a>
		<a href="#N" title="<?php echo $alt_text_menu; ?> N">N</a>
		<a href="#O" title="<?php echo $alt_text_menu; ?> O">O</a>
		<a href="#P" title="<?php echo $alt_text_menu; ?> P">P</a>
		<a href="#Q" title="<?php echo $alt_text_menu; ?> Q">Q</a>
		<a href="#R" title="<?php echo $alt_text_menu; ?> R">R</a>
		<a href="#S" title="<?php echo $alt_text_menu; ?> S">S</a>
		<a href="#T" title="<?php echo $alt_text_menu; ?> T">T</a>
		<a href="#U" title="<?php echo $alt_text_menu; ?> U">U</a>
		<a href="#V" title="<?php echo $alt_text_menu; ?> V">V</a>
		<a href="#W" title="<?php echo $alt_text_menu; ?> W">W</a>
		<a href="#X" title="<?php echo $alt_text_menu; ?> X">X</a>
		<a href="#Y" title="<?php echo $alt_text_menu; ?> Y">Y</a>
		<a href="#Z" title="<?php echo $alt_text_menu; ?> Z">Z</a>
		<a href="#0" title="<?php echo $alt_text_menu; ?> 0-9">0-4</a>
		 <a href="#5" title="<?php echo $alt_text_menu; ?> 0-9">5-9</a>
	</nav>
	 
	<a href="#logo" class="oben" title="hier klicken um wieder nach oben zu kommen"><span>NACH</span><span>OBEN</span></a>
</section>

<?php

$first_char = 'A';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
 echo $class_start;
  
 	echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
  
		  echo '<div class="logos">
		<a href="' . get_permalink(3750) . '"><img loading="lazy" src="'.$Img_Url.'amazon-logo.png" alt="Amazon Gutscheine" title="Alle Amazon Gutscheine"/></a>
		<a href="' . get_permalink(3955) . '"><img loading="lazy" src="'.$Img_Url.'asos-logo.png" alt="asos Gutscheine" title="Alle asos Gutscheine"/></a>
		<a href="' . get_permalink(3932) . '"><img loading="lazy" src="'.$Img_Url.'ab-in-den-urlaub-logo.png" alt="ab in den urlaub Gutscheine" title="Alle ab in den urlaub Gutscheine"/></a>
		<a href="' . get_permalink(6094) . '"><img loading="lazy" src="'.$Img_Url.'anzuege-de-logo.png" alt="Anzuege.de Gutscheine" title="Alle Anzuege.de Gutscheine"/></a>
		<a href="' . get_permalink(3840) . '"><img loading="lazy" src="'.$Img_Url.'adidas-logo.png" alt="adidas Gutscheine" title="Alle adidas Gutscheine"/></a>
		<a href="' . get_permalink(4153) . '"><img loading="lazy" src="'.$Img_Url.'angelplatz-logo.png" alt="Angelplatz Gutscheine" title="Alle Angelplatz Gutscheine"/></a>
		</div>';
		
while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;

	echo $class_close;
}
wp_reset_query();
}

$first_char = 'B';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
 echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
 echo '<div class="logos">
		<a href="' . get_permalink(3752) . '"><img loading="lazy" src="'.$Img_Url.'baby-markt-logo.png" alt="Baby-Markt Gutscheine" title="Alle Baby-Markt Gutscheine"/></a>
		   <a href="' . get_permalink(3799) . '"><img loading="lazy" src="'.$Img_Url.'baby-walz-logo.png" alt="baby-walz Gutscheine" title="Alle baby-walz Gutscheine"/></a>
		   <a href="' . get_permalink(3973) . '"><img loading="lazy" src="'.$Img_Url.'brands4friends-logo.png" alt="Brands4Friends Gutscheine" title="Alle Brands4Friends Gutscheine"/></a>
		   <a href="' . get_permalink(3969) . '"><img loading="lazy" src="'.$Img_Url.'bonprix-logo.png" alt="Bonprix Gutscheine" title="Alle Bonprix Gutscheine"/></a>
		   <a href="' . get_permalink(4026) . '"><img loading="lazy" src="'.$Img_Url.'buecher-de-logo.png" alt="bücher.de Gutscheine" title="Alle bücher.de Gutscheine"/></a>
		   <a href="' . get_permalink(4002) . '"><img loading="lazy" src="'.$Img_Url.'beate-uhse-logo.png" alt="Beate Uhse Gutscheine" title="Alle Beate Uhse Gutscheine"/></a>
		   </div>';
  
 
 while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
 echo $class_close;
}
wp_reset_query(); 
}

$first_char = 'C';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
  echo $class_start; 
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
  
 echo '<div class="logos">
       <a href="' . get_permalink(3796) . '"><img loading="lazy" src="'.$Img_Url.'c-und-a-logo.png" alt="C&A Gutscheine" title="Alle C&A Gutscheine"/></a>
       <a href="' . get_permalink(4222) . '"><img loading="lazy" src="'.$Img_Url.'charles-voegele-logo.png" alt="Charles Vögele Gutscheine" title="Alle Charles Vögele Gutscheine"/></a>
       <a href="' . get_permalink(4088) . '"><img loading="lazy" src="'.$Img_Url.'christ-logo.png" alt="Christ Gutscheine" title="Alle Christ Gutscheine"/></a>
       <a href="' . get_permalink(4224) . '"><img loading="lazy" src="'.$Img_Url.'check-und-flieg-logo.png" alt="Check und Flieg Gutscheine" title="Alle Check und Flieg Gutscheine"/></a>
       <a href="' . get_permalink(4246) . '"><img loading="lazy" src="'.$Img_Url.'crocs-logo.png" alt="Crocs Gutscheine" title="Alle Crocs Gutscheine"/></a>
		 <a href="' . get_permalink(5674) . '"><img loading="lazy" src="'.$Img_Url.'center-parcs-logo.png" alt="center-parcs Gutscheine" title="Alle center-parcs Gutscheine"/></a>
       </div>';
  
  
  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
 echo $class_close; 
}
wp_reset_query();
}

$first_char = 'D';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
  echo $class_start; 
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
 echo '<div class="logos">
		<a href="' . get_permalink(3811) . '"><img loading="lazy" src="'.$Img_Url.'douglas-logo.png" alt="Alle Douglas Gutscheine" title="Alle Douglas Gutscheine"/></a>
		<a href="' . get_permalink(4024) . '"><img loading="lazy" src="'.$Img_Url.'deichmann-logo.png" alt="Alle Deichmann Gutscheine" title="Alle Deichmann Gutscheine"/></a>
		<a href="' . get_permalink(4120) . '"><img loading="lazy" src="'.$Img_Url.'dress-for-less-logo.png" alt="Alle dress-for-less Gutscheine" title="Alle dress-for-less Gutscheine"/></a>
		<a href="' . get_permalink(4289) . '"><img loading="lazy" src="'.$Img_Url.'dermarkenjuwelier-logo.png" alt="Alle DerMarkenJuwelier Gutscheine" title="Alle DerMarkenJuwelier Gutscheine"/></a>
		<a href="' . get_permalink(3897) . '"><img loading="lazy" src="'.$Img_Url.'dell-logo.png" alt="Dell Gutscheine" title="Alle Dell Gutscheine"/></a>
		   <a href="' . get_permalink(4309) . '"><img loading="lazy" src="'.$Img_Url.'drivenow-logo.png" alt="DriveNow Gutscheine" title="Alle DriveNow Gutscheine"/></a>
		   </div>';
  

  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
echo $class_close; 
}
wp_reset_query();
}

$first_char = 'E';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
  echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
 echo '<div class="logos">
       <a href="' . get_permalink(3975) . '"><img loading="lazy" src="'.$Img_Url.'ebay-logo.png" alt="Alle Ebay Gutscheine" title="Alle Ebay Gutscheine"/></a>
       <a href="' . get_permalink(3754) . '"><img loading="lazy" src="'.$Img_Url.'esprit-logo.png" alt="Alle Esprit Gutscheine" title="Alle Esprit Gutscheine"/></a>
       <a href="' . get_permalink(4282) . '"><img loading="lazy" src="'.$Img_Url.'euronics-logo.png" alt="Alle Euronics Gutscheine" title="Alle Euronics Gutscheine"/></a>
       <a href="' . get_permalink(4035) . '"><img loading="lazy" src="'.$Img_Url.'expedia-logo.png" alt="Alle Expedia Gutscheine" title="Alle Expedia Gutscheine"/></a>
       <a href="' . get_permalink(4080) . '"><img loading="lazy" src="'.$Img_Url.'eu-versandapotheke-logo.png" alt="Eu Versandapotheke Gutscheine" title="Alle Eu Versandapotheke Gutscheine"/></a>
       <a href="' . get_permalink(5713) . '"><img loading="lazy" src="'.$Img_Url.'efox-logo.png" alt="efox Gutscheine" title="Alle efox Gutscheine"/></a>
       </div>';
  

  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;

  echo $class_close;
}
wp_reset_query();
}

$first_char = 'F';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
  echo $class_start; 
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
 echo '<div class="logos">
       <a href="' . get_permalink(3814) . '"><img loading="lazy" src="'.$Img_Url.'frontlineshop-logo.png" alt="Alle Frontlineshop Gutscheine" title="Alle Frontlineshop Gutscheine"/></a>
       <a href="' . get_permalink(4538) . '"><img loading="lazy" src="'.$Img_Url.'fab-logo.png" alt="Alle fab Gutscheine" title="Alle fab Gutscheine"/></a>
       <a href="' . get_permalink(4138) . '"><img loading="lazy" src="'.$Img_Url.'fressnapf-logo.png" alt="Alle Fressnapf Gutscheine" title="Alle Fressnapf Gutscheine"/></a>
       <a href="' . get_permalink(4626) . '"><img loading="lazy" src="'.$Img_Url.'futterplatz-logo.png" alt="Alle Futterplatz Gutscheine" title="Alle Futterplatz Gutscheine"/></a>
       <a href="' . get_permalink(6932) . '"><img loading="lazy" src="'.$Img_Url.'flaconi-logo.png" alt="Flaconi Gutscheine" title="Alle Flaconi Gutscheine"/></a>
       <a href="' . get_permalink(6696) . '"><img loading="lazy" src="'.$Img_Url.'flug-de-logo.png" alt="Flug.de Gutscheine" title="Alle Flug.de Gutscheine"/></a>
       </div>';
  
  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
  echo $class_close;
}
wp_reset_query();
}

$first_char = 'G';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
   echo $class_start; 
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
 echo '<div class="logos">
       <a href="' . get_permalink(3858) . '"><img loading="lazy" src="'.$Img_Url.'gaastra-logo.png" alt="Alle H&amp;M Gutscheine" title="Alle H&amp;M Gutscheine"/></a>
       <a href="' . get_permalink(3965) . '"><img loading="lazy" src="'.$Img_Url.'galeria-kaufhof-logo.png" alt="Galeria Kaufhof Gutscheine" title="Alle Galeria Kaufhof Gutscheine"/></a>
       <a href="' . get_permalink(4108) . '"><img loading="lazy" src="'.$Img_Url.'goertz-logo.png" alt="Görtz Gutscheine" title="Alle Görtz Gutscheine"/></a>
       <a href="' . get_permalink(6926) . '"><img loading="lazy" src="'.$Img_Url.'gerry-weber-logo.png" alt="Gerry Weber Gutscheine" title="Alle Gerry Weber Gutscheine"/></a>
       <a href="' . get_permalink(4577) . '"><img loading="lazy" src="'.$Img_Url.'gartenmoebel-logo.png" alt="Gartenmöbel Gutscheine" title="Alle Gartenmöbel Gutscheine"/></a>
       <a href="' . get_permalink(4585) . '"><img loading="lazy" src="'.$Img_Url.'geschenkplanet-logo.png" alt="Geschenkplanet Gutscheine" title="Alle Geschenkplanet Gutscheine"/></a>
       </div>';
  
  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
  echo $class_close; 
}
wp_reset_query();
}

$first_char = 'H';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
   echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
 echo '<div class="logos">
       <a href="' . get_permalink(3760) . '"><img loading="lazy" src="'.$Img_Url.'h-und-m-logo.png" alt="H&amp;M Gutscheine" title="Alle H&amp;M Gutscheine"/></a>
       <a href="' . get_permalink(4617) . '"><img loading="lazy" src="'.$Img_Url.'herrenausstatter-logo.png" alt="Herrenausstatter Gutscheine" title="Alle Herrenausstatter Gutscheine"/></a>
       <a href="' . get_permalink(3905) . '"><img loading="lazy" src="'.$Img_Url.'heine-logo.png" alt="Heine Gutscheine" title="Alle Heine Gutscheine"/></a>
       <a href="' . get_permalink(3790) . '"><img loading="lazy" src="'.$Img_Url.'home24-logo.png" alt="Home24 Gutscheine" title="Alle Home24 Gutscheine"/></a>
       <a href="' . get_permalink(4048) . '"><img loading="lazy" src="'.$Img_Url.'holidaycheck-logo.png" alt="HolidayCheck Gutscheine" title="Alle HolidayCheck Gutscheine"/></a>
       <a href="' . get_permalink(3848) . '"><img loading="lazy" src="'.$Img_Url.'hse24-logo.png" alt="HSE24 Gutscheine" title="Alle HSE24 Gutscheine"/></a>
       </div>';
  
  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
  echo $class_close; 
}
wp_reset_query();
}

$first_char = 'I';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
     echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
  
  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
    echo $class_close;
}
wp_reset_query();
}

$first_char = 'J';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
       echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;

  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
     echo $class_close;
}
wp_reset_query();
}

$first_char = 'K';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
   echo $class_start;
  
echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;

  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
 echo $class_close;
}
wp_reset_query();
}


$first_char = 'L';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
   echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;

  
  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;

   echo $class_close;
  
}
wp_reset_query();
}

$first_char = 'M';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
   echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
 echo '<div class="logos">
       <a href="' . get_permalink(3767) . '"><img loading="lazy" src="'.$Img_Url.'mytoys-logo.png" alt="myToys Gutscheine" title="Alle myToys Gutscheine"/></a>
       <a href="' . get_permalink(3784) . '"><img loading="lazy" src="'.$Img_Url.'mister-spex-logo.png" alt="Mister Spex Gutscheine" title="Alle Mister Spex Gutscheine"/></a>
       <a href="' . get_permalink(3971) . '"><img loading="lazy" src="'.$Img_Url.'meinpaket-logo.png" alt="MeinPaket Gutscheine" title="Alle MeinPaket Gutscheine"/></a>
       <a href="' . get_permalink(4106) . '"><img loading="lazy" src="'.$Img_Url.'mirapodo-logo.png" alt="Mirapodo Gutscheine" title="Alle Mirapodo Gutscheine"/></a>
       <a href="' . get_permalink(3875) . '"><img loading="lazy" src="'.$Img_Url.'media-markt-logo.png" alt="Media Markt Gutscheine" title="Alle Media Markt Gutscheine"/></a>
       <a href="' . get_permalink(4819) . '"><img loading="lazy" src="'.$Img_Url.'mirabeau-logo.png" alt="mirabeau Gutscheine" title="Alle mirabeau Gutscheine"/></a>
       </div>';
  

  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
  echo $class_close;
}
wp_reset_query();
}


$first_char = 'N';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
   echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;

  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;

   echo $class_close;
  
}
wp_reset_query();
}

$first_char = 'O';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
   echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
 echo '<div class="logos">
       <a href="' . get_permalink(3745) . '"><img loading="lazy" src="'.$Img_Url.'otto-logo.png" alt="Otto Gutscheine" title="Alle Otto Gutscheine"/></a>
       <a href="' . get_permalink(3807) . '"><img loading="lazy" src="'.$Img_Url.'orsay-logo.png" alt="Orsay Gutscheine" title="Alle Orsay Gutscheine"/></a>
       <a href="' . get_permalink(3788) . '"><img loading="lazy" src="'.$Img_Url.'obi-logo.png" alt="Obi Gutscheine" title="Alle Obi Gutscheine"/></a>
       <a href="' . get_permalink(4040) . '"><img loading="lazy" src="'.$Img_Url.'orion-logo.png" alt="Orion Gutscheine" title="Alle Orion Gutscheine"/></a>
       <a href="' . get_permalink(4921) . '"><img loading="lazy" src="'.$Img_Url.'optikplus-logo.png" alt="optikplus Gutscheine" title="Alle optikplus Gutscheine"/></a>
       <a href="' . get_permalink(4938) . '"><img loading="lazy" src="'.$Img_Url.'optixone-logo.png" alt="optixone Gutscheine" title="Alle optixone Gutscheine"/></a>
       </div>';
  
  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;

   echo $class_close;
  
}
wp_reset_query(); 
}

$first_char = 'P';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
   echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
 echo '<div class="logos">
       <a href="' . get_permalink(3801) . '"><img loading="lazy" src="'.$Img_Url.'puma-logo.png" alt="Puma Gutscheine" title="Alle Puma Gutscheine"/></a>
       <a href="' . get_permalink(3951) . '"><img loading="lazy" src="'.$Img_Url.'planet-sports-logo.png" alt="Planet Sports Gutscheine" title="Alle Planet Sports Gutscheine"/></a>
       <a href="' . get_permalink(6951) . '"><img loading="lazy" src="'.$Img_Url.'plus-logo.png" alt="Plus Gutscheine" title="Alle Plus Gutscheine"/></a>
       <a href="' . get_permalink(6936) . '"><img loading="lazy" src="'.$Img_Url.'parfuemplatz-de-logo.png" alt="Parfümplatz.de Gutscheine" title="Alle Parfümplatz.de Gutscheine"/></a>
       <a href="' . get_permalink(4979) . '"><img loading="lazy" src="'.$Img_Url.'postertaxi-logo.png" alt="Postertaxi Gutscheine" title="Alle Postertaxi Gutscheine"/></a>
       <a href="' . get_permalink(3866) . '"><img loading="lazy" src="'.$Img_Url.'posterxxl-logo.png" alt="PosterXXL Gutscheine" title="Alle PosterXXL Gutscheine"/></a>
       </div>';
  
  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
 
   echo $class_close;
  
}
wp_reset_query();
}

$first_char = 'Q';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
   echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
 echo '<div class="logos">
       <a href="' . get_permalink(3763) . '"><img loading="lazy" src="'.$Img_Url.'quelle-logo.png" alt="Quelle Gutscheine" title="Alle Quelle Gutscheine"/></a>
       </div>';  

  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
 
  echo $class_close;
}
wp_reset_query();
}

$first_char = 'R';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
   echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
 echo '<div class="logos">
       <!--<a href="' . get_permalink(3805) . '"><img loading="lazy" src="'.$Img_Url.'redcoon-logo.png" alt="redcoon Gutscheine" title="Alle redcoon Gutscheine"/></a>-->
       <a href="' . get_permalink(3961) . '"><img loading="lazy" src="'.$Img_Url.'rebuy-logo.png" alt="reBuy Gutscheine" title="Alle reBuy Gutscheine"/></a>
       <a href="' . get_permalink(4084) . '"><img loading="lazy" src="'.$Img_Url.'runners-point-logo.png" alt="Runnners Point Gutscheine" title="Alle Runnners Point Gutscheine"/></a>
       <a href="' . get_permalink(5083) . '"><img loading="lazy" src="'.$Img_Url.'roller-logo.png" alt="Roller Gutscheine" title="Alle Roller Gutscheine"/></a>
       </div>';
  
  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
 
   echo $class_close;
}
wp_reset_query();
}

$first_char = 'S';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
   echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
 echo '<div class="logos">
       <a href="' . get_permalink(3985) . '"><img loading="lazy" src="'.$Img_Url.'sheego-logo.png" alt="Alle Sheego Gutscheine" title="Alle Sheego Gutscheine"/></a>
       <a href="' . get_permalink(3936) . '"><img loading="lazy" src="'.$Img_Url.'schwab-logo.png" alt="Alle Schwab Gutscheine" title="Alle Schwab Gutscheine"/></a>
       <a href="' . get_permalink(3758) . '"><img loading="lazy" src="'.$Img_Url.'s-oliver-logo.png" alt="Alle s.Oliver Gutscheine" title="Alle s.Oliver Gutscheine"/></a>
       <a href="' . get_permalink(3809) . '"><img loading="lazy" src="'.$Img_Url.'schuhtempel24-logo.png" alt="Alle Schuhtempel24 Gutscheine" title="Alle Schuhtempel24 Gutscheine"/></a>
       <a href="' . get_permalink(3963) . '"><img loading="lazy" src="'.$Img_Url.'shop-apotheke-logo.png" alt="Alle Shop Apotheke Gutscheine" title="Alle Shop Apotheke Gutscheine"/></a>
       <a href="' . get_permalink(3895) . '"><img loading="lazy" src="'.$Img_Url.'saturn-logo.png" alt="Alle Saturn Gutscheine" title="Alle Saturn Gutscheine"/></a>
       </div>';
  
  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
  echo $class_close;
}
wp_reset_query();
}


$first_char = 'T';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
   echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;

  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
  echo $class_close;
}
wp_reset_query(); 
}

$first_char = 'U';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
   echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;

  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
  echo $class_close;
}
wp_reset_query(); 
}


$first_char = 'V';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
 
  echo $class_start; 
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
  
  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
   echo $class_close;
}
wp_reset_query();
}

$first_char = 'W';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
   echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
 echo '<div class="logos">
       <a href="' . get_permalink(3924) . '"><img loading="lazy" src="'.$Img_Url.'weg-de-logo.png" alt="weg.de Gutscheine" title="Alle weg.de Gutscheine"/></a>
       <a href="' . get_permalink(6785) . '"><img loading="lazy" src="'.$Img_Url.'windeln-de-logo.png" alt="windeln.de Gutscheine" title="Alle windeln.de Gutscheine"/></a>
       </div>';
  
  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
 
  echo $class_close;
}
wp_reset_query();
}


$first_char = 'X';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
  echo $class_start; 
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;

  
  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
  echo $class_close;
}
wp_reset_query();
}

$first_char = 'Y';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
   echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
  echo '<div class="logos">
       <a href="' . get_permalink(3938) . '"><img loading="lazy" src="'.$Img_Url.'yves-rocher-logo.png" alt="Yves Rocher Gutscheine" title="Alle Yves Rocher Gutscheine"/></a>
       </div>';
  
  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
 
   echo $class_close;
  
}
wp_reset_query();
}


$first_char = 'Z';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
   echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
 echo '<div class="logos">
       <a href="' . get_permalink(3747) . '"><img loading="lazy" src="'.$Img_Url.'zalando-logo.png" alt="zalando Gutscheine" title="Alle zalando Gutscheine"/></a>
       <a href="' . get_permalink(3864) . '"><img loading="lazy" src="'.$Img_Url.'zalando-lounge-logo.png" alt="zalando lounge Gutscheine" title="Alle zalando lounge Gutscheine"/></a>
       <a href="' . get_permalink(5000) . '"><img loading="lazy" src="'.$Img_Url.'zarima-logo.png" alt="Zarima Gutscheine" title="Alle Zarima Gutscheine"/></a>
       <a href="' . get_permalink(3819) . '"><img loading="lazy" src="'.$Img_Url.'zooplus-logo.png" alt="Zooplus Gutscheine" title="Alle Zooplus Gutscheine"/></a>
       <a href="' . get_permalink(4122) . '"><img loading="lazy" src="'.$Img_Url.'zooroyal-logo.png" alt="zooroyal Gutscheine" title="Alle zooroyal Gutscheine"/></a>
       <a href="' . get_permalink(4062) . '"><img loading="lazy" src="'.$Img_Url.'zur-rose-logo.png" alt="zur Rose Gutscheine" title="Alle zur Rose Gutscheine"/></a>
       </div>';
  
  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
 
  echo $class_close; 
  
}
wp_reset_query();
}

$first_char = '0';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
   echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
 echo '<ul class="stores">';
  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
  echo $class_close;
}
wp_reset_query();
}

$first_char = '1';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
   echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
  
  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
 echo $class_close;
}
wp_reset_query();
}


$first_char = '2';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
 echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;

  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
 echo $class_close;
}
wp_reset_query();
}

$first_char = '3';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
  echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;

  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
echo $class_close;
}
wp_reset_query();
}


$first_char = '4';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
 echo $class_start; 
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;

  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
echo $class_close;
}
wp_reset_query();
}

$first_char = '5';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
  echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;
  
  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
 echo $class_close;
}
wp_reset_query();
}

$first_char = '6';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
  echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;

  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
echo $class_close;
}
wp_reset_query();
}


$first_char = '7';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
  echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;

  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;

  echo $class_close;
}
wp_reset_query();
}

$first_char = '8';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
  echo $class_start;
  
 echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;

  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;
  
echo $class_close;
}
wp_reset_query();
}


$first_char = '9';
$postids=$wpdb->get_col($wpdb->prepare("SELECT ID FROM $wpdb->posts WHERE SUBSTR($wpdb->posts.post_title,1,1) = %s ORDER BY $wpdb->posts.post_title",$first_char));
if ($postids) {
$args=array( 'post__in' => $postids,'post_type' => 'post','post_status' => 'publish','posts_per_page' => -1,'caller_get_posts'=> 1,'orderby'=> 'title', 'order' => 'ASC');
$my_query = null;
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
  
  echo $class_start;
  
echo $shop_list_head_before . $first_char. '<a id="'. $first_char. '"></a>' . $shop_list_head_after;

  while ($my_query->have_posts()) : $my_query->the_post(); ?><a href="<?php the_permalink() ?>" rel="bookmark" title="Zu den <?php the_title_attribute(); ?> Gutscheinen"><?php the_title(); ?></a><?php endwhile;

  echo $class_close;
}
wp_reset_query();
}
?>
			

	  
	  
	  
	 
	  
	  
	  


<?php get_footer(); ?>