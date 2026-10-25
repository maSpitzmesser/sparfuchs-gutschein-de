<?php if (empty($_GET['lightbox'])) {  ?>
<link rel="stylesheet" href="<?php bloginfo('url'); ?>/wp-content/themes/sg/admin/css/admin_frontend.css" type="text/css" media="print, screen, projection"/>
<?php


if ( isset( $_POST["wp_cache_content_delete"]) ) {
 wp_cache_clear_cache();
}
 
    $current_user = wp_get_current_user();
   $current_user->user_login;
    $current_user->user_email;
   $current_user->user_firstname;
    $current_user->user_lastname;
    $current_user->display_name;
    $current_user->ID;
?>




<div id="website-assistent" class="website-assistent-out" >
	<span class="button-in-out"></span>
	
		<div class="website-assistent-row website-assistent-user">
		     <span class="website-assistent-avatar-img"><?php $size = 35; echo get_avatar( $current_user->ID, $size, $default, $alt, $args ); ?></span>
				 <p>Hello again, <br/><strong><?php echo $current_user->user_firstname; ?> <?php echo $current_user->user_lastname; ?></strong></p>
		</div>
	
	<div class="website-assistent-row">
			<a  href="<?php bloginfo('url'); ?>/wp-admin/" title="zum Dashboard">
			<span class="dashicons dashicons-dashboard"></span>
			Dashboard
		</a>
		</div>
		
		
	<?php if (is_front_page() ) : ?>	
		<div class="website-assistent-row">
			<a href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=slider-options" title="Slider bearbeiten">
				<span class="dashicons dashicons-images-alt2"></span>Slider bearbeiten
			</a>
		</div>
	<?php endif ?>
	
	
	<?php if (!is_front_page() ) : ?>	
		<div class="website-assistent-row">
			<a href="<?php bloginfo('url'); ?>/wp-admin/post.php?post=<?php echo the_ID(); ?>&action=edit" title="Seite bearbeiten">
				<?php if (is_page() ) : ?><span class="dashicons dashicons-edit"></span>Seite bearbeiten<?php else : ?><span class="dashicons dashicons-cart"></span>Shop bearbeiten<?php endif ?>
			</a>
		</div>
	<?php endif ?>
	
	<?php if (!is_page() && !is_front_page()) : ?>
		<div class="website-assistent-row">
			<a  href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=coupon-op-settings" title="Neuer Gutschein anlegen">
			<span class="dashicons dashicons-tag"></span>
			Neuer Gutschein
		</a>
		</div>
	<?php endif ?>
		
	


					<div class="website-assistent-row">
		<span class="dashicons dashicons-editor-spellcheck"></span>
		
		    <label for="spell-check-switch" class="noselect" title="Rechtschreibprüfung für den Webseiten Text. Etwas buggy aber funtioniert.">Rechtschreibprüfung</label>
        <div class="onoffswitch">				
          <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="spell-check-switch" autocomplete="off" />
          <label class="onoffswitch-label" for="spell-check-switch"></label>
        </div>

        <p id="spell-check-active"></p>

		</div>
		
		<div class="website-assistent-row">
		<a  href="<?php bloginfo('url'); ?>/wp-admin/widgets.php" title="Sidebar bearbeiten">
			<span class="dashicons dashicons-list-view"></span>
			Sidebar bearbeiten
		</a>
	</div>
		
		
	<div class="website-assistent-row">
		<a  href="<?php bloginfo('url'); ?>/wp-admin/admin.php?page=sg_mysql-options" title="MySQL Datenbank">
			<span class="dashicons dashicons-grid-view"></span>
			MySQL Datenbank
		</a>
	</div>
		
			<div class="website-assistent-row">
			<form action="?page=wpsupercache&amp;tab=contents" method="post">
					<span class="dashicons dashicons-trash"></span>
					<input name="wp_cache_content_delete" id="deletepost" class="website-assistent-button" value="Webseiten Cache leeren " type="submit">		
			</form>
			</div>
  
  
  			<div class="website-assistent-row javascript-error">
				<p>
					 <span>Javascript</span><br/>
					 <span>is brocken!</span>
				</p>
			</div>
		
</div>
<?php }?>