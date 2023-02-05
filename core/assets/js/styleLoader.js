loadCSS( "https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" );

var stylesheet = loadCSS( "/wp-content/themes/equd/assets/css/loader.css" );
onloadCSS(
	stylesheet,
	function () {
		console.log( "Welcome to EQUD! Stylesheet 'loader' has loaded." );
	}
);

var stylesheet = loadCSS( "/wp-content/themes/equd/assets/css/general.css" );
onloadCSS(
	stylesheet,
	function () {
		console.log( "Stylesheet 'general' has loaded." );
	}
);

var stylesheet = loadCSS( "/wp-content/themes/equd/assets/css/mobile.css" , null , media = "only screen  and (max-width: 480px)" );
onloadCSS(
	stylesheet,
	function () {
		console.log( "Stylesheet 'mobile' has loaded." );
	}
);

var stylesheet = loadCSS( "/wp-content/themes/equd/assets/css/tablet.css" , null , media = "only screen  and (min-width: 480px) and (max-width: 1280px)" );
onloadCSS(
	stylesheet,
	function () {
		console.log( "Stylesheet 'tablet' has loaded." );
	}
);
