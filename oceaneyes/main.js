/**
 * main.js
 */
$(function() {
	$(window).scroll(function() {
		if (!$("#tool-bar").isInViewport()) {
			$("#tool-bar-inner").addClass('active');
		} else {
			$("#tool-bar-inner").removeClass('active');
		}
	});
});
