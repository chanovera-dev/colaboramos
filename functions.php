<?php

// carga componentes (estilos, javascript, etc) en el header
function load_components_header() {
    // Estilos globales
    wp_enqueue_script('jquery');
}
add_action( 'wp_enqueue_scripts', 'load_components_header' );

// Carga componentes (estilos, javascript, etc) en el footer
function load_components_footer(){
    // JS de efectos en la cabecera
    wp_enqueue_script( 'header-scripts', get_template_directory_uri() . '/assets/js/ajax-blog.js', array(), '1.0', true );
}
add_action( 'get_footer', 'load_components_footer' );

// A N E X O S
/* anexo para cargar el css que se usa en todas las páginas */
require_once(get_template_directory() . '/functions/global-css.php');

function renata_theme_support(){ 
    
    add_theme_support( 'title-tag' );

    add_theme_support( 'automatic-feed-links' );

    add_theme_support( 'custom-logo', array(
        'width'                => 200,
        'height'               => 100,
        'flex-width'           => true,
        'flex-height'          => true,
        'header-text'          => array( 'site-title', 'site-description' ),
    ) );

    add_theme_support( 'html5', array( 
        'comment-list', 
        'comment-form', 
        'search-form', 
        'gallery', 
        'caption', 
        'style', 
        'script' 
    ) );

    add_theme_support( 'post-formats', array(
        'aside',
        'image', 
        'video',
        'quote',
        'link',
        'gallery',
        'status',
        'audio',
        'chat',
    ) );

    add_theme_support( 'customize-selective-refresh-widgets' );

    add_theme_support( 'post-thumbnails', array( 
        'post',
        'page',
        'movies' 
    ) );

    set_post_thumbnail_size( 300, 200, true ); // Normal post thumbnails, hard crop mode
	add_image_size( 'post-image', 400, 300, true ); // Post thumbnails, hard crop mode
	add_image_size( 'slider-image', 920, 300, true ); // Post thumbnails for slider, hard crop mode

} 
add_action('after_setup_theme', 'renata_theme_support');

// ajax para el blog
function filter_posts() {
    $catSlug = $_POST['category'];

    $ajaxposts = new WP_Query([
        'post_type' => 'post',
        'posts_per_page' => -1,
        'category_name' => $catSlug,
        'orderby' => 'menu_order', 
        'order' => 'desc',
    ]);
    $response = '';

    if($ajaxposts->have_posts()) {
        while($ajaxposts->have_posts()) : $ajaxposts->the_post();
        $response .= get_template_part( 'templates/content', 'archive' ); 
        endwhile;
    } else {
        $response = 'empty';
    }

    echo $response;
    exit;
}
add_action('wp_ajax_filter_projects', 'filter_posts');
add_action('wp_ajax_nopriv_filter_projects', 'filter_posts');