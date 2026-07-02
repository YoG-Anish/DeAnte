<?php
if (isset($block['data']['preview_image_help'])) {
    echo '<img src="' . get_template_directory_uri() . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
} else {
    $items = get_field('items');
?>
    <section class="testimonial-wrapper <?php echo esc_attr(get_field('html_wrapper_class')); ?>">
        <div class="container">

            <?php if (!empty($items)) : ?>
                <div id="testimonial-slider" class="splide testimonial-splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php foreach ($items as $item) :
                                $client_name = !empty($item['client_name']) ? $item['client_name'] : 'Valued Customer';
                                $job_title   = $item['job_title'];
                                $content     = $item['content'];

                                if (empty($content)) {
                                    continue;
                                }
                            ?>
                                <li class="splide__slide testimonial-slide">
                                    <div class="testimonial-container">

                                        <div class="quote-icon top">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="55" height="29" viewBox="0 0 55 29" fill="none">
                                                <path d="M0 0H12.8478C22.0183 0 27.5 5.39702 27.5 14.3921C27.5 23.8853 21.9326 29 12.8478 29H0V0Z" fill="#92D5B2"></path>
                                                <path d="M27.5 0H40.3478C49.5183 0 55 5.39702 55 14.3921C55 23.8853 49.4326 29 40.3478 29H27.5V0Z" fill="#92D5B2"></path>
                                            </svg>
                                        </div>

                                        <div class="testimonial-content">
                                            <div class="quote-text">
                                                <?php echo wp_kses_post($content); ?>
                                            </div>

                                            <span class="author">
                                                / <?php echo esc_html($client_name); ?><?php echo !empty($job_title) ? ', ' . esc_html($job_title) : ''; ?>
                                            </span>
                                        </div>

                                        <div class="quote-icon bottom">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="55" height="29" viewBox="0 0 55 29" fill="none">
                                                <path d="M27.5 0H14.6522C5.48173 0 0 5.39702 0 14.3921C0 23.8853 5.56738 29 14.6522 29H27.5V0Z" fill="#92D5B2"></path>
                                                <path d="M55 0H42.1522C32.9817 0 27.5 5.39702 27.5 14.3921C27.5 23.8853 33.0674 29 42.1522 29H55V0Z" fill="#92D5B2"></path>
                                            </svg>
                                        </div>

                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

        </div>
    </section>
<?php } ?>