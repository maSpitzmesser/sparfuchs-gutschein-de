<?php
get_header(); ?>
    <h1 class="top-level-heading-2">Kostenlose Gutscheincodes &amp; Gutscheine bei Sparfuchs-Gutschein.de</h1>
    <p class="top-level-heading-2"><strong>Sparen will gelernt sein, und ein Sparfuchs zu sein, das spart immer ein paar Euros ein!</strong></p>

<section>
    <div id="slideshow" class="col-first span_2_of_3 style-a1">
        <?php get_slides(); ?>
    </div>

	<aside class="col span_1_of_3 video style-a1">
		<span>Rabatte nutzen!</span>
		<ol>
			<li>Gutschein aussuchen</li>
			<li>Gutscheincode einlösen</li>
			<li>Geld sparen</li>
		</ol>
	</aside>

	<!--<div class="col span_1_of_4 style-a1">
        <?php // the_widget( 'Widget_Werbung_Affiliate', $instance, $args ); ?>
    </div>-->

</section>


    <section class="col-first span_3_of_3 carousel sl-logos sl-l style-a1">
	    <a href="<?php echo get_permalink( 4106 ); ?>" title="Alle <?php echo get_the_title( 4106 ); ?> Gutscheincodes">
            <img loading="lazy" src="/wp-content/themes/sg/images/shop_logos/mirapodo-logo.png" alt="<?php echo get_the_title( 4106 ); ?> Gutschein"/>
        </a>
        <a href="<?php echo get_permalink( 3982 ); ?>" title="Alle <?php echo get_the_title( 3982 ); ?> Gutscheincodes"><!-- douglas -->
            <img loading="lazy" src="/wp-content/themes/sg/images/shop_logos/tom-tailor-logo" alt="<?php echo get_the_title( 3982 ); ?> Gutschein"/>
        </a>
        <a href="<?php echo get_permalink( 3965 ); ?>" title="Alle <?php echo get_the_title( 3965 ); ?> Gutscheincodes"><!-- douglas -->
            <img loading="lazy" src="/wp-content/themes/sg/images/shop_logos/galeria-logo" alt="<?php echo get_the_title( 3965 ); ?> Gutschein"/>
        </a>

        <a href="<?php echo get_permalink( 3763 ); ?>" title="Alle <?php echo get_the_title( 3763 ); ?> Gutscheincodes"><!-- douglas -->
            <img loading="lazy" src="/wp-content/themes/sg/images/shop_logos/quelle-logo" alt="<?php echo get_the_title( 3763 ); ?> Gutschein"/>
        </a>
        
        <?php //query_posts('showposts=9&order=ASC'); while (have_posts()) : the_post(); ?>
        <!--<a href="<?php //the_permalink() ?>" title="Alle <?php //echo $post->post_title; ?> Gutscheincodes">-->
            <?php //get_logo($shopname); ?>
        <!-- </a>-->
        <?php //endwhile;?>
        
        <a href="<?php echo get_permalink( 3811 ); ?>" title="Alle <?php echo get_the_title( 3811 ); ?> Gutscheincodes"><!-- douglas -->
            <img loading="lazy" src="/wp-content/themes/sg/images/shop_logos/douglas-logo.png" alt="<?php echo get_the_title( 3811 ); ?> Gutschein"/>
        </a>

        <a href="<?php echo get_permalink( 4770 ); ?>" title="Alle <?php echo get_the_title( 4770 ); ?> Gutscheincodes"><!-- douglas -->
            <img loading="lazy" src="/wp-content/themes/sg/images/shop_logos/lensbest-logo" alt="<?php echo get_the_title( 4770 ); ?> Gutschein"/>
        </a>
    </section>


  <section>
        <div class="col-first span_1_of_2 sb style-a1">
            <h2 class="headline-a2">Neue Gutscheincodes</h2>
            <ul class="cs"><?php new_vouchers_widget(); ?></ul>
            <a href="/neue-gutscheine/">Liste aller neuen Gutscheinen &raquo;</a>
        </div>

        <div class="col span_1_of_2 sb style-a1">
            <h3 class="headline-a2">Bald Endend</h3>
            <ul class="cs"><?php expire_vouchers_widget(); ?></ul>
            <a href="/last-minute/">Last Minute Sparvorteile &raquo;</a>
        </div>
