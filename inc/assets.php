<?php
add_action('enqueue_block_editor_assets', function () {
    /* wp_enqueue_style( $handle, $src, $deps, $ver, $media ); */

    wp_enqueue_style('estude-editor', get_parent_theme_file_uri('/css/estude-editor.css'), array(), WP_DEBUG ? null : filemtime(get_parent_theme_file_path('/css/estude-editor.css')), 'all');
});
add_action( 'wp_enqueue_scripts', function() {
    /* wp_enqueue_style( $handle, $src, $deps, $ver, $media ); */

    wp_enqueue_style( 'vendor', get_parent_theme_file_uri( '/css/vendor.css' ), array(), WP_DEBUG ? null : filemtime(get_parent_theme_file_path( '/css/vendor.css' )), 'all' );

    wp_enqueue_style( 'estude', get_parent_theme_file_uri( '/css/estude.css' ), array(), WP_DEBUG ? null : filemtime(get_parent_theme_file_path( '/css/estude.css' )), 'all' );

    /* wp_register_script( $handle, $src, $deps, $ver, $in_footer ); */
    /* wp_enqueue_script( $handle[, $src, $deps, $ver, $in_footer] ); */

    if ( file_exists( get_parent_theme_file_path( '/js/commons.js' ) ) ) {
        wp_enqueue_script( 'commons', get_parent_theme_file_uri( '/js/commons.js' ), array(), WP_DEBUG ? null : filemtime(get_parent_theme_file_path( '/js/commons.js' )), true );
    }

    wp_enqueue_script( 'estude', get_parent_theme_file_uri( '/js/estude.js' ), array(), WP_DEBUG ? null : filemtime(get_parent_theme_file_path( '/js/estude.js' )), true );

    if (is_post_type_archive( 'oportunidade' ) || is_tax( 'unidade' ) || is_front_page()) {
        wp_enqueue_script( 'oportunidades', get_parent_theme_file_uri( '/js/oportunidades.js' ), array(), WP_DEBUG ? null : filemtime(get_parent_theme_file_path( '/js/oportunidades.js' )), true );
    }

    if (is_singular( 'curso' )) {
        wp_enqueue_script( 'curso', get_parent_theme_file_uri( '/js/curso.js' ), array(), WP_DEBUG ? null : filemtime(get_parent_theme_file_path( '/js/curso.js' )), true );
    }

    if (!WP_DEBUG) {
        wp_enqueue_script( 'vlibras', 'https://vlibras.gov.br/app/vlibras-plugin.js', array(), null, true );
        wp_add_inline_script( 'vlibras', "new window.VLibras.Widget('https://vlibras.gov.br/app');" );
    }
}, 11 );
