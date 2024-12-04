<?php

function exclude_current_page_from_output($output) {
    if (is_page()) {
        global $post;
        $current_page_id = $post->ID;
        // Busca y elimina la página actual de la lista
        $pattern = '/<li[^>]*>\s*<a[^>]*href="[^"]*'.get_permalink($current_page_id).'[^"]*">.*?<\/a>\s*<\/li>/i';
        $output = preg_replace($pattern, '', $output);
    }
    return $output;
}
add_filter('wp_list_pages', 'exclude_current_page_from_output');

