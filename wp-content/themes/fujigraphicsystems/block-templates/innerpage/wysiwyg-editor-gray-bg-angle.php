<?php 
    /**
     * Preview Block for Editor
     * Description: This will display the preview block on admin editor.
     * 
     * fx_preview_block_banner - 10
     * 
     */
    do_action('fx_preview_block');

	/**
     * Return null when viewing the block on admin panel 
     * as it will populate the data when previewed and make unnecessary display.
     */
    if( is_admin() ) 
        return;
?>

<section class="wysiwyg-editor gray-bg angle angle-top angle-bottom <?php echo is_page() ? 'innerpage' : ''; ?> js-detect-angle-display overflow-hidden">
	<div id="angle-top">
	    <svg viewBox="0 0 100 100" preserveAspectRatio="none">
	        <polygon points="0,100 100,0 100,100" />
	    </svg>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10 col-md-push-1">
				<div class="entry-content">
					<?php echo apply_filters('acf_the_content', get_field('content') ); ?>
				</div>
			</div>
		</div>
	</div>
	<div id="angle-bottom">
    <svg viewBox="0 0 100 100" preserveAspectRatio="none">
        <polygon points="0,0 100,0 0,100" />
    </svg>
</div>
</section>