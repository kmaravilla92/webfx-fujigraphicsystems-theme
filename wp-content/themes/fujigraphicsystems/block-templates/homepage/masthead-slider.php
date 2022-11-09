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


<?php if( have_rows( 'slides' ) ): ?>
    <section class="homepage-masthead js-masthead-homepage-slider">
        <?php $skip_lazy = true;
        while( have_rows( 'slides' ) ): the_row(); 
            
            $link           = get_sub_field('button');
            $link_url       = 'javascript:void(0);';
            $link_title     = '';
            
            if( $link ) {
                $link_url       = $link['url'];
                $link_title     = $link['title'];
                $link_target    = $link['target'] ? $link['target'] : '_self';;
            }

        ?>
            <div class="banner-slider__wrapper">
                <div class="homepage-masthead-banner-image">
                    <a href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>">
                        <?php echo fx_get_image_tag( get_sub_field( 'background_image' ), 'img-responsive hidden-sm-down', 'masthead_desktop', $skip_lazy ); ?>
                        <?php echo fx_get_image_tag( get_sub_field( 'background_image' ), 'hidden-xs-down hidden-md-up', 'masthead_tab', $skip_lazy ); ?>
                        <?php echo fx_get_image_tag( get_sub_field( 'background_image' ), 'img-responsive hidden-sm-up', 'masthead_mobile', $skip_lazy ); ?>
                    </a>
                </div>
                <div class="homepage-masthead-banner-overlay">
                    <div class="container-fluid">
                        <div class="homepage-masthead-banner-content" data-mh="banner-height">
                            <?php echo $heading      = get_sub_field('headline') ? '<h4>' . get_sub_field('headline') . '</h4>' : ''; ?>
                            <?php echo $banner_title = get_sub_field('banner_title') ? '<h1 class="homepage-masthead--title">' . get_sub_field('banner_title') . '</h1>' : ''; ?>
                            <?php if($link): ?>
                                <a href="<?php echo $link_url; ?>" target="<?php echo $link_target; ?>" class="btn btn-primary">
                                    <?php echo $link_title; ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php $skip_lazy = false;
        endwhile; ?>
    </section>
<?php endif; ?>
