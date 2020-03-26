<?php
/**
 * Adding extra data to scripts
**/
if (!function_exists( 'wp_script_add_data' )) {
    function wp_script_add_data( $handle, $key, $value ) {
        global $wp_scripts;
        return $wp_scripts->add_data( $handle, $key, $value );
    }
}

add_action( 'wp_enqueue_scripts', function() {
    /* wp_enqueue_style( $handle, $src, $deps, $ver, $media ); */

    if (!is_admin()) {
        wp_dequeue_style( 'wp-block-library' );
        wp_deregister_style( 'wp-block-library' );
    }

    wp_enqueue_style('css-vendor', get_stylesheet_directory_uri().'/css/vendor.css', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/vendor.css'), 'all');

    wp_enqueue_style('css-ingresso', get_stylesheet_directory_uri().'/css/ingresso.css', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/ingresso.css'), 'all');
}, 1 );

add_action( 'wp_enqueue_scripts', function() {
    /* wp_register_script( $handle, $src, $deps, $ver, $in_footer ); */
    /* wp_enqueue_script( $handle[, $src, $deps, $ver, $in_footer] ); */

    if (!is_admin()) {
        wp_deregister_script('jquery');
    }

    wp_enqueue_script('js-common', get_template_directory_uri().'/js/common.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/common.js'), true);

    wp_enqueue_script( 'js-ie', get_template_directory_uri().'/js/ie.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/ie.js'), false );
    wp_script_add_data( 'js-ie', 'conditional', 'lt IE 9' );

    wp_enqueue_script('js-ingresso', get_template_directory_uri().'/js/ingresso.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/ingresso.js'), true);

    if (!WP_DEBUG) {
        add_action('wp_head', function() {
            echo '<link rel="preconnect" href="https://barra.brasil.gov.br">';
        }, 0);
        wp_enqueue_script( 'js-barra-brasil', 'https://barra.brasil.gov.br/barra.js', array(), null, true );
    }
}, 2 );
