<?php
// Remove Gutenberg custom options
add_theme_support( 'editor-color-palette' );
add_theme_support( 'editor-gradient-presets' );
add_theme_support( 'disable-custom-colors' );
add_theme_support( 'disable-custom-gradients' );
add_theme_support( 'disable-custom-font-sizes' );
add_theme_support( 'custom-units', array() );

// Add theme support for Automatic Feed Links
add_theme_support( 'automatic-feed-links' );

// Add theme support for Featured Images
add_theme_support( 'post-thumbnails' );

// Add theme support for HTML5 Semantic Markup
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

// Add theme support for Responsive Embeds
add_theme_support( 'responsive-embeds' );

// Add theme support for document <title> tag
add_theme_support( 'title-tag' );

// Habilita a personalização do logo
add_theme_support( 'custom-logo', array(
    'width'       => 540,
    'height'      => 142,
    'flex-height' => false,
    'flex-width'  => true,
) );

// Registra as áreas para widgets
add_action('widgets_init', function() {
    register_sidebar(array(
        'name'          => 'Carousel',
        'id'            => 'area-carousel',
        'description'   => __('Área para conteúdo em forma de slider, geralmente imagens.', 'ifrs-ingresso-theme'),
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
});

// Impede a adição da tag <p> pelo plugin ContactForm7
add_filter('wpcf7_autop_or_not', '__return_false');
