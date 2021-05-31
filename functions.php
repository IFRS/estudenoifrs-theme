<?php
// Remove a versão do WP
require_once('inc/remove-version.php');

// Permissions & Roles
require_once('inc/permissions.php');

// Carregamento das fontes
require_once('inc/fonts.php');

// Configurações para o tema
require_once('inc/theme-config.php');

// Menus
require_once('inc/menus.php');

// Tamanho do resumo e resumo em páginas
require_once('inc/excerpt.php');

// Lazyload em imagens
require_once('inc/lazyload.php');

// Breadcrumb
require_once('inc/breadcrumb.php');

// Paginação personalizada
require_once('inc/pagination.php');

// Controla a busca com termo vazio
require_once('inc/empty-search.php');

// Scripts & Styles
require_once('inc/assets.php');

// Custom Post Type
require('inc/cpt/pergunta.php');

require('inc/cpt/oportunidade.php');
require('inc/tax/forma-ingresso.php');
require('inc/tax/unidade.php');
