<section class="wysiwyg section-margins general-wysiwyg <?php echo get_field('select_background'); ?>-bg <?php echo is_page() ? 'innerpage' : ''; ?>">

	<div class="container-fluid">
		<div class="row">
			<div class="<?php echo ( is_single() ) ? 'col-xs-12' : 'col-md-10 col-md-offset-1'; ?>">
				<div class="wysiwyg__content">
					<?php the_field( 'content' ); ?>
				</div>
			</div>
		</div>
	</div>
	
</section>