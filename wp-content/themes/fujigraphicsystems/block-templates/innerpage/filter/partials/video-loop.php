<?php 
    while ( $args['video']->have_posts() ) : $args['video']->the_post(); 
    $video_link     = get_field('video_link', get_the_ID() );
    $video_thumb    = get_field('video_thumbnail', get_the_ID() );
    $heading        = get_field('heading', get_the_ID() );
    $short_desc     = get_field('short_description', get_the_ID() );
?>
        <div class="video-loop__item">
            <a class="video-slider-item" href="<?php echo $video_link; ?>" data-fancybox="video-gallery-loop" >
                <div class="video-slider-image" data-mh="same-height-image">
                    <?php 
                        if( $video_thumb ) {
                            echo fx_get_image_tag( $video_thumb, 'img-responsive' );
                        } else {
                            $generated_video_url = fx_generate_video_thumbnail( $video_link );
                            $alt                 = get_the_title();
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
                    <h6><?php echo $heading; ?></h6>
                    <h3><?php echo get_the_title(); ?></h3>
                </div>
            </a>
        </div>
<?php endwhile; ?>