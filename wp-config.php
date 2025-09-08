<?php
define( 'WP_CACHE', true );

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'technical' );

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
define( 'AUTH_KEY',         'r:8+F7^zcwQcXv%qb/h/wzBd7y35YZmo]qgr5[.RG}855]CMGBXoLHfuXa_`V4}]' );
define( 'SECURE_AUTH_KEY',  'zjP=5gjJYw:hyvNB?+qO^EQ:b%}X1h^!n`&bbyA]57=0/;[7>9uf70D)UuY|byYc' );
define( 'LOGGED_IN_KEY',    'rE9LszTi5EL5jeQdK[]j1+p@qa*?6VNod|2.ALsRm.Q]?b_1#}N]R/jb!P[`Gi;(' );
define( 'NONCE_KEY',        'GDx*e:ZSP@50/6@;(t~(iT$GD6Oa-d){HQEdvp&r wY`hK~v*Ueuzz<e]NtaeY&.' );
define( 'AUTH_SALT',        'voN_-N3zEsvZK#8Q7j$c,BW|(vO<7I/&yHGgQ~Lqf?V<RL|=uwOqFxLrlS:X+r&j' );
define( 'SECURE_AUTH_SALT', 'I#e>Ds:4$~UK=9;eV$sCp*Lli_pQpZ}kmj0xmQ3/cUe4gR)l2=j@`wV!FK:w{HTF' );
define( 'LOGGED_IN_SALT',   'bj};%Dz;5i%W.fHV5$A]$6`=Emau:pol+aonl]k)/,=?^xT:Dx{nNGX zlF7V_Mz' );
define( 'NONCE_SALT',       'OX}Te,*OrZU8c2r-1]JZ~Na:V>S|y$`?+3Vp6n,sXk-y5-34f[)O#4Z=7(z=j8vO' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );
define( 'WP_DEBUG_DISPLAY', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
