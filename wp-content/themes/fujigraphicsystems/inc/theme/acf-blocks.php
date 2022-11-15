<?php

/**
 * Register FX blocks
 * 
 * fx_register_block() is, at its core, a wrapper function for acf_register_block_type with additional parameters for 
 * our supporting functionality 
 * 
 * @see Guru card: https://app.getguru.com/card/Tn9zzk8c/FX-ACF-Blocks
 * @see more info for acf_register_block_type(): https://www.advancedcustomfields.com/resources/acf_register_block_type/
 * 
 * Below is a reference for the parameters you can pass to fx_register_block(). You can also pass any setting from 
 * acf_register_block_type() to fx_register_acf_block().
 * 
 * Required arguments: "name", "title", and "template"
 * 
 */

// @todo — remove $reference_settings before launch
$reference_settings = array(
    'name'          => '', // (required) (string) unique name to identify block (no spaces)
    'title'         => '', // (required) (string) display title for block
    'template'      => '', // (required) (string) relative path of the template we'll use to load this block (in block-templates/), Ex: innerpage/template.php
    'css'           => '', // (string) block-specific stylesheet path. Assumed to be in /themes/fx/assets/css, so use relative path (e.g. "homepage/homepage-block.css")
    'css_deps'      => [], // (array) CSS dependency handles. These stylesheets will be loaded before this block's specific stylesheet. Dependencies must already be registered.
    'js'            => '', // (string) block-specific script path. Assumed to be in /themes/fx/assets/js, so use relative path (e.g. "homepage/homepage-block.js")
    'js_deps'       => [], // (array) JS dependency handles. These scripts will be loaded before this block's specific script. Dependencies must already be registered.
    'description'   => '', // (string) short description of block. Optional, but blocks should have useful descriptions to indicate purpose of block.
    'category'      => '', // (string) declares which category in the block editor block belongs to. Options: "text", "media", "design", "widgets", and "embed". You can define your own categories.
    'icon'          => '', // (array|string) can be a dashicon or SVG image used to identify the block
    'keywords'      => '', // (array) terms to help find block in block editor
    'post_types'    => [], // (array) if declared, will restrict block to being available for only specified post types. Default is "page".
    'mode'          => '', // (string) display mode for block when you add block in editor. Options: "auto", "preview", "edit". If no mode is selected, it will automatically be set to "edit", unless your block is an "outer block" in which case the default mode should be "preview". Due to these defaults, It is unlikely you will need to use this setting very often. Note: for large acf groups, such as repeaters, it is recommended to stick with the default "edit" mode.
    'supports'      => '', // (associative array) features to support. See https://developer.wordpress.org/block-editor/developers/block-api/block-supports/
);


/**
 * General blocks
 * 
 * These blocks are intended to be used anywhere, including the homepage and innerpage.
 * 
 * Block template path: /themes/fx/block-templates/general
 * Stylesheet path:     /themes/fx/assets/css/general
 * Script path:         /themes/fx/assets/js/general
 * 
 */


/**
 * Create a "FX General Blocks" category in the block editor. Use "fx-general-blocks" as your "category" value in 
 * fx_register_block()
 * 
 */
fx_add_block_category( 'FX General Blocks', 'fx-general-blocks' );


/**
 * Plan WYSIWYG block for general usage
 * 
 */
fx_register_block(
    [
        'name'          => 'wysiwyg',
        'title'         => 'WYSIWYG',
        'template'      => 'general/wysiwyg.php',
        'description'   => 'A basic "What you see is what you get" editor.',
        'css'           => 'general/wysiwyg.css',
        'post_types'    => [],
    ]
);


/**
 * To avoid issues with CF7 assets, we're creating our own CF7 block. You shouldn't need to touch this section.
 *
 */
$cf7_settings = [
    'name'          => 'cf7-block',
    'title'         => 'CF7 Block',
    'template'      => 'general/cf7-block.php',
    'description'   => 'Adds CF7 block to the page',
    'js_deps'       => [ 'contact-form-7', 'wpcf7-recaptcha', 'google-recaptcha' ],
    'keywords'      => [ 'cf7', 'contact', 'form' ],
    'mode'          => 'edit',
    'post_types'    => [], // all post types
];
$cf7_icon = WP_PLUGIN_DIR . '/contact-form-7/assets/icon.svg';
if( file_exists( $cf7_icon ) ) {
    $cf7_settings['icon'] = file_get_contents( $cf7_icon );
}
fx_register_block( $cf7_settings );

// @todo — add additional general blocks below with the "fx-general-blocks" category



