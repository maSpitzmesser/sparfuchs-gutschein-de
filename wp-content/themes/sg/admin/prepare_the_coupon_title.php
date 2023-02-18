<?php



$OfferTitle = str_replace('&#42;', '', $OfferTitle);
$OfferTitle = str_replace('*', '', $OfferTitle);
$OfferTitle = str_replace('&ast;', '', $OfferTitle);
$OfferTitle = preg_replace('/[\*]+/', '', $OfferTitle);
//$OfferTitle = preg_replace("[*|-]", "", $OfferTitle);




// Gutscheintitel ersetzen												IST																	SOLL


// Asos
$OfferTitle = str_replace("Affiliate ONLY! 15% Studentenrabatt!", "15% Rabatt für Studenten", $OfferTitle);


// BUFFALO
$OfferTitle = str_replace("BUFFALO SHOPPING DAY", "15% Rabatt auf Alles", $OfferTitle);

// Buerostuhl24
$OfferTitle = str_replace("Versandkostenfreie Lieerung", "Versandkostenfreie Lieferung", $OfferTitle);
$OfferTitle = str_replace("Neuer 10€ Gutschein auf Büromöbel!", "10€ Rabatt auf Büromöbel!", $OfferTitle);

// Baby-Markt
$OfferTitle = str_replace("5 % Rabatt sofort!", "5% Online-Rabatt auf Herbst Mode", $OfferTitle);
$OfferTitle = str_replace("10 % Rabatt sofort!", "10% Online-Rabatt auf Herbst Mode", $OfferTitle);
$OfferTitle = str_replace("15 % Rabatt sofort!", "15% Online-Rabatt auf Herbst Mode", $OfferTitle);
$OfferTitle = str_replace("Mode Sale – Bis zu 70 % Rabatt!", "Bis zu 70 % Rabatt im Mode Sale!", $OfferTitle);
// brands4friends
$OfferTitle = str_replace("brands4friends: bis zu 70% Online-Rabatt auf Lifestyle und Mode", "Bis zu 70% Rabatt auf Lifestyle und Mode", $OfferTitle);
$OfferTitle = str_replace("brands4friends Outlet mit bis zu 90% Online-Rabatt", "Bis zu 90% Rabatt im Outlet", $OfferTitle);
$OfferTitle = str_replace("brands4friends: ", "", $OfferTitle);

// beate uhse
$OfferTitle = str_replace("10% auf alles", "10% Rabatt auf alles ", $OfferTitle);
$OfferTitle = str_replace("brands4friends Outlet mit bis zu 90% Online-Rabatt", "Bis zu 90% Rabatt im Outlet", $OfferTitle);

// brillenplatz
$OfferTitle = str_replace("10% auf ALLES", "10% Rabatt auf ALLES", $OfferTitle);
$OfferTitle = str_replace("10€ auf Marken Korrektion ab 89€ MBW", "10€ Rabatt auf Marken Korrektion", $OfferTitle);
$OfferTitle = str_replace("10% auf alle Sonnenbrillen!", "10€ Rabatt auf alle Sonnenbrillen!", $OfferTitle);
$OfferTitle = str_replace("8% auf alle Sportbrillen bei Brillenplatz.de", "8% Online-Rabatt auf alle Sportbrillen", $OfferTitle);
$OfferTitle = str_replace("5-€ Rabatt", "5€ Online-Rabatt", $OfferTitle);
$OfferTitle = str_replace("Skibrillen Outlet - Bis zu 40 % Rabatt!", "Bis zu 40 % Rabatt auf Skibrillen", $OfferTitle);
$OfferTitle = str_replace("Korrektionsbrillen Outlet - Bis zu 60% Ersparnis" , "Bis zu 60% Rabatt auf Korrektionsbrillen", $OfferTitle);
$OfferTitle = str_replace("Sonnenbrillen Outlet - Bis zu 40% Ersparnis" , "Bis zu 40% Rabatt auf Sonnenbrillen", $OfferTitle);
$OfferTitle = str_replace("GRATISVERSAND bei Brillenplatz.de" , "Kostenloser Versand", $OfferTitle);
//$OfferTitle = str_replace("Ab 39 € gibts neue Brillengläser für die eigene Brille!" , "Neue Brillengläser für die eigene Brille ab 39€", $OfferTitle);
//$OfferTitle = str_replace("5% Gutschein für die 5€ Rabatt für Newsletteranmeldung" , "5% Gutschein für Newsletteranmeldung", $OfferTitle);


// decathlon
$OfferTitle = str_replace("DECATHLON: ", "", $OfferTitle);


