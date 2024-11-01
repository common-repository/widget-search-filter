/**
 * Widget Search Filter JS
 *
 * @since 1.0.0
 *
 * @package Widget Search Filter
 */

(function($) {

	$(document).ready(function() {

		// Add separator to distinguish between visible and hidden widgets
		$('.widget:last-of-type').after('<div class="widget-separator" />');

		// Add data attribute for order to each widget
		$('#widgets-left .widget').each(function() {
			var index = $(this).index() + 1;
			$(this).attr('data-widget-index', index );
		});

		// Add liveFilter
		$('#widgets-left').liveFilter('#widgets-search', '.widget', {
			filterChildSelector: '.widget-title h4, .widget-title h3',
			after: function(contains, containsNot) {

				// Move all hidden widgets to end.
				containsNot.each(function() {
					$(this).insertAfter($(this).parent().find('.widget-separator'));
				});

				// Sort all visible widgets by original index
				contains.sort(function(a,b) {
					return a.getAttribute('data-widget-index') - b.getAttribute('data-widget-index');
				});

				// Move all visible back
				contains.each(function() {
					$(this).insertBefore($(this).parent().find('.widget-separator'));
				});

			}
		});

	});

})( jQuery );
