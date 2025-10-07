<?php
/**
 * Colaboramos engine room
 *
 * @package Colaboramos
 * @since 1.0.0
 */

// Prevent direct access to this file for security reasons.
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

/**
 * Theme version constant (safe: only define if not already defined).
 */
$theme = wp_get_theme();
$version = $theme && method_exists( $theme, 'get' ) ? $theme->get( 'Version' ) : '1.0.0';

if ( ! defined( 'COLABORAMOS_VERSION' ) ) {
    define( 'COLABORAMOS_VERSION', (string) $version );
}

/**
 * Load optional theme components from the /inc directory.
 * Note: files are included only if they exist.
 */
$inc_files = array(
    'core'       => 'inc/core.php',
    'extended'   => 'inc/extended.php',
    'customizer' => 'inc/customizer.php',
    'templates'  => 'inc/templates.php',
);

foreach ( $inc_files as $key => $relative_path ) {
    $path = __DIR__ . '/' . $relative_path;
    if ( file_exists( $path ) ) {
        require_once $path;
    }
}