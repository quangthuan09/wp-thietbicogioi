<?php
/**
 * Plugin Name: Pen
 * Plugin URI:  https://wordpress.org/plugins/pen-extra-features
 * Description: This plugin adds more features to the fantastic Pen theme.
 * Version:     1.1.0
 * Author:      htmlpie
 * Author URI:  https://www.htmlpie.com/
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: pen-extra-features
 * Domain Path: /languages
 *
 * @package Pen Extra Features
 */

// Prevents direct access.
defined( 'ABSPATH' ) || die();

define( 'PEN_PLUGIN_URL', plugins_url( '', __FILE__ ) );
define( 'PEN_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'PEN_PLUGIN_VERSION', '1.0.9' );
define( 'PEN_PLUGIN_SUPPORT_URL', 'https://wordpress.org/support/theme/pen/' );

define( 'PEN_PLUGIN_DOCUMENTATION_URL', 'https://www.htmlpie.com/knowledge-base/documentations/pen-multipurpose-wordpress-theme' );

define( 'PEN_PLUGIN_NUMBER_COLOR_SCHEMES', 20 );
define( 'PEN_PLUGIN_NUMBER_FONT_PAIRS', 10 );

if ( ! function_exists( 'pen_plugin_run' ) ) {
	/**
	 * Initiates the awesome Pen Extra Features plugin.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return void
	 */
	function pen_plugin_run() {
		pen_plugin_requirements_check();
		if ( is_admin() && ( current_user_can( 'edit_pages' ) || current_user_can( 'edit_posts' ) || current_user_can( 'edit_products' ) ) ) {
			require PEN_PLUGIN_DIR . 'backend/classes/class-pen-plugin-postmeta-import.php';
			add_action( 'add_meta_boxes', 'Pen_Plugin_Postmeta_Import::add' );
			add_action( 'wp_ajax_pen_postmeta', 'Pen_Plugin_Postmeta_Import::ajax_request' );

			require PEN_PLUGIN_DIR . 'backend/classes/class-pen-plugin-addons.php';

			require PEN_PLUGIN_DIR . 'backend/classes/class-pen-plugin-customization.php';
			add_action( 'admin_init', 'Pen_Plugin_Customization::download' );
			add_action( 'admin_menu', 'pen_plugin_menu' );
		}
		if ( is_admin_bar_showing() ) {
			require PEN_PLUGIN_DIR . 'shared/pen-plugin-toolbar.php';
			add_action( 'admin_bar_menu', 'pen_plugin_toolbar', 500 );
		}
	}
	add_action( 'init', 'pen_plugin_run' );
}

if ( ! function_exists( 'pen_plugin_requirements_check' ) ) {
	/**
	 * Checks whether Pen theme is installed, active, and meets the minimum.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return void
	 */
	function pen_plugin_requirements_check() {
		$pen_theme = wp_get_theme( 'pen' );
		// exists() checks whether the folder also exists,
		// as get_template() may just return what is in the database.
		if ( $pen_theme->exists() && 'pen' === get_template() ) {
			define( 'PEN_PLUGIN_HAS_THEME', true );
			if ( version_compare( $pen_theme->get( 'Version' ), '1.2.8', '>=' ) ) {
				define( 'PEN_PLUGIN_REQUIREMENTS', true );
			} else {
				define( 'PEN_PLUGIN_REQUIREMENTS', false );
			}
		} else {
			define( 'PEN_PLUGIN_HAS_THEME', false );
			define( 'PEN_PLUGIN_REQUIREMENTS', false );
		}
	}
}

if ( ! function_exists( 'pen_plugin_menu' ) ) {
	/**
	 * Adds the plugin links to the administration navigation menu.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return void
	 */
	function pen_plugin_menu() {
		if ( ! function_exists( 'pen_plugin_style_page' ) ) {
			require PEN_PLUGIN_DIR . 'backend/partials/style/pen-plugin-style-page.php';
		}
		$pen_plugin = add_menu_page(
			esc_html( ! PEN_PLUGIN_HAS_THEME ? __( 'Pen Plugin', 'pen-extra-features' ) : __( 'Pen Theme', 'pen-extra-features' ) ),
			esc_html( ! PEN_PLUGIN_HAS_THEME ? __( 'Pen Plugin', 'pen-extra-features' ) : __( 'Pen Theme', 'pen-extra-features' ) ),
			'administrator',
			'pen-extra-features',
			'pen_plugin_style_page'
		);

		$style = add_submenu_page(
			'pen-extra-features',
			sprintf(
				'%1$s ‹ %2$s',
				esc_html__( 'Styles', 'pen-extra-features' ),
				esc_html__( 'Pen Theme', 'pen-extra-features' )
			),
			esc_html__( 'Style', 'pen-extra-features' ),
			'administrator',
			'pen-extra-features',
			'pen_plugin_style_page'
		);

		if ( ! function_exists( 'pen_plugin_layout_page' ) ) {
			require PEN_PLUGIN_DIR . 'backend/partials/layout/pen-plugin-layout-page.php';
		}
		$layout = add_submenu_page(
			'pen-extra-features',
			sprintf(
				'%1$s ‹ %2$s',
				esc_html__( 'Layout', 'pen-extra-features' ),
				esc_html__( 'Pen Theme', 'pen-extra-features' )
			),
			esc_html__( 'Layout', 'pen-extra-features' ),
			'administrator',
			'pen-extra-features-layout',
			'pen_plugin_layout_page'
		);

		if ( ! function_exists( 'pen_plugin_overview_page' ) ) {
			require PEN_PLUGIN_DIR . 'backend/partials/overview/pen-plugin-overview-page.php';
		}
		$overview = add_submenu_page(
			'pen-extra-features',
			sprintf(
				'%1$s ‹ %2$s',
				esc_html__( 'Content Customization Overview', 'pen-extra-features' ),
				esc_html__( 'Pen Theme', 'pen-extra-features' )
			),
			esc_html__( 'Content Customization', 'pen-extra-features' ),
			'administrator',
			'pen-extra-features-overview',
			'pen_plugin_overview_page'
		);

		if ( Pen_Plugin_Customization::export() ) {
			if ( ! function_exists( 'pen_plugin_export_page' ) ) {
				require PEN_PLUGIN_DIR . 'backend/partials/export/pen-plugin-export-page.php';
			}
			$export = add_submenu_page(
				'pen-extra-features',
				sprintf(
					'%1$s ‹ %2$s',
					esc_html__( 'Customization Export', 'pen-extra-features' ),
					esc_html__( 'Pen Theme', 'pen-extra-features' )
				),
				esc_html__( 'Customization Export', 'pen-extra-features' ),
				'administrator',
				'pen-extra-features-export',
				'pen_plugin_export_page'
			);
		}

		if ( ! function_exists( 'pen_plugin_import_page' ) ) {
			require PEN_PLUGIN_DIR . 'backend/partials/import/pen-plugin-import-page.php';
		}
		$import = add_submenu_page(
			'pen-extra-features',
			sprintf(
				'%1$s ‹ %2$s',
				esc_html__( 'Customization Import', 'pen-extra-features' ),
				esc_html__( 'Pen Theme', 'pen-extra-features' )
			),
			esc_html__( 'Customization Import', 'pen-extra-features' ),
			'administrator',
			'pen-extra-features-import',
			'pen_plugin_import_page'
		);

		if ( ! class_exists( 'Pen_Plugin_Addons' ) ) {
			require PEN_PLUGIN_DIR . 'backend/classes/class-pen-plugin-addons.php';
		}
		if ( ! function_exists( 'pen_plugin_addons_page' ) ) {
			require PEN_PLUGIN_DIR . 'backend/partials/addons/pen-plugin-addons-page.php';
		}
		$addons_new   = Pen_Plugin_Addons::count_new();
		$count_addons = '';
		if ( $addons_new ) {
			$count_addons .= ' <span class="update-plugins count-' . esc_attr( $addons_new ) . '">';
			$count_addons .= '<span class="pen-plugin-new-addons-count">' . esc_html( $addons_new ) . '</span>';
			$count_addons .= '</span>';
		}
		$addons = add_submenu_page(
			'pen-extra-features',
			sprintf(
				'%1$s ‹ %2$s',
				esc_html__( 'Addons', 'pen-extra-features' ),
				esc_html__( 'Pen Theme', 'pen-extra-features' )
			),
			esc_html__( 'Addons', 'pen-extra-features' ) . $count_addons, /* phpcs:ignore */
			'administrator',
			'pen-extra-features-addons',
			'pen_plugin_addons_page'
		);

		// Includes CSS and JavaScript stuff.
		add_action( 'admin_print_styles-' . $pen_plugin, 'pen_plugin_css' );
		add_action( 'admin_print_styles-' . $style, 'pen_plugin_css' );
		add_action( 'admin_print_styles-' . $layout, 'pen_plugin_css' );
		add_action( 'admin_print_styles-' . $overview, 'pen_plugin_css' );
		if ( isset( $export ) ) {
			add_action( 'admin_print_styles-' . $export, 'pen_plugin_css' );
		}
		add_action( 'admin_print_styles-' . $import, 'pen_plugin_css' );
		add_action( 'admin_print_styles-' . $addons, 'pen_plugin_css' );
	}
}

if ( ! function_exists( 'pen_plugin_css' ) ) {
	/**
	 * Adds required CSS.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return void
	 */
	function pen_plugin_css() {

		$directory_css = PEN_PLUGIN_URL . '/backend/assets/css/';

		wp_register_style( 'hp-backend', $directory_css . 'hp-backend.css', array(), PEN_PLUGIN_VERSION );
		wp_enqueue_style( 'hp-backend' );

		$current_page = filter_input( INPUT_GET, 'page' );
		$dependencies = array( 'hp-backend' );

		switch ( $current_page ) {
			case 'pen-extra-features':
				wp_register_style( 'pen-plugin-style', $directory_css . 'pen-plugin-style.css', $dependencies, PEN_PLUGIN_VERSION );
				wp_enqueue_style( 'pen-plugin-style' );
				break;

			case 'pen-extra-features-layout':
				wp_register_style( 'pen-plugin-layout', $directory_css . 'pen-plugin-layout.css', $dependencies, PEN_PLUGIN_VERSION );
				wp_enqueue_style( 'pen-plugin-layout' );
				break;

			case 'pen-extra-features-overview':
				wp_register_style( 'pen-plugin-overview', $directory_css . 'pen-plugin-overview.css', $dependencies, PEN_PLUGIN_VERSION );
				wp_enqueue_style( 'pen-plugin-overview' );
				break;

			case 'pen-extra-features-export':
				wp_register_style( 'pen-plugin-export', $directory_css . 'pen-plugin-export.css', $dependencies, PEN_PLUGIN_VERSION );
				wp_enqueue_style( 'pen-plugin-export' );
				break;

			case 'pen-extra-features-import':
				wp_register_style( 'pen-plugin-import', $directory_css . 'pen-plugin-import.css', $dependencies, PEN_PLUGIN_VERSION );
				wp_enqueue_style( 'pen-plugin-import' );
				break;

			case 'pen-extra-features-addons':
				wp_register_style( 'pen-plugin-addons', $directory_css . 'pen-plugin-addons.css', $dependencies, PEN_PLUGIN_VERSION );
				wp_enqueue_style( 'pen-plugin-addons' );
				break;
		}
	}
}

if ( ! function_exists( 'pen_plugin_load_textdomain' ) ) {
	/**
	 * Load textdomain.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return void
	 */
	function pen_plugin_load_textdomain() {
		load_plugin_textdomain( 'pen-extra-features', false, PEN_PLUGIN_DIR . 'languages' );
	}
	add_action( 'plugins_loaded', 'pen_plugin_load_textdomain' );
}

if ( ! function_exists( 'pen_plugin_uninstall' ) ) {
	/**
	 * Basically removes postmeta.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return void
	 */
	function pen_plugin_uninstall() {
		delete_post_meta_by_key( 'pen_meta_name' );
	}
	register_uninstall_hook( __FILE__, 'pen_plugin_uninstall' );
}
