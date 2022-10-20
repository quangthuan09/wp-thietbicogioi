<?php
/**
 * "Pen" WordPress plug-in.
 *
 * Footer menu.
 *
 * @link       https://www.htmlpie.com/products/pen-multipurpose-wordpress-theme/
 * @since      Pen Extra Features 1.0.0
 *
 * @package    Pen Extra Features
 * @subpackage Pen Extra Features/backend/partials
 */

// Prevents direct access.
defined( 'ABSPATH' ) || die();

if ( ! function_exists( 'pen_plugin_backend_footer' ) ) {
	/**
	 * Settings page output
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return void
	 */
	function pen_plugin_backend_footer() {
		if ( ! PEN_PLUGIN_HAS_THEME ) {
			return;
		}

		ob_start();
		?>
	<div id="hp_menu_footer">
		<ul>
			<li>
		<?php
		$pen_theme = wp_get_theme( 'pen' );
		printf(
			/* Translators: %$1s, %3$s links, %2$s: version number. */
			esc_html__( 'You are using the %1$s v%2$s by %3$s', 'pen-extra-features' ),
			sprintf(
				'<a href="%1$s" title="%2$s">%3$s</a>',
				esc_url( 'https://www.wordpress.org/themes/pen' ),
				esc_attr__( 'External link', 'pen-extra-features' ),
				esc_html__( 'Pen Theme', 'pen-extra-features' )
			),
			esc_html( $pen_theme->get( 'Version' ) ),
			// Haven't used __() functions for the "htmlpie" to avoid confusion.
			sprintf(
				'<a href="%1$s" title="%2$s">htmlpie</a>',
				esc_url( 'https://www.htmlpie.com/' ),
				esc_attr__( 'External link', 'pen-extra-features' )
			)
		);
		?>
			</li>
			<li>
		<?php
		printf(
			'<a href="%1$s" title="%2$s">%3$s</a>',
			esc_url( PEN_PLUGIN_DOCUMENTATION_URL ),
			esc_attr__( 'External link', 'pen-extra-features' ),
			esc_html__( 'Theme Documentation', 'pen-extra-features' )
		);
		?>
			</li>
			<li>
		<?php
		printf(
			'<a href="%1$s" title="%2$s">%3$s</a>',
			esc_url( PEN_PLUGIN_SUPPORT_URL ),
			esc_attr__( 'External link', 'pen-extra-features' ),
			esc_html__( 'Feature Requests', 'pen-extra-features' )
		);
		?>
			</li>
			<li>
		<?php
		printf(
			'<a href="%1$s" title="%2$s">%3$s</a>',
			esc_url( PEN_PLUGIN_SUPPORT_URL ),
			esc_attr__( 'External link', 'pen-extra-features' ),
			esc_html__( 'Help & Support', 'pen-extra-features' )
		);
		?>
			</li>
		</ul>
	</div>
		<?php
		echo wp_kses( ob_get_clean(), wp_kses_allowed_html( 'post' ) );
	}
}
