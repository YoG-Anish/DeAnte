<!DOCTYPE html>
<html lang="<?php language_attributes(); ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <header>
        <!-- Add class desktop-header for header in desktop page -->
        <?php
        if (is_front_page()) {
            echo '<section class="site-header desktop-header">';
        } else {
            echo '<section class="site-header">';
        }
        ?>
        <div class="container">
            <!-- Logo Section -->
            <?php
            $header_logo = get_field('header_logo', 'option');
            if ($header_logo) {
                echo '<div class="logo">';
                echo '<a href="' . esc_url(home_url('/')) . '"><img src="' . esc_url($header_logo['url']) . '" alt="' . esc_attr($header_logo['alt']) . '" /></a>';
                echo '</div>';
            }
            ?>

            <!-- Navigation Section -->
            <nav class="nav-pill">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'header-menu',
                    'menu_class'     => 'nav-links',
                    'fallback_cb'    => false,
                ));
                ?>
            </nav>
            <div class="bar-menu">
                <span>
                    <svg
                        width="20"
                        height="16"
                        viewBox="0 0 20 16"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="bar-icon">
                        <path
                            d="M20 8C20 8.22101 19.9122 8.43298 19.7559 8.58926C19.5996 8.74554 19.3877 8.83333 19.1667 8.83333H0.833333C0.61232 8.83333 0.400358 8.74554 0.244078 8.58926C0.0877975 8.43298 0 8.22101 0 8C0 7.77899 0.0877975 7.56702 0.244078 7.41074C0.400358 7.25446 0.61232 7.16667 0.833333 7.16667H19.1667C19.3877 7.16667 19.5996 7.25446 19.7559 7.41074C19.9122 7.56702 20 7.77899 20 8ZM0.833333 2.16667H19.1667C19.3877 2.16667 19.5996 2.07887 19.7559 1.92259C19.9122 1.76631 20 1.55435 20 1.33333C20 1.11232 19.9122 0.900358 19.7559 0.744078C19.5996 0.587798 19.3877 0.5 19.1667 0.5H0.833333C0.61232 0.5 0.400358 0.587798 0.244078 0.744078C0.0877975 0.900358 0 1.11232 0 1.33333C0 1.55435 0.0877975 1.76631 0.244078 1.92259C0.400358 2.07887 0.61232 2.16667 0.833333 2.16667ZM19.1667 13.8333H0.833333C0.61232 13.8333 0.400358 13.9211 0.244078 14.0774C0.0877975 14.2337 0 14.4457 0 14.6667C0 14.8877 0.0877975 15.0996 0.244078 15.2559C0.400358 15.4122 0.61232 15.5 0.833333 15.5H19.1667C19.3877 15.5 19.5996 15.4122 19.7559 15.2559C19.9122 15.0996 20 14.8877 20 14.6667C20 14.4457 19.9122 14.2337 19.7559 14.0774C19.5996 13.9211 19.3877 13.8333 19.1667 13.8333Z"
                            fill="#00142B"></path>
                    </svg>
                </span>
            </div>
        </div>
        </section>
    </header>
    <!-- Modal Overlay For Get In Touch -->
    <div class="modal-overlay" id="contactModal">
        <div class="modal-content">
            <button class="modal-close" id="closeModal">
                <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                    class="close-icon">
                    <path
                        d="M17.2513 16.049C17.3302 16.128 17.3929 16.2217 17.4356 16.3249C17.4783 16.4281 17.5003 16.5387 17.5003 16.6504C17.5003 16.7621 17.4783 16.8726 17.4356 16.9758C17.3929 17.079 17.3302 17.1728 17.2513 17.2517C17.1723 17.3307 17.0785 17.3934 16.9753 17.4361C16.8722 17.4788 16.7616 17.5008 16.6499 17.5008C16.5382 17.5008 16.4276 17.4788 16.3244 17.4361C16.2212 17.3934 16.1275 17.3307 16.0485 17.2517L8.99993 10.2021L1.95135 17.2517C1.79186 17.4112 1.57554 17.5008 1.34998 17.5008C1.12442 17.5008 0.908101 17.4112 0.748608 17.2517C0.589114 17.0922 0.499512 16.8759 0.499512 16.6504C0.499512 16.4248 0.589114 16.2085 0.748608 16.049L7.79825 9.00042L0.748608 1.95184C0.589114 1.79234 0.499512 1.57602 0.499512 1.35047C0.499512 1.12491 0.589114 0.908589 0.748608 0.749096C0.908101 0.589602 1.12442 0.5 1.34998 0.5C1.57554 0.5 1.79186 0.589602 1.95135 0.749096L8.99993 7.79874L16.0485 0.749096C16.208 0.589602 16.4243 0.5 16.6499 0.5C16.8754 0.5 17.0918 0.589602 17.2513 0.749096C17.4107 0.908589 17.5003 1.12491 17.5003 1.35047C17.5003 1.57602 17.4107 1.79234 17.2513 1.95184L10.2016 9.00042L17.2513 16.049Z"
                        fill="#00142B"></path>
                </svg>
            </button>

            <h2 class="modal-title">Get in touch</h2>

            <p class="modal-text">
                Great solutions begin with a great conversation, so if you’re ready to
                get started, let’s talk.
            </p>

            <a href="mailto:Hello@deante.co" class="modal-btn">
                <svg
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <path
                        d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
                <span>Hello@deante.co</span>
            </a>
        </div>
    </div>
    <div class="sidebar-overlay" id="sidebarMenu">
        <div class="sidebar-content">
            <button class="sidebar-close" id="closeSidebar">
                <svg
                    width="18"
                    height="18"
                    viewBox="0 0 18 18"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M17.2513 16.049C17.3302 16.128 17.3929 16.2217 17.4356 16.3249C17.4783 16.4281 17.5003 16.5387 17.5003 16.6504C17.5003 16.7621 17.4783 16.8726 17.4356 16.9758C17.3929 17.079 17.3302 17.1728 17.2513 17.2517C17.1723 17.3307 17.0785 17.3934 16.9753 17.4361C16.8722 17.4788 16.7616 17.5008 16.6499 17.5008C16.5382 17.5008 16.4276 17.4788 16.3244 17.4361C16.2212 17.3934 16.1275 17.3307 16.0485 17.2517L8.99993 10.2021L1.95135 17.2517C1.79186 17.4112 1.57554 17.5008 1.34998 17.5008C1.12442 17.5008 0.908101 17.4112 0.748608 17.2517C0.589114 17.0922 0.499512 16.8759 0.499512 16.6504C0.499512 16.4248 0.589114 16.2085 0.748608 16.049L7.79825 9.00042L0.748608 1.95184C0.589114 1.79234 0.499512 1.57602 0.499512 1.35047C0.499512 1.12491 0.589114 0.908589 0.748608 0.749096C0.908101 0.589602 1.12442 0.5 1.34998 0.5C1.57554 0.5 1.79186 0.589602 1.95135 0.749096L8.99993 7.79874L16.0485 0.749096C16.208 0.589602 16.4243 0.5 16.6499 0.5C16.8754 0.5 17.0918 0.589602 17.2513 0.749096C17.4107 0.908589 17.5003 1.12491 17.5003 1.35047C17.5003 1.57602 17.4107 1.79234 17.2513 1.95184L10.2016 9.00042L17.2513 16.049Z"
                        fill="#00142B"></path>
                </svg>
            </button>

            <nav class="sidebar-nav">
                <a href="#about" class="nav-main-link">About</a>

                <div class="expertise-group">
                    <h3 class="nav-heading"><a href="#expertise">Expertise</a></h3>
                    <ul class="sub-nav-links">
                        <li><a href="#">/ Product Strategy</a></li>
                        <li><a href="#">/ Digital Design (UX/UI)</a></li>
                        <li><a href="#">/ eCRM</a></li>
                        <li><a href="#">/ Digital Branding</a></li>
                        <li><a href="#">/ Development</a></li>
                        <li><a href="#">/ SEO</a></li>
                        <li><a href="#">/ Data Dashboard</a></li>
                    </ul>
                </div>

                <a href="#case-studies" class="nav-main-link">Case studies</a>
            </nav>

            <button class="sidebar-btn btn-modal-sidebar-contact">
                Get in touch
            </button>
        </div>
    </div>