<?php
define( 'WP_CACHE', true );
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
define( 'DB_NAME', 'wp-prirucka-wt' );

/** MySQL database username */
define( 'DB_USER', 'admin' );

/** MySQL database password */
define( 'DB_PASSWORD', 'jpjsjs' );

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
define( 'AUTH_KEY',         'MQ| r3>TGXgE;;pyvq8C$Sh@w>@g)lbApytI@Nq^C;gTD/_@/=~[y4gSwE5TI%9?' );
define( 'SECURE_AUTH_KEY',  ';vi~ALYOgwzp#zRb-fHH]bbJuS[#0b2 8:[DF~60nAX1SYf)5^iNv)ln>-R[}bB+' );
define( 'LOGGED_IN_KEY',    '_XVUYL nRI32Ra3wt*JGOR^m% %1$ (hZY]co4/Mu.TvReisadb9b({;e,0!)(.4' );
define( 'NONCE_KEY',        'bo(y%88mg~:hV>{$%1My(}h,lI/Cis>XOz?IAuTX|O/pmB6M/(,OioCNoKNg!pgr' );
define( 'AUTH_SALT',        '$tvgGZK]d/>rV^+6nodo:PIE9@lTJ_wKruGSZ>@N9IKnGA5)8%Rz8)pQh)G<^-7i' );
define( 'SECURE_AUTH_SALT', 'HAuj8/]Zdp+>[6*8:>HB$/)YG;ODGw`2r}gZN,qOo1g!SOL7D*apov,9pIY&Wvd;' );
define( 'LOGGED_IN_SALT',   '<jD+S4QmBu;L,xS^1{<jhC7l&pxVWQxLIHsKYx$3Cxr$ R04pVJi& ZOc]}f$PED' );
define( 'NONCE_SALT',       '[X5}_R{@}XvQh~`.aDrj9tA_/_5@zc<deCf$y|>?a])R~U<IDi.rj4]Tgz2hwOYh' );

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

// Obchvat FTP:
if(is_admin()) {
   define( 'FS_METHOD', 'direct' );
}
// limit one post revisions
define('WP_POST_REVISIONS', 1);

