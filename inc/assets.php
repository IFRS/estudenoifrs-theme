<?php
add_action( 'wp_enqueue_scripts', function() {
    /* wp_enqueue_style( $handle, $src, $deps, $ver, $media ); */

    wp_enqueue_style( 'vendor', get_stylesheet_directory_uri().'/css/vendor.css', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/vendor.css'), 'all' );

    wp_enqueue_style( 'ingresso', get_stylesheet_directory_uri().'/css/ingresso.css', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/css/ingresso.css'), 'all' );

    /* wp_register_script( $handle, $src, $deps, $ver, $in_footer ); */
    /* wp_enqueue_script( $handle[, $src, $deps, $ver, $in_footer] ); */

    wp_enqueue_script( 'commons', get_template_directory_uri().'/js/commons.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/commons.js'), true );

    wp_enqueue_script( 'ie', get_template_directory_uri().'/js/ie.js', array(), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/ie.js'), false );
    wp_script_add_data( 'ie', 'conditional', 'lt IE 9' );

    wp_enqueue_script( 'ingresso', get_template_directory_uri().'/js/ingresso.js', array('commons'), WP_DEBUG ? null : filemtime(get_stylesheet_directory() . '/js/ingresso.js'), true );

    if (!WP_DEBUG) {
        wp_enqueue_script( 'vlibras', 'https://vlibras.gov.br/app/vlibras-plugin.js', array(), null, true );
        wp_add_inline_script( 'vlibras', "
            new window.VLibras.Widget('https://vlibras.gov.br/app');
        " );
    }
}, 1 );
