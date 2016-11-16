<?php
/**
 *
 * Secret-Keys, Sprache und ABSPATH. Mehr Informationen zur wp-config.php gibt es auf der {@link http://codex.wordpress.org/Editing_wp-config.php
 *
 * und die Installationsroutine (/wp-admin/install.php) aufgerufen wird.
 * Man kann aber auch direkt in dieser Datei alle Eingaben vornehmen und sie von wp-config-sample.php in wp-config.php umbenennen und die Installation starten.
 *
 * @package WordPress
 */

// Fix Memory Allocation bug
ini_set("memory_limit","256M");
define('WP_MEMORY_LIMIT', '256M');

/**  MySQL Einstellungen - diese Angaben bekommst du von deinem Webhoster. */
define('DB_NAME', 'ottoduerr_wordpress');

/** Ersetze username_here mit deinem MySQL-Datenbank-Benutzernamen */
define('DB_USER', 'root');

/** Ersetze password_here mit deinem MySQL-Passwort */
define('DB_PASSWORD', 'root');

/** Ersetze localhost mit der MySQL-Serveradresse */
define('DB_HOST', 'localhost');

/** Der Datenbankzeichensatz der beim Erstellen der Datenbanktabellen verwendet werden soll */
define('DB_CHARSET', 'utf8');

define('DB_COLLATE', '');

/**#@+
 *
 * Auf der Seite {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service} kannst du dir alle KEYS generieren lassen.
 *
 * @seit 2.6.0
 */
define('AUTH_KEY',         'lW|!k@]SVy+iJa%j|PS,3}c-X5.YN+<fKqba{fN+_0+U3P,A4^=WP(<@zjL@n|y@');
define('SECURE_AUTH_KEY',  'Z*7<6V!~eTD>1SS2qrMzBfa(6#FmSpax?G/_T~FRp3GwPokPMcM-tVcx3FM|0XCa');
define('LOGGED_IN_KEY',    'GM(^Ww.XZ@6Tp9cBc||LTbi:ao?tj)-qj(@j/}-g8Vl}#zD0fG9^I/h&<1VB,,hv');
define('NONCE_KEY',        '[!pJ+V0+PgT6?%cm/aX(xtgj]C0}=e3RAfWNwbKZ)X?nAv<:7]6l+sggC:9 (>-f');
define('AUTH_SALT',        'lr5l3 Bp-Ok9xQ!nw[X8g}#%h~8vkSbE:PQJmAHHg3FJDr/7$|k 9f~,z]#[cu~g');
define('SECURE_AUTH_SALT', '?rKcc+5)Lu3-|_d|:#a3O=cE#lX(9+aMqJw^kX~k+<-+={pA+Xh(bbpBPO-md@T_');
define('LOGGED_IN_SALT',   '7EiF]Hmh*xCvN1ecD:hB|YZn|yy@6f@^5{Bj`SY Xc ZevJGhHl^vVzhnUyL#a{d');
define('NONCE_SALT',       ' +%Fy55~_agZ%jtR},#j3F=<HR_gu%J.uj-sqN]nLv%h_/Ls{YK}tI1l_ !ToO_T');

/**#@-*/

/**
 *
 *  verschiedene WordPress-Installationen betreiben. Nur Zahlen, Buchstaben und Unterstriche bitte!
 */
$table_prefix  = 'otto_duerr_';

/**
 * WordPress Sprachdatei
 *
 * Hier kannst du einstellen, welche Sprachdatei benutzt werden soll. Die entsprechende
 * Sprachdatei muss im Ordner wp-content/languages vorhanden sein, beispielsweise de_DE.mo
 */
define('WPLANG', 'de_DE');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
define('WP_HOME','http://wp-project/');
define('WP_SITEURL','http://wp-project/');