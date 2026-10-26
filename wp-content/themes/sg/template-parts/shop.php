<?php
/**
 * Inhalt einer Shop-Seite: Kopf mit Logo, Gutscheincodes, Aktionen, Informationen und Video.
 */

defined('ABSPATH') || exit;

$shop_id    = get_the_ID();
$shop       = get_the_title();
$shop_slug  = get_post_field('post_name', $shop_id);
$shop_intro = (string) get_post_meta($shop_id, 'gf_shopintro', true);
$video_url  = function_exists('get_field') ? (string) get_field('video') : '';
$video_id   = preg_match('~(?:youtu\.be/|youtube(?:-nocookie)?\.com/(?:embed/|watch\?v=|v/))([\w-]{11})~', $video_url, $match) ? $match[1] : '';
$updated    = sg_shop_updated_timestamp($shop_id);
?>
<article class="entry-content col-first span_3_of_4 shop" data-shop-id="<?php echo (int) $shop_id; ?>">
  <div class="style-a1">
    <figure>
      <img alt="<?php echo esc_attr($shop_slug . ' Gutscheincode'); ?>" src="<?php echo esc_url(sg_shop_logo_url($shop_slug)); ?>" title="<?php echo esc_attr($shop_slug); ?>">
    </figure>
    <h1 class="headline-a1 fn entry-title"><?php echo esc_html($shop); ?> <span class="hidden">Gutschein'e</span></h1>
    <h2 class="sub-title">Tolle Rabatte und top Gutscheincode's für <?php echo esc_html($shop); ?></h2>
    <p class="intro"><?php echo wp_kses_post($shop_intro); ?> Jetzt einen <?php echo esc_html($shop); ?> Rabatt nutzen und bares Geld sparen.</p>
  </div>

  <div class="style-a1">
    <?php sg_shop_offer_section($shop_id, 'voucher'); ?>
  </div>

  <div class="style-a1">
    <?php sg_shop_offer_section($shop_id, 'promotion'); ?>
  </div>

  <div class="style-a1">
    <?php if (trim(get_the_content()) !== '') : ?>
      <span class="headline-a2" id="Geschichte">Informationen über <?php echo esc_html($shop); ?></span>
      <?php the_content(); ?>
    <?php endif; ?>

    <?php if ($video_id) : ?>
      <p><strong class="headline-h2" id="Werbespot">Video von <?php echo esc_html($shop); ?></strong></p>
      <?php // YouTube erst nach Klick laden (Datenschutz); site.js setzt dann das Video ein ?>
      <div class="lazy-video preview" data-youtube-id="<?php echo esc_attr($video_id); ?>">
        <button type="button" class="lazy-video-play">
          <span>Video von <?php echo esc_html($shop); ?> abspielen</span>
          <small>Beim Abspielen wird eine Verbindung zu YouTube (Google) hergestellt.</small>
        </button>
      </div>
    <?php else : ?>
      <br>
    <?php endif; ?>

    <h3>Gratis <?php echo esc_html($shop); ?> Gutscheincode <?php echo esc_html(wp_date('F Y')); ?></h3>
    <p><i>Die oben gelisteten <em><span class="author vcard"><span class="fn"><?php echo esc_html($shop); ?></span></span></em> Gutscheine sind kostenlos. Einfach einen Gutschein von <?php echo esc_html($shop); ?> auswählen und einlösen. Wir recherchieren jeden Tag nach neuen <b><?php echo esc_html($shop); ?> Gutscheincodes</b>.</i></p>

    <footer class="entry-meta">
      <p class="cats">Kategorie: <?php
        echo implode(' / ', array_map(
            static fn(WP_Term $category): string => sprintf('<a href="%s" rel="category" title="%s">%s</a>', esc_url(get_category_link($category)), esc_attr($category->name), esc_html($category->name)),
            get_the_category()
        ));
      ?></p>

      <span class="date">aktualisiert: <?php if ($updated) : ?><time class="updated entry-date" datetime="<?php echo esc_attr(wp_date('Y-m-d', $updated)); ?>"> <?php echo esc_html(wp_date('j. F Y', $updated)); ?></time><?php endif; ?></span>

      <?php $tags = get_the_tags(); ?>
      <?php if ($tags) : ?>
        <p class="tags">Weitere Online-Shops zum Thema: <?php
          echo implode(' | ', array_map(
              static fn(WP_Term $tag): string => sprintf('<a href="%s" rel="tag" title="%s">%s</a>', esc_url(get_tag_link($tag)), esc_attr($tag->name), esc_html($tag->name)),
              $tags
          ));
        ?></p>
      <?php endif; ?>
    </footer>
  </div>
</article>
