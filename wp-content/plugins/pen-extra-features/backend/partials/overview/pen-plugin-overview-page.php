<?php
/**
 * "Pen" WordPress plug-in.
 *
 *  Content Customization Overview page.
 *
 * @link       https://www.htmlpie.com/products/pen-multipurpose-wordpress-theme/
 * @since      Pen Extra Features 1.0.0
 *
 * @package    Pen Extra Features
 * @subpackage Pen Extra Features/backend/partials
 */

// Prevents direct access.
defined( 'ABSPATH' ) || die();

if ( ! function_exists( 'pen_plugin_overview_page' ) ) {
	/**
	 * Generates a list of posts & pages with custom configurations.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return void
	 */
	function pen_plugin_overview_page() {
		?>
	<div class="wrap">
		<?php
		if ( ! function_exists( 'pen_overview_page_title' ) ) {
			require PEN_PLUGIN_DIR . 'backend/partials/overview/pen-plugin-overview-page-title.php';
		}
		pen_plugin_overview_page_title();
		?>
		<div id="hp_admin">
			<div class="pen_plugin_page_overview hp_no_js">
		<?php
		if ( ! function_exists( 'pen_plugin_backend_warnings' ) ) {
			require PEN_PLUGIN_DIR . 'backend/partials/common/pen-plugin-warnings.php';
		}
		pen_plugin_backend_warnings();

		if ( PEN_PLUGIN_HAS_THEME ) {

			if ( ! function_exists( 'pen_plugin_postmeta_overview' ) ) {
				require PEN_PLUGIN_DIR . 'backend/partials/postmeta/pen-plugin-postmeta-overview.php';
			}

			$wpb_all_query = new WP_Query(
				array(
					'post_type'      => array( 'post', 'page', 'product' ),
					'posts_per_page' => -1,
				)
			);
			if ( $wpb_all_query->have_posts() ) {
				ob_start();
				while ( $wpb_all_query->have_posts() ) {
					$wpb_all_query->the_post();
					$content_id = get_the_ID();
					$overview   = pen_plugin_postmeta_overview( $content_id, false );
					if ( $overview ) {
						?>
				<tr>
					<td>
						<a href="<?php the_permalink(); ?>" target="_blank">
						<?php
						echo esc_html( $content_id );
						?>
						</a>
					</td>
					<td>
						<a href="<?php the_permalink(); ?>" target="_blank">
						<?php
						the_title();
						?>
						</a>
					</td>
					<td>
						<?php
						$administrative_title = get_post_meta( $content_id, 'pen_meta_name', true );
						if ( $administrative_title ) {
							echo esc_html( $administrative_title );
						} else {
							esc_html_e( 'N/A', 'pen-extra-features' );
						}
						?>
					</td>
					<td>
						<a href="<?php echo esc_url( get_edit_post_link( get_the_ID() ) ); ?>" class="button">
						<?php
						esc_html_e( 'Edit', 'pen-extra-features' );
						?>
						</a>
					</td>
				</tr>
						<?php
					}
					unset( $count );
				}
				wp_reset_postdata();

				$posts = wp_kses( ob_get_clean(), wp_kses_allowed_html( 'post' ) );
				if ( $posts ) {
					?>
				<p>
					<?php
					esc_html_e( 'The following contents have custom configurations. You can click the Edit button to check their current configuration - It is under the "Pen Options" section on the Post Edit screen.', 'pen-extra-features' );
					?>
					<br>
					<?php
					esc_html_e( 'You can also copy those custom configurations from one post to another by clicking the "Import" button there.', 'pen-extra-features' );
					?>
				</p>
				<table class="wp-list-table striped widefat" id="pen_table_overview">
					<thead>
						<tr>
							<th scope="col">
					<?php
					esc_html_e( 'ID', 'pen-extra-features' );
					?>
							</th>
							<th scope="col">
					<?php
					esc_html_e( 'Title', 'pen-extra-features' );
					?>
							</th>
							<th scope="col">
					<?php
					esc_html_e( 'Customization Name', 'pen-extra-features' );
					?>
							</th>
							<th scope="col">
					<?php
					esc_html_e( 'Actions', 'pen-extra-features' );
					?>
							</th>
						</tr>
					</thead>
					<tbody>
					<?php
					echo $posts; /* phpcs:ignore */
					?>
					</tbody>
				</table>
					<?php
				} else {
					?>
				<div id="message" class="updated">
					<p>
					<?php
					esc_html_e( 'All your contents appear to be using the default configuration.', 'pen-extra-features' );
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
