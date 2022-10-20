<?php
/**
 * "Pen" WordPress plug-in.
 *
 * Import\Export page.
 *
 * @link       https://www.htmlpie.com/products/pen-multipurpose-wordpress-theme/
 * @since      Pen Extra Features 1.0.0
 *
 * @package    Pen Extra Features
 * @subpackage Pen Extra Features/backend/partials
 */

// Prevents direct access.
defined( 'ABSPATH' ) || die();

if ( ! function_exists( 'pen_plugin_preview_import' ) ) {
	/**
	 * Generates a summary of theme customizations.
	 *
	 * @param string $data The data to preview.
	 *
	 * @since Pen Extra Features 1.0.0
	 */
	function pen_plugin_preview_import( $data ) {

		if ( ! PEN_PLUGIN_HAS_THEME ) {
			return;
		}

		ob_start();
		if ( is_array( $data ) && count( $data ) ) {
			$options = pen_configuration();
			?>
			<table class="wp-list-table striped widefat">
				<thead>
					<th scope="col">
			<?php
			esc_html_e( 'Setting', 'pen-extra-features' );
			?>
					</th>
					<th scope="col">
			<?php
			esc_html_e( 'Value', 'pen-extra-features' );
			?>
					</th>
				</thead>
				<tbody>
			<?php
			foreach ( $data as $id => $value ) {
				?>
					<tr>
						<td>
				<?php
				echo esc_html( $id );
				?>
						</td>
						<td>
				<?php
				if ( isset( $options[ $id ] ) ) {
					if ( 'pen_sanitize_color' === $options[ $id ]['sanitize'] ) {
						$value = '<span style="background:' . esc_html( $value ) . ';border:1px solid #000;float:left;height:1em;margin:0 1em 0 0;width:1em"></span>' . $value;
					} elseif ( 'pen_sanitize_boolean' === $options[ $id ]['sanitize'] ) {
						$value = $value ? esc_html__( 'Yes', 'pen-extra-features' ) : esc_html__( 'No', 'pen-extra-features' );
					}
				}
				if ( empty( $value ) || 'default' === $value ) {
					$value = esc_html__( 'N/A', 'pen-extra-features' );
				}
				echo ltrim( $value, 'g:' ); /* phpcs:ignore */
				?>
						</td>
					</tr>
				<?php
			}
			?>
				</tbody>
			</table>
			<?php
		}
		return wp_kses( ob_get_clean(), wp_kses_allowed_html( 'post' ) );
	}
}
