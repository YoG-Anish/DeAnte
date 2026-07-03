<?php
if (isset($block['data']['preview_image_help'])) {
    echo '<img src="' . get_template_directory_uri() . $block['data']['preview_image_help'] . '" style="width:100%; height:auto;">';
} else {
    $title        = get_field('title');
    $button_link  = get_field('button_link');
    $case_studies = get_field('case_studies');
?>
    <section class="case-studies-section <?php echo esc_attr(get_field('html_wrapper_class')); ?>">
        <div class="container">

            <header class="section-header">
                <?php if (!empty($title)) : ?>
                    <h2 class="section-title">
                        <span class="highlight"><?php echo esc_html($title); ?></span>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($button_link)) : ?>
                    <a href="<?php echo esc_url($button_link['url']); ?>" class="btn-outline mobile-hidden">
                        <?php echo esc_html($button_link['title']); ?>
                    </a>
                <?php endif; ?>
            </header>

            <?php if (!empty($case_studies)) : ?>
                <div class="case-studies-grid">
                    <?php foreach ($case_studies as $case) :
                        $video_type = get_field('media_type', $case->ID);
                        $youtube_id = get_field('youtube_id', $case->ID);
                        $video_file = get_field('mp4_file', $case->ID);

                        $show_youtube = ($video_type === 'yt_video_id' && !empty($youtube_id));
                        $show_mp4     = ($video_type === 'mp4_video' && !empty($video_file));
                        $show_image   = (!$show_youtube && !$show_mp4 && has_post_thumbnail($case->ID));

                        // skip this case study entirely if it has no media at all
                        if (!$show_youtube && !$show_mp4 && !$show_image) {
                            continue;
                        }
                    ?>
                        <article class="case-card">
                            <a href="<?php echo esc_url(get_permalink($case->ID)); ?>" class="card-image">

                                <?php if ($show_youtube) : ?>
                                    <iframe
                                        src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_id); ?>"
                                        frameborder="0"
                                        allowfullscreen
                                    ></iframe>

                                <?php elseif ($show_mp4) : ?>
                                    <video autoplay muted loop playsinline>
                                        <source src="<?php echo esc_url($video_file['url']); ?>" type="video/mp4">
                                    </video>

                                <?php elseif ($show_image) : ?>
                                    <?php echo get_the_post_thumbnail($case->ID, 'large'); ?>
                                <?php endif; ?>

                            </a>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($button_link)) : ?>
                <a href="<?php echo esc_url($button_link['url']); ?>" class="btn-outline desktop-hidden">
                    <?php echo esc_html($button_link['title']); ?>
                </a>
            <?php endif; ?>

        </div>
    </section>
<?php } ?>