<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link rel="icon" href="<?php bloginfo('template_url')?>/assets/img/favicon.ico" type="image/x-icon"/>
    <!-- TODO: Add font code here -->
    <link href="https://fonts.googleapis.com/css2?family=Arimo:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

    <?php wp_head(); ?>
</head>

<body id="top" <?php body_class(); ?>>

    <?php wp_body_open(); ?>

    <?php
        // gets client logo image set in Theme Settings
        $logo_id    = fx_get_client_logo_image_id(); 
        $home_url   = get_home_url();

        $schedule_demo_label = get_field('schedule_demo_button_label', 'option');
        $schedule_demo_label = ( !empty( $schedule_demo_label ) ) ? $schedule_demo_label : 'Schedule a demo';
    ?>

    <header class="page-header" id="page-header">
        <div class="container-fluid clearfix">
            <div class="logo">
                <a href="<?php echo $home_url; ?>">
                    <?php echo fx_get_image_tag( $logo_id, 'img-responsive',  ); ?>
                </a>
            </div>
            <div class="header-right">
                <?php 
                    // wp_nav_menu( array('menu' => 'Main Navigation', 'menu_class' => 'menu-main-navigation menu clearfix', 'container' => 'nav', 'container_class' => 'nav-primary') ); 
                    ubermenu( 'main' , array( 
                            'theme_location' => 'main_menu',
                            'menu_class' => 'menu-main-navigation menu clearfix',
                            'container' => 'nav',
                            'container_class' => 'nav-primary'
                    ) );    
                ?>
                <div class="header-button hidden-xs-down hidden-lg">
                    <a href="<?php echo get_field('schedule_demo_link', 'option'); ?>" class="btn btn-primary"><?php echo $schedule_demo_label; ?></a>
                </div>
                <div class="search">
                    <span class="icon-magnify"></span>
                </div>
                <div class="header-button hidden-md-down">
                    <a href="<?php echo get_field('schedule_demo_link', 'option'); ?>" class="btn btn-primary"><?php echo $schedule_demo_label; ?></a>
                </div>
                <div class="menu-toggle hidden-lg">
                    <span class="icon-menu"></span>
                    MENU
                </div>
            </div>
        </div>
        <div class="mobile-header-button hidden-sm-up">
            <a href="<?php echo get_field('schedule_demo_link', 'option'); ?>" class="btn btn-primary"><?php echo $schedule_demo_label; ?></a>
        </div>
        <div class="search-div">
            <form action="<?php echo esc_url( home_url( '/' ) ); ?>"  method="get">
                <div class="search-column">
                    <input type="text" placeholder="Search" name="s" id="s" value="" data-swplive="true">
                    <button class="icon-magnify" type="submit"></button>
                </div>
            </form>
        </div>
		<!-- Global site tag (gtag.js) - Google Analytics -->
			<script async src=https://www.googletagmanager.com/gtag/js?id=G-9L7ZYPC0MP></script>

			<script>
			  window.dataLayer = window.dataLayer || [];
			  function gtag(){dataLayer.push(arguments);}
			  gtag('js', new Date());
			  gtag('config', 'UA-219831008-1');
			  gtag('config', 'G-9L7ZYPC0MP');
			</script>
    </header>