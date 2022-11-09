/* ---------------------------------------------------------------------
	Global Js
	Target Browsers: All

	HEADS UP! This script is for general functionality found on ALL pages and not tied to specific components, blocks, or
	plugins. 

	If you need to add JS for a specific block or component, create a script file in js/components or js/blocks and
	add your JS there. (Don't forget to enqueue it!)
------------------------------------------------------------------------ */

var FX = ( function( FX, $ ) {

	/**
	 * Doc Ready
	 * 
	 * Use a separate $(function() {}) block for each function call
	 */
	$( () => {
		FX.General.init(); // For super general or super short scripts
	})

    $( () => {
        FX.ExternalLinks.init(); // Enable by default
	})

    $( () => {
        FX.Menu.init();
	})

	$( ()  => {
		FX.MobileMenu.init();	
    })

    $( () => {
        // TODO: Add Modules needed for build. Remove unused modules
        // NOTE: Code that is specific to one page or block should not be added in global.js. This file is reserved for javascript that must load on each page.
	})
	
	
	$(window).on( 'load', () => {
		FX.BackToTop.init()
	})

	$( ()  => {
		FX.ReadMoreLess.init();	
    })

	$( ()  => {
		FX.TaxonomySidebar.init();	
    })


	/**
	 * Display scroll-to-top after a certain amount of pixels
	 * @type {Object}
	 */
	FX.BackToTop = {
		$btn: null,

		init() {
			this.$btn = $('.back-to-top');

			if( this.$btn.length ) {
				this.bind();
			}
		},

		bind() {
			$(window).on( 'scroll load', this.maybeShowButton.bind( this ) );
			this.$btn.on( 'click', this.scrollToTop );
		},

		maybeShowButton() {
			if( $( window ).scrollTop() > 100 ) { // TODO: Update "100" for how far down page to show button
				this.$btn.removeClass( 'hide' );
			} else {
				this.$btn.addClass( 'hide' );
			}
		},

		scrollToTop() {
			$(window).scrollTop( 0 );
		}
	};

	
	
	/**
	 * General functionality — ideal for one-liners or super-duper short code blocks
	 */
	FX.General = {
		init() {
			this.bind();
		},

		bind() {

			// Makes all PDF to open in new tabs
			$('a[href*=".pdf"]').each( e => {
				$(this).attr('target', '_blank');
			});

			// FitVids - responsive videos
			$('body').fitVids();

			// Input on focus remove placeholder
			$('input,textarea').focus( () => {
				$(this).removeAttr('placeholder');
			});
			
			// nav search toggle
			$('.js-search-toggle').on('click', () => {
				$('.desktop-menu__phone, .js-search-toggle, .desktop-menu__search').toggleClass('js-search-active');
                $('.desktop-menu__search input[name="s"]').focus();
			});
			
			$('body .search').click( function() {	
				$(this).toggleClass('search-cross');	
                $('.search-div').slideToggle("fast");	
                $(".search-column input").focus();	
			});
			
			if( $('.testimonial-slider').length > 0 ) {

				$('.testimonial-slider').slick({
					slidesToShow: 1,
					slidesToScroll: 1,
					dots: false,
					arrows: true,
					infinite: true,
				});

			}

			if( $('body.search-results .js-tab-accordion-btn, body.search-no-results .js-tab-accordion-btn').length ) {
				$('body.search-results .js-tab-accordion-btn, body.search-no-results .js-tab-accordion-btn').on('click', function(){
					let dataTabId = $(this).attr('data-tab-id');

					$('body.search-results .js-tab-accordion-btn, body.search-no-results .js-tab-accordion-btn').removeClass('is-active');
					$('body.search-results .tab-accordion__panel, body.search-no-results .tab-accordion__panel').removeClass('is-active');

					// $(this).addClass('is-active');
					$('body.search-results .js-tab-accordion-btn, body.search-no-results .js-tab-accordion-btn').each(function(){
						if( $(this).attr('data-tab-id') == dataTabId ) {
							$(this).addClass('is-active');
						}
					});

					$('body.search-results .tab-accordion__panel[data-tab-id="'+ dataTabId +'"], body.search-no-results .tab-accordion__panel[data-tab-id="'+ dataTabId +'"]').addClass('is-active');

				});
			}

			if( $('#sidebarWrap').length ) {

				let parentSideBarWidth = $('#sidebarWrap').parent().width();
				if( $(window).width() > 1024 ) {
					$('#sidebarWrap').css('width', parentSideBarWidth + 'px');
				}

				$(window).resize(function(){
					let parentSideBarWidth = $('#sidebarWrap').parent().width();
					if( $(window).width() > 1024 ) {
						$('#sidebarWrap').css('width', parentSideBarWidth + 'px');
					}
				});

				var top = $('#sidebar').offset().top - parseFloat($('#sidebar').css('marginTop').replace(/auto/, 0));
				var footTop,offsetSideBar;
				var outerHeightDiv = $('#post-listing-feature__wrapper').outerHeight();
				if( $('#custom-flex-block__wrapper').length ) {
					footTop = $('#custom-flex-block__wrapper').offset().top - parseFloat($('#custom-flex-block__wrapper').css('marginTop').replace(/auto/, 0));
					offsetSideBar = 280;
				} else {
					footTop = $('#page-footer').offset().top - parseFloat($('#page-footer').css('marginTop').replace(/auto/, 0));
					offsetSideBar = 130;
				}
				
				var sidebarOuterHeight = $('#sidebar').outerHeight();
				var maxY = ( footTop - sidebarOuterHeight ) - offsetSideBar;
				
				$(window).scroll(function(evt) {
					var y = $(this).scrollTop();
					if (y > top) {
						
						if (y < maxY) {
							$('#sidebar').addClass('fixed').removeAttr('style');
						} else {
							
							$('#sidebar').removeClass('fixed').css({
								position: 'absolute',
								top: (outerHeightDiv - sidebarOuterHeight) + 'px'
							});
						}

					} else {
						$('#sidebar').removeClass('fixed');
					}
					
				});
			}

			// $(window).on('load', function(){
				// if( $('form.hs-form').length ) {

				// 	$('.hbspt-form').fadeIn();

				// 	$('form.hs-form .hs-error-msgs').removeAttr('style');
				// 	$('form.hs-form .hs-error-msgs').css('display', 'none');
				// }

				$(document).on('focusout','form.hs-form .hs-input.error.invalid', function(e){ 
					
					$(this).parent().parent().find('ul.hs-error-msgs').removeAttr('style');
					$(this).parent().parent().find('ul.hs-error-msgs').css('display', 'block');
					
				});


				$(document).on('click','form.hs-form .actions .hs-button', function(e){
					
					let invalid = [];

					$('form.hs-form input.error.invalid').each(function(){
						$(this).parent().parent().find('ul.hs-error-msgs').removeAttr('style');
						$(this).parent().parent().find('ul.hs-error-msgs').css('display', 'block');

						invalid.push(true);

					});

					let uniqueArray = invalid.filter(function(item, pos, self) {
						return self.indexOf(item) == pos;
					})

					if( uniqueArray.length !== 1 && uniqueArray[0] == true ) {
						e.preventDefault();
					}

				});

			// });

			/* ubermenu hack to force-show a Ubermenu submenu. Delete prior to launch */
			// setInterval(function() {
				// 	$('#menu-item-306').addClass('ubermenu-active');
				// }, 1000 );
				
				// TODO: Add additional small scripts below


			window.addEventListener('message', event => {
			   if(event.data.type === 'hsFormCallback' && event.data.eventName === 'onFormReady') {
			       // the form is ready to manipulate!
			       $('form.hs-form .hs-error-msgs').removeAttr('style');
			   }
			});

		}
	};



	/**
	 * Mobile menu script for opening/closing menu and sub menus
	 * @type {Object}
	 */
	FX.MobileMenu = {
		init() {
			$('.nav-primary li.menu-item-has-children > a').after('<span class="sub-menu-toggle"></span>');	
			$('.sub-menu-toggle').on('touchstart click', function(e) {
				var $this = $(this),	
					$parent = $this.closest("li"),	
					$wrap = $parent.find("> .sub-menu"),
					$activelink = $this.prev("a"), 
					$activemenu = $this.closest("header")	;	
				$wrap.toggleClass("js-toggled");	
				$this.toggleClass('js-clicked');	
				$this.toggleClass("js-toggled");
				$activelink.toggleClass("js-toggled");
				$activemenu.toggleClass("js-toggled");	
			});	
			$('.menu-toggle').click( function() {	
                $('.page-header .nav-primary').fadeToggle();	
				$('.page-header nav.ubermenu-main').toggleClass('ubermenu-responsive-collapse');
				$(this).toggleClass('cross');
			});

			$('.ubermenu-sub-indicator.fas.fa-angle-down').on('touchstart click', function(e) {
				e.stopPropagation();	
				var $this = $(this),	
					$parent = $this.closest("li"),	
					$wrap = $parent.find("> .ubermenu-submenu");

					$parent.toggleClass('ubermenu-active');
				e.preventDefault();	
			});	

			$('.ubermenu-main li.fx-ctm-submenu > a').append('<span class="submenu-fx-toggle"><i class="icon-chevron-down"></i></span>');
			$('.submenu-fx-toggle').on('touchstart click', function(e){
				e.preventDefault(); 
				var $this = $(this),	
				$parent = $this.closest("li"),	
				$wrap = $parent.find("> .ubermenu-submenu"),
				$activelink = $this.prev("a"), 
				$activemenu = $this.closest("header")	;	
				$wrap.toggleClass("js-toggled");	
				$this.toggleClass('js-clicked');	
				$this.toggleClass("js-toggled");
				$activelink.toggleClass("js-toggled");
				$activemenu.toggleClass("js-toggled");
			});
		}
	};

	/**
	 * Initalize read more less on mobile devices
	 */
	FX.ReadMoreLess = {
		init() {
			
			let readMore = $('.mobile-read-more-less-tag');
			
			if( readMore.length ) {
			
				readMore.each(function(){
					let readMoreWrapper = $(this),
						parentReadMore  = readMoreWrapper.parent();

					readMoreWrapper.find('img').remove();
					
					readMoreWrapper.prev()[0].innerHTML += '<span class="points">...</span>';
					
					$('<div class="fx-readmore-less__wrapper"></div>').insertAfter( readMoreWrapper );

					$('.fx-readmore-less__wrapper').css('height', 0);
					$('.fx-readmore-less__wrapper').css('overflow', 'hidden');
					$('.fx-readmore-less__wrapper').css('visibility', 'hidden');

					readMoreWrapper.nextAll().appendTo( parentReadMore.find('.fx-readmore-less__wrapper') );

					readMoreWrapper.parent().append('<button class="btn-read-more">Read More</button>');

				});
				
				this.readMoreAction();

			}

		},

		readMoreAction() {
			
			$(document).on('click', '.btn-read-more', function(e) {
				e.preventDefault();

				let parentReadmore = $(this).parent();

				$(this).toggleClass('read-less');

				if( $(this).hasClass('read-less') ) {
					$(this).text('Read Less');
					parentReadmore.find('.fx-readmore-less__wrapper').css('height', 'auto');
					parentReadmore.find('.fx-readmore-less__wrapper').css('overflow', 'visible');
					parentReadmore.find('.fx-readmore-less__wrapper').css('visibility', 'visible');
					parentReadmore.find('.points').css('visibility', 'hidden');
				} else {
					$(this).text('Read More');
					parentReadmore.find('.fx-readmore-less__wrapper').css('height', 0);
					parentReadmore.find('.fx-readmore-less__wrapper').css('overflow', 'hidden');
					parentReadmore.find('.fx-readmore-less__wrapper').css('visibility', 'hidden');
					parentReadmore.find('.points').css('visibility', 'visible');
				}

			});

		},

	};

	/**
	 * Initalize TaxonomySidebar
	 */
	 FX.TaxonomySidebar = {
		init() {
			if( $('.js-taxonomy').length ) {
				let taxonomyList = $('.js-taxonomy li');

				taxonomyList.each(function(){
					if( $(this).children('ul.children').length > 0 ) {
						$(this).addClass('has-children');
						$(this).append('<i class="sub-tax icon-chevron-down"></i>');
					}
				});

				$(document).on('click', '.sub-tax', function(){

					if( $(this).parent().hasClass('show-in-child') ) {
						$(this).parent().removeClass('show-in-child');
						$(this).parent().children('ul.children').fadeOut();
					} else {
						$(this).parent().children('ul.children').fadeIn();
						$(this).parent().addClass('show-in-child');
					}
				});

			}
		},

	};
	
	/**
	 * Ubermenu mobile menu toggle hack
	 * @type {Object}
	 */
	FX.Menu = {
		windowWidth: 		0,
		$ubermenu: 			$('#ubermenu-nav-main-33'), // replace with ID of ubermenu element
		$topLevelMenuItems: null,
		$mobileMenuToggle: 	$('.ubermenu-responsive-toggle'),


        init() {
            this.setMenuClasses();
			this.setSubMenuClasses();

			this.$topLevelMenuItems = this.$ubermenu.children('.ubermenu-item-level-0');
			this.bind();
        },

        setMenuClasses() {
            let windowWidth = $( window ).innerWidth();

            // iOS fires resize event on scroll - let's first make sure the window width actually changed
            if ( windowWidth == this.windowWidth ) {
                return;
            }

            this.windowWidth = windowWidth;

            if ( this.windowWidth < 1025 ) {
                $('.ubermenu-item-has-children').each( () => {
                    $(this).removeClass('ubermenu-has-submenu-drop');
                });

            } else {
                $('.ubermenu-item-has-children').each( () => {
                    $(this).addClass('ubermenu-has-submenu-drop');
                });
            }
        },

		setSubMenuClasses() {
			$('.ubermenu-item-has-children').each( () => {
                $(this).children('a').each( () => {
                    let $this = $(this);
                    $this.children('.ubermenu-sub-indicator').clone().insertAfter( $this).addClass('submenu-toggle hidden-md-up');
                    $this.children('.ubermenu-sub-indicator').addClass('hidden-sm-down');
                });
			});
		},

        bind() {
			$(window).on( 'resize', this.setMenuClasses.bind(this) );

			$('.submenu-toggle').on( 'touchstart click', this.toggleNextLevel );

			this.$topLevelMenuItems.on( 'ubermenuopen', this.handleUbermenuOpen.bind( this ) )
			this.$topLevelMenuItems.on( 'ubermenuclose', this.handleUbermenuClose.bind( this ) )

			// when clicking to open/close mobile menu toggle
			this.$mobileMenuToggle.on( 'ubermenutoggledopen', this.handleUbermenuOpen.bind( this ) )
			this.$mobileMenuToggle.on( 'ubermenutoggledclose', this.handleUbermenuClose.bind( this ) )
		},

		handleUbermenuOpen( e ) {
			const self = this,
				$container = self.$ubermenu.closest('.desktop-menu')

			$(document.body).addClass('menu-is-active')

			$container.addClass('menu-is-active')
			self.$mobileMenuToggle.addClass('menu-is-active')
		},


		handleUbermenuClose( e ) {
			const self = this,
				$container = self.$ubermenu.closest('.desktop-menu')

			$(document.body).removeClass('menu-is-active')
			$container.removeClass('menu-is-active')
			self.$mobileMenuToggle.removeClass('menu-is-active')
		},


		/* handleResponsiveToggleClick( e ) {
			const $btn = $(e.currentTarget),
				$menu = $('.desktop-menu').find('.ubermenu-main')

			$btn.toggleClass('menu-is-active', $menu.hasClass('ubermenu-responsive-collapse') )
		}, */


        toggleNextLevel( e ) {
            let $this = $( this );
            
			e.preventDefault();
			
            $this.toggleClass('fa-angle-down').toggleClass('fa-times');
            $this.parent().toggleClass('ubermenu-active');
            if( $this.parent().hasClass('ubermenu-active') ) {
                $this.parent().siblings('.ubermenu-active').removeClass('ubermenu-active').children('.submenu-toggle').addClass('fa-angle-down').removeClass('fa-times');
            }
        }
	}



	/**
	 * Force External Links to open in new window.
	 * @type {Object}
	 */
	FX.ExternalLinks = {
		init() {
			var siteUrlBase = FX.siteurl.replace( /^https?:\/\/((w){3})?/, '' );

			$( 'a[href*="//"]:not([href*="'+siteUrlBase+'"])' )
				.not( '.ignore-external' ) // ignore class for excluding
				.addClass( 'external' )
				.attr( 'target', '_blank' )
				.attr( 'rel', 'noopener' );
		}
	};



	/**
	 * Affix
	 * Fixes sticky items on scroll
	 * @type {Object}
	 */
	FX.Affix = {

		$body: 			null,
		$header: 		null,
		headerHeight: 	null,
		scrollFrame: 	null,
		resizeFrame: 	null,


		init() {
			this.$body 			= $(document.body);
			this.$header 		= $('#page-header');
			this.headerHeight 	= this.$header.outerHeight( true );

			this.bind();
        },


        bind(e) {
			$(window).on( 'scroll', this.handleScroll.bind( this ) );
			$(window).on( 'resize', this.handleResize.bind( this ) );
		},


		handleScroll( e ) {
			var self = this;

			// avoid constantly running intensive function(s) on scroll
			if( null !== self.scrollFrame ) {
				cancelAnimationFrame( self.scrollFrame )
			}

			self.scrollFrame = requestAnimationFrame( self.maybeAffixHeader.bind( self ) )
		},


		handleResize( e ) {
			var self = this;

			// avoid constantly running intensive function(s) on resize
			if( null !== self.resizeFrame ) {
				cancelAnimationFrame( self.resizeFrame )
			}

			self.resizeFrame = requestAnimationFrame( () => {
				self.headerHeight = self.$header.outerHeight( true );
			})
		},


		maybeAffixHeader() {
			var self = this;

			if( 200 < $(window).scrollTop() ) {
				self.$body.css( 'padding-top', self.headerHeight );
				self.$header.addClass('js-scrolled');
			} else {
				self.$body.css( 'padding-top', 0 );
				self.$header.removeClass('js-scrolled');
			}
		}
	};



	/**
	 * FX.SmoothAnchors
	 * Smoothly Scroll to Anchor ID
	 * @type {Object}
	 */
	FX.SmoothAnchors = {
		hash: null,

		init() {
			this.hash = window.location.hash;

			if( '' !== this.hash ) {
				this.scrollToSmooth( this.hash );
			}

			this.bind();
		},

		bind() {
			$( 'a[href^="#"]' ).on( 'click', $.proxy( this.onClick, this ) );
		},

		onClick( e ) {
			e.preventDefault();

			var target = $( e.currentTarget ).attr( 'href' );

			this.scrollToSmooth( target );
		},

		scrollToSmooth( target ) {
			var $target = $( target ),
				headerHeight = 0 // TODO: if using sticky header change to $('#page-header').outerHeight(true)
			
			$target = ( $target.length ) ? $target : $( this.hash );

			if ( $target.length ) {
				var targetOffset = $target.offset().top - headerHeight;

				$( 'html, body' ).animate({ 
					scrollTop: targetOffset 
				}, 600 );

				return false;
			}
		}
	};
	/**
	 * Accordion
	 */
	FX.Accordion = {

		init: function() {
			this.bind();
			$('.accordion-content').hide();
		},

		bind: function() {
			$('.accordion-toggle > .accordion-title').on( 'toggle-panel', this.togglePanel );
			$('.accordion-toggle > .accordion-title').click( this.togglePanel );
		},

		togglePanel: function() {
			$this = $(this);
			$target =  $this.parent().next();

			if ( $this.hasClass('active') ) {
				$this.removeClass('active');
				$target.removeClass('active').slideUp();
			} else {
				$('.accordion-content').removeClass('active').slideUp();
				$('.accordion-title').removeClass('active');
				$this.addClass('active');
				$target.addClass('active').slideDown();
			}
		}

	};
	

	return FX;

} ( FX || {}, jQuery ) );
