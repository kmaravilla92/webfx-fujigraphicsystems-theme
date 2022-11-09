<?php 
    /**
     * Preview Block for Editor
     * Description: This will display the preview block on admin editor.
     * 
     * fx_preview_block_banner - 10
     * 
     */
    do_action('fx_preview_block');

    /**
     * Return null when viewing the block on admin panel 
     * as it will populate the data when previewed and make unnecessary display.
     */
    if( is_admin() ) 
        return;
        
?>
<section class="video-filter">
    <div class="container-fluid">
        <div class="video-filter-header">
            <?php echo get_field('title') ? '<h2>' . get_field('title') . '</h2>' : ''; ?>
            <div class="entry-content">
                <?php echo apply_filters('acf_the_content', get_field('content') ); ?>
            </div>
        </div>
        <?php
            $featured_post_query = new WP_Query(
                [
                    'posts_per_page' => 1,
                    'meta_key'       => 'set_featured_post',
                    'meta_value'     => '1',
                    'post_type'      => 'video'
                ] 
            );
        ?>
        <?php if ( $featured_post_query->have_posts() ) : while ( $featured_post_query->have_posts() ) : $featured_post_query->the_post(); ?>
            <div class="featured-item__wrapper col-lg-10 col-lg-push-1">
                <div class="featured-image">
                    <?php 
                        $thumb_id   = get_field( 'video_thumbnail', get_the_ID() );
                        $video_link = get_field('video_link', get_the_ID() );
                        if( $thumb_id ) {
                            echo fx_get_image_tag( $thumb_id , 'img-responsive'); 
                        } else {
                            $generated_video_url = fx_generate_video_thumbnail( $video_link );
                            $alt                 = get_the_title();
                            echo '<img src="'. $generated_video_url .'" class="img-responsive" alt="'. $alt .'">'; 
                        }
                        
                    ?>
                    <?php if( $video_link ): ?>
                        <div class="play__wrapper">
                            <a href="<?php echo $video_link; ?>" data-fancybox>
                                <i class="icon-play-circle"></i>
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="featured-content">
                    <h5 class="h6-lg">Featured <?php echo fx_get_post_type_label(); ?></h5>
                    <h3><?php the_title(); ?></h3>
                    <div class="entry-content">
                        <?php 
                        echo mb_strimwidth( wp_strip_all_tags( get_field( 'short_description', get_the_ID() ) ), 0, 120, '...' ); ?>
                    </div>
                    <?php 

                        $primary_link       = get_field('call_to_action',get_the_ID() );

                        if( $primary_link ) {
                            echo sprintf(
                                '<a href="%s" target="%s" class="btn btn-tertiary">%s</a>',
                                $primary_link['url'],
                                $primary_link['target'] ? $primary_link['target'] : '_self',
                                $primary_link['title']
                            );
                        }

                    ?>
                </div>
            </div>
        <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>

    <div class="video-filter__wrapper">
        <div class="filter-action__wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="filter-label">
                        <label for="">Filter By:</label>
                    </div>
                    <div class="category-multiple__select">
                        <div class="select-cat js-toggled-cat">
                            Category <i class="icon-chevron-down"></i>
                        </div>
                        <div class="list__categories js-category-dropdown">
                            <ul>
                                <li>
                                    <a href="javascript:void(0)" term-name="all" term-id="0" class="all-categories">All</a>
                                </li>
                                <?php 
                                    $video_terms = get_terms(
                                        array(
                                            'taxonomy' => 'video-category',
                                            'hide_empty' => false,
                                        ) 
                                    );
                                    if( $video_terms ) {
                                        foreach( $video_terms as $term ) {
                                            if( $term->parent == 0 ){
                                ?>
                                                <li>
                                                    <a href="javascript:void(0)" term-name="<?php echo $term->slug; ?>" term-id="<?php echo $term->term_id; ?>">
                                                        <?php echo $term->name; ?>
                                                    </a>
                                                </li>
                                <?php
                                            }
                                        }
                                    }
                                ?>
                                
                            </ul>
                        </div>
                    </div>
                    <div class="sub-category-multiple__select">
                        <div class="sub-select-cat js-toggled-cat">
                            Sub-Category <i class="icon-chevron-down"></i>
                        </div>
                        <div class="list__sub-categories js-category-dropdown"><ul></ul></div>
                    </div>
                    <div class="storage-category__wrapper">
                        <div class="storage-category__list"></div>
                    </div>
                    <div class="clear-filters-mb">
                        <a href="javascript:void(0)" class="js-clear-filters">Clear filters</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="filter-list_wrapper">
            <div class="container-fluid">
                <div class="filter-listing js-filter-lists"></div>
            </div>
        </div>
    </div>

</section>