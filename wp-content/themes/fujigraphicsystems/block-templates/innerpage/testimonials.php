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

<section class="innerpage innerpage-testimonials">
    <div class="container-fluid ">
        <div class="innerpage-testimonials-container">
            <h5 class="h6-lg">Testimonials</h5>
            <?php echo get_field('headline') ? '<h2>' . get_field('headline') . '</h2>' : ''; ?>

            <?php 
                $term_testimonials = get_field('testimonials_category');
                $testimonials      = fx_get_testimonial_posts_term( $term_testimonials );
                if( $testimonials ):
            ?>
                <div class="innerpage-testimonials-slider">
                    <?php foreach( $testimonials as $testimonial ): ?>
                        <div class="innerpage-testimonials-slider-item">
                            
                            <div class="innerpage-testimonials-slider-content">
                                <div class="desktop-testimonial__content">
                                    <?php 
                                        $content = wp_strip_all_tags( get_field('testimonial_content', $testimonial->ID ) );
                                    ?>
                                    <p><?php echo $content; ?></p>
                                </div>
                                <div class="mobile-testimonial__content">
                                    <?php echo apply_filters('acf_the_content', get_field('testimonial_content', $testimonial->ID) ); ?>
                                </div>
                                <div class="innerpage-testimonial-profile">
                                    <div class="innerpage-testimonials-slider-image">
                                        <?php echo fx_get_image_tag( get_post_thumbnail_id( $testimonial->ID ), 'img-responsive', 'testimonial_innerpage_person' ); ?>
                                    </div>
                                    <div class="innerpage-testimonials-profile-info">
                                        <h5><?php echo get_field('client_name', $testimonial->ID ); ?></h5>
                                        <p><?php echo get_field('location', $testimonial->ID); ?></p>
                                    </div>
                                </div>
                            </div>

                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>