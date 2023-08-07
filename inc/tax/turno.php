<?php
add_action( 'init', function() {
    $labels = array(
        'name'                       => _x( 'Turnos', 'Taxonomy General Name', 'ifrs-estude-theme' ),
        'singular_name'              => _x( 'Turno', 'Taxonomy Singular Name', 'ifrs-estude-theme' ),
        'menu_name'                  => __( 'Turnos', 'ifrs-estude-theme' ),
        'all_items'                  => __( 'Todos os Turnos', 'ifrs-estude-theme' ),
        'parent_item'                => __( 'Turno Pai', 'ifrs-estude-theme' ),
        'parent_item_colon'          => __( 'Turno Pai:', 'ifrs-estude-theme' ),
        'new_item_name'              => __( 'Novo Turno', 'ifrs-estude-theme' ),
        'add_new_item'               => __( 'Adicionar Novo Turno', 'ifrs-estude-theme' ),
        'edit_item'                  => __( 'Editar Turno', 'ifrs-estude-theme' ),
        'update_item'                => __( 'Atualizar Turno', 'ifrs-estude-theme' ),
        'view_item'                  => __( 'Visualizar Turno', 'ifrs-estude-theme' ),
        'separate_items_with_commas' => __( 'Turnos separados por vírgulas', 'ifrs-estude-theme' ),
        'add_or_remove_items'        => __( 'Adicionar ou Remover Turnos', 'ifrs-estude-theme' ),
        'choose_from_most_used'      => __( 'Escolher pelo Turno Mais Usado', 'ifrs-estude-theme' ),
        'popular_items'              => __( 'Turnos Populares', 'ifrs-estude-theme' ),
        'search_items'               => __( 'Buscar Turnos', 'ifrs-estude-theme' ),
        'not_found'                  => __( 'Não Encontrado', 'ifrs-estude-theme' ),
        'no_terms'                   => __( 'Sem Turnos', 'ifrs-estude-theme' ),
        'items_list'                 => __( 'Lista de Turnos', 'ifrs-estude-theme' ),
        'items_list_navigation'      => __( 'Lista de navegação de Turnos', 'ifrs-estude-theme' ),
    );

    $capabilities = array(
        'manage_terms'               => 'manage_turnos',
        'edit_terms'                 => 'manage_turnos',
        'delete_terms'               => 'manage_turnos',
        'assign_terms'               => 'edit_cursos',
    );

    $args = array(
        'labels'                     => $labels,
        'description'                => __( 'Turnos nos quais acontecem aulas.', 'ifrs-estude-theme' ),
        'public'                     => true,
        'show_in_rest'               => true,
        'show_tagcloud'              => false,
        'show_admin_column'          => true,
        'capabilities'               => $capabilities,
        'rewrite'                    => array( 'slug' => 'cursos/turno' ),
    );

    register_taxonomy( 'turno', array( 'curso' ), $args );
}, 0 );
