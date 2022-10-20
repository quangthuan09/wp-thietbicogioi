<?php
/**
 * "Pen" WordPress plug-in.
 *
 * Customization Export page.
 *
 * @link       https://www.htmlpie.com/products/pen-multipurpose-wordpress-theme/
 * @since      Pen Extra Features 1.0.0
 *
 * @package    Pen Extra Features
 * @subpackage Pen Extra Features/backend/partials
 */

// Prevents direct access.
defined( 'ABSPATH' ) || die();

if ( ! function_exists( 'pen_plugin_export_page' ) ) {
	/**
	 * The "Customization export" page.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return void
	 */
	function pen_plugin_export_page() {
		?>
	<div class="wrap">
		<?php
		if ( ! function_exists( 'pen_plugin_export_page_title' ) ) {
			require PEN_PLUGIN_DIR . 'backend/partials/export/pen-plugin-export-page-title.php';
		}
		pen_plugin_export_page_title();
		?>
		<div id="hp_admin">
			<div class="pen_plugin_page_export hp_no_js">
		<?php
		if ( ! function_exists( 'pen_plugin_backend_warnings' ) ) {
			require PEN_PLUGIN_DIR . 'backend/partials/common/pen-plugin-warnings.php';
		}
		pen_plugin_backend_warnings();

		if ( PEN_PLUGIN_HAS_THEME ) {

			if ( ! class_exists( 'Pen_Plugin_Customization' ) ) {
				require PEN_PLUGIN_DIR . 'backend/classes/class-pen-plugin-import.php';
			}
			$export = Pen_Plugin_Customization::export();
			if ( ! $export ) {
				?>
				<p>
				<?php
				esc_html__( 'There is nothing to export.', 'pen-extra-features' );
				?>
				</p>
				<?php
			} else {
				?>
				<p>
				<?php
				esc_html_e( 'Here are the customization for the "Pen" theme that you have made through the "Pen" sections of the Customize interface (Appearance &rarr; Customize).', 'pen-extra-features' );
				?>
					<br>
				<?php
				esc_html_e( 'You can copy this code and import it to another website with the same theme in order to have your customization applied to that website too, or you can save this code as a text file (.txt) as a backup.', 'pen-extra-features' );
				?>
				</p>

				<div class="pen_customization_export_code">
				<?php
				echo esc_html( $export );
				?>
				</div>

				<p>
				<?php
				esc_html_e( 'Please note, the following code does not cover all your customization in the theme customizer such as "Additional CSS" or any other thing from the WordPress core or plugins. The following code only covers those customization which belong to the "Pen" theme. If you need to create backups we recommend you to use a backup plugin to create complete site backups.', 'pen-extra-features' );
				?>
				</p>
				<p>
					<strong>
				<?php
				esc_html_e( 'If you have any unsaved customization right now in the Customize section you should save them first and then refresh this page.', 'pen-extra-features' );
				?>
					</strong>
				</p>

				<?php
				if ( 'preview_export' === filter_input( INPUT_GET, 'pen_page' ) ) {
					?>
				<hr>

				<h3>
					<?php
					esc_html_e( 'Preview', 'pen-extra-features' );
					?>
				</h3>
				<p>
					<?php
					esc_html_e( 'Here is a summary of the above data.', 'pen-extra-features' );
					?>
				</p>
					<?php
					$preview = Pen_Plugin_Customization::import( $export, 'preview' );
					if ( $preview ) {
						if ( ! function_exists( 'pen_plugin_preview_import' ) ) {
							require PEN_PLUGIN_DIR . 'backend/partials/common/pen-plugin-preview-import.php';
						}
						echo pen_plugin_preview_import( $preview ); /* phpcs:ignore */
					} else {
						?>
				<strong>
						<?php
						esc_html_e( 'Cannot retrieve the theme configuration.', 'pen-extra-features' );
						?>
				</strong>
						<?php
					}
					?>
				<p>
					<a href="<?php echo esc_url( self_admin_url( 'admin.php?page=pen-extra-features&pen_configuration_download=1' ) ); ?>" class="button-primary">
					<?php
					esc_html_e( 'Download', 'pen-extra-features' );
					?>
					</a>
				</p>
					<?php
				} else {
					?>
				<p>
					<a href="<?php echo esc_url( self_admin_url( 'admin.php?page=pen-extra-features-export&pen_page=preview_export' ) ); ?>" class="button">
					<?php
					esc_html_e( 'Preview', 'pen-extra-features' );
					?>
					</a>&nbsp;
					<a href="<?php echo esc_url( self_admin_url( 'admin.php?page=pen-extra-features-export&pen_configuration_download=1' ) ); ?>" class="button-primary">
					<?php
					esc_html_e( 'Download', 'pen-extra-features' );
					?>
					</a>
				</p>
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
