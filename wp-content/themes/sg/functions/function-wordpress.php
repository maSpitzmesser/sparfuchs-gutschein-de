<?php // Wordpress spezifische Funktionen
//function user_agent() {
  //$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
  //$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
  //$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
  //$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
  //$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

  //if ($iphone || $android || $palmpre || $ipod || $berry == true){
  //echo '<link rel="stylesheet" href="http://sg.sparfuchs-gutschein.de/fuchs.css.gz" type="text/css" media="handheld"/>';
  //echo '<link rel="stylesheet" href="/wp-content/themes/sg/styles/flat/theme.css.gz" type="text/css" media="screen"/>';
  //} else {
  //echo '<link rel="stylesheet" href="http://sg.sparfuchs-gutschein.de/fuchs.css.gz" type="text/css" media="print, screen, projection"/>';
  //echo '<link rel="stylesheet" href="/wp-content/themes/sg/styles/flat/theme.css.gz" type="text/css" media="screen"/>';
  //}
//}


  function add_vary_header($headers) {
    $headers['Vary'] = 'User-Agent';
    return $headers;
  }
  add_filter('wp_headers', 'add_vary_header');


  function my_deregister_scripts(){
    wp_deregister_script( 'wp-embed' );
  }
  add_action( 'wp_footer', 'my_deregister_scripts' );

  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );


//Remove Gutenberg Block Library CSS from loading on the frontend
  function smartwp_remove_wp_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'wp-block-library-theme' );
    wp_dequeue_style( 'wc-block-style' ); // Remove WooCommerce block CSS
  }
  add_action( 'wp_enqueue_scripts', 'smartwp_remove_wp_block_library_css', 100 );


  function wpseo_disable_rel_next_home( $link ) {
    if ( is_home() ) {
      return false;
    }
  }
  add_filter( 'wpseo_next_rel_link', 'wpseo_disable_rel_next_home' );




  remove_action('wp_head', 'wp_generator');



// sauberes Men�
  function cssklassen_menu_classes($classes, $item) {
    $classes = array_filter(
      $classes,
      create_function( '$class',
        'return in_array( $class,
									array( "current-menu-item", "current-menu-parent" ) );' )
    );
    return array_merge(
      $classes,
      (array)get_post_meta( $item->ID, '_menu_item_classes', true )
    );
  }
  add_filter('nav_menu_css_class', 'cssklassen_menu_classes', 10, 2);


  add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
  function my_css_attributes_filter($var) {
    return is_array($var) ? array() : '';
  }


  function change_menu_classes($css_classes, $item) {
    $css_classes = str_replace("current-menu-item", "active", $css_classes);
    $css_classes = str_replace("current-menu-parent", "active", $css_classes);
    $css_classes = str_replace("current-menu-ancestor", "active", $css_classes);
    return $css_classes;
  }
  add_filter('nav_menu_css_class', 'change_menu_classes', 10, 2);



  function remove_recent_comment_style() {
    global $wp_widget_factory;
    remove_action(
      'wp_head',
      array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' )
    );
  }
  add_action( 'widgets_init', 'remove_recent_comment_style' );



