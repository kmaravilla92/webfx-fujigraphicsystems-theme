     <!-- page footer -->
     <?php
        // gets client logo image set in Theme Settings
        $logo_id    = fx_get_client_logo_image_id(); 
        $home_url   = get_home_url();
    ?>
    <?php 
        if( is_single() ){
    ?>
        <div class="footer-archive__wrapper">
            <a class="btn btn-primary" href="<?php echo get_post_type_archive_link( get_post_type() ); ?>">
                <i class="icon-long-arrow-alt-left"></i> Main Page
            </a>
        </div>
    <?php
        }
    ?>
    <footer class="page-footer" id="page-footer">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="footer-logo">
                                <a href="<?php echo $home_url; ?>">
                                    <?php echo fx_get_image_tag( $logo_id, 'img-responsive',  ); ?>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="footer-box">
                                <h6>Social</h6>
                                <div class="social-icon">
                                    <a href="<?php echo get_field('facebook','option'); ?>"><span class="icon-facebook"></span></a>
                                    <a href="<?php echo get_field('twitter','option'); ?>"><span class="icon-twitter"></span></a>
                                    <a href="<?php echo get_field('instagram','option'); ?>"><span class="icon-instagram"></span></a>
                                    <a href="<?php echo get_field('linkedin','option'); ?>"><span class="icon-linkedin"></span></a>
                                    <a href="<?php echo get_field('youtube','option'); ?>"><span class="icon-youtube"></span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6">
                            <div class="footer-box">
                                <h6>Contact details</h6>
                                <a href="tel:<?php echo get_field('phone','option'); ?>" class="footer-contact-phone"><?php echo get_field('phone_type_1','option'); ?><?php echo get_field('phone','option'); ?></a>
                                 <a href="tel:<?php echo get_field('tech_support_phone','option'); ?>" class="footer-contact-phone"><?php echo get_field('phone_type_2','option'); ?><?php echo get_field('tech_support_phone','option'); ?></a>
                                <a href="mailto:<?php echo get_field('email','option'); ?>" class="footer-contact-mail"><?php echo get_field('email','option'); ?></a>

                                <?php 

                                    $action_newsletter = get_field('join_newsletter_action', 'option');
                                    $action_link = '#newsletter__form';
                                    $action_pop  = '';

                                    if( $action_newsletter['link_or_popup'] == 'link' ) {
                                        $action_link = $action_newsletter['join_newsletter_link'];
                                    } else if( $action_newsletter['link_or_popup'] == 'popup' ) {
                                        $action_pop = 'data-fancybox';
                                    }

                                    $newsletter_btn_label = get_field('join_our_newsletter_button_label', 'option');
                                    $newsletter_btn_label = !empty( $newsletter_btn_label ) ? $newsletter_btn_label : 'Join our newsletter';

                                    echo sprintf(
                                        '<a href="%s" %s class="btn btn-primary">%s</a>',
                                        $action_link,
                                        $action_pop,
                                        $newsletter_btn_label
                                    );

                                ?>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6">
                            <div class="footer-box quick-links-footer hidden-md-down">
                                <h6>Quick links</h6>
                                <?php wp_nav_menu( array('menu' => 'quick links', 'depth' => 1) ); ?>
                            </div>
                            <div class="footer-box copyrights hidden-lg">
                                <ul>
                                    <li>Copyright © <?php echo date("Y"); ?>. All Rights Reserved.</li>
                                    <li>© FUJIFILM Holdings America Corporation </li>
                                    <li><a href="<?php echo get_field('privacy_policy','option'); ?>">Privacy Policy</a></li>
                                    <li><a href="<?php echo get_field('terms_of_use','option'); ?>">Terms of Use</a></li>
                                    <li><a href="<?php echo get_field('sitemap','option'); ?>">Sitemap</a></li>
                                    <li><a href="<?php echo get_field('site_credits','option'); ?>">Site Credits</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="">
                            <div class="backtop col-md-12 col-lg-2">
                                <a href="Javascript:void(0)" class="back-to-top">
                                    <div class="back-to-top-icon"><span class="icon-long-arrow-alt-up"></span></div>
                                    Back to Top
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom hidden-md-down">
            <div class="container-fluid">
                <div class="copyrights">
                    <ul>
                        <li>Copyright © 2022. All Rights Reserved.</li>
                        <li>© FUJIFILM Holdings America Corporation </li>
                        <li><a href="<?php echo get_field('privacy_policy','option'); ?>">Privacy Policy</a></li>
                        <li><a href="<?php echo get_field('terms_of_use','option'); ?>">Terms of Use</a></li>
                        <li><a href="<?php echo get_field('sitemap','option'); ?>">Sitemap</a></li>
                        <li><a href="<?php echo get_field('site_credits','option'); ?>">Site Credits</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <?php if( $action_newsletter['link_or_popup'] == 'popup' ): ?>
    <div id="newsletter__form">
        <?php echo apply_filters('acf_the_content', $action_newsletter['popup_content']); ?>
    </div>
    <?php endif; ?>
    <!-- page footer -->
    
    <script async="async" src=//consent.trustarc.com/notice?domain=print-us.fujifilm.com&c=teconsent&js=nj&noticeType=bb&gtm=1 crossorigin=""></script>  
    <!--This goes in the header-->
    <div id="consent_blackbar" style="position:fixed;bottom:0;width:100%;z-index:999"></div>  
    <!-- this controls the consent banner and banner location-->
    <div id="teconsent"></div> 
    <!-- this is a link to the modal and goes in your footer links -->


    <?php wp_footer(); ?>
</body>
</html>