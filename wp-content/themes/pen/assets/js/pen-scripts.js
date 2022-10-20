/**
 * Front-end JavaScript.
 *
 * @package Pen
 */

;( function( $ ) {

	'use strict';

	$( 'html' ).removeClass( 'no-js' ).addClass( 'js' );

	var $window = $( window ),
		$body = $( 'body' ),
		$page = $( '#page' ),
		$page_wrapper = $page.children( '.pen_wrapper' );

	if ( $body.hasClass( 'pen_loading_spinner' ) ) {
		$page_wrapper.addClass( 'pen_hidden' );
	}

	$( document ).ready( function() {

		if ( $body.hasClass( 'pen_width_narrow' ) || ( pen_function_exists( typeof Modernizr ) && Modernizr.mq( 'only all and (max-width:728px)' ) ) ) {
			if ( pen_js.font_resize.site_title === 'dynamic' && pen_function_exists( typeof $window.fitText ) ) {
				$( '#site-title' ).fitText( 1, { minFontSize: 20, maxFontSize: 48 } );
				$window.on( 'resize orientationchange', function() {
					$window.trigger( 'resize.fittext' );
				});
			}
			if ( pen_js.font_resize.site_title === 'resize' ) {
				var $site_title = $( '#pen_header #pen_site_title a .site-title' );
				$site_title.pen_font_resize( parseInt( $site_title.css( 'font-size' ) ) );
				$window.on( 'resize orientationchange', function() {
					if ( pen_function_exists( typeof Modernizr ) && Modernizr.mq( 'only all and (max-width:728px)' ) ) {
						$site_title.pen_font_resize( parseInt( $site_title.css( 'font-size' ) ) );
					} else {
						$site_title.css( { fontSize: '' } );
					}
				});
			}
		}

		if ( pen_function_exists( typeof autosize ) ) {
			autosize( $page.find( 'textarea' ) );
		}

		$page.find( '.search-form' ).on( 'submit', function( event ) {
			if ( pen_text_trim( $( this ).find( '.search-field' ).val() ) === '' ) {
				alert( pen_js.text.enter_keyword );
				event.preventDefault();
			}
		});

		$( '#pen_back' ).hide().on( 'click', function ( event ) {
			$( 'html, body' ).animate( { scrollTop: 0 }, { queue: false, duration: 1000 } );
			event.preventDefault();
		});

		$( '#content' ).find( 'iframe' ).each( function() {
			$( this ).on( 'load', function() {
				pen_content_height();
			} );
		} );

	});

	$window.on( 'load', function() {
		var $main = $( '#main' );

		if ( $body.hasClass( 'pen_loading_spinner' ) ) {
			$page.children( '.pen_loading' ).fadeOut(
				100,
				function() {
					$page_wrapper.removeClass( 'pen_hidden' )
					.css( { display: 'none', visibility: 'visible' } ).fadeIn( 100 );
				}
			);
		}

		if ( pen_js.animation_comments ) {
			var $comments = $( '#comments .comment-list' );
			if ( $comments.length ) {
				$comments.children( 'li' )
				.addClass( 'pen_animate_on_scroll pen_custom_animation_' + pen_js.animation_comments );
				if ( pen_js.animation_delay_comments ) {
					$comments.children( 'li' ).attr( 'delay', pen_js.animation_delay_comments );
				}
			}
		}

		pen_animation( $page.find( '.pen_animate_on_scroll' ), 'automatic' );

		pen_footer_position();

		pen_content_height();

	})
	.on( 'resize orientationchange', function() {

		pen_footer_position();

		pen_content_height();

	})
	.on( 'scroll', function() {
			if ( $( this ).scrollTop() > 400 ) {
				$( '#pen_back' ).fadeIn( 200 );
			} else {
				$( '#pen_back' ).fadeOut( 200 );
			}
		}
	);

	$.fn.extend(
		{
			pen_font_resize: function( font_size ) {
				var $element = this,
					parent_width = $element.parent().outerWidth( false ),
					element_width = $element.css( { position: 'fixed', whiteSspace: 'nowrap' } ).outerWidth( true );
					$element.css( { position: 'relative' } );
					font_size = font_size - 2;
				if ( font_size > 12 && element_width > parent_width ) {
					$element.animate( { fontSize: font_size } )
					.end().pen_font_resize( font_size );
				}
			}
		}
	);

})( jQuery );

