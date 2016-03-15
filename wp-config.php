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
define('DB_NAME', 'mediabaum');

/** MySQL database username */
define('DB_USER', 'mediabaumuser');

/** MySQL database password */
define('DB_PASSWORD', 'm3d14b4um');

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
define('AUTH_KEY',         ':q`PzG$E%6ZGA@&`05qA;3/#ki8ahY;5yOED66z6wA#?K:vD%H?Fviz2/RE~61"*');
define('SECURE_AUTH_KEY',  'Kf(bCU&VUo3m7T!meRR$c+S#76bNkGWt~/#L5~$?nIMH9FG1jG@":Z*L(&rBc7UY');
define('LOGGED_IN_KEY',    'Dd!sDg7lMlD?Jb/VSFeEoImlvk1"5S8p&g8`/ABlsmdb#EDZ?2XV&Y8pT9bQI$(@');
define('NONCE_KEY',        'M53BzGwE"*gZJ|:/PnJT9|_!_FuP2h5nU930PxY"`Hya~5G%d1FCn_CdGHnAd5I|');
define('AUTH_SALT',        '+RgnAq1B0ZO@i3b`|;sFC/JwzWi?1Xh7zLD%&$XdPpIV7XWt;uh2qWR7|$92w?Wu');
define('SECURE_AUTH_SALT', 'iVy:`s:;"?m*TxeT;pVWqu``Fp8!F|+)UZ"hYmkh!Oq70Z/R_%7d|J(:4g0|i*k^');
define('LOGGED_IN_SALT',   'WkDa8:1W*S)Ve_`%f(b":PrR0?Z~jR^x5VK^h:n*sJ%6|v~|q&GuNiAk+%RwNdaJ');
define('NONCE_SALT',       'W:3*~MAFAN4N(gElUg#(E&17FY&U52;1GmSfKqVUX!@JW/UVzil4sl:bq$3TtRMr');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_zcg4yy_';

/**
 * Limits total Post Revisions saved per Post/Page.
 * Change or comment this line out if you would like to increase or remove the limit.
 */
define('WP_POST_REVISIONS',  10);

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

