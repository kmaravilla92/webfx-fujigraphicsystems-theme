<?php get_header(); ?>

<?php get_template_part('partials/masthead'); ?>

<div class="container-fluid">

    <section class="imgbtns-404">
        <div class="">
            <h2>Explore one of these pages instead:</h2>
            <div class="">
                <?php 
                    $page_404_leads = get_field('page_404_leads', 'option');
                    if( $page_404_leads ) {
                        foreach( $page_404_leads as $lead ){
                ?>
                        <div class="col-sm-3">
                            <div class="image-buttons-item">
                                <a href="<?php echo $lead['link'] ? $lead['link'] : 'javascript:void(0)'; ?>">
                                    <div class="image-buttons-image-box">
                                        <?php  echo fx_get_image_tag( $lead['featured_image'], 'img-responsive' ); ?>
                                    </div>
                                    <div class="image-buttons-overlay">
                                        <div class="image-buttons-arrow">
                                            <span class="icon-long-arrow-alt-up"></span>
                                        </div>
                                        <h5><?php echo $lead['title']; ?></h5>
                                    </div>
                                </a>
                            </div>
                        </div>
                <?php
                        }
                    }
                ?>
            </div>
        </div>
    </section>

    <section class="links-404">
        <div class="">
            <div class="col-xxs-12 col-md-6">
                <div class="search-404">
                    <h4>Or, try searching our site:</h4>
                    <form action="" method="get">
                        <input type="text" name="s" id="s" value="" data-swplive="true" /> <!-- data-swplive="true" enables SearchWP Live Search -->
                        <button class="search-btn mobile-hview" type="submit">Search</button>
                        <div class="search-column mobile-dview">
                            <button type="submit"><i class="icon-magnify"></i></button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-xxs-12 col-md-6">
                <div class="contact-404 text-center">
                    <h4>Still can't find what you're looking for?</h4>
                    <a href="<?php echo get_field('contact_us_link', 'option'); ?>" class="btn">Contact Us Today!</a>
                </div>
            </div>
        </div>
    </section>

</div>

<?php get_footer(); 