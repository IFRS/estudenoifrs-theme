<?php
add_action( 'init', function() {
    $labels = array(
        'name'                       => _x( 'Unidades', 'Taxonomy General Name', 'ifrs-ingresso-theme' ),
        'singular_name'              => _x( 'Unidade', 'Taxonomy Singular Name', 'ifrs-ingresso-theme' ),
        'menu_name'                  => __( 'Unidades', 'ifrs-ingresso-theme' ),
        'all_items'                  => __( 'Todas as Unidades', 'ifrs-ingresso-theme' ),
        'parent_item'                => __( 'Unidade mãe', 'ifrs-ingresso-theme' ),
        'parent_item_colon'          => __( 'Unidade mãe:', 'ifrs-ingresso-theme' ),
        'new_item_name'              => __( 'Nova Unidade', 'ifrs-ingresso-theme' ),
        'add_new_item'               => __( 'Adicionar Nova Unidade', 'ifrs-ingresso-theme' ),
        'edit_item'                  => __( 'Editar Unidade', 'ifrs-ingresso-theme' ),
        'update_item'                => __( 'Atualizar Unidade', 'ifrs-ingresso-theme' ),
        'view_item'                  => __( 'Visualizar Unidade', 'ifrs-ingresso-theme' ),
        'separate_items_with_commas' => __( 'Unidades separadas por vígulas', 'ifrs-ingresso-theme' ),
        'add_or_remove_items'        => __( 'Adicionar ou Remover Unidades', 'ifrs-ingresso-theme' ),
        'choose_from_most_used'      => __( 'Escolher pela Unidade mais usada', 'ifrs-ingresso-theme' ),
        'popular_items'              => __( 'Unidades populares', 'ifrs-ingresso-theme' ),
        'search_items'               => __( 'Buscar Unidades', 'ifrs-ingresso-theme' ),
        'not_found'                  => __( 'Não encontrada', 'ifrs-ingresso-theme' ),
        'no_terms'                   => __( 'Sem Unidades', 'ifrs-ingresso-theme' ),
        'items_list'                 => __( 'Lista de Unidades', 'ifrs-ingresso-theme' ),
        'items_list_navigation'      => __( 'Lista de navegação de Unidades', 'ifrs-ingresso-theme' ),
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

    register_taxonomy( 'unidade', array( 'oportunidade', 'curso' ), $args );
}, 0 );
