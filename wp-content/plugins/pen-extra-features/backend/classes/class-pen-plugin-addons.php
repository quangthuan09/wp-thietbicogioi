<?php
/**
 * "Pen" WordPress plug-in.
 *
 * Addons.
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
 * Addons class.
 *
 * @since      Pen Extra Features 1.0.0
 *
 * @package    Pen Extra Features
 * @subpackage Pen Extra Features/backend/classes
 * @author     HTMLPIE.COM
 */
class Pen_Plugin_Addons {

	/**
	 * Prepares a list of available addons.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return array
	 */
	public static function items() {

		$offers = array(
			'HPCF'     => array(
				'type'          => 'plugin',
				'slug'          => 'contact-form',
				'title'         => __( 'Advanced Contact Form Plugin', 'pen-extra-features' ),
				'description'   => __( 'Do you need a contact form for your site?', 'pen-extra-features' ),
				'features'      => array(
					__( 'Ready-made CSS3 Styles Included', 'pen-extra-features' ),
					__( 'Image, Riddle, and Hidden CAPTCHA', 'pen-extra-features' ),
					__( 'Multilingual Forms & E-mails', 'pen-extra-features' ),
					__( 'GDPR-compliant', 'pen-extra-features' ),
					__( 'SMTP, CC, and BCC', 'pen-extra-features' ),
					__( 'File Attachments', 'pen-extra-features' ),
					__( 'E-mail Blacklist', 'pen-extra-features' ),
					__( 'Free Long-term Support', 'pen-extra-features' ),
				),
				'price'         => '$29',
				'price_suffix'  => sprintf( '(%s)', __( 'VAT incl.', 'pen-extra-features' ) ),
				'icon'          => PEN_PLUGIN_URL . '/backend/assets/img/hpcf_128x128.png',
				'url_preview'   => 'https://www.htmlpie.com/preview/wordpress-contact-form-plugin/',
				'url_purchase'  => 'https://www.htmlpie.com/wordpress-contact-form-plugin',
				'version'       => '1.3.2',
				'last_update'   => '2020-08-15',
				'rating'        => array( '5', '4.8/5 based on 20 reviews' ),
				'new'           => true,
				'recommended'   => array(),
				'special_offer' => '',
			),
			'DM'       => array(
				'type'          => 'theme',
				'slug'          => 'domain',
				'title'         => __( 'Domain Theme', 'pen-extra-features' ),
				'description'   => __( 'Do you have some domain names for sale?', 'pen-extra-features' ),
				'features'      => array(
					sprintf(
						/* Translators: Theme name. */
						__( 'All the features of the %s theme', 'pen-extra-features' ),
						__( 'Pen', 'pen-extra-features' )
					),
					sprintf(
						/* Translators: Service name. */
						__( '%s Integration', 'pen-extra-features' ),
						esc_html( 'Escrow.com' )
					),
					sprintf(
						/* Translators: Price. */
						__( '%s Worth of Plugins!', 'pen-extra-features' ),
						esc_html( '$70' )
					),
					__( 'Advanced Contact Form Plugin', 'pen-extra-features' ),
					__( 'This Domain Is For Sale Plugin', 'pen-extra-features' ),
					__( 'Unlimited Landing Pages', 'pen-extra-features' ),
					__( 'Free Long-term Support', 'pen-extra-features' ),

				),
				'price'         => '$59',
				'price_suffix'  => sprintf( '(%s)', __( 'VAT incl.', 'pen-extra-features' ) ),
				'icon'          => PEN_PLUGIN_URL . '/backend/assets/img/dm_128x128.png',
				'url_preview'   => 'https://www.htmlpie.com/preview/domain-wordpress-theme/',
				'url_purchase'  => 'https://www.htmlpie.com/domain-for-sale-wordpress-theme',
				'version'       => '1.6.2',
				'last_update'   => '2020-02-01',
				'rating'        => array( '5', '5/5 based on 12 reviews' ),
				'new'           => true,
				'recommended'   => array(),
				'special_offer' => '',
			),
			'SERVICES' => array(
				'type'         => 'service',
				'slug'         => 'wordpress-services',
				'title'        => __( 'WordPress Optimization', 'pen-extra-features' ),
				'description'  => __( 'Optimize your website for Google, mobile users, and more...', 'pen-extra-features' ),
				'features'     => array(
					__( 'Search Engine Optimization', 'pen-extra-features' ),
					__( 'Speed Optimization', 'pen-extra-features' ),
					/* Translators: BCR is short for "Visitor-to-buyer conversion ratio". */
					__( 'BCR Optimization', 'pen-extra-features' ),
					__( 'User Experience Improvement', 'pen-extra-features' ),
					__( 'PWA Setup', 'pen-extra-features' ),
				),
				/* Translators: %s is a price, e.g. $50. */
				'price'        => sprintf( __( 'Starting at %s', 'pen-extra-features' ), '$59' ),
				'price_suffix' => sprintf( '(%s)', __( 'VAT incl.', 'pen-extra-features' ) ),
				'icon'         => PEN_PLUGIN_URL . '/backend/assets/img/services_128x128.png',
				'url_purchase' => 'https://www.htmlpie.com/services',
			),
		);

		return $offers;
	}

	/**
	 * Counts the number of new addons.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return int
	 */
	public static function count_new() {
		$count  = 0;
		$addons = self::items();
		if ( is_array( $addons ) ) {
			foreach ( $addons as $addon ) {
				if ( isset( $addon['new'] ) && $addon['new'] && ! self::is_installed( $addon['type'], $addon['slug'] ) ) {
					$count++;
				}
			}
		}
		return (int) $count;
	}

	/**
	 * Checks if an addon is installed already.
	 *
	 * @param string $type Type of the addon; plugin or theme.
	 * @param string $slug The slug of the addon.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return boolean
	 */
	public static function is_installed( $type, $slug ) {
		if ( 'theme' === $type ) {
			$theme = wp_get_theme( $slug );
			if ( $theme->exists() ) {
				return true;
			}
		} else {
			if ( 'plugin' === $type && ( is_plugin_active( $slug . '/' . $slug . '.php' ) || ( is_multisite() && is_network_only_plugin( $slug . '/' . $slug . '.php' ) ) ) ) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Checks if an addon is activate.
	 *
	 * @param string $type Type of the addon; plugin or theme.
	 * @param string $slug The slug of the addon.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return boolean
	 */
	public static function is_active( $type, $slug ) {
		if ( 'theme' === $type ) {
			if ( get_template() === $slug ) {
				return true;
			}
		} elseif ( 'plugin' === $type && ( is_plugin_active( $slug . '/' . $slug . '.php' ) || ( is_multisite() && is_network_only_plugin( $slug . '/' . $slug . '.php' ) ) ) ) {
			return true;
		}
		return false;
	}

}
