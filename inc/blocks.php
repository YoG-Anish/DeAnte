<?php
if ( ! class_exists( 'acf' ) ) {
    return false;
}

function register_acf_fields() {
    foreach ( glob( get_template_directory() . '/blocks/*/' ) as $path ) {
        require_once( $path . 'init.php' );
    }
}
add_action( 'init', 'register_acf_fields' );

// Register custom block category
add_filter( 'block_categories_all', function( $categories ) {
    array_unshift( $categories, [
        'slug'  => 'deante-blocks',
        'title' => 'Deante Blocks',
        'icon'  => null,
    ]);
    return $categories;
});

// functions.php
function render_case_study_card($case) {
    $media_type  = get_field('media_type', $case->ID); // yt / mp4
    $youtube_id  = get_field('youtube_id', $case->ID);
    $mp4_file    = get_field('mp4_file', $case->ID);
    $client_name = get_field('client_name', $case->ID);
    $description = get_field('description', $case->ID);
    $roles       = get_field('our_role', $case->ID);

    $show_youtube = ($media_type === 'yt_video_id' && !empty($youtube_id));
    $show_mp4     = ($media_type === 'mp4_video' && !empty($mp4_file));
    $show_image   = (!$show_youtube && !$show_mp4 && has_post_thumbnail($case->ID));

    ob_start();
    ?>
    <a href="<?php echo esc_url(get_permalink($case->ID)); ?>" class="case-studies-card">

        <div class="card-media <?php echo (!$show_youtube && !$show_mp4 && !$show_image) ? 'gray-placeholder' : ''; ?>">
            <?php if ($show_youtube) : ?>
                <iframe src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_id); ?>" frameborder="0" allowfullscreen></iframe>
            <?php elseif ($show_mp4) : ?>
                <video autoplay muted loop playsinline>
                    <source src="<?php echo esc_url($mp4_file['url']); ?>" type="video/mp4">
                </video>
            <?php elseif ($show_image) : ?>
                <?php echo get_the_post_thumbnail($case->ID, 'large', ['alt' => 'Project Image']); ?>
            <?php endif; ?>
        </div>

        <div class="card-content">
            <div class="content-top">
                <?php if (!empty($client_name)) : ?>
                    <span><?php echo esc_html($client_name); ?></span>
                <?php endif; ?>

                <h3><?php echo esc_html(get_the_title($case->ID)); ?></h3>

                <?php if (!empty($description)) : ?>
                    <p><?php echo esc_html(wp_trim_words($description, 30)); ?></p>
                <?php endif; ?>
            </div>

            <?php if (!empty($roles)) : ?>
                <div class="content-bottom">
                    <span class="role-label">Our role</span>
                    <div class="role-filter-list">
                        <?php foreach ($roles as $role) :
                            if (empty($role['role_item'])) {
                                continue;
                            }
                        ?>
                            <span>/&ensp;<?php echo esc_html($role['role_item']); ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </a>
    <?php
    return ob_get_clean();
}
function ajax_filter_case_studies() {
    $filter = isset($_POST['filter']) ? sanitize_text_field($_POST['filter']) : 'all';

    $args = [
        'post_type'      => 'case-study',
        'posts_per_page' => -1,
    ];

    if ($filter !== 'all') {
        $args['tax_query'] = [[
            'taxonomy' => 'services-category',
            'field'    => 'slug',
            'terms'    => $filter,
        ]];
    }

    $query = new WP_Query($args);
    $html  = '';

    if ($query->have_posts()) {
        while ($query->have_posts()) {
            $query->the_post();
            $html .= render_case_study_card(get_post());
        }
        wp_reset_postdata();
    } else {
        $html = '<p class="no-results">No case studies found.</p>';
    }

    echo $html;
    wp_die();
}
add_action('wp_ajax_filter_case_studies', 'ajax_filter_case_studies');
add_action('wp_ajax_nopriv_filter_case_studies', 'ajax_filter_case_studies');