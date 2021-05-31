<?php
// Habilita a personalização do logo
add_theme_support( 'custom-logo', array(
    'width'       => 540,
    'height'      => 142,
    'flex-height' => false,
    'flex-width'  => true,
) );

// Habilita imagens destaque
add_theme_support( 'post-thumbnails' );

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
