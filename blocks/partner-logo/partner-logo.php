<?php
if (isset($block['data']['preview_image_help'])) {
    echo '<img src="' . get_template_directory_uri() . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
} else {
    $title = get_field('title');
    $items = get_field('items');
?>
    <section class="partners-section <?php echo esc_attr(get_field('html_wrapper_class')); ?>">
        <div class="container">
            <?php if (!empty($title)) : ?>
                <h2 class="partners-heading h2-margin"><?php echo esc_html($title); ?></h2>
            <?php endif; ?>
        </div>

        <?php if (!empty($items)) : ?>
            <div id="partner-slider" class="splide partner-splide" aria-label="Client Partners">
                <div class="splide__track">
                    <ul class="splide__list">
                        <?php foreach ($items as $item) :
                            $logo = $item['logo'];
                            if (empty($logo)) {
                                continue;
                            }
                        ?>
                            <li class="splide__slide partner-slide">
                                <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt'] ?: 'Partner logo'); ?>" />
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        <?php endif; ?>

    </section>
<?php } ?>