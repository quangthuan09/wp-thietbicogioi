<?php
/**
 * "Pen" WordPress plug-in.
 *
 * Toolbar menu.
 *
 * @link       https://www.htmlpie.com/products/pen-multipurpose-wordpress-theme/
 * @since      Pen Extra Features 1.0.0
 *
 * @package    Pen Extra Features
 * @subpackage Pen Extra Features/backend/partials
 */

// Prevents direct access.
defined( 'ABSPATH' ) || die();

if ( ! function_exists( 'pen_plugin_toolbar' ) ) {
	/**
	 * Adds a menu to the administration toolbar.
	 *
	 * @param object $wp_admin_bar WordPress Admin toolbar menu.
	 *
	 * @since Pen Extra Features 1.0.0
	 * @return void
	 */
	function pen_plugin_toolbar( $wp_admin_bar ) {

		if ( ! PEN_PLUGIN_HAS_THEME || ! current_user_can( 'edit_theme_options' ) ) {
			return;
		}

		$url_pen_plugin = self_admin_url( 'admin.php?page=pen-extra-features' );
		$url_customize  = wp_customize_url();
		$content_id     = pen_post_id();
		if ( ! is_admin() && $content_id ) {
			$url_customize = add_query_arg( 'pen_content_id', $content_id, wp_customize_url() );
		}

		$url_content_edit = get_edit_post_link( $content_id ) . '#pen_meta_box';

		$wp_admin_bar->add_node(
			array(
				'parent' => 'edit', // It'll be excluded if Edit item is not present, so no need to check that.
				'id'     => 'pen-edit-options',
				'title'  => esc_html(
					sprintf(
						/* Translators: %s: Theme name. */
						__( '%s Options', 'pen-extra-features' ),
						__( 'Pen', 'pen-extra-features' )
					)
				),
				'href'   => esc_url( $url_content_edit ),
			)
		);

		$wp_admin_bar->add_node(
			array(
				'id'    => 'pen-extra-features-menu',
				'title' => esc_html__( 'Pen Theme', 'pen-extra-features' ),
				'href'  => esc_url( $url_pen_plugin ),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu',
				'id'     => 'pen-extra-features-menu-customize',
				'title'  => esc_html__( 'Customize', 'pen-extra-features' ),
				'href'   => esc_url( $url_customize ),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize',
				'id'     => 'pen-extra-features-menu-customize-everything',
				'title'  => esc_html__( 'Everything', 'pen-extra-features' ),
				'href'   => esc_url( $url_customize ),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize',
				'id'     => 'pen-extra-features-menu-customize-animation',
				'title'  => esc_html__( 'Animation', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[panel]' => 'pen_panel_animation',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-animation',
				'id'     => 'pen-extra-features-menu-customize-animation-header',
				'title'  => esc_html__( 'Header', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_animation_header',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-animation',
				'id'     => 'pen-extra-features-menu-customize-animation-navigation',
				'title'  => esc_html__( 'Navigation', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_animation_navigation',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-animation',
				'id'     => 'pen-extra-features-menu-customize-animation-search',
				'title'  => esc_html__( 'Search', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_animation_search',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-animation',
				'id'     => 'pen-extra-features-menu-customize-animation-lists',
				'title'  => esc_html__( 'List Views', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_animation_list',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-animation',
				'id'     => 'pen-extra-features-menu-customize-animation-full-content',
				'title'  => esc_html__( 'Full Content Views', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_animation_content',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-animation',
				'id'     => 'pen-extra-features-menu-customize-animation-widget-areas',
				'title'  => esc_html__( 'Widget Areas', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_animation_widget_areas',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize',
				'id'     => 'pen-extra-features-menu-customize-colors',
				'title'  => esc_html__( 'Colors', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[panel]' => 'pen_panel_colors',
						),
						$url_customize
					)
				),
			)
		);
		$current_preset_color = (int) str_replace( 'preset_', '', pen_preset_get( 'color' ) );
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-colors',
				'id'     => 'pen-extra-features-menu-customize-colors-current',
				'title'  => esc_html(
					sprintf(
						/* Translators: %d the ID of the current predefined set of settings. */
						__( 'Current Set (%d)', 'pen-extra-features' ),
						$current_preset_color
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[panel]' => 'pen_panel_colors',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-colors-current',
				'id'     => 'pen-extra-features-menu-customize-colors-current-general',
				'title'  => esc_html__( 'General', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_colors_general',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-colors-current',
				'id'     => 'pen-extra-features-menu-customize-colors-current-header',
				'title'  => esc_html(
					sprintf(
						/* Translators: Part of the theme, e.g. Header Colors. */
						__( '%s Colors', 'pen-extra-features' ),
						__( 'Header', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_colors_header',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-colors-current',
				'id'     => 'pen-extra-features-menu-customize-colors-current-navigation',
				'title'  => esc_html(
					sprintf(
						/* Translators: Part of the theme, e.g. Header Colors. */
						__( '%s Colors', 'pen-extra-features' ),
						__( 'Navigation Menu', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_colors_navigation',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-colors-current',
				'id'     => 'pen-extra-features-menu-customize-colors-current-search',
				'title'  => esc_html(
					sprintf(
						/* Translators: Part of the theme, e.g. Header Colors. */
						__( '%s Colors', 'pen-extra-features' ),
						_x( 'Search Bar', 'noun', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_colors_search',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-colors-current',
				'id'     => 'pen-extra-features-menu-customize-colors-current-content',
				'title'  => esc_html(
					sprintf(
						/* Translators: Part of the theme, e.g. Header Colors. */
						__( '%s Colors', 'pen-extra-features' ),
						__( 'Content Area', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_colors_content',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-colors-current',
				'id'     => 'pen-extra-features-menu-customize-colors-current-list',
				'title'  => esc_html(
					sprintf(
						/* Translators: Part of the theme, e.g. Header Colors. */
						__( '%s Colors', 'pen-extra-features' ),
						/* Translators: Adjective. */
						_x( 'List View', 'noun', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_colors_list',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-colors-current',
				'id'     => 'pen-extra-features-menu-customize-colors-current-bottom',
				'title'  => esc_html(
					sprintf(
						/* Translators: Part of the theme, e.g. Header Colors. */
						__( '%s Colors', 'pen-extra-features' ),
						__( 'Bottom', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_colors_bottom',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-colors-current',
				'id'     => 'pen-extra-features-menu-customize-colors-current-footer',
				'title'  => esc_html(
					sprintf(
						/* Translators: Part of the theme, e.g. Header Colors. */
						__( '%s Colors', 'pen-extra-features' ),
						__( 'Footer', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_colors_footer',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-colors-current',
				'id'     => 'pen-extra-features-menu-customize-colors-current-loading-spinner',
				'title'  => esc_html(
					sprintf(
						/* Translators: Just some words. */
						__( '"%s" Screen', 'pen-extra-features' ),
						__( 'Loading...', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_colors_loading_spinner',
						),
						$url_customize
					)
				),
			)
		);

		for ( $i = 1; $i <= PEN_PLUGIN_NUMBER_COLOR_SCHEMES; $i++ ) {
			if ( $i !== $current_preset_color ) {
				$wp_admin_bar->add_node(
					array(
						'parent' => 'pen-extra-features-menu-customize-colors',
						'id'     => 'pen-extra-features-menu-customize-colors-preset-' . $i,
						'title'  => esc_html(
							sprintf(
								/* Translators: %d the ID of the current predefined set of settings. */
								__( 'Preview Style %d', 'pen-extra-features' ),
								$i
							)
						),
						'href'   => esc_url(
							add_query_arg(
								array(
									'autofocus[panel]'  => 'pen_panel_colors',
									'pen_preview_color' => (int) $i,
								),
								$url_customize
							)
						),
					)
				);
			}
		}

		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize',
				'id'     => 'pen-extra-features-menu-customize-typography',
				'title'  => esc_html__( 'Typography', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[panel]' => 'pen_panel_typography',
						),
						$url_customize
					)
				),
			)
		);
		$current_preset_font = (int) str_replace( 'preset_', '', pen_preset_get( 'font_family' ) );
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-typography',
				'id'     => 'pen-extra-features-menu-customize-typography-current',
				'title'  => esc_html(
					sprintf(
						/* Translators: %d the ID of the current predefined set of settings. */
						__( 'Current Set (%d)', 'pen-extra-features' ),
						$current_preset_font
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[panel]' => 'pen_panel_typography',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-typography-current',
				'id'     => 'pen-extra-features-menu-customize-typography-current-general',
				'title'  => esc_html__( 'General', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_typography_general',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-typography-current',
				'id'     => 'pen-extra-features-menu-customize-typography-current-header',
				'title'  => esc_html(
					sprintf(
						/* Translators: Part of the theme such as Header Typography. */
						__( '%s Typography', 'pen-extra-features' ),
						__( 'Header', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_typography_header',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-typography-current',
				'id'     => 'pen-extra-features-menu-customize-typography-current-navigation',
				'title'  => esc_html(
					sprintf(
						/* Translators: Part of the theme such as Header Typography. */
						__( '%s Typography', 'pen-extra-features' ),
						__( 'Navigation', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_typography_navigation',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-typography-current',
				'id'     => 'pen-extra-features-menu-customize-typography-current-sidebars',
				'title'  => esc_html(
					sprintf(
						/* Translators: Part of the theme such as Header Typography. */
						__( '%s Typography', 'pen-extra-features' ),
						__( 'Widget Areas', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_typography_sidebars',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-typography-current',
				'id'     => 'pen-extra-features-menu-customize-typography-current-footer',
				'title'  => esc_html(
					sprintf(
						/* Translators: Part of the theme such as Header Typography. */
						__( '%s Typography', 'pen-extra-features' ),
						__( 'Footer', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_typography_footer',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-typography-current',
				'id'     => 'pen-extra-features-menu-customize-typography-current-contact',
				'title'  => esc_html(
					sprintf(
						/* Translators: Part of the theme such as Header Typography. */
						__( '%s Typography', 'pen-extra-features' ),
						__( 'Contact Links', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_typography_contact',
						),
						$url_customize
					)
				),
			)
		);

		for ( $i = 1; $i <= PEN_PLUGIN_NUMBER_FONT_PAIRS; $i++ ) {
			if ( $i !== $current_preset_font ) {
				$wp_admin_bar->add_node(
					array(
						'parent' => 'pen-extra-features-menu-customize-typography',
						'id'     => 'pen-extra-features-menu-customize-typography-preset-' . $i,
						'title'  => esc_html(
							sprintf(
								/* Translators: %d the ID of the current predefined set of settings. */
								__( 'Preview Font Group %d', 'pen-extra-features' ),
								$i
							)
						),
						'href'   => esc_url(
							add_query_arg(
								array(
									'autofocus[panel]' => 'pen_panel_colors',
									'pen_preview_font' => (int) $i,
								),
								$url_customize
							)
						),
					)
				);
			}
		}

		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize',
				'id'     => 'pen-extra-features-menu-customize-header',
				'title'  => esc_html__( 'Header', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[panel]' => 'pen_panel_header',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-header',
				'id'     => 'pen-extra-features-menu-customize-header-general',
				'title'  => esc_html__( 'General', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_header_general',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-header',
				'id'     => 'pen-extra-features-menu-customize-header-phone',
				'title'  => esc_html__( 'Phone', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_phone',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-header',
				'id'     => 'pen-extra-features-menu-customize-header-search',
				'title'  => esc_html__( 'Search', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_header_search',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-header',
				'id'     => 'pen-extra-features-menu-customize-header-register',
				'title'  => esc_html__( 'Registration Button', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_header_register',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-header',
				'id'     => 'pen-extra-features-menu-customize-header-navigation',
				'title'  => esc_html__( 'Navigation', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_header_navigation',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize',
				'id'     => 'pen-extra-features-menu-customize-content',
				'title'  => esc_html__( 'Content', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[panel]' => 'pen_panel_content',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-content',
				'id'     => 'pen-extra-features-menu-customize-content-general',
				'title'  => esc_html__( 'General', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_content_general',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-content',
				'id'     => 'pen-extra-features-menu-customize-content-list',
				'title'  => esc_html__( 'List Views', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_list',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-content',
				'id'     => 'pen-extra-features-menu-customize-content-full',
				'title'  => esc_html__( 'Full Content Views', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_content',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-content',
				'id'     => 'pen-extra-features-menu-customize-content-layout',
				'title'  => esc_html__( 'Layout', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_layout',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize',
				'id'     => 'pen-extra-features-menu-customize-front',
				'title'  => esc_html__( 'Front Page', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[panel]' => 'pen_panel_front',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-front',
				'id'     => 'pen-extra-features-menu-customize-front-content',
				'title'  => esc_html__( 'Front Page Content', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'static_front_page',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-front',
				'id'     => 'pen-extra-features-menu-customize-front-sidebars',
				'title'  => esc_html__( 'Front Page Sidebars', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_front_sidebars',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize',
				'id'     => 'pen-extra-features-menu-customize-footer',
				'title'  => esc_html__( 'Footer', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_footer',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize',
				'id'     => 'pen-extra-features-menu-customize-loading-spinner',
				'title'  => esc_html(
					sprintf(
						/* Translators: Just some words. */
						__( '"%s" Screen', 'pen-extra-features' ),
						__( 'Loading...', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_loading_spinner',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize',
				'id'     => 'pen-extra-features-menu-customize-contact',
				'title'  => esc_html__( 'Contact Information', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[panel]' => 'pen_panel_contact',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-contact',
				'id'     => 'pen-extra-features-menu-customize-contact-facebook',
				'title'  => esc_html__( 'Facebook', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_facebook',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-contact',
				'id'     => 'pen-extra-features-menu-customize-contact-twitter',
				'title'  => esc_html__( 'Twitter', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_twitter',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-contact',
				'id'     => 'pen-extra-features-menu-customize-contact-instagram',
				'title'  => esc_html__( 'Instagram', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_instagram',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-contact',
				'id'     => 'pen-extra-features-menu-customize-contact-phone',
				'title'  => esc_html__( 'Phone', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_phone',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-contact',
				'id'     => 'pen-extra-features-menu-customize-contact-whatsapp',
				'title'  => esc_html__( 'WhatsApp', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_whatsapp',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-contact',
				'id'     => 'pen-extra-features-menu-customize-contact-email',
				'title'  => esc_html__( 'E-mail', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_email',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-contact',
				'id'     => 'pen-extra-features-menu-customize-contact-linkedin',
				'title'  => esc_html__( 'LinkedIn', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_linkedin',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-contact',
				'id'     => 'pen-extra-features-menu-customize-contact-pinterest',
				'title'  => esc_html__( 'Pinterest', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_pinterest',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-contact',
				'id'     => 'pen-extra-features-menu-customize-contact-bitbucket',
				'title'  => esc_html__( 'Bitbucket', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_bitbucket',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-contact',
				'id'     => 'pen-extra-features-menu-customize-contact-flickr',
				'title'  => esc_html__( 'Flickr', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_flickr',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-contact',
				'id'     => 'pen-extra-features-menu-customize-contact-github',
				'title'  => esc_html__( 'GitHub', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_github',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-contact',
				'id'     => 'pen-extra-features-menu-customize-contact-slack',
				'title'  => esc_html__( 'Slack', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_slack',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-contact',
				'id'     => 'pen-extra-features-menu-customize-contact-skype',
				'title'  => esc_html__( 'Skype', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_skype',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-contact',
				'id'     => 'pen-extra-features-menu-customize-contact-telegram',
				'title'  => esc_html__( 'Telegram', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_telegram',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-contact',
				'id'     => 'pen-extra-features-menu-customize-contact-mewe',
				'title'  => esc_html__( 'MeWe', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_mewe',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-contact',
				'id'     => 'pen-extra-features-menu-customize-contact-vk',
				'title'  => esc_html__( 'VK', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_vk',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-contact',
				'id'     => 'pen-extra-features-menu-customize-contact-shop',
				'title'  => esc_html__( 'Shop', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_shop',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-contact',
				'id'     => 'pen-extra-features-menu-customize-contact-vimeo',
				'title'  => esc_html__( 'Vimeo', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_vimeo',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-contact',
				'id'     => 'pen-extra-features-menu-customize-contact-youtube',
				'title'  => esc_html__( 'YouTube', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_youtube',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-contact',
				'id'     => 'pen-extra-features-menu-customize-contact-rss',
				'title'  => esc_html__( 'RSS Feed', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_rss',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize',
				'id'     => 'pen-extra-features-menu-customize-background',
				'title'  => esc_html__( 'Background Images', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[panel]' => 'p_panel_background_images',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-background',
				'id'     => 'pen-extra-features-menu-customize-background-color',
				'title'  => esc_html__( 'Site Background Color', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_colors_general',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-background',
				'id'     => 'pen-extra-features-menu-customize-background-site',
				'title'  => esc_html(
					sprintf(
						/* Translators: Part of the theme such as Header Background Image. */
						__( '%s Background Image', 'pen-extra-features' ),
						__( 'Site', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'background_image',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-background',
				'id'     => 'pen-extra-features-menu-customize-background-header',
				'title'  => esc_html(
					sprintf(
						/* Translators: Part of the theme such as Header Background Image. */
						__( '%s Background Image', 'pen-extra-features' ),
						__( 'Header', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'header_image',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-background',
				'id'     => 'pen-extra-features-menu-customize-background-navigation',
				'title'  => esc_html(
					sprintf(
						/* Translators: Part of the theme such as Header Background Image. */
						__( '%s Background Image', 'pen-extra-features' ),
						_x( 'Navigation', 'noun', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_background_image_navigation',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-background',
				'id'     => 'pen-extra-features-menu-customize-background-search',
				'title'  => esc_html(
					sprintf(
						/* Translators: Part of the theme such as Header Background Image. */
						__( '%s Background Image', 'pen-extra-features' ),
						_x( 'Search Bar', 'noun', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_background_image_search',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-background',
				'id'     => 'pen-extra-features-menu-customize-background-content-title',
				'title'  => esc_html(
					sprintf(
						/* Translators: Part of the theme such as Header Background Image. */
						__( '%s Background Image', 'pen-extra-features' ),
						__( 'Title', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_background_image_content_title',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-background',
				'id'     => 'pen-extra-features-menu-customize-background-bottom',
				'title'  => esc_html(
					sprintf(
						/* Translators: Part of the theme such as Header Background Image. */
						__( '%s Background Image', 'pen-extra-features' ),
						__( 'Bottom', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_background_image_bottom',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-background',
				'id'     => 'pen-extra-features-menu-customize-background-footer',
				'title'  => esc_html(
					sprintf(
						/* Translators: Part of the theme such as Header Background Image. */
						__( '%s Background Image', 'pen-extra-features' ),
						__( 'Footer', 'pen-extra-features' )
					)
				),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_section_background_image_footer',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize',
				'id'     => 'pen-extra-features-menu-customize-logo',
				'title'  => esc_html__( 'Site Identity', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'title_tagline',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize',
				'id'     => 'pen-extra-features-menu-customize-menus',
				'title'  => esc_html__( 'Menus', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[panel]' => 'nav_menus',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize-menus',
				'id'     => 'pen-extra-features-menu-customize-shortcuts',
				'title'  => esc_html__( 'Shortcuts', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[section]' => 'pen_shortcut_menus',
						),
						$url_customize
					)
				),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu-customize',
				'id'     => 'pen-extra-features-menu-customize-widgets',
				'title'  => esc_html__( 'Widgets', 'pen-extra-features' ),
				'href'   => esc_url(
					add_query_arg(
						array(
							'autofocus[panel]' => 'widgets',
						),
						$url_customize
					)
				),
			)
		);

		if ( class_exists( 'WooCommerce' ) ) {
			$wp_admin_bar->add_node(
				array(
					'parent' => 'pen-extra-features-menu-customize',
					'id'     => 'pen-extra-features-menu-customize-woocommerce',
					'title'  => esc_html__( 'WooCommerce', 'pen-extra-features' ),
					'href'   => esc_url(
						add_query_arg(
							array(
								'autofocus[panel]' => 'woocommerce',
							),
							$url_customize
						)
					),
				)
			);
			$wp_admin_bar->add_node(
				array(
					'parent' => 'pen-extra-features-menu-customize-woocommerce',
					'id'     => 'pen-extra-features-menu-customize-woocommerce-general',
					'title'  => esc_html__( 'General', 'pen-extra-features' ),
					'href'   => esc_url(
						add_query_arg(
							array(
								'autofocus[panel]' => 'woocommerce',
							),
							$url_customize
						)
					),
				)
			);
			$wp_admin_bar->add_node(
				array(
					'parent' => 'pen-extra-features-menu-customize-woocommerce',
					'id'     => 'pen-extra-features-menu-customize-woocommerce-colors',
					'title'  => esc_html__( 'Colors', 'pen-extra-features' ),
					'href'   => esc_url(
						add_query_arg(
							array(
								'autofocus[section]' => 'pen_section_colors_woocommerce',
							),
							$url_customize
						)
					),
				)
			);
		}

		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu',
				'id'     => 'pen-extra-features-menu-style',
				'title'  => esc_html__( 'Styles', 'pen-extra-features' ),
				'href'   => esc_url( self_admin_url( 'admin.php?page=pen-extra-features' ) ),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu',
				'id'     => 'pen-extra-features-menu-layout',
				'title'  => esc_html__( 'Layout', 'pen-extra-features' ),
				'href'   => esc_url( self_admin_url( 'admin.php?page=pen-extra-features-layout' ) ),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu',
				'id'     => 'pen-extra-features-menu-overview',
				'title'  => esc_html__( 'Customization Overview', 'pen-extra-features' ),
				'href'   => esc_url( self_admin_url( 'admin.php?page=pen-extra-features-overview' ) ),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu',
				'id'     => 'pen-extra-features-menu-export',
				'title'  => esc_html__( 'Customization Export', 'pen-extra-features' ),
				'href'   => esc_url( self_admin_url( 'admin.php?page=pen-extra-features-export' ) ),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu',
				'id'     => 'pen-extra-features-menu-import',
				'title'  => esc_html__( 'Customization Import', 'pen-extra-features' ),
				'href'   => esc_url( self_admin_url( 'admin.php?page=pen-extra-features-import' ) ),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu',
				'id'     => 'pen-extra-features-menu-addons',
				'title'  => esc_html__( 'Addons', 'pen-extra-features' ),
				'href'   => esc_url( self_admin_url( 'admin.php?page=pen-extra-features-addons' ) ),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu',
				'id'     => 'pen-extra-features-menu-documentation',
				'title'  => esc_html__( 'Theme Documentation', 'pen-extra-features' ),
				'href'   => esc_url( PEN_PLUGIN_DOCUMENTATION_URL ),
			)
		);
		$wp_admin_bar->add_node(
			array(
				'parent' => 'pen-extra-features-menu',
				'id'     => 'pen-extra-features-menu-support',
				'title'  => esc_html__( 'Help & Support', 'pen-extra-features' ),
				'href'   => esc_url( PEN_PLUGIN_SUPPORT_URL ),
			)
		);
	}
}
