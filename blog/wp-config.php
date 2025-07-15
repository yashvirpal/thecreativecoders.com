<?php
define( 'WP_CACHE', true );
//
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'codensk1_codenskills' );

/** Database username */
define( 'DB_USER', 'codensk1_codenskills' );

/** Database password */
define( 'DB_PASSWORD', '=)=hwyAjF~36' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

//define('DISABLE_WP_CRON', true);

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '&VHNevWDPU`HZ+h~)Yy1!/E;=ezlBP{R4@Bmj>u5ea2j3o^q<]m+bS!3qUgn_` X' );
define( 'SECURE_AUTH_KEY',  '*RJ$uvy`{^rWNa$hWRD^&**0)yQ0gcrL30vJ^I,|ws/u}_Lr_+Ikteh@&-B4kjv_' );
define( 'LOGGED_IN_KEY',    'd}T0y}fTAD{rS>$0$GeI`w#)<&yGnb;N1V^}Z{[9>:PUe`.GOqwayD2$o6Nr,*u2' );
define( 'NONCE_KEY',        'DN5-e3wLb;*9Sb4Ivpd<ENpM9roP%kHq{m,Kud?m-#S44cS@XLb-2)IyL#Z(Gh$q' );
define( 'AUTH_SALT',        'N<eDEd@de hpe,n5f+`JC!HiObt[QZgIo6L`tllVg[)m+1%t]=<b3({dUolxMZ%C' );
define( 'SECURE_AUTH_SALT', 'Xsmm1hbB?G.1`}I&Tf/#eD2vNk4gz,~Dm=#L:hS^s<&&Bx`wNG6<;MK >.)zNrh.' );
define( 'LOGGED_IN_SALT',   '1nk+lj`_6.J+3eu({Ivco$O0*eZ~O%9ehkshCKK/x!<EX{92`e5=IN#Y:|wc;I,+' );
define( 'NONCE_SALT',       '7oNtfOh081QFMSCM)P3i]bCIaLwUBh,B.#)J}d5.(Yx)5{(c<U B jIY(O_(/4yA' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'cs_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
@ini_set('display_errors', 0);

ini_set('zlib.output_compression', 'Off');
/* Add any custom values between this line and the "stop editing" line. */
define('WP_HOME', 'https://thecreativecoders.com/blog');
define('WP_SITEURL', 'https://thecreativecoders.com/blog');





/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';