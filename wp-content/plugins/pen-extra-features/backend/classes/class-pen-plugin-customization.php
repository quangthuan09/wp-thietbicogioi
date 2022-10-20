<?php
/**
 * "Pen" WordPress plug-in.
 *
 * Customization import\export.
 *
 * @link       https://www.htmlpie.com/products/pen-multipurpose-wordpress-theme/
 * @since      Pen Extra Features 1.0.0
 *
 * @package    Pen Extra Features
 * @subpackage Pen Extra Features/backend/classes
 */

// Prevents direct access.
defined( 'ABSPATH' ) || die();

/**
 * Customization import\export class.
 *
 * @since      Pen Extra Features 1.0.0
 *
 * @package    Pen Extra Features
 * @subpackage Pen Extra Features/backend/classes
 * @author     HTMLPIE.COM
 */
class Pen_Plugin_Customization {

	/**
	 * Customization download.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return void
	 */
	public static function download() {
		if ( filter_input( INPUT_GET, 'pen_configuration_download' ) ) {
			$filename = sanitize_file_name(
				strtolower(
					esc_html(
						sprintf(
							'%s_pen_theme_configuration_%s.txt',
							get_bloginfo( 'name' ),
							gmdate( 'M_d_Y' )
						)
					)
				)
			);
			// Adds necessary headers to the download.
			header( 'Expires: 0' );
			header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
			header( 'Content-Description: File Transfer' );
			header( 'Content-Type: text/plain' );
			header( 'Content-Disposition: attachment; filename="' . $filename . '"' );
			echo self::export(); /* phpcs:ignore */
			exit;
		}
	}

	/**
	 * Exports the "Theme Customizer" configuration.
	 *
	 * @param string $data   Configuration backup.
	 * @param string $action Type of request, can be 'preview' to just preview before importing or 'import'.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return mixed
	 */
	public static function import( $data, $action ) {
		if ( ! function_exists( 'pen_configuration' ) ) {
			return;
		}

		$data = json_decode( $data, true );
		if ( ! is_array( $data ) ) {
			return false;
		}

		$configuration = pen_configuration();
		$import        = array();
		foreach ( $data as $option => $value ) {
			if ( isset( $configuration[ $option ] ) ) {
				$add = pen_option_sanitize( $option, $value );
				if ( is_null( $add ) ) {
					$add = pen_option_get( $option );
				}
				$import[ $option ] = $add;
			}
		}
		if ( 'preview' === $action ) {
			return $import;
		}
		if ( 'import' === $action ) {
			foreach ( $import as $option => $value ) {
				$preset  = pen_preset_get( $option );
				$new     = array( $preset => $value );
				$current = get_theme_mod( $option, pen_option_default( $option ) );
				if ( is_array( $current ) ) {
					$new = array_merge( $new, $current );
				}
				set_theme_mod( $option, $new );
			}
			return true;
		}
		return null;
	}

	/**
	 * Exports the "Theme Customizer" configuration.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return string
	 */
	public static function export() {
		if ( ! PEN_PLUGIN_HAS_THEME ) {
			return;
		}
		$configuration = pen_configuration();
		unset( $configuration['pen_preset_color'] );
		unset( $configuration['pen_preset_font'] );
		unset( $configuration['pen_disable_googlefonts'] );
		$theme  = wp_get_theme();
		$export = array(
			'theme_name'    => esc_html( $theme->get( 'Name' ) ),
			'theme_version' => esc_html( $theme->get( 'Version' ) ),
		);
		foreach ( $configuration as $option => $value ) {
			$export[ $option ] = pen_option_get( $option );
		}
		return wp_json_encode( $export );
	}

}
