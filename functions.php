<?php
// Utils
require_once 'inc/sortArrayByArray.php';

// Remove a versão do WP
require_once 'inc/remove-version.php';

// Permissions & Roles
require_once 'inc/permissions.php';

// Carregamento das fontes
require_once 'inc/fonts.php';

// Configurações para o tema
require_once 'inc/theme-config.php';
require_once 'inc/remove-h1.php';

// Menus
require_once 'inc/menus.php';
require_once 'inc/site-map-walker.class.php';

// Tamanho do resumo e resumo em páginas
require_once 'inc/excerpt.php';

// Adiciona classe no primeiro item da área carousel
require_once 'inc/carousel-first-item-add-class.php';

// Breadcrumb
require_once 'inc/breadcrumb.php';

// Paginação personalizada
require_once 'inc/pagination.php';

// Controla a busca com termo vazio
require_once 'inc/empty-search.php';

// Scripts & Styles
require_once 'inc/assets.php';

// Custom Post Type
require_once 'inc/cpt/pergunta.php';
require_once 'inc/cpt/oportunidade.php';
require_once 'inc/cpt/curso.php';

require_once 'inc/tax/modalidade.php';
require_once 'inc/tax/nivel.php';
require_once 'inc/tax/turno.php';
require_once 'inc/tax/unidade.php';
