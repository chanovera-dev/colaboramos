<?php

// exclude the current page for the pages list
function exclude_current_page_and_wc_from_page_list($block_content, $block) {
    if (!is_singular('page') || $block['blockName'] !== 'core/page-list') {
        return $block_content;
    }

    // Obtener la URL de la página actual
    $current_page_url = get_permalink(get_the_ID());

    // Agregar URLs de las páginas principales de WooCommerce
    if (class_exists('WooCommerce')) {
        $wc_pages = [
            wc_get_page_id('shop'),      // Página de tienda
            wc_get_page_id('cart'),      // Página de carrito
            wc_get_page_id('checkout'),  // Página de finalizar compra
            wc_get_page_id('myaccount')  // Página de mi cuenta
        ];

        foreach ($wc_pages as $page_id) {
            if ($page_id && get_post_status($page_id) === 'publish') {
                $wc_page_url = get_permalink($page_id);
                if ($wc_page_url) {
                    $current_page_url = array_merge(
                        (array)$current_page_url, 
                        (array)$wc_page_url
                    );
                }
            }
        }
    }

    // Convertir a array para facilitar la comparación
    $current_page_urls = (array) $current_page_url;

    // Procesar el contenido del bloque
    $dom = new DOMDocument('1.0', 'UTF-8');
    libxml_use_internal_errors(true);
    $dom->loadHTML('<?xml encoding="utf-8" ?>' . $block_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    foreach ($dom->getElementsByTagName('li') as $li) {
        $a = $li->getElementsByTagName('a')->item(0);
        if ($a && in_array($a->getAttribute('href'), $current_page_urls, true)) {
            $li->parentNode->removeChild($li);
        }
    }

    return $dom->saveHTML();
}
add_filter('render_block', 'exclude_current_page_and_wc_from_page_list', 10, 2);
