<?php

/** 
 * Documentation on FX Assets:
 * https://app.getguru.com/card/ceEjzyKi/FX-Assets
 */

/**
 * Register and enqueue theme styles
 *
 * @return void
 */
add_action( 'wp_enqueue_scripts', 'fx_theme_styles' );
function fx_theme_styles() {
    $theme_dir = get_stylesheet_directory();
    $theme_url = get_stylesheet_directory_uri();

    /* Inline critical/above-the-fold stylesheets */
    
    fx_assets_add_stylesheet(
        [
            'handle'    => 'normalize',
            'src'       => $theme_url . '/assets/css/normalize.css',
            'inline'    => false,
            'enqueue' => true,
        ]
    );
    
    // TODO remove this stylesheet registration if not using ubermenu.
    fx_assets_add_stylesheet(
        [
            'handle'    => 'fx-ubermenu',
            'src'       => plugins_url() . '/ubermenu/pro/assets/css/ubermenu.min.css',
            'inline'    => false,
            'enqueue' => true,
        ]
    );
    
    // Styles that are required on every page
    fx_assets_add_stylesheet(
        [
            'handle'    => 'site-global',
            'src'       => $theme_url . '/assets/css/global.css',
            'inline'    => false,
            'enqueue' => true,
        ]
    );
    
    // Header Styling
    fx_assets_add_stylesheet(
        [
            'handle'    => 'site-header',
            'src'       => $theme_url . '/assets/css/header.css',
            'inline'    => false,
            'enqueue' => true,
        ]
    );
    
    
    /* Other theme styles, enqueued normally (not inline in header) */
    
    // Footer Styling
    fx_assets_add_stylesheet(
        [
            'handle'    => 'site-footer',
            'src'       => $theme_url . '/assets/css/footer.css',
            'enqueue'   => !is_admin()
        ]
    );
    
    fx_assets_add_stylesheet(
        [
            'handle'    => 'page-contact',
            'src'       => $theme_url . '/assets/css/blocks/innerpage/page-contact.css',
            'enqueue'   => ( is_page_template('page-contact.php') )
        ]
    );


    fx_assets_add_stylesheet(
        [
            'handle'    => 'half-image-half-text',
            'src'       => $theme_url . '/assets/css/blocks/innerpage/half-image-half-text.css'
        ]
    );

    // Posts-specific styling: blog singles, archives, search page
    fx_assets_add_stylesheet(
        [
            'handle'    => 'site-posts',
            'src'       => $theme_url . '/assets/css/posts.css',
            'enqueue'   => ( is_single() || is_home() || is_archive() || is_search() )
        ]
    );

    // Styles for only 404 page

    fx_assets_add_stylesheet(
        [
            'handle'    => 'image-buttons-404',
            'src'       => $theme_url . '/assets/css/blocks/innerpage/image-buttons.css',
            'enqueue'   => is_404()
        ]
    );

    fx_assets_add_stylesheet(
        [
            'handle'    => 'site-404',
            'src'       => $theme_url . '/assets/css/404.css',
            'enqueue'   => is_404()
        ]
    );    
    
    // Print Styles
    fx_assets_add_stylesheet(
        [
            'handle'    => 'site-print',
            'src'       => $theme_url . '/assets/css/print.css',
            'enqueue'   => !is_admin(),
            'media'     => 'print'
        ]
    );
    
    /* Component-specific css. These will be enqueued per-block as dependencies or per-page as needed. These files can be edited to override default styling. */
    
    // Styles for social sharing buttons on blog pages
    fx_assets_add_stylesheet(
        [
            'handle'    => 'fx_social',
            'src'       => $theme_url . '/assets/css/components/FxSocialShare.css',
            'enqueue'   => is_single()
        ]
    );
    
    // Styles specifically for CF7 forms.
    fx_assets_add_stylesheet(
        [
            'handle'    => 'fx_cf7',
            'src'       => $theme_url . '/assets/css/components/cf7.css',
        ]
    );
    
    // Styles for tab/accordion block sections
    fx_assets_add_stylesheet(
        [
            'handle'    => 'fx_tabs_accordion',
            'src'       => $theme_url . '/assets/css/components/FxTabsAccordion.css',
            'enqueue'   => is_search()
        ]
    );
    
    // Custom styling for choices.js library
    fx_assets_add_stylesheet(
        [
            'handle'        => 'fx_choices_custom',
            'src'           => $theme_url . '/assets/css/components/choices.css',
            'dependencies'  => ['fx_choices_plugin'],
            // 'enqueue'       => is_archive(), // TODO uncomment if categories in sidebar will use drop-downs. Remove otherwise.
        ]
    );

    fx_assets_add_script(
        [
            'handle'        => 'fx_match_height',
            'src'           => $theme_url . '/assets/js/plugins/matchheight.js',
            'dependencies'  => [ 'jquery' ],
            'enqueue'       => ( is_archive() || is_home() )
        ]
    );
    
    // Custom styling for slick library
    fx_assets_add_stylesheet(
        [
            'handle'        => 'fx_slick',
            'src'           => $theme_url . '/assets/css/components/slick.css',
            'dependencies'  => ['fx_slick_plugin'],
        ]
    );
    
    // Custom styling for ninja tables. TODO: remove if not using ninja tables.
    fx_assets_add_stylesheet(
        [
            'handle'        => 'fx_ninja',
            'src'           => $theme_url . '/assets/css/components/ninja-tables.css',
            'dependencies'  => ['fx_ninja_plugin'],
        ]
    );
    
    /* Plugin-specific css dependencies. These will be enqueued per-block as dependencies or per-page as needed. These files should not be edited directly. */
    
    fx_assets_add_stylesheet(
        [
            'handle'        => 'fx_fancybox',
            'src'           => $theme_url . '/assets/css/plugins/fancybox3.css',
            'enqueue'       => !is_admin()
        ]
    );

    fx_assets_add_stylesheet(
        [
            'handle'    => 'fx_slick_plugin',
            'src'       => $theme_url . '/assets/css/plugins/slick.css',
        ]
    );
    
    fx_assets_add_stylesheet(
        [
            'handle'    => 'fx_choices_plugin',
            'src'       => $theme_url . '/assets/css/plugins/choices.css',
        ]
    );
    
    // TODO: remove if not using ninja tables.
    fx_assets_add_stylesheet(
        [
            'handle'    => 'fx_ninja_plugin',
            'src'       => $theme_url . '/assets/css/plugins/ninja-tables.css',
        ]
    );
    
    // Custom plugin dependencies. This will ensure fx styles load whenever the selected plugin style loads.
    fx_assets_add_plugin_style( 'contact-form-7', 'fx_choices_custom' );
    fx_assets_add_plugin_style( 'contact-form-7', 'fx_cf7' );
    // TODO: remove below if not using ninja tables.
    fx_assets_add_plugin_style( 'footable_styles', 'fx_ninja' );
}

