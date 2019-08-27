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
	'width'                  => 350,
	'height'                 => 80,
	'flex-height'            => false,
	'flex-width'             => false,
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
