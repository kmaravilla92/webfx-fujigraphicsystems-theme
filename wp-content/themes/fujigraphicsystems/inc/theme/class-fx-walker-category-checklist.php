<?php

class FX_Walker_Category_Checklist extends Walker {
    public $tree_type = 'category';
    public $db_fields = array(
        'parent' => 'parent',
        'id'     => 'term_id',
    ); // TODO: Decouple this.
 
    /**
     * Starts the list before the elements are added.
     *
     * @see Walker:start_lvl()
     *
     * @since 2.5.1
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int    $depth  Depth of category. Used for tab indentation.
     * @param array  $args   An array of arguments. @see wp_terms_checklist()
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent  = str_repeat( "\t", $depth );
        $output .= "$indent<ul class='children'>\n";
    }
 
    /**
     * Ends the list of after the elements are added.
     *
     * @see Walker::end_lvl()
     *
     * @since 2.5.1
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int    $depth  Depth of category. Used for tab indentation.
     * @param array  $args   An array of arguments. @see wp_terms_checklist()
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $indent  = str_repeat( "\t", $depth );
        $output .= "$indent</ul>\n";
    }
 
    /**
     * Start the element output.
     *
     * @see Walker::start_el()
     *
     * @since 2.5.1
     *
     * @param string  $output   Used to append additional content (passed by reference).
     * @param WP_Term $category The current term object.
     * @param int     $depth    Depth of the term in reference to parents. Default 0.
     * @param array   $args     An array of arguments. @see wp_terms_checklist()
     * @param int     $id       ID of the current term.
     */
    public function start_el( &$output, $category, $depth = 0, $args = array(), $id = 0 ) {
        if ( empty( $args['taxonomy'] ) ) {
            $taxonomy = 'category';
        } else {
            $taxonomy = $args['taxonomy'];
        }
 
        if ( 'category' === $taxonomy ) {
            $name = 'post_category';
        } else {
            $name = 'tax_input[' . $taxonomy . ']';
        }
 
        $args['popular_cats'] = ! empty( $args['popular_cats'] ) ? array_map( 'intval', $args['popular_cats'] ) : array();
 
        $class = in_array( $category->term_id, $args['popular_cats'], true ) ? ' class="popular-category"' : '';

        if ( ! empty( $args['list_only'] ) ) {
            $aria_checked = 'false';
            $inner_class  = 'category';
 
            $output .= "\n" . '<li' . $class . '>' .
                '<div class="' . $inner_class . '" data-term-id=' . $category->term_id .
                ' tabindex="0" role="checkbox" aria-checked="' . $aria_checked . '">' .
                /** This filter is documented in wp-includes/category-template.php */
                esc_html( apply_filters( 'the_category', $category->name, '', '' ) ) . '</div>';
        } else {
            $term_link   = get_term_link( $category );
        
            $output .= "\n<li id='{$taxonomy}-{$category->term_id}'$class>" .
                /** This filter is documented in wp-includes/category-template.php */
                "<a class='h6-lg' href='{$term_link}'>{$category->name}</a> ";
        }
    }
 
    /**
     * Ends the element output, if needed.
     *
     * @see Walker::end_el()
     *
     * @since 2.5.1
     *
     * @param string  $output   Used to append additional content (passed by reference).
     * @param WP_Term $category The current term object.
     * @param int     $depth    Depth of the term in reference to parents. Default 0.
     * @param array   $args     An array of arguments. @see wp_terms_checklist()
     */
    public function end_el( &$output, $category, $depth = 0, $args = array() ) {
        $output .= "</li>\n";
    }
}