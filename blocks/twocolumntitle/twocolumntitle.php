<?php
if (isset($block['data']['preview_image_help'])) {
    echo '<img src="' . get_template_directory_uri() . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
} else {
    $image           = get_field('image');
    $title           = get_field('title');
    $content         = get_field('content');
    $project_details = get_field('project_details');
?>
    <section class="inner-banner-section <?php echo esc_attr(get_field('html_wrapper_class')); ?>">
        <div class="container split-layout">

            <?php if (!empty($image)) : ?>
                <div class="inner-banner-graphic ">
                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                </div>
            <?php endif; ?>

            <div class="inner-banner-content">
                <?php if (!empty($title)) : ?>
                    <span class="inner-banner-label highlight"><?php echo esc_html($title); ?></span>
                <?php endif; ?>

                <?php if (!empty($content)) : ?>
                    <h1 class="inner-banner-heading">
                        <?php echo wp_kses_post($content); ?>
                    </h1>
                <?php endif; ?>

                <?php if (!empty($project_details)) : ?>
                    <div class="project-details">
                        <?php foreach ($project_details as $detail) :
                            $detail_label = $detail['label'];
                            $values       = $detail['values'];

                            if (empty($detail_label) || empty($values)) {
                                continue;
                            }
                        ?>
                            <div class="detail-item">
                                <span class="detail-label"><?php echo esc_html($detail_label); ?></span>
                                <div class="detail-value">
                                    <?php foreach ($values as $value) :
                                        if (empty($value['value_item'])) {
                                            continue;
                                        }
                                    ?>
                                        <span>/&ensp;<?php echo esc_html($value['value_item']); ?></span>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>
    </section>
<?php } ?>