<?php
/**
 * "Pen" WordPress plug-in.
 *
 * Postmeta Import.
 *
 * @link       https://www.htmlpie.com/products/pen-multipurpose-wordpress-theme/
 * @since      Pen Extra Features 1.0.0
 *
 * @package    Pen Extra Features
 * @subpackage Pen Extra Features/backend/partials
 */

// Prevents direct access.
defined( 'ABSPATH' ) || die();

if ( ! function_exists( 'pen_plugin_postmeta_tools' ) ) {
	/**
	 * Generates a list of posts with custom configurations
	 * and allows user to import them to the post that is being edited or added.
	 *
	 * @param int $content_id The current post ID.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return void
	 */
	function pen_plugin_postmeta_tools( $content_id ) {
		// PHP5.
		$content_id = (int) $content_id;
		?>
		<div id="pen_meta_tools">

			<fieldset>

				<legend title="<?php esc_attr_e( 'This section is a part of the Pen plugin.', 'pen-extra-features' ); ?>">
		<?php
		esc_html_e( 'Pen Plugin', 'pen-extra-features' );
		?>
				</legend>

				<label for="pen_meta_name">
		<?php
		echo esc_html(
			sprintf(
				/* Translators: Just some words. */
				__( '%s:', 'pen-extra-features' ),
				__( 'Administrative Title', 'pen-extra-features' )
			)
		);
		$meta_name = get_post_meta( $content_id, 'pen_meta_name', true );
		?>
				</label>
				<input type="text" name="pen_meta_name" id="pen_meta_name" size="30" value="<?php echo esc_attr( $meta_name ); ?>" placeholder="<?php esc_attr_e( 'e.g. Wide Layout', 'pen-extra-features' ); ?>" />
				<p>
		<?php
		esc_attr_e( 'You can set a distinct title for this set of customization so you can easily find it everywhere.', 'pen-extra-features' );
		?>
				</p>

				<hr>

				<a href="<?php echo esc_url( self_admin_url( 'admin.php?page=pen-extra-features-overview' ) ); ?>" class="button" id="pen_meta_tool_overview" target="_blank">
		<?php
		esc_html_e( 'Overview', 'pen-extra-features' );
		?>
				</a>
				<a href="#" class="button pen_meta_tool_open" id="pen_meta_tool_import" title="<?php esc_attr_e( 'You can import options from your other posts or pages.', 'pen-extra-features' ); ?>">
		<?php
		esc_html_e( 'Import', 'pen-extra-features' );
		?>
				</a>
				<div id="pen_meta_import" class="pen_meta_tool">
					<p>
		<?php
		esc_html_e( 'You can import your customization from your other posts or pages to the current one.', 'pen-extra-features' );
		?>
					</p>
					<a href="#" class="button pen_meta_tool_close">
						<span class="screen-reader-text">
		<?php
		esc_html_e( 'Close', 'pen-extra-features' );
		?>
						</span>
					</a>
					<label for="pen_posts">
		<?php
		echo esc_html(
			sprintf(
				/* Translators: Just some words. */
				__( '%s:', 'pen-extra-features' ),
				__( 'Select the source', 'pen-extra-features' )
			)
		);
		?>
					</label>
					<select id="pen_posts">
						<option value="">
		<?php
		esc_html_e( 'Select a content', 'pen-extra-features' );
		?>
						</option>
		<?php
		/* phpcs:disable */
		$wpb_all_query = new WP_Query( array(
			'post_type'      => array( 'post', 'page', 'product' ),
			'posts_per_page' => -1,
			'orderby'        => 'ID',
			'order'          => 'DESC'
		) );
		/* phpcs:enable */
		if ( $wpb_all_query->have_posts() ) {
			$options = array();
			while ( $wpb_all_query->have_posts() ) {
				$wpb_all_query->the_post();
				$current_post_id = (int) get_the_ID();
				if ( $current_post_id === $content_id ) {
					continue;
				}
				$title_full = trim( get_the_title() );
				$title      = trim( substr( $title_full, 0, 70 ) );
				/* phpcs:disable */
				if ( $title !== $title_full ) {
				/* phpcs:enable */
					$title .= '...';
				}
				$meta_name = get_post_meta( $current_post_id, 'pen_meta_name', true );

				$index = '';
				if ( ! $meta_name ) {
					$index = '_';
				}
				$index .= strtotime( get_the_date( 'Y-m-d H:i:s' ) ) . '_';
				if ( $meta_name ) {
					$index .= substr( $meta_name, 0, 1 ) . '_';
				} else {
					$index .= substr( $title, 0, 1 );
				}

				$options[ $index ] = array(
					'content_id' => $current_post_id,
					'html'       => sprintf(
						'%1$s%2$s - %3$s - %4$s',
						$meta_name ? sprintf( '[ %1$s ] - ', $meta_name ) : '',
						$current_post_id,
						$title,
						get_the_date( 'F d, Y' )
					),
				);
			}
			wp_reset_postdata();

			ksort( $options );

			foreach ( $options as $key => $option ) {
				?>
						<option value="<?php echo $option['content_id']; /* phpcs:ignore */ ?>">
				<?php
				echo esc_html( $option['html'] );
				?>
						</option>
				<?php
			}

			wp_nonce_field( 'pen_ajax_nonce', 'pen_nonce' );
		}
		?>
					</select>
				</div>
			</fieldset>
		</div>
		<?php
	}
}
