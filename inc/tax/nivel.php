<?php
add_action( 'init', function() {
    $labels = array(
        'name'                       => _x( 'Níveis', 'Taxonomy General Name', 'ifrs-ingresso-theme' ),
        'singular_name'              => _x( 'Nível', 'Taxonomy Singular Name', 'ifrs-ingresso-theme' ),
        'menu_name'                  => __( 'Níveis', 'ifrs-ingresso-theme' ),
        'all_items'                  => __( 'Todos os Níveis', 'ifrs-ingresso-theme' ),
        'parent_item'                => __( 'Nível Pai', 'ifrs-ingresso-theme' ),
        'parent_item_colon'          => __( 'Nível Pai:', 'ifrs-ingresso-theme' ),
        'new_item_name'              => __( 'Novo Nível', 'ifrs-ingresso-theme' ),
        'add_new_item'               => __( 'Adicionar Novo Nível', 'ifrs-ingresso-theme' ),
        'edit_item'                  => __( 'Editar Nível', 'ifrs-ingresso-theme' ),
        'update_item'                => __( 'Atualizar Nível', 'ifrs-ingresso-theme' ),
        'view_item'                  => __( 'Visualizar Nível', 'ifrs-ingresso-theme' ),
        'separate_items_with_commas' => __( 'Níveis separados por vírgula', 'ifrs-ingresso-theme' ),
        'add_or_remove_items'        => __( 'Adicionar ou Remover Níveis', 'ifrs-ingresso-theme' ),
        'choose_from_most_used'      => __( 'Escolher pelo Nível Mais Usado', 'ifrs-ingresso-theme' ),
        'popular_items'              => __( 'Níveis Populares', 'ifrs-ingresso-theme' ),
        'search_items'               => __( 'Buscar Níveis', 'ifrs-ingresso-theme' ),
        'not_found'                  => __( 'Não Encontrado', 'ifrs-ingresso-theme' ),
        'no_terms'                   => __( 'Sem Níveis', 'ifrs-ingresso-theme' ),
        'items_list'                 => __( 'Lista de Níveis', 'ifrs-ingresso-theme' ),
        'items_list_navigation'      => __( 'Lista de navegação de Níveis', 'ifrs-ingresso-theme' ),
    );

    $capabilities = array(
        'manage_terms'               => 'manage_niveis',
        'edit_terms'                 => 'manage_niveis',
        'delete_terms'               => 'manage_niveis',
        'assign_terms'               => 'assign_niveis',
    );

    $args = array(
        'labels'                     => $labels,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => false,
        'capabilities'               => $capabilities,
        'show_in_rest'               => true,
        // 'rewrite'                    => array('slug' => 'cursos/niveis', 'with_front' => false),
    );

    register_taxonomy( 'nivel', array( 'curso' ), $args );
}, 0 );

/**
 * Limita a profundidade da hierarquia
 */
add_filter( 'taxonomy_parent_dropdown_args', function( $args, $taxonomy ) {
    if ( 'nivel' != $taxonomy ) return $args;

    $args['depth'] = '1';
    return $args;
}, 10, 2 );

/* Colorpicker */
add_action( 'cmb2_admin_init', function() {
    $prefix = '_nivel_';

    /**
     * Datas Metabox
     */
    $datas = new_cmb2_box( array(
        'id'            => $prefix . 'metabox',
        'title'         => __( 'Cor', 'ifrs-ingresso-theme' ),
        'object_types'  => array( 'term' ),
        'taxonomies'    => array( 'nivel' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => false,
    ) );

    /* Isenção */
    $datas->add_field( array(
        'name'    => __( 'Cor', 'ifrs-ingresso-theme' ),
        'desc'    => __( 'Selecione a cor para representar esse nível.', 'ifrs-ingresso-theme' ),
        'id'      => $prefix . 'color',
        'type'    => 'colorpicker',
        'default' => '#000000',
    ) );
});
