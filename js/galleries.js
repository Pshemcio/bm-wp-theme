/**
 * File galleries.js.
 *
 * Handles page galleries
 */
( function() {
	const homeSlider = document.querySelector( '#home-header-slider' );
	const singlePostSlider = document.querySelector( '#single-post-slider' );
	const homeGallerySlider = document.querySelector( '#home-gallery-slider' );

	if ( homeSlider ) {
		const homeAutoplay = homeSlider.dataset.headerAutoplay;

		new Glide( '#home-header-slider', {
			type: 'carousel',
			autoplay: homeAutoplay,
			gap: 0,
			dragThreshold: false,
			swipeThreshold: false,
			breakpoints: {
				480: {
					dragThreshold: 120,
					swipeThreshold: 120
				},
			},
		} ).mount();
	}

	if ( singlePostSlider ) {
		new Glide( '#single-post-slider', {
			type: 'carousel',
			gap: 10,
			dragThreshold: false,
			swipeThreshold: false,
			breakpoints: {
				480: {
					dragThreshold: 120,
					swipeThreshold: 120
				},
			},
		} ).mount();
	}

	if ( homeGallerySlider ) {
		new Glide( '#home-gallery-slider', {
			type: 'carousel',
			gap: 20,
			dragThreshold: false,
			swipeThreshold: false,
			perView: 4,
			breakpoints: {
				480: {
					perView: 1,
					dragThreshold: 120,
					swipeThreshold: 120
				},
				800: {
					perView: 2,
				},
				1200: {
					perView: 3,
				},
			},
		} ).mount();
	}
}() );
