/**
 * Plain layout.
 *
 * @package Pen
 */

;( function( $ ) {

	'use strict';

	$( window ).on( 'load', function() {
		if ( $( '#pen_plain' ).length ) {
			$( '#pen_plain' ).pen_layout_plain();
		}
	});

	$.fn.extend(
		{
			pen_layout_plain: function() {
				var $list = this,
					$main = $( '#main' );
				if ( pen_function_exists( typeof pen_animation ) ) {
					var $thumbnails = $main.find( '.pen_image_thumbnail' );
					if ( $( 'body' ).hasClass( 'pen_multiple' ) ) {
						var $items = $main.find( '.pen_article' );
						pen_animation( $items, pen_js.animation_list );
						pen_animation( $thumbnails, pen_js.animation_list_thumbnails );
					} else {
						pen_animation( $main, pen_js.animation_content );
						pen_animation( $thumbnails, pen_js.animation_content_thumbnails );
					}
				}
			}
		}
	)
})( jQuery );
