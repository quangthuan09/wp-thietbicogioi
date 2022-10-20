<?php
/**
 * "Pen" WordPress plug-in.
 *
 * Warning messages.
 *
 * @link       https://www.htmlpie.com/products/pen-multipurpose-wordpress-theme/
 * @since      Pen Extra Features 1.0.0
 *
 * @package    Pen Extra Features
 * @subpackage Pen Extra Features/backend/partials
 */

// Prevents direct access.
defined( 'ABSPATH' ) || die();

if ( ! function_exists( 'pen_plugin_backend_warnings' ) ) {
	/**
	 * Warning messages on the backend.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return void
	 */
	function pen_plugin_backend_warnings() {
		$message = '';
		if ( ! PEN_PLUGIN_HAS_THEME ) {
			?>
			<?php
			$pen_theme = wp_get_theme( 'pen' );
			if ( $pen_theme->exists() ) {
				$message = sprintf(
					/* Translators: A URL and the theme name. */
					__( 'You need to <a href="%1$s">activate the %2$s theme</a>.', 'pen-extra-features' ),
					esc_url( self_admin_url( 'themes.php?search=pen' ) ),
					__( 'Pen', 'pen-extra-features' )
				);
			} else {
				$message = sprintf(
					/* Translators: A URL and the theme name. */
					__( 'You need to <a href="%1$s">install the %2$s theme</a>.', 'pen-extra-features' ),
					esc_url( self_admin_url( 'theme-install.php?search=pen' ) ),
					__( 'Pen', 'pen-extra-features' )
				);
			}
		} elseif ( ! PEN_PLUGIN_REQUIREMENTS ) {
			$message = sprintf(
				/* Translators: A URL and the theme name. */
				__( 'You need to <a href="%1$s">update the %2$s theme</a>.', 'pen-extra-features' ),
				esc_url( self_admin_url( 'themes.php?search=pen' ) ),
				__( 'Pen', 'pen-extra-features' )
			);
		}
		if ( $message ) {
			?>
	<div id="message" class="error notice">
		<p>
			<?php
			echo wp_kses( $message, wp_kses_allowed_html( 'post' ) );
			?>
		</p>
	</div>
			<?php
		}
	}
}
