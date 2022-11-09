<?php get_header(); ?>

<?php get_template_part('partials/masthead'); ?>

<?php $pagination = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1; ?>
<?php if ( 1 === $pagination ) : // Only show Featured post on first page of posts ?>
    <?php
        $featured_post_query = new WP_Query(
            [
                'posts_per_page' => 1,
                'meta_key'       => 'post_featured',
                'meta_value'     => '1',
            ] 
        );
    ?>
    
<?php endif; ?>

<?php if( have_posts() ): ?>
    <section class="<?php echo get_post_type(); ?>-listing-container section-archive__wrapper js-load-more-block" data-load-more-post-type="<?php echo get_post_type(); ?>">
        <div class="container-fluid">   
            <div class="row">     
                <div id="post-listing-feature__wrapper" class="col-xs-12 col-md-9">
                    <?php if ( $featured_post_query->have_posts() ) : while ( $featured_post_query->have_posts() ) : $featured_post_query->the_post(); ?>
                        <div class="featured-item__wrapper">
                            <div class="featured-image">
                                <?php 
                                    $thumb_id = get_post_thumbnail_id( get_the_ID() );
                                    if( ! $thumb_id ) {
                                        $thumb_id = get_field( 'placeholder_image', 'option' );
                                    }
                                    echo fx_get_image_tag( $thumb_id , 'img-responsive'); 
                                ?>
                            </div>
                            <div class="featured-content">
                                <h5 class="h6-lg">Featured <?php echo fx_get_post_type_label(); ?></h5>
                                <h3><?php the_title(); ?></h3>
                                <div class="entry-content">
                                    <?php 
                                    echo mb_strimwidth( wp_strip_all_tags( get_field( 'intro_text', get_the_ID() ) ), 0, 120, '...' ); ?>
                                </div>
                                <a href="<?php echo get_permalink( get_the_ID() ); ?>" class="btn btn-tertiary">READ FULL <?php echo fx_get_post_type_label(); ?></a>
                            </div>
                        </div>
                    <?php endwhile; endif; wp_reset_postdata(); ?>
                    
                    <div class="<?php echo get_post_type(); ?>-listing <?php echo ( $featured_post_query->have_posts() ) ? 'archive-posts__wrapper' : ''; ?> js-load-more-posts">    
                        <?php while( have_posts() ): the_post(); ?>
                            <?php get_template_part( 'partials/loop-content' ); ?>
                        <?php endwhile; ?>
                    </div>
                    <div class="<?php echo get_post_type(); ?>-listing__pagination text-center pagination__wrapper">
                        <div class="col-xxs-12">
                            <?php get_template_part( 'partials/pagination' ); ?> 
                        </div>
                    </div>  
                </div>      
                <div class="col-xs-12 col-md-3">
                    <?php get_sidebar(); ?>
                </div>
            </div> 
        </div> 
    </section>
<?php endif; ?>

<div id="custom-flex-block__wrapper">
    <?php fx_flexible_content_archives_tax('blog_call_to_action__footer'); ?>
</div>
<?php 
    
    get_footer(); 

?>