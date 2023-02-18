<?php	if (have_posts()) : while (have_posts()) : the_post();

	$categories = get_the_category();
	$shop_intro = get_post_meta($post->ID, 'gf_shopintro',  true);
?>
<article class="entry-content col-first span_3_of_4 shop" role="article" data-shop-id="<?php echo $post->ID; ?>">
	<div class="style-a1">
		<figure><img alt="<?php echo $post->post_name; ?> Gutscheincode" src="https://sparfuchs-gutschein.de/wp-content/themes/sg/images/shop_logos/<?php echo $post->post_name; ?>-logo.png" title="<?php echo $post->post_name; ?>" itemprop="logo"><?php //get_logo($shopname); ?>
        <span itemprop="url" content="http://sparfuchs-gutschein.de/mirapodo"></span>
        </figure>
		<h1 class="headline-a1 fn entry-title"><?php echo $post->post_title; ?> <span class="hidden">Gutschein'e</span></h1>
        <h2 class="sub-title">Tolle Rabatte und top Gutscheincode's für <?php echo $post->post_title; ?></h2>
		<p class="intro"><?php echo $shop_intro;  ?> Jetzt einen <?php echo $post->post_title; ?> Rabatt nutzen und bares Geld sparen.</p>

        <?php //if(function_exists("kk_star_ratings")) : echo kk_star_ratings($pid); endif; ?>

    </div>

    <div class="style-a1">
        <?php get_vouchers($post->ID); ?>
    </div>

    <div class="style-a1">

		<?php get_shop_offers($post->ID); ?>
	</div>

    <div class="style-a1">
        <?php  if ($post->post_content != '') { ?>
        <span class="headline-a2" id="Geschichte">Informationen über <?php echo $post->post_title; ?></span>
        <?php the_content(); } ?>


        <?php if( get_field( "video" ) ): $YoutubeID = get_field( "video" );
        $YoutubeID = explode('/',$YoutubeID); ?>
        
        <p>
            <strong class="headline-h2" id="Werbespot">Video von <?php echo $post->post_title; ?></strong>
        </p>
        
		<!--<div class="lazy-video preview" data-youtube-id="<?php // echo $YoutubeID[4]; ?>">
			<img alt="<?php // echo $post->post_title; ?>-Youtube-Screenshot" data-src="//img.youtube.com/vi/<?php // echo $YoutubeID[4]; ?>/maxresdefault.jpg" src="https://sparfuchs-gutschein.de/wp-content/themes/sg/images/shop_logos/blank.png"  title="<?php //echo $post->post_title; ?> Youtube Screenshot" />
		</div>-->
        
        <div class="lazy-video">
            <iframe loading="lazy"
                    src="https://www.youtube.com/embed/<?php echo $YoutubeID[4]; ?>?rel=0&controls=0"
                    frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen>
            </iframe>
        </div>
        
        <?php else : ?>
        <br/>
        <?php endif; ?>


        <h3>Gratis <?php echo $post->post_title; ?> Gutscheincode <?php echo strftime('%B %Y'); ?></h3>
        <p><i>Die oben gelisteten <em><span class="author vcard"><span class="fn"><?php echo $post->post_title; ?></span></span></em> Gutscheine sind kostenlos. Einfach einen Gutschein von <?php echo $post->post_title; ?> auswählen und einlösen. Wir recherchieren jeden Tag nach neuen <b><?php echo $post->post_title; ?> Gutscheincodes</b>.</i></p>

        <footer class="entry-meta">
            <p class="cats">Kategorie: <?php
            $separator = ' / ';
            $output = '';
            if($categories){
                foreach($categories as $category) {
                    $output .= '<a href="'.get_category_link( $category->term_id ).'" rel="category" title="'.$category->cat_name.'">'.$category->cat_name.'</a>'.$separator;
                }
            }
            echo trim($output, $separator);
            ?>
            </p>

            <span class="date">aktualisiert: <?php get_vouchers_update($post->ID); ?></span>

            <?php
                $posttags = get_the_tags();
                $separator = ' | ';
                $output2 = '';
                if ($posttags) {
                    echo '<p class="tags">Weitere Online-Shops zum Thema: ';
                    foreach($posttags as $tag) {
                        $output2 .= '<a href="'.get_tag_link($tag->term_id).'" rel="tag" title="'.$tag->name.'">'.$tag->name.'</a>'.$separator;
                        //echo '<a rel="tag" href="' . get_tag_link($tag->term_id) . '" title="' . $tag->name . '">' . $tag->name . ' </a> | ';
                    }

                    echo trim($output2, $separator);
                    echo '</p>';
                }

                ?>

        </footer>
    </div>
</article>
<?php endwhile; endif; ?>
