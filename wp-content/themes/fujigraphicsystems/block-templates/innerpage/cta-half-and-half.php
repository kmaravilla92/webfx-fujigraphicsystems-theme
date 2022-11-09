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

<section class="cta-half-and-half">
    <div class="cta-half cta-half-blue">
        <?php 
            $left_cta = get_field('call_to_action_left');
            if( $left_cta ):
        ?>
            <div class="cta-half-content">
                <?php 
                    echo $left_cta['title'] ? '<h3>' . $left_cta['title'] . '</h3>' : '';    
                ?>
                <div class="entry-content">
                    <?php echo apply_filters('acf_the_content', $left_cta['content'] ); ?>
                </div>
                <?php 
                    $primary_link       = $left_cta['cta_link'];

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
        <?php endif; ?>
    </div>
    <div class="cta-half cta-half-dark">
        <?php 
            $right_cta = get_field('call_to_action_right'); 
            if( $right_cta ):
        ?>
            <div class="cta-half-content">
                <?php 
                    echo $right_cta['title'] ? '<h3>' . $right_cta['title'] . '</h3>' : '';    
                ?>
                <div class="entry-content">
                    <?php echo apply_filters('acf_the_content', $right_cta['content'] ); ?>
                </div>
                <?php 
                    $primary_link       = $right_cta['cta_link'];

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
        <?php endif; ?>
    </div>
    <div class="grid-image">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/grid-image.png" class="img-responsive" alt="">
    </div>
</section>