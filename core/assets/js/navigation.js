/*! navigation.js */
let menuButton    = document.querySelector( '.menu-button' );
let sectionToogle = document.querySelector( 'section.toogle-menu' );

if (menuButton) {
	menuButton.addEventListener(
		'click',
		function (e) {
			if (menuButton.classList.contains( 'cross' )) {
				menuButton.classList.remove( 'cross' );
				sectionToogle.classList.remove( '_active' );
			} else {
				menuButton.classList.add( 'cross' );
				sectionToogle.classList.add( '_active' );
			}
		}
	);
}

let linksChild = document.querySelector( 'a.link-has-children' );
if (linksChild) {
	function stopDefAction(evt)
	{
		evt.preventDefault();
		if (linksChild.classList.contains( '_active' )) {
			linksChild.classList.remove( '_active' );
		} else {
			linksChild.classList.add( '_active' );
		}
	}
	linksChild.addEventListener(
		'click',
		stopDefAction,
		false
	);
}
if (linksChild.length > 1) {
	for (let index = 0; index < linksChild.length; index++) {
		const linkChild = linksChild[index];
		linkChild.addEventListener(
			'click',
			function (e) {
				evt.preventDefault();
				linkChild.parentElement.classList.toogle( '_active' );
			}
		);
	}
}

/*
let menuChilds    = document.querySelector('.menu-item-has-children');
if (menuChilds.length > 0) {
	for (let index = 0; index < menuChilds.length; index++) {
		const menuChild = menuChilds[index];
		menuChild.addEventListener(
			'click',
			function (e) {
				menuChild.parentElement.classList.toogle('_active');
			}
		);
	}
}
*/
