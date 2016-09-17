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
define('DB_NAME', 'mattiemontgomery');

/** MySQL database username */
define('DB_USER', 'wpuser');

/** MySQL database password */
define('DB_PASSWORD', 'Beetbrat63');

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
define('AUTH_KEY',         '( tRsX6d22qcRxot^+MyNw9a*P!wq=A(MN>tNzzGO:4+|:zJYWe+~t8= xEMwgk<');
define('SECURE_AUTH_KEY',  'Q}T?t%bb^[|Kl8ygo6P.Gq&T|O+nH}<LfMG+zMj^i#M}13n(eLO@;NY2cD8tY8tS');
define('LOGGED_IN_KEY',    'JtRBfSWcuV$Uz*=!H%0@kLjD=qzW)?Z{cZzL(r77Wg~J((r:)a68^WdaxG:,Qa0{');
define('NONCE_KEY',        'vwYB^LP@)?1C>QT}g3x9m!rQ::+//c(WLF[&57)SG2VH_Y?a(l*(&e!U>kYFpl==');
define('AUTH_SALT',        'O(+Lp1;Nx=n<E;*oNf?Cw 2&TA-!k%Q4A2CF<?~)Y}SZ,lRqS0%KXxVP-Wte`6,h');
define('SECURE_AUTH_SALT', 'Tu2a.<`b~!o@R}1vz.we8zQ3w;oQ=+)G]`mNAv:WJ)0jwS_bHkN;Thv_qMb$!|NA');
define('LOGGED_IN_SALT',   'PtG$h^nq.f/O9guF9P3ILZ5I=%mpJJ<m6dZi @heEsr.#s2>l,I;6KK0Xlob-VAW');
define('NONCE_SALT',       'c=/$C*2Jp+Xzgx{Cc].2}-_ml8jWfQOc6g47X>p1V0e*KH*^(J *%Q]qe?(NBZJ1');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'mattiemontgomerytest_';

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
