<?php

function exclude_current_page_from_page_list($block_content, $block) {
    if (!is_singular('page') || $block['blockName'] !== 'core/page-list') {
        return $block_content;
    }

    // Obtener el ID de la página actual.
    $current_page_id = get_the_ID();

    // Modificar el contenido del bloque para excluir la página actual.
    $dom = new DOMDocument();
    libxml_use_internal_errors(true); // Evitar warnings con HTML mal formado.
    $dom->loadHTML($block_content, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);

    foreach ($dom->getElementsByTagName('li') as $li) {
        $a = $li->getElementsByTagName('a')->item(0);
        if ($a && strpos($a->getAttribute('href'), 'page_id=' . $current_page_id) !== false) {
            $li->parentNode->removeChild($li);
        }
    }

    return $dom->saveHTML();
}
add_filter('render_block', 'exclude_current_page_from_page_list', 10, 2);

