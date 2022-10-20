<?php
/**
 * Theme Customizer.
 *
 * @package Pen
 */

defined( 'ABSPATH' ) || die();

if ( ! function_exists( 'pen_customize_color' ) ) {
	/**
	 * Adds color options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param array                $variables    Common variables.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_customize_color( &$wp_customize, $variables ) {

		$preset = pen_preset_get( 'color' );

		$panel = 'pen_panel_colors';
		$wp_customize->add_panel(
			$panel,
			array(
				'title'    => __( 'Colors', 'pen' ),
				'priority' => 1,
			)
		);

		// Moves the default WP "Colors" section to this panel.
		$wp_customize->get_section( 'colors' )->title    = __( 'General', 'pen' );
		$wp_customize->get_section( 'colors' )->priority = 1;
		$wp_customize->get_section( 'colors' )->panel    = 'pen_colors';

		/**
		 * General.
		 */
		$section = 'pen_section_colors_general';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'General', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,background_image'   => __( 'Background Image', 'pen' ),
							'panel,content'              => __( 'General', 'pen' ),
							'section,typography_general' => __( 'Typography', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = 'pen_dark_mode[preset_1]';
		$label      = __( 'Dark Mode', 'pen' );
		$choices    = array(
			'none'        => __( 'Disable', 'pen' ),
			'web_browser' => __( 'Web browser', 'pen' ),
			'always'      => __( 'Always', 'pen' ),
			'clock'       => __( 'Clock', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = 'pen_dark_mode_allow_switch[preset_1]';
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Dark Mode', 'pen' ),
			__( 'Allow users to disable it', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = 'pen_dark_mode_switch_location[preset_1]';
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Dark Mode', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Button', 'pen' ),
				__( 'Location', 'pen' )
			)
		);
		$choices = array(
			'top'   => __( 'Top', 'pen' ),
			'left'  => __( 'Left', 'pen' ),
			'right' => __( 'Right', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'postMessage', $choices, $label );

		$setting_id = "pen_color_site_shadow_display[$preset]";
		$label      = __( 'Shadow', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_shadow[$preset]";
		$label      = __( 'Shadow', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_site_background[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Site', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_site_background_effect[$preset]";
		$label      = __( 'Site Background Effect', 'pen' );
		$choices    = array(
			'none'       => __( 'None', 'pen' ),
			'trianglify' => 'TrianglifyJS',
			'shards'     => 'jQuery Shards',
		);
		pen_control_radio( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_color_text[$preset]";
		$label      = __( 'Text', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_link[$preset]";
		$label      = __( 'Links', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_link_hover[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Links', 'pen' ),
			__( 'Hover', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_button_background_primary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Button', 'pen' ),
			__( 'Primary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_button_background_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Button', 'pen' ),
			__( 'Secondary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_button_background_angle[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Angle', 'pen' ),
			__( 'Button', 'pen' )
		);
		$choices = array(
			'to right'  => __( 'Horizontal', 'pen' ),
			'125deg'    => __( 'Diagonal', 'pen' ),
			'to bottom' => __( 'Vertical', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_color_button_text[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Button', 'pen' ),
			__( 'Text', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_button_border[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Button', 'pen' ),
			__( 'Border', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		/**
		 * Header.
		 */
		$section = 'pen_section_colors_header';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Header', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,animation_header'  => __( 'Animation', 'pen' ),
							'section,header_image'      => __( 'Background Image', 'pen' ),
							'section,header_general'    => __( 'General', 'pen' ),
							'section,title_tagline'     => sprintf(
								/* Translators: Just some words. */
								__( '%1$s & %2$s', 'pen' ),
								__( 'Logo', 'pen' ),
								__( 'Site Title', 'pen' )
							),
							'section,typography_header' => __( 'Typography', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_color_header_background_transparent[$preset]";
		$label      = __( 'Transparent Background', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_background_primary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Primary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_background_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Secondary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_background_angle[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Angle', 'pen' ),
			__( 'Header', 'pen' )
		);
		$choices = array(
			'to right'  => __( 'Horizontal', 'pen' ),
			'125deg'    => __( 'Diagonal', 'pen' ),
			'to bottom' => __( 'Vertical', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_color_header_text_shadow_display[$preset]";
		$label      = __( 'Text Shadow', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_text_shadow[$preset]";
		$label      = __( 'Text Shadow', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_sitetitle[$preset]";
		$label      = __( 'Site Title', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_sitetitle_hover[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Site Title', 'pen' ),
			__( 'Hover', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_sitedescription[$preset]";
		$label      = __( 'Site Description', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_sitedescription_hover[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Site Description', 'pen' ),
			__( 'Hover', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_phone[$preset]";
		$label      = __( 'Phone', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_phone_hover[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Phone', 'pen' ),
			__( 'Hover', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_link[$preset]";
		$label      = __( 'Links', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_link_hover[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Links', 'pen' ),
			__( 'Hover', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_text[$preset]";
		$label      = __( 'Text', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_field_background_primary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Form Field', 'pen' ),
			__( 'Primary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_field_background_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Form Field', 'pen' ),
			__( 'Secondary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_field_background_angle[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Angle', 'pen' ),
			__( 'Form Field', 'pen' )
		);
		$choices = array(
			'to right'  => __( 'Horizontal', 'pen' ),
			'125deg'    => __( 'Diagonal', 'pen' ),
			'to bottom' => __( 'Vertical', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_color_header_field_text[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Text', 'pen' ),
			__( 'Form Field', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_search_background_primary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Search Box', 'pen' ),
				__( 'Button', 'pen' )
			),
			__( 'Primary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_search_background_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Search Box', 'pen' ),
				__( 'Button', 'pen' )
			),
			__( 'Secondary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_search_background_angle[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Angle', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Search Box', 'pen' ),
				__( 'Button', 'pen' )
			)
		);
		$choices = array(
			'to right'  => __( 'Horizontal', 'pen' ),
			'125deg'    => __( 'Diagonal', 'pen' ),
			'to bottom' => __( 'Vertical', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_color_header_search_text[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Text', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Search Box', 'pen' ),
				__( 'Button', 'pen' )
			)
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_button_users_background_primary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Button', 'pen' ),
				sprintf(
					/* Translators: Just some words. */
					__( '%1$s/%2$s', 'pen' ),
					__( 'Login', 'pen' ),
					__( 'Register', 'pen' )
				)
			),
			__( 'Primary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_button_users_background_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Button', 'pen' ),
				sprintf(
					/* Translators: Just some words. */
					__( '%1$s/%2$s', 'pen' ),
					__( 'Login', 'pen' ),
					__( 'Register', 'pen' )
				)
			),
			__( 'Secondary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_header_button_users_background_angle[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Angle', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Button', 'pen' ),
				sprintf(
					/* Translators: Just some words. */
					__( '%1$s/%2$s', 'pen' ),
					__( 'Login', 'pen' ),
					__( 'Register', 'pen' )
				)
			)
		);
		$choices = array(
			'to right'  => __( 'Horizontal', 'pen' ),
			'125deg'    => __( 'Diagonal', 'pen' ),
			'to bottom' => __( 'Vertical', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_color_header_button_users_text[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Text', 'pen' ),
			sprintf(
				/* Translators: Just some words. */
				__( '%1$s/%2$s', 'pen' ),
				__( 'Login', 'pen' ),
				__( 'Register', 'pen' )
			)
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		/**
		 * Navigation colors.
		 */
		$section = 'pen_section_colors_navigation';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Navigation', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,animation_navigation' => __( 'Animation', 'pen' ),
							'section,background_image_navigation' => __( 'Background Image', 'pen' ),
							'section,header_navigation'    => __( 'General', 'pen' ),
							'panel,nav_menus'              => __( 'Menu', 'pen' ),
							'section,typography_navigation' => __( 'Typography', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_color_navigation_background_transparent[$preset]";
		$label      = __( 'Transparent Background', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_navigation_background_primary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Primary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_navigation_background_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Secondary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_navigation_background_angle[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Angle', 'pen' ),
			__( 'Main Menu', 'pen' )
		);
		$choices = array(
			'to right'  => __( 'Horizontal', 'pen' ),
			'125deg'    => __( 'Diagonal', 'pen' ),
			'to bottom' => __( 'Vertical', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_color_navigation_background_submenu_primary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Sub-menus', 'pen' ),
			__( 'Primary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_navigation_background_submenu_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Sub-menus', 'pen' ),
			__( 'Secondary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_navigation_background_submenu_angle[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Angle', 'pen' ),
			__( 'Sub-menus', 'pen' )
		);
		$choices = array(
			'to right'  => __( 'Horizontal', 'pen' ),
			'125deg'    => __( 'Diagonal', 'pen' ),
			'to bottom' => __( 'Vertical', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_color_navigation_text_shadow_display[$preset]";
		$label      = __( 'Text Shadow', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_navigation_text_shadow[$preset]";
		$label      = __( 'Text Shadow', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_navigation_link[$preset]";
		$label      = __( 'Links', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_navigation_link_hover[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Links', 'pen' ),
			__( 'Hover', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_navigation_link_submenu[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Sub-menus', 'pen' ),
			__( 'Links', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_navigation_link_hover_submenu[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Sub-menus', 'pen' ),
				__( 'Links', 'pen' )
			),
			__( 'Hover', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_navigation_text_shadow_display_submenu[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Text Shadow', 'pen' ),
			__( 'Sub-menus', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_navigation_text_shadow_submenu[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Text Shadow', 'pen' ),
			__( 'Sub-menus', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_button_navigation_mobile_background_primary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Mobile Menu', 'pen' ),
			__( 'Primary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_button_navigation_mobile_background_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Mobile Menu', 'pen' ),
			__( 'Secondary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_button_navigation_mobile_background_angle[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Angle', 'pen' ),
			__( 'Mobile Menu', 'pen' ),
			__( 'Button', 'pen' )
		);
		$choices = array(
			'to right'  => __( 'Horizontal', 'pen' ),
			'125deg'    => __( 'Diagonal', 'pen' ),
			'to bottom' => __( 'Vertical', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_color_button_navigation_mobile_text[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Text', 'pen' ),
			__( 'Mobile Menu', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		/**
		 * Search.
		 */
		$section = 'pen_section_colors_search';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Search Bar', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><hr><strong>%s</strong><br>%s<hr>',
					sprintf(
						'<a href="%s" class="pen_customizer_shortcut" data-type="%s" data-target="%s">%s</a>',
						esc_url(
							add_query_arg(
								array(
									'autofocus[section]' => 'pen_section_header_search',
								),
								$variables['url_customize']
							)
						),
						'section',
						'pen_section_header_search',
						__( 'Please make sure the Search Box Location is set to Content Area before making any changes here.', 'pen' )
					),
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,animation_search' => __( 'Animation', 'pen' ),
							'section,background_image_search' => __( 'Background Image', 'pen' ),
							'section,header_search'    => __( 'General', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_color_search_background_transparent[$preset]";
		$label      = __( 'Transparent Background', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_search_background_primary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Primary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_search_background_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Secondary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_search_background_angle[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Angle', 'pen' ),
			__( 'Search Box', 'pen' )
		);
		$choices = array(
			'to right'  => __( 'Horizontal', 'pen' ),
			'125deg'    => __( 'Diagonal', 'pen' ),
			'to bottom' => __( 'Vertical', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_color_search_field_background_primary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Search Box', 'pen' ),
			__( 'Primary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_search_field_background_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Search Box', 'pen' ),
			__( 'Secondary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_search_field_background_angle[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Angle', 'pen' ),
			__( 'Search Box', 'pen' )
		);
		$choices = array(
			'to right'  => __( 'Horizontal', 'pen' ),
			'125deg'    => __( 'Diagonal', 'pen' ),
			'to bottom' => __( 'Vertical', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_color_search_field_text[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Text', 'pen' ),
			__( 'Search Box', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_search_button_background_primary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Search Box', 'pen' ),
				__( 'Button', 'pen' )
			),
			__( 'Primary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_search_button_background_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Search Box', 'pen' ),
				__( 'Button', 'pen' )
			),
			__( 'Secondary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_search_button_background_angle[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Angle', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Search Box', 'pen' ),
				__( 'Button', 'pen' )
			)
		);
		$choices = array(
			'to right'  => __( 'Horizontal', 'pen' ),
			'125deg'    => __( 'Diagonal', 'pen' ),
			'to bottom' => __( 'Vertical', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_color_search_button_text[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Text', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Search Box', 'pen' ),
				__( 'Button', 'pen' )
			)
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_search_text[$preset]";
		$label      = __( 'Text', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_search_link[$preset]";
		$label      = __( 'Links', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_search_link_hover[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Links', 'pen' ),
			__( 'Hover', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_search_text_shadow_display[$preset]";
		$label      = __( 'Text Shadow', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_search_text_shadow[$preset]";
		$label      = __( 'Text Shadow', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		/**
		 * Content.
		 */
		$section = 'pen_section_colors_content';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Content', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,animation_content' => __( 'Animation', 'pen' ),
							'section,background_image_content_title' => __( 'Background Image', 'pen' ),
							'section,content'           => __( 'General', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_color_content_title_background_primary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Background', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Header', 'pen' )
			),
			__( 'Primary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_content_title_background_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Background', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Header', 'pen' )
			),
			__( 'Secondary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_content_title_background_angle[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Angle', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Header', 'pen' )
			)
		);
		$choices = array(
			'to right'  => __( 'Horizontal', 'pen' ),
			'125deg'    => __( 'Diagonal', 'pen' ),
			'to bottom' => __( 'Vertical', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_color_content_title_text[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Text', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Title', 'pen' )
			)
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_content_title_text_shadow_display[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Text Shadow', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Title', 'pen' )
			)
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_content_title_text_shadow[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Text Shadow', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Title', 'pen' )
			)
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_content_title_link[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Content', 'pen' ),
			__( 'Title', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_content_title_link_hover[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Title', 'pen' )
			),
			__( 'Hover', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_content_background_primary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Primary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_content_background_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Secondary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_content_background_angle[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Angle', 'pen' ),
			__( 'Content', 'pen' )
		);
		$choices = array(
			'to right'  => __( 'Horizontal', 'pen' ),
			'125deg'    => __( 'Diagonal', 'pen' ),
			'to bottom' => __( 'Vertical', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_color_content_footer_background_primary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Footer', 'pen' ),
			__( 'Primary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_content_footer_background_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Footer', 'pen' ),
			__( 'Secondary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_content_footer_background_angle[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Angle', 'pen' ),
			__( 'Footer', 'pen' )
		);
		$choices = array(
			'to right'  => __( 'Horizontal', 'pen' ),
			'125deg'    => __( 'Diagonal', 'pen' ),
			'to bottom' => __( 'Vertical', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id  = "pen_color_content_thumbnail_frame[$preset]";
		$label       = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Featured Image', 'pen' ),
			_x( 'Frame', 'As in photo or picture frame.', 'pen' )
		);
		$description = sprintf(
			/* Translators: 1: Setting name, 2: Link to that setting, e.g. Customize &rarr; Content. */
			__( 'Make sure the "%1$s" is enabled in %2$s', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Featured Image', 'pen' ),
				_x( 'Frame', 'As in photo or picture frame.', 'pen' )
			),
			sprintf(
				/* Translators: 1: Link to Customize section, 2: Link text. */
				'<a href="%1$s" class="pen_customizer_shortcut" data-type="section" data-target="pen_section_content">%2$s</a>',
				esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_content',
						),
						$variables['url_customize']
					)
				),
				sprintf(
					'%1$s &rarr; %2$s &rarr; %3$s',
					__( 'Customize', 'pen' ),
					__( 'Content', 'pen' ),
					__( 'Full Content View', 'pen' )
				)
			)
		);
		$choices = array(
			'#ffffff' => __( 'Light', 'pen' ),
			'#000000' => __( 'Dark', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label, $description );

		$setting_id = "pen_color_content_text[$preset]";
		$label      = __( 'Text', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_content_link[$preset]";
		$label      = __( 'Links', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_content_link_hover[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Links', 'pen' ),
			__( 'Hover', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_content_field_background_primary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Form Field', 'pen' ),
			__( 'Primary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_content_field_background_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Form Field', 'pen' ),
			__( 'Secondary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_content_field_background_angle[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Angle', 'pen' ),
			__( 'Form Field', 'pen' )
		);
		$choices = array(
			'to right'  => __( 'Horizontal', 'pen' ),
			'125deg'    => __( 'Diagonal', 'pen' ),
			'to bottom' => __( 'Vertical', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_color_content_field_text[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Text', 'pen' ),
			__( 'Form Field', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		/**
		 * Lists.
		 */
		$section = 'pen_section_colors_list';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'List View', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,animation_list' => __( 'Animation', 'pen' ),
							'section,list'           => __( 'General', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_color_list_thumbnail_frame[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Featured Image', 'pen' ),
				_x( 'Frame', 'As in photo or picture frame.', 'pen' )
			),
			__( 'Plain List', 'pen' )
		);
		$description = sprintf(
			/* Translators: 1: Setting name, 2: Link to that setting, e.g. Customize &rarr; Content. */
			__( 'Make sure the "%1$s" is enabled in %2$s', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Featured Image', 'pen' ),
				_x( 'Frame', 'As in photo or picture frame.', 'pen' )
			),
			sprintf(
				'%1$s &rarr; %2$s &rarr; %3$s',
				__( 'Customize', 'pen' ),
				__( 'Content', 'pen' ),
				__( 'List View', 'pen' )
			)
		);
		$choices = array(
			'#ffffff' => __( 'Light', 'pen' ),
			'#000000' => __( 'Dark', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label, $description );

		$setting_id = "pen_color_list_thumbnail_background_primary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Featured Image', 'pen' ),
			__( 'Primary', 'pen' )
		);
		$description = sprintf(
			/* Translators: Name of the layouts. */
			__( 'Only for these layouts: %s.', 'pen' ),
			sprintf(
				/* Translators: Just some words. */
				__( '%1$s & %2$s', 'pen' ),
				__( 'Tiles', 'pen' ),
				'jQuery Masonry'
			)
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_color_list_thumbnail_background_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Featured Image', 'pen' ),
			__( 'Secondary', 'pen' )
		);
		$description = sprintf(
			/* Translators: Name of the layouts. */
			__( 'Only for these layouts: %s.', 'pen' ),
			sprintf(
				/* Translators: Just some words. */
				__( '%1$s & %2$s', 'pen' ),
				__( 'Tiles', 'pen' ),
				'jQuery Masonry'
			)
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		/**
		 * Bottom.
		 */
		$section = 'pen_section_colors_bottom';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Bottom', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,animation_widget_areas' => __( 'Animation', 'pen' ),
							'section,background_image_bottom' => __( 'Background Image', 'pen' ),
							'section,widgets' => __( 'General', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_color_bottom_background_transparent[$preset]";
		$label      = __( 'Transparent Background', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_bottom_background_primary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Primary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_bottom_background_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Secondary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_bottom_background_angle[$preset]";
		$label      = __( 'Angle', 'pen' );
		$choices    = array(
			'to right'  => __( 'Horizontal', 'pen' ),
			'125deg'    => __( 'Diagonal', 'pen' ),
			'to bottom' => __( 'Vertical', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_color_bottom_text[$preset]";
		$label      = __( 'Text', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_bottom_link[$preset]";
		$label      = __( 'Links', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_bottom_link_hover[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Links', 'pen' ),
			__( 'Hover', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_bottom_text_shadow_display[$preset]";
		$label      = __( 'Text Shadow', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_bottom_text_shadow[$preset]";
		$label      = __( 'Text Shadow', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id  = "pen_color_bottom_headings[$preset]";
		$label       = __( 'Heading', 'pen' );
		$description = __( "It'd only apply to widgets with no Color Scheme.", 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_color_bottom_headings_text_shadow_display[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Text Shadow', 'pen' ),
			__( 'Heading', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_bottom_headings_text_shadow[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Text Shadow', 'pen' ),
			__( 'Heading', 'pen' )
		);
		$description = __( "It'd only apply to widgets with no Color Scheme.", 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_color_bottom_field_background_primary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Form Field', 'pen' ),
			__( 'Primary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_bottom_field_background_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Form Field', 'pen' ),
			__( 'Secondary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_bottom_field_background_angle[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Angle', 'pen' ),
			__( 'Form Field', 'pen' )
		);
		$choices = array(
			'to right'  => __( 'Horizontal', 'pen' ),
			'125deg'    => __( 'Diagonal', 'pen' ),
			'to bottom' => __( 'Vertical', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_color_bottom_field_text[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Text', 'pen' ),
			__( 'Form Field', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		/**
		 * Footer.
		 */
		$section = 'pen_section_colors_footer';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Footer', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,animation_footer'  => __( 'Animation', 'pen' ),
							'section,background_image_footer' => __( 'Background Image', 'pen' ),
							'section,footer'            => __( 'General', 'pen' ),
							'section,typography_footer' => __( 'Typography', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_color_footer_background_transparent[$preset]";
		$label      = __( 'Transparent Background', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_footer_background_primary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Primary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_footer_background_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Secondary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_footer_background_angle[$preset]";
		$label      = __( 'Angle', 'pen' );
		$choices    = array(
			'to right'  => __( 'Horizontal', 'pen' ),
			'125deg'    => __( 'Diagonal', 'pen' ),
			'to bottom' => __( 'Vertical', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_color_footer_text[$preset]";
		$label      = __( 'Text', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_footer_link[$preset]";
		$label      = __( 'Links', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_footer_link_hover[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Links', 'pen' ),
			__( 'Hover', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_footer_text_shadow_display[$preset]";
		$label      = __( 'Text Shadow', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_footer_text_shadow[$preset]";
		$label      = __( 'Text Shadow', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		/**
		 * "Loading..." splash screen.
		 */
		$section = 'pen_section_colors_loading_spinner';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => sprintf(
					/* Translators: Just some words. */
					__( '"%s" Screen', 'pen' ),
					__( 'Loading...', 'pen' )
				),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,loading_spinner' => __( 'General', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_color_loading_spinner_text[$preset]";
		$label      = __( 'Text', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_loading_spinner_primary[$preset]";
		$label      = __( 'Primary', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_loading_spinner_secondary[$preset]";
		$label      = __( 'Secondary', 'pen' );
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_loading_spinner_background_primary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Primary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_loading_spinner_background_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Background', 'pen' ),
			__( 'Secondary', 'pen' )
		);
		pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_color_loading_spinner_background_angle[$preset]";
		$label      = __( 'Angle', 'pen' );
		$choices    = array(
			'to right'  => __( 'Horizontal', 'pen' ),
			'125deg'    => __( 'Diagonal', 'pen' ),
			'to bottom' => __( 'Vertical', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		if ( PEN_THEME_HAS_WOOCOMMERCE ) {

			/**
			 * WooCommerce.
			 */
			$section = 'pen_section_colors_woocommerce';
			$wp_customize->add_section(
				$section,
				array(
					'title'       => __( 'WooCommerce', 'pen' ),
					'panel'       => $panel,
					'description' => sprintf(
						'<strong>%s</strong><br>%s<hr>',
						sprintf(
							/* Translators: Just some word. */
							__( '%s:', 'pen' ),
							__( 'More', 'pen' )
						),
						pen_html_jump_menu_items(
							array(
								'panel,woocommerce' => __( 'General', 'pen' ),
							)
						)
					),
				)
			);

			$setting_id = "pen_color_cart_header_button_background_primary[$preset]";
			$label      = sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				sprintf(
					'%1$s &rarr; %2$s',
					__( 'Button', 'pen' ),
					__( 'Cart', 'pen' )
				),
				__( 'Primary', 'pen' )
			);
			pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

			$setting_id = "pen_color_cart_header_button_background_secondary[$preset]";
			$label      = sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				sprintf(
					'%1$s &rarr; %2$s',
					__( 'Button', 'pen' ),
					__( 'Cart', 'pen' )
				),
				__( 'Secondary', 'pen' )
			);
			pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

			$setting_id = "pen_color_cart_header_button_background_angle[$preset]";
			$label      = sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Angle', 'pen' ),
				sprintf(
					'%1$s &rarr; %2$s',
					__( 'Button', 'pen' ),
					__( 'Cart', 'pen' )
				)
			);
			$choices = array(
				'to right'  => __( 'Horizontal', 'pen' ),
				'125deg'    => __( 'Diagonal', 'pen' ),
				'to bottom' => __( 'Vertical', 'pen' ),
			);
			pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

			$setting_id = "pen_color_cart_header_button_text[$preset]";
			$label      = sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Text', 'pen' ),
				sprintf(
					'%1$s &rarr; %2$s',
					__( 'Button', 'pen' ),
					__( 'Cart', 'pen' )
				)
			);
			pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

			$setting_id = "pen_color_cart_header_content_background_primary[$preset]";
			$label      = sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s (%3$s)', 'pen' ),
				__( 'Background', 'pen' ),
				__( 'Shopping Cart', 'pen' ),
				__( 'Primary', 'pen' )
			);
			pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

			$setting_id = "pen_color_cart_header_content_background_secondary[$preset]";
			$label      = sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s (%3$s)', 'pen' ),
				__( 'Background', 'pen' ),
				__( 'Shopping Cart', 'pen' ),
				__( 'Secondary', 'pen' )
			);
			pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

			$setting_id = "pen_color_cart_header_content_background_angle[$preset]";
			$label      = __( 'Angle', 'pen' );
			$choices    = array(
				'to right'  => __( 'Horizontal', 'pen' ),
				'125deg'    => __( 'Diagonal', 'pen' ),
				'to bottom' => __( 'Vertical', 'pen' ),
			);
			pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

			$setting_id = "pen_color_cart_header_content_text[$preset]";
			$label      = sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Text', 'pen' ),
				__( 'Shopping Cart', 'pen' )
			);
			pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

			$setting_id = "pen_color_cart_header_content_link[$preset]";
			$label      = __( 'Cart', 'pen' );
			pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

			$setting_id = "pen_color_cart_header_content_link_hover[$preset]";
			$label      = sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				__( 'Cart', 'pen' ),
				__( 'Hover', 'pen' )
			);
			pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

			$setting_id = "pen_color_cart_badge_sale_background_primary[$preset]";
			$label      = sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				__( 'Sale Badge', 'pen' ),
				__( 'Primary', 'pen' )
			);
			pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

			$setting_id = "pen_color_cart_badge_sale_background_secondary[$preset]";
			$label      = sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				__( 'Sale Badge', 'pen' ),
				__( 'Secondary', 'pen' )
			);
			pen_control_color( $wp_customize, $setting_id, $section, 'refresh', $label );

		}
	}
}

if ( ! function_exists( 'pen_customize_typography' ) ) {
	/**
	 * Adds typography options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param array                $variables    Common variables.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_customize_typography( &$wp_customize, $variables ) {

		$preset      = 'preset_1';
		$preset_font = pen_preset_get( 'font_family' );

		$list_fonts = array_merge(
			array(
				'default' => __( 'Default', 'pen' ),
			),
			pen_fonts_all()
		);

		$list_sizes = array(
			'0.5em'   => __( 'Very Small', 'pen' ),
			'0.75em'  => __( 'Small', 'pen' ),
			'default' => __( 'Default', 'pen' ),
			'2em'     => __( 'Large', 'pen' ),
			'3em'     => __( 'Very Large', 'pen' ),
		);

		$panel = 'pen_panel_typography';
		$wp_customize->add_panel(
			$panel,
			array(
				'title'    => __( 'Typography', 'pen' ),
				'priority' => 2,
			)
		);

		/**
		 * General.
		 */
		$section = 'pen_section_typography_general';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'General', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,background_image' => __( 'Background Image', 'pen' ),
							'section,colors_general'   => __( 'Colors', 'pen' ),
							'panel,content'            => __( 'General', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_font_family_site[$preset_font]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Font Family', 'pen' ),
			__( 'General', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_fonts, $label );

		$setting_id = "pen_font_family_headings[$preset_font]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Font Family', 'pen' ),
			__( 'Heading', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_fonts, $label );

		$setting_id = "pen_font_family_title_list[$preset_font]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Font Family', 'pen' ),
			__( 'Title', 'pen' ),
			__( 'List View', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_fonts, $label );

		$setting_id = "pen_font_size_title_list[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Font Size', 'pen' ),
			__( 'Title', 'pen' ),
			__( 'List View', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_sizes, $label );

		$setting_id = "pen_font_family_title_content[$preset_font]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Font Family', 'pen' ),
			__( 'Title', 'pen' ),
			__( 'Full Content View', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_fonts, $label );

		$setting_id = "pen_font_size_title_content[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Font Size', 'pen' ),
			__( 'Title', 'pen' ),
			__( 'Full Content View', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_sizes, $label );

		$setting_id = "pen_font_family_forms[$preset_font]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Font Family', 'pen' ),
			__( 'Forms', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_fonts, $label );

		$setting_id = "pen_font_family_buttons[$preset_font]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Font Family', 'pen' ),
			__( 'Button', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_fonts, $label );

		$setting_id = "pen_transform_text_buttons[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Transform', 'pen' ),
			__( 'Button', 'pen' )
		);
		$choices = array(
			'disable'    => __( 'Disabled', 'pen' ),
			'uppercase'  => __( 'Uppercase', 'pen' ),
			'capitalize' => __( 'Words', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		/**
		 * Header.
		 */
		$section = 'pen_section_typography_header';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Header', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,animation_header' => __( 'Animation', 'pen' ),
							'section,header_image'     => __( 'Background Image', 'pen' ),
							'section,colors_header'    => __( 'Colors', 'pen' ),
							'section,title_tagline'    => sprintf(
								/* Translators: Just some words. */
								__( '%1$s & %2$s', 'pen' ),
								__( 'Logo', 'pen' ),
								__( 'Site Title', 'pen' )
							),
							'panel,header'             => __( 'General', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_font_family_sitetitle[$preset_font]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Font Family', 'pen' ),
			__( 'Site Title', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_fonts, $label );

		$setting_id = "pen_font_size_sitetitle[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Font Size', 'pen' ),
			__( 'Site Title', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_sizes, $label );

		$setting_id = "pen_font_resize_sitetitle[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Dynamic Font Size', 'pen' ),
			__( 'Site Title', 'pen' )
		);
		$description = sprintf(
			/* Translators: Just some words. */
			__( '(%s)', 'pen' ),
			__( 'Only Small Screens', 'pen' )
		);
		$choices = array(
			'none'    => __( 'Disabled', 'pen' ),
			'dynamic' => 'jQuery FitText',
			'resize'  => __( 'Shrink to fit', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label, $description );

		$setting_id = "pen_transform_text_sitetitle[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Transform', 'pen' ),
			__( 'Site Title', 'pen' )
		);
		$choices = array(
			'disable'    => __( 'Disabled', 'pen' ),
			'normal'     => __( 'Normal', 'pen' ),
			'uppercase'  => __( 'Uppercase', 'pen' ),
			'capitalize' => __( 'Words', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_font_family_sitedescription[$preset_font]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Font Family', 'pen' ),
			__( 'Site Description', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_fonts, $label );

		$setting_id = "pen_font_size_sitedescription[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Font Size', 'pen' ),
			__( 'Site Description', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_sizes, $label );

		$setting_id = "pen_transform_text_sitedescription[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Transform', 'pen' ),
			__( 'Site Description', 'pen' )
		);
		$choices = array(
			'disable'    => __( 'Disabled', 'pen' ),
			'normal'     => __( 'Normal', 'pen' ),
			'uppercase'  => __( 'Uppercase', 'pen' ),
			'capitalize' => __( 'Words', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		/**
		 * Navigation font.
		 */
		$section = 'pen_section_typography_navigation';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Navigation', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,animation_navigation' => __( 'Animation', 'pen' ),
							'section,background_image_navigation' => __( 'Background Image', 'pen' ),
							'section,colors_navigation'    => __( 'Colors', 'pen' ),
							'panel,nav_menus'              => __( 'Menu', 'pen' ),
							'section,header_navigation'    => __( 'General', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_font_family_navigation[$preset_font]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Font Family', 'pen' ),
			__( 'Main Menu', 'pen' ),
			__( 'Parent Menu Items', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_fonts, $label );

		$setting_id = "pen_font_size_navigation[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Font Size', 'pen' ),
			__( 'Main Menu', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_sizes, $label );

		$setting_id = "pen_transform_text_navigation[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Transform', 'pen' ),
			__( 'Main Menu', 'pen' )
		);
		$choices = array(
			'disable'    => __( 'Disabled', 'pen' ),
			'normal'     => __( 'Normal', 'pen' ),
			'uppercase'  => __( 'Uppercase', 'pen' ),
			'capitalize' => __( 'Words', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_transform_text_navigation_mobile[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Transform', 'pen' ),
			__( 'Mobile Menu', 'pen' )
		);
		$choices = array(
			'disable'    => __( 'Disabled', 'pen' ),
			'normal'     => __( 'Normal', 'pen' ),
			'uppercase'  => __( 'Uppercase', 'pen' ),
			'capitalize' => __( 'Words', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_font_family_navigation_submenu[$preset_font]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Font Family', 'pen' ),
			__( 'Sub-menus', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_fonts, $label );

		$setting_id = "pen_transform_text_navigation_submenu[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Transform', 'pen' ),
			__( 'Sub-menus', 'pen' )
		);
		$choices = array(
			'disable'    => __( 'Disabled', 'pen' ),
			'normal'     => __( 'Normal', 'pen' ),
			'uppercase'  => __( 'Uppercase', 'pen' ),
			'capitalize' => __( 'Words', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_transform_text_navigation_submenu_mobile[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Transform', 'pen' ),
			__( 'Sub-menus', 'pen' ),
			__( 'Mobile Menu', 'pen' )
		);
		$choices = array(
			'disable'    => __( 'Disabled', 'pen' ),
			'normal'     => __( 'Normal', 'pen' ),
			'uppercase'  => __( 'Uppercase', 'pen' ),
			'capitalize' => __( 'Words', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		/**
		 * Sidebars.
		 */
		$section = 'pen_section_typography_sidebars';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Widget Areas', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'panel,widgets'          => __( 'General', 'pen' ),
							'section,front_sidebars' => sprintf(
								'%1$s &rarr; %2$s',
								__( 'Front Page', 'pen' ),
								__( 'Sidebars', 'pen' )
							),
						)
					)
				),
			)
		);

		$setting_id = "pen_font_family_widget_title_top[$preset_font]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Top', 'pen' ),
			__( 'Widget Title', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_fonts, $label );

		$setting_id = "pen_font_size_widget_title_top[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s &rarr; %2$s: %3$s', 'pen' ),
			__( 'Size', 'pen' ),
			__( 'Top', 'pen' ),
			__( 'Widget Title', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_sizes, $label );

		$setting_id = "pen_font_family_widget_title_left[$preset_font]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Left', 'pen' ),
			__( 'Widget Title', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_fonts, $label );

		$setting_id = "pen_font_size_widget_title_left[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s &rarr; %2$s: %3$s', 'pen' ),
			__( 'Size', 'pen' ),
			__( 'Left Sidebar', 'pen' ),
			__( 'Widget Title', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_sizes, $label );

		$setting_id = "pen_font_family_widget_title_right[$preset_font]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Right Sidebar', 'pen' ),
			__( 'Widget Title', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_fonts, $label );

		$setting_id = "pen_font_size_widget_title_right[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s &rarr; %2$s: %3$s', 'pen' ),
			__( 'Size', 'pen' ),
			__( 'Right Sidebar', 'pen' ),
			__( 'Widget Title', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_sizes, $label );

		$setting_id = "pen_font_family_widget_title_bottom[$preset_font]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Bottom', 'pen' ),
			__( 'Widget Title', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_fonts, $label );

		$setting_id = "pen_font_size_widget_title_bottom[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s &rarr; %2$s: %3$s', 'pen' ),
			__( 'Size', 'pen' ),
			__( 'Bottom', 'pen' ),
			__( 'Widget Title', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_sizes, $label );

		/**
		 * Footer fonts.
		 */
		$section = 'pen_section_typography_footer';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Footer', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,animation_footer' => __( 'Animation', 'pen' ),
							'section,background_image_footer' => __( 'Background Image', 'pen' ),
							'section,colors_footer'    => __( 'Colors', 'pen' ),
							'section,footer'           => __( 'General', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_transform_text_footer_menu[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Transform', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Footer', 'pen' ),
				__( 'Menu', 'pen' )
			)
		);
		$choices = array(
			'disable'    => __( 'Disabled', 'pen' ),
			'uppercase'  => __( 'Uppercase', 'pen' ),
			'capitalize' => __( 'Words', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_font_family_copyright[$preset_font]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Font Family', 'pen' ),
			__( 'Phone', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_fonts, $label );

		$setting_id = "pen_font_size_copyright[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Font Size', 'pen' ),
			__( 'Phone', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_sizes, $label );

		$section = 'pen_section_typography_contact';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => sprintf(
					/* Translators: Just some words. */
					__( '%1$s & %2$s', 'pen' ),
					__( 'Phone', 'pen' ),
					__( 'Social Media', 'pen' )
				),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'panel,contact' => __( 'General', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_font_family_phone_header[$preset_font]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Font Family', 'pen' ),
			__( 'Phone', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_fonts, $label );

		$setting_id = "pen_font_size_phone_header[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Font Size', 'pen' ),
			__( 'Phone', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_sizes, $label );

		$setting_id = "pen_font_size_social_header[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Font Size', 'pen' ),
			__( 'Social Media', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_sizes, $label );

		$setting_id = "pen_font_family_phone_footer[$preset_font]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Font Family', 'pen' ),
			__( 'Phone', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_fonts, $label );

		$setting_id = "pen_font_size_phone_footer[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Font Size', 'pen' ),
			__( 'Phone', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_sizes, $label );

		$setting_id = "pen_font_size_social_footer[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Font Size', 'pen' ),
			__( 'Social Media', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $list_sizes, $label );
	}
}

if ( ! function_exists( 'pen_customize_header' ) ) {
	/**
	 * Adds header options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param array                $variables    Common variables.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_customize_header( &$wp_customize, $variables ) {

		$preset = 'preset_1';

		$description = sprintf(
			'<strong>%s</strong><br>%s<hr>',
			sprintf(
				/* Translators: Just some word. */
				__( '%s:', 'pen' ),
				__( 'More', 'pen' )
			),
			pen_html_jump_menu_items(
				array(
					'section,animation_header'  => __( 'Animation', 'pen' ),
					'section,header_image'      => __( 'Background Image', 'pen' ),
					'section,colors_header'     => __( 'Colors', 'pen' ),
					'section,title_tagline'     => sprintf(
						/* Translators: Just some words. */
						__( '%1$s & %2$s', 'pen' ),
						__( 'Logo', 'pen' ),
						__( 'Site Title', 'pen' )
					),
					'section,typography_header' => __( 'Typography', 'pen' ),
				)
			)
		);

		$panel = 'pen_panel_header';
		$wp_customize->add_panel(
			$panel,
			array(
				'title'       => __( 'Header', 'pen' ),
				'priority'    => 3,
				'description' => $description,
			)
		);

		/*
		 * Header.
		 */
		$section = 'pen_section_header_general';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'General', 'pen' ),
				'panel'       => $panel,
				'description' => $description,
			)
		);

		$setting_id = "pen_site_header_display[$preset]";
		$label      = __( 'Site Header', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_header_sticky[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Sticky', 'pen' ),
			__( 'Header', 'pen' )
		);
		$description = __( 'This may automatically change to provide the best appearance and user experience.', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_header_sticky_minimize[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Sticky', 'pen' ),
			__( 'Minimize', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_header_sitetitle_display[$preset]";
		$label      = __( 'Site Title', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_header_sitedescription_display[$preset]";
		$label      = __( 'Site Description', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		if ( PEN_THEME_HAS_WOOCOMMERCE ) {
			$setting_id = "pen_cart_header_display[$preset]";
			$label      = sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				sprintf(
					'%1$s &rarr; %2$s',
					__( 'Button', 'pen' ),
					__( 'Cart', 'pen' )
				),
				__( 'Header', 'pen' )
			);
			pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );
		}

		$setting_id = "pen_header_alignment[$preset]";
		$label      = __( 'Alignment', 'pen' );
		$choices    = array(
			'left'   => __( 'Left', 'pen' ),
			'center' => __( 'Center', 'pen' ),
			'right'  => __( 'Right', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'postMessage', $choices, $label );

		$setting_id  = "pen_padding_header[$preset]";
		$label       = __( 'Padding', 'pen' );
		$description = __( 'Does not apply to the Narrow layout and small screens.', 'pen' );
		$choices     = array(
			'none'          => __( 'None', 'pen' ),
			'small'         => __( 'Small', 'pen' ),
			'small_bottom'  => sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				__( 'Small', 'pen' ),
				__( 'Bottom', 'pen' )
			),
			'small_top'     => sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				__( 'Small', 'pen' ),
				__( 'Top', 'pen' )
			),
			'medium'        => __( 'Medium', 'pen' ),
			'medium_bottom' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				__( 'Medium', 'pen' ),
				__( 'Bottom', 'pen' )
			),
			'medium_top'    => sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				__( 'Medium', 'pen' ),
				__( 'Top', 'pen' )
			),
			'big'           => __( 'Big', 'pen' ),
			'big_bottom'    => sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				__( 'Big', 'pen' ),
				__( 'Bottom', 'pen' )
			),
			'big_top'       => sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				__( 'Big', 'pen' ),
				__( 'Top', 'pen' )
			),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'postMessage', $choices, $label, $description );

		/*
		 * Search.
		 */
		$section = 'pen_section_header_search';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Search', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,animation_search' => __( 'Animation', 'pen' ),
							'section,background_image_search' => __( 'Background Image', 'pen' ),
							'section,colors_header'    => sprintf(
								/* Translators: Just some words. */
								__( '%1$s: %2$s', 'pen' ),
								__( 'Colors', 'pen' ),
								__( 'Header', 'pen' )
							),
							'section,colors_search'    => sprintf(
								/* Translators: Just some words. */
								__( '%1$s: %2$s', 'pen' ),
								__( 'Colors', 'pen' ),
								__( 'Search Bar', 'pen' )
							),
						)
					)
				),
			)
		);

		$setting_id = "pen_search_display[$preset]";
		$label      = __( 'Search Box', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_search_location[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Location', 'pen' ),
			__( 'Search Box', 'pen' )
		);
		$choices = array(
			'header'  => __( 'Header', 'pen' ),
			'content' => __( 'Search Bar', 'pen' ),
		);
		pen_control_radio( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$section = 'pen_section_header_register';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'Registration', 'pen' ),
				'panel' => $panel,
			)
		);

		$setting_id = "pen_button_users_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Button', 'pen' ),
			__( 'Registration', 'pen' )
		);
		$choices    = array(
			'never'     => __( 'Never', 'pen' ),
			'always'    => __( 'Always', 'pen' ),
			'visitors'  => __( 'Visitors Only', 'pen' ),
			'logged_in' => __( 'Authenticated Users', 'pen' ),
		);
		pen_control_radio( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_encourage_register[$preset]";
		$label      = __( 'Encourage visitors to register', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_button_users_header_text_register[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Text', 'pen' ),
			__( 'Visitors', 'pen' )
		);
		$choices = array(
			'free_registration' => __( 'Free Registration', 'pen' ),
			'login_register'    => sprintf(
				/* Translators: Just some words. */
				__( '%1$s / %2$s', 'pen' ),
				__( 'Login', 'pen' ),
				__( 'Register', 'pen' )
			),
			'register'          => __( 'Register', 'pen' ),
			'register_today'    => __( 'Register Today', 'pen' ),
			'shop_now'          => __( 'Shop Now', 'pen' ),
			'sign_in'           => __( 'Sign in', 'pen' ),
			'sign_up'           => __( 'Sign up', 'pen' ),
			'subscribe'         => __( 'Subscribe', 'pen' ),
			'subscribe_today'   => __( 'Subscribe Today', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_button_users_header_url[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%s:', 'pen' ),
			__( 'Custom page for user registration', 'pen' )
		);
		$description  = __( 'Leave it empty if you do not have any custom registration page.', 'pen' );
		$description .= sprintf(
			'<br>%s<br>%s',
			sprintf(
				/* Translators: Just some words. */
				__( '%s:', 'pen' ),
				__( 'Examples', 'pen' )
			),
			'https://example.com/register<br>#registration-form'
		);
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		/*
		 * Navigation.
		 */
		$section = 'pen_section_header_navigation';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Navigation', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,animation_navigation' => __( 'Animation', 'pen' ),
							'section,background_image_navigation' => __( 'Background Image', 'pen' ),
							'section,colors_navigation'    => __( 'Colors', 'pen' ),
							'panel,nav_menus'              => __( 'Menu', 'pen' ),
							'section,typography_navigation' => __( 'Typography', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_navigation_display[$preset]";
		$label      = __( 'Main Menu', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		if ( PEN_THEME_HAS_WOOCOMMERCE ) {
			$setting_id = "pen_cart_navigation_include[$preset]";
			$label      = sprintf(
				'%1$s &rarr; %2$s',
				__( 'Shopping Cart', 'pen' ),
				__( 'Main Menu', 'pen' )
			);
			pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

			$setting_id = "pen_cart_footer_menu_include[$preset]";
			$label      = sprintf(
				'%1$s &rarr; %2$s',
				__( 'Shopping Cart', 'pen' ),
				sprintf(
					'%1$s &rarr; %2$s',
					__( 'Footer', 'pen' ),
					__( 'Menu', 'pen' )
				)
			);
			pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );
		}

		$setting_id = "pen_navigation_mobile_display[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Visibility', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Menu', 'pen' ),
				__( 'Mobile', 'pen' )
			)
		);
		$choices = array(
			'never'         => __( 'Never', 'pen' ),
			'mobile'        => __( 'Mobile', 'pen' ),
			'mobile_tablet' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s & %2$s', 'pen' ),
				__( 'Mobile', 'pen' ),
				__( 'Tablet', 'pen' )
			),
			'always'        => __( 'Always', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_navigation_pointer_event[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Menu', 'pen' ),
			__( 'Expand', 'pen' )
		);
		$choices = array(
			'hover' => __( 'Hover', 'pen' ),
			'click' => __( 'Click', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_navigation_mobile_sticky[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Sticky', 'pen' ),
			__( 'Mobile Menu', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_navigation_mobile_parents_include[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Mobile Menu', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Parent Menu Items', 'pen' ),
				__( 'Duplicate', 'pen' )
			)
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_navigation_mobile_text[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Text', 'pen' ),
			__( 'Mobile Menu', 'pen' )
		);
		$choices = array(
			''          => __( 'Hide', 'pen' ),
			'menu'      => __( 'Menu', 'pen' ),
			'menu_main' => __( 'Main Menu', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_navigation_separator[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Separators', 'pen' ),
			__( 'Main Menu', 'pen' )
		);
		$choices = array(
			0 => __( 'None', 'pen' ),
		);
		for ( $i = 1; $i <= 10; $i++ ) {
			/* Translators: Just a number. */
			$choices[ $i ] = sprintf( __( 'Style %d', 'pen' ), $i );
		}
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_navigation_separator_submenu[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Separators', 'pen' ),
			sprintf(
				/* Translators: Just some words. */
				__( '%1$s & %2$s', 'pen' ),
				__( 'Sub-menus', 'pen' ),
				__( 'Mobile Menu', 'pen' )
			)
		);
		$choices = array(
			0 => __( 'None', 'pen' ),
		);
		for ( $i = 1; $i <= 10; $i++ ) {
			/* Translators: Just a number. */
			$choices[ $i ] = sprintf( __( 'Style %d', 'pen' ), $i );
		}
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_navigation_hover[$preset]";
		$label      = __( 'Hover', 'pen' );
		$choices    = array(
			0 => __( 'None', 'pen' ),
		);
		for ( $i = 1; $i <= 10; $i++ ) {
			/* Translators: Just a number. */
			$choices[ $i ] = sprintf( __( 'Style %d', 'pen' ), $i );
		}
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_navigation_arrows[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Parent Menu Items', 'pen' ),
			__( 'Icon', 'pen' )
		);
		$choices    = array(
			0 => __( 'None', 'pen' ),
		);
		for ( $i = 1; $i <= 10; $i++ ) {
			/* Translators: Just a number. */
			$choices[ $i ] = sprintf( __( 'Style %d', 'pen' ), $i );
		}
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_navigation_alignment[$preset]";
		$label      = __( 'Alignment', 'pen' );
		$choices    = array(
			'left'   => __( 'Left', 'pen' ),
			'center' => __( 'Center', 'pen' ),
			'right'  => __( 'Right', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'postMessage', $choices, $label );

		$setting_id = "pen_padding_navigation[$preset]";
		$label      = __( 'Padding', 'pen' );
		$choices    = array(
			'none'          => __( 'None', 'pen' ),
			'small'         => __( 'Small', 'pen' ),
			'small_bottom'  => sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				__( 'Small', 'pen' ),
				__( 'Bottom', 'pen' )
			),
			'small_top'     => sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				__( 'Small', 'pen' ),
				__( 'Top', 'pen' )
			),
			'medium'        => __( 'Medium', 'pen' ),
			'medium_bottom' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				__( 'Medium', 'pen' ),
				__( 'Bottom', 'pen' )
			),
			'medium_top'    => sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				__( 'Medium', 'pen' ),
				__( 'Top', 'pen' )
			),
			'big'           => __( 'Big', 'pen' ),
			'big_bottom'    => sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				__( 'Big', 'pen' ),
				__( 'Bottom', 'pen' )
			),
			'big_top'       => sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				__( 'Big', 'pen' ),
				__( 'Top', 'pen' )
			),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'postMessage', $choices, $label );

	}
}

if ( ! function_exists( 'pen_customize_content_general' ) ) {
	/**
	 * Adds general "Content area" options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param array                $variables    Common variables.
	 *
	 * @since Pen 1.3.4
	 * @return void
	 */
	function pen_customize_content_general( &$wp_customize, $variables ) {

		$preset = 'preset_1';

		$panel = 'pen_panel_content';
		$wp_customize->add_panel(
			$panel,
			array(
				'title'    => __( 'Content', 'pen' ),
				'priority' => 4,
			)
		);

		$section = 'pen_section_content_general';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'General', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,background_image'   => __( 'Background Image', 'pen' ),
							'section,colors_general'     => __( 'Colors', 'pen' ),
							'section,typography_general' => __( 'Typography', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_content_details_separator[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Separators', 'pen' ),
			__( 'Details', 'pen' )
		);
		$choices = array(
			0 => __( 'None', 'pen' ),
		);
		for ( $i = 1; $i <= 10; $i++ ) {
			/* Translators: Just a number. */
			$choices[ $i ] = sprintf( __( 'Style %d', 'pen' ), $i );
		}
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

	}
}

if ( ! function_exists( 'pen_customize_content_list' ) ) {
	/**
	 * Adds "Content list" options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param array                $variables    Common variables.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_customize_content_list( &$wp_customize, $variables ) {

		$preset = 'preset_1';

		$panel = 'pen_panel_content';

		$section = 'pen_section_list';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'List View', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,animation_list' => __( 'Animation', 'pen' ),
							'section,colors_list'    => __( 'Colors', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_list_infinite_scrolling[$preset]";
		$label      = __( 'Infinite Scrolling', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_infinite_scrolling_allow_stop[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Infinite Scrolling', 'pen' ),
			__( 'Allow users to disable it', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_type[$preset]";
		$label      = __( 'Layout', 'pen' );
		$choices    = array(
			'tiles'   => __( 'Tiles', 'pen' ),
			'masonry' => 'jQuery Masonry',
			'plain'   => __( 'Plain List', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_list_tile_columns[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Tiles', 'pen' ),
			__( 'Columns', 'pen' ),
			__( 'Maximum', 'pen' )
		);
		$choices = array(
			'2' => __( 'Two', 'pen' ),
			'3' => __( 'Three', 'pen' ),
			'4' => __( 'Four', 'pen' ),
			'5' => __( 'Five', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_list_tile_thumbnail_effect[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Featured Image', 'pen' ),
			__( 'Effect', 'pen' ),
			__( 'Tiles', 'pen' )
		);
		$choices = array(
			'none'     => __( 'None', 'pen' ),
			'zoom_in'  => __( 'Zoom in', 'pen' ),
			'zoom_out' => __( 'Zoom out', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_list_tile_thumbnail_style[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Featured Image', 'pen' ),
			__( 'Style', 'pen' ),
			__( 'Tiles', 'pen' )
		);
		$choices = array(
			0 => __( 'None', 'pen' ),
		);
		for ( $i = 1; $i <= 25; $i++ ) {
			/* Translators: Just a number. */
			$choices[ $i ] = sprintf( __( 'Style %d', 'pen' ), $i );
		}
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_list_masonry_columns[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			'jQuery Masonry',
			__( 'Columns', 'pen' ),
			__( 'Maximum', 'pen' )
		);
		$choices = array(
			'2' => __( 'Two', 'pen' ),
			'3' => __( 'Three', 'pen' ),
			'4' => __( 'Four', 'pen' ),
			'5' => __( 'Five', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_list_masonry_thumbnail_effect[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Featured Image', 'pen' ),
			__( 'Effect', 'pen' ),
			'jQuery Masonry'
		);
		$choices = array(
			'none'     => __( 'None', 'pen' ),
			'zoom_in'  => __( 'Zoom in', 'pen' ),
			'zoom_out' => __( 'Zoom out', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_list_masonry_thumbnail_style[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s (%3$s)', 'pen' ),
			__( 'Featured Image', 'pen' ),
			__( 'Style', 'pen' ),
			'jQuery Masonry'
		);
		$choices = array(
			0 => __( 'None', 'pen' ),
		);
		for ( $i = 1; $i <= 25; $i++ ) {
			/* Translators: Just a number. */
			$choices[ $i ] = sprintf( __( 'Style %d', 'pen' ), $i );
		}
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id  = "pen_list_effect[$preset]";
		$label       = __( 'List Effect', 'pen' );
		$description = __( 'This may not work in conjunction with some of the animations in the "Content list animation" above.', 'pen' );
		$choices     = array(
			'none'         => __( 'None', 'pen' ),
			'enlarge'      => __( 'Enlarge', 'pen' ),
			'fade'         => __( 'Fade', 'pen' ),
			'enlarge_fade' => sprintf(
				'%1$s + %2$s',
				__( 'Enlarge', 'pen' ),
				__( 'Fade', 'pen' )
			),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label, $description );

		$setting_id = "pen_list_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Content', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_header_alignment[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s &rarr; %3$s &rarr; %4$s',
			__( 'Content', 'pen' ),
			__( 'Header', 'pen' ),
			__( 'Alignment', 'pen' ),
			__( 'Center', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_header_icon[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s &rarr; %3$s',
			__( 'Content', 'pen' ),
			__( 'Header', 'pen' ),
			__( 'Icon', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_title_alignment[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s &rarr; %3$s &rarr; %4$s',
			__( 'Content', 'pen' ),
			__( 'Title', 'pen' ),
			__( 'Alignment', 'pen' ),
			__( 'Center', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_excerpt[$preset]";
		$label      = __( 'Excerpt', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_title_display[$preset]";
		$label      = __( 'Title', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_author_location[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Location', 'pen' ),
			__( 'Author', 'pen' )
		);
		$choices = array(
			'header' => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Header', 'pen' )
			),
			'footer' => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Footer', 'pen' )
			),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_list_author_display[$preset]";
		$label      = __( 'Author', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_date_location[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Location', 'pen' ),
			__( 'Content Date', 'pen' )
		);
		$choices = array(
			'header' => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Header', 'pen' )
			),
			'footer' => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Footer', 'pen' )
			),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_list_date_display[$preset]";
		$label      = __( 'Content Date', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_date_updated_display[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Content Date', 'pen' ),
			__( 'Updated', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_category_location[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Location', 'pen' ),
			__( 'Categories', 'pen' )
		);
		$choices = array(
			'header' => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Header', 'pen' )
			),
			'footer' => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Footer', 'pen' )
			),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_list_category_display[$preset]";
		$label      = __( 'Categories', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_category_only_first[$preset]";
		$label      = __( 'The First Category Only', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_thumbnail_display[$preset]";
		$label      = __( 'Featured Image', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_thumbnail_rotate[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Featured Image', 'pen' ),
			__( 'Rotate', 'pen' )
		);
		$description = __( 'Only applies to the Plain List layout.', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_list_thumbnail_frame[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Featured Image', 'pen' ),
			_x( 'Frame', 'As in photo or picture frame.', 'pen' )
		);
		$description = __( 'Only applies to the Plain List layout.', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_list_thumbnail_alignment[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Featured Image', 'pen' ),
			__( 'Alignment', 'pen' )
		);
		$description = __( 'Only applies to the Plain List layout.', 'pen' );
		$choices     = array(
			'left'   => __( 'Left', 'pen' ),
			'center' => __( 'Center', 'pen' ),
			'right'  => __( 'Right', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label, $description );

		$setting_id = "pen_list_thumbnail_resize[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Featured Image', 'pen' ),
			__( 'Size', 'pen' )
		);
		$description     = __( 'Only applies to the Plain List layout.', 'pen' );
		$thumbnail_sizes = array(
			'none' => __( 'None', 'pen' ),
		);
		$thumbnail_sizes = array_merge( $thumbnail_sizes, $variables['options_image_sizes'] );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $thumbnail_sizes, $label, $description );

		$setting_id = "pen_list_summary_display[$preset]";
		$label      = __( 'Summaries', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_profile_display[$preset]";
		$label      = __( 'Author Profile', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_author_name_link[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Link', 'pen' ),
			__( "Author's Name", 'pen' )
		);
		$choices = array(
			'none'    => __( 'None', 'pen' ),
			'archive' => __( 'Archive', 'pen' ),
			'website' => __( 'Website', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_list_author_avatar_link[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Link', 'pen' ),
			__( 'Avatar', 'pen' )
		);
		$choices = array(
			'none'    => __( 'None', 'pen' ),
			'archive' => __( 'Archive', 'pen' ),
			'website' => __( 'Website', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_list_author_avatar_style[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Avatar', 'pen' ),
			__( 'Style', 'pen' )
		);
		$choices = array(
			0 => __( 'None', 'pen' ),
		);
		for ( $i = 1; $i <= 10; $i++ ) {
			/* Translators: Just a number. */
			$choices[ $i ] = sprintf( __( 'Style %d', 'pen' ), $i );
		}
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_list_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Content', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_tags_display[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Footer', 'pen' ),
			__( 'Tags', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_button_comment_display[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Footer', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Button', 'pen' ),
				__( 'Comment', 'pen' )
			)
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_button_edit_display[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Footer', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Button', 'pen' ),
				__( 'Edit', 'pen' )
			)
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_button_read_more_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Button', 'pen' ),
			__( 'Read More', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_list_button_read_more_text[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Read More', 'pen' ),
			__( 'Wording', 'pen' )
		);
		$choices = array(
			'buy_now'          => __( 'Buy Now', 'pen' ),
			'continue_reading' => sprintf(
				/* Translators: Content title. */
				__( 'Continue reading %s', 'pen' ),
				sprintf(
					/* Translators: Just some text. */
					__( '(%s)', 'pen' ),
					sprintf(
						/* Translators: Just some text. */
						__( '%1$s: %2$s', 'pen' ),
						__( 'Hidden', 'pen' ),
						__( 'Content Title', 'pen' )
					)
				)
			),
			'details'          => __( 'Details', 'pen' ),
			'download'         => __( 'Download', 'pen' ),
			'enrol_now'        => __( 'Enroll Now', 'pen' ),
			'free_download'    => __( 'Free Download', 'pen' ),
			'join_now'         => __( 'Join Now', 'pen' ),
			'know_more'        => __( 'Know More', 'pen' ),
			'members_only'     => __( 'Members Only', 'pen' ),
			'more'             => __( 'More', 'pen' ),
			'order_now'        => __( 'Order Now', 'pen' ),
			'read'             => __( 'Read', 'pen' ),
			'read_more'        => __( 'Read More', 'pen' ),
			'register_now'     => __( 'Register Now', 'pen' ),
			'view'             => __( 'View', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_list_button_read_more_type[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Read More', 'pen' ),
			__( 'Element', 'pen' )
		);
		$choices = array(
			'button' => __( 'Button', 'pen' ),
			'link'   => __( 'Link', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_list_button_read_more_icon[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Read More', 'pen' ),
			__( 'Icon', 'pen' )
		);
		$choices = array(
			'none'         => __( 'None', 'pen' ),
			'arrow'        => __( 'Arrow', 'pen' ),
			'arrow_double' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				__( 'Arrow', 'pen' ),
				__( 'Double', 'pen' )
			),
			'ellipsis'     => __( 'Ellipsis', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

	}
}

if ( ! function_exists( 'pen_customize_content_full' ) ) {
	/**
	 * Adds "Full Content View" options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param array                $variables    Common variables.
	 *
	 * @since Pen 1.0.2
	 * @return void
	 */
	function pen_customize_content_full( &$wp_customize, $variables ) {

		$preset = 'preset_1';

		$panel = 'pen_panel_content';

		$section = 'pen_section_content';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Full Content View', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,animation_content' => __( 'Animation', 'pen' ),
							'section,background_image_content_title' => __( 'Background Image', 'pen' ),
							'section,colors_content'    => __( 'Colors', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_content_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Content', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_header_alignment[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s &rarr; %3$s &rarr; %4$s',
			__( 'Content', 'pen' ),
			__( 'Header', 'pen' ),
			__( 'Alignment', 'pen' ),
			__( 'Center', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Content', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_title_alignment[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s &rarr; %3$s &rarr; %4$s',
			__( 'Content', 'pen' ),
			__( 'Title', 'pen' ),
			__( 'Alignment', 'pen' ),
			__( 'Center', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_title_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Content', 'pen' ),
			__( 'Title', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_author_location[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Location', 'pen' ),
			__( 'Author', 'pen' )
		);
		$choices = array(
			'header' => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Header', 'pen' )
			),
			'footer' => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Footer', 'pen' )
			),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_content_author_display[$preset]";
		$label      = __( 'Author', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_date_location[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Location', 'pen' ),
			__( 'Content Date', 'pen' )
		);
		$choices = array(
			'header' => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Header', 'pen' )
			),
			'footer' => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Footer', 'pen' )
			),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_content_date_display[$preset]";
		$label      = __( 'Content Date', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_date_updated_display[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Content Date', 'pen' ),
			__( 'Updated', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_category_location[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Location', 'pen' ),
			__( 'Categories', 'pen' )
		);
		$choices = array(
			'header' => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Header', 'pen' )
			),
			'footer' => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Footer', 'pen' )
			),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_content_category_display[$preset]";
		$label      = __( 'Category', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_category_only_first[$preset]";
		$label      = __( 'The First Category Only', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_thumbnail_display[$preset]";
		$label      = __( 'Featured Image', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_thumbnail_alignment[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Alignment', 'pen' ),
			__( 'Featured Image', 'pen' )
		);
		$choices = array(
			'left'   => __( 'Left', 'pen' ),
			'center' => __( 'Center', 'pen' ),
			'right'  => __( 'Right', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_content_thumbnail_resize[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Size', 'pen' ),
			__( 'Featured Image', 'pen' )
		);
		$thumbnail_sizes = array(
			'none' => __( 'None', 'pen' ),
		);
		$thumbnail_sizes = array_merge( $thumbnail_sizes, $variables['options_image_sizes'] );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $thumbnail_sizes, $label );

		$setting_id = "pen_content_thumbnail_rotate[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Featured Image', 'pen' ),
			__( 'Rotate', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_thumbnail_frame[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Featured Image', 'pen' ),
			_x( 'Frame', 'As in photo or picture frame.', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_tags_display[$preset]";
		$label      = __( 'Tags', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_settings_overview_display[$preset]";
		$label      = __( 'Content Settings', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_share_location[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Location', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Button', 'pen' ),
				__( 'Share', 'pen' )
			)
		);
		$choices = array(
			'header'  => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Header', 'pen' )
			),
			'content' => __( 'Content', 'pen' ),
			'footer'  => sprintf(
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Footer', 'pen' )
			),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_content_share_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Button', 'pen' ),
			__( 'Share', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_button_edit_display[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Footer', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Button', 'pen' ),
				__( 'Edit', 'pen' )
			)
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_profile_display[$preset]";
		$label      = __( 'Author Profile', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_author_name_link[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Link', 'pen' ),
			__( "Author's Name", 'pen' )
		);
		$choices = array(
			'none'    => __( 'None', 'pen' ),
			'archive' => __( 'Archive', 'pen' ),
			'website' => __( 'Website', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_content_author_avatar_link[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Link', 'pen' ),
			__( 'Avatar', 'pen' )
		);
		$choices = array(
			'none'    => __( 'None', 'pen' ),
			'archive' => __( 'Archive', 'pen' ),
			'website' => __( 'Website', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_content_author_avatar_style[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Avatar', 'pen' ),
			__( 'Style', 'pen' )
		);
		$choices = array(
			0 => __( 'None', 'pen' ),
		);
		for ( $i = 1; $i <= 10; $i++ ) {
			/* Translators: Just a number. */
			$choices[ $i ] = sprintf( __( 'Style %d', 'pen' ), $i );
		}
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_content_previous_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Button', 'pen' ),
			__( 'Previous', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_next_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Button', 'pen' ),
			__( 'Next', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_previous_text[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Previous', 'pen' ),
			__( 'Wording', 'pen' )
		);
		$choices = array(
			'previous'                 => __( 'Previous', 'pen' ),
			'previous_and_title'       => sprintf(
				/* Translators: Just some words. */
				__( '%1$s & %2$s', 'pen' ),
				__( 'Previous', 'pen' ),
				__( 'Title', 'pen' )
			),
			'date_published'           => __( 'Content Date', 'pen' ),
			'date_published_and_title' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s & %2$s', 'pen' ),
				__( 'Content Date', 'pen' ),
				__( 'Title', 'pen' )
			),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_content_next_text[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Next', 'pen' ),
			__( 'Wording', 'pen' )
		);
		$choices = array(
			'next'                     => __( 'Next', 'pen' ),
			'next_and_title'           => sprintf(
				/* Translators: Just some words. */
				__( '%1$s & %2$s', 'pen' ),
				__( 'Next', 'pen' ),
				__( 'Title', 'pen' )
			),
			'date_published'           => __( 'Content Date', 'pen' ),
			'date_published_and_title' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s & %2$s', 'pen' ),
				__( 'Content Date', 'pen' ),
				__( 'Title', 'pen' )
			),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_content_next_only_similar[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			sprintf(
				/* Translators: Just some words. */
				__( '%1$s/%2$s', 'pen' ),
				__( 'Next', 'pen' ),
				__( 'Previous', 'pen' )
			),
			__( 'Only Similar Content', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_content_next_previous_type[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			sprintf(
				/* Translators: Just some words. */
				__( '%1$s/%2$s', 'pen' ),
				__( 'Next', 'pen' ),
				__( 'Previous', 'pen' )
			),
			__( 'Element', 'pen' )
		);
		$choices = array(
			'button' => __( 'Button', 'pen' ),
			'link'   => __( 'Link', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_content_next_previous_icon[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			sprintf(
				/* Translators: Just some words. */
				__( '%1$s/%2$s', 'pen' ),
				__( 'Next', 'pen' ),
				__( 'Previous', 'pen' )
			),
			__( 'Icon', 'pen' )
		);
		$choices = array(
			'none'         => __( 'None', 'pen' ),
			'arrow'        => __( 'Arrow', 'pen' ),
			'arrow_double' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				__( 'Arrow', 'pen' ),
				__( 'Double', 'pen' )
			),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

	}
}

if ( ! function_exists( 'pen_customize_loading_spinner' ) ) {
	/**
	 * Adds "Loading..." splash screen options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param array                $variables    Common variables.
	 *
	 * @since Pen 1.3.0
	 * @return void
	 */
	function pen_customize_loading_spinner( &$wp_customize, $variables ) {

		$preset = 'preset_1';

		$section = 'pen_section_loading_spinner';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => sprintf(
					/* Translators: Just some words. */
					__( '"%s" Screen', 'pen' ),
					__( 'Loading...', 'pen' )
				),
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,colors_loading_spinner' => __( 'Colors', 'pen' ),
						)
					)
				),
				'priority'    => 8,
			)
		);

		$setting_id = "pen_loading_spinner_display[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '"%s" Screen', 'pen' ),
			__( 'Loading...', 'pen' )
		);
		$description = __( 'Disable it for better SEO.', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_loading_spinner_style[$preset]";
		$label      = __( 'Style', 'pen' );
		$choices    = array(
			'none' => __( 'None', 'pen' ),
		);
		for ( $i = 1; $i <= 4; $i++ ) {
			/* Translators: Just a number. */
			$choices[ $i ] = sprintf( __( 'Style %d', 'pen' ), $i );
		}
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_loading_spinner_text[$preset]";
		$label      = __( 'Text', 'pen' );
		$choices    = array(
			'loading'     => __( 'Loading...', 'pen' ),
			'please_wait' => __( 'Please wait...', 'pen' ),
			'site_title'  => sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				__( 'Site Title', 'pen' ),
				get_bloginfo( 'name', 'display' )
			),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

	}
}

if ( ! function_exists( 'pen_customize_site_layout' ) ) {
	/**
	 * Adds "Site layout" options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param array                $variables    Common variables.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_customize_site_layout( &$wp_customize, $variables ) {

		$preset = 'preset_1';

		$panel = 'pen_panel_content';

		$section = 'pen_section_layout';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'Site Layout', 'pen' ),
				'panel' => $panel,
			)
		);

		$setting_id = "pen_site_width[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Page', 'pen' ),
			__( 'Width', 'pen' )
		);
		$choices = array(
			'boxed'    => __( 'Boxed', 'pen' ),
			'narrow'   => __( 'Narrow', 'pen' ),
			'standard' => __( 'Standard', 'pen' ),
			'wide'     => __( 'Wide', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_container_position[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Alignment', 'pen' ),
			__( 'Content Area', 'pen' )
		);
		$description = __( 'Does not apply to the Narrow layout and small screens.', 'pen' );
		$choices     = array(
			'left'   => __( 'Left', 'pen' ),
			'center' => __( 'Center', 'pen' ),
			'right'  => __( 'Right', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'postMessage', $choices, $label, $description );

		$setting_id = "pen_sidebar_left_width[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Width', 'pen' ),
			__( 'Left Sidebar', 'pen' )
		);
		$description = __( 'Does not apply to the Narrow layout and small screens.', 'pen' );
		$choices     = array(
			'10%' => '10%',
			'20%' => '20%',
			'25%' => '25%',
			'30%' => '30%',
			'40%' => '40%',
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'postMessage', $choices, $label, $description );

		$setting_id = "pen_sidebar_right_width[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Width', 'pen' ),
			__( 'Right Sidebar', 'pen' )
		);
		$description = __( 'Does not apply to the Narrow layout and small screens.', 'pen' );
		$choices     = array(
			'10%' => '10%',
			'20%' => '20%',
			'25%' => '25%',
			'30%' => '30%',
			'40%' => '40%',
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'postMessage', $choices, $label, $description );

		$setting_id = "pen_sidebar_left_sticky[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Sticky', 'pen' ),
			__( 'Left Sidebar', 'pen' )
		);
		$description = __( 'Does not apply to the Narrow layout and small screens.', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_sidebar_right_sticky[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Sticky', 'pen' ),
			__( 'Right Sidebar', 'pen' )
		);
		$description = __( 'Does not apply to the Narrow layout and small screens.', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_round_corners[$preset]";
		$label      = __( 'Round Corners', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

	}
}

if ( ! function_exists( 'pen_customize_front' ) ) {
	/**
	 * "Front page" options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param array                $variables    Common variables.
	 *
	 * @since Pen 1.0.2
	 * @return void
	 */
	function pen_customize_front( &$wp_customize, $variables ) {

		$preset = 'preset_1';

		$panel = 'pen_panel_front';
		$wp_customize->add_panel(
			$panel,
			array(
				'title'    => __( 'Front Page', 'pen' ),
				'priority' => 5,
			)
		);

		$wp_customize->get_section( 'static_front_page' )->panel = $panel;
		$wp_customize->get_section( 'static_front_page' )->title = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Front Page', 'pen' ),
			__( 'Content', 'pen' )
		);
		$section = 'pen_section_front_sidebars';
		$wp_customize->add_section(
			$section,
			array(
				'title' => sprintf(
					'%1$s &rarr; %2$s',
					__( 'Front Page', 'pen' ),
					__( 'Sidebars', 'pen' )
				),
				'panel' => $panel,
			)
		);

		$widget_areas = array(
			'header_primary'     => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Hide', 'pen' ),
				sprintf(
					'%s - %s',
					__( 'Header', 'pen' ),
					__( 'Primary', 'pen' )
				)
			),
			'header_secondary'   => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Hide', 'pen' ),
				sprintf(
					'%s - %s',
					__( 'Header', 'pen' ),
					__( 'Secondary', 'pen' )
				)
			),
			'search_top'         => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Hide', 'pen' ),
				sprintf(
					'%s - %s',
					__( 'Search', 'pen' ),
					__( 'Top', 'pen' )
				)
			),
			'search_left'        => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Hide', 'pen' ),
				sprintf(
					'%s - %s',
					__( 'Search', 'pen' ),
					__( 'Left', 'pen' )
				)
			),
			'search_right'       => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Hide', 'pen' ),
				sprintf(
					'%s - %s',
					__( 'Search', 'pen' ),
					__( 'Right', 'pen' )
				)
			),
			'search_bottom'      => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Hide', 'pen' ),
				sprintf(
					'%s - %s',
					__( 'Search', 'pen' ),
					__( 'Bottom', 'pen' )
				)
			),
			'top'                => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Hide', 'pen' ),
				__( 'Top', 'pen' )
			),
			'left'               => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Hide', 'pen' ),
				__( 'Left Sidebar', 'pen' )
			),
			'right'              => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Hide', 'pen' ),
				__( 'Right Sidebar', 'pen' )
			),
			'content_top'        => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Hide', 'pen' ),
				sprintf(
					'%s - %s',
					__( 'Content', 'pen' ),
					__( 'Top', 'pen' )
				)
			),
			'content_bottom'     => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Hide', 'pen' ),
				sprintf(
					'%s - %s',
					__( 'Content', 'pen' ),
					__( 'Bottom', 'pen' )
				)
			),
			'bottom'             => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Hide', 'pen' ),
				__( 'Bottom', 'pen' )
			),
			'footer_top'         => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Hide', 'pen' ),
				sprintf(
					'%s - %s',
					__( 'Footer', 'pen' ),
					__( 'Top', 'pen' )
				)
			),
			'footer_left'        => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Hide', 'pen' ),
				sprintf(
					'%s - %s',
					__( 'Footer', 'pen' ),
					__( 'Left', 'pen' )
				)
			),
			'footer_right'       => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Hide', 'pen' ),
				sprintf(
					'%s - %s',
					__( 'Footer', 'pen' ),
					__( 'Right', 'pen' )
				)
			),
			'footer_bottom'      => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Hide', 'pen' ),
				sprintf(
					'%s - %s',
					__( 'Footer', 'pen' ),
					__( 'Bottom', 'pen' )
				)
			),
			'mobile_menu_top'    => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Hide', 'pen' ),
				sprintf(
					'%s - %s',
					__( 'Mobile Menu', 'pen' ),
					__( 'Top', 'pen' )
				)
			),
			'mobile_menu_bottom' => sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Hide', 'pen' ),
				sprintf(
					'%s - %s',
					__( 'Mobile Menu', 'pen' ),
					__( 'Bottom', 'pen' )
				)
			),
		);

		foreach ( $widget_areas as $id => $label ) {
			$setting_id = "pen_front_sidebar_{$id}_display[$preset]";
			pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );
		}

	}
}

if ( ! function_exists( 'pen_customize_footer' ) ) {
	/**
	 * Adds footer options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param array                $variables    Common variables.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_customize_footer( &$wp_customize, $variables ) {

		$preset = 'preset_1';

		$section = 'pen_section_footer';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Footer', 'pen' ),
				'priority'    => 6,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,animation_footer' => __( 'Animation', 'pen' ),
							'section,colors_footer'    => __( 'Colors', 'pen' ),
							'panel,contact'            => __( 'Contact Information', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_site_footer_display[$preset]";
		$label      = __( 'Site Footer', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_footer_alignment[$preset]";
		$label      = __( 'Alignment', 'pen' );
		$choices    = array(
			'left'   => __( 'Left', 'pen' ),
			'center' => __( 'Center', 'pen' ),
			'right'  => __( 'Right', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'postMessage', $choices, $label );

		$setting_id = "pen_footer_menu_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Footer', 'pen' ),
			__( 'Menu', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'postMessage', $label );

		$setting_id = "pen_footer_menu_separator[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Separators', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Footer', 'pen' ),
				__( 'Menu', 'pen' )
			)
		);
		$choices = array(
			0 => __( 'None', 'pen' ),
		);
		for ( $i = 1; $i <= 10; $i++ ) {
			/* Translators: Just a number. */
			$choices[ $i ] = sprintf( __( 'Style %d', 'pen' ), $i );
		}
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_footer_back_to_top_display[$preset]";
		$label      = sprintf(
			'"%s"',
			__( 'Back to top', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_footer_copyright_display[$preset]";
		$label      = __( 'Copyright', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'postMessage', $label );

		$setting_id  = "pen_footer_copyright_text[$preset]";
		$label       = __( 'Copyright Notice', 'pen' );
		$description = sprintf(
			'%s<br>%s',
			__( 'Available Tokens:', 'pen' ),
			sprintf(
				'<ul><li>%s</li><li>%s</li><li>%s</li></ul>%s',
				sprintf(
					/* Translators: a token, i.e. %YEAR%. */
					__( '%1$s: %2$s', 'pen' ),
					__( 'Year', 'pen' ),
					'<strong>%YEAR%</strong>'
				),
				sprintf(
					/* Translators: 1: a token, i.e. %SITE_NAME%, 2: some words, 3: path to the settings page. */
					__( '%1$s for %2$s (%3$s)', 'pen' ),
					'<strong>%SITE_NAME%</strong>',
					__( 'Site Title', 'pen' ),
					sprintf(
						'%1$s%2$s &rarr; %3$s%4$s',
						sprintf(
							'<a href="%s" class="pen_customizer_shortcut" data-type="section" data-target="title_tagline">',
							esc_url(
								add_query_arg(
									array(
										'autofocus[section]' => 'title_tagline',
									),
									$variables['url_customize']
								)
							)
						),
						__( 'Customize', 'pen' ),
						__( 'Site Identity', 'pen' ),
						'</a>'
					)
				),
				sprintf(
					/* Translators: 1: a token, i.e. %SITE_URL%, 2: some words, 3: path to the settings page. */
					__( '%1$s for %2$s (%3$s)', 'pen' ),
					'<strong>%SITE_URL%</strong>',
					__( 'Site URL', 'pen' ),
					sprintf(
						'%1$s &rarr; %2$s',
						__( 'Settings', 'pen' ),
						__( 'General', 'pen' )
					)
				),
				sprintf(
					'<strong>%1$s</strong>%2$s',
					sprintf(
						/* Translators: Just some words. */
						__( '%s:', 'pen' ),
						__( 'Examples', 'pen' )
					),
					sprintf(
						'<br><ul><li><small>%1$s</small></li><li><small>%2$s</small></li><li><small>%3$s</small></li></ul>',
						sprintf(
							'&amp;copy; %%YEAR%% %1$s %%SITE_NAME%%. %2$s',
							/* Translators: "by" as in copyright notice, e.g. Copyright 2019 by Lorem Ipsum. All rights reserved. */
							__( 'by', 'pen' ),
							__( 'All rights reserved.', 'pen' )
						),
						sprintf(
							'&amp;copy; %%YEAR%% %1$s &lt;a href="%%SITE_URL%%"&gt;%%SITE_NAME%%&lt;/a&gt;. %2$s.',
							/* Translators: "by" as in copyright notice, e.g. Copyright 2019 by Lorem Ipsum. All rights reserved. */
							__( 'by', 'pen' ),
							__( 'All rights reserved.', 'pen' )
						),
						__( '(Supports limited HTML)', 'pen' )
					)
				)
			)
		);
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );
	}
}

if ( ! function_exists( 'pen_customize_animation' ) ) {
	/**
	 * Adds animation options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param array                $variables    Common variables.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_customize_animation( &$wp_customize, $variables ) {

		$preset = 'preset_1';

		$panel = 'pen_panel_animation';
		$wp_customize->add_panel(
			$panel,
			array(
				'title'    => __( 'Animation', 'pen' ),
				'priority' => 1,
			)
		);

		$section = 'pen_section_animation_header';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Header', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,header_image'      => __( 'Background Image', 'pen' ),
							'section,colors_header'     => __( 'Colors', 'pen' ),
							'panel,header'              => __( 'General', 'pen' ),
							'section,title_tagline'     => sprintf(
								/* Translators: Just some words. */
								__( '%1$s & %2$s', 'pen' ),
								__( 'Logo', 'pen' ),
								__( 'Site Title', 'pen' )
							),
							'section,typography_header' => __( 'Typography', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_header_animation_reveal[$preset]";
		$label      = __( 'Header', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_header_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_header_logo_animation_reveal[$preset]";
		$label      = __( 'Logo', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_header_logo_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Logo', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_header_sitetitle_animation_reveal[$preset]";
		$label      = __( 'Site Title', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_header_sitetitle_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Site Title', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_header_sitedescription_animation_reveal[$preset]";
		$label      = __( 'Site Description', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_header_sitedescription_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Site Description', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_phone_header_animation_reveal[$preset]";
		$label      = __( 'Phone', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_phone_header_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Phone', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_social_header_animation_reveal[$preset]";
		$label      = __( 'Social Media', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_social_header_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Social Media', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_search_header_animation_reveal[$preset]";
		$label      = __( 'Search Box', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_search_header_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: 1 and 2: Just some text. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Search Box', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_button_users_header_animation_reveal[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Button', 'pen' ),
			__( 'Registration', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_button_users_header_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Button', 'pen' ),
				__( 'Registration', 'pen' )
			)
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		if ( PEN_THEME_HAS_WOOCOMMERCE ) {
			$setting_id = "pen_cart_header_animation_reveal[$preset]";
			$label      = sprintf(
				/* Translators: Just some words. */
				__( '%1$s (%2$s)', 'pen' ),
				sprintf(
					'%1$s &rarr; %2$s',
					__( 'Button', 'pen' ),
					__( 'Cart', 'pen' )
				),
				__( 'Header', 'pen' )
			);
			pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

			$setting_id = "pen_cart_header_animation_delay_reveal[$preset]";
			$label      = sprintf(
				/* Translators: 1, 2, and 3: Just some text. */
				__( '%1$s: %2$s (%3$s)', 'pen' ),
				__( 'Delay', 'pen' ),
				sprintf(
					'%1$s &rarr; %2$s',
					__( 'Button', 'pen' ),
					__( 'Cart', 'pen' )
				),
				__( 'Header', 'pen' )
			);
			pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );
		}

		$section = 'pen_section_animation_navigation';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Navigation', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,background_image_navigation' => __( 'Background Image', 'pen' ),
							'section,colors_navigation' => __( 'Colors', 'pen' ),
							'section,header_navigation' => __( 'General', 'pen' ),
							'panel,nav_menus'           => __( 'Menu', 'pen' ),
							'section,typography_navigation' => __( 'Typography', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_navigation_bar_animation_reveal[$preset]";
		$label      = __( 'Navigation Bar', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_navigation_bar_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Navigation Bar', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_navigation_animation_reveal[$preset]";
		$label      = __( 'Main Menu', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_navigation_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Main Menu', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_navigation_easing[$preset]";
		$label      = __( 'Sub-menus', 'pen' );
		$choices    = array(
			''              => __( 'None', 'pen' ),
			'easeInBack'    => 'easeInBack',
			'easeInBounce'  => 'easeInBounce',
			'easeInCirc'    => 'easeInCirc',
			'easeInCubic'   => 'easeInCubic',
			'easeInElastic' => 'easeInElastic',
			'easeInExpo'    => 'easeInExpo',
			'easeInQuad'    => 'easeInQuad',
			'easeInQuart'   => 'easeInQuart',
			'easeInQuint'   => 'easeInQuint',
			'easeInSine'    => 'easeInSine',
			'swing'         => 'swing',
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_navigation_animation_speed[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Sub-menus', 'pen' ),
			__( 'Speed', 'pen' )
		);
		$choices    = array(
			2000 => __( 'Very Slow', 'pen' ),
			1000 => __( 'Slow', 'pen' ),
			500  => __( 'Normal', 'pen' ),
			250  => __( 'Fast', 'pen' ),
			100  => __( 'Very Fast', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$section = 'pen_section_animation_search';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Search Bar', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><hr><strong>%s</strong><br>%s<hr>',
					sprintf(
						'<a href="%s" class="pen_customizer_shortcut" data-type="%s" data-target="%s">%s</a>',
						esc_url(
							add_query_arg(
								array(
									'autofocus[section]' => 'pen_section_header_search',
								),
								$variables['url_customize']
							)
						),
						'section',
						'pen_section_header_search',
						__( 'Please make sure the Search Box Location is set to Content Area before making any changes here.', 'pen' )
					),
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,background_image_search' => __( 'Background Image', 'pen' ),
							'section,colors_search' => __( 'Colors', 'pen' ),
							'section,header_search' => __( 'General', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_search_bar_animation_reveal[$preset]";
		$label      = __( 'Search Bar', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_search_bar_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Search Bar', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$section = 'pen_section_animation_list';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'List View', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,colors_list' => __( 'Colors', 'pen' ),
							'section,list'        => __( 'General', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_list_page_header_animation_reveal[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Page', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_list_page_header_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Page', 'pen' ),
				__( 'Header', 'pen' )
			)
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_list_animation_reveal[$preset]";
		$label      = __( 'List View', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_list_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'List View', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_list_title_animation_reveal[$preset]";
		$label      = __( 'Title', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_list_title_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Title', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_list_author_animation_reveal[$preset]";
		$label      = __( 'Author Profile', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_list_author_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Author Profile', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_list_thumbnail_animation_reveal[$preset]";
		$label      = __( 'Featured Image', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_list_thumbnail_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Featured Image', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_list_pager_animation_reveal[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Button', 'pen' ),
			__( 'Pagination', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_list_pager_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Button', 'pen' ),
				__( 'Pagination', 'pen' )
			)
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$section = 'pen_section_animation_content';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Full Content View', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,colors_content' => __( 'Colors', 'pen' ),
							'section,content'        => __( 'General', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_content_animation_reveal[$preset]";
		$label      = __( 'Content Area', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_content_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Content Area', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_content_title_animation_reveal[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Content', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_content_title_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_content_thumbnail_animation_reveal[$preset]";
		$label      = __( 'Featured Image', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_content_thumbnail_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Featured Image', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_content_author_animation_reveal[$preset]";
		$label      = __( 'Author Profile', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_content_author_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Author Profile', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_content_next_previous_animation_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Content', 'pen' ),
			sprintf(
				/* Translators: Just some words. */
				__( '%1$s/%2$s', 'pen' ),
				__( 'Next', 'pen' ),
				__( 'Previous', 'pen' )
			)
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_content_next_previous_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Content', 'pen' ),
			sprintf(
				/* Translators: Just some words. */
				__( '%1$s/%2$s', 'pen' ),
				__( 'Next', 'pen' ),
				__( 'Previous', 'pen' )
			)
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_content_previous_animation_reveal[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Button', 'pen' ),
			__( 'Previous', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_content_previous_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Button', 'pen' ),
				__( 'Previous', 'pen' )
			)
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_content_next_animation_reveal[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Button', 'pen' ),
			__( 'Next', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_content_next_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Button', 'pen' ),
				__( 'Next', 'pen' )
			)
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_content_pager_animation_reveal[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Button', 'pen' ),
			__( 'Pagination', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_content_pager_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Button', 'pen' ),
				__( 'Pagination', 'pen' )
			)
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_comments_animation_reveal[$preset]";
		$label      = __( 'Comments', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_comments_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Comments', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$section = 'pen_section_animation_footer';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Footer', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,background_image_footer' => __( 'Background Image', 'pen' ),
							'section,colors_footer'     => __( 'Colors', 'pen' ),
							'panel,contact'             => __( 'Contact Information', 'pen' ),
							'section,footer'            => __( 'General', 'pen' ),
							'section,typography_footer' => __( 'Typography', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_footer_animation_reveal[$preset]";
		$label      = __( 'Footer', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_footer_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_footer_menu_animation_reveal[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Footer', 'pen' ),
			__( 'Menu', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_footer_menu_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Footer', 'pen' ),
				__( 'Menu', 'pen' )
			)
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_social_footer_animation_reveal[$preset]";
		$label      = __( 'Social Media', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_social_footer_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Social Media', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		$setting_id = "pen_phone_footer_animation_reveal[$preset]";
		$label      = __( 'Phone', 'pen' );
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

		$setting_id = "pen_phone_footer_animation_delay_reveal[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Delay', 'pen' ),
			__( 'Phone', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );

		/**
		 * Widget Areas.
		 */
		$section = 'pen_section_animation_widget_areas';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Widget Areas', 'pen' ),
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'panel,widgets' => __( 'General', 'pen' ),
						)
					)
				),
			)
		);

		$widget_areas = array(
			'header_primary'     => sprintf(
				/* Translators: Widget area, e.g. "Header - Primary" Widget Area . */
				'%1$s &rarr; %2$s',
				__( 'Header', 'pen' ),
				__( 'Primary', 'pen' )
			),
			'header_secondary'   => sprintf(
				/* Translators: Widget area, e.g. "Header - Primary" Widget Area . */
				'%1$s &rarr; %2$s',
				__( 'Header', 'pen' ),
				__( 'Secondary', 'pen' )
			),
			'search_top'         => sprintf(
				/* Translators: Widget area, e.g. "Header - Primary" Widget Area . */
				'%1$s &rarr; %2$s',
				__( 'Search', 'pen' ),
				__( 'Top', 'pen' )
			),
			'search_left'        => sprintf(
				/* Translators: Widget area, e.g. "Header - Primary" Widget Area . */
				'%1$s &rarr; %2$s',
				__( 'Search', 'pen' ),
				__( 'Left', 'pen' )
			),
			'search_right'       => sprintf(
				/* Translators: Widget area, e.g. "Header - Primary" Widget Area . */
				'%1$s &rarr; %2$s',
				__( 'Search', 'pen' ),
				__( 'Right', 'pen' )
			),
			'search_bottom'      => sprintf(
				/* Translators: Widget area, e.g. "Header - Primary" Widget Area . */
				'%1$s &rarr; %2$s',
				__( 'Search', 'pen' ),
				__( 'Bottom', 'pen' )
			),
			'top'                => sprintf(
				/* Translators: Widget area, e.g. "Header - Primary" Widget Area . */
				__( '"%s" Widget Area', 'pen' ),
				__( 'Top', 'pen' )
			),
			'left'               => __( 'Left Sidebar', 'pen' ),
			'right'              => __( 'Right Sidebar', 'pen' ),
			'content_top'        => sprintf(
				/* Translators: Widget area, e.g. "Header - Primary" Widget Area . */
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Top', 'pen' )
			),
			'content_bottom'     => sprintf(
				/* Translators: Widget area, e.g. "Header - Primary" Widget Area . */
				'%1$s &rarr; %2$s',
				__( 'Content', 'pen' ),
				__( 'Bottom', 'pen' )
			),
			'bottom'             => sprintf(
				/* Translators: Widget area, e.g. "Bottom" Widget Area . */
				__( '"%s" Widget Area', 'pen' ),
				__( 'Bottom', 'pen' )
			),
			'footer_top'         => sprintf(
				/* Translators: Widget area, e.g. "Header - Primary" Widget Area . */
				'%1$s &rarr; %2$s',
				__( 'Footer', 'pen' ),
				__( 'Top', 'pen' )
			),
			'footer_left'        => sprintf(
				/* Translators: Widget area, e.g. "Header - Primary" Widget Area . */
				'%1$s &rarr; %2$s',
				__( 'Footer', 'pen' ),
				__( 'Left', 'pen' )
			),
			'footer_right'       => sprintf(
				/* Translators: Widget area, e.g. "Header - Primary" Widget Area . */
				'%1$s &rarr; %2$s',
				__( 'Footer', 'pen' ),
				__( 'Right', 'pen' )
			),
			'footer_bottom'      => sprintf(
				/* Translators: Widget area, e.g. "Header - Primary" Widget Area . */
				'%1$s &rarr; %2$s',
				__( 'Footer', 'pen' ),
				__( 'Bottom', 'pen' )
			),
			'mobile_menu_top'    => sprintf(
				/* Translators: Widget area, e.g. "Header - Primary" Widget Area . */
				'%1$s &rarr; %2$s',
				__( 'Mobile Menu', 'pen' ),
				__( 'Top', 'pen' )
			),
			'mobile_menu_bottom' => sprintf(
				/* Translators: Widget area, e.g. "Header - Primary" Widget Area . */
				'%1$s &rarr; %2$s',
				__( 'Mobile Menu', 'pen' ),
				__( 'Bottom', 'pen' )
			),
		);

		foreach ( $widget_areas as $id => $label ) {
			$setting_id = "pen_sidebar_{$id}_animation_reveal[$preset]";
			pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation'], $label );

			$setting_id = "pen_sidebar_{$id}_animation_delay_reveal[$preset]";
			$label      = sprintf(
				/* Translators: Just some words. */
				__( '%1$s: %2$s', 'pen' ),
				__( 'Delay', 'pen' ),
				$label
			);
			pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $variables['options_animation_delay'], $label );
		}

	}
}

if ( ! function_exists( 'pen_customize_contact' ) ) {
	/**
	 * Adds contact details options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param array                $variables    Common variables.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_customize_contact( &$wp_customize, $variables ) {

		$preset = 'preset_1';

		$panel = 'pen_panel_contact';
		$wp_customize->add_panel(
			$panel,
			array(
				'title'       => __( 'Contact Information', 'pen' ),
				'priority'    => 7,
				'description' => sprintf(
					'%s<br>%s<hr><strong>%s</strong><br>%s<hr>',
					__( 'Separate multiple values by a vertical line.', 'pen' ),
					sprintf(
						/* Translators: Just some words. */
						__( '%1$s: %2$s', 'pen' ),
						__( 'Examples', 'pen' ),
						'john@example.com<br>john@example.com<span style="color:red;font-weight:bold">|</span>jane@example.com'
					),
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,typography_contact' => __( 'Typography', 'pen' ),
						)
					)
				),
			)
		);

		$section = 'pen_section_twitter';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'Twitter', 'pen' ),
				'panel' => $panel,
			)
		);

		$setting_id  = "pen_twitter[$preset]";
		$label       = __( 'URL', 'pen' );
		$description = 'https://twitter.com/example';
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_twitter_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Twitter', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_twitter_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Twitter', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$section = 'pen_section_facebook';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'Facebook', 'pen' ),
				'panel' => $panel,
			)
		);

		$setting_id  = "pen_facebook[$preset]";
		$label       = __( 'URL', 'pen' );
		$description = 'https://facebook.com/example';
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_facebook_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Facebook', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_facebook_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Facebook', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$section = 'pen_section_instagram';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'Instagram', 'pen' ),
				'panel' => $panel,
			)
		);

		$setting_id  = "pen_instagram[$preset]";
		$label       = __( 'URL', 'pen' );
		$description = 'https://instagram.com/example';
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_instagram_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Instagram', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_instagram_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Instagram', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$section = 'pen_section_phone';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'Phone', 'pen' ),
				'panel' => $panel,
			)
		);

		$setting_id = "pen_phone[$preset]";
		$label      = __( 'Phone', 'pen' );
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_phone_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Phone', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_phone_header_label_display[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Text', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$choices_phone_labels = array(
			'call_me'              => __( 'Call me:', 'pen' ),
			'call_now'             => __( 'Call Now:', 'pen' ),
			'call_us'              => __( 'Call us:', 'pen' ),
			'direct_line'          => __( 'Direct Line:', 'pen' ),
			'fax'                  => __( 'Fax:', 'pen' ),
			'facsimile'            => __( 'Facsimile:', 'pen' ),
			'for_more_information' => __( 'For more information:', 'pen' ),
			'give_me_a_call'       => __( 'Give me a call:', 'pen' ),
			'give_us_a_call'       => __( 'Give us a call:', 'pen' ),
			'lets_talk'            => __( "Let's talk!", 'pen' ),
			'phone'                => sprintf(
				/* Translators: Just some words. */
				__( '%s:', 'pen' ),
				__( 'Phone', 'pen' )
			),
			'phone_number'         => __( 'Phone Number:', 'pen' ),
			'talk_to_an_expert'    => __( 'Talk to an expert:', 'pen' ),
			'talk_to_an_operator'  => __( 'Talk to an operator:', 'pen' ),
			'tel'                  => __( 'Tel:', 'pen' ),
			'telephone'            => __( 'Telephone:', 'pen' ),
			'toll_free'            => __( 'Toll Free:', 'pen' ),
		);

		$setting_id = "pen_phone_header_label_text[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Text', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices_phone_labels, $label );

		$setting_id = "pen_phone_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Phone', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_phone_footer_label_display[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Text', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_phone_footer_label_text[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Text', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices_phone_labels, $label );

		$setting_id = "pen_phone_secondary[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Phone', 'pen' ),
			__( 'Secondary', 'pen' )
		);
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label );

		$section = 'pen_section_whatsapp';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'WhatsApp', 'pen' ),
				'panel' => $panel,
			)
		);

		$setting_id  = "pen_whatsapp[$preset]";
		$label       = __( 'URL', 'pen' );
		$description = 'whatsapp://send?text=Hi!&phone=+123456789';
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_whatsapp_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'WhatsApp', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_whatsapp_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'WhatsApp', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$section = 'pen_section_linkedin';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'LinkedIn', 'pen' ),
				'panel' => $panel,
			)
		);

		$setting_id  = "pen_linkedin[$preset]";
		$label       = __( 'URL', 'pen' );
		$description = 'https://linkedin.com/example';
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_linkedin_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'LinkedIn', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_linkedin_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'LinkedIn', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$section = 'pen_section_pinterest';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'Pinterest', 'pen' ),
				'panel' => $panel,
			)
		);

		$setting_id  = "pen_pinterest[$preset]";
		$label       = __( 'URL', 'pen' );
		$description = 'https://pinterest.com/example';
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_pinterest_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Pinterest', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_pinterest_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Pinterest', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$section = 'pen_section_flickr';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'Flickr', 'pen' ),
				'panel' => 'pen_panel_contact',
			)
		);

		$setting_id  = "pen_flickr[$preset]";
		$label       = __( 'URL', 'pen' );
		$description = 'https://flickr.com/example';
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_flickr_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Flickr', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_flickr_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Flickr', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$section = 'pen_section_bitbucket';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'Bitbucket', 'pen' ),
				'panel' => 'pen_panel_contact',
			)
		);

		$setting_id  = "pen_bitbucket[$preset]";
		$label       = __( 'URL', 'pen' );
		$description = 'https://bitbucket.org/example';
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_bitbucket_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Bitbucket', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_bitbucket_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Bitbucket', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$section = 'pen_section_github';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'GitHub', 'pen' ),
				'panel' => 'pen_panel_contact',
			)
		);

		$setting_id  = "pen_github[$preset]";
		$label       = __( 'URL', 'pen' );
		$description = 'https://github.com/example';
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_github_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'GitHub', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_github_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'GitHub', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$section = 'pen_section_skype';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'Skype', 'pen' ),
				'panel' => $panel,
			)
		);

		$setting_id  = "pen_skype[$preset]";
		$label       = __( 'URL', 'pen' );
		$description = 'skype:username?call';
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_skype_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Skype', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_skype_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Skype', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$section = 'pen_section_slack';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'Slack', 'pen' ),
				'panel' => $panel,
			)
		);

		$setting_id  = "pen_slack[$preset]";
		$label       = __( 'URL', 'pen' );
		$description = 'https://slack.com/example';
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_slack_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Slack', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_slack_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Slack', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$section = 'pen_section_mewe';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'MeWe', 'pen' ),
				'panel' => $panel,
			)
		);

		$setting_id  = "pen_mewe[$preset]";
		$label       = __( 'URL', 'pen' );
		$description = 'https://www.mewe.com/join/example';
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_mewe_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'MeWe', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_mewe_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'MeWe', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$section = 'pen_section_telegram';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'Telegram', 'pen' ),
				'panel' => $panel,
			)
		);

		$setting_id  = "pen_telegram[$preset]";
		$label       = __( 'URL', 'pen' );
		$description = 'https://t.me/example';
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_telegram_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Telegram', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_telegram_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Telegram', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$section = 'pen_section_vk';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'VK', 'pen' ),
				'panel' => $panel,
			)
		);

		$setting_id  = "pen_vk[$preset]";
		$label       = __( 'URL', 'pen' );
		$description = 'https://vk.com/example';
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_vk_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'VK', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_vk_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'VK', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$section = 'pen_section_shop';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'Shop', 'pen' ),
				'panel' => $panel,
			)
		);

		$setting_id  = "pen_shop[$preset]";
		$label       = __( 'URL', 'pen' );
		$description = 'https://www.example.com/';
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_shop_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Shop', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_shop_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Shop', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$section = 'pen_section_vimeo';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'Vimeo', 'pen' ),
				'panel' => $panel,
			)
		);

		$setting_id  = "pen_vimeo[$preset]";
		$label       = __( 'URL', 'pen' );
		$description = 'https://vimeo.com/channels/123456789';
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_vimeo_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Vimeo', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_vimeo_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Vimeo', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$section = 'pen_section_youtube';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'YouTube', 'pen' ),
				'panel' => $panel,
			)
		);

		$setting_id  = "pen_youtube[$preset]";
		$label       = __( 'URL', 'pen' );
		$description = 'https://youtube.com/wordpress';
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_youtube_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'YouTube', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_youtube_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'YouTube', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$section = 'pen_section_rss';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'Feed', 'pen' ),
				'panel' => $panel,
			)
		);

		$setting_id  = "pen_rss[$preset]";
		$label       = __( 'URL', 'pen' );
		$description = 'http://example.com/rss.xml';
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_rss_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'RSS', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_rss_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'RSS', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$section = 'pen_section_email';
		$wp_customize->add_section(
			$section,
			array(
				'title' => __( 'E-mail', 'pen' ),
				'panel' => $panel,
			)
		);

		$setting_id  = "pen_email[$preset]";
		$label       = __( 'Your e-mail or URL to a "Contact us" page', 'pen' );
		$description = sprintf(
			'%s<br>%s',
			'mail@example.com',
			'http://example.com/contact-us'
		);
		pen_control_text( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id = "pen_email_header_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'E-mail', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_email_footer_display[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'E-mail', 'pen' ),
			__( 'Footer', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

	}
}

if ( ! function_exists( 'pen_customize_background' ) ) {
	/**
	 * Adds the background image options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param array                $variables    Common variables.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_customize_background( &$wp_customize, $variables ) {

		$preset = 'preset_1';

		$panel = 'p_panel_background_images';
		$wp_customize->add_panel(
			$panel,
			array(
				'title'    => __( 'Background Images', 'pen' ),
				'priority' => 10,
			)
		);

		$section = 'background_image';

		$wp_customize->get_section( $section )->title       = __( 'Site', 'pen' );
		$wp_customize->get_section( $section )->priority    = 1;
		$wp_customize->get_section( $section )->transport   = 'refresh';
		$wp_customize->get_section( $section )->panel       = $panel;
		$wp_customize->get_section( $section )->description = sprintf(
			'<strong>%s</strong><br>%s<hr>',
			sprintf(
				/* Translators: Just some word. */
				__( '%s:', 'pen' ),
				__( 'More', 'pen' )
			),
			pen_html_jump_menu_items(
				array(
					'section,colors_general'     => __( 'Colors', 'pen' ),
					'panel,content'              => __( 'General', 'pen' ),
					'section,typography_general' => __( 'Typography', 'pen' ),
				)
			)
		);

		$wp_customize->get_control( 'background_image' )->label .= ' ' . sprintf(
			/* Translators: Just some word. */
			__( '(%s)', 'pen' ),
			__( 'Static', 'pen' )
		);
		$setting_id = "pen_background_image_site_dynamic[$preset]";
		$label      = sprintf(
			'[%1$s] %2$s',
			__( 'Pen', 'pen' ),
			__( 'Dynamic Background Image', 'pen' )
		);
		$choices    = array(
			'none'           => __( 'Disabled', 'pen' ),
			'featured_image' => __( 'Featured Image', 'pen' ),
		);
		pen_control_radio( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_background_lights_dim[$preset]";
		$label      = sprintf(
			'[%1$s] %2$s',
			__( 'Pen', 'pen' ),
			__( 'Dim the lights', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$section = 'header_image';

		$wp_customize->get_section( $section )->title       = __( 'Header', 'pen' );
		$wp_customize->get_section( $section )->priority    = 2;
		$wp_customize->get_section( $section )->transport   = 'refresh';
		$wp_customize->get_section( $section )->panel       = $panel;
		$wp_customize->get_section( $section )->description = sprintf(
			'<strong>%s</strong><br>%s<hr>',
			sprintf(
				/* Translators: Just some word. */
				__( '%s:', 'pen' ),
				__( 'More', 'pen' )
			),
			pen_html_jump_menu_items(
				array(
					'section,animation_header'  => __( 'Animation', 'pen' ),
					'section,colors_header'     => __( 'Colors', 'pen' ),
					'panel,header'              => __( 'General', 'pen' ),
					'section,title_tagline'     => sprintf(
						/* Translators: Just some words. */
						__( '%1$s & %2$s', 'pen' ),
						__( 'Logo', 'pen' ),
						__( 'Site Title', 'pen' )
					),
					'section,typography_header' => __( 'Typography', 'pen' ),
				)
			)
		);

		$wp_customize->get_control( 'header_image' )->label .= ' ' . sprintf(
			/* Translators: Just some word. */
			__( '(%s)', 'pen' ),
			__( 'Static', 'pen' )
		);
		$setting_id = "pen_background_image_header_dynamic[$preset]";
		$label      = sprintf(
			'[%1$s] %2$s',
			__( 'Pen', 'pen' ),
			__( 'Dynamic Background Image', 'pen' )
		);
		$choices    = array(
			'none'           => __( 'Disabled', 'pen' ),
			'featured_image' => __( 'Featured Image', 'pen' ),
		);
		pen_control_radio( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$section = 'pen_section_background_image_navigation';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Navigation', 'pen' ),
				'priority'    => 3,
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,animation_navigation' => __( 'Animation', 'pen' ),
							'section,colors_navigation'    => __( 'Colors', 'pen' ),
							'section,header_navigation'    => __( 'General', 'pen' ),
							'section,typography_navigation' => __( 'Typography', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_background_image_navigation[$preset]";
		$label      = sprintf(
			/* Translators: 1: Part of the theme, e.g. navigation. 2: some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Navigation', 'pen' ),
			__( 'Static', 'pen' )
		);
		pen_control_image( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_background_image_navigation_dynamic[$preset]";
		$label      = __( 'Dynamic Background Image', 'pen' );
		$choices    = array(
			'none'           => __( 'Disabled', 'pen' ),
			'featured_image' => __( 'Featured Image', 'pen' ),
		);
		pen_control_radio( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$setting_id = "pen_background_image_navigation_submenu[$preset]";
		$label      = sprintf(
			/* Translators: 1: Part of the theme, e.g. navigation. 2: some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Sub-menus', 'pen' ),
			__( 'Static', 'pen' )
		);
		pen_control_image( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_background_image_navigation_submenu_dynamic[$preset]";
		$label      = __( 'Dynamic Background Image', 'pen' );
		$choices    = array(
			'none'           => __( 'Disabled', 'pen' ),
			'featured_image' => __( 'Featured Image', 'pen' ),
		);
		pen_control_radio( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$section = 'pen_section_background_image_search';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Search Bar', 'pen' ),
				'panel'       => $panel,
				'priority'    => 4,
				'description' => sprintf(
					'<strong>%s</strong><hr><strong>%s</strong><br>%s<hr>',
					sprintf(
						'<a href="%s" class="pen_customizer_shortcut" data-type="%s" data-target="%s">%s</a>',
						esc_url(
							add_query_arg(
								array(
									'autofocus[section]' => 'pen_section_header_search',
								),
								$variables['url_customize']
							)
						),
						'section',
						'pen_section_header_search',
						__( 'Please make sure the Search Box Location is set to Content Area before making any changes here.', 'pen' )
					),
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,animation_search' => __( 'Animation', 'pen' ),
							'section,colors_search'    => __( 'Colors', 'pen' ),
							'section,header_search'    => __( 'General', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_background_image_search[$preset]";
		$label      = sprintf(
			/* Translators: 1: Part of the theme, e.g. navigation. 2: some words. */
			__( '%1$s (%2$s)', 'pen' ),
			__( 'Search Bar', 'pen' ),
			__( 'Static', 'pen' )
		);
		pen_control_image( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_background_image_search_dynamic[$preset]";
		$label      = __( 'Dynamic Background Image', 'pen' );
		$choices    = array(
			'none'           => __( 'Disabled', 'pen' ),
			'featured_image' => __( 'Featured Image', 'pen' ),
		);
		pen_control_radio( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$section = 'pen_section_background_image_content_title';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => sprintf(
					'%1$s &rarr; %2$s',
					__( 'Content', 'pen' ),
					__( 'Header', 'pen' )
				),
				'priority'    => 5,
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,animation_content' => __( 'Animation', 'pen' ),
							'section,colors_content'    => __( 'Colors', 'pen' ),
							'section,content'           => __( 'General', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_background_image_content_title[$preset]";
		$label      = sprintf(
			'%1$s &rarr; %2$s',
			__( 'Content', 'pen' ),
			__( 'Header', 'pen' )
		);
		pen_control_image( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_background_image_content_title_dynamic[$preset]";
		$label      = __( 'Dynamic Background Image', 'pen' );
		$choices    = array(
			'none'           => __( 'Disabled', 'pen' ),
			'featured_image' => __( 'Featured Image', 'pen' ),
		);
		pen_control_radio( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$section = 'pen_section_background_image_bottom';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Bottom', 'pen' ),
				'priority'    => 6,
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,animation_widget_areas' => __( 'Animation', 'pen' ),
							'section,colors_bottom' => __( 'Colors', 'pen' ),
							'panel,widgets'         => __( 'General', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_background_image_bottom[$preset]";
		$label      = __( 'Bottom', 'pen' );
		pen_control_image( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_background_image_bottom_dynamic[$preset]";
		$label      = __( 'Dynamic Background Image', 'pen' );
		$choices    = array(
			'none'           => __( 'Disabled', 'pen' ),
			'featured_image' => __( 'Featured Image', 'pen' ),
		);
		pen_control_radio( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

		$section = 'pen_section_background_image_footer';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Footer', 'pen' ),
				'priority'    => 7,
				'panel'       => $panel,
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,animation_footer'  => __( 'Animation', 'pen' ),
							'section,colors_footer'     => __( 'Colors', 'pen' ),
							'section,footer'            => __( 'General', 'pen' ),
							'section,typography_footer' => __( 'Typography', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_background_image_footer[$preset]";
		$label      = __( 'Footer', 'pen' );
		pen_control_image( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_background_image_footer_dynamic[$preset]";
		$label      = __( 'Dynamic Background Image', 'pen' );
		$choices    = array(
			'none'           => __( 'Disabled', 'pen' ),
			'featured_image' => __( 'Featured Image', 'pen' ),
		);
		pen_control_radio( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

	}
}

if ( ! function_exists( 'pen_customize_woocommerce' ) ) {
	/**
	 * Adds WooCommerce options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param array                $variables    Common variables.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_customize_woocommerce( &$wp_customize, $variables ) {

		$preset = 'preset_1';

		$section = 'pen_section_woocommerce_general';
		$wp_customize->add_section(
			$section,
			array(
				'title'       => __( 'Theme Options', 'pen' ),
				'panel'       => 'woocommerce',
				'description' => sprintf(
					'<strong>%s</strong><br>%s<hr>',
					sprintf(
						/* Translators: Just some word. */
						__( '%s:', 'pen' ),
						__( 'More', 'pen' )
					),
					pen_html_jump_menu_items(
						array(
							'section,colors_woocommerce' => __( 'Colors', 'pen' ),
						)
					)
				),
			)
		);

		$setting_id = "pen_cart_products_related_display[$preset]";
		$label      = __( 'Related Products', 'pen' );
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_cart_upsells_per_product[$preset]";
		$label      = sprintf(
			/* Translators: Part of the site, e.g. Number of Related Products. */
			__( 'Number of Related Products', 'pen' )
		);

		$description = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Default', 'pen' ),
			pen_option_default( 'cart_upsells_per_product' )
		);
		pen_control_number( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

		$setting_id   = "pen_cart_upsells_columns[$preset]";
		$label        = __( 'Number of Columns For Related Products', 'pen' );
		$description  = sprintf(
			'%s<br>',
			__( 'This may automatically change to provide the best appearance and user experience.', 'pen' )
		);
		$description .= sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Default', 'pen' ),
			pen_option_default( 'cart_upsells_columns' )
		);
		$choices = array(
			1 => __( 'One', 'pen' ),
			2 => __( 'Two', 'pen' ),
			3 => __( 'Three', 'pen' ),
			4 => __( 'Four', 'pen' ),
			5 => __( 'Five', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label, $description );

		$setting_id  = "pen_content_per_page_products[$preset]";
		$label       = __( 'Products per page', 'pen' );
		$description = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Default', 'pen' ),
			pen_option_default( 'content_per_page_products' )
		);
		$description .= sprintf(
			'<br>%s',
			sprintf(
				/* Translators: 1: opening tag for a hyperlink, e.g. <a href="#">, 2: closing tag for a hyperlink, e.g. </a>. */
				__( 'The %1$sColumns setting%2$s would override this if you are using the Tiles or the jQuery Masonry layout.', 'pen' ),
				sprintf(
					'<a href="%s" class="pen_customizer_shortcut" data-type="section" data-target="pen_section_list">',
					esc_url(
						add_query_arg(
							array(
								'autofocus[section]' => 'pen_section_list',
							),
							$variables['url_customize']
						)
					)
				),
				'</a>'
			)
		);
		pen_control_number( $wp_customize, $setting_id, $section, 'refresh', $label, $description );

	}
}

if ( ! function_exists( 'pen_customize_logo' ) ) {
	/**
	 * Moves logo options to "Site Identity".
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param array                $variables    Common variables.
	 *
	 * @since Pen 1.0.8
	 * @return void
	 */
	function pen_customize_logo( &$wp_customize, $variables ) {

		$preset = 'preset_1';

		$section = 'title_tagline';

		$wp_customize->get_section( $section )->description .= sprintf(
			'<hr><strong>%s</strong><br>%s<hr>',
			sprintf(
				/* Translators: Just some word. */
				__( '%s:', 'pen' ),
				__( 'More', 'pen' )
			),
			pen_html_jump_menu_items(
				array(
					'section,animation_header'  => __( 'Animation', 'pen' ),
					'section,colors_header'     => __( 'Colors', 'pen' ),
					'panel,header'              => __( 'Header', 'pen' ),
					'section,typography_header' => __( 'Typography', 'pen' ),
				)
			)
		);

		$wp_customize->get_setting( 'custom_logo' )->transport = 'refresh';

		$setting_id = "pen_header_logo_light[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s (%2$s)', 'pen' ),
			sprintf(
				'[%1$s] %2$s',
				__( 'Pen', 'pen' ),
				sprintf(
					'%1$s &rarr; %2$s',
					__( 'Logo', 'pen' ),
					__( 'For dark backgrounds', 'pen' )
				)
			),
			__( 'Optional', 'pen' )
		);
		pen_control_image( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_header_logo_display[$preset]";
		$label      = sprintf(
			'[%1$s] %2$s',
			__( 'Pen', 'pen' ),
			__( 'Site Logo', 'pen' )
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_header_logo_size[$preset]";
		$label      = sprintf(
			'[%1$s] %2$s',
			__( 'Pen', 'pen' ),
			__( 'Limit', 'pen' )
		);
		$choices    = array(
			'none'   => __( 'None', 'pen' ),
			'height' => __( 'Vertical', 'pen' ),
			'width'  => __( 'Horizontal', 'pen' ),
		);
		pen_control_select( $wp_customize, $setting_id, $section, 'refresh', $choices, $label );

	}
}

if ( ! function_exists( 'pen_customize_shortcuts' ) ) {
	/**
	 * Adds menu options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param array                $variables    Common variables.
	 *
	 * @since Pen 1.3.4
	 * @return void
	 */
	function pen_customize_shortcuts( &$wp_customize, $variables ) {

		$preset = 'preset_1';

		$panel = 'nav_menus';

		$section = 'pen_shortcut_menus';
		$wp_customize->add_section(
			$section,
			array(
				'title' => sprintf(
					'%1$s &rarr; %2$s',
					__( 'Menu', 'pen' ),
					__( 'Shortcut', 'pen' )
				),
				'panel' => $panel,
			)
		);

		$setting_id = "pen_shortcut_menus_front_display[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Front-end', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Menu', 'pen' ),
				__( 'Shortcut', 'pen' )
			)
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

		$setting_id = "pen_shortcut_menus_back_display[$preset]";
		$label      = sprintf(
			/* Translators: Just some words. */
			__( '%1$s: %2$s', 'pen' ),
			__( 'Back-end', 'pen' ),
			sprintf(
				'%1$s &rarr; %2$s',
				__( 'Menu', 'pen' ),
				__( 'Shortcut', 'pen' )
			)
		);
		pen_control_checkbox( $wp_customize, $setting_id, $section, 'refresh', $label );

	}
}

if ( ! function_exists( 'pen_control_color' ) ) {
	/**
	 * Color control.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param string               $setting_id   The setting ID.
	 * @param string               $section      Field section.
	 * @param string               $transport    Transport type.
	 * @param string               $label        Field label.
	 * @param string               $description  Field description.
	 *
	 * @since Pen 1.0.8
	 * @return void
	 */
	function pen_control_color( &$wp_customize, $setting_id, $section, $transport, $label, $description = '' ) {
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => pen_option_default( $setting_id ),
				'sanitize_callback' => pen_option_sanitize( $setting_id ),
				'transport'         => $transport,
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				$setting_id,
				array(
					'label'       => $label,
					'description' => $description,
					'section'     => $section,
					'settings'    => $setting_id,
				)
			)
		);
	}
}

if ( ! function_exists( 'pen_control_image' ) ) {
	/**
	 * Image control.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param string               $setting_id   The setting ID.
	 * @param string               $section      Field section.
	 * @param string               $transport    Transport type.
	 * @param string               $label        Field label.
	 * @param string               $description  Field description.
	 *
	 * @since Pen 1.0.8
	 * @return void
	 */
	function pen_control_image( &$wp_customize, $setting_id, $section, $transport, $label, $description = '' ) {
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => pen_option_default( $setting_id ),
				'sanitize_callback' => pen_option_sanitize( $setting_id ),
				'transport'         => $transport,
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				$setting_id,
				array(
					'label'       => $label,
					'description' => $description,
					'section'     => $section,
					'settings'    => $setting_id,
				)
			)
		);
	}
}

if ( ! function_exists( 'pen_control_checkbox' ) ) {
	/**
	 * Checkbox control.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param string               $setting_id   The setting ID.
	 * @param string               $section      Field section.
	 * @param string               $transport    Transport type.
	 * @param string               $label        Field label.
	 * @param string               $description  Field description.
	 *
	 * @since Pen 1.0.8
	 * @return void
	 */
	function pen_control_checkbox( &$wp_customize, $setting_id, $section, $transport, $label, $description = '' ) {
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => pen_option_default( $setting_id ),
				'sanitize_callback' => pen_option_sanitize( $setting_id ),
				'transport'         => $transport,
			)
		);
		$wp_customize->add_control(
			$setting_id,
			array(
				'label'       => $label,
				'description' => $description,
				'section'     => $section,
				'type'        => 'checkbox',
			)
		);
	}
}

if ( ! function_exists( 'pen_control_radio' ) ) {
	/**
	 * Radio button control.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param string               $setting_id   The setting ID.
	 * @param string               $section      Field section.
	 * @param string               $transport    Transport type.
	 * @param array                $choices      Choices.
	 * @param string               $label        Field label.
	 * @param string               $description  Field description.
	 *
	 * @since Pen 1.0.8
	 * @return void
	 */
	function pen_control_radio( &$wp_customize, $setting_id, $section, $transport, $choices, $label, $description = '' ) {

		$default = pen_option_default( $setting_id );

		foreach ( $choices as $key => $value ) {
			if ( $key === $default && false === stripos( $value, __( 'Default', 'pen' ) ) ) {
				$choices[ $key ] = esc_html(
					sprintf(
						/* Translators: Just some words. */
						__( '%1$s (%2$s)', 'pen' ),
						$value,
						__( 'Default', 'pen' )
					)
				);
			}
		}

		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $default,
				'sanitize_callback' => pen_option_sanitize( $setting_id ),
				'transport'         => $transport,
			)
		);
		$wp_customize->add_control(
			$setting_id,
			array(
				'label'       => $label,
				'description' => $description,
				'section'     => $section,
				'type'        => 'radio',
				'choices'     => $choices,
			)
		);
	}
}

if ( ! function_exists( 'pen_control_select' ) ) {
	/**
	 * Select control.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param string               $setting_id   The setting ID.
	 * @param string               $section      Field section.
	 * @param string               $transport    Transport type.
	 * @param array                $choices      Choices.
	 * @param string               $label        Field label.
	 * @param string               $description  Field description.
	 *
	 * @since Pen 1.0.8
	 * @return void
	 */
	function pen_control_select( &$wp_customize, $setting_id, $section, $transport, $choices, $label, $description = '' ) {

		$default = pen_option_default( $setting_id );

		foreach ( $choices as $key => $value ) {
			if ( $key === $default && false === stripos( $value, __( 'Default', 'pen' ) ) ) {
				$choices[ $key ] = esc_html(
					sprintf(
						/* Translators: Just some words. */
						__( '%1$s (%2$s)', 'pen' ),
						$value,
						__( 'Default', 'pen' )
					)
				);
			}
		}

		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => $default,
				'sanitize_callback' => pen_option_sanitize( $setting_id ),
				'transport'         => $transport,
			)
		);
		$wp_customize->add_control(
			$setting_id,
			array(
				'label'       => $label,
				'description' => $description,
				'section'     => $section,
				'type'        => 'select',
				'choices'     => $choices,
			)
		);
	}
}

if ( ! function_exists( 'pen_control_text' ) ) {
	/**
	 * Text control.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param string               $setting_id   The setting ID.
	 * @param string               $section      Field section.
	 * @param string               $transport    Transport type.
	 * @param string               $label        Field label.
	 * @param string               $description  Field description.
	 *
	 * @since Pen 1.0.8
	 * @return void
	 */
	function pen_control_text( &$wp_customize, $setting_id, $section, $transport, $label, $description = '' ) {
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => pen_option_default( $setting_id ),
				'sanitize_callback' => pen_option_sanitize( $setting_id ),
				'transport'         => $transport,
			)
		);
		$wp_customize->add_control(
			$setting_id,
			array(
				'label'       => $label,
				'description' => $description,
				'section'     => $section,
				'type'        => 'text',
			)
		);
	}
}

if ( ! function_exists( 'pen_control_number' ) ) {
	/**
	 * Number control.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 * @param string               $setting_id   The setting ID.
	 * @param string               $section      Field section.
	 * @param string               $transport    Transport type.
	 * @param string               $label        Field label.
	 * @param string               $description  Field description.
	 *
	 * @since Pen 1.2.8
	 * @return void
	 */
	function pen_control_number( &$wp_customize, $setting_id, $section, $transport, $label, $description = '' ) {
		$wp_customize->add_setting(
			$setting_id,
			array(
				'default'           => pen_option_default( $setting_id ),
				'sanitize_callback' => pen_option_sanitize( $setting_id ),
				'transport'         => $transport,
			)
		);
		$wp_customize->add_control(
			$setting_id,
			array(
				'label'       => $label,
				'description' => $description,
				'section'     => $section,
				'type'        => 'number',
			)
		);
	}
}

if ( ! function_exists( 'pen_inline_css_general' ) ) {
	/**
	 * Adds inline CSS.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_inline_css_general() {

		$content_id = pen_post_id();

		$css = '';

		$preset_color = pen_preset_get( 'color' );

		$preset_font        = esc_html( pen_preset_get( 'font_family' ) );
		$background         = esc_html( pen_option_get( 'color_site_background' ) );
		$background_default = pen_option_default( 'color_site_background' );
		$text               = esc_html( pen_option_get( 'color_text' ) );
		$text_default       = pen_option_default( 'color_text' );

		$background_dynamic = get_post_meta( $content_id, 'pen_content_background_image_site_dynamic_override', true );
		if ( ! $background_dynamic || 'default' === $background_dynamic ) {
			$background_dynamic = pen_option_get( 'background_image_site_dynamic' );
		}
		$image_dynamic = '';
		if ( 'featured_image' === $background_dynamic && $content_id ) {
			$image_size = 'original';
			if ( PEN_THEME_SMALLSCREEN ) {
				$image_size = 'large';
			}
			$image_dynamic = esc_url( get_the_post_thumbnail_url( null, $image_size ) );
		}

		if ( 'preset_1' !== $preset_color || $background !== $background_default || ( 'none' !== $background_dynamic && $image_dynamic ) || $text !== $text_default ) {
			/**
			 * The background overrides any linear-gradient in the CSS files
			 * and background-color as a fallback for any background-image.
			 */
			$css_normal = 'body {
				background-color:' . $background . ';
				background:' . $background . ';';
			if ( 'none' !== $background_dynamic && $image_dynamic ) {
				$css_normal .= "background-image:url('" . esc_html( $image_dynamic ) . "') !important;
					background-repeat:no-repeat !important;
					background-position:top center !important;
					background-size:cover !important;";
			}
			$css_normal .= '}';

			if ( 'preset_1' !== $preset_color || $text !== $text_default ) {
				$css_normal .= '#page {
					color:' . $text . ';
				}';
			}

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$color_background = new \Pen_Theme\Color( $background );
				if ( $color_background->isLight() ) {
					$background_dark = $color_background->darken( 75 );
					$background_dark = new \Pen_Theme\Color( $background_dark );
					$background_dark = '#' . $background_dark->getHex();
				} else {
					$background_dark = $background;
				}

				$color_text = new \Pen_Theme\Color( $text );
				if ( $color_text->isDark() ) {
					$text_light = $color_text->lighten( 80 );
					$text_light = new \Pen_Theme\Color( $text_light );
					$text_light = '#' . $text_light->getHex();
				} else {
					$text_light = $text;
				}

				$css_dark = 'body.pen_dark_mode {
					background-color:' . $background_dark . ';';
				if ( 'none' !== $background_dynamic && $image_dynamic ) {
					$css_dark .= "background-image:url('" . esc_html( $image_dynamic ) . "') !important;
						background-repeat:no-repeat !important;
						background-position:top center !important;
						background-size:cover !important;";
				}
				$css_dark .= '}
					body.pen_dark_mode #page {
						color:' . $text_light . '
					}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}

			$color_background_dim = new \Pen_Theme\Color( $background );
			if ( $color_background_dim->isDark() ) {
				$color_background_dim = new \Pen_Theme\Color( $color_background_dim->darken( 15 ) );
				$css                 .= 'body.pen_background_lights_dim.pen_has_background_effect:before,
					body.pen_background_lights_dim.pen_has_background_image:before {
						background: rgba(' . implode( ',', $color_background_dim->getRgb() ) . ',0.85) !important;
					}';
			}
		}

		$site_font = esc_html( pen_option_get( 'font_family_site' ) );

		if ( 'g:Roboto' !== $site_font || $text !== $text_default ) {
			$css .= 'body,
				button,
				input,
				select,
				optgroup,
				textarea {
					font-family:"' . ltrim( $site_font, 'g:' ) . '", Arial, Helvetica, Sans-serif !important;
				}';
		}

		$headings_font = esc_html( pen_option_get( 'font_family_headings' ) );
		if ( 'g:Roboto' !== $headings_font ) {
			$css .= 'h1,h2,h3,h4,h5 {
				font-family:"' . ltrim( $headings_font, 'g:' ) . '", Arial, Helvetica, Sans-serif !important;
			}';
		}

		if ( pen_option_get( 'color_site_shadow_display' ) ) {

			$shadow         = esc_html( pen_option_get( 'color_shadow' ) );
			$shadow_default = pen_option_default( 'color_shadow' );

			if ( 'preset_1' !== $preset_color || $shadow !== $shadow_default ) {

				$color_shadow = new \Pen_Theme\Color( $shadow );
				$shadow_rgb   = 'rgba(' . implode( ',', $color_shadow->getRgb() ) . ',0.25)';

				$selector = 'body.pen_drop_shadow #main article.pen_article,
					body.pen_drop_shadow #comments,
					body.pen_drop_shadow #pen_content_next_previous,
					body.pen_drop_shadow.pen_list_plain #pen_pager,
					body.pen_drop_shadow #main .pen_customize_overview.pen_off_screen,
					body.pen_drop_shadow #pen_header.pen_not_transparent .pen_header_inner,
					body.pen_drop_shadow #pen_search,
					body.pen_drop_shadow #page .widget.pen_widget_not_transparent,
					body.pen_drop_shadow #pen_bottom.pen_not_transparent,
					body.pen_drop_shadow #pen_footer.pen_not_transparent';

				if ( PEN_THEME_HAS_WOOCOMMERCE ) {
					$selector .= ',
						body.pen_drop_shadow.pen_has_woocommerce.pen_multiple #main li.pen_article,
						body.pen_drop_shadow.pen_has_woocommerce.pen_list_plain #page .woocommerce-pagination';
				}

				if ( PEN_THEME_DARK_MODE ) {
					$selector .= ',
						body.pen_drop_shadow #pen_dark_mode_toggle';
				}

				$css_normal = $selector . '{
					box-shadow:0 5px 10px ' . $shadow_rgb . ', 0 0 5px ' . $shadow_rgb . ' !important;
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					if ( $color_shadow->isLight() ) {
						$shadow_dark = $color_shadow->darken( 100 );
						$shadow_dark = new \Pen_Theme\Color( $shadow_dark );
						$shadow_dark = 'rgba(' . implode( ',', $shadow_dark->getRgb() ) . ',0.25)';
					} else {
						$shadow_dark = $shadow_rgb;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						box-shadow:0 5px 10px ' . $shadow_dark . ', 0 0 5px ' . $shadow_dark . ' !important;
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}
		}

		$link         = esc_html( pen_option_get( 'color_link' ) );
		$link_default = pen_option_default( 'color_link' );

		if ( 'preset_1' !== $preset_color || $link !== $link_default ) {

			$css_normal = 'a {
				color:' . $link . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$color_link = new \Pen_Theme\Color( $link );
				if ( $color_link->isDark() ) {
					$link_light = $color_link->lighten( 80 );
					$link_light = new \Pen_Theme\Color( $link_light );
					$link_light = 'rgba(' . implode( ',', $link_light->getRgb() ) . ',0.25)';
				} else {
					$link_light = $link;
				}

				$css_dark = 'body.pen_dark_mode a {
					color:' . $link_light . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$link_hover         = esc_html( pen_option_get( 'color_link_hover' ) );
		$link_hover_default = pen_option_default( 'color_link_hover' );

		if ( 'preset_1' !== $preset_color || $link_hover !== $link_hover_default ) {

			$selector = 'a:focus,
				a:hover,
				a:active';

			$css_normal = $selector . '{
				color:' . $link_hover . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$color_link_hover = new \Pen_Theme\Color( $link_hover );
				if ( $color_link_hover->isDark() ) {
					$link_hover_light = $color_link_hover->lighten( 80 );
					$link_hover_light = new \Pen_Theme\Color( $link_hover_light );
					$link_hover_light = 'rgba(' . implode( ',', $link_hover_light->getRgb() ) . ',0.25)';
				} else {
					$link_hover_light = $link_hover;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					color:' . $link_hover_light . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$form_font = esc_html( pen_option_get( 'font_family_forms' ) );

		if ( 'g:Roboto' !== $form_font ) {
			$css .= 'input[type="date"],
				input[type="datetime"],
				input[type="datetime-local"],
				input[type="email"],
				input[type="month"],
				input[type="number"],
				input[type="password"],
				input[type="search"],
				input[type="tel"],
				input[type="text"],
				input[type="time"],
				input[type="url"],
				input[type="week"],
				legend,
				option,
				select,
				textarea,
				#pen_header .pen_header_main .search-form .search-field,
				#pen_header .pen_header_main form.wp-block-search .wp-block-search__input,
				#pen_search .search-form .search-field,
				#pen_search form.wp-block-search .wp-block-search__input {
					font-family:"' . ltrim( $form_font, 'g:' ) . '", Arial, Helvetica, Sans-serif !important;
				}';
		}

		$button_primary           = esc_html( pen_option_get( 'color_button_background_primary' ) );
		$button_primary_default   = pen_option_default( 'color_button_background_primary' );
		$button_secondary         = esc_html( pen_option_get( 'color_button_background_secondary' ) );
		$button_secondary_default = pen_option_default( 'color_button_background_secondary' );

		$button_text         = esc_html( pen_option_get( 'color_button_text' ) );
		$button_text_default = pen_option_default( 'color_button_text' );

		$angle         = esc_html( pen_option_get( 'color_button_background_angle' ) );
		$angle_default = pen_option_default( 'color_button_background_angle' );

		$button_border         = esc_html( pen_option_get( 'color_button_border' ) );
		$button_border_default = pen_option_default( 'color_button_border' );
		$button_font           = esc_html( pen_option_get( 'font_family_buttons' ) );

		if ( 'preset_1' !== $preset_color || $button_text !== $button_text_default || $button_primary !== $button_primary_default || $button_secondary !== $button_secondary_default || $button_border !== $button_border_default || 'g:Roboto' !== $button_font ) {

			$selector = '#page .pen_button,
				#primary .comments-link a,
				#primary .comment-list a.comment-edit-link,
				#primary .comment-list .reply a,
				#primary button[type="reset"],
				#primary button[type="submit"],
				#primary input[type="button"],
				#primary input[type="reset"],
				#primary input[type="submit"],
				#primary .pen_content_footer .tags-links a,
				#cancel-comment-reply-link,
				#content .page-links a,
				#content .comment-navigation a,
				#content .posts-navigation a,
				#content .post-navigation a,
				#content .wp-pagenavi a,
				#content .wp-pagenavi span,
				#page .pen_button:focus,
				#primary .comments-link a:focus,
				#primary .comment-list a.comment-edit-link:focus,
				#primary .comment-list .reply a:focus,
				#primary button[type="reset"]:focus,
				#primary button[type="submit"]:focus,
				#primary input[type="button"]:focus,
				#primary input[type="reset"]:focus,
				#primary input[type="submit"]:focus,
				#primary .pen_content_footer .tags-links a:focus,
				#cancel-comment-reply-link:focus,
				#content .page-links a:focus,
				#content .comment-navigation a:focus,
				#content .posts-navigation a:focus,
				#content .post-navigation a:focus,
				#page .pen_button:hover,
				#primary .comments-link a:hover,
				#primary .comment-list a.comment-edit-link:hover,
				#primary .comment-list .reply a:hover,
				#primary button[type="reset"]:hover,
				#primary button[type="submit"]:hover,
				#primary input[type="button"]:hover,
				#primary input[type="reset"]:hover,
				#primary input[type="submit"]:hover,
				#primary .pen_content_footer .tags-links a:hover,
				#cancel-comment-reply-link:hover,
				#content .page-links a:hover,
				#content .comment-navigation a:hover,
				#content .posts-navigation a:hover,
				#content .post-navigation a:hover';

			if ( PEN_THEME_HAS_WOOCOMMERCE ) {
				$selector .= ',
					body.pen_has_woocommerce #page .product .button,
					body.pen_has_woocommerce #page .wp-block-button__link,
					body.pen_has_woocommerce #page .wc-backward,
					body.pen_has_woocommerce #page .wc-forward,
					body.pen_has_woocommerce #page .woocommerce-pagination a.page-numbers,
					body.pen_has_woocommerce #page .product .button:focus,
					body.pen_has_woocommerce #page .wp-block-button__link:focus,
					body.pen_has_woocommerce #page .wc-backward:focus,
					body.pen_has_woocommerce #page .wc-forward:focus,
					body.pen_has_woocommerce #page .woocommerce-pagination a.page-numbers:focus,
					body.pen_has_woocommerce #page .product .button:hover,
					body.pen_has_woocommerce #page .wc-backward:hover,
					body.pen_has_woocommerce #page .wc-forward:hover,
					body.pen_has_woocommerce #page .woocommerce-pagination a.page-numbers:hover';
			}

			$css .= $selector . '{';

			if ( 'preset_1' !== $preset_color || $button_primary !== $button_primary_default || $button_secondary !== $button_secondary_default ) {
				$css .= 'background-color:' . $button_secondary . ';
				background:' . $button_secondary . ';';
				if ( $button_primary !== $button_secondary ) {
					$css .= 'background:linear-gradient(' . $angle . ',' . $button_primary . ' 0%,' . $button_secondary . ' 100%);';
				}
			}
			if ( 'preset_1' !== $preset_color || $button_text !== $button_text_default ) {
				$css .= 'color:' . $button_text . ' !important;';
			}
			if ( 'preset_1' !== $preset_color || $button_border !== $button_border_default ) {
				$css .= 'border-color:' . $button_border . ' !important;';
			}
			if ( 'g:Roboto' !== $button_font ) {
				$css .= 'font-family:"' . ltrim( $button_font, 'g:' ) . '", Arial, Helvetica, Sans-serif !important;';
			}
			$css .= '}';

			$button_transform_text         = esc_html( pen_option_get( 'transform_text_buttons' ) );
			$button_transform_text_default = pen_option_default( 'transform_text_buttons' );

			if ( $button_transform_text !== $button_transform_text_default ) {
				$css .= '#page .pen_button,
					#primary .comments-link a,
					#primary .comment-list a.comment-edit-link,
					#primary .comment-list .reply a,
					#primary button[type="reset"],
					#primary button[type="submit"],
					#primary input[type="button"],
					#primary input[type="reset"],
					#primary input[type="submit"],
					#primary .pen_content_footer .tags-links a,
					#cancel-comment-reply-link,
					#content .page-links a,
					#content .comment-navigation a,
					#content .posts-navigation a,
					#content .post-navigation a,
					#content .wp-pagenavi a,
					#content .wp-pagenavi span {
						text-transform:' . $button_transform_text . ' !important;
					}';
			}

			if ( 'preset_1' !== $preset_color || $button_primary !== $button_primary_default || $button_secondary !== $button_secondary_default ) {

				$selector = '#page .pen_button:active,
					#page .pen_button.pen_active,
					#primary .comments-link a:active,
					#primary .comment-list a.comment-edit-link:active,
					#primary .comment-list .reply a:active,
					#primary button[type="reset"]:active,
					#primary button[type="submit"]:active,
					#primary input[type="button"]:active,
					#primary input[type="reset"]:active,
					#primary input[type="submit"]:active,
					#primary .pen_content_footer .tags-links a:active,
					#cancel-comment-reply-link:active,
					#content .page-links a:active,
					#content .comment-navigation a:active,
					#content .posts-navigation a:active,
					#content .post-navigation a:active,
					#content .wp-pagenavi span,
					#content .wp-pagenavi .current';

				if ( PEN_THEME_HAS_WOOCOMMERCE ) {
					$selector .= ',
						body.pen_has_woocommerce #page .wc-backward:active,
						body.pen_has_woocommerce #page .wc-forward:active,
						body.pen_has_woocommerce #page .woocommerce-pagination a.page-numbers:active,
						body.pen_has_woocommerce #page .woocommerce-pagination span.page-numbers.current';
				}

				$css .= $selector . '{
					background:' . $button_secondary . ';
				}';

			}
			if ( 'g:Roboto' !== $button_font ) {
				$css .= '#pen_header .pen_header_main .search-form .search-submit,
				#pen_header .pen_header_main form.wp-block-search .wp-block-search__button {
					font-family:"' . ltrim( $button_font, 'g:' ) . '", Arial, Helvetica, Sans-serif !important;
				}';
			}
		}

		if ( pen_sidebar_check( 'sidebar-top', $content_id ) ) {

			$widget_title_top_font              = esc_html( pen_option_get( 'font_family_widget_title_top' ) );
			$widget_title_top_font_size         = esc_html( pen_option_get( 'font_size_widget_title_top' ) );
			$widget_title_top_font_size_default = pen_option_default( 'font_size_widget_title_top' );

			if ( 'g:Roboto' !== $widget_title_top_font || $widget_title_top_font_size !== $widget_title_top_font_size_default ) {
				$css .= '#pen_top .widget-title,
					#pen_top .widget_block h2 {';
				if ( 'g:Roboto' !== $widget_title_top_font ) {
					$css .= 'font-family:"' . ltrim( $widget_title_top_font, 'g:' ) . '", Arial, Helvetica, Sans-serif !important;';
				}
				if ( $widget_title_top_font_size !== $widget_title_top_font_size_default ) {
					$css .= 'font-size:' . $widget_title_top_font_size . ';';
				}
				$css .= '}';
			}
		}

		if ( pen_sidebar_check( 'sidebar-left', $content_id ) ) {

			$widget_title_left_font              = esc_html( pen_option_get( 'font_family_widget_title_left' ) );
			$widget_title_left_font_size         = esc_html( pen_option_get( 'font_size_widget_title_left' ) );
			$widget_title_left_font_size_default = pen_option_default( 'font_size_widget_title_left' );

			if ( 'g:Roboto' !== $widget_title_left_font || $widget_title_left_font_size !== $widget_title_left_font_size_default ) {
				$css .= '#pen_left .widget-title,
					#pen_left .widget_block h2 {';
				if ( 'g:Roboto' !== $widget_title_left_font ) {
					$css .= 'font-family:"' . ltrim( $widget_title_left_font, 'g:' ) . '", Arial, Helvetica, Sans-serif !important;';
				}
				if ( $widget_title_left_font_size !== $widget_title_left_font_size_default ) {
					$css .= 'font-size:' . $widget_title_left_font_size . ';';
				}
				$css .= '}';
			}
		}

		if ( pen_sidebar_check( 'sidebar-right', $content_id ) ) {

			$widget_title_right_font              = esc_html( pen_option_get( 'font_family_widget_title_right' ) );
			$widget_title_right_font_size         = esc_html( pen_option_get( 'font_size_widget_title_right' ) );
			$widget_title_right_font_size_default = pen_option_default( 'font_size_widget_title_right' );

			if ( 'g:Roboto' !== $widget_title_right_font || $widget_title_right_font_size !== $widget_title_right_font_size_default ) {
				$css .= '#pen_right .widget-title,
					#pen_right .widget_block h2 {';
				if ( 'g:Roboto' !== $widget_title_right_font ) {
					$css .= 'font-family:"' . ltrim( $widget_title_right_font, 'g:' ) . '", Arial, Helvetica, Sans-serif !important;';
				}
				if ( $widget_title_right_font_size !== $widget_title_right_font_size_default ) {
					$css .= 'font-size:' . $widget_title_right_font_size . ';';
				}
				$css .= '}';
			}
		}

		$css = pen_compress_css( $css );

		wp_add_inline_style( 'pen-css', $css );
	}
	if ( PEN_THEME_CUSTOM_CSS ) {
		add_action( 'wp_enqueue_scripts', 'pen_inline_css_general' );
	}
}

if ( ! function_exists( 'pen_inline_css_loading_spinner' ) ) {
	/**
	 * Adds inline CSS for the loading spinner.
	 *
	 * @since Pen 1.3.0
	 * @return void
	 */
	function pen_inline_css_loading_spinner() {

		$css = '';

		$preset_color = pen_preset_get( 'color' );

		$background_primary           = esc_html( pen_option_get( 'color_loading_spinner_background_primary' ) );
		$background_primary_default   = pen_option_default( 'color_loading_spinner_background_primary' );
		$background_secondary         = esc_html( pen_option_get( 'color_loading_spinner_background_secondary' ) );
		$background_secondary_default = pen_option_default( 'color_loading_spinner_background_secondary' );

		$text         = esc_html( pen_option_get( 'color_loading_spinner_text' ) );
		$text_default = pen_option_default( 'color_loading_spinner_text' );

		$angle         = esc_html( pen_option_get( 'color_loading_spinner_background_angle' ) );
		$angle_default = pen_option_default( 'color_loading_spinner_background_angle' );

		if ( 'preset_1' !== $preset_color || $background_primary !== $background_primary_default || $background_secondary !== $background_secondary_default || $angle !== $angle_default || $text !== $text_default ) {

			$color_background_primary = new \Pen_Theme\Color( $background_primary );
			$background_primary       = $color_background_primary->getRgb();

			$color_background_secondary = new \Pen_Theme\Color( $background_secondary );
			$background_secondary       = $color_background_secondary->getRgb();

			$color_text = new \Pen_Theme\Color( $text );
			$text_rgb   = 'rgba(' . implode( ',', $color_text->getRgb() ) . ',0.95)';

			$selector = '#page .pen_loading';

			$css_normal = $selector . '{
				background:rgba(' . implode( ',', $background_primary ) . ',0.85);';
			if ( $background_primary !== $background_secondary ) {
				$css_normal .= 'background:linear-gradient(' . $angle . ',rgba(' . implode( ',', $background_primary ) . ',0.85) 0%, rgba(' . implode( ',', $background_secondary ) . ',0.85) 100%);';
			}
			if ( 'preset_1' !== $preset_color || $text !== $text_default ) {
				$css_normal .= 'color:' . $text_rgb . ';';
			}
			$css_normal .= '}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				if ( $color_background_primary->isLight() ) {
					$background_primary_dark = $color_background_primary->darken( 80 );
					$background_primary_dark = new \Pen_Theme\Color( $background_primary_dark );
					$background_primary_dark = $background_primary_dark->getRgb();
				} else {
					$background_primary_dark = $background_primary;
				}

				if ( $color_background_secondary->isLight() ) {
					$background_secondary_dark = $color_background_secondary->darken( 80 );
					$background_secondary_dark = new \Pen_Theme\Color( $background_secondary_dark );
					$background_secondary_dark = $background_secondary_dark->getRgb();
				} else {
					$background_secondary_dark = $background_secondary;
				}

				if ( $color_text->isDark() ) {
					$text_light = $color_text->lighten( 80 );
					$text_light = new \Pen_Theme\Color( $text_light );
					$text_light = 'rgba(' . implode( ',', $text_light->getRgb() ) . ',0.95)';
				} else {
					$text_light = $text_rgb;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					background:linear-gradient(' . $angle . ',rgba(' . implode( ',', $background_primary_dark ) . ',0.85) 0%, rgba(' . implode( ',', $background_secondary_dark ) . ',0.85) 100%);
					color:' . $text_light . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$primary           = esc_html( pen_option_get( 'color_loading_spinner_primary' ) );
		$primary_default   = pen_option_default( 'color_loading_spinner_primary' );
		$secondary         = esc_html( pen_option_get( 'color_loading_spinner_secondary' ) );
		$secondary_default = pen_option_default( 'color_loading_spinner_secondary' );

		$style         = (int) pen_option_get( 'loading_spinner_style' );
		$style_default = pen_option_default( 'loading_spinner_style' );

		if ( 'preset_1' !== $preset_color || $primary !== $primary_default || $secondary !== $secondary_default || $style !== $style_default ) {

			$color_primary   = new \Pen_Theme\Color( $primary );
			$color_secondary = new \Pen_Theme\Color( $secondary );

			$selector = 'body.pen_loading_spinner_style_' . $style . ' #page .pen_loading .pen_icon:before';

			$css_normal = $selector . '{';

			if ( 1 === $style ) {

				$primary_rgb   = 'rgba(' . implode( ',', $color_primary->getRgb() ) . ',0.75)';
				$secondary_rgb = 'rgba(' . implode( ',', $color_primary->getRgb() ) . ',0.1)';

				$css_normal .= 'border-top-color:' . $secondary_rgb . ' !important;
					border-right-color:' . $secondary_rgb . ' !important;
					border-bottom-color:' . $secondary_rgb . ' !important;
					border-left-color:' . $primary_rgb . ' !important;';

			} elseif ( 2 === $style ) {

				$primary_rgb   = 'rgba(' . implode( ',', $color_primary->getRgb() ) . ',0.75)';
				$secondary_rgb = 'rgba(' . implode( ',', $color_primary->getRgb() ) . ',0.1)';

				$css_normal .= 'border-top-color:' . $secondary_rgb . ' !important;
					border-right-color:' . $primary_rgb . ' !important;
					border-bottom-color:' . $secondary_rgb . ' !important;
					border-left-color:' . $primary_rgb . ' !important;';

			} elseif ( 3 === $style ) {

				$primary_rgb   = 'rgba(' . implode( ',', $color_primary->getRgb() ) . ',0.5)';
				$secondary_rgb = 'rgba(' . implode( ',', $color_primary->getRgb() ) . ',0.1)';

				$css_normal .= 'border-top-color:' . $secondary_rgb . ' !important;
					border-right-color:' . $secondary_rgb . ' !important;
					border-bottom-color:' . $secondary_rgb . ' !important;
					border-left-color:' . $primary_rgb . ' !important;';

			} elseif ( 4 === $style ) {

				$primary_rgb   = 'rgba(' . implode( ',', $color_primary->getRgb() ) . ',0.75)';
				$secondary_rgb = 'rgba(' . implode( ',', $color_primary->getRgb() ) . ',0.25)';

				$css_normal .= 'border-top-color:' . $secondary_rgb . ' !important;
					border-right-color:' . $secondary_rgb . ' !important;
					border-bottom-color:' . $secondary_rgb . ' !important;
					border-left-color:' . $primary_rgb . ' !important;';
			}
			$css_normal .= '}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				if ( $color_primary->isDark() ) {
					$primary_light = $color_primary->lighten( 80 );
					$primary_light = new \Pen_Theme\Color( $primary_light );
					$primary_light = $primary_light->getRgb();
				} else {
					$primary_light = $color_primary->getRgb();
				}

				if ( $color_secondary->isDark() ) {
					$secondary_light = $color_secondary->lighten( 80 );
					$secondary_light = new \Pen_Theme\Color( $secondary_light );
					$secondary_light = $secondary_light->getRgb();
				} else {
					$secondary_light = $color_secondary->getRgb();
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{';

				if ( 1 === $style ) {

					$primary_light   = 'rgba(' . implode( ',', $primary_light ) . ',0.75)';
					$secondary_light = 'rgba(' . implode( ',', $secondary_light ) . ',0.1)';

					$css_dark .= 'border-top-color:' . $secondary_light . ' !important;
						border-right-color:' . $secondary_light . ' !important;
						border-bottom-color:' . $secondary_light . ' !important;
						border-left-color:' . $primary_light . ' !important;';

				} elseif ( 2 === $style ) {

					$primary_light   = 'rgba(' . implode( ',', $primary_light ) . ',0.75)';
					$secondary_light = 'rgba(' . implode( ',', $secondary_light ) . ',0.1)';

					$css_dark .= 'border-top-color:' . $secondary_light . ' !important;
						border-right-color:' . $primary_light . ' !important;
						border-bottom-color:' . $secondary_light . ' !important;
						border-left-color:' . $primary_light . ' !important;';

				} elseif ( 3 === $style ) {

					$primary_light   = 'rgba(' . implode( ',', $primary_light ) . ',0.5)';
					$secondary_light = 'rgba(' . implode( ',', $secondary_light ) . ',0.1)';

					$css_dark .= 'border-top-color:' . $secondary_light . ' !important;
						border-right-color:' . $secondary_light . ' !important;
						border-bottom-color:' . $secondary_light . ' !important;
						border-left-color:' . $primary_light . ' !important;';

				} else {

					$primary_light   = 'rgba(' . implode( ',', $primary_light ) . ',0.75)';
					$secondary_light = 'rgba(' . implode( ',', $secondary_light ) . ',0.25)';

					$css_dark .= 'border-top-color:' . $secondary_light . ' !important;
						border-right-color:' . $secondary_light . ' !important;
						border-bottom-color:' . $secondary_light . ' !important;
						border-left-color:' . $primary_light . ' !important;';
				}

				$css_dark .= '}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$css = pen_compress_css( $css );

		wp_add_inline_style( 'pen-css', $css );
	}
	if ( PEN_THEME_CUSTOM_CSS ) {
		add_action( 'wp_enqueue_scripts', 'pen_inline_css_loading_spinner' );
	}
}

if ( ! function_exists( 'pen_inline_css_header' ) ) {
	/**
	 * Adds inline CSS for the header.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_inline_css_header() {

		$content_id = pen_post_id();

		$css = '';

		$preset_color = pen_preset_get( 'color' );

		$primary           = esc_html( pen_option_get( 'color_header_background_primary' ) );
		$primary_default   = pen_option_default( 'color_header_background_primary' );
		$secondary         = esc_html( pen_option_get( 'color_header_background_secondary' ) );
		$secondary_default = pen_option_default( 'color_header_background_secondary' );

		$angle         = esc_html( pen_option_get( 'color_header_background_angle' ) );
		$angle_default = pen_option_default( 'color_header_background_angle' );

		$header_image = get_header_image();
		$dynamic      = get_post_meta( $content_id, 'pen_content_background_image_header_dynamic_override', true );
		if ( ! $dynamic || 'default' === $dynamic ) {
			$dynamic = pen_option_get( 'background_image_header_dynamic' );
		}
		if ( 'featured_image' === $dynamic && $content_id ) {
			$image_size = 'original';
			if ( PEN_THEME_SMALLSCREEN || 'narrow' === pen_option_get( 'site_width' ) ) {
				$image_size = 'large';
			}
			$image_dynamic = esc_url( get_the_post_thumbnail_url( null, $image_size ) );
			if ( $image_dynamic ) {
				$header_image = $image_dynamic;
			}
		}

		if ( 'preset_1' !== $preset_color || $primary !== $primary_default || $secondary !== $secondary_default || $header_image || $angle !== $angle_default ) {

			$selector = '#pen_header.pen_not_transparent .pen_header_inner .pen_header_main';

			$css_normal = $selector . '{
				background-color:' . $primary . ';
				background:' . $primary . ';';
			if ( $primary !== $secondary ) {
				$css_normal .= 'background:linear-gradient(' . $angle . ',' . $primary . ' 0%,' . $secondary . ' 100%);';
			}
			if ( $header_image ) {
				$css_normal .= "background-image:url('" . esc_html( $header_image ) . "') !important;
					background-repeat:no-repeat !important;
					background-position:top center !important;
					background-size:cover !important;";
			}
			$css_normal .= '}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$color_primary = new \Pen_Theme\Color( $primary );
				if ( $color_primary->isLight() ) {
					$primary_dark = $color_primary->darken( 80 );
					$primary_dark = new \Pen_Theme\Color( $primary_dark );
					$primary_dark = '#' . $primary_dark->getHex();
				} else {
					$primary_dark = $primary;
				}

				$color_secondary = new \Pen_Theme\Color( $secondary );
				if ( $color_secondary->isLight() ) {
					$secondary_dark = $color_secondary->darken( 80 );
					$secondary_dark = new \Pen_Theme\Color( $secondary_dark );
					$secondary_dark = '#' . $secondary_dark->getHex();
				} else {
					$secondary_dark = $secondary;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					background-color:' . $primary_dark . ' !important;
					background:' . $primary_dark . ' !important;';
				if ( $primary_dark !== $secondary_dark ) {
					$css_dark .= 'background:linear-gradient(' . $angle . ',' . $primary_dark . ' 0%,' . $secondary_dark . ' 100%) !important;';
				}
				if ( $header_image ) {
					$css_dark .= "background-image:url('" . esc_html( $header_image ) . "') !important;
						background-repeat:no-repeat !important;
						background-position:top center !important;
						background-size:cover !important;";
				}
				$css_dark .= '}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}

			$text         = esc_html( pen_option_get( 'color_header_text' ) );
			$text_default = pen_option_default( 'color_header_text' );

			if ( 'preset_1' !== $preset_color || $text !== $text_default ) {

				$selector = '#pen_header .pen_header_inner .pen_header_main';

				$css_normal = $selector . '{
					color:' . $text . ' !important;
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_text = new \Pen_Theme\Color( $text );
					if ( $color_text->isDark() ) {
						$text_light = $color_text->lighten( 75 );
						$text_light = new \Pen_Theme\Color( $text_light );
						$text_light = '#' . $text_light->getHex();
					} else {
						$text_light = $text;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						color:' . $text_light . ' !important;
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}
		}

		$shadow         = pen_option_get( 'color_header_text_shadow' );
		$shadow_default = pen_option_default( 'color_header_text_shadow' );
		$shadow_display = pen_option_get( 'color_header_text_shadow_display' );

		if ( 'preset_1' !== $preset_color || $shadow !== $shadow_default || ! $shadow_display ) {

			if ( $shadow_display ) {
				$text_shadow = '1px 1px 2px ' . esc_html( $shadow );
			} else {
				$text_shadow = 'none';
			}

			$selector = 'body.pen_drop_shadow #pen_header .pen_header_inner .pen_header_main';

			$css_normal = $selector . '{
				text-shadow:' . $text_shadow . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				if ( $shadow_display ) {
					$color_shadow = new \Pen_Theme\Color( $shadow );
					if ( $color_shadow->isLight() ) {
						$shadow_dark = $color_shadow->darken( 100 );
						$shadow_dark = new \Pen_Theme\Color( $shadow_dark );
						$shadow_dark = '1px 1px 2px #' . $shadow_dark->getHex();
					} else {
						$shadow_dark = $shadow;
					}
				} else {
					$shadow_dark = 'none';
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					text-shadow:' . $shadow_dark . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$link               = esc_html( pen_option_get( 'color_header_link' ) );
		$link_default       = pen_option_default( 'color_header_link' );
		$link_hover         = esc_html( pen_option_get( 'color_header_link_hover' ) );
		$link_hover_default = pen_option_default( 'color_header_link_hover' );

		if ( 'preset_1' !== $preset_color || $link !== $link_default || $link_hover !== $link_hover_default ) {

			$selector = '#pen_header .pen_header_inner .pen_header_main a';

			$css_normal = $selector . '{
				color:' . $link . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$color_link = new \Pen_Theme\Color( $link );
				if ( $color_link->isDark() ) {
					$link_light = $color_link->lighten( 80 );
					$link_light = new \Pen_Theme\Color( $link_light );
					$link_light = '#' . $link_light->getHex();
				} else {
					$link_light = $link;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					color:' . $link_light . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		if ( 'preset_1' !== $preset_color || $link_hover !== $link_hover_default ) {

			$selector = '#pen_header .pen_header_main a:focus,
				#pen_header .pen_header_main a:hover,
				#pen_header .pen_header_main a:active,
				#pen_header .pen_social_networks a:focus,
				#pen_header .pen_social_networks a:hover,
				#pen_header .pen_social_networks a:active';

			$css_normal = $selector . '{
				color:' . $link_hover . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$color_link_hover = new \Pen_Theme\Color( $link_hover );
				if ( $color_link_hover->isDark() ) {
					$link_hover_light = $color_link_hover->lighten( 55 );
					$link_hover_light = new \Pen_Theme\Color( $link_hover_light );
					$link_hover_light = '#' . $link_hover_light->getHex();
				} else {
					$link_hover_light = $link_hover;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					color:' . $link_hover_light . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$sitetitle                        = esc_html( pen_option_get( 'color_header_sitetitle' ) );
		$sitetitle_default                = pen_option_default( 'color_header_sitetitle' );
		$sitetitle_font                   = esc_html( pen_option_get( 'font_family_sitetitle' ) );
		$sitetitle_size                   = esc_html( pen_option_get( 'font_size_sitetitle' ) );
		$sitetitle_size_default           = pen_option_default( 'font_size_sitetitle' );
		$sitetitle_transform_text         = esc_html( pen_option_get( 'transform_text_sitetitle' ) );
		$sitetitle_transform_text_default = pen_option_default( 'transform_text_sitetitle' );

		if ( 'preset_1' !== $preset_color || $sitetitle !== $sitetitle_default || $link !== $link_default // || because $link may affect the sitetitle.
			|| 'g:Roboto' !== $sitetitle_font || $sitetitle_size !== $sitetitle_size_default || $sitetitle_transform_text !== $sitetitle_transform_text_default ) {

			$selector = '#pen_header #pen_site_title a span.site-title';

			$css .= $selector . '{';

			if ( 'preset_1' !== $preset_color || $sitetitle !== $sitetitle_default || $link !== $link_default ) {
				$css .= 'color:' . $sitetitle . ';';
			}
			if ( 'g:Roboto' !== $sitetitle_font ) {
				$css .= 'font-family:"' . ltrim( $sitetitle_font, 'g:' ) . '", Arial, Helvetica, Sans-serif !important;';
			}
			if ( $sitetitle_size !== $sitetitle_size_default ) {
				$css .= 'font-size:' . $sitetitle_size . ';';
			}
			if ( $sitetitle_transform_text !== $sitetitle_transform_text_default ) {
				$css .= 'text-transform:' . $sitetitle_transform_text . ';';
			}
			$css .= '}';

			if ( PEN_THEME_DARK_MODE ) {

				$color_sitetitle = new \Pen_Theme\Color( $sitetitle );
				if ( $color_sitetitle->isDark() ) {
					$sitetitle_light = $color_sitetitle->lighten( 80 );
					$sitetitle_light = new \Pen_Theme\Color( $sitetitle_light );
					$sitetitle_light = '#' . $sitetitle_light->getHex();
				} else {
					$sitetitle_light = $sitetitle;
				}

				$css_normal = $selector . '{
					color:' . $sitetitle . ';
				}';

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					color:' . $sitetitle_light . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$sitetitle_hover         = esc_html( pen_option_get( 'color_header_sitetitle_hover' ) );
		$sitetitle_hover_default = pen_option_default( 'color_header_sitetitle_hover' );

		if ( 'preset_1' !== $preset_color || $sitetitle_hover !== $sitetitle_hover_default ) {

			$selector = '#pen_header #pen_site_title a:focus .site-title,
				#pen_header #pen_site_title a:hover .site-title,
				#pen_header #pen_site_title a:active .site-title';

			$css_normal = $selector . '{
				color:' . $sitetitle_hover . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$color_sitetitle_hover = new \Pen_Theme\Color( $sitetitle_hover );
				if ( $color_sitetitle_hover->isDark() ) {
					$sitetitle_hover_light = $color_sitetitle_hover->lighten( 55 );
					$sitetitle_hover_light = new \Pen_Theme\Color( $sitetitle_hover_light );
					$sitetitle_hover_light = '#' . $sitetitle_hover_light->getHex();
				} else {
					$sitetitle_hover_light = $sitetitle_hover;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					color:' . $sitetitle_hover_light . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$sitedescription                        = esc_html( pen_option_get( 'color_header_sitedescription' ) );
		$sitedescription_default                = pen_option_default( 'color_header_sitedescription' );
		$sitedescription_font                   = esc_html( pen_option_get( 'font_family_sitedescription' ) );
		$sitedescription_size                   = esc_html( pen_option_get( 'font_size_sitedescription' ) );
		$sitedescription_size_default           = pen_option_default( 'font_size_sitedescription' );
		$sitedescription_transform_text         = esc_html( pen_option_get( 'transform_text_sitedescription' ) );
		$sitedescription_transform_text_default = pen_option_default( 'transform_text_sitedescription' );

		if ( 'preset_1' !== $preset_color || $sitedescription !== $sitedescription_default || 'g:Roboto' !== $sitedescription_font || $sitedescription_size !== $sitedescription_size_default || $sitedescription_transform_text !== $sitedescription_transform_text_default ) {

			$selector = '#pen_header #pen_site_title a .site-description';

			$css .= $selector . '{';
			if ( 'preset_1' !== $preset_color || $sitedescription !== $sitedescription_default || $link !== $link_default ) {
				$css .= 'color:' . $sitedescription . ';';
			}
			if ( 'g:Roboto' !== $sitedescription_font ) {
				$css .= 'font-family:"' . ltrim( $sitedescription_font, 'g:' ) . '", Arial, Helvetica, Sans-serif !important;';
			}
			if ( $sitedescription_size !== $sitedescription_size_default ) {
				$css .= 'font-size:' . $sitedescription_size . ';';
			}
			if ( $sitedescription_transform_text !== $sitedescription_transform_text_default ) {
				$css .= 'text-transform:' . $sitedescription_transform_text . ';';
			}
			$css .= '}';

			if ( PEN_THEME_DARK_MODE ) {

				$color_sitedescription = new \Pen_Theme\Color( $sitedescription );
				if ( $color_sitedescription->isDark() ) {
					$sitedescription_light = $color_sitedescription->lighten( 80 );
					$sitedescription_light = new \Pen_Theme\Color( $sitedescription_light );
					$sitedescription_light = '#' . $sitedescription_light->getHex();
				} else {
					$sitedescription_light = $sitedescription;
				}

				$css_normal = $selector . '{
					color:' . $sitedescription . ';
				}';

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					color:' . $sitedescription_light . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$sitedescription_hover         = esc_html( pen_option_get( 'color_header_sitedescription_hover' ) );
		$sitedescription_hover_default = pen_option_default( 'color_header_sitedescription_hover' );

		if ( 'preset_1' !== $preset_color || $sitedescription_hover !== $sitedescription_hover_default ) {

			$selector = '#pen_header #pen_site_title a:focus .site-description,
				#pen_header #pen_site_title a:hover .site-description,
				#pen_header #pen_site_title a:active .site-description';

			$css_normal = $selector . '{
				color:' . $sitedescription_hover . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$color_sitedescription_hover = new \Pen_Theme\Color( $sitedescription_hover );
				if ( $color_sitedescription_hover->isDark() ) {
					$sitedescription_hover_light = $color_sitedescription_hover->lighten( 55 );
					$sitedescription_hover_light = new \Pen_Theme\Color( $sitedescription_hover_light );
					$sitedescription_hover_light = '#' . $sitedescription_hover_light->getHex();
				} else {
					$sitedescription_hover_light = $sitedescription_hover;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					color:' . $sitedescription_hover_light . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$social_links_size         = esc_html( pen_option_get( 'font_size_social_header' ) );
		$social_links_size_default = pen_option_default( 'font_size_social_header' );

		if ( $social_links_size !== $social_links_size_default ) {
			$css .= '#pen_header .pen_social_networks li {
				font-size:' . $social_links_size . ';
			}';
		}

		if ( pen_option_get( 'phone' ) && pen_option_get( 'phone_header_display' ) ) {

			$phone         = esc_html( pen_option_get( 'color_header_phone' ) );
			$phone_default = pen_option_default( 'color_header_phone' );

			if ( 'preset_1' !== $preset_color || $phone !== $phone_default ) {

				$selector = '#pen_header .pen_header_main .pen_phone a';

				$css_normal = $selector . '{
					color:' . $phone . ';
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_phone = new \Pen_Theme\Color( $phone );
					if ( $color_phone->isDark() ) {
						$phone_light = $color_phone->lighten( 80 );
						$phone_light = new \Pen_Theme\Color( $phone_light );
						$phone_light = '#' . $phone_light->getHex();
					} else {
						$phone_light = $phone;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						color:' . $phone_light . ';
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$phone_hover         = esc_html( pen_option_get( 'color_header_phone_hover' ) );
			$phone_hover_default = pen_option_default( 'color_header_phone_hover' );

			if ( 'preset_1' !== $preset_color || $phone_hover !== $phone_hover_default ) {

				$selector = '#pen_header .pen_header_main .pen_phone a:focus,
					#pen_header .pen_header_main .pen_phone a:hover,
					#pen_header .pen_header_main .pen_phone a:active';

				$css_normal = $selector . '{
					color:' . $phone_hover . ' !important;
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_phone_hover = new \Pen_Theme\Color( $phone_hover );
					if ( $color_phone_hover->isDark() ) {
						$phone_hover_light = $color_phone_hover->lighten( 55 );
						$phone_hover_light = new \Pen_Theme\Color( $phone_hover_light );
						$phone_hover_light = '#' . $phone_hover_light->getHex();
					} else {
						$phone_hover_light = $phone_hover;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						color:' . $phone_hover_light . ' !important;
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$phone_font         = esc_html( pen_option_get( 'font_family_phone_header' ) );
			$phone_size         = esc_html( pen_option_get( 'font_size_phone_header' ) );
			$phone_size_default = pen_option_default( 'font_size_phone_header' );

			if ( 'g:Roboto' !== $phone_font || $phone_size !== $phone_size_default ) {
				$css .= '#pen_header .pen_header_main .pen_phone {';
				if ( 'g:Roboto' !== $phone_font ) {
					$css .= 'font-family:"' . ltrim( $phone_font, 'g:' ) . '", Arial, Helvetica, Sans-serif !important;';
				}
				if ( $phone_size !== $phone_size_default ) {
					$css .= 'font-size:' . $phone_size . ';';
				}
				$css .= '}';
			}
		}

		$field_primary           = esc_html( pen_option_get( 'color_header_field_background_primary' ) );
		$field_primary_default   = pen_option_default( 'color_header_field_background_primary' );
		$field_secondary         = esc_html( pen_option_get( 'color_header_field_background_secondary' ) );
		$field_secondary_default = pen_option_default( 'color_header_field_background_secondary' );

		$angle         = esc_html( pen_option_get( 'color_header_field_background_angle' ) );
		$angle_default = pen_option_default( 'color_header_field_background_angle' );

		$field_text         = esc_html( pen_option_get( 'color_header_field_text' ) );
		$field_text_default = pen_option_default( 'color_header_field_text' );

		$color_field_text = new \Pen_Theme\Color( $field_text );

		if ( 'preset_1' !== $preset_color || $field_primary !== $field_primary_default || $field_secondary !== $field_secondary_default || $field_text !== $field_text_default ) {

			$selector = '#pen_header .pen_header_main input[type="date"],
				#pen_header .pen_header_main input[type="datetime"],
				#pen_header .pen_header_main input[type="datetime-local"],
				#pen_header .pen_header_main input[type="email"],
				#pen_header .pen_header_main input[type="month"],
				#pen_header .pen_header_main input[type="number"],
				#pen_header .pen_header_main input[type="password"],
				#pen_header .pen_header_main input[type="search"],
				#pen_header .pen_header_main input[type="tel"],
				#pen_header .pen_header_main input[type="text"],
				#pen_header .pen_header_main input[type="time"],
				#pen_header .pen_header_main input[type="url"],
				#pen_header .pen_header_main input[type="week"],
				#pen_header .pen_header_main option,
				#pen_header .pen_header_main select,
				#pen_header .pen_header_main textarea,
				#pen_header .pen_header_main .search-form .search-field,
				#pen_header .pen_header_main form.wp-block-search .wp-block-search__input';

			$css_normal = $selector . '{
				background:' . $field_secondary . ';';
			if ( $field_primary !== $field_secondary ) {
				$css_normal .= 'background:linear-gradient(' . $angle . ',' . $field_primary . ' 0%,' . $field_secondary . ' 100%);';
			}
			if ( 'preset_1' !== $preset_color || $field_text !== $field_text_default ) {
				$css_normal .= 'color:' . $field_text . ';';
			}
			$css_normal .= '}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$color_field_primary = new \Pen_Theme\Color( $field_primary );
				if ( $color_field_primary->isLight() ) {
					$field_primary_dark = $color_field_primary->darken( 80 );
					$field_primary_dark = new \Pen_Theme\Color( $field_primary_dark );
					$field_primary_dark = '#' . $field_primary_dark->getHex();
				} else {
					$field_primary_dark = $field_primary;
				}

				$color_field_secondary = new \Pen_Theme\Color( $field_secondary );
				if ( $color_field_secondary->isLight() ) {
					$field_secondary_dark = $color_field_secondary->darken( 80 );
					$field_secondary_dark = new \Pen_Theme\Color( $field_secondary_dark );
					$field_secondary_dark = '#' . $field_secondary_dark->getHex();
				} else {
					$field_secondary_dark = $field_secondary;
				}

				if ( $color_field_text->isDark() ) {
					$field_text_light = $color_field_text->lighten( 80 );
					$field_text_light = new \Pen_Theme\Color( $field_text_light );
					$field_text_light = '#' . $field_text_light->getHex();
				} else {
					$field_text_light = $field_text;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					background:linear-gradient(' . $angle . ',' . $field_primary_dark . ' 0%,' . $field_secondary_dark . ' 100%);
					color:' . $field_text_light . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}

			if ( 'preset_1' !== $preset_color || $field_text !== $field_text_default ) {

				$placeholder_rgb = 'rgba(' . implode( ',', $color_field_text->getRgb() ) . ',0.75)';

				$selector_webkit = '#pen_header .pen_header_main input::-webkit-input-placeholder,
					#pen_header .pen_header_main select::-webkit-input-placeholder,
					#pen_header .pen_header_main textarea::-webkit-input-placeholder';

				$selector_moz = '#pen_header .pen_header_main input::-moz-placeholder,
					#pen_header .pen_header_main select::-moz-placeholder,
					#pen_header .pen_header_main textarea::-moz-placeholder';

				$selector_ms = '#pen_header .pen_header_main input:-ms-input-placeholder,
					#pen_header .pen_header_main select:-ms-input-placeholder,
					#pen_header .pen_header_main textarea:-ms-input-placeholder';

				$css_normal = $selector_webkit . '{
					color:' . $placeholder_rgb . ' !important;
				}' . $selector_moz . '{
					color:' . $placeholder_rgb . ' !important;
				}' . $selector_ms . '{
					color:' . $placeholder_rgb . ' !important;
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					if ( $color_field_text->isDark() ) {
						$placeholder_light = $color_field_text->lighten( 80 );
						$placeholder_light = new \Pen_Theme\Color( $placeholder_light );
						$placeholder_light = 'rgba(' . implode( ',', $placeholder_light->getRgb() ) . ',0.5)';
					} else {
						$placeholder_light = $placeholder_rgb;
					}

					$selector_webkit_dark = pen_inline_css_dark_mode_selector( $selector_webkit );
					$selector_moz_dark    = pen_inline_css_dark_mode_selector( $selector_moz );
					$selector_ms_dark     = pen_inline_css_dark_mode_selector( $selector_ms );

					$css_dark = $selector_webkit_dark . '{
						color:' . $placeholder_light . ' !important;
					}' . $selector_moz_dark . '{
						color:' . $placeholder_light . ' !important;
					}' . $selector_ms_dark . '{
						color:' . $placeholder_light . ' !important;
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}
		}

		$search_primary                      = esc_html( pen_option_get( 'color_header_search_background_primary' ) );
		$search_primary_default              = pen_option_default( 'color_header_search_background_primary' );
		$search_secondary                    = esc_html( pen_option_get( 'color_header_search_background_secondary' ) );
		$search_background_secondary_default = pen_option_default( 'color_header_search_background_secondary' );

		$angle         = esc_html( pen_option_get( 'color_header_search_background_angle' ) );
		$angle_default = pen_option_default( 'color_header_search_background_angle' );

		$search_text         = esc_html( pen_option_get( 'color_header_search_text' ) );
		$search_text_default = pen_option_default( 'color_header_search_text' );

		if ( 'preset_1' !== $preset_color || $search_primary !== $search_primary_default || $search_secondary !== $search_background_secondary_default || $search_text !== $search_text_default ) {
			$css_normal = '#pen_header .pen_header_main .search-form .search-submit,
			#pen_header .pen_header_main form.wp-block-search .wp-block-search__button {
				background-color:' . $search_secondary . ';
				background:' . $search_secondary . ';';
			if ( $search_primary !== $search_secondary ) {
				$css_normal .= 'background:linear-gradient(' . $angle . ',' . $search_primary . ' 0%,' . $search_secondary . ' 100%);';
			}
			if ( 'preset_1' !== $preset_color ) {
				$css_normal .= 'border-color:' . $search_secondary . ' !important;';
			}
			if ( 'preset_1' !== $preset_color || $search_text !== $search_text_default ) {
				$css_normal .= 'color:' . $search_text . ' !important;';
			}
			$css_normal .= '}';

			$css .= $css_normal;

			$css .= 'body.pen_drop_shadow #pen_header .pen_header_main input[type="date"]:focus,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="date"]:active,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="datetime"]:focus,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="datetime"]:active,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="datetime-local"]:focus,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="datetime-local"]:active,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="email"]:focus,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="email"]:active,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="month"]:focus,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="month"]:active,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="number"]:focus,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="number"]:active,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="password"]:focus,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="password"]:active,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="search"]:focus,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="search"]:active,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="tel"]:focus,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="tel"]:active,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="text"]:focus,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="text"]:active,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="time"]:focus,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="time"]:active,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="url"]:focus,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="url"]:active,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="week"]:focus,
				body.pen_drop_shadow #pen_header .pen_header_main input[type="week"]:active,
				body.pen_drop_shadow #pen_header .pen_header_main option:focus,
				body.pen_drop_shadow #pen_header .pen_header_main option:active,
				body.pen_drop_shadow #pen_header .pen_header_main select:focus,
				body.pen_drop_shadow #pen_header .pen_header_main select:active,
				body.pen_drop_shadow #pen_header .pen_header_main textarea:focus,
				body.pen_drop_shadow #pen_header .pen_header_main textarea:active,
				body.pen_drop_shadow #pen_header .pen_header_main .search-form .search-field:focus,
				body.pen_drop_shadow #pen_header .pen_header_main .search-form .search-field:active,
				body.pen_drop_shadow #pen_header .pen_header_main form.wp-block-search .wp-block-search__input:focus,
				body.pen_drop_shadow #pen_header .pen_header_main form.wp-block-search .wp-block-search__input:active {
					box-shadow:2px 2px 2px rgba(0,0,0,0.2) inset, 0 0 7px ' . $search_secondary . ';
				}
				#pen_header .pen_header_main .search-form .search-submit:focus,
				#pen_header .pen_header_main .search-form .search-submit:active,
				#pen_header .pen_header_main form.wp-block-search .wp-block-search__button:focus,
				#pen_header .pen_header_main form.wp-block-search .wp-block-search__button:active {
					background:' . $search_secondary . ';
				}';
		}

		$button_users_primary                      = esc_html( pen_option_get( 'color_header_button_users_background_primary' ) );
		$button_users_primary_default              = pen_option_default( 'color_header_button_users_background_primary' );
		$button_users_secondary                    = esc_html( pen_option_get( 'color_header_button_users_background_secondary' ) );
		$button_users_background_secondary_default = pen_option_default( 'color_header_button_users_background_secondary' );

		$angle         = esc_html( pen_option_get( 'color_header_button_users_background_angle' ) );
		$angle_default = pen_option_default( 'color_header_button_users_background_angle' );

		$button_users_text         = esc_html( pen_option_get( 'color_header_button_users_text' ) );
		$button_users_text_default = pen_option_default( 'color_header_button_users_text' );

		if ( 'preset_1' !== $preset_color || $button_users_primary !== $button_users_primary_default || $button_users_secondary !== $button_users_background_secondary_default || $button_users_text !== $button_users_text_default ) {
			$css .= '#pen_header_button_users .pen_button {
				background-color:' . $button_users_secondary . ' !important;
				background:' . $button_users_secondary . ' !important;';
			if ( $button_users_primary !== $button_users_secondary ) {
				$css .= 'background:linear-gradient(' . $angle . ',' . $button_users_primary . ' 0%,' . $button_users_secondary . ' 100%) !important;';
			}
			if ( 'preset_1' !== $preset_color || $button_users_text !== $button_users_text_default ) {
				$css .= 'border:1px solid ' . $button_users_secondary . ' !important;
				color:' . $button_users_text . ' !important;';
			}
			$css .= '}';

			$css .= '#pen_header_button_users .pen_button:focus,
			#pen_header_button_users .pen_button:hover,
			#pen_header_button_users .pen_button:active,
			#pen_header_button_users .pen_button.pen_active {
				background:' . $button_users_secondary . ' !important;
			}';
		}

		$css = pen_compress_css( $css );

		wp_add_inline_style( 'pen-css', $css );
	}
	if ( PEN_THEME_CUSTOM_CSS ) {
		add_action( 'wp_enqueue_scripts', 'pen_inline_css_header' );
	}
}

if ( ! function_exists( 'pen_inline_css_navigation' ) ) {
	/**
	 * Adds inline CSS for the main navigation menu.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_inline_css_navigation() {

		$content_id = pen_post_id();

		$css = '';

		if ( pen_option_get( 'navigation_display' ) || 'never' !== pen_option_get( 'navigation_mobile_display' ) ) {

			$preset_color = pen_preset_get( 'color' );

			$background_primary           = esc_html( pen_option_get( 'color_navigation_background_primary' ) );
			$background_primary_default   = pen_option_default( 'color_navigation_background_primary' );
			$background_secondary         = esc_html( pen_option_get( 'color_navigation_background_secondary' ) );
			$background_secondary_default = pen_option_default( 'color_navigation_background_secondary' );

			$angle         = esc_html( pen_option_get( 'color_navigation_background_angle' ) );
			$angle_default = pen_option_default( 'color_navigation_background_angle' );

			$background_image   = esc_html( pen_option_get( 'background_image_navigation' ) );
			$background_dynamic = get_post_meta( $content_id, 'pen_content_background_image_navigation_dynamic_override', true );
			if ( ! $background_dynamic || 'default' === $background_dynamic ) {
				$background_dynamic = pen_option_get( 'background_image_navigation_dynamic' );
			}
			if ( 'featured_image' === $background_dynamic && $content_id ) {
				$image_size = 'original';
				if ( PEN_THEME_SMALLSCREEN || 'narrow' === pen_option_get( 'site_width' ) ) {
					$image_size = 'large';
				}
				$image_dynamic = esc_url( get_the_post_thumbnail_url( null, $image_size ) );
				if ( $image_dynamic ) {
					$background_image = $image_dynamic;
				}
			}

			if ( 'preset_1' !== $preset_color || $background_primary !== $background_primary_default || $background_secondary !== $background_secondary_default || $background_image || $angle !== $angle_default ) {

				$selector = '#pen_navigation.pen_not_transparent,
					#pen_navigation_mobile';

				$css_normal = $selector . '{
					background-color:' . $background_primary . ';
					background:' . $background_primary . ';';
				if ( $background_primary !== $background_secondary ) {
					$css_normal .= 'background:linear-gradient(' . $angle . ',' . $background_primary . ' 0%,' . $background_secondary . ' 100%);';
				}
				if ( $background_image ) {
					$css_normal .= "background-image:url('" . esc_html( $background_image ) . "') !important;
						background-repeat:no-repeat !important;
						background-position:top center !important;
						background-size:cover !important;";
				}
				$css_normal .= '}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_background_primary = new \Pen_Theme\Color( $background_primary );
					if ( $color_background_primary->isLight() ) {
						$background_primary_dark = $color_background_primary->darken( 100 );
						$background_primary_dark = new \Pen_Theme\Color( $background_primary_dark );
						$background_primary_dark = '#' . $background_primary_dark->getHex();
					} else {
						$background_primary_dark = $background_primary;
					}

					$color_background_secondary = new \Pen_Theme\Color( $background_secondary );
					if ( $color_background_secondary->isLight() ) {
						$background_secondary_dark = $color_background_secondary->darken( 100 );
						$background_secondary_dark = new \Pen_Theme\Color( $background_secondary_dark );
						$background_secondary_dark = '#' . $background_secondary_dark->getHex();
					} else {
						$background_secondary_dark = $background_secondary;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						background-color:' . $background_secondary_dark . ' !important;
						background:' . $background_secondary_dark . ' !important;';
					if ( $background_primary_dark !== $background_secondary_dark ) {
						$css_dark .= 'background:linear-gradient(' . $angle . ',' . $background_primary_dark . ' 0%,' . $background_secondary_dark . ' 100%) !important;';
					}
					if ( $background_image ) {
						$css_dark .= "background-image:url('" . esc_html( $background_image ) . "') !important;
							background-repeat:no-repeat !important;
							background-position:top center !important;
							background-size:cover !important;";
					}
					$css_dark .= '}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$background_submenu_primary           = esc_html( pen_option_get( 'color_navigation_background_submenu_primary' ) );
			$background_submenu_primary_default   = pen_option_default( 'color_navigation_background_submenu_primary' );
			$background_submenu_secondary         = esc_html( pen_option_get( 'color_navigation_background_submenu_secondary' ) );
			$background_submenu_secondary_default = pen_option_default( 'color_navigation_background_submenu_secondary' );

			$angle         = esc_html( pen_option_get( 'color_navigation_background_submenu_angle' ) );
			$angle_default = pen_option_default( 'color_navigation_background_submenu_angle' );

			$background_submenu_image = pen_option_get( 'background_image_navigation_submenu' );
			$background_dynamic       = get_post_meta( $content_id, 'pen_content_background_image_navigation_submenu_dynamic_override', true );
			if ( ! $background_dynamic || 'default' === $background_dynamic ) {
				$background_dynamic = pen_option_get( 'background_image_navigation_submenu_dynamic' );
			}
			if ( 'featured_image' === $background_dynamic && $content_id ) {
				$image_size = 'original';
				if ( PEN_THEME_SMALLSCREEN || 'narrow' === pen_option_get( 'site_width' ) ) {
					$image_size = 'large';
				}
				$image_dynamic = esc_url( get_the_post_thumbnail_url( null, $image_size ) );
				if ( $image_dynamic ) {
					$background_submenu_image = $image_dynamic;
				}
			}

			if ( 'preset_1' !== $preset_color || $background_submenu_primary !== $background_submenu_primary_default || $background_submenu_secondary !== $background_submenu_secondary_default || $background_submenu_image || $angle !== $angle_default ) {

				$selector = '#pen_navigation ul#primary-menu ul,
					#pen_navigation_mobile ul#primary-menu-mobile ul';

				$css_normal = $selector . '{
					background-color:' . $background_submenu_primary . ';
					background:' . $background_submenu_primary . ';';
				if ( $background_submenu_primary !== $background_submenu_secondary ) {
					$css_normal .= 'background:linear-gradient(' . $angle . ',' . $background_submenu_primary . ' 0%,' . $background_submenu_secondary . ' 100%);';
				}
				if ( $background_submenu_image ) {
					$css_normal .= "background-image:url('" . esc_html( $background_submenu_image ) . "') !important;
						background-repeat:no-repeat !important;
						background-position:top center !important;
						background-size:cover !important;";
				}
				$css_normal .= '}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_background_submenu_primary = new \Pen_Theme\Color( $background_submenu_primary );
					if ( $color_background_submenu_primary->isLight() ) {
						$background_primary_submenu_dark = $color_background_submenu_primary->darken( 80 );
						$background_primary_submenu_dark = new \Pen_Theme\Color( $background_primary_submenu_dark );
						$background_primary_submenu_dark = '#' . $background_primary_submenu_dark->getHex();
					} else {
						$background_primary_submenu_dark = $background_submenu_primary;
					}

					$color_background_submenu_secondary = new \Pen_Theme\Color( $background_submenu_secondary );
					if ( $color_background_submenu_secondary->isLight() ) {
						$background_secondary_submenu_dark = $color_background_submenu_secondary->darken( 80 );
						$background_secondary_submenu_dark = new \Pen_Theme\Color( $background_secondary_submenu_dark );
						$background_secondary_submenu_dark = '#' . $background_secondary_submenu_dark->getHex();
					} else {
						$background_secondary_submenu_dark = $background_submenu_secondary;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						background-color:' . $background_secondary_submenu_dark . ' !important;
						background:' . $background_secondary_submenu_dark . ' !important;';
					if ( $background_primary_submenu_dark !== $background_secondary_submenu_dark ) {
						$css_dark .= 'background:linear-gradient(' . $angle . ',' . $background_primary_submenu_dark . ' 0%,' . $background_secondary_submenu_dark . ' 100%) !important;';
					}
					if ( $background_submenu_image ) {
						$css_dark .= "background-image:url('" . esc_html( $background_submenu_image ) . "') !important;
							background-repeat:no-repeat !important;
							background-position:top center !important;
							background-size:cover !important;";
					}
					$css_dark .= '}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$link         = esc_html( pen_option_get( 'color_navigation_link' ) );
			$link_default = pen_option_default( 'color_navigation_link' );

			$navigation_font         = esc_html( pen_option_get( 'font_family_navigation' ) );
			$navigation_size         = esc_html( pen_option_get( 'font_size_navigation' ) );
			$navigation_size_default = pen_option_default( 'font_size_navigation' );

			if ( 'preset_1' !== $preset_color || $link !== $link_default || 'g:Roboto' !== $navigation_font || $navigation_size !== $navigation_size_default ) {

				$selector = '#pen_navigation ul#primary-menu a,
					#pen_navigation_mobile ul#primary-menu-mobile a,
					#pen_navigation_mobile .widget-area a';

				$css .= $selector . '{';
				if ( 'preset_1' !== $preset_color || $link !== $link_default ) {
					$css .= 'color:' . $link . ';';
				}
				if ( 'g:Roboto' !== $navigation_font ) {
					$css .= 'font-family:"' . ltrim( $navigation_font, 'g:' ) . '", Arial, Helvetica, Sans-serif !important;';
				}
				if ( $navigation_size !== $navigation_size_default ) {
					$css .= 'font-size:' . $navigation_size . ';';
				}
				$css .= '}';

				if ( PEN_THEME_DARK_MODE ) {

					$color_link = new \Pen_Theme\Color( $link );
					if ( $color_link->isDark() ) {
						$link_light = $color_link->lighten( 80 );
						$link_light = new \Pen_Theme\Color( $link_light );
						$link_light = '#' . $link_light->getHex();
					} else {
						$link_light = $link;
					}

					$css_normal = $selector . '{
						color:' . $link . ';
					}';

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						color:' . $link_light . '
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			if ( 'preset_1' !== $preset_color || $link !== $link_default ) {

				$selector = '#pen_navigation,
					#pen_navigation_mobile';

				$css_normal = $selector . '{
					color:' . $link . ';
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						color:' . $link_light . ';
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}

				$separator = (int) pen_option_get( 'navigation_separator' );

				if ( $separator ) {

					if ( PEN_THEME_DARK_MODE ) {
						if ( $color_link->isDark() ) {
							$separator_light = $color_link->lighten( 70 );
							$separator_light = new \Pen_Theme\Color( $separator_light );
							$separator_light = 'rgba(' . implode( ',', $separator_light->getRgb() ) . ',0.9)';
						} else {
							$separator_light = $separator;
						}
					}

					$css_normal = '';
					$css_dark   = '';

					if ( in_array( $separator, array( 1, 2, 3 ), true ) ) {

						$selector = '#pen_navigation.pen_separator_' . $separator . ' ul#primary-menu > li:after';

						$css_normal = $selector . '{
							background:linear-gradient(180deg, rgba(0,0,0,0) 0%, ' . $link . ' 50%, rgba(0,0,0,0) 100%);
						}';

						if ( PEN_THEME_DARK_MODE ) {

							$selector_dark = pen_inline_css_dark_mode_selector( $selector );

							$css_dark = $selector_dark . '{
								background:linear-gradient(180deg, rgba(0,0,0,0) 0%, ' . $separator_light . ' 50%, rgba(0,0,0,0) 100%);
							}';
						}
					} elseif ( in_array( $separator, array( 4, 5, 7 ), true ) ) {

						$selector = '#pen_navigation.pen_separator_' . $separator . ' ul#primary-menu > li:after';

						$css_normal = $selector . '{
							background:' . $link . ';
						}';

						if ( PEN_THEME_DARK_MODE ) {

							$selector_dark = pen_inline_css_dark_mode_selector( $selector );

							$css_dark = $selector_dark . '{
								background:' . $separator_light . ';
							}';
						}
					} elseif ( 6 === $separator ) {

						$selector = '#pen_navigation.pen_separator_6 ul#primary-menu > li:before,
							#pen_navigation.pen_separator_6 ul#primary-menu > li:after';

						$css_normal = $selector . '{
							background:' . $link . ';
						}';

						if ( PEN_THEME_DARK_MODE ) {

							$selector_dark = pen_inline_css_dark_mode_selector( $selector );

							$css_dark = $selector_dark . '{
								background:' . $separator_light . ';
							}';
						}
					} elseif ( in_array( $separator, array( 8, 9 ), true ) ) {

						$selector = '#pen_navigation.pen_separator_' . $separator . ' ul#primary-menu > li:after';

						$css_normal = $selector . '{
							border-color:' . $link . ';
						}';

						if ( PEN_THEME_DARK_MODE ) {

							$selector_dark = pen_inline_css_dark_mode_selector( $selector );

							$css_dark = $selector_dark . '{
								border-color:' . $separator_light . ';
							}';
						}
					} elseif ( 10 === $separator ) {

						$selector = '#pen_navigation.pen_separator_10 ul#primary-menu > li:after';

						$css_normal = $selector . '{
							color:' . $link . ';
						}';

						if ( PEN_THEME_DARK_MODE ) {

							$selector_dark = pen_inline_css_dark_mode_selector( $selector );

							$css_dark = $selector_dark . '{
								color:' . $separator_light . ';
							}';
						}
					}
					if ( $css_normal ) {
						$css .= $css_normal;
						if ( PEN_THEME_DARK_MODE ) {
							$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
						}
					}
				}
			}

			$hover = (int) pen_option_get( 'navigation_hover' );

			if ( 'preset_1' !== $preset_color && $hover ) {
				if ( 1 === $hover || 2 === $hover ) {
					if ( $color_link->isDark() ) {
						$css .= '#pen_navigation.pen_hover_' . $hover . ' ul#primary-menu > li.sfHover > a,
							#pen_navigation.pen_hover_' . $hover . ' ul#primary-menu > li > a:focus,
							#pen_navigation.pen_hover_' . $hover . ' ul#primary-menu > li > a:hover,
							#pen_navigation.pen_hover_' . $hover . ' ul#primary-menu > li > a:active,
							#pen_navigation.pen_hover_' . $hover . ' ul#primary-menu > li.current-menu-item > a {';
						if ( 'preset_15' === $preset_color ) {
							$css .= 'background:rgba(255,255,255,0.2);';
						} else {
							$css .= 'background:rgba(255,255,255,0.3);';
						}
						$css .= '}';
					}
				} else {

					if ( $color_link->isDark() ) {
						$hover_light = $color_link->lighten( 80 );
						$hover_light = new \Pen_Theme\Color( $hover_light );
						$hover_light = 'rgba(' . implode( ',', $hover_light->getRgb() ) . ',0.9)';
					} else {
						$hover_light = $link;
					}

					$css_normal = '';
					$css_dark   = '';

					if ( in_array( $hover, array( 3, 4, 5, 6, 7, 10 ), true ) ) {

						$selector = '#pen_navigation.pen_hover_' . $hover . ' ul#primary-menu > li > a:after';

						$css_normal = $selector . '{
							background:' . $link . ';
						}';

						if ( PEN_THEME_DARK_MODE ) {

							$selector_dark = pen_inline_css_dark_mode_selector( $selector );

							$css_dark = $selector_dark . '{
								background:' . $hover_light . ';
							}';
						}
					} elseif ( 8 === $hover ) {

						$selector = '#pen_navigation.pen_hover_8 ul#primary-menu > li > a:after';

						$css_normal = $selector . '{
							border-top-color:' . $link . ';
						}';

						if ( PEN_THEME_DARK_MODE ) {

							$selector_dark = pen_inline_css_dark_mode_selector( $selector );

							$css_dark = $selector_dark . '{
								background:' . $hover_light . ';
							}';
						}
					} elseif ( 9 === $hover ) {

						$selector = '#pen_navigation.pen_hover_9 ul#primary-menu > li > a:after';

						$css_normal = $selector . '{
							border-bottom-color:' . $link . ';
						}';

						if ( PEN_THEME_DARK_MODE ) {

							$selector_dark = pen_inline_css_dark_mode_selector( $selector );

							$css_dark = $selector_dark . '{
								border-bottom-color:' . $hover_light . ';
							}';
						}
					}
					if ( $css_normal ) {
						$css .= $css_normal;
						if ( PEN_THEME_DARK_MODE ) {
							$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
						}
					}
				}
			}

			$shadow         = pen_option_get( 'color_navigation_text_shadow' );
			$shadow_default = pen_option_default( 'color_navigation_text_shadow' );
			$shadow_display = pen_option_get( 'color_navigation_text_shadow_display' );

			if ( 'preset_1' !== $preset_color || $shadow !== $shadow_default || ! $shadow_display ) {

				if ( $shadow_display ) {
					$text_shadow = '1px 1px 1px ' . esc_html( $shadow );
				} else {
					$text_shadow = 'none';
				}

				$selector = 'body.pen_drop_shadow #pen_navigation ul#primary-menu a,
					body.pen_drop_shadow #pen_navigation_mobile ul#primary-menu-mobile a,
					body.pen_drop_shadow #pen_navigation_mobile .widget-area a';

				$css_normal = $selector . '{
					text-shadow:' . $text_shadow . ';
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					if ( $shadow_display ) {
						$color_shadow = new \Pen_Theme\Color( $shadow );
						if ( $color_shadow->isLight() ) {
							$shadow_dark = $color_shadow->darken( 100 );
							$shadow_dark = new \Pen_Theme\Color( $shadow_dark );
							$shadow_dark = '1px 1px 1px #' . $shadow_dark->getHex();
						} else {
							$shadow_dark = $shadow;
						}
					} else {
						$shadow_dark = 'none';
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						text-shadow:' . $shadow_dark . ';
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$navigation_transform_text         = esc_html( pen_option_get( 'transform_text_navigation' ) );
			$navigation_transform_text_default = pen_option_default( 'transform_text_navigation' );

			if ( $navigation_transform_text !== $navigation_transform_text_default ) {
				$css .= '#pen_navigation ul#primary-menu a {
					text-transform: ' . $navigation_transform_text . '
				}';
			}

			$navigation_submenu_transform_text         = esc_html( pen_option_get( 'transform_text_navigation_submenu' ) );
			$navigation_submenu_transform_text_default = pen_option_default( 'transform_text_navigation_submenu' );

			if ( $navigation_submenu_transform_text !== $navigation_submenu_transform_text_default ) {
				$css .= '#pen_navigation ul#primary-menu li li a {
					text-transform: ' . $navigation_submenu_transform_text . '
				}';
			}

			$navigation_mobile_transform_text         = esc_html( pen_option_get( 'transform_text_navigation_mobile' ) );
			$navigation_mobile_transform_text_default = pen_option_default( 'transform_text_navigation_mobile' );

			if ( $navigation_mobile_transform_text !== $navigation_mobile_transform_text_default ) {
				$css .= '#pen_navigation_mobile ul#primary-menu-mobile a {
					text-transform: ' . $navigation_mobile_transform_text . '
				}';
			}

			$navigation_submenu_mobile_transform_text         = esc_html( pen_option_get( 'transform_text_navigation_submenu_mobile' ) );
			$navigation_submenu_mobile_transform_text_default = pen_option_default( 'transform_text_navigation_submenu_mobile' );

			if ( $navigation_submenu_mobile_transform_text !== $navigation_submenu_mobile_transform_text_default ) {
				$css .= '#pen_navigation_mobile ul#primary-menu-mobile li li a {
					text-transform: ' . $navigation_submenu_mobile_transform_text . '
				}';
			}

			$link_hover         = esc_html( pen_option_get( 'color_navigation_link_hover' ) );
			$link_hover_default = pen_option_default( 'color_navigation_link_hover' );

			if ( 'preset_1' !== $preset_color || $link_hover !== $link_hover_default ) {

				$selector = '#pen_navigation ul#primary-menu li.sfHover > a,
					#pen_navigation ul#primary-menu a:focus,
					#pen_navigation ul#primary-menu a:hover,
					#pen_navigation ul#primary-menu a:active,
					#pen_navigation_mobile ul#primary-menu-mobile a:focus,
					#pen_navigation_mobile ul#primary-menu-mobile a:hover,
					#pen_navigation_mobile ul#primary-menu-mobile a:active,
					#pen_navigation_mobile ul#primary-menu-mobile ul li.pen_active a,
					#pen_navigation_mobile .widget-area a:focus,
					#pen_navigation_mobile .widget-area a:hover,
					#pen_navigation_mobile .widget-area a:active';

				$css_normal = $selector . '{
					color:' . $link_hover . ';
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_link_hover = new \Pen_Theme\Color( $link_hover );
					if ( $color_link_hover->isDark() ) {
						$link_hover_light = $color_link_hover->lighten( 55 );
						$link_hover_light = new \Pen_Theme\Color( $link_hover_light );
						$link_hover_light = '#' . $link_hover_light->getHex();
					} else {
						$link_hover_light = $link_hover;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						color:' . $link_hover_light . ';
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$link_submenu         = esc_html( pen_option_get( 'color_navigation_link_submenu' ) );
			$link_submenu_default = pen_option_default( 'color_navigation_link_submenu' );

			$navigation_submenu_font = esc_html( pen_option_get( 'font_family_navigation_submenu' ) );

			if ( 'preset_1' !== $preset_color || $link_submenu !== $link_submenu_default || 'g:Roboto' !== $navigation_submenu_font || $navigation_size !== $navigation_size_default ) {

				$selector = '#pen_navigation ul#primary-menu li li a,
					#pen_navigation_mobile ul#primary-menu-mobile li li a';

				$css .= $selector . '{';

				if ( 'preset_1' !== $preset_color || $link_submenu !== $link_submenu_default ) {
					$css .= 'color:' . $link_submenu . ';';
				}
				if ( 'g:Roboto' !== $navigation_submenu_font ) {
					$css .= 'font-family:"' . ltrim( $navigation_submenu_font, 'g:' ) . '", Arial, Helvetica, Sans-serif !important;';
				}
				if ( $navigation_size !== $navigation_size_default ) {
					$css .= 'font-size:' . $navigation_size . ';';
				}
				$css .= '}';

				if ( PEN_THEME_DARK_MODE ) {

					$color_link_submenu = new \Pen_Theme\Color( $link_submenu );
					if ( $color_link_submenu->isDark() ) {
						$link_submenu_light = $color_link_submenu->lighten( 80 );
						$link_submenu_light = new \Pen_Theme\Color( $link_submenu_light );
						$link_submenu_light = '#' . $link_submenu_light->getHex();
					} else {
						$link_submenu_light = $link_submenu;
					}

					$css_normal = $selector . '{
						color: ' . $link_submenu . '
					}';

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						color:' . $link_submenu_light . ';
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}

				$shadow         = pen_option_get( 'color_navigation_text_shadow_submenu' );
				$shadow_default = pen_option_default( 'color_navigation_text_shadow_submenu' );
				$shadow_display = pen_option_get( 'color_navigation_text_shadow_display_submenu' );

				if ( 'preset_1' !== $preset_color || $shadow !== $shadow_default || ! $shadow_display ) {

					if ( $shadow_display ) {
						$text_shadow = '1px 1px 1px ' . esc_html( $shadow );
					} else {
						$text_shadow = 'none';
					}

					$selector = 'body.pen_drop_shadow #pen_navigation ul#primary-menu li li a,
						body.pen_drop_shadow #pen_navigation_mobile ul#primary-menu-mobile li li a';

					$css_normal = $selector . '{
						text-shadow:' . $text_shadow . ';
					}';

					$css .= $css_normal;

					if ( PEN_THEME_DARK_MODE ) {

						if ( $shadow_display ) {
							$color_shadow = new \Pen_Theme\Color( $shadow );
							if ( $color_shadow->isLight() ) {
								$shadow_dark = $color_shadow->darken( 100 );
								$shadow_dark = new \Pen_Theme\Color( $shadow_dark );
								$shadow_dark = '1px 1px 1px #' . $shadow_dark->getHex();
							} else {
								$shadow_dark = $shadow;
							}
						} else {
							$shadow_dark = 'none';
						}

						$selector_dark = pen_inline_css_dark_mode_selector( $selector );

						$css_dark = $selector_dark . '{
							text-shadow:' . $shadow_dark . ';
						}';

						$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
					}
				}

				$separator = (int) pen_option_get( 'navigation_separator_submenu' );

				if ( 'preset_1' !== $preset_color && $separator ) {

					$css_normal = '';
					$css_dark   = '';

					if ( 1 === $separator ) {

						$selector = '#pen_navigation.pen_separator_submenu_1 ul#primary-menu li li:after,
							#pen_navigation_mobile nav.pen_separator_submenu_1 ul#primary-menu-mobile li:after';

						$css_normal = $selector . '{
							background:linear-gradient(90deg,rgba(0,0,0,0) 0%, ' . $link_submenu . ' 25%,rgba(0,0,0,0) 100%);
						}';

						if ( PEN_THEME_DARK_MODE ) {

							$selector_dark = pen_inline_css_dark_mode_selector( $selector );

							$css_dark = $selector_dark . '{
								background:linear-gradient(90deg,rgba(0,0,0,0) 0%, ' . $link_submenu_light . ' 25%,rgba(0,0,0,0) 100%);
							}';
						}
					} elseif ( 2 === $separator ) {

						$selector = '#pen_navigation.pen_separator_submenu_2 ul#primary-menu li li:after,
							#pen_navigation_mobile nav.pen_separator_submenu_2 ul#primary-menu-mobile li:after';

						$css_normal = $selector . '{
							background:linear-gradient(90deg,rgba(0,0,0,0) 0%, ' . $link_submenu . ' 50%,rgba(0,0,0,0) 100%);
						}';

						if ( PEN_THEME_DARK_MODE ) {

							$selector_dark = pen_inline_css_dark_mode_selector( $selector );

							$css_dark = $selector_dark . '{
								background:linear-gradient(90deg,rgba(0,0,0,0) 0%, ' . $link_submenu_light . ' 50%,rgba(0,0,0,0) 100%);
							}';
						}
					} elseif ( 3 === $separator ) {

						$selector = '#pen_navigation.pen_separator_submenu_3 ul#primary-menu li li:after,
							#pen_navigation_mobile nav.pen_separator_submenu_3 ul#primary-menu-mobile li:after';

						$css_normal = $selector . '{
							background:linear-gradient(90deg,rgba(0,0,0,0) 0%, ' . $link_submenu . ' 75%,rgba(0,0,0,0) 100%);
						}';

						if ( PEN_THEME_DARK_MODE ) {

							$selector_dark = pen_inline_css_dark_mode_selector( $selector );

							$css_dark = $selector_dark . '{
								background:linear-gradient(90deg,rgba(0,0,0,0) 0%, ' . $link_submenu_light . ' 75%,rgba(0,0,0,0) 100%);
							}';
						}
					} elseif ( in_array( $separator, array( 4, 5, 7 ), true ) ) {

						$selector = '#pen_navigation.pen_separator_submenu_' . $separator . ' ul#primary-menu li li:after,
							#pen_navigation_mobile nav.pen_separator_submenu_' . $separator . ' ul#primary-menu-mobile li:after';

						$css_normal = $selector . '{
							background:' . $link_submenu . ';
						}';

						if ( PEN_THEME_DARK_MODE ) {

							$selector_dark = pen_inline_css_dark_mode_selector( $selector );

							$css_dark = $selector_dark . '{
								background:' . $link_submenu_light . ';
							}';
						}
					} elseif ( 6 === $separator ) {

						$selector = '#pen_navigation.pen_separator_submenu_6 ul#primary-menu li li:before,
							#pen_navigation.pen_separator_submenu_6 ul#primary-menu li li:after,
							#pen_navigation_mobile nav.pen_separator_submenu_6 ul#primary-menu-mobile li:before,
							#pen_navigation_mobile nav.pen_separator_submenu_6 ul#primary-menu-mobile li:after';

						$css_normal = $selector . '{
							background:' . $link_submenu . ';
						}';

						if ( PEN_THEME_DARK_MODE ) {

							$selector_dark = pen_inline_css_dark_mode_selector( $selector );

							$css_dark = $selector_dark . '{
								background:' . $link_submenu_light . ';
							}}';
						}
					} elseif ( in_array( $separator, array( 8, 9 ), true ) ) {

						$selector = '#pen_navigation.pen_separator_submenu_' . $separator . ' ul#primary-menu li li:after,
							#pen_navigation_mobile nav.pen_separator_submenu_' . $separator . ' ul#primary-menu-mobile li:after';

						$css_normal = $selector . '{
							border-color:' . $link_submenu . ';
						}';

						if ( PEN_THEME_DARK_MODE ) {

							$selector_dark = pen_inline_css_dark_mode_selector( $selector );

							$css_dark = $selector_dark . '{
								border-color:' . $link_submenu_light . ';
							}';
						}
					} elseif ( 10 === $separator ) {

						$selector = '#pen_navigation.pen_separator_submenu_10 ul#primary-menu li li:after,
							#pen_navigation_mobile nav.pen_separator_submenu_10 ul#primary-menu-mobile li:after';

						$css_normal = $selector . '{
							color:' . $link_submenu . ';
						}';

						if ( PEN_THEME_DARK_MODE ) {

							$selector_dark = pen_inline_css_dark_mode_selector( $selector );

							$css_dark = $selector_dark . '{
								color:' . $link_submenu_light . ';
							}';
						}
					}
					if ( $css_normal ) {
						$css .= $css_normal;
						if ( PEN_THEME_DARK_MODE ) {
							$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
						}
					}
				}
			}

			$link_hover_submenu         = esc_html( pen_option_get( 'color_navigation_link_hover_submenu' ) );
			$link_hover_submenu_default = pen_option_default( 'color_navigation_link_hover_submenu' );

			if ( 'preset_1' !== $preset_color || $link_hover_submenu !== $link_hover_submenu_default ) {
				$selector = '#pen_navigation ul#primary-menu li li.sfHover > a,
					#pen_navigation ul#primary-menu li li a:focus,
					#pen_navigation ul#primary-menu li li a:hover,
					#pen_navigation ul#primary-menu li li a:active,
					#pen_navigation_mobile ul#primary-menu-mobile li li a:focus,
					#pen_navigation_mobile ul#primary-menu-mobile li li a:hover,
					#pen_navigation_mobile ul#primary-menu-mobile li li a:active,
					#pen_navigation_mobile ul#primary-menu-mobile li li.pen_active > a';

				$css_normal = $selector . '{
					color:' . $link_hover_submenu . ';
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_link_hover_submenu = new \Pen_Theme\Color( $link_hover_submenu );
					if ( $color_link_hover_submenu->isDark() ) {
						$link_hover_submenu_light = $color_link_hover_submenu->lighten( 55 );
						$link_hover_submenu_light = new \Pen_Theme\Color( $link_hover_submenu_light );
						$link_hover_submenu_light = '#' . $link_hover_submenu_light->getHex();
					} else {
						$link_hover_submenu_light = $link_hover_submenu;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						color:' . $link_hover_submenu_light . ';
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$primary           = esc_html( pen_option_get( 'color_button_navigation_mobile_background_primary' ) );
			$primary_default   = pen_option_default( 'color_button_navigation_mobile_background_primary' );
			$secondary         = esc_html( pen_option_get( 'color_button_navigation_mobile_background_secondary' ) );
			$secondary_default = pen_option_default( 'color_button_navigation_mobile_background_secondary' );

			$text         = esc_html( pen_option_get( 'color_button_navigation_mobile_text' ) );
			$text_default = pen_option_default( 'color_button_navigation_mobile_text' );

			$angle         = esc_html( pen_option_get( 'color_button_navigation_mobile_background_angle' ) );
			$angle_default = pen_option_default( 'color_button_navigation_mobile_background_angle' );

			if ( 'preset_1' !== $preset_color || $primary !== $primary_default || $secondary !== $secondary_default || $text !== $text_default || $angle !== $angle_default ) {

				$selector = '#pen_navigation_mobile_toggle';

				$css_normal = $selector . '{
					background-color:' . $primary . ';
					background:' . $primary . ';';
				if ( $primary !== $secondary ) {
					$css_normal .= 'background:linear-gradient(' . $angle . ',' . $primary . ' 0%,' . $secondary . ' 100%);';
				}
				if ( 'preset_1' !== $preset_color || $text !== $text_default ) {
					$css_normal .= 'color:' . $text . ';';
				}
				$css_normal .= '}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_primary = new \Pen_Theme\Color( $primary );
					if ( $color_primary->isLight() ) {
						$primary_dark = $color_primary->darken( 90 );
						$primary_dark = new \Pen_Theme\Color( $primary_dark );
						$primary_dark = '#' . $primary_dark->getHex();
					} else {
						$primary_dark = $primary;
					}

					$color_secondary = new \Pen_Theme\Color( $secondary );
					if ( $color_secondary->isLight() ) {
						$secondary_dark = $color_secondary->darken( 90 );
						$secondary_dark = new \Pen_Theme\Color( $secondary_dark );
						$secondary_dark = '#' . $secondary_dark->getHex();
					} else {
						$secondary_dark = $secondary;
					}

					$color_text = new \Pen_Theme\Color( $text );
					if ( $color_text->isDark() ) {
						$text_light = $color_text->lighten( 80 );
						$text_light = new \Pen_Theme\Color( $text_light );
						$text_light = '#' . $text_light->getHex();
					} else {
						$text_light = $text;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						background-color:' . $primary_dark . ' !important;
						background:' . $primary_dark . ' !important;';
					if ( $primary_dark !== $secondary_dark ) {
						$css_dark .= 'background:linear-gradient(' . $angle . ',' . $primary_dark . ' 0%,' . $secondary_dark . ' 100%);';
					}
					$css_dark .= '
						color:' . $text_light . ' !important;
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}

				if ( $text !== $text_default ) {

					$selector = '#pen_navigation_mobile_toggle span.pen_icon span';

					$css_normal = $selector . '{
						background:' . $text . ';
					}';

					$css .= $css_normal;

					if ( PEN_THEME_DARK_MODE ) {

						$selector_dark = pen_inline_css_dark_mode_selector( $selector );

						$css_dark = $selector_dark . '{
							background:' . $text_light . ';
						}';

						$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
					}
				}
			}
			$css = pen_compress_css( $css );
		}
		wp_add_inline_style( 'pen-css', $css );
	}
	if ( PEN_THEME_CUSTOM_CSS ) {
		add_action( 'wp_enqueue_scripts', 'pen_inline_css_navigation' );
	}
}

if ( ! function_exists( 'pen_inline_css_search' ) ) {
	/**
	 * Adds inline CSS for the search bar.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_inline_css_search() {

		$css = '';

		$content_id = pen_post_id();

		$search_location = get_post_meta( $content_id, 'pen_content_search_location_override', true );
		if ( ! $search_location || 'default' === $search_location ) {
			$search_location = pen_option_get( 'search_location' );
		}
		$search = pen_html_search_box( $content_id );
		if ( $search && 'content' === $search_location ) {

			$preset_color = pen_preset_get( 'color' );

			$background_primary           = esc_html( pen_option_get( 'color_search_background_primary' ) );
			$background_primary_default   = pen_option_default( 'color_search_background_primary' );
			$background_secondary         = esc_html( pen_option_get( 'color_search_background_secondary' ) );
			$background_secondary_default = pen_option_default( 'color_search_background_secondary' );

			$angle         = esc_html( pen_option_get( 'color_search_background_angle' ) );
			$angle_default = pen_option_default( 'color_search_background_angle' );

			$background_image   = pen_option_get( 'background_image_search' );
			$background_dynamic = get_post_meta( $content_id, 'pen_content_background_image_search_dynamic_override', true );
			if ( ! $background_dynamic || 'default' === $background_dynamic ) {
				$background_dynamic = pen_option_get( 'background_image_search_dynamic' );
			}
			if ( 'featured_image' === $background_dynamic && $content_id ) {
				$image_size = 'original';
				if ( PEN_THEME_SMALLSCREEN || 'narrow' === pen_option_get( 'site_width' ) ) {
					$image_size = 'large';
				}
				$image_dynamic = esc_url( get_the_post_thumbnail_url( null, $image_size ) );
				if ( $image_dynamic ) {
					$background_image = $image_dynamic;
				}
			}

			if ( 'preset_1' !== $preset_color || $background_primary !== $background_primary_default || $background_secondary !== $background_secondary_default || $background_image || $angle !== $angle_default ) {

				$selector = '#pen_search.pen_not_transparent';

				$css_normal = $selector . '{
					background-color:' . $background_primary . ';
					background:' . $background_primary . ';';
				if ( $background_primary !== $background_secondary ) {
					$css_normal .= 'background:linear-gradient(' . $angle . ',' . $background_primary . ' 0%,' . $background_secondary . ' 100%);';
				}
				if ( $background_image ) {
					$css_normal .= "background-image:url('" . esc_html( $background_image ) . "') !important;
						background-repeat:no-repeat !important;
						background-position:top center !important;
						background-size:cover !important;";
				}
				$css_normal .= '}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_background_primary = new \Pen_Theme\Color( $background_primary );
					if ( $color_background_primary->isLight() ) {
						$background_primary_dark = $color_background_primary->darken( 80 );
						$background_primary_dark = new \Pen_Theme\Color( $background_primary_dark );
						$background_primary_dark = '#' . $background_primary_dark->getHex();
					} else {
						$background_primary_dark = $background_primary;
					}

					$color_background_secondary = new \Pen_Theme\Color( $background_secondary );
					if ( $color_background_secondary->isLight() ) {
						$background_secondary_dark = $color_background_secondary->darken( 80 );
						$background_secondary_dark = new \Pen_Theme\Color( $background_secondary_dark );
						$background_secondary_dark = '#' . $background_secondary_dark->getHex();
					} else {
						$background_secondary_dark = $background_secondary;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						background-color:' . $background_primary_dark . ' !important;
						background:' . $background_primary_dark . ' !important;';
					if ( $background_primary_dark !== $background_secondary_dark ) {
						$css_dark .= 'background:linear-gradient(' . $angle . ',' . $background_primary_dark . ' 0%,' . $background_secondary_dark . ' 100%) !important;';
					}
					if ( $background_image ) {
						$css_dark .= "background-image:url('" . esc_html( $background_image ) . "') !important;
							background-repeat:no-repeat !important;
							background-position:top center !important;
							background-size:cover !important;";
					}
					$css_dark .= '}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$field_primary           = esc_html( pen_option_get( 'color_search_field_background_primary' ) );
			$field_primary_default   = pen_option_default( 'color_search_field_background_primary' );
			$field_secondary         = esc_html( pen_option_get( 'color_search_field_background_secondary' ) );
			$field_secondary_default = pen_option_default( 'color_search_field_background_secondary' );

			$angle         = esc_html( pen_option_get( 'color_search_field_background_angle' ) );
			$angle_default = pen_option_default( 'color_search_field_background_angle' );

			$field_text         = esc_html( pen_option_get( 'color_search_field_text' ) );
			$field_text_default = pen_option_default( 'color_search_field_text' );

			if ( 'preset_1' !== $preset_color || $field_primary !== $field_primary_default || $field_secondary !== $field_secondary_default || $field_text !== $field_text_default ) {

				$selector = '#pen_search .search-form .search-field,
				#pen_search form.wp-block-search .wp-block-search__input';

				$css_normal = $selector . '{
					background:' . $field_secondary . ';';
				if ( $field_primary !== $field_secondary ) {
					$css_normal .= 'background:linear-gradient(' . $angle . ',' . $field_primary . ' 0%,' . $field_secondary . ' 100%);';
				}
				if ( 'preset_1' !== $preset_color || $field_text !== $field_text_default ) {
					$css_normal .= 'color:' . $field_text . ';';
				}
				$css_normal .= '}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_field_primary = new \Pen_Theme\Color( $field_primary );
					if ( $color_field_primary->isLight() ) {
						$field_primary_dark = $color_field_primary->darken( 80 );
						$field_primary_dark = new \Pen_Theme\Color( $field_primary_dark );
						$field_primary_dark = '#' . $field_primary_dark->getHex();
					} else {
						$field_primary_dark = $field_primary;
					}

					$color_field_secondary = new \Pen_Theme\Color( $field_secondary );
					if ( $color_field_secondary->isLight() ) {
						$field_secondary_dark = $color_field_secondary->darken( 80 );
						$field_secondary_dark = new \Pen_Theme\Color( $field_secondary_dark );
						$field_secondary_dark = '#' . $field_secondary_dark->getHex();
					} else {
						$field_secondary_dark = $field_secondary;
					}

					$color_field_text = new \Pen_Theme\Color( $field_text );
					if ( $color_field_text->isDark() ) {
						$field_text_light = $color_field_text->lighten( 80 );
						$field_text_light = new \Pen_Theme\Color( $field_text_light );
						$field_text_light = '#' . $field_text_light->getHex();
					} else {
						$field_text_light = $field_text;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						background-color:' . $field_primary_dark . ' !important;
						background:' . $field_primary_dark . ' !important;';
					if ( $field_primary_dark !== $field_secondary_dark ) {
						$css_dark .= 'background:linear-gradient(' . $angle . ',' . $field_primary_dark . ' 0%,' . $field_secondary_dark . ' 100%);';
					}
					$css_dark .= 'color:' . $field_text_light . '}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$text         = esc_html( pen_option_get( 'color_search_text' ) );
			$text_default = pen_option_default( 'color_search_text' );
			if ( 'preset_1' !== $preset_color || $text !== $text_default ) {

				$selector = '#pen_search .widget';

				$css_normal = $selector . '{
					color:' . $text . ';
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_text = new \Pen_Theme\Color( $text );
					if ( $color_text->isDark() ) {
						$text_light = $color_text->lighten( 80 );
						$text_light = new \Pen_Theme\Color( $text_light );
						$text_light = '#' . $text_light->getHex();
					} else {
						$text_light = $text;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						color:' . $text_light . ';
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$shadow         = pen_option_get( 'color_search_text_shadow' );
			$shadow_default = pen_option_default( 'color_search_text_shadow' );
			$shadow_display = pen_option_get( 'color_search_text_shadow_display' );

			if ( 'preset_1' !== $preset_color || $shadow !== $shadow_default || ! $shadow_display ) {

				if ( $shadow_display ) {
					$text_shadow = '1px 1px 2px ' . esc_html( $shadow );
				} else {
					$text_shadow = 'none';
				}

				$selector = 'body.pen_drop_shadow #pen_search .widget';

				$css_normal = $selector . '{
					text-shadow:' . $text_shadow . ';
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					if ( $shadow_display ) {
						$color_shadow = new \Pen_Theme\Color( $shadow );
						if ( $color_shadow->isLight() ) {
							$shadow_dark = $color_shadow->darken( 100 );
							$shadow_dark = new \Pen_Theme\Color( $shadow_dark );
							$shadow_dark = '1px 1px 2px #' . $shadow_dark->getHex();
						} else {
							$shadow_dark = $shadow;
						}
					} else {
						$shadow_dark = 'none';
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						text-shadow:' . $shadow_dark . ';
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$link         = esc_html( pen_option_get( 'color_search_link' ) );
			$link_default = pen_option_default( 'color_search_link' );
			if ( 'preset_1' !== $preset_color || $link !== $link_default ) {

				$selector = '#pen_search .widget a';

				$css_normal = $selector . '{
					color:' . $link . ';
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_link = new \Pen_Theme\Color( $link );
					if ( $color_link->isDark() ) {
						$link_light = $color_link->lighten( 80 );
						$link_light = new \Pen_Theme\Color( $link_light );
						$link_light = '#' . $link_light->getHex();
					} else {
						$link_light = $link;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						color:' . $link_light . ';
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$link_hover         = esc_html( pen_option_get( 'color_search_link_hover' ) );
			$link_hover_default = pen_option_default( 'color_search_link_hover' );

			if ( 'preset_1' !== $preset_color || $link_hover !== $link_hover_default ) {

				$selector = '#pen_search .widget a:focus,
					#pen_search .widget a:hover,
					#pen_search .widget a:active';

				$css_normal = $selector . '{
					color:' . $link_hover . ' !important;
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_link_hover = new \Pen_Theme\Color( $link_hover );
					if ( $color_link_hover->isDark() ) {
						$link_hover_light = $color_link_hover->lighten( 55 );
						$link_hover_light = new \Pen_Theme\Color( $link_hover_light );
						$link_hover_light = '#' . $link_hover_light->getHex();
					} else {
						$link_hover_light = $link_hover;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						color:' . $link_hover_light . ' !important;
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$search_background_primary           = esc_html( pen_option_get( 'color_search_button_background_primary' ) );
			$search_background_primary_default   = pen_option_default( 'color_search_button_background_primary' );
			$search_background_secondary         = esc_html( pen_option_get( 'color_search_button_background_secondary' ) );
			$search_background_secondary_default = pen_option_default( 'color_search_button_background_secondary' );

			$angle         = esc_html( pen_option_get( 'color_search_button_background_angle' ) );
			$angle_default = pen_option_default( 'color_search_button_background_angle' );

			$search_text         = esc_html( pen_option_get( 'color_search_button_text' ) );
			$search_text_default = pen_option_default( 'color_search_button_text' );

			if ( 'preset_1' !== $preset_color || $search_background_primary !== $search_background_primary_default || $search_background_secondary !== $search_background_secondary_default || $search_text !== $search_text_default ) {

				$selector = '#pen_search .search-form .search-submit,
				#pen_search form.wp-block-search .wp-block-search__button';

				$css_normal = $selector . '{
					background:' . $search_background_secondary . ';';
				if ( $search_background_primary !== $search_background_secondary ) {
					$css_normal .= 'background:linear-gradient(' . $angle . ',' . $search_background_primary . ' 0%,' . $search_background_secondary . ' 100%) !important;';
				}
				if ( 'preset_1' !== $preset_color || $search_text !== $search_text_default ) {
					$css_normal .= 'color:' . $search_text . ' !important;';
				}
				$css_normal .= '}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_text = new \Pen_Theme\Color( $search_text );
					if ( $color_text->isDark() ) {
						$text_light = $color_text->lighten( 80 );
						$text_light = new \Pen_Theme\Color( $text_light );
						$text_light = '#' . $text_light->getHex();
					} else {
						$text_light = $search_text;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						color:' . $text_light . '
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}

				$selector = '#pen_search .search-form .search-submit:active,
				#pen_search form.wp-block-search .wp-block-search__button:active';

				$css_normal = $selector . '{
					background:' . $search_background_secondary . ' !important;
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_search_background_secondary = new \Pen_Theme\Color( $search_background_secondary );
					if ( $color_search_background_secondary->isDark() ) {
						$search_background_secondary_light = $color_search_background_secondary->lighten( 80 );
						$search_background_secondary_light = new \Pen_Theme\Color( $search_background_secondary_light );
						$search_background_secondary_light = '#' . $search_background_secondary_light->getHex();
					} else {
						$search_background_secondary_light = $search_background_secondary;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						background:' . $search_background_secondary_light . '
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			if ( 'preset_1' !== $preset_color || $field_text !== $field_text_default ) {

				$color_placeholder = new \Pen_Theme\Color( $field_text );
				$placeholder_rgb   = 'rgba(' . implode( ',', $color_placeholder->getRgb() ) . ',0.75)';

				$selector_webkit = '#pen_search input::-webkit-input-placeholder,
					#pen_search select::-webkit-input-placeholder,
					#pen_search textarea::-webkit-input-placeholder';

				$selector_moz = '#pen_search input::-moz-placeholder,
					#pen_search select::-moz-placeholder,
					#pen_search textarea::-moz-placeholder';

				$selector_ms = '#pen_search input:-ms-input-placeholder,
					#pen_search select:-ms-input-placeholder,
					#pen_search textarea:-ms-input-placeholder';

				$css_normal = $selector_webkit . '{
					color:' . $placeholder_rgb . ' !important;
				}' . $selector_moz . '{
					color:' . $placeholder_rgb . ' !important;
				}' . $selector_ms . '{
					color:' . $placeholder_rgb . ' !important;
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					if ( $color_placeholder->isDark() ) {
						$placeholder_light = $color_placeholder->lighten( 80 );
						$placeholder_light = new \Pen_Theme\Color( $placeholder_light );
						$placeholder_light = 'rgba(' . implode( ',', $placeholder_light->getRgb() ) . ',0.75)';
					} else {
						$placeholder_light = $placeholder_rgb;
					}

					$selector_webkit_dark = pen_inline_css_dark_mode_selector( $selector_webkit );
					$selector_moz_dark    = pen_inline_css_dark_mode_selector( $selector_moz );
					$selector_ms_dark     = pen_inline_css_dark_mode_selector( $selector_ms );

					$css_dark = $selector_webkit_dark . '{
						color:' . $placeholder_light . ' !important;
					}' . $selector_moz_dark . '{
						color:' . $placeholder_light . ' !important;
					}' . $selector_ms_dark . '{
						color:' . $placeholder_light . ' !important;
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}
			$css = pen_compress_css( $css );
		}
		wp_add_inline_style( 'pen-css', $css );
	}
	if ( PEN_THEME_CUSTOM_CSS ) {
		add_action( 'wp_enqueue_scripts', 'pen_inline_css_search' );
	}
}

if ( ! function_exists( 'pen_inline_css_content' ) ) {
	/**
	 * Adds inline CSS for the content area.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_inline_css_content() {

		$content_id      = pen_post_id();
		$pen_is_singular = pen_is_singular();

		$css = '';

		$preset_color = pen_preset_get( 'color' );

		$primary           = esc_html( pen_option_get( 'color_content_title_background_primary' ) );
		$primary_default   = pen_option_default( 'color_content_title_background_primary' );
		$secondary         = esc_html( pen_option_get( 'color_content_title_background_secondary' ) );
		$secondary_default = pen_option_default( 'color_content_title_background_secondary' );

		$angle         = esc_html( pen_option_get( 'color_content_title_background_angle' ) );
		$angle_default = pen_option_default( 'color_content_title_background_angle' );

		$background_image = esc_html( pen_option_get( 'background_image_content_title' ) );
		$dynamic          = get_post_meta( $content_id, 'pen_content_background_image_content_title_dynamic_override', true );
		if ( ! $dynamic || 'default' === $dynamic ) {
			$dynamic = pen_option_get( 'background_image_content_title_dynamic' );
		}
		if ( $pen_is_singular && 'featured_image' === $dynamic ) {
			$background_image_size = 'original';
			if ( PEN_THEME_SMALLSCREEN || 'narrow' === pen_option_get( 'site_width' ) ) {
				$background_image_size = 'large';
			}
			$background_image_dynamic = esc_url( get_the_post_thumbnail_url( null, $background_image_size ) );
			if ( $background_image_dynamic ) {
				$background_image = $background_image_dynamic;
			}
		}

		if ( 'preset_1' !== $preset_color || $primary !== $primary_default || $secondary !== $secondary_default || $background_image || $angle !== $angle_default ) {

			$selector = '#main .pen_article header.pen_content_header';

			$css_normal = $selector . '{
				background-color:' . $primary . ';
				background:' . $primary . ';';
			if ( $primary !== $secondary ) {
				$css_normal .= 'background:linear-gradient(' . $angle . ',' . $primary . ' 0%,' . $secondary . ' 100%);';
			}
			if ( $background_image ) {
				$css_normal .= "background-image:url('" . esc_html( $background_image ) . "') !important;
					background-repeat:no-repeat !important;
					background-position:top center !important;
					background-size:cover !important;";
			}
			$css_normal .= '}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$color_primary = new \Pen_Theme\Color( $primary );
				if ( $color_primary->isLight() ) {
					$primary_dark = $color_primary->darken( 80 );
					$primary_dark = new \Pen_Theme\Color( $primary_dark );
					$primary_dark = '#' . $primary_dark->getHex();
				} else {
					$primary_dark = $primary;
				}

				$color_secondary = new \Pen_Theme\Color( $secondary );
				if ( $color_secondary->isLight() ) {
					$secondary_dark = $color_secondary->darken( 80 );
					$secondary_dark = new \Pen_Theme\Color( $secondary_dark );
					$secondary_dark = '#' . $secondary_dark->getHex();
				} else {
					$secondary_dark = $secondary;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					background-color:' . $primary_dark . ' !important;
					background:' . $primary_dark . ' !important;';
				if ( $primary_dark !== $secondary_dark ) {
					$css_dark .= 'background:linear-gradient(' . $angle . ',' . $primary_dark . ' 0%,' . $secondary_dark . ' 100%) !important;';
				}
				if ( $background_image ) {
					$css_dark .= "background-image:url('" . esc_html( $background_image ) . "') !important;
						background-repeat:no-repeat !important;
						background-position:top center !important;
						background-size:cover !important;";
				}
				$css_dark .= '}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$text         = esc_html( pen_option_get( 'color_content_text' ) );
		$text_default = pen_option_default( 'color_content_text' );

		if ( 'preset_1' !== $preset_color || $text !== $text_default ) {

			$selector = '#main article.pen_article,
				body.pen_multiple #main li.pen_article,
				#main .pen_summary,
				#main .pen_content_footer,
				#main label,
				#comments,
				#comments h3';

			if ( PEN_THEME_HAS_WOOCOMMERCE ) {
				$selector .= ',
					body.pen_has_woocommerce #page .woocommerce-notices-wrapper,
					body.pen_has_woocommerce #page div.product .woocommerce-tabs,
					body.pen_has_woocommerce #page div.product .up-sells,
					body.pen_has_woocommerce #page div.product .related,
					body.pen_has_woocommerce #page .wc-block-pagination-page.wc-block-components-pagination__page';
			}

			$css_normal = $selector . '{
				color:' . $text . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$color_text = new \Pen_Theme\Color( $text );
				if ( $color_text->isDark() ) {
					$text_light = $color_text->lighten( 80 );
					$text_light = new \Pen_Theme\Color( $text_light );
					$text_light = '#' . $text_light->getHex();
				} else {
					$text_light = $text;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					color:' . $text_light . ' !important;
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}

			$view            = $pen_is_singular ? 'content' : 'list';
			$profile_display = get_post_meta( $content_id, 'pen_' . $view . '_profile_display_override', true );

			if ( ! $profile_display || 'default' === $profile_display ) {
				$profile_display = esc_html( pen_option_get( $view . '_profile_display' ) );
			}

			if ( $profile_display ) {

				$selector = '#primary .pen_author_profile:before';

				$css_normal = $selector . '{
					background: linear-gradient(90deg, rgba(255,255,255,0) 0%,' . $text . ' 50%, rgba(255,255,255,0) 100%);
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_text = new \Pen_Theme\Color( $text );
					if ( $color_text->isDark() ) {
						$text_light = $color_text->lighten( 80 );
						$text_light = new \Pen_Theme\Color( $text_light );
						$text_light = '#' . $text_light->getHex();
					} else {
						$text_light = $text;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						background: linear-gradient(90deg, rgba(0,0,0,0) 0%,' . $text_light . ' 50%, rgba(0,0,0,0) 100%);
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}
		}

		if ( 'preset_1' !== $preset_color || $text !== $text_default ) {

			$separator = (int) pen_option_get( 'content_details_separator' );

			$separator_rgb = 'rgba(' . implode( ',', $color_text->getRgb() ) . ',0.9)';

			if ( PEN_THEME_DARK_MODE ) {
				if ( $color_text->isDark() ) {
					$separator_light = $color_text->lighten( 80 );
					$separator_light = new \Pen_Theme\Color( $separator_light );
					$separator_light = 'rgba(' . implode( ',', $separator_light->getRgb() ) . ',0.9)';
				} else {
					$separator_light = $separator;
				}
			}

			$css_normal = '';
			$css_dark   = '';

			if ( in_array( $separator, array( 1, 2, 3 ), true ) ) {

				$selector = '#main .pen_article .pen_content_footer .entry-meta.pen_separator_1 > span:after,
					#main .pen_article .pen_content_footer .entry-meta.pen_separator_2 > span:after,
					#main .pen_article .pen_content_footer .entry-meta.pen_separator_3 > span:after';

				$css_normal = $selector . '{
					background: linear-gradient(180deg, rgba(0,0,0,0) 0%, ' . $separator_rgb . ' 50%, rgba(0,0,0,0) 100%);
				}';

				if ( PEN_THEME_DARK_MODE ) {

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						background: linear-gradient(180deg, rgba(0,0,0,0) 0%, ' . $separator_light . ' 50%, rgba(0,0,0,0) 100%);
					}';
				}
			} elseif ( in_array( $separator, array( 4, 5, 6, 7 ), true ) ) {

				$selector = '#main .pen_article .pen_content_footer .entry-meta.pen_separator_4 > span:after,
					#main .pen_article .pen_content_footer .entry-meta.pen_separator_5 > span:after,
					#main .pen_article .pen_content_footer .entry-meta.pen_separator_6 > span:after,
					#main .pen_article .pen_content_footer .entry-meta.pen_separator_6 > span:before,
					#main .pen_article .pen_content_footer .entry-meta.pen_separator_7 > span:after';

				$css_normal = $selector . '{
					background:' . $separator_rgb . ';
				}';

				if ( PEN_THEME_DARK_MODE ) {

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						background:' . $separator_light . ';
					}';
				}
			} elseif ( in_array( $separator, array( 8, 9 ), true ) ) {

				$selector = '#main .pen_article .pen_content_footer .entry-meta.pen_separator_8 > span:after,
					#main .pen_article .pen_content_footer .entry-meta.pen_separator_9 > span:after';

				$css_normal = $selector . '{
					border-color:' . $separator_rgb . ';
				}';

				if ( PEN_THEME_DARK_MODE ) {

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						border-color:' . $separator_light . ';
					}';
				}
			} elseif ( 10 === $separator ) {

				$selector = '#main .pen_article .pen_content_footer .entry-meta.pen_separator_10 > span:after';

				$css_normal = $selector . '{
					color:' . $separator_rgb . ';
				}';

				if ( PEN_THEME_DARK_MODE ) {

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						color:' . $separator_light . ';
					}';
				}
			}
			if ( $css_normal ) {
				$css .= $css_normal;
				if ( PEN_THEME_DARK_MODE ) {
					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}
		}

		$background_primary           = esc_html( pen_option_get( 'color_content_background_primary' ) );
		$background_primary_default   = pen_option_default( 'color_content_background_primary' );
		$background_secondary         = esc_html( pen_option_get( 'color_content_background_secondary' ) );
		$background_secondary_default = pen_option_default( 'color_content_background_secondary' );

		$angle         = esc_html( pen_option_get( 'color_content_background_angle' ) );
		$angle_default = pen_option_default( 'color_content_background_angle' );

		if ( 'preset_1' !== $preset_color || $background_primary !== $background_primary_default || $background_secondary !== $background_secondary_default || $angle !== $angle_default ) {

			$selector = '#main article.pen_article,
				body.pen_multiple #main li.pen_article,
				#comments,
				#comments ol.comment-list li.comment div.comment-author .photo,
				#pen_content_next_previous,
				body.pen_list_plain #pen_pager';

			if ( PEN_THEME_HAS_WOOCOMMERCE ) {
				$selector .= ',
					body.pen_list_plain.pen_has_woocommerce #page .woocommerce-pagination,
					body.pen_has_woocommerce.pen_list_tile #pen_tiles ul.wc-block-grid__products li.wc-block-grid__product,
					body.pen_has_woocommerce.pen_list_masonry #pen_masonry ul.wc-block-grid__products li.wc-block-grid__product,
					body.pen_has_woocommerce.pen_list_tile #pen_tiles ul.products li.product,
					body.pen_has_woocommerce.pen_list_masonry #pen_masonry ul.products li.product,
					body.pen_has_woocommerce.single-product div.product #reviews #comments ol.commentlist li.review .avatar';
			}

			$css_normal = $selector . '{
				background-color:' . $background_primary . ';
				background:' . $background_primary . ';';
			if ( $background_primary !== $background_secondary ) {
				$css_normal .= 'background:linear-gradient(' . $angle . ',' . $background_primary . ' 0%,' . $background_secondary . ' 100%);';
			}
			$css_normal .= '}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {
				$color_background_primary = new \Pen_Theme\Color( $background_primary );
				if ( $color_background_primary->isLight() ) {
					$background_primary_dark = $color_background_primary->darken( 80 );
					$background_primary_dark = new \Pen_Theme\Color( $background_primary_dark );
					$background_primary_dark = '#' . $background_primary_dark->getHex();
				} else {
					$background_primary_dark = $background_primary;
				}

				$color_background_secondary = new \Pen_Theme\Color( $background_secondary );
				if ( $color_background_secondary->isLight() ) {
					$background_secondary_dark = $color_background_secondary->darken( 80 );
					$background_secondary_dark = new \Pen_Theme\Color( $background_secondary_dark );
					$background_secondary_dark = '#' . $background_secondary_dark->getHex();
				} else {
					$background_secondary_dark = $background_secondary;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					background-color:' . $background_primary_dark . ' !important;
					background:' . $background_primary_dark . ' !important;';
				if ( $background_primary_dark !== $background_secondary_dark ) {
					$css_dark .= 'background:linear-gradient(' . $angle . ',' . $background_primary_dark . ' 0%,' . $background_secondary_dark . ' 100%) !important;';
				}
				$css_dark .= '}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$background_primary           = esc_html( pen_option_get( 'color_content_footer_background_primary' ) );
		$background_primary_default   = pen_option_default( 'color_content_footer_background_primary' );
		$background_secondary         = esc_html( pen_option_get( 'color_content_footer_background_secondary' ) );
		$background_secondary_default = pen_option_default( 'color_content_footer_background_secondary' );

		$angle         = esc_html( pen_option_get( 'color_content_footer_background_angle' ) );
		$angle_default = pen_option_default( 'color_content_footer_background_angle' );

		if ( 'preset_1' !== $preset_color || $background_primary !== $background_primary_default || $background_secondary !== $background_secondary_default || $angle !== $angle_default ) {

			$selector = '#main .pen_article .pen_content_footer';

			$css_normal = $selector . '{
				background-color:' . $background_primary . ';
				background:' . $background_primary . ';';
			if ( $background_primary !== $background_secondary ) {
				$css_normal .= 'background:linear-gradient(' . $angle . ',' . $background_primary . ' 0%,' . $background_secondary . ' 100%);';
			}
			$css_normal .= '
				padding-top: 2rem !important;
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {
				$color_background_primary = new \Pen_Theme\Color( $background_primary );
				if ( $color_background_primary->isLight() ) {
					$background_primary_dark = $color_background_primary->darken( 80 );
					$background_primary_dark = new \Pen_Theme\Color( $background_primary_dark );
					$background_primary_dark = '#' . $background_primary_dark->getHex();
				} else {
					$background_primary_dark = $background_primary;
				}

				$color_background_secondary = new \Pen_Theme\Color( $background_secondary );
				if ( $color_background_secondary->isLight() ) {
					$background_secondary_dark = $color_background_secondary->darken( 80 );
					$background_secondary_dark = new \Pen_Theme\Color( $background_secondary_dark );
					$background_secondary_dark = '#' . $background_secondary_dark->getHex();
				} else {
					$background_secondary_dark = $background_secondary;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					background-color:' . $background_primary_dark . ' !important;
					background:' . $background_primary_dark . ' !important;';
				if ( $background_primary_dark !== $background_secondary_dark ) {
					$css_dark .= 'background:linear-gradient(' . $angle . ',' . $background_primary_dark . ' 0%,' . $background_secondary_dark . ' 100%) !important;';
				}
				$css_dark .= '}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$link               = esc_html( pen_option_get( 'color_content_link' ) );
		$link_default       = pen_option_default( 'color_content_link' );
		$link_hover         = esc_html( pen_option_get( 'color_content_link_hover' ) );
		$link_hover_default = pen_option_default( 'color_content_link_hover' );

		if ( 'preset_1' !== $preset_color || $link !== $link_default ) {

			$selector = '#primary a:not([class^=\'wp-block\'])';

			$css_normal = $selector . '{
				color:' . $link . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {
				$color_link = new \Pen_Theme\Color( $link );
				if ( $color_link->isDark() ) {
					$link_light = $color_link->lighten( 80 );
					$link_light = new \Pen_Theme\Color( $link_light );
					$link_light = '#' . $link_light->getHex();
				} else {
					$link_light = $link;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					color:' . $link_light . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		if ( 'preset_1' !== $preset_color || $link_hover !== $link_hover_default ) {

			$selector = '#primary a:not([class^=\'wp-block\']):focus,
				#primary a:not([class^=\'wp-block\']):hover,
				#primary a:not([class^=\'wp-block\']):active';

			$css_normal = $selector . '{
				color:' . $link_hover . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {
				$color_link_hover = new \Pen_Theme\Color( $link_hover );
				if ( $color_link_hover->isDark() ) {
					$link_hover_light = $color_link_hover->lighten( 55 );
					$link_hover_light = new \Pen_Theme\Color( $link_hover_light );
					$link_hover_light = '#' . $link_hover_light->getHex();
				} else {
					$link_hover_light = $link_hover;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					color:' . $link_hover_light . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		if ( $pen_is_singular ) {
			$title_font         = esc_html( pen_option_get( 'font_family_title_content' ) );
			$title_size         = esc_html( pen_option_get( 'font_size_title_content' ) );
			$title_size_default = pen_option_default( 'font_size_title_content' );
		} else {
			$title_font         = esc_html( pen_option_get( 'font_family_title_list' ) );
			$title_size         = esc_html( pen_option_get( 'font_size_title_list' ) );
			$title_size_default = pen_option_default( 'font_size_title_list' );
		}

		if ( 'preset_1' !== $preset_color || $title_size !== $title_size_default || 'g:Roboto' !== $title_font ) {
			$css .= '#main header.pen_content_header .pen_content_title {';
			if ( 'g:Roboto' !== $title_font ) {
				$css .= 'font-family:"' . ltrim( $title_font, 'g:' ) . '", Arial, Helvetica, Sans-serif !important;';
			}
			if ( $title_size !== $title_size_default ) {
				$css .= 'font-size:' . $title_size . ' !important;';
			}
			$css .= '}';
		}

		$shadow         = pen_option_get( 'color_content_title_text_shadow' );
		$shadow_default = pen_option_default( 'color_content_title_text_shadow' );
		$shadow_display = pen_option_get( 'color_content_title_text_shadow_display' );

		if ( 'preset_1' !== $preset_color || $shadow !== $shadow_default || ! $shadow_display ) {

			if ( $shadow_display ) {
				$text_shadow = '1px 1px 2px ' . esc_html( $shadow );
			} else {
				$text_shadow = 'none';
			}

			$selector = 'body.pen_drop_shadow #main header.pen_content_header .pen_content_title';

			$css_normal = $selector . '{
				text-shadow:' . $text_shadow . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				if ( $shadow_display ) {
					$color_shadow = new \Pen_Theme\Color( $shadow );
					if ( $color_shadow->isLight() ) {
						$shadow_dark = $color_shadow->darken( 100 );
						$shadow_dark = new \Pen_Theme\Color( $shadow_dark );
						$shadow_dark = '1px 1px 2px #' . $shadow_dark->getHex();
					} else {
						$shadow_dark = $shadow;
					}
				} else {
					$shadow_dark = 'none';
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					text-shadow:' . $shadow_dark . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$title         = esc_html( pen_option_get( 'color_content_title_text' ) );
		$title_default = pen_option_default( 'color_content_title_text' );
		$color_title   = new \Pen_Theme\Color( $title );
		if ( PEN_THEME_DARK_MODE ) {
			if ( $color_title->isDark() ) {
				$title_light = $color_title->lighten( 100 );
				$title_light = new \Pen_Theme\Color( $title_light );
				$title_light = 'rgba(' . implode( ',', $title_light->getRgb() ) . ',0.9)';
			} else {
				$title_light = $title;
			}
		}

		if ( 'preset_1' !== $preset_color || $title !== $title_default ) {

			$selector = '#main .pen_article header.pen_content_header';

			$css_normal = $selector . '{
				color:' . $title . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {
				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					color:' . $title_light . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$link         = esc_html( pen_option_get( 'color_content_title_link' ) );
		$link_default = pen_option_default( 'color_content_title_link' );

		if ( 'preset_1' !== $preset_color || $link !== $link_default ) {

			$selector = '#main .pen_article header.pen_content_header a';

			$css_normal = $selector . '{
				color:' . $link . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {
				$color_link = new \Pen_Theme\Color( $link );
				if ( $color_link->isDark() ) {
					$link_light = $color_link->lighten( 80 );
					$link_light = new \Pen_Theme\Color( $link_light );
					$link_light = '#' . $link_light->getHex();
				} else {
					$link_light = $link;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					color:' . $link_light . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}

			$separator = (int) pen_option_get( 'content_details_separator' );

			if ( $separator ) {

				$separator_rgb = 'rgba(' . implode( ',', $color_title->getRgb() ) . ',0.9)';

				$css_normal = '';
				$css_dark   = '';

				if ( in_array( $separator, array( 1, 2, 3 ), true ) ) {
					$selector = '#main .pen_article .pen_content_header .entry-meta.pen_separator_' . $separator . ' > span:after';

					$css_normal = $selector . '{
						background: linear-gradient(180deg, rgba(0,0,0,0) 0%, ' . $separator_rgb . ' 50%, rgba(0,0,0,0) 100%);
					}';

					if ( PEN_THEME_DARK_MODE ) {

						$selector_dark = pen_inline_css_dark_mode_selector( $selector );

						$css_dark = $selector_dark . '{
							background: linear-gradient(180deg, rgba(0,0,0,0) 0%, ' . $title_light . ' 50%, rgba(0,0,0,0) 100%);
						}';
					}
				} elseif ( in_array( $separator, array( 4, 5, 7 ), true ) ) {

					$selector = '#main .pen_article .pen_content_header .entry-meta.pen_separator_' . $separator . ' > span:after';

					$css_normal = $selector . '{
						background:' . $separator_rgb . ';
					}';

					if ( PEN_THEME_DARK_MODE ) {
						$selector_dark = pen_inline_css_dark_mode_selector( $selector );

						$css_dark = $selector_dark . '{
							background:' . $title_light . ';
						}';
					}
				} elseif ( 6 === $separator ) {

					$selector = '#main .pen_article .pen_content_header .entry-meta.pen_separator_6 > span:before,
						#main .pen_article .pen_content_header .entry-meta.pen_separator_6 > span:after';

					$css_normal = $selector . '{
						background:' . $separator_rgb . ';
					}';

					if ( PEN_THEME_DARK_MODE ) {

						$selector_dark = pen_inline_css_dark_mode_selector( $selector );

						$css_dark = $selector_dark . '{
							background:' . $title_light . ';
						}';
					}
				} elseif ( in_array( $separator, array( 8, 9 ), true ) ) {

					$selector = '#main .pen_article .pen_content_header .entry-meta.pen_separator_' . $separator . ' > span:after';

					$css_normal = $selector . '{
						border-color:' . $separator_rgb . ';
					}';

					if ( PEN_THEME_DARK_MODE ) {
						$selector_dark = pen_inline_css_dark_mode_selector( $selector );

						$css_dark = $selector_dark . '{
							border-color:' . $title_light . ';
						}';
					}
				} elseif ( 10 === $separator ) {

					$selector = '#main .pen_article .pen_content_header .entry-meta.pen_separator_10 > span:after';

					$css_normal = $selector . '{
						color:' . $separator_rgb . ';
					}';

					if ( PEN_THEME_DARK_MODE ) {

						$selector_dark = pen_inline_css_dark_mode_selector( $selector );

						$css_dark = $selector_dark . '{
							color:' . $title_light . ';
						}';
					}
				}
				if ( $css_normal ) {
					$css .= $css_normal;
					if ( PEN_THEME_DARK_MODE ) {

						$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
					}
				}
			}
		}

		$link_hover         = esc_html( pen_option_get( 'color_content_title_link_hover' ) );
		$link_hover_default = pen_option_default( 'color_content_title_link_hover' );

		if ( 'preset_1' !== $preset_color || $link_hover !== $link_hover_default ) {

			$selector = '#main .pen_article header.pen_content_header a:focus,
				#main .pen_article header.pen_content_header a:hover,
				#main .pen_article header.pen_content_header a:active';

			$css_normal = $selector . '{
				color:' . $link_hover . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$color_link_hover = new \Pen_Theme\Color( $link_hover );
				if ( $color_link_hover->isDark() ) {
					$link_hover_light = $color_link_hover->lighten( 55 );
					$link_hover_light = new \Pen_Theme\Color( $link_hover_light );
					$link_hover_light = '#' . $link_hover_light->getHex();
				} else {
					$link_hover_light = $link_hover;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					color:' . $link_hover_light . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$field_primary           = esc_html( pen_option_get( 'color_content_field_background_primary' ) );
		$field_primary_default   = pen_option_default( 'color_content_field_background_primary' );
		$field_secondary         = esc_html( pen_option_get( 'color_content_field_background_secondary' ) );
		$field_secondary_default = pen_option_default( 'color_content_field_background_secondary' );

		$angle         = esc_html( pen_option_get( 'color_content_field_background_angle' ) );
		$angle_default = pen_option_default( 'color_content_field_background_angle' );

		$field_text         = esc_html( pen_option_get( 'color_content_field_text' ) );
		$field_text_default = pen_option_default( 'color_content_field_text' );

		if ( 'preset_1' !== $preset_color || $field_primary !== $field_primary_default || $field_secondary !== $field_secondary_default || $field_text !== $field_text_default ) {

			$selector = '#page input[type="date"],
				#page input[type="datetime"],
				#page input[type="datetime-local"],
				#page input[type="email"],
				#page input[type="month"],
				#page input[type="number"],
				#page input[type="password"],
				#page input[type="search"],
				#page input[type="tel"],
				#page input[type="text"],
				#page input[type="time"],
				#page input[type="url"],
				#page input[type="week"],
				#page option,
				#page select,
				#page textarea';

			$css_normal = $selector . '{
				background:' . $field_primary . ';';
			if ( $field_primary !== $field_secondary ) {
				$css_normal .= 'background:linear-gradient(' . $angle . ',' . $field_primary . ' 0%,' . $field_secondary . ' 100%);';
			}
			if ( 'preset_1' !== $preset_color || $field_text !== $field_text_default ) {
				$css_normal .= 'color:' . $field_text . ';';
			}
			$css_normal .= '}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$color_field_primary = new \Pen_Theme\Color( $field_primary );
				if ( $color_field_primary->isLight() ) {
					$field_primary_dark = $color_field_primary->darken( 80 );
					$field_primary_dark = new \Pen_Theme\Color( $field_primary_dark );
					$field_primary_dark = '#' . $field_primary_dark->getHex();
				} else {
					$field_primary_dark = $field_primary;
				}

				$color_field_secondary = new \Pen_Theme\Color( $field_secondary );
				if ( $color_field_secondary->isLight() ) {
					$field_secondary_dark = $color_field_secondary->darken( 80 );
					$field_secondary_dark = new \Pen_Theme\Color( $field_secondary_dark );
					$field_secondary_dark = '#' . $field_secondary_dark->getHex();
				} else {
					$field_secondary_dark = $field_secondary;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					background-color:' . $field_primary_dark . ' !important;
					background:' . $field_primary_dark . ' !important;';
				if ( $field_primary_dark !== $field_secondary_dark ) {
					$css_dark .= 'background:linear-gradient(' . $angle . ',' . $field_primary_dark . ' 0%,' . $field_secondary_dark . ' 100%);';
				}
				$css_dark .= '}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}

			$selector = '#page option';

			$css_normal = $selector . '{
				background:' . $field_secondary . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					background-color:' . $field_primary_dark . ' !important;
					background:' . $field_primary_dark . ' !important;';
				if ( $field_primary_dark !== $field_secondary_dark ) {
					$css_dark .= 'background:linear-gradient(' . $angle . ',' . $field_primary_dark . ' 0%,' . $field_secondary_dark . ' 100%) !important;';
				}
				$css_dark .= '}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}

			if ( 'preset_1' !== $preset_color || $field_text !== $field_text_default ) {

				$color_placeholder = new \Pen_Theme\Color( $field_text );
				$placeholder_rgb   = 'rgba(' . implode( ',', $color_placeholder->getRgb() ) . ',0.75)';

				$selector_webkit = '#page input::-webkit-input-placeholder,
					#page select::-webkit-input-placeholder,
					#page textarea::-webkit-input-placeholder';

				$selector_moz = '#page input::-moz-placeholder,
					#page select::-moz-placeholder,
					#page textarea::-moz-placeholder';

				$selector_ms = '#page input:-ms-input-placeholder,
					#page select:-ms-input-placeholder,
					#page textarea:-ms-input-placeholder';

				$css_normal = $selector_webkit . '{
					color:' . $placeholder_rgb . ' !important;
				}' . $selector_moz . '{
					color:' . $placeholder_rgb . ' !important;
				}' . $selector_ms . '{
					color:' . $placeholder_rgb . ' !important;
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					if ( $color_placeholder->isDark() ) {
						$placeholder_light = $color_placeholder->lighten( 80 );
						$placeholder_light = new \Pen_Theme\Color( $placeholder_light );
						$placeholder_light = 'rgba(' . implode( ',', $placeholder_light->getRgb() ) . ',0.75)';
					} else {
						$placeholder_light = $placeholder_rgb;
					}

					$selector_webkit_dark = pen_inline_css_dark_mode_selector( $selector_webkit );
					$selector_moz_dark    = pen_inline_css_dark_mode_selector( $selector_moz );
					$selector_ms_dark     = pen_inline_css_dark_mode_selector( $selector_ms );

					$css_dark = $selector_webkit_dark . '{
						color:' . $placeholder_light . ' !important;
					}' . $selector_moz_dark . '{
						color:' . $placeholder_light . ' !important;
					}' . $selector_ms_dark . '{
						color:' . $placeholder_light . ' !important;
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$selector = '.select2-container--default .select2-selection--single,
				.select2-container--default .select2-selection--multiple,
				.select2-container--default .select2-dropdown';

			$css_normal = $selector . '{
				background-color:' . $field_secondary . ';
				background:' . $field_secondary . ';
				border:1px solid ' . $field_secondary . ';';
			/* The .select2-dropdown stays outside the #page. */
			if ( $field_primary !== $field_secondary ) {
				$css_normal .= 'background:linear-gradient(' . $angle . ',' . $field_primary . ' 0%,' . $field_secondary . ' 100%);';
			}
			if ( 'preset_1' !== $preset_color || $field_text !== $field_text_default ) {
				$css_normal .= 'color:' . $field_text . ';';
			}
			$css_normal .= '}';

			$css .= $css_normal;

			$color_field_primary = new \Pen_Theme\Color( $field_primary );
			if ( $color_field_primary->isLight() ) {
				$field_primary_dark = $color_field_primary->darken( 80 );
				$field_primary_dark = new \Pen_Theme\Color( $field_primary_dark );
				$field_primary_dark = '#' . $field_primary_dark->getHex();
			} else {
				$field_primary_dark = $field_primary;
			}

			if ( PEN_THEME_DARK_MODE ) {

				$color_field_secondary = new \Pen_Theme\Color( $field_secondary );
				if ( $color_field_secondary->isLight() ) {
					$field_secondary_dark = $color_field_secondary->darken( 80 );
					$field_secondary_dark = new \Pen_Theme\Color( $field_secondary_dark );
					$field_secondary_dark = '#' . $field_secondary_dark->getHex();
				} else {
					$field_secondary_dark = $field_secondary;
				}

				$color_field_text = new \Pen_Theme\Color( $field_text );
				if ( $color_field_text->isDark() ) {
					$field_text_light = $color_field_text->lighten( 80 );
					$field_text_light = new \Pen_Theme\Color( $field_text_light );
					$field_text_light = '#' . $field_text_light->getHex();
				} else {
					$field_text_light = $field_text;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					background-color:' . $field_secondary_dark . ' !important;
					background:' . $field_secondary_dark . ' !important;
					border:1px solid ' . $field_secondary_dark . ' !important;';
				if ( $field_primary_dark !== $field_secondary_dark ) {
					$css_dark .= 'background:linear-gradient(' . $angle . ',' . $field_primary_dark . ' 0%,' . $field_secondary_dark . ' 100%) !important;';
				}
				$css_dark .= '
					color:' . $field_text_light . ' !important;
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}

			if ( 'preset_1' !== $preset_color || $field_text !== $field_text_default ) {

				$selector = '.select2-container--default .select2-selection__rendered,
					.select2-container--default .select2-search__field,
					.select2-container--default .select2-results__option';

				$css_normal = $selector . '{
					color:' . $field_text . ' !important;
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						color:' . $field_text_light . ';
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$selector = '.select2-container--default .select2-results__option[aria-selected=true],
				.select2-container--default .select2-results__option[data-selected=true],
				.select2-container--default .select2-results__option--highlighted[aria-selected],
				.select2-container--default .select2-selection--multiple .select2-selection__choice';

			$css_normal = $selector . '{
				background:linear-gradient(' . $angle . ',' . $field_secondary . ' 0%,' . $field_primary . ' 100%);
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					background-color:' . $field_secondary_dark . ' !important;
					background:' . $field_secondary_dark . ' !important;';
				if ( $field_secondary_dark !== $field_primary_dark ) {
					$css_dark .= 'background:linear-gradient(' . $angle . ',' . $field_secondary_dark . ' 0%,' . $field_primary_dark . ' 100%);';
				}
				$css_dark .= '}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$css = pen_compress_css( $css );

		wp_add_inline_style( 'pen-css', $css );
	}
	if ( PEN_THEME_CUSTOM_CSS ) {
		add_action( 'wp_enqueue_scripts', 'pen_inline_css_content' );
	}
}

if ( ! function_exists( 'pen_inline_css_list' ) ) {
	/**
	 * Adds inline CSS for lists.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_inline_css_list() {

		$css = '';

		$content_id = pen_post_id();

		$preset_color = pen_preset_get( 'color' );

		$list_type = pen_list_type( $content_id );

		if ( 'masonry' === $list_type || 'tiles' === $list_type ) {
			$type                         = ( ( 'tiles' === $list_type ) ? 'tile' : $list_type );
			$list_thumbnail_style         = esc_html( pen_option_get( 'list_' . $type . '_thumbnail_style' ) );
			$background_primary           = esc_html( pen_option_get( 'color_list_thumbnail_background_primary' ) );
			$background_primary_default   = pen_option_default( 'color_list_thumbnail_background_primary' );
			$background_secondary         = esc_html( pen_option_get( 'color_list_thumbnail_background_secondary' ) );
			$background_secondary_default = pen_option_default( 'color_list_thumbnail_background_secondary' );

			if ( 'preset_1' !== $preset_color || $background_primary !== $background_primary_default || $background_secondary !== $background_secondary_default ) {
				$css .= 'body.pen_list_' . $list_type . ' #pen_' . $list_type . ' .pen_article.pen_thumbnail_style_' . $list_thumbnail_style . ' .pen_image_thumbnail {
					background:linear-gradient(90deg, ' . $background_primary . ' 0%, ' . $background_secondary . ' 50%, ' . $background_primary . ' 100%) !important;
				}';
			}
		}

		$css = pen_compress_css( $css );

		wp_add_inline_style( 'pen-css', $css );
	}
	if ( PEN_THEME_CUSTOM_CSS ) {
		add_action( 'wp_enqueue_scripts', 'pen_inline_css_list' );
	}
}

if ( ! function_exists( 'pen_inline_css_bottom' ) ) {
	/**
	 * Adds inline CSS for the bottom area.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_inline_css_bottom() {

		$css = '';

		$content_id = pen_post_id();

		$preset_color = pen_preset_get( 'color' );

		if ( pen_sidebar_check( 'sidebar-bottom', $content_id ) ) {

			$primary           = esc_html( pen_option_get( 'color_bottom_background_primary' ) );
			$primary_default   = pen_option_default( 'color_bottom_background_primary' );
			$secondary         = esc_html( pen_option_get( 'color_bottom_background_secondary' ) );
			$secondary_default = pen_option_default( 'color_bottom_background_secondary' );

			$angle         = esc_html( pen_option_get( 'color_bottom_background_angle' ) );
			$angle_default = pen_option_default( 'color_bottom_background_angle' );

			$background_image   = esc_html( pen_option_get( 'background_image_bottom' ) );
			$background_dynamic = get_post_meta( $content_id, 'pen_content_background_image_bottom_dynamic_override', true );
			if ( ! $background_dynamic || 'default' === $background_dynamic ) {
				$background_dynamic = pen_option_get( 'background_image_bottom_dynamic' );
			}
			if ( 'featured_image' === $background_dynamic && $content_id ) {
				$image_size = 'original';
				if ( PEN_THEME_SMALLSCREEN || 'narrow' === pen_option_get( 'site_width' ) ) {
					$image_size = 'large';
				}
				$image_dynamic = esc_url( get_the_post_thumbnail_url( null, $image_size ) );
				if ( $image_dynamic ) {
					$background_image = $image_dynamic;
				}
			}

			if ( 'preset_1' !== $preset_color || $primary !== $primary_default || $secondary !== $secondary_default || $background_image || $angle !== $angle_default ) {

				$selector = '#pen_bottom.pen_not_transparent';

				$css_normal = $selector . '{
					background-color:' . $primary . ';
					background:' . $primary . ';';
				if ( $primary !== $secondary ) {
					$css_normal .= 'background:linear-gradient(' . $angle . ',' . $primary . ' 0%,' . $secondary . ' 100%);';
				}
				if ( $background_image ) {
					$css_normal .= "background-image:url('" . esc_html( $background_image ) . "') !important;
					background-repeat:no-repeat !important;
					background-position:top center !important;
					background-size:cover !important;";
				}
				$css_normal .= '}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_primary = new \Pen_Theme\Color( $primary );
					if ( $color_primary->isLight() ) {
						$primary_dark = $color_primary->darken( 80 );
						$primary_dark = new \Pen_Theme\Color( $primary_dark );
						$primary_dark = '#' . $primary_dark->getHex();
					} else {
						$primary_dark = $primary;
					}

					$color_secondary = new \Pen_Theme\Color( $secondary );
					if ( $color_secondary->isLight() ) {
						$secondary_dark = $color_secondary->darken( 80 );
						$secondary_dark = new \Pen_Theme\Color( $secondary_dark );
						$secondary_dark = '#' . $secondary_dark->getHex();
					} else {
						$secondary_dark = $secondary;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						background-color:' . $secondary_dark . ' !important;
						background:' . $secondary_dark . ' !important;';
					if ( $primary_dark !== $secondary_dark ) {
						$css_dark .= 'background:linear-gradient(' . $angle . ',' . $primary_dark . ' 0%,' . $secondary_dark . ' 100%) !important;';
					}
					if ( $background_image ) {
						$css_dark .= "background-image:url('" . esc_html( $background_image ) . "') !important;
							background-repeat:no-repeat !important;
							background-position:top center !important;
							background-size:cover !important;";
					}
					$css_dark .= '}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$text         = esc_html( pen_option_get( 'color_bottom_text' ) );
			$text_default = pen_option_default( 'color_bottom_text' );

			if ( 'preset_1' !== $preset_color || $text !== $text_default ) {

				$selector = '#pen_bottom,
					#page #pen_bottom label';

				$css_normal = $selector . '{
					color:' . $text . '
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_text = new \Pen_Theme\Color( $text );
					if ( $color_text->isDark() ) {
						$text_light = $color_text->lighten( 75 );
						$text_light = new \Pen_Theme\Color( $text_light );
						$text_light = '#' . $text_light->getHex();
					} else {
						$text_light = $text;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						color:' . $text_light . ' !important;
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$shadow         = pen_option_get( 'color_bottom_text_shadow' );
			$shadow_default = pen_option_default( 'color_bottom_text_shadow' );
			$shadow_display = pen_option_get( 'color_bottom_text_shadow_display' );

			if ( 'preset_1' !== $preset_color || $shadow !== $shadow_default || ! $shadow_display ) {

				if ( $shadow_display ) {
					$text_shadow = '1px 1px 2px ' . esc_html( $shadow );
				} else {
					$text_shadow = 'none';
				}

				$selector = 'body.pen_drop_shadow #pen_bottom';

				$css_normal = $selector . '{
					text-shadow:' . $text_shadow . ';
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					if ( $shadow_display ) {
						$color_shadow = new \Pen_Theme\Color( $shadow );
						if ( $color_shadow->isLight() ) {
							$shadow_dark = $color_shadow->darken( 100 );
							$shadow_dark = new \Pen_Theme\Color( $shadow_dark );
							$shadow_dark = '1px 1px 2px #' . $shadow_dark->getHex();
						} else {
							$shadow_dark = $shadow;
						}
					} else {
						$shadow_dark = 'none';
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						text-shadow:' . $shadow_dark . ';
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$headings         = esc_html( pen_option_get( 'color_bottom_headings' ) );
			$headings_default = pen_option_default( 'color_bottom_headings' );

			if ( 'preset_1' !== $preset_color || $headings !== $headings_default ) {

				$selector = '#pen_bottom .pen_widget_transparent h2,
					#pen_bottom .pen_widget_transparent h3,
					#pen_bottom .pen_widget_transparent h4,
					#pen_bottom .pen_widget_transparent h5';

				$css_normal = $selector . '{
					color:' . $headings . ';
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_text = new \Pen_Theme\Color( $text );
					if ( $color_text->isDark() ) {
						$text_light = $color_text->lighten( 80 );
						$text_light = new \Pen_Theme\Color( $text_light );
						$text_light = '#' . $text_light->getHex();
					} else {
						$text_light = $text;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						color:' . $text_light . ';
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$shadow         = pen_option_get( 'color_bottom_headings_text_shadow' );
			$shadow_default = pen_option_default( 'color_bottom_headings_text_shadow' );
			$shadow_display = pen_option_get( 'color_bottom_headings_text_shadow_display' );

			if ( 'preset_1' !== $preset_color || $shadow !== $shadow_default || ! $shadow_display ) {

				if ( $shadow_display ) {
					$text_shadow = '1px 1px 2px ' . esc_html( $shadow );
				} else {
					$text_shadow = 'none';
				}

				$selector = 'body.pen_drop_shadow #pen_bottom .pen_widget_transparent h2,
					body.pen_drop_shadow #pen_bottom .pen_widget_transparent h3,
					body.pen_drop_shadow #pen_bottom .pen_widget_transparent h4,
					body.pen_drop_shadow #pen_bottom .pen_widget_transparent h5';

				$css_normal = $selector . '{
					text-shadow:' . $text_shadow . ';
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					if ( $shadow_display ) {
						$color_shadow = new \Pen_Theme\Color( $shadow );
						if ( $color_shadow->isLight() ) {
							$shadow_dark = $color_shadow->darken( 100 );
							$shadow_dark = new \Pen_Theme\Color( $shadow_dark );
							$shadow_dark = '1px 1px 2px #' . $shadow_dark->getHex();
						} else {
							$shadow_dark = $shadow;
						}
					} else {
						$shadow_dark = 'none';
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						text-shadow:' . $shadow_dark . ';
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$widget_title_bottom_font              = esc_html( pen_option_get( 'font_family_widget_title_bottom' ) );
			$widget_title_bottom_font_size         = esc_html( pen_option_get( 'font_size_widget_title_bottom' ) );
			$widget_title_bottom_font_size_default = pen_option_default( 'font_size_widget_title_bottom' );

			if ( 'g:Roboto' !== $widget_title_bottom_font || $widget_title_bottom_font_size !== $widget_title_bottom_font_size_default ) {
				$css .= '#pen_bottom .widget-title,
					#pen_bottom .widget_block h2 {';
				if ( 'g:Roboto' !== $widget_title_bottom_font ) {
					$css .= 'font-family:"' . ltrim( $widget_title_bottom_font, 'g:' ) . '", Arial, Helvetica, Sans-serif !important;';
				}
				if ( $widget_title_bottom_font_size !== $widget_title_bottom_font_size_default ) {
					$css .= 'font-size:' . $widget_title_bottom_font_size . ';';
				}
				$css .= '}';
			}

			$field_primary           = esc_html( pen_option_get( 'color_bottom_field_background_primary' ) );
			$field_primary_default   = pen_option_default( 'color_bottom_field_background_primary' );
			$field_secondary         = esc_html( pen_option_get( 'color_bottom_field_background_secondary' ) );
			$field_secondary_default = pen_option_default( 'color_bottom_field_background_secondary' );

			$angle         = esc_html( pen_option_get( 'color_bottom_field_background_angle' ) );
			$angle_default = pen_option_default( 'color_bottom_field_background_angle' );

			$field_text         = esc_html( pen_option_get( 'color_bottom_field_text' ) );
			$field_text_default = pen_option_default( 'color_bottom_field_text' );

			if ( 'preset_1' !== $preset_color || $field_primary !== $field_primary_default || $field_secondary !== $field_secondary_default || $field_text !== $field_text_default ) {

				$selector = '#pen_bottom input[type="date"],
					#pen_bottom input[type="datetime"],
					#pen_bottom input[type="datetime-local"],
					#pen_bottom input[type="email"],
					#pen_bottom input[type="month"],
					#pen_bottom input[type="number"],
					#pen_bottom input[type="password"],
					#pen_bottom input[type="search"],
					#pen_bottom input[type="tel"],
					#pen_bottom input[type="text"],
					#pen_bottom input[type="time"],
					#pen_bottom input[type="url"],
					#pen_bottom input[type="week"],
					#pen_bottom option,
					#pen_bottom select,
					#pen_bottom textarea';

				$css_normal = $selector . '{
						background:' . $field_secondary . ';';
				if ( $field_primary !== $field_secondary ) {
					$css_normal .= 'background:linear-gradient(' . $angle . ',' . $field_primary . ' 0%,' . $field_secondary . ' 100%);';
				}
				if ( 'preset_1' !== $preset_color || $field_text !== $field_text_default ) {
					$css_normal .= 'color:' . $field_text . ';';
				}
				$css_normal .= '}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_field_primary = new \Pen_Theme\Color( $field_primary );
					if ( $color_field_primary->isLight() ) {
						$field_primary_dark = $color_field_primary->darken( 80 );
						$field_primary_dark = new \Pen_Theme\Color( $field_primary_dark );
						$field_primary_dark = '#' . $field_primary_dark->getHex();
					} else {
						$field_primary_dark = $field_primary;
					}

					$color_field_secondary = new \Pen_Theme\Color( $field_secondary );
					if ( $color_field_secondary->isLight() ) {
						$field_secondary_dark = $color_field_secondary->darken( 80 );
						$field_secondary_dark = new \Pen_Theme\Color( $field_secondary_dark );
						$field_secondary_dark = '#' . $field_secondary_dark->getHex();
					} else {
						$field_secondary_dark = $field_secondary;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						background-color:' . $field_primary_dark . ' !important;
						background:' . $field_primary_dark . ' !important;';
					if ( $field_primary_dark !== $field_secondary_dark ) {
						$css_dark .= 'background:linear-gradient(' . $angle . ',' . $field_primary_dark . ' 0%,' . $field_secondary_dark . ' 100%) !important;';
					}
					$css_dark .= '}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}

				$selector = '#pen_bottom option';

				$css_normal = $selector . '{
					background:' . $field_secondary . ';
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						background-color:' . $field_primary_dark . ' !important;
						background:' . $field_primary_dark . ' !important;';
					if ( $field_primary_dark !== $field_secondary_dark ) {
						$css_dark .= 'background:linear-gradient(' . $angle . ',' . $field_primary_dark . ' 0%,' . $field_secondary_dark . ' 100%) !important;';
					}
					$css_dark .= '}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}

				if ( 'preset_1' !== $preset_color || $field_text !== $field_text_default ) {

					$color_placeholder = new \Pen_Theme\Color( $field_text );
					$placeholder_rgb   = 'rgba(' . implode( ',', $color_placeholder->getRgb() ) . ',0.75)';

					$selector_webkit = '#pen_bottom input::-webkit-input-placeholder,
						#pen_bottom select::-webkit-input-placeholder,
						#pen_bottom textarea::-webkit-input-placeholder';

					$selector_moz = '#pen_bottom input::-moz-placeholder,
						#pen_bottom select::-moz-placeholder,
						#pen_bottom textarea::-moz-placeholder';

					$selector_ms = '#pen_bottom input:-ms-input-placeholder,
						#pen_bottom select:-ms-input-placeholder,
						#pen_bottom textarea:-ms-input-placeholder';

					$css_normal = $selector_webkit . '{
						color:' . $placeholder_rgb . ' !important;
					}' . $selector_moz . '{
						color:' . $placeholder_rgb . ' !important;
					}' . $selector_ms . '{
						color:' . $placeholder_rgb . ' !important;
					}';

					$css .= $css_normal;

					if ( PEN_THEME_DARK_MODE ) {

						if ( $color_placeholder->isDark() ) {
							$placeholder_light = $color_placeholder->lighten( 80 );
							$placeholder_light = new \Pen_Theme\Color( $placeholder_light );
							$placeholder_light = 'rgba(' . implode( ',', $placeholder_light->getRgb() ) . ',0.75)';
						} else {
							$placeholder_light = $placeholder_rgb;
						}

						$selector_webkit_dark = pen_inline_css_dark_mode_selector( $selector_webkit );
						$selector_moz_dark    = pen_inline_css_dark_mode_selector( $selector_moz );
						$selector_ms_dark     = pen_inline_css_dark_mode_selector( $selector_ms );

						$css_dark = $selector_webkit_dark . '{
							color:' . $placeholder_light . ' !important;
						}' . $selector_moz_dark . '{
							color:' . $placeholder_light . ' !important;
						}' . $selector_ms_dark . '{
							color:' . $placeholder_light . ' !important;
						}';

						$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
					}
				}
			}

			$link         = esc_html( pen_option_get( 'color_bottom_link' ) );
			$link_default = pen_option_default( 'color_bottom_link' );

			if ( 'preset_1' !== $preset_color || $link !== $link_default ) {

				$selector = '#pen_bottom a';

				$css_normal = $selector . '{
					color:' . $link . ';
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_link = new \Pen_Theme\Color( $link );
					if ( $color_link->isDark() ) {
						$link_light = $color_link->lighten( 80 );
						$link_light = new \Pen_Theme\Color( $link_light );
						$link_light = '#' . $link_light->getHex();
					} else {
						$link_light = $link;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						color:' . $link_light . ';
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}

			$link_hover         = esc_html( pen_option_get( 'color_bottom_link_hover' ) );
			$link_hover_default = pen_option_default( 'color_bottom_link_hover' );

			if ( 'preset_1' !== $preset_color || $link_hover !== $link_hover_default ) {

				$selector = '#pen_bottom a:focus,
					#pen_bottom a:hover,
					#pen_bottom a:active';

				$css_normal = $selector . '{
					color:' . $link_hover . ';
				}';

				$css .= $css_normal;

				if ( PEN_THEME_DARK_MODE ) {

					$color_link_hover = new \Pen_Theme\Color( $link_hover );
					if ( $color_link_hover->isDark() ) {
						$link_hover_light = $color_link_hover->lighten( 55 );
						$link_hover_light = new \Pen_Theme\Color( $link_hover_light );
						$link_hover_light = '#' . $link_hover_light->getHex();
					} else {
						$link_hover_light = $link_hover;
					}

					$selector_dark = pen_inline_css_dark_mode_selector( $selector );

					$css_dark = $selector_dark . '{
						color:' . $link_hover_light . ';
					}';

					$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
				}
			}
			$css = pen_compress_css( $css );
		}

		wp_add_inline_style( 'pen-css', $css );
	}
	if ( PEN_THEME_CUSTOM_CSS ) {
		add_action( 'wp_enqueue_scripts', 'pen_inline_css_bottom' );
	}
}

if ( ! function_exists( 'pen_inline_css_footer' ) ) {
	/**
	 * Adds inline CSS for the footer area.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_inline_css_footer() {

		$content_id = pen_post_id();

		$css = '';

		$preset_color = pen_preset_get( 'color' );

		$background_primary           = esc_html( pen_option_get( 'color_footer_background_primary' ) );
		$background_primary_default   = pen_option_default( 'color_footer_background_primary' );
		$background_secondary         = esc_html( pen_option_get( 'color_footer_background_secondary' ) );
		$background_secondary_default = pen_option_default( 'color_footer_background_secondary' );

		$angle         = esc_html( pen_option_get( 'color_footer_background_angle' ) );
		$angle_default = pen_option_default( 'color_footer_background_angle' );

		$background_image   = esc_html( pen_option_get( 'background_image_footer' ) );
		$background_dynamic = get_post_meta( $content_id, 'pen_content_background_image_footer_dynamic_override', true );
		if ( ! $background_dynamic || 'default' === $background_dynamic ) {
			$background_dynamic = pen_option_get( 'background_image_footer_dynamic' );
		}
		if ( 'featured_image' === $background_dynamic && $content_id ) {
			$image_size = 'original';
			if ( PEN_THEME_SMALLSCREEN || 'narrow' === pen_option_get( 'site_width' ) ) {
				$image_size = 'large';
			}
			$image_dynamic = esc_url( get_the_post_thumbnail_url( null, $image_size ) );
			if ( $image_dynamic ) {
				$background_image = $image_dynamic;
			}
		}

		$link         = esc_html( pen_option_get( 'color_footer_link' ) );
		$link_default = pen_option_default( 'color_footer_link' );

		if ( PEN_THEME_DARK_MODE ) {

			$color_background_secondary = new \Pen_Theme\Color( $background_secondary );
			if ( $color_background_secondary->isLight() ) {
				$background_secondary_dark = $color_background_secondary->darken( 90 );
				$background_secondary_dark = new \Pen_Theme\Color( $background_secondary_dark );
				$background_secondary_dark = '#' . $background_secondary_dark->getHex();
			} else {
				$background_secondary_dark = $background_secondary;
			}

			$color_link = new \Pen_Theme\Color( $link );
			if ( $color_link->isDark() ) {
				$link_light = $color_link->lighten( 80 );
				$link_light = new \Pen_Theme\Color( $link_light );
				$link_light = '#' . $link_light->getHex();
			} else {
				$link_light = $link;
			}
		}

		if ( 'preset_1' !== $preset_color || $background_primary !== $background_primary_default || $background_secondary !== $background_secondary_default || $background_image || $angle !== $angle_default || $link !== $link_default ) {

			$selector = '#pen_footer.pen_not_transparent';

			$css_normal = $selector . '{
				background-color:' . $background_primary . ';
				background:' . $background_primary . ';';
			if ( $background_primary !== $background_secondary ) {
				$css_normal .= 'background:linear-gradient(' . $angle . ',' . $background_primary . ' 0%,' . $background_secondary . ' 100%);';
			}
			if ( $background_image ) {
				$css_normal .= "background-image:url('" . esc_html( $background_image ) . "') !important;
					background-repeat:no-repeat !important;
					background-position:top center !important;
					background-size:cover !important;";
			}
			$css_normal .= '}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$color_background_primary = new \Pen_Theme\Color( $background_primary );
				if ( $color_background_primary->isLight() ) {
					$background_primary_dark = $color_background_primary->darken( 90 );
					$background_primary_dark = new \Pen_Theme\Color( $background_primary_dark );
					$background_primary_dark = '#' . $background_primary_dark->getHex();
				} else {
					$background_primary_dark = $background_primary;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					background-color:' . $background_primary_dark . ' !important;
					background:' . $background_primary_dark . ' !important;';
				if ( $background_primary_dark !== $background_secondary_dark ) {
					$css_dark .= 'background:linear-gradient(' . $angle . ',' . $background_primary_dark . ' 0%,' . $background_secondary_dark . ' 100%) !important;';
				}
				if ( $background_image ) {
					$css_dark .= "background-image:url('" . esc_html( $background_image ) . "') !important;
						background-repeat:no-repeat !important;
						background-position:top center !important;
						background-size:cover !important;";
				}
				$css_dark .= '}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}

			$selector = 'a#pen_back';

			$css_normal = $selector . '{
				background:' . $background_secondary . ';
				color:' . $link . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					background:' . $background_secondary_dark . ';
					color:' . $link_light . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$text         = esc_html( pen_option_get( 'color_footer_text' ) );
		$text_default = pen_option_default( 'color_footer_text' );
		if ( 'preset_1' !== $preset_color || $text !== $text_default ) {

			$selector = '#pen_footer';

			$css_normal = $selector . '{
				color:' . $text . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {
				$color_text = new \Pen_Theme\Color( $text );
				if ( $color_text->isDark() ) {
					$text_light = $color_text->lighten( 80 );
					$text_light = new \Pen_Theme\Color( $text_light );
					$text_light = 'rgba(' . implode( ',', $text_light->getRgb() ) . ',0.9)';
				} else {
					$text_light = $text;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					color:' . $text_light . ' !important;
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$shadow         = pen_option_get( 'color_footer_text_shadow' );
		$shadow_default = pen_option_default( 'color_footer_text_shadow' );
		$shadow_display = pen_option_get( 'color_footer_text_shadow_display' );

		if ( 'preset_1' !== $preset_color || $shadow !== $shadow_default || ! $shadow_display ) {

			if ( $shadow_display ) {
				$text_shadow = '1px 1px 2px ' . esc_html( $shadow );
			} else {
				$text_shadow = 'none';
			}

			$selector = 'body.pen_drop_shadow #pen_footer.pen_not_transparent,
				body.pen_drop_shadow a#pen_back';

			$css_normal = $selector . '{
				text-shadow:' . $text_shadow . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				if ( $shadow_display ) {
					$color_shadow = new \Pen_Theme\Color( $shadow );
					if ( $color_shadow->isLight() ) {
						$shadow_dark = $color_shadow->darken( 100 );
						$shadow_dark = new \Pen_Theme\Color( $shadow_dark );
						$shadow_dark = '1px 1px 2px #' . $shadow_dark->getHex();
					} else {
						$shadow_dark = $shadow;
					}
				} else {
					$shadow_dark = 'none';
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					text-shadow:' . $shadow_dark . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		if ( pen_option_get( 'phone' ) && pen_option_get( 'phone_footer_display' ) ) {

			$phone_font         = esc_html( pen_option_get( 'font_family_phone_footer' ) );
			$phone_size         = esc_html( pen_option_get( 'font_size_phone_footer' ) );
			$phone_size_default = pen_option_default( 'font_size_phone_footer' );

			if ( 'preset_1' !== $preset_color || 'g:Roboto' !== $phone_font || $phone_size !== $phone_size_default ) {
				$css .= '#pen_footer .pen_footer_inner .pen_phone {';
				if ( 'g:Roboto' !== $phone_font ) {
					$css .= 'font-family:"' . ltrim( $phone_font, 'g:' ) . '", Arial, Helvetica, Sans-serif !important;';
				}
				if ( $phone_size !== $phone_size_default ) {
					$css .= 'font-size:' . $phone_size . ';';
				}
				$css .= '}';
			}
		}

		if ( 'preset_1' !== $preset_color || $link !== $link_default ) {

			$selector = '#pen_footer a,
				#pen_footer .pen_footer_inner .pen_social_networks a';

			$css_normal = $selector . '{
				color:' . $link . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					color:' . $link_light . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}

			$separator = (int) pen_option_get( 'footer_menu_separator' );

			if ( $separator ) {

				$css_normal = '';
				$css_dark   = '';

				if ( in_array( $separator, array( 1, 2, 3 ), true ) ) {

					$selector = '#pen_footer .pen_footer_inner #pen_footer_menu.pen_separator_' . $separator . ' ul#secondary-menu > li:after';

					$css_normal = $selector . '{
						background:linear-gradient(180deg, rgba(0,0,0,0) 0%, ' . $link . ' 50%, rgba(0,0,0,0) 100%);
					}';

					if ( PEN_THEME_DARK_MODE ) {

						$selector_dark = pen_inline_css_dark_mode_selector( $selector );

						$css_dark = $selector_dark . '{
							background:linear-gradient(180deg, rgba(0,0,0,0) 0%, ' . $link_light . ' 50%, rgba(0,0,0,0) 100%);
						}';
					}
				} elseif ( in_array( $separator, array( 4, 5, 7 ), true ) ) {

					$selector = '#pen_footer .pen_footer_inner #pen_footer_menu.pen_separator_' . $separator . ' ul#secondary-menu > li:after';

					$css_normal = $selector . '{
						background:' . $link . ';
					}';

					if ( PEN_THEME_DARK_MODE ) {
						$selector_dark = pen_inline_css_dark_mode_selector( $selector );

						$css_dark = $selector_dark . '{
							background:' . $link_light . ';
						}';
					}
				} elseif ( 6 === $separator ) {

					$selector = '#pen_footer .pen_footer_inner #pen_footer_menu.pen_separator_6 ul#secondary-menu > li:before,
						#pen_footer .pen_footer_inner #pen_footer_menu.pen_separator_6 ul#secondary-menu > li:after';

					$css_normal = $selector . '{
						background:' . $link . ';
					}';

					if ( PEN_THEME_DARK_MODE ) {

						$selector_dark = pen_inline_css_dark_mode_selector( $selector );

						$css_dark = $selector_dark . '{
							background:' . $link_light . ';
						}';
					}
				} elseif ( in_array( $separator, array( 8, 9 ), true ) ) {

					$selector = '#pen_footer .pen_footer_inner #pen_footer_menu.pen_separator_' . $separator . ' ul#secondary-menu > li:after';

					$css_normal = $selector . '{
						border-color:' . $link . ';
					}';

					if ( PEN_THEME_DARK_MODE ) {
						$selector_dark = pen_inline_css_dark_mode_selector( $selector );

						$css_dark = $selector_dark . '{
							border-color:' . $link_light . ';
						}';
					}
				} elseif ( 10 === $separator ) {

					$selector = '#pen_footer .pen_footer_inner #pen_footer_menu.pen_separator_10 ul#secondary-menu > li:after';

					$css_normal = $selector . '{
						color:' . $link . ';
					}';

					if ( PEN_THEME_DARK_MODE ) {

						$selector_dark = pen_inline_css_dark_mode_selector( $selector );

						$css_dark = $selector_dark . '{
							color:' . $link_light . ';
						}';
					}
				}
				if ( $css_normal ) {
					$css .= $css_normal;
					if ( PEN_THEME_DARK_MODE ) {
						$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
					}
				}
			}
		}

		$link_hover         = esc_html( pen_option_get( 'color_footer_link_hover' ) );
		$link_hover_default = pen_option_default( 'color_footer_link_hover' );

		if ( 'preset_1' !== $preset_color || $link_hover !== $link_hover_default ) {

			$color_link_hover = new \Pen_Theme\Color( $link_hover );
			if ( $color_link_hover->isDark() ) {
				$link_hover_light = $color_link_hover->lighten( 55 );
				$link_hover_light = new \Pen_Theme\Color( $link_hover_light );
				$link_hover_light = '#' . $link_hover_light->getHex();
			} else {
				$link_hover_light = $link_hover;
			}

			$selector = '#pen_footer a:focus,
				#pen_footer a:hover,
				#pen_footer a:active,
				#pen_footer .pen_footer_inner .pen_social_networks a:focus,
				#pen_footer .pen_footer_inner .pen_social_networks a:hover,
				#pen_footer .pen_footer_inner .pen_social_networks a:active';

			$css_normal = $selector . '{
				color:' . $link_hover . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					color:' . $link_hover_light . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$transform_text_footer_menu         = esc_html( pen_option_get( 'transform_text_footer_menu' ) );
		$transform_text_footer_menu_default = pen_option_default( 'transform_text_footer_menu' );
		if ( $transform_text_footer_menu !== $transform_text_footer_menu_default ) {
			$css .= '#pen_footer .pen_footer_inner #pen_footer_menu li a {
				text-transform:' . $transform_text_footer_menu . ' !important;
			}';
		}

		$social_links_size         = esc_html( pen_option_get( 'font_size_social_footer' ) );
		$social_links_size_default = pen_option_default( 'font_size_social_footer' );
		if ( $social_links_size !== $social_links_size_default ) {
			$css .= '#pen_footer .pen_footer_inner .pen_social_networks li {
				font-size:' . $social_links_size . ';
			}';
		}

		$copyright_font              = esc_html( pen_option_get( 'font_family_copyright' ) );
		$copyright_font_size         = esc_html( pen_option_get( 'font_size_copyright' ) );
		$copyright_font_size_default = pen_option_default( 'font_size_copyright' );

		if ( 'g:Roboto' !== $copyright_font || $copyright_font_size !== $copyright_font_size_default ) {
			$css .= '#pen_footer .pen_footer_inner .site-info {';
			if ( 'g:Roboto' !== $copyright_font ) {
				$css .= 'font-family:"' . ltrim( $copyright_font, 'g:' ) . '", Arial, Helvetica, Sans-serif !important;';
			}
			if ( $copyright_font_size !== $copyright_font_size_default ) {
				$css .= 'font-size:' . $copyright_font_size . ';';
			}
			$css .= '}';
		}

		$css = pen_compress_css( $css );

		wp_add_inline_style( 'pen-css', $css );
	}
	if ( PEN_THEME_CUSTOM_CSS ) {
		add_action( 'wp_enqueue_scripts', 'pen_inline_css_footer' );
	}
}

if ( PEN_THEME_HAS_WOOCOMMERCE && ! function_exists( 'pen_inline_css_woocommerce' ) ) {
	/**
	 * Adds inline CSS for the awesome WooCommerce plugin.
	 *
	 * @since Pen 1.2.8
	 * @return void
	 */
	function pen_inline_css_woocommerce() {

		$css = '';

		$preset_color = pen_preset_get( 'color' );

		$background_primary           = esc_html( pen_option_get( 'color_cart_header_button_background_primary' ) );
		$background_primary_default   = pen_option_default( 'color_cart_header_button_background_primary' );
		$background_secondary         = esc_html( pen_option_get( 'color_cart_header_button_background_secondary' ) );
		$background_secondary_default = pen_option_default( 'color_cart_header_button_background_secondary' );

		$angle         = esc_html( pen_option_get( 'color_cart_header_button_background_angle' ) );
		$angle_default = pen_option_default( 'color_cart_header_button_background_angle' );

		$text         = esc_html( pen_option_get( 'color_cart_header_button_text' ) );
		$text_default = pen_option_default( 'color_cart_header_button_text' );

		if ( 'preset_1' !== $preset_color || $background_primary !== $background_primary_default || $background_secondary !== $background_secondary_default || $text !== $text_default ) {
			$css .= '#pen_header .pen_header_main #pen_cart_header .pen_button {
					background-color:' . $background_secondary . ' !important;
					background:' . $background_secondary . ' !important;';
			if ( $background_primary !== $background_secondary ) {
				$css .= 'background:linear-gradient(' . $angle . ',' . $background_primary . ' 0%,' . $background_secondary . ' 100%) !important;';
			}
			if ( 'preset_1' !== $preset_color || $text !== $text_default ) {
				$css .= 'border-color:' . $background_secondary . ' !important;
					color:' . $text . ' !important;';
			}
			$css .= '}';

			$css .= '#pen_header .pen_header_main #pen_cart_header .pen_button:focus,
				#pen_header .pen_header_main #pen_cart_header .pen_button:hover
				#pen_header .pen_header_main #pen_cart_header .pen_button:active,
				#pen_header .pen_header_main #pen_cart_header .pen_button.pen_active {
					background:' . $background_secondary . ' !important;
				}';
		}

		$text         = esc_html( pen_option_get( 'color_cart_header_content_text' ) );
		$text_default = pen_option_default( 'color_cart_header_content_text' );

		$background_primary           = esc_html( pen_option_get( 'color_cart_header_content_background_primary' ) );
		$background_primary_default   = pen_option_default( 'color_cart_header_content_background_primary' );
		$background_secondary         = esc_html( pen_option_get( 'color_cart_header_content_background_secondary' ) );
		$background_secondary_default = pen_option_default( 'color_cart_header_content_background_secondary' );

		$angle         = esc_html( pen_option_get( 'color_cart_header_content_background_angle' ) );
		$angle_default = pen_option_default( 'color_cart_header_content_background_angle' );

		if ( 'preset_1' !== $preset_color || $background_primary !== $background_primary_default || $background_secondary !== $background_secondary_default || $angle !== $angle_default || $text !== $text_default ) {

			$selector = 'body.pen_has_woocommerce #pen_cart_header .pen_cart_content';

			$css_normal = $selector . '{
				background-color:' . $background_primary . ' !important;
				background:' . $background_primary . ' !important;';
			if ( $background_primary !== $background_secondary ) {
				$css_normal .= 'background:linear-gradient(' . $angle . ',' . $background_primary . ' 0%,' . $background_secondary . ' 100%) !important;';
			}
			if ( 'preset_1' !== $preset_color || $text !== $text_default ) {
				$css_normal .= 'color:' . $text . ' !important;';
			}
			$css_normal .= '}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$color_background_primary = new \Pen_Theme\Color( $background_primary );
				if ( $color_background_primary->isLight() ) {
					$background_primary_dark = $color_background_primary->darken( 80 );
					$background_primary_dark = new \Pen_Theme\Color( $background_primary_dark );
					$background_primary_dark = '#' . $background_primary_dark->getHex();
				} else {
					$background_primary_dark = $background_primary;
				}

				$color_background_secondary = new \Pen_Theme\Color( $background_secondary );
				if ( $color_background_secondary->isLight() ) {
					$background_secondary_dark = $color_background_secondary->darken( 80 );
					$background_secondary_dark = new \Pen_Theme\Color( $background_secondary_dark );
					$background_secondary_dark = '#' . $background_secondary_dark->getHex();
				} else {
					$background_secondary_dark = $background_secondary;
				}

				$color_text = new \Pen_Theme\Color( $text );
				if ( $color_text->isDark() ) {
					$text_light = $color_text->lighten( 80 );
					$text_light = new \Pen_Theme\Color( $text_light );
					$text_light = '#' . $text_light->getHex();
				} else {
					$text_light = $text;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					background-color:' . $background_secondary_dark . ' !important;
					background:' . $background_secondary_dark . ' !important;';
				if ( $background_primary_dark !== $background_secondary_dark ) {
					$css_dark .= 'background:linear-gradient(' . $angle . ',' . $background_primary_dark . ' 0%,' . $background_secondary_dark . ' 100%) !important;';
				}
				$css_dark .= '
					color:' . $text_light . ' !important;
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$link         = esc_html( pen_option_get( 'color_cart_header_content_link' ) );
		$link_default = pen_option_default( 'color_cart_header_content_link' );

		if ( 'preset_1' !== $preset_color || $link !== $link_default ) {

			$selector = 'body.pen_has_woocommerce #pen_cart_header .pen_cart_content a';

			$css_normal = $selector . '{
				color:' . $link . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$color_link = new \Pen_Theme\Color( $link );
				if ( $color_link->isDark() ) {
					$link_light = $color_link->lighten( 80 );
					$link_light = new \Pen_Theme\Color( $link_light );
					$link_light = '#' . $link_light->getHex();
				} else {
					$link_light = $link;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					color:' . $link_light . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$link_hover         = esc_html( pen_option_get( 'color_cart_header_content_link_hover' ) );
		$link_hover_default = pen_option_default( 'color_cart_header_content_link_hover' );

		if ( 'preset_1' !== $preset_color || $link_hover !== $link_hover_default ) {

			$selector = 'body.pen_has_woocommerce #pen_cart_header .pen_cart_content a:focus,
				body.pen_has_woocommerce #pen_cart_header .pen_cart_content a:hover,
				body.pen_has_woocommerce #pen_cart_header .pen_cart_content a:active';

			$css_normal = $selector . '{
				color:' . $link_hover . ';
			}';

			$css .= $css_normal;

			if ( PEN_THEME_DARK_MODE ) {

				$color_link_hover = new \Pen_Theme\Color( $link_hover );
				if ( $color_link_hover->isDark() ) {
					$link_hover_light = $color_link_hover->lighten( 55 );
					$link_hover_light = new \Pen_Theme\Color( $link_hover_light );
					$link_hover_light = '#' . $link_hover_light->getHex();
				} else {
					$link_hover_light = $link_hover;
				}

				$selector_dark = pen_inline_css_dark_mode_selector( $selector );

				$css_dark = $selector_dark . '{
					color:' . $link_hover_light . ';
				}';

				$css .= pen_inline_css_dark_mode_media_query( $css_normal, $css_dark );
			}
		}

		$background_primary           = esc_html( pen_option_get( 'color_cart_badge_sale_background_primary' ) );
		$background_primary_default   = pen_option_default( 'color_cart_badge_sale_background_primary' );
		$background_secondary         = esc_html( pen_option_get( 'color_cart_badge_sale_background_secondary' ) );
		$background_secondary_default = pen_option_default( 'color_cart_badge_sale_background_secondary' );

		$angle = 90;

		if ( 'preset_1' !== $preset_color || $background_primary !== $background_primary_default || $background_secondary !== $background_secondary_default || $angle !== $angle_default ) {

			$css .= 'body.pen_has_woocommerce #page div.product > .pen_badge_sale {
				background-color:' . $background_primary . ' !important;
				background:' . $background_primary . ' !important;';
			if ( $background_primary !== $background_secondary ) {
				$css .= 'background:linear-gradient(' . $angle . 'deg,' . $background_primary . ' 0%,' . $background_secondary . ' 100%) !important;';
			}
			$css .= '}';

			$css .= 'body.pen_has_woocommerce #page ul.wc-block-grid__products li.wc-block-grid__product .wc-block-grid__product-onsale,
				body.pen_has_woocommerce #page ul.products li.product .pen_badge_sale {
				background:' . $background_primary . ' !important;
				border-color:' . $background_primary . ' !important;
			}';

			$css .= 'body.pen_has_woocommerce #page ul.wc-block-grid__products li.wc-block-grid__product .wc-block-grid__product-onsale:before,
				body.pen_has_woocommerce #page ul.products li.product .pen_badge_sale:before{
				border-top-color:' . $background_primary . ' !important;
			}';
		}

		$css = pen_compress_css( $css );

		wp_add_inline_style( 'pen-css', $css );
	}
	if ( PEN_THEME_CUSTOM_CSS ) {
		add_action( 'wp_enqueue_scripts', 'pen_inline_css_woocommerce' );
	}
}

if ( ! function_exists( 'pen_inline_css_dark_mode_media_query' ) ) {
	/**
	 * Adds some CSS for the Dark Mode feature.
	 *
	 * @param string $css_normal The normal CSS.
	 * @param string $css_dark   The CSS for the Dark Mode.
	 *
	 * @since Pen 1.4.1
	 * @return string
	 */
	function pen_inline_css_dark_mode_media_query( $css_normal, $css_dark ) {

		$dark_mode              = pen_option_get( 'dark_mode' );
		$dark_mode_allow_switch = pen_option_get( 'dark_mode_allow_switch' );

		$output = '@media (prefers-color-scheme: dark){';

		if ( $dark_mode_allow_switch || 'none' === $dark_mode || 'clock' === $dark_mode ) {
			$output .= $css_normal;
		}

		if ( 'none' !== $dark_mode ) {
			$output .= $css_dark;
		}

		$output .= '}';

		if ( 'none' !== $dark_mode ) {
			$output .= $css_dark;
		}

		return $output;
	}
}

if ( ! function_exists( 'pen_inline_css_dark_mode_selector' ) ) {
	/**
	 * Adds inline CSS selectors for the Dark Mode.
	 *
	 * @param string $selector The CSS selector.
	 *
	 * @since Pen 1.4.1
	 * @return string
	 */
	function pen_inline_css_dark_mode_selector( $selector ) {
		$selector_dark = array();
		$selector      = explode( ',', $selector );
		foreach ( $selector as $selector ) {
			$selector = trim( $selector );
			if ( false !== stripos( $selector, 'body ' ) ) {
				$selector = str_ireplace( 'body ', 'body.pen_dark_mode ', $selector );
			} elseif ( false !== stripos( $selector, 'body.' ) ) {
				$selector = str_ireplace( 'body.', 'body.pen_dark_mode.', $selector );
			} else {
				$selector = 'body.pen_dark_mode ' . $selector;
			}
			$selector_dark[] = $selector;
		}
		return implode( ',', $selector_dark );
	}
}

if ( ! function_exists( 'pen_customize_register' ) ) {
	/**
	 * Registers theme options.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_customize_register( $wp_customize ) {

		$variables = array(
			'options_animation'       => pen_animations(),
			'options_animation_delay' => pen_animations_delay(),
			'options_image_sizes'     => pen_wp_image_sizes(),
			'url_customize'           => wp_customize_url(),
		);

		pen_customize_animation( $wp_customize, $variables );
		pen_customize_contact( $wp_customize, $variables );
		pen_customize_color( $wp_customize, $variables );
		pen_customize_typography( $wp_customize, $variables );
		pen_customize_header( $wp_customize, $variables );
		pen_customize_content_general( $wp_customize, $variables );
		pen_customize_content_list( $wp_customize, $variables );
		pen_customize_content_full( $wp_customize, $variables );
		pen_customize_site_layout( $wp_customize, $variables );
		pen_customize_front( $wp_customize, $variables );
		pen_customize_footer( $wp_customize, $variables );
		pen_customize_loading_spinner( $wp_customize, $variables );
		pen_customize_background( $wp_customize, $variables );
		pen_customize_logo( $wp_customize, $variables );
		pen_customize_shortcuts( $wp_customize, $variables );

		if ( PEN_THEME_HAS_WOOCOMMERCE ) {
			pen_customize_woocommerce( $wp_customize, $variables );
		}
	}
	add_action( 'customize_register', 'pen_customize_register' );
}

if ( ! function_exists( 'pen_customizer_preview_js' ) ) {
	/**
	 * Enhancements for the the Theme Customizer.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_customizer_preview_js() {
		wp_enqueue_script( 'pen-customizer-preview', PEN_THEME_DIRECTORY_URI . '/assets/js/pen-customize-preview.js', array( 'customize-preview', 'wp-backbone' ), PEN_THEME_VERSION, true );
		wp_localize_script(
			'pen-customizer-preview',
			'pen_preview_js',
			array(
				'preset_color' => esc_html( pen_preset_get( 'color' ) ),
			)
		);
	}
	add_action( 'customize_preview_init', 'pen_customizer_preview_js' );
}

if ( ! function_exists( 'pen_customizer_css_js' ) ) {
	/**
	 * Binds CSS/JS to the customizer.
	 *
	 * @since Pen 1.0.0
	 * @return void
	 */
	function pen_customizer_css_js() {

		$preset_preview = false;
		if ( pen_filter_input( 'GET', 'pen_preview_color' ) || pen_filter_input( 'GET', 'pen_preview_font' ) ) {
			$preset_preview = true;
		}

		$content_id = (int) pen_filter_input( 'GET', 'pen_content_id' );
		$url_start  = '';
		if ( $content_id ) {
			$url_start = get_permalink( $content_id );
		}

		wp_enqueue_style( 'pen-customizer-main', PEN_THEME_DIRECTORY_URI . '/assets/css/pen-customize-main.css', array(), PEN_THEME_VERSION );

		wp_enqueue_script( 'pen-customizer-main', PEN_THEME_DIRECTORY_URI . '/assets/js/pen-customize-main.js', array(), PEN_THEME_VERSION, true );
		wp_localize_script(
			'pen-customizer-main',
			'pen_customize_js',
			array(
				'url_start'          => esc_url( $url_start ),
				'url_support'        => esc_url( PEN_THEME_SUPPORT_URL ),
				'url_support_urgent' => esc_url( PEN_THEME_SUPPORT_URL_URGENT ),
				'url_rate'           => pen_remind_rate_review() ? esc_url( PEN_THEME_RATING_URL ) : false,
				'preset_preview'     => $preset_preview,
				'preset_color'       => str_replace( 'preset_', '', pen_preset_get( 'color' ) ),
				'preset_font'        => str_replace( 'preset_', '', pen_preset_get( 'font_family' ) ),
				'plugin_install_url' => esc_url( self_admin_url( 'plugins.php?s=pen&plugin_status=inactive' ) ),
				'text'               => array(
					'pen_theme'        => esc_html__( 'Pen', 'pen' ),
					'do_you_need_help' => esc_html__( 'Do you need help?', 'pen' ),
					'urgent_support'   => esc_html__( 'Urgent Support', 'pen' ),
					'rate'             => esc_html__( 'Give This Theme Five Stars!', 'pen' ),
					'theme_specific'   => esc_attr(
						sprintf(
							"%1\$s\n%2\$s",
							sprintf(
								/* Translators: Theme name. */
								__( '%s Theme Only:', 'pen' ),
								__( 'Pen', 'pen' )
							),
							sprintf(
								'%s %s',
								__( 'This is a part of the Pen theme.', 'pen' ),
								__( 'These settings will be no longer available if you switch to another theme. Other settings are either parts of the WordPress core or your plugins and they will be available even without this theme.', 'pen' )
							)
						)
					),
				),
			)
		);
	}
	add_action( 'customize_controls_enqueue_scripts', 'pen_customizer_css_js' );
}
