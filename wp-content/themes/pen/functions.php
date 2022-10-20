<?php
/**
 * The functions.php file.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Pen
 */

define( 'PEN_THEME_SUPPORT_URL', 'https://wordpress.org/support/theme/pen/' );
define( 'PEN_THEME_SUPPORT_URL_URGENT', 'https://www.htmlpie.com/support' );
define( 'PEN_THEME_RATING_URL', 'https://wordpress.org/support/theme/pen/reviews/#new-post' );
define( 'PEN_THEME_DIRECTORY', get_template_directory() );
define( 'PEN_THEME_DIRECTORY_URI', get_template_directory_uri() );
define( 'PEN_THEME_NOTICE_DEPRECATION', false );
define( 'PEN_THEME_DARK_MODE', true );
define( 'PEN_THEME_CUSTOM_CSS', true );
define( 'PEN_THEME_NUMBER_COLOR_SCHEMES', 20 );
define( 'PEN_THEME_NUMBER_FONT_PAIRS', 10 );
define( 'PEN_THEME_HAS_WOOCOMMERCE', class_exists( 'WooCommerce' ) );
define( 'PEN_THEME_HAS_ASGAROS_FORUM', class_exists( 'AsgarosForum' ) );

if ( PEN_THEME_HAS_WOOCOMMERCE ) {
	require PEN_THEME_DIRECTORY . '/include/plugins/woocommerce.php';
}

require PEN_THEME_DIRECTORY . '/include/color.php';
require PEN_THEME_DIRECTORY . '/include/general.php';

define( 'PEN_THEME_PREVIEW', ( 'wp-themes.com' === pen_domain_name() ) ? true : false );

require PEN_THEME_DIRECTORY . '/include/compress.php';
require PEN_THEME_DIRECTORY . '/include/sanitize.php';
require PEN_THEME_DIRECTORY . '/include/typography.php';
require PEN_THEME_DIRECTORY . '/include/html.php';
require PEN_THEME_DIRECTORY . '/include/configure.php';
require PEN_THEME_DIRECTORY . '/include/assets.php';
require PEN_THEME_DIRECTORY . '/include/sidebars.php';
require PEN_THEME_DIRECTORY . '/include/widgets.php';
require PEN_THEME_DIRECTORY . '/include/content.php';
require PEN_THEME_DIRECTORY . '/include/customize.php';
require PEN_THEME_DIRECTORY . '/install/list.php';

