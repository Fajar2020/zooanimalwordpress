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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'zooanimal' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'DCx|FHuSZ$4xu`.DE1$4>-r014NpG$$JLX:nS:q0uClMq#f_uA>H]pv,=x>R)366' );
define( 'SECURE_AUTH_KEY',  '^DC<4]G(-=).:$I+ucyoigEXe`Ay0uA+X]6?6~mFmyN{;v;r:IP`N9y_W55b7s*Y' );
define( 'LOGGED_IN_KEY',    'LMlUfQ<G;oL)Numc>A<{9Nl;N?oMJFv}L(7D{{x@{bb>LC6]G3t#/$$(/!%fEPFB' );
define( 'NONCE_KEY',        ' [?s$Lqwq&KfGL?xg+^X:iHa:oS{{:PEz9Ru$uFH ,rUDjh!dC% :;z:%dnc53cF' );
define( 'AUTH_SALT',        'jG[~,c~,PrKg{LV+xK4SnR#6/$(]]=ssl%jW81wD^Hq+:HEEU`jdSPAcjY@mc8(+' );
define( 'SECURE_AUTH_SALT', 'M%YjD0gFNA?9CA^D9m_yK<rC+9XW(Gm_/Ol?JhpL46gV13}a96/.PZw:5LSC-0e1' );
define( 'LOGGED_IN_SALT',   '%#JJ587Wq~QEpfObBr%Xg{:c2V v+2>]]Zd?_!DbSaSB59PMS`S4+reLsqj~ 7M0' );
define( 'NONCE_SALT',       '.+Z()MAK`RsUIthIQZE%[g)q`aIG5agX.YDq~(9W[Jn3As<]VR)`e3^Q%)Ingsxu' );

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
