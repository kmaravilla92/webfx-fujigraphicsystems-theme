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

<section class="innerpage attention-block <?php echo get_field('select_background'); ?>-bg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="attention-block__container">
                    <div class="attention-block__text">
                        <?php echo apply_filters('acf_the_content', get_field('attention_block_content') ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>