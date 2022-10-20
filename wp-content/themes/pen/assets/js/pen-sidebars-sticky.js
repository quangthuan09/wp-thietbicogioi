/**
 * Sticky sidebars.
 *
 * @package Pen
 */

;( function( $ ) {

	'use strict';

	var $window = $( window ),
		$body = $( 'body' ),
		$wpadminbar = $( '#wpadminbar' ),
		$header = $( '#pen_header' );

	$( document ).ready(
		function() {

			var $navigation_mobile = $( '#pen_navigation_mobile' );

			function pen_sidebar_sticky_position( $sidebar, height_document, height_window, space_bottom, container_offset ) {

				var sidebar_offset_top = parseInt( $sidebar.offset().top ),
					height_sidebar = parseInt( $sidebar.outerHeight( true ) ),
					sidebar_offset_bottom = parseInt( height_document - sidebar_offset_top - height_sidebar ),
					scroll_top = parseInt( $window.scrollTop() ),
					scroll_bottom = parseInt( height_document - height_window - scroll_top ),
					reset = false;

				if ( scroll_top ) {
					if ( scroll_top > container_offset ) {
						var position_top = ( scroll_top - container_offset ) + 10;
						if ( $navigation_mobile.length && $navigation_mobile.hasClass( 'pen_navigation_mobile_sticked' ) ) {
							position_top += $( '#pen_navigation_mobile_toggle' ).outerHeight( true );
						}
						if ( $header.hasClass( 'pen_header_sticked' ) ) {
							position_top += $header.outerHeight( true );
						}
						if ( $wpadminbar.length ) {
							position_top += $wpadminbar.outerHeight( true );
						}
						if ( ( height_document - ( container_offset + position_top + height_sidebar ) ) > space_bottom ) {
							$sidebar.css( { bottom: '', top: position_top } );
						} else {
							var position_bottom = 0;
							if ( $( '#pen_footer' ).css( 'position' ) === 'absolute' ) {
								position_bottom += parseInt( $( '#content' ).css( 'padding-bottom' ) );
							}
							$sidebar.css( { bottom: position_bottom, top: 'auto' } );
						}
					}
				} else {
					$sidebar.css( { bottom: '', top: '' } ).removeClass( 'pen_sidebar_sticked' );
				}
			}

			function pen_sidebar_sticky_add( $sidebar, space_bottom ) {
				var height_document = $( document ).height(),
				height_window = $window.height(),
				container_offset = $( '#content' ).offset().top,
				desktop = false,
				tablet_portrait = false;

				if ( pen_function_exists( typeof Modernizr ) ) {
					desktop = Modernizr.mq( 'only all and (min-width:728px)' );
					tablet_portrait = Modernizr.mq( 'only all and (min-width:728px) and (max-width:1024px) and (orientation:portrait)' );
				}
				if ( desktop && ! tablet_portrait ) {
					pen_sidebar_sticky_position( $sidebar, height_document, height_window, space_bottom, container_offset );
					$window.on( 'scroll', function(){
						setTimeout(
							function() {
								pen_sidebar_sticky_position( $sidebar, height_document, height_window, space_bottom, container_offset );
							},
							500
						);
					} );
				}


				$window.on( 'resize orientationchange', function() {
					setTimeout(
						function() {
							height_document = $( document ).height();
							height_window = $window.height();
							container_offset = $( '#content' ).offset().top,
							desktop = false,
							tablet_portrait = false;

							if ( pen_function_exists( typeof Modernizr ) ) {
								desktop = Modernizr.mq( 'only all and (min-width:728px)' );
								tablet_portrait = Modernizr.mq( 'only all and (min-width:728px) and (max-width:1024px) and (orientation:portrait)' );
							}
							if ( window.innerWidth > document.documentElement.clientWidth && desktop && ! tablet_portrait ) {
								pen_sidebar_sticky_position( $sidebar, height_document, height_window, space_bottom, container_offset );
								$window.on( 'scroll', function(){
									setTimeout(
										function() {
											pen_sidebar_sticky_position( $sidebar, height_document, height_window, space_bottom, container_offset );
										},
										500
									);
								} );
							} else {
								$sidebar.css( { bottom: '', top: '' } ).removeClass( 'pen_sidebar_sticked' );
							}
						},
						1000
					);
				} );
			}


			function pen_sidebar_sticky() {
				var $bottom = $('#pen_bottom'),
					$footer = $('#pen_footer'),
					space_bottom = 0;

				if ( $bottom.length ) {
					space_bottom += $bottom.outerHeight( true );
				}
				if ( $footer.length ) {
					space_bottom += $footer.outerHeight( true );
				}

				if ( $( '#pen_left' ).hasClass( 'pen_sidebar_sticky' ) ) {
					pen_sidebar_sticky_add( $( '#pen_left' ), space_bottom );
				}
				if ( $( '#pen_right' ).hasClass( 'pen_sidebar_sticky' ) ) {
					pen_sidebar_sticky_add( $( '#pen_right' ), space_bottom );
				}
			}

			pen_sidebar_sticky();

			$window.on( 'load', function() {
				pen_sidebar_sticky();
			} );

			$( '#content' ).find( 'iframe' ).each( function() {
				$( this ).on( 'load', function() {
					pen_sidebar_sticky();
				} );
			} );

		}
	)
})( jQuery );
