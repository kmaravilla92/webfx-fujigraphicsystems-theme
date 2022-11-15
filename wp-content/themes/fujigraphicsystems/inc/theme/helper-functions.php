<?php

/**
 * Create an SEO-friendly image tag based on supplied arguments
 *
 * @param	mixed   $image      Image ID (integer/string) or image URL (string)
 * @param   mixed   $class      Either string or array of classes
 * @param   string  $size       Image size
 * @param   bool    $skip_lazy  Prevent WP Rocket from lazy-loading image
 * @param   array   $atts       Additional attributes to add to tag 
 *      
 * @return  string              If valid image, then <img> string; otherwise empty string
 */
function fx_get_image_tag( $image, $classes = '', string $size = 'full', bool $skip_lazy = false, array $atts = [] ): string {
    $image_id = null;

    // determine if image ID or URL
    if( is_numeric( $image ) ) {
        $image_id = absint( $image );

    // try to find ID based on URL
    } elseif( is_string( $image ) ) {
        $image_id = attachment_url_to_postid( $image );
    }

    // if still empty, check for placeholder
    if( empty( $image_id ) ) {
        $image_id = get_field( 'placeholder_img', 'option' );
	}

    // if STILL empty, return empty string
    if( empty( $image_id ) ) {
        return '';
	}

    // if classes weren't passed as string, try to form string
    if( is_array( $classes ) ) {
        $classes = implode( ' ', $classes );
	}

    // prevent lazyloading from WP Rocket?
    if( $skip_lazy && false !== strpos( $classes, 'skip-lazy' ) ) {
        $classes .= ' skip-lazy';
    }

    // combine classes with tag attributes
    $atts = array_merge( 
        [ 
            'class' => $classes 
        ], 
        $atts 
    );
    $atts = array_filter( $atts );

    // use WP's native function to generate image element
    $src = wp_get_attachment_image_src( $image_id, $size );
    if( $src ) {
        $width = $src[1];
        $height = $src[2];
        if( $height > $width ) {
            $atts['class'] .= ' orientation--portrait';
        }
    }
    
    $tag = wp_get_attachment_image( $image_id, $size, false, $atts );

    return $tag;
}


/**
 * Strip all nonalphanumeric characters from string
 *
 * @param	string	$arg    String to strip
 * @return  string          Stripped string
 */
function fx_string_strip_special( string $arg = '' ): string {
    return preg_replace( '/[^A-Za-z0-9]/', '', $arg );
}


/**
 * Pretty-print var_dump for easier readability
 *
 * @param	mixed   $var        Variable to var_dump
 * @param   bool    $esc_html   If true, will escape HTML to prevent rendering content as HTML
 * @return  void
 */
if( !function_exists( 'fx_var_dump' ) ) {
    function fx_var_dump( $var = null, bool $esc_html = false ): void {
        if( ( defined( 'WP_DEBUG' ) && WP_DEBUG ) || 'development' === wp_get_environment_type() ) {
            echo '<pre><code>'; 

            if( $esc_html && is_string( $var ) ) {
                $var = esc_html( $var );
            }

            var_dump( $var );

            echo '</code></pre>';
        }
    }
}


/**
 * Get attachment ID for client logo
 * 
 * The image for the client logo can be set in WP Admin > Theme Settings > Media Assets > Logo
 *
 * @return  int|null     Attachment ID if logo has been set in admin; otherwise, null
 */
function fx_get_client_logo_image_id() {
    $logo_id = get_field( 'logo', 'option' );

    return $logo_id ?: null;
}


/**
 * Get client telephone number
 * 
 * The phone number can be set in WP Admin > Theme Settings > Contact Info > Phone
 *
 * @param	bool    $raw    Get phone number with special characters stripped (ideal for usage with tel: protocol)
 * @return  string|null     String if phone number set in admin; otherwise, null
 */
function fx_get_client_phone_number( bool $raw = false ) {
    $phone_number = get_field( 'phone', 'option' );

    if( !empty( $phone_number ) ) {
        if( $raw ) {
            $phone_number = fx_string_strip_special( $phone_number );
        }

        return $phone_number;
    }

    return null;
}


