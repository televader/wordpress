<?php
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
define( 'DB_NAME', 'wordpress_oct22' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

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
define( 'AUTH_KEY',         'vS7p!vhL9DVYd~t,B_zY^=ZV&=q& bb~3l17R$y9H=}yQX5[-6jxMEQzSTjNKQOM' );
define( 'SECURE_AUTH_KEY',  ',-M/~XKs!YK;`RW@^[7G#IpKUEP1~P><8QN.Fn(mu31[,ldeE[$T~d, 1r@:aX1%' );
define( 'LOGGED_IN_KEY',    'lE;J&Gs)$gB[[bumREeObA#UQ4P.5:#.G;}d~OzQf9jQ}7xW/k G.s-HL|,1dnA-' );
define( 'NONCE_KEY',        'T^xq+&R(SQdFu-XsP SSDyQaMBtoiNK  ]l}pnJV{P=Gh3wcXE0#[cdPzyUt;H8;' );
define( 'AUTH_SALT',        '`W4|Z4D/,%^q``d?B1<u#aA#,*r6#=;72(`jp/OgM.hOFj)Nq~%TTwNIt,j:Ig+?' );
define( 'SECURE_AUTH_SALT', '6YNu>5nm3vC 1X9cL!<Zr_g@t<K+<FSzI J=Ar_z^Mu!zIw<qxULS*K&KRy|I|{j' );
define( 'LOGGED_IN_SALT',   'OH&~7VNU5<cY(<e`>xuV 8q$DOA$@)qVewo99@P@UALwxjxSGWTl>!S~HWz]y`@-' );
define( 'NONCE_SALT',       'gxppZkg^F[>osmeY_dRk::nm /[,*Da1W?) 8R,QzVE^?a6OUU05vRAk1;[DH%qc' );

/**#@-*/

/**
 * WordPress database table prefix.
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

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
