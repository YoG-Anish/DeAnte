<?php
get_header();
?>
<section class="inner-banner-section">
    <div class="container split-layout">
        <div class="inner-banner-content">
            <?php 
            $content = get_field('404_content', 'option');
            if (!empty($content)) {
                echo wp_kses_post($content);
            }

            $button = get_field('button', 'option');
            if (!empty($button)) { ?>
            <a href="<?php echo esc_url($button['url']); ?>" class="btn-outline"><?php echo esc_html($button['title']); ?></a>
            <?php } ?>
        </div>
    </div>

</section>

<?php
get_footer();
?>