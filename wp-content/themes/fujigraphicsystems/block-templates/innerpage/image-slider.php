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

<section class="innerpage image-button-slider-section white-bg">
    <div class="container-fluid">
        <div class="">
            <div class="img-btn-slider-intro">
                <?php 
                    echo get_field('headline') ? '<h2>' . get_field('headline') . '</h2>' : '';
                ?>
                <p>
                    <?php echo get_field('intro_text'); ?> 
                    <?php 

                        $primary_link       = get_field('call_to_action');

                        if( $primary_link ) {
                            echo sprintf(
                                ' <a href="%s" target="%s" class="btn btn-secondary hidden-sm-down">%s</a>',
                                $primary_link['url'],
                                $primary_link['target'] ? $primary_link['target'] : '_self',
                                $primary_link['title']
                            );
                        }

                    ?> 
                </p>
                <?php 

                    $primary_link       = get_field('call_to_action');

                    if( $primary_link ) {
                        echo sprintf(
                            ' <a href="%s" target="%s" class="btn btn-secondary hidden-md-up">%s</a>',
                            $primary_link['url'],
                            $primary_link['target'] ? $primary_link['target'] : '_self',
                            $primary_link['title']
                        );
                    }

                ?> 
            </div>
        </div>

        <?php 
            $image_btns = get_field('image_buttons');
            if( $image_btns ):
        ?>
                    
        <div class="row hidden-xs-down">
            <div class="">
                <div class="img-btn-nav-slider">
                    <?php 
                        foreach( $image_btns as $btn ):
                    ?>
                        <div class="img-btn-nav-slide-container">
                            <div class="img-btn-nav-slide">
                                <div class="img-btn-nav-image">
                                    <?php
                                        echo fx_get_image_tag( $btn['the_image_button'], 'img-responsive' );
                                    ?>
                                </div>
                                <p><?php echo $btn['image_title']; ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!--End slider nav-->
        <div class="row">
            <div class="col-12">
                <div class="img-btn-slider">
                    <?php foreach( $image_btns as $btn ): ?>
                        <div class="img-btn-slide">
                            <?php 
                                $class = 'style="width:100%"';
                                if( $btn['product_image'] ){
                                $class = '';
                            ?>
                                <div class="img-btn-image">
                                    <?php
                                        echo fx_get_image_tag( $btn['product_image'], 'img-responsive', 'img_slider_product', false );
                                    ?>
                                </div>

                                <?php } ?>

                                <div class="img-btn-content" <?php echo $class; ?>>
                                    <?php echo apply_filters('acf_the_content', $btn['product_content'] ); ?>
                                </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <?php endif; ?>

    </div>
</section>