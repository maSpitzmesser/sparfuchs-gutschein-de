<?php
function sg_rating() {
  
  global $wpdb;
  $table = $wpdb->prefix . 'postmeta';
  
  $title = get_the_title($id);
  
  $rated_posts = $wpdb->get_results("SELECT a.ID, a.post_title, b.meta_value AS 'ratings' FROM " . $wpdb->posts . " a, $table b, $table c WHERE a.post_status='publish' AND a.ID='$title' AND a.ID=c.post_id ORDER BY b.meta_value DESC, c.meta_value DESC LIMIT 1");
			
    foreach ( $rated_posts as $rating ) {
  
	echo '<div class="legende" typeof="v:Review-aggregate">

							<span rel="v:rating">
      						<span typeof="v:Rating">
         						<span property="v:average">' . $rating->total_value  . '</span>';
        							echo ' von '; 
         				echo '<span property="v:best">5</span>
      						</span>
   						</span>';
   				echo ' bei ';
   				echo '<span property="v:votes">' . $rating->total_votes . '</span>';
					echo ' Bewertungen ';		
	echo '</div>';
  }
} ?>