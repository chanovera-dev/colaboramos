<?php

// delete the current page and de WC pages for the pages list
function exclude_current_page_and_wc_from_page_list($block_content, $block) {
    if (!is_singular('page') || $block['blockName'] !== 'core/page-list') {
        return $block_content;
    }

    // Obtener la URL de la página actual
    $current_page_url = get_permalink(get_the_ID());
    $shop_page_url = wc_get_page_permalink('shop');

    // Obtener las URLs de las páginas de WooCommerce
    // $wc_pages = [];
    // if (class_exists('WooCommerce')) {
    //     $wc_pages = [
    //         wc_get_page_permalink('shop'),
    //         wc_get_page_permalink('cart'),
    //         wc_get_page_permalink('checkout'),
    //         wc_get_page_permalink('myaccount'),
    //     ];
    // }

    $dom = new DOMDocument('1.0', 'UTF-8');
    libxml_use_internal_errors(true);
    $dom->loadHTML('<?xml encoding="utf-8" ?>' . $block_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    foreach ($dom->getElementsByTagName('li') as $li) {
        $a = $li->getElementsByTagName('a')->item(0);

        // Eliminar si el enlace corresponde a la página actual
        if ($a && $a->getAttribute('href') === $current_page_url) {
            $li->parentNode->removeChild($li);
        }

        // Eliminar si el enlace corresponde a una página de WooCommerce
        elseif ($a && $a->getAttribute('href') === $shop_page_url) {
            $li->parentNode->removeChild($li);
        }
    }

    return $dom->saveHTML();
}
add_filter('render_block', 'exclude_current_page_and_wc_from_page_list', 10, 2);