/**
 * Infinite scrolling.
 *
 * @package Pen
 */

;( function( $ ) {

	'use strict';

	var $window = $( window ),
		$body = $( 'body' ),
		$page = $( '#page' ),
		$pager = $( '#pen_pager' ),
		page_next = parseInt( pen_infinite_scrolling_js.page_current ),
		url_page_next = pen_infinite_scrolling_js.url_page_next,
		page_title = $( 'title' ).text(),
		$articles = $page.find( '.pen_articles article' );

	$( document ).ready( function() {

		/* Page has scrollbars. */
		if ( window.innerWidth > document.documentElement.clientWidth ) {
			$pager.addClass( 'pen_element_hidden' );
		}

		$articles.each( function() {
			$( this )
			.data( 'page-url', window.location.href )
			.data( 'page-title', page_title );
		} );

		if ( pen_function_exists( typeof $( window ).waypoint ) ) {
			$articles.waypoint( {
				handler: function( direction ) {
					var $item = $( this.element );
					$( 'title' ).html( $item.data( 'page-title' ) );
					if ( history.pushState ) {
						window.history.replaceState( window.location.href, $( 'title' ).text(), $item.data( 'page-url' ) );
					}
				},
				offset: '90%'
			} );
		}
	});

	$window.on( 'scroll', function() {
		if ( pen_infinite_scrolling_js.is_customize_preview ) {
			return false;
		}
		var pages_total = parseInt( pen_infinite_scrolling_js.pages_total );
		if ( $window.scrollTop() === $( document ).height() - $window.height() ) {
			if ( pages_total < 2 || page_next > pages_total ) {
				return false;
			} else {
				var $loading_overlay = $page.children( '.pen_loading' );
				if ( $page.hasClass( 'pen_wait' ) || ! url_page_next || $body.hasClass( 'pen_infinite_scrolling_stop' ) ) {
					return false;
				}
				if ( pen_infinite_scrolling_js.allow_stop ) {
					$loading_overlay
					.append( '<a href="#" class="pen_button pen_stop">' + pen_infinite_scrolling_js.text.stop + '</a>' )
					.children( '.pen_stop' ).on( 'click', function( event ) {
						$body.addClass( 'pen_infinite_scrolling_stop' );
						$pager.removeClass( 'pen_element_hidden' );
						$loading_overlay.fadeOut( 100, function() { $page.removeClass( 'pen_wait' ); } );
						event.preventDefault();
					} );
				}
				$loading_overlay.fadeIn( 100, function() { $page.addClass( 'pen_wait' ); } );
				$.post( {
					url: url_page_next,
					success: function ( html ) {
						if ( html && ! $body.hasClass( 'pen_infinite_scrolling_stop' ) ) {
							$loading_overlay.fadeOut( 100, function() { $page.removeClass( 'pen_wait' ); } );
							var $last_article = $page.find( '.pen_article' ).last(),
								$html = $( '<div />' ).prepend( html ),
								page_title = $html.find( 'title' ).text(),
								$articles  = $html.find( '.pen_articles article' ),
								$link_previous = $html.find( '#pen_pager .nav-previous > a' ),
								url_page_current = url_page_next.replace( /[\?&]pen_sticky_exclude=[^&]+/, '').replace( /^&/, '?' );

							if ( $link_previous.length ) {
								if ( history.pushState ) {
									window.history.pushState( {}, page_title, url_page_current );
								}
								url_page_next = $link_previous.attr( 'href' );
							} else {
								url_page_next = false;
							}

							if ( $articles.length ) {
								$last_article.after( $articles );

								$articles.each( function() {
									$( this )
									.data( 'page-url', url_page_current )
									.data( 'page-title', page_title );
								} );

								if ( pen_function_exists( typeof $( window ).waypoint ) ) {
									$articles.waypoint( {
										handler: function( direction ) {
											var $item = $( this.element );
											$( 'title' ).html( $item.data( 'page-title' ) );
											if ( history.pushState ) {
												window.history.replaceState( window.location.href, $( 'title' ).text(), url_page_current );
											}
										},
										offset: '90%'
									} );
								}

								var $header = $( '#pen_header' ),
									offset_top = $last_article.offset().top;
								if ( pen_function_exists( typeof Modernizr ) && Modernizr.mq( 'only all and (max-width:728px)' ) ) {
									offset_top += $last_article.outerHeight( true );
								} else {
									offset_top -= 40;
								}
								if ( $( '#wpadminbar' ).length ) {
									offset_top -= $( '#wpadminbar' ).outerHeight( true );
								}
								if ( $header.hasClass( 'pen_header_sticked' ) ) {
									offset_top -= $header.outerHeight( true );
								}
                $window.trigger( 'resize' );
								$( 'html, body' ).animate( { scrollTop: offset_top }, { queue: false, duration: 1000 } );

								if ( $( '#pen_masonry.pen_masonry_applied' ).length ) {
									$( '#pen_masonry' ).masonry( 'destroy' ).pen_layout_masonry();
									/* pen_content_height() does nothing on mobile. */
									pen_content_height();
								}
								if ( $( '#pen_tiles' ).length ) {
									$( '#pen_tiles' ).pen_layout_tiles();
								}
								if ( $( '#pen_plain' ).length ) {
									$( '#pen_plain' ).pen_layout_plain();
								}
							} else {
								alert( pen_infinite_scrolling_js.text.no_more_content );
							}
						}
					}
				} );
			}
			page_next++;
		}
	}).on( 'resize orientationchange', function() {
		if ( this.innerWidth > document.documentElement.clientWidth ) {
			$pager.addClass( 'pen_element_hidden' );
		} else {
			$pager.removeClass( 'pen_element_hidden' );
		}
	} );

})( jQuery );
