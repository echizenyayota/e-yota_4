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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'wordpress');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'R,}SYl)+|Nfx)|mh!8BO+%k5IpZQE<8yJ<T+9.<-WD-#`)!Ru^|?s3$angNBt(t^');
define('SECURE_AUTH_KEY',  ' I1{UKRiaLpQ#eV!h=acJ0!.859}!$jlI@++*=_xnU`A|+>&yUdP!kA/ihfaM6#>');
define('LOGGED_IN_KEY',    '>Xv;)/]-)q9r`mNfQ@|}+H4:*%9eM/l.-7@_%ic)yf~OS-|DT<#xm}%qQFh7gV|e');
define('NONCE_KEY',        'v{.f~+WNk(V[K4}AV-c-~XWCK~OaBd}161<k)a/cUN%9-i`+[(:b^GM<]f90=i<F');
define('AUTH_SALT',        '9,*6o:_ht(DTL[Vul }!9_FC4o||o{Dt@|XY&8Y#ZX@=OI}{K0oI/,33:wxTEs/7');
define('SECURE_AUTH_SALT', 'bP`IoNcpQ 3?,}ktzz!n_+7r.x*ph>Q]_syiq=k!E3?7f97^;F^RzY:^|o.2 #Fv');
define('LOGGED_IN_SALT',   'p%|n`!upz hUha)8Ecv,:|5eN%+2L-C t6uc-#@>EZ#D$NX!(fsEf&e[K(vmWF{G');
define('NONCE_SALT',       '|&Ku|}+,05D%arbGMH/u+Ln!t>dnCK>5ySV?+W8*YT7Ad=2!Vv=g>NS+c,?2s{^1');


/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


define( 'WP_DEBUG', true );
define( 'WP_DEBUG_LOG', true );

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
