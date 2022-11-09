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

<section class="innerpage cta-full-width blue-bg rainbow-<?php echo get_field('disable_border'); ?>">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-8 col-lg-push-2">
                <div class="entry-content">
                    <?php echo apply_filters('acf_the_content', get_field('full_width_cta_content') ); ?>
                </div>
            </div>
        </div>
    </div>
</section>