//remove class from the_post_thumbnail
  function the_post_thumbnail_remove_class($output) {
    $output = preg_replace('/class=".*?"/', '', $output);
    return $output;
  }
  add_filter('post_thumbnail_html', 'the_post_thumbnail_remove_class');





  function theme_setup() {
    add_theme_support( 'automatic-feed-links' );
    add_theme_support( 'post-formats', array( 'aside', 'image', 'link', 'quote', 'status' ) );
    register_nav_menu( 'primary', __( 'Primary Menu', 'twentytwelve' ) );
    add_theme_support( 'post-thumbnails' );

    set_post_thumbnail_size( 350, 262, true ); // blog post thumbnails
    add_image_size( 'thumb-small', 30, 30, true ); // used in the sidebar widget
    add_image_size( 'thumb-med', 75, 75, true ); // used on the admin coupon list view
    add_image_size( 'thumb-large', 230, 172, true );
  }
  add_action( 'after_setup_theme', 'theme_setup' );





  function custom_sidebar() {
    if (!function_exists('register_sidebars')) return;

    register_sidebar(array(
      'name' 								=> 'Shop Sidebar',
      'id'            						=> 'sidebar_shop',
      'description'  			=> '',
      'before_widget'  => '<div>',
      'after_widget'  		=> '</div>',
      'before_title'  			=> '<span>',
      'after_title'   				=> '</span>'
    ));

    register_sidebar(array(
      'name'        				   => 'Page Sidebar',
      'id'           						 => 'sidebar_page',
      'description' 			   => '',
      'before_widget'  => '<div>',
      'after_widget'  		=> '</div>',
      'before_title'				 => '<span>',
      'after_title'						 => '</span>'
    ));

    register_sidebar(array(
      'name'          				=> 'Kategorien Sidebar',
      'id'            						=> 'sidebar_cats',
      'description'  			=> '',
      'before_widget'  => '<div>',
      'after_widget'  		=> '</div>',
      'before_title' 			=> '<span>',
      'after_title' 					=> '</span>'
    ));
  }
  add_action( 'widgets_init', 'custom_sidebar' );



  if ( ! function_exists( 'twentytwelve_comment' ) ) :

    function twentytwelve_comment( $comment, $args, $depth ) {
      $GLOBALS['comment'] = $comment;
      switch ( $comment->comment_type ) :
        case 'pingback' :
        case 'trackback' :
          // Display trackbacks differently than normal comments.
          ?>
            <li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
            <p><?php _e( 'Pingback:', 'twentytwelve' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'twentytwelve' ), '<span class="edit-link">', '</span>' ); ?></p>
          <?php
          break;
        default :
          // Proceed with normal comments.
          global $post;
          ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
            <article id="comment-<?php comment_ID(); ?>" class="comment">
                <header class="comment-meta comment-author vcard">
                  <?php
                    echo get_avatar( $comment, 44 );
                    printf( '<cite><b class="fn">%1$s</b> %2$s</cite>',
                      get_comment_author_link(),
                      // If current post author is also comment author, make it known visually.
                      ( $comment->user_id === $post->post_author ) ? '<span>' . __( 'Post author', 'twentytwelve' ) . '</span>' : ''
                    );
                    printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
                      esc_url( get_comment_link( $comment->comment_ID ) ),
                      get_comment_time( 'c' ),
                      /* translators: 1: date, 2: time */
                      sprintf( __( '%1$s at %2$s', 'twentytwelve' ), get_comment_date(), get_comment_time() )
                    );
                  ?>
                </header><!-- .comment-meta -->

              <?php if ( '0' == $comment->comment_approved ) : ?>
                  <p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentytwelve' ); ?></p>
              <?php endif; ?>

                <section class="comment-content comment">
                  <?php comment_text(); ?>
                  <?php edit_comment_link( __( 'Edit', 'twentytwelve' ), '<p class="edit-link">', '</p>' ); ?>
                </section><!-- .comment-content -->

                <div class="reply">
                  <?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'twentytwelve' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                </div><!-- .reply -->
            </article><!-- #comment-## -->
          <?php
          break;
      endswitch; // end comment_type check
    }
  endif;




  function sg_form_style() {
    if ( is_page ( 'Kontakt' ) || is_page ( 'Feedback' ) || is_page ( 'Gutschein melden' ) ) {
      global $wp_scripts;
      wp_register_style( 'form-style', get_bloginfo('template_directory').'/templates/forms/css/form.css', '1.0.0', true);
      wp_enqueue_style( 'form-style' );
      wp_register_style( 'select-style', get_bloginfo('template_directory').'/templates/forms/css/cs-select.css', '1.0.0', true);
      wp_enqueue_style( 'select-style' );
    }
  }
  add_action('wp_enqueue_scripts', 'sg_form_style');


  function sg_form_script() {
    if ( is_page ( 'Kontakt' ) || is_page ( 'Feedback' ) || is_page ( 'Gutschein melden' ) ) {
      global $wp_scripts;

      wp_register_script('classie-js', get_bloginfo('template_directory').'/templates/forms/js/classie.js', '1.0.0', true);
      wp_enqueue_script('classie-js');

      wp_register_script('selectFx-js', get_bloginfo('template_directory').'/templates/forms/js/selectFx.js', '1.0.0', true);
      wp_enqueue_script('selectFx-js');

      //wp_register_script('tipsy-js', get_bloginfo('template_directory').'/forms/js/jquery.tipsy.js', '1.0.0', true);
      //wp_enqueue_script('tipsy-js');

      //wp_register_script('validation-js', get_bloginfo('template_directory').'/forms/js/validation.js');
      //wp_enqueue_script('validation-js');

      wp_register_script('s3Capcha-js', get_bloginfo('template_directory').'/templates/forms/js/s3Capcha.js', '1.0.0', true);
      wp_enqueue_script('s3Capcha-js');

      wp_register_script('form-js', get_bloginfo('template_directory').'/templates/forms/js/form.js', '1.0.0', true);
      wp_enqueue_script('form-js');
    }
  }
  add_action('wp_footer', 'sg_form_script');



  function custom_login() {
    echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/styles/login-style.css" />';
  }
  add_action('login_head', 'custom_login');
  function my_login_logo_url() {
    return home_url();
  }
  add_filter( 'login_headerurl', 'my_login_logo_url' );

  function my_login_logo_url_title() {
    return '';
  }
  add_filter( 'login_headertitle', 'my_login_logo_url_title' );

?>
