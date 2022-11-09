<?php 
    /**
     * Preview Block for Editor
     * Description: This will display the preview block on admin editor.
     * 
     * fx_preview_block_banner - 10
     * 
     */
    do_action('fx_preview_block');

    $section_bg = get_field('section_bg') ? get_field('section_bg') : 'gray-bg';
?>

<section class="innerpage tab-section <?php echo $section_bg; ?> ">
    <div class="container-fluid">
        <div class="">
            <div class="col-md-12">
                <div class="tab-section__intro">
                    <?php echo get_field('headline') ? '<h2>' . get_field('headline') . '</h2>' : ''; ?>

                    <div class="entry-content">
                        <?php echo apply_filters('acf_the_content', get_field('content') ); ?>
                    </div>

                </div>
                    
                <section class="tab-accordion js-tab-accordion">
                    <?php 
                        $accordion_tabs = get_field('tabs');
                        if( $accordion_tabs ):
                    ?>
                        <div class="tab-accordion__tabs hidden-sm-down">
                            <?php
                                $ctr = 1; 
                                foreach( $accordion_tabs as $tab ): 
                            ?>
                                <button class="tab-accordion__tab js-tab-accordion-btn <?php echo ( $ctr == 1 ) ? 'is-active' : ''; ?>" type="button" data-tab-id="<?php echo $ctr; ?>">
                                    <?php 
                                        echo fx_get_image_tag( $tab['tab_thumbnail'], 'tab__thumbnail', 'thumb_tabs', false ); 
                                    ?>
                                    <h6><?php echo $tab['tab_name']; ?></h6>
                                </button>
                                
                            <?php $ctr++; endforeach; ?>
                        </div>

                        <div class="row">
                            <div class="tab-accordion__panels col-lg-10 col-lg-push-1">
                                <?php
                                    $ctr = 1; 
                                    foreach( $accordion_tabs as $tab ): 
                                ?>
                                    <article class="tab-accordion__panel js-tab-accordion-panel <?php echo ( $ctr == 1 ) ? 'is-active' : ''; ?>" data-tab-id="<?php echo $ctr; ?>">

                                        <button class="tab-accordion__panel__toggle js-tab-accordion-btn hidden-md-up <?php echo ( $ctr == 1 ) ? 'is-active' : ''; ?>" type="button" data-tab-id="<?php echo $ctr; ?>">
                                        
                                            <!-- Wrapping thumbnail div in outer div for flex (to group ::before with the thumbnail as same flex child) -->
                                            <div>
                                                <div class="tab__thumbnail">
                                                    <?php 
                                                        echo fx_get_image_tag( $tab['tab_thumbnail'], '', 'thumb_tabs', false ); 
                                                    ?>
                                                </div>
                                            </div>
                                            <h6><?php echo $tab['tab_name']; ?></h6>

                                        </button>

                                        <div class="tab-accordion__panel__content ">
                                            <div class="row">
                                                <?php 
                                                    $class = "col-md-12";
                                                    if( $tab['tab_content_featured_image'] ):
                                                    $class = "col-md-6 col-md-pull-6";
                                                ?>
                                                    <div class="col-md-6 col-md-push-6">
                                                        <?php 
                                                            echo fx_get_image_tag( $tab['tab_content_featured_image'], 'img-responsive', 'tab_content_featured_image', false ); 
                                                        ?>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="<?php echo $class; ?>">
                                                    <?php echo apply_filters('acf_the_content', $tab['tab_content'] ) ?>
                                                </div>
                                            </div>
                                        </div>

                                    </article>

                                <?php $ctr++; endforeach; ?>

                            </div>
                        </div>

                    <?php endif; ?>

                </section>

            </div>
        </div>
    </div>
</section>