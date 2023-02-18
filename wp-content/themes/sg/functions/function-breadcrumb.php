<?php
function breadcrumb() {
	echo '<ol class="breadcrumbs" itemscope itemtype="http://schema.org/BreadcrumbList">';
	echo '<li>Sie befinden sich hier:</li>';  
		if(is_page() && !is_front_page()){
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'.get_bloginfo('url').'"><span itemprop="name">Startseite</span></a><meta itemprop="position" content="1" />&raquo;</li>';
			$post_anchestors = get_post_ancestors($post);
				if($post_anchestors){
					$post_anchestors = array_reverse($post_anchestors);
					foreach($post_anchestors as $crumb){
						echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'.get_permalink($crumb).'" title="'.get_the_title($crumb).'"><span itemprop="name">'.get_the_title($crumb).'</span></a></li>';
					}
				}
				echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'.get_permalink($ID).'"><span itemprop="name">'.get_the_title().'</span></a></li>';
		} 
		elseif(is_single()){
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'.get_bloginfo('url').'" title="zur Startseite"><span itemprop="name">Startseite</span></a><meta itemprop="position" content="1" /></li>';
			$breadcrumb_category = get_the_category();
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'.get_category_link($breadcrumb_category[0]->cat_ID).'" title="'.$breadcrumb_category[0]->cat_name.' Codes"><span itemprop="name">'.$breadcrumb_category[0]->cat_name.'</span></a><meta itemprop="position" content="2" /></li>';
			echo '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" href="'.get_permalink($ID).'" title="'.get_the_title().'"><span itemprop="name">'.get_the_title().'</span></a><meta itemprop="position" content="3" /></li>';
		}
	echo '</ol>';
} ?>