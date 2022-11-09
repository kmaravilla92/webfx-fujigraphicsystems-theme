<?php get_header(); ?>

<header class="masthead">
    <div class="container-fluid">
        <h1 class="masthead-title">Case Studies</h1>
        <?php
            if( function_exists( 'yoast_breadcrumb' ) ) {
                yoast_breadcrumb( '<div class="breadcrumbs hidden-sm-down">', '</div>' );
            }
        ?>
    </div>
</header>


<?php 
    $args = array(
        'post_type'         => 'case-study',
        'post_status'       => 'publish',
        'orderby'           => 'publish_date',
        'order'             => 'desc',
        'meta_query'        => array(
            array(
                'key'       => 'set_featured_post',
                'value'     => 1,
            )
        )
    );

    $get_posts = get_posts( $args );
    if( $get_posts ) {
        // Get post
        $featured_post = get_post( $get_posts[0]->ID );
    }

    if( have_posts() ): 
    
?>
    <section class="<?php echo get_post_type(); ?>-listing-container section-archive__wrapper js-load-more-block" data-load-more-post-type="<?php echo get_post_type(); ?>">
        <div class="container-fluid">   
            <div class="row">     
                <div id="post-listing-feature__wrapper" class="col-xs-12 col-md-9">
                    <?php if( $get_posts ): ?>
                    <div class="featured-item__wrapper">
                        <div class="featured-image">
                            <?php 
                                $thumb_id = get_post_thumbnail_id( $featured_post->ID );
                                if( ! get_post_thumbnail_id( $featured_post->ID ) ) {
                                    $thumb_id = get_field( 'placeholder_image', 'option' );
                                }
                                echo fx_get_image_tag( $thumb_id , 'img-responsive'); 
                            ?>
                        </div>
                        <div class="featured-content">
                            <h5 class="h6-lg">Featured Case Study</h5>
                            <h3><?php echo $featured_post->post_title; ?></h3>
                            <div class="entry-content">
                                <?php 
                                echo mb_strimwidth( wp_strip_all_tags( get_field( 'intro_text', $featured_post->ID ) ), 0, 120, '...' ); ?>
                            </div>
                            <a href="<?php echo get_permalink( $featured_post->ID ); ?>" class="btn btn-tertiary">READ FULL CASE STUDY</a>
                        </div>
                    </div>
                    <?php endif; ?>
                    <div class="<?php echo get_post_type(); ?>-listing archive-posts__wrapper js-load-more-posts">    
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
<?php else: ?>
    Sorry, we couldn't find any posts.
<?php endif; ?>

<div id="custom-flex-block__wrapper">
<?php fx_flexible_content_archives_tax('case_study_call_to_action__footer'); ?>
</div>

<?php 

get_footer(); 

?>