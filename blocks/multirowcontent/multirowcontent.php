<?php
if (isset($block['data']['preview_image_help'])) {
    echo '<img src="' . get_template_directory_uri() . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
} else {
    $items       = get_field('items');
    $small_title = get_field('small_title');
    $image_size  = get_field('image_size'); // small / big
    $popup       = get_field('contact_popup');

    $total     = $items ? count($items) : 0;
    $is_single = $total <= 1;

    $section_class = $is_single ? 'image-content-section' : 'image-content-section image-content-about-section';
    $wrap_class    = $is_single ? 'image-content-wrap image-content-wrap-home' : 'image-content-wrap';
    $image_class   = 'image-column image-width-' . ($image_size === 'small' ? 'about' : 'home');
    $button_class  = $popup ? 'btn-outline btn-modal-sidebar-contact' : 'btn-outline';
?>
    <section id="down" class="<?php echo esc_attr($section_class); ?> <?php echo esc_attr(get_field('html_wrapper_class')); ?>">

        <?php if ($is_single) : ?>
            <div class="container">
            <?php endif; ?>

            <?php if (!empty($items)) : ?>
                <?php foreach ($items as $item) :
                    $image   = $item['image'];
                    $content = $item['content'];
                    $button_link  = $item['button_link'];
                    $has_button  = !empty($button_link) && !empty($button_link['url']);

                    if (empty($image) || empty($content)) {
                        continue;
                    }
                ?>

                    <?php if (!$is_single) : ?>
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

                                        <?php if ($has_button) : ?>
                                            <p>
                                                <?php if (!$is_single && !empty($small_title)) : ?>
                                                    <span class="bold-text"><?php echo esc_html($small_title); ?></span>
                                                <?php endif; ?>
                                                <a class="<?php echo esc_attr($button_class); ?>"
                                                    href="<?php echo esc_url($button_link['url']); ?>"
                                                    target="<?php echo esc_attr($button_link['target']); ?>">
                                                    <?php echo esc_html($button_link['title']); ?>
                                                </a>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <?php if (!$is_single) : ?>
                            </div>
                        </div>
                    <?php endif; ?>

                <?php endforeach; ?>
            <?php endif; ?>

            <?php if ($is_single) : ?>
            </div>
        <?php endif; ?>

    </section>
<?php } ?>