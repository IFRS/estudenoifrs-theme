<?php
// Content width
if ( ! isset( $content_width ) ) $content_width = 1296;

// Gutenberg Default Theme Styles
add_theme_support( 'wp-block-styles' );

// Remove some Gutenberg custom options
add_theme_support( 'custom-units', array() );
add_theme_support( 'editor-color-palette', array() );
add_theme_support( 'editor-gradient-presets', array() );
add_theme_support( 'editor-font-sizes', array() );
add_theme_support( 'disable-custom-font-sizes', true );
add_theme_support( 'disable-custom-colors' );
add_theme_support( 'disable-custom-gradients' );
// add_theme_support( 'disable-layout-styles' );

// Add theme support for Automatic Feed Links
add_theme_support( 'automatic-feed-links' );

// Add theme support for Featured Images
add_theme_support( 'post-thumbnails' );

// Add theme support for HTML5 Semantic Markup
add_theme_support( 'html5', array(
    'search-form',
    'comment-form',
    'comment-list',
    'gallery',
    'caption',
) );

// Add theme support for Responsive Embeds
add_theme_support( 'responsive-embeds' );

// Add theme support for document <title> tag
add_theme_support( 'title-tag' );

// Custom Logo
add_theme_support( 'custom-logo', array(
    'width'       => 540,
    'height'      => 142,
    'flex-height' => false,
    'flex-width'  => true,
) );

// Custom Header Image
add_theme_support( 'custom-header', array(
    'default-image'      => get_template_directory_uri() . '/img/header-bg.png',
    'random-default'     => false,
    'uploads'            => true,
    'default-text-color' => 'ffffff',
    'width'              => 1920,
    'height'             => 226,
    'flex-width'         => false,
    'flex-height'        => true,
) );

// Sidebars
add_action('widgets_init', function() {
    register_sidebar(array(
        'name'          => 'Banners',
        'id'            => 'area-banners',
        'description'   => __('Área para imagens de divulgação. Aparece somente na página inicial, abaixo das "Inscrições Abertas".', 'ifrs-estude-theme'),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
    ));
    register_sidebar(array(
        'name'          => 'Contato',
        'id'            => 'area-contato',
        'description'   => __('Área para formulário de contato. Aparece em todas as páginas.', 'ifrs-estude-theme'),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
    ));
    register_sidebar(array(
        'name'           => 'Rodapé',
        'id'             => 'area-rodape',
        'description'    => __('Área para informações de contato no rodapé.', 'ifrs-estude-theme'),
        'before_sidebar' => '<address id="%1$s" class="%2$s">',
        'after_sidebar'  => '</address>',
        'before_widget'  => '<div id="%1$s" class="%2$s">',
        'after_widget'   => '</div>',
    ));
});

// Prevents ContactForm7 plugin to add <p> tag
add_filter('wpcf7_autop_or_not', '__return_false');