/**
 * Get client email address
 * 
 * The email address can be set in WP Admin > Theme Settings > Contact Info > Email
 *
 * @param	bool    $antispam   Get email address with random characters converted to HTML entities to deter spambots
 * @return  string|null         String if email address is set in admin and valid; otherwise, null
 */
function fx_get_client_email( bool $antispam = false ) {
    $email_address = get_field( 'email', 'option' );

    if( !empty( $email_address ) && is_email( $email_address ) ) {
        if( $antispam ) {
            $email_address = antispambot( $email_address );
        }

        return $email_address;
    }

    return null;
}


/**
 * Get client physical address
 * 
 * The physical address can be set in WP admin > Theme Settings > Contact Info > Address
 *
 * @return  string|null     String if email address is set in admin and valid; otherwise, null
 */
function fx_get_client_address() {
    $address = get_field( 'address', 'option' );

    return $address ?: null;
}

function print_filters_for( $hook = '' ) {
    global $wp_filter;
    if( empty( $hook ) || !isset( $wp_filter[$hook] ) )
        return;

    print '<pre>';
    print_r( $wp_filter[$hook] );
    print '</pre>';
}

/**
 * Get the youtube video id
 * @return string|null
 */
function fx_generate_video_thumbnail( $video_link ) {

    if( !$video_link )
        return null;

    $video_id = explode('?v=', $video_link);

    /**
     * Check if the video link has youtube or vimeo
     */
    if (strpos($video_id[0], 'youtu') !== false) {

        preg_match('/(http(s|):|)\/\/(www\.|)yout(.*?)\/(embed\/|watch.*?v=|)([a-z_A-Z0-9\-]{11})/i', $video_link, $results);    

        if( isset($results[6]) ) {
            $video_id = $results[6];
            $thumbnail_url = 'https://img.youtube.com/vi/'. $video_id .'/hqdefault.jpg';
        } else {
            $thumbnail_url = wp_get_attachment_url(759);
        }
    }

    if (strpos($video_id[0], 'vimeo') !== false) {
        $vimeo_url      = explode('/', $video_link);
        if( $vimeo_url[3] ) {
            $video_id       = $vimeo_url[3]; 
            $data           = file_get_contents("https://vimeo.com/api/v2/video/$video_id.json");
            $data           = json_decode($data);
            $thumbnail_url  = $data[0]->thumbnail_large;
        } else {
            $thumbnail_url  = wp_get_attachment_url(763);
        }
        
    }
   
    return $thumbnail_url;

}

/**
 * Count terms
 * @return int|string
 */
function fx_get_case_study_term_count( $term_id = '' ){

    if( ! $term_id )
        return NULL;
    
    $term = get_term_by( 'term_id', $term_id, 'case-study-category' );

    return $term->count;

}

/**
 * Get posts related to ACF block Case Study
 * @return array
 */
function fx_get_posts_case_study( $term_ids = [] ) {

    if( ! $term_ids )
        return NULL;

    $count_termId   = count( $term_ids );
    $temp_arr       = array();

    // temp posts per page
    switch( $count_termId ){ 
        case 1:
            $posts_per_page = 3;
            break;
        case 2:
            $posts_per_page = 3;
            break;
        default:
            $posts_per_page = 1;
    }
    
    $ctr = 0;
    foreach( $term_ids as $term => $term_id ) {

        // purpose to get the count of each terms
        $terms = get_term_by('term_id', $term_id,'case-study-category');

        // guess
        if( $count_termId == 2 ) {
            // first term id display 2 item
            if( $terms->count >= 2 ) {
                $posts_per_page = 2;
            } else {
                $posts_per_page = 1;
            }
        }

        $tax_query = array(
            array(
                'taxonomy' => 'case-study-category',
                'field'    => 'term_id',
                'terms'    => $term_id
            )
        );  
        
        $args = array(
            'post_type'         => 'case-study',
            'post_status'       => 'publish',
            'orderby'           => 'publish_date',
            'order'             => 'DESC',
            'posts_per_page'    => $posts_per_page,
            'tax_query'         => $tax_query
        );

        $case_study_posts = get_posts($args);

        if( $case_study_posts ) {
            $post_ctr = 0;
            foreach( $case_study_posts as $post ) {
                $temp_arr[$ctr][$post_ctr] = [
                    'post_id'           => $case_study_posts[$post_ctr]->ID,
                    'show_posts'        => $posts_per_page
                ];
                $post_ctr++;
            }
            $ctr++;
        }
        
    }
    
    //simplified the array temp
    $result_ctr = 0;
    foreach( $temp_arr as $arr ) {
        if( $arr ) {
            foreach( $arr as $val ) {
                $result[$result_ctr] = [
                    'post_id'   => $val['post_id']
                ];
                $result_ctr++;
            }
        }
    }

    return $result;

}

