<?php
add_action( 'init', function() {
    $labels = array(
        'name'                       => _x( 'Unidades', 'Taxonomy General Name', 'ifrs-estude-theme' ),
        'singular_name'              => _x( 'Unidade', 'Taxonomy Singular Name', 'ifrs-estude-theme' ),
        'menu_name'                  => __( 'Unidades', 'ifrs-estude-theme' ),
        'all_items'                  => __( 'Todas as Unidades', 'ifrs-estude-theme' ),
        'parent_item'                => __( 'Unidade mãe', 'ifrs-estude-theme' ),
        'parent_item_colon'          => __( 'Unidade mãe:', 'ifrs-estude-theme' ),
        'new_item_name'              => __( 'Nova Unidade', 'ifrs-estude-theme' ),
        'add_new_item'               => __( 'Adicionar Nova Unidade', 'ifrs-estude-theme' ),
        'edit_item'                  => __( 'Editar Unidade', 'ifrs-estude-theme' ),
        'update_item'                => __( 'Atualizar Unidade', 'ifrs-estude-theme' ),
        'view_item'                  => __( 'Visualizar Unidade', 'ifrs-estude-theme' ),
        'separate_items_with_commas' => __( 'Unidades separadas por vígulas', 'ifrs-estude-theme' ),
        'add_or_remove_items'        => __( 'Adicionar ou Remover Unidades', 'ifrs-estude-theme' ),
        'choose_from_most_used'      => __( 'Escolher pela Unidade mais usada', 'ifrs-estude-theme' ),
        'popular_items'              => __( 'Unidades populares', 'ifrs-estude-theme' ),
        'search_items'               => __( 'Buscar Unidades', 'ifrs-estude-theme' ),
        'not_found'                  => __( 'Não encontrada', 'ifrs-estude-theme' ),
        'no_terms'                   => __( 'Sem Unidades', 'ifrs-estude-theme' ),
        'items_list'                 => __( 'Lista de Unidades', 'ifrs-estude-theme' ),
        'items_list_navigation'      => __( 'Lista de navegação de Unidades', 'ifrs-estude-theme' ),
    );

    $capabilities = array(
        'manage_terms'               => 'manage_unidades',
        'edit_terms'                 => 'manage_unidades',
        'delete_terms'               => 'manage_unidades',
        'assign_terms'               => 'assign_unidades',
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'capabilities'               => $capabilities,
        'show_in_rest'               => true,
        // 'rewrite'                    => array('slug' => 'cursos/unidades', 'with_front' => false),
    );

    register_taxonomy( 'unidade', array( 'curso' ), $args );
}, 0 );
