<?php
if ( ! function_exists('ingresso_ctp_pergunta') ) {
    function ingresso_ctp_pergunta() {
        $labels = array(
            'name'                => _x( 'Perguntas', 'Post Type General Name', 'ifrs-ingresso-theme' ),
            'singular_name'       => _x( 'Pergunta', 'Post Type Singular Name', 'ifrs-ingresso-theme' ),
            'menu_name'           => __( 'Perguntas', 'ifrs-ingresso-theme' ),
            'name_admin_bar'      => __( 'Perguntas', 'ifrs-ingresso-theme' ),
            'parent_item_colon'   => __( 'Pergunta principal:', 'ifrs-ingresso-theme' ),
            'all_items'           => __( 'Todas as Perguntas', 'ifrs-ingresso-theme' ),
            'add_new_item'        => __( 'Adicionar Nova Pergunta', 'ifrs-ingresso-theme' ),
            'add_new'             => __( 'Adicionar Nova', 'ifrs-ingresso-theme' ),
            'new_item'            => __( 'Nova Pergunta', 'ifrs-ingresso-theme' ),
            'edit_item'           => __( 'Editar Pergunta', 'ifrs-ingresso-theme' ),
            'update_item'         => __( 'Atualizar Pergunta', 'ifrs-ingresso-theme' ),
            'view_item'           => __( 'Ver Pergunta', 'ifrs-ingresso-theme' ),
            'search_items'        => __( 'Buscar Pergunta', 'ifrs-ingresso-theme' ),
            'not_found'           => __( 'Não encontrada', 'ifrs-ingresso-theme' ),
            'not_found_in_trash'  => __( 'Não encontrada na Lixeira', 'ifrs-ingresso-theme' ),
        );
        $args = array(
            'label'               => __( 'pergunta', 'ifrs-ingresso-theme' ),
            'description'         => __( 'Perguntas', 'ifrs-ingresso-theme' ),
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
            'rewrite'             => array('slug' => 'perguntas'),
        );
        register_post_type( 'pergunta', $args );
    }
    add_action( 'init', 'ingresso_ctp_pergunta', 1 );
}
