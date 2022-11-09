var FX = ( function( FX, $ ) {


	$( () => {
		FX.videoSlider.init()
	})


	FX.videoSlider = {
		$slider: null,

		init() {
			
			  $('.video-slider').slick({
				slidesToShow: 3,
				slidesToScroll: 1,
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
