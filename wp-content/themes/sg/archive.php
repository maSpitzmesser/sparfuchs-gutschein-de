<?php /* Template Name: Alle Shops Template */
get_header();

$post_type = "'post'";
$alphabet  = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
$numbers   = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
$keys      = array_merge($alphabet, $numbers);

function get_page_permalink_from_name($page_name) {
  global $wpdb;
  $pageid_name = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_title = '" . $page_name . "' LIMIT 0, 1");
  return get_permalink($pageid_name);
}
?>
<section class="navigation-abc style-a1">
  <h1 class="headline-a1">
    <?php
    $sql   = "SELECT count(DISTINCT post_title) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = $post_type";
    $posts = $wpdb->get_var($sql);
    echo $posts; ?> Online Shops mit Gutscheinen, Rabatten und Schnäppchen von A-Z
  </h1>
  <nav class="ABC">
    <?php
    foreach ($alphabet as $key) {
      $sql   = "SELECT DISTINCT post_title FROM $wpdb->posts WHERE SUBSTR(post_title,1,1) = %s AND post_status = 'publish' AND post_type = $post_type ORDER BY post_title";
      $posts = $wpdb->get_results($wpdb->prepare($sql, $key) );

      $disabledClass     = $posts ? '' : 'btn-secondary disabled';
      $disabledAttribute = $posts ? '' : 'disabled=""';

      echo '<a href="#' . $key . '" title="Alle Online-Shops die mit ' . $key . ' beginnen" >' . $key . '</a>';
    }
    ?>
    <a href="#1" title="Alle Online-Shops beginnend von 0-4">0-4</a>
    <a href="#5" title="Alle Online-Shops beginnend von  0-9">5-9</a>
  </nav>

  <a href="#logo" class="oben" title="hier klicken um wieder nach oben zu kommen"><span>NACH</span><span>OBEN</span></a>
</section>

<?php
foreach ($keys as $key) {
  $sql   = "SELECT DISTINCT post_title FROM $wpdb->posts WHERE SUBSTR(post_title,1,1) = %s AND post_status = 'publish' AND post_type = $post_type ORDER BY post_title";
  $posts = $wpdb->get_results($wpdb->prepare($sql, $key) );

  if ($posts) {
    echo '
      <section class="col-first span_3_of_3 shop-list style-a1">
          <h3>
            ' . $key . '
            <a id="'. $key . '"></a>
          </h3>';

    foreach ($posts as $post) {
      echo'<a href="' . get_page_permalink_from_name( $post->post_title ) . '" rel="bookmark" title="Zu den ' . $post->post_title . ' Produkten">
             ' . $post->post_title . '
          </a>';
    }
    echo '
      </section>
    ';
  }
}


get_footer(); ?>
