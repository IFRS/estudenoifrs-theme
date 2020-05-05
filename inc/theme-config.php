<?php
// Registra os menus
register_nav_menus(
    array(
        'main' => 'Menu Principal',
    )
);

// Habilita a personalização de cabeçalho
add_theme_support('custom-header', array(
    'default-image'          => get_stylesheet_directory_uri() . '/img/header.png',
	'width'                  => 540,
	'height'                 => 142,
	'flex-height'            => false,
	'flex-width'             => true,
	'uploads'                => true,
	'random-default'         => false,
	'header-text'            => false,
	'default-text-color'     => '',
	'wp-head-callback'       => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
));

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
        'before_title'  => '<span class="sr-only">',
        'after_title'   => '</span>',
    ));
    register_sidebar(array(
        'name'          => 'Contato',
        'id'            => 'area-contato',
        'description'   => __('Área para formulário de contato no rodapé, aparece em todas as páginas.', 'ifrs-ingresso-theme'),
        'before_widget' => '<div id="%1$s" class="contato__widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<span class="sr-only">',
        'after_title'   => '</span>',
    ));
});

// Impede a adição da tag <p> pelo plugin ContactForm7
add_filter('wpcf7_autop_or_not', '__return_false');
