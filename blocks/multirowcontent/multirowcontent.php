<?php
if (isset($block['data']['preview_image_help'])) {
    echo '<img src="' . get_template_directory_uri() . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
} else {
    $items       = get_field('items');
    $small_title = get_field('small_title');
    $button_link = get_field('button_link');
    $is_home     = get_field('is_home');
    $has_button  = !empty($button_link) && !empty($button_link['url']);

    $section_class = $is_home ? 'image-content-section' : 'image-content-section image-content-about-section';
    $wrap_class    = $is_home ? 'image-content-wrap image-content-wrap-home' : 'image-content-wrap';
    $image_class   = $is_home ? 'image-column image-width-home' : 'image-column image-width-about';

    $total = $items ? count($items) : 0;
?>
    <section class="<?php echo esc_attr($section_class); ?> <?php echo esc_attr(get_field('html_wrapper_class')); ?>">

        <?php if ($is_home) : ?>
            <div class="container">
        <?php endif; ?>

        <?php if ($items) : ?>
            <?php foreach ($items as $index => $item) :
                $image   = $item['image'];
                $content = $item['content'];
                $is_last = ($index === $total - 1);

                if (empty($image) || empty($content)) {
                    continue;
                }
            ?>

                <?php if (!$is_home) : ?>
                    <div class="image-content-about">
                        <div class="container">
                <?php endif; ?>

                            <div class="<?php echo esc_attr($wrap_class); ?>">
                                <div class="<?php echo esc_attr($image_class); ?>">
                                    <div class="image-holder">
                                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                    </div>
                                </div>

                                <div class="content-column">
                                    <div class="content">
                                        <?php echo wp_kses_post($content); ?>

                                        <?php if ($is_last && $has_button) : ?>
                                            <p>
                                                <?php if (!$is_home && !empty($small_title)) : ?>
                                                    <span class="bold-text"><?php echo esc_html($small_title); ?></span>
                                                <?php endif; ?>
                                                <a class="btn-outline<?php echo !$is_home ? ' btn-outline-full-mobile' : ''; ?>"
                                                   href="<?php echo esc_url($button_link['url']); ?>"
                                                   target="<?php echo esc_attr($button_link['target'] ); ?>">
                                                    <?php echo esc_html($button_link['title']); ?>
                                                </a>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                <?php if (!$is_home) : ?>
                        </div>
                    </div>
                <?php endif; ?>

            <?php endforeach; ?>
        <?php endif; ?>

        <?php if ($is_home) : ?>
            </div>
        <?php endif; ?>

    </section>
<?php } ?>