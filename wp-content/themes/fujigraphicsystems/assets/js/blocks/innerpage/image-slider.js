var FX = ( function( FX, $ ) {

	$( () => {
		FX.imgSlider.init()
	})



	FX.imgSlider = {
		$slider: 		null,
		sliderHeight: 	500,

		init: function() {
			var self = this;
			self.$slider = $('.img-btn-slider');
			self.$slider_nav = $('.img-btn-nav-slider');
			if( self.$slider.length )
				self.bind();
		},

		bind: function() {
			var self = this;
			this.applySlick();
		},



		applySlick: function() {
			var self = this;

			// avoid reapplying Slick on same element
			if( self.$slider.hasClass( 'slick-initialized' ) || self.$slider_nav.hasClass( 'slick-initialized' ) )
				return; 

			self.$slider.slick({
				slidesToShow: 1,
				infinite: true,
				asNavFor: '.img-btn-nav-slider', 
				arrows: true,
				fade: true,
				swipe: false,
				adaptiveHeight: false,
				responsive: [
				{
						breakpoint: 1200,
						settings: {
							adaptiveHeight: true,
						}

					}]

			});

			var slideShow = 9;
			var childElements = $('.img-btn-nav-slider').children().length;
			var infiniteLoop = false;

			if( (childElements) < slideShow ) {
				slideShow = childElements;
				infiniteLoop = false;
			}

			self.$slider_nav.slick({
				slidesToShow: slideShow,
				slidesToScroll: 1,
				infinite:infiniteLoop,
				asNavFor: '.img-btn-slider',
				focusOnSelect: true, 
				adaptiveHeight: false,
				arrows: false,
				responsive: [
					{
						breakpoint: 1200,
						settings: {
							slidesToShow: 4,

						}

					}

				]



			});

			// update forced height (to prevent unslicked appearance from expanding page)

			self.sliderHeight = self.$slider.outerHeight( true );
			self.addNowPlaying();

		}, 



		addNowPlaying: function () {

			var self = this;

			// When a new video is selected, hide "Now Playing for all videos, then show "Now Playing" for the current

			self.$slider_nav.on('afterChange', function(slick, currentSlide ) {
				var slide = currentSlide.currentSlide;
				var classSelectors = "";
				var classList = currentSlide.$slides[slide]['classList'];
				for (var i = 0; i < classList.length ; i++) {
					classSelectors += "." + classList[i];
				}



				// Hides "Now Playing" for all videos in nav

				self.$slider_nav.find('.now-playing-video').hide();
				// Show "Now Playing" for current video
				$(classSelectors).find('.now-playing-video').show();

			});
			
		}

	};



	return FX



} ( FX || {}, jQuery ) )

