<?php
/**
 * Theme Templates Settings
 * 
 * @package Colaboramos
 * @since 1.0.0
 */

/**
 * Helper: Enqueue style file with automatic versioning
 *
 * @param string $handle
 * @param string $path
 * @param string $media
 * @return void
 */
function colaboramos_enqueue_style( $handle, $path, $media = 'all' ) {
    $uri = get_template_directory_uri();
    wp_enqueue_style( $handle, $uri . $path, [], get_asset_version( $path ), $media );
}

/**
 * Helper: Enqueue script file with automatic versioning
 *
 * @param string $handle
 * @param string $path
 * @return void
 */
function colaboramos_enqueue_script( $handle, $path ) {
    $uri = get_template_directory_uri();
    wp_enqueue_script( $handle, $uri . $path, [], get_asset_version( $path ), true );
}

/**
 * Enqueues styles specifically for Single Post/Page
 * 
 * Loads custom CSS file only when viewing single post/page
 *
 * @since 1.0.0
 * @return void
 */
function page_template() {
    $assets_path = '/assets';

    if ( is_page() or is_single() ) {
        $page_css = "$assets_path/css/page.css";
        $single_css = "$assets_path/css/single.css";
        $related_css = "$assets_path/css/posts.css";
        $comments_css = "$assets_path/css/comments.css";
        $page_thumbnail = "$assets_path/css/page-thumbnail.css";
        $parallax_hero = "$assets_path/js/parallax-hero.js";
        $blur_typing = "$assets_path/js/blur-typing.js";

        colaboramos_enqueue_style( 'page', $page_css );
        colaboramos_enqueue_script( 'blur-typing', $blur_typing );

        $post_id = get_queried_object_id();
        if ( $post_id && has_post_thumbnail( $post_id ) ) {
            colaboramos_enqueue_style( 'page-thumbnail', $page_thumbnail );
            colaboramos_enqueue_script( 'parallax-hero', $parallax_hero );
        }

        if ( is_single() ) {
            colaboramos_enqueue_style( 'single', $single_css );
            $related = get_posts( [
                'post__not_in' => [ $post_id ],
                'posts_per_page' => 1,
                'category__in' => wp_get_post_categories( $post_id ),
                'tag__in' => wp_get_post_tags( $post_id, [ 'fields' => 'ids' ] ),
            ] );

            if ( ! empty( $related ) ) {
                colaboramos_enqueue_style( 'related-posts', $related_css );
            }

            if ( comments_open() ) {
            colaboramos_enqueue_style( 'custom-comments', $comments_css );
            }
        }
    }
}
add_action( 'wp_enqueue_scripts', 'page_template' );

function posts_styles() {
    $assets_path = '/assets';

    if ( is_home() or is_archive() or is_search() ) {
        $posts_css = "$assets_path/css/posts.css";
        $pagination_css = "$assets_path/css/pagination.css";
        $blur_typing = "$assets_path/js/blur-typing.js";

        colaboramos_enqueue_style( 'posts', $posts_css );
        colaboramos_enqueue_script( 'blur-typing', $blur_typing );
        
        if ( paginate_links() ) {
            colaboramos_enqueue_style( 'pagination', $pagination_css );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'posts_styles' );

/**
 * Enqueues styles specifically for 404 error page
 * 
 * Loads custom CSS file only when viewing 404 page
 * to optimize performance and reduce unnecessary loading
 *
 * @since 1.0.0
 * @return void
 */
function page404_styles() {
    $assets_path = '/assets';

    if ( is_404() ) {
        $error404_css = "$assets_path/css/error404.css";
        colaboramos_enqueue_style( 'error404', $error404_css );
    }
}
add_action( 'wp_enqueue_scripts', 'page404_styles' );