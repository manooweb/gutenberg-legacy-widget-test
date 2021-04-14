jQuery(
	function( $ ) {
		console.log( 'gutenberg', 'Legacy Gutenberg Test Widget JS loaded.');

		function gutenberg_toggle( a, test ) {
			test ? a.show() : a.hide();
		}

		// Remove all options if dropdown is checked.
		$( '.edit-widgets-main-block-list' ).on(
			'change',
			'.gutenberg-dropdown',
			function() {
				var this_id = $( this ).parent().parent().parent().children( '.widget-id' ).attr( 'value' );
				console.log('gutenberg', this, this_id )
				gutenberg_toggle( $( '.no-dropdown-' + this_id ), ! $( this ).prop( 'checked' ) );
			}
		);

		// Disallow unchecking both show names and show flags.
		var options = ['-show_flags', '-show_names'];
		$.each(
			options,
			function( i, v ) {
				$( '.edit-widgets-main-block-list' ).on(
					'change',
					'.gutenberg' + v,
					function() {
						var this_id = $( this ).parent().parent().parent().children( '.widget-id' ).attr( 'value' );
						console.log('gutenberg', this, this_id )
						if ( true != $( this ).prop( 'checked' ) ) {
							$( '#widget-' + this_id + options[ 1 - i ] ).prop( 'checked', true );
						}
					}
				);
			}
		);
	}
)
