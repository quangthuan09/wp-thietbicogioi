<?php
/**
 * "Pen" WordPress plug-in.
 *
 * Addons page.
 *
 * @link       https://www.htmlpie.com/products/pen-multipurpose-wordpress-theme/
 * @since      Pen Extra Features 1.0.0
 *
 * @package    Pen Extra Features
 * @subpackage Pen Extra Features/backend/partials
 */

// Prevents direct access.
defined( 'ABSPATH' ) || die();

if ( ! function_exists( 'pen_plugin_addons_page' ) ) {
	/**
	 * Builds the Add-ons page.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return void
	 */
	function pen_plugin_addons_page() {

		if ( ! class_exists( 'Pen_Plugin_Addons' ) ) {
			require PEN_PLUGIN_DIR . 'backend/classes/class-pen-plugin-addons.php';
		}
		?>
	<div class="wrap">
		<?php
		if ( ! function_exists( 'pen_addons_page_title' ) ) {
			require PEN_PLUGIN_DIR . 'backend/partials/addons/pen-plugin-addons-page-title.php';
		}
		pen_plugin_addons_page_title();
		?>
		<div id="hp_admin">
			<div class="pen_plugin_page_addons hp_no_js">
			<?php
			if ( ! function_exists( 'pen_plugin_backend_warnings' ) ) {
				require PEN_PLUGIN_DIR . 'backend/partials/common/pen-plugin-warnings.php';
			}
			pen_plugin_backend_warnings();

			if ( PEN_PLUGIN_HAS_THEME ) {
				?>
				<div class="hp_grid">
					<div class="hp_column_2">
						<p>
							<strong>
				<?php
				printf(
					'%1$s&nbsp;%2$s<br>%3$s',
					esc_html__( "Dear users, we have spent a lot of time building this theme, so please show us your appreciation and help us continue the development by buying the theme or maybe our beautiful Advanced Contact Form plugin, it's very awesome.", 'pen-extra-features' ),
					esc_html__( 'We also provide WordPress optimization and maintenance services.', 'pen-extra-features' ),
					esc_html__( 'Thank you in advance!', 'pen-extra-features' )
				);
				?>
								<span class="dashicons dashicons-heart" style="color:#e00;display:inline-block">
								<span>
							</strong>
						</p>
					</div>
				</div>

				<div class="hp_grid">
					<?php
					$addons = Pen_Plugin_Addons::items();
					if ( is_array( $addons ) ) {
						foreach ( $addons as $key => $addon ) {
							$installed     = Pen_Plugin_Addons::is_installed( $addon['type'], $addon['slug'] ) ? true : false;
							$new           = ( ! $installed && ! empty( $addon['new'] ) ) ? true : false;
							$special       = ( ! empty( $addon['special_offer']['active'] ) ) ? true : false;
							$special_price = ( $special && ! empty( $addon['special_offer']['price'] ) ) ? true : false;

							$recommended = false;
							if ( isset( $addon['recommended'] ) && is_array( $addon['recommended'] ) && $addon['recommended'] ) {
								foreach ( $addon['recommended'] as $item ) {
									if ( Pen_Plugin_Addons::is_installed( $item['type'], $item['slug'] ) ) {
										$recommended = true;
									}
								}
							}

							$classes = trim(
								implode(
									' ',
									array_filter(
										array(
											'pen_plugin_addon',
											$installed ? 'pen_plugin_installed' : '',
											$new ? 'pen_plugin_new' : '',
											( $recommended && ! $installed ) ? 'pen_plugin_recommended' : '',
											$special ? 'pen_plugin_special' : '',
											$special_price ? 'pen_plugin_price_special' : '',
										)
									)
								)
							);
							?>
					<div class="hp_column_3">
						<div class="<?php echo esc_attr( $classes ); ?>">
							<h3>
								<img src="<?php echo esc_url( $addon['icon'] ); ?>" height="64" width="64" alt="<?php echo esc_attr( $addon['title'] ); ?>" />
								<div>
								<?php
								echo esc_html( $addon['title'] );
								if ( ! empty( $addon['rating'] ) ) {
									?>
									<span class="pen_plugin_rating pen_plugin_rating_<?php echo sanitize_html_class( $addon['rating'][0] ); ?>">
									<?php
									echo esc_html( $addon['rating'][1] );
									?>
									</span>
									<?php
								}
								if ( $installed ) {
									?>
									<span class="pen_plugin_installed">
									<?php
									esc_html_e( 'Installed', 'pen-extra-features' );
									if ( ! Pen_Plugin_Addons::is_active( $addon['type'], $addon['slug'] ) ) {
										echo esc_html(
											sprintf(
												/* Translators: Just some words. */
												__( ' (%s)', 'pen-extra-features' ),
												__( 'Deactivated', 'pen-extra-features' )
											)
										);
									}
									?>
									</span>
									<?php
								}
								?>
								</div>
							</h3>
							<?php
							if ( ! $special ) {
								if ( $new ) {
									?>
							<span class="pen_plugin_label_new">
									<?php
									esc_html_e( 'New!', 'pen-extra-features' );
									?>
							</span>
									<?php
								} elseif ( $recommended && ! $installed ) {
									?>
							<span class="pen_plugin_label_recommended">
									<?php
									esc_html_e( 'Recommended', 'pen-extra-features' );
									?>
							</span>
									<?php
								}
							} else {
								?>
							<span class="pen_plugin_label_special">
								<?php
								esc_html_e( 'Special Offer!', 'pen-extra-features' );
								?>
							</span>
								<?php
							}

							if ( ! empty( $addon['description'] ) ) {
								?>
							<p>
								<?php
								echo wp_kses( $addon['description'], wp_kses_allowed_html( 'post' ) );
								?>
							</p>
								<?php
							}

							if ( ! empty( $addon['features'] ) ) {
								?>
							<ul class="pen_plugin_addon_features">
								<?php
								foreach ( $addon['features'] as $feature ) {
									?>
								<li>
									<?php
									echo esc_html( $feature );
									?>
								</li>
									<?php
								}
								?>
							</ul>
								<?php
							}
							?>
							<p>
								<strong>
							<?php
							echo esc_html(
								sprintf(
									/* Translators: Just some word. */
									__( '%s:', 'pen-extra-features' ),
									__( 'Price', 'pen-extra-features' )
								)
							);
							?>
								</strong>
								<span class="pen_plugin_price">
							<?php
							echo esc_html( $addon['price'] );
							?>
								</span>
							<?php
							if ( ! $special_price && ! empty( $addon['price_suffix'] ) ) {
								?>
								<span class="pen_plugin_price_suffix">
								<?php
								echo esc_html( $addon['price_suffix'] );
								?>
								</span>
								<?php
							}
							if ( $special_price ) {
								?>
								<br>
								<strong>
								<?php
								echo esc_html(
									sprintf(
										/* Translators: Just some word. */
										__( '%s:', 'pen-extra-features' ),
										__( 'Special Price', 'pen-extra-features' )
									)
								);
								?>
								</strong>
								<span class="pen_plugin_price_special">
								<?php
								echo esc_html( $addon['special_offer']['price'] );
								?>
								</span>
								<?php
								if ( ! empty( $addon['price_suffix'] ) ) {
									?>
								<span class="pen_plugin_price_suffix">
									<?php
									echo esc_html( $addon['price_suffix'] );
									?>
								</span>
									<?php
								}
								if ( ! empty( $addon['special_offer']['end'] ) ) {
									?>
								<br>
								<span class="pen_plugin_special_end">
									<?php
									echo esc_html(
										sprintf(
											/* Translators: %s is a date. */
											__( 'This offer ends on %s (no extension)', 'pen-extra-features' ),
											$addon['special_offer']['end']
										)
									);
									?>
								</span>
									<?php
								}
							}
							?>
							</p>

							<p>
							<?php
							if ( ! empty( $addon['url_preview'] ) ) {
								?>
								<a href="<?php echo esc_url( $addon['url_preview'] ); ?>" class="button-primary pen_plugin_button_preview" title="<?php esc_attr_e( 'Opens a new window', 'pen-extra-features' ); ?>" target="_blank">
								<?php
								esc_html_e( 'Live Preview', 'pen-extra-features' );
								?>
								</a>
								<?php
							}

							if ( ! empty( $addon['url_purchase'] ) ) {
								?>
								<a href="<?php echo esc_url( $addon['url_purchase'] ); ?>" class="button-primary pen_plugin_button_purchase" title="<?php esc_attr_e( 'Opens a new window', 'pen-extra-features' ); ?>" target="_blank">
								<?php
								esc_html_e( 'Order Now', 'pen-extra-features' );
								?>
								</a>
								<?php
							}
							?>
							</p>

						</div>
					</div>
							<?php
						}
					}
					?>
				</div>

				<p>
					<strong>
				<?php
				esc_html_e( 'You are more than welcome to contact us if you have any questions regarding these offers, thanks.', 'pen-extra-features' );
				?>
					</strong>
				</p>

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
