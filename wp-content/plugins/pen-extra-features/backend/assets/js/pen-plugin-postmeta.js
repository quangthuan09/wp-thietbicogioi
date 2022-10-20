;( function() {
	jQuery( document ).ready(
		function( $ ) {
			if ( $( '#pen_meta_tools' ).length ) {

				$( '#pen_postmeta' ).find( '.pen_postmeta_container' ).each( function() {
					var $this = $( this ),
					timer;
					$this.prepend( '<p><label>' + pen_plugin_backend_js.text.search + ' <input type="text" class="pen_postmeta_search" /></label></p>' );
					$this.find( '.pen_postmeta_search' ).on( 'keyup', function() {
						var $search = $( this ),
						keyword = hp_text_trim( $search.val() );
						clearTimeout( timer );
						if ( ! keyword ) {
							$this.find( '.pen_postmeta_wrapper' ).removeClass( 'screen-reader-text' );
						} else {
							timer = setTimeout( function() {
								keyword = keyword.toLowerCase();
								$this.find( '.pen_postmeta_wrapper' ).each( function() {
									if ( keyword ) {
										var $setting = $( this );
										$setting.addClass( 'screen-reader-text' ).add( $setting.find( 'label, option' ) ).each( function() {
											keyword = keyword.replace( /[-\/\\^$*+?.()|[\]{}]/g, '\\$&' );
											var $option = $( this ),
											haystack = hp_text_trim( $option.text().replace( /\s/g, ' ' ) ).toLowerCase(),
											match = new RegExp( '^(?=.*' + keyword + ').+', 'i' );
											if ( match.test( haystack ) ) {
												$setting.removeClass( 'screen-reader-text' );
												return false;
											}
										} );
									}
								} );
							}, 500 );
						}
					} );
				} );

				$( '#pen_meta_tools' ).find( '.pen_meta_tool' ).addClass( 'screen-reader-text' )
				.end().find( '.button.pen_meta_tool_open' ).on(
					'click',
					function( event ) {
						var $panel = $( '#' + $( this ).attr( 'id' ).replace( 'tool_', '' ) );
						if ( ! $panel.hasClass( 'pen_expanded' ) ) {
							$panel.hide().removeClass( 'screen-reader-text' ).fadeIn( 'fast' ).addClass( 'pen_expanded' );
						}
						event.preventDefault();
					}
				)
				.end().find( '.pen_meta_tool_close' ).on(
					'click',
					function( event ) {
						$( this ).parent().fadeOut( 'fast' ).addClass( 'screen-reader-text' ).show().removeClass( 'pen_expanded' );
						event.preventDefault();
					}
				);

				$( '#pen_posts' ).change(
					function() {
						var $list = $( this ),
						post_id   = parseInt( $list.val() ),
						nonce     = $( '#pen_nonce' ).val();

						if ( ! post_id ) {
							return;
						}

						$list.attr( 'disabled', true ).next( '.pen_options_overview' ).remove();

						$.ajax(
							{
								url: pen_plugin_backend_js.ajax_url,
								type: 'POST',
								data: 'action=pen_postmeta&pen_content_id=' + post_id + '&pen_nonce=' + nonce,
								success: function( response ) {
									var data = $.parseJSON( hp_text_trim( response ) );
									$( '#pen_content_customization' ).fadeOut().remove();
									$list.attr( 'disabled', false ).after( '<div id="pen_content_customization" style="display:none"></div>' ).next( '#pen_content_customization' ).prepend( $( data.results ) ).fadeIn();

									var $wrapper = $( '#pen_content_customization' );

									$wrapper.find( 'th:nth-child(2), td:not(:last-child)' ).on(
										'click',
										function() {
											$( this ).closest( 'tr' ).find( 'input[type="checkbox"]' ).trigger( 'click' );
										}
									);

									$wrapper.pen_meta_import_parent_disabled();
									pen_meta_import_select_single( $wrapper );
									pen_meta_import_select_all( $wrapper );
									pen_meta_import_select_parent( $wrapper );
									pen_meta_import_select_option( $wrapper );
									pen_meta_import_apply_all( $wrapper );
								}
							}
						);
					}
				);

				function pen_meta_import_select_single( $wrapper ) {
					$wrapper.find( '.button.pen_apply_this' ).each(
						function() {
								var $button = $( this ),
								$option     = $button.closest( 'tr' ).find( 'td input[type="checkbox"]' ),
								id          = $option.attr( 'id' ).replace( 'apply_', '' ),
								value_new   = $option.val();

							if ( $option.parent().hasClass( 'pen_apply_sidebar' ) ) {
								if ( $( '#' + id ).is( ':checked' ) ) {
									$option.prop( 'disabled', true ).removeAttr( 'checked' )
									.prop( 'checked', false );
									$button.addClass( 'disabled' );
								}
							} else {
								if ( $( '#' + id ).val() === value_new ) {
									$option.prop( 'disabled', true ).removeAttr( 'checked' )
									.prop( 'checked', false );
									$button.addClass( 'disabled' );
								}
							}
							$button.on(
								'click',
								function( event ) {
									if ( ! $button.hasClass( 'disabled' ) ) {
										if ( $option.parent().hasClass( 'pen_apply_sidebar' ) ) {
											$( '#' + id ).prop( 'checked', true ).trigger( 'change' );
										} else {
											$( '#' + id ).val( value_new ).trigger( 'change' );
										}
										$option.prop( 'disabled', true ).removeAttr( 'checked' )
										.prop( 'checked', false ).trigger( 'change' );
										$button.addClass( 'disabled' );
									}
									event.preventDefault();
								}
							);
						}
					);
				}

				function pen_meta_import_select_all( $wrapper ) {
					$( '#pen_select_all' ).on(
						'click',
						function( event ) {
							$wrapper.find( 'th input[type="checkbox"]:not(:disabled)' ).prop( 'checked', true ).trigger( 'change' );
							event.preventDefault();
						}
					);
				}

				function pen_meta_import_select_parent( $wrapper ) {
					$wrapper.find( 'th input[type="checkbox"]' ).on(
						'change',
						function() {
							var $this      = $( this ),
							id             = $this.attr( 'id' ),
							$apply_list    = $wrapper.find( 'td.pen_apply_list input:not(:disabled)' ),
							$apply_content = $wrapper.find( 'td.pen_apply_content input:not(:disabled)' );
							if ( $this.is( ':checked' ) ) {
								if ( id === 'pen_apply_list_all' ) {
									$apply_list.prop( 'checked', true ).trigger( 'change' );
								} else if ( id === 'pen_apply_content_all' ) {
									$apply_content.prop( 'checked', true ).trigger( 'change' );
								}
							} else {
								if ( id === 'pen_apply_list_all' ) {
									$apply_list.removeAttr( 'checked' ).prop( 'checked', false ).trigger( 'change' );
								} else if ( id === 'pen_apply_content_all' ) {
									$apply_content.removeAttr( 'checked' ).prop( 'checked', false ).trigger( 'change' );
								}
							}
						}
					);
				}

				$.fn.extend(
					{
						pen_meta_import_parent_disabled: function() {
							var $wrapper = $( this );
							if ( $wrapper.find( '.pen_apply_content input:disabled' ).length === $wrapper.find( '.pen_apply_content input' ).length ) {
								$( '#pen_apply_content_all' ).prop( 'disabled', true ).removeAttr( 'checked' ).prop( 'checked', false );
							} else if ( $( '#pen_apply_content_all' ).is( ':disabled' ) ) {
								$( '#pen_apply_content_all' ).prop( 'disabled', false ).removeAttr( 'checked' ).prop( 'checked', false );
							}

							if ( $wrapper.find( '.pen_apply_list input:disabled' ).length === $wrapper.find( '.pen_apply_list input' ).length ) {
								$( '#pen_apply_list_all' ).prop( 'disabled', true ).removeAttr( 'checked' ).prop( 'checked', false );
							} else if ( $( '#pen_apply_list_all' ).is( ':disabled' ) ) {
								$( '#pen_apply_list_all' ).prop( 'disabled', false ).removeAttr( 'checked' ).prop( 'checked', false );
							}
						}
					}
				);

				function pen_meta_import_select_option( $wrapper ) {
					$wrapper.find( 'td input[type="checkbox"]' ).on(
						'change',
						function() {
							var $this = $( this ),
							$row      = $this.closest( 'tr' );
							if ( $this.is( ':checked' ) ) {
								$row.addClass( 'pen_active' );
							} else {
								$row.removeClass( 'pen_active' );
							}

							$wrapper.pen_meta_import_parent_disabled();

							if ( $wrapper.find( 'td input[type="checkbox"]:checked' ).length ) {
								$( '#pen_apply_all' ).addClass( 'button-primary' );
							} else {
								$( '#pen_apply_all' ).removeClass( 'button-primary' );
							}
						}
					);
				}

				function pen_meta_import_apply_all( $wrapper ) {
					$( '#pen_apply_all' ).on(
						'click',
						function( event ) {
							var $options = $wrapper.find( 'td input[type="checkbox"]:checked' );
							if ( ! $options.length ) {
								alert( pen_plugin_backend_js.text.nothing_selected );
							} else {
								$options.each(
									function() {
										$( this ).removeAttr( 'checked' ).prop( 'checked', false ).trigger( 'change' )
										.closest( 'tr' ).find( '.button.pen_apply_this' ).trigger( 'click' );
									}
								);
							}
							event.preventDefault();
						}
					);
				}

				function hp_text_trim( input ) {
					if ( ! input ) {
						return input;
					}
					var output = jQuery.trim( input.replace( /\s/g, ' ' ) );
					return output;
				}
			}
		}
	);
} )( jQuery );
