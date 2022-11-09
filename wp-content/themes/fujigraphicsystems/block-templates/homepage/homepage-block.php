<?php

/** 
 * $template note:
 * 
 * Block names should be prefixed with acf/. So if the name you specified in
 * fx_register_block is 'your-block-name', the name you should use here is
 * 'acf/your-block-name' 
 */

$template = [
	['acf/home-masthead-slider'], // TODO remove if not using slider. Otherwise, delete this comment.
    ['acf/homepage-half-image-half-text'],
    ['acf/video-section'],
    ['acf/homepage-testimonials'],
    ['acf/cta-half-and-half'],
    // TODO add additional blocks here and delete this comment
];

?>

<div>
    <InnerBlocks template="<?php echo esc_attr( wp_json_encode( $template ) )?>" templateLock="all" />
</div>