/**
 * Homepage blocks
 * 
 * These blocks are intended to be used ONLY on the homepage.
 * 
 * Block template path: /themes/fx/block-templates/homepage
 * Stylesheet path:     /themes/fx/assets/css/homepage
 * Script path:         /themes/fx/assets/js/homepage
 * 
 */

/**
 * Create a "FX Homepage Blocks" category in the block editor. Use "fx-homepage-blocks" as your "category" value in 
 * fx_register_block()
 * 
 */
fx_add_block_category( 'FX Homepage Blocks', 'fx-homepage-blocks' );


/**
 * This is the main homepage "outer block." All other homepage blocks should be added within this block in the Block 
 * Editor and in block-templates/homepage/homepage-block.php
 * 
 */
fx_register_block(
    [
        'name'          => 'homepage-block',
        'title'         => 'Homepage',
        'template'      => 'homepage/homepage-block.php',
        'description'   => 'The main content block for the homepage',
        'mode'          => 'preview',
        'supports'      => [ 'jsx' => true ], // enables support for inner blocks
        'category'      => 'fx-homepage-blocks',
    ]
);

// @todo —  remove this block if not using a homepage masthead slider

fx_register_block(
    [
        'name'          => 'home-masthead-slider',
        'title'         => 'Masthead Slider',
        'template'      => 'homepage/masthead-slider.php',
        'description'   => 'Slider block for the homepage masthead.',
        'css'           => 'homepage/masthead-slider.css',
        'css_deps'      => [ 'fx_slick' ],
        'js'            => 'homepage/masthead-slider.js',
        'js_deps'       => [ 'fx_slick', 'fx_match_height' ],
        'category'      => 'fx-homepage-blocks',
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'homepage',
                    'image_type'        => 'masthead-slider.jpg'
                ]
            ]
        ]
    ]
);

fx_register_block(
    [
        'name'          => 'homepage-half-image-half-text',
        'title'         => 'Half Image Half Text',
        'template'      => 'homepage/half-image-half-text.php',
        'description'   => '50/50 Image and Text the position of text and image can be swap.',
        'css'           => 'homepage/homepage-half-image-half-text.css',
        'category'      => 'fx-homepage-blocks',
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'homepage',
                    'image_type'        => 'half-image-half-text.jpg'
                ]
            ]
        ]
    ]
);

fx_register_block(
    [
        'name'          => 'homepage-testimonials',
        'title'         => 'Testimonials',
        'template'      => 'homepage/home-testimonials.php',
        'css'           => 'homepage/homepage-testimonials.css',
        'css_deps'      => [ 'fx_slick' ],
        'js'            => 'homepage/testimonials.js',
        'js_deps'       => [ 'fx_slick' ],
        'category'      => 'fx-homepage-blocks',
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'homepage',
                    'image_type'        => 'testimonials.jpg'
                ]
            ]
        ]
    ]
);

// @todo — add additional homepage blocks below with the "fx-homepage-blocks" category



/**
 * Innerpage blocks
 * 
 * These blocks are intended to be used ONLY on innerpages
 * 
 * Block template path: /themes/fx/block-templates/innerpage
 * Stylesheet path:     /themes/fx/assets/css/innerpage
 * Script path:         /themes/fx/assets/js/innerpage
 * 
 */

/**
 * Create a "FX Innerpage Blocks" category in the block editor. Use "fx-innerpage-blocks" as your "category" value in 
 * fx_register_block()
 * 
 */
fx_add_block_category( 'FX Innerpage Blocks', 'fx-innerpage-blocks' );

// @todo — add additional innerpage blocks below with the "fx-innerpage-blocks" category

fx_register_block(
    [
        'name'          => 'cta-half-and-half',
        'title'         => '50/50 Call To Action',
        'description'   => 'Half - Call to action.',
        'template'      => 'innerpage/cta-half-and-half.php',
        'css'           => 'innerpage/cta-half-and-half.css',
        'category'      => 'fx-innerpage-blocks',
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'innerpage',
                    'image_type'        => 'cta-half-and-half.jpg'
                ]
            ]
        ],
        'post_types'    => ['page','post'],
    ]
);

fx_register_block(
    [
        'name'          => 'wysiwyg-light-gray-angle',
        'title'         => 'Wysiwyg Light Gray w/ Angle',
        'description'   => 'Different from the general Wyiswyg this wysiwyg has a background light gray and angle top and bottom.',
        'template'      => 'innerpage/wysiwyg-editor-gray-bg-angle.php',
        'js'            => 'innerpage/wyswyig-light-gray-angle.js',
        'js_deps'       => [ 'jquery' ],
        'category'      => 'fx-innerpage-blocks',
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'innerpage',
                    'image_type'        => 'angled-gray.jpg'
                ]
            ]
        ]
    ]
);

