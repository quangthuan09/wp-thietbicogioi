/**
 * Google Fonts.
 *
 * @package Pen
 */

;( function( $ ) {

	'use strict';

	$( document ).ready(
		function() {
			if ( pen_googlefonts.families.length && pen_function_exists( typeof WebFont ) ) {
				WebFont.load( { google: { families: pen_googlefonts.families } } );
			}
		}
	)
})( jQuery );
