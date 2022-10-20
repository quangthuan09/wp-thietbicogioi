/**
 * Sticky mobile menu.
 *
 * @package Pen
 */

;( function( $ ) {

	'use strict';

	var $window = $( window ),
		$body = $( 'body' ),
		$wpadminbar = $( '#wpadminbar' ),
		$header = $( '#pen_header' ),
		$page_wrapper = $( '#page' ).children( '.pen_wrapper' );

	$window.on( 'load resize orientationchange pen_update_sticky_navigation_mobile pen_update_navigation_mobile', function() {
		var $navigation_mobile = $( '#pen_navigation_mobile' );
		if ( $navigation_mobile.length ) {
			var navigation_mobile_top = 0,
				admin_toolbar_height = 0,
				header_height = ( $header.css( 'position' ) === 'fixed' ) ? $header.outerHeight( true ) : 0,
				navigation_mobile_height = $navigation_mobile.removeClass( 'pen_navigation_mobile_sticked' ).outerHeight( true );
			if ( $wpadminbar.length ) {
				admin_toolbar_height = $wpadminbar.outerHeight( true );
			}
			$navigation_mobile.css( { left: 0, position: 'fixed', top: admin_toolbar_height } );

			$page_wrapper.css( { paddingTop: navigation_mobile_height + header_height } );

			$window.on( 'scroll', function() {
				if ( $window.scrollTop() ) {
					var stick = false;
					if ( pen_navigation_mobile_sticky_js.navigation_mobile === 'always' ) {
						stick = true;
					} else if ( pen_function_exists( typeof Modernizr ) ) {
						var breakpoint = '';
						if ( pen_navigation_mobile_sticky_js.navigation_mobile === 'mobile' ) {
							breakpoint = ' and (max-width:728px)';
						} else if ( pen_navigation_mobile_sticky_js.navigation_mobile === 'tablet' || pen_navigation_mobile_sticky_js.navigation_mobile === 'mobile_tablet' ) {
							breakpoint = ' and (max-width:1024px)';
						}
						if ( breakpoint && Modernizr.mq( 'only all' + breakpoint ) ) {
							stick = true;
						}
					}
					if ( stick ) {
						$navigation_mobile.css( {
							top: ( $wpadminbar.css( 'position' ) === 'fixed' ) ? admin_toolbar_height : 0
						} );
						$navigation_mobile.addClass( 'pen_navigation_mobile_sticked' );
						$body.addClass( 'pen_navigation_mobile_sticked' );
					}
				} else {
					$navigation_mobile.removeClass( 'pen_navigation_mobile_sticked' ).css( { top: admin_toolbar_height } );
					$body.removeClass( 'pen_navigation_mobile_sticked' );
				}
			});
		}
	});
})( jQuery );
