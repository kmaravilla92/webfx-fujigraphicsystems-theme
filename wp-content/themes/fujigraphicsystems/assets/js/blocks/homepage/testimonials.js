var FX = ( function( FX, $ ) {


	$( () => {
		FX.testimonilas.init()
	})


	FX.testimonilas = {
		$slider: null,

		init() {
			$('.testimonial-img-slider').slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				fade: true,
				asNavFor: '.testimonilas-slider'
			  });
			  $('.testimonilas-slider').slick({
				slidesToShow: 3,
				slidesToScroll: 1,
				asNavFor: '.testimonial-img-slider',
				dots: false,
				arrows: true,
				infinite: true,
				focusOnSelect: true,
				responsive: [{
					breakpoint: 1200,
					settings: {
					slidesToShow: 2,
					slidesToScroll: 1,
					arrows: false,
					dots: true,
					}
				},
				{
					breakpoint: 768,
					settings: {
					slidesToShow: 1,
					slidesToScroll: 1,
					arrows: false,
					dots: true,
					}
				}
				]
			  });
		},

	}

	return FX

} ( FX || {}, jQuery ) )
