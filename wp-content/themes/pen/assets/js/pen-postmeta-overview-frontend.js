/**
 * Postmeta overview.
 *
 * @package Pen
 */

;( function( $ ) {

	'use strict';

	$( document ).ready(
		function() {

			$( '#primary' ).find( '.pen_options_overview' ).each(
				function() {
					var $overview = $( this );
					if ( $( 'body' ).hasClass( 'pen_singular' ) ) {
						$( '#page' ).append( $overview );
					}
					var overview_id = $overview.attr( 'id' ),
						toggle_id = overview_id + '_toggle';
					$overview.addClass( 'pen_off_screen' )
					.prepend( '<a href="#" class="pen_close">' + pen_postmeta_overview_js.text.close + '</a>' )
					.before( '<a href="#" id="' + toggle_id + '" class="pen_options_overview_toggle pen_button pen_visible" title="' + pen_postmeta_overview_js.text.overview + '">' + pen_postmeta_overview_js.text.overview + '</a>' )
					.find( '.pen_close' ).on(
						'click',
						function( event ) {
							$( '#' + toggle_id ).toggleClass( 'pen_visible' );
							$overview.toggleClass( 'pen_visible' );
							event.preventDefault();
						}
					);
					$( '#' + toggle_id ).on(
						'click',
						function( event ) {
							$( this ).toggleClass( 'pen_visible' );
							$overview.toggleClass( 'pen_visible' );
							event.preventDefault();
						}
					);
				}
			);

		}
	)
})( jQuery );
