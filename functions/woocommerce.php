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
function exclude_woocommerce_pages_from_page_list_block($block_content, $block) {
    if ($block['blockName'] === 'core/page-list') {
        $woocommerce_pages = array(
            get_option('woocommerce_shop_page_id'),
            get_option('woocommerce_cart_page_id'),
            get_option('woocommerce_checkout_page_id'),
            get_option('woocommerce_myaccount_page_id')
        );

        // Filtrar el contenido del bloque para excluir las páginas de WooCommerce
        $dom = new DOMDocument();
        @$dom->loadHTML(mb_convert_encoding($block_content, 'HTML-ENTITIES', 'UTF-8'));
        $links = $dom->getElementsByTagName('a');

        foreach ($links as $link) {
            $href = $link->getAttribute('href');
            foreach ($woocommerce_pages as $page_id) {
                if (strpos($href, 'page_id=' . $page_id) !== false) {
                    $link->parentNode->removeChild($link);
                }
            }
        }

        $block_content = $dom->saveHTML();
    }
    return $block_content;
}
add_filter('render_block', 'exclude_woocommerce_pages_from_page_list_block', 10, 2);

