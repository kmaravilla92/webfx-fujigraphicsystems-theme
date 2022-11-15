<?php
/* Table of Contents
 *
 * Admin Whitelabel
 * TinyMCE Options
 * Block Editor Options
 * Page Excerpts
 */

/** ----- ADMIN WHITELABEL ----- **/

/**
 * Output style to change logo on login
 *
 * @return void
 */
add_action( 'login_head', 'fx_login_logo' );
function fx_login_logo() {
    ?>
    <style type="text/css">
        h1 a {
            background-image:url('<?php echo get_template_directory_uri(); ?>/assets/img/logo.png') !important;
            background-size: 275px 84px !important;
            height: auto !important;
            width: 100% !important;
            margin-bottom: 20px !important;
            padding-bottom: 0 !important;
            height: 84px !important;
        }
        .login form { margin-top: 25px !important; }

        #nav {
            float: right !important;
            width: 50%;
            padding: 0 !important;
            text-align: right !important;
        }

        #backtoblog {
            float: left !important;
            width: 50%;
            padding: 0 !important;
            margin-top: 24px;
        }
    </style>
    <?php
}


/**
 * Removes Items from the sidebar that aren't needed
 *
 * @return void
 */
add_action( 'admin_menu', 'fx_remove_admin_menu_items' );
function fx_remove_admin_menu_items() {
    global $menu;

    // array of item names to remove
    $remove_menu_items = array(
        __( 'Comments' ),
    );

    end( $menu );
    while ( prev( $menu ) ) {
        $item = explode( ' ', $menu[ key( $menu ) ][0] );
        if ( in_array( null !== $item[0] ? $item[0] : '', $remove_menu_items, true ) ) {
            unset( $menu[ key( $menu ) ] );
        }
    }
}


/**
 * Removes nodes from admin bar to make for white labeled
 *
 * @param  class $wp_toolbar the WordPress toolbar instance.
 * @return class             returns the modified toolbar
 */
add_action( 'admin_bar_menu', 'fx_remove_admin_bar_menus', 999 );
function fx_remove_admin_bar_menus( $wp_toolbar ) {
    $wp_toolbar->remove_node( 'wp-logo' );
    return $wp_toolbar;
}


/**
 * Remove the defualt dashboard widgets for orgs
 *
 * @return void
 */
add_action( 'wp_dashboard_setup', 'fx_remove_dashboard_widgets', 0 );
function fx_remove_dashboard_widgets() {
    remove_meta_box( 'dashboard_primary', 'dashboard', 'side' );
}


/**
 * Remove the WordPress text at the bottom of the admin
 *
 * @param  string $text current footer text.
 * @return string the changed footer text
 */
add_filter( 'update_footer', 'fx_remove_footer_text', 999 );
add_filter( 'admin_footer_text', 'fx_remove_footer_text' );
function fx_remove_footer_text() {
    return '';
}


/**
 * Change logo URL on WP login page to point to site's homepage
 *
 * @return string 	Homepage URL
 */
add_filter( 'login_headerurl', function() {
	return get_home_url();
});

/** ----- TINYMCE OPTIONS ----- **/

/**
 * Add "Styles" drop-down
 *
 * @param  array $buttons current buttons to be setup.
 * @return array
 */
add_filter( 'mce_buttons_2', 'fx_mce_editor_buttons' );
function fx_mce_editor_buttons( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}

/**
 * Add styles/classes to the "Styles" drop-down
 *
 * @param  array $settings Settings array for TinyMCE.
 * @return array
 */