/**
 * Get posts from terms
 * @return object
 */
function fx_get_testimonial_posts_term( $term_id = 0 ) {

    if( $term_id == 0 )
        return NULL;

    
    $tax_query = array(
        array(
            'taxonomy' => 'testimonial_category',
            'field'    => 'term_id',
            'terms'    => $term_id
        )
    );  
    
    $args = array(
        'post_type'         => 'testimonial',
        'post_status'       => 'publish',
        'posts_per_page'    => -1,
        'tax_query'         => $tax_query
    );

    $testimonial_posts = get_posts($args);

    return $testimonial_posts;

}

/**
 * Get Taxonomies from post type
 */
function fx_get_taxonomy() {

    $post_type = get_post_type();

    switch ($post_type) {
        case 'post':
            return 'category';
            break;
        case 'case-study':
            return 'case-study-category';
            break;
        case 'testimonial':
            return 'testimonial_category';
            break;
    }

}

/**
 * Generates Categories and Sub categories. Depth up to level 2
 */
function fx_wp_terms_checklist( $post_id = 0, $args = array() ) {

    // Grab path for includes
    $theme_path = get_template_directory();

    require_once $theme_path . '/inc/theme/class-fx-walker-category-checklist.php';

    $defaults = array(
        'descendants_and_self' => 0,
        'selected_cats'        => false,
        'popular_cats'         => false,
        'walker'               => null,
        'taxonomy'             => 'category',
        'checked_ontop'        => true,
        'echo'                 => true,
    );
 
    /**
     * Filters the taxonomy terms checklist arguments.
     *
     * @since 3.4.0
     *
     * @see wp_terms_checklist()
     *
     * @param array $args    An array of arguments.
     * @param int   $post_id The post ID.
     */
    $params = apply_filters( 'wp_terms_checklist_args', $args, $post_id );
 
    $parsed_args = wp_parse_args( $params, $defaults );
    
    if ( empty( $parsed_args['walker'] ) || ! ( $parsed_args['walker'] instanceof Walker ) ) {
        $walker = new FX_Walker_Category_Checklist;
    } else {
        $walker = $parsed_args['walker'];
    }

    $taxonomy             = $parsed_args['taxonomy'];
    $descendants_and_self = (int) $parsed_args['descendants_and_self'];
 
    $args = array( 'taxonomy' => $taxonomy );
 
    $tax              = get_taxonomy( $taxonomy );
    $args['disabled'] = ! current_user_can( $tax->cap->assign_terms );
 
    $args['list_only'] = ! empty( $parsed_args['list_only'] );
 
    if ( is_array( $parsed_args['selected_cats'] ) ) {
        $args['selected_cats'] = array_map( 'intval', $parsed_args['selected_cats'] );
    } elseif ( $post_id ) {
        $args['selected_cats'] = wp_get_object_terms( $post_id, $taxonomy, array_merge( $args, array( 'fields' => 'ids' ) ) );
    } else {
        $args['selected_cats'] = array();
    }
 
    if ( is_array( $parsed_args['popular_cats'] ) ) {
        $args['popular_cats'] = array_map( 'intval', $parsed_args['popular_cats'] );
    } else {
        $args['popular_cats'] = get_terms(
            array(
                'taxonomy'     => $taxonomy,
                'fields'       => 'ids',
                'orderby'      => 'count',
                'order'        => 'DESC',
                'number'       => 10,
                'hierarchical' => false,
            )
        );
    }
 
    if ( $descendants_and_self ) {
        $categories = (array) get_terms(
            array(
                'taxonomy'     => $taxonomy,
                'child_of'     => $descendants_and_self,
                'hierarchical' => 0,
                'hide_empty'   => 0,
            )
        );
        $self       = get_term( $descendants_and_self, $taxonomy );
        array_unshift( $categories, $self );
    } else {
        $categories = (array) get_terms(
            array(
                'taxonomy' => $taxonomy,
                'get'      => 'all',
            )
        );
    }
 
    $output = '';
 
    if ( $parsed_args['checked_ontop'] ) {
        // Post-process $categories rather than adding an exclude to the get_terms() query
        // to keep the query the same across all posts (for any query cache).
        $checked_categories = array();
        $keys               = array_keys( $categories );
 
        foreach ( $keys as $k ) {
            if ( in_array( $categories[ $k ]->term_id, $args['selected_cats'], true ) ) {
                $checked_categories[] = $categories[ $k ];
                unset( $categories[ $k ] );
            }
        }
 
        // Put checked categories on top.
        $output .= $walker->walk( $checked_categories, 0, $args );
    }
    // Then the rest of them.
    $output .= $walker->walk( $categories, 0, $args );
 
    if ( $parsed_args['echo'] ) {
        echo $output;
    }
 
    return $output;
}

