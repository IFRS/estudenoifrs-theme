<?php
// Remove a versão do WP
require_once('inc/remove-version.php');

// Desabilita o suporte a emojis
require_once('inc/disable-emojis.php');

// Permissions & Roles
require_once('inc/permissions.php');

// Configurações para o tema
require_once('inc/theme-config.php');

// Tamanho do resumo e resumo em páginas
require_once('inc/excerpt.php');

// Breadcrumb
require_once('inc/breadcrumb.php');

// Paginação personalizada
require_once('inc/pagination.php');

// Controla a busca com termo vazio
require_once('inc/empty-search.php');

// Scripts & Styles
require_once('inc/assets.php');

// Bootstrap 4 navwalker
if ( ! file_exists( get_stylesheet_directory() . '/vendor/wp-bootstrap/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php' ) ) {
	// file does not exist... return an error.
	return new WP_Error( 'class-wp-bootstrap-navwalker-missing', __( 'It appears the class-wp-bootstrap-navwalker.php file may be missing.', 'wp-bootstrap-navwalker' ) );
} else {
	// file exists... require it.
	require_once get_stylesheet_directory() . '/vendor/wp-bootstrap/wp-bootstrap-navwalker/class-wp-bootstrap-navwalker.php';
}

// Custom Post Type
require('inc/cpt/pergunta.php');

require('inc/cpt/oportunidade.php');
require('inc/tax/forma-ingresso.php');
require('inc/tax/unidade.php');