add_filter( 'tiny_mce_before_init', 'fx_mce_before_init' );
function fx_mce_before_init( $settings ) {

    $style_formats = array(
        array(
            'title'    => 'Button',
            'selector' => 'a',
            'classes'  => 'btn',
        ),

        array(
            'title'    => 'Primary Button',
            'selector' => 'a',
            'classes'  => 'btn btn-primary',
        ),

        array(
            'title'    => 'Secondary Button',
            'selector' => 'a',
            'classes'  => 'btn btn-secondary',
        ),

        array(
            'title'    => 'Tertiary Button',
            'selector' => 'a',
            'classes'  => 'btn btn-tertiary',
        ),

        /*
        Examples for adding styles
        array(
            'title' => 'Call Out Text',
            'selector' => 'p',
            'classes' => 'callout'
        )
        ,array(
            'title' => 'Warning Box',
            'block' => 'div',
            'classes' => 'warning box',
            'wrapper' => true
        )
        ,array(
            'title' => 'Red Uppercase Text',
            'inline' => 'span',
            'styles' => array(
                'color' => '#ff0000',
                'fontWeight' => 'bold',
                'textTransform' => 'uppercase'
            )
        )
        */
    );

    $settings['style_formats'] = wp_json_encode( $style_formats );

    return $settings;
}


/**
 *  Adds "Theme Settings" option page
 *
 *  @return  void
 */
add_action( 'init', 'fx_admin_add_options_page' );
function fx_admin_add_options_page() {
    if( function_exists('acf_add_options_page') ) {
        acf_add_options_page(
            [
                'page_title'    => 'Theme General Settings',
                'menu_title'    => 'Theme Settings',
                'menu_slug'     => 'theme-general-settings',
                'capability'    => 'edit_posts',
                'redirect'      => false
            ]
        );
    }
}

/** ----- BLOCK EDITOR OPTIONS ----- **/

/**
 * Remove core block patterns to prevent user confusion
 */
add_action( 'after_setup_theme', 'fx_remove_core_block_patterns' );
function fx_remove_core_block_patterns() {
    remove_theme_support( 'core-block-patterns' );
}

/**
 * Unregister the "Classic Block" to prevent admin confusion
 */
add_action( 'init', 'fx_unregister_classic_block', 11 );
function fx_unregister_classic_block() {
    unregister_block_type( 'core/freeform' );
}

/**
 * Unregisters the CF7 block, since does not allow you to include
 * an html_id for MCFX tracking. Use the FX CF7 block instead.
 *
 * TODO remove from build template in phase II (for builds, delete this comment)
 */
add_action( 'init', 'fx_unregister_cf7_block', 11 );
function fx_unregister_cf7_block() {
    if ( WP_Block_Type_Registry::get_instance()->is_registered( 'contact-form-7/contact-form-selector' ) ) {
        unregister_block_type( 'contact-form-7/contact-form-selector' );
    }
}

/**
 * Restrict the blocks that can be used on the homepage: this should include the top-level acf/homepage-block.
 * Inner-blocks declared in homepage-block.php will automatically be included
 *
 */
add_filter( 'allowed_block_types_all', 'fx_restrict_homepage_blocks', 10, 2);
function fx_restrict_homepage_blocks( $allowed_blocks, $context ) {
    // TODO update to homepage ID & remove this comment
    if( (int) get_option( 'page_on_front' ) === $context->post->ID ) {
        $allowed_blocks = array(
            // Original Home page related blocks
            'acf/homepage-block',
            'acf/home-masthead-slider',
            'acf/homepage-half-image-half-text',
            'acf/homepage-testimonials',
            'acf/cta-half-and-half',

            // New Inner page related blocks
            'acf/video-section',
            'acf/wysiwyg',
            'acf/case-study-section',
            'acf/video-section',
            'acf/attention-block',
            'acf/resources-block',
        );
    } else {
        // TODO add blocks that shouldn't be allowed outside of the homepage to $disallowed_blocks. Block name should be acf/{name}
        $disallowed_blocks = [
            'acf/homepage-block',
            'acf/home-masthead-slider',
            'acf/homepage-half-image-half-text',
            'acf/homepage-testimonials'
        ];

        if ( is_bool($allowed_blocks) ) {
            $block_types = WP_Block_Type_Registry::get_instance()->get_all_registered();
            $allowed_blocks = array_keys( $block_types );
        }

        foreach ($disallowed_blocks as $unset) {
            $key = array_search($unset, $allowed_blocks);

            if ( $key !== false) {
                unset($allowed_blocks[$key]);
            }
        }
    }

    return array_values($allowed_blocks);
}

