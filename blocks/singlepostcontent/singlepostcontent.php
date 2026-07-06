<?php
if (isset($block['data']['preview_image_help'])) {
    echo '<img src="' . get_template_directory_uri() . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
} else {
    $content_blocks    = get_field('content_blocks');
?>
    <section class="single-content-split-section padding-0 <?php echo esc_attr(get_field('html_wrapper_class')); ?>">
        <div class="container">

            <?php if (!empty($content_blocks)) : ?>
                <div class="single-content-grid">
                    <?php foreach ($content_blocks as $block_item) :
                        $heading = $block_item['title'];
                        $text    = $block_item['content'];

                        if (empty($heading) && empty($text)) {
                            continue;
                        }
                    ?>
                        <div class="content-column">
                            <?php if (!empty($heading)) : ?>
                                <h2 class="single-content-heading"><?php echo esc_html($heading); ?></h2>
                            <?php endif; ?>

                            <?php if (!empty($text)) : ?>
                                <p class="single-content-text"><?php echo wp_kses_post($text); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($content_blocks)) : ?>
                <div class="single-image-grid">
                    <?php foreach ($content_blocks as $block_item) :
                        $image = $block_item['image'];

                        if (empty($image)) {
                            continue;
                        }
                    ?>
                        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </section>
<?php } ?>