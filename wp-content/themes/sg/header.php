<!DOCTYPE html><html lang="de-DE" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#"<?php if (isset($_GET['lightbox'])) { echo ' class="lightbox"'; } ?> itemscope itemtype="http://schema.org/WebPage">
<head>
	<meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<title itemprop='name'><?php wp_title(); ?></title>
    <!--<meta name="verification" content="f0274e886ecb8dda1937c82d3c1bee90" />-->
  
  <link rel="preload" href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" as="style" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" />
  <link rel="preload" href="<?php echo bloginfo('template_directory') ?>/styles/fonts/icomoon.woff" as="font" type="font/woff2" crossorigin="anonymous" />

  	<!-- All individual CSS files -->
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/1html5reset.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/2cols.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/3cols.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/4cols.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/5cols.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/breadcrumb.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/col.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/cookie-banner.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/coupon.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/dropdowns.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/footer.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/fuchs.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/google-ads.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/header.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/lightbox.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/main-menu.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/searchform-autocomplet.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/side-nav.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/slick-carousel.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/social-networks.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/star-rating.css" media="print, screen" />
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory') ?>/styles/css/tabs.css" media="print, screen" />

   <?php wp_head();
	 if (is_front_page() ) : ?>
		<meta name="keywords" content="Gutschein, Rabatt, Gutscheincode"/>
	<?php else : ?>
        <meta name="keywords" content="<?php the_title(); ?> Gutschein, <?php the_title(); ?> Rabatt, <?php the_title(); ?> Gutscheincode"/>
	<?php endif; ?>
  
    <link rel="preload" href="/wp-content/themes/sg/styles/flat/theme.css" as="style" />
    <link rel="stylesheet" href="/wp-content/themes/sg/styles/flat/theme.css" media="screen" />
  

  
	<link rel="shortcut icon" href="<?php bloginfo('url'); ?>/favicon.ico" type="image/x-icon"/>
	<link rel="apple-touch-icon" href="<?php echo bloginfo('template_directory') ?>/images/logo/apple-touch-icon_152x152.png"/>

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
