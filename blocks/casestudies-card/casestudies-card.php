<?php
if (isset($block['data']['preview_image_help'])) {
    echo '<img src="' . get_template_directory_uri() . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
} else {
    $terms = get_terms(['taxonomy' => 'services-category', 'hide_empty' => true]);

    $initial_query = new WP_Query([
        'post_type'      => 'case-study',
        'posts_per_page' => 5,
        'paged'          => 1,
    ]);

    $has_more = $initial_query->max_num_pages > 1;
?>
    <section class="case-studies-wrapper <?php echo esc_attr(get_field('html_wrapper_class')); ?>">
        <div class="container">

            <nav class="filter-nav">
                <button class="filter-btn active" data-filter="all">Show all</button>
                <?php foreach ($terms as $term) : ?>
                    <button class="filter-btn" data-filter="<?php echo esc_attr($term->slug); ?>">
                        <?php echo esc_html($term->name); ?>
                    </button>
                <?php endforeach; ?>
            </nav>

            <div class="case-studies-grid" data-page="1" data-filter="all">
                <?php if ($initial_query->have_posts()) : ?>
                    <?php while ($initial_query->have_posts()) : $initial_query->the_post(); ?>
                        <?php echo render_case_study_card(get_post()); ?>
                    <?php endwhile; wp_reset_postdata(); ?>
                <?php endif; ?>
            </div>

            <button class="btn-outline load-more-btn" <?php echo !$has_more ? 'style="display:none;"' : ''; ?>>
                <span class="btn-text">Load more</span>
                <span class="btn-spinner" aria-hidden="true"></span>
            </button>

        </div>
    </section>
<?php } ?>