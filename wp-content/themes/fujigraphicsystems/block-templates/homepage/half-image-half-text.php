<?php 
    /**
     * Preview Block for Editor
     * Description: This will display the preview block on admin editor.
     * 
     * fx_preview_block_banner - 10
     * 
     */
    do_action('fx_preview_block');
?>


<section class="homepage-half-image-half-text">
    <?php 
        $switch_position = get_field('switch_display_position');
        if( $switch_position == 'right_switch' ) {
            $position = 'half-image-half-text left-text-right-image clearfix';
        } else {
            $position = 'half-image-half-text right-text-left-image clearfix';
        }
    ?>
    <div class="<?php echo $position; ?>">
        <div class="half-text">
            <?php 
            
                echo get_field('section_title') ? '<h5>' . get_field('section_title') . '</h5>' : '';
                echo get_field('headline') ? '<h2>' . get_field('headline') . '</h2>' : ''; 
            ?>

            <div class="entry-content">
                <?php
                    echo apply_filters('acf_the_content', get_field('content') );
                ?>
            </div>

            <?php 
                $primary_link       = get_field('cta_primary');
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

                    // echo sprintf(
                    //     '<a href="%s" target="%s" class="btn btn-tertiary hidden-md-up">%s</a>',
                    //     $secondary_link['url'],
                    //     $secondary_link['target'] ? $secondary_link['target'] : '_self',
                    //     $secondary_link['title']
                    // );
                }
            ?>

        </div>
        <div class="half-image">
            <?php echo fx_get_image_tag( get_field( 'featured_image' ), 'img-responsive', 'half_image_half_content', false ); ?>
        </div>
    </div>

    <?php 
        /**
         * Intended for multiple 50/50 image and content
         */
    ?>

    <?php 
        $multitple_rows = get_field('add_half_image_half_text');

        if( $multitple_rows ):
            
            foreach( $multitple_rows as $row ):

            $switch_position = $row['switch_display_position'];
            if( $switch_position == 'right_switch' ) {
                $position = 'half-image-half-text left-text-right-image clearfix';
            } else {
                $position = 'half-image-half-text right-text-left-image clearfix';
            }
    ?>
        <div class="<?php echo $position; ?>">
            <div class="half-text">
                <?php 
                    echo $row['section_title'] ? '<h5>' . $row['section_title'] . '</h5>' : '';
                    echo $row['headline'] ? '<h2>' . $row['headline'] . '</h2>' : ''; 
                ?>

                <div class="entry-content">
                    <?php echo apply_filters('acf_the_content', $row['content'] ); ?>
                </div>

                <?php 
                    $primary_link       = $row['cta_primary'];
                    $secondary_link     = $row['cta_secondary'];

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

                        // echo sprintf(
                        //     '<a href="%s" target="%s" class="btn btn-tertiary hidden-md-up">%s</a>',
                        //     $secondary_link['url'],
                        //     $secondary_link['target'] ? $secondary_link['target'] : '_self',
                        //     $secondary_link['title']
                        // );
                    }
                ?>

            </div>
            <div class="half-image">
                <?php echo fx_get_image_tag( $row['featured_image'], 'img-responsive', 'half_image_half_content', false ); ?>
            </div>
        </div>

    <?php endforeach; 
    endif; ?>
    
</section>