<!--
        <div class="col span_1_of_3 sb style-a1">
           <h3 class="headline-a2">Gratis Produkte</h3>
            <ul class="cs"><?php //free_gifts_widget(); ?></ul>
            <a href="/gratis-produkte/">Alle Gratis Produkte &raquo;</a>
        </div>-->
    </section>

<?php // include_once 'inc/adsense.php'; ?>




<section class="content col-first span_3_of_3 style-a1">
    <ul class="tabs">
        <li class="active">Clever einkaufen</li>
        <li>Gutscheincodes &amp; Gutscheine</li>
        <li>Was sind Gutscheincodes?</li>
        <li>Wie löse ich einen Gutscheincode ein?</li>
    </ul>

    <article class="full sk" role="article">
        <h2>Clever einkaufen mit Gutscheincodes</h2>
        <img loading="lazy" src="/wp-content/themes/sg/images/Award.jpg" alt="Award-2013"/>
        <p>So macht das Sparen Spaß: Auf dieser Webseite geht es um tolle Angebote und sensationelle Rabatt-Gelegenheiten. Sparfuchs-Gutschein.de bietet <i>Gutscheincodes für den Einkauf</i> bei namhaften Unternehmen und vertrauenswürdigen Shops. Mach dir doch einfach selbst mal eine Freude: Mit einem individuellen Gutscheincode liegst du bei deinen Einkäufen immer richtig. Das Schöne dabei ist, dass du die Codes bei mehreren hundert Shops einsetzen kannst. Bei dieser großen Vielfalt ist der nächste Einkauf garantiert gerettet. Suche dir einfach in Ruhe das Passende im jeweiligen Shop aus. Sparfuchs-gutschein.de ist ein kostenloser Gutscheincode-Finder, der immer das beste Angebot für dich aufspürt - ein <strong>echter Sparfuchs</strong> eben!</p>
        <p>Bei beliebten Online-Händlern wie Otto, H&amp;M, Blume2000, Toys'R'Us und Swarovski bietet sparfuchs-gutschein.de regelmäßig tolle Angebote, die in Form eines Gutscheincodes beim Kauf in den Online-Shops eingelöst werden können. Am Ende des Kaufvorgangs wird der entsprechende Code einfach eingegeben, und der Rabatt wird vom Kaufpreis abgezogen. So bequem sparst du beim Einkaufen nicht nur Geld, sondern auch jede Menge Zeit!</p>
    </article>

    <article class="full sk hidden" role="article">
        <h2>Gutscheincodes &amp; Gutscheine für über <?php echo wp_count_posts()->publish; ?> Online-Shops</h2>
        <p><b>Gutscheincodes</b> werden immer beliebter. Das Online-Portal sparfuchs-gutschein.de bietet seinen Nutzern eine riesige Auswahl an Online-Shops, die ihren Kunden die Möglichkeit bieten, Rabatte beim online-Kauf einzulösen. Viele hundert online-Versandhäuser sind bei sparfuchs-gutschein.de gelistet. Bares Geld sparen heißt heutzutage, sparfuchs-gutschein.de nutzen. Auf dem Portal findest du täglich die aktuellsten Angebote von Unternehmen, bei denen echte Sparfüchse viel Geld sparen können und richtig gute Schnäppchen finden. Bereits auf der Startseite sparfuchs-gutschein.de kann man eine bunte Mischung an Anbietern von Gutscheincodes entdecken. Wer gezielt sucht, dem steht die Möglichkeit offen, über die Kategorie-Suchleiste nach den passenden Anbietern zu suchen und sich dort die gelisteten Gutscheine der Kategorie entsprechend auszusuchen.</p>
        <p>Das Portal sparfuchs-gutschein.de versteht sich als Gutscheinsucher, dessen Benutzung völlig kostenlos für den Nutzer ist. User, die spezielle <strong>Gutscheine</strong> melden, machen somit anderen Nutzern diese lohnenswerten Gutscheine mithilfe von sparfuchs-gutschein.de zugänglich. Sparfüchse sind immer auf der Suche nach lohnenswerten Schnäppchen. Und im Internet steht mittlerweile eine so große Anzahl an Gutscheinen und Gutscheincodes zur Verfügung, dass die Übersichtlichkeit schnell einmal verloren gehen kann. Mit dem Portal sparfuchs-gutschein.de hingegen hat jeder die Möglichkeit, den für sich passenden Gutscheincode in einer übersichtlich und anschaulich gestalteten Liste zu finden und auszuwählen.</p>
    </article>

    <article class="full sk hidden" role="article">
        <h3>Was sind Gutscheincodes bzw. Rabattcodes?</h3>
        <img loading="lazy" src="/wp-content/themes/sg/images/Gutscheincodes.png" alt="Gutschein + Gutscheincodes" title="Beispiel eines Gutscheincodes" />
        <p>Ähnlich wie herkömmliche <i>Gutscheine</i> in Papierform funktionieren auch die Gutscheincodes im Internet. Meist bestehen diese Gutscheincodes aus einer Kombination von Zahlen und Buchstaben. Bei einem Bestellvorgang in einem Online-Shop wird der Gutscheincode  beim Bezahlvorgang in ein spezielles Eingabefeld eingetragen, und die dafür hinterlegte Summe wird als Bonus vom Kaufpreis abgezogen - eine einfache und praktische Art, Rabatte einzulösen. Manche der Gutscheincodes berechtigen auch zum Bestellen von Musterartikeln oder kleinen Geschenken. Auch hier ist immer ausschlaggebend, mit welchem Wert diese Codes hinterlegt sind. Gutscheincodes werden in der Regel von den Händlern im Internet angeboten. Online-Shops belohnen dabei ihre Kunden mit dem Gutscheincode als Dankeschön für die Bestellung. Aber auch zur Neukundengewinnung haben die Händler der Online-Shops diese Gutscheincodes für sich entdeckt. Das Einlösen der Codes von sparfuchs-gutschein.de ist kostenlos und ohne vorherige Anmeldung möglich.</p>
        <p>Mit einem <strong>Gutscheincode</strong> von sparfuchs-gutschein.de sicherst du dir Rabatte und andere Vergünstigungen bei der nächsten Bestellung in deinem Lieblingsshop. Und das komplett gratis, denn die Registrierung bei sparfuchs-gutschein.de kostet dich keinen Cent. Nutze diesen tollen Service, um in den Genuss von Gratiszugaben, Preisnachlässen oder einer kostenlosen Lieferung zu kommen. Der clevere Code-Anbieter ist bei einem ganzen Netz angesagter Shops von renommierten Herstellern vertreten, wie Douglas, Saturn, Esprit und S. Oliver, bei denen man so gut wie alle Artikel online bestellen kann. Ob Mode, Beauty, Bekleidung oder Elektronik - sparfuchs-gutschein.de bietet Angebote für alles, was das Herz begehrt.</p>
    </article>

    <article class="full sk hidden" role="article">
        <h3>Wie löse ich einen Gutscheincode ein?</h3>
        <img loading="lazy" src="/wp-content/themes/sg/images/logo/Sparfuchs-Gutschein.webp" alt="Sparfuchs"/>
        <p>Die auf unsere Webseite zur Verfügung gestellten <em>Gutscheincodes</em> werden am Ende Deiner Bestellung von Deiner Endsumme automatisch abgezogen. Der <strong>Gutscheincode</strong> erscheint bei Deinem gewünschten Online-Shop oben in einer Leiste nachdem Du auf "Gutscheincode & Shop öffnen" geklickt hast. Diesen Code musst Du dann nur noch in das daf&uuml;r vorgesehene Feld beim Warenkorb einfügen und schon hast Du Geld gespart. Mehr Informationen dazu findest Du in unserer Anleitung. Anmelden musst Du dich nicht und das Einlösen der Gutscheine ist zudem kostenlos.</p>
    </article>
