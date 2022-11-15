<?php 
    /**
     * Preview Block for Editor
     * Description: This will display the preview block on admin editor.
     * 
     * fx_preview_block_banner - 10
     * 
     */
    do_action('fx_preview_block');

    $categories     = get_field('case_study_category_filter');
    $taxonomy_posts = fx_get_posts_case_study( $categories );
?>

<section class="innerpage case-study-section <?php echo ( get_field('select_background') == 'white' ) ? 'white-bg': 'gray-bg'; ?>">
    <div class="container-fluid">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <?php 
                        echo get_field('headline') ? '<h2 class="hidden-lg">' . get_field('headline') . '</h2>' : '';
                        echo get_field('text') ? get_field('text') : '';
                    ?>
                </div>
            </div>

            <div class="cs-slider">
                <?php 
                    if( $taxonomy_posts ){ 
                        foreach( $taxonomy_posts as $post ){ 
                ?>
                            <div class="cs-slider-item">
                                <div class="row col-lg-5 col-lg-push-1">
                                    <div class="">
                                        <div class="cs-featured-img">
                                            <?php 
                                                echo fx_get_image_tag( get_field('product_image', $post['post_id']), 'img-responsive', 'cs_featured_img', true );
                                            ?>
                                        </div>
                                        <div class="cs-quote hidden-sm hidden-md">
                                            <p>
                                                <?php echo substr( get_field('case_study_testimonials', $post['post_id']), 0, 120 ); ?>
                                            </p>
                                            <span class="hidden-md-down"><?php echo get_field('company_name', $post['post_id']); ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row cs-content col-lg-5 col-lg-push-2">
                                    <div class="">
                                        <div class="cs-content__container">
                                            <div class="cs-quote hidden-xs-down col-sm-5 hidden-lg">
                                                <p><?php echo substr( get_field('case_study_testimonials', $post['post_id']), 0, 120 ); ?></p>
                                                <span class="hidden-md-down"><?php echo get_field('company_name', $post['post_id']); ?></span>
                                            </div>
                                            <div class="cs-text col-sm-7 col-lg-12">
                                                <?php echo get_field('headline') ? '<h2 class="hidden-md-down">' . get_field('headline') . '</h2>' : ''; ?>
                                                <h6><?php echo get_the_title( $post['post_id'] ); ?></h6>
                                                <div class="entry-content">
                                                    <?php echo apply_filters('acf_the_content', get_field('intro_text', $post['post_id']) ); ?>
                                                </div>
                                                <div class="cs-company-name hidden-lg">
                                                    <?php echo get_field('company_name', $post['post_id']); ?>
                                                    <span>
                                                        <?php
                                                            $category_detail = wp_get_post_terms($post['post_id'], 'case-study-category');
                                                            foreach( $category_detail as $cd ){
                                                                if( get_post_meta($post['post_id'], '_yoast_wpseo_primary_case-study-category',true) == $cd->term_id ) {
                                                                    echo $cd->name;
                                                                }
                                                            }
                                                        ?>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cs-buttons col-12">
                                            <a href="<?php echo get_permalink( $post['post_id'] ) ?>" class="btn btn-primary">Read Full Case Study</a>

                                            <?php 
                                                $demo_link = get_field('request_demo_link', $post['post_id']);
                                                if( !empty( $demo_link ) ) { ?>
                                                    <a class="btn btn-secondary" href="<?php echo $demo_link;?>">Request a live demo</a>
                                            <?php } ?>        

                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php   
                        }
                    } 
                ?>
            </div>
            
        <div class="row">
            <div class="innerpage-case-studies-nav hidden-md-down">
                <?php if( $taxonomy_posts ){ ?>
                    <div class="cs-slider-nav">
                        <?php 
                            foreach( $taxonomy_posts as $post ){ 
                        ?>
                            <div>
                                <?php 
                                    echo fx_get_image_tag( get_field('person_image', $post['post_id']), 'img-responsive', 'thumb_tabs', true );
                                ?>
                                <div class="cs-slider-nav__text">
                                    <p><?php echo get_field('company_name', $post['post_id']); ?></p>
                                    <span>
                                        <?php
                                            $category_detail = wp_get_post_terms($post['post_id'], 'case-study-category');
                                            foreach( $category_detail as $cd ){
                                                if( get_post_meta($post['post_id'], '_yoast_wpseo_primary_case-study-category',true) == $cd->term_id ) {
                                                    echo $cd->name;
                                                }
                                            }
                                        ?>
                                    </span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>
        </div>

    </div>

</section>