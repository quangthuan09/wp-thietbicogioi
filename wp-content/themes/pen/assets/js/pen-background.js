/**
 * Background.
 *
 * @package Pen
 */

;( function( $ ) {

	'use strict';

	var $window = $( window ),
		$body = $( 'body' ),
		background_image = $body.css( 'background-image' );

	$( document ).ready( function() {
		if ( background_image && background_image === 'none' ) {
			if ( pen_background_js.trianglify_colors && pen_function_exists( typeof Trianglify ) ) {

				function pen_background_trianglify() {
					$( '#pen_background_trianglify' ).remove();
					var pattern = Trianglify(
						{
							height: window.innerHeight,
							width: window.innerWidth,
							x_colors: pen_background_js.trianglify_colors,
							y_colors: 'match_x',
							cell_size: 80
						}
					),
					svg = $( '<div />' ).prepend( pattern.svg() ).html(),
					$trianglify = $( svg ).attr( { id: 'pen_background_trianglify' } );
					$body.addClass( 'pen_trianglify' ).prepend( $trianglify );
					$( '#pen_background_trianglify' )
					.attr( 'role', 'img' )
					.attr( 'aria-label', pen_background_js.text.background_image );
				}

				pen_background_trianglify();

				$window.on( 'load resize orientationchange', function() {
					pen_background_trianglify();
				} );

			} else if ( pen_background_js.shards_colors && pen_function_exists( typeof $window.shards ) ) {

				function pen_background_shards() {
					$( '#pen_background_shards' ).remove();
					var $shards = $( '<div id="pen_background_shards" />' );
					$shards.shards( pen_background_js.shards_colors[0], pen_background_js.shards_colors[1], [0,0,0,0.5], 20, .8, 2, .15, 1 );
					$body.addClass( 'pen_shards' ).prepend( $shards );
					$( '#pen_background_shards' ).children( 'svg' )
					.attr( 'role', 'img' )
					.attr( 'aria-label', pen_background_js.text.background_image );
				}

				pen_background_shards();

				$window.on( 'load resize orientationchange', function() {
					pen_background_shards();
				} );
			}
		}
	})
})( jQuery );
