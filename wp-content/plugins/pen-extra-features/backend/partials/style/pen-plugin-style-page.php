<?php
/**
 * "Pen" WordPress plug-in.
 *
 * Styles page.
 *
 * @link       https://www.htmlpie.com/products/pen-multipurpose-wordpress-theme/
 * @since      Pen Extra Features 1.0.0
 *
 * @package    Pen Extra Features
 * @subpackage Pen Extra Features/backend/partials
 */

// Prevents direct access.
defined( 'ABSPATH' ) || die();

if ( ! function_exists( 'pen_plugin_style_page' ) ) {
	/**
	 * Generates a list of available color schemes and font pairs.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return void
	 */
	function pen_plugin_style_page() {
		?>
	<div class="wrap">
		<?php
		if ( ! function_exists( 'pen_style_page_title' ) ) {
			require PEN_PLUGIN_DIR . 'backend/partials/style/pen-plugin-style-page-title.php';
		}
		pen_plugin_style_page_title();
		?>
		<div id="hp_admin">
			<div class="pen_plugin_page_style hp_no_js">
		<?php
		if ( ! function_exists( 'pen_plugin_backend_warnings' ) ) {
			require PEN_PLUGIN_DIR . 'backend/partials/common/pen-plugin-warnings.php';
		}
		pen_plugin_backend_warnings();

		if ( PEN_PLUGIN_HAS_THEME ) {
			?>

				<div class="pen_preset_thumbnails pen_color">
					<h2>
			<?php
			esc_html_e( 'Color Schemes', 'pen-extra-features' );
			?>
					</h2>
					<div class="hp_row">
						<p>
			<?php
			esc_html_e( 'You can set different color schemes for different posts by changing the "Color Scheme" setting in the "Pen Options" section under the content editor.', 'pen-extra-features' );
			?>
						</p>
						<ul>
			<?php
			$preset = (int) str_replace( 'preset_', '', pen_option_get( 'preset_color' ) );
			for ( $s = 1; $s <= PEN_PLUGIN_NUMBER_COLOR_SCHEMES; $s++ ) {

				if ( $s === $preset ) {
					$preview_caption = __( 'View', 'pen-extra-features' );
					$preview_link    = is_multisite() ? network_home_url( false ) : home_url( false );

					$wrapper_start = 'div';
					$wrapper_end   = 'div';

					$button_start = 'a href="' . esc_url( $preview_link ) . '"';
					$button_end   = 'a';
				} else {
					$preview_caption = __( 'Preview', 'pen-extra-features' );
					$preview_link    = add_query_arg( 'pen_preview_color', rawurlencode( $s ), wp_customize_url() );

					$wrapper_start = 'a href="' . esc_url( $preview_link ) . '"';
					$wrapper_end   = 'a';

					$button_start = 'span';
					$button_end   = 'span';
				}

				$classes = trim(
					implode(
						' ',
						array_filter(
							array(
								'pen_thumbnail_wrapper',
								'pen_preset_' . $s,
								( $s === $preset ) ? 'pen_active' : '',
							)
						)
					)
				);
				?>
							<li>
								<<?php echo $wrapper_start; /* phpcs:ignore */ ?> class="<?php echo esc_attr( $classes ); ?>">
				<?php
				if ( $s === $preset ) {
					?>
									<span class="screen-reader-text">
					<?php
					echo esc_html(
						sprintf(
							/* Translators: Just some word. */
							__( '%s:', 'pen-extra-features' ),
							__( 'Current Style', 'pen-extra-features' )
						)
					);
					?>
									</span>
					<?php
				}
				?>
									<span class="pen_thumbnail">
										<span>
				<?php
				// Translators: %d: The style number.
				echo esc_html( trim( sprintf( __( 'Style %d', 'pen-extra-features' ), $s ) ) );
				?>
										</span>
									</span>


									<<?php echo $button_start; /* phpcs:ignore */ ?> class="button pen_button_preview">
				<?php
				echo esc_html( $preview_caption );
				?>
									</<?php echo $button_end; /* phpcs:ignore */ ?>>
				<?php
				if ( $s === $preset ) {
					?>
									<a href="<?php echo esc_url( add_query_arg( 'autofocus[panel]', 'pen_panel_colors', wp_customize_url() ) ); ?>" class="button button-primary pen_button_customize">
					<?php
					esc_html_e( 'Customize', 'pen-extra-features' );
					?>
									</a>
					<?php
				}
				?>
								</<?php echo $wrapper_end; /* phpcs:ignore */ ?>>
							</li>
				<?php
			}
			?>
						</ul>
					</div>
				</div>

				<div class="pen_preset_thumbnails pen_font">
					<h2>
			<?php
			esc_html_e( 'Font Groups', 'pen-extra-features' );
			?>
					</h2>
					<div class="hp_row">
						<p>
			<?php
			esc_html_e( 'These are pre-defined font pairs, you can find more font choices in the Customize section.', 'pen-extra-features' );
			?>
						</p>
						<ul>
			<?php
			$preset = (int) str_replace( 'preset_', '', pen_option_get( 'preset_font' ) );
			for ( $s = 1; $s <= PEN_PLUGIN_NUMBER_FONT_PAIRS; $s++ ) {

				if ( $s === $preset ) {
					$preview_caption = __( 'View', 'pen-extra-features' );
					$preview_link    = is_multisite() ? network_home_url( false ) : home_url( false );

					$wrapper_start = 'div';
					$wrapper_end   = 'div';

					$button_start = 'a href="' . esc_url( $preview_link ) . '"';
					$button_end   = 'a';
				} else {
					$preview_caption = __( 'Preview', 'pen-extra-features' );
					$preview_link    = add_query_arg( 'pen_preview_font', rawurlencode( $s ), wp_customize_url() );

					$wrapper_start = 'a href="' . esc_url( $preview_link ) . '"';
					$wrapper_end   = 'a';

					$button_start = 'span';
					$button_end   = 'span';
				}

				$classes = trim(
					implode(
						' ',
						array_filter(
							array(
								'pen_thumbnail_wrapper',
								'pen_preset_' . $s,
								( $s === $preset ) ? 'pen_active' : '',
							)
						)
					)
				);
				?>
							<li>
								<<?php echo $wrapper_start; /* phpcs:ignore */ ?> class="<?php echo esc_attr( $classes ); ?>">
									<span class="pen_thumbnail">
										<span>
				<?php
				// Translators: %d: The style number.
				echo esc_html( trim( sprintf( __( 'Style %d', 'pen-extra-features' ), $s ) ) );
				?>
										</span>
									</span>
									<<?php echo $button_start; /* phpcs:ignore */ ?> class="button pen_button_preview">
				<?php
				echo esc_html( $preview_caption );
				?>
									</<?php echo $button_end; /* phpcs:ignore */ ?>>
				<?php
				if ( $s === $preset ) {
					?>
									<a href="<?php echo esc_url( add_query_arg( 'autofocus[panel]', 'pen_panel_typography', wp_customize_url() ) ); ?>" class="button button-primary pen_button_customize">
					<?php
					esc_html_e( 'Customize', 'pen-extra-features' );
					?>
									</a>
					<?php
				}
				?>
								</<?php echo $wrapper_end; /* phpcs:ignore */ ?>>
							</li>
				<?php
			}
			?>
						</ul>
					</div>
				</div>
			<?php
			if ( ! function_exists( 'pen_plugin_backend_footer' ) ) {
				require PEN_PLUGIN_DIR . 'backend/partials/common/pen-plugin-footer.php';
			}
			pen_plugin_backend_footer();
		}
		?>
			</div>
		</div>
	</div>
		<?php
	}
}
