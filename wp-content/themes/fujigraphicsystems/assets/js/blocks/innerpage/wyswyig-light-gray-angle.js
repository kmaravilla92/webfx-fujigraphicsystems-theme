var FX = ( function( FX, $ ) {


	$( () => {
		FX.WysiwygGrayAngle.init()
	})


	FX.WysiwygGrayAngle = {

		init() {
            $(document).ready(function(){
                 
                if( $('.js-detect-angle-display').length ) {

                    const whiteListContainer = [
                        'masthead',
                        'tab-section',
                        'case-study-section',
                        'innerpage-testimonials',
                        'full-width-image-section',
                        'cta-full-width',
                        'cta-half-and-half',
                        'attention-block'
                    ];

                    let wysiwygAngle = $('.js-detect-angle-display');

                    wysiwygAngle.each(function(){
                        let $this = $(this);

                        // remove overflow hidden after html load
                        $this.removeClass('overflow-hidden')

                        whiteListContainer.forEach(function (item, index) {
                            
                            if( $this.prev()[0].classList.contains( item ) ) {
                                if( ! $this.prev()[0].classList.contains( 'white-bg' ) &&  $this.prev()[0].classList.contains( item ) ) {
                                    $this.removeClass('angle-top');
                                    $this.find('#angle-top').remove();
                                }

                                if( $this.prev()[0].classList.contains( 'attention-block' ) &&  $this.prev()[0].classList.contains( 'white-bg' )  ) {
                                    $this.removeClass('angle-top');
                                    $this.find('#angle-top').remove();
                                }

                            }

                            if( $this.next()[0].classList.contains( item ) ) {

                                if( ! $this.next()[0].classList.contains( 'white-bg' ) &&  $this.next()[0].classList.contains( item ) ) {
                                    $this.removeClass('angle-bottom');
                                    $this.find('#angle-bottom').remove();
                                }

                                if( $this.next()[0].classList.contains( 'attention-block' ) &&  $this.next()[0].classList.contains( 'white-bg' )  ) {
                                    $this.removeClass('angle-bottom');
                                    $this.find('#angle-bottom').remove();
                                }

                            }

                        });

                    });

                }

            }); 
		},

	}

	return FX

} ( FX || {}, jQuery ) )
