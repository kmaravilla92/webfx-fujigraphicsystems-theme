<?php get_header(); ?>
<?php get_template_part('partials/masthead'); ?>
<?php
    $search_query   = get_search_query();
    $paged          = get_query_var( 'paged' );
    if( empty( $paged ) ) {
        $paged = 1;
    }

    $search_results = FX_Load_More()->search->get_tabbed_results( $search_query, $paged );

    $tabbed_content = [];
    $active_id      = null;
    foreach( $search_results as $post_type_key => $data ) {
        $tab_id = sanitize_title( $post_type_key );
        $label  = sprintf( '%s (%s)', $data['tab_title'], $data['tab_count'] );

        // set tab to be active on page load
        if( empty( $active_id ) ) {
            $active_id = $tab_id;
        }

        $data['label'] = $label;
        $tabbed_content[ $tab_id ] = $data;
    }

    print_r($search_results);
?>
<?php if( $data['posts'] ){ ?>
<section class="section-margins">
	<div class="container">
		<div class="row">
			<div class="col-xxs-12">

                <div class="tab-accordion js-tab-accordion">

                    <div class="tab-accordion__tabs hidden-sm-down">
                        <?php foreach( $tabbed_content as $id => $data ): ?>
                            <button
                                class="tab-accordion__tab js-tab-accordion-btn <?php if( $id === $active_id ) echo 'is-active'; ?>"
                                type="button"
                                data-tab-id="<?php echo esc_attr( $id ); ?>"
                            ><?php echo $data['label']; ?></button>
                        <?php endforeach; ?>
                    </div>

                    <div class="tab-accordion__panels">
                        <?php foreach( $tabbed_content as $tab_id => $data ): ?>
                            <article
                                class="tab-accordion__panel js-tab-accordion-panel js-load-more-block <?php if( $tab_id === $active_id ) echo 'is-active'; ?>"
                                data-tab-id="<?php echo esc_attr( $tab_id ); ?>"
                                data-load-more-post-type="<?php echo esc_attr( $data['post_type_key'] ); ?>"
                                data-load-more-total="<?php echo esc_attr( $data['tab_count'] ); ?>"
                                data-load-more-current-page="<?php echo esc_attr( $paged ); ?>"
                                data-load-more-search-query="<?php echo esc_attr( $search_query ); ?>"
                            >
                                <button
                                    class="tab-accordion__panel__toggle js-tab-accordion-btn hidden-md-up <?php if( $tab_id === $active_id ) echo 'is-active'; ?>"
                                    type="button"
                                    data-tab-id="<?php echo esc_attr( $tab_id ); ?>"
                                ><?php echo $data['label']; ?></button>

                                <div class="tab-accordion__panel__content">
                                    <?php if( !empty( $data['posts'] ) ): ?>
                                        <div class="search-results js-load-more-posts">
                                            <?php
                                                foreach( $data['posts'] as $post ) {
                                                    setup_postdata( $post );
                                                    get_template_part(
                                                        'partials/search-result',
                                                        null,
                                                        [
                                                            'query' => $search_query // used for highlighting search term
                                                        ]
                                                    );
                                                }
                                            ?>
                                        </div>
                                        <div class="blog-listing__pagination">
                                            <div class="col-xxs-12">
                                                <?php get_template_part( 'partials/pagination' ); ?>
                                            </div>
                                        </div>

                                    <?php else: ?>
                                        <div class="search-results">No results for "<?php echo esc_html( $search_query ); ?>."</div>
                                    <?php endif; ?>
                                </div>
                            </article>
                        <?php endforeach; ?>
                        <?php wp_reset_postdata(); ?>
                    </div>

                </div>

            </div>
        </div>
    </div>
</section>
<?php } else { ?>
    <section class="links-404">
        <div class="container-fluid">
            <div class="not-found__wrapper">
                <div class="item-content">
                    <h3 class="search-error">Sorry, we couldn't find any results that matched <i><strong><?php echo esc_html( $search_query ); ?></strong></i></h3>
                </div>
            </div>
            <div class="">
                <div class="col-xxs-12 col-md-6">
                    <div class="search-404">
                        <h4>Or, try searching our site:</h4>
                        <form action="" method="get">
                            <input type="text" name="s" id="s" value="" data-swplive="true" /> <!-- data-swplive="true" enables SearchWP Live Search -->
                            <button class="search-btn mobile-hview" type="submit">Search</button>
                            <div class="search-column mobile-dview">
                                <button type="submit"><i class="icon-magnify"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-xxs-12 col-md-6">
                    <div class="contact-404 text-center">
                        <h4>Still can't find what you're looking for?</h4>
                        <a href="<?php echo get_field('contact_us_link', 'option'); ?>" class="btn">Contact Us Today!</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php } ?>
<?php get_footer();
