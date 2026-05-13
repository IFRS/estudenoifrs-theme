<?php
add_action( 'init', function() {
    $labels = array(
        'name'                       => _x( 'Níveis', 'Taxonomy General Name', 'ifrs-estude-theme' ),
        'singular_name'              => _x( 'Nível', 'Taxonomy Singular Name', 'ifrs-estude-theme' ),
        'menu_name'                  => __( 'Níveis', 'ifrs-estude-theme' ),
        'all_items'                  => __( 'Todos os Níveis', 'ifrs-estude-theme' ),
        'parent_item'                => __( 'Nível Pai', 'ifrs-estude-theme' ),
        'parent_item_colon'          => __( 'Nível Pai:', 'ifrs-estude-theme' ),
        'new_item_name'              => __( 'Novo Nível', 'ifrs-estude-theme' ),
        'add_new_item'               => __( 'Adicionar Novo Nível', 'ifrs-estude-theme' ),
        'edit_item'                  => __( 'Editar Nível', 'ifrs-estude-theme' ),
        'update_item'                => __( 'Atualizar Nível', 'ifrs-estude-theme' ),
        'view_item'                  => __( 'Visualizar Nível', 'ifrs-estude-theme' ),
        'separate_items_with_commas' => __( 'Níveis separados por vírgulas', 'ifrs-estude-theme' ),
        'add_or_remove_items'        => __( 'Adicionar ou Remover Níveis', 'ifrs-estude-theme' ),
        'choose_from_most_used'      => __( 'Escolher pelo Nível Mais Usado', 'ifrs-estude-theme' ),
        'popular_items'              => __( 'Níveis Populares', 'ifrs-estude-theme' ),
        'search_items'               => __( 'Buscar Níveis', 'ifrs-estude-theme' ),
        'not_found'                  => __( 'Não Encontrado', 'ifrs-estude-theme' ),
        'no_terms'                   => __( 'Sem Níveis', 'ifrs-estude-theme' ),
        'items_list'                 => __( 'Lista de Níveis', 'ifrs-estude-theme' ),
        'items_list_navigation'      => __( 'Lista de navegação de Níveis', 'ifrs-estude-theme' ),
    );

    $capabilities = array(
        'manage_terms'               => 'manage_niveis',
        'edit_terms'                 => 'manage_niveis',
        'delete_terms'               => 'manage_niveis',
        'assign_terms'               => 'edit_cursos',
    );

    $args = array(
        'labels'                     => $labels,
        'description'                => __( 'Níveis de formação.', 'ifrs-estude-theme' ),
        'public'                     => true,
        'hierarchical'               => true,
        'show_in_rest'               => true,
        'show_tagcloud'              => false,
        'show_admin_column'          => true,
        'capabilities'               => $capabilities,
        'rewrite'                    => array( 'slug' => 'cursos/nivel' ),
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

/* Metaboxes */
add_action( 'cmb2_admin_init', function() {
    $prefix = '_nivel_';

    /**
     * Cor Metabox
     */
    $cor = new_cmb2_box( array(
        'id'            => $prefix . 'metabox',
        'title'         => __( 'Cor', 'ifrs-estude-theme' ),
        'object_types'  => array( 'term' ),
        'taxonomies'    => array( 'nivel' ),
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => false,
    ) );

    /* Cor */
    $cor->add_field( array(
        'name'    => __( 'Cor', 'ifrs-estude-theme' ),
        'desc'    => __( 'Selecione a cor para representar esse nível.', 'ifrs-estude-theme' ),
        'id'      => $prefix . 'color',
        'type'    => 'colorpicker',
        'default' => '#2a8733',
    ) );
});
