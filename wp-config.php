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
define('DB_NAME', 'senzix15_cyber');

/** MySQL database username */
define('DB_USER', 'senzix15_admin');

/** MySQL database password */
define('DB_PASSWORD', 'senzit123$%^');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('WP_MEMORY_LIMIT', '64M');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'fjsrpeoyk0glg2tveqiuyslepkee0im6hhwjqbndluzphjdzv9cnvdkfio4sahxr');
define('SECURE_AUTH_KEY',  'wixkcs44xg0r4h0vvokf8b17mpeeasz0pnqxvxtfd6whafrs2tkohbp8qbt7lki1');
define('LOGGED_IN_KEY',    'v61ikhbphvs0ep4itukvnuhmvwbkorrfeq38y0vy9olqiykmhfbxcwgr5tvh3rok');
define('NONCE_KEY',        'byzkspt1pf6qe0w6yjy8mgu4gyu1d535dgi4ywndsvvrjeg6uix0qgtd4exyzsm9');
define('AUTH_SALT',        'btuxcohoqfvymqbbkorgdge10br8rk3zxinwh1qyqziqbiblat6d95nf5wgd7xue');
define('SECURE_AUTH_SALT', 'ygoibga1tycnldm8q0ju9aliokmyqffallb2gupsoyqhdy41kj3ewauyzlfifjzn');
define('LOGGED_IN_SALT',   'swqexqn0kxyybwouotvp1cv1tkkdukgmhctd80uvcvq2gd6xmhzackfbvquxhchp');
define('NONCE_SALT',       'asodak8ysfmljqkulrfa5hwimytciuwh2edoqvadjxo2go7cipollgfk5avteayu');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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