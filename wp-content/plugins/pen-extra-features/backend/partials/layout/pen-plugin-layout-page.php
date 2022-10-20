<?php
/**
 * "Pen" WordPress plug-in.
 *
 * Layout page.
 *
 * @link       https://www.htmlpie.com/products/pen-multipurpose-wordpress-theme/
 * @since      Pen Extra Features 1.0.0
 *
 * @package    Pen Extra Features
 * @subpackage Pen Extra Features/backend/partials
 */

// Prevents direct access.
defined( 'ABSPATH' ) || die();

if ( ! function_exists( 'pen_plugin_layout_page' ) ) {
	/**
	 * Generates a list of available color schemes and font pairs.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return void
	 */
	function pen_plugin_layout_page() {
		?>
	<div class="wrap">
		<?php
		if ( ! function_exists( 'pen_layout_page_title' ) ) {
			require PEN_PLUGIN_DIR . 'backend/partials/layout/pen-plugin-layout-page-title.php';
		}
		pen_plugin_layout_page_title();
		?>
		<div id="hp_admin">
			<div class="pen_plugin_page_layout hp_no_js">
		<?php
		if ( ! function_exists( 'pen_plugin_backend_warnings' ) ) {
			require PEN_PLUGIN_DIR . 'backend/partials/common/pen-plugin-warnings.php';
		}
		pen_plugin_backend_warnings();

		if ( PEN_PLUGIN_HAS_THEME ) {
			$notices     = array();
			$problematic = array();
			$updated     = false;
			$nonce       = filter_input( INPUT_POST, 'pen_nonce' );
			if ( $nonce && wp_verify_nonce( $nonce, 'pen_layout' ) ) {

				$list_type = filter_input( INPUT_POST, 'pen_list_type' );
				if ( pen_sanitize_list_type( $list_type ) ) {
					$updated = true;
					set_theme_mod( 'pen_list_type', array( 'preset_1' => $list_type ) );
				}

				$container_position = filter_input( INPUT_POST, 'pen_container_position' );
				if ( pen_sanitize_alignment( $container_position ) ) {
					$updated = true;
					set_theme_mod( 'pen_container_position', array( 'preset_1' => $container_position ) );
				}

				$site_width = filter_input( INPUT_POST, 'pen_site_width' );
				if ( pen_sanitize_site_width( $site_width ) ) {
					$updated = true;
					set_theme_mod( 'pen_site_width', array( 'preset_1' => $site_width ) );
				}

				if ( $updated ) {
					?>
				<div id="message" class="updated notice">
					<p>
					<?php
					esc_html_e( 'Settings saved.', 'pen-extra-features' );
					?>
					</p>
				</div>
					<?php
				}

				// Clears Autoptimize cache (also some other plugins).
				if ( method_exists( 'autoptimizeCache', 'clearall' ) ) {
					autoptimizeCache::clearall();
				}
				if ( function_exists( 'autoptimize_flush_pagecache' ) ) {
					autoptimize_flush_pagecache();
				}

				// Clears WP Super Cache.
				if ( function_exists( 'wp_cache_clear_cache' ) ) {
					wp_cache_clear_cache();
				}
			}
			?>

				<form method="post">
					<fieldset>

						<fieldset class="pen_options_list_type">
							<legend>
			<?php
			esc_html_e( 'List Views', 'pen-extra-features' );
			?>
							</legend>
							<div class="hp_row">
			<?php
			$setting_id = 'list_type';
			$value      = pen_option_get( $setting_id );
			$options    = array(
				'masonry' => __( 'jQuery Masonry', 'pen-extra-features' ),
				'tiles'   => __( 'Tiles', 'pen-extra-features' ),
				'plain'   => __( 'Plain List', 'pen-extra-features' ),
			);
			foreach ( $options as $option => $label ) {
				?>
								<label for="pen_<?php echo esc_attr( $setting_id . '_option_' . $option ); ?>" id="pen_<?php echo esc_attr( $setting_id . '_' . $option ); ?>">
									<span>
				<?php
				echo esc_html( $label );
				?>
									</span>
									<input type="radio" name="pen_<?php echo esc_attr( $setting_id ); ?>" value="<?php echo esc_attr( $option ); ?>" id="pen_<?php echo esc_attr( $setting_id . '_option_' . $option ); ?>"<?php checked( $option, $value ); ?> />
								</label>
				<?php
			}
			?>
							</div>
						</fieldset>

						<fieldset class="pen_options_alignment">
							<legend>
			<?php
			esc_html_e( 'Alignment', 'pen-extra-features' );
			?>
							</legend>
							<div class="hp_row">
			<?php
			$setting_id = 'container_position';
			$value      = pen_option_get( $setting_id );
			$options    = array(
				'left'   => __( 'Left', 'pen-extra-features' ),
				'center' => __( 'Center', 'pen-extra-features' ),
				'right'  => __( 'Right', 'pen-extra-features' ),
			);
			foreach ( $options as $option => $label ) {
				?>
								<label for="pen_<?php echo esc_attr( $setting_id . '_option_' . $option ); ?>" id="pen_<?php echo esc_attr( $setting_id . '_' . $option ); ?>">
									<span>
				<?php
				echo esc_html( $label );
				?>
									</span>
									<input type="radio" name="pen_<?php echo esc_attr( $setting_id ); ?>" value="<?php echo esc_attr( $option ); ?>" id="pen_<?php echo esc_attr( $setting_id . '_option_' . $option ); ?>"<?php checked( $option, $value ); ?> />
								</label>
				<?php
			}
			?>
							</div>
						</fieldset>

						<fieldset class="pen_options_width">
							<legend>
			<?php
			esc_html_e( 'Width', 'pen-extra-features' );
			?>
							</legend>
							<div class="hp_row">
			<?php
			$setting_id = 'site_width';
			$value      = pen_option_get( $setting_id );
			$options    = array(
				'boxed'    => __( 'Boxed', 'pen-extra-features' ),
				'narrow'   => __( 'Narrow', 'pen-extra-features' ),
				'standard' => __( 'Standard', 'pen-extra-features' ),
				'wide'     => __( 'Wide', 'pen-extra-features' ),
			);
			foreach ( $options as $option => $label ) {
				?>
								<label for="pen_<?php echo esc_attr( $setting_id . '_option_' . $option ); ?>" id="pen_<?php echo esc_attr( $setting_id . '_' . $option ); ?>">
									<span>
				<?php
				echo esc_html( $label );
				?>
									</span>
									<input type="radio" name="pen_<?php echo esc_attr( $setting_id ); ?>" value="<?php echo esc_attr( $option ); ?>" id="pen_<?php echo esc_attr( $setting_id . '_option_' . $option ); ?>"<?php checked( $option, $value ); ?> />
								</label>
				<?php
			}
			?>
							</div>
						</fieldset>

						<div class="hp_row">
			<?php
			$page = filter_input( INPUT_GET, 'page' );
			?>
							<input type="hidden" name="page" value="<?php echo esc_attr( $page ); ?>" />
			<?php
			wp_nonce_field( 'pen_layout', 'pen_nonce' );
			?>
							<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Save Configuration', 'pen-extra-features' ); ?>" />
						</div>
					</fieldset>
				</form>

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
