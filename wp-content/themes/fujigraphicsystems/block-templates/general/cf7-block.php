<div class="container section-margins">
    <?php
        $form = get_field('cf7_shortcode');
    
        if( !empty( $form ) ) {
            echo apply_shortcodes( $form );
        }
    ?>
</div>