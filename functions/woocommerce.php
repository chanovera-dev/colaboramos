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
function exclude_woocommerce_pages_from_page_list($args) {
    // Obtén los IDs de las páginas de WooCommerce
    $woocommerce_pages = array(
        get_option('woocommerce_shop_page_id'),
        get_option('woocommerce_cart_page_id'),
        get_option('woocommerce_checkout_page_id'),
        get_option('woocommerce_myaccount_page_id')
    );

    // Excluye las páginas de WooCommerce
    $args['post__not_in'] = $woocommerce_pages;

    return $args;
}
add_filter('block_type_metadata.settings.core/page-list', 'exclude_woocommerce_pages_from_page_list');

