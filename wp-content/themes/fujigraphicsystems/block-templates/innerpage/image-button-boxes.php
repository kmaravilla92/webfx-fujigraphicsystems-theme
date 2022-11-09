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

<section class="innerpage image-buttons white-bg">
    <div class="container-fluid">
        <div class="image-buttons-header">
            <?php 
                echo get_field('headline') ? '<h2>' . get_field('headline') . '</h2>' : '';    
            ?>
            <div class="entry-content">
                <?php echo apply_filters('acf_the_content', get_field('content')); ?>
            </div>
        </div>
        <div class="row">
            <?php 
                $image_buttons = get_field('images_w_description');
                if( $image_buttons ){
                    foreach( $image_buttons as $img ){
                        $cta_link = $img['call_to_action'];
            ?>
                    <div class="col-sm-4">
                        <div class="image-buttons-item">
                            <?php if( $cta_link ){ ?>
                                <a href="<?php echo $cta_link['url']; ?>" target="<?php echo $cta_link['target'] ? $cta_link['target'] : '_self' ?>" alt="<?php echo $cta_link['title'] ?>">
                            <?php }else{
                                echo '<a href="">';
                            } ?>
                                <div class="image-buttons-image-box">
                                    <?php
                                        echo fx_get_image_tag( $img['featured_image'], 'img-responsive', 'button_boxes' );
                                    ?>
                                </div>
                                <div class="image-buttons-overlay">
                                    <div class="image-buttons-arrow">
                                        <span class="icon-long-arrow-alt-up"></span>
                                    </div>
                                    <h5><?php echo $img['title']; ?></h5>
                                    <div class="image-buttons-hoverable-content">
                                        <p><?php echo $img['description']; ?></p>
                                        <?php
                                            if( $cta_link ) {
                                                echo sprintf(
                                                    '<div class="btn btn-primary">%s</div>',
                                                    $cta_link['title']
                                                );
                                            }
                                        ?> 
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
            <?php
                    } 
                } 
            ?>
        </div>
        <?php 
            $primary_link       = get_field('cta_primary');
            $cta_tertiary     = get_field('cta_tertiary');

            if( $primary_link ) {
                echo sprintf(
                    '<a href="%s" target="%s" class="btn btn-primary">%s</a>',
                    $primary_link['url'],
                    $primary_link['target'] ? $primary_link['target'] : '_self',
                    $primary_link['title']
                );
            }

            if( $cta_tertiary ) {
                echo sprintf(
                    '<a href="%s" target="%s" class="btn btn-secondary">%s</a>',
                    $cta_tertiary['url'],
                    $cta_tertiary['target'] ? $cta_tertiary['target'] : '_self',
                    $cta_tertiary['title']
                );
            }

        ?> 
    </div>
</section>