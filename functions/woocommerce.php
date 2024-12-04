<?php

// Agrega soporte para woocommerce
function soporte_woocommerce(){ add_theme_support( 'woocommerce' ); }
add_action( 'after_setup_theme', 'soporte_woocommerce' );

add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

//Disable all woocommerce stylesheets
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

// excluir las páginas de WooCoomerce de las listas de WordPress
function exclude_woocommerce_pages($query) {
    if (is_woocommerce()) {
        return $query;
    }
    return $query;
}
add_filter('block_core/page-list', 'exclude_woocommerce_pages');
