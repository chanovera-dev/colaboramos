<?php

// Estilos para todos los artículos y páginas
function single_styles() {
    if ( is_single() or is_page() && ! is_front_page() ) {
        wp_enqueue_style( 'single-styles', get_template_directory_uri() . '/assets/css/page.css' );
        wp_enqueue_style( 'single-styles', get_template_directory_uri() . '/assets/css/sidebar.css' );
    }
}
add_action( 'wp_enqueue_scripts', 'single_styles' );