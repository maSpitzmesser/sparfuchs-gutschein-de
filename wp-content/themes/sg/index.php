<?php
/**
 * Startseite.
 */

defined('ABSPATH') || exit;

/* Shops im Logo-Karussell: Beitrags-ID => Logo-Datei */
$carousel_shops = [
    4106 => 'mirapodo',
    3982 => 'tom-tailor',
    3965 => 'galeria',
    3763 => 'quelle',
    3811 => 'douglas',
    4770 => 'lensbest',
];

/* Beliebte Shops in der Linkliste (Beitrags-IDs) */
$popular_shops = [3763, 3803, 3895, 3965, 3985, 3936, 3973, 4138, 3819, 4122, 3784, 3890, 4770, 7009, 3963, 8108];

get_header();
?>
  <h1 class="top-level-heading-2">Kostenlose Gutscheincodes &amp; Gutscheine bei Sparfuchs-Gutschein.de</h1>
  <p class="top-level-heading-2"><strong>Sparen will gelernt sein, und ein Sparfuchs zu sein, das spart immer ein paar Euros ein!</strong></p>

  <section>
    <div id="slideshow" class="col-first span_2_of_3 style-a1" data-carousel="fade" aria-roledescription="Karussell" aria-label="Aktuelle Gutscheine">
      <?php sg_home_slides(); ?>
    </div>

    <aside class="col span_1_of_3 video style-a1">
      <span>Rabatte nutzen!</span>
      <ol>
        <li>Gutschein aussuchen</li>
        <li>Gutscheincode einlösen</li>
        <li>Geld sparen</li>
      </ol>
    </aside>
  </section>

  <section class="col-first span_3_of_3 carousel sl-logos sl-l style-a1" data-carousel="slide" aria-label="Beliebte Shops">
    <?php foreach ($carousel_shops as $shop_id => $logo) : $title = get_the_title($shop_id); ?>
      <a href="<?php echo esc_url(get_permalink($shop_id)); ?>" title="<?php echo esc_attr('Alle ' . $title . ' Gutscheincodes'); ?>">
        <img loading="lazy" src="<?php echo esc_url(SG_THEME_URI . '/images/shop_logos/' . $logo . '-logo.png'); ?>" alt="<?php echo esc_attr($title . ' Gutschein'); ?>">
      </a>
    <?php endforeach; ?>
  </section>

  <section>
    <div class="col-first span_1_of_2 sb style-a1">
      <h2 class="headline-a2">Neue Gutscheincodes</h2>
      <ul class="cs"><?php sg_render_offers(sg_get_vouchers('newest', 5), 'small'); ?></ul>
      <a href="<?php echo esc_url(home_url('/neue-gutscheine/')); ?>">Liste aller neuen Gutscheinen &raquo;</a>
    </div>

    <div class="col span_1_of_2 sb style-a1">
      <h3 class="headline-a2">Bald Endend</h3>
      <ul class="cs"><?php sg_render_offers(sg_get_vouchers('ending', 5), 'small'); ?></ul>
      <a href="<?php echo esc_url(home_url('/last-minute/')); ?>">Last Minute Sparvorteile &raquo;</a>
    </div>
  </section>

  <section class="content col-first span_3_of_3 style-a1">
    <ul class="tabs" role="tablist">
      <li class="active" role="tab" tabindex="0" aria-selected="true">Clever einkaufen</li>
      <li role="tab" tabindex="-1" aria-selected="false">Gutscheincodes &amp; Gutscheine</li>
      <li role="tab" tabindex="-1" aria-selected="false">Was sind Gutscheincodes?</li>
      <li role="tab" tabindex="-1" aria-selected="false">Wie löse ich einen Gutscheincode ein?</li>
    </ul>

    <article class="full sk" role="tabpanel">
      <h2>Clever einkaufen mit Gutscheincodes</h2>
      <img loading="lazy" src="<?php echo esc_url(SG_THEME_URI . '/images/Award.jpg'); ?>" alt="Besucher-Award 2013">
      <p>So macht das Sparen Spaß: Auf dieser Webseite geht es um tolle Angebote und sensationelle Rabatt-Gelegenheiten. Sparfuchs-Gutschein.de bietet <i>Gutscheincodes für den Einkauf</i> bei namhaften Unternehmen und vertrauenswürdigen Shops. Mach dir doch einfach selbst mal eine Freude: Mit einem individuellen Gutscheincode liegst du bei deinen Einkäufen immer richtig. Das Schöne dabei ist, dass du die Codes bei mehreren hundert Shops einsetzen kannst. Bei dieser großen Vielfalt ist der nächste Einkauf garantiert gerettet. Suche dir einfach in Ruhe das Passende im jeweiligen Shop aus. Sparfuchs-gutschein.de ist ein kostenloser Gutscheincode-Finder, der immer das beste Angebot für dich aufspürt - ein <strong>echter Sparfuchs</strong> eben!</p>
      <p>Bei beliebten Online-Händlern wie Otto, H&amp;M, Blume2000, Toys'R'Us und Swarovski bietet sparfuchs-gutschein.de regelmäßig tolle Angebote, die in Form eines Gutscheincodes beim Kauf in den Online-Shops eingelöst werden können. Am Ende des Kaufvorgangs wird der entsprechende Code einfach eingegeben, und der Rabatt wird vom Kaufpreis abgezogen. So bequem sparst du beim Einkaufen nicht nur Geld, sondern auch jede Menge Zeit!</p>
    </article>

    <article class="full sk hidden" role="tabpanel">
      <h2>Gutscheincodes &amp; Gutscheine für über <?php echo (int) wp_count_posts()->publish; ?> Online-Shops</h2>
      <p><b>Gutscheincodes</b> werden immer beliebter. Das Online-Portal sparfuchs-gutschein.de bietet seinen Nutzern eine riesige Auswahl an Online-Shops, die ihren Kunden die Möglichkeit bieten, Rabatte beim online-Kauf einzulösen. Viele hundert online-Versandhäuser sind bei sparfuchs-gutschein.de gelistet. Bares Geld sparen heißt heutzutage, sparfuchs-gutschein.de nutzen. Auf dem Portal findest du täglich die aktuellsten Angebote von Unternehmen, bei denen echte Sparfüchse viel Geld sparen können und richtig gute Schnäppchen finden. Bereits auf der Startseite sparfuchs-gutschein.de kann man eine bunte Mischung an Anbietern von Gutscheincodes entdecken. Wer gezielt sucht, dem steht die Möglichkeit offen, über die Kategorie-Suchleiste nach den passenden Anbietern zu suchen und sich dort die gelisteten Gutscheine der Kategorie entsprechend auszusuchen.</p>
      <p>Das Portal sparfuchs-gutschein.de versteht sich als Gutscheinsucher, dessen Benutzung völlig kostenlos für den Nutzer ist. User, die spezielle <strong>Gutscheine</strong> melden, machen somit anderen Nutzern diese lohnenswerten Gutscheine mithilfe von sparfuchs-gutschein.de zugänglich. Sparfüchse sind immer auf der Suche nach lohnenswerten Schnäppchen. Und im Internet steht mittlerweile eine so große Anzahl an Gutscheinen und Gutscheincodes zur Verfügung, dass die Übersichtlichkeit schnell einmal verloren gehen kann. Mit dem Portal sparfuchs-gutschein.de hingegen hat jeder die Möglichkeit, den für sich passenden Gutscheincode in einer übersichtlich und anschaulich gestalteten Liste zu finden und auszuwählen.</p>
    </article>

    <article class="full sk hidden" role="tabpanel">
      <h3>Was sind Gutscheincodes bzw. Rabattcodes?</h3>
      <img loading="lazy" src="<?php echo esc_url(SG_THEME_URI . '/images/Gutscheincodes.png'); ?>" alt="Gutschein und Gutscheincodes" title="Beispiel eines Gutscheincodes">
      <p>Ähnlich wie herkömmliche <i>Gutscheine</i> in Papierform funktionieren auch die Gutscheincodes im Internet. Meist bestehen diese Gutscheincodes aus einer Kombination von Zahlen und Buchstaben. Bei einem Bestellvorgang in einem Online-Shop wird der Gutscheincode  beim Bezahlvorgang in ein spezielles Eingabefeld eingetragen, und die dafür hinterlegte Summe wird als Bonus vom Kaufpreis abgezogen - eine einfache und praktische Art, Rabatte einzulösen. Manche der Gutscheincodes berechtigen auch zum Bestellen von Musterartikeln oder kleinen Geschenken. Auch hier ist immer ausschlaggebend, mit welchem Wert diese Codes hinterlegt sind. Gutscheincodes werden in der Regel von den Händlern im Internet angeboten. Online-Shops belohnen dabei ihre Kunden mit dem Gutscheincode als Dankeschön für die Bestellung. Aber auch zur Neukundengewinnung haben die Händler der Online-Shops diese Gutscheincodes für sich entdeckt. Das Einlösen der Codes von sparfuchs-gutschein.de ist kostenlos und ohne vorherige Anmeldung möglich.</p>
      <p>Mit einem <strong>Gutscheincode</strong> von sparfuchs-gutschein.de sicherst du dir Rabatte und andere Vergünstigungen bei der nächsten Bestellung in deinem Lieblingsshop. Und das komplett gratis, denn die Registrierung bei sparfuchs-gutschein.de kostet dich keinen Cent. Nutze diesen tollen Service, um in den Genuss von Gratiszugaben, Preisnachlässen oder einer kostenlosen Lieferung zu kommen. Der clevere Code-Anbieter ist bei einem ganzen Netz angesagter Shops von renommierten Herstellern vertreten, wie Douglas, Saturn, Esprit und S. Oliver, bei denen man so gut wie alle Artikel online bestellen kann. Ob Mode, Beauty, Bekleidung oder Elektronik - sparfuchs-gutschein.de bietet Angebote für alles, was das Herz begehrt.</p>
    </article>

    <article class="full sk hidden" role="tabpanel">
      <h3>Wie löse ich einen Gutscheincode ein?</h3>
      <img loading="lazy" src="<?php echo esc_url(SG_THEME_URI . '/images/logo/Sparfuchs-Gutschein.webp'); ?>" alt="Sparfuchs">
      <p>Die auf unsere Webseite zur Verfügung gestellten <em>Gutscheincodes</em> werden am Ende Deiner Bestellung von Deiner Endsumme automatisch abgezogen. Der <strong>Gutscheincode</strong> erscheint bei Deinem gewünschten Online-Shop oben in einer Leiste nachdem Du auf "Gutscheincode & Shop öffnen" geklickt hast. Diesen Code musst Du dann nur noch in das daf&uuml;r vorgesehene Feld beim Warenkorb einfügen und schon hast Du Geld gespart. Mehr Informationen dazu findest Du in unserer Anleitung. Anmelden musst Du dich nicht und das Einlösen der Gutscheine ist zudem kostenlos.</p>
    </article>
  </section>

  <section class="col-first span_3_of_4 shop-list style-a1">
    <h3 class="headline-a2">Bei uns gibt es alle Gutscheine / Codes für die beliebtesten Online-Shops</h3>
    <?php foreach ($popular_shops as $shop_id) : $title = get_the_title($shop_id); ?>
      <a href="<?php echo esc_url(get_permalink($shop_id)); ?>" title="<?php echo esc_attr($title); ?>"><?php echo esc_html($title); ?></a>
    <?php endforeach; ?>
  </section>

  <div class="col span_1_of_4 box-300 style-a1">
    <p class="social-link">
      <a href="https://www.facebook.com/SparfuchsGutschein/" target="_blank" rel="noopener">Sparfuchs-Gutschein auf Facebook</a>
      <span>Neue Gutscheine und Aktionen direkt in deinem Feed.</span>
    </p>
  </div>
<?php
get_footer();
