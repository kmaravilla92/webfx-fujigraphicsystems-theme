<?php
	$thumb_id = get_post_thumbnail_id();

	// if no thumb ID, check for placeholder image (from ACF options page)
	if( empty( $thumb_id ) ) {
		$thumb_id = get_field( 'placeholder_image', 'option' );
	}

	$get_term = [
		[
			'post_type'			=> 'case-study',
			'taxonomy'			=> 'case-study-category',
			'description_field'	=> 'intro_text'
		],
		[
			'post_type'			=> 'post',
			'taxonomy'			=> 'category',
			'description_field'	=> 'excerpt'
		],
		[
			'post_type' 		=> 'testimonial',
			'taxonomy'  		=> 'testimonial_category',
			// 'description_field'	=> 'excerpt'
		]
	];

	foreach( $get_term as $type ) {
		if( get_post_type() == $type['post_type'] ) {
			$taxonomy = $type['taxonomy'];
		}
	}

	$img_tag 	= fx_get_image_tag( $thumb_id, 'blog-post__img', 'archive_post_image' );
	$permalink 	= get_permalink();
	$terms 		= wp_get_object_terms( get_the_ID(), $taxonomy );
	$excerpt 	= wp_trim_words( get_the_excerpt(), 20, ' &hellip;' );
?>

<div class="col-xxs-12 col-sm-6 post__item" data-mh="mh-blog-item">
	<article class="blog-post__item">

		<?php if( !empty( $img_tag ) ): ?>
			<a class="blog-post__img-container show" href="<?php echo esc_url( $permalink ); ?>">
				<?php echo $img_tag; ?>
			</a>
		<?php endif; ?>

		<div class="blog-post__meta" data-mh="post-mh">
			<?php if( !empty( $terms ) ): ?>
				<div class="blog-post__tags">
					<?php $ctr = 1; $count_cat = count($terms); foreach( $terms as $term ): ?>
						<a class="blog-post__tag" href="<?php echo esc_url( get_term_link( $term ) ); ?>">
							<h5 class="h6-lg"><?php echo $term->name; ?></h5>
						</a>
					<?php
						if( $ctr !== $count_cat ) {
							echo ' | ';
						}
						$ctr++;

						endforeach;
					?>
				</div>
			<?php endif; ?>

			<h3 class="blog-post__title">
				<a class="blog-post__title__link" href="<?php echo esc_url( $permalink ); ?>"><?php the_title(); ?></a>
			</h3>

			<div class="blog-post__excerpt push-bottom">
				<?php
					foreach( $get_term as $type ) {
						if( $type['post_type'] == get_post_type() ) {
							if( $type['description_field'] !== 'excerpt' ) {
								echo wp_trim_words( wp_strip_all_tags( get_field( 'intro_text', get_the_ID() ) ), 20, ' &hellip;' );
							} else {
								echo $excerpt;
							}
						}
					}
				?>
			</div>

		</div>
		<div class="cta-post__wrapper">
			<a class="blog-post__link btn btn-secondary" href="<?php echo esc_url( $permalink ); ?>">Read Full <?php echo fx_get_post_type_label(); ?></a>
		</div>
	</article>
</div>
