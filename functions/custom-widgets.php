<?php

function exclude_current_page_from_widget($args) {
    // Verifica que estamos en una página y obtiene el ID de la página actual.
    if (is_page()) {
        $current_page_id = get_queried_object_id();

        // Agrega el ID de la página actual al argumento 'exclude'.
        if (!empty($args['exclude'])) {
            $args['exclude'] .= ',' . $current_page_id;
        } else {
            $args['exclude'] = $current_page_id;
        }
    }
    return $args;
}
add_filter('widget_pages_args', 'exclude_current_page_from_widget', 99);
