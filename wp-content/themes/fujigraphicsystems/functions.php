<?php
remove_filter('template_redirect','redirect_canonical');


/**
 * Bootstrap File
 * File is only used to load in the necessary files for the theme - no
 * functions should be added here directly.
 *
 * Please keep in mind that only presentation functionality should be added
 * inside the theme. Any additional functionality - custom post types,
 * taxonomies, etc. - should be added in plugins or mu-plugins to allow
 * the theme to be changed without affecting site functionality.
 */


// Remove unnecessary items from head
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );

// Grab path for includes
$theme_path = get_template_directory();


/**
 * Include helper functions
 * Contains free-standing functions (not attached to specific WP hooks) to be used in templates, etc
 */
require_once $theme_path . '/inc/theme/helper-functions.php';


/**
 * Include admin-related functionality
 * Contains functions attached to admin-specific WP hooks
 */
require_once $theme_path . '/inc/theme/admin.php';


/**
 * Include frontend-related functionality
 * Contains functions attached to frontend-specific WP hooks
 */
require_once $theme_path . '/inc/theme/frontend.php';

/**
 * Include assets
 * Contains logic for enqueuing styles and scripts
 */
require_once $theme_path . '/inc/theme/assets.php';


/**
 * Include ACF blocks
 * Contains logic for registering ACF blocks
 */
require_once $theme_path . '/inc/theme/acf-blocks.php';


/**
 * Include shortcodes
 * Each shortcode should be a separate file in the /inc/shortcodes directory
 */
// TODO include shortcode files here (if applicable)

/**
 * Include classes
 * Each class should be a separate file in the /inc/classes directory
 */
 // TODO include class files here (if applicable)