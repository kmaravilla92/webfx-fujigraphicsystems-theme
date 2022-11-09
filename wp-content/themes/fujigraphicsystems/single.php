<?php get_header(); ?>
<?php get_template_part('partials/masthead'); ?>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <section class="<?php echo get_post_type(); ?>-listing-container section-single__wrapper">
        <div class="container-fluid">   
            <div class="back-main__archive-page">
                <a class="btn btn-secondary-rev" href="<?php echo get_post_type_archive_link( get_post_type() ); ?>">
                    Main Page
                </a>
            </div>
            <div class="row">     
                <?php if( get_field('hero_image') ): ?>
                <div id="post-listing-feature__wrapper" class="col-xs-12">
                    <div class="<?php echo get_post_type(); ?>-listing ">    
                        <?php 
                                echo fx_get_image_tag( get_field('hero_image'), 'img-responsive single-post-thumbnail' );
                        ?>
                        <div class="post-meta__wrapper">
                            <div class="date">
                                <?php 

                                    the_date('F jS, Y'); 

                                    $category_detail = wp_get_post_terms( get_the_ID(), fx_get_taxonomy() );
                                    $ctr = 1;
                                    $count_cat = count( $category_detail );
                                    echo ( $count_cat > 0 ) ? ' | CATEGORY: ' : '';
                                    foreach( $category_detail as $cd ){
                                        // echo ;
                                        echo sprintf(
                                            '<span class="category"><a href="%s">%s</a></span>',
                                            get_term_link( $cd->term_id ),
                                            $cd->name
                                        );

                                        if( $ctr !== $count_cat ) {
                                            echo ', ';
                                        }
                                        $ctr++;
                                    }

                                ?> 
                            </div>
                        </div>
                    </div>
                    <?php endif;  ?>
                </div>      
            </div> 
        </div> 
        <div class="acf-blocks__wrapper">
            <?php the_content(); ?>
        </div>
    </section>
<?php endwhile; endif; ?>

<?php 

get_footer();