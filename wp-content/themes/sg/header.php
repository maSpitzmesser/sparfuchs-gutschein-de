<!DOCTYPE html><html lang="de-DE" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"<?php if (isset($_GET['lightbox'])) { echo ' class="lightbox"'; } ?> itemscope itemtype="http://schema.org/WebPage">
<head>
	<meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title itemprop='name'><?php wp_title(); ?></title>
    <!--<meta name="verification" content="f0274e886ecb8dda1937c82d3c1bee90" />-->
  
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" as="style" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" />
  
  <link rel="preload" href="https://sparfuchs-gutschein.de/wp-content/themes/sg/styles/fonts/icomoon.woff" as="font" type="font/woff2" crossorigin="anonymous" />

    <?php wp_head();
	 if (is_front_page() ) : ?>
		<meta name="keywords" content="Gutschein, Rabatt, Gutscheincode"/>
	<?php else : ?>
        <meta name="keywords" content="<?php the_title(); ?> Gutschein, <?php the_title(); ?> Rabatt, <?php the_title(); ?> Gutscheincode"/>
	<?php endif ?>

	<?php if (current_user_can( 'manage_options' )) {
		$theme_root = get_template_directory();
		$cssFiles   = glob($theme_root . "/styles/css/*.css");
		foreach ($cssFiles as $cssFile){
			$cssFilesName = pathinfo($cssFile, PATHINFO_FILENAME); ?>
			<link rel="stylesheet" href="<?php echo bloginfo('template_directory') . '/styles/css/' . $cssFilesName ?>" media="print, screen" /><?php  PHP_EOL;
		}

	} else  { ?>
		<link rel="preload" href="<?php echo bloginfo('template_directory') ?>/styles/css/sg_min_all_2.css.gz" as="style"/>
		<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/sg_min_all_2.css.gz" media="print, screen" />
	<?php }  ?>
  
    <link rel="preload" href="/wp-content/themes/sg/styles/flat/theme.css" as="style" />
    <link rel="stylesheet" href="/wp-content/themes/sg/styles/flat/theme.css" media="screen" />
  

  
	<link rel="shortcut icon" href="<?php bloginfo('url'); ?>/favicon.ico" type="image/x-icon"/>
	<link rel="apple-touch-icon" href="https://sparfuchs-gutschein.de/wp-content/themes/sg/images/logo/apple-touch-icon_152x152.png"/>

    <meta name="theme-color" content="#ff5800"/>
</head>

<body class="hfeed">

	<header itemscope itemtype="http://schema.org/Organization" role="banner">
		<!--<div class="bread">
            <a href="<?php echo get_permalink( 3747 ); ?>" title="Zu den <?php echo get_the_title( 3747 ); ?> Gutscheinen"><?php echo get_the_title( 3747 ); ?> Gutscheine</a>
			<a href="<?php echo get_permalink( 3745 ); ?>"  title="Zu den <?php echo get_the_title( 3745 ); ?> Gutscheinen"><?php echo get_the_title( 3745 ); ?> Gutscheine</a>
			<a href="<?php bloginfo('url'); ?>/reise-urlaub/" title="Zu den Urlaubs Sparvorteile">Urlaubs Sparvorteile</a>

			<a href="<?php bloginfo('url'); ?>/exklusive-gutscheine/" title="Zu den Exklusive Gutscheincodes">Exklusive Gutscheincodes</a>
		
		</div>-->

		<a id="logo" href="<?php bloginfo('url'); ?>" title="Sparfuchs-Gutschein.de" itemprop="url" rel="home">
			<img src="<?php bloginfo('url'); ?>/wp-content/themes/sg/images/logo/sparfuchs-gutschein-logo.min.png" alt="Sparfuchs-Gutschein" title="Gutscheincodes bei Sparfuchs-Gutschein.de"/>
		</a>

		<form class="style-a1" method="get" action="<?php bloginfo('url'); ?>" role="search">
			<input id="s" name="s" type="text" value="Shopname hier eingeben, z.B.: Zalando..."/>
			<input id="submit" name="Search" type="submit" value=""/>
            <label class="hidden" for="s">Sparvorteil für Online-Shop suchen?</label>
		</form>

        <nav class="main-menu style-a1">
            <span class="mobile-menu-button">
                <span class="mobile-menu-icon"></span>
                <span class="mobile-menu-text">Menü</span>
            </span>
            <ul><?php wp_nav_menu( array( 'container' => '', 'items_wrap' => '%3$s' ) ); ?></ul>
        </nav>

	</header>

<div id="main" class="main" role="main">
<?php	if (is_page()  || is_single()) : breadcrumb(); endif; ?>
