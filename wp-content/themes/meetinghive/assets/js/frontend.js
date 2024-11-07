(function ($) {
	'use strict';

	$(document).ready(function () {

		// Button
		hivetheme.getComponent('button').each(function () {
			var button = $(this),
				icon = button.data('icon');

			if (icon) {
				button.append('<i class="hp-icon fas fa-' + icon + '"></i>');
			}
		});

		// Slider
		hivetheme.getComponent('slider').each(function () {
			var container = $(this),
				slider = container.children('div:first'),
				slides = slider.children('div'),
				width = 420,
				settings = {
					prevArrow: '<i class="slick-prev fas fa-arrow-left"></i>',
					nextArrow: '<i class="slick-next fas fa-arrow-right"></i>',
					slidesToScroll: 1,
				};

			if (container.data('type') === 'carousel') {
				if (container.data('width')) {
					width = container.data('width');
				}

				$.extend(settings, {
					centerMode: true,
					slidesToShow: Math.ceil($(window).width() / width),
					responsive: [
						{
							breakpoint: 1025,
							settings: {
								slidesToShow: 3,
							},
						},
						{
							breakpoint: 769,
							settings: {
								slidesToShow: 2,
							},
						},
						{
							breakpoint: 481,
							settings: {
								slidesToShow: 1,
								centerMode: false,
							},
						},
					],
				});

				if (settings['slidesToShow'] > slides.length) {
					settings['slidesToShow'] = slides.length;
				}
			}

			if (container.data('pause')) {
				$.extend(settings, {
					autoplay: true,
					autoplaySpeed: parseInt(container.data('pause')),
				});
			}

			slider.slick(settings);

			container.imagesLoaded(function () {
				slider.slick('resize');
			});

			var observer = new MutationObserver(function () {
				slider.slick('resize');
			}).observe(slider.get(0), {
				subtree: true,
				childList: true,
				attributes: true,
				attributeFilter: ['src'],
			});
		});

		// Rating
		hivetheme.getComponent('circle-rating').each(function () {
			var container = $(this);

			container.circleProgress({
				size: 24,
				emptyFill: 'transparent',
				fill: container.css('color'),
				thickness: 12,
				animation: false,
				startAngle: -Math.PI / 2,
				reverse: true,
				value: parseFloat(container.data('value')) / 5,
			});
		});
	});

	$('body').imagesLoaded(function () {

		// Parallax
		hivetheme.getComponent('parallax').each(function () {
			var container = $(this),
				background = container.css('background-image'),
				image = new Image(),
				offset = container.offset().top,
				speed = 0.25;

			if ($('#wpadminbar').length) {
				offset = offset - $('#wpadminbar').height();
			}

			if ($(window).width() >= 1024 && background.indexOf('url') === 0) {
				image.src = background.replace('url(', '').replace(')', '').replace(/\"/gi, '');

				if (image.height < container.outerHeight()) {
					offset = (image.height - container.outerHeight()) / (2 * speed);
				}

				container.css('background-position-y', ($(window).scrollTop() - offset) * speed);

				$(window).on('scroll', function () {
					container.css('background-position-y', ($(window).scrollTop() - offset) * speed);
				});
			}
		});

		// Color
		hivetheme.getComponent('inherit-color').each(function () {
			var container = $(this),
				property = container.data('property') ? container.data('property') : 'background-color',
				target = container.data('target') ? container.children(container.data('target')) : container,
				rgb = container.closest(container.data('source')).css('background-color').replace(/[^0-9,]+/g, '').split(','),
				r = rgb[0] / 255,
				g = rgb[1] / 255,
				b = rgb[2] / 255,
				max = Math.max(r, g, b),
				min = Math.min(r, g, b),
				h, s, l = (max + min) / 2;

			if (max == min) {
				h = s = 0;
			} else {
				var d = max - min;

				s = l > 0.5 ? d / (2 - max - min) : d / (max + min);

				switch (max) {
					case r: h = (g - b) / d + (g < b ? 6 : 0); break;
					case g: h = (b - r) / d + 2; break;
					case b: h = (r - g) / d + 4; break;
				}

				h /= 6;
			}

			h *= 360;
			s *= 100;
			l *= 100;

			if (container.data('hue')) {
				h += parseInt(container.data('hue'));
			}

			if (container.data('saturation')) {
				s += parseInt(container.data('saturation'));
			}

			if (container.data('light')) {
				l += parseInt(container.data('light'));
			}

			target.css(property, 'hsl(' + h + ',' + s + '%,' + l + '%)');
		});
	});
})(jQuery);
