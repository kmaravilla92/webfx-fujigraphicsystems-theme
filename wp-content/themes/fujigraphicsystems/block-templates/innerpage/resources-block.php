<?php 
    /**
     * Preview Block for Editor
     * Description: This will display the preview block on admin editor.
     * 
     * fx_preview_block_banner - 10
     * 
     */
    do_action('fx_preview_block');

    $background_color   = esc_attr(get_field('background_color'));
    $text               = wp_kses_post(get_field('text'));
    $resources          = get_field('resources');
    $cta_link           = $resources['cta_link'];
?>
<section class="resources-section <?php echo $background_color; ?>">
    <div class="container-fluid">
        <?php if ($text) { ?>
        <header class="resources-section__header">
            <?php echo $text; ?>
        </header>
        <?php } ?>

        <?php
        the_row();
        $post_type      = $resources['post_type'];
        $read_more_text = $resources['read_more_text'];
        
        $resource_items = [];

        if ('manual' === $post_type) {
            $resource_items = $resources['manual_items'];
        } else {
            $resource_items_query = new WP_Query([
                'post_type'         => $post_type,
                'posts_per_page'    => 3,
                'post_status'       => 'publish'
            ]);

            if ($resource_items_query->have_posts()) {
                while ($resource_items_query->have_posts()) {
                    $resource_items_query->the_post();
                    $id = get_the_ID();
                    $resource_item = [
                        'type'          => $post_type,
                        'image'         => get_post_thumbnail_id(),
                        'title'         => get_the_title(),
                        'text'          => get_the_excerpt(),
                        'button_link' => [
                            'url'       => get_the_permalink(),
                            'title'     => $read_more_text,
                            'target'    => '_blank',
                        ],
                    ];

                    if ('video' === $post_type) {
                        $resource_item = array_merge(
                            $resource_item,
                            [
                                'title'         => get_field('heading', $id) ?: get_the_title(),
                                'image'         => get_field('video_thumbnail', $id),
                                'text'          => get_field('short_description', $id),
                                'button_link'   => array_merge(
                                    $resource_item['button_link'],
                                    [
                                        'url' => get_field('video_link', $id),
                                    ]
                                ),
                            ]
                        );
                    }

                    $resource_items[] = $resource_item;
                }
            }

            wp_reset_postdata();
        }
        ?>
        <div class="row resources">
            <?php foreach ($resource_items as $ri => $resource_item): ?>
            <?php
            $type               = $resource_item['type'];
            $image              = $resource_item['image'];
            $title              = wp_kses_post($resource_item['title']);
            $text               = wp_kses_post($resource_item['text']);
            $button_link        = $resource_item['button_link'];

            $is_video           = 'video' === $type;
            $has_footer         = !empty($button_link);
            $fancybox_attr      = $is_video ? 'data-fancybox' : '';

            $default_image = fx_get_image_tag(get_field('placeholder_image', 'option'), 'resource__image');
            if ($is_video) {
                if (empty($image)) {
                    $generated_video_url = fx_generate_video_thumbnail($button_link['url']);
                    $image = sprintf(
                        '<img src="%s" class="resource__image" alt="%s">',
                        esc_url($generated_video_url),
                        esc_attr($title)
                    );
                } else {
                    $image = fx_get_image_tag($image, 'resource__image');
                }
            } else if ($image) {
                $image = fx_get_image_tag($image, 'resource__image');
            } else {
                $image = $default_image;
            }
            ?>   
            <div class="col-sm-6 col-lg-4 resources__item resources__item--<?php echo $type; ?>">
                <article class="resource">
                    <?php if ($button_link): ?>
                    <a class="resource__link resource__link--no-border" href="<?php echo esc_url($button_link['url']); ?>" <?php echo $fancybox_attr; ?>>
                    <?php endif; ?>
                        <figure class="resource__figure">
                            <?php if ($is_video): ?>
                            <div class="resource__figure-overlay">
                                <i class="resource__figure-overlay-icon icon icon-play-circle"></i>
                            </div>
                            <?php endif; ?>
                            <?php echo $image; ?>
                        </figure>
                    <?php if ($button_link): ?>
                    </a>
                    <?php endif; ?>

                    <div class="resource__body">
                        <?php if ($title): ?>
                        <h3 class="resource__title"><?php echo $title; ?></h3>
                        <?php endif; ?>

                        <?php echo wp_trim_words($text, 20, '&#8230;'); ?>
                    </div>

                    <?php if ($has_footer): ?>
                    <footer class="resource__footer">
                        <?php if ($button_link): ?>
                            <a class="resource__link btn btn-secondary" href="<?php echo esc_url($button_link['url']); ?>" target="<?php echo esc_url($button_link['target']); ?>" <?php echo $fancybox_attr; ?>>
                                <?php echo esc_html($button_link['title']); ?>
                                <!-- <i class="icon-long-arrow-alt-right resource__link-icon"></i> -->
                            </a>
                        <?php endif; ?>
                    </footer>
                    <?php endif; ?>
                </article>
            </div>
            <?php endforeach; ?>
        </div>

        <?php if ($cta_link): ?>
        <div class="text-center">
            <a class="btn btn-primary" href="<?php echo esc_url($cta_link['url']); ?>" target="<?php echo esc_attr($cta_link['target']) ?>">
                <?php echo esc_html($cta_link['title']); ?>
            </a>
        </div>
        <?php endif; ?>
    </div>
</section>