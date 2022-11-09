var FX = ( function( FX, $ ) {





	$( () => {

		FX.caseStudies.init()

	})





	FX.caseStudies = {

		$slider: null,



		init() {

			$('.cs-slider-nav').slick({

				slidesToShow: 3,

				slidesToScroll: 1,

				arrows: false,

				fade: true,

				focusOnSelect: true,

				asNavFor: '.cs-slider'

			  });

			  $('.cs-slider').slick({

				slidesToShow: 1,

				slidesToScroll: 1,

				asNavFor: '.cs-slider-nav',

				dots: false,

				arrows: false,

				infinite: true,

				focusOnSelect: true,

				responsive: [{

					breakpoint: 1200,

					settings: {

					dots: true,

					}

				},

				{

					breakpoint: 1024,

					settings: {

					dots: true,

					adaptiveHeight: true,

					}

				},

				{

					breakpoint: 768,

					settings: {

					dots: true,

					adaptiveHeight: true,

					}

				}

				]

			  });

		},



	}



	return FX



} ( FX || {}, jQuery ) )

