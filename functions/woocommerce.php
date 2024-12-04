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
function filter_core_page_list_block($query_args, $block) {
    if ($block->name === 'core/page-list') {
        // Obtén los IDs de las páginas de WooCommerce
        $woocommerce_pages = array(
            get_option('woocommerce_shop_page_id'),
            get_option('woocommerce_cart_page_id'),
            get_option('woocommerce_checkout_page_id'),
            get_option('woocommerce_myaccount_page_id')
        );

        // Excluye las páginas de WooCommerce
        $query_args['post__not_in'] = $woocommerce_pages;
    }
    return $query_args;
}
add_filter('render_block_data', 'filter_core_page_list_block', 10, 2);