/**
 * Place a flexible content to be use only for archives and taxonomy pages.
 */
add_action('wp_enqueue_scripts', 'fx_archive_tax_enqueue_scripts');
function fx_archive_tax_enqueue_scripts() {

    $theme_dir = get_stylesheet_directory();
    $theme_url = get_stylesheet_directory_uri();
    
    if( is_archive() || is_tax() || is_home() || is_singular('case-study')) { 
        fx_assets_add_stylesheet(
            [
                'handle'    => 'cta-half-and-half',
                'src'       => $theme_url . '/assets/css/blocks/innerpage/cta-half-and-half.css',
                'inline'    => false,
                'enqueue' => true,
            ]
        );

        fx_assets_add_stylesheet(
            [
                'handle'    => 'full-width-cta',
                'src'       => $theme_url . '/assets/css/blocks/innerpage/cta-full-width.css',
                'inline'    => false,
                'enqueue' => true,
            ]
        );

        fx_assets_add_stylesheet(
            [
                'handle'    => 'attention-block',
                'src'       => $theme_url . '/assets/css/blocks/innerpage/attention-block.css',
                'inline'    => false,
                'enqueue' => true,
            ]
        );
    }

}

function fx_cta_block_case_study_post() {

    $field = 'cta_case_study_block';
    

    if( have_rows($field) ):

        // Loop through rows.
        while ( have_rows($field) ) : the_row();
            if( get_row_layout() == '5050_cta' ):
                get_template_part('partials/archive-flexbox/cta-half-and-half');

                elseif( get_row_layout() == 'attention_block' ): 
                    get_template_part('partials/archive-flexbox/attention-block');

                elseif( get_row_layout() == 'full_width_cta' ): 
                    get_template_part('partials/archive-flexbox/cta-full-width');

            endif;
        // End loop.
        endwhile;
    
    // No value.
    else :
        // Do something...
    endif;

}

function fx_flexible_content_archives_tax( $field = '' ) {

    if( $field == '' ) {
        
        $post_type = get_post_type();

        if( $post_type == 'case-study' ) {
            $field = 'case_study_call_to_action__footer';
        } else if( $post_type == 'post' ) {
            $field = 'blog_call_to_action__footer';
        } else {
            $field = '';
        }

    }   

    if( have_rows($field,'option') ):

        // Loop through rows.
        while ( have_rows($field,'option') ) : the_row();
            if( get_row_layout() == '5050_cta' ):
                get_template_part('partials/archive-flexbox/cta-half-and-half');

                elseif( get_row_layout() == 'attention_block' ): 
                    get_template_part('partials/archive-flexbox/attention-block');

                elseif( get_row_layout() == 'full_width_cta' ): 
                    get_template_part('partials/archive-flexbox/cta-full-width');

            endif;
        // End loop.
        endwhile;
    
    // No value.
    else :
        // Do something...
    endif;

}
/**
 * Disabled block editor for post.
 */
