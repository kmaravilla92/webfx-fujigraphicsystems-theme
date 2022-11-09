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

<section class="innerpage innerpage-half-image-half-text text-overlap">
    <div class="container-fluid">
        <?php 
            $text_image = get_field('image_and_text_overlap');
            if( $text_image ){
                foreach($text_image as $detail){
                $switch_position = $detail['switch_display_position']; 
                if( $switch_position == 'right_switch' ) {
        ?>
                    <div class="half-image-half-text right-text-left-image clearfix">
                        <div class="half-text ">
                            <?php 
                                echo $detail['section_title'] ? '<h5 class="h6-lg">' . $detail['section_title'] . '</h5>' : '';
                            ?>
                            <div class="entry-content">
                                <?php echo apply_filters('acf_the_content', $detail['content']); ?>
                            </div>
                            
                            <?php 
                                $primary_link       = $detail['cta_primary'];
                                $secondary_link     = $detail['cta_secondary'];

                                if( $primary_link ) {
                                    echo sprintf(
                                        '<a href="%s" target="%s" class="btn btn-primary hidden-xs-down">%s</a>',
                                        $primary_link['url'],
                                        $primary_link['target'] ? $primary_link['target'] : '_self',
                                        $primary_link['title']
                                    );
                                }

                                if( $secondary_link ) {
                                    echo sprintf(
                                        '<a href="%s" target="%s" class="btn btn-secondary hidden-xs-down">%s</a>',
                                        $secondary_link['url'],
                                        $secondary_link['target'] ? $secondary_link['target'] : '_self',
                                        $secondary_link['title']
                                    );
                                }
                            ?>
                        </div>
                        <div class="half-image">
                            <?php echo fx_get_image_tag( $detail['featured_image'], 'img-responsive', 'innerpage_half_image_text_overlap' ); ?>
                        </div>
                        <?php 
                            $primary_link       = $detail['cta_primary'];
                            $secondary_link     = $detail['cta_secondary'];

                            if( $primary_link ) {
                                echo sprintf(
                                    '<a href="%s" target="%s" class="btn btn-primary hidden-sm-up">%s</a>',
                                    $primary_link['url'],
                                    $primary_link['target'] ? $primary_link['target'] : '_self',
                                    $primary_link['title']
                                );
                            }

                            if( $secondary_link ) {
                                echo sprintf(
                                    '<a href="%s" target="%s" class="btn btn-secondary hidden-sm-up">%s</a>',
                                    $secondary_link['url'],
                                    $secondary_link['target'] ? $secondary_link['target'] : '_self',
                                    $secondary_link['title']
                                );
                            }
                        ?> 
                    </div>
            <?php 
                } else { 
            ?>
                    <div class="half-image-half-text left-text-right-image clearfix">
                        <div class="half-text ">
                        <?php 
                                echo $detail['section_title'] ? '<h5 class="h6-lg">' . $detail['section_title'] . '</h5>' : '';
                            ?>
                            <div class="entry-content">
                                <?php echo apply_filters('acf_the_content', $detail['content']); ?>
                            </div>
                            <!-- <button onclick="toggleText()" id="textButton" class="btn-read-more">Read More</button> -->
                            <?php 
                                $primary_link       = $detail['cta_primary'];
                                $secondary_link     = $detail['cta_secondary'];

                                if( $primary_link ) {
                                    echo sprintf(
                                        '<a href="%s" target="%s" class="btn btn-primary hidden-xs-down">%s</a>',
                                        $primary_link['url'],
                                        $primary_link['target'] ? $primary_link['target'] : '_self',
                                        $primary_link['title']
                                    );
                                }

                                if( $secondary_link ) {
                                    echo sprintf(
                                        '<a href="%s" target="%s" class="btn btn-secondary hidden-xs-down">%s</a>',
                                        $secondary_link['url'],
                                        $secondary_link['target'] ? $secondary_link['target'] : '_self',
                                        $secondary_link['title']
                                    );
                                }
                            ?>
                        </div>
                        <div class="half-image">
                            <?php echo fx_get_image_tag( $detail['featured_image'], 'img-responsive', 'innerpage_half_image_text_overlap' ); ?>
                        </div>
                        <?php 
                            $primary_link       = $detail['cta_primary'];
                            $secondary_link     = $detail['cta_secondary'];

                            if( $primary_link ) {
                                echo sprintf(
                                    '<a href="%s" target="%s" class="btn btn-primary hidden-sm-up">%s</a>',
                                    $primary_link['url'],
                                    $primary_link['target'] ? $primary_link['target'] : '_self',
                                    $primary_link['title']
                                );
                            }

                            if( $secondary_link ) {
                                echo sprintf(
                                    '<a href="%s" target="%s" class="btn btn-secondary hidden-sm-up">%s</a>',
                                    $secondary_link['url'],
                                    $secondary_link['target'] ? $secondary_link['target'] : '_self',
                                    $secondary_link['title']
                                );
                            }
                        ?> 
                    </div>
        <?php 
                    }
                }
            } 
        ?>

    </div>
</section>