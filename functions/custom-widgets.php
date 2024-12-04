<?php

function exclude_current_page_from_page_list($block_content, $block) {
    // Asegurarnos de que estamos en una página singular y que es el bloque correcto.
    if (!is_singular('page') || $block['blockName'] !== 'core/page-list') {
        return $block_content;
    }

    // Obtener la URL de la página actual.
    $current_page_url = get_permalink(get_the_ID());

    // Crear un objeto DOMDocument con codificación UTF-8.
    $dom = new DOMDocument('1.0', 'UTF-8');
    libxml_use_internal_errors(true); // Suprimir errores de HTML mal formado.
    $dom->loadHTML('<?xml encoding="utf-8" ?>' . $block_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    // Buscar todos los elementos <li>.
    foreach ($dom->getElementsByTagName('li') as $li) {
        $a = $li->getElementsByTagName('a')->item(0); // Buscar el enlace dentro del <li>.
        if ($a && $a->getAttribute('href') === $current_page_url) {
            $li->parentNode->removeChild($li); // Eliminar el <li> si coincide la URL.
        }
    }

    return $dom->saveHTML();
}
add_filter('render_block', 'exclude_current_page_from_page_list', 10, 2);

