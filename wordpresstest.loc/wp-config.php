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
define('DB_NAME', 'wordpress.loc');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'qqqq2222');

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
define('AUTH_KEY',         'kLZfQXcau?*gh6XDv2hW_Ib9B,-T*qQ6X|zvY_9qx(-M}sZWbLW^J$)h}Kaa$I;p');
define('SECURE_AUTH_KEY',  'EkJiIVRgy|+.ACGH~c_R6GCUtB[#vv)QO-g]0(,HN>.FCbi@(tUT|oCFf&33-Urj');
define('LOGGED_IN_KEY',    'f?n1M=;|(qQUuWv[[bSkIL1nW|JNVZ7oS%3cXu[pia+;Zk/>o&KaA/W]&zyDKD(J');
define('NONCE_KEY',        'M5P-t+~9+(J!M3X|z=yA[mbieI?`+c_a@y/6js9|%^CCghFZrm32?amq=W8IW#4l');
define('AUTH_SALT',        'xiAF5hL=AgWH/[q^iTQdFDb `gaOrw7h[;83WM.@:P)L$#28w`z))Y^g53Md;iYl');
define('SECURE_AUTH_SALT', 'YV|;DLB2M~$}ezs:80w:g<(g.Uc3#B21b8z%,Ra+77M[d/~OHsohC@%teMg]VP0z');
define('LOGGED_IN_SALT',   'Qzz9l!Wq3|@--KyPL[YaX{9--y*Ob!^#E/dk;D9xAb{=8,P_CW2?ucO#$,cW]BT^');
define('NONCE_SALT',       'p:ewM(G*RjcEoQt++|gAy`rFy<qJG>5c2X9/)h[m8~IxFPc} : @^NK56{#B8Ltf');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
