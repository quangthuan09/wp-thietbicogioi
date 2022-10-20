<?php
/**
 * "Pen" WordPress plug-in.
 *
 * Content customization overview.
 *
 * @link       https://www.htmlpie.com/products/pen-multipurpose-wordpress-theme/
 * @since      Pen Extra Features 1.0.0
 *
 * @package    Pen Extra Features
 * @subpackage Pen Extra Features/backend/partials
 */

// Prevents direct access.
defined( 'ABSPATH' ) || die();

if ( ! function_exists( 'pen_plugin_postmeta_overview' ) ) {
	/**
	 * Displays an overview of the postmeta settings.
	 *
	 * @param int  $content_id       Content ID.
	 * @param bool $include_controls Whether to include form controls.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return string
	 */
	function pen_plugin_postmeta_overview( $content_id, $include_controls = true ) {
		if ( ! PEN_PLUGIN_HAS_THEME ) {
			return;
		}
		$post_type = get_post_type();
		if ( 'page' === $post_type && ! current_user_can( 'edit_pages' ) ) {
			return;
		}
		if ( 'post' === $post_type && ! current_user_can( 'edit_posts' ) ) {
			return;
		}
		if ( 'product' === $post_type && ! current_user_can( 'edit_products' ) ) {
			return;
		}

		ob_start();
		$overview_list     = array();
		$overview_content  = array();
		$overview_sidebars = array();

		$options_list = pen_post_meta_options( 'list' );

		foreach ( $options_list as $option => $label ) {
			$value = get_post_meta( $content_id, $option, true );
			if ( $value && 'default' !== $value ) {
				$overview_list[ $option ] = array(
					'status' => ( 'no' === $value ) ? 'disabled' : 'enabled',
					'id'     => $option,
					'label'  => $label,
					'value'  => $value,
				);
			}
		}

		$options_content = pen_post_meta_options( 'content' );

		foreach ( $options_content as $option => $label ) {
			$value = get_post_meta( $content_id, $option, true );
			if ( $value && 'default' !== $value ) {
				$overview_content[ $option ] = array(
					'status' => ( 'no' === $value ) ? 'disabled' : 'enabled',
					'id'     => $option,
					'label'  => $label,
					'value'  => $value,
				);
			}
		}

		$options_sidebars = pen_post_meta_options( 'sidebar' );

		foreach ( $options_sidebars as $sidebar => $label ) {
			if ( get_post_meta( $content_id, $sidebar, true ) ) {
				$overview_sidebars[ $sidebar ] = array(
					'status' => 'disabled',
					'id'     => $sidebar,
					'label'  => sprintf(
						/* Translators: Sidebar name. */
						__( 'Sidebar %s', 'pen-extra-features' ),
						ucfirst( str_replace( array( 'pen_sidebar_', '_display', '_' ), array( '', '', ' ' ), $sidebar ) )
					),
					'value'  => __( 'Hidden', 'pen-extra-features' ),
				);
			}
		}
		if ( empty( $overview_list ) && empty( $overview_content ) && empty( $overview_sidebars ) ) {
			ob_end_clean();
			return;
		}
		?>
		<div class="pen_options_overview" id="pen_post_overview_<?php echo esc_attr( $content_id ); ?>">
			<table>
		<?php
		if ( $overview_content || $overview_sidebars ) {
			?>
				<tr>
			<?php
			if ( $include_controls ) {
				?>
					<th>
						<input type="checkbox" name="pen_apply_content_all" id="pen_apply_content_all" value="1" />
					</th>
				<?php
			}
			?>
					<th scope="col" colspan="3">
			<?php
			esc_html_e( 'Full Content View', 'pen-extra-features' );
			?>
					</th>
				</tr>
			<?php
			foreach ( $overview_content as $item ) {
				?>
				<tr class="pen_option_<?php echo esc_attr( $item['status'] ); ?>">
					<td class="pen_apply_content">
						<input type="checkbox" name="apply_<?php echo esc_attr( $item['id'] ); ?>" id="apply_<?php echo esc_attr( $item['id'] ); ?>" value="<?php echo esc_attr( $item['value'] ); ?>" />
					</td>
				<?php
				$value = $item['value'];
				if ( '#000000' === $value ) {
					$value = __( 'Dark', 'pen-extra-features' );
				} elseif ( '#ffffff' === $value ) {
					$value = __( 'Light', 'pen-extra-features' );
				}
				?>
					<td class="pen_overview_item">
				<?php
				echo esc_html( $item['label'] );
				?>
					</td>
					<td class="pen_overview_value">
				<?php
				echo esc_html( $value );
				?>
					</td>
					<td>
						<a href="#" class="button pen_apply_this">
				<?php
				esc_html_e( 'Apply', 'pen-extra-features' );
				?>
						</a>
					</td>
				</tr>
				<?php
			}
		}

		foreach ( $overview_sidebars as $item ) {
			?>
				<tr class="pen_option_<?php echo esc_attr( $item['status'] ); ?>">
					<td class="pen_apply_content pen_apply_sidebar">
						<input type="checkbox" name="apply_<?php echo esc_attr( $item['id'] ); ?>" id="apply_<?php echo esc_attr( $item['id'] ); ?>" value="1" />
					</td>
					<td class="pen_overview_item">
			<?php
			echo esc_html( $item['label'] );
			?>
					</td>
					<td class="pen_overview_value">
			<?php
			echo esc_html( $item['value'] );
			?>
					</td>
			<?php
			if ( $include_controls ) {
				?>
					<td>
						<a href="#" class="button pen_apply_this">
				<?php
				esc_html_e( 'Apply', 'pen-extra-features' );
				?>
						</a>
					</td>
				<?php
			}
			?>
				</tr>
			<?php
		}

		if ( ! empty( $overview_list ) ) {
			?>
				<tr>
			<?php
			if ( $include_controls ) {
				?>
					<th>
						<input type="checkbox" name="pen_apply_list_all" id="pen_apply_list_all" value="1" />
					</th>
				<?php
			}
			?>
					<th scope="col" colspan="3">
			<?php
			echo esc_html_e( 'List Views', 'pen-extra-features' );
			?>
					</th>
				</tr>
			<?php
			foreach ( $overview_list as $item ) {
				?>
				<tr class="pen_option_<?php echo esc_attr( $item['status'] ); ?>">
					<td class="pen_apply_list">
						<input type="checkbox" name="apply_<?php echo esc_attr( $item['id'] ); ?>" id="apply_<?php echo esc_attr( $item['id'] ); ?>" value="<?php echo esc_attr( $item['value'] ); ?>" />
					</td>
				<?php
				$value = $item['value'];
				if ( '#000000' === $value ) {
					$value = __( 'Dark', 'pen-extra-features' );
				} elseif ( '#ffffff' === $value ) {
					$value = __( 'Light', 'pen-extra-features' );
				}
				?>
					<td class="pen_overview_item">
				<?php
				echo esc_html( $item['label'] );
				?>
					</td>
					<td class="pen_overview_value">
				<?php
				echo esc_html( $value );
				?>
					</td>
				<?php
				if ( $include_controls ) {
					?>
					<td>
						<a href="#" class="button pen_apply_this">
					<?php
					esc_html_e( 'Apply', 'pen-extra-features' );
					?>
						</a>
					</td>
					<?php
				}
				?>
				</tr>
				<?php
			}
		}
		?>
			</table>
		<?php
		if ( $include_controls ) {
			?>
			<p>
				<a href="#" class="button" id="pen_apply_all">
			<?php
			esc_html_e( 'Apply Selected', 'pen-extra-features' );
			?>
				</a>
				<a href="#" class="button" id="pen_select_all">
			<?php
			esc_html_e( 'Select All', 'pen-extra-features' );
			?>
				</a>
			</p>
			<?php
		}
		?>
		</div>
		<?php
		return ob_get_clean();
	}
}