// fressnapf
$OfferTitle = str_replace("5% auf Premium-Trockenfutter für Hunde und Katzen", "5% Rabatt auf Premium-Trockenfutter für Hunde und Katzen", $OfferTitle);
// Home24
$OfferTitle = str_replace("Exceptional -15% voucher on SKOP", "15% Rabattcode für einen SKOP Kleiderschrank", $OfferTitle);

// HSE24
$OfferTitle = str_replace('Neukundengutschein April "NEU0416"', '10€ Rabatt', $OfferTitle);

// Karstadt
$OfferTitle = str_replace("Karstadt Sports: 10 € Rabatt im Golfsortiment", "10 € Rabatt im Golfsortiment", $OfferTitle);
$OfferTitle = str_replace("Karstadt Sports: 20 € Rabatt im Golfsortiment", "20 € Rabatt im Golfsortiment", $OfferTitle);

// Keller sports
$OfferTitle = str_replace("10% auf alle Asics Produkte", "10% Rabatt auf alle Asics Produkte", $OfferTitle);
$OfferTitle = str_replace("10% auf alle adidas Produkte", "10% Rabatt auf alle adidas Produkte", $OfferTitle);
$OfferTitle = str_replace("10% auf alle The North Face Produkte", "10% Rabatt auf alle The North Face Produkte", $OfferTitle);
$OfferTitle = str_replace("10% auf alle Jack Wolfskin Produkte", "10% Rabatt auf alle Jack Wolfskin Produkte", $OfferTitle);

// mirapodo
$OfferTitle = str_replace("Neu: 10% Rabatt im April", "10% Rabatt im April", $OfferTitle);
$OfferTitle = str_replace("Neu: 15% Rabatt im April", "15% Rabatt im April", $OfferTitle);
$OfferTitle = str_replace("15% auf Taschen", "15% Online-Rabatt auf Taschen", $OfferTitle);
$OfferTitle = str_replace("Neuer Gutschein bei mirapodo", "5€ Online-Rabatt", $OfferTitle);
$OfferTitle = str_replace("15% auf Damen und Herrenschuhe", "15% Rabatt auf Damen und Herrenschuhe", $OfferTitle);
$OfferTitle = str_replace("20% auf Damen und Herrenschuhe", "20% Rabatt auf Damen und Herrenschuhe", $OfferTitle);
$OfferTitle = str_replace("mirapodo feiert 5 Jahre: Ihre Jubiläums-Tasche +10€ Gutschein", "10€ Online-Rabatt + Gratis Jubiläums-Tasche", $OfferTitle);
// frontlineshop
$OfferTitle = str_replace("Neukundengutschein 10%", "10% Rabatt", $OfferTitle);
$OfferTitle = str_replace("10 € Newsletter Gutschein", "10% Rabatt für die Newsletteranmeldung", $OfferTitle);
$OfferTitle = str_replace("frontlineshop: -15% Iriedaily Women", "15% Rabatt auf Iriedaily Women Artikel", $OfferTitle);
$OfferTitle = str_replace("frontlineshop - 10% auf Men Top-Marken", "10% Rabatt auf Men Top-Marken", $OfferTitle);
$OfferTitle = str_replace("frontlineshop - Trendrichtung Nord 20% auf skandinavische Styles!", "10% Rabatt auf skandinavische Styles!", $OfferTitle);
// Galeria Kaufhof
$OfferTitle = str_replace("Tagesaktion0304", "20% Rabatt auf Damen- und Herrenschuhe", $OfferTitle);
$OfferTitle = str_replace("Tagesaktion0104", "15% Rabatt auf Schmuck", $OfferTitle);
$OfferTitle = str_replace("Tagesaktion0404", "20% Rabatt auf Wrangler", $OfferTitle);
$OfferTitle = str_replace("Tagesaktion3103", "20% Rabatt auf Damenwäsche", $OfferTitle);
$OfferTitle = str_replace("Osteraktion10ab79", "10 € Rabatt auf Alles", $OfferTitle);
$OfferTitle = str_replace("OSTERAKTION: ", "", $OfferTitle);
$OfferTitle = str_replace("15% Rabatt auf festliche Kleidung für Damen und Herren mit dem Aktionscode Abschluss16", "15% Rabatt auf festliche Kleidung", $OfferTitle);
$OfferTitle = str_replace("ab dem 18.04. bis zum 23.04.2016 können unsere Kunden mit der Aktion Kauf 2 und spar dabei! noch mehr sparen. ", "", $OfferTitle);
$OfferTitle = str_replace("Mit dem Aktionscode VORTEIL4915 erhalten unsere Kunden bei einem Kauf von 2 Artikeln aus den Bereichen Damen, Herren und Kindermode 50% Rabatt", "Bis zu 50% Rabatt auf Damen-, Herren- und Kindermode", $OfferTitle);
// LinsenPlatz
$OfferTitle = str_replace("8% auf Monatslinsen, Kein MBW", "8% Online-Rabatt auf Monatslinsen", $OfferTitle);
$OfferTitle = str_replace("9 % Rabatt", "9% Online-Rabatt", $OfferTitle);
$OfferTitle = str_replace("10% auf Tageslinsen", "10% Rabatt auf Tageslinsen", $OfferTitle);
$OfferTitle = str_replace(", Kein MBW", "", $OfferTitle);
$OfferTitle = str_replace("9 % auf Pflegeartikel der Marke EYE CARE!", "9% Rabatt auf EYE CARE Produkte", $OfferTitle);

