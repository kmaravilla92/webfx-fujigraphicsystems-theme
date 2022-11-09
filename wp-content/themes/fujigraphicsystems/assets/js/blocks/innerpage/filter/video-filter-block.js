var FX = ( function( FX, $ ) {


	$( () => {
		FX.videoFilter.init()
	})


	FX.videoFilter = {
		$slider: null,

		init() {
			this.toggleFilters();
            this.clearFilters();
            $(window).on('load', function(){
                FX.videoFilter.loadVideoCategories();
                FX.videoFilter.loadMorePosts(); 
            });
            
            $('.video-slider-item').fancybox({
                buttons : [
                    'play'
                ]
            });

        },

        clearFilters() {
            $('.js-clear-filters').on('click', function(){
                $('.js-category-dropdown ul li a').removeClass('is-selected');
                $('.storage-category__list').empty();
                $('.list__sub-categories ul').empty();
                FX.videoFilter.loadVideoCategories( 0 );
            });
        },

        loadMorePosts() {

            $(document).on('click','.filter-list_wrapper .js-load-more-btn', function(){

                if( $('.storage-category__list a').length == 0 || (  $('.storage-category__list a').length == 1 && $('.storage-category__list > a:first-child').attr('term-id') == 0 ) ) {
                    FX.videoFilter.loadVideoCategories( 0, true );
                } else {
                    let storageFilter = [];
                    $('.storage-category__list a').each(function(){
                        storageFilter.push( $(this).attr('term-id') );
                    });
                    FX.videoFilter.loadVideoCategories( storageFilter, true );
                }

            }); 

        },

        postsPerPageDevice() {
            let windowWidth  = $(window).width(),
                postPerPage  = 0;

            if( windowWidth <= 1024 ) {
                postPerPage = 6;
            }

            if( windowWidth > 1024 ) {
                postPerPage = 9;
            }

            return postPerPage;

        },

        loadVideoCategories( catLists = 0, loadMore = false ) {

            let currentPaged = $('.js-filter-lists').attr('paged'),
                dynamicPpp   = FX.videoFilter.postsPerPageDevice();

            $.ajax( {
                
				url: FXcustom.ajaxurl,
				type: 'post',
				data: {
				   action			    : 'fx_video_posts_category',
                   categories           : catLists,
                   paged                : currentPaged,
                   postsPerPage         : dynamicPpp,
				   nonce			    : FXcustom.FXnonce,
				},
                
				beforeSend: function() {
                    // 
                    if( loadMore == false ) {
                        $('.js-filter-lists').empty();
                        $('.filter-list_wrapper .load-more').remove();
                    }

				},

			   	success( data ) {

                    if ( data ) {

                        if( loadMore == false ) {
                            $('.js-filter-lists').empty();
                            $('.filter-list_wrapper .load-more').remove();
                        }

                        $('.js-filter-lists').append( data.data.videos );
                        
                        if( $('.js-load-more').length == 0 ) {
                            let loadMoreHtml    = '<div class="load-more js-load-more text-center"> \
                                                    <div class="load-more__counter js-load-more-videos"></div> \
                                                    <progress class="load-more__progress js-load-more-video-progress"></progress> \
                                                    <button class="btn load-more__btn js-load-more-btn">Load more</button> \
                                                </div>';
                            $('.js-filter-lists').parent().append( loadMoreHtml );
                        
                        }

                        let  postsCount      = $('.video-slider-item').length,
                             foundPosts      = data.data.found_posts,
                             paged           = data.data.paged;
                        
                            $('.js-filter-lists').attr('paged', paged );

                            $('.js-load-more-videos').text(`Viewing ${postsCount} of ${foundPosts} Videos`);
                            $('.js-load-more-video-progress').attr('max', foundPosts);
                            $('.js-load-more-video-progress').attr('value', postsCount);

                        if( parseInt( postsCount ) == parseInt( foundPosts ) ) {
                            $('.filter-list_wrapper .js-load-more-btn').remove();
                        }

				    }
			   
			   	},

			} );

        },

        subCategoryFilters( parentCat ) {
            
            if( ! $('.list__categories ul li a[term-id="'+ parentCat +'"]').hasClass('is-selected') ) {
                return false;
            }

            $.ajax( {
                
				url: FXcustom.ajaxurl,
				type: 'post',
				data: {
				   action			    : 'fx_video_sub_cat',
                   subCat               : parentCat,
				   nonce			    : FXcustom.FXnonce,
				},

			   	success( data ) {

                    if ( data ) {
                        $('.list__sub-categories ul').append( data.data.sub_categories );
				    }
			   
			   	},

			} );

        },

        toggleFilters() {

            let storageFilter = [],
                timer;

            $('.js-toggled-cat').on('click', function(){
                $(this).parent().find('.js-category-dropdown').toggleClass('toggle-category');
            });

            $('.category-multiple__select').on('mouseleave', function(){
                $(this).find('.js-category-dropdown').removeClass('toggle-category');
            });

            $('.sub-category-multiple__select').on('mouseleave', function(){
                $(this).find('.js-category-dropdown').removeClass('toggle-category');
            });

            $(document).on('click','.js-category-dropdown li a', function(){

                if( $(this).attr('term-id') == 0 ) {

                    $('.js-category-dropdown li a').removeClass('is-selected');
                    $('.list__sub-categories ul li').remove();
                    $('.storage-category__list a').remove();
                    $(this).addClass('is-selected');
                    $(this).clone().appendTo( '.storage-category__list' );

                    return;

                }

                $('.js-category-dropdown .all-categories').removeClass('is-selected');
                
                $(this).toggleClass('is-selected');

                if( $(this).parents()[2].classList.contains('list__categories') ) {
                    let currentTermId = $(this).attr('term-id');

                    $('.list__categories ul li a').each(function(){
                        
                        let termID   = $(this).attr('term-id');

                        if( ! $(this).hasClass('is-selected') ) {
                            $('.storage-category__list').find( "[term-id='"+ termID +"']" ).remove();
                        }

                    });

                    if( $(this).hasClass('is-selected') ) {
                        FX.videoFilter.subCategoryFilters( currentTermId );
                        $(this).clone().appendTo( '.storage-category__list' );

                    } else {
                        $('.list__sub-categories ul li a[parent-term-id="'+ currentTermId +'"]').parent().remove();
                    }

                    if( $('.list__categories ul li a.is-selected').length == 0 ) {
                        $('.list__sub-categories ul li').remove();
                    }

                }
                
                
                if( $(this).parents()[2].classList.contains('list__sub-categories') ) {
                    $('.list__sub-categories ul li a').each(function(){
                        
                        let termID   = $(this).attr('term-id');

                        if( ! $(this).hasClass('is-selected') ) {
                            $('.storage-category__list').find( "[term-id='"+ termID +"']" ).remove();
                        }

                    });

                    if( $(this).hasClass('is-selected') ) {
                        $(this).clone().appendTo( '.storage-category__list' );
                    } 
                }


                
            });

            $('.storage-category__list').bind('DOMSubtreeModified', function(e){

                storageFilter = [];

                if (timer) clearTimeout(timer);
                timer = setTimeout(function() { 
                    
                    $('.storage-category__list a').each(function(){
                        if( $(this).attr('term-id') == 0 ) {
                            storageFilter = '0';
                        } else {
                            storageFilter.push( $(this).attr('term-id') );
                        }
                        
                    });

                    $('.js-filter-lists').attr('paged', '0');
                    FX.videoFilter.loadVideoCategories( storageFilter, false );
                }, 200);

            });


            $(document).on('click','.storage-category__list a', function() {
                
                let isSelected = $(this).attr('term-id');
                $(this).remove();

                $('.js-category-dropdown li a').each(function(){
                    if( $(this).attr('term-id') == isSelected ) {
                        $(this).removeClass('is-selected');
                    }
                });

            }); 

            
        }

	}

	return FX

} ( FX || {}, jQuery ) )
