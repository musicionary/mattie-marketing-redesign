jQuery( document ).ready(function() {
	jQuery( '*' ).click(function(e) {
		e.preventDefault();
	});
	jQuery( 'form' ).submit(function( event ) {
	  	event.preventDefault();
	});
    jQuery('a').attr('href','javascript: void(0)');
});