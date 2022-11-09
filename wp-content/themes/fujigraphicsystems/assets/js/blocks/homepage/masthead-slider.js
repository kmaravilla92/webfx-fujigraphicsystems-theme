var FX = ( function( FX, $ ) {


	$( () => {
		FX.HomepageMasthead.init()
	})


	FX.HomepageMasthead = {
		$slider: null,

		init() {
			this.$slider = $('.js-masthead-homepage-slider')

			if( this.$slider.length ) {
				this.applySlick()
			}
		},

		applySlick() {
            // TODO configure settings for your slider here (ref: https://github.com/kenwheeler/slick/#settings)
			// keep in mind, you don't need to declare default values
            this.$slider.slick( {
                dots: true,
                autoplay: true,
				arrows: false,
                autoplaySpeed: 5000,
            });
		}
	}

	

	return FX

} ( FX || {}, jQuery ) )