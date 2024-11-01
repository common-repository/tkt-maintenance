(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	$( window ).on('load', function() {

		if( typeof( time ) !== 'undefined' ){

			// Set the date we're counting down to
		  	var countDownDate = new Date(time).getTime();

		  	// Update the count down every 1 second
		  	var countdownfunction = setInterval(function() {

			    // Get todays date and time
			    var now = new Date().getTime();
			    
			    // Find the distance between now an the count down date
			    var distance = countDownDate - now;
			    
			    // Time calculations for days, hours, minutes and seconds
			    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
			    
			    // Output the result in an element with id="timer"
			    document.getElementById("tkt-maintenance-timer").innerHTML = days + "d " + hours + "h "
			    + minutes + "m " + seconds + "s ";
			    
			    // If the count down is over, write some text 
			    if (distance < 0) {
			      clearInterval(countdownfunction);
			      document.getElementById("tkt-maintenance-timer").innerHTML = "EXPIRED";
			    }
			    
		  	}, 1000);

		}
		
	});
	
})( jQuery );
