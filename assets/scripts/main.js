/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function ($) {


	function findBootstrapEnvironment() {
		var envs = ['xs', 'sm', 'md', 'lg'];

		var $el = $('<div>');
		$el.appendTo($('body'));

		for (var i = envs.length - 1; i >= 0; i--) {
			var env = envs[i];

			$el.addClass('hidden-' + env);
			if ($el.is(':hidden')) {
				$el.remove();
				return env;
			}
		}
	}


	var mobile = false;

	function detectMobile() {
		switch (findBootstrapEnvironment()) {
			case 'xs':
			case 'sm':
				mobile = true;
				break;
			case 'md':
			case 'lg':
				mobile = false;
				break;
			default:
				mobile = false;
				break;
		}
	}

	/**
	 * detect IE
	 * returns version of IE or false, if browser is not Internet Explorer
	 */
	function detectIE() {
		var ua = window.navigator.userAgent;

		var msie = ua.indexOf('MSIE ');
		if (msie > 0) {
			// IE 10 or older => return version number
			return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
		}

		var trident = ua.indexOf('Trident/');
		if (trident > 0) {
			// IE 11 => return version number
			var rv = ua.indexOf('rv:');
			return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
		}

		var edge = ua.indexOf('Edge/');
		if (edge > 0) {
			// Edge (IE 12+) => return version number
			return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
		}

		// other browser
		return false;
	}

	function is_touch_device() {
		return 'ontouchstart' in window || navigator.maxTouchPoints;
	}

	function stickyHeader() {
		var $nav_container = $('header.banner'),
			$wrap = $('div.wrap'),
			$wpadminbar = $('#wpadminbar');

		if ($wpadminbar.is(':visible') && !mobile) {
			$nav_container.css('top', $wpadminbar.height());
		} else {
			$nav_container.css('top', '0px');
		}

		var startpoint = parseInt($('.upper-header').height() + 1);
		var lastScrollTop = 0;

		setInterval(function () {
			var scrolltop = $(window).scrollTop();
			if (scrolltop >= startpoint) {
				// going down...
				if (!$nav_container.hasClass('sticky')) {
					$nav_container.addClass('sticky');
					$nav_container.removeClass('non-sticky');
				}
			} else {
				// going up
				if ($nav_container.hasClass('sticky')) {
					$nav_container.removeClass('sticky');
					$nav_container.addClass('non-sticky');
				}
			}
		}, 100);
	}

	var initMasonry = function ($container) {

		var columnWidth = 436;
		var gutterWidth = 30;
		var transition = '0.4s';
		if (findBootstrapEnvironment() === 'xs' || findBootstrapEnvironment() === 'sm') {
			columnWidth = 290;
			gutterWidth = 15;
			transition = 0;
		}

        $container.imagesLoaded(function () {
            $container.isotope({
                itemSelector: '.some-row .element',
                masonry: {
                    gutter: gutterWidth,
                    columnWidth: columnWidth,
                    isFitWidth: true,
                    transitionDuration: transition
                },
            });
        });
	};

	var config = {
		menuScrollTreshold: 260
	};

	var menuOnTop = true,
		menuVisible = true,
		menuOpaque = false,
		prevScroll = 0;

	function handleScroll() {
		var scroll = $(window).scrollTop();

		if (scroll >= config.menuScrollTreshold * 0.5) {
			//Not on top
			if (menuOnTop === true) {
				menuOnTop = false;
				$('header.banner').removeClass('ontop');
			}
		} else {
			//On top
			if (menuOnTop === false) {
				menuOnTop = true;
				$('header.banner').addClass('ontop');
			}
		}

		if (scroll < config.menuScrollTreshold) {
			if (menuOpaque === true) {
				menuOpaque = false;
				$('header.banner').removeClass('opaque');
			}
		} else {
			if (menuOpaque === false) {
				menuOpaque = true;
				$('header.banner').addClass('opaque');
			}
		}

		//Scroll down
		if (scroll > prevScroll) {
			if (menuVisible === true && !$('.search-form-collapse').is(':visible')) {
				$('header.banner').removeClass('visible');
				menuVisible = false;
			}
		}

		//Scroll up
		if (scroll < prevScroll) {
			if (menuVisible === false) {
				$('header.banner').addClass('visible');
				menuVisible = true;
			}
		}
		prevScroll = scroll;
	}

	// Use this variable to set up the common and page specific functions. If you
	// rename this variable, you will also need to rename the namespace below.
	var Sage = {
		// All pages
		'common': {
			init: function () {
				// JavaScript to be fired on all pages
				detectMobile();
				if (!mobile) {
					stickyHeader();
				} else {
					handleScroll();
					$('#mega-toggle-block-1').click(function () {
						$(this).parent().parent().toggleClass('active');
						// Remove sticky header while menu is open
						$('.mobile-header header').toggleClass('mobilenavopen');
						$('html, body').animate({scrollTop: '0px'}, 100);
					});
					$('.btn-mobilesecondarynav').click(function () {
						$(this).toggleClass('active');
						$('#secondary-navbar-collapse').toggle();
					});
					$('.mobilenav-secondary li.page_item_has_children').click(function (e) {
						$(this).toggleClass('active');
						$(this).children('ul.children').toggle();
						e.stopPropagation();
					});
					$('.glyphicon-search').click(function () {
					});

					// Move top-nav inside mobile nav
					$('.mobile-top-nav').detach().appendTo('#mega-menu-primary_navigation');
				}

				// SVG inject
				var mySVGsToInject = document.querySelectorAll('img.svg-icon');

				// Options
				var injectorOptions = {
					evalScripts: 'once',
					pngFallback: 'assets/images',
					each: function (svg) {
						// Callback after each SVG is injected
						//console.log('SVG injected: ' + svg.getAttribute('id'));
					}
				};

				new SVGInjector(mySVGsToInject, injectorOptions);

				$('img').attr('data-no-retina', true);
				$('.retina').removeAttr('data-no-retina');

				var $allPanels = $('.sidebar-nav .page_item_has_children > ul.children');
				var $toggles = $('.togglechildren');

				$secondChildren = $('ul.sidebar-nav li.page_item_has_children ul.children li.page_item_has_children ul.children');
				if (!$secondChildren.parent().hasClass('current_page_item') && !$secondChildren.parent().hasClass('current_page_ancestor') && !$secondChildren.parent().hasClass('current_page_parent')) {
					$secondChildren.slideUp();
				}

				$toggles.click(function () {
					$toggles.removeClass('open');
					if (!$(this).hasClass('toggle_1')) {
						$allPanels.slideUp();
					} else {
						$(this).next('ul.children').slideUp();
					}
					if (!$(this).next().is(':visible')) {
						$(this).addClass('open');
						$(this).next().slideDown();
					}
					return false;
				});

				// FacetWP search tooltip
				$(document).on('facetwp-loaded', function () {

					$('.facetwp-page').click(function () {
						$('html, body').animate({
							scrollTop: $('.facetwp-template').offset().top
						}, 500);
					});

					// Facet search button click
					$('.btn-facet-search').on('click', function () {
						FWP.refresh();
					});

					// Boostrap tooltip on search
					$('[data-toggle="tooltip"]').tooltip();

					$('.show_person').on('click', function () {
						$(this).siblings('.additional_content').toggle();
						$(this).toggle();
					});

				});

			},
			finalize: function () {
				// JavaScript to be fired on all pages, after page specific JS is fired
			}
		},
		// Home page
		'home': {
			init: function () {
				// JavaScript to be fired on the home page

				$('.slider-container').slick({
					dots: true,
					arrows: true,
					infinite: true,
					speed: 500,
					fade: true,
					cssEase: 'linear',
					autoplay: true,
					autoplaySpeed: 6000
				});

				var $container = $('.slide-content-container');
				if ($('.slick-arrow').length) {
					$('.slick-prev').css('left', $container.offset().left);
					$('.slick-next').css('right', $container.offset().left);
				}

				$('.popular-pages-lift').bind("click keypress", function (e) {
					$(".popular-pages-content").slideToggle("fast");
					$(this).children('.pp-open-close').toggleClass('active');
				});

				$('.article-list-articles .article-list-row').matchHeight({
					byRow: false,
					property: 'height',
					target: null,
					remove: false
				});

			},
			finalize: function () {
				// JavaScript to be fired on the home page, after the init JS

				// Masonry home somefeed
				$container = $('.some-feed .some-row');
				initMasonry($container);

				// Some wall

				// bind filter button click

				$('.filters-button-group').on('click', 'button', function () {
					var filterValue = $(this).attr('data-filter');
					$container.isotope({filter: filterValue});
				});

				// change is-checked class on buttons
				$('.button-group').each(function (i, buttonGroup) {
					var $buttonGroup = $(buttonGroup);
					$buttonGroup.on('click', 'button', function () {
						$buttonGroup.find('.is-checked').removeClass('is-checked');
						$(this).addClass('is-checked');
					});
				});


				$('.some-feed .hentry.element .entry-content a').click(function (event) {
					event.preventDefault();
				});
			}
		},
		'page_template_template_service': {
			init: function () {
				$(".servicelift").hover(
					function () {
						$(this).find('.overlay').removeClass('out').addClass('over');
					},
					function () {
						$(this).find('.overlay').removeClass('over').addClass('out');
					}
				);
			}
		},
	};

	// The routing fires all common scripts, followed by the page specific scripts.
	// Add additional events for more control over timing e.g. a finalize event
	var UTIL = {
		fire: function (func, funcname, args) {
			var fire;
			var namespace = Sage;
			funcname = (funcname === undefined) ? 'init' : funcname;
			fire = func !== '';
			fire = fire && namespace[func];
			fire = fire && typeof namespace[func][funcname] === 'function';

			if (fire) {
				namespace[func][funcname](args);
			}
		},
		loadEvents: function () {
			// Fire common init JS
			UTIL.fire('common');

			// Fire page-specific init JS, and then finalize JS
			$.each(document.body.className.replace(/-/g, '_').split(/\s+/), function (i, classnm) {
				UTIL.fire(classnm);
				UTIL.fire(classnm, 'finalize');
			});

			// Fire common finalize JS
			UTIL.fire('common', 'finalize');
		}
	};

	// Load Events
	$(document).ready(UTIL.loadEvents);

	$(window).resize(function () {
		detectMobile();
		if (!mobile) {
			stickyHeader();
		} else {
			handleScroll();
		}
	});

	$(window).scroll(function () {
		if (mobile) {
			handleScroll();
		}
	});

})(jQuery); // Fully reference jQuery after this point.
