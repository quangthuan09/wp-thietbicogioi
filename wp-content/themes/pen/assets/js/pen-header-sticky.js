/**
 * Sticky header.
 *
 * @package Pen
 */

;( function( $ ) {

	'use strict';

	var $body = $( 'body' );
	if ( ! $body.hasClass( 'pen_site_header_hide' ) ) {
		var $window = $( window ),
			$wpadminbar = $( '#wpadminbar' ),
			$header = $( '#pen_header' ),
			$page_wrapper = $( '#page' ).children( '.pen_wrapper' ),
			layout_boxed = $body.hasClass( 'pen_width_boxed' ) ? true : false,
			layout_narrow = $body.hasClass( 'pen_width_narrow' ) ? true : false;

		$window.on( 'load resize orientationchange pen_update_sticky_header pen_update_navigation pen_update_navigation_mobile pen_update_sticky_navigation_mobile', function() {

			var stick = true,
				$mobile_menu = $( '#pen_navigation_mobile' );

			if ( $body.hasClass( 'pen_width_narrow' ) ) {
				stick = false;
			} else if ( pen_function_exists( typeof Modernizr ) && Modernizr.mq( 'only all and (max-width:728px)' ) ) {
				stick = false;
			} else if ( ( $window.outerHeight() / 2 ) < $header.outerHeight( true ) ) {
				stick = false;
			}

			if ( ! stick ) {
				$header.removeClass( 'pen_header_sticked' ).css( { left: '', position: '', top: '' } );
				$body.removeClass( 'pen_header_sticked' );
				var reset_padding_top = 0;
				if ( $mobile_menu.length && $mobile_menu.css( 'position' ) === 'fixed' ) {
					reset_padding_top += $mobile_menu.outerHeight( true );
				}
				$page_wrapper.css( { paddingTop: reset_padding_top } );

			} else {

				var header_top = 0,
					header_offset_left = 0,
					admin_toolbar_height = 0,
					mobile_menu_height = 0,
					page_padding_top = 0,
					header_height = $header.removeClass( 'pen_header_sticked' ).outerHeight( true );

				if ( $wpadminbar.length ) {
					var admin_toolbar_height = $wpadminbar.outerHeight( true );
					header_top += admin_toolbar_height;
				}
				if ( $mobile_menu.length ) {
					var mobile_menu_height = $mobile_menu.outerHeight( true );
					header_top += mobile_menu_height;
					if ( $mobile_menu.css( 'position' ) === 'fixed' ) {
						page_padding_top += mobile_menu_height;
					}
				}
				if ( layout_boxed || layout_narrow ) {
					var header_offset = $page_wrapper.offset();
					if ( header_offset ) {
						header_offset_left = header_offset.left;
					}
					$header.css( { width: $( '#pen_section' ).outerWidth( true ) } );
				}

				$header.css( { left: header_offset_left, position: 'fixed', top: header_top } );

				if ( $header.css( 'position' ) === 'fixed' ) {
					page_padding_top += header_height;
				}
				$page_wrapper.css( { paddingTop: page_padding_top } );
			}

			$window.on( 'scroll', function() {
				if ( $window.scrollTop() && ( $window.outerHeight() / 2 ) > $header.outerHeight( true ) ) {
					$header.addClass( 'pen_header_sticked' );
					$body.addClass( 'pen_header_sticked' );
					var header_top_dynamic = 0;
					if ( $wpadminbar.length && $wpadminbar.css( 'position' ) === 'fixed' ) {
						header_top_dynamic += admin_toolbar_height;
					}
					if ( $mobile_menu.length && $mobile_menu.css( 'position' ) === 'fixed' ) {
						header_top_dynamic += mobile_menu_height;
					}
					if ( $header.css( 'position' ) === 'fixed' ) {
						$header.css( { top: header_top_dynamic } );
					}
				} else {
					$header.removeClass( 'pen_header_sticked' )
					.css( { top: ( $header.css( 'position' ) === 'fixed' ) ? header_top : 0 } );
					$body.removeClass( 'pen_header_sticked' );
				}
			});
		});
	}

})( jQuery );
