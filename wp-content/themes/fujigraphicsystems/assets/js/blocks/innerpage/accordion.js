var FX = ( function( FX, $ ) {


	$( () => {
		FX.AccordionBlock.init()
	})


	FX.AccordionBlock = {

		init() {
			
			this.mainAccordion();
			this.subAccordion();
            this.wrapVideoLightBox();

		},

		mainAccordion() {
			$('.main__accordion-box.accordion-toggle').on('click', function(e) {
				e.preventDefault();

				let parentWrapper = $(this).parent();
					
					if( $(this).hasClass('active') ) {
						$(this).toggleClass('active');
						$(this).find('.accordion-title').toggleClass('active');

						parentWrapper.find('.main__accordion-box.accordion-content').toggleClass('active');

						$('html, body').stop().animate({ scrollTop: parentWrapper.offset().top - 120 }, 500);

					} else {
						$('.main__accordion-box').removeClass('active');
						$('.main__accordion-box > h3.accordion-title').removeClass('active');

						// add active class on the current click
						$(this).toggleClass('active');
						$(this).find('.accordion-title').toggleClass('active');

						parentWrapper.find('.main__accordion-box.accordion-content').toggleClass('active');
						$('html, body').stop().animate({ scrollTop: parentWrapper.offset().top - 120 }, 500);
					}

			});
		},

		subAccordion() {
			$('.sub-accordion__wrapper .accordion-toggle').on('click', function(e) {
				e.preventDefault();

				let parentWrapper = $(this).parent();
					
					if( $(this).hasClass('active') ) {
						$(this).toggleClass('active');
						$(this).find('.accordion-title').toggleClass('active');

						parentWrapper.find('.accordion-content').toggleClass('active');
						$('html, body').stop().animate({ scrollTop: parentWrapper.offset().top - 120 }, 500);
					} else {
						$('.sub-accordion__wrapper .accordion-toggle').removeClass('active');
						$('.sub-accordion__wrapper h3.accordion-title').removeClass('active');
						$('.sub-accordion__wrapper .accordion-content').removeClass('active');

						// add active class on the current click
						$(this).toggleClass('active');
						$(this).find('.accordion-title').toggleClass('active');

						parentWrapper.find('.accordion-content').toggleClass('active');
						$('html, body').stop().animate({ scrollTop: parentWrapper.offset().top - 120 }, 500);
					}

			});
		},

		wrapVideoLightBox() {
			$(window).on('load', function() {
				let videoWrapper = $('.fluid-width-video-wrapper');

					if( videoWrapper.length ) {
						videoWrapper.each(function() {
							let iframeVideo = $(this).find('iframe'),
								videoSrc	= iframeVideo.attr('src');
							$(this).find('iframe').remove();
							$(this).append('<a data-fancybox href="'+videoSrc+'" class="video-popup"></a>');
							$(this).find('.video-popup').html( '<iframe src="'+videoSrc+'" width="732" height="483" allowfullscreen="allowfullscreen"></iframe>' );
						});

					}

			});

			
		}
	}

	

	return FX

} ( FX || {}, jQuery ) )