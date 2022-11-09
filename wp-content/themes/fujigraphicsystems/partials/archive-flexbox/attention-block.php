<section class="innerpage attention-block <?php echo get_sub_field('select_background','option'); ?>-bg">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="attention-block__container">
                    <div class="attention-block__text">
                        <?php echo apply_filters('acf_the_content', get_sub_field('attention_block_content') ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>