/**
 * Deprecation notices.
 *
 * @package Pen
 */

;( function( $ ) {

	'use strict';

	$( document ).ready(
		function() {

			var $page = $( '#page' );

			$page.find( '.pen_warning_upgrade' ).each( function() {
				var $warning = $( this );
				$warning.addClass( 'pen_element_hidden' ).attr( 'aria-hidden', 'true' )
				.before( '<button class="pen_warning_toggle">' + pen_notice_update_js.text.button_warning + '</button>' )
				.prev( '.pen_warning_toggle' ).on( 'click', function() {
					var $toggle = $( this );
					$warning.on( 'click', function() {
						$( this ).addClass( 'pen_element_hidden' ).attr( 'aria-hidden', 'true' );
						$toggle.after( $warning );
					} );
					if ( $warning.hasClass( 'pen_element_hidden' ) ) {
						$page.append( $warning );
						$warning.removeClass( 'pen_element_hidden' ).attr( 'aria-hidden', 'false' );
					} else {
						$warning.addClass( 'pen_element_hidden' ).attr( 'aria-hidden', 'true' );
						$toggle.after( $warning );
					}
				} );
			} );
		}
	)
})( jQuery );

