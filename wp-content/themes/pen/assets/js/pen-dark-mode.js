/**
 * Dark mode.
 *
 * @package Pen
 */

;( function( $ ) {

	'use strict';

	var $body = $( 'body' );

	$( document ).ready( function() {
		if ( pen_dark_mode_js.type !== 'none' ) {
			var local_storage = pen_function_exists( typeof window.localStorage.setItem ) ? true : false;
			function pen_dark_mode( active ) {
				if ( ! pen_dark_mode_js.is_customize_preview ) {
					if ( active ) {
						$body.addClass( 'pen_dark_mode' );
						if ( pen_dark_mode_js.type === 'web_browser' ) {
							$body.addClass( 'pen_dark_mode_always' );
						}
						if ( local_storage ) {
							window.localStorage.setItem( 'pen_dark_mode', 'on' );
						}
					} else {
						$body.removeClass( 'pen_dark_mode' );
						if ( pen_dark_mode_js.type === 'web_browser' ) {
							$body.removeClass( 'pen_dark_mode_always' );
						}
						if ( local_storage ) {
							window.localStorage.setItem( 'pen_dark_mode', 'off' );
						}
					}
				}
			}

			if ( pen_dark_mode_js.type === 'always' ) {
				pen_dark_mode( true );
			}
			else if ( pen_dark_mode_js.type === 'clock' ) {
				var dark_mode_stored = window.localStorage.getItem( 'pen_dark_mode' );
				if ( dark_mode_stored === 'null' || dark_mode_stored === null ) {
					var date = new Date(),
						hour = date.getHours();
					if ( hour > 18 || hour < 7 ) {
						pen_dark_mode( true );
					} else {
						pen_dark_mode( false );
					}
					var $dark_mode_switch = $( '#pen_dark_mode' );
					if ( $dark_mode_switch.length ) {
						if ( $body.hasClass( 'pen_dark_mode' ) ) {
							$dark_mode_switch.prop( 'checked', true ).attr( 'aria-checked', 'true' ).trigger( 'change' );
						} else {
							$dark_mode_switch.prop( 'checked', false ).attr( 'aria-checked', 'false' ).trigger( 'change' );
						}
					}
				}
			}
			else if ( pen_dark_mode_js.type === 'web_browser' ) {
				if ( local_storage ) {
					var dark_mode_stored = window.localStorage.getItem( 'pen_dark_mode' );
					if ( dark_mode_stored === 'null' || dark_mode_stored === null ) {
						pen_dark_mode( true );
					}
				} else {
					var dark_mode_enabled = ( window.matchMedia && window.matchMedia( '(prefers-color-scheme:dark)' ).matches ) ? true : false;
					if ( dark_mode_enabled ) {
						pen_dark_mode( true );
					} else {
						pen_dark_mode( false );
					}
				}
			}

			if ( local_storage ) {
				var dark_mode_stored = window.localStorage.getItem( 'pen_dark_mode' );
				if ( dark_mode_stored === 'on' ) {
					pen_dark_mode( true );
				} else if ( dark_mode_stored === 'off' ) {
					pen_dark_mode( false );
				}
			}

			if ( pen_dark_mode_js.allow_switch ) {
				$body.append( '<label for="pen_dark_mode" id="pen_dark_mode_toggle" title="' + pen_dark_mode_js.text.dark_mode + '"><input id="pen_dark_mode" class="pen_element_hidden" type="checkbox" aria-label="' + pen_dark_mode_js.text.dark_mode + '" aria-hidden="true"></label>' );
				if ( ! pen_dark_mode_js.is_customize_preview ) {
					$( '#pen_dark_mode' ).on( 'change', function() {
						if ( $body.hasClass( 'pen_dark_mode' ) ) {
							pen_dark_mode( false );
						} else {
							pen_dark_mode( true );
						}
					} );
				}
			}
		}
	})
})( jQuery );