// meinfoto.de
$OfferTitle = str_replace("Premium Fotogeschenke: ", "", $OfferTitle);
// saturn
$OfferTitle = str_replace('SATURN Handyshop: Jetzt 440 € Gutschein Card bei Abschluss eines REAL ALLNET VODAFONE Tarifes!', 'Jetzt 440 € Gutschein Card<br/><p class="sec"> bei Abschluss eines REAL ALLNET VODAFONE Tarifes!</p>', $OfferTitle);
$OfferTitle = str_replace("SATURN Tagesangebot: ", "", $OfferTitle);

//sheego
$OfferTitle = str_replace("15€ Gutschein nur für Neukunden", "15€ Gutschein", $OfferTitle);

//schwab
$OfferTitle = str_replace("Gratis Versand Gutschein für Neu- und Bestandskunden", "Gratis Versand", $OfferTitle);


// Plus.de
$OfferTitle = str_replace("Jetzt 5 € Rabatt sichen!", "5 € Rabatt", $OfferTitle);
$OfferTitle = str_replace("Jetzt 10 € Rabatt sichen!", "10 € Rabatt", $OfferTitle);
$OfferTitle = str_replace("Jetzt 25 € Rabatt sichen!", "25 € Rabatt", $OfferTitle);
$OfferTitle = str_replace("Jetzt 5 € Rabatt sichern!", "5 € Rabatt", $OfferTitle);
$OfferTitle = str_replace("Jetzt 10 € Rabatt sichern!", "10 € Rabatt", $OfferTitle);
$OfferTitle = str_replace("Jetzt 25 € Rabatt sichern!", "25 € Rabatt", $OfferTitle);
$OfferTitle = str_replace("Plus der Woche: ", "Plus der Woche: <br/>", $OfferTitle);
$OfferTitle = str_replace("Plus des Tages: ", "Plus des Tages: <br/>", $OfferTitle);

// Quelle
$OfferTitle = str_replace("€ 15,- Neukunden Gutschein", "15,- € Rabatt", $OfferTitle);
$OfferTitle = str_replace("€ 15, Neukunden Gutschein", "15,- € Rabatt", $OfferTitle);
$OfferTitle = str_replace("15 € Neukunden Gutschein", "15,- € Rabatt", $OfferTitle);
$OfferTitle = str_replace("€ 25, Gutschein auf Elektrogroßgeräte", "25,- € Rabatt auf Elektrogroßgeräte", $OfferTitle);
$OfferTitle = str_replace("kostenlose Lieferung für alle Möbel, Matratzen und Lattenroste - nur für kurze ZEit", "Kostenlose Lieferung für alle Möbel, Matratzen und Lattenroste", $OfferTitle);
$OfferTitle = str_replace("versandkostenfreie Lieferung auf Heimtextilien", "Versandkostenfreie Lieferung auf Heimtextilien", $OfferTitle);
$OfferTitle = str_replace("versandkostenfreie Lieferung auf Elektrogerät", "Versandkostenfreie Lieferung auf Elektrogerät", $OfferTitle);
$OfferTitle = str_replace("€ 50,- auf die erste Ratenzahlung", "50,- € Rabatt auf die erste Ratenzahlung", $OfferTitle);
$OfferTitle = str_replace("€ 20 auf Kühl- und Gefrierschränke", "20,- € Rabatt auf Kühl- und Gefrierschränke", $OfferTitle);
$OfferTitle = str_replace("€ 25 auf das Gartensortiment", "25,- € Rabatt auf das Gartensortiment", $OfferTitle);