</section>


<section class="col-first span_3_of_4 shop-list style-a1">
	<h3 class="headline-a2">Bei uns gibt es alle Gutscheine / Codes für die beliebtesten Online-Shops</h3>

    <a href="<?php echo get_permalink( 3763 ); ?>" title="<?php echo get_the_title( 3763 ); ?>"><?php echo get_the_title( 3763 ); ?></a><!-- Quelle -->
    <a href="<?php echo get_permalink( 3803 ); ?>" title="<?php echo get_the_title( 3803 ); ?>"><?php echo get_the_title( 3803 ); ?></a><!-- Bauer -->

    <a href="<?php echo get_permalink( 3895 ); ?>" title="<?php echo get_the_title( 3895 ); ?>"><?php echo get_the_title( 3895 ); ?></a><!-- Saturn -->
    <a href="<?php echo get_permalink( 3965 ); ?>" title="<?php echo get_the_title( 3965 ); ?>"><?php echo get_the_title( 3965 ); ?></a><!-- Galeria Kaufhof -->


    <a href="<?php echo get_permalink( 3985 ); ?>" title="<?php echo get_the_title( 3985 ); ?>"><?php echo get_the_title( 3985 ); ?></a><!-- Sheego -->
    <a href="<?php echo get_permalink( 3936 ); ?>" title="<?php echo get_the_title( 3936 ); ?>"><?php echo get_the_title( 3936 ); ?></a><!-- Schwab -->
    <a href="<?php echo get_permalink( 3973 ); ?>" title="<?php echo get_the_title( 3973 ); ?>"><?php echo get_the_title( 3973 ); ?></a><!-- brands4friends -->

    <a href="<?php echo get_permalink( 4138 ); ?>" title="<?php echo get_the_title( 4138 ); ?>"><?php echo get_the_title( 4138 ); ?></a><!-- Fressnapf -->
    <a href="<?php echo get_permalink( 3819 ); ?>" title="<?php echo get_the_title( 3819 ); ?>"><?php echo get_the_title( 3819 ); ?></a><!-- Zooplus -->
    <a href="<?php echo get_permalink( 4122 ); ?>" title="<?php echo get_the_title( 4122 ); ?>"><?php echo get_the_title( 4122 ); ?></a><!-- Zooroyal -->

    <a href="<?php echo get_permalink( 3784 ); ?>" title="<?php echo get_the_title( 3784 ); ?>"><?php echo get_the_title( 3784 ); ?></a><!-- Mister Spex -->
    <a href="<?php echo get_permalink( 3890 ); ?>" title="<?php echo get_the_title( 3890 ); ?>"><?php echo get_the_title( 3890 ); ?></a><!-- Linsenplatz -->
    <a href="<?php echo get_permalink( 4770 ); ?>" title="<?php echo get_the_title( 4770 ); ?>"><?php echo get_the_title( 4770 ); ?></a><!-- Lensbest -->

    <a href="<?php echo get_permalink( 7009 ); ?>" title="<?php echo get_the_title( 7009 ); ?>"><?php echo get_the_title( 7009 ); ?></a><!-- DocMorris -->
    <a href="<?php echo get_permalink( 3963 ); ?>" title="<?php echo get_the_title( 3963 ); ?>"><?php echo get_the_title( 3963 ); ?></a><!-- Shop-Apotheke -->
    <a href="<?php echo get_permalink( 8108 ); ?>" title="<?php echo get_the_title( 8108 ); ?>"><?php echo get_the_title( 8108 ); ?></a><!-- Europa Apotheek -->
</section>


<div class="col span_1_of_4 box-300 style-a1">
    <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/de_DE/sdk.js#xfbml=1&version=v2.8";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, "script", "facebook-jssdk"));</script>

    <div class="fb-page" data-href="https://facebook.com/SparfuchsGutschein" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://facebook.com/SparfuchsGutschein" class="fb-xfbml-parse-ignore"><a href="https://facebook.com/SparfuchsGutschein">Sparfuchs-Gutschein.de</a></blockquote></div>

</div>
<?php get_footer(); ?>