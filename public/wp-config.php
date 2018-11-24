<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'fox_database');

/** MySQL database username */
define('DB_USER', 'foxworkuser');

/** MySQL database password */
define('DB_PASSWORD', 'RtmPdjXyA2LOEcZq');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'T6u0p6GRM/&i~8}_pM^*wTK;~f*34Gj?5Cz0b84lh-8!1-q$X1U[6Gd<ZUpz3A#_');
define('SECURE_AUTH_KEY',  '?jmQ=nN$>hjh{X$)-pd[+@Hn=Ghx>GCiy=sQfpdQjw!X+rW)yPqNS_gM1fb%p[8a');
define('LOGGED_IN_KEY',    '%.+?gO$Is|Z~$6+3-UB*l&U/pQ!PrHHPi2ASMz;i&<xSeR<e}0a<31HB%P.;$H9E');
define('NONCE_KEY',        'BhJR]k/~]:RB$&D5np6lG5q|<;:!T$^<zulL<0GKB+,&2{&loANdgh^xm&Bg$yEt');
define('AUTH_SALT',        'n!:Ay$~LkK*7Ge=9/-sIH*G%wevi)()Ji)IS##R`s4tJ68(MGe*hyC4If7KK53w-');
define('SECURE_AUTH_SALT', 'C3H/;c.w}^Qm}9Ux)6m-LP<4TK2;IA0B80B[56o$*9B;<p`mb+t;+@[]*{&-/Dzb');
define('LOGGED_IN_SALT',   '_evd4HMfv>YUEkcampa|<jPJ!g;mLm6d!7dL4qwV>.xM!P!OZ=LVb2jR-|q=~t)|');
define('NONCE_SALT',       'dvQ]rwrFoIITSiZyb,%8r90;r1gUKa<-f:RRQJJo#J2`&ZL-;{SbITmOV9e }49l');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'fox_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