$OfferTitle = str_replace("Versandkostenfreiheit auf alle Artikel", "Gratis Versand", $OfferTitle);
$OfferTitle = str_replace("- Auf alle Artikel im Shop", "Rabatt", $OfferTitle);
$OfferTitle = str_replace("DE: ", "", $OfferTitle);
$OfferTitle = str_replace("€ 15 Neukunden Gutschein", "15€ Rabatt", $OfferTitle);
$OfferTitle = str_replace("€ 15,- auf Sport und Fitness", "15€ Rabatt auf Sport und Fitness", $OfferTitle);
$OfferTitle = str_replace("50€ auf die erste Ratenzahlung", "50€ Rabatt auf die erste Ratenzahlung", $OfferTitle);
$OfferTitle = str_replace(" ohne Mindesteinkaufswert", "", $OfferTitle);
$OfferTitle = str_replace("Versandkostenfreie Lieferung", "Gratis Versand", $OfferTitle);//error
$OfferTitle = str_replace(" ohne Mindesteinkaufsert", "", $OfferTitle);
$OfferTitle = str_replace(" für Neukunden", "", $OfferTitle);
$OfferTitle = str_replace("Neukunden Gutschein ", "Rabatt ", $OfferTitle);
$OfferTitle = str_replace(" für Bestandskunden", "", $OfferTitle);
$OfferTitle = str_replace("Newsletteranmeldung", "5€ Rabatt für Newsletteranmeldung", $OfferTitle); //error
$OfferTitle = str_replace(" MBW 35€", "", $OfferTitle);
$OfferTitle = str_replace(" MBW 55€", "", $OfferTitle);

$OfferTitle = str_replace("25% Rabatt-Gutschein auf Mode & Schuhe", "25% Rabatt auf Mode & Schuhe", $OfferTitle);

$OfferTitle = str_replace("5% sparen bei Sammelbestellungen!", "5% Rabatt für Sammelbesteller", $OfferTitle);
$OfferTitle = str_replace("Unser Ostergeschenk: 5% auf ALLES!", "5% Rabatt auf ALLES!", $OfferTitle);



$OfferTitle = str_replace("5€ BK-Gutschein", "5€ Rabatt", $OfferTitle);


$OfferTitle = str_replace("12€ Mode und Schuhe Gutschein!", "12€ Rabatt auf Mode und Schuhe", $OfferTitle);
$OfferTitle = str_replace("5€ Mode und Schuhe Gutschein!", "5€ Rabatt auf Mode und Schuhe ", $OfferTitle);


// PLUS
$OfferTitle = str_replace("Nur heute: ", "", $OfferTitle);


// saturn
$OfferTitle = str_replace("SATURN Tagesangbot: ", "", $OfferTitle);
$OfferTitle = str_replace("Jetzt bei SATURN: ", "", $OfferTitle);


// ZOOROYAL
$OfferTitle = str_replace("10%-Neukundenrabatt ab einem Einkaufswert von mindestens 39€", "10% Rabatt", $OfferTitle);
$OfferTitle = str_replace("10%Neukundenrabatt ab einem Einkaufswert von mindestens 39€", "10% Rabatt", $OfferTitle);
$OfferTitle = str_replace("ZooRoyal Newsletter abonnieren und 5€ Gutschein sichern", "5€ Rabatt für Newsletteranmeldung", $OfferTitle);
$OfferTitle = str_replace("10% Rabatt ab 39€ Mindesteinkaufswert", "10% Rabatt", $OfferTitle);
$OfferTitle = str_replace("10% Rabatt  ab 39€ Mindesteinkaufswert.", "10% Rabatt", $OfferTitle);
$OfferTitle = str_replace("10% Rabatt  ab 39€ Mindesteinkaufswert", "10% Rabatt", $OfferTitle);
$OfferTitle = str_replace("Nur für kurze Zeit: 10% Rabatt auf Peco-Pets - Umweltfreundliche Produkte", "10% Rabatt auf Peco-Pets Produkte", $OfferTitle);
$OfferTitle = str_replace("10% auf alle Wessel-Werk Produkte", "10% Rabatt auf alle Wessel-Werk Produkte", $OfferTitle);

// standart replace
//$OfferTitle = str_replace("5€ für Newsletteranmeldung", "5€ Rabatt für Newsletteranmeldung", $OfferTitle);
$OfferTitle = str_replace("allles", "alles", $OfferTitle);


$OfferTitle = str_replace("Neu: ", "", $OfferTitle);
$OfferTitle = str_replace("Neu:", "", $OfferTitle);
$OfferTitle = str_replace("NEU: ", "", $OfferTitle);
$OfferTitle = str_replace("NEU:", "", $OfferTitle);


$OfferTitle = str_replace(",00", "", $OfferTitle);
$OfferTitle = str_replace("EUR", "€", $OfferTitle);
$OfferTitle = str_replace("&euro;", "€", $OfferTitle);
$OfferTitle = str_replace("Euro", "€", $OfferTitle);
$OfferTitle = str_replace(",-", "", $OfferTitle);

$OfferTitle = str_replace("0 %", "0%", $OfferTitle);
$OfferTitle = str_replace("0 €", "0€", $OfferTitle);

$OfferTitle = str_replace("% auf", "% Rabatt auf", $OfferTitle);
?>