fx_register_block(
    [
        'name'          => 'accordion',
        'title'         => 'Accordion Section',
        'description'   => 'Accordion section.',
        'template'      => 'innerpage/accordion.php',
        'css'           => 'innerpage/accordion.css',
        'css_deps'      => ['fx_fancybox'],
        'js_deps'       => [ 'jquery', 'fx_fancybox' , 'fx_accordion_js'],
        'category'      => 'fx-innerpage-blocks',
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'innerpage',
                    'image_type'        => 'accordion.jpg'
                ]
            ]
        ]
    ]
);

fx_register_block(
    [
        'name'          => 'half-content-half-image-accordion-bottom',
        'title'         => 'Half Content/Half Image + Accordion Bottom',
        'description'   => 'Half Content/Half Image + Accordion Bottom Block available for Innerpages use.',
        'template'      => 'innerpage/half-text-half-image-accordion-bottom.php',
        'css'           => 'innerpage/accordion.css',
        'css_deps'      => ['fx_fancybox', 'half-image-half-text'],
        'js_deps'       => [ 'jquery', 'fx_fancybox', 'fx_accordion_js'],
        'category'      => 'fx-innerpage-blocks',
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'innerpage',
                    'image_type'        => 'accordion.jpg'
                ]
            ]
        ]
    ]
);


fx_register_block(
    [
        'name'          => 'tab-section',
        'title'         => 'Tab Section',
        'description'   => 'Tabulation of title and content.',
        'template'      => 'innerpage/tab-section.php',
        'css'           => 'innerpage/tabs.css',
        'css_deps'      => ['fx_tabs_accordion'],
        'js'            => 'innerpage/tabs.js',
        'js_deps'       => ['jquery', 'fx_tabs_accordion' ],
        'category'      => 'fx-innerpage-blocks',
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'innerpage',
                    'image_type'        => 'tab.jpg'
                ]
            ]
        ]
    ]
);

fx_register_block(
    [
        'name'          => 'video-section',
        'title'         => 'Video Section',
        'description'   => 'Video section if more than 3 slider initialize.',
        'template'      => 'innerpage/video-section.php',
        'css'           => 'innerpage/video-slider.css',
        'css_deps'      => [ 'fx_slick', 'fx_fancybox' ],
        'js'            => 'innerpage/video-slider.js',
        'js_deps'       => [ 'jquery', 'fx_slick', 'fx_match_height', 'fx_fancybox' ],
        'category'      => 'fx-innerpage-blocks',
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'innerpage',
                    'image_type'        => 'video.jpg'
                ]
            ]
        ]
    ]
);

fx_register_block(
    [
        'name'          => 'case-study-section',
        'title'         => 'Case Study Section',
        'description'   => 'Display 3 case study pulled from the case study post type',
        'template'      => 'innerpage/case-study-section.php',
        'css'           => 'innerpage/case-studies.css',
        'css_deps'      => [ 'fx_slick' ],
        'js'            => 'innerpage/case-studies.js',
        'js_deps'       => [ 'jquery'],
        'category'      => 'fx-innerpage-blocks',
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'innerpage',
                    'image_type'        => 'case-studies.jpg'
                ]
            ]
        ]
    ]
);

fx_register_block(
    [
        'name'          => 'full-width-cta-single',
        'title'         => 'Full Width CTA Single',
        'description'   => 'Full width CTA single with background',
        'template'      => 'innerpage/cta-full-width.php',
        'css'           => 'innerpage/cta-full-width.css',
        'category'      => 'fx-innerpage-blocks',
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'innerpage',
                    'image_type'        => 'full-width-cta-single.jpg'
                ]
            ]
                ],
        'post_types'    => ['page','post'],
    ]
);

fx_register_block(
    [
        'name'          => 'image-button-slider',
        'title'         => 'Image Button Slider',
        'description'   => 'Image button slider and has product specific for the image slide',
        'template'      => 'innerpage/image-slider.php',
        'css'           => 'innerpage/image-slider.css',
        'css_deps'      => [ 'fx_slick' ],
        'js'            => 'innerpage/image-slider.js',
        'js_deps'       => [ 'fx_slick'],
        'category'      => 'fx-innerpage-blocks',
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'innerpage',
                    'image_type'        => 'image-button-slider.jpg'
                ]
            ]
        ]
    ]
);

fx_register_block(
    [
        'name'          => 'image-button-boxes-with-hover-text',
        'title'         => 'Image Button Boxes With Hover Text',
        'description'   => 'Image button that has a hover effect displays the description',
        'template'      => 'innerpage/image-button-boxes.php',
        'css'           => 'innerpage/image-buttons.css',
        'category'      => 'fx-innerpage-blocks',
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'innerpage',
                    'image_type'        => 'image-button-boxes-with-hover-text.jpg'
                ]
            ]
        ]
    ]
);

