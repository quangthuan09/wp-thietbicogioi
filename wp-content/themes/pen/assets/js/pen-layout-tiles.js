/**
 * Tiles layout.
 *
 * @package Pen
 */

;( function( $ ) {

	'use strict';

	var $window = $( window ),
		$body = $( 'body' );

	$window.on( 'load', function() {
		if ( $( '#pen_tiles' ).length ) {
			$( '#pen_tiles' ).pen_layout_tiles();
		}
	})
	.on( 'resize orientationchange', function() {
		if ( $( '#pen_tiles' ).length ) {
			$( '#pen_tiles' ).pen_layout_tiles();
		}
	});

	$.fn.extend(
		{
			pen_layout_tiles: function() {
				if ( $body.hasClass( 'pen_width_narrow' ) ) {
					return false;
				}
				var $list = this;
				if ( pen_function_exists( typeof Modernizr ) && Modernizr.mq( 'only all and (max-width:728px)' ) ) {
					$list.find( '.pen_article' ).css( { minHeight: '' } );
				} else {
					if ( pen_function_exists( typeof $window.imagesLoaded ) ) {
						$list.imagesLoaded(
							function() {
								var $articles = $list.find( '.pen_article' ),
									height = 0;
								$articles.each( function() {
									height = Math.max( height, $( this ).outerHeight( true ) );
								} );
								$articles.css( 'min-height', height );
								pen_content_height();
							}
						);
					} else {
						/**
						 * Since we're only using it on window.load and window.resize it may
						 * work without imagesLoaded() too.
						 */
						var $articles = $list.find( '.pen_article' ),
							height = 0;
						$articles.each( function() {
							height = Math.max( height, $( this ).outerHeight( true ) );
						} );
						$articles.css( 'min-height', height );
						pen_content_height();
					}
				}
				if ( pen_function_exists( typeof pen_animation ) ) {
					var $main = $( '#main' ),
						$items = $main.find( '.pen_article' ),
						$thumbnails = $main.find( '.pen_image_thumbnail' );
					pen_animation( $items, pen_js.animation_list );
					pen_animation( $thumbnails, pen_js.animation_list_thumbnails );
				}
				/* pen_content_height() does nothing on mobile. */
				setTimeout(
					function() {
						pen_content_height();
					},
					5000
				);

			}
		}
	)
})( jQuery );
