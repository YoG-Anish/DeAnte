<?php
if (isset($block['data']['preview_image_help'])) {
    echo '<img src="' . get_template_directory_uri() . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
} else {
    $section_title       = get_field('title');
    $section_description = get_field('description');
    $grid_type            = get_field('choose_grid_layout'); // grid_3 / grid_4
    $use_small_icon       = get_field('icon_size_and_layout');
    $items                = get_field('items');
    $is_grid_3 = $grid_type === 'grid_3';
    $grid_class = 'expertise-grid ' . ($is_grid_3 ? 'grid-3' : 'grid-4') . ($use_small_icon ? ' card-princ-40' : '');
?>
    <section class="expertise-wrapper <?php echo esc_attr(get_field('html_wrapper_class')); ?>">
        <div class="container">

            <?php if (!empty($section_title)) : ?>
                <h2 class="expertise-title <?php echo empty($section_description) ? 'h2-margin' : ''; ?>">
                    <?php echo esc_html($section_title); ?>
                </h2>
            <?php endif; ?>

            <?php if (!empty($section_description)) : ?>
                <?php echo wp_kses_post($section_description); ?>
            <?php endif; ?>

            <?php if (!empty($items)) : ?>
                <div class="<?php echo esc_attr($grid_class); ?>">
                    <?php foreach ($items as $item) :
                        $icon        = $item['icon'];
                        $card_title  = $item['title'];
                        $description = $item['description'];
                        $link        = $item['page_linked_to'];

                        if (empty($card_title)) {
                            continue;
                        }
                    ?>

                        <?php if (!empty($link)) : ?>
                            <a href="<?php echo esc_url($link['url']); ?>" class="expertise-card">
                        <?php else : ?>
                            <div class="expertise-card">
                        <?php endif; ?>

                            <div class="card-inner">
                                <div class="card-top">
                                    <?php if (!empty($icon)) : ?>
                                        <div class="card-icon">
                                            <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" />
                                        </div>
                                    <?php endif; ?>

                                    <?php if (!empty($link)) : ?>
                                        <span class="card-arrow">
                                            <svg width="32" height="23" viewBox="0 0 32 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M0.666504 11.5L30.6665 11.5M30.6665 11.5L20.5502 1M30.6665 11.5L20.5502 22"
                                                      stroke="#92D5B2" stroke-linecap="round" stroke-linejoin="round"></path>
                                            </svg>
                                        </span>
                                    <?php endif; ?>
                                </div>

                                <div class="card-bottom">
                                    <h3><?php echo esc_html($card_title); ?></h3>
                                    <?php if (!empty($description)) : ?>
                                        <?php echo wp_kses_post($description); ?>
                                    <?php endif; ?>
                                </div>
                            </div>

                        <?php if (!empty($link)) : ?>
                            </a>
                        <?php else : ?>
                            </div>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </section>
<?php } ?>