// add_filter('use_block_editor_for_post_type', 'prefix_disable_gutenberg', 10, 2);
function prefix_disable_gutenberg($current_status, $post_type)
{
    // Use your post type key instead of 'product'
    if ($post_type === 'post') return false;
    return $current_status;
}
/**
 * Disable widget block editor
 */
add_filter( 'use_widgets_block_editor', '__return_false' );

add_action( 'widgets_init', 'fx_register_dynamic_category' );
function fx_register_dynamic_category() {
    register_widget( 'dynamic_categories' );
}
$theme_path = get_template_directory();
require_once $theme_path . '/inc/theme/class-fx-dynamic-categories-widget.php';   

function fx_get_post_type_label() {
    $post_type_name = get_post_type_object( get_post_type() );
    $label_singular = $post_type_name->labels->singular_name;
    return $label_singular;
}
    
// Insert scripts to footer
add_action('wp_footer','fx_hook_footer_scripts');
function fx_hook_footer_scripts() {

    $scripts = get_field('tracker_code','option');

    if( $scripts ) {
        echo $scripts;
    }

}

/**
 * Ajax handling request for Video Sub Category
 */
add_action('wp_ajax_fx_video_sub_cat','video_sub_categories');
add_action('wp_ajax_nopriv_fx_video_sub_cat','video_sub_categories');
function video_sub_categories() {
    
    if ( ! wp_verify_nonce( $_POST['nonce'], 'fx_ajax_nonce' ) ) {
        die ( 'Busted!');
    }

    if( isset( $_POST['subCat'] ) ) {
        $parent_id = (int) $_POST['subCat'];
    }
    
    if( $parent_id ) {
        $children   = get_term_children( $parent_id, 'video-category' ); 
        $html       = '';
        if( $children ) {
            foreach( $children as $child ) {
                $child_term = get_term_by('id', $child, 'video-category'); 
                $html       .= "<li><a href='javascript:void(0)' parent-term-id='{$parent_id}' term-name='{$child_term->slug}' term-id='{$child_term->term_id}'>{$child_term->name}</a></li>";
            }
        }
    }
    
    wp_send_json_success( 
        array(
            'sub_categories'	=> $html, 
        )
    );
    
    wp_die();
}

/**
 * Ajax load Video Posts
 */
add_action('wp_ajax_fx_video_posts_category','fx_video_posts');
add_action('wp_ajax_nopriv_fx_video_posts_category','fx_video_posts');
function fx_video_posts() {
    
    if ( ! wp_verify_nonce( $_POST['nonce'], 'fx_ajax_nonce' ) ) {
        die ( 'Busted!');
    }

    if( isset( $_POST['categories'] ) ) {

        if( (int) $_POST['categories'] == 0 ) {
            $tax_query = '';
        } else {
            $categories = filter_input( INPUT_POST, 'categories', FILTER_SANITIZE_NUMBER_INT, FILTER_FORCE_ARRAY );
            
            $tax_query = array(
                array(
                    'taxonomy' => 'video-category',
                    'field'    => 'term_id',
                    'terms'    => $categories
                )
            );
        }

    }
    
    if( isset( $_POST['paged'] ) ) {
        $paged = (int) $_POST['paged'];
        $paged = $paged + 1;
    } else {
        $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
    }
              
    if( isset( $_POST['postsPerPage'] ) ) {
        $posts_per_page = (int) $_POST['postsPerPage'];
    }

    $video_args = array(
        'post_type'         => 'video',
        'posts_per_page'    => $posts_per_page,
        'tax_query'         => $tax_query,
        'paged'             => $paged,
        'orderby'           => 'date',
        'order'             => 'ASC',
    );

    $obj_videos = new WP_Query( $video_args );
    
    if( $obj_videos->have_posts() ):
        ob_start();
           
            get_template_part('block-templates/innerpage/filter/partials/video','loop' , [ 'video' => $obj_videos ] );
        
        $output = ob_get_contents();
        ob_end_clean();

    endif;

    wp_send_json_success( 
        array(
            'videos'	        => $output,
            'paged'             => $paged,
            'max_num_pages'     => $obj_videos->max_num_pages,
            'found_posts'       => $obj_videos->found_posts
        )
    );

    wp_die();

}