<header class="masthead">
    <div class="container-fluid">
        <?php if ( is_search() ): ?>
            <h3 class="h1 masthead-title">Search Results</h3><?php /* different heading type for SEO benefit */ ?>
        <?php elseif ( is_home() ): ?>
            <h3 class="h1 masthead-title">News & Updates</h3><?php /* different heading type for SEO benefit */ ?>
        <?php elseif ( is_404() ) : ?>
            <h1 class="masthead-title">404: Oops! We can't find the page you're looking for.</h1>
        <?php else : ?>
            <h1 class="masthead-title"><?php the_title(); ?></h1>
        <?php endif; ?>

        <?php
            if( function_exists( 'yoast_breadcrumb' ) ) {
                yoast_breadcrumb( '<div class="breadcrumbs hidden-sm-down">', '</div>' );
            }
        ?>
    </div>
</header>