add_filter( 'allowed_block_types_all', 'fx_restricted_video_filter', 10, 99);
function fx_restricted_video_filter( $allowed_blocks, $context ) {

    if( (int) $context->post->ID === 1323 ) {
        $key = array_search('acf/video-filter-block', $allowed_blocks);
        $index = 0;
        foreach ($allowed_blocks as $unset ) {
            if ( $key !== $index ) {
                unset($allowed_blocks[$index]);
            }
            $index++;
        }
    } else {
        $key = array_search('acf/video-filter-block', $allowed_blocks);
        unset($allowed_blocks[$key]);
    }

    return array_values($allowed_blocks);

}


/** ----- PAGE EXCERPTS ----- **/

/**
 * Difficult to auto-generate good excerpts with block editor;
 * allow custom excerpts
 */
add_action( 'init', 'fx_page_supports_excerpts' );
function fx_page_supports_excerpts() {
	add_post_type_support( 'page', 'excerpt' );
}


add_action( 'save_post_page', 'fx_generate_post_excerpt', 99, 2 );
/** Automatically generates a post excerpt for pages without one */
function fx_generate_post_excerpt( $post_id, $post ) {
    if( !has_excerpt( $post_id ) ) {
        $blocks = parse_blocks( $post->post_content );

        if( !empty( $blocks ) ) {
            $block_content = apply_filters( 'the_content', render_block( $blocks[0] ) );
            $content = wp_strip_all_tags($block_content);
            $excerpt_length = apply_filters('excerpt_length', 55);
            $excerpt_more = apply_filters( 'excerpt_more', ' ' . '[&hellip;]' );
            $text         = wp_trim_words( $content, $excerpt_length, $excerpt_more );

            // prevent infinite loop if no excerpt to update
            if (!empty($text) ) {
                $the_post = [
                    'ID'              => $post_id,
                    'post_excerpt'    => $text,
                ];

                wp_update_post($the_post);
            }
        }
    }

    return true;
}

/**
 * tinyMCE create custom button for read more read less block
 *
 */
add_action('init', 'fx_block_custom_readmore_less');
function fx_block_custom_readmore_less() {
    if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
        return;
    }

    if ( get_user_option( 'rich_editing' ) !== 'true' ) {
        return;
    }

    add_filter( 'mce_external_plugins', 'fx_block_add_readmore_less',99 );
    add_filter( 'mce_buttons', 'fx_block_readmore_less',99 );
}

function fx_block_add_readmore_less( $plugin_array ) {
    $plugin_array['readmore_readless'] = get_template_directory_uri().'/assets/js/tinymce_readmore-less.js';
    return $plugin_array;
}

function fx_block_readmore_less( $buttons ) {
    array_push( $buttons, 'readmore_readless' );
    return $buttons;
}

/**
 *
 * Add Preview Banner to editor block
 * Description: To add a preview banner to each block. The Image must be declared inside
 * fx_register_block() array example data values. Make sure that you add the file extension!
 *
 */
add_action('fx_preview_block','fx_preview_block_banner', 10);
function fx_preview_block_banner() {

    $preview_banner     = get_field('preview_banner');
    $template_folder    = get_field('template_folder');
    $image_name         = get_field('image_type');

    if( ! $preview_banner && ! $template_folder && ! $image_name && ! is_admin() )
        return;

    $template_directory = get_template_directory_uri() . '/assets/img/preview/' . $template_folder . '/' . $image_name;

    echo sprintf(
        '<img src="%s">',
        $template_directory
    );

}


add_action('admin_print_styles', function() { ?>
    <style>
    #set-post-thumbnail-desc:after {
        content: "WebFX recommends image size of at least 557px by 250px.";
        display: block;
        margin-top: 5px;
        font-weight: bold;
    }
    </style>
<?php
});
