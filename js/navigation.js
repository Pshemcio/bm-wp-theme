/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
(function () {
	const siteNavigation = document.getElementById('site-navigation');
	const languageSwitchers = document.querySelectorAll(' .language-switcher ');
	languageSwitchers.forEach((switcher) => {
		const languageSwitcher = switcher.querySelector('.language-switcher-list');
		const languageToggle = switcher.querySelector('.single-language.current');

		languageToggle.addEventListener('click', () => {
			if (languageSwitcher.childNodes.length) {
				languageSwitcher.classList.toggle('is-shown');
			}
		});
	});

	// Return early if the navigation doesn't exist.
	if (!siteNavigation) {
		return;
	}

	const button = document.getElementById('burger');

	// Return early if the button doesn't exist.
	if ('undefined' === typeof button) {
		return;
	}

	const menu = document.getElementById('main-menu');

	// Hide menu toggle button if menu is empty and return early.
	if ('undefined' === typeof menu) {
		button.style.display = 'none';
		return;
	}

	if (!menu.classList.contains('nav-menu')) {
		menu.classList.add('nav-menu');
	}

	// Toggle the .toggled class and the aria-expanded value each time the button is clicked.
	button.addEventListener('click', function () {
		siteNavigation.classList.toggle('toggled');
		languageSwitchers.forEach((switcher) => {
			const languageSwitcher = switcher.querySelector('.language-switcher-list');
			languageSwitcher.classList.remove('is-shown');
		});

		if (button.getAttribute('aria-expanded') === 'true') {
			button.setAttribute('aria-expanded', 'false');
		} else {
			button.setAttribute('aria-expanded', 'true');
		}
	});

	// Remove the .toggled class and set aria-expanded to false when the user clicks outside the navigation.
	document.addEventListener('click', function (event) {
		const isClickInside = siteNavigation.contains(event.target);

		if (!isClickInside) {
			siteNavigation.classList.remove('toggled');
			button.setAttribute('aria-expanded', 'false');
		}
	});

	// Get all the link elements within the menu.
	const links = menu.querySelectorAll('a');

	// Get all the link elements with children within the menu.
	const linksWithChildren = menu.querySelectorAll('.menu-item-has-children > a, .page_item_has_children > a');

	// Toggle focus each time a menu link is focused or blurred.
	for (const link of links) {
		link.addEventListener('click', (e) => {
			if (e.target?.href.includes('#')) {
				siteNavigation.classList.toggle('toggled');
				linksWithChildren.forEach((link) => link.closest('li').classList.remove('focus'));
			}
		});
	}

	/**
	 * Sets or removes .focus class on an element.
	 */
	const toggleFocus = (e) => {
		if (window.innerWidth < 840) {
			e.preventDefault();
			e.target.closest('li').classList.toggle('focus');
		}
	};

	// Toggle focus each time a menu link with children receive a touch event.
	for (const link of linksWithChildren) {
		link.addEventListener('touchstart', toggleFocus);
	}

	const accordions = document.querySelectorAll('[data-accordion]');

	accordions.forEach((accordion) => {
		accordion.querySelector('[data-accordion-trigger]').addEventListener('click', () => {
			accordion.classList.toggle('accordion-opened');
		});
	});
})();
