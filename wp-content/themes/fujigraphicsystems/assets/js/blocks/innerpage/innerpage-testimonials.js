var FX = ( function( FX, $ ) {


	$( () => {
		FX.innerTestimonials.init()
	})


	FX.innerTestimonials = {
		$slider: null,

		init() {
			  $('.innerpage-testimonials-slider').slick({
				slidesToShow: 1,
				slidesToScroll: 1,

				dots: true,
				arrows: false,
				infinite: true,
				focusOnSelect: true,
			  });
		},

	}

	return FX

} ( FX || {}, jQuery ) )
