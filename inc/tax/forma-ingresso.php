<?php
if ( ! function_exists( 'ingresso_forma_taxonomy' ) ) {
    function ingresso_forma_taxonomy() {
        $labels = array(
            'name'                       => _x( 'Formas de Ingresso', 'Taxonomy General Name', 'ifrs-ingresso-theme' ),
            'singular_name'              => _x( 'Forma de Ingresso', 'Taxonomy Singular Name', 'ifrs-ingresso-theme' ),
            'menu_name'                  => __( 'Forma de Ingresso', 'ifrs-ingresso-theme' ),
            'all_items'                  => __( 'Todas as Formas de Ingresso', 'ifrs-ingresso-theme' ),
            'parent_item'                => __( 'Forma de Ingresso mãe', 'ifrs-ingresso-theme' ),
            'parent_item_colon'          => __( 'Forma de Ingresso mãe:', 'ifrs-ingresso-theme' ),
            'new_item_name'              => __( 'Nova Forma de Ingresso', 'ifrs-ingresso-theme' ),
            'add_new_item'               => __( 'Adicionar Nova Forma de Ingresso', 'ifrs-ingresso-theme' ),
            'edit_item'                  => __( 'Editar Forma de Ingresso', 'ifrs-ingresso-theme' ),
            'update_item'                => __( 'Atualizar Forma de Ingresso', 'ifrs-ingresso-theme' ),
            'view_item'                  => __( 'Visualizar Forma de Ingresso', 'ifrs-ingresso-theme' ),
            'separate_items_with_commas' => __( 'Formas de Ingresso separadas por vígulas', 'ifrs-ingresso-theme' ),
            'add_or_remove_items'        => __( 'Adicionar ou Remover Formas de Ingresso', 'ifrs-ingresso-theme' ),
            'choose_from_most_used'      => __( 'Escolher a mais usada', 'ifrs-ingresso-theme' ),
            'popular_items'              => __( 'Formas de Ingresso populares', 'ifrs-ingresso-theme' ),
            'search_items'               => __( 'Buscar Formas de Ingresso', 'ifrs-ingresso-theme' ),
            'not_found'                  => __( 'Não encontrada', 'ifrs-ingresso-theme' ),
            'no_terms'                   => __( 'Sem Formas de Ingresso', 'ifrs-ingresso-theme' ),
            'items_list'                 => __( 'Lista de Formas de Ingresso', 'ifrs-ingresso-theme' ),
            'items_list_navigation'      => __( 'Lista de navegação de Formas de Ingresso', 'ifrs-ingresso-theme' ),
        );

        $capabilities = array(
            'manage_terms'               => 'manage_formas',
            'edit_terms'                 => 'manage_formas',
            'delete_terms'               => 'manage_formas',
            'assign_terms'               => 'edit_oportunidades',
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

        register_taxonomy( 'forma', array( 'oportunidade' ), $args );
    }

    add_action( 'init', 'ingresso_forma_taxonomy', 0 );
}
