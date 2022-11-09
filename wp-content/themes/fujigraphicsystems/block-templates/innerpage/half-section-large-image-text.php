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

<section class="innerpage innerpage-half-image-half-text">
    <div class="container-fluid">
        <?php 
            $text_image = get_field('large_image__text');
            if( $text_image ){
                foreach($text_image as $detail){
                $image_fit = $detail['image_option'];
                $switch_position = $detail['switch_display_position']; 
                if( $switch_position == 'right_switch' ) {
        ?>
                    <div class="half-image-half-text left-text-right-image clearfix box-<?php echo $image_fit; ?>">
                        <div class="half-text col-lg-6">
                            
                            <div class="entry-content">
                                <?php echo apply_filters('acf_the_content', $detail['content'] ); ?>
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
                        <div class="half-image col-lg-6 <?php echo $image_fit; ?>">
                            <?php 

                                if( $detail['image_or_video'] == 'image' || $detail['image_or_video'] == '' ) {
                                    if( $detail['featured_image'] ) {
                                        if( $detail['enable_image_lightbox'] == 'yes' ) {
                                            $image = fx_get_image_tag( $detail['featured_image'], 'img-responsive', 'innerpage_half_large_image' );
                                            echo sprintf(
                                                '<a href="%s" data-fancybox >%s</a>',
                                                wp_get_attachment_url( $detail['featured_image'] ),
                                                $image
                                            );
                                        } else {
                                            echo fx_get_image_tag( $detail['featured_image'], 'img-responsive', 'innerpage_half_large_image' );
                                        }
                                        
                                    }
                                }

                                if( $detail['image_or_video'] == 'video' ) {

                                    $generated_video_url = fx_generate_video_thumbnail( $detail['video_link'] );

                                    if( $detail['video_placeholder'] ) {
                                        $image = fx_get_image_tag( $detail['video_placeholder'], 'img-responsive', 'innerpage_half_large_image' );
                                    } else {
                                        $image = '<img src="'. $generated_video_url .'" class="img-responsive">'; 
                                    }

                                    $video_link = '#';
                                    $fancybox = '';
                                    $play_icon = '';
                                    
                                    if( $detail['video_link'] ) {
                                        $video_link = $detail['video_link'];
                                        $fancybox = "data-fancybox";
                                        $play_icon = '<i class="icon-play-circle"></i>';
                                    }

                                    echo sprintf(
                                            '<a href="%s" %s class="play-video-hslit">%s %s</a>',
                                            $video_link,
                                            $fancybox,
                                            $image,
                                            $play_icon
                                    );
                                    
                                }

                            ?>
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
                    <div class="half-image-half-text right-text-left-image clearfix box-<?php echo $image_fit; ?>">
                        <div class="half-text col-lg-6">
                        <?php

                            echo apply_filters('acf_the_content', $detail['content'] );

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
                        <div class="half-image col-lg-6 col-lg-pull-6 <?php echo $image_fit; ?>">

                            <?php 

                                if( $detail['image_or_video'] == 'image' || $detail['image_or_video'] == '' ) {
                                    if( $detail['featured_image'] ) {
                                        if( $detail['enable_image_lightbox'] == 'yes' ) {
                                            $image = fx_get_image_tag( $detail['featured_image'], 'img-responsive', 'innerpage_half_large_image' );
                                            echo sprintf(
                                                '<a href="%s" data-fancybox >%s</a>',
                                                wp_get_attachment_url( $detail['featured_image'] ),
                                                $image
                                            );
                                        } else {
                                            echo fx_get_image_tag( $detail['featured_image'], 'img-responsive', 'innerpage_half_large_image' );
                                        }
                                        
                                    }
                                }

                                if( $detail['image_or_video'] == 'video' ) {

                                    $generated_video_url = fx_generate_video_thumbnail( $detail['video_link'] );

                                    if( $detail['video_placeholder'] ) {
                                        $image = fx_get_image_tag( $detail['video_placeholder'], 'img-responsive', 'innerpage_half_large_image' );
                                    } else {
                                        $image = '<img src="'. $generated_video_url .'" class="img-responsive">'; 
                                    }

                                    $video_link = '#';
                                    $fancybox = '';
                                    $play_icon = '';

                                    if( $detail['video_link'] ) {
                                        $video_link = $detail['video_link'];
                                        $fancybox = "data-fancybox";
                                        $play_icon = '<i class="icon-play-circle"></i>';
                                    }

                                    echo sprintf(
                                            '<a href="%s" %s class="play-video-hslit">%s %s</a>',
                                            $video_link,
                                            $fancybox,
                                            $image,
                                            $play_icon
                                    );
                                    
                                }

                            ?>

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