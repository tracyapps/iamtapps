/**
 * global JS file
 */

( function() {

	var page = document.getElementById('page');
	var svg = document.getElementById('bgtexture');

// Convert the SVG node to HTML.
	var div = document.createElement('div');
	div.appendChild(svg.cloneNode(true));

// Encode the SVG as base64
	var b64 = 'data:image/svg+xml;base64,'+window.btoa(div.innerHTML);
	var url = 'url("' + b64 + '")';
	page.style.backgroundImage = url;

})();