<?php
define( 'WP_CACHE', false ); // By Speed Optimizer by SiteGround

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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'dbw4plxg6gmtnq' );

/** Database username */
define( 'DB_USER', 'utdk0brmailnp' );

/** Database password */
define( 'DB_PASSWORD', 'wmr6gtlm0sql' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'V@C,^hduoRU7+PVklLFda%2O,8zLG-[ mPa(1L?f] LY,_|jii:K0=V:awg8++:j' );
define( 'SECURE_AUTH_KEY',   '3>`qAAy?y:rfUwSjSa)QD[ZCGeQ2*{o(<{pi[7JK[Rsw|:bgY@S>sH[ *6(N08KO' );
define( 'LOGGED_IN_KEY',     '8fD+TzZ<=_0&bX2ImMuhC3 |5W0MRj~Rsr(gXH]1X}r4uT->9^x3sw4^8wiv}J{ ' );
define( 'NONCE_KEY',         'il+TDl6Om9p|1kd!w!`C uTC_X#i0b47p<T!doi|bt3:-B2Vm<;IQL@grP6d9=Nf' );
define( 'AUTH_SALT',         'yv6aS<I+h]_m1=Ed-:H-}SEwi@dGEKq=(aiGT8;P-<;:SI&!JyPw2]${J}%J3Mq*' );
define( 'SECURE_AUTH_SALT',  'cZHi%1l/1@:c0+(#wHYZ5>y[;Gl8 I+(QgD^bzybiI]>rkpW27ZU045O<;LE$sEo' );
define( 'LOGGED_IN_SALT',    'j#QK*7JX##u6Ihw`jasLa65J>0CJDA~WUdSTu[Yq#bG,jtAvi@<tfRXo6t9QMz<0' );
define( 'NONCE_SALT',        '}=BW5;CyXzBH~F/znmIG64erqdbwD-d~Ck}$QRdN!=@vXj,Yz9*MN:QuN A/dk+;' );
define( 'WP_CACHE_KEY_SALT', '5]vRZfDMsz!0Se{v?_ (DZEtGo>ZtDh,^E$^mPEiK.FDq9raHsvajg4b=9aIf,hT' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'nxs_';

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

define( 'AS3CF_SETTINGS', serialize( array(
	'provider' => 'aws',
	'access-key-id' => 'AKIA4Z7K5PXJFRUARNGW',
	'secret-access-key' => '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',
) ) );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
@include_once('/var/lib/sec/wp-settings-pre.php'); // Added by SiteGround WordPress management system
require_once ABSPATH . 'wp-settings.php';
@include_once('/var/lib/sec/wp-settings.php'); // Added by SiteGround WordPress management system
