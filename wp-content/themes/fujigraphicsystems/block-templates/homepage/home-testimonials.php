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

<section class="homepage-testimonials">
    <div class="testimonials-angle">
        <img src="<?php echo get_template_directory_uri() ?>/assets/img/angle.png" class="img-responsive" alt="">
    </div>
    <div class="container-fluid">
        <div class="section-title">
            <?php 
                echo $section_title  = get_field('section_title') ? '<h4>' . get_field('section_title') . '</h4>' : ''; 
                echo $headline       = get_field('headline') ? '<h2>' . get_field('headline') . '</h2>' : ''; 
            ?>
        </div>
    </div>
    <?php 
        $args = array(
            'post_type'         => 'testimonial',
            'posts_per_page'    => -1,
            'meta_query'        => array(
                array(
                    'key'       => 'featured',
                    'value'     => true
                )
            )
        );

        $testimonials = get_posts( $args );
    ?>
    <div class="homepage-testimonials-wrapper clearfix">
        <div class="homepage-testimonials-wrapper-banner hidden-md-down">
            <div class="testimonial-img-slider">
                <?php 
                    if( $testimonials ): 
                        foreach( $testimonials as $testimonial ):
                        $product_image = get_field('product_image', $testimonial->ID );
                ?>
                        <div>
                            <?php echo fx_get_image_tag( $product_image, 'img-responsive', 'testimonial_banner', false ); ?>
                        </div>
                <?php 
                        endforeach;
                    endif; 
                ?>
            </div>
        </div>
        <div class="homepage-testimonials-right">
            <div class="testimonilas-slider">
                <?php 
                    if( $testimonials ): 
                        foreach( $testimonials as $testimonial ):
                            $post_thumbnail = get_post_thumbnail_id( $testimonial->ID );
                ?>
                        <div class="testimonilas-slider-item">
                            <div class="testimonilas-slider-image">
                                <?php echo fx_get_image_tag( $post_thumbnail, 'img-responsive', 'testimonial_photo', false ); ?>
                            </div>
                            <div class="testimonilas-slider-content">
                                <div class="entry-content">
                                    <?php 
                                        $content = wp_strip_all_tags( get_field('testimonial_content', $testimonial->ID ) );
                                        $trimmed = mb_strimwidth( $content, 0, 160, '...' );
                                    ?>
                                    <p><?php echo $trimmed; ?></p>
                                </div>
                                <div class="testimonilas-profile-info">
                                    <h5><?php echo get_field('client_name', $testimonial->ID ); ?></h5>
                                    <p><?php echo get_field('location', $testimonial->ID ); ?></p>
                                </div>
                            </div>
                        </div>
                <?php 
                        endforeach;
                    endif; 
                ?>
            </div>
            <div class="homepage-testimonials-button">
                <?php 
                    $primary_link       = get_field('cta_primary');
                    $secondary_link     = get_field('cta_secondary' );

                    if( $primary_link ) {
                        echo sprintf(
                            '<a href="%s" target="%s" class="btn btn-primary">%s</a>',
                            $primary_link['url'],
                            $primary_link['target'] ? $primary_link['target'] : '_self',
                            $primary_link['title']
                        );
                    }

                    if( $secondary_link ) {

                        echo sprintf(
                            '<a href="%s" target="%s" class="btn btn-secondary hidden-md-down">%s</a>',
                            $secondary_link['url'],
                            $secondary_link['target'] ? $primary_link['target'] : '_self',
                            $secondary_link['title']
                        );

                        echo sprintf(
                            '<a href="%s" target="%s" class="btn btn-secondary hidden-xs-down hidden-lg">%s</a>',
                            $secondary_link['url'],
                            $secondary_link['target'] ? $primary_link['target'] : '_self',
                            $secondary_link['title']
                        );

                        echo sprintf(
                            '<a href="%s" target="%s" class="btn btn-secondary hidden-sm-up">%s</a>',
                            $secondary_link['url'],
                            $secondary_link['target'] ? $primary_link['target'] : '_self',
                            $secondary_link['title']
                        );
                        
                    }

                ?>
            </div>
        </div>
    </div>
</section>