function pen_animation( $items, animation ) {
	var animation_offset = '90%';

	$items = $items.filter( '.pen_animate_on_scroll' );

	if ( pen_function_exists( typeof jQuery( window ).waypoint ) && animation ) {
		$items.not( '.animate__animated' ).addClass( 'animate__animated' ).css( 'visibility', 'hidden' );

		for ( var i = 0; i < $items.length; i++ ) {
			var $item = $items.eq(i);
			if ( $item.closest( '#pen_footer, #pen_bottom' ).length ) {
				animation_offset = '99%';
			}
			$item.waypoint(
				{
					handler: function( direction ) {
						var timer,
							$item = jQuery( this.element ),
							add_animation = '';

						var animation_delay = 0,
							custom_animation_delay = this.element.className.match( /(^|\s)pen_custom_animation_delay_\S+/g );
						if ( custom_animation_delay && custom_animation_delay[0] ) {
							animation_delay = ( 1000 * parseInt( pen_text_trim( custom_animation_delay[0].replace( 'pen_custom_animation_delay_', '' ) ) ) );
						}

						var custom_animation = this.element.className.match( /(^|\s)pen_custom_animation_\S+/g );
						if ( custom_animation && custom_animation[0] ) {
							add_animation = pen_text_trim( custom_animation[0].replace( 'pen_custom_animation_', 'animate__' ) );
						} else {
							add_animation = 'animate__' + animation;
						}

						timer = setTimeout( function() {
							if ( ! $item.hasClass( add_animation ) ) {
								$item.addClass( add_animation ).css( 'visibility', 'visible' );
							}
						}, animation_delay ? animation_delay : 1 );

					},
					offset: animation_offset
				}
			);
		}
	}
}

function pen_footer_position() {
	var $body = jQuery( 'body' ),
		$content = jQuery( '#content' ),
		$bottom = jQuery( '#pen_bottom' ),
		$footer = jQuery( '#pen_footer' ),
		width_content = '100%',
		offset_left = 0,
		height_bottom = $bottom.length ? $bottom.outerHeight( true ) : 0,
		height_footer = pen_js.site_footer_display ? $footer.outerHeight( true ) : 0;

	if ( $body.hasClass( 'pen_width_narrow' ) || $body.hasClass( 'pen_width_boxed' ) ) {
		width_content = $content.outerWidth( true );
		offset_left = $content.offset().left;
	}

	$content.css( { paddingBottom: '' } );
	var content_padding_bottom = parseInt( $content.css( 'padding-bottom' ) ) + ( height_bottom + height_footer );
	$content.css( { paddingBottom: content_padding_bottom } );

	if ( $bottom.length ) {
		$bottom.css( {
			bottom: pen_js.site_footer_display ? height_footer : 0,
			position: 'absolute',
			width: width_content
		} );
	}
	$footer.css( { bottom: 0, left: offset_left, position: 'absolute', width: width_content } );
}

function pen_content_height() {
	var left_height = 0,
		right_height = 0,
		$content = jQuery( '#content' ),
		$left = jQuery( '#pen_left' ),
		$right = jQuery( '#pen_right' );
	if ( pen_function_exists( typeof Modernizr ) && Modernizr.mq( 'only all and (max-width:728px)' ) ) {
		$content.css( { minHeight: '' } );
		return;
	}
	if ( $left.length ) {
		left_height = $left.outerHeight( true );
	}
	if ( $right.length ) {
		right_height = $right.outerHeight( true );
	}
	var content_height = Math.max( left_height, right_height );
	if ( content_height ) {
		content_height = content_height + parseInt( $content.css( 'padding-bottom' ) ) + 30;
		$content.css( 'min-height', content_height );
	}
}

function pen_function_exists( type_of ) {
	if ( type_of !== 'undefined' && type_of !== undefined && type_of !== null ) {
		return true;
	}
	return false;
}

function pen_text_trim( input ) {
	if ( ! input ) {
		return input;
	}
	var output = input.replace( /\s/g, ' ' ).replace( /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '' );
	return output;
}
