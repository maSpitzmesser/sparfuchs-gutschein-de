<?php /** single categorie */
  get_header();
  global $wpdb;
  
  $page = intval(get_query_var('page'));
  $start = $page*20;
  
  $cat = get_query_var('cat');
  $yourcat = get_category ($cat);
  
  $query = "SELECT post_name FROM $wpdb->posts
            LEFT JOIN $wpdb->term_relationships ON ($wpdb->posts.ID = $wpdb->term_relationships.object_id)
            LEFT JOIN $wpdb->term_taxonomy ON ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
            WHERE $wpdb->posts.post_status = 'publish'
            AND $wpdb->term_taxonomy.taxonomy = 'category'
            AND $wpdb->term_taxonomy.term_id = $yourcat->cat_ID";
  
  $posts = $wpdb->get_col($query);
  $implodeshops = implode("','", $posts);
  
  //echo '<span class="hidden debug">' . $implodeshops . '</span>';
  
  
  $sql = "SELECT * FROM awin_vouchers
            WHERE Shopname in ('$implodeshops')
            ORDER BY Ends DESC
            LIMIT 100";
  
  //LIMIT $start, 20";
  
  $offers = $wpdb->get_results($sql);
  
  $offer_count = $wpdb->get_var("SELECT count(*) FROM awin_vouchers WHERE Shopname in ('$implodeshops')");
  
  
  //echo '<span class="hidden debug">';
  //print_r ($offer_count);
  //echo '</span>';

    //echo '<span class="hidden debug">';
  //echo print_r ($offers);
  //echo '</span>';
  
  $cat_name = $yourcat->cat_name;
?>
    <article class="col-first span_3_of_4 " >

        <div class="category-header style-a1">
            <h1 class="headline-a1"><?php echo $cat_name ?> Gutscheine</h1>
            <figure><img src="http://sg.sparfuchs-gutschein.de/images/kategorien/<?php echo $yourcat->cat_ID; ?>.jpg" alt="<?php echo $cat_name ?>"/></figure>
            <p>Hier findest du alle Online-Shops, Gutscheine &amp; Gutscheincodes zu <?php echo $cat_name ?> nach alphabet und folgender Aufteilung:</p>
            <p style="padding-left: 85px;">
                <a class="pfeil" href="#top-shops">Beliebteste Online-Shops <?php echo $cat_name ?></a><br>
                <a class="pfeil" href="#topcodes">Neue <?php echo $cat_name ?> Gutscheincodes </a><br>
                <a class="pfeil" href="#alleshops">Liste aller Online-Shops zu <?php echo $cat_name ?></a><br>
            </p>
        </div>

        <div class="logos style-a1">
            <h3 class="headline-a2" id="top-shops">Top Shops der Kategorie <?php echo $yourcat->cat_name; ?></h3>
          <?php $args = array( 'category' => $yourcat->cat_ID, 'post_type' => 'post', 'post_status' => 'publish', 'posts_per_page' => 6, 'offset'=> 1, 'orderby' => 'post_date', 'order' => 'ASC' );
            $myposts = get_posts( $args ); foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
              <a href="<?php the_permalink(); ?>"><?php get_logo($shopname); ?></a>
          <?php endforeach; ?>
        </div>
      
      <?php //include_once 'includes/adsense.php'; ?>

        <div class="style-a1">
            <h2 class="headline-a2" id="topcodes">Die Neusten Gutscheine zu <?php echo $cat_name ?></h2>
            <ul class="c">
              <?php
                foreach ($offers as $offer) {
                    include dirname(__FILE__).'/templates/offers/offer-awin.php';
                }
              ?>
            </ul>
            <style>
                ul.pagination {
                    display: inline-block;
                    padding: 0;
                    margin: 0;
                }

                ul.pagination li {display: inline;}

                ul.pagination li a {
                    color: black;
                    float: left;
                    padding: 8px 16px;
                    text-decoration: none;
                    background: #FFF;
                    box-shadow: 0px 0px 0px 1px #303438;
                    margin-right: 10px;
                }


            </style>


        </div>

    </article>





    <aside class="col span_1_of_4 sidebar" role="complementary">
      <?php if(!function_exists('dynamic_sidebar') || dynamic_sidebar('Page Sidebar') ) {} ?>
    </aside>

    <div class="col-first span_3_of_4 hidden">
        <ul class="pagination">
            <li>
                <a href="?page=<?php echo $page-1 ?>">«</a>
            </li>
            <?php
              for ($n=0; $n<= ceil($offer_count/11); $n++) { ?>
              <li>
                  <a href="?page=<?php echo $n ?>"><?php echo ($n+1) ?></a>
              </li>
            <?php } ?>
            <li>
                <a href="?page=<?php echo $page+1 ?>">»</a>
            </li>
        </ul>
    </div>

    <section class="col-first span_4_of_4 shop-list style-a1">
        <h3 class="headline-a2" id="alleshops">Alle Shops der Kategorie <?php echo $cat_name ?></h3>

        <div class="select-box">
            <select class="dropdown">
                <optgroup label="Ansicht:" class="optgroup">
                    <option class="option active" style="background-image: url(http://sg.sparfuchs-gutschein.de/images/liste.png);" >Liste</option>
                    <option class="option"           style="background-image: url(http://sg.sparfuchs-gutschein.de/images/Bilder.png);">Logos</option>
                </optgroup>
            </select>
        </div>


        <div id="select-container shop-list style-a1">
          <?php  ?>
            <div class="select-content">
              <?php
                $args = array( 'category' => $yourcat->cat_ID, 'posts_per_page' => -1, 'offset'=> 1, 'orderby' => 'title',  'order'=> 'ASC' );
                $myposts = get_posts( $args );
                foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <?php endforeach;
              
              ?>
            </div>

            <div class="select-content hidden">
            <span class="logos">
                <?php
  
                  foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
                      <a href="<?php the_permalink(); ?>">
                    <?php get_logo_lazy($shopname); ?>
                    </a>
                  <?php endforeach; ?>
            </span>
            </div>

        </div>
    </section>


    <style>
        article {
            padding: 0;
        }

        .category-header,
        .logos  {
            margin-bottom: 25px;
        }

        figure {
            margin: 0 15px 15px 0
        }

        .select-content.active {
            display:inline-block;
        }

        .c {
            padding: 0 15px;
        }


        #topcodes {

        }

    </style>


<?php get_footer(); ?>