add_action( 'wp_enqueue_scripts', 'fx_theme_style_trumps', 103 );
/** Register and enqueue trump styles
 * @hooked wp_enqueue_scripts priority 103 so block asset manager completes
 * running and trump styles are enqueued last.
 */
function fx_theme_style_trumps() {
    $theme_url = get_stylesheet_directory_uri();
    
    fx_assets_add_stylesheet(
        [
            'handle'        => 'site-trumps',
            'src'           => $theme_url . '/assets/css/trumps.css',
            'enqueue'       => !is_admin()
        ]
    );
}



/**
 * Register and enqueue theme scripts
 *
 * @return void
 */
add_action( 'wp_enqueue_scripts', 'fx_theme_scripts' );
function fx_theme_scripts() {
    $theme_dir = get_stylesheet_directory();
    $theme_url = get_stylesheet_directory_uri();

    // Scripts that must be included on every page.
    fx_assets_add_script(
        [
            'handle'        => 'site-global',
            'src'           => $theme_url . '/assets/js/global.js',
            'dependencies'  => [ 'jquery', 'fx_fitvids' ],
            'enqueue'       => !is_admin(),
            'defer'         => true,
            'preload'       => true,
        ]
    );
    

    /**
     * Component-specific JS
     * 
     * These will be enqueued per-block as dependencies or per-page as needed. These files can be edited to override 
     * default behavior if necessary.
     */
    // 
    fx_assets_add_script(
        [
            'handle'        => 'fx_choices',
            'src'           => $theme_url . '/assets/js/components/FxChoices.js',
            'dependencies'  => [ 'fx_choices_plugin' ],
            'defer'         => true,
            // 'enqueue'       => ( is_archive() || is_home() ), // todo — uncomment and add conditions for dropdowns, etc
        ]
    );     
    
    // Script for block sections that use parallax
    fx_assets_add_script(
        [
            'handle'        => 'fx_parallax',
            'src'           => $theme_url . '/assets/js/components/FxParallax.js',
            'dependencies'  => [ 'jquery' ],
            'defer'         => true,
        ]
    );     
    
    // Script social sharing buttons on blog pages
    fx_assets_add_script(
        [
            'handle'        => 'fx_social',
            'src'           => $theme_url . '/assets/js/components/FxSocialShare.js',
            'enqueue'       => is_single()
        ]
    );
    
    // Script for "Read More" block sections
    fx_assets_add_script(
        [
            'handle'        => 'fx_readmore',
            'src'           => $theme_url . '/assets/js/components/FxReadMore.js',
            'dependencies'  => [ 'jquery' ],
        ]
    );
    
    // Script for accordion block sections
    fx_assets_add_script(
        [
            'handle'        => 'fx_accordion',
            'src'           => $theme_url . '/assets/js/components/FxAccordion.js',
        ]
    );

    fx_assets_add_script(
        [
            'handle'        => 'fx_accordion_js',
            'src'           => $theme_url . '/assets/js/blocks/innerpage/accordion.js',
            'dependencies'  => [ 'jquery' ],
        ]
    );
    
    // Script for tabs/accordion block sections
    fx_assets_add_script(
        [
            'handle'        => 'fx_tabs_accordion',
            'src'           => $theme_url . '/assets/js/components/FxTabsAccordion.js',
            'enqueue'       => is_search()
        ]
    );
    
    // Script for block sections that use parallax
    fx_assets_add_script(
        [
            'handle'        => 'fx_parallax',
            'src'           => $theme_url . '/assets/js/components/FxParallax.js',
            'dependencies'  => [ 'jquery' ],
            'defer'         => true,
        ]
    );  


        
    
    /**
     * Plugin-specific JS
     * 
     * These will be enqueued per-block as dependencies or per-page as needed. These files should not be edited directly.
     */ 
    fx_assets_add_script(
        [
            'handle'        => 'fx_slick',
            'src'           => $theme_url . '/assets/js/plugins/slick.js',
            'dependencies'  => [ 'jquery' ],
        ]
    );
    
    fx_assets_add_script(
        [
            'handle'        => 'fx_choices_plugin',
            'src'           => $theme_url . '/assets/js/plugins/choices.js',
        ]
    );
    
    fx_assets_add_script(
        [
            'handle'        => 'fx_fitvids',
            'src'           => $theme_url . '/assets/js/plugins/fitvids.js',
            'dependencies'  => [ 'jquery' ],
            'defer'         => true,
            'enqueue'       => true
        ]
    );
    
    fx_assets_add_script(
        [
            'handle'        => 'fx_phone_formatter',
            'src'           => $theme_url . '/assets/js/plugins/FormatPhoneNumbers.js',
            'dependencies'  => [ 'jquery' ],
            'defer'         => true,
        ]
    );

    fx_assets_add_script(
        [
            'handle'        => 'fx_fancybox',
            'src'           => $theme_url . '/assets/js/plugins/fancybox3.js',
            'dependencies'  => [ 'jquery' ],
            'defer'         => true,
            'enqueue'       => !is_admin()
        ]
    );

    // Custom dependencies for WordPress plugins. Ensures that assigned scripts loads whenever WP plugin's script(s) load
    fx_assets_add_plugin_script( 'contact-form-7', 'fx_choices' );
    fx_assets_add_plugin_script( 'contact-form-7', 'fx_phone_formatter' );

    
}

