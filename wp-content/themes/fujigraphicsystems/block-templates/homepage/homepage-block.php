<?php

/** 
 * $template note:
 * 
 * Block names should be prefixed with acf/. So if the name you specified in
 * fx_register_block is 'your-block-name', the name you should use here is
 * 'acf/your-block-name' 
 */

$template = [
    // Original Home page related blocks
	['acf/home-masthead-slider'],
    ['acf/homepage-half-image-half-text'],
    ['acf/video-section'],
    ['acf/homepage-testimonials'],
    ['acf/cta-half-and-half'],
    
    // New Inner page related blocks
    ['acf/video-section'],
    ['acf/wysiwyg'],
    ['acf/case-study-section'],
    ['acf/attention-block'],
    ['acf/resources-block'],
];

?>

<div>
    <InnerBlocks template="<?php echo esc_attr( wp_json_encode( $template ) )?>" templateLock="all" />
</div>
