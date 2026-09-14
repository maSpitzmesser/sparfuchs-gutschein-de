<?php
define('WP_CACHE', false);
// define( 'WPCACHEHOME', '/homepages/40/d393556749/htdocs/webseiten/sparfuchs-gutschein-de/wp-content/plugins/wp-super-cache/' );
define('DB_NAME', 'wordpress_local');
/** Ersetze username_here mit deinem MySQL-Datenbank-Benutzernamen */
define('DB_USER', 'wordpress');
/** Ersetze password_here mit deinem MySQL-Passwort */
define('DB_PASSWORD', 'wordpress');
/** Ersetze localhost mit der MySQL-Serveradresse */
define('DB_HOST', 'mysql');
/** Der Datenbankzeichensatz der beim Erstellen der Datenbanktabellen verwendet werden soll */
define('DB_CHARSET', 'utf8');
/** Der collate type sollte nicht ge�ndert werden */
define('DB_COLLATE', '');
/**#@+
 * Sicherheitsschl�ssel
 *
 * �ndere jeden KEY in eine beliebige, m�glichst einzigartige Phrase. 
 * Auf der Seite {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service} kannst du dir alle KEYS generieren lassen.
 * Bitte trage f�r jeden KEY eine eigene Phrase ein. Du kannst die Schl�ssel jederzeit wieder �ndern, alle angemeldeten Benutzer m�ssen sich danach erneut anmelden.
 *
 * @seit 2.6.0
 */
define('AUTH_KEY',         'C]|J.Aon7v:#,LS]n?tD+gw}@U!K8gH`U>gN=L,|`~jQ-,Bp4Kz{WNZnHDHlG3H');
define('SECURE_AUTH_KEY',  '|:m}$H+u,5xL>Uk]!^@?8M%uZ-sAw8X7~+A(dN}:9#H.Gt}^wQ9PQR{K8,bN2xt');
define('LOGGED_IN_KEY',    'mW7(bN[7X.d:G@nN<KF"5$s~2:L#.Cv*M0?L/x"pZ9tQ]>R4~vK_Q|U(XY{8T^');
define('NONCE_KEY',        'q;=^A^Hnb;S*~v"~rp9F~f-q9*gVU-Z.8]Z$|F)xc>R3;Gk]Tq=S:9?Hu,P9wf');
define('AUTH_SALT',        '8H;:4j7$~@LW`7pT0X1C6^"q|~!?#G^)gO}MK.H4Y,K.X.uV<+lF]_H-d!}N$8');
define('SECURE_AUTH_SALT', '@uR<|+4Y@Q(}x9*!b6L>H@t{~Fm_MX#D0?hxB:V~|1pJ@uL#^c>A=q~5$P_sZzf');
define('LOGGED_IN_SALT',   '3K}|G9d$mC_2xM#B?yN>*m5vC<+}hS&|Sp)g"C.ZJ+;kT[i;F(l(x+7X|5<"T0p');
define('NONCE_SALT',       'z~e7_~[V5/g*?Dn+Cw"k{<Fx2Tp9&f>$Q`^dMu1:^:CKsJ@_Pu8nV9K[d$JH3c');
/**#@-*/
/**
 * WordPress Datenbanktabellen-Pr�fix
 *
 *  Wenn du verschiedene Pr�fixe benutzt, kannst du innerhalb einer Datenbank
 *  verschiedene WordPress-Installationen betreiben. Nur Zahlen, Buchstaben und Unterstriche bitte!
 */
$table_prefix  = 'wp_';
/**
 * WordPress Sprachdatei
 *
 * Hier kannst du einstellen, welche Sprachdatei benutzt werden soll. Die entsprechende
 * Sprachdatei muss im Ordner wp-content/languages vorhanden sein, beispielsweise de_DE.mo
 * Wenn du nichts eintr�gst, wird Englisch genommen.
 */
define('WPLANG', 'de_DE');
/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');