<?php
/**
 * "Pen" WordPress plug-in.
 *
 * Import feature for post meta boxes.
 *
 * @link       https://www.htmlpie.com/products/pen-multipurpose-wordpress-theme/
 * @since      Pen Extra Features 1.0.0
 *
 * @package    Pen Extra Features
 * @subpackage Pen Extra Features/backend/classes
 */

// Prevents direct access.
defined( 'ABSPATH' ) || die();

/**
 * Post metaboxes import.
 *
 * @since      Pen Extra Features 1.0.0
 *
 * @package    Pen Extra Features
 * @subpackage Pen Extra Features/backend/classes
 * @author     HTMLPIE.COM
 */
class Pen_Plugin_Postmeta_Import {

	/**
	 * Adds extra features to Pen metaboxes.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return void
	 */
	public static function add() {
		// This is for the theme.
		require PEN_PLUGIN_DIR . 'backend/partials/postmeta/pen-plugin-postmeta-import.php';
		add_action( 'admin_enqueue_scripts', 'Pen_Plugin_Postmeta_Import::javascript' );
	}

	/**
	 * Adds postmeta JavaScript.
	 *
	 * @param string $hook_suffix The file name.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return void
	 */
	public static function javascript( $hook_suffix ) {
		if ( 'post.php' === $hook_suffix || 'post-new.php' === $hook_suffix ) {
			wp_enqueue_script( 'pen-plugin-postmeta-js', PEN_PLUGIN_URL . '/backend/assets/js/pen-plugin-postmeta.js', array( 'jquery', 'pen-postmeta-js' ), PEN_PLUGIN_VERSION, true );
			wp_localize_script(
				'pen-plugin-postmeta-js',
				'pen_plugin_backend_js',
				array(
					'ajax_url' => admin_url( 'admin-ajax.php' ),
					'text'     => array(
						'nothing_selected' => __( 'Please select an item.', 'pen-extra-features' ),
						'search'           => esc_html(
							sprintf(
								/* Translators: Just some word. */
								__( '%s:', 'pen-extra-features' ),
								__( 'Search', 'pen-extra-features' )
							)
						),
					),
				)
			);
			wp_register_style( 'pen-plugin-postmeta-css', PEN_PLUGIN_URL . '/backend/assets/css/pen-plugin-postmeta.css', array(), PEN_PLUGIN_VERSION );
			wp_enqueue_style( 'pen-plugin-postmeta-css' );
		}
	}

	/**
	 * Handles AJAX requests.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return void
	 */
	public static function ajax_request() {
		$nonce = filter_input( INPUT_POST, 'pen_nonce' );
		$id    = (int) filter_input( INPUT_POST, 'pen_content_id' );
		if ( $nonce && $id && wp_verify_nonce( $nonce, 'pen_ajax_nonce' ) && defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			if ( ! function_exists( 'pen_plugin_postmeta_overview' ) ) {
				require PEN_PLUGIN_DIR . 'backend/partials/postmeta/pen-plugin-postmeta-overview.php';
			}
			$customization = pen_plugin_postmeta_overview( $id );
			if ( ! $customization ) {
				$customization = sprintf(
					'<p><strong>%1$s</strong></p>',
					__( 'The selected content does not have a custom configuration; It is currently using the default configuration as set in the Customize section.', 'pen-extra-features' )
				);
			}
			exit(
				wp_json_encode(
					array(
						'results' => $customization,
					)
				)
			);
		} else {
			exit(
				wp_json_encode(
					array(
						'results' => sprintf(
							'<p>%1$s</p>',
							__( 'Something went wrong, please try again.', 'pen-extra-features' )
						),
					)
				)
			);
		}
	}

}
