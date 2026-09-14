</div>

<?php if (is_single() ) : ?>
  <div class="side-nav">
    <a class="current" href="#Gutscheine">Gutscheincodes</a>
    <a href="#Rabatte">Rabatte</a>
    <a href="#Geschichte">Infos</a>
    <a href="#Werbespot">Werbespot</a>
  </div>
<?php endif ?>


<footer class="site-footer">
  <div class="site-footer-inner">
    <div class="col-first span_2_of_5 site-links">
      <h4>Sparfuchs-Gutschein.de</h4>
      <a href="/neue-gutscheine/" title="Die neusten Gutscheine">Die neusten Gutscheine</a>
      <!-- <a class="lightbox-open-450" href="/gutschein-melden/?lightbox=true" title="Gutscheincodes melden">Gutscheincodes melden</a>-->
      <a href="/shops/" title="Top Shops">Top Shops</a>
      <a href="/kategorien/" title="Kategorien">Codes nach Kategorien</a>
    </div>
    <div class="col span_1_of_5 site-links">
      <h4>Hilfe</h4>
      <a class="lightbox-open" href="/anleitung/?lightbox=true" title="Zur Anleitung">Zur Anleitung</a>
      <a href="/fragen/" title="Fragen &amp; Antworten">Fragen &amp; Antworten</a>
      <a class="lightbox-open-450" href="/kontakt/?lightbox=true" title="Kontakt">Kontakt</a>
    </div>
    <div class="col span_1_of_5 site-links">
      <h4>Für Fans</h4>
      <a href="/go/r?l=https://addons.mozilla.org/de/firefox/addon/sparfuchs-gutschein/" target="_blank" title="Sparfuchs Design für Firefox">Sparfuchs Design für Firefox</a>
      <!--<a href="/verlinkungsmoglichkeiten/" title="Verlinkungsmöglichkeiten">Verlinkungsmöglichkeiten</a>-->
    </div>
    <div class="col span_1_of_5 site-links">
      <h4>Rechtliches</h4>
      <a href="/impressum/" title="Impressum">Impressum</a>
      <a href="/datenschutz/" title="Datenschutz">Datenschutz</a>
      <a href="/haftungsausschluss/" title="Haftungsausschluss">Haftungsausschluss</a>
      <?php if (current_user_can( 'manage_options' )) { ?>
        <a class="drawer-toggler lightbox-open" href="/design-aendern/?lightbox=true">Design</a>
      <?php } ?>
    </div>

    <?php if (is_front_page() ||  is_page()) : ?>
      <div class="col-first span_3_of_3 site-info" role="contentinfo">
        <ul class="col span_3_of_3">
          <li class="col-first span_1_of_3"><span><?php count_new_coupons(); ?></span> Neue Gutscheine & Aktionen heute</li>
          <li class="col span_1_of_3"><span><?php echo wp_count_posts()->publish; ?></span> Online-Shops insgesamt</li>
          <li class="col span_1_of_3"><span><?php count_all_coupons(); ?></span> Gutscheine & Aktionen insgesamt</li>
        </ul>
      </div>


    <?php endif ?>
    <?php if (is_front_page() ) : ?>
      <p class="note">Exklusive Gutscheincodes dürfen auf anderen Gutscheinblogs ohne schriftliche Genehmigung nicht kopiert weder verbreitet noch veröffentlicht werden. Diese werden exklusiv von den Online-Shops für diese Webseite und für deren Benutzer bereitgestellt.</p>
    <?php endif ?>

    <p class="copy">&copy; Copyright Sparfuchs-Gutschein.de 2012 - <?php echo date('Y'); ?> ~ Alle Rechte vorbehalten<?php if (is_single() ) : ?> | Du liest gerade: <?php the_title(); ?> Gutschein<?php endif ?></p>
  </div>
</footer>

<div class="cookie-banner style-b1 hidden">
  <img loading="lazy" src="/wp-content/themes/sg/images/cookie-banner-50-50.png" alt="cookie" />
  Auf Sparfuchs-Gutschein.de werden Cookies verwendet, um dir einen besseren Service anbieten zu können.
  Wenn du diese Seite weiter benutzt, stimmst du unseren
  <a class="cookie-banner-link" href="/datenschutz">Cookie-Richtlinien</a> zu.
  <span title="Fenster schließen und Cookies akzeptieren" class="cookie-banner-close" />
</div>


<?php if (current_user_can( 'manage_options' )) {
  include_once '/homepages/40/d393556749/htdocs/webseiten/sparfuchs-gutschein-de/wp-content/themes/sg/admin/web-assistent.php';
} ?>

<script src="/wp-content/themes/sg/js/jquery-3.5.1.min.js"></script>

<!-- All individual JavaScript files -->
<script src="<?php echo bloginfo('template_directory') ?>/scripts/1-jCookie.js"></script>
<script src="<?php echo bloginfo('template_directory') ?>/scripts/2-DesignSwitcher.js"></script>
<script src="<?php echo bloginfo('template_directory') ?>/scripts/2-jLazyLoad.js"></script>
<script src="<?php echo bloginfo('template_directory') ?>/scripts/3-jScrollTo.js"></script>
<script src="<?php echo bloginfo('template_directory') ?>/scripts/MainMenu.js"></script>
<script src="<?php echo bloginfo('template_directory') ?>/scripts/Searchform-autocomplet.js"></script>
<script src="<?php echo bloginfo('template_directory') ?>/scripts/cookie-banner.js"></script>
<script src="<?php echo bloginfo('template_directory') ?>/scripts/jLightbox.js"></script>
<script src="<?php echo bloginfo('template_directory') ?>/scripts/jSingelpage-nav.js"></script>
<script src="<?php echo bloginfo('template_directory') ?>/scripts/jStarRating.js"></script>
<script src="<?php echo bloginfo('template_directory') ?>/scripts/sg-all.js"></script>
<script src="<?php echo bloginfo('template_directory') ?>/scripts/slick-carousel.js"></script>
<script src="<?php echo bloginfo('template_directory') ?>/scripts/social-media.js"></script>
<script src="<?php echo bloginfo('template_directory') ?>/scripts/sticky-header.js"></script>
<script src="<?php echo bloginfo('template_directory') ?>/scripts/tabs.js"></script>

<?php
wp_footer();
include_once("includes/analyticstracking.php") ?>

<script src="https://www.dwin2.com/pub.587077.min.js"></script>


</body>
</html>
