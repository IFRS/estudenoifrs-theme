<?php
add_action( 'init', function() {
    $labels = array(
        'name'                => _x( 'Perguntas', 'Post Type General Name', 'ifrs-estude-theme' ),
        'singular_name'       => _x( 'Pergunta', 'Post Type Singular Name', 'ifrs-estude-theme' ),
        'menu_name'           => __( 'Perguntas', 'ifrs-estude-theme' ),
        'name_admin_bar'      => __( 'Perguntas', 'ifrs-estude-theme' ),
        'parent_item_colon'   => __( 'Pergunta principal:', 'ifrs-estude-theme' ),
        'all_items'           => __( 'Todas as Perguntas', 'ifrs-estude-theme' ),
        'add_new_item'        => __( 'Adicionar Nova Pergunta', 'ifrs-estude-theme' ),
        'add_new'             => __( 'Adicionar Nova', 'ifrs-estude-theme' ),
        'new_item'            => __( 'Nova Pergunta', 'ifrs-estude-theme' ),
        'edit_item'           => __( 'Editar Pergunta', 'ifrs-estude-theme' ),
        'update_item'         => __( 'Atualizar Pergunta', 'ifrs-estude-theme' ),
        'view_item'           => __( 'Ver Pergunta', 'ifrs-estude-theme' ),
        'search_items'        => __( 'Buscar Perguntas', 'ifrs-estude-theme' ),
        'not_found'           => __( 'Não encontrada', 'ifrs-estude-theme' ),
        'not_found_in_trash'  => __( 'Não encontrada na Lixeira', 'ifrs-estude-theme' ),
    );
    $args = array(
        'label'               => __( 'Pergunta', 'ifrs-estude-theme' ),
        'description'         => __( 'Perguntas Frequentes', 'ifrs-estude-theme' ),
        'labels'              => $labels,
        'supports'            => array( 'title', 'editor', 'revisions' ),
        'taxonomies'          => array(),
        'hierarchical'        => false,
        'public'              => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'menu_position'       => 25,
        'menu_icon'           => 'dashicons-lightbulb',
        'can_export'          => true,
        'has_archive'         => true,
        'exclude_from_search' => false,
        'publicly_queryable'  => true,
        'rewrite'             => array( 'slug' => 'perguntas' ),
    );
    register_post_type( 'pergunta', $args );
}, 3 );
