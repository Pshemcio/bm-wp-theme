/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function() {
	const homeSlider = document.querySelector( '#home-header-slider' );
	if ( homeSlider ) {
		const homeAutoplay = homeSlider.dataset.headerAutoplay;

		new Glide( '#home-header-slider', {
			type: 'carousel',
			autoplay: homeAutoplay,
			gap: 0,
		} ).mount();
	}
}() );
