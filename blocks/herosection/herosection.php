<?php
if (isset($block['data']['preview_image_help'])) {
    echo '<img src="' . get_template_directory_uri() . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
} else {
    $logo         = get_field('logo');
    $heading      = get_field('content');
    $banner_image = get_field('banner');

    $services_page_url  = get_field('services_list_page');
    $services_parent_id = url_to_postid($services_page_url);

    $services = [];
    if (!empty($services_parent_id)) {
        $services = get_pages([
            'child_of'    => $services_parent_id,
            'sort_column' => 'menu_order',
            'sort_order'  => 'ASC',
        ]);
    }
?>
    <section class="hero-section <?php echo esc_attr(get_field('html_wrapper_class')); ?>">
        <div class="container">
            <div class="left-pane">

                <?php if (!empty($logo)) : ?>
                    <div class="logo-wrapper">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (!empty($heading)) : ?>
                    <div class="wysiwyg-content">
                        <?php echo wp_kses_post($heading); ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($services)) : ?>
                    <div class="services-list">
                        <?php foreach ($services as $service) : ?>
                            <a href="<?php echo esc_url(get_permalink($service->ID)); ?>">
                                /&ensp;<?php echo esc_html($service->post_title); ?>
                            </a>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <a href="#down" class="down-btn-wrapper">
                    <span class="icon down-btn">
                        <svg width="23" height="32" viewBox="0 0 23 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.5 0.859131L11.5 30.8591M11.5 30.8591L22 20.7429M11.5 30.8591L1 20.7429"
                                stroke="white" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </a>
            </div>

            <?php
            $is_image = !empty($banner_image) && strpos($banner_image['mime_type'], 'image') !== false;
            $is_video = !empty($banner_image) && strpos($banner_image['mime_type'], 'video') !== false;

            if ($is_image || $is_video) :
            ?>
                <div class="right-pane">
                    <div class="image-container">

                        <?php if ($is_image) : ?>
                            <img src="<?php echo esc_url($banner_image['url']); ?>" alt="<?php echo esc_attr($banner_image['title']); ?>" />
                        <?php elseif ($is_video) : ?>
                            <video autoplay muted loop playsinline>
                                <source src="<?php echo esc_url($banner_image['url']); ?>" type="<?php echo esc_attr($banner_image['mime_type']); ?>">
                            </video>
                        <?php endif; ?>

                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>
<?php } ?>