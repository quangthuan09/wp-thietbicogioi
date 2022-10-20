<?php
/**
 * JavaScript and CSS files.
 *
 * @package Pen
 */

defined( 'ABSPATH' ) || die();

if ( ! function_exists( 'pen_assets' ) ) {
	/**
	 * Enqueue scripts and styles.
	 */
	function pen_assets() {

		$content_id = pen_post_id();

		$pen_is_singular = pen_is_singular();

		$is_customize_preview = is_customize_preview() ? true : false;

		$css_files = array(
			'normalize'  => '/assets/css/plugins/normalize.css',
			'animate'    => '/assets/css/plugins/animate.css',
			'base'       => '/assets/css/pen-base.css',
			'typography' => '/assets/css/pen-typography.css',
			'tables'     => '/assets/css/pen-tables.css',
			'layout'     => '/assets/css/pen-layout.css',
			'loading'    => '/assets/css/pen-loading.css',
			'buttons'    => '/assets/css/pen-buttons.css',
			'comments'   => '/assets/css/pen-comments.css',
			'footer'     => '/assets/css/pen-footer.css',
			'header'     => '/assets/css/pen-header.css',
			'menus'      => '/assets/css/pen-menus.css',
			'navigation' => '/assets/css/pen-navigation.css',
			'forms'      => '/assets/css/pen-forms.css',
			'content'    => '/assets/css/pen-content.css',
			'thumbnails' => '/assets/css/pen-thumbnails.css',
			'author'     => '/assets/css/pen-author.css',
			'pagination' => '/assets/css/pen-pagination.css',
			'share'      => '/assets/css/pen-share.css',
			'widgets'    => '/assets/css/pen-widgets.css',
		);

		$search_location = get_post_meta( $content_id, 'pen_content_search_location_override', true );
		if ( ! $search_location || 'default' === $search_location ) {
			$search_location = pen_option_get( 'search_location' );
		}
		if ( 'content' === $search_location ) {
			if ( pen_html_search_box( $content_id ) ) {
				$css_files['search-bar'] = '/assets/css/pen-search-bar.css';
			}
		}

		if ( pen_sidebar_check( 'sidebar-top', $content_id ) && is_active_sidebar( 'sidebar-top' ) ) {
			$css_files['top'] = '/assets/css/pen-top.css';
		}

		if ( PEN_THEME_PREVIEW || ( pen_sidebar_check( 'sidebar-bottom', $content_id ) && is_active_sidebar( 'sidebar-bottom' ) ) ) {
			$css_files['bottom'] = '/assets/css/pen-bottom.css';
		}

		if ( PEN_THEME_HAS_WOOCOMMERCE ) {
			$css_files['woocommerce'] = '/assets/css/plugins/wp.woocommerce.css';
			$css_files['select2']     = '/assets/css/plugins/jquery.select2.css';
		}

		if ( PEN_THEME_HAS_ASGAROS_FORUM ) {
			$css_files['asgaros-forum'] = '/assets/css/plugins/wp.asgaros-forum.css';
		}

		if ( file_exists( PEN_THEME_DIRECTORY_URI . '/assets/css/custom.css' ) ) {
			$css_files['custom'] = '/assets/css/custom.css';
		}

		foreach ( $css_files as $key => $value ) {
			wp_enqueue_style( 'pen-' . $key, PEN_THEME_DIRECTORY_URI . $value, array(), PEN_THEME_VERSION );
		}

		if ( PEN_THEME_DARK_MODE ) {
			// These are needed even if 'dark_mode' value is 'none'.
			$css_files_dark_mode                  = array(
				'base-dark-mode'       => '/assets/css/dark_mode/pen-base-dark-mode.css',
				'bottom-dark-mode'     => '/assets/css/dark_mode/pen-bottom-dark-mode.css',
				'author-dark-mode'     => '/assets/css/dark_mode/pen-author-dark-mode.css',
				'typography-dark-mode' => '/assets/css/dark_mode/pen-typography-dark-mode.css',
				'tables-dark-mode'     => '/assets/css/dark_mode/pen-tables-dark-mode.css',
				'loading-dark-mode'    => '/assets/css/dark_mode/pen-loading-dark-mode.css',
				'comments-dark-mode'   => '/assets/css/dark_mode/pen-comments-dark-mode.css',
				'footer-dark-mode'     => '/assets/css/dark_mode/pen-footer-dark-mode.css',
				'header-dark-mode'     => '/assets/css/dark_mode/pen-header-dark-mode.css',
				'menus-dark-mode'      => '/assets/css/dark_mode/pen-menus-dark-mode.css',
				'navigation-dark-mode' => '/assets/css/dark_mode/pen-navigation-dark-mode.css',
				'forms-dark-mode'      => '/assets/css/dark_mode/pen-forms-dark-mode.css',
				'content-dark-mode'    => '/assets/css/dark_mode/pen-content-dark-mode.css',
				'thumbnails-dark-mode' => '/assets/css/dark_mode/pen-thumbnails-dark-mode.css',
				'pagination-dark-mode' => '/assets/css/dark_mode/pen-pagination-dark-mode.css',
				'search-bar-dark-mode' => '/assets/css/dark_mode/pen-search-bar-dark-mode.css',
				'top-dark-mode'        => '/assets/css/dark_mode/pen-top-dark-mode.css',
				'widgets-dark-mode'    => '/assets/css/dark_mode/pen-widgets-dark-mode.css',
			);
			$css_files_dark_mode['css-dark-mode'] = '/assets/css/dark_mode/pen-general-dark-mode.css';

			if ( PEN_THEME_HAS_WOOCOMMERCE ) {
				$css_files_dark_mode['woocommerce-dark-mode'] = '/assets/css/dark_mode/plugins/wp.woocommerce-dark-mode.css';
				$css_files_dark_mode['select2-dark-mode']     = '/assets/css/dark_mode/plugins/jquery.select2-dark-mode.css';
			}

			foreach ( $css_files_dark_mode as $key => $value ) {
				wp_enqueue_style( 'pen-' . $key, PEN_THEME_DIRECTORY_URI . $value, array(), PEN_THEME_VERSION );
			}

			$dark_mode = pen_option_get( 'dark_mode' );

			if ( 'none' !== $dark_mode ) {
				wp_enqueue_script( 'pen-dark-mode', PEN_THEME_DIRECTORY_URI . '/assets/js/pen-dark-mode.js', array( 'jquery', 'pen-js' ), PEN_THEME_VERSION, true );

				wp_localize_script(
					'pen-dark-mode',
					'pen_dark_mode_js',
					array(
						'is_customize_preview' => $is_customize_preview,
						'type'                 => esc_html( $dark_mode ),
						'allow_switch'         => pen_option_get( 'dark_mode_allow_switch' ) ? true : false,
						'text'                 => array(
							'dark_mode' => esc_html__( 'Dark Mode', 'pen' ),
						),
					)
				);
			}
		}

		// The key has to be the same as the slug in the inline CSS of the customize.php file.
		wp_enqueue_style( 'pen-css', PEN_THEME_DIRECTORY_URI . '/assets/css/pen-general.css', array(), PEN_THEME_VERSION );

		$font_resize_sitetitle = pen_option_get( 'font_resize_sitetitle' );

		if ( 'dynamic' === $font_resize_sitetitle ) {
			wp_enqueue_script( 'jquery-fittext', PEN_THEME_DIRECTORY_URI . '/assets/js/plugins/jquery.fittext.js', array( 'jquery' ), '1.2', true );
		}
		wp_enqueue_script( 'autosize', PEN_THEME_DIRECTORY_URI . '/assets/js/plugins/autosize.js', array(), '4.0', true );
		wp_enqueue_script( 'respond', PEN_THEME_DIRECTORY_URI . '/assets/js/plugins/respond.js', array( 'jquery' ), '1.4.2', true );
		wp_enqueue_script( 'pen-skip', PEN_THEME_DIRECTORY_URI . '/assets/js/skip-link-focus-fix.js', array(), PEN_THEME_VERSION, true );

		if ( $pen_is_singular ) {
			wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script( 'jquery-waypoints', PEN_THEME_DIRECTORY_URI . '/assets/js/plugins/jquery.waypoints.js', array( 'jquery' ), '4.0.1', true );

		wp_enqueue_script( 'imagesloaded' );

		$content_list_type = pen_list_type( $content_id );
		if ( 'masonry' === $content_list_type ) {
			wp_enqueue_script( 'masonry' );
		}

		wp_enqueue_script( 'pen-modernizr', PEN_THEME_DIRECTORY_URI . '/assets/js/plugins/modernizr.js', array(), '3.6', true );

		if ( PEN_THEME_HAS_WOOCOMMERCE ) {
			wp_enqueue_script( 'pen-woocommerce', PEN_THEME_DIRECTORY_URI . '/assets/js/plugins/wp.woocommerce.js', array( 'jquery', 'pen-js' ), PEN_THEME_VERSION, true );

			wp_localize_script(
				'pen-woocommerce',
				'pen_woocommerce_js',
				array(
					'is_customize_preview' => $is_customize_preview,
				)
			);
		}

		$site_background_effect = pen_option_get( 'color_site_background_effect' );

		if ( 'none' !== $site_background_effect ) {
			$trianglify                 = false;
			$trianglify_colors          = array();
			$shards                     = false;
			$shards_colors              = array();
			$dependencies_background_js = array( 'jquery', 'pen-js' );
			if ( 'trianglify' === $site_background_effect ) {
				$trianglify        = true;
				$trianglify_colors = array(
					pen_option_get( 'color_site_background' ),
					pen_option_get( 'color_button_background_primary' ),
					pen_option_get( 'color_button_background_secondary' ),
					pen_option_get( 'color_header_background_primary' ),
					pen_option_get( 'color_header_background_secondary' ),
					pen_option_get( 'color_navigation_background_primary' ),
					pen_option_get( 'color_navigation_background_secondary' ),
				);
				wp_enqueue_script( 'trianglify', PEN_THEME_DIRECTORY_URI . '/assets/js/plugins/trianglify.js', array( 'jquery' ), '2.0.0', true );
				$dependencies_background_js = array_merge( $dependencies_background_js, array( 'trianglify' ) );

			} elseif ( 'shards' === $site_background_effect ) {
				$shards                      = true;
				$site_background             = new \Pen_Theme\Color( pen_option_get( 'color_site_background' ) );
				$site_background             = array_values( $site_background->getRgb() );
				$site_background[]           = 0.25;
				$header_background_primary   = new \Pen_Theme\Color( pen_option_get( 'color_header_background_primary' ) );
				$header_background_primary   = array_values( $header_background_primary->getRgb() );
				$header_background_primary[] = 0.25;
				$shards_colors               = array(
					$site_background,
					$header_background_primary,
				);
				wp_enqueue_script( 'shards', PEN_THEME_DIRECTORY_URI . '/assets/js/plugins/shards.js', array( 'jquery' ), '1.1', true );
				$dependencies_background_js = array_merge( $dependencies_background_js, array( 'shards' ) );
			}

			wp_enqueue_script( 'pen-background', PEN_THEME_DIRECTORY_URI . '/assets/js/pen-background.js', $dependencies_background_js, PEN_THEME_VERSION, true );

			wp_localize_script(
				'pen-background',
				'pen_background_js',
				array(
					'trianglify_colors' => $trianglify_colors, // Array.
					'shards_colors'     => $shards_colors, // Array.
					'text'              => array(
						'background_image' => esc_html__( 'Background Image', 'pen' ),
					),
				)
			);
		}

		if ( pen_option_get( 'header_sticky' ) ) {
			wp_enqueue_script( 'pen-header-sticky', PEN_THEME_DIRECTORY_URI . '/assets/js/pen-header-sticky.js', array( 'jquery', 'pen-js' ), PEN_THEME_VERSION, true );
		}

		$navigation_easing        = array( 'height' => array( 'show', 'swing' ) );
		$navigation_pointer_event = pen_option_get( 'navigation_pointer_event' );
		if ( pen_option_get( 'navigation_display' ) || 'never' !== pen_option_get( 'navigation_mobile_display' ) ) {
			if ( 'click' !== $navigation_pointer_event && ! PEN_THEME_SMALLSCREEN ) {
				wp_enqueue_script( 'hoverIntent' );
				wp_enqueue_script( 'jquery-superfish', PEN_THEME_DIRECTORY_URI . '/assets/js/plugins/jquery.superfish.js', array( 'jquery' ), '1.7.10', true );
			} else {
				wp_enqueue_script( 'jquery-superclick', PEN_THEME_DIRECTORY_URI . '/assets/js/plugins/jquery.superclick.js', array( 'jquery' ), '1.1.0', true );
			}
			$easing = pen_option_get( 'navigation_easing' );
			if ( $easing ) {
				wp_enqueue_script( 'jquery-easing', PEN_THEME_DIRECTORY_URI . '/assets/js/plugins/jquery.easing.js', array( 'jquery' ), '1.3', true );
				$navigation_easing = array(
					'height' => array( 'show', $easing ),
				);
			}

			if ( $is_customize_preview ) {
				$url_home = '#';
			} else {
				$url_home = home_url( '/' );
			}

			$navigation_mobile_sticky = pen_option_get( 'navigation_mobile_sticky' );

			$text_navigation_mobile    = pen_option_get( 'navigation_mobile_text' );
			$choices_navigation_mobile = array(
				'menu'      => __( 'Menu', 'pen' ),
				'menu_main' => __( 'Main Menu', 'pen' ),
			);
			if ( ! empty( $choices_navigation_mobile[ $text_navigation_mobile ] ) ) {
				$text_navigation_mobile = $choices_navigation_mobile[ $text_navigation_mobile ];
			} else {
				$text_navigation_mobile = '';
			}

			wp_enqueue_script( 'pen-navigation', PEN_THEME_DIRECTORY_URI . '/assets/js/pen-navigation.js', array( 'jquery', 'pen-js' ), PEN_THEME_VERSION, true );

			wp_localize_script(
				'pen-navigation',
				'pen_navigation_js',
				array(
					'is_customize_preview'   => $is_customize_preview,
					'url_home'               => $url_home,
					'speed'                  => esc_html( pen_option_get( 'navigation_animation_speed' ) ),
					'pointer_event'          => esc_html( $navigation_pointer_event ),
					'arrows'                 => pen_option_get( 'navigation_arrows' ) ? true : false,
					'easing'                 => $navigation_easing, // Array.
					'mobile_sticky'          => $navigation_mobile_sticky ? true : false,
					'mobile'                 => esc_html( pen_option_get( 'navigation_mobile_display' ) ),
					'mobile_parents_include' => pen_option_get( 'navigation_mobile_parents_include' ) ? true : false,
					'text'                   => array(
						'menu' => esc_html( $text_navigation_mobile ),
					),
				)
			);

			if ( $navigation_mobile_sticky ) {
				wp_enqueue_script( 'pen-navigation-mobile-sticky', PEN_THEME_DIRECTORY_URI . '/assets/js/pen-navigation-mobile-sticky.js', array( 'jquery', 'pen-js', 'pen-navigation' ), PEN_THEME_VERSION, true );

				wp_localize_script(
					'pen-navigation-mobile-sticky',
					'pen_navigation_mobile_sticky_js',
					array(
						'navigation_mobile' => esc_html( pen_option_get( 'navigation_mobile_display' ) ),
					)
				);
			}
		}

		if ( pen_option_get( 'pen_sidebar_left_sticky' ) || pen_option_get( 'pen_sidebar_right_sticky' ) ) {
			wp_enqueue_script( 'pen-sidebars-sticky', PEN_THEME_DIRECTORY_URI . '/assets/js/pen-sidebars-sticky.js', array( 'jquery', 'pen-js' ), PEN_THEME_VERSION, true );
		}

		if ( ! $pen_is_singular && pen_option_get( 'list_infinite_scrolling' ) ) {
			global $paged, $wp_query;
			$page_current  = (int) $paged ? $paged : 1;
			$page_next     = intval( $page_current + 1 );
			$pages_total   = $wp_query->max_num_pages;
			$url_page_next = false;
			if ( $page_next <= $pages_total ) {
				$url_page_next = next_posts( $pages_total, false );
			}
			$url_page_next = add_query_arg( 'pen_sticky_exclude', 'true', $url_page_next );

			if ( $url_page_next ) {

				wp_enqueue_script( 'pen-infinite-scrolling', PEN_THEME_DIRECTORY_URI . '/assets/js/pen-infinite-scrolling.js', array( 'jquery', 'pen-js' ), PEN_THEME_VERSION, true );

				wp_localize_script(
					'pen-infinite-scrolling',
					'pen_infinite_scrolling_js',
					array(
						'is_customize_preview' => $is_customize_preview,
						'allow_stop'           => pen_option_get( 'list_infinite_scrolling_allow_stop' ) ? true : false,
						'page_current'         => (int) $page_current,
						'pages_total'          => (int) $pages_total,
						'url_page_next'        => esc_url( $url_page_next ),
						'text'                 => array(
							'stop'            => esc_html__( 'Stop', 'pen' ),
							'no_more_content' => esc_html__( 'Nothing else to show.', 'pen' ),
						),
					)
				);
			}
		}

		if ( current_user_can( 'edit_theme_options' ) ) {

			if ( ! $pen_is_singular || pen_option_get( 'content_settings_overview_display' ) ) {
				wp_enqueue_script( 'pen-postmeta-overview', PEN_THEME_DIRECTORY_URI . '/assets/js/pen-postmeta-overview-frontend.js', array( 'jquery', 'pen-js' ), PEN_THEME_VERSION, true );

				wp_localize_script(
					'pen-postmeta-overview',
					'pen_postmeta_overview_js',
					array(
						'text' => array(
							'overview' => esc_attr__( 'Content Settings', 'pen' ),
							'close'    => esc_html__( 'Close', 'pen' ),
						),
					)
				);
			}

			if ( PEN_THEME_NOTICE_DEPRECATION ) {
				wp_enqueue_script( 'pen-notice-update', PEN_THEME_DIRECTORY_URI . '/assets/js/pen-notice-update.js', array( 'jquery', 'pen-js' ), PEN_THEME_VERSION, true );

				wp_localize_script(
					'pen-notice-update',
					'pen_notice_update_js',
					array(
						'text' => array(
							'button_warning' => esc_html__( 'Warning', 'pen' ),
						),
					)
				);
			}

			wp_enqueue_script( 'pen-jump-menus', PEN_THEME_DIRECTORY_URI . '/assets/js/pen-jump-menus.js', array( 'jquery', 'pen-js' ), PEN_THEME_VERSION, true );

			wp_localize_script(
				'pen-jump-menus',
				'pen_jump_menus_js',
				array(
					'text' => array(
						'pen_theme'       => esc_html__( 'Pen', 'pen' ),
						'expand_collapse' => esc_html(
							sprintf(
								/* Translators: Just some words. */
								__( '%1$s/%2$s', 'pen' ),
								__( 'Expand', 'pen' ),
								__( 'Collapse', 'pen' )
							)
						),
						'theme_specific'  => esc_attr(
							sprintf(
								'%s %s',
								__( 'This is a part of the Pen theme.', 'pen' ),
								__( 'These settings will be no longer available if you switch to another theme. Other settings are either parts of the WordPress core or your plugins and they will be available even without this theme.', 'pen' )
							)
						),
					),
				)
			);
		}

		if ( 'masonry' === $content_list_type ) {
			wp_enqueue_script( 'pen-layout-masonry', PEN_THEME_DIRECTORY_URI . '/assets/js/pen-layout-masonry.js', array( 'jquery', 'pen-js', 'masonry' ), PEN_THEME_VERSION, true );
		} elseif ( 'plain' === $content_list_type ) {
			wp_enqueue_script( 'pen-layout-plain', PEN_THEME_DIRECTORY_URI . '/assets/js/pen-layout-plain.js', array( 'jquery', 'pen-js' ), PEN_THEME_VERSION, true );
		} elseif ( 'tiles' === $content_list_type ) {
			wp_enqueue_script( 'pen-layout-tiles', PEN_THEME_DIRECTORY_URI . '/assets/js/pen-layout-tiles.js', array( 'jquery', 'pen-js' ), PEN_THEME_VERSION, true );
		}

		wp_enqueue_script(
			'pen-js',
			PEN_THEME_DIRECTORY_URI . '/assets/js/pen-scripts.js',
			array_filter(
				array(
					'jquery',
					( 'dynamic' === $font_resize_sitetitle ) ? 'jquery-fittext' : '',
				)
			),
			PEN_THEME_VERSION,
			true
		);

		wp_localize_script(
			'pen-js',
			'pen_js',
			array(
				'animation_comments'           => esc_html( pen_option_get( 'comments_animation_reveal' ) ),
				'animation_list'               => esc_html( pen_option_get( 'list_animation_reveal' ) ),
				'animation_list_thumbnails'    => esc_html( pen_option_get( 'list_thumbnail_animation_reveal' ) ),
				'animation_content'            => esc_html( pen_option_get( 'content_animation_reveal' ) ),
				'animation_content_thumbnails' => esc_html( pen_option_get( 'content_thumbnail_animation_reveal' ) ),
				'site_footer_display'          => pen_option_get( 'site_footer_display' ) ? true : false,
				'font_resize'                  => array(
					'site_title' => esc_html( $font_resize_sitetitle ),
				),
				'text'                         => array(
					'enter_keyword' => esc_html__( 'Please enter some keywords.', 'pen' ),
				),
			)
		);

		if ( file_exists( PEN_THEME_DIRECTORY_URI . '/assets/js/custom.js' ) ) {
			wp_enqueue_script( 'pen-custom', PEN_THEME_DIRECTORY_URI . '/assets/js/custom.js', array( 'jquery', 'pen-js' ), PEN_THEME_VERSION, true );
		}

		wp_enqueue_script( 'html5shiv', PEN_THEME_DIRECTORY_URI . '/assets/js/plugins/html5.js', array(), '3.7.3', false );
		wp_script_add_data( 'html5shiv', 'conditional', 'lt IE 9' );

	}
	add_action( 'wp_enqueue_scripts', 'pen_assets' );

}
