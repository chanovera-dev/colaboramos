<?php

// exclude the current page for the pages list
function exclude_current_and_wc_pages_from_page_list($block_content, $block) {
    if (!is_singular('page') || $block['blockName'] !== 'core/page-list') {
        return $block_content;
    }

    // Obtener la URL de la página actual.
    $current_page_url = trailingslashit(get_permalink(get_the_ID()));

    // Obtener los slugs de las páginas clave de WooCommerce.
    $wc_page_ids = [
        wc_get_page_id('shop'),       // Página de tienda.
        wc_get_page_id('cart'),       // Página de carrito.
        wc_get_page_id('checkout'),   // Página de finalizar compra.
        wc_get_page_id('myaccount')   // Página de mi cuenta.
    ];
    $wc_page_slugs = array_filter(array_map(function($page_id) {
        return $page_id > 0 ? get_post_field('post_name', $page_id) : null;
    }, $wc_page_ids));

    // Crear un objeto DOMDocument con codificación UTF-8.
    $dom = new DOMDocument('1.0', 'UTF-8');
    libxml_use_internal_errors(true);
    $dom->loadHTML('<?xml encoding="utf-8" ?>' . $block_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    foreach ($dom->getElementsByTagName('li') as $li) {
        $a = $li->getElementsByTagName('a')->item(0);
        if ($a) {
            $href = trailingslashit($a->getAttribute('href'));
            $slug = basename(untrailingslashit($href)); // Extraer el slug de la URL.

            // Excluir si la URL es la actual o si el slug coincide con un slug de WooCommerce.
            if ($href === $current_page_url || in_array($slug, $wc_page_slugs, true)) {
                $li->parentNode->removeChild($li);
            }
        }
    }

    return $dom->saveHTML();
}
add_filter('render_block', 'exclude_current_and_wc_pages_from_page_list', 10, 2);