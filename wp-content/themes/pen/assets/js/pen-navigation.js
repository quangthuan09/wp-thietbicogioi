/**
 * Navigation menu.
 *
 * @package Pen
 */

;( function( $ ) {

	'use strict';

	var $window = $( window ),
		$body = $( 'body' ),
		$page = $( '#page' ),
		$wpadminbar = $( '#wpadminbar' ),
		$header = $( '#pen_header' ),
		$page_wrapper = $page.children( '.pen_wrapper' ),
		$menu_primary = $( 'ul#primary-menu' ).length ? $( 'ul#primary-menu' ) : false;

	$( document ).ready( function() {

		if ( /iP(hone|od|ad)/.test( navigator.platform ) ) {
			var iOS_version_match = ( navigator.appVersion ).match( /OS (\d+)_(\d+)_?(\d+)?/ );
			if ( iOS_version_match ) {
				var iOS_compatibility = ( parseInt( iOS_version_match[1], 10 ) > 13 ) ? true : false;
			} else {
				var iOS_compatibility = false;
			}
		} else {
			var iOS_compatibility = true;
		}

		if ( $menu_primary ) {
			if ( pen_navigation_js.pointer_event !== 'click' && pen_function_exists( typeof $window.superfish ) ) {
				$menu_primary.superfish(
					{
						animation: pen_navigation_js.easing,
						speed: parseInt( pen_navigation_js.animation_navigation_speed ),
						cssArrows: pen_navigation_js.arrows
					}
				);
			} else if ( pen_function_exists( typeof $window.superclick ) ) {
				$menu_primary.superclick(
					{
						animation: pen_navigation_js.easing,
						speed: parseInt( pen_navigation_js.animation_navigation_speed ),
						cssArrows: pen_navigation_js.arrows
					}
				);
			}
			if ( pen_navigation_js.mobile !== 'never' ) {
				pen_navigation_mobile( $menu_primary, iOS_compatibility );
			}
		}

		$window.on( 'resize orientationchange', function() {
			if ( $menu_primary && pen_navigation_js.mobile !== 'never' ) {
				pen_navigation_mobile( $menu_primary, iOS_compatibility );
			}
		});
	});

	function pen_navigation_mobile( $menu, iOS_compatibility ) {

		var visible = false,
			$menu_mobile = $menu.clone(), /* $menu is a <ul> */
			$navigation = $menu.closest( 'nav' ),
			$navigation_mobile = $( '#pen_navigation_mobile' ),
			$wpadminbar = $( '#wpadminbar' );

		if ( pen_navigation_js.mobile === 'always' ) {
			visible = true;
		} else if ( pen_function_exists( typeof Modernizr ) ) {
			if ( pen_navigation_js.mobile === 'mobile' ) {
				visible = Modernizr.mq( 'only all and (max-width:728px)' ) ? true : false;
			} else if ( pen_navigation_js.mobile === 'mobile_tablet' ) {
				visible = Modernizr.mq( 'only all and (max-width:1024px)' ) ? true : false;
			}
		}

		if ( ! visible ) {
			if ( $navigation_mobile.length ) {
				if ( $navigation_mobile.find( '#pen_mobile_menu_top' ).length ) {
					$menu.closest( 'nav' ).before( $( '#pen_mobile_menu_top' ) );
				}
				if ( $navigation_mobile.find( '#pen_mobile_menu_bottom' ).length ) {
					$menu.closest( 'nav' ).after( $( '#pen_mobile_menu_bottom' ) );
				}
				if ( $navigation_mobile.find( '#pen_jump_menu_navigation' ).length ) {
					$menu.closest( 'nav' ).append( $( '#pen_jump_menu_navigation' ) );
					$( '#pen_jump_menu_navigation' ).removeClass( 'pen_element_hidden' )
					.attr( 'aria-hidden', 'false' );
				}

				var height_mobile_button = $( '#pen_navigation_mobile_toggle' ).outerHeight( true );

				$navigation_mobile.remove();
				$body.removeClass( 'pen_navigation_mobile_show' ).addClass( 'pen_navigation_mobile_hide' );

				if ( pen_navigation_js.mobile_sticky ) {
					var padding_top_page = parseInt( $page_wrapper.css( 'padding-top' ) );
					if ( padding_top_page > height_mobile_button ) {
						$page_wrapper.css( { paddingTop: ( padding_top_page - height_mobile_button ) } );
					} else if ( ! $body.hasClass( 'pen_header_sticky' ) ) {
						$page_wrapper.css( { paddingTop: '' } );
					}
					$window.trigger( 'pen_update_sticky_navigation_mobile' );
				}
				$window.trigger( 'pen_update_navigation_mobile' );

				$navigation.show();
				$body.addClass( 'pen_navigation_show' ).removeClass( 'pen_navigation_hide' );
				$window.trigger( 'pen_update_navigation' );
				if ( iOS_compatibility ) {
					$page_wrapper.stop( true, true ).fadeIn( 200 );
				}
			}

			return;
		}

		$menu_mobile.attr( 'id', 'primary-menu-mobile' )
		.removeClass( function ( index, css ) {
			return ( css.match( /(^|\s)sf-\S+/g ) || [] ).join( ' ' );
		} )
		.find( '*' ).each( function() {
			$( this ).removeClass( function ( index, css ) {
				return ( css.match( /(^|\s)sf-\S+/g ) || [] ).join( ' ' );
			} );
		} )
		.end()
		.addClass( 'pen_element_hidden pen_collapsed' ).attr( 'aria-hidden', 'true' )
		.find( 'li ul' )
		.addClass( 'pen_element_hidden pen_collapsed' ).attr( 'aria-hidden', 'true' );

		if ( ! $( '#pen_navigation_mobile' ).length ) {
			$page.prepend( '<div id="pen_navigation_mobile" />' )
			.children( '#pen_navigation_mobile' )
			.addClass( 'pen_collapsed' )
			.prepend( '<div id="pen_navigation_mobile_wrapper" />' )
			.children( '#pen_navigation_mobile_wrapper' )
			.prepend( '<nav role="navigation" />' )
			.children( 'nav' )
			.attr( 'class', $navigation.attr( 'class' ) )
			.removeClass( 'pen_element_hidden' )
			.attr( 'aria-label', $navigation.attr( 'aria-label' ) )
			.prepend( $menu_mobile );

			$body.removeClass( 'pen_navigation_mobile_hide' ).addClass( 'pen_navigation_mobile_show' );

			var $navigation_mobile = $( '#pen_navigation_mobile' );

			$navigation_mobile.prepend( '<a id="pen_navigation_mobile_toggle" href="' + pen_navigation_js.url_home + '"><span class="pen_text" title="' + pen_navigation_js.text.menu + '">' + pen_navigation_js.text.menu + '</span><span class="pen_icon"><span></span><span></span><span></span><span></span></span></a>' );

			$window.trigger( 'pen_update_navigation_mobile' );

			if ( $( '#pen_mobile_menu_top' ).length ) {
				var $mobile_menu_top = $( '#pen_mobile_menu_top' );
				$mobile_menu_top.addClass( 'pen_element_hidden' ).attr( 'aria-hidden', 'true' );
				$navigation_mobile.find( 'nav' ).before( $mobile_menu_top );
			}
			if ( $( '#pen_mobile_menu_bottom' ).length ) {
				var $mobile_menu_bottom = $( '#pen_mobile_menu_bottom' );
				$mobile_menu_bottom.addClass( 'pen_element_hidden' ).attr( 'aria-hidden', 'true' );
				$navigation_mobile.find( 'nav' ).after( $mobile_menu_bottom );
			}
			if ( $( '#pen_jump_menu_navigation' ).length ) {
				$navigation_mobile.find( 'nav' ).append( $( '#pen_jump_menu_navigation' ) );
				$( '#pen_jump_menu_navigation' ).addClass( 'pen_element_hidden' )
				.attr( 'aria-hidden', 'true' );
			}
		} else {
			var $navigation_mobile = $( '#pen_navigation_mobile' );
		}

		/* The mobile menu is there, so no need to instead apply the pen_element_hidden class. */
		$navigation.hide();
		$body.removeClass( 'pen_navigation_show' ).addClass( 'pen_navigation_hide' );
		$window.trigger( 'pen_update_navigation' );

		var $navigation_mobile_toggle = $( '#pen_navigation_mobile_toggle' );

		if ( ! pen_navigation_js.text.menu ) {
			$navigation_mobile_toggle.find( '.pen_text' ).addClass( 'pen_element_hidden' );
		}

		$navigation_mobile_toggle.on( 'click', function( event ) {
			if ( $menu_mobile.hasClass( 'pen_collapsed' ) ) {
				$( this ).addClass( 'pen_active' );
				$menu_mobile.hide()
				.removeClass( 'pen_collapsed pen_element_hidden' )
				.addClass( 'pen_expanded' )
				.stop( true, true )
				.animate( pen_navigation_js.easing, pen_navigation_js.speed )
				.attr( 'aria-hidden', 'false' );
				if ( $mobile_menu_top ) {
					$mobile_menu_top.hide().removeClass( 'pen_element_hidden' )
					.fadeIn( 200 ).attr( 'aria-hidden', 'false' );
				}
				if ( $mobile_menu_bottom ) {
					$mobile_menu_bottom.hide().removeClass( 'pen_element_hidden' )
					.fadeIn( 200 ).attr( 'aria-hidden', 'false' );
				}
				if ( $wpadminbar.length && ! pen_navigation_js.mobile_sticky ) {
					$navigation_mobile.css( { paddingTop: $wpadminbar.outerHeight( true ) } );
				}
				$navigation_mobile.addClass( 'pen_expanded' ).removeClass( 'pen_collapsed' );
				if ( $( '#pen_jump_menu_navigation' ).length ) {
					$( '#pen_jump_menu_navigation' ).removeClass( 'pen_element_hidden' )
					.attr( 'aria-hidden', 'false' );
				}
				if ( iOS_compatibility ) {
					$page_wrapper.stop( true, true ).fadeOut( 200 );
				}
			} else {
				$( this ).removeClass( 'pen_active' );
				$menu_mobile
				.stop( true, true )
				.animate( { height: 'hide' }, pen_navigation_js.animation_navigation_speed, function() {
					$( this )
					.removeClass( 'pen_expanded' )
					.addClass( 'pen_collapsed pen_element_hidden' ).show()
					.attr( 'aria-hidden', 'true' );
				} );
				if ( $mobile_menu_top ) {
					$mobile_menu_top.addClass( 'pen_element_hidden' ).attr( 'aria-hidden', 'true' );
				}
				if ( $mobile_menu_bottom ) {
					$mobile_menu_bottom.addClass( 'pen_element_hidden' ).attr( 'aria-hidden', 'true' );
				}
				$navigation_mobile.removeClass( 'pen_expanded' ).addClass( 'pen_collapsed' );
				if ( $wpadminbar.length && ! pen_navigation_js.mobile_sticky ) {
					$navigation_mobile.css( { paddingTop: '' } );
				}
				if ( $( '#pen_jump_menu_navigation' ).length ) {
					$( '#pen_jump_menu_navigation' ).addClass( 'pen_element_hidden' )
					.attr( 'aria-hidden', 'true' );
				}
				if ( iOS_compatibility ) {
					$page_wrapper.stop( true, true ).fadeIn( 200 );
				}

				if ( $( '#pen_masonry' ).length ) {
					$( '#pen_masonry' ).pen_layout_masonry();
				}
				if ( $( '#pen_tiles' ).length ) {
					$( '#pen_tiles' ).pen_layout_tiles();
				}
			}
			event.preventDefault();
		} );

		$menu_mobile.find( 'a' ).each( function() {
			var $link = $( this ),
				$parent = $link.closest( 'li' ),
				$child = $parent.children( 'ul' );
			if ( $child.length ) {
				if ( pen_navigation_js.mobile_parents_include && $parent.children( 'a' ).attr( 'href' ) !== '#' ) {
					$child.prepend( $( '<li class="pen_duplicate" />' ).prepend( $parent.children( 'a' ).clone() ) );
				}
				$parent.addClass( 'pen_parent pen_collapsed' );
				$link.on( 'click', function( event ) {
					if ( $parent.hasClass( 'pen_collapsed' ) ) {
						$parent.addClass( 'pen_expanded' ).removeClass( 'pen_collapsed' );
						$child.hide()
						.removeClass( 'pen_collapsed pen_element_hidden' )
						.addClass( 'pen_expanded' )
						.stop( true, true )
						.animate( pen_navigation_js.easing, pen_navigation_js.animation_navigation_speed )
						.attr( 'aria-hidden', 'false' );
					} else {
						$parent.addClass( 'pen_collapsed' ).removeClass( 'pen_expanded' );
						$child.hide()
						.removeClass( 'pen_expanded pen_element_hidden' )
						.addClass( 'pen_collapsed' )
						.stop( true, true )
						.animate( { height: 'hide' }, pen_navigation_js.animation_navigation_speed )
						.attr( 'aria-hidden', 'false' );
					}
					event.preventDefault();
				} );
			}
		} );

		if ( $navigation_mobile && pen_navigation_js.is_customize_preview ) {
			$navigation_mobile.find( 'li.pen_parent > a' ).attr( 'href', '#' );
		}
	}

})( jQuery );
