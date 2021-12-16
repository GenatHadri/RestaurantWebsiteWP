<?php
define( 'WP_CACHE', true );
/** Enable W3 Total Cache */
 // Added by W3 Total Cache

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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'genazcfg_projekti' );

/** MySQL database username */
define( 'DB_USER', 'genazcfg_connect' );

/** MySQL database password */
define( 'DB_PASSWORD', 'Genat123' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'jUf<DW+yy~FD5Bg!,gM[gGVp<[^(Y>X]$rv]JW}FScwafDr,P[%bqt~yv;Xr6,&e' );
define( 'SECURE_AUTH_KEY',  '%K.y@DvHm/S[XgmMK0K {`k_+)?/^r`1)jeMB,^LfVu`F!Lm!LyRo!n*R6xZETCA' );
define( 'LOGGED_IN_KEY',    'jW[be1Hpc7a|}[rpH~IHn*mS6,n!$*e%6x5jIJ^b/9BNreLA@l]HGZQB1-t((UTH' );
define( 'NONCE_KEY',        'xiLBUENJHggLTFRSFTDH[!<VkYiwiOo]bVrBNnW@jO>}4C%dey3hetLK5#K)G){Y' );
define( 'AUTH_SALT',        '/YzH/oKEOd~23t1s$a*F1,v`jBK6)aj0*Q0UT+8Ne,HCW4~jxX-s={;0;u4f`(+`' );
define( 'SECURE_AUTH_SALT', 'jgeIl+~8 aYEOgHT3kLeZE)rz~&}oM]/y`)ZACV@NW}N-v Wh[?H]a2^uMw27V0h' );
define( 'LOGGED_IN_SALT',   'C8;PH#TFBn@:Tkfl{JLw4lTVK6@[K75roFQD.EZ*o?F^NrRV^B>8X<kVyIv~]EUx' );
define( 'NONCE_SALT',       ' BNUW3%H!eE?V]xtN2Tl{|y1GNB3721Xe7ONBV69W;U4C$p+0un7h}s)rh2^f*6*' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
