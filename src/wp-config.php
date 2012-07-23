<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'robsohnc_raszczynski');

/** MySQL database username */
define('DB_USER', 'robsohnc_raszczy');

/** MySQL database password */
define('DB_PASSWORD', 'A1D2691BF80562C');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'jr|,-K7p9|8$+68+Q8nIxlhe-dJp[5vo,`QzQ0)4zsuF~7P-?mlY]|GM3 ;nJb1~');
define('SECURE_AUTH_KEY',  'CaigCb^lH4KGKj@i5+U]R^4]Pp2v[[2cTRouw|-.l//_&J)0A_b*&C1BVj:V|g_<');
define('LOGGED_IN_KEY',    'v[%:<aE<ohNS+nw#[sG-+[~z5<6Nk83,:+!BHuO[]_$3MjJtb+,f[WG|iK5+/Dtu');
define('NONCE_KEY',        'd|Q112rOlAf)&}K-&j9?w`/>b-aM7VR%hhGi<z</:wkAV_~r1tK4-1t+80+:BpMp');
define('AUTH_SALT',        '6OkZj#.|O,m|`yBr?2#Z<2}^V3dHj5zu6,<z4,`QcrGoE{_3a|z;/F@*v5J5^&Tn');
define('SECURE_AUTH_SALT', 'S3!j]jdpO0Ufje293W+[-z@^4Bzh,3oS@G+7G%Y<j:5p!@0:`2]_D*`KMx{FNUM{');
define('LOGGED_IN_SALT',   '|Vltxx3WV[rGJ,*UYpWC.toV-!#MjE6_mhTqYGDi)Gch+FcDKwU,+,Ja/Ys({uy<');
define('NONCE_SALT',       'rl$#J3IbQ5l9YoR9D8gA9rc^c,sAF#ir2Vd+|nM6^iZR!+TQVIoWtiXbIO&QC[!1');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

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
