<?php
$manifestFile = get_theme_file_path('.vite/manifest.json');

if (file_exists($manifestFile)) {
    $manifest = json_decode(file_get_contents($manifestFile), true);

    /* Block Editor Assets */
    add_action('enqueue_block_editor_assets', function () use ($manifest) {
        /* wp_enqueue_style( string $handle, string $src, string[] $deps = array(), string|bool|null $ver = false, string $media ) */

        wp_enqueue_style( $manifest['sass/estude-editor.scss']['name'], get_parent_theme_file_uri($manifest['sass/estude-editor.scss']['file']), array(), false, 'all');
    });

    /* Fonts Preload */
    add_action('wp_head', function() use ($manifest) {
        echo '<link rel="preload" href="' . esc_url( get_parent_theme_file_uri( $manifest['node_modules/@fontsource/open-sans/files/open-sans-latin-400-normal.woff2']['file'] ) ) . '" as="font" type="font/woff2" crossorigin="anonymous"/>';
    }, 1);


    /* Frontend Styles and Scripts */
    add_action( 'wp_enqueue_scripts', function() use ($manifest) {
        /* wp_register_style( string $handle, string|false $src, string[] $deps = array(), string|bool|null $ver = false, string $media ): bool */
        /* wp_enqueue_style( string $handle, string $src, string[] $deps = array(), string|bool|null $ver = false, string $media ) */

        wp_enqueue_style( $manifest['sass/fonts.scss']['name'], get_parent_theme_file_uri($manifest['sass/fonts.scss']['file']), array(), false, 'all' );

        wp_enqueue_style( $manifest['sass/vendor.scss']['name'], get_parent_theme_file_uri($manifest['sass/vendor.scss']['file']), array(), false, 'all' );

        wp_enqueue_style( $manifest['sass/estude.scss']['name'], get_parent_theme_file_uri($manifest['sass/estude.scss']['file']), array(), false, 'all' );

        /* wp_register_script( string $handle, string|false $src, string[] $deps = array(), string|bool|null $ver = false, array|bool $args = array() ): bool */
        /* wp_enqueue_script( string $handle, string $src, string[] $deps = array(), string|bool|null $ver = false, array|bool $args = array() ) */
        /* wp_enqueue_script_module( string $id, string $src, array $deps = array(), string|false|null $version = false, array $args = array() ) */

        wp_enqueue_script_module( $manifest['src/estude.js']['name'], get_parent_theme_file_uri( $manifest['src/estude.js']['file'] ), array(), false, array( 'in_footer' => true ) );

        if (is_post_type_archive( 'oportunidade' ) || is_tax( 'unidade' ) || is_front_page()) {
            wp_enqueue_script_module( $manifest['src/oportunidades.js']['name'], get_parent_theme_file_uri( $manifest['src/oportunidades.js']['file'] ), array(), false, array( 'in_footer' => true ) );
        }

        if (is_post_type_archive( 'curso' ) || is_tax( array( 'modalidade', 'nivel', 'turno', 'unidade' ) )) {
            wp_enqueue_script_module( $manifest['src/cursos.js']['name'], get_parent_theme_file_uri( $manifest['src/cursos.js']['file'] ), array(), false, array( 'in_footer' => true ) );
        }

        if (is_singular( 'curso' )) {
            wp_enqueue_script_module( $manifest['src/curso.js']['name'], get_parent_theme_file_uri( $manifest['src/curso.js']['file'] ), array(), false, array( 'in_footer' => true ) );
        }

        /* VLibras */
        if (!WP_DEBUG) {
            wp_enqueue_script( 'vlibras', 'https://vlibras.gov.br/app/vlibras-plugin.js', array(), false, true );
            wp_add_inline_script( 'vlibras', "new window.VLibras.Widget('https://vlibras.gov.br/app');" );
        }
    }, 11 );
}
