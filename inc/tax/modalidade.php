<?php
add_action( 'init', function() {
    $labels = array(
        'name'                       => _x( 'Modalidades', 'Taxonomy General Name', 'ifrs-estude-theme' ),
        'singular_name'              => _x( 'Modalidade', 'Taxonomy Singular Name', 'ifrs-estude-theme' ),
        'menu_name'                  => __( 'Modalidades', 'ifrs-estude-theme' ),
        'all_items'                  => __( 'Todas as Modalidades', 'ifrs-estude-theme' ),
        'parent_item'                => __( 'Modalidade Mãe', 'ifrs-estude-theme' ),
        'parent_item_colon'          => __( 'Modalidade Mãe:', 'ifrs-estude-theme' ),
        'new_item_name'              => __( 'Nova Modalidade', 'ifrs-estude-theme' ),
        'add_new_item'               => __( 'Adicionar Nova Modalidade', 'ifrs-estude-theme' ),
        'edit_item'                  => __( 'Editar Modalidade', 'ifrs-estude-theme' ),
        'update_item'                => __( 'Atualizar Modalidade', 'ifrs-estude-theme' ),
        'view_item'                  => __( 'Visualizar Modalidade', 'ifrs-estude-theme' ),
        'separate_items_with_commas' => __( 'Modalidades separadas com vírgulas', 'ifrs-estude-theme' ),
        'add_or_remove_items'        => __( 'Adicionar ou Remover Modalidades', 'ifrs-estude-theme' ),
        'choose_from_most_used'      => __( 'Escolher pela Modalidade Mais Usada', 'ifrs-estude-theme' ),
        'popular_items'              => __( 'Modalidades Populares', 'ifrs-estude-theme' ),
        'search_items'               => __( 'Buscar Modalidades', 'ifrs-estude-theme' ),
        'not_found'                  => __( 'Não Encontrada', 'ifrs-estude-theme' ),
        'no_terms'                   => __( 'Sem Modalidades', 'ifrs-estude-theme' ),
        'items_list'                 => __( 'Lista de Modalidades', 'ifrs-estude-theme' ),
        'items_list_navigation'      => __( 'Lista de navegação de Modalidades', 'ifrs-estude-theme' ),
    );

    $capabilities = array(
        'manage_terms'               => 'manage_modalidades',
        'edit_terms'                 => 'manage_modalidades',
        'delete_terms'               => 'manage_modalidades',
        'assign_terms'               => 'assign_modalidades',
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
        // 'rewrite'                    => array('slug' => 'cursos/modalidades', 'with_front' => false),
    );

    register_taxonomy( 'modalidade', array( 'curso' ), $args );
}, 0 );
