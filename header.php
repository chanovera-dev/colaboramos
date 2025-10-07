<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <?php /* Title tag fallback if the theme does not support title-tag */ ?>
    <?php if ( ! current_theme_supports( 'title-tag' ) ) : ?>
        <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php endif; ?>

    <?php /* Output meta description if available (escaped) */ ?>
    <?php $site_description = get_bloginfo( 'description', 'display' ); ?>
    <?php if ( $site_description ) : ?>
        <meta name="description" content="<?php echo esc_attr( $site_description ); ?>">
    <?php endif; ?>
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
    <?php if ( function_exists( 'wp_body_open' ) ) { wp_body_open(); } ?>

    <?php /* Skip link for accessibility */ ?>
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e( 'Skip to content', 'colaboramos' ); ?></a>

    <header id="main-header" role="banner" aria-label="<?php echo esc_attr__( 'Main header', 'colaboramos' ); ?>">
        <div class="block">
            <div class="content">
                <div class="site-brand">
                    <?php
                        // Prefer get_custom_logo() so we can control output and avoid unexpected echoes
                        $custom_logo = get_custom_logo();
                        if ( $custom_logo ) {
                            echo $custom_logo; // get_custom_logo returns safe HTML
                        } else {
                            $home_url = esc_url( home_url( '/' ) );
                            $aria_label = esc_attr__( 'Link to home page', 'colaboramos' );
                            $site_name = esc_html( get_bloginfo( 'name' ) );

                            // Use printf with escaped values to avoid accidental unescaped output
                            printf( '<a class="site-title" href="%1$s" aria-label="%2$s">%3$s</a>', $home_url, $aria_label, $site_name );
                        }
                    ?>
                </div>
                <?php
                    wp_nav_menu( array(
                        'container'       => 'nav',
                        'container_class' => 'main-navigation',
                        'theme_location'  => 'primary',
                        'fallback_cb'     => false,
                    ) );
                ?>
                <div class="members-options">
                    <a href="#" class="signup">Registro</a>
                    <a href="#" class="login">Login</a>
                </div>
                <button class="menu-mobile__button" onclick="toggleMenuMobile()">
                    <span class="bar"></span>
                </button>
            </div>
        </div>
    </header>