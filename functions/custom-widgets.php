<?php

function exclude_current_page_from_list_pages($args) {
    if (is_page()) {
        global $post;
        $args['exclude'] = $post->ID; // Excluye la página actual
    }
    return $args;
}
add_filter('widget_pages_args', 'exclude_current_page_from_list_pages');
