var FX = ( function( FX, $ ) {


	$( () => {
		FX.TabsAccordion.init()
	})


	FX.TabsAccordion = {

		init() {
            this.resizeRainbowBar()
            // Listen
			window.addEventListener('resize', (event) => this.resizeRainbowBar(event), true);

            $('.js-tab-accordion-btn').on('click', function(event) {
                let currentTab      = $(this).attr('data-tab-id'),
                    parentWrapper   = $('.tab-accordion__panel');

                parentWrapper.removeClass('is-active');
                $('.js-tab-accordion-btn').removeClass('is-active');

                $('.js-tab-accordion-btn[data-tab-id="'+currentTab+'"]').toggleClass('is-active');
                $('.tab-accordion__panel[data-tab-id="'+currentTab+'"]').toggleClass('is-active');
                $('.tab-accordion__panel__toggle[data-tab-id="'+currentTab+'"]').toggleClass('is-active');

                FX.TabsAccordion.resizeRainbowBar(event);

                $('html, body').stop().animate({ scrollTop: parentWrapper.offset().top - 20 }, 500);

            });

		},
		resizeRainbowBar(event = null) {
			// Get all js accordions
            const accordions = Array.from(document.querySelectorAll('.js-tab-accordion'));
            if (! accordions.length) {
                console.trace();
                return;
            }
            accordions.forEach(accordion => {
                const panelContainer = accordion.querySelector('.tab-accordion__panels');
                const {top: containerY} = panelContainer.getBoundingClientRect(); 
                const panels = Array.from(accordion.querySelectorAll('.tab-accordion__panel.js-tab-accordion-panel'));
                if (! panels.length) {
                    console.trace();
                    return;
                }

                // We don't draw a line from the last panel down to nowhere (no other panel to connect) - so we ignore it.
                for (let i = 0; i < (panels.length - 1); ++i) {
                    // Get current child in tab list
                    const thisPanel = panels[i];
                    // Get next child in tab list
                    const nextPanel = panels[i + 1];
                    const thisPanelThumbnail = thisPanel.querySelector('.tab__thumbnail');
                    const nextPanelThumbnail = nextPanel.querySelector('.tab__thumbnail');
    
                    // Get difference between central height of this thumbnail and central height of next thumbnail - this is the height of our rainbow.
                    const {top: thisTop, height: thisHeight} = thisPanelThumbnail.getBoundingClientRect();
                    const {top: nextTop, height: nextHeight} = nextPanelThumbnail.getBoundingClientRect();
                    const thisY = thisTop + (thisHeight / 2);
                    const lastY = nextTop + (nextHeight / 2);
                    const differenceY = Math.ceil(lastY - thisY);
                    // Top has to be the difference between parent container's Y position and this panel's Y position.
                    console.log({containerY});
                    console.log({thisY});
                    const containerDifferenceY = Math.ceil(thisY - containerY); // Offset
                    console.log({containerDifferenceY});
                    // Update CSS variables on accordion to resize/reposition the bar
                    // https://css-tricks.com/updating-a-css-variable-with-javascript/
                    thisPanel.style.setProperty('--vertical-maybe-rainbow-bar-height', differenceY + 'px');
                    // thisPanel.style.setProperty('--vertical-maybe-rainbow-bar-top', (thisHeight / 2) + 'px');
                    thisPanel.style.setProperty('--vertical-maybe-rainbow-bar-top', containerDifferenceY + 'px');
                }
            });
		}

	}

	

	return FX

} ( FX || {}, jQuery ) )