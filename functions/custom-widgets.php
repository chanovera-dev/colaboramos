<?php

// exclude the current page for the pages list
function exclude_current_and_wc_pages_from_page_list($block_content, $block) {
    if (!is_singular('page') || $block['blockName'] !== 'core/page-list') {
        return $block_content;
    }

    // Obtener la URL de la página actual.
    $current_page_url = get_permalink(get_the_ID());

    // Obtener las URLs de páginas clave de WooCommerce.
    $wc_page_ids = [
        wc_get_page_id('shop'),       // Página de tienda.
        wc_get_page_id('cart'),       // Página de carrito.
        wc_get_page_id('checkout'),   // Página de finalizar compra.
        wc_get_page_id('myaccount')   // Página de mi cuenta.
    ];
    $wc_page_urls = array_filter(array_map('get_permalink', $wc_page_ids));

    // Crear un objeto DOMDocument con codificación UTF-8.
    $dom = new DOMDocument('1.0', 'UTF-8');
    libxml_use_internal_errors(true);
    $dom->loadHTML('<?xml encoding="utf-8" ?>' . $block_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    foreach ($dom->getElementsByTagName('li') as $li) {
        $a = $li->getElementsByTagName('a')->item(0);
        if ($a) {
            $href = $a->getAttribute('href');
            // Condicional extendido: excluir si la URL es la actual o está en las URLs de WooCommerce.
            if ($href === $current_page_url || in_array($href, $wc_page_urls, true)) {
                $li->parentNode->removeChild($li);
            }
        }
    }

    return $dom->saveHTML();
}
add_filter('render_block', 'exclude_current_and_wc_pages_from_page_list', 10, 2);
