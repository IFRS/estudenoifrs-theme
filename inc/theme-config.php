<?php
// Content width
if ( ! isset( $content_width ) ) $content_width = 1296;

// Remove some Gutenberg custom options
add_theme_support( 'editor-color-palette' );
add_theme_support( 'editor-gradient-presets' );
add_theme_support( 'disable-custom-colors' );
add_theme_support( 'disable-custom-gradients' );
add_theme_support( 'disable-custom-font-sizes' );
add_theme_support( 'custom-units', array() );

// Gutenberg Default Theme Styles
add_theme_support( 'wp-block-styles' );

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
        'name'          => 'Carrossel',
        'id'            => 'area-carousel',
        'description'   => __('Área para imagens em forma de slider.', 'ifrs-ingresso-theme'),
        'before_widget' => '<div id="%1$s" class="carousel-item %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<span class="visually-hidden">',
        'after_title'   => '</span>',
    ));
    register_sidebar(array(
        'name'          => 'Contato',
        'id'            => 'area-contato',
        'description'   => __('Área para formulário de contato no rodapé, aparece em todas as páginas.', 'ifrs-ingresso-theme'),
        'before_widget' => '<div id="%1$s" class="contato__widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<span class="visually-hidden">',
        'after_title'   => '</span>',
    ));
    register_sidebar(array(
        'name'          => 'Rodapé',
        'id'            => 'area-rodape',
        'description'   => __('Área para informações de contato no rodapé.', 'ifrs-ingresso-theme'),
        'before_widget' => '<address id="%1$s" class="footer__widget %2$s">',
        'after_widget'  => '</address>',
        'before_title'  => '<h2 class="footer__widget-title">',
        'after_title'   => '</h2>',
    ));
});

// Prevents ContactForm7 plugin to add <p> tag
add_filter('wpcf7_autop_or_not', '__return_false');
