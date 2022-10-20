/**
 * jQuery Masonry layout.
 *
 * @package Pen
 */

;( function( $ ) {

	'use strict';

	var $window = $( window );

	$window.on( 'load', function() {
		if ( $( '#pen_masonry' ).length ) {
			$( '#pen_masonry' ).pen_layout_masonry();
		}
	})
	.on( 'resize orientationchange', function() {
		if ( $( '#pen_masonry.pen_masonry_applied' ).length ) {
			$( '#pen_masonry' ).pen_layout_masonry();
		}
	});

	$.fn.extend(
		{
			pen_layout_masonry: function() {
				var $list = this;
				if ( pen_function_exists( typeof $window.masonry ) ) {
					$list.masonry(
						{
							itemSelector: '.pen_article',
							percentPosition: true,
							transitionDuration: 0
						}
					).addClass( 'pen_masonry_applied' );
					if ( pen_function_exists( typeof $window.imagesLoaded ) ) {
						$list.imagesLoaded(
							function() {
								$list.masonry( 'layout' );
								pen_content_height();
								if ( pen_function_exists( typeof pen_animation ) ) {
									var $main = $( '#main' ),
										$items = $main.find( '.pen_article' ),
										$thumbnails = $main.find( '.pen_image_thumbnail' );
									pen_animation( $items, pen_js.animation_list );
									pen_animation( $thumbnails, pen_js.animation_list_thumbnails );
								}
							}
						);
					}
					setTimeout(
						function() {
							$list.masonry( 'layout' );
							pen_content_height();
						},
						3000
					);
				}
			}
		}
	)
})( jQuery );
