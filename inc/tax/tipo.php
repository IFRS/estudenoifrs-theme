<?php
add_action( 'init', function() {
    $labels = array(
        'name'                       => _x( 'Tipos', 'Taxonomy General Name', 'ifrs-ingresso-theme' ),
        'singular_name'              => _x( 'Tipo', 'Taxonomy Singular Name', 'ifrs-ingresso-theme' ),
        'menu_name'                  => __( 'Tipos', 'ifrs-ingresso-theme' ),
        'all_items'                  => __( 'Todos os Tipos', 'ifrs-ingresso-theme' ),
        'parent_item'                => __( 'Tipo pai', 'ifrs-ingresso-theme' ),
        'parent_item_colon'          => __( 'Tipo pai:', 'ifrs-ingresso-theme' ),
        'new_item_name'              => __( 'Novo Tipo', 'ifrs-ingresso-theme' ),
        'add_new_item'               => __( 'Adicionar Novo Tipo', 'ifrs-ingresso-theme' ),
        'edit_item'                  => __( 'Editar Tipo', 'ifrs-ingresso-theme' ),
        'update_item'                => __( 'Atualizar Tipo', 'ifrs-ingresso-theme' ),
        'view_item'                  => __( 'Visualizar Tipo', 'ifrs-ingresso-theme' ),
        'separate_items_with_commas' => __( 'Tipos separados por vígulas', 'ifrs-ingresso-theme' ),
        'add_or_remove_items'        => __( 'Adicionar ou Remover Tipos', 'ifrs-ingresso-theme' ),
        'choose_from_most_used'      => __( 'Escolher o mais usada', 'ifrs-ingresso-theme' ),
        'popular_items'              => __( 'Tipos populares', 'ifrs-ingresso-theme' ),
        'search_items'               => __( 'Buscar Tipos', 'ifrs-ingresso-theme' ),
        'not_found'                  => __( 'Não encontrado', 'ifrs-ingresso-theme' ),
        'no_terms'                   => __( 'Sem Tipos', 'ifrs-ingresso-theme' ),
        'items_list'                 => __( 'Lista de Tipos', 'ifrs-ingresso-theme' ),
        'items_list_navigation'      => __( 'Lista de navegação de Tipos', 'ifrs-ingresso-theme' ),
    );

    $capabilities = array(
        'manage_terms'               => 'manage_tipos',
        'edit_terms'                 => 'manage_tipos',
        'delete_terms'               => 'manage_tipos',
        'assign_terms'               => 'assign_tipos',
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => false,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'capabilities'               => $capabilities,
        'show_in_rest'               => true,
    );

    register_taxonomy( 'tipo', array( 'oportunidade' ), $args );
}, 0 );