fx_register_block(
    [
        'name'          => 'testimonials-section',
        'title'         => 'Testimonials',
        'description'   => 'Display the testimonials posts from the testimonial post type',
        'template'      => 'innerpage/testimonials.php',
        'css'           => 'innerpage/innerpage-testimonials.css',
        'css_deps'      => ['fx_slick'],
        'js'            => 'innerpage/innerpage-testimonials.js',
        'js_deps'       => ['fx_slick'],
        'category'      => 'fx-innerpage-blocks',
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'innerpage',
                    'image_type'        => 'testimonials-section.jpg'
                ]
            ]
        ]
    ]
);

fx_register_block(
    [
        'name'          => 'half-half-section-large-image-text',
        'title'         => '50/50 Section Large Image/Text',
        'description'   => '50/50 section with Large Image and Text.',
        'template'      => 'innerpage/half-section-large-image-text.php',
        'css'           => 'innerpage/half-image-half-text.css',
        'css_deps'      => ['fx_fancybox'],
        'js_deps'       => ['jquery', 'fx_fancybox'],
        'category'      => 'fx-innerpage-blocks',
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'innerpage',
                    'image_type'        => 'half-half-section-large-image-text.jpg'
                ]
            ]
        ],
        'post_types'    => ['page','post'],
    ]
);

fx_register_block(
    [
        'name'          => 'half-half-section-image-text-overlap',
        'title'         => '50/50 Section Image Text Overlap',
        'description'   => '50/50 section with Image and Text Overlap.',
        'template'      => 'innerpage/half-section-image-text-overlap.php',
        'css'           => 'innerpage/half-image-half-text.css',
        'category'      => 'fx-innerpage-blocks',
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'innerpage',
                    'image_type'        => 'half-half-section-image-text-overlap.jpg'
                ]
            ]
        ]
    ]
);

fx_register_block(
    [
        'name'          => 'full-width-image-with-text',
        'title'         => 'Full Width Image With Text',
        'description'   => 'Full width image background with text.',
        'template'      => 'innerpage/full-width-image-background-text.php',
        'css'           => 'innerpage/full-width-image.css',
        'category'      => 'fx-innerpage-blocks',
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'innerpage',
                    'image_type'        => 'full-width-image-with-text.jpg'
                ]
            ]
        ],
        'post_types'    => ['page','post'],
    ]
);

fx_register_block(
    [
        'name'          => 'two-column-image-text',
        'title'         => 'Two Column Image Text',
        'description'   => 'Can add image and text on each column.',
        'template'      => 'innerpage/two-column-image-text.php',
        'css'           => 'innerpage/two-columns.css',
        'category'      => 'fx-innerpage-blocks',
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'innerpage',
                    'image_type'        => 'two-column-image-text.jpg'
                ]
            ]
        ]
    ]
);

fx_register_block(
    [
        'name'          => 'attention-block',
        'title'         => 'Attention Block',
        'template'      => 'innerpage/attention-block.php',
        'css'           => 'innerpage/attention-block.css',
        'category'      => 'fx-innerpage-blocks',
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'innerpage',
                    'image_type'        => 'attention-block.jpg'
                ]
            ]
        ],
        'post_types'    => ['page','post'],
    ]
);

fx_register_block(
    [
        'name'          => 'resources-block',
        'title'         => 'Resources Block',
        'template'      => 'innerpage/resources-block.php',
        'css'           => 'innerpage/resources-block.css',
        'css_deps'      => ['fx_fancybox'],
        'js_deps'       => ['fx_fancybox'],
        'category'      => 'fx-innerpage-blocks',
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'innerpage',
                    'image_type'        => 'attention-block.jpg'
                ]
            ]
        ],
        'post_types'    => ['page','post'],
    ]
);

fx_add_block_category( 'FX Filter Blocks', 'fx-filter-blocks' );

fx_register_block(
    [
        'name'          => 'video-filter-block',
        'title'         => 'Video Filter',
        'template'      => 'innerpage/filter/video-filter-block.php',
        'css'           => 'innerpage/filter/video-filter-block.css',
        'category'      => 'fx-filter-blocks',
        'js'            => 'innerpage/filter/video-filter-block.js',
        'js_deps'       => ['jquery'],
        'example'       => [
            'attributes'    => [
                'mode'  => 'preview',
                'data'  => [ 
                    'preview_banner'    => true, 
                    'template_folder'   => 'innerpage',
                    'image_type'        => 'video-filter.jpg'
                ]
            ]
        ],
        'post_types'    => ['page','post'],
    ]
);