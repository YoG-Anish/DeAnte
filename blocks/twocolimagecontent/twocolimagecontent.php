<?php
if (isset($block['data']['preview_image_help'])) {
    echo '<img src="' . get_template_directory_uri() . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
} else {
    $title           = get_field('title');
    $description     = get_field('content');
    $media           = get_field('media'); // File field - accepts image or video
    $column_reverse  = get_field('column_reverse');
    $content_center  = get_field('content_center');

    $section_class = 'split-section';
    if ($column_reverse) {
        $section_class .= ' reverse';
    }

    $grid_class = 'split-grid';
    if ($content_center) {
        $grid_class .= ' items-center';
    }
?>
    <section class="<?php echo esc_attr($section_class); ?> <?php echo esc_attr(get_field('html_wrapper_class')); ?>">
        <div class="container">
            <div class="<?php echo esc_attr($grid_class); ?>">

                <div class="split-content">
                    <?php if (!empty($title)) : ?>
                        <h2 class="split-title"><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>

                    <?php if (!empty($description)) : ?>
                        <?php echo wp_kses_post($description); ?>
                    <?php endif; ?>
                </div>
                <?php
                $is_image = !empty($media) && strpos($media['mime_type'], 'image') !== false;
                $is_video = !empty($media) && strpos($media['mime_type'], 'video') !== false;

                if ($is_image || $is_video) : ?>
                    <div class="split-media">
                        <div class="media-inner">
                            <?php if ($is_image) : ?>
                                <img src="<?php echo esc_url($media['url']); ?>" alt="<?php echo esc_attr($media['title']); ?>" />
                            <?php elseif ($is_video) : ?>
                                <video autoplay muted loop playsinline>
                                    <source src="<?php echo esc_url($media['url']); ?>" type="<?php echo esc_attr($media['mime_type']); ?>">
                                </video>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </section>
<?php } ?>