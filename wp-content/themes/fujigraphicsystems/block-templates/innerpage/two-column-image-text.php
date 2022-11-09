<?php 
    /**
     * Preview Block for Editor
     * Description: This will display the preview block on admin editor.
     * 
     * fx_preview_block_banner - 10
     * 
     */
    do_action('fx_preview_block');

    $first_image_option  = get_field('first_image_option');
    $second_image_option = get_field('secondary_image_option');
?>

<section class="innerpage two-column">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 two-column_container">
                <div class="two-column__img">
                    <?php 
                        echo fx_get_image_tag( get_field('first_featured_image'), 'fw-img '.$first_image_option, 'two_col_image' );
                    ?>
                </div>
                <div class="two-column__text">
                    <div class="entry-content">
                        <?php echo apply_filters('acf_the_content', get_field('first_content') ); ?>
                    </div>
                    <?php 
                        
                        $primary_link       = get_field('first_cta_primary');
                        $secondary_link     = get_field('first_cta_secondary');

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
                                '<a href="%s" target="%s" class="btn btn-secondary">%s</a>',
                                $secondary_link['url'],
                                $secondary_link['target'] ? $secondary_link['target'] : '_self',
                                $secondary_link['title']
                            );
                        }

                    ?> 
                </div>
            </div>
            <!--start col 2-->
            <div class="col-lg-6 two-column_container">
                <div class="two-column__img">
                    <?php 
                        echo fx_get_image_tag( get_field('secondary_featured_image'), 'fw-img' .$second_image_option, 'two_col_image' );
                    ?>
                </div>
                <div class="two-column__text">
                    <div class="entry-content">
                        <?php echo apply_filters('acf_the_content', get_field('secondary_content') ); ?>
                    </div>
                    <?php 
                    
                        $primary_link       = get_field('secondary_cta_primary');
                        $secondary_link     = get_field('cta_secondary');

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
                                '<a href="%s" target="%s" class="btn btn-secondary">%s</a>',
                                $secondary_link['url'],
                                $secondary_link['target'] ? $secondary_link['target'] : '_self',
                                $secondary_link['title']
                            );
                        }

                    ?> 
                </div>
            </div>
        </div>
    </div>
</section>