<?php
/**
 * "Pen" WordPress plug-in.
 *
 * Customization Import page.
 *
 * @link       https://www.htmlpie.com/products/pen-multipurpose-wordpress-theme/
 * @since      Pen Extra Features 1.0.0
 *
 * @package    Pen Extra Features
 * @subpackage Pen Extra Features/backend/partials
 */

// Prevents direct access.
defined( 'ABSPATH' ) || die();

if ( ! function_exists( 'pen_plugin_import_page' ) ) {
	/**
	 * The "Customization import" page.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return void
	 */
	function pen_plugin_import_page() {
		?>
	<div class="wrap">
		<?php
		if ( ! function_exists( 'pen_import_page_title' ) ) {
			require PEN_PLUGIN_DIR . 'backend/partials/import/pen-plugin-import-page-title.php';
		}
		pen_plugin_import_page_title();
		?>
		<div id="hp_admin">
			<div class="pen_plugin_page_import hp_no_js">
		<?php
		if ( ! function_exists( 'pen_plugin_backend_warnings' ) ) {
			require PEN_PLUGIN_DIR . 'backend/partials/common/pen-plugin-warnings.php';
		}
		pen_plugin_backend_warnings();

		if ( PEN_PLUGIN_HAS_THEME ) {

			$action = '';
			$nonce  = filter_input( INPUT_POST, 'pen_nonce' );
			if ( $nonce ) {
				if ( wp_verify_nonce( $nonce, 'pen_configuration_import' ) ) {
					if ( ! class_exists( 'Pen_Plugin_Customization' ) ) {
						require PEN_PLUGIN_DIR . 'backend/classes/class-pen-plugin-import.php';
					}
					$import = filter_input( INPUT_POST, 'pen_configuration_import' );
					if ( $import ) {
						$import_preview = Pen_Plugin_Customization::import( $import, 'preview' );
						$action         = 'import';
					} else {
						$confirmed = filter_input( INPUT_POST, 'pen_configuration_import_confirmed' );
						if ( $confirmed ) {
							if ( Pen_Plugin_Customization::import( $confirmed, 'import' ) ) {
								?>
						<div id="message" class="updated notice">
							<p>
								<?php
								esc_html_e( 'Import was attempted; please check your website and make sure that everything is fine.', 'pen-extra-features' );
								?>
							</p>
						</div>
								<?php
							} else {
								?>
						<div id="message" class="error notice">
							<p>
								<?php
								esc_html_e( 'Import was not successful; you can contact support about this.', 'pen-extra-features' );
								?>
							</p>
						</div>
								<?php
							}
						}
					}
				} else {
					?>
				<div class="error notice">
					<p>
					<?php
					esc_html_e( 'Import was unsuccessful.', 'pen-extra-features' );
					?>
					</p>
				</div>
					<?php
				}
			}

			$page = filter_input( INPUT_GET, 'page' );
			if ( 'import' !== $action ) {
				?>
				<p>
				<?php
				esc_html_e( 'Enter your theme customization code below.', 'pen-extra-features' );
				?>
				</p>
				<form method="post" id="pen_configuration">
					<input type="hidden" name="page" value="<?php echo $page ? esc_attr( $page ) : ''; /* phpcs:ignore */ ?>" />
					<textarea name="pen_configuration_import" id="pen_configuration_import" class="widefat" rows="20" cols="10"></textarea>
				<?php
				wp_nonce_field( 'pen_configuration_import', 'pen_nonce' );
				?>
					<p>
						<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Preview & Import', 'pen-extra-features' ); ?>" />
					</p>
				</form>
				<?php
			} elseif ( 'import' === $action ) {

				if ( $import_preview ) {
					?>
				<h2>
					<?php
					esc_html_e( 'Preview before import', 'pen-extra-features' );
					?>
				</h2>
				<p>
					<?php
					esc_html_e( 'Please make sure everything is correct and then click the "Import" button below.', 'pen-extra-features' );
					?>
				</p>
					<?php
					if ( ! function_exists( 'pen_plugin_preview_import' ) ) {
						require PEN_PLUGIN_DIR . 'backend/partials/common/pen-plugin-preview-import.php';
					}
					echo pen_plugin_preview_import( $import_preview ); /* phpcs:ignore */
					?>
				<form method="post" id="pen_configuration">
					<input type="hidden" name="page" value="<?php echo ( $page ) ? esc_attr( $page ) : ''; /* phpcs:ignore */ ?>" />
					<input type="hidden" name="pen_configuration_import_confirmed" value="<?php echo esc_attr( filter_input( INPUT_POST, 'pen_configuration_import' ) ); ?>" />
					<?php
					wp_nonce_field( 'pen_configuration_import', 'pen_nonce' );
					?>
					<p>
						<input type="submit" class="button-primary" value="<?php esc_attr_e( 'Import', 'pen-extra-features' ); ?>" />
						&nbsp;
						<a href="<?php echo esc_url( self_admin_url( 'admin.php?page=pen-extra-features-import' ) ); ?>">
					<?php
					esc_html_e( 'Cancel', 'pen-extra-features' );
					?>
						</a>
					</p>
					<p>
					<?php
					esc_html_e( 'This action is irreversible!', 'pen-extra-features' );
					?>
					</p>
				</form>
					<?php
				} else {
					?>
				<div id="message" class="error notice">
					<p>
					<?php
					esc_html_e( 'The input does not contain a valid backup of the theme configuration.', 'pen-extra-features' );
					?>
					</p>
				</div>
					<?php
				}
			}
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
