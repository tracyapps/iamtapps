/**
 * global JS file
 */

( function() {
	//SVG background
	var page = document.getElementById('page');
	var svg = document.getElementById('bgtexture');

	// Convert the SVG node to HTML.
	var div = document.createElement('div');
	div.appendChild(svg.cloneNode(true));

	// Encode the SVG as base64
	var b64 = 'data:image/svg+xml;base64,'+window.btoa(div.innerHTML);
	var url = 'url("' + b64 + '")';
	page.style.backgroundImage = url;
	//end SVG background

	//skrollr
	skrollr.init({
		forceHeight: false
	});

})();


// blast.js
( function( $ ) {

	$( ".animatein" )
	// Blast the text apart by word.
	.blast({ delimiter: "word" })
	// Fade the words into view using Velocity.js.
	.velocity("fadeIn", {
		display: null,
		duration: 2050,
		stagger: 90,
		delay: 150
	});

	$(function() {
		var bar = $('#stickyHeader');
		var top = bar.css('top');
		$(window).scroll(function() {
			if($(this).scrollTop() > 95) {
				bar.stop().animate({'top' : '0px'}, 400);
			} else {
				bar.stop().animate({'top' : top}, 400);
			}
		});
	});

})( jQuery );