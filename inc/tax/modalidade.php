<?php
add_action( 'init', function() {
    $labels = array(
        'name'                       => _x( 'Modalidades', 'Taxonomy General Name', 'ifrs-ingresso-theme' ),
        'singular_name'              => _x( 'Modalidade', 'Taxonomy Singular Name', 'ifrs-ingresso-theme' ),
        'menu_name'                  => __( 'Modalidades', 'ifrs-ingresso-theme' ),
        'all_items'                  => __( 'Todas as Modalidades', 'ifrs-ingresso-theme' ),
        'parent_item'                => __( 'Modalidade Mãe', 'ifrs-ingresso-theme' ),
        'parent_item_colon'          => __( 'Modalidade Mãe:', 'ifrs-ingresso-theme' ),
        'new_item_name'              => __( 'Nova Modalidade', 'ifrs-ingresso-theme' ),
        'add_new_item'               => __( 'Adicionar Nova Modalidade', 'ifrs-ingresso-theme' ),
        'edit_item'                  => __( 'Editar Modalidade', 'ifrs-ingresso-theme' ),
        'update_item'                => __( 'Atualizar Modalidade', 'ifrs-ingresso-theme' ),
        'view_item'                  => __( 'Visualizar Modalidade', 'ifrs-ingresso-theme' ),
        'separate_items_with_commas' => __( 'Modalidades separadas com vírgulas', 'ifrs-ingresso-theme' ),
        'add_or_remove_items'        => __( 'Adicionar ou Remover Modalidades', 'ifrs-ingresso-theme' ),
        'choose_from_most_used'      => __( 'Escolher pela Modalidade Mais Usada', 'ifrs-ingresso-theme' ),
        'popular_items'              => __( 'Modalidades Populares', 'ifrs-ingresso-theme' ),
        'search_items'               => __( 'Buscar Modalidades', 'ifrs-ingresso-theme' ),
        'not_found'                  => __( 'Não Encontrada', 'ifrs-ingresso-theme' ),
        'no_terms'                   => __( 'Sem Modalidades', 'ifrs-ingresso-theme' ),
        'items_list'                 => __( 'Lista de Modalidades', 'ifrs-ingresso-theme' ),
        'items_list_navigation'      => __( 'Lista de navegação de Modalidades', 'ifrs-ingresso-theme' ),
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
