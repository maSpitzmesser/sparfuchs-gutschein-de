<?php
/**
 * Fuß der Seite: Links, Kennzahlen, Cookie-Hinweis und der Dialog für Lightbox-Inhalte.
 */

defined('ABSPATH') || exit;
?>
</div>

<?php if (is_single()) : ?>
  <nav class="side-nav" aria-label="Abschnitte">
    <a class="current" href="#Gutscheine">Gutscheincodes</a>
    <a href="#Rabatte">Rabatte</a>
    <a href="#Geschichte">Infos</a>
    <a href="#Werbespot">Werbespot</a>
  </nav>
<?php endif; ?>

<footer class="site-footer">
  <div class="site-footer-inner">
    <div class="col-first span_2_of_5 site-links">
      <h4>Sparfuchs-Gutschein.de</h4>
      <a href="<?php echo esc_url(home_url('/neue-gutscheine/')); ?>">Die neusten Gutscheine</a>
      <a href="<?php echo esc_url(home_url('/shops/')); ?>">Top Shops</a>
      <a href="<?php echo esc_url(home_url('/kategorien/')); ?>">Codes nach Kategorien</a>
    </div>
    <div class="col span_1_of_5 site-links">
      <h4>Hilfe</h4>
      <a class="lightbox-open" href="<?php echo esc_url(home_url('/anleitung/')); ?>">Zur Anleitung</a>
      <a href="<?php echo esc_url(home_url('/fragen/')); ?>">Fragen &amp; Antworten</a>
      <a class="lightbox-open-450" href="<?php echo esc_url(home_url('/kontakt/')); ?>">Kontakt</a>
    </div>
    <div class="col span_1_of_5 site-links">
      <h4>Für Fans</h4>
      <a href="https://addons.mozilla.org/de/firefox/addon/sparfuchs-gutschein/" target="_blank" rel="noopener">Sparfuchs Design für Firefox</a>
    </div>
    <div class="col span_1_of_5 site-links">
      <h4>Rechtliches</h4>
      <a href="<?php echo esc_url(home_url('/impressum/')); ?>">Impressum</a>
      <a href="<?php echo esc_url(home_url('/datenschutz/')); ?>">Datenschutz</a>
      <a href="<?php echo esc_url(home_url('/haftungsausschluss/')); ?>">Haftungsausschluss</a>
    </div>

    <?php if (is_front_page() || is_page()) : ?>
      <div class="col-first span_3_of_3 site-info" role="contentinfo">
        <ul class="col span_3_of_3">
          <li class="col-first span_1_of_3"><span><?php echo (int) sg_count_offers(true); ?></span> Neue Gutscheine &amp; Aktionen heute</li>
          <li class="col span_1_of_3"><span><?php echo (int) wp_count_posts()->publish; ?></span> Online-Shops insgesamt</li>
          <li class="col span_1_of_3"><span><?php echo (int) sg_count_offers(); ?></span> Gutscheine &amp; Aktionen insgesamt</li>
        </ul>
      </div>
    <?php endif; ?>

    <?php if (is_front_page()) : ?>
      <p class="note">Exklusive Gutscheincodes dürfen auf anderen Gutscheinblogs ohne schriftliche Genehmigung nicht kopiert weder verbreitet noch veröffentlicht werden. Diese werden exklusiv von den Online-Shops für diese Webseite und für deren Benutzer bereitgestellt.</p>
    <?php endif; ?>

    <p class="copy">&copy; Copyright Sparfuchs-Gutschein.de 2012 - <?php echo esc_html(wp_date('Y')); ?> ~ Alle Rechte vorbehalten<?php if (is_single()) : ?> | Du liest gerade: <?php echo esc_html(get_the_title()); ?> Gutschein<?php endif; ?></p>
  </div>
</footer>

<div class="cookie-banner style-b1 hidden" role="region" aria-label="Hinweis zu Cookies">
  <img loading="lazy" src="<?php echo esc_url(SG_THEME_URI . '/images/cookie-banner-50-50.png'); ?>" alt="" width="50" height="50">
  Auf Sparfuchs-Gutschein.de werden Cookies verwendet, um dir einen besseren Service anbieten zu können.
  Wenn du diese Seite weiter benutzt, stimmst du unseren
  <a class="cookie-banner-link" href="<?php echo esc_url(home_url('/datenschutz/')); ?>">Cookie-Richtlinien</a> zu.
  <button type="button" class="cookie-banner-close" title="Hinweis schließen" aria-label="Hinweis schließen"></button>
</div>

<dialog class="sg-dialog" aria-label="Inhalt">
  <button type="button" class="sg-dialog-close" aria-label="Schließen">✕</button>
  <iframe class="sg-dialog-frame" title="Inhalt" src="about:blank"></iframe>
</dialog>

<?php wp_footer(); ?>
</body>
</html>