add_action( 'wp_head', 'fx_localize_script');
function fx_localize_script() {
    if( !is_admin() ) {
        echo "<script type='text/javascript'>\n";
?>
        var FX = ( FX => {
            FX.siteurl = '<?php echo esc_js( get_site_url() ); ?>'
            FX.ajaxurl = '<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>'
            
            return FX
        }) ( FX || {} )

        var FXcustom = {
            ajaxurl : "<?php echo admin_url('admin-ajax.php'); ?>",
            FXnonce : "<?php echo wp_create_nonce('fx_ajax_nonce'); ?>"
        }
<?php
        echo "</script>\n";
       
    }
}

/** Dequeues CF7 scripts on pages where cf7 is not used
 * The FX_ParseBlockAssets mu-plugin hooks this up when there are no cf7 blocks
 * detected on a page.
 * TODO remove in Phase II. (For builds, remove this TODO comment)
 * @hooked wp_print_scripts 100 - conditionally
 */
function fx_dequeue_cf7_scripts() {
    wp_dequeue_script('google-recaptcha');
    wp_dequeue_script('wpcf7-recaptcha');
    wp_dequeue_script('contact-form-7');
}

/** This function checks if a cf7 form is on the page,
 * and enqueues fx_choices_plugin css and fx_cf7.
 * Note: fx_choices_plugin is enqueued inline before other block css to
 * allow easier styling of forms.
 * @hooked wp_enqueue_scripts 102 to make sure block asset
 *  parser has finished
 */
add_action('wp_enqueue_scripts', 'fx_print_cf7_styles', 102);
function fx_print_cf7_styles() {
    $asset_parser = FX_Parse_Block_Assets();
    if ( $asset_parser->cf7_on_page) {
        $theme_url = get_stylesheet_directory_uri();
        // print fx_choices_plugin inline before block-specific css.
        fx_assets_add_stylesheet(
            [
                'handle'        => 'fx_choices_custom',
                'src'           => $theme_url . '/assets/css/components/choices.css',
                'inline'        => true,
                'priority'      => -1, 
                'dependencies'  => ['fx_choices_plugin'],
            ]
        );
        // this can be enqueued with normal priority
        wp_enqueue_style('fx_cf7');
    }
}


add_filter( 'fx_dont_inline_block_assets', 'fx_exclude_cf7_asset_inline' );
/** Prevents cf7 scripts from being inlined if cf7 is the first block on a page */
function fx_exclude_cf7_asset_inline( $excluded_blocks ) {
    $excluded_blocks[] = 'acf/cf7-block';

    return $excluded_blocks;
}

/** Remove jquery migrate as a jquery dependency on the front end to improve load times. */
add_action( 'wp_default_scripts', 'fx_dequeue_jquery_migrate' );
function fx_dequeue_jquery_migrate( $scripts ) {
    if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
        $scripts->registered['jquery']->deps = array_diff(
            $scripts->registered['jquery']->deps,
            [ 'jquery-migrate' ]
        );
    }
}