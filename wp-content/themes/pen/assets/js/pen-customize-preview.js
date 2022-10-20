/**
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @package Pen
 */

;( function( $ ) {
	function pen_element_header_logo() {
		return $( '#pen_header #pen_site_title .custom-logo-link' );
	}
	function pen_element_footer_menu() {
		return $( '#pen_footer_menu' );
	}
	function pen_element_footer_copyright() {
		return $( '#pen_footer .site-info' );
	}

	function pen_option_get( option ) {
		var preset = ( option.substr( 0, 5 ) === 'color' ) ? pen_preview_js.preset_color : 'preset_1',
		element    = wp.customize( 'pen_' + option + '[' + preset + ']' );
		if ( element === 'undefined' || element === undefined || element === null ) {
			console.log( option );
		}
		return wp.customize( 'pen_' + option + '[' + preset + ']' )();
	}

	/**
	 * After each page load.
	 */
	wp.customize.bind(
		'preview-ready',
		function() {

			$( '#page' ).find( 'a.pen_customizer_shortcut' ).each(
				function() {
					$( this ).on(
						'click',
						function( event ) {
							var data = $( this ).data();
							wp.customize.preview.send( 'pen_switch_section', { type: data.type, target: data.target } );
							event.preventDefault();
						}
					);
				}
			);

			wp.customize.preview.bind(
				'pen_section_change',
				function( data ) {
					if ( $( data.selector ).length ) {
						var element_offset = $( data.selector ).offset().top;
						if ( $( 'body' ).hasClass( 'pen_header_sticky' ) ) {
							element_offset -= $( '#pen_header' ).outerHeight( true );
						}
						element_offset -= 200;
						$( 'html, body' ).stop( true, true ).animate( { scrollTop: element_offset }, 500 );
					}
				}
			);

			/**
			 * Logo.
			 */
			var pen_logo_source = pen_element_header_logo().find( 'img' ).attr( 'src' );
			if ( pen_logo_source === 'undefined' || pen_logo_source === undefined || pen_logo_source === null ) {
				$( '#pen_header' ).removeClass( 'pen_logo_show' );
			} else {
				$( '#pen_header' ).addClass( 'pen_logo_show' );
			}

			/**
			 * Layout
			 */
			$( 'body' ).removeClass(
				function( index, css ) {
					return ( css.match( /(^|\s)pen_main_container_\S+/g ) || [] ).join( ' ' );
				}
			).addClass( 'pen_main_container_' + pen_option_get( 'container_position' ) )
			.removeClass(
				function( index, css ) {
					return ( css.match( /(^|\s)pen_dark_mode_switch_\S+/g ) || [] ).join( ' ' );
				}
			).addClass( 'pen_dark_mode_switch_' + pen_option_get( 'dark_mode_switch_location' ) )
			.removeClass(
				function( index, css ) {
					return ( css.match( /(^|\s)pen_sidebar_left_width_\S+/g ) || [] ).join( ' ' );
				}
			).addClass( 'pen_sidebar_left_width_' + ( pen_option_get( 'sidebar_left_width' ).replace( '%', '' ) ) )
			.removeClass(
				function( index, css ) {
					return ( css.match( /(^|\s)pen_sidebar_right_width_\S+/g ) || [] ).join( ' ' );
				}
			).addClass( 'pen_sidebar_right_width_' + ( pen_option_get( 'sidebar_right_width' ).replace( '%', '' ) ) );

			/**
			 * Header.
			 */
			$( 'body' )
			.removeClass(
				function( index, css ) {
					return ( css.match( /(^|\s)pen_header_alignment_\S+/g ) || [] ).join( ' ' );
				}
			).addClass( 'pen_header_alignment_' + pen_option_get( 'header_alignment' ) )
			.removeClass(
				function( index, css ) {
					return ( css.match( /(^|\s)pen_padding_header_\S+/g ) || [] ).join( ' ' );
				}
			).addClass( 'pen_padding_header_' + pen_option_get( 'padding_header' ) )
			.removeClass(
				function( index, css ) {
					return ( css.match( /(^|\s)pen_padding_navigation_\S+/g ) || [] ).join( ' ' );
				}
			).addClass( 'pen_padding_navigation_' + pen_option_get( 'padding_navigation' ) );

			/**
			 * Navigation.
			 */
			$( 'body' ).removeClass(
				function( index, css ) {
					return ( css.match( /(^|\s)pen_navigation_alignment_\S+/g ) || [] ).join( ' ' );
				}
			).addClass( 'pen_navigation_alignment_' + pen_option_get( 'navigation_alignment' ) );

			/**
			 * Footer.
			 */
			$( 'body' ).removeClass(
				function( index, css ) {
					return ( css.match( /(^|\s)pen_footer_alignment_\S+/g ) || [] ).join( ' ' );
				}
			).addClass( 'pen_footer_alignment_' + pen_option_get( 'footer_alignment' ) );
			if ( pen_option_get( 'footer_menu_display' ) ) {
				pen_element_footer_menu().show();
			} else {
				pen_element_footer_menu().hide();
			}
			if ( pen_option_get( 'footer_copyright_display' ) ) {
				pen_element_footer_copyright().show();
			} else {
				pen_element_footer_copyright().hide();
			}

		}
	);

	/**
	 * Layout.
	 */
	wp.customize(
		'pen_container_position[preset_1]',
		function( value ) {
			value.bind(
				function( position ) {
					$( 'body' ).removeClass(
						function( index, css ) {
							return ( css.match( /(^|\s)pen_main_container_\S+/g ) || [] ).join( ' ' );
						}
					).addClass( 'pen_main_container_' + position );
				}
			);
		}
	);
	wp.customize(
		'pen_dark_mode_switch_location[preset_1]',
		function( value ) {
			value.bind(
				function( position ) {
					$( 'body' ).removeClass(
						function( index, css ) {
							return ( css.match( /(^|\s)pen_dark_mode_switch_\S+/g ) || [] ).join( ' ' );
						}
					).addClass( 'pen_dark_mode_switch_' + position );
				}
			);
		}
	);
	wp.customize(
		'pen_sidebar_left_width[preset_1]',
		function( value ) {
			value.bind(
				function( width ) {
					$( 'body' ).removeClass(
						function( index, css ) {
							return ( css.match( /(^|\s)pen_sidebar_left_width_\S+/g ) || [] ).join( ' ' );
						}
					).addClass( 'pen_sidebar_left_width_' + ( width.replace( '%', '' ) ) );
				}
			);
		}
	);
	wp.customize(
		'pen_sidebar_right_width[preset_1]',
		function( value ) {
			value.bind(
				function( width ) {
					$( 'body' ).removeClass(
						function( index, css ) {
							return ( css.match( /(^|\s)pen_sidebar_right_width_\S+/g ) || [] ).join( ' ' );
						}
					).addClass( 'pen_sidebar_right_width_' + ( width.replace( '%', '' ) ) );
				}
			);
		}
	);

	/**
	 * Header.
	 */
	wp.customize(
		'pen_header_alignment[preset_1]',
		function( value ) {
			value.bind(
				function( position ) {
					$( 'body' ).removeClass(
						function( index, css ) {
							return ( css.match( /(^|\s)pen_header_alignment_\S+/g ) || [] ).join( ' ' );
						}
					).addClass( 'pen_header_alignment_' + position );
				}
			);
		}
	);
	wp.customize(
		'pen_padding_header[preset_1]',
		function( value ) {
			value.bind(
				function( size ) {
					$( 'body' ).removeClass(
						function( index, css ) {
							return ( css.match( /(^|\s)pen_padding_header_\S+/g ) || [] ).join( ' ' );
						}
					).addClass( 'pen_padding_header_' + size );
				}
			);
		}
	);
	wp.customize(
		'pen_padding_navigation[preset_1]',
		function( value ) {
			value.bind(
				function( size ) {
					$( 'body' ).removeClass(
						function( index, css ) {
							return ( css.match( /(^|\s)pen_padding_navigation_\S+/g ) || [] ).join( ' ' );
						}
					).addClass( 'pen_padding_navigation_' + size );
				}
			);
		}
	);

	/**
	 * Navigation.
	 */
	wp.customize(
		'pen_navigation_alignment[preset_1]',
		function( value ) {
			value.bind(
				function( position ) {
					$( 'body' ).removeClass(
						function( index, css ) {
							return ( css.match( /(^|\s)pen_navigation_alignment_\S+/g ) || [] ).join( ' ' );
						}
					).addClass( 'pen_navigation_alignment_' + position );
				}
			);
		}
	);

	/**
	 * Footer.
	 */
	wp.customize(
		'pen_footer_alignment[preset_1]',
		function( value ) {
			value.bind(
				function( position ) {
					$( 'body' ).removeClass(
						function( index, css ) {
							return ( css.match( /(^|\s)pen_footer_alignment_\S+/g ) || [] ).join( ' ' );
						}
					).addClass( 'pen_footer_alignment_' + position );
				}
			);
		}
	);
	wp.customize(
		'pen_footer_menu_display[preset_1]',
		function( value ) {
			value.bind(
				function( display ) {
					if ( display ) {
						pen_element_footer_menu().show();
					} else {
						pen_element_footer_menu().hide();
					}
				}
			);
		}
	);
	wp.customize(
		'pen_footer_copyright_display[preset_1]',
		function( value ) {
			value.bind(
				function( display ) {
					if ( display ) {
						pen_element_footer_copyright().show();
					} else {
						pen_element_footer_copyright().hide();
					}
				}
			);
		}
	);

} )( jQuery );
