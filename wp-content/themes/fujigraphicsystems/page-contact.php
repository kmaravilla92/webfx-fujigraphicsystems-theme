<?php
/**
 * Template Name: Contact Page
 */
?>

 <?php get_header(); ?>

<header class="contact-masthead">
    <div class="contact-masthead__overlay">
        <?php 
            if( get_field('section_background') ) {
                echo fx_get_image_tag( get_field('section_background'), 'contact-masthead__bg-img' );
            }
        ?>
    </div>
    <div class="container-fluid">
        <h1><?php the_title(); ?></h1>

            <?php
            if( function_exists( 'yoast_breadcrumb' ) ) {
                yoast_breadcrumb( '<div class="breadcrumbs hidden-sm-down">', '</div>' );
            }
        ?>
    </div>
</header>
<section class="">
    <div class="container-fluid">
        <div class="contact__container">
            <div class="contact-intro">
                <?php 
                    echo get_field('section_title') ? '<h2>' . get_field('section_title') . '</h2>' : ''; 
                ?>
                <div class="entry-content">
                    <?php echo apply_filters('acf_the_content', get_field('content') ); ?>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 form-half">
                    <div class="contact-form">
                        <?php echo apply_filters('acf_the_content', get_field('form_box')); ?>
                    </div>
                </div>
                <div class="col-lg-3 col-lg-push-1 details-half">
                    <?php echo apply_filters('acf_the_content', get_field('contact_details')); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <?php the_content(); ?>
<?php endwhile; endif; ?>

<?php get_footer();?>