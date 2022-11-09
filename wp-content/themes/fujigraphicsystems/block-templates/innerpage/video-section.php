<?php 
    /**
     * Preview Block for Editor
     * Description: This will display the preview block on admin editor.
     * 
     * fx_preview_block_banner - 10
     * 
     */
    do_action('fx_preview_block');

    $videos = get_field('video_gallery');
?>
<?php if( isset( $videos ) ): ?>
<section class="innerpage video-section white-bg ">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php 
                    echo get_field('headline') ? '<h2 class="section-title">' . get_field('headline') . '</h2>' : '';
                ?>
                <div class="video-section__content">
                    <div class="entry-content">
                    <?php 
                        echo apply_filters('acf_the_content', get_field('content'));
                    ?>
                    </div>
                </div>
                <div class="innerpage-video-wrapper clearfix">
                    <?php 
                        $block_video    = get_field('video_gallery');
                        if( $block_video ):
                    ?>
                        <div class="video-slider">
                            <?php 
                                foreach( $block_video as $video ):
                            ?>
                                <a class="video-slider-item" href="<?php echo $video['video_link']; ?>" data-fancybox >
                                    <div class="video-slider-image" >
                                        <?php 
                                            if( $video['featured_image'] ) {
                                                echo fx_get_image_tag( $video['featured_image'], 'img-responsive' );
                                            } else {
                                                $generated_video_url = fx_generate_video_thumbnail( $video['video_link'] );
                                                $alt                 = $video['heading'];
                                                echo '<img src="'. $generated_video_url .'" class="img-responsive" alt="'. $alt .'">'; 
                                            }
                                        ?>
                                    </div>
                                    <button class="btn btn-primary video-play-button">
                                        <img class="icon-play" src="<?php echo get_template_directory_uri(); ?>/assets/img/svg/video-play-icon.svg">
                                            <div class="hidden-md-down watch-now">
                                                Watch Now
                                            </div>
                                    </button>
                                    <div class="video-slider-content">
                                        <h6><?php echo $video['title']; ?></h6>
                                        <h3><?php echo $video['heading']; ?></h3>
                                    </div>
                                </a>
                            <?php
                                endforeach; 
                            ?>
                        </div>
                    <?php endif; ?>
                    <div class="innerpage-videos-button">
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
                            }

                        ?> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>