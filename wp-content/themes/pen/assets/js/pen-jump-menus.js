/**
 * Shortcut links.
 *
 * @package Pen
 */

;( function( $ ) {

	'use strict';

	$( document ).ready(
		function() {

			function pen_jump_menu( $menu ) {
				var $heading = $menu.find( 'strong.pen_jump_menu_title' ),
				name = pen_text_trim( $heading.children( 'span.pen_jump_menu_name' ).text() ),
				title = pen_text_trim( $heading.attr( 'title' ) );
				$menu.prepend( '<button type="button" class="pen_toggle pen_collapsed" title="' + title + '"><span class="pen_element_hidden">' + pen_jump_menus_js.text.expand_collapse + '</span><span class="pen_caption pen_element_hidden">' + name + '</span></button>' )
				.find( '.pen_menu_wrapper' ).attr( 'aria-hidden', true )
				.end().removeClass( 'pen_element_hidden' ).attr( 'aria-hidden', false )
				.children( 'strong.pen_jump_menu_title' ).prepend( '<span class="pen_only" title="' + pen_jump_menus_js.text.theme_specific + '">' + pen_jump_menus_js.text.pen_theme + '</span>&nbsp;' );
				var $toggle = $menu.find( '.pen_toggle' ),
					timer;
				if ( $menu.attr( 'id' ) === 'pen_jump_menu_color_schemes' || $menu.attr( 'id' ) === 'pen_jump_menu_font_presets' ) {
					$toggle.find( '.pen_caption' ).removeClass( 'pen_element_hidden' );
				}
				$menu.find( 'ul li a' ).each(
					function() {
						jQuery( this ).attr( 'title', pen_text_trim( jQuery( this ).text() ) ).attr( 'tabindex', '-1' );
					}
				);
				$toggle.on(
					'click',
					function() {
						var $wrapper = jQuery( '.pen_menu_wrapper', $menu );
						clearTimeout( timer );
						if ( $toggle.hasClass( 'pen_expanded' ) ) {
							$toggle.removeClass( 'pen_expanded' ).addClass( 'pen_collapsed' );
							$wrapper.addClass( 'pen_element_hidden' ).attr( 'aria-hidden', true )
							.find( 'ul li a' ).attr( 'tabindex', '-1' );
						} else {
							$toggle.addClass( 'pen_expanded' ).removeClass( 'pen_collapsed' );
							$wrapper.find( 'ul li a' ).removeAttr( 'tabindex' )
							.end().removeClass( 'pen_element_hidden' ).attr( 'aria-hidden', false )
							.on(
								'mouseleave',
								function() {
									clearTimeout( timer );
									timer = setTimeout(
										function() {
											$wrapper.stop( true, true ).animate(
												{ opacity: 0 },
												{
													duration: 2000,
													queue: false,
													complete: function() {
														 $toggle.trigger( 'click' );
													}
												}
											);
										},
										30000
									);
								}
							).on(
								'mouseenter',
								function() {
									$wrapper.stop( true, true ).animate( { opacity: 1 }, { duration: 200, queue: false } );
									clearTimeout( timer );
								}
							);
						}
					}
				);
			}

			$( '#page' ).find( '.pen_jump_menu' ).each(
				function() {
					pen_jump_menu( $( this ) );
				}
			);
		}
	)
})( jQuery );
