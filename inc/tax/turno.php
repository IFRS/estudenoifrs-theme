<?php
add_action( 'init', function() {
    $labels = array(
        'name'                       => _x( 'Turnos', 'Taxonomy General Name', 'ifrs-ingresso-theme' ),
        'singular_name'              => _x( 'Turno', 'Taxonomy Singular Name', 'ifrs-ingresso-theme' ),
        'menu_name'                  => __( 'Turnos', 'ifrs-ingresso-theme' ),
        'all_items'                  => __( 'Todos os Turnos', 'ifrs-ingresso-theme' ),
        'parent_item'                => __( 'Turno Pai', 'ifrs-ingresso-theme' ),
        'parent_item_colon'          => __( 'Turno Pai:', 'ifrs-ingresso-theme' ),
        'new_item_name'              => __( 'Novo Turno', 'ifrs-ingresso-theme' ),
        'add_new_item'               => __( 'Adicionar Novo Turno', 'ifrs-ingresso-theme' ),
        'edit_item'                  => __( 'Editar Turno', 'ifrs-ingresso-theme' ),
        'update_item'                => __( 'Atualizar Turno', 'ifrs-ingresso-theme' ),
        'view_item'                  => __( 'Visualizar Turno', 'ifrs-ingresso-theme' ),
        'separate_items_with_commas' => __( 'Turnos separados com vírgulas', 'ifrs-ingresso-theme' ),
        'add_or_remove_items'        => __( 'Adicionar ou Remover Turnos', 'ifrs-ingresso-theme' ),
        'choose_from_most_used'      => __( 'Escolher pelo Turno Mais Usado', 'ifrs-ingresso-theme' ),
        'popular_items'              => __( 'Turnos Populares', 'ifrs-ingresso-theme' ),
        'search_items'               => __( 'Buscar Turnos', 'ifrs-ingresso-theme' ),
        'not_found'                  => __( 'Não Encontrado', 'ifrs-ingresso-theme' ),
        'no_terms'                   => __( 'Sem Turnos', 'ifrs-ingresso-theme' ),
        'items_list'                 => __( 'Lista de Turnos', 'ifrs-ingresso-theme' ),
        'items_list_navigation'      => __( 'Lista de navegação de Turnos', 'ifrs-ingresso-theme' ),
    );

    $capabilities = array(
        'manage_terms'               => 'manage_turnos',
        'edit_terms'                 => 'manage_turnos',
        'delete_terms'               => 'manage_turnos',
        'assign_terms'               => 'assign_turnos',
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
        // 'rewrite'                    => array('slug' => 'cursos/turnos', 'with_front' => false),
    );

    register_taxonomy( 'turno', array( 'curso' ), $args );
}, 0 );
