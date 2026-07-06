<footer class="site-footer">
    <section class="footer-primary">
        <div class="container">
            <!-- Left Column: Branding and Main CTA -->
            <?php
            $logo             = get_field('logo', 'option');
            $description      = get_field('description', 'option');
            $button           = get_field('button', 'option');
            $location_address = get_field('location_address', 'option');
            ?>

            <div class="footer-col-left">

                <?php if (!empty($logo)) : ?>
                    <div class="footer-logo">
                        <a href="<?php echo esc_url(home_url('/')); ?>">
                            <img src="<?php echo esc_url($logo['url']); ?>" alt="<?php echo esc_attr($logo['alt']); ?>" />
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (!empty($description)) : ?>
                    <h2 class="footer-headline">
                        <?php echo wp_kses_post($description); ?>
                    </h2>
                <?php endif; ?>

                <?php if (!empty($button) && !empty($button['url'])) : ?>
                    <a href="<?php echo esc_url($button['url']); ?>" class="btn-outline" target="<?php echo esc_attr($button['target'] ?: '_self'); ?>">
                        <?php echo esc_html($button['title']); ?>
                    </a>
                <?php endif; ?>

                <?php if (!empty($location_address)) : ?>
                    <a href="#" class="footer-location">
                        <span class="icon-pin">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M11.625 16.4058C11.7383 16.4706 11.8666 16.5046 11.9972 16.5046C12.1277 16.5046 12.256 16.4706 12.3694 16.4058C12.5991 16.2736 17.9944 13.1245 17.9944 7.50422C17.9472 5.94543 17.2951 4.46625 16.176 3.38009C15.0569 2.29393 13.559 1.68616 11.9995 1.68555C10.44 1.68494 8.94151 2.29154 7.8216 3.37682C6.7017 4.46211 6.04835 5.94078 6 7.49953C6 13.1245 11.3981 16.2689 11.625 16.4058ZM12 5.24953C12.445 5.24953 12.88 5.38149 13.25 5.62872C13.62 5.87595 13.9084 6.22736 14.0787 6.63849C14.249 7.04962 14.2936 7.50202 14.2068 7.93848C14.12 8.37494 13.9057 8.77585 13.591 9.09052C13.2763 9.40519 12.8754 9.61948 12.439 9.7063C12.0025 9.79311 11.5501 9.74855 11.139 9.57826C10.7278 9.40796 10.3764 9.11957 10.1292 8.74956C9.88196 8.37955 9.75 7.94454 9.75 7.49953C9.75 6.90279 9.98705 6.33049 10.409 5.90854C10.831 5.48658 11.4033 5.24953 12 5.24953ZM22.5 17.2495C22.5 20.1727 17.0897 21.7495 12 21.7495C6.91031 21.7495 1.5 20.1727 1.5 17.2495C1.5 15.8817 2.73937 14.6705 4.99031 13.8398C5.17491 13.7789 5.37596 13.7919 5.5511 13.8763C5.72624 13.9607 5.86178 14.1098 5.92913 14.2921C5.99648 14.4745 5.99039 14.6759 5.91215 14.8539C5.8339 15.0318 5.6896 15.1724 5.50969 15.2461C3.96187 15.8189 3 16.5858 3 17.2495C3 18.502 6.42375 20.2495 12 20.2495C17.5763 20.2495 21 18.502 21 17.2495C21 16.5858 20.0381 15.8189 18.4903 15.247C18.3104 15.1734 18.1661 15.0328 18.0879 14.8548C18.0096 14.6768 18.0035 14.4754 18.0709 14.2931C18.1382 14.1107 18.2738 13.9616 18.4489 13.8772C18.624 13.7929 18.8251 13.7798 19.0097 13.8408C21.2606 14.6705 22.5 15.8817 22.5 17.2495Z" fill="#00142B" />
                            </svg>
                        </span>
                        <span class="underline-on-hover">
                            <?php echo wp_kses_post($location_address); ?>
                        </span>
                    </a>
                <?php endif; ?>

            </div>

            <!-- Right Column: Navigation and Expertise -->
            <div class="footer-col-right">

                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-menu-1',
                    'menu_class'     => 'footer-nav underline-on-hover-ul',
                    'fallback_cb'    => false,
                ));
                ?>

                <?php
                wp_nav_menu(array(
                    'theme_location' => 'footer-menu-2',
                    'menu_class'     => 'footer-expertise underline-on-hover-ul',
                    'fallback_cb'    => false,
                ));
                ?>
                <?php
                $social_links = get_field('social_links', 'option');
                ?>

                <div class="footer-social-actions">

                    <?php if (!empty($social_links)) : ?>
                        <?php foreach ($social_links as $social) :
                            $icon = $social['icon'];
                            $link = $social['link'];

                            if (empty($icon) || empty($link)) {
                                continue;
                            }
                        ?>
                            <a href="<?php echo $link ?>" class="social-link"  target="blank"  >
                                <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt']); ?>" />
                            </a>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <a href="#top" class="back-to-top" aria-label="Back to top">
                        <img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/image/uparrow.svg" alt="" />
                    </a>

                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Dark Bar -->
    <section class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-content">
                <p><?php bloginfo('description'); ?></p>
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved.</p>
            </div>
        </div>
    </section>
</footer>



<?php wp_footer(); ?>

</body>

</html>