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

<section class="innerpage full-width-image-section">
    <div class="full-width__img">
        <?php echo fx_get_image_tag( get_field('image_background'), 'fw-img', 'full_width_background' ); ?>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-10 col-sm-push-1 col-lg-12 col-lg-push-0">
                <div class="full-width__text full-width__text-<?php echo get_field('switch_content_position'); ?>">
                    <?php echo apply_filters('acf_the_content', get_field('content') ); ?>
                </div>
            </div>
        </div>
    </div